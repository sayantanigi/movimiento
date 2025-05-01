<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Trainer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->Adminmodel->loggedIn();
    }
    public function index() {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Trainer List',
            'subpage' => 'trainer',
        );
        $data['trainer_list'] = $this->Adminmodel->get_all_record('*', 'users', 'user_type = 2', array('id', 'DESC'), '');
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/trainer/trainer_list');
        $this->load->view('admin/footer');
    }
    public function check_trainer_email() {
        $trainer_email = $this->input->post('trainer_email');
        $checkEmail = $this->db->query("SELECT * FROM users WHERE email = '".$trainer_email."'")->row();
        if ($checkEmail > 0) {
            $response = array('status' => 'error', 'message'=>'The given trainer email already exists.');
        } else {
            $response = array('status' => 'success', 'message'=>'Trainer email available.');
        }
        echo json_encode($response);
    }
    public function add_trainer() {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Add Trainer',
            'subpage' => 'trainer',
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['upload_pimage']['name'] != '') {
                $psrc = $_FILES['upload_pimage']['tmp_name'];
                $pfilEnc = time();
                $pavatar = rand(0000, 9999) . "_" . $_FILES['upload_pimage']['name'];
                $pavatar1 = str_replace(array('(', ')', ' '), '', $pavatar);
                $pdest = getcwd() . '/uploads/trainer/profilePic/' . $pavatar1;
                if (move_uploaded_file($psrc, $pdest)) {
                    $pimage  = $pavatar1;
                }
            } else {
                $pimage  = '';
            }

            if ($_FILES['upload_cimage']['name'] != '') {
                $csrc = $_FILES['upload_cimage']['tmp_name'];
                $cfilEnc = time();
                $cavatar = rand(0000, 9999) . "_" . $_FILES['upload_cimage']['name'];
                $cavatar1 = str_replace(array('(', ')', ' '), '', $cavatar);
                $cdest = getcwd() . '/uploads/trainer/cover_image/' . $cavatar1;
                if (move_uploaded_file($csrc, $cdest)) {
                    $cimage  = $cavatar1;
                }
            } else {
                $cimage  = '';
            }
            if (!empty($_POST['skills'])) {
                $count = count($_POST['skills']);
                $all_data = array();

                for ($i = 0; $i < $count; $i++) {
                    $details_data = array(
                        'skills' => $_POST['skills'][$i],
                        'rating' => $_POST['rating'][$i]
                    );

                    $all_data[] = $details_data;
                }

                $serialized_data = serialize($all_data);
            }
            $data = array(
                'added_by' => 'admin',
                'unique_code' => random_int(100000, 999999),
                'user_type' => '2',
                'salutation' => strip_tags($this->input->post('salutation')),
                'first_name' => strip_tags($this->input->post('fname')),
                'last_name' => strip_tags($this->input->post('lname')),
                'username' => strip_tags($this->input->post('username')),
                'email' => strip_tags($this->input->post('email')),
                'about' => $this->input->post('about'),
                'gender' => strip_tags($this->input->post('gender')),
                'dob' => $this->input->post('dob'),
                'phone' => strip_tags($this->input->post('phone')),
                'pfirst_name' => strip_tags($this->input->post('pfirst_name')),
                'plast_name' => strip_tags($this->input->post('plast_name')),
                'pemail' => strip_tags($this->input->post('pemail')),
                'phone_2' => strip_tags($this->input->post('phone_2')),
                'address' => strip_tags($this->input->post('address')),
                'latitude' => strip_tags($this->input->post('latitude')),
                'longitude' => strip_tags($this->input->post('longitude')),
                'country' => strip_tags($this->input->post('country')),
                'state' => strip_tags($this->input->post('state')),
                'city' => strip_tags($this->input->post('city')),
                'zipcode' => strip_tags($this->input->post('pincode')),
                'degree' => strip_tags($this->input->post('degree')),
                'languages' => strip_tags($this->input->post('languages')),
                'certificates' => strip_tags($this->input->post('certificates')),
                'experience' => strip_tags($this->input->post('experience')),
                'image' => $pimage,
                'coverImage' => $cimage,
                'skills' => $serialized_data,
                'status' => $this->input->post('status'),
                'password' => md5($this->input->post('password')),
                'created_at' => date('Y-m-d H:i:s')
            );
            $result = $this->Adminmodel->add('users', $data);
            $trainer_id = $this->db->insert_id();
            $action_id = $this->input->post('action_id');
            $user_id = $trainer_id;
            if($action_id == '1') {
                $this->db->query("DELETE FROM trainer_availability WHERE user_id = '".$user_id."' AND is_datewise = '0' AND is_booked = '0'");
            }
            $this->db->query("UPDATE users SET timeZone = '".$_POST['timeZone']."' WHERE id = '".$user_id."'");
            $outputArray = [];
            $weekDays = ['weekDay1', 'weekDay2', 'weekDay3', 'weekDay4', 'weekDay5', 'weekDay6', 'weekDay7'];
            $fromTimes = ['fromtime1', 'fromtime2','fromtime3', 'fromtime4','fromtime5', 'fromtime6','fromtime7'];
            $toTimes = ['totime1', 'totime2','totime3', 'totime4','totime5', 'totime6','totime7'];
            for ($i = 0; $i < count($weekDays); $i++) {
                $weekDay = $_POST[$weekDays[$i]];
                $fromTime = $_POST[$fromTimes[$i]];
                $toTime = $_POST[$toTimes[$i]];
                $outputArray[$i]['weekDay'] = [
                    'date' => $this->getDateForWeekDay($_POST['starting_date'], $weekDay),
                    'day' => $weekDay,
                    'fromtime' => $fromTime,
                    'totime' => $toTime,
                    'timeZone' => $_POST['timeZone'],
                    'repeat_month' => @$_POST['repeat_month'],
                    'schedule_status' => '1',
                    'user_id' => $user_id,
                ];
            }
            $output = $outputArray;
            $filteredArray = array_filter($output, function($item) {
                return !$this->isEmptyWeekDay($item['weekDay']);
            });
            $filteredArray = array_values($filteredArray);
            foreach ($filteredArray as $entry) {
                $weekDay = $entry['weekDay'];
                foreach ($weekDay['fromtime'] as $key => $fromtime) {
                    $totime = isset($weekDay['totime'][$key]) ? $weekDay['totime'][$key] : null;
                    $utcfromTime = new DateTime($fromtime, new DateTimeZone($_POST['timeZone']));
                    $utcfromTime->setTimezone(new DateTimeZone('UTC'));
                    $utcFromTime = $utcfromTime->format('H:i');

                    $utctoTime = new DateTime($totime, new DateTimeZone($_POST['timeZone']));
                    $utctoTime->setTimezone(new DateTimeZone('UTC'));
                    $utcToTime = $utctoTime->format('H:i');

                    $utcStartDate = new DateTime($weekDay['date']." ".$fromtime, new DateTimeZone($_POST['timeZone']));
                    $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                    $utcStartDate = $utcStartDate->format('Y-m-d');

                    $schedule_data = array(
                        'user_id' => $weekDay['user_id'],
                        'weekday' => $weekDay['day'],
                        'weekdayslot' => $fromtime." to ".$totime,
                        'timeZone' => $_POST['timeZone'],
                        'utcTime' => $utcFromTime." to ".$utcToTime,
                        'start_date' => $weekDay['date'],
                        'utcStartDate' => $utcStartDate,
                        'repeat_month' => $weekDay['repeat_month'],
                        'schedule_status' => $weekDay['schedule_status'],
                    );

                    $data = $schedule_data;
                    if($data['repeat_month'] == '1') {
                        $repeatMonth = '12';
                        $schedule = [];
                        $startDate = new DateTime($data['start_date']);
                        $targetWeekday = $this->getWeekdayNumber($data['weekday']);
                        $currentMonth = $startDate->format('m');
                        $currentYear = $startDate->format('Y');
                        for ($i = 0; $i < $repeatMonth; $i++) {
                            $firstDayOfMonth = new DateTime("$currentYear-$currentMonth-01");
                            $firstTargetWeekday = clone $firstDayOfMonth;
                            $firstDayOfWeek = $firstTargetWeekday->format('N');
                            $diff = $targetWeekday - $firstDayOfWeek;
                            if ($diff < 0) {
                                $diff += 7;
                            }
                            $firstTargetWeekday->modify("+$diff days");
                            if ($firstTargetWeekday < $startDate) {
                                $firstTargetWeekday->modify('+1 week');
                            }

                            while ($firstTargetWeekday->format('m') == $currentMonth) {
                                $utcStartDate = new DateTime($firstTargetWeekday->format('Y-m-d'), new DateTimeZone($data['timeZone']));
                                $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                                $utcStartDate = $utcStartDate->format('Y-m-d');
                                $schedule[] = [
                                    'user_id' => $data['user_id'],
                                    'weekday' => $data['weekday'],
                                    'weekdayslot' => $data['weekdayslot'],
                                    'timeZone' => $data['timeZone'],
                                    'utcTime' => $data['utcTime'],
                                    'start_date' => $firstTargetWeekday->format('Y-m-d'),
                                    'utcStartDate' => $utcStartDate,
                                    'repeat_month' => $data['repeat_month'],
                                    'schedule_status' => $data['schedule_status'],
                                ];
                                $firstTargetWeekday->modify('+1 week');
                            }
                            $currentMonth++;
                            if ($currentMonth > 12) {
                                $currentMonth = 1;
                                $currentYear++;
                            }
                        }
                        $finalData = [];
                        foreach ($schedule as $key => $value) {
                            $finalData['user_id'] = $value['user_id'];
                            $finalData['weekday'] = $value['weekday'];
                            $finalData['weekdayslot'] = $value['weekdayslot'];
                            $finalData['timeZone'] = $value['timeZone'];
                            $finalData['utcTime'] = $value['utcTime'];
                            $finalData['start_date'] = $value['start_date'];
                            $finalData['utcStartDate'] = $value['utcStartDate'];
                            $finalData['repeat_month'] = $value['repeat_month'];
                            $finalData['schedule_status'] = $value['schedule_status'];
                            $this->Adminmodel->add('trainer_availability', $finalData);
                        }
                    } else {
                        $repeatMonth = '1';
                        $schedule = [];
                        $startDate = new DateTime($data['start_date']);
                        $targetWeekday = $this->getWeekdayNumber($data['weekday']);
                        $currentMonth = $startDate->format('m');
                        $currentYear = $startDate->format('Y');
                        for ($i = 0; $i < $repeatMonth; $i++) {
                            $firstDayOfMonth = new DateTime($data['start_date']);
                            $firstTargetWeekday = clone $firstDayOfMonth;
                            $firstDayOfWeek = (int)$firstTargetWeekday->format('N');
                            $diff = $targetWeekday - $firstDayOfWeek;
                            if ($diff < 0) {
                                $diff += 7;
                            }
                            $firstTargetWeekday->modify("+$diff days");
                            if ($firstTargetWeekday < $startDate) {
                                $firstTargetWeekday->modify('+1 week');
                            }
                            while ($firstTargetWeekday->format('m') == $currentMonth) {
                                $utcStartDate = new DateTime($firstTargetWeekday->format('Y-m-d'), new DateTimeZone($data['timeZone']));
                                $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                                $utcStartDate = $utcStartDate->format('Y-m-d');
                                $schedule[] = [
                                    'user_id' => $data['user_id'],
                                    'weekday' => $data['weekday'],
                                    'weekdayslot' => $data['weekdayslot'],
                                    'timeZone' => $data['timeZone'],
                                    'utcTime' => $data['utcTime'],
                                    'start_date' => $firstTargetWeekday->format('Y-m-d'),
                                    'utcStartDate' => $utcStartDate,
                                    'repeat_month' => $data['repeat_month'],
                                    'schedule_status' => $data['schedule_status'],
                                ];
                                $firstTargetWeekday->modify('+1 week');
                            }
                            $currentMonth++;
                            if ($currentMonth > 12) {
                                $currentMonth = 1;
                                $currentYear++;
                            }
                        }
                        $finalData = [];
                        //print_r($schedule);
                        foreach ($schedule as $key => $value) {
                            $finalData['user_id'] = $value['user_id'];
                            $finalData['weekday'] = $value['weekday'];
                            $finalData['weekdayslot'] = $value['weekdayslot'];
                            $finalData['timeZone'] = $value['timeZone'];
                            $finalData['utcTime'] = $value['utcTime'];
                            $finalData['start_date'] = $value['start_date'];
                            $finalData['utcStartDate'] = $value['utcStartDate'];
                            $finalData['repeat_month'] = $value['repeat_month'];
                            $finalData['schedule_status'] = $value['schedule_status'];
                            $this->Adminmodel->add('trainer_availability', $finalData);
                        }
                    }
                }
            }
            if ($result) {
                $msg = '["Trainer has been added successfully.", "success", "#A5DC86"]';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/trainer'), 'refresh');
            } else {
                $msg = 'Some error occurred.Please try again.';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/trainer'), 'refresh');
            }
        }
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/trainer/add_trainer');
        $this->load->view('admin/footer');
    }
    public function edit_trainer($id) {
        $data = array(
            'title' => 'Bay Hill DS',
            'page' => 'Edit Trainer',
            'subpage' => 'trainer',
        );
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($_FILES['upload_pimage']['name'] != '') {
                $psrc = $_FILES['upload_pimage']['tmp_name'];
                $pfilEnc = time();
                $pavatar = rand(0000, 9999) . "_" . $_FILES['upload_pimage']['name'];
                $pavatar1 = str_replace(array('(', ')', ' '), '', $pavatar);
                $pdest = getcwd() . '/uploads/trainer/profilePic/' . $pavatar1;
                if (move_uploaded_file($psrc, $pdest)) {
                    $pimage  = $pavatar1;
                    @unlink('uploads/trainer/profilePic/' . $_POST['old_pimage']);
                }
            } else {
                if(!empty($_POST['old_pimage'])) {
                    $pimage  = $_POST['old_pimage'];
                } else {
                    $pimage  = '';
                }
            }

            if ($_FILES['upload_cimage']['name'] != '') {
                $csrc = $_FILES['upload_cimage']['tmp_name'];
                $cfilEnc = time();
                $cavatar = rand(0000, 9999) . "_" . $_FILES['upload_cimage']['name'];
                $cavatar1 = str_replace(array('(', ')', ' '), '', $cavatar);
                $cdest = getcwd() . '/uploads/trainer/cover_image/' . $cavatar1;
                if (move_uploaded_file($csrc, $cdest)) {
                    $cimage  = $cavatar1;
                    @unlink('uploads/trainer/cover_image/' . $_POST['old_cimage']);
                }
            } else {
                if(!empty($_POST['old_cimage'])) {
                    $cimage  = $_POST['old_cimage'];
                } else {
                    $cimage  = '';
                }
            }

            if (!empty($_POST['skills'])) {
                $count = count($_POST['skills']);
                $all_data = array();
                for ($i = 0; $i < $count; $i++) {
                    $details_data = array(
                        'skills' => $_POST['skills'][$i],
                        'rating' => $_POST['rating'][$i]
                    );
                    $all_data[] = $details_data;
                }
                $serialized_data = serialize($all_data);
            }

            $data = array(
                'salutation' => strip_tags($this->input->post('salutation')),
                'first_name' => strip_tags($this->input->post('fname')),
                'last_name' => strip_tags($this->input->post('lname')),
                'username' => strip_tags($this->input->post('username')),
                'email' => strip_tags($this->input->post('email')),
                'about' => $this->input->post('about'),
                'gender' => strip_tags($this->input->post('gender')),
                'dob' => $this->input->post('dob'),
                'phone' => strip_tags($this->input->post('phone')),
                'pfirst_name' => strip_tags($this->input->post('pfirst_name')),
                'plast_name' => strip_tags($this->input->post('plast_name')),
                'pemail' => strip_tags($this->input->post('pemail')),
                'phone_2' => strip_tags($this->input->post('phone_2')),
                'address' => strip_tags($this->input->post('address')),
                'latitude' => strip_tags($this->input->post('latitude')),
                'longitude' => strip_tags($this->input->post('longitude')),
                'country' => strip_tags($this->input->post('country')),
                'state' => strip_tags($this->input->post('state')),
                'city' => strip_tags($this->input->post('city')),
                'zipcode' => strip_tags($this->input->post('pincode')),
                'degree' => strip_tags($this->input->post('degree')),
                'languages' => strip_tags($this->input->post('languages')),
                'certificates' => strip_tags($this->input->post('certificates')),
                'experience' => strip_tags($this->input->post('experience')),
                'skills' => $serialized_data,
                'image' => $pimage,
                'coverImage' => $cimage,
                'status' => $this->input->post('status'),
            );
            $result = $this->Adminmodel->update($data, 'users', array('id' => $id));
            if ($result) {
                $msg = '["Trainer has been updated successfully.", "success", "#A5DC86"]';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/trainer'), 'refresh');
            } else {
                $msg = 'Some error occurred.Please try again.';
                $this->session->set_flashdata('msg', $msg);
                redirect(base_url('admin/trainer'), 'refresh');
            }
        }
        $data['result'] = $this->Adminmodel->get_by('users', 'single', array('id' => $id), '', 1);
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar');
        $this->load->view('admin/trainer/edit_trainer');
        $this->load->view('admin/footer');
    }
    public function changestatus() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $status = $this->input->post('status');
            if ($status == 1) {
                $msg = 'Your status is Activate';
            } else {
                $msg = 'Your status is Inctivate';
            }
            if ($this->Adminmodel->update(['status' => $status], 'users', ['id' => $id])) {
                echo '["' . $msg . '", "success", "#A5DC86"]';
            } else {
                echo '["Some error occured, Please try again!", "error", "#DD6B55"]';
            }
        }
    }
    function getDateForWeekDay($startingDate, $weekDay) {
        $startDate = new DateTime($startingDate);
        $currentWeekDay = $startDate->format('l');
        $diffDays = (new DateTime($weekDay))->diff($startDate)->days;
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $currentDayIndex = array_search($currentWeekDay, $daysOfWeek);
        $targetDayIndex = array_search($weekDay, $daysOfWeek);
        $daysToAdd = ($targetDayIndex - $currentDayIndex + 7) % 7;
        $date = clone $startDate;
        $date->modify("+$daysToAdd days");
        return $date->format('Y-m-d');
    }
    function isEmptyWeekDay($weekDay) {
        //return empty(@$weekDay['day']) && empty(array_filter(@$weekDay['fromtime'])) && empty(array_filter(@$weekDay['totime']));
    }
    function getWeekdayNumber($weekday) {
        $weekdays = [
            'Monday' => 1,
            'Tuesday' => 2,
            'Wednesday' => 3,
            'Thursday' => 4,
            'Friday' => 5,
            'Saturday' => 6,
            'Sunday' => 7
        ];
        if (isset($weekdays[$weekday])) {
            return $weekdays[$weekday];
        } else {
            return 1; // Default to Monday
        }
    }
    function utcDateTime($dateTimeInput, $inputTimezone) {
        $dateTime = new DateTime($dateTimeInput, new DateTimeZone($inputTimezone));
        $dateTime->setTimezone(new DateTimeZone('UTC'));
        return $dateTime->format('Y-m-d H:i:s');
    }
    public function create_availability() {
        $action_id = $_POST['action_id'];
        $user_id = $_POST['user_id'];
        if($action_id == '1') {
            $this->db->query("DELETE FROM trainer_availability WHERE user_id = '".$user_id."' AND is_datewise = '0' AND is_booked = '0'");
        }
        $this->db->query("UPDATE users SET timeZone = '".$_POST['timeZone']."' WHERE id = '".$user_id."'");
        $outputArray = [];
        $weekDays = ['weekDay1', 'weekDay2', 'weekDay3', 'weekDay4', 'weekDay5', 'weekDay6', 'weekDay7'];
        $fromTimes = ['fromtime1', 'fromtime2','fromtime3', 'fromtime4','fromtime5', 'fromtime6','fromtime7'];
        $toTimes = ['totime1', 'totime2','totime3', 'totime4','totime5', 'totime6','totime7'];
        for ($i = 0; $i < count($weekDays); $i++) {
            $weekDay = $_POST[$weekDays[$i]];
            $fromTime = $_POST[$fromTimes[$i]];
            $toTime = $_POST[$toTimes[$i]];
            $outputArray[$i]['weekDay'] = [
                'date' => $this->getDateForWeekDay($_POST['starting_date'], $weekDay),
                'day' => $weekDay,
                'fromtime' => $fromTime,
                'totime' => $toTime,
                'timeZone' => $_POST['timeZone'],
                'repeat_month' => @$_POST['repeat_month'],
                'schedule_status' => '1',
                'user_id' => $user_id,
            ];
        }
        $output = $outputArray;
        $filteredArray = array_filter($output, function($item) {
            return !$this->isEmptyWeekDay($item['weekDay']);
        });
        $filteredArray = array_values($filteredArray);
        foreach ($filteredArray as $entry) {
            $weekDay = $entry['weekDay'];
            foreach ($weekDay['fromtime'] as $key => $fromtime) {
                $totime = isset($weekDay['totime'][$key]) ? $weekDay['totime'][$key] : null;
                $utcfromTime = new DateTime($fromtime, new DateTimeZone($_POST['timeZone']));
                $utcfromTime->setTimezone(new DateTimeZone('UTC'));
                $utcFromTime = $utcfromTime->format('H:i');

                $utctoTime = new DateTime($totime, new DateTimeZone($_POST['timeZone']));
                $utctoTime->setTimezone(new DateTimeZone('UTC'));
                $utcToTime = $utctoTime->format('H:i');

                $utcStartDate = new DateTime($weekDay['date']." ".$fromtime, new DateTimeZone($_POST['timeZone']));
                $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                $utcStartDate = $utcStartDate->format('Y-m-d');

                $schedule_data = array(
                    'user_id' => $weekDay['user_id'],
                    'weekday' => $weekDay['day'],
                    'weekdayslot' => $fromtime." to ".$totime,
                    'timeZone' => $_POST['timeZone'],
                    'utcTime' => $utcFromTime." to ".$utcToTime,
                    'start_date' => $weekDay['date'],
                    'utcStartDate' => $utcStartDate,
                    'repeat_month' => $weekDay['repeat_month'],
                    'schedule_status' => $weekDay['schedule_status'],
                );

                $data = $schedule_data;
                if($data['repeat_month'] == '1') {
                    $repeatMonth = '12';
                    $schedule = [];
                    $startDate = new DateTime($data['start_date']);
                    $targetWeekday = $this->getWeekdayNumber($data['weekday']);
                    $currentMonth = $startDate->format('m');
                    $currentYear = $startDate->format('Y');
                    for ($i = 0; $i < $repeatMonth; $i++) {
                        $firstDayOfMonth = new DateTime("$currentYear-$currentMonth-01");
                        $firstTargetWeekday = clone $firstDayOfMonth;
                        $firstDayOfWeek = $firstTargetWeekday->format('N');
                        $diff = $targetWeekday - $firstDayOfWeek;
                        if ($diff < 0) {
                            $diff += 7;
                        }
                        $firstTargetWeekday->modify("+$diff days");
                        if ($firstTargetWeekday < $startDate) {
                            $firstTargetWeekday->modify('+1 week');
                        }

                        while ($firstTargetWeekday->format('m') == $currentMonth) {
                            $utcStartDate = new DateTime($firstTargetWeekday->format('Y-m-d'), new DateTimeZone($data['timeZone']));
                            $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                            $utcStartDate = $utcStartDate->format('Y-m-d');
                            $schedule[] = [
                                'user_id' => $data['user_id'],
                                'weekday' => $data['weekday'],
                                'weekdayslot' => $data['weekdayslot'],
                                'timeZone' => $data['timeZone'],
                                'utcTime' => $data['utcTime'],
                                'start_date' => $firstTargetWeekday->format('Y-m-d'),
                                'utcStartDate' => $utcStartDate,
                                'repeat_month' => $data['repeat_month'],
                                'schedule_status' => $data['schedule_status'],
                            ];
                            $firstTargetWeekday->modify('+1 week');
                        }
                        $currentMonth++;
                        if ($currentMonth > 12) {
                            $currentMonth = 1;
                            $currentYear++;
                        }
                    }
                    $finalData = [];
                    foreach ($schedule as $key => $value) {
                        $finalData['user_id'] = $value['user_id'];
                        $finalData['weekday'] = $value['weekday'];
                        $finalData['weekdayslot'] = $value['weekdayslot'];
                        $finalData['timeZone'] = $value['timeZone'];
                        $finalData['utcTime'] = $value['utcTime'];
                        $finalData['start_date'] = $value['start_date'];
                        $finalData['utcStartDate'] = $value['utcStartDate'];
                        $finalData['repeat_month'] = $value['repeat_month'];
                        $finalData['schedule_status'] = $value['schedule_status'];
                        $this->Adminmodel->add('trainer_availability', $finalData);
                    }
                } else {
                    $repeatMonth = '1';
                    $schedule = [];
                    $startDate = new DateTime($data['start_date']);
                    $targetWeekday = $this->getWeekdayNumber($data['weekday']);
                    $currentMonth = $startDate->format('m');
                    $currentYear = $startDate->format('Y');
                    for ($i = 0; $i < $repeatMonth; $i++) {
                        $firstDayOfMonth = new DateTime($data['start_date']);
                        $firstTargetWeekday = clone $firstDayOfMonth;
                        $firstDayOfWeek = (int)$firstTargetWeekday->format('N');
                        $diff = $targetWeekday - $firstDayOfWeek;
                        if ($diff < 0) {
                            $diff += 7;
                        }
                        $firstTargetWeekday->modify("+$diff days");
                        if ($firstTargetWeekday < $startDate) {
                            $firstTargetWeekday->modify('+1 week');
                        }
                        while ($firstTargetWeekday->format('m') == $currentMonth) {
                            $utcStartDate = new DateTime($firstTargetWeekday->format('Y-m-d'), new DateTimeZone($data['timeZone']));
                            $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                            $utcStartDate = $utcStartDate->format('Y-m-d');
                            $schedule[] = [
                                'user_id' => $data['user_id'],
                                'weekday' => $data['weekday'],
                                'weekdayslot' => $data['weekdayslot'],
                                'timeZone' => $data['timeZone'],
                                'utcTime' => $data['utcTime'],
                                'start_date' => $firstTargetWeekday->format('Y-m-d'),
                                'utcStartDate' => $utcStartDate,
                                'repeat_month' => $data['repeat_month'],
                                'schedule_status' => $data['schedule_status'],
                            ];
                            $firstTargetWeekday->modify('+1 week');
                        }
                        $currentMonth++;
                        if ($currentMonth > 12) {
                            $currentMonth = 1;
                            $currentYear++;
                        }
                    }
                    $finalData = [];
                    //print_r($schedule);
                    foreach ($schedule as $key => $value) {
                        $finalData['user_id'] = $value['user_id'];
                        $finalData['weekday'] = $value['weekday'];
                        $finalData['weekdayslot'] = $value['weekdayslot'];
                        $finalData['timeZone'] = $value['timeZone'];
                        $finalData['utcTime'] = $value['utcTime'];
                        $finalData['start_date'] = $value['start_date'];
                        $finalData['utcStartDate'] = $value['utcStartDate'];
                        $finalData['repeat_month'] = $value['repeat_month'];
                        $finalData['schedule_status'] = $value['schedule_status'];
                        $this->Adminmodel->add('trainer_availability', $finalData);
                    }
                }
            }
        }
        echo '1';
    }
    public function createdatewiseavailability() {
        $user_id = $_POST['user_id'];
        $output = array();
        $specific_dates = explode(',', $_POST['specific_date'][0]);
        $this->db->query("DELETE FROM trainer_availability WHERE user_id = '".$user_id."' AND is_datewise = '1' AND is_booked = '0'");
        foreach ($specific_dates as $date) {
            $weekday = $this->getWeekdayName($date);
            foreach ($_POST['fromtimedate'] as $index => $start_time) {
                $end_time = $_POST['totimedate'][$index];
                $time_slot = $start_time . ' to ' . $end_time;

                $utcfromTimedate = new DateTime($start_time, new DateTimeZone($_POST['timeZonedate']));
                $utcfromTimedate->setTimezone(new DateTimeZone('UTC'));
                $utcFromTimedate = $utcfromTimedate->format('H:i');

                $utctoTimedate = new DateTime($end_time, new DateTimeZone($_POST['timeZonedate']));
                $utctoTimedate->setTimezone(new DateTimeZone('UTC'));
                $utcToTimedate = $utctoTimedate->format('H:i');

                $utcStartDate = new DateTime($date." ".$start_time, new DateTimeZone($_POST['timeZonedate']));
                $utcStartDate->setTimezone(new DateTimeZone('UTC'));
                $utcStartDate = $utcStartDate->format('Y-m-d');

                $slot = array(
                    'user_id' => $_POST['user_id'],
                    'weekday' => $weekday,
                    'weekdayslot' => $time_slot,
                    'start_date' => $date,
                    'timeZone' => $_POST['timeZonedate'],
                    'utcTime' => $utcFromTimedate." to ".$utcToTimedate,
                    'utcStartDate' => $utcStartDate,
                    'schedule_status' => 1,
                    'is_booked' => 0
                );
                $output[] = $slot;
            }
        }
        $finalArray = $output;
        $storedata = [];
        foreach ($finalArray as $key1 => $value) {
            $storedata['user_id'] = $value['user_id'];
            $storedata['weekday'] = $value['weekday'];
            $storedata['weekdayslot'] = $value['weekdayslot'];
            $storedata['timeZone'] = $value['timeZone'];
            $storedata['start_date'] = $value['start_date'];
            $storedata['utcTime'] = $value['utcTime'];
            $storedata['utcStartDate'] = $value['utcStartDate'];
            $storedata['schedule_status'] = $value['schedule_status'];
            $storedata['is_booked'] = $value['is_booked'];
            $storedata['is_datewise'] = '1';
            $this->Adminmodel->add('trainer_availability', $storedata);
        }
		echo "1";
    }
    function getWeekdayName($date) {
        return date('l', strtotime($date)); // Returns the full weekday name (e.g., "Monday")
    }
}
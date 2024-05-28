<?php
$user_id = $this->session->userdata('user_id');
$userDetails = $this->Commonmodel->fetch_row('users', array('id' => $user_id));
//print_r($userDetails); die();
$completedCourse = 0;
$courseArray = array();

if (!empty($enrolments)) {
    foreach ($enrolments as $key => $value) {
        $totalModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$value->course_id . "'";
        $totalmodule = $this->db->query($totalModuleSql)->num_rows();
        $moduleData = $this->db->query($totalModuleSql)->result();
        $moduleArray = array();
        if (!empty($moduleData)) {
            foreach ($moduleData as $keyn => $item) {
                $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$value->course_id . "' AND `module` = '" . @$item->id . "'";
                $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();
                $getAttemptModuleSql = "SELECT COUNT(*) as attemptModule FROM `course_enrollment_status` where `course_id` = '" . @$value->course_id . "' and `module` = '" . $item->id . "' and `enrollment_id` = '" . @$value->enrollment_id . "'";
                $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();
                $totalComModule = 0;
                if (@$totalmaterial == @$attemptModuleRow->attemptModule && @$totalmaterial != '0') {
                    $totalComModule++;
                    $moduleArray[] = $item->id;
                }
                // echo "<br> Course Id = ".@$value->course_id." Total Module ".$totalmodule." ModuleId = ".$item->id." Material ".$totalmaterial." attempt = ".@$attemptModuleRow->attemptModule." Completed = ".$totalComModule;
            }
        }
        if (@$totalmodule == count($moduleArray)) {
            $courseArray[] = $value->course_id;

        }
    }
}
$condition = "";
if (!empty($courseArray)) {
    $courseIds = implode("', '", $courseArray);
    $condition = " AND course_id NOT IN('$courseIds')";
}
$getEnrolmentSql = "SELECT COUNT(DISTINCT `enrollment_id`) AS activeCourse FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "' $condition";
$active_data = $this->db->query($getEnrolmentSql)->row();
$activeCourse = 0;
if (!empty($active_data)) {
    $activeCourse = $active_data->activeCourse;
}
?>
<main>
    <section class="pt-100 pb-145">
        <div class="container">
            <div class="rbt-dashboard-content-wrapper">
                <div class="rbt-tutor-information">
                    <div class="rbt-tutor-information-left d-flex align-items-center">
                        <div class="thumbnail rbt-avatars size-lg">
                            <?php if (!empty($userDetails->image)) { ?>
                                <img src="<?= base_url() ?>/uploads/profile_pictures/<?= $userDetails->image ?>" alt="">
                            <?php } else { ?>
                                <img src="images/no-user.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="tutor-content">
                            <h5 class="title h4 fw-bold">
                                <?= $userDetails->fname ?>
                            </h5>
                            <ul class="listRbt mt--5">
                                <li><i class="far fa-book-alt"></i>
                                    <?php echo @$ctn_enrolment; ?> Courses Enroled
                                </li>
                                <li><i class="far fa-file-certificate"></i>
                                    <?php echo count($courseArray); ?> Certificate
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $this->load->view('leftbar_dash'); ?>
                <div class="col-lg-8">
                    <div class="card bg-dark shadow">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold text-uppercase">Product Order History</h2>
                            <hr>
                            <div class="table-responsive">
                                <table class="rbt-table table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Product Details</th>
                                            <th>Date</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                        if(!empty($productOrderList)) {
                                            foreach ($productOrderList as $value) {
                                        ?>
                                        <tr>
                                            <th>#<?php echo @$value['txn_id']; ?></th>
                                            <td>
                                            <?php 
                                            $order_item = json_decode($value['order_item']); 
                                            for($i=0; $i < count($order_item); $i++) {
                                                $proQuery = $this->db->query("SELECT * FROM product WHERE id = '".$order_item[$i]->product_id."'")->result_array();
                                                foreach ($proQuery as $proData) {?>
                                                <p style="color: #fff; margin: 0px; text-align: end;">
                                                    <?= $proData['product_name']." (".$order_item[$i]->size.") x".$order_item[$i]->quantity." = ".$order_item[$i]->price?>
                                                </p>
                                            <?php } } ?>
                                                <p style="color: #fff; margin: 0px; text-align: end;">Shipping: <?= $value['shipping']; ?></p>
                                                <p style="color: #fff; margin: 0px; text-align: end;">Tax: <?= number_format((float)$value['tax'], 2, '.', ''); ?></p>
                                                <hr style="margin: 1px;">
                                                <p style="color: #fff; margin: 0px; text-align: end;">Total: <?= number_format((float)$value['order_total'], 2, '.', ''); ?></p>
                                            </td>
                                            <td><?php echo date("jS F Y, H:i", strtotime(@$value['created_date'])); ?></td>
                                            <td><?php echo @number_format((float)$value['order_total'], 2, '.', ''); ?></td>
                                            <td><span class="badge bg-success rounded-pill fw-normal"><?php echo ucWords(strtolower(@$value['status'])); ?></span></td>
                                        </tr>
                                        <?php } } else { ?>
                                        <tr>
                                            <td colspan="5" style="text-align: center">
                                                <div class="dashboard-table__text">No record available!</div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
<?php
$getCourse = $this->db->query("SELECT * FROM courses WHERE id = '".$course_id."'")->row();
?>
<section class="enrollPnl">
    <div class="container">
        <h2 class="subtitle  wow fadeInUp">Booking Slot</h2>
        <div class="d-lg-flex gap-4 justify-content-between">
            <div><h3 class="maintitle mb-4  wow fadeInUp">Plan your reservation based on<br/> your preferences</h3></div>
            <div class="mb-4">
                <a href="<?= base_url() ?>booking_slot?ctitle=<?= base64_encode($getCourse->course_name)?>&uid=<?= base64_encode($user_id)?>" class="enrollbtn btn-warning">Book By Availability</a>
                <a href="<?= base_url() ?>instructor_list?ctitle=<?= base64_encode($getCourse->course_name)?>&uid=<?= base64_encode($user_id)?>" class="enrollbtn">Book by Instructor</a>
            </div>
        </div>
        <div class="boxDateSchdule">
            <?php if(empty($booking_id)) { ?>
            <form action="<?php echo base_url() ?>create-booking?ctitle=<?= base64_encode($getCourse->course_name) ?>&uid=<?= base64_encode($user_id) ?>" method="POST">
            <?php } else { ?>
            <form action="<?php echo base_url() ?>confirm-booking?ctitle=<?= base64_encode($getCourse->course_name) ?>&uid=<?= base64_encode($user_id) ?>&bookingid=<?= base64_encode($booking_id) ?>" method="POST">
            <?php } ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="p-lg-5 p-3">
                            <div id="calendar-container" class="mt-0">
                                <div id="calendar"></div>
                                <ul class="mt-30 sloatsInfo">
                                    <li><span style="background-color: #d4edda;"></span> Available Time Slots</li>
                                    <li><span style="background-color: #f0d0d0;"></span> No available slots</li>
                                    <li><span style="background-color: #f5f6fa;"></span> Expired slots</li>
                                </ul>
                                <p style="font-size: 12px; text-align: justify; color: red; margin-top: 12px; margin-bottom: 0; font-style: italic;">Note: Please select your date. Once select it cannot be undone.</p>
                                <p style="font-size: 12px; text-align: justify; color: red; margin-top: 0; margin-bottom: 0; font-style: italic;">*You can select one or multiple dates as per your convenience.</p>
                            </div>
                            <div id="slot-container" style="display: none;">
                                <div class="text-start"><a href="#" class="text-warning" id="back-to-calendar"><i class="fas fa-chevron-left me-1"></i> Back to Calendar</a></div>
                                <h5 class="h6" id="selected-date">Selected Date:</h5>
                                <div id="slots"></div>
                                <ul class="mt-30 sloatsInfo">
                                    <li><span style="background-color: #d4edda;"></span> Available Time Slots</li>
                                    <li><span style="background-color: #f0d0d0;"></span> No available slots</li>
                                </ul>
                                <p style="font-size: 12px; text-align: justify; color: red; margin-top: 12px; margin-bottom: 0; font-style: italic;">Note: Please select your slot. Once select it cannot be undone.</p>
                                <p style="font-size: 12px; text-align: justify; color: red; margin-top: 0; margin-bottom: 0; font-style: italic;">*You can select one or multiple dates as per your convenience.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-lg-5 p-3 h-100 boxoutput">
                            <p class="text-muted mb-0">Course Name</p>
                            <h2 class="h4 mb-15 fw-semibold"><?= $course_title; ?></h2>
                            <div class="mt-30 mb-50">
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="d-flex w-100 bookingBox align-items-center">
                                            <div class="iconBook">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="boxInfo">
                                                <h3><?= $course_duration; ?><?= ($course_duration == 1) ? " Hour" : " Hours"; ?></h3>
                                                <h4>Course Duration</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex w-100 bookingBox align-items-center">
                                            <div class="iconBook">
                                                <i class="fas fa-id-card-alt"></i>
                                            </div>
                                            <div class="boxInfo">
                                                <h3>
                                                    <?= $course_class; ?>
                                                    <?= ($course_class == 1) ? " Class" : " Classes"; ?>
                                                </h3>
                                                <h4>Course Class</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="d-flex w-100 bookingBox align-items-center">
                                            <div class="iconBook">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                            <div class="boxInfo">
                                                <h3>$ <?= $offer_price; ?></h3>
                                                <h4>Price</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6" id="datetimeboxInfo">
                                        <div class="d-flex w-100 bookingBox align-items-center">
                                            <div class="iconBook">
                                                <i class="fas fa-calendar-check"></i>
                                            </div>
                                            <div class="boxInfo">
                                                <h3 class="boxdate">15 Dec, 2024</h3>
                                                <h5 class="boxtime">9:00 am - 11:00 am</h5>
                                                <h4>Date & Time</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="booking_details" class="mt-30 mb-50">
                                <h2 class="h4 mb-15 fw-semibold bookingDetails">Booking Details</h2>
                                <div id="booking-details" class="mt-10 mb-10"></div>
                            </div>
                            <div id="emptySlotmsg"></div>
                            <div class="text-center">
                                <button class="enrollbtn" id="confirm-booking">Confirm Book Slot</button>
                                <input type="hidden" id="course_id" name="course_id" value="<?= $course_id; ?>">
                                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>">
                                <input type="hidden" id="booking_id" name="booking_id" value="<?= @$booking_id; ?>">
                                <input type="hidden" id="selected_dates" name="selected_dates" value="">
                                <input type="hidden" id="selected_times" name="selected_times" value="">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="whychoose" style="background-image: url(./assets/images/serv-bg-03.jpg);">
    <div class="container">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <h2 class="maintitle text-white mb-4">Why Take California Driver Ed With Us?</h2>
                <p>Bayhill Driving school established in 2013, have designed an Driving Lessons proven to give you quality driver education, provides a solid foundation of knowledge and skills that can help you to become a safe driver in California. Instructors are fully licensed by the State of California with extensive Behind The Wheel experience. We pride ourselves on providing a patient and supportive style when working with both teens and adults. Each instructor is License and approved by the DMV. All our Instructors act in a professional and courteous manner when giving instructions.</p>
                <div class="mt-5">
                    <a href="<?= base_url()?>faq" class="enrollbtn text-uppercase">Course FAQ</a>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
#slots label span{width: 120px !important;}
</style>
<script>
const slots = [
    { time: '09:00 am - 11:00 am', status: 'available' },
    { time: '11:00 am - 01:00 pm', status: 'available' },
    { time: '01:00 pm - 03:00 pm', status: 'available' },
    { time: '03:00 pm - 05:00 pm', status: 'available' },
];

let selectedSlots = [];
let selectedDates = [];
let currentClass = 1;
<?php
$getBookingData = $this->db->query("SELECT * FROM booking WHERE user_id = '".@$_SESSION['bayhill']['user_id']."' AND course_id = '".@$course_id."'")->row();
$getBookingSlots = $this->db->query("SELECT * FROM booking_details WHERE booking_id = '".@$getBookingData->id."'")->result();
if($course_class > count($getBookingSlots)) { ?>
const totalClasses = <?= $course_class - count($getBookingSlots); ?>;
<?php } else { ?>
const totalClasses = <?= $course_class ?>;
<?php } ?>

$(function() {
    $("#confirm-booking").hide();
    $(".bookingDetails").hide();
    const calendarElement = $('#calendar');
    const today = new Date();
    let selectedDate = null;

    function renderCalendar(month, year) {
        calendarElement.empty();
        const firstDay = new Date(year, month).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        const monthYearHeader = $('<div></div>').addClass('month-year-header');
        const prevButton = $('<button><i class="fas fa-chevron-left"></i></button>').click(() => {
            if (month === 0) {
                renderCalendar(11, year - 1);
            } else {
                renderCalendar(month - 1, year);
            }
        });
        const nextButton = $('<button><i class="fas fa-chevron-right"></i></button>').click(() => {
            if (month === 11) {
                renderCalendar(0, year + 1);
            } else {
                renderCalendar(month + 1, year);
            }
        });
        const monthYearText = $('<span></span>').text(`${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`);

        monthYearHeader.append(prevButton, monthYearText, nextButton);
        calendarElement.append(monthYearHeader);

        const dayNames = $('<div></div>').addClass('day-names');
        ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].forEach(day => {
            dayNames.append($('<div></div>').text(day));
        });
        calendarElement.append(dayNames);

        const daysGrid = $('<div></div>').addClass('days-grid');
        for (let i = 0; i < firstDay; i++) {
            daysGrid.append($('<div></div>'));
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            let dayElement = $('<div></div>').text(day);

            //if (date < today.setHours(0, 0, 0, 0)) {
            if (date < today.setHours(0, 0, 0, 0) || date.getDay() === 0 || date.getDay() === 6) {
                dayElement.addClass('disabled');
            } else {
                dayElement.addClass('available');
                dayElement.click(() => {
                    selectedDate = date.toDateString();
                    const formattedDate = date.toLocaleDateString('default', { day: '2-digit', month: 'short', year: 'numeric' });
                    const formattedSDate = date.toLocaleDateString().split('T')[0];
                    $('.boxdate').text(formattedDate);
                    $('#selected_date').val(formattedSDate);
                    $('#selected-date').text(`Selected Date: ${formattedDate}`);
                    $('#calendar-container').hide();
                    $('#slot-container').show();
                    renderSlots(formattedDate, formattedSDate);
                });
            }

            if (date.toDateString() === new Date().toDateString()) {
                dayElement.addClass('today');
            }
            daysGrid.append(dayElement);
        }
        calendarElement.append(daysGrid);
    }

    function renderSlots(formattedDate, formattedSDate) {
        const slotsElement = $('#slots');
        slotsElement.empty();
        const disableSelection = selectedSlots.length >= totalClasses;
        slots.forEach(slot => {
            const isSelected = selectedSlots.includes(slot.time) && selectedDates.includes(formattedSDate); // Check if slot already selected
            const slotElement = $('<label></label>').addClass(slot.status).toggleClass('already-selected', isSelected); // Optional: Add a class for styling already-selected slots
            const radioButton = $('<input>')
                .attr('type', 'radio')
                .attr('name', 'slot')
                .attr('disabled', slot.status === 'unavailable' || disableSelection || isSelected)
                .change(() => selectSlot(slotElement, slot.time, formattedDate, formattedSDate));
            const label = $('<span></span>').text(slot.time);
            slotElement.append(radioButton, label);
            slotsElement.append(slotElement);
        });
    }

    function selectSlot(slotElement, time, formattedDate, formattedSDate) {
        const isDuplicate = selectedSlots.some((selectedTime, index) =>
            selectedTime === time && selectedDates[index] === formattedSDate
        );
        if (isDuplicate) {
            alert('This slot and date combination is already selected. Please choose a different one.');
            return; // Prevent duplicate selection
        }
        if (selectedSlots.length < totalClasses) {
            selectedSlots.push(time);
            selectedDates.push(formattedSDate);
            $('#slots label').removeClass('selected');
            slotElement.addClass('selected');
            $('#selected_times').val(JSON.stringify(selectedSlots));
            $('#selected_dates').val(JSON.stringify(selectedDates));
            updateBookingDetails(formattedDate, formattedSDate);
            if (currentClass < totalClasses) {
                currentClass++;
                $('#calendar-container').show();
                $('#slot-container').hide();
                $('#confirm-booking').show();
            } else {
                $('#confirm-booking').show();
            }
        }
    }

    function updateBookingDetails(formattedDate, formattedSDate) {
        var user_id = $("#user_id").val();
        var course_id = $("#course_id").val();
        $("#datetimeboxInfo").hide();
        if (selectedSlots.length > 0) {
            $(".bookingDetails").show();
            $("#emptySlotmsg").hide()
        }
        const bookingDetails = $('#booking-details');
        bookingDetails.empty();
        selectedSlots.forEach((slot, index) => {
            const date = new Date(selectedDates[index]);
            const formattedDate = date.toLocaleDateString('default', { day: '2-digit', month: 'short', year: 'numeric' });
            const detail = `<div class="d-flex w-100 bookingBox align-items-center"><div class="iconBook"><i class="fas fa-calendar-check"></i></div><div class="boxInfo w-100"><h3 class="boxdate1">${formattedDate}</h3><h5 class="boxtime">${slot}</h5><h4>Date & Time</h4></div><div class="remove-slot iconBook" style="background: #df001f;"><i class="fas fa-trash remove-slot-btn" data-index="${index}"></i></div></div>`;
            bookingDetails.append(detail);
        });

        bookingDetails.off('click', '.remove-slot-btn');
        bookingDetails.on('click', '.remove-slot-btn', function () {
            const indexToRemove = parseInt($(this).attr('data-index'));
            if (indexToRemove > -1) {
                selectedSlots.splice(indexToRemove, 1);
                selectedDates.splice(indexToRemove, 1);
                $('#calendar-container').show();
                $('#slot-container').hide();
            }

            if (selectedSlots.length === 0) {
                $('#calendar-container').show(); // Show calendar for new selection
                $('#slot-container').hide();
                $(".bookingDetails").hide();
                $('#confirm-booking').hide(); // Hide confirmation button until new slots are selected
                $("#emptySlotmsg").text('All slots have been removed. Please select a new date and time.').css('color', 'red').show();
            }
            updateBookingDetails();
        });
    }

    $('#back-to-calendar').click(function () {
        $('#slot-container').hide();
        $('#calendar-container').show();
    });

    // Set the initial date on load
    const formattedDate = today.toLocaleDateString('default', { day: '2-digit', month: 'short', year: 'numeric' });
    const formattedSDate = today.toISOString().split('T')[0];
    $('#selected_date').val(formattedSDate);
    $('.boxdate').text(formattedDate);
    $('#selected-date').text(`Selected Date: ${formattedDate}`);
    renderCalendar(today.getMonth(), today.getFullYear());
});
</script>
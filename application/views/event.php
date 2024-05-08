<main>
    <section class="signup__area po-rel-z1 pt-100 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center">
                        <h2 class="section__title">Events</h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                            <li class="breadcrumb-item"><a href="<?= base_url()?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Events</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <div class="course__sidebar-search mb-30">
                        <input type="text" placeholder="Search for Events..." id="event_search" name="event_search">
                        <button type="submit">
                            <i class="far fa-search"></i>
                        </button>
                    </div>
                    <div class="card bg-dark shadow-lg rounded-lg mb-3">
                        <div class="card-body">
                            <h4 class="mb-4">Filter By:</h4>
                            <ul>
                                <li>
                                    <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                        <input class="m-check-input" type="checkbox" id="m-admin" name="checkBoxesName" value="1" onclick="SortByuser(this.value)">
                                        <label class="m-check-label text-white" for="m-admin">Admin Created (<?php if($admineventList->count > 0) { echo $admineventList->count;} else { echo '0';} ?>)</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                        <input class="m-check-input" type="checkbox" id="m-ins" name="checkBoxesName" value="2" onclick="SortByuser(this.value)">
                                        <label class="m-check-label text-white" for="m-ins">Instructor Created (<?php if($instruatoreventList->count > 0) { echo $instruatoreventList->count;} else { echo '0';} ?>)</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="filtermore">
                        <div class="card bg-dark shadow-lg rounded-lg mb-3">
                            <div class="card-body">
                                <h4 class="mb-4">Instructor Name:</h4>
                                <ul>
                                    <?php 
                                    $getinstructorData = $this->db->query("SELECT * FROM event WHERE (user_id IS NOT NULL OR user_id != '') AND status = '1' AND is_delete = '1' GROUP BY user_id")->result_array();
                                    if(!empty($getinstructorData)) { 
                                    $i=1;
                                    foreach ($getinstructorData as $insData) {  ?>
                                    <li>
                                        <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                            <input class="m-check-input" type="checkbox" id="ins<?= $i?>" name="checkboxUser" value="<?= $insData['user_id']?>" onclick="SortByEachuser(this.value)">
                                            <label class="m-check-label text-white" for="ins<?= $i?>"> 
                                            <?php if(!empty($insData['user_id'])){
                                                $userdetails = $this->db->query("SELECT * FROM users WHERE id = '".$insData['user_id']."'")->row();
                                                echo $userdetails->fname." ".$userdetails->lname;
                                            } ?>
                                            </label>
                                        </div>
                                    </li>
                                    <?php $i++; } } else { ?>
                                    <p style="font-size: larger; color: #d3e0d4; text-align: center;">No data Found!</p>
                                <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-dark shadow-lg rounded-lg mb-3 change_filtermore">
                        <div class="card-body">
                            <h4 class="mb-4">Course Name:</h4>
                            <ul>
                                <?php 
                                $get_courses = $this->db->query("SELECT * FROM courses WHERE status = '1'")->result_array();
                                if(!empty($get_courses)) { 
                                foreach ($get_courses as $courses) { ?>
                                    <li>
                                        <div class="course__sidebar-check mb-10 d-flex align-items-center">
                                            <input class="m-check-input" type="checkbox" name="checkboxCourse" id="course1" value="<?= $courses['id']?>" onclick="SortByCourses(this.value)">
                                            <label class="m-check-label text-white" for="course1"> <?= $courses['title']?> </label>
                                        </div>
                                    </li>
                                <?php } } else { ?>
                                    <p style="font-size: larger; color: #d3e0d4; text-align: center;">No data Found!</p>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9" id="search_results">
                    <?php if(!empty($eventList)) { 
                    foreach ($eventList as $event) { ?>
                    <div class="card eventlist mb-2 bg-dark shadow-lg rounded-lg">
                        <div class="card-body p-4">
                            <span class="page__title-pre">Posted By: 
                            <?php 
                            if(!empty($event['user_id'])){
                                $userdetails = $this->db->query("SELECT * FROM users WHERE id = '".$event['user_id']."'")->row();
                                echo $userdetails->fname." ".$userdetails->lname;
                            } else {
                                echo "Admin";
                            } ?>
                            </span>
                            <h3><a href="<?= base_url()?>event/<?= $event['event_slug']?>"><?= $event['event_name']?></a></h3>
                            <span class="evntdate"><?= date('d M Y', strtotime($event['event_dt'])); ?></span> <span class="evnttime"><?= date('h:i A', strtotime($event['from_time']))." - ".date('h:i A', strtotime($event['to_time']))?></span>
                            <p>
                            <?php 
                            $string = strip_tags($event['event_desc']);
                            if (strlen($string) > 500) {
                                 $stringCut = substr($string, 0, 250);
                                $endPoint = strrpos($stringCut, ' ');
                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '  ...';
                            }
                            echo $string; ?>
                            </p>
                            <a href="<?= base_url()?>event/<?= $event['event_slug']?>">More info <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <?php } } else { ?>
                        <div class="card eventlist mb-2 bg-dark shadow-lg rounded-lg" style="text-align: center;padding: 40px;">No data found</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>
<style>
.change_filtermore{display: block !important;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#event_search').keyup(function(){
        var keyword = $('#event_search').val();
        $.ajax({
            url: "<?= base_url()?>/Home/search_event",
            cache: false,
            type: "POST",
            data: {keyword : keyword},
            success: function(html){
                //console.log(html)
                $("#search_results").html(html);
            }
        })
    })
})

function SortByuser(s) {
   var id = '';
    $('[name="checkBoxesName"]').each(function(i,e) {
        if ($(e).is(':checked')) {
            var comma = id.length===0?'':',';
            id += (comma+e.value);
        }
    });
    $.ajax({
        type: "POST",
        url: "<?= base_url()?>/Home/search_event",
        data: {keyword : id},
        success: function(html) {
            $("#search_results").html(html);
        }
    });
}

function SortByCourses(s) {
   var id = '';
    $('[name="checkboxCourse"]').each(function(i,e) {
        if ($(e).is(':checked')) {
            var comma = id.length===0?'':',';
            id += (comma+e.value);
        }
    });
    $.ajax({
        type: "POST",
        url: "<?= base_url()?>/Home/search_event",
        data: {course : id},
        success: function(html) {
            $("#search_results").html(html);
        }
    });
}

function SortByEachuser(s) {
   var id = '';
    $('[name="checkboxUser"]').each(function(i,e) {
        if ($(e).is(':checked')) {
            var comma = id.length===0?'':',';
            id += (comma+e.value);
        }
    });
    $.ajax({
        type: "POST",
        url: "<?= base_url()?>/Home/search_event",
        data: {user : id},
        success: function(html) {
            $("#search_results").html(html);
        }
    });
}
</script>

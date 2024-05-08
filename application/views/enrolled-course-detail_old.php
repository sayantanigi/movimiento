<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title"> 
                <?php if (@$courses->title) {
                    echo @$courses->title;
                } else {
                    echo "&#8212;";
                } ?> 
            </h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url('student-dashboard') ?>">Home</a>
                </li>
                <li>
                    <a class="" href="<?= base_url('enrolled-courses') ?>">Course List</a>
                </li>
                <li>
                    <?php if (@$courses->title) {
                        echo @$courses->title;
                    } else {
                        echo "&#8212;";
                    } ?> 
                </li>
            </ul>
        </div>
    </div>
</div>

<section class="intro-section py-5 loaded">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <div class="sidebar shadow-sm">
                    <?php include("usr-menu.php"); ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div>
                    <div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-6">
                                <h3> 
                                    <?php if (@$courses->title) {
                                        echo @$courses->title;
                                    } else {
                                        echo "&#8212;";
                                    } ?> 
                                </h3>
                            </div>
                            <!-- <div class="col-lg-6"> 
                                <div id="svg_wrap"></div>
                            </div> -->
                        </div>

                        <div class="card">
                            <div class="card-body">
                               

                                <section class="mainsteps">

                                  <h4><?=@$courses->heading_1?></h4>
                                  <p><?=@$courses->description?></p>
                                 
                                  <ul class="course-doclist">
                                    <?php
                                        //Get The course Module
                                        $getModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$courses->course_id . "' ORDER BY `position_order` ASC";
                                        $module = $this->db->query($getModuleSql)->result();

                                        $moduleArray = array();

                                        if(!empty($module)) {
                                            foreach ($module as $key => $value) {

                                                $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$courses->course_id . "' AND `module` = '" . @$value->id . "'";
                                                $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();

                                                $getAttemptModuleSql = "SELECT 
                                                        COUNT(*) as attemptModule
                                                    FROM
                                                        `course_enrollment_status`
                                                    where `course_id` = '" . @$courses->course_id . "' and `module` = '".$value->id."' and `enrollment_id` = '".@$courses->enrollment_id."'";
                                                $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();

                                                $totalComModule = 0;

                                                if(@$totalmaterial==@$attemptModuleRow->attemptModule && @$totalmaterial!='0') {
                                                    $totalComModule++;
                                                    $moduleArray[] = $value->id;
                                                }

                                                // echo "<br> Module = ".$value->id." Tot Mat ".$totalmaterial." attempt module = ".@$attemptModuleRow->attemptModule." Completed = ".$totalComModule;
                                    ?>
                                    <li> 
                                        <a href="<?=base_url('users/courseMaterial/'.@$courses->enrollment_id."/".@$value->id)?>">
                                           <div class="d-flex justify-content-between align-items-center">
                                                <div class="flex-fill">
                                                    <?php echo @$value->name; ?>
                                                </div>
                                                <?php if (in_array(@$value->id, $moduleArray)) { ?>
                                                    <span class="downloadModule mr-3 bg-success"><i class="fa fa-check"></i></span>
                                                <?php } ?>
                                                
                                                <span class="downloadModule"><i class="fa fa-arrow-right"></i></span>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    <?php } } ?>
                                  </ul>
                                </section>

                                
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
$nl = $this->uri->segment(2);
$nl2 = $this->uri->segment(3);
$checkSudscriptionData = $this->db->query("SELECT * FROM user_subscription WHERE employer_id = '".$_SESSION['user_id']."' AND status = '1'")->row();
?>
<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 40px">
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler"> </div>
        </li>
        <li class="sidebar-search-wrapper"> </li>

        <li class="nav-item start ">
            <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/home");} else {echo "javascript:void(0)";} ?>" class="nav-link <?php if ($nl == "") { ?>active open<?php } ?>">  <i class="fa fa-th-list"></i><span class="title">Dashboard</span> </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/home");} else {echo "javascript:void(0)";} ?>" class="nav-link "> <i class="icon-list"></i> <span class="title">View Dashboard</span> </a>
                </li>
            </ul>
        </li>

        <li class="nav-item <?php if ($nl == "category" || $nl2 == "show_category" || $nl == "course" || $nl == "batch" || $nl == "lesson") { ?>active open<?php } ?>">
            <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-th-list"></i>
                <span class="title">Course</span>
                <span class="addindividual"></span>
                <span class="arrow addindividual"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "category") { ?>active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/category");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                    <span class="title">Add Category</span> </a>
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_category") { ?>active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/category/show_category");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                        <span class="title">Category Lists</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($nl2 == "course") { ?> active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/course/add_course");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                        <span class="title">Add Course</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($nl == "show_course") { ?>active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/course/show_all_courses");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                        <span class="title">All Courses </span>
                    </a>
                </li>
                <li class="nav-item <?php if ($nl2 == "course") { ?>active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/course/purchased_course");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                        <span class="title">Purchased Course List</span>
                    </a>
                </li>
                <!-- <li class="nav-item <?php if ($nl == "show_course") { ?>active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/course/upcomming_course");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                        <span class="title">Upcoming Courses </span>
                    </a>
                </li>
                <li class="nav-item <?php if ($nl == "show_course") { ?>active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/course/comingsoon_course");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                    <span class="title">Coming Soon courses </span>
                    </a>
                </li> -->
            </ul>
        </li>

        <li class="nav-item <?php if ($nl2 == "add_comm_cat" || $nl2 == "comm_cat" || $nl2 == "add_comm" || $nl2 == "comm") { ?>active open<?php } ?>">
            <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-th-list"></i>
                <span class="title">Community</span>
                <span class="addindividual"></span>
                <span class="arrow addindividual"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl == "add_comm") { ?> active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/community/add_community");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                        <span class="title">Add Community</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($nl == "comm") { ?>active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) { echo base_url("supercontrol/community");} else {echo "javascript:void(0)";} ?>" class="nav-link ">
                        <span class="title">Comminity List </span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item <?php if ($nl2 == "add_comm_cat" || $nl2 == "comm_cat" || $nl2 == "add_comm" || $nl2 == "comm") { ?>active open<?php } ?>">
            <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-th-list"></i>
                <span class="title">Subscription</span>
                <span class="addindividual"></span>
                <span class="arrow addindividual"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl == "comm") { ?>active open<?php } ?>">
                    <a href="<?php if(!empty($checkSudscriptionData)) {echo "javascript:void(0)"; } else { echo base_url("supercontrol/subscription");} ?>" class="nav-link ">
                        <span class="title">Subscription List </span>
                    </a>
                </li>
                <li class="nav-item <?php if ($nl == "add_comm") { ?> active open<?php } ?>">
                    <a href="<?php echo base_url(); ?>supercontrol/subscription/purchased_subscription" class="nav-link ">
                        <span class="title">Purchased Subscription list</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="<?php echo base_url(); ?>logout" class="nav-link ">
                <i class="icon-logout"></i>
                <span class="title">Logout</span>
            </a>
        </li>
    </ul>
</div>
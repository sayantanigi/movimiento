<?php
$nl = $this->uri->segment(2);
$nl2 = $this->uri->segment(3);
?>
<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
        <li class="sidebar-toggler-wrapper hide">
            <div class="sidebar-toggler"> </div>
        </li>
        <li class="sidebar-search-wrapper"> </li>
        <li class="nav-item start "> 
            <a href="<?php echo base_url() ?>supercontrol/home" class="nav-link "> <span class="title">Dashboard</span> </a>
            <ul class="sub-menu">
                <li class="nav-item start "> 
                    <a href="<?php echo base_url() ?>supercontrol/home" class="nav-link "> <i class="icon-list"></i> <span class="title">View Dashboard</span> </a> 
                </li>
            </ul>
        </li>
        <li class="heading">
            <h3 class="uppercase">Features</h3>
        </li>
        <!--li class="nav-item <?php if ($nl == "cms") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-pagelines"></i> 
                <span class="title">Content Management</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "cms" && $nl2 != "view_addcms") { ?>active open<?php } ?>"> <a href="<?php echo base_url() ?>supercontrol/cms/show_cms" class="nav-link "> <span class="title">Static Pages</span> </a> </li>
                <li class="nav-item  <?php if ($nl2 == "cms" && $nl2 != "view_addcms") { ?>active open<?php } ?>"> <a href="<?php echo base_url() ?>supercontrol/cms/crop_cms" class="nav-link "> <span class="title">Corporate/Student  </span> </a> </li>
                <li class="nav-item  <?php if ($nl2 == "Content" && $nl2 != "view_addcms") { ?>active open<?php } ?>"> <a href="<?php echo base_url() ?>supercontrol/Content/show_cms" class="nav-link "> <span class="title">Other Pages</span> </a> </li>
                <li class="nav-item  <?php if ($nl2 == "Contactdetails") { ?>active open<?php } ?>"> <a href="<?php echo base_url() ?>supercontrol/contactdetails/show_contactdetails/" class="nav-link "> <span class="title">Contact Details Page</span> </a> </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "banner") { ?> active open <?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-picture-o"></i> 
                <span class="title">Banner Management</span> 
                <span class="arrow"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "Add Banner") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/banner/addbanner" class="nav-link "> 
                        <span class="title">Add Banner</span> 
                    </a>
                </li>
                <li class="nav-item <?php if ($nl2 == "Show Banner") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/banner/showbanner" class="nav-link "> 
                        <span class="title">Show Banner</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "member") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-users"></i> 
                <span class="title">Member Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "student_list") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/member/student_list" class="nav-link ">
                        <span class="title">Student List</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl == "instructor_list") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/member/instructor_list" class="nav-link "> 
                        <span class="title">Instructor List</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl == "business_list") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/member/business_list" class="nav-link "> 
                        <span class="title">Businesses List</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl == "business_list") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/member/bus_std_list" class="nav-link "> 
                        <span class="title">Business wise Student List</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "mode") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-certificate"></i> 
                <span class="title">Mode Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl == "show_mode") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/mode/show_mode" class="nav-link "> 
                        <span class="title">Manage Mode</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "category") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-keyboard-o"></i> 
                <span class="title">Category Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "category") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/category" class="nav-link "> 
                        <span class="title">Add Category</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_category") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/category/show_category" class="nav-link "> 
                        <span class="title">Manage Category</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "batch" || $nl == "location" || $nl == "lesson") { ?>active open<?php } ?>">
            <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-sitemap"></i> 
                <span class="title">Course Batch  Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "batch") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/batch/add_batch" class="nav-link "> 
                        <span class="title">Add Batch</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl == "show_batch") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/batch/show_batch" class="nav-link "> 
                        <span class="title">Manage Batches</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "course") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/batch/add_instructor" class="nav-link "> 
                        <span class="title">Add Instructor for Batches</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl == "show_course") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/batch/show_instructor" class="nav-link "> 
                        <span class="title">Manage Instructor for Batches</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "paid") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-money"></i> 
                <span class="title">Course Booking Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl == "show_list") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/paid/show_list" class="nav-link "> 
                        <span class="title">Book List</span> 
                    </a>
                </li>
            </ul>
        </li>-->
        <!--<li class="nav-item <?php if ($nl == "coursequery") { ?>active open<?php } ?>"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-info-circle"></i> <span class="title">Course Query Mgmt</span> <span class="addindividual"></span> <span class="arrow addindividual"></span> </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl == "show_coursequery") { ?>active open<?php } ?>"> <a href="<?php echo base_url(); ?>supercontrol/coursequery/show_coursequery" class="nav-link "> <span class="title">Manage Course Query</span> </a> </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "schedule_list") { ?>active open<?php } ?>"> <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-calendar-check-o"></i> <span class="title">Inst Schedule Mgmt</span> <span class="addindividual"></span> <span class="arrow addindividual"></span> </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "schedule_list") { ?>active open<?php } ?>"> <a href="<?php echo base_url(); ?>supercontrol/member/instructor_schedule" class="nav-link "> <span class="title">Schedule List </span> </a> </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "discount") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="icon-docs"></i> 
                <span class="title">Discount Mgmt</span> <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl == "show_discount") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/discount/show_discount" class="nav-link "> 
                        <span class="title">Show Discount</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "add_discount_view") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/discount/add_discount_view" class="nav-link "> 
                        <span class="title">Add Discount</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item  <?php if ($nl == "timeline" || $nl == "partners") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-home"></i> 
                <span class="title">About Us Mgmt</span> 
                <span class="arrow"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "addtimeline") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/timeline/addtimeline" class="nav-link ">
                        <span class="title">Add Timeline</span> 
                    </a> 
                </li>
                <li class="nav-item <?php if ($nl2 == "showtimeline") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/timeline/showtimeline" class="nav-link "> 
                        <span class="title">Show Timeline</span> 
                    </a> 
                </li>
                <li class="nav-item <?php if ($nl2 == "addpartners") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/partners/addpartners" class="nav-link "> 
                        <span class="title">Add Partners</span> 
                    </a> 
                </li>
                <li class="nav-item <?php if ($nl2 == "showpartners") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/partners/showpartners" class="nav-link "> 
                        <span class="title">Show Partners</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "faq") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-question-circle"></i> 
                <span class="title">FAQ Managements</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "faq_add_form") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/faq/faq_add_form" class="nav-link "> 
                        <span class="title">Add FAQ</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_faq") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/faq/show_faq" class="nav-link "> 
                        <span class="title">Manage FAQ</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "testimonial") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-rss"></i> 
                <span class="title">Testimonial Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "testmonial_add_form") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/testimonial/testmonial_add_form" class="nav-link "> 
                        <span class="title">Add Testimonial</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_testimonial") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/testimonial/show_testimonial" class="nav-link "> 
                        <span class="title">Manage Testimonial</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "contact") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-envelope-square"></i> 
                <span class="title">Contact Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl == "show_contact") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/contact/show_contact" class="nav-link "> 
                        <span class="title">Manage Contact</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "announcement") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-bullhorn"></i> 
                <span class="title">Announcement Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "addannouncementview") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/announcement/addannouncementview" class="nav-link "> 
                        <span class="title">Add Announcement</span>
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl == "showannouncement") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/announcement/showannouncement" class="nav-link "> 
                        <span class="title">Show Announcement</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "newsletter") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-check-square"></i> 
                <span class="title">News Letter Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl == "show_newsletter") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/newsletter/show_newsletter" class="nav-link "> 
                    <span class="title">Manage News Letter</span> </a> </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "adminprofile" || $nl == "settings" || $nl == "user") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-cogs"></i> 
                <span class="title">Tools</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "show_adminprofile_id") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/adminprofile/show_adminprofile_id/1" class="nav-link "> 
                        <span class="title">Admin profile</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_settings_id") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/settings/show_settings_id/1" class="nav-link "> 
                        <span class="title">Settings</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_reset_pass") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/user/show_reset_pass/1" class="nav-link "> 
                        <span class="title">Change Password</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "logout") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url() ?>supercontrol/main/logout" class="nav-link "> 
                        <span class="title">Log out</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "country") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-keyboard-o"></i> 
                <span class="title">Country Mgmt</span>
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "country") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/country" class="nav-link "> 
                    <span class="title">Add country</span> </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_country") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/country/show_country" class="nav-link "> 
                    <span class="title">Manage country</span> </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "city") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-keyboard-o"></i> 
                <span class="title">City Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "city") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/city" class="nav-link "> 
                        <span class="title">Add  City</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_city") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/city/show_city" class="nav-link "> 
                        <span class="title">Manage City</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "location") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-question-circle"></i> 
                <span class="title">Location Managements</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "location_add_form") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/location/location_add_form" class="nav-link "> 
                        <span class="title">Add Location</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_location") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/location/show_location" class="nav-link "> 
                        <span class="title">Manage Location</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "country") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-keyboard-o"></i> 
                <span class="title">Data Managements</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "country") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/country" class="nav-link "> 
                        <span class="title">Country Managements</span> 
                    </a> 
                </li>
                <li class="nav-item <?php if ($nl2 == "country") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/country/show_country" class="nav-link "> 
                        <span class="title">Country Managements</span> 
                    </a> 
                </li>
                <li class="nav-item <?php if ($nl2 == "city") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/category/show_category" class="nav-link "> 
                        <span class="title">City Managements</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "team") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-keyboard-o"></i> 
                <span class="title">Team Management</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "team") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/team/" class="nav-link "> 
                        <span class="title">Add Team</span> 
                    </a> 
                </li>
                <li class="nav-item <?php if ($nl2 == "showteam") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/team/showteam" class="nav-link "> 
                        <span class="title">Manage Team</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "blog") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-keyboard-o"></i> 
                <span class="title">Blog Management</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "blog") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/blog/" class="nav-link "> 
                        <span class="title">Add Blog</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_blog") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/blog/show_blog" class="nav-link "> 
                        <span class="title">Manage Blog</span>
                    </a>
                </li>
            </ul>
        </l>
        <li class="nav-item <?php if ($nl == "book") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-certificate"></i> 
                <span class="title">Booking Management</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl == "show_level") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/level/show_level" class="nav-link "> 
                        <span class="title">Booking List</span> 
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "student") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-certificate"></i> 
                <span class="title">Student Management</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl == "show_level") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/level/show_level" class="nav-link "> 
                    <span class="title">Student List</span> </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "instructor") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-certificate"></i> 
                <span class="title">Instructor Management</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl == "show_level") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/course/show_instructor" class="nav-link "> 
                        <span class="title">Instructor List</span> 
                    </a> 
                </li>
            </ul>
        </li> -->
        <li class="nav-item <?php if ($nl == "mode") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-certificate"></i> 
                <span class="title">Mode Mgmt</span>
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "add_mode") { ?> active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/mode/add_mode" class="nav-link "> 
                        <span class="title">Add Mode</span>
                    </a>
                </li>
                <li class="nav-item  <?php if ($nl == "show_mode") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/mode/show_mode" class="nav-link "> 
                        <span class="title">Manage Mode</span> 
                    </a> 
                </li>
            </ul>
        </li>

        <li class="nav-item <?php if ($nl == "level") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-certificate"></i> 
                <span class="title">Level Mgmt</span>
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "add_level") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/level/add_level" class="nav-link "> 
                    <span class="title">Add Level</span> </a> 
                </li>
                <li class="nav-item <?php if ($nl == "show_level") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/level/show_level" class="nav-link "> 
                        <span class="title">Manage Level</span> 
                    </a> 
                </li>
            </ul>
        </li>

        <li class="nav-item <?php if ($nl == "category") { ?>active open<?php } ?>">
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-keyboard-o"></i> 
                <span class="title">Category Mgmt</span>
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "category") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/category" class="nav-link "> 
                    <span class="title">Add Category</span> </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_category") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/category/show_category" class="nav-link "> 
                        <span class="title">Manage Category</span> 
                    </a> 
                </li>
            </ul>
        </li>

        <li class="nav-item <?php if ($nl == "course" || $nl == "batch" || $nl == "lesson") { ?>active open<?php } ?>">
            <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa fa-th-list"></i> 
                <span class="title">Course Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "course") { ?> active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/course/add_course" class="nav-link "> 
                        <span class="title">Add Course</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($nl == "show_course") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/course/show_all_courses" class="nav-link ">
                        <span class="title">All Courses </span> 
                    </a>
                </li>
                <li class="nav-item <?php if ($nl == "show_course") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/course/upcomming_course" class="nav-link ">
                        <span class="title">Upcoming Courses </span> 
                    </a>
                </li>
                <li class="nav-item <?php if ($nl == "show_course") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/course/comingsoon_course" class="nav-link ">
                    <span class="title">Coming Soon courses </span>
                    </a> 
                </li>
                <!--<li class="nav-item <?php if ($nl2 == "batch") { ?>active open<?php } ?>">
                        <a href="<?php echo base_url(); ?>supercontrol/batch/add_batch" class="nav-link ">
                        <span class="title">Add Course Time Table</span>
                    </a>
                </li>-->
            </ul>
        </li>

        <li class="nav-item <?php if ($nl == "event") { ?>active open<?php } ?>">
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-keyboard-o"></i> 
                <span class="title">Event Mgmt</span>
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "addeventview") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/event/addeventview" class="nav-link "> 
                    <span class="title">Add Event</span> </a> 
                </li>
                <li class="nav-item  <?php if ($nl2 == "show_event") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/event/showevent" class="nav-link "> 
                        <span class="title">Manage Event</span> 
                    </a> 
                </li>
            </ul>
        </li>

        <li class="nav-item <?php if ($nl == "news") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-newspaper-o"></i> 
                <span class="title">Blog Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item  <?php if ($nl2 == "news_add_form") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/news/news_add_form" class="nav-link "> 
                        <span class="title">Add Blog</span> 
                    </a> 
                </li>
                <li class="nav-item  <?php if ($nl == "show_news") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/news/show_news" class="nav-link "> 
                        <span class="title">Blog list</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "conference") { ?>active open<?php } ?>"> 
            <a href="javascript:;" class="nav-link nav-toggle"> 
                <i class="fa fa-newspaper-o"></i> 
                <span class="title">Conference Mgmt</span> 
                <span class="addindividual"></span> 
                <span class="arrow addindividual"></span> 
            </a>
            <ul class="sub-menu">
                <li class="nav-item <?php if ($nl2 == "conference_add_form") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/conference/conference_add_form" class="nav-link "> 
                        <span class="title">Add Conference</span> 
                    </a> 
                </li>
                <li class="nav-item <?php if ($nl == "show_conference") { ?>active open<?php } ?>"> 
                    <a href="<?php echo base_url(); ?>supercontrol/conference/show_conference" class="nav-link "> 
                        <span class="title">Conference list</span> 
                    </a> 
                </li>
            </ul>
        </li>
        <li class="nav-item <?php if ($nl == "") { ?>active open<?php } ?>"> 
            <a href="<?php echo base_url(); ?>logout" class="nav-link ">
                <i class="icon-logout"></i>
                <span class="title">Logout</span>
            </a>
        </li>
    </ul>
</div>
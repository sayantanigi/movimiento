<main>
    <section class="signup__area po-rel-z1 pt-50 pb-50 mt-100 bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center pb-20 mb-30">
                        <h2 class="section__title"><?= $conference_details->title; ?></h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="<?php base_url()?>conference"><i class="fas fa-flag me-3"></i> Conference proceedings - Institute</a></li>
                                <li class="breadcrumb-item"><a href="<?php base_url()?>conference"><i class="fas fa-arrow-left me-3"></i> Retour aux publications</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-white">
                    <div class="mb-30">
                        <?php if(!empty($conference_details->image)) { ?>
                        <img src="<?= base_url()?>uploads/conference/<?= $conference_details->image; ?>" class="img-fluid" style="height: 400px;">
                        <?php } ?>
                        <div style="margin: 25px 0 0 0;"><?= $conference_details->description; ?></div>
                        <?php if(!empty($conference_details->description)) { ?>
                        <a href="<?= base_url()?>uploads/conference/<?= $conference_details->attachment?>" target="_blank" class="text-uppercase e-btn">Read the Report</a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog__sidebar pl-40">
                        <div class="sidebar__widget mb-60">
                            <div class="sidebar__widget-content">
                                <div class="sidebar__search p-relative mb-20">
                                    <form method="post" action="<?php echo base_url()?>search-query">
                                        <input type="text" id="search_input" name="search_input" placeholder="Search for courses...">
                                        <button type="submit">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 584.4 584.4"
                                                style="enable-background:new 0 0 584.4 584.4;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path class="st0"
                                                            d="M565.7,474.9l-61.1-61.1c-3.8-3.8-8.8-5.9-13.9-5.9c-6.3,0-12.1,3-15.9,8.3c-16.3,22.4-36,42.1-58.4,58.4    c-4.8,3.5-7.8,8.8-8.3,14.5c-0.4,5.6,1.7,11.3,5.8,15.4l61.1,61.1c12.1,12.1,28.2,18.8,45.4,18.8c17.1,0,33.3-6.7,45.4-18.8    C590.7,540.6,590.7,499.9,565.7,474.9z" />
                                                        <path class="st1"
                                                            d="M254.6,509.1c140.4,0,254.5-114.2,254.5-254.5C509.1,114.2,394.9,0,254.6,0C114.2,0,0,114.2,0,254.5    C0,394.9,114.2,509.1,254.6,509.1z M254.6,76.4c98.2,0,178.1,79.9,178.1,178.1s-79.9,178.1-178.1,178.1S76.4,352.8,76.4,254.5    S156.3,76.4,254.6,76.4z" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="sidebar__widget mb-20 bg-white rounded p-4">
                                    <div class="sidebar__widget-head mb-25">
                                        <h3 class="sidebar__widget-title text-danger">CATEGORIES</h3>
                                    </div>
                                    <div class="sidebar__widget-content">
                                        <div class="sidebar__category">
                                            <ul>
                                                <li><a href="<?= base_url()?>category/foundation">Foundation</a></li>
                                                <li><a href="<?= base_url()?>category/institute">Institute</a></li>
                                                <li><a href="<?= base_url()?>category/network">Network</a></li>
                                                <li><a href="<?= base_url()?>category/webiner">Webinar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar__widget mb-20 bg-white rounded p-4">
                                    <div class="sidebar__widget-head mb-25">
                                        <h3 class="sidebar__widget-title text-danger">INSTITUTE</h3>
                                    </div>
                                    <div class="sidebar__widget-content">
                                        <div class="sidebar__category">
                                            <ul>
                                                <li><a href="<?= base_url()?>conferences">Conference proceedings</a></li>
                                                <li><a href="<?= base_url()?>work_documents">Work documents</a></li>
                                                <li><a href="<?= base_url()?>raba_arbi">RABA/ARBI</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar__widget mb-20 bg-white rounded p-4">
                                    <div class="sidebar__widget-head mb-25">
                                        <h3 class="sidebar__widget-title text-danger">RECENT NEWS​</h3>
                                    </div>
                                    <div class="sidebar__widget-content">
                                        <div class="sidebar__category">
                                            <?php
                                            $recentNews = $this->db->query("SELECT * FROM conference WHERE id != '".$conference_details->id."' AND status = '1'")->result_array();
                                            if(!empty($recentNews)) {
                                            foreach ($recentNews as $value) { ?>
                                            <div class="rc__post ">
                                                <div class="d-flex align-items-top mb-2">
                                                    <div class="rc__thumb mr-20">
                                                        <a href="#"><img src="<?= base_url()?>uploads/conference/<?= $value['image']?>" alt=""></a>
                                                    </div>
                                                    <div class="rc__content">
                                                        <h6 class="rc__title">
                                                            <a href="<?= base_url()?>conference/<?= $value['slug']?>"><?= $value['title']?></a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
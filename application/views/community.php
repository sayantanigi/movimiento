<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
    data-background="<?= base_url() ?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Community</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Community</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-100 pb-145">
    <div class="container">
        <?php if (!empty($community)) { ?>
            <!-- <ul class="listComCategory">
                <li>
                    <a href="#" class="active">All</a>
                </li>
                <?php if (!empty($community_cat)) {
                    foreach ($community_cat as $cat_value) { ?>
                        <li>
                            <a href="#"><?= $cat_value['category_name'] ?></a>
                        </li>
                    <?php }
                } ?>
            </ul> -->
            <div class="row">
                <div class="col-lg-12">
                    <?php foreach ($community as $community_val) {
                        $string = strip_tags($community_val['description']);
                        if (strlen($string) > 400) {
                            $stringCut = substr($string, 0, 400);
                            $endPoint = strrpos($stringCut, ' ');
                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '    ....';
                        }
                        ?>
                        <div class="communityList d-flex shadow p-3 mb-4">
                            <?php
                            if (!empty($community_val['uploaded_by'])) {
                                $userdetails = $this->db->query("SELECT * FROM users WHERE id = '" . $community_val['uploaded_by'] . "'")->row();
                                $name = $userdetails->full_name;
                            } else {
                                $name = "Admin";
                            }
                            ?>
                            <div class="userIcon-com me-3">
                                <a href="javascript:void(0)">
                                    <?php if (!empty($userdetails->image)) { ?>
                                        <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userdetails->image ?>" />
                                    <?php } else { ?>
                                        <img src="<?= base_url() ?>images/no-user.png" />
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="userComInfo">
                                <h6 class="fw-semibold mb-0"><a href="javascript:void(0)"><?= $name ?></a></h6>
                                <span class="post-meta mb-2 d-block text-secondary">
                                    <small><?= date('M j, Y', strtotime($community_val['created_at'])) ?></small></span>
                                <h2 class="h4 fw-bold communitytitle"><a
                                        href="<?= base_url() ?>community/<?= $community_val['slug'] ?>"><?= $community_val['title'] ?></a>
                                </h2>
                                <p><?= $string ?></p>
                                <p><a href="<?= base_url() ?>community/<?= $community_val['slug'] ?>" class="btn-community">View
                                        Details <i class="fas fa-arrow-right"></i></a></p>
                                <ul class="d-flex align-items-center mt-3">
                                    <?php $countchechis_like = $this->db->query("SELECT COUNT(id) as count FROM community_like WHERE community_id = '".$community_val['id']."' AND is_liked = 1")->row();?>
                                    <li class="me-4"><a href="javascript:void(0)"><i class="fas fa-thumbs-up text-secondary"></i> <sup style="top: -2px;"><?= $countchechis_like->count;?></sup></a></li>
                                    <?php $commentCount = $this->db->query("SELECT count(id) as count FROM community_comment WHERE community_id = '".$community_val['id']."'")->row(); ?>
                                    <li><a href="javascript:void(0)"><i class="fas fa-comment text-secondary"></i> <sup style="top: -2px;"><?= $commentCount->count;?> </sup></a></li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <div> No community added yet</div>
        <?php } ?>
    </div>
</section>
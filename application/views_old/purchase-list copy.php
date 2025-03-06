<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">Purchase History</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url('student-dashboard') ?>">Home</a>
                </li>
                <li>Purchase History</li>
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
                        <div class="d-flex justify-content-between">
                            <h3>Purchase History</h3>
                        </div>

                        <div class="dashboard-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="id">ID</th>
                                        <th class="courses">Courses</th>
                                        <th class="amount">Amount</th>
                                        <th class="status">Status</th>
                                        <th class="date">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(!empty($orders)) {
                                            foreach ($orders as $key => $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="dashboard-table__mobile-heading">ID</div>
                                            <div class="dashboard-table__text">#<?php echo @$value->order_id; ?></div>
                                        </td>
                                        <td class="course-info">
                                            <div class="dashboard-table__mobile-heading">Courses</div>
                                            <div class="dashboard-table__text">
                                                <p><?php echo @$value->title; ?></p>
                                            </div>
                                        </td>
                                        <td class="correct">
                                            <div class="dashboard-table__mobile-heading">Amount</div>
                                            <div class="dashboard-table__text">
                                                <span class="sale-price">
                                                <?php if(@$value->enrollment_price == '0') {
                                                    echo "Free";
                                                } else {
                                                    echo '$'.number_format(@$value->enrollment_price,2);
                                                }
                                                ?></span>
                                            </div>
                                        </td>
                                        <td class="incorrect">
                                            <div class="dashboard-table__mobile-heading">Status</div>
                                            <div class="dashboard-table__text"><?php echo ucWords(strtolower(@$value->payment_status)); ?></div>
                                        </td>
                                        <td class="earned">
                                            <div class="dashboard-table__mobile-heading">Date</div>
                                            <div class="dashboard-table__text"><?php echo date("jS F Y, H:i", strtotime(@$value->enrollment_date)); ?></div>
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                        <tr>
                                            <td colspan="5" align="center">
                                                <div class="dashboard-table__text text-danger">No record available!</div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-5 border-top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow paymentbox">
                    <div class="card-body">
                        <h3 class="text-center">Enrollment Status</h3>
                        <h4 class="h5 font-weight-bold">
                        <?php
                            if ($this->session->flashdata('success')) {
                        ?>
                            <?php echo $this->session->flashdata('success'); ?>
                        <?php }
                            if ($this->session->flashdata('error')) {
                        ?>
                            <?php echo $this->session->flashdata('error'); ?>
                        <?php } ?>
                        </h4>
                        <a href="<?php echo base_url('student-dashboard'); ?>">Go to dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-sm-12">
        <?php
        if ($this->session->flashdata('success')) {
        ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php $this->session->unset_userdata('success');
         }
        ?>
        <?php
        if ($this->session->flashdata('info')) {
        ?>
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('info'); ?>
            </div>
        <?php $this->session->unset_userdata('info');
        }
        ?>
        <?php
        if ($this->session->flashdata('error')) {
        ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php $this->session->unset_userdata('error');
        }
        ?>
        <?php
        if ($this->session->flashdata('warning')) {
        ?>
            <div class="alert alert-warning alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $this->session->flashdata('warning'); ?>
            </div>
        <?php $this->session->unset_userdata('warning');
        }
        ?>
        <?php
        $err = validation_errors();
        if ($err) {
        ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $err; ?>
            </div>
        <?php
        }
        ?>
    </div>
</div>
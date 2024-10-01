<!-- Main content -->
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
            <?= $title ?>
        </li>
    </ol>
</section>
<?php
$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);
$comm_id = $url[4];
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $title ?></h3>
                </div>
                <form action="<?= admin_url('community/add_event/'.@$comm_id.'/'.@$event->id) ?>" method="post" enctype="multipart/form-data">

                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event Title</label>
                                            <input type="text" name="frm[event_title]" value="<?= @$event->event_title ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Event Title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event From Date</label>
                                            <input type="date" name="frm[event_from_date]" value="<?= @$event->event_from_date ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter From Date" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event From Time</label>
                                            <input type="time" name="frm[event_from_time]" value="<?= @$event->event_from_time ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter From Time" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event To Date</label>
                                            <input type="date" name="frm[event_to_date]" value="<?= @$event->event_to_date ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter To Date" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event To Time</label>
                                            <input type="time" name="frm[event_to_time]" value="<?= @$event->event_to_time ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter To Date" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event Repeat</label>
                                            <select name="frm[event_repeat]" class="form-control" required>
                                                <option value="">Select option</option>
                                                <option value="Does not repeat" <?php if (@$event->event_repeat == 'Does not repeat') { echo 'selected';} ?>>Does not repeat</option>
                                                <option value="Daily" <?php if (@$event->event_repeat == 'Daily') { echo 'selected';} ?>>Daily</option>
                                                <option value="Weekly" <?php if (@$event->event_repeat == 'Weekly') { echo 'selected';} ?>>Weekly</option>
                                                <option value="Monthly" <?php if (@$event->event_repeat == 'Monthly') { echo 'selected';} ?>>Monthly</option>
                                                <option value="Yearly" <?php if (@$event->event_repeat == 'Yearly') { echo 'selected';} ?>>Yearly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event Description</label>
                                            <textarea name="frm[event_description]" value="<?= @$event->event_description ?>" id="editor1"><?= @$event->event_description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Event Status</label>
                                            <select name="frm[event_status]" class="form-control" required>
                                                <option value="">Select option</option>
                                                <option value="1" <?php if (@$event->event_status == 1) { echo 'selected';} ?>>Active</option>
                                                <option value="2" <?php if (@$event->event_status == 2) { echo 'selected';} ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="box-footer" style="border-top: none;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <input type="hidden" name="frm[community_id]" value="<?= $comm_id?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<style>
    .weekly_event{display: none;}
    .recurring_val{display: none;}
</style>
<script>
    $(document).ready(function(){
        $('#event_repeat').change(function() {
            if($(this).val() == '3') {
                $('.weekly_event').show();
            } else {
                $('.onetime_val').hide();
                $('.recurring_val').show();
            }

        })
    })
</script>
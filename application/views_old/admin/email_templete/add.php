<!-- Main content -->
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?php echo @$title; ?>
                    </h3>
                </div>
                <?php
                if (@$email_templete->id) {
                    $formPath = admin_url('email_templete/email_templeteUpdate/' . @$email_templete->id);
                } else {
                    $formPath = admin_url('email_templete/add/' . @$email_templete->id);
                }
                //echo "<pre>"; print_r($email_templete); die();
                ?>
                <form action="<?php echo @$formPath; ?>" method="post" enctype="multipart/form-data"
                    id="form_validation">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Template Name<span class="red">*</span></label>
                                        <input type="text" name="name" value="<?= @$email_templete->name ?>" class="form-control" id="name" placeholder="Enter Template Name">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="subject">Subject<span class="red">*</span></label>
                                        <input type="text" name="subject" value="<?= @$email_templete->subject ?>" class="form-control" id="subject" placeholder="Enter Subject">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="content">Template Body<span class="red">*</span></label>
                                        <textarea name="content" class="form-control" id="content" placeholder="Enter Event Description"><?= @$email_templete->content ?></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Choose option</option>
                                            <option value="1" <?= (@$email_templete->status == 1) ? 'selected' : ''; ?>>Active </option>
                                            <option value="2" <?= (@$email_templete->status == 2) ? 'selected' : ''; ?>>Inactive </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" style="margin-left:30px;">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= admin_url('email_templete') ?>" class="btn btn-warning" title="Back">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
.eventTypeForm {display: none;}
.checkforLink {display: none;}
.checkforUpload {display: none;}
</style>
<script>
CKEDITOR.replace('content', {
    filebrowserUploadUrl: "<?php echo base_url()?>admin/email_templete/ck_upload",
    filebrowserUploadMethod: "form",
    removePlugins: 'easyimage',
});
$(function() {
    $("#datepicker").datepicker();
    $('#event_type').change(function() {
        var type = $(this).val();
        if(type == 'paid'){
            $('.eventTypeForm').show();
            $('#event_price').attr('required', true);
            $('#price_key').attr('required', true);
        } else if(type == 'free') {
            $('.eventTypeForm').hide();
            $('#event_price').attr('required', false);
            $('#event_price').val('0');
            $('#price_key').attr('required', false);
            $('#price_key').val('');
        } else {
            $('.eventTypeForm').hide();
            $('#event_price').attr('required', false);
            $('#event_price').val('');
            $('#price_key').attr('required', false);
            $('#price_key').val('');
        }
    })

    $('#event_mode').change(function() {
        var type = $(this).val();
        if(type == 'online') {
            $('.checkforLink').show();
            $('#event_link').attr('required', true);
        } else if(type == 'offline') {
            $('.checkforLink').hide();
            $('#event_link').attr('required', false);
        } else {
            $('.checkforLink').hide();
            $('#event_link').attr('required', false);
        }
    })
});
</script>
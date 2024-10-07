<!-- Main content -->
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= admin_url('subscription') ?>"> Subscription List</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <!-- <h3 class="box-title">Add Service</h3> -->
                </div>
                <?php if(@$subscription->id) {
                    $url = admin_url('subscription/subscribeUpdate/'.@$subscription->id);
                } else {
                    $url = admin_url('subscription/add');
                }
                ?>
                <form action="<?=  $url; ?>" id="form_validation" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Subscription Name <span style="color: red">*</span></label>
                                            <input type="text" name="subscription_name" value="<?= @$subscription->subscription_name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Subscription Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Subscription Plan for Specific User Type <span style="color: red">*</span></label>
                                            <select class="form-control" name="subscription_user_type" id="subscription_user_type" required>
                                                <option value="">Choose</option>
                                                <!-- <option value="free" <?php if (@$subscription->subscription_user_type == '1') { echo "selected"; } ?>>Student</option> -->
                                                <option value="2" <?php if (@$subscription->subscription_user_type == '2') { echo "selected"; } ?>>Instructor</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Subscription Type <span style="color: red">*</span></label>
                                            <select class="form-control" name="subscription_type" id="subscription_type" required>
                                                <option value="">Choose</option>
                                                <option value="free" <?php if (@$subscription->subscription_type == 'free') { echo "selected"; } ?>>Free</option>
                                                <option value="paid" <?php if (@$subscription->subscription_type == 'paid') { echo "selected"; } ?>>Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="courseTypefield">
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Subscription Amount(In $) <span style="color: red">*</span></label>
                                                <input type="text" name="subscription_amount" value="<?= @@$subscription->subscription_amount ?>" class="form-control subscription_amount" id="exampleInputEmail1" placeholder="Ex: 100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Price ID (Stripe Price ID) <span style="color: red">*</span></label>
                                                <input type="text" name="price_key" value="<?= @$subscription->price_key ?>" class="form-control price_key" id="exampleInputEmaila1" placeholder="Price ID (Stripe Price ID)" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Payment Link (Stripe Payment Link) <span style="color: red">*</span></label>
                                                <input type="text" name="payment_link" value="<?= @$subscription->payment_link ?>" class="form-control payment_link" id="exampleInputEmaila1" placeholder="https://buy.stripe.com/****_******************" required>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Subscription Duration (in days)</label>
                                            <input type="text" name="subscription_duration" value="<?= @$subscription->subscription_duration ?>" class="form-control" id="exampleInputEmaila1" placeholder="Enter Duration. Ex: 30 days" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Subscription Description</label>
                                            <textarea name="subscription_description" id="editor2"><?= @$subscription->subscription_description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status <span style="color: red">*</span></label>
                                            <select name="status" class="form-control" required>
                                                <option value="">Choose</option>
                                                <option <?php if (@$subscription->status == 1) { echo "selected"; } ?> value="1">Active</option>
                                                <option <?php if (@$subscription->status == 0) { echo "selected"; } ?>value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer" style="margin-left: 30px;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<style>
.courseTypefield {display: none;}
</style>
<script>
$(document).ready(function () {
    var selectedCourseType = $('#subscription_type').val();
    if (selectedCourseType == 'free') {
        $('.courseTypefield').hide();
        $('.subscription_amount').val('');
        $('.price_key').val('');
        $('.price_key').prop('required', false);
        $('.payment_link').val('');
        $('.payment_link').prop('required', false);
    } else if (selectedCourseType == 'paid') {
        $('.courseTypefield').show();
        $('.price_key').prop('required', true);
        $('.payment_link').prop('required', true);
    } else {
        $('.courseTypefield').hide();
    }
});

$('#subscription_type').change(function () {
    var selectedOption = $(this).val(); //alert(selectedOption);
    if (selectedOption == 'free') {
        $('.courseTypefield').hide();
        $('.subscription_amount').val('');
        $('.price_key').val('');
        $('.price_key').prop('required', false);
        $('.payment_link').val('');
        $('.payment_link').prop('required', false);
    } else if (selectedOption == 'paid') {
        $('.courseTypefield').show();
        $('.price_key').prop('required', true);
        $('.payment_link').prop('required', true);
    } else {
        $('.courseTypefield').hide();
    }
})
</script>
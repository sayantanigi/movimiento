<style>
#sample_1_filter {padding: 8px;float: right;}
#sample_1_length {padding: 8px;}
#sample_1_info {padding: 8px;}
#sample_1_paginate {float: right; padding: 8px;}
.dataTables_info {padding: 7px;}
.showcase_buttons .btn.btn-outline.green { width: 100%; margin: 0 0 5px 0;}
.showcase_buttons .btn.btn-outline.red {width: 100%;}
.details{position: relative !important; right: 0px !important; padding: 15px !important; }
.desc {text-align: center !important; font-size: 16px !important; padding: 0 !important; margin: 0 !important;}
.desc * {margin: 0;}
.dashboard-stat.red .more {text-align: center !important;}
</style>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?php $this->load->view('supercontrol/leftbar'); ?>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo base_url(); ?>supercontrol/home">Home</a><i class="fa fa-circle"></i> </li>
                    <li><span>Supercontrol Panel</span> <i class="fa fa-circle"></i></li>
                    <li><span>Show Subscription List </span></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed showcase_buttons">
                        <div class="tab-content">
                        <div class="page-content1">
                            <h3 class="page-title"> Subscription Package</h3>
                            <div class="row">
                                <?php
                                $getsubscriptionList = $this->db->query("SELECT * FROM subscription WHERE status = '1'")->result_array();
                                if(!empty($getsubscriptionList)) {
                                    foreach ($getsubscriptionList as $key => $subscription) { ?>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="dashboard-stat red">
                                                <div class="details">
                                                    <div class="desc"><?= $subscription['subscription_name']?></div>
                                                </div>
                                                <div class="details">
                                                    <div class="desc"><?= $subscription['subscription_description']?></div>
                                                </div>
                                                <a class="more" href="<?= $subscription['payment_link']?>">Subscribe</a>
                                                <!-- <?php if($subscription['subscription_type'] == 'paid') { ?>
                                                <a class="more" href="<?= base_url('stripe/'.base64_encode($subscription['price_key']))?>">Subscribe</a>
                                                <?php } else { ?>
                                                <a href="javascript:void(0);" class="btn btn-primary getSubscription_<?php echo $subscription['id']?>" id="getSubscription_<?php echo $subscription['id']?>">Subscribe</a>
                                                <input type="hidden" name="user_id_<?php echo $subscription['id']?>" id="user_id_<?php echo $subscription['id']?>" value="<?php echo $_SESSION['afrebay']['userId']?>">
                                                <input type="hidden" name="sub_id_<?php echo $subscription['id']?>" id="sub_id_<?php echo $subscription['id']?>" value="<?php echo $subscription['id']?>">
                                                <input type="hidden" name="sub_name_<?php echo $subscription['id']?>" id="sub_name_<?php echo $subscription['id']?>" value="<?php echo $subscription['subscription_name']?>">
                                                <input type="hidden" name="user_email_<?php echo $subscription['id']?>" id="user_email_<?php echo $subscription['id']?>" value="<?php echo $_SESSION['afrebay']['userEmail']?>">
                                                <input type="hidden" name="sub_price_<?php echo $subscription['id']?>" id="sub_price_<?php echo $subscription['id']?>" value="<?php echo $subscription['subscription_amount']?>">
                                                <input type="hidden" name="sub_duration_<?php echo $subscription['id']?>" id="sub_duration_<?php echo $subscription['id']?>" value="<?php echo $subscription['subscription_duration']?>">
                                                <?php } ?> -->
                                            </div>
                                        </div>
                                <?php } } ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $("#selectall").click(function () {
        var check = $(this).prop('checked');
        if (check == true) {
            $('.checker').find('span').addClass('checked');
            $('.checkbox1').prop('checked', true);
        } else {
            $('.checker').find('span').removeClass('checked');
            $('.checkbox1').prop('checked', false);
        }
    });
    $("#del_all").on('click', function (e) {
        e.preventDefault();
        var checkValues = $('.checkbox1:checked').map(function () {
            return $(this).val();
        }).get();
        console.log(checkValues);
        //alert(checkValues);
        $.each(checkValues, function (i, val) {
            //alert(val);
            $("#" + val).remove();
        });
        $.ajax({
            url: '<?php echo base_url() ?>supercontrol/course/delete_multiple',
            type: 'post',
            data: 'ids=' + checkValues
        }).done(function (data) {
            $("#respose").html(data);
            //location.reload();
            var newurl = '<?php echo base_url() ?>supercontrol/course/show_course';
            window.location.href = newurl;
            $('#selectall').attr('checked', false);
        });
    });
    function resetcheckbox() {
        $('input:checkbox').each(function () { //loop through each checkbox
            this.checked = false; //deselect all checkboxes with class "checkbox1"
        });
    }
});
function f1(stat, id) {
    $.ajax({
        type: "get",
        url: "<?php echo base_url(); ?>supercontrol/blog/statusblog",
        data: { stat: stat, id: id }
    });
}
function subscriptionPayment(subscription_id) {
    var id = subscription_id;
    var user_id = $("#user_id").val();
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>supercontrol/subscription/userSubscription",
        data: { subscription_id: id, user_id: user_id }
    })
    .done(function (data) {
        window.location.href = data;
    });
}
</script>
<?php //$this->load->view ('footer');?>
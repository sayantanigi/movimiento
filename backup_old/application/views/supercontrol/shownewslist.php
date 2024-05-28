<style>
#sample_1_filter {padding: 8px;float: right;}
#sample_1_length {padding: 8px;}
#sample_1_info {padding: 8px;}
#sample_1_paginate {float: right;padding: 8px;}
.dataTables_info {padding: 7px;}
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
                    <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i></li>
                    <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
                    <li> <span>Show News List </span> </li>
                </ul>
            </div>
            <?php if (@$message) {
                echo @$message;
            } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Show News</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a> 
                                            <a href="javascript:;" class="reload"> </a> 
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                            <div id="mydiv">
                                                <thead>
                                                    <tr>
                                                        <th>Sl No</th>
                                                        <th style="max-width:170px;">Image</th>
                                                        <th>Blog Title</th>
                                                        <th>Posted By</th>
                                                        <th>News Link</th>
                                                        <th>Status</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (is_array($ecms)) {
                                                    $ctn = 1;
                                                    foreach ($ecms as $i) { ?>
                                                    <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                                        <td><?= $ctn?></td>
                                                        <td><?php if ($i->image == "") { ?>
                                                        No Image
                                                        <?php } else { ?>
                                                        <img src="<?php echo base_url() ?>uploads/blog/<?php echo $i->image; ?>" width="150" height="100" style="border: 2px solid #ddd;"/>
                                                        <?php } ?></td>
                                                        <td style="max-width:150px;"> <?php echo $i->title; ?> </td>
                                                        <td style="max-width:200px;"> 
                                                        <?php 
                                                        if(!empty($i->uploaded_by)){
                                                            $userdetails = $this->db->query("SELECT * FROM users WHERE id = '".$i->uploaded_by."'")->row();
                                                            echo $userdetails->fname." ".$userdetails->lname;
                                                        }
                                                        ?>
                                                        </td>
                                                        <td style="max-width:200px;"> <?php echo $i->popular; ?> </td>
                                                        <td style="max-width:250px;">
                                                            <div class="form-group">
                                                                <div class="col-md-5">
                                                                    <select name="blog_status" id="stachange" onchange="f1(this.value,<?php echo $i->id; ?>)" style="padding:4px;">
                                                                        <option value="1" <?php if ($i->status == 1) { ?> selected="selected" <?php } ?>>Active </option>
                                                                        <option value="0" <?php if ($i->status == 0) { ?> selected="selected" <?php } ?>>Inactive </option>
                                                                    </select>
                                                                    <input type="hidden" name="id" value="<?php echo $i->id; ?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="max-width:80px;"><a
                                                                class="btn green btn-sm btn-outline sbold uppercase"
                                                                href="<?php echo base_url() ?>supercontrol/news/show_news_id/<?php echo $i->id; ?>">Edit</a>
                                                        </td>
                                                        <td style="max-width:80px;">
                                                            <a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url() ?>supercontrol/news/delete_news/<?php echo $i->id; ?>">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php $ctn++; } } ?>
                                                </tbody>
                                            </div>
                                        </table>
                                    </div>
                                </div>
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
        //resetcheckbox();
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
            //                    return  false;
            //alert ("<?php echo base_url() ?>supercontrol/controllers/news/delete_multiple");
            $.ajax({

                url: '<?php echo base_url() ?>supercontrol/news/delete_multiple',
                type: 'post',
                data: 'ids=' + checkValues
            }).done(function (data) {
                $("#respose").html(data);
                //location.reload();
                var newurl = '<?php echo base_url() ?>supercontrol/news/show_news';
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
</script>
<script>
    function f1(stat, id) {
        $.ajax({
            type: "get",
            url: "<?php echo base_url(); ?>supercontrol/news/statusnews",
            data: { stat: stat, id: id }
        });
    }
</script>

<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
.files:after,.files:before{position:absolute;left:0;pointer-events:none;right:0;display:block;margin:0 auto}small>p{color:red}p strong{font-weight:600!important;color:#000!important}.sa-confirm-button-container button{background-color:#146c43!important;border-color:#146c43!important}.files input{outline:#92b0b3 dashed 2px;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;padding:52px 0 46px 32%;text-align:center!important;margin:0;width:100%!important}.files input:focus{outline:#92b0b3 dashed 2px;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;border:1px solid #92b0b3}.files{position:relative}.files:after{top:60px;width:50px;height:56px;content:"";background-image:url(https://image.flaticon.com/icons/png/128/109/109612.png);background-size:100%;background-repeat:no-repeat}.color input{background-color:#f1f1f1}.files:before{bottom:10px;width:100%;height:57px;color:#2ea591;font-weight:600;text-transform:capitalize;text-align:center}
</style>
<div class="main-content">
    <div class="page-content">	
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?= $title ?></h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="page-wrapper">
                        <div class="container-fluid">
                            <form action="" method="POST" enctype="multipart/form-data" id="submitAboutus">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="box-title m-b-30 m-t-10"><?= $title ?></h3>
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group mb-2">
                                                            <label class="fw-semibold  text-black">Heading</label>
                                                            <input type="text" class="form-control" name="heading"  id="heading1"  autocomplete="off" value="<?php echo!empty($help->heading) ? $help->heading : ''; ?>">
                                                        </div>
                                                        <small id="heading_error"></small>
                                                        <div class="form-row mb-3 mt-3">
                                                            <div class="form-group col-md-12">
                                                                <label class="fw-semibold  text-black">Description</label>
                                                                <textarea name="description" id="description" class="form-control editor summermote">
                                                                    <?php echo!empty($help->description) ? $help->description : ''; ?>
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                        <small id="description_error"></small>
                                                        <div class="form-group mb-2">
                                                            <label class="fw-semibold  text-black">Status</label>
                                                            <select class="form-control" name="status"  id="userstatus">
                                                                <option value="">Select Status</option>
                                                                <option value="1" <?php echo (@$help->status == 1) ? 'selected' : '' ?>>Active</option>
                                                                <option value="0" <?php echo (@$help->status == 0) ? 'selected' : '' ?>>Inactive</option>
                                                            </select>
                                                        </div>
                                                        <small id="status_error"></small>
                                                        <br/>
                                                        <div class="col-sm-6 col-sm-offset-2 mb-3" style="padding-left:30px;">
                                                            <div class="form-group">
                                                                <input type="submit" class="btn btn-success" name="submit" id="submit" value="Save"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 	
        </div> 
        <script type="text/javascript">
            $(document).ready(function () {
                $('.editor').summernote({
                    placeholder: 'About Us Body',
                    height: 200
                });
            });

            document.getElementById("upload_image").onchange = function (event) {
                let file = event.target.files[0];
                var extension = file.name.split('.').pop().toLowerCase();
                if (extension == 'jpg' || extension == 'jpeg' || extension == 'gif' || extension == 'png') {
                    let blobURL = URL.createObjectURL(file);
                    document.getElementById("blahImg").src = blobURL;
                    $('#blahImg').css('display', 'block');
                    $('#blahVideo').css('display', 'none');
                } else {
                    let blobURL = URL.createObjectURL(file);
                    document.getElementById("blahVideo").src = blobURL;
                    $('#blahImg').css('display', 'none');
                    $('#blahVideo').css('display', 'block');
                }
            }
            $(document).ready(function () {
                $("#submitAboutus").on('submit', function (e) {
                    e.preventDefault();
                    var form_data = new FormData();
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('admin/cms/saveHelp'); ?>',
                        data: new FormData(this),
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            $(".progress-bar").width('0%');
                        },
                        error: function () {
                            $('#uploadsuccessfully').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
                        },
                        success: function (data) {
                            if (data.vali_error == 1) {
                                if (data.heading_error != '') {
                                    $('#heading_error').html(data.heading_error);
                                } else {
                                    $('#heading_error').html('');
                                }
                                if (data.description_error != '') {
                                    $('#description_error').html(data.description_error);
                                } else {
                                    $('#description_error').html('');
                                }
                                if (data.status_error != '') {
                                    $('#status_error').html(data.status_error);
                                } else {
                                    $('#status_error').html('');
                                }
                            }

                            if (data.status == 1) {
                                swal({title: "Sucess!", text: "<strong>" + data.message + "</strong>", type: "success", showConfirmButton: true, html: true}, function () {
                                    window.location.href = "<?= base_url('admin/cms/help') ?>"
                                });
                            }
                        }
                    });
                });
            });
        </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<style>
.form-check{display:flex;align-items:center}.form-check label{margin-left:10px;font-size:18px;font-weight:500}.form-switch .form-check-input[type=checkbox]{border-radius:2em;height:50px;width:100px}small>p{color:red}p strong{font-weight:600!important;color:#000!important}.sa-confirm-button-container button{background-color:#146c43!important;border-color:#146c43!important}
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
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-shadow rounded-lg border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-10">
                                    <h4 class="card-title mb-4"><?= $title ?></h4>
                                </div>
                            </div>   	
                            <div class="">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Reply by Admin</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php if (is_array($contact_list) || is_object($contact_list)) {
                                        $count = 1;
                                        foreach ($contact_list as $contact) { ?>
                                        <tr>
                                            <td><?= $count; ?></td>
                                            <td><?= ucwords(@$contact->firstname); ?></td>
                                            <td><?= ucwords(@$contact->lastname); ?></td>
                                            <td><?= @$contact->email; ?></td>
                                            <td><?= @$contact->phone; ?></td>
                                            <td><?= @$contact->message; ?></td>
                                            <td><?= @$contact->reply_text; ?></td>
                                            <td class="text-center">
                                                <?php if(@$contact->reply_status != '1') { ?>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg_<?= $count; ?>" title="Reply">
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                                <div class="modal fade bd-example-modal-lg_<?= $count; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form>
                                                                    <div class="form-group" style="text-align: left;">
                                                                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                                                                        <input type="text" class="form-control" id="recipient_<?= @$contact->id; ?>" value="<?= @$contact->email; ?>" readonly>
                                                                        <span id="err_rec_<?= @$contact->id; ?>"></span>
                                                                    </div>
                                                                    <div class="form-group" style="text-align: left;">
                                                                        <label for="message-text" class="col-form-label">Message:</label>
                                                                        <textarea class="form-control" id="messageText_<?= @$contact->id; ?>"></textarea>
                                                                        <span id="err_msg_<?= @$contact->id; ?>"></span>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" id="sendReply_<?= @$contact->id; ?>">Send Reply</button>
                                                                <input type="hidden" id="contact_id_<?= @$contact->id; ?>" value="<?= @$contact->id; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php } else { ?>
                                                <a href="javascript:void(0)" class="btn btn-success btn-sm replied_<?= $count; ?>" >
                                                    <i class="fas fa-reply"></i>
                                                </a>
                                                <?php } ?>
                                                <a href="javascript:void(0)" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" title="Delete"  onclick="deleteDeals(<?= @$v->id ?>)">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $count++; } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>   
<script type="text/javascript">
<?php $count = 1;
foreach ($contact_list as $contact) { ?>
    $('#sendReply_<?= @$contact->id; ?>').click(function() {
        var contact_id = $('#contact_id_<?= @$contact->id; ?>').val();
        var recipient = $('#recipient_<?= @$contact->id; ?>').val();
        var message = $('#messageText_<?= @$contact->id; ?>').val();
        if(recipient == '') {
            $('#err_rec_<?= @$contact->id; ?>').text('Invalid Recipient').css('color', 'red');
        } else if(message == '') {
            $('#err_msg_<?= @$contact->id; ?>').text('This field is mandatory').css('color', 'red');
        } else {
            $.ajax({
                url: '<?= base_url()?>admin/contact/reply_contact',
                type: 'POST',
                dataType: 'json',
                data: {
                    contact_id: contact_id,
                    recipient: recipient,
                    message: message
                },
            })
            .done(function (data) {
                if (data.status == 'success') {
                    swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html: true}, function () {
                        window.location.href = "<?= base_url('admin/contact')?>"
                    });
                } else if (data.status == 'error') {
                    swal({title: "Sucess!", text: "<strong>"+data.message+"</strong>", type: "success", showConfirmButton: true, html: true}, function () {
                        window.location.href = " "
                    });
                }
            })
            .fail(function (data) {
                console.log(data);
            })
        }
    })
    $('.replied_<?= @$contact->id; ?>').click(function(){
        swal({title: "", text: "<strong>Already Replied.</strong>", type: "info", showConfirmButton: true, html: true}, function () {
            window.location.href = "<?= base_url('admin/contact')?>"
        });
    })
<?php $count++; } ?>
</script>
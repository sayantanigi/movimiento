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
            <form action="<?= base_url('admin/dashboard/save_Link') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="col-xl-12 mb-3">
                            <div class="panel-body">
                                <table class="table jobsites" id="purchaseTableclone1" style="border: 5px solid #eee !important;">
                                    <tr class="color">
                                        <th><label class="fw-semibold text-black">DMV Useful Links</label></th>
                                        <th style="text-align: end;"><button type="button" class="btn btn-info addMoreBtn" onclick="add_row1()">Add More</button></th>
                                    </tr>
                                    <tbody id="clonetable_feedback1">
                                        <?php if(!empty($links_dmv->link_name_data)) {
                                        $link_name_data = unserialize(@$links_dmv->link_name_data);
                                        $rows = 1;
                                        foreach ($link_name_data as $key) { ?>
                                        <tr>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_name_dmv[]" id="link_name_dmv<?= $rows; ?>" class="form-control" value="<?= $key['link_name_dmv']; ?>">
                                            </td>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_dmv[]" id="link_dmv<?= $rows; ?>" class="form-control" value="<?= $key['link_dmv']; ?>">
                                            </td>
                                            <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow1(this)">X</a></td>
                                        </tr>
                                        <?php } } else { ?>
                                        <tr>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_name_dmv[]" id="link_name_dmv1" class="form-control" placeholder="Link Name">
                                            </td>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_dmv[]" id="link_dmv1" class="form-control" placeholder="Link">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow1(this)">X</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-12 mb-3">
                            <div class="panel-body">
                                <table class="table jobsites" id="purchaseTableclone2" style="border: 5px solid #eee !important;">
                                    <tr class="color">
                                        <th><label class="fw-semibold text-black">Useful Video Links For New Drivers</label></th>
                                        <th style="text-align: end;"><button type="button" class="btn btn-info addMoreBtn" onclick="add_row2()">Add More</button></th>
                                    </tr>
                                    <tbody id="clonetable_feedback2">
                                        <?php if(!empty($links_video->link_name_data)) {
                                        $link_name_data = unserialize(@$links_video->link_name_data);
                                        $rows=1;
                                        foreach ($link_name_data as $key) { ?>
                                        <tr>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_name_video[]" id="link_name_video<?= $rows; ?>" class="form-control" value="<?= $key['link_name_video']; ?>">
                                            </td>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_video[]" id="link_video<?= $rows; ?>" class="form-control" value="<?= $key['link_video']; ?>">
                                            </td>
                                            <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow2(this)">X</a></td>
                                        </tr>
                                        <?php } } else { ?>
                                        <tr>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_name_video[]" id="link_name_video1" class="form-control" placeholder="Link Name">
                                            </td>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_video[]" id="link_video1" class="form-control" placeholder="Link">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow2(this)">X</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-12 mb-3">
                            <div class="panel-body">
                                <table class="table jobsites" id="purchaseTableclone3" style="border: 5px solid #eee !important;">
                                    <tr class="color">
                                        <th><label class="fw-semibold text-black">DMV Permit Practice Test</label></th>
                                        <th style="text-align: end;"><button type="button" class="btn btn-info addMoreBtn" onclick="add_row3()">Add More</button></th>
                                    </tr>
                                    <tbody id="clonetable_feedback3">
                                        <?php if(!empty($links_permit->link_name_data)) {
                                        $link_name_data = unserialize(@$links_permit->link_name_data);
                                        $rows=1;
                                        foreach ($link_name_data as $key) { ?>
                                        <tr>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_name_permit[]" id="link_name_permit<?= $rows; ?>" class="form-control" value="<?= $key['link_name_permit']; ?>">
                                            </td>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_permit[]" id="link_permit<?= $rows; ?>" class="form-control" value="<?= $key['link_permit']; ?>">
                                            </td>
                                            <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow3(this)">X</a></td>
                                        </tr>
                                        <?php } } else { ?>
                                        <tr>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_name_permit[]" id="link_name_permit1" class="form-control" placeholder="Link Name">
                                            </td>
                                            <td style="width: 50%;">
                                                <input type="text" name="link_permit[]" id="link_permit1" class="form-control" placeholder="Link">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow3(this)">X</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 col-sm-offset-4">
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" name="linkadd" id="linkadd" value="Update"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
let dmvCount = 1;
function add_row1() {
    dmvCount++;
    const tabledmv = document.getElementById("clonetable_feedback1");
    const rowdmv = tabledmv.insertRow();
    rowdmv.innerHTML = `<td style="width: 50%;"><input type="text" name="link_name_dmv[]" id="link_name_dmv${dmvCount}" class="form-control" placeholder="Link Name"></td><td style="width: 50%;"><input type="text" name="link_dmv[]" id="link_dmv${dmvCount}" class="form-control" placeholder="Link"></td><td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow1(this)">X</a></td>`;
}

function removeRow1(elementdmv) {
    const rowdmv = elementdmv.parentElement.parentElement;
    rowdmv.remove();
}

let videoCount = 1;
function add_row2() {
    videoCount++;
    const tablevideo = document.getElementById("clonetable_feedback2");
    const rowvideo = tablevideo.insertRow();
    rowvideo.innerHTML = `<td style="width: 50%;"><input type="text" name="link_name_video[]" id="link_name_video${videoCount}" class="form-control" placeholder="Link Name"></td><td style="width: 50%;"><input type="text" name="link_video[]" id="link_video${videoCount}" class="form-control" placeholder="Link"></td><td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow2(this)">X</a></td>`;
}

function removeRow2(elementvideo) {
    const rowvideo = elementvideo.parentElement.parentElement;
    rowvideo.remove();
}

let permitCount = 1;
function add_row3() {
    permitCount++;
    const tablepermit = document.getElementById("clonetable_feedback3");
    const rowpermit = tablepermit.insertRow();
    rowpermit.innerHTML = `<td style="width: 50%;"><input type="text" name="link_name_permit[]" id="link_name_permit${permitCount}" class="form-control" placeholder="Link Name"></td><td style="width: 50%;"><input type="text" name="link_permit[]" id="link_permit${permitCount}" class="form-control" placeholder="Link"></td><td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow3(this)">X</a></td>`;
}

function removeRow3(elementpermit) {
    const rowpermit = elementpermit.parentElement.parentElement;
    rowpermit.remove();
}
</script>
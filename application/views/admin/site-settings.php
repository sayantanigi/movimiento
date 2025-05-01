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
            <form action="<?= base_url('admin/settings/save') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Site Basic Details</h4>
                                <hr>
                                <div class="row mb-3 mt-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="address" id="address" value="<?= $data->address ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" value="<?= $data->email ?>" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-url-input" class="col-sm-2 col-form-label">Telephone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="phone" id="phone" value="<?= $data->phone ?>" autocomplete="off" required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-url-input" class="col-sm-2 col-form-label">Tax Amount</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="tax_amount" id="tax_amount" value="<?= $data->tax_amount ?>" autocomplete="off" required="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="panel-body">
                                        <table class="table jobsites" id="purchaseTableclone1">
                                            <tr class="color">
                                                <th><label class="fw-semibold text-black">Other Office Locations: </label></th>
                                                <th style="text-align: end;"><button type="button" class="btn btn-info addMoreBtn" onclick="add_row()" >Add More</button></th>
                                            </tr>
                                            <tbody id="clonetable_feedback1">
                                                <?php if(!empty($data->other_location_details)) {
                                                $other_location_details = unserialize(@$data->other_location_details);
                                                $rows=1;
                                                foreach ($other_location_details as $key) { ?>
                                                <tr>
                                                    <td style="width: 50%;">
                                                        <input type="text" name="company_location[]" id="company_location<?= $rows; ?>" class="form-control" value="<?= $key['company_location']; ?>">
                                                    </td>
                                                    <td style="width: 50%;">
                                                        <input type="text" name="company_contact[]" id="company_contact<?= $rows; ?>" class="form-control" value="<?= $key['company_contact']; ?>">
                                                    </td>
                                                    <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow(this)">X</a></td>
                                                </tr>
                                                <?php } } else { ?>
                                                <tr>
                                                    <td style="width: 50%;">
                                                        <input type="text" name="company_location[]" id="company_location1" class="form-control" placeholder="Company Location">
                                                    </td>
                                                    <td style="width: 50%;">
                                                        <input type="text" name="company_contact[]" id="company_contact1" class="form-control" placeholder="Company Contact">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow(this)">X</a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Social Media Settings</h4>
                                <hr>
                                <div class="row mb-3 mt-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Facebook :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="facebook" id="facebook" value="<?= $data->facebook ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Twitter :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="twitter" id="twitter" value="<?= $data->twitter ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Linkedin :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="linkedin" id="linkedin" value="<?= $data->linkedin ?>" autocomplete="off">
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">SMTP Settings</h4>
                                <hr>
                                <div class="row mb-3 mt-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">SMTP HOST :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="smtp_host" id="smtp_host" value="<?= $data->smtp_host ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">SMTP PORT :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="smtp_port" id="smtp_port" value="<?= $data->smtp_port ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">SMTP User Email :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="smtp_email" id="smtp_email" value="<?= $data->smtp_email ?>" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">SMTP Password :</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="smtp_pass" id="smtp_pass" value="<?= $data->smtp_pass ?>" autocomplete="off">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 col-sm-offset-4">
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-success" name="settings" id="settings" value="Update"/>
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
<script>
let rowCount = 1;
function add_row() {
    rowCount++;
    const table = document.getElementById("clonetable_feedback1");
    const row = table.insertRow();
    row.innerHTML = `<td style="width: 50%;"><input type="text" name="company_location[]" id="company_location${rowCount}" class="form-control" placeholder="Company Location"></td><td style="width: 50%;"><input type="text" name="company_contact[]" id="company_contact${rowCount}" class="form-control" placeholder="Company Contact"></td><td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return removeRow(this)">X</a></td>`;
}

function removeRow(element) {
    const row = element.parentElement.parentElement;
    row.remove();
}
</script>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Images</h3>
                </div>
                <form action="<?= admin_url('maknine/add/' . @$maknine->id) ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                            <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="file" name="image[]" multiple class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Presentation For</label>
                                            <select name="presentation_for" class="form-control">
                                                <option value="">Select Option</option>
                                                <option value="mak_09" <?php if (@$maknine->presentation_for == 'mak_09') { echo 'selected'; } ?>>Makutano 09</option>
                                                <option value="mak_08" <?php if (@$maknine->presentation_for == 'mak_08') { echo 'selected'; } ?>>Makutano 08</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">Select Option</option>
                                                <option value="1" <?php if (@$maknine->status == '1') { echo 'selected'; } ?>>Active</option>
                                                <option value="2" <?php if (@$maknine->status == '2') { echo 'selected'; } ?>>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
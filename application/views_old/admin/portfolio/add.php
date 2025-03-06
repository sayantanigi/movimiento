<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Partner</h3>
                </div>
                <form action="<?= admin_url('portfolio/add/' . $portfolio->id) ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Portfolio Name</label>
                                            <select name="portfolioId" class="form-control">
                                                <option value="">Select Option</option>
                                                <option value="1" <?php if ($portfolio->portfolioId == '1') { echo 'selected'; } ?>>Portfolio 9</option>
                                                <option value="2" <?php if ($portfolio->portfolioId == '2') { echo 'selected'; } ?>>Portfolio 8</option>
                                                <option value="3" <?php if ($portfolio->portfolioId == '3') { echo 'selected'; } ?>>Portfolio 7</option>
                                                <option value="4" <?php if ($portfolio->portfolioId == '4') { echo 'selected'; } ?>>Youth</option>
                                                <option value="5" <?php if ($portfolio->portfolioId == '5') { echo 'selected'; } ?>>Women In Business</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="file" name="image[]" multiple class="form-control" id="exampleInputEmail1">
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
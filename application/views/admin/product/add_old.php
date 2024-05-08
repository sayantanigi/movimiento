<!-- Main content -->
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= admin_url('products/product_list') ?>"> Product List</a></li>
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
                <form action="<?= admin_url('products/add_product/' . $product->id) ?>" id="form_validation" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Category</label>
                                            <select name="frm[categori_id]" class="form-control">
                                                <option value="">Choose</option>
                                                <?php foreach ($product_cat as $pcat) { ?>
                                                <option <?php if (@$product->categori_id == $pcat->id) { echo "selected"; } ?> value="<?= $pcat->id; ?>"><?= $pcat->category_name;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Name</label>
                                            <input type="text" name="frm[product_name]" value="<?= @$product->product_name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Program Overview</label>
                                            <textarea name="frm[overview]" id="editor2"><?= @$product->overview ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea name="frm[description]" id="editor1"><?= @$product->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Additional Information</label>
                                            <textarea name="frm[additional_information]" id="editor3"><?= @$product->additional_information ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="courseTypefield1">
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Quantity <span id="tooltipTarget">(Allow only numeric values without decimal)</span></label>
                                                <input type="text" name="frm[quantity]" value="<?= @$product->quantity ?>" class="form-control price" id="quantity" placeholder="Enter Price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="courseTypefield1">
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">MRP (In $) <span id="tooltipTarget">(Allow only numeric values)</span></label>
                                                <input type="text" name="frm[mrp]" value="<?= @$product->mrp ?>" class="form-control price" id="mrp" placeholder="Enter MRP">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="courseTypefield1">
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Selling price (In $) <span id="tooltipTarget">(Allow only numeric values)</span></label>
                                                <input type="text" name="frm[sale_price]" value="<?= @$product->sale_price ?>" class="form-control price" id="sale_price" placeholder="Enter sale price">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <img src="<?= site_url('uploads/products/' . @$product->product_image) ?>" onerror="this.src='<?= site_url() ?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                                            <label for="exampleInputEmail1">Product Image</label>
                                            <input type="file" name="product_image" value="<?= @$product->product_image ?>" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status <span style="color: red">*</span></label>
                                            <select name="frm[status]" class="form-control" required>
                                                <option value="">Choose</option>
                                                <option <?php if (@$product->status == 1) { echo "selected"; } ?> value="1">Active</option>
                                                <option <?php if (@$product->status == 0) { echo "selected"; } ?>value="0">Inactive</option>
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
            <!-- /.box -->
        </div>
    </div>
</section>
<style>
.courseTypefield {
    display: none;
}
#tooltipTarget {color: red;}
</style>
<script>
$(document).ready(function () {
    var selectedCourseType = $('#course_fees').val();
    if (selectedCourseType == 'free') {
        $('.courseTypefield').hide();
        $('.price').val('');
        $('.price_key').val('');
        $('.price_key').prop('required', false);
    } else if (selectedCourseType == 'paid') {
        $('.courseTypefield').show();
        $('.price_key').prop('required', true);
    } else {
        $('.courseTypefield').hide();
    }

    $('#quantity').on('input', function() {
        var inputValue = $(this).val();
        var numericValue = inputValue.replace(/\D/g, '');
        $(this).val(numericValue);
    });

    $("#mrp").on("input", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
        }
    });

    $("#sale_price").on("input", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
        }
    });
});
</script>
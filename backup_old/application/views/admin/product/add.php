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
                <form action="<?= admin_url('products/add_product/' . @$product->id) ?>" id="form_validation" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Product Category</label>
                                            <select name="categori_id" class="form-control">
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
                                            <input type="text" name="product_name" value="<?= @$product->product_name ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Product Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Program Overview</label>
                                            <textarea name="frmoverview" id="editor2"><?= @$product->overview ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea name="frmdescription" id="editor1"><?= @$product->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Additional Information</label>
                                            <textarea name="additional_information" id="editor3"><?= @$product->additional_information ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-10">
                                        <label>Details</label>
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <table class="table jobsites" id="purchaseTableclone1">
                                                    <tr class="color">
                                                        <th>Size</th>
                                                        <th>Quantity</th>
                                                        <th><button type="button" class="btn btn-info addMoreBtn" onclick="add_row()" >Add More</button></th>
                                                    </tr>
                                                    <tbody id="clonetable_feedback1">
                                                        <?php 
                                                        $query = $this->db->query("SELECT * FROM product_details WHERE product_id = '".$product->id."'")->result_array();
                                                        if(!empty($query)) {
                                                        $rows=1;
                                                        foreach ($query as $key) { ?>
                                                        <tr>
                                                            <td style="width: 65%;">
                                                                <select class="form-control form-select" name="size[]" id="size<?= $rows; ?>">
                                                                    <option value="">Select Size</option>
                                                                    <option value="XS" <?php if($key['size'] == "XS") {echo "selected";}?>>XS</option>
                                                                    <option value="S" <?php if($key['size'] == "S") {echo "selected";}?>>S</option>
                                                                    <option value="M" <?php if($key['size'] == "M") {echo "selected";}?>>M</option>
                                                                    <option value="L" <?php if($key['size'] == "L") {echo "selected";}?>>L</option>
                                                                    <option value="XL" <?php if($key['size'] == "XL") {echo "selected";}?>>XL</option>
                                                                    <option value="2XL" <?php if($key['size'] == "2XL") {echo "selected";}?>>2XL</option>
                                                                    <option value="3XL" <?php if($key['size'] == "3XL") {echo "selected";}?>>3XL</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="quantity[]" value="<?= $key['quantity']; ?>" class="form-control price" id="quantity<?= $rows; ?>" placeholder="Enter Quantity">
                                                            </td>
                                                            <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return remove(this)">X</a></td>
                                                        <?php } } else { ?>
                                                        <tr>
                                                            <td style="width: 65%;">
                                                                <select class="form-control form-select" name="size[]" id="size1">
                                                                    <option value="">Select Size</option>
                                                                    <option value="XS">XS</option>
                                                                    <option value="S">S</option>
                                                                    <option value="M">M</option>
                                                                    <option value="L">L</option>
                                                                    <option value="XL">XL</option>
                                                                    <option value="2XL">2XL</option>
                                                                    <option value="3XL">3XL</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="quantity[]" value="" class="form-control price" id="quantity1" placeholder="Enter Quantity">
                                                            </td>
                                                            <td><a href="javascript:void(0)" title="Delete" class="text-danger" onclick="return remove(this)">X</a></td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="courseTypefield1">
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Quantity <span id="tooltipTarget">(Allow only numeric values without decimal)</span></label>
                                                <input type="text" name="frm[quantity]" value="<?= @$product->quantity ?>" class="form-control price" id="quantity" placeholder="Enter Price">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="courseTypefield1">
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">MRP (In $) <span id="tooltipTarget">(Allow only numeric values)</span></label>
                                                <input type="text" name="mrp" value="<?= @$product->mrp ?>" class="form-control price" id="mrp" placeholder="Enter MRP">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="courseTypefield1">
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Selling price (In $) <span id="tooltipTarget">(Allow only numeric values)</span></label>
                                                <input type="text" name="sale_price" value="<?= @$product->sale_price ?>" class="form-control price" id="sale_price" placeholder="Enter sale price">
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
                                            <select name="status" class="form-control" required>
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
function add_row() {
    var y=document.getElementById('clonetable_feedback1');
    var new_row = y.rows[0].cloneNode(true);
    var len = y.rows.length;
    new_number=Math.round(Math.exp(Math.random()*Math.log(10000000-0+1)))+0;
    var inp0 = new_row.cells[0].getElementsByTagName('select')[0];
    inp0.value = '';
    inp0.defaultValue = '';
    inp0.id = 'service'+(len+1);
    var inp1 = new_row.cells[1].getElementsByTagName('input')[0];
    inp1.value = '';
    inp1.defaultValue = '';
    inp1.id = 'service'+(len+1);
    if(new_row.cells.length > 3) {
        new_row.cells[2].remove();
    }
    var submit_btn =$('#submit').val();
    y.appendChild(new_row);
}

function remove(row) {
    var y=document.getElementById('purchaseTableclone1');
    var len = y.rows.length;
    if(len>2) {
        var i= (len-1);
        document.getElementById('purchaseTableclone1').deleteRow(i);
    }
}
</script>
<?php
$arr_default['twitter'] = '';
$arr_default['facebook'] = '';
$arr_default['pint'] = '';
$arr_default['linked'] = '';
$arr_default['lt'] = '';
$arr_default['insta'] = '';
$arr_default['l1'] = '';
$arr_default['l2'] = '';
$arr_default['l3'] = '';
$arr_default['l4'] = '';
$arr_default['l5'] = '';
$arr_default['l6'] = '';
$arr_default['address'] = '';
$arr_default['phone'] = '';
$arr_default['hth1'] = '';
$arr_default['hd1'] = '';
$arr_default['hth2'] = '';
$arr_default['hd2'] = '';
$arr_default['hth3'] = '';
$arr_default['hd3'] = '';
$arr_default['hth4'] = '';
$arr_default['hd4'] = '';
$arr_default['email'] = '';
$arr_default['cemail'] = '';
$arr_default['wemail'] = '';
$arr_default['youtube'] = '';
$arr_default['facebook'] = '';
$arr_default['twitter'] = '';
$arr_default['app_store_link'] = '';;
$arr_default['play_store_link'] = '';;
$arr_default['openh'] = '';
$arr_default['course_price'] = '';
$arr_default['map'] = '';
$arr_default['shipping_charge'] = '';
$arr_default['tax'] = '';
$arr_default['tollfree'] = '';
$_GET['options'] = $options;
$_GET['default'] = $arr_default;
function get_option($fname) {
    $arr_options = $_GET['options'];
    $arr_default = $_GET['default'];
    if (isset($arr_options[$fname])) {
        return $arr_options[$fname];
    } else {
        if (isset($arr_default[$fname])) {
            return $arr_default[$fname];
        } else {
            return NULL;
        }
    }
}
?>
<!-- Main content -->
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
            <?= $title ?>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Global Setting</h3>
                </div>
                <?php
                if (@get_option('logo') && file_exists('./uploads/logo/' . @get_option('logo'))) {
                    $profileImage = base_url('uploads/logo/' . @get_option('logo'));
                } else {
                    $profileImage = base_url('images/thumbs.jpg');
                } ?>
                <!-- /.box-header -->
                <div style="margin-top: 25px;">
                    <?php echo form_open_multipart(admin_url('settings'), array('class' => 'form-horizontal')); ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Website Logo</label>
                        <div class="col-sm-8">
                            <input type="file" accept="image/*" class="form-control" name="logo" id="customFile" onchange="preview_image(event)">
                        </div>
                        <div class="col-sm-2 text-left">
                            <label></label>
                            <img id="output_image" style="background: #3c8dbc;" src="<?= @$profileImage ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Footer text</label>
                        <div class="col-sm-8">
                            <input type="text" name="lt" value="<?= get_option('lt'); ?>" placeholder="Footer About text" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-8">
                            <input type="text" name="address" value="<?= get_option('address'); ?>" placeholder="Address" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" value="<?= get_option('phone'); ?>" placeholder="Enter Phone No" class="form-control input-sm" />
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Phone 2</label>
                        <div class="col-sm-8">
                            <input type="text" name="tollfree" value="<?= get_option('tollfree'); ?>" placeholder="Enter Toll Free" class="form-control input-sm" />
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Info Email</label>
                        <div class="col-sm-8">
                            <input type="text" name="email" value="<?= get_option('email'); ?>" placeholder="Enter Info Email" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Map</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="map" rows="6"><?= get_option('map') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Shipping Charge</label>
                        <div class="col-sm-8">
                            <!-- <textarea class="form-control" name="shipping_charge" rows="6"><?= get_option('shipping_charge') ?></textarea> -->
                            <input type="text" name="shipping_charge" value="<?= get_option('shipping_charge'); ?>" placeholder="Shipping Charge" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tax (%)</label>
                        <div class="col-sm-8">
                            <!-- <textarea class="form-control" name="tax" rows="6"><?= get_option('shipping_charge') ?></textarea> -->
                            <input type="text" name="tax" value="<?= get_option('tax'); ?>" placeholder="Tax (%)" class="form-control input-sm" />
                        </div>
                    </div>
                    <hr />
                    <div class="box-header with-border">
                        <h3 class="box-title">Footer Setting</h3>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Linkedin Link</label>
                        <div class="col-sm-8">
                            <input type="text" name="linked" value="<?= get_option('linked'); ?>" placeholder="" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Facebook Link</label>
                        <div class="col-sm-8">
                            <input type="text" name="facebook" value="<?= get_option('facebook'); ?>" placeholder="" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Twitter Link</label>
                        <div class="col-sm-8">
                            <input type="text" name="twitter" value="<?= get_option('twitter'); ?>" placeholder="" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Instagram Link</label>
                        <div class="col-sm-8">
                            <input type="text" name="insta" value="<?= get_option('insta'); ?>" placeholder="" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Youtube Link</label>
                        <div class="col-sm-8">
                            <input type="text" name="youtube" value="<?= get_option('youtube'); ?>" placeholder="" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">App Store Link</label>
                        <div class="col-sm-8">
                            <input type="text" name="app_store_link" value="<?= get_option('app_store_link'); ?>" placeholder="" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Play Store Link</label>
                        <div class="col-sm-8">
                            <input type="text" name="play_store_link" value="<?= get_option('play_store_link'); ?>" placeholder="" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">&nbsp;</label>
                        <div class="col-sm-5">
                            <input type="submit" name="submit" value="Save Settings" class="btn btn-primary btn-sm" />
                            <!-- <a href="<?= admin_url('settings/restore'); ?>" class="btn btn-sm btn-default reset">Restore Default</a> -->
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php
                        $str = '';
                        if (is_array($arr_default) && count($arr_default) > 0) {
                            foreach ($arr_default as $key => $val) {
                                $str .= $key . ',';
                            }
                        }
                        $str = rtrim($str, ',');
                        ?>
                        <input type="hidden" name="fields" value="<?= $str; ?>" />
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $('.reset').click(function () {
                        if (!confirm('It will RESET all values. Are you sure to proceed?'))
                            return false;
                    });
                });
            </script>
            <?= form_close(); ?>
        </div>
    </div>
    <!-- /.nav-tabs-custom -->
</section>
</section>
<!-- /.content -->
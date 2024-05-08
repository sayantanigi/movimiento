<?php
$arr_default['hth1'] = '';
$arr_default['hd1'] = '';
$arr_default['hth2'] = '';
$arr_default['hd2'] = '';
$arr_default['hth3'] = '';
$arr_default['hd3'] = '';
$arr_default['hth4'] = '';
$arr_default['hd4'] = '';
$arr_default['hth5'] = '';
$arr_default['hd5'] = '';
$arr_default['hth6'] = '';
$arr_default['hd6'] = '';

$arr_default['b1'] = '';
$arr_default['bd1'] = '';
$arr_default['b2'] = '';
$arr_default['bd2'] = '';
$arr_default['b3'] = '';
$arr_default['bd3'] = '';
$_GET['options'] = $options;
$_GET['default'] = $arr_default;
function get_option($fname) {
    $arr_options = $_GET['options'];
    $arr_default = $_GET['default'];
    if(isset($arr_options[$fname])) {
        return $arr_options[$fname];
    } else {
        if(isset($arr_default[$fname])) {
            return $arr_default[$fname];
        } else {
            return NULL;
        }
    }
}
?>
<!-- Main content -->
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Solution Setting</h3>
                </div>
                <?php echo form_open(admin_url('option'), array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Heading 1</label>
                    <div class="col-sm-8">
                        <input type="text" name="hth1" value="<?= get_option('hth1'); ?>" placeholder="" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description 1</label>
                    <div class="col-sm-8">
                        <textarea name="hd1" class="form-control" rows=2><?= get_option('hd1'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Heading 2</label>
                    <div class="col-sm-8">
                        <input type="text" name="hth2" value="<?= get_option('hth2'); ?>" placeholder="" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description 2</label>
                    <div class="col-sm-8">
                        <textarea name="hd2" class="form-control" rows=2><?= get_option('hd2'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Heading 3</label>
                    <div class="col-sm-8">
                        <input type="text" name="hth3" value="<?= get_option('hth3'); ?>" placeholder="" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description 3</label>
                    <div class="col-sm-8">
                        <textarea name="hd3" class="form-control" rows=2><?= get_option('hd3'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Heading 4</label>
                    <div class="col-sm-8">
                        <input type="text" name="hth4" value="<?= get_option('hth4'); ?>" placeholder="" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description 4</label>
                    <div class="col-sm-8">
                        <textarea name="hd4" class="form-control" rows=2><?= get_option('hd4'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Heading 5</label>
                    <div class="col-sm-8">
                        <input type="text" name="hth5" value="<?= get_option('hth5'); ?>" placeholder="" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description 5</label>
                    <div class="col-sm-8">
                        <textarea name="hd5" class="form-control" rows=2><?= get_option('hd5'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Heading 6</label>
                    <div class="col-sm-8">
                        <input type="text" name="hth6" value="<?= get_option('hth6'); ?>" placeholder="" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description 6</label>
                    <div class="col-sm-8">
                        <textarea name="hd6" class="form-control" rows=2><?= get_option('hd6'); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2">&nbsp;</label>
                    <div class="col-sm-5">
                        <input type="submit" name="submit" value="Save Settings" class="btn btn-primary btn-sm" />
                        <a href="<?= admin_url('settings/restore'); ?>" class="btn btn-sm btn-default reset">Restore Default</a>
                    </div>
                </div>
                <div class="box-footer">
                    <?php $str = '';
                    if(is_array($arr_default) && count($arr_default) > 0){
                        foreach($arr_default as $key => $val){
                            $str .= $key . ',';
                        }
                    }
                    $str = rtrim($str, ','); ?>
                    <input type="hidden" name="fields" value="<?= $str; ?>" />
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function(){
    $('.reset').click(function(){
        if(!confirm('It will RESET all values. Are you sure to proceed?'))
            return false;
    });
});
</script>
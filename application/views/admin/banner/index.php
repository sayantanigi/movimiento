<style>
  .form-control {
    margin-bottom: 15px;
  }
</style>
<!-- Main content -->
<section class="content-header">
  <h1>
    <?= $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border2">
          <h3 class="box-title">Banner Lists</h3>
          <a href="<?= admin_url('banner/add/') ?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add New</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tr>
              <th style="width: 10px">#</th>
              <th>Image</th>
              <th>Heading</th>
              <th>Sub Heading</th>
              <th>URL</th>
              <th>Date</th>
              <th>Status</th>
              <th>Actions</th>

            </tr>
            <?php
            if (!empty($banners)) {
              $i = 1;
              foreach ($banners as $banner) {
            ?>
                <tr>
                  <td><?= $i ?></td>
                  <td style="vertical-align: middle;">
											<?php if (@$banner->banner_image && file_exists('./uploads/banners/' . @$banner->banner_image)) {
											?>
												<img src="<?= base_url('uploads/banners/' . @$banner->banner_image) ?>" alt="" style="width: auto; max-height: 60px; padding: 1px; border: 2px solid #e87c03;">
											<?php } else { ?>
												<img src="<?= base_url('images/thumbs.jpg') ?>" alt="" style="width: auto; max-height: 52px; padding: 1px; border: 2px solid #e87c03;">
											<?php } ?>
                  </td>
                  <td><?= $banner->heading ?></td>
                  <td><?= $banner->sub_heading ?></td>
                  <td><?php if(@$banner->banner_url) {echo @$banner->banner_url; } else { echo"&#8212;"; } ?></td>

                  <td><?= date('d M Y', strtotime($banner->created_at)); ?></td>
                  


                  <td style="vertical-align: middle;">
                      <div class="checkbox checbox-switch switch-success">
                          <label>
                          <input type="checkbox" value="<?= @$banner->status ?>" <?= (@$banner->status == 1) ? 'checked="checked"' : ''; ?> onchange="changeBannerStatus(<?= @$banner->id ?>, $(this))">
                              <span></span>
                          </label>
                      </div>
										</td>

                   <td>
                      <div class="action-button">
                      
                        <a href="<?= admin_url('banner/add/' . $banner->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                        <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteBanner(<?= @$banner->id ?>)">
                          <i class="fa fa-trash"></i>
                        </button>
                      </div>
                    </td>
                </tr>

            <?php $i++; } } else { echo"<tr><td colspan='8' class='text-center red'><h3>No record available!</h3></td></tr>";} ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <?= $paginate ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    function deleteBanner(id) {
        swal({
            title: 'Are You sure want to delete this banner?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#36A1EA',
            cancelButtonColor: '#e50914',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            closeOnConfirm: true,
            closeOnCancel: true
        }, function(isConfirm) {
            if (isConfirm) {
                window.location.href = '<?= admin_url('banner/deleteBanner/') ?>' + id
            }
        });
    }
  </script>
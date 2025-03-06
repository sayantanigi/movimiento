<section class="content-header">
  <h1>
    <?= $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<section class="content-header">
  <?php $this->load->view('alert'); ?>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border33">
          <h3 class="box-title">Course Lists</h3>
          <a href="<?= admin_url('course/add_course') ?>" class="pull-right btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table">
            <tr>
              <th>Sl No.</th>
              <th>Image</th>
              <th>Title</th>
              <th>Description</th>
              <th>Price</th>
              <th>Status</th>
              <th>Module</th>
              <th>Course Material</th>
              <th>Action</th>
            </tr>
            <?php
            if (is_array($course) && count($course) > 0) {
              $i = 0;
              foreach ($course as $course_v) {
                $i++;
                if (@$course_v->image && file_exists('./assets/images/courses/' . @$course_v->image)) {
                  $image = base_url('assets/images/courses/' . @$course_v->image);
                } else {
                  $image = base_url('assets/images/no-image.png');
                }
                // $catt=$this->db->get_where('cr_category',array('id'=>$course_v->cat_id))->row();
            ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><img src="<?= @$image ?>" title="<?= $course_v->title ?>" style="width:60px; border:1px solid #ccc; padding:2px;"></td>
                  <td>
                    <div class="truncate"><?php if (@$course_v->title) {
                                            echo @$course_v->title;
                                          } else {
                                            echo "&#8212;";
                                          } ?></div>
                  </td>
                  <td>
                    <div class="truncate"><?= strip_tags($course_v->description) ?></div>
                  </td>
                  <td>$<?= number_format($course_v->price, 2) ?></td>
                  <td style="vertical-align: middle;">
                    <div class="checkbox checbox-switch switch-success">
                      <label>
                        <input type="checkbox" value="<?= @$course_v->status ?>" <?= (@$course_v->status == 1) ? 'checked="checked"' : ''; ?> onchange="changeCourseStatus(<?= @$course_v->id ?>, $(this))">
                        <span></span>
                      </label>
                    </div>
                  </td>
                  <td>
                    <a href="<?= admin_url('course/add_module/' . $course_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-plus"></span> Add </a>
                    <a href="<?= admin_url('course/module_list/' . $course_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-eye"></span> View </a>
                  </td>

                  <td>
                    <div class="action-button">
                      <a href="<?= admin_url('course/add_materials/' . $course_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-plus"></span> Add </a>
                      <a href="<?= admin_url('course/material_list/' . $course_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-eye"></span> View </a>
                    </div>
                  </td>

                  <td>

                    <div class="action-button">
                      <a href="<?= admin_url('course/add_course/' . $course_v->id) ?>" class="btn btn-xs btn-warning"><span class="fa fa-pencil"></span></a>
                      <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteCourse(<?= @$course_v->id ?>)">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>
                  </td>
                </tr>
            <?php
              }
            }
            ?>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <?= $paginate ?>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>

  <script>
    function deleteCourse(id) {
      swal({
        title: 'Are You sure want to delete this course?',
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
          window.location.href = '<?= admin_url('course/deleteCourse/') ?>' + id
        }
      });
    }
  </script>
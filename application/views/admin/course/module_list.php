<!-- Main content -->
<section class="content-header">
  <h1>
    <?= $title ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?= admin_url('course/course_list') ?>"> Course List</a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title" style="float: right;"><a href="<?= admin_url('course/add_module/' . @$course_id) ?>" class="btn btn-xs btn-info"><span class="fa fa-plus"></span> Add New</a></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <form action="<?= admin_url('course/save_module_pref/' . $this->uri->segment(4)) ?>" method="post" enctype="multipart/form-data">
            <table class="table table-striped" id="tblLocations">

              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Module Name</th>
                <th>Description</th>
                <th>Materials</th>
                <th>Action</th>
              </tr>

              <tbody class="row_position">
                <?php
                if (is_array($list) && count($list) > 0) {
                  $i = 1;
                  foreach ($list as $course_v) {
                    $crsnm = $this->db->get_where('courses', array('id' => $course_v->course_id))->row();

                    if (@$course_v->module_image && file_exists('./uploads/modules/' . @$course_v->module_image)) {
                      $image = base_url('./uploads/modules/' . @$course_v->module_image);
                    } else {
                      $image = base_url('assets/images/no-image.png');
                    }
                ?>
                    <tr id="<?php echo @$course_v->id ?>" class="draggable">
                      <td><?= $i ?></td>
                      <td><img src="<?= @$image ?>" style="width:35px; border:1px solid #ccc; padding:2px;"></td>
                      <td>
                        <div class="truncate_name"><?= $course_v->name ?></div> <input type="hidden" name="pref[]" value="<?= $course_v->id ?>">
                      </td>
                      <td>
                        <div class="truncate_desc"><?= strip_tags($course_v->module_descriptions) ?></div>
                      </td>
                      <td>
                        <a href="<?= admin_url('course/material_list/' . $this->uri->segment(4) . '/' . $course_v->id) ?>" class="btn btn-xs btn-info">Material Preference</a>
                      </td>
                      <td>
                        <div class="action-button">
                          <a href="<?= admin_url('course/update_module/' . @$course_id . '/' . $course_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                          <a href="<?= admin_url('course/delete_module/' . @$course_id . '/' . @$course_v->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                        </div>
                      </td>
                    </tr>
                  <?php
                    $i++;
                  }
                } else { ?>
                  <tr>
                    <td colspan="7">No Module Found!</td>
                  </tr>

                <?php  }
                ?>
              </tbody>

            </table>
            <!-- <button type="submit" class="btn btn-primary">Change Preffrence</button> -->
          </form>
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    </div>
  </div>

  <style>
    .draggable {
        cursor: all-scroll;
    }
  </style>


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>


  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/themes/smoothness/jquery-ui.css" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
  <script type="text/javascript">
    // $(function() {
    //   $("#tblLocations").sortable({
    //     items: 'tr:not(tr:first-child)',
    //     cursor: 'pointer',
    //     axis: 'y',
    //     dropOnEmpty: false,
    //     start: function(e, ui) {
    //       ui.item.addClass("selected");
    //     },
    //     stop: function(e, ui) {
    //       ui.item.removeClass("selected");
    //       $(this).find("tr").each(function(index) {
    //         if (index > 0) {
    //           $(this).find("td").eq(2).html(index);
    //         }
    //       });
    //     }
    //   });
    // });
  </script>
  

  <script type="text/javascript">
    $(".row_position").sortable({
      delay: 150,
      stop: function() {
        var selectedData = new Array();
        $('.row_position>tr').each(function() {
          selectedData.push($(this).attr("id"));
        });
        updateOrder(selectedData);
      }
    });


    function updateOrder(data) {
      $.ajax({
        url: '<?= admin_url('course/save_module_ordering/'.@$course_id) ?>',
        type: 'post',
        data: {
          position: data
        },
        success: function() {
          // location.reload();
          alert_func(["your change successfully saved!", "success", "#36A1EA"]);
          // alert('your change successfully saved');
        }
      })
    }
  </script>
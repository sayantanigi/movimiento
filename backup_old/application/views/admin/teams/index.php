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
            <div class="box-header with-border">
              <h3 class="box-title">Team Lists</h3>
              <!-- <a href="<?=admin_url('teams/add')?>" class="pull-right btn btn-primary">Add</a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Position</th>
                  <th>Description</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($products) && count($products)>0){
                    $i=1;
                    foreach ($products as $product) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><img src="<?=site_url('assets/images/teams/'.$product->img)?>" title="<?=$product->name?>" width="100px" onerror="this.src='<?=site_url('assets/images/no-image.png');?>';"></td>
                        <td><?=$product->name?></td>
                        <td><?=$product->desig?></td>
                        <td><?=$product->descr?></td>
                        <td>
                          <div class="action-button">
                            <a href="<?=admin_url('teams/add/'.$product->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('teams/delete/'.$product->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                          </div>
                        </td>
                      </tr>
                      <?php
                    $i++;
                    }
                  }
                ?>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <?=$paginate?>
              <!-- <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul> -->
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
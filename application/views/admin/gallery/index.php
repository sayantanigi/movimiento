
<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Partner List</h3>
              <a href="<?=admin_url('partner/add')?>" class="pull-right btn btn-primary"><span class="fa fa-plus"></span> Add</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">#</th>
                   <th>Image</th>
                  <th>Status</th>
                  <th style="width: 40px">Action</th>
                </tr>
                <?php
                  if(is_array($gallery) && count($gallery)>0){
                    $i=1;
                    foreach ($gallery as $gal) {
                      ?>
                      <tr>
                        <td><?=$i?></td>
                        <td><img src="<?=site_url('assets/images/gallery/'.@$gal->image)?>" title="<?=@$gal->name?>" width="80px" onerror="this.onerror=null;this.src='<?=site_url('assets/images/download.jpg');?>';"></td>
                        
                        <td>
                          <?php
                          if($gal->status == 1){
                            ?>
                            <a href="<?=admin_url('partner/deactivate/'.$gal->id)?>"><span class="badge bg-green">Active</span></a>
                            <?php
                          }
                          else{
                            ?>
                            <a href="<?=admin_url('partner/activate/'.$gal->id)?>"><span class="badge bg-red">Inactive</span></a>
                            <?php
                          }
                          ?>                          
                        </td>
                        <td>
                        	<div class="action-button">
                             <a href="<?=admin_url('partner/add/'.$gal->id)?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                            <a href="<?=admin_url('partner/delete/'.$gal->id)?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
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
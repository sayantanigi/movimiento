<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= admin_url('comminity/event_list') ?>"> Event List</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Community Event Lists</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="communityCat">
                        <thead>
                            <th>#</th>
                            <th>Event Title</th>
                            <th style="width:625px">Event Description</th>
                            <th>Event Date Time</th>
                            <th>Event Status</th>
                            <th>Action</th>
                        </thead>
                        <?php
                        if (is_array($event_list) && count($event_list) > 0) {
                        $i = 1;
                        foreach ($event_list as $event_list_v) {
                            $string = strip_tags($event_list_v['event_description']);
                            if (strlen($string) > 400) {
                                $stringCut = substr($string, 0, 400);
                                $endPoint = strrpos($stringCut, ' ');
                                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '    ....';
                            }
                        ?>
                        <tbody>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $event_list_v['event_title'] ?></td>
                                <td><?= $string ?></td>
                                <td>
                                    <?php
                                    $fromdateTime = $event_list_v['event_from_date']." ".$event_list_v['event_from_time'];
                                    $todateTime = $event_list_v['event_from_date']." ".$event_list_v['event_from_time'];
                                    echo "<p><b>From: </b>".date('d-m-Y h:i a', strtotime($fromdateTime ))."</p><p><b>To: </b>".date('d-m-Y h:i a', strtotime($todateTime ))."</p>";
                                    ?>
                                </td>
                                <td>
                                    <?php if ($event_list_v['event_status'] == 1) { ?>
                                    <a href="<?= admin_url('community/eventdeactivate/'.$event_list_v['community_id'].'/'.$event_list_v['id']) ?>"><span class="badge bg-green">Active</span></a>
                                    <?php } else { ?>
                                    <a href="<?= admin_url('community/eventactivate/'.$event_list_v['community_id'].'/'.$event_list_v['id']) ?>"><span class="badge bg-red">Inactive</span></a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?= admin_url('community/add_event/'.$event_list_v['community_id'].'/'.$event_list_v['id']) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <button class="btn btn-xs btn-danger" style="margin-left: 5px;" title="Delete" data-toggle="tooltip" onclick="deleteCategory(<?= @$event_list_v['community_id'] ?>,<?= @$event_list_v['id'] ?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php $i++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function deleteCategory(comm_id, id) {
    swal({
        title: 'Are you sure want to delete this category?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#36A1EA',
        cancelButtonColor: '#e50914',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            window.location.href = '<?= admin_url('community/eventdelete/') ?>'+comm_id+'/'+ id;
        }
    });
}
</script>
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content-header">
    <?php $this->load->view('alert'); ?>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <th>Sl No.</th>
                            <th>TXN ID</th>
                            <th>Course Name</th>
                            <th>Purchased By</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Enrollment Date</th>
                        </tr>
                        <?php
                        if (is_array($course_order_details) && count($course_order_details) > 0) {
                        $i = 0;
                        foreach ($course_order_details as $course) {
                        $i++;
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $course['transaction_id']?></td>
                            <td>
                                <?php $order_item = $this->db->query("SELECT * FROM courses WHERE id = '".$course['course_id']."'")->row(); 
                                echo $order_item->title; ?>
                            </td>
                            <td>
                            <?php 
                            $getUserdata = $this->db->query("SELECT fname, lname FROM users WHERE id = '".$course['user_id']."'")->row(); 
                            echo $getUserdata->fname." ".$getUserdata->lname;
                            ?>
                            </td>
                            <td>
                                <?php if($course['price_cents'] > 0) {
                                    echo "$".$course['price_cents'];
                                } else {
                                    echo "Free"; 
                                } ?></td>
                            <td><?= $course['payment_status']?></td>
                            <td><?= date('d-m-Y', strtotime($course['enrollment_date'])) ?></td>
                        </tr>
                        <?php } } ?>
                    </table>
                </div>
                <div class="box-footer clearfix"><?= $paginate ?></div>
            </div>
        </div>
    </div>
</section>
<style>
.modal-title {width: 90%;display: inline-block;}
.modal-close {background: none;border: none;float: right;}
</style>
<script>
function deleteProduct(id) {
    swal({
        title: 'Are You sure want to delete this product?',
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
            window.location.href = '<?= admin_url('products/delete/') ?>' + id
        }
    });
}
</script>
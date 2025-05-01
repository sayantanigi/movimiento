    <footer class="footer">
          <div class="container-fluid">
             <div class="row">
                <div class="col-sm-12">
                   <div class="text-sm-end d-sm-block">
                      &copy; <?=date('Y')?> Goigi. All Rights Reserved.
                   </div>
                </div>
             </div>
          </div>
       </footer>
    </div>
</div>
<div class="rightbar-overlay"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url()?>assets/plugins/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url()?>assets/plugins/simplebar/simplebar.min.js"></script>
<script src="<?= base_url()?>assets/plugins/node-waves/waves.min.js"></script>
<script src="<?= base_url()?>assets/plugins/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url()?>assets/plugins/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url()?>assets/plugins/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url()?>assets/plugins/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="<?= base_url()?>assets/plugins/jasny-bootstrap/jasny-bootstrap.min.js"></script>
<script src="<?= base_url()?>assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?= base_url()?>assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= base_url()?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url()?>assets/js/owl.carousel.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>assets/dist/js/pages/datatables.init.js"></script>
<script src="<?= base_url()?>assets/dist/js/app.js"></script>
<script src="<?= base_url()?>assets/plugins/summernote/summernote-lite.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/jquery.blockUI.js"></script>
<script src="<?= base_url('assets/dist/js/script.js?v=').time() ?>"></script>
<?php if (!empty($this->session->flashdata('msg'))): ?>
<?php if ($this->session->flashdata('msg') == 'error') { ?>
<script>
   alert_func(["Some error occured, Please try again!", "error", "#DD6B55"]);
</script>
<?php } else { ?>
<script>
   alert_func(<?= $this->session->flashdata('msg') ?>);
</script>
<?php } ?>
<?php 
 $this->session->unset_userdata('msg');
endif ?>
 </body>
</html>
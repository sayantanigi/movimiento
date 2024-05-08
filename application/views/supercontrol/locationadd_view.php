<?php //$this->load->view ('header');?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
$(function() {
setTimeout(function() { $("#testdiv").fadeOut(1500); }, 5000)
$('#btnclick').click(function() {
$('#testdiv').show();
setTimeout(function() { $("#testdiv").fadeOut(1500); }, 5000)
})
})
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.datetimepicker.css"/>
<style type="text/css">
.custom-date-style {
	background-color: red !important;
}
.input {
}
.input-wide {
	width: 500px;
}
</style>
<div class="page-container">
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <?php $this->load->view ('supercontrol/leftbar');?>
    </div>
  </div>
  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>supercontrol panel</span> </li>
        </ul>
      </div>
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
        <?php 
				$last = end($this->uri->segments); 
				if($last=="success"){echo "Data Added Successfully ......";}
				if($last=="successdelete"){echo "Data Deleted Successfully ......";}
            ?>
        </strong> </div>
      <div class="row">
        <?php if($this->session->flashdata('add_message')!=''){?>
        <div class="alert alert-success1" style="background-color:#98E0D5;">
          <button type="button" class="close" data-dismiss="alert">&#10006;</button>
          <strong style="color:#063;"><?php echo @$this->session->flashdata('add_message');?></strong> </div>
        <?php }?>
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Add Location</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form"> 
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url().'supercontrol/location/add_location' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                      <div class="form-body">
                        <div class="form-group">
                          <label class="control-label col-md-3">Location Name</label>
                          <div class="col-md-8">
                            <input type="text" class="form-control" id="location_name" value="" name="location_name">
                          </div>
                        </div>
                        <?php echo form_error('location_name'); ?>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course Country *</label>
                        </b>
                        <div class="col-md-8">
                          
                          <select name="course_country"  onchange="cityget(this);" class="form-control">
                              <option>-- Select Country --</option>
                              <?php if(is_array($categories) && count($categories)>0){
                                    foreach($categories as $cs){
                               ?>
                              <option value="<?=$cs->id?>"><?=$cs->country_name?></option>
                              <?php }} ?>
                            </select>
                          <label id="errorBox"></label>
                        </div>
                      </div>
                      <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course City*</label>
                        </b>
                        <div class="col-md-8">
                          <select class="form-control" id="cityShow" name="city_name">
                            <option>-- Select City --</option>
                        </select>
                          <label id="errorBox"></label>
                        </div>
                      </div>
                        
                        <div class="form-group">
                          <label class="control-label col-md-3">Address</label>
                          <div class="col-md-8">
                            <input type="text" required="" class="form-control" id="hour_no" value="" name="location_address" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3">TelePhone Number</label>
                          <div class="col-md-8">
                            <input type="text" required="" class="form-control"  value="" name="location_telephone_number" >
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-md-3">Currency</label>
                          <div class="col-md-8">
                            <input type="text" required="" class="form-control" id="hour_no" value="" name="location_currency">
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-md-3">Direction</label>
                          <div class="col-md-8">
                            <input type="text" required="" class="form-control" id="hour_no" value="" name="location_direction">
                          </div>
                        </div> 

                        <div class="form-group">
                          <label class="control-label col-md-3">Opening Hours</label>
                          <div class="col-md-8">
                            <input type="text" required="" class="form-control" id="hour_no" value="" name="location_opening_hours" >
                          </div>
                        </div> 


                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9"> 
                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                            <button type="button" class="btn default">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <script src="<?php echo base_url(); ?>js/jquery.js"></script> 
                    <script src="<?php echo base_url(); ?>js/jquery.datetimepicker.full.js"></script> 
                    <script>

$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015-04-15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
format:'d-m-Y H:i',
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
$('#datetimepicker19').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker19').datetimepicker({value:'2015/04/15 05:03',step:10});


$('.some_class').datetimepicker();

$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	formatDate:'d.m.Y',
    	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});

$('#datetimepicker10').datetimepicker({
	step:5,
	inline:true
});
$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});

$('#datetimepicker1').datetimepicker({
	datepicker:false,
	format:'H:i',
	step:5
});
$('#datetimepicker2').datetimepicker({
	format:'d-m-Y',
	timepicker:false,
	formatDate:'d-m-Y',
	minDate:'-2016/11/03', // yesterday is minimum date
});
$('#datetimepicker2e').datetimepicker({
	format:'d-m-Y',
	timepicker:false,
	formatDate:'d-m-Y',
	minDate:'-2016/11/03', // yesterday is minimum date
});
$('#datetimepicker3').datetimepicker({
	inline:true
});
$('#datetimepicker4').datetimepicker();
$('#open').click(function(){
	$('#datetimepicker4').datetimepicker('show');
});
$('#close').click(function(){
	$('#datetimepicker4').datetimepicker('hide');
});
$('#reset').click(function(){
	$('#datetimepicker4').datetimepicker('reset');
});
$('#datetimepicker5').datetimepicker({
	datepicker:false,
	allowTimes:['12:00','13:00','15:00','17:00','17:05','17:20','19:00','20:00'],
	step:5
});
$('#datetimepicker6').datetimepicker();
$('#destroy').click(function(){
	if( $('#datetimepicker6').data('xdsoft_datetimepicker') ){
		$('#datetimepicker6').datetimepicker('destroy');
		this.value = 'create';
	}else{
		$('#datetimepicker6').datetimepicker();
		this.value = 'destroy';
	}
});
var logic = function( currentDateTime ){
	if (currentDateTime && currentDateTime.getDay() == 6){
		this.setOptions({
			minTime:'11:00'
		});
	}else
		this.setOptions({
			minTime:'8:00'
		});
};
$('#datetimepicker7').datetimepicker({
	onChangeDateTime:logic,
	onShow:logic
});
$('#datetimepicker8').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date')
			.toggleClass('xdsoft_disabled');
	},
	minDate:'-1970/01/2',
	maxDate:'+1970/01/2',
	timepicker:false
});
$('#datetimepicker9').datetimepicker({
	onGenerate:function( ct ){
		$(this).find('.xdsoft_date.xdsoft_weekend')
			.addClass('xdsoft_disabled');
	},
	weekends:['01.01.2014','02.01.2014','03.01.2014','04.01.2014','05.01.2014','06.01.2014'],
	timepicker:false
});
var dateToDisable = new Date();
	dateToDisable.setDate(dateToDisable.getDate() + 2);
$('#datetimepicker11').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [false, ""]
		}

		return [true, ""];
	}
});
$('#datetimepicker12').datetimepicker({
	beforeShowDay: function(date) {
		if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
			return [true, "custom-date-style"];
		}

		return [true, ""];
	}
});
$('#datetimepicker_dark').datetimepicker({theme:'dark'})

	function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
					return false;
			}
			return true;
	}

</script> 


<script>
    function cityget(sl){
        var  id = sl.value;
        if(id==''){
            jQuery('#cityShow').html('<option>--Select Course--</option>');
            return false;
        }
        jQuery.ajax({
       url: '<?=site_url('courses/getCity');?>',
       type: 'POST',
       dataType: 'html',
       data: {id:id},
       })
       .done(function(e) {
           jQuery('#cityShow').html(e);
       });
    }
</script>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php //$this->load->view ('footer');?>

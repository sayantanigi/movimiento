<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery.datetimepicker.css"/>
<?php //$this->load->view ('header');?>
<!-- BEGIN CONTAINER -->

<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
      <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
      <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
      <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
      <?php $this->load->view ('supercontrol/leftbar');?>
      <!-- END SIDEBAR MENU -->
      <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <!-- BEGIN PAGE HEADER-->
      <!-- BEGIN THEME PANEL -->
      <!-- END THEME PANEL -->
      <!-- BEGIN PAGE BAR -->
      <div class="page-bar">
        <ul class="page-breadcrumb">
          <li> <a href="">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Admin Panel</span> </li>
        </ul>
        <div class="page-toolbar">
          <div class="btn-group pull-right">
            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions <i class="fa fa-angle-down"></i> </button>
            <ul class="dropdown-menu pull-right" role="menu">
              <li> <a href="#"> <i class="icon-bell"></i> Action</a> </li>
              <li> <a href="#"> <i class="icon-shield"></i> Another action</a> </li>
              <li> <a href="#"> <i class="icon-user"></i> Something else here</a> </li>
              <li class="divider"> </li>
              <li> <a href="#"> <i class="icon-bag"></i> Separated link</a> </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <!-- END PAGE TITLE-->
      <!-- END PAGE HEADER-->
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
        <?php 
				if(@$success_msg!=''){echo @$success_msg;}
				
            ?>
        </strong> </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Edit Property</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($ecms as $i){?>
                    <form action="<?php echo base_url()?>supercontrol/property/edit_property" method="post" enctype="multipart/form-data" class="form-horizontal">
                      <input type="hidden" name="id" id="id" value="<?php echo $i->id?>">
						<?php
                        //form validation
                        echo validation_errors();
                        ?>
                      <div class="form-body">
                        
                        
                        <div class="form-group">
                                                            <b> <label class="col-md-3 control-label">Proeprty Type *</label> </b>
                                                            <div class="col-md-8">
                                                                 <select name="pid" id="property_type" class="form-control" >
                                                                    <option value="">Choose Product Type</option>
                                                                   <?php
                                                                        
                                                                        foreach($ecat as $a){
                                                                        ?>
                                                                    <option value="<?php echo $a->property_type_id; ?>" <?php if($a->property_type_id==$i->pid){?> selected="selected" <?php }?>><?php echo $a->property_type_title?></option>
                                                                    <?php } ?>
                                                                 </select>
                                                                 <label id="errorBox"></label>
                                                            </div>
                                                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Property Name</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->Property_name?>" name="Property_name" class="form-control" placeholder="Property Name" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                                                            <b> <label class="col-md-3 control-label">Country *</label> </b>
                                                            <div class="col-md-8">
                                                                 <select name="country_id" id="" class="form-control" >
                                                                    <option value="">Choose Country</option>
																   <?php
                                                                        foreach($conuntry as $ct){
                                                                     ?>
                                                                    <option <?php if($i->country_id == $ct->country_id){?> selected="selected" <?php }?> value="<?php echo $ct->country_id;?>"><?php echo $ct->country_name;?></option>
                                                                    <?php } ?>
                                                                 </select>
                                                                
                                                            </div>
                                                        </div>
                        
                        
                       
                       <div class="form-group">
                          <label class="col-md-3 control-label">City</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->city_id?>" name="city_id" class="form-control" placeholder="City" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                         <div class="form-group">
                          <label class="col-md-3 control-label">Location</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->address?>" name="address" class="form-control" placeholder="Location" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Room</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->room?>" name="room" class="form-control" placeholder="Room" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Monthly Rent (For Rent)</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->monthly_rent?>" name="monthly_rent" class="form-control" placeholder="Monthly Rent" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Maintenance Charge (For Rent)</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->maintenance_charge?>" name="maintenance_charge" class="form-control" placeholder="Maintenance Charge" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Available From (For Rent)</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->available_from?>" name="available_from" id="datetimepicker2" class="form-control"  onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                       
                         <div class="form-group">
                          <label class="col-md-3 control-label">Carpet Area </label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->carpet_area?>" name="carpet_area" class="form-control" placeholder="Carpet Area" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Per Unit Price $</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->per_unit_price?>" name="per_unit_price" class="form-control" placeholder="Per Unit Price" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Price $</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->price?>" name="price" class="form-control" placeholder="Price" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Bedroom</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->bedroom?>" name="bedroom" class="form-control" placeholder="Bedroom" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                         <div class="form-group">
                          <label class="col-md-3 control-label">Bathroom</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->bathroom?>" name="bathroom" class="form-control" placeholder="Bathroom" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Garage</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->garage?>" name="garage" class="form-control" placeholder="Garage" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Property Sqft</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->property_sqft?>" name="property_sqft" class="form-control" placeholder="Property Sqft" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label">Floor</label>
                          <div class="col-md-8">
                            <input type="text" value="<?php echo $i->floor?>" name="floor" class="form-control" placeholder="Floor" onkeyup="leftTrim(this)" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                    <label class="control-label col-md-3">property Map<br> <span style="color:#F00;font-size:10px;"></span></label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="map" rows="6" id="map"><?php echo $i->map;?></textarea>
                    </div>
                  </div>
                        
                        <div class="form-group">
                          <label class="col-md-3 control-label">Description</label>
                          <div class="col-md-8">
                            <textarea class="form-control" name="description" id="pagedes" rows="8" cols="16" id="cms_pagedes"><?php echo $i->description?></textarea>
                          </div>
                        </div>
                       
                      <div class="form-actions top">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="<?php echo base_url()?>supercontrol/property/show_Property">
                            <button type="button" class="btn default">Cancel</button>
                            </a> </div>
                        </div>
                      </div>
                    </form>
                    <?php }?>
                    <!-- END FORM-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->
  <!-- BEGIN QUICK SIDEBAR -->
  <!-- END QUICK SIDEBAR -->
</div>
<script>
function leftTrim(element){
if(element)
element.value=element.value.replace(/^\s+/,"");
}
</script>
<script src="<?php echo base_url()?>assets/jquery.js"></script>
<script src="<?php echo base_url()?>assets/build/jquery.datetimepicker.full.js"></script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/

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
	//defaultDate:'8.12.1986', // it's my birthday
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


</script>
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>

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
   label {
   width: 125px;
   display: block;
   float: left;
   }
   label input {
   display: none;
   }
   label span {
   display: block;
   width: 17px;
   height: 17px;
   border: 1px solid black;
   float: left;
   margin: 0 5px 0 0;
   position: relative;
   }
   label.active span:after {
   content: " ";
   position: absolute;
   left: 3px;
   right: 3px;
   top: 3px;
   bottom: 3px;
   background: black;
   }
   .topul li {
   list-style-type:none;
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
               <li> <a href="<?php echo base_url(); ?>supercontrol/user/dashboard">Home</a> <i class="fa fa-circle"></i> </li>
               <li> <span>Admin panel</span> </li>
            </ul>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="tabbable-line boxless tabbable-reversed">
                  <div class="tab-content">
                     <div class="tab-pane active" id="tab_0">
                        <div class="portlet box blue-hoki">
                           <div class="portlet-title">
                              <div class="caption"> <i class="fa fa-gift"></i>ADD TIME TABLE</div>
                              <div class="tools"> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                           </div>
                           <div class="portlet-body form">
                              <!-- BEGIN FORM-->
                              <form action="<?php echo base_url().'supercontrol/batch/add'?>" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="check()">
                                 <div class="form-body">
                                    <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Total Session *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="text" class="form-control" id="total_session"  value="" name="total_session" required>
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <b>
                                       <label class="col-md-3 control-label">Total hours *</label>
                                       </b>
                                       <div class="col-md-8">
                                          <input type="text" class="form-control"  value="" name="total_hour" required="required">
                                          <label id="errorBox"></label>
                                       </div>
                                    </div>
                                    <div id="startdate"></div>
                                 </div>
                                 <div class="form-actions">
                                    <div class="row">
                                       <div class="col-md-offset-3 col-md-9">
                                           <input type="hidden" name="courseId" value="<?php echo end($this->uri->segment_array());?>" />
                                          <input type="submit" id="submit" value="Submit" class="btn red">
                                       </div>
                                    </div>
                                 </div>
                              </form>
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
    startDate:  '1986/01/05'
   });
   $('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
   
   
   
   $('#datetimepicker19').datetimepicker({
    dayOfWeekStart : 1,
    lang:'en',
    disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
    startDate:  '1986/01/05'
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
   
   $('#timepicker1').datetimepicker({
    datepicker:false,
    format:'H:i',
    step:5
   });
   $('#timepicker2').datetimepicker({
    datepicker:false,
    format:'H:i',
    step:5
   });
   $('#datetimepicker2').datetimepicker({
    format:'d-m-Y',
    timepicker:false,
    formatDate:'d-m-Y',
    minDate:'-2016/11/03', 
   });
   $('#datetimepicker2e').datetimepicker({
    format:'d-m-Y',
    timepicker:false,
    formatDate:'d-m-Y',
    minDate:'-2016/11/03', 
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
      return [false, ""];
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
<script>
   $(document).ready(function() {
      $('#total_session').on("focusout",function(){
         var val = $(this).val();
         var html = '';
         for(var i=1; i<=val; i++){
            var html = '<div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Date *</label></b><div class="col-md-8"><input type="date" name="date[]" id="timepicker1"  class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Start Time *</label></b><div class="col-md-8"><input type="time" name="startTime[]" id="timepicker1"  class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' End Time *</label></b><div class="col-md-8"><input type="time" name="endTime[]" id="timepicker1"  class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Time Type *</label></b><div class="col-md-8"><input type="text" name="time_type[]"   class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Session Objective *</label></b><div class="col-md-8"><input type="text" name="session_objective[]"   class="form-control" /><label id="errorBox"></label></div></div><div class="form-group"><b><label class="col-md-3 control-label">Session'+i+' Location *</label></b><div class="col-md-8"><select name="session_location[]" class="form-control"><option>-- Select Location --</option><?php if(is_array($locations) && count($locations)>0){foreach($locations as $ls){ ?>
              <option value="<?=$ls->id?>"><?=$ls->location_name?></option> <?php }} ?></select><label id="errorBox"></label></div></div>';
         $('#startdate').append(html);
         }
         console.log(html);
      });
   });
   
</script>
<script>
    function cityget(sl,j){
        var  id = sl.value;
        
        if(id==''){
            jQuery('#cityShow'+j).html('<option>--Select Course--</option>');
            return false;
        }
        jQuery.ajax({
       url: '<?=site_url('courses/getCity');?>',
       type: 'POST',
       dataType: 'html',
       data: {id:id},
       })
       .done(function(e) {
           jQuery('#cityShow'+j).html(e);
       });
    }
</script>

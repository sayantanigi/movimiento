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
<div class="page-container">
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <?php $this->load->view ('supercontrol/leftbar');?>
    </div>
  </div>
  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="page-bar">
        <ul class="page-breadcrumb"> <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i> </li>
          <li> <span>Supercontrol panel</span> </li>
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
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Add users</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                  <!-- action="<?php echo base_url().'supercontrol/users/edit_users' ?>" -->
                    <!-- BEGIN FORM-->
                    <?php foreach($eusr as $ur) {?>
                    <form class="form-horizontal form-bordered" action="<?php echo base_url().'supercontrol/users/edit_users' ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="uid" value="<?=$ur->uid;?>">
                <input type="hidden" name="profileimage" value="<?php echo $ur->image;?>">
                    <div class="form-body">
                    
                        <div class="form-group last">
                        <label class="control-label col-md-3">User Image</label>
                        <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                           
                                    <img src="<?php echo base_url(); ?>uploads/propic/<?php echo $ur->image; ?>" alt="" style="width:200px; height:150px;"/> 
                                    </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                <div>
                                    <span class="btn default btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <!--<input type="file" name="...">-->
											<?php
                                            $file = array('type' => 'file','name' => 'userfile' ,'id' => 'chkimg' ,'onchange' => 'readURL(this);');
                                            echo form_input($file);
                                            ?>
                                    </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                            <div class="clearfix margin-top-10">
                                <span class="label label-danger">Format</span> jpg, jpeg, png, gif </div>
                        </div>
                        </div>
                        
                        
                    <div class="form-group">
                    <label class="control-label col-md-3"> First Name</label>
                    <div class="col-md-8">
                    <input type="text" name="first_name" class="form-control" value="<?php echo $ur->first_name?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Last Name</label>
                    <div class="col-md-8"> 
                    <input type="text" name="last_name" class="form-control" value="<?php echo $ur->last_name?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Email</label>
                    <div class="col-md-8">
                    <input type="email" name="email" class="form-control" value="<?php echo $ur->email?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Password </label>
                    <div class="col-md-8">
                    <input type="password" name="password" class="form-control" value="<?php echo base64_decode($ur->password);?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Phone</label>
                    <div class="col-md-8">
                    <input type="text" name="phone" class="form-control" value="<?php echo $ur->phone?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <b><label class="control-label col-md-3"> Time Zone</label></b>
                    <div class="col-md-8">
                    <select id="time_zone" name="time_zone" class="form-control">
                    <option value="">Select</option>
                    <option value="Perth" <?php if($ur->time_zone=="Perth"){?> selected="selected" <?php }?>>(GMT+08:00) Perth</option>
                    <option value="Adelaide" <?php if($ur->time_zone=="Adelaide"){?> selected="selected" <?php }?>>(GMT+09:30) Adelaide</option>
                    <option value="Darwin" <?php if($ur->time_zone=="Darwin"){?> selected="selected" <?php }?>>(GMT+09:30) Darwin</option>
                    <option value="Brisbane" <?php if($ur->time_zone=="Brisbane"){?> selected="selected" <?php }?>>(GMT+10:00) Brisbane</option>
                    <option value="Canberra" <?php if($ur->time_zone=="Canberra"){?> selected="selected" <?php }?>>(GMT+10:00) Canberra</option>
                    <option value="Hobart" <?php if($ur->time_zone=="Hobart"){?> selected="selected" <?php }?>>(GMT+10:00) Hobart</option>
                    <option value="Melbourne" <?php if($ur->time_zone=="Melbourne"){?> selected="selected" <?php }?>>(GMT+10:00) Melbourne</option>
                    <option value="Sydney" <?php if($ur->time_zone=="Sydney"){?> selected="selected" <?php }?>>(GMT+10:00) Sydney</option>
                    <option value="American Samoa" <?php if($ur->time_zone=="American Samoa"){?> selected="selected" <?php }?>>(GMT-11:00) American Samoa</option>
                    <option value="International Date Line West" <?php if($ur->time_zone=="International Date Line West"){?> selected="selected" <?php }?>>(GMT-11:00) International Date Line West</option>
                    <option value="Midway Island" <?php if($ur->time_zone=="Midway Island"){?> selected="selected" <?php }?>>(GMT-11:00) Midway Island</option>
                    <option value="Samoa" <?php if($ur->time_zone=="Samoa"){?> selected="selected" <?php }?>>(GMT-11:00) Samoa</option>
                    <option value="Hawaii" <?php if($ur->time_zone=="Hawaii"){?> selected="selected" <?php }?>>(GMT-10:00) Hawaii</option>
                    <option value="Alaska" <?php if($ur->time_zone=="Alaska"){?> selected="selected" <?php }?>>(GMT-09:00) Alaska</option>
                    <option value="Pacific Time (US &amp; Canada)" <?php if($ur->time_zone=="Pacific Time (US &amp; Canada)"){?> selected="selected" <?php }?>>(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                    <option value="Tijuana" <?php if($ur->time_zone=="Tijuana"){?> selected="selected" <?php }?>>(GMT-08:00) Tijuana</option>
                    <option value="Arizona" <?php if($ur->time_zone=="Arizona"){?> selected="selected" <?php }?>>(GMT-07:00) Arizona</option>
                    <option value="Chihuahua" <?php if($ur->time_zone=="Chihuahua"){?> selected="selected" <?php }?>>(GMT-07:00) Chihuahua</option>
                    <option value="Mazatlan" <?php if($ur->time_zone=="Mazatlan"){?> selected="selected" <?php }?>>(GMT-07:00) Mazatlan</option>
                    <option value="Mountain Time (US &amp; Canada)" <?php if($ur->time_zone=="Mountain Time (US &amp; Canada)"){?> selected="selected" <?php }?>>(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                    <option value="Central America" <?php if($ur->time_zone=="Central America"){?> selected="selected" <?php }?>>(GMT-06:00) Central America</option>
                    <option value="Central Time (US &amp; Canada)" <?php if($ur->time_zone=="Central Time (US &amp; Canada)"){?> selected="selected" <?php }?>>(GMT-06:00) Central Time (US &amp; Canada)</option>
                    <option value="Guadalajara" <?php if($ur->time_zone=="Guadalajara"){?> selected="selected" <?php }?>>(GMT-06:00) Guadalajara</option>
                    <option value="Mexico City" <?php if($ur->time_zone=="Mexico City"){?> selected="selected" <?php }?>>(GMT-06:00) Mexico City</option>
                    <option value="Monterrey" <?php if($ur->time_zone=="Monterrey"){?> selected="selected" <?php }?>>(GMT-06:00) Monterrey</option>
                    <option value="Saskatchewan" <?php if($ur->time_zone=="Saskatchewan"){?> selected="selected" <?php }?>>(GMT-06:00) Saskatchewan</option>
                    <option value="Bogota" <?php if($ur->time_zone=="Bogota"){?> selected="selected" <?php }?>>(GMT-05:00) Bogota</option>
                    <option value="Eastern Time (US &amp; Canada)" <?php if($ur->time_zone=="Eastern Time (US &amp; Canada)"){?> selected="selected" <?php }?>>(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                    <option value="Indiana (East)" <?php if($ur->time_zone=="Indiana (East)"){?> selected="selected" <?php }?>>(GMT-05:00) Indiana (East)</option>
                    <option value="Lima" <?php if($ur->time_zone=="Lima"){?> selected="selected" <?php }?>>(GMT-05:00) Lima</option>
                    <option value="Quito" <?php if($ur->time_zone=="Quito"){?> selected="selected" <?php }?>>(GMT-05:00) Quito</option>
                    <option value="Atlantic Time (Canada)" <?php if($ur->time_zone=="Atlantic Time (Canada)"){?> selected="selected" <?php }?>>(GMT-04:00) Atlantic Time (Canada)</option>
                    <option value="Caracas" <?php if($ur->time_zone=="Caracas"){?> selected="selected" <?php }?>>(GMT-04:00) Caracas</option>
                    <option value="Georgetown" <?php if($ur->time_zone=="Georgetown"){?> selected="selected" <?php }?>>(GMT-04:00) Georgetown</option>
                    <option value="La Paz" <?php if($ur->time_zone=="La Paz"){?> selected="selected" <?php }?>>(GMT-04:00) La Paz</option>
                    <option value="Santiago" <?php if($ur->time_zone=="Santiago"){?> selected="selected" <?php }?>>(GMT-04:00) Santiago</option>
                    <option value="Newfoundland" <?php if($ur->time_zone=="Newfoundland"){?> selected="selected" <?php }?>>(GMT-03:30) Newfoundland</option>
                    <option value="Brasilia" <?php if($ur->time_zone=="Brasilia"){?> selected="selected" <?php }?>>(GMT-03:00) Brasilia</option>
                    <option value="Buenos Aires" <?php if($ur->time_zone=="Buenos Aires"){?> selected="selected" <?php }?>>(GMT-03:00) Buenos Aires</option>
                    <option value="Greenland" <?php if($ur->time_zone=="Greenland"){?> selected="selected" <?php }?>>(GMT-03:00) Greenland</option>
                    <option value="Montevideo" <?php if($ur->time_zone=="Montevideo"){?> selected="selected" <?php }?>>(GMT-03:00) Montevideo</option>
                    <option value="Mid-Atlantic" <?php if($ur->time_zone=="Mid-Atlantic"){?> selected="selected" <?php }?>>(GMT-02:00) Mid-Atlantic</option>
                    <option value="Azores" <?php if($ur->time_zone=="Azores"){?> selected="selected" <?php }?>>(GMT-01:00) Azores</option>
                    <option value="Cape Verde Is." <?php if($ur->time_zone=="Cape Verde Is."){?> selected="selected" <?php }?>>(GMT-01:00) Cape Verde Is.</option>
                    <option value="Casablanca" <?php if($ur->time_zone=="Casablanca"){?> selected="selected" <?php }?>>(GMT+00:00) Casablanca</option>
                    <option value="Dublin" <?php if($ur->time_zone=="Dublin"){?> selected="selected" <?php }?>>(GMT+00:00) Dublin</option>
                    <option value="Edinburgh" <?php if($ur->time_zone=="Edinburgh"){?> selected="selected" <?php }?>>(GMT+00:00) Edinburgh</option>
                    <option value="Lisbon" <?php if($ur->time_zone=="Lisbon"){?> selected="selected" <?php }?>>(GMT+00:00) Lisbon</option>
                    <option value="London" <?php if($ur->time_zone=="London"){?> selected="selected" <?php }?>>(GMT+00:00) London</option>
                    <option value="Monrovia" <?php if($ur->time_zone=="Monrovia"){?> selected="selected" <?php }?>>(GMT+00:00) Monrovia</option>
                    <option value="UTC" <?php if($ur->time_zone=="UTC"){?> selected="selected" <?php }?>>(GMT+00:00) UTC</option>
                    <option value="Amsterdam" <?php if($ur->time_zone=="Amsterdam"){?> selected="selected" <?php }?>>(GMT+01:00) Amsterdam</option>
                    <option value="Belgrade" <?php if($ur->time_zone=="Belgrade"){?> selected="selected" <?php }?>>(GMT+01:00) Belgrade</option>
                    <option value="Berlin" <?php if($ur->time_zone=="Berlin"){?> selected="selected" <?php }?>>(GMT+01:00) Berlin</option>
                    <option value="Bern" <?php if($ur->time_zone=="Bern"){?> selected="selected" <?php }?>>(GMT+01:00) Bern</option>
                    <option value="Bratislava" <?php if($ur->time_zone=="Bratislava"){?> selected="selected" <?php }?>>(GMT+01:00) Bratislava</option>
                    <option value="Brussels" <?php if($ur->time_zone=="Brussels"){?> selected="selected" <?php }?>>(GMT+01:00) Brussels</option>
                    <option value="Budapest" <?php if($ur->time_zone=="Budapest"){?> selected="selected" <?php }?>>(GMT+01:00) Budapest</option>
                    <option value="Copenhagen" <?php if($ur->time_zone=="Copenhagen"){?> selected="selected" <?php }?>>(GMT+01:00) Copenhagen</option>
                    <option value="Ljubljana" <?php if($ur->time_zone=="Ljubljana"){?> selected="selected" <?php }?>>(GMT+01:00) Ljubljana</option>
                    <option value="Madrid" <?php if($ur->time_zone=="Madrid"){?> selected="selected" <?php }?>>(GMT+01:00) Madrid</option>
                    <option value="Paris" <?php if($ur->time_zone=="Paris"){?> selected="selected" <?php }?>>(GMT+01:00) Paris</option>
                    <option value="Prague" <?php if($ur->time_zone=="Prague"){?> selected="selected" <?php }?>>(GMT+01:00) Prague</option>
                    <option value="Rome" <?php if($ur->time_zone=="Rome"){?> selected="selected" <?php }?>>(GMT+01:00) Rome</option>
                    <option value="Sarajevo" <?php if($ur->time_zone=="Sarajevo"){?> selected="selected" <?php }?>>(GMT+01:00) Sarajevo</option>
                    <option value="Skopje" <?php if($ur->time_zone=="Skopje"){?> selected="selected" <?php }?>>(GMT+01:00) Skopje</option>
                    <option value="Stockholm" <?php if($ur->time_zone=="Stockholm"){?> selected="selected" <?php }?>>(GMT+01:00) Stockholm</option>
                    <option value="Vienna" <?php if($ur->time_zone=="Vienna"){?> selected="selected" <?php }?>>(GMT+01:00) Vienna</option>
                    <option value="Warsaw" <?php if($ur->time_zone=="Warsaw"){?> selected="selected" <?php }?>>(GMT+01:00) Warsaw</option>
                    <option value="West Central Africa" <?php if($ur->time_zone=="West Central Africa"){?> selected="selected" <?php }?>>(GMT+01:00) West Central Africa</option>
                    <option value="Zagreb" <?php if($ur->time_zone=="Zagreb"){?> selected="selected" <?php }?>>(GMT+01:00) Zagreb</option>
                    <option value="Athens" <?php if($ur->time_zone=="Athens"){?> selected="selected" <?php }?>>(GMT+02:00) Athens</option>
                    <option value="Bucharest" <?php if($ur->time_zone=="Bucharest"){?> selected="selected" <?php }?>>(GMT+02:00) Bucharest</option>
                    <option value="Cairo" <?php if($ur->time_zone=="Cairo"){?> selected="selected" <?php }?>>(GMT+02:00) Cairo</option>
                    <option value="Harare" <?php if($ur->time_zone=="Harare"){?> selected="selected" <?php }?>>(GMT+02:00) Harare</option>
                    <option value="Helsinki" <?php if($ur->time_zone=="Helsinki"){?> selected="selected" <?php }?>>(GMT+02:00) Helsinki</option>
                    <option value="Jerusalem" <?php if($ur->time_zone=="Jerusalem"){?> selected="selected" <?php }?>>(GMT+02:00) Jerusalem</option>
                    <option value="Kaliningrad" <?php if($ur->time_zone=="Kaliningrad"){?> selected="selected" <?php }?>>(GMT+02:00) Kaliningrad</option>
                    <option value="Kyiv" <?php if($ur->time_zone=="Kyiv"){?> selected="selected" <?php }?>>(GMT+02:00) Kyiv</option>
                    <option value="Pretoria" <?php if($ur->time_zone=="Pretoria"){?> selected="selected" <?php }?>>(GMT+02:00) Pretoria</option>
                    <option value="Riga" <?php if($ur->time_zone=="Riga"){?> selected="selected" <?php }?>>(GMT+02:00) Riga</option>
                    <option value="Sofia" <?php if($ur->time_zone=="Sofia"){?> selected="selected" <?php }?>>(GMT+02:00) Sofia</option>
                    <option value="Tallinn" <?php if($ur->time_zone=="Tallinn"){?> selected="selected" <?php }?>>(GMT+02:00) Tallinn</option>
                    <option value="Vilnius" <?php if($ur->time_zone=="Vilnius"){?> selected="selected" <?php }?>>(GMT+02:00) Vilnius</option>
                    <option value="Baghdad" <?php if($ur->time_zone=="Baghdad"){?> selected="selected" <?php }?>>(GMT+03:00) Baghdad</option>
                    <option value="Istanbul" <?php if($ur->time_zone=="Istanbul"){?> selected="selected" <?php }?>>(GMT+03:00) Istanbul</option>
                    <option value="Kuwait" <?php if($ur->time_zone=="Kuwait"){?> selected="selected" <?php }?>>(GMT+03:00) Kuwait</option>
                    <option value="Minsk" <?php if($ur->time_zone=="Minsk"){?> selected="selected" <?php }?>>(GMT+03:00) Minsk</option>
                    <option value="Moscow" <?php if($ur->time_zone=="Moscow"){?> selected="selected" <?php }?>>(GMT+03:00) Moscow</option>
                    <option value="Nairobi" <?php if($ur->time_zone=="Nairobi"){?> selected="selected" <?php }?>>(GMT+03:00) Nairobi</option>
                    <option value="Riyadh" <?php if($ur->time_zone=="Riyadh"){?> selected="selected" <?php }?>>(GMT+03:00) Riyadh</option>
                    <option value="St. Petersburg" <?php if($ur->time_zone=="St. Petersburg"){?> selected="selected" <?php }?>>(GMT+03:00) St. Petersburg</option>
                    <option value="Volgograd" <?php if($ur->time_zone=="Volgograd"){?> selected="selected" <?php }?>>(GMT+03:00) Volgograd</option>
                    <option value="Tehran" <?php if($ur->time_zone=="Tehran"){?> selected="selected" <?php }?>>(GMT+03:30) Tehran</option>
                    <option value="Abu Dhabi" <?php if($ur->time_zone=="Abu Dhabi"){?> selected="selected" <?php }?>>(GMT+04:00) Abu Dhabi</option>
                    <option value="Baku" <?php if($ur->time_zone=="Baku"){?> selected="selected" <?php }?>>(GMT+04:00) Baku</option>
                    <option value="Muscat" <?php if($ur->time_zone=="Muscat"){?> selected="selected" <?php }?>>(GMT+04:00) Muscat</option>
                    <option value="Samara" <?php if($ur->time_zone=="Samara"){?> selected="selected" <?php }?>>(GMT+04:00) Samara</option>
                    <option value="Tbilisi" <?php if($ur->time_zone=="Tbilisi"){?> selected="selected" <?php }?>>(GMT+04:00) Tbilisi</option>
                    <option value="Yerevan" <?php if($ur->time_zone=="Yerevan"){?> selected="selected" <?php }?>>(GMT+04:00) Yerevan</option>
                    <option value="Kabul" <?php if($ur->time_zone=="Kabul"){?> selected="selected" <?php }?>>(GMT+04:30) Kabul</option>
                    <option value="Ekaterinburg" <?php if($ur->time_zone=="Ekaterinburg"){?> selected="selected" <?php }?>>(GMT+05:00) Ekaterinburg</option>
                    <option value="Islamabad" <?php if($ur->time_zone=="Islamabad"){?> selected="selected" <?php }?>>(GMT+05:00) Islamabad</option>
                    <option value="Karachi" <?php if($ur->time_zone=="Karachi"){?> selected="selected" <?php }?>>(GMT+05:00) Karachi</option>
                    <option value="Tashkent" <?php if($ur->time_zone=="Tashkent"){?> selected="selected" <?php }?>>(GMT+05:00) Tashkent</option>
                    <option value="Chennai" <?php if($ur->time_zone=="Chennai"){?> selected="selected" <?php }?>>(GMT+05:30) Chennai</option>
                    <option value="Kolkata" <?php if($ur->time_zone=="Kolkata"){?> selected="selected" <?php }?>>(GMT+05:30) Kolkata</option>
                    <option value="Mumbai" <?php if($ur->time_zone=="Mumbai"){?> selected="selected" <?php }?>>(GMT+05:30) Mumbai</option>
                    <option value="New Delhi" <?php if($ur->time_zone=="New Delhi"){?> selected="selected" <?php }?>>(GMT+05:30) New Delhi</option>
                    <option value="Sri Jayawardenepura" <?php if($ur->time_zone=="Sri Jayawardenepura"){?> selected="selected" <?php }?>>(GMT+05:30) Sri Jayawardenepura</option>
                    <option value="Kathmandu" <?php if($ur->time_zone=="Kathmandu"){?> selected="selected" <?php }?>>(GMT+05:45) Kathmandu</option>
                    <option value="Almaty" <?php if($ur->time_zone=="Almaty"){?> selected="selected" <?php }?>>(GMT+06:00) Almaty</option>
                    <option value="Astana" <?php if($ur->time_zone=="Astana"){?> selected="selected" <?php }?>>(GMT+06:00) Astana</option>
                    <option value="Dhaka" <?php if($ur->time_zone=="Dhaka"){?> selected="selected" <?php }?>>(GMT+06:00) Dhaka</option>
                    <option value="Urumqi" <?php if($ur->time_zone=="Urumqi"){?> selected="selected" <?php }?>>(GMT+06:00) Urumqi</option>
                    <option value="Rangoon" <?php if($ur->time_zone=="Rangoon"){?> selected="selected" <?php }?>>(GMT+06:30) Rangoon</option>
                    <option value="Bangkok" <?php if($ur->time_zone=="Bangkok"){?> selected="selected" <?php }?>>(GMT+07:00) Bangkok</option>
                    <option value="Hanoi" <?php if($ur->time_zone=="Hanoi"){?> selected="selected" <?php }?>>(GMT+07:00) Hanoi</option>
                    <option value="Jakarta" <?php if($ur->time_zone=="Jakarta"){?> selected="selected" <?php }?>>(GMT+07:00) Jakarta</option>
                    <option value="Krasnoyarsk" <?php if($ur->time_zone=="Krasnoyarsk"){?> selected="selected" <?php }?>>(GMT+07:00) Krasnoyarsk</option>
                    <option value="Novosibirsk" <?php if($ur->time_zone=="Novosibirsk"){?> selected="selected" <?php }?>>(GMT+07:00) Novosibirsk</option>
                    <option value="Beijing" <?php if($ur->time_zone=="Beijing"){?> selected="selected" <?php }?>>(GMT+08:00) Beijing</option>
                    <option value="Chongqing" <?php if($ur->time_zone=="Chongqing"){?> selected="selected" <?php }?>>(GMT+08:00) Chongqing</option>
                    <option value="Hong Kong" <?php if($ur->time_zone=="Hong Kong"){?> selected="selected" <?php }?>>(GMT+08:00) Hong Kong</option>
                    <option value="Irkutsk" <?php if($ur->time_zone=="Irkutsk"){?> selected="selected" <?php }?>>(GMT+08:00) Irkutsk</option>
                    <option value="Kuala Lumpur" <?php if($ur->time_zone=="Kuala Lumpur"){?> selected="selected" <?php }?>>(GMT+08:00) Kuala Lumpur</option>
                    <option value="Singapore" <?php if($ur->time_zone=="Singapore"){?> selected="selected" <?php }?>>(GMT+08:00) Singapore</option>
                    <option value="Taipei" <?php if($ur->time_zone=="Taipei"){?> selected="selected" <?php }?>>(GMT+08:00) Taipei</option>
                    <option value="Ulaanbaatar" <?php if($ur->time_zone=="Ulaanbaatar"){?> selected="selected" <?php }?>>(GMT+08:00) Ulaanbaatar</option>
                    <option value="Osaka" <?php if($ur->time_zone=="Osaka"){?> selected="selected" <?php }?>>(GMT+09:00) Osaka</option>
                    <option value="Sapporo" <?php if($ur->time_zone=="Sapporo"){?> selected="selected" <?php }?>>(GMT+09:00) Sapporo</option>
                    <option value="Seoul" <?php if($ur->time_zone=="Seoul"){?> selected="selected" <?php }?>>(GMT+09:00) Seoul</option>
                    <option value="Tokyo" <?php if($ur->time_zone=="Tokyo"){?> selected="selected" <?php }?>>(GMT+09:00) Tokyo</option>
                    <option value="Yakutsk" <?php if($ur->time_zone=="Yakutsk"){?> selected="selected" <?php }?>>(GMT+09:00) Yakutsk</option>
                    <option value="Guam" <?php if($ur->time_zone=="Guam"){?> selected="selected" <?php }?>>(GMT+10:00) Guam</option>
                    <option value="Port Moresby" <?php if($ur->time_zone=="Port Moresby"){?> selected="selected" <?php }?>>(GMT+10:00) Port Moresby</option>
                    <option value="Vladivostok" <?php if($ur->time_zone=="Vladivostok"){?> selected="selected" <?php }?>>(GMT+10:00) Vladivostok</option>
                    <option value="Magadan" <?php if($ur->time_zone=="Magadan"){?> selected="selected" <?php }?>>(GMT+11:00) Magadan</option>
                    <option value="New Caledonia" <?php if($ur->time_zone=="New Caledonia"){?> selected="selected" <?php }?>>(GMT+11:00) New Caledonia</option>
                    <option value="Solomon Is." <?php if($ur->time_zone=="Solomon Is."){?> selected="selected" <?php }?>>(GMT+11:00) Solomon Is.</option>
                    <option value="Srednekolymsk" <?php if($ur->time_zone=="Srednekolymsk"){?> selected="selected" <?php }?>>(GMT+11:00) Srednekolymsk</option>
                    <option value="Auckland" <?php if($ur->time_zone=="Auckland"){?> selected="selected" <?php }?>>(GMT+12:00) Auckland</option>
                    <option value="Fiji" <?php if($ur->time_zone=="Fiji"){?> selected="selected" <?php }?>>(GMT+12:00) Fiji</option>
                    <option value="Kamchatka" <?php if($ur->time_zone=="Kamchatka"){?> selected="selected" <?php }?>>(GMT+12:00) Kamchatka</option>
                    <option value="Marshall Is." <?php if($ur->time_zone=="Marshall Is."){?> selected="selected" <?php }?>>(GMT+12:00) Marshall Is.</option>
                    <option value="Wellington" <?php if($ur->time_zone=="Wellington"){?> selected="selected" <?php }?>>(GMT+12:00) Wellington</option>
                    <option value="Chatham Is." <?php if($ur->time_zone=="Chatham Is."){?> selected="selected" <?php }?>>(GMT+12:45) Chatham Is.</option>
                    <option value="Nuku'alofa" <?php if($ur->time_zone=="Nuku'alofa"){?> selected="selected" <?php }?>>(GMT+13:00) Nuku'alofa</option>
                    <option value="Tokelau Is." <?php if($ur->time_zone=="Tokelau Is."){?> selected="selected" <?php }?>>(GMT+13:00) Tokelau Is.</option>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <b> <label class="col-md-3 control-label"> Country </label> </b>
                    <div class="col-md-8">
                    <select name="country" id="" class="form-control" >
                    <option value="">Select a Country</option>
                    <?php foreach($cntry as $cn){ ?>
					<option value="<?php echo $cn->phonecode; ?>" <?php if($cn->phonecode==$ur->country) {?> selected="selected" <?php }?>><?php echo $cn->nicename; ?></option>
                    <?php }?>
                    </select>
                    </div>
                    </div>
                    <!--Checkbox Check-->
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Main User Type </label>
                    <div class="col-md-4"> <label style="display:inline-block;">
                    <input type="radio" name="user_type_main" id="radio" class="form-control" value="1" <?php if($ur->user_type_main==1){?> checked="checked" <?php }?>> Normal User</label>
                    </div>
                    
                    <div class="col-md-4"><label style="display:inline-block;"> 
                    <input type="radio" name="user_type_main" id="radio1" class="form-control" value="2" <?php if($ur->user_type_main==2){?> checked="checked" <?php }?>>Exco User </label>
                    </div>
                    </div>
                    
                    <div id="a">
                    
                    <div class="form-group">
                    <b> <label class="col-md-3 control-label"> User Type </label> </b>
                    <div class="col-md-8">
                    <select name="user_type_sub" id="subtype" class="form-control" >
                    <option value="individual" <?php if($ur->user_type_sub=="individual") {?> selected="selected" <?php }?>>I am an Individual</option>
					<option value="business" <?php if($ur->user_type_sub=="business") {?> selected="selected" <?php }?> >I am a Business</option>
                    </select>
                    </div>
                    </div>
                    
                    <!--Business Fields-->
                    <div id="bsns">
                    <input type="hidden" id="bsns" value="<?php echo $ur->user_type_sub;?>">
                    <!--Business Fields-->
                    <div class="form-group">
                    <label class="control-label col-md-3">Home Phone</label>
                    <div class="col-md-8"> 
                    <input type="text" name="home_phone" class="form-control" value="<?php echo $ur->home_phone?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <b> <label class="col-md-3 control-label"> Phone Preference </label> </b>
                    <div class="col-md-8">
                    <select name="phone_pref" id="" class="form-control" >
                    <option value="mobilephone" <?php if($ur->phone_pref=="mobilephone") {?> selected="selected" <?php }?>>Mobile Phone</option>
					<option value="homephone" <?php if($ur->phone_pref=="homephone") {?> selected="selected" <?php }?>>Home Phone</option>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Business Name </label>
                    <div class="col-md-8">
                    <input type="text" name="business_name" class="form-control" value="<?php echo $ur->business_name?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Billing Email </label>
                    <div class="col-md-8"> 
                    <input type="text" name="billing_email" class="form-control" value="<?php echo $ur->billing_email?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Default Message </label>
                    <div class="col-md-8"> 
                    <input type="text" name="default_message" class="form-control" value="<?php echo $ur->default_message?>">
                    </div>
                    </div>
                    <!--Business Fields-->
                    </div>
                    <!--Business Fields-->
                    </div>
                    
                    <div id="b" style="display:none;">
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Home Address </label>
                    <div class="col-md-8"> 
                    <input type="text" name="address" class="form-control" value="<?php echo $ur->address?>">
                    </div>
                    </div>
                    
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> ABN or ACN </label>
                    <div class="col-md-8">
                    <input type="text" name="abn_acn_num" class="form-control" value="<?php echo $ur->abn_acn_num?>">
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <b> <label class="col-md-3 control-label"> Vehicle </label> </b>
                    <div class="col-md-8">
                    <select name="vehicle" id="" class="form-control" >
                        <option value="car" <?php if($ur->vehicle=="car") {?> selected="selected" <?php }?>>Car</option>
                        <option value="bike_scooter" <?php if($ur->vehicle=="bike_scooter") {?> selected="selected" <?php }?>>Motorbike / Scooter</option>
                        <option value="push_bike" <?php if($ur->vehicle=="push_bike") {?> selected="selected" <?php }?>>Push Bike</option>
                        <option value="van_truck" <?php if($ur->vehicle=="van_truck") {?> selected="selected" <?php }?>>Van / Truck</option>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <b> <label class="col-md-3 control-label"> Contact Preference </label> </b>
                    <div class="col-md-8">
                    <select name="contact_preference" id="" class="form-control" >
                        <option  value="call" <?php if($ur->contact_preference=="call") {?> selected="selected" <?php }?>> Call </option>
                        <option value="sms" <?php if($ur->contact_preference=="sms") {?> selected="selected" <?php }?>> SMS </option>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <b> <label class="col-md-3 control-label"> Device </label> </b>
                    <div class="col-md-8">
                    <select name="device" id="" class="form-control" >
                        <option <?php if($ur->contact_preference=="android") {?> selected="selected" <?php }?> value="android"> Android </option>
                        <option value="ios" <?php if($ur->contact_preference=="ios") {?> selected="selected" <?php }?>> iOS </option>
                    </select>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-md-3"> Registered for GST </label>
                    <div class="col-md-4"> <label style="display:inline-block;">
                    <input type="radio" name="gst_status" id="aa" class="form-control" value="<?php echo $ur->gst_status?>" <?php if($ur->gst_status==1) {?> checked="checked" <?php }?>>Yes</label>
                    </div>
                    
                    <div class="col-md-4"><label style="display:inline-block;">
                    <input type="radio" name="gst_status" id="aa" class="form-control" value="<?php echo $ur->gst_status?>" <?php if($ur->gst_status==0) {?> checked="checked" <?php }?>> No </label>
                    </div>
                    </div>
                    
                    </div>
                    </div>
                 
                    <div class="form-actions">
                    <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                    <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                    <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                    <button type="button" class="btn default">Cancel</button>
                    </div>
                    </div>
                    </div>
                    </form>
                    <?php }?>
					<script>
                    $('INPUT[type="file"]').change(function () {
                    var ext = this.value.match(/\.(.+)$/)[1];
                    switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                    $('#chkimg').attr('disabled', false);
                    break;
                    default:
                    alert('This is not an allowed file type.');
                    this.value = '';
                    }
                    });
                    </script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                    <script>
					$(document).ready(function() {
					$('#radio').click(function() {
					$('#a').show();
					$('#b').hide();
					});
					$('#radio1').click(function() {
					$('#b').show();
					$('#a').hide();
					});
					});			
                    </script>
                    <script>
					$(function() {
					var bsns = document.getElementById("bsns").value;
					if(bsns=="business"){
					$('#bsns').show();
					}else{
					$('#subtype').change(function(){
					if($('#subtype').val() == 'business') {
					$('#bsns').show(); 
					} else {
					$('#bsns').hide(); 
					} 
					});	
					}
					});
					</script>
					<script>
                    $(document).ready(function() {
						if ($('#radio').prop('checked')){
						//alert(">>>>");
						$('#radio').click();
						}
						if ($('#radio1').prop('checked')){
						//alert("<<<<");
						$('#radio1').click();
						}
                    });			
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
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
<style type="text/css">
.datepicker .active {
	background-color: #fff !important;
}
.datepicker {
	color: #333;
}
.datepicker .active:hover {
	background-color: #fff !important;
}
.datepicker--day-name {
	color: #67809f!important;
	font-weight: 600!important;
}
</style>
<link href="<?php echo base_url(); ?>css/datepicker.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,300,500&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/highlight.js/8.9.1/highlight.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>js/datepicker.js"></script>
<script src="<?php echo base_url(); ?>js/datepicker.en.js"></script>
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
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Add Consignment</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="<?php echo base_url().'supercontrol/consignment/add_consignment' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                      <div class="form-body">
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Pickup Address</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="pickup_address" value="" name="pickup_address" onkeyup="leftTrim(this)">
                                <?php echo form_error('pickup_address'); ?> </div>
                            </div>
                          </div>
                          <script src="<?php echo base_url();?>js/jquery-1.10.1.min.js"></script>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label" style="margin-left:18px;">Pickup Location</label>
                              <div class="controls">
                                <input  class="form-control"  id="autocomplete" name="pickup_location" onFocus="geolocate()" placeholder="Enter a Location" type="text" value=""  style="width:490px;"  />
                                <?php echo form_error('pickup_location'); ?> </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Delivery Address</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="delivery_address" value="" name="delivery_address" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Delivery Location</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="autocomplete2" onFocus="geolocate()" value="" name="delivery_location" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Vehicle</label>
                              <div class="controls">
                                <select name="vehicle" id="vehicle" class="form-control">
                                  <option value="Car">Car</option>
                                  <option value="Motorbike/Scooter">Motorbike/Scooter</option>
                                  <option value="Van/Truck">Van/Truck</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Delivery Option</label>
                              <div class="controls">
                                <select name="delivery_option" id="delivery_option" class="form-control">
                                  <option value="1">90 min option</option>
                                  <option value="2">3 hour option</option>
                                  <option value="3">Same day option</option>
                                </select>
                                <!--<input type="text" class="form-control" id="delivery_option" value="" name="delivery_option" onkeyup="leftTrim(this)">-->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Item Ready Time</label>
                              <div class="controls"> <?php echo form_input(array('id' => 'start_date_time', 'placeholder'=>'10 AM', 'data-language'=>'en', 'name' => 'item_ready_time', 'data-timepicker'=>'true','class'=>'datepicker-here form-control' )); ?> <?php echo form_error('start_date_time'); ?> </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Pickup User Name</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="pickup_usr_name" value="" name="pickup_usr_name" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Pickup Country</label>
                              <div class="controls">
                                <select name="pickup_country" id="pickup_country" class="form-control">
                                  <option value="">Select Country</option>
                                  <?php foreach($cntry as $c){?>
                                  <option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Pickup Phone</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="pickup_phone" value="" name="pickup_phone" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Reference Id</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="reference_id" value="" name="reference_id" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Pickup Instruction</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="pickup_instruction" value="" name="pickup_instruction" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Delivery User Name</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="delivery_usr_name" value="" name="delivery_usr_name" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Delivery Country</label>
                              <div class="controls">
                                <select name="delivery_country" id="delivery_country" class="form-control">
                                  <option value="">Select Country</option>
                                  <?php foreach($cntry as $c){?>
                                  <option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Delivery Phone</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="delivery_phone" value="" name="delivery_phone" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Delivery Instruction</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="delivery_instruction" value="" name="delivery_instruction" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Delivery Amount</label>
                              <div class="controls">
                                <input type="text" class="form-control" id="delivery_amount" value="" name="delivery_amount" onkeyup="leftTrim(this)">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label style="margin-left:18px;" class="control-label">Sms Tracking Status</label>
                              <div class="controls">
                                <select name="sms_tracking_stat" id="sms_tracking_stat" class="form-control">
                                  <option value="1">Yes</option>
                                  <option value="0">No</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label style="margin-left:18px;" class="control-label">Item Description</label>
                            <div class="controls">
                              <textarea class="form-control" name="item_name_description" rows="5" cols="5" id="pagedes" onkeyup="leftTrim(this)"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-5 col-md-12">
							<?php 
                            //$addressFrom = 'Durgapur';
                            //$addressTo = 'Ranigaunge';
                           // echo getDistance($addressFrom, $addressTo,"K");
						   //echo $distance;
							?>
                            <div id="image" style="display:none;"><img src="<?php echo base_url()?>images/loading.gif" /></div>
                            <div id="pcalculation" style="color:#E12330; font-weight:bold;"></div>
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                            <input type="hidden" name="pricevalue" value="" id="pricetext" />
                            <input type="button" name="check" id="cp" value="Calculate Price"  class="btn red"/>
                            <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit' ,'class'=>'btn red')); ?>
                            <button type="button" class="btn default">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <!--    location script--->
                    <script type="text/javascript">
						$(document).ready(function () {
							var base_url = "<?php echo base_url() ?>supercontrol/consignment/price_calculate";
							var base_url2 = "<?php echo base_url() ?>supercontrol/consignment/price_calculate2";
							$("#cp").click(function(){
								//alert(base_url);
								var frm = document.getElementById('autocomplete').value;
								var toad = document.getElementById('autocomplete2').value;	
								var type = document.getElementById('delivery_option').value;
								$('#image').show();
									//alert(frm + toad + type);
									$.ajax({
										   type: "POST",
										   url: base_url,
										   data: {'frm':frm,'toad':toad,'type':type},
										   success: function (response) {
											   //alert(response);
											   //alert("kjhkjhkhk");
											   document.getElementById("pcalculation").innerHTML=response;
											   document.getElementById("pricetext").value=response;
											   $('#image').hide();
												//$("#pcalculation").innerHTML(response);
											}
										   
										   })
									
									$.ajax({
										   type: "POST",
										   url: base_url2,
										   data: {'frm':frm,'toad':toad,'type':type},
										   success: function (response) {
											   //alert(response);
											   //alert("kjhkjhkhk");
											   document.getElementById("pricetext").value=response;
											   $('#image').hide();
												//$("#pcalculation").innerHTML(response);
											}
										   
										   })
							});
						});
						/*var id = $(this).val();
								$.ajax({
									type: "POST",
									url: base_url+"index.php/sms/get_dept_employee";
									data: {'id':id},
									dataType:"json",
									cache: false
									success: function (emp_list) {
										$("#dept-emp").html(emp_list);
									}
								});*/
					</script>
                    <script>
var placeSearch, autocomplete, autocomplete2;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */
    (document.getElementById('autocomplete')), {
      types: ['geocode'],
	  componentRestrictions: {country: 'AU'}
    });

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', function() {
    fillInAddress(autocomplete, "");
  });

  autocomplete2 = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */
    (document.getElementById('autocomplete2')), {
      types: ['geocode'],
	  componentRestrictions: {country: 'AU'}
	  
    });
  autocomplete2.addListener('place_changed', function() {
    fillInAddress(autocomplete2, "2");
  });

}

function fillInAddress(autocomplete, unique) {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    if (!!document.getElementById(component + unique)) {
      document.getElementById(component + unique).value = '';
      document.getElementById(component + unique).disabled = false;
    }
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType] && document.getElementById(addressType + unique)) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType + unique).value = val;
    }
  }
}
google.maps.event.addDomListener(window, "load", initAutocomplete);

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtg6oeRPEkRL9_CE-us3QdvXjupbgG14A&libraries=places&callback=initAutocomplete"></script>
                    <script>
                    $('INPUT[type="file"]').change(function () {
                    var ext = this.value.match(/\.(.+)$/)[1];
                    switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                    $('#userfile').attr('disabled', false);
                    break;
                    default:
                    alert('This is not an allowed file type.');
                    this.value = '';
                    }
                    });
					
					
					
					function leftTrim(element){
					if(element)
					element.value=element.value.replace(/^\s+/,"");
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

<?php //$this->load->view ('header');?>

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
          <li> <span>supercontrol Panel</span> </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tabbable-line boxless tabbable-reversed">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_0">
                <div class="portlet box blue-hoki">
                  <div class="portlet-title">
                    <div class="caption"> <i class="fa fa-gift"></i>Consignment edit</div>
                    <div class="tools"> <a href="javascript:;" class="collapse"> </a> <a href="#portlet-config" data-toggle="modal" class="config"> </a> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                  </div>
                  <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <?php foreach($ecms as $i){?>
                    <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url().'supercontrol/consignment/edit_consignment '?>" enctype="multipart/form-data">
                      <div class="form-body">
                        <input type="hidden" name="consignment_id" value="<?=$i->con_id;?>">
                        
                        <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Pickup Address</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="pickup_address" value="<?php echo $i->pickup_address;?>" name="pickup_address" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Pickup Location</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="autocomplete" onFocus="geolocate()" value="<?php echo $i->pickup_location;?>" name="pickup_location" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Delivery Address</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="delivery_address" value="<?php echo $i->delivery_address;?>" name="delivery_address" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Delivery Location</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="autocomplete2" onFocus="geolocate()" value="<?php echo $i->delivery_location;?>" name="delivery_location" onkeyup="leftTrim(this)">
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
                                                            	<option <?php if($i->vehicle=="Car"){?> selected="selected"<?php }?> value="Car">Car</option>
                                                                <option <?php if($i->vehicle=="Motorbike/Scooter"){?> selected="selected"<?php }?> value="Motorbike/Scooter">Motorbike/Scooter</option>
                                                                <option <?php if($i->vehicle=="Van/Truck"){?> selected="selected"<?php }?> value="Van/Truck">Van/Truck</option>
                                                             </select>
                            <!--<input type="text" class="form-control" id="vehicle" value="<?php echo $i->vehicle;?>" name="vehicle" onkeyup="leftTrim(this)">-->
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Delivery Option</label>
                          <div class="controls">
                          <select name="delivery_option" id="delivery_option" class="form-control">
                                                            	<option <?php if($i->vehicle=="1"){?> selected="selected"<?php }?> value="1">90 min option</option>
                                                                <option <?php if($i->vehicle=="2"){?> selected="selected"<?php }?> value="2">3 hour option</option>
                                                                <option <?php if($i->vehicle=="3"){?> selected="selected"<?php }?> value="3">Same day option</option>
                                                             </select>  
                            <!--<input type="text" class="form-control" id="delivery_option" value="<?php echo $i->delivery_option;?>" name="delivery_option" onkeyup="leftTrim(this)">-->
                          </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Item Ready Time</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="item_ready_time" value="<?php echo $i->item_ready_time;?>" name="item_ready_time" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Pickup User Name</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="pickup_usr_name" value="<?php echo $i->pickup_usr_name;?>" name="pickup_usr_name" onkeyup="leftTrim(this)">
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
                            <option value="<?php echo $c->id;?>" <?php if($c->id==$i->pickup_country){ ?> selected="selected" <?php }?>><?php echo $c->name;?></option>
                            <?php } ?>
                          </select>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Pickup Phone</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="pickup_phone" value="<?php echo $i->pickup_phone;?>" name="pickup_phone" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Reference id</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="reference_id" value="<?php echo $i->reference_id;?>" name="reference_id" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                       </div>
                        <div class="col-md-6"> 
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Pickup Instruction</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="pickup_instruction" value="<?php echo $i->pickup_instruction;?>" name="pickup_instruction" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Delivery User Name</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="delivery_usr_name" value="<?php echo $i->delivery_usr_name;?>" name="delivery_usr_name" onkeyup="leftTrim(this)">
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
                            <option value="<?php echo $c->id;?>" <?php if($c->id==$i->delivery_country){ ?> selected="selected" <?php }?>><?php echo $c->name;?></option>
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
                            <input type="text" class="form-control" id="delivery_phone" value="<?php echo $i->delivery_phone;?>" name="delivery_phone" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Delivery Instruction</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="delivery_instruction" value="<?php echo $i->delivery_instruction;?>" name="delivery_instruction" onkeyup="leftTrim(this)">
                          </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label style="margin-left:18px;" class="control-label">Delivery Amount</label>
                          <div class="controls">
                            <input type="text" class="form-control" id="delivery_amount" value="<?php echo $i->delivery_amount;?>" name="delivery_amount" onkeyup="leftTrim(this)">
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
                            <textarea class="form-control" name="item_name_description" rows="6" id="pagedes" onkeyup="leftTrim(this)"><?php echo $i->item_name_description;?></textarea>
                          </div>
                        </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-5 col-md-9">
                            <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                            <input type="submit" class="btn red" id="submit" value="Submit" name="update">
                            <button class="btn default" type="button">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <?php }?>
                    <!-- END FORM-->
                    
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
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>

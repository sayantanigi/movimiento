<?php //$this->load->view ('header');?>
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
      <div class="alert alert-success alert-dismissable" style="padding:10px;">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
        <strong>
          <?php 
          if(@$success_msg!=''){echo @$success_msg;}
          $last = end($this->uri->segments); 
          if($last=="success"){echo "course Added Successfully ......";}
          if($last=="successdelete"){echo "course Deleted Successfully ......";}
          ?>
        </strong> </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tabbable-line boxless tabbable-reversed">
              <div class="tab-content">
                <div class="tab-pane active" id="tab_0">
                  <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                      <div class="caption"> <i class="fa fa-gift"></i>Add course</div>
                      <div class="tools"> <a href="javascript:;" class="reload"> </a> <a href="javascript:;" class="remove"> </a> </div>
                    </div>
                    <div class="portlet-body form"> 
                      <!-- BEGIN FORM-->
                      <form action="<?php echo base_url().'supercontrol/course/add_my_course'?>" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="check()">
                        <div class="form-body">
                          <div class="form-group"> <b>
                            <label class="col-md-3 control-label">Select Category *</label>
                          </b>
                          <div class="col-md-8"> 
                            <select name="course_category" class="form-control">
                              <?php foreach($allcat as $ac){?>
                              <option value="<?php echo $ac->category_id?>"><?php echo $ac->category_name?></option>
                              <?php }?>
                            </select>
                            <label id="errorBox"></label>
                          </div>
                        </div>
                        
                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course Country *</label>
                        </b>
                        <div class="col-md-8">
                          <input type="text" name="course_country" required="" id="title" class="form-control" placeholder="Course Country" onkeyup= "leftTrim(this)"/>
                          <label id="errorBox"></label>
                        </div>
                      </div>
                      
                      
                      <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course state *</label>
                        </b>
                        <div class="col-md-8">
                          <input type="text" name="course_state" required="" id="title" class="form-control" placeholder="Course state" onkeyup= "leftTrim(this)"/>
                          <label id="errorBox"></label>
                        </div>
                      </div>
                      
                      <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course city *</label>
                        </b>
                        <div class="col-md-8">
                          <input type="text" name="course_city" required="" id="title" class="form-control" placeholder="Course city" onkeyup= "leftTrim(this)"/>
                          <label id="errorBox"></label>
                        </div>
                      </div>
                      
                      <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course Local Area *</label>
                        </b>
                        <div class="col-md-8">
                          <input type="text" name="course_local_area" required="" id="title" class="form-control" placeholder="Course Local Area" onkeyup= "leftTrim(this)"/>
                          <label id="errorBox"></label>
                        </div>
                      </div>
                      
                      

                        <div class="form-group"> <b>
                          <label class="col-md-3 control-label">Course Name *</label>
                        </b>
                        <div class="col-md-8">
                          <input type="text" name="course_name" required="" id="title" class="form-control" placeholder="Course Name" onkeyup= "leftTrim(this)"/>
                          <label id="errorBox"></label>
                        </div>
                      </div>

                      <div class="form-group"> <b>
                        <label class="col-md-3 control-label">Price *</label>
                      </b>
                      <div class="col-md-8">
                        <input type="text" name="price" required="" id="price" class="form-control" placeholder="Price" onkeyup= "leftTrim(this)"/>
                        <label id="errorprice"></label>
                      </div>
                    </div>

                    <div class="form-group"> <b>
                      <label class="col-md-3 control-label">Sort Order</label>
                    </b>
                    <div class="col-md-8">
                      <input type="text" required="" name="sort_order" id="sort_order" class="form-control" placeholder="Sort Order"/>
                      <!-- <label id="errorBox1"></label>-->
                    </div>
                  </div>
                   <div class="form-group"> <b>
                      <label class="col-md-3 control-label">CPD accredited</label>
                    </b>
                    <div class="col-md-8">
                      
                      <input type="radio" name="cpd" class="form-control" checked="" value="Yes">Yes
                      <input type="radio" name="cpd" class="form-control"  value="No">No 
                    </div>
                  </div>
                  <div class="form-group"> <b>
                      <label class="col-md-3 control-label">Certificate</label>
                    </b>
                    <div class="col-md-8">
                      <input type="text" required="" name="certificate" id="certificate" class="form-control" placeholder="Certificate Details"/>
                      <!-- <label id="errorBox1"></label>-->
                    </div>
                  </div>
                  <div class="form-group"> <b>
                      <label class="col-md-3 control-label">Entry Requirement</label>
                    </b>
                    <div class="col-md-8">
                      <input type="text" required="" name="entry_requirment" id="entry_requirment" class="form-control" placeholder="Entry Requirement Details"/>
                      <!-- <label id="errorBox1"></label>-->
                    </div>
                  </div>
                  
                  
                  
                  
                  
                  <div class="form-group"><b>
                                        <label class="col-md-3 control-label">Opening Date * </label></b>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="date" name="start_date" id="date"  placeholder="Enter Day"  class="form-control"  data-format="dd-mm-yyyy">
                                            </div>
                                        </div>                                                                                                
                                    </div>
                                    
                                    <div class="form-group"><b>
                                        <label class="col-md-3 control-label">End  Date * </label></b>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input type="date" name="end_date" id="date"  placeholder="Last Day"  class="form-control"  data-format="dd-mm-yyyy">
                                            </div>
                                        </div>                                                                                                
                                    </div>
                  
                  
                  
                  
                  
  <div class="form-group"> <b>
    <label class="col-md-3 control-label">Description</label>
    </b>
    <div class="col-md-8">
    <textarea id="pagedes" class="form-control" name="course_description" cols="60" rows="10"  aria-hidden="true"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="col-md-3 control-label"><b>Shift Details *
    </b></label>
    <div class="form-group col-md-2">
      <label for="inputEmail4">Start Time</label>
      <input type="time" name="start_time" class="form-control" id="start_time" placeholder="Email">
    </div>
    <div class="form-group col-md-2">
      <label for="inputPassword4">End Time</label>
      <input type="time" name="end_time" class="form-control" id="end_time" placeholder="Password">
    </div>
    <div class="form-group col-md-2">
      <label for="inputPassword4">Day</label>
      <input type="text" name="day" class="form-control" id="day" placeholder="Password">
    </div>
    <div class="form-group col-md-2">
      <label for="inputPassword4">Shift Time</label>
      <input type="text" name="shift" class="form-control" id="shift" placeholder="Password">
    </div>
    <div class="form-group col-md-1" style="margin-top: 24px;">
      <button type="button" class="mtr-btn btn btn-primary" onclick="education_fields();"><span>Add More</span></button>
    </div>
  </div>
  <div class="clearfix"></div>
 <div id="education_fields"></div>
</div>
<div class="form-actions">
  <div class="row">
    <div class="col-md-offset-3 col-md-9">
      <input type="submit" id="submit" value="Submit" class="btn red">
      <button type="button" class="btn default">Cancel</button>
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

<style>
#errorBox{
  color:#F00;
}
</style>

<?php //$this->load->view ('footer');?>

          
                                                 <div id="tablesec">
                                                  <?php
                                                  if($mulimg){
                                                  ?>
                                                    <?php   foreach($mulimg as $i){?>
                                                      <?php   if($i->apartment_image == ''){
                                                                $pic = base_url()."property_img/noimage.jpg" ;
                                                              } else{
                                                            $pic = base_url()."property_img/".$i->apartment_image ; } 
                                                    ?>
                                                    
                                                    <div class="img">
                                                      
                                                        <img src="<?=$pic ?>" alt="Image Loading..." width="151" height="152">
                                                     
                                                      <div class="desc"><button style="background-color:#F00;"><a style="text-decoration:none; color:#FFF;" href="<?php echo base_url()?>supercontrol/imageupload/delete_property_img/<?php echo $i->id?>/<?=$this->uri->segment(4); ?>" onclick="return confirm('Are you sure you want to delete ?');"><i class="fa fa-trash"></i> Delete</a>
                                                     <!-- <img src="<?=$pic ?>" alt="Image loading.." style="width:150px;"/>
                                                      <div>
                                                      <a href="<?php echo base_url()?>supercontrol/imageupload/delete_property_img/<?php echo $i->id?>/<?=$this->uri->segment(4); ?>" onclick="return confirm('Are you sure you want to delete ?');"><i class="fa fa-trash"></i> Delete</a>-->
                                                      </div> </div>
                                                    <?php }  ?>
                                                  <?php }?>
                                                  <style>
                                                        div.img {
                                                            margin: 5px;
                                                            border: 1px solid #ccc;
                                                            float: left;
                                                            width: 181px;
                                                        }
                                                        
                                                        div.img:hover {
                                                            border: 1px solid #777;
                                                        }
                                                        
                                                        div.img img {
                                                            width: 180px;
                                                            height: 150px	;
                                                        }
                                                        
                                                        div.desc {
                                                            padding: 15px;
                                                            text-align: center;
                                                        }
                                                    </style>
                                                    
                                                    </div>

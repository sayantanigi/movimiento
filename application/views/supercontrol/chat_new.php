<?php if(!empty($allchat)){ foreach($allchat as $all){?>
            <?php if($all->admin_id!=0){?>
            <li class="left clearfix"><span class="chat-img pull-left"> <img style="width:50px; height:50px;"
             src="<?php echo base_url()?>user_panel/student/img/logo1.png" alt="User Avatar" class="img-circle" /> </span>
              <div class="chat-body clearfix">
                <div class="header"> <strong class="primary-font">Admin</strong> <small class="pull-right text-muted"> <span class="glyphicon glyphicon-time"></span><?php echo date('d-m-Y h:i:s', strtotime($all->send_date));?></small> </div>
                <p> <?=$all->message;?></p>
              </div>
            </li>
            <?php }else{?>
            <li class="right clearfix"><span class="chat-img pull-right"><?php if(!empty($myprofile)){?> <img style="width:50px; height:50px;" src="<?php echo base_url()?>uploads/profile/<?php echo $myprofile[0]->profile_image?>" alt="User Avatar" class="img-circle" /><?php }else{?><img style="width:50px; height:50px;" src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" /> <?php }?> </span>
              <div class="chat-body clearfix">
                <div class="header"> <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo date('d-m-Y h:i:s', strtotime($all->send_date));?></small> <strong class="pull-right primary-font"><?=$myprofile[0]->first_name;?></strong> </div>
                <p style="float:right;"> <?=$all->message;?> </p>
              </div>
            </li>
            <?php }?>
            <?php }}?>
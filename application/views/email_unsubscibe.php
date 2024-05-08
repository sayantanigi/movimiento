<?php 
$getOptionsSql = "SELECT * FROM `options`";
$optionsList = $this->db->query($getOptionsSql)->result();

//  echo $id;die;

 $id_decode=base64_decode($id);
//  echo $id_decode;die;
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $id_decode))
    {
        // one or more of the 'special characters' found in $string
        echo "You are not allowed to change any url contains";die;
    }
$sql="SELECT enrollment_id from course_enrollment where enrollment_id='$id_decode'";
$data = $this->db->query($sql)->num_rows();

// echo $data;die;


if($data>0){
?>
<style>
#form-messages {text-align: center; margin-top: 10px;}
</style>
<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">Email Unsubscribe Page</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li>Email Unsubscribe Page</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->
   
    <div class="contact-page-section pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            
            <div class="row justify-content-center">
                
                <div class="col-lg-6 pl-60 md-pl-15">
                    <div class="contact-comment-box">
                        <!-- <div class="inner-part">
                            <h2 class="title mb-mb-15">Get In Touch</h2>
                            <p>Have some suggestions or just want to say hi? Our support team are ready to help you 24/7.</p>
                        </div> -->
                        
                        <form id="unsubscribe-form" method="post" action="">
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-12 mb-35 col-md-6 col-sm-12">
                                        <input class="from-control" type="email" id="email" name="email" placeholder="Put your email id which you want to unsubscribe" required="">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <input class="btn-send" type="submit" value="Submit Now">
                                </div>
                            </fieldset>
                            <div id="form-messages"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

</div>

<?php  } else{
        ?>
<p></p>
<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title"></h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li>You are not authorized to check this page</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->
   
    <div class="contact-page-section pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            
            <div class="row align-items-center">
                
                <div class="col-lg-6 pl-60 md-pl-15">
                    <div class="contact-comment-box">
                       
                    <div class="inner-part">
                            <h2 class="title mb-mb-15"></h2>
                            <p>You are not authorized to check this page</p>
                        </div> 
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

   

</div>


   <?php } ?>
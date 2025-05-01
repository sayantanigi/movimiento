<?php $settings = $this->Adminmodel->get('settings', true, 'settingId', 1); ?>
<style>
    body,html{display:flex;align-items:center;justify-content:center;background:#eee;font-family:Arial,sans-serif}
</style>
<div class="PasswordContainer">
    <img src="<?= base_url('uploads/logos/'.@$settings->logo) ?>" alt="Logo">
    <h2>Forgot Password</h2>
    <div class="input-field" id="emailField">
        <label for="role">Email</label>
        <input type="email" id="email" placeholder="Enter recovery email">
        <span class="icon fa fa-envelope"></span>
    </div>
    <div class="OTPBlock" id="otpBlock">
        <div class="input-field">
            <label for="role">Enter OTP sent to your email</label>
            <div class="OTPContainer">
                <input type="text" class="OTPinput" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                    oninput="moveToNext(this, 'otp2')" id="otp1">
                <input type="text" class="OTPinput" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                    oninput="moveToNext(this, 'otp3')" id="otp2">
                <input type="text" class="OTPinput" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                    oninput="moveToNext(this, 'otp4')" id="otp3">
                <input type="text" class="OTPinput" maxlength="1" pattern="[0-9]*" inputmode="numeric"
                    oninput="moveToNext(this, 'otp5')" id="otp4">
            </div>
        </div>
        <a class="Link">Resend Code</a>
    </div>
    <div id="errormsg"></div>
    <button class="OTPSendBtn" onclick="showOTPBlock()">Send</button>
    <div class="Bottomlink">Back to <a href="<?= base_url('login'); ?>">Sign In</a></div>
</div>
<script>
function showOTPBlock(){
    var email = $("#email").val();
    var emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if(email == '') {
		$('#email').prop('placeholder','Enter your email address');
		$('#email').css({'color':'red', 'border':'1px solid red'});
		$("#email").focus();
		return false;
	} else {
        if(!emailRegex.test(email)) {
            $("#errormsg").fadeIn().html("Please enter a valid email address").css({'color':'red','margin-bottom':'5px'});
            $('#email').css({'color':'red', 'border':'1px solid red'});
            setTimeout(function(){$("#errormsg").html("");},5000)
            $("#email").focus();
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Forgetpassword/forgotpassemail')?>",
                data: {email: email},
                dataType: 'json',
                beforeSend: function() {

                },
                success: function(returndata) {
                    console.log(returndata[1]);
                    if(returndata[0] == 'success') {
                        $('#errormsg').html(returndata[1]).css({'color': 'green', 'font-size': '13px', 'margin-bottom': '12px'});
                    } else {
                        $('#errormsg').html(returndata[1]).css({'color': 'red', 'font-size': '13px', 'margin-bottom': '12px'});
                    }
                },
                complete: function() {

                }
            });
        }
    }
}
</script>
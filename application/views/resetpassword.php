<?php $settings = $this->Adminmodel->get('settings', true, 'settingId', 1); ?>
<style>
    body,html{display:flex;align-items:center;justify-content:center;background:#eee;font-family:Arial,sans-serif}
</style>
<div class="PasswordContainer">
    <img src="<?= base_url('uploads/logos/'.@$settings->logo) ?>" alt="Logo">
    <h2>Reset Password</h2>
    <form action="<?= base_url('Forgetpassword/update_password'); ?>" method="POST">
        <div class="input-field" id="emailField">
            <label for="role">New Password</label>
            <input type="password" id="password" name="password" placeholder="Enter New Password" required>
            <span class="icon fa fa-envelope"></span>
        </div>
        <div class="input-field" id="emailField">
            <label for="role">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password" required>
            <span class="icon fa fa-envelope"></span>
        </div>
        <div id="errormsg"></div>
        <button class="OTPSendBtn" id="resetButton">Send</button>
        <input hidden id="user_id" name="user_id" value="<?= $user_id; ?>" >
    </form>
    <div class="Bottomlink">Back to <a href="<?= base_url('login'); ?>">Sign In</a></div>
</div>
<script>
$(document).ready(function() {
    $('#confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#errormsg').html('Matching').css('color', 'green');
            $('#password').focus().css('border', '2px solid green');
            $('#confirm_password').focus().css('border', '2px solid green');
            document.getElementById('resetButton').disabled = false;
        } else {
            $('#password').focus().css('border', '2px solid red');
            $('#confirm_password').focus().css('border', '2px solid red');
            $('#errormsg').html('Password Mismatch').css('color', 'red');
            document.getElementById('resetButton').disabled = true;
        }
    });
});
</script>
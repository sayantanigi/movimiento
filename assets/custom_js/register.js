$(document).ready(function(){
	$(".select-user-type input[name='type']").change(function() {
		if($(this).is(":checked")) {
			if($(this).val() == '1') {
				$('.displayOnType').show();
			} else {
				$('.displayOnType').hide();
			}
		}
	});
});

function onuserRegistration() {
	var base_url=$('#base_url').val();
    var userType=$(".select-user-type input[name='type']:checked").val();
	if(userType == '1'){
		var userSubtype=$(".select-user-subtype input[name='subtype']:checked").val();
	} else {
		var userSubtype='';
	}
	var firstname=$('#firstname').val();
	var lastname=$('#lastname').val();
	var email=$('#email').val();
	var password=$('#password').val();
	var conf_password=$('#confirmpassword').val();
    var pattern_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	if(userType=='') {
		$('#err_select-user-type').fadeIn().html('Please select your type').css('color','red');
		setTimeout(function(){$("#err_select-user-type").html("");},3000);
		$(".select-user-type").focus();
		return false;
	}

	if(userType == '1'){
		if(userSubtype == undefined) {
			$('#err_select-user-subtype').fadeIn().html('Please select your sub type').css('color','red');
			setTimeout(function(){$("#err_select-user-subtype").html("");},3000);
			$(".select-user-subtype").focus();
			return false;
		}
	}

	if(firstname=='') {
		$('#err_firstname').fadeIn().html('Please enter your first name').css('color','red');
		setTimeout(function(){$("#err_firstname").html("");},3000);
		$("#firstname").focus();
		return false;
	}

	if(lastname=='') {
		$('#err_lastname').fadeIn().html('Please enter your last name').css('color','red');
		setTimeout(function(){$("#err_lastname").html("");},3000);
		$("#lastname").focus();
		return false;
	}

	if(email=='') {
		$('#err_email').fadeIn().html('Please enter your email').css('color','red');
		setTimeout(function(){$("#err_email").html("");},3000);
		$("#email").focus();
		return false;

	} else if(!pattern_email.test(email)) {
		$("#err_email").fadeIn().html("Please enter a valid email address");
		setTimeout(function(){$("#err_email").html("");},5000)
		$("#email").focus();
		return false;
	}

	if(password=='') {
		$('#err_password').fadeIn().html('Please enter password').css('color','red');
		setTimeout(function(){$("#err_password").html("");},3000);
		$("#password").focus();
		return false;
	}

   	if(password.length<6) {
		$('#err_password').fadeIn().html('please enter at least 6 character').css('color','red');
		setTimeout(function(){$("#err_password").html("");},3000);
		$("#password").focus();
		return false;
	}

	if(conf_password=='') {
		$('#err_showconfirmpass').fadeIn().html('Please enter confirm password').css('color','red');
		setTimeout(function(){$("#err_showconfirmpass").html("");},3000);
		$("#showconfirmpass").focus();
		return false;
	}

   	if(conf_password.length<6) {
		$('#err_showconfirmpass').fadeIn().html('please enter at least 6 character').css('color','red');
		setTimeout(function(){$("#err_showconfirmpass").html("");},3000);
		$("#showconfirmpass").focus();
		return false;
	}

	if (password != conf_password) {
		$('#err_showconfirmpass').fadeIn().html('Password Mismatch').css('color','red');
		setTimeout(function(){$("#err_showconfirmpass").html("");},3000);
		return false;
	}
	
	$.ajax({
		url: base_url+'save',
		type: 'POST',
		data: {userType:userType, userSubtype:userSubtype, firstname:firstname, lastname:lastname, email:email, password:password},
		dataType:'json',
		beforeSend : function(){
			$("#rSignUp").text("Please Wait...");
			$("#rSignUp").prop("disable", "true");
		},
		success:function(returndata) {
			if(returndata.result==1) {
				$("#signUp_form")[0].reset();
				$(".displayOnType").hide();
				$('#register-messages').show();
				$("#rSignUp").text("Register");
			}
			if(returndata.result=='0') {
				if(returndata.data == 'email') {
					$('#err_email').fadeIn().html('This email already exists').css('color','red');
					setTimeout(function(){$("#err_email").html("");},3000);
					$("#email").focus();
					$("#rSignUp").text("Sign Up");
					return false;
				}
			}
			if(returndata.result==2) {
				$('#err-messages').show();
				setTimeout(function () {
                 	$('#register-messages').hide();
             	}, 20000);
				$("#rSignUp").text("Sign Up");
			}
		}
	});
}

function onuserLogin() {
	var base_url=$('#base_url').val();
	var login_email = $('#login_email').val();
	var login_pass = $('#login_password').val();
	var pattern_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	
	if(login_email=='') {
		$('#err_login_email').fadeIn().html('Please enter your email').css('color','red');
		setTimeout(function(){$("#err_login_email").html("");},3000);
		$("#login_email").focus();
		return false;

	} else if(!pattern_email.test(login_email)) {
		$("#err_login_email").fadeIn().html("Please enter a valid email address");
		setTimeout(function(){$("#err_login_email").html("");},5000)
		$("#login_email").focus();
		return false;
	}

	if(login_pass=='') {
		$('#err_login_password').fadeIn().html('Please enter password').css('color','red');
		setTimeout(function(){$("#err_login_password").html("");},3000);
		$("#login_password").focus();
		return false;
	}

   	if(login_pass.length<6) {
		$('#err_login_password').fadeIn().html('please enter at least 6 character').css('color','red');
		setTimeout(function(){$("#err_login_password").html("");},3000);
		$("#login_password").focus();
		return false;
	}
}

function onforgotPass() {
	var base_url=$('#base_url').val();
	var forgot_email = $('#forgot_email').val();
	var pattern_email = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	if(forgot_email=='') {
		$('#err_forgot_email').fadeIn().html('Please enter your email').css('color','red');
		setTimeout(function(){$("#err_forgot_email").html("");},3000);
		$("#forgot_email").focus();
		return false;

	} else if(!pattern_email.test(forgot_email)) {
		$("#err_forgot_email").fadeIn().html("Please enter a valid email address");
		setTimeout(function(){$("#err_forgot_email").html("");},5000)
		$("#forgot_email").focus();
		return false;
	}
	//console.log(forgot_email);
	$.ajax({
		url: base_url+'Home/send_forget_password',
		type: 'POST',
		data: {forgot_email: forgot_email},
		dataType:'json',
		beforeSend : function(){
			$("#rfPass").text("Please Wait...");
			$("#rfPass").prop("disable", "true");
		},
		success:function(returndata) {
			console.log(returndata);
			if(returndata.code == 1){
				$('.successMsg').text(returndata.result);
				$("#rfPass").text("Submit");
				$("#forgotPass")[0].reset();
				setTimeout(function(){
					$('.successMsg').text('');
				}, 5000);
			} else {
				$('.errorMsg').text(returndata.result);
				$("#rfPass").text("Submit");
				$('#forgotPass')[0].reset();
				setTimeout(function(){
					$('.errorMsg').text('');
				}, 5000);
			}
		}
	});
}
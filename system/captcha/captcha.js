$(function(){
	
	$("#refreshimg").click(function(){
		$.post('./captcha/newsession.php');
		$("#captchaimage").load('./captcha/image_req.php');
		return false;
	});
	
	$("#loginForm").validate({
		rules: {
			captcha: {
				required: true,
				remote: "./captcha/process.php"
			}
		},
		messages: {
			captcha: "Correct captcha is required. Click the captcha to generate a new one"	
		},
		submitHandler: function() {
			alert("Correct captcha!");
		},
		success: function(label) {
			label.addClass("valid").text("Valid captcha!")
		},
		onkeyup: false
	});
	
});

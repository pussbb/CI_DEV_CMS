<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'themes/system/reg/style.css';?>" />
<title><?php echo $this->lang->line('reg').' '.$this->config->item('site_name');?></title>

<script src="<?php echo base_url()?>system/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>system/js/jquery-validate/jquery.validate.pack.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>system/js/jquery-validate/localization/messages_<?php echo lang_id(); ?>.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen"  href="<?php echo base_url();?>system/js/jquery-validate/css/screen.css" />
<style type="text/css">

  img { border: 1px solid #eee; }

  p#statusgreen { font-size: 1.2em; background-color: #fff; color: #0a0; }

  p#statusred { font-size: 1.2em; background-color: #fff; color:#FF9999 /*#a00*/; }

  fieldset label { display: block; }

  fieldset div#captchaimage { float: left; margin-right: 15px; }

  fieldset input#captcha { width: 25%; border: 1px solid #ddd; padding: 2px; }

  fieldset input#submit { display: block; margin: 2% 0% 0% 0%; }

  #captcha.success {

  	border: 1px solid #49c24f;

	background: #bcffbf;

  }

  #captcha.error {

  	border: 1px solid #c24949;

	background: #ffbcbc;

  }

 </style>



 <script type="text/javascript">

$(function(){

	$("#refreshimg").click(function(){

		$.post('<?php echo base_url()?>system/captcha/newsession.php');

		$("#captchaimage").load('<?php echo base_url()?>system/captcha/image_req.php');

		return false;

	});

	

	$("#signapForm").validate({

		rules: {

			captcha: {

				required: true,

				remote: "<?php echo base_url()?>system/captcha/process.php"

			},

			username: {

				required: true,

				minlength: 5

			},

			password: {

				required: true,

				minlength: 6

			},

			confirm_password: {

				required: true,

				minlength: 6,

				equalTo: "#password"

			},

			email: {

				required: true,

				email: true

			},

			agree: "required"

		},

		messages: {

			captcha: "<?php echo $this->lang->line('captchaerror')?>"	

		}

	});

	

});

</script>

</head>

<body>



<div class="m"> 

<div class="mtop2"><?php echo $this->lang->line('reg'); ?></div>

<div class="mfor"><div class="menum3"><div class="logou"></div>

<?php



 ini_set('session.use_trans_sid', '0');



  // Include the random string file

  require './system/captcha/rand.php';



  // Begin the session

  session_start();

///

  // Set the session contents

  $_SESSION['captcha_id'] = $str;



;

?>

<div id="main">
<?php print_r($_SERVER)?>
<form class="cmxform" id="signapForm" method="post" action="<?php echo lang_url().'/'.time();?>">

<fieldset><legend></legend>

<legend>&nbsp;&nbsp;</legend>

<p>

<label for="сusername"><?php echo $this->lang->line('username'); ?></label>

<input id="сusername" name="username"  />

</p>

<p>

<label for="сemail">E-mail</label>

<input id="сemail" name="email"  />

</p>

<p>

<label for="password"><?php echo $this->lang->line('password'); ?></label>

<input type="password" id="password" name="password"  />

</p>

<p>

<label for="confirm_password"><?php echo $this->lang->line('repass'); ?></label>

<input type="password" id="confirm_password" name="confirm_password"  />

</p>

<div id="captchaimage"><a href="<?php echo base_url();?>register" id="refreshimg" title="Click to refresh image"><img src="<?php echo base_url();?>system/captcha/images/image.php?<?php echo time(); ?>" width="132" height="46" alt="Captcha image" /></a></div>

 <label for="captcha"><?php echo $this->lang->line('captchainfo'); ?></label>

 <input type="text" maxlength="6" name="captcha" id="captcha" />



<!--
<p>

<label style="width:70%;" for="agree">Да Я ознакомлен и согласен с правилами сайта</label>

<input type="checkbox" id="agree" name="agree" />

</p>
-->

<input class="submit" type="submit" value="Submit"/>

	</fieldset>

</form>

</div>

</div></div>

<div class="mbot3"> </div></div>



</body>

</html>
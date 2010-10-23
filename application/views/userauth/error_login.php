
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'themes/system/reg/style.css';?>" />
<title><?php echo $this->lang->line('login_error').' '.$this->config->item('site_name');?></title>
<script src="<?php echo base_url()?>system/js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>system/js/jquery-validate/jquery.validate.pack.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>system/js/jquery-validate/localization/messages_<?php echo lang_id(); ?>.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen"  href="<?php echo base_url();?>system/js/jquery-validate/css/screen.css" />
<link rel="stylesheet" type="text/css" media="screen"  href="<?php echo base_url();?>system/js/colorbox/colorbox.css" />
<script src="<?php echo base_url()?>system/js/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
<style type="text/css">
  html, body {
   color:#fff;
     font:11px Verdana;
   background:red;
}
  img { border: 1px solid #eee; }
  p#statusgreen { font-size: 1.2em; background-color: #fff; color: #0a0; }
  p#statusred { font-size: 1.2em; background-color: #fff; color: #a00; }
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

	$(".fancybox").colorbox({width:"80%", height:"80%", iframe:true});
	$("#loginForm").validate({
		rules: {
			captcha: {
				required: true,
				remote: "<?php echo base_url()?>system/captcha/process.php"
			},
			log: {
				required: true,
				minlength: 5
			},
			pwd: {
				required: true,
				minlength: 6
			}
				
			},
		messages: {
			captcha: "<?php echo $this->lang->line('captchaerror')?>"
		}
		
		
	
	});
	
});
</script>

</head>
<body>

<div class="m" > 
<div class="mtop2"><?php echo $this->lang->line('login_error');?></div>
<div class="mfor"><div class="menum3"><div class="logou"></div>
<br /><h3><?php	echo $msg;?></h3>
<div class="loginform" id="main">
<form class="cmxform" id="loginForm" method="post" action="">
<fieldset>

<label for="log"><?php echo $this->lang->line('username'); ?></label>
<input id="log" name="name" class="required" />
<p>
<label for="pwd"><?php echo $this->lang->line('password');?></label>
<input id="pwd"  type="password" name="pass" class="required" />
</p>
<div id="captchaimage"><a href="<?php echo base_url()?>login" id="refreshimg" title="Click to refresh image"><img src="<?php echo base_url()?>system/captcha/images/image.php?<?php echo time(); ?>" width="132" height="46" alt="Captcha image" /></a></div>
 <label for="captcha"><?php echo $this->lang->line('captchainfo'); ?></label>
 <input type="text" maxlength="6" name="captcha" id="captcha" />

<p> <input  class="submit"  align="right" type="submit" value="Войти"/></p>

</fieldset>
</form><?php echo anchor(lang_id()."/register",  $this->lang->line('reg')) ?>
&nbsp;  |  &nbsp;
<?php echo anchor(lang_id()."/lostpass",  $this->lang->line('lost_pass'), array('class' =>
'fancybox','title' =>
$this->lang->line('pass_recovery'))) ?>
</div> 
 <br /> <br /> <br />
</div>
<div class="mbot3"> </div></div>
</div>

</body>
</html>


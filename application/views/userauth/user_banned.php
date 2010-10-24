
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'themes/system/reg/style.css';?>" />
<title>login error</title>
<style type="text/css">
  html, body {
   color:#fff;
     font:11px Verdana;
   background:red;
}
 
 </style>
</head>
<body>

<div class="m"> 
<div class="mtop2"><?php echo $this->lang->line('login_error');?></div>
<div class="mfor"><div class="menum3"><div class="logou"></div>
<br /><h2><?php echo $this->lang->line('user_banned');?></h2> <br />
<h3><?php echo $this->lang->line('banned_reason_title');?> :</h3>
	<?php	echo $msg;?>
 <br />  <br />
 <?php echo $this->lang->line('banned_reason_info');?>
 <br /> <br /> 
</div>
<div class="mbot3"> </div>

</div>

</div>

</body>
</html>


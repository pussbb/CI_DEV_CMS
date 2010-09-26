
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'system/templates/KAuth/style.css';?>">
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
<div class="mtop2"><?php echo $heading;?></div>
<div class="mfor"><div class="menum3"><div class="logou"></div>
<br /><h2>Пользователь заблокирован администрацией. </h2> <br />
<h3>Причина :</h3>
<?php	echo $message;?>
 <br />  <br />
 Если Вы не согласны то напишите нам. Возможно действительно произошла ошибка.
 <br /> <br /> 
</div>
<div class="mbot3"> </div></div>

</body>
</html>


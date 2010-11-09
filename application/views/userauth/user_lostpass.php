<html  xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title>Error</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">

body {
background-color:#8A8A7A	;
margin:				40px;
font-family:		Lucida Grande, Verdana, Sans-serif;
font-size:			12px;
color:				#3C3C3C;
}

#content  {

 display: block;
border:				#999 1px solid;
background-color:	#f5f7f9	;
padding:			20px 20px 12px 20px;
}

h1 {
font-weight:		normal;
font-size:			14px;
color:				#990000;
margin: 			0 0 4px 0;
}
#display {
 font-family: Monaco, Verdana, Sans-serif;
 font-size: 12px;
 background-color: #f9f9f9;
 border: 1px solid #D0D0D0;
 color: #002166;
 display: block;
 margin: 14px 0 14px 0;
 padding: 12px 10px 12px 10px;
}

</style>
</head>
<body>
	

	<div id="display">
<?php
 if ($showform==true)
 {
     echo validation_errors(); ?>

<form action="<?php $PHP_SELF ?>" method="post"  name="fogot" id="fogot">
<legend><?php echo $this->lang->line('email_recovery_pass');?></legend><br />
<p><input type="text" id="email" name="email" /></p>
<input type="submit" />
</form>
<?php
 }
 else
 {
     echo $msg;
 }
 ?>
</div>

</body>
</html>
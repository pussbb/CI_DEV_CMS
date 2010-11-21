<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html>
<head>
    <title>404 Page Not Found</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style><!--

* {
    font-family: "Arial", Helvetica, Tahoma, serif; color:#000; font-size: 10pt;
    line-height: 1.5;
    margin: 0;
    padding: 0;
    z-index: 1;
    
}

p {
    padding-bottom: 1em;
}

.logo {
    position: absolute;
    left: 20px;
    top: 20px;
}

.transparentbox {
    width: 480px;
    border: #E54A29 1px solid;
}
.transparentbox span.top, .transparentbox span.top span, .transparentbox span.bottom, .transparentbox span.bottom span {
    display: block;
    position: relative;
    height: 15px;
    background-repeat: no-repeat;
    background-image: url(/images/roundedhallow.gif);
    font-size: 1px;  
}
.transparentbox span.top { top:-1px; left:-1px}
.transparentbox span.top span { left:2px; background-position: 100% -15px; }
.transparentbox span.bottom { top:1px; left:-1px; background-position: 0 -30px; }
.transparentbox span.bottom span { left:2px; background-position: 100% -45px; }

.error {
    background-image: url(/images/warn.gif);
    background-repeat: no-repeat;
    margin-left: 10px;
    padding: 1.5em;
    padding-left: 140px;
}
.language {
    position: absolute;
    z-index: 5;
    margin-left:380px;
}

.language a {
    background-color: #FCAE24;
    color: #fff;
    font-weight:bold;
    margin-right:2px;
    padding: 2px;
}

.active {
    background-color: #FCC65C !important;
    text-decoration: none !important;
}
h1 {
font-weight:		normal;
font-size:			14px;
color:				#990000;
margin: 			0 0 4px 0;
}

    --></style>
</head>
<body style="background-color:white;">
    <div class="logo">
      
    </div>
    <table border="0" cellspacing="0" cellpadding="0" width="100%" height="80%">
        <tr>
            <td valign="top" align="left">  
            <td valign="middle" align="center" width="100%">
                <div class="transparentbox">
                    
                    <span class="top"><span></span></span>  
                    <div class="error" align="left">
                    <h1><?php 
                      

        
        $a = explode('/', $_SERVER["REQUEST_URI"]);
        if (sizeof($a) > 0) {
            switch ($a[1]) {
                case 'ru':
                    {
                        $heading= "404 Старница не найдена";
$message = "Страницу которую Вы запросили не найденна.";
$back ='Вернуться назад';
                        break;
                    }
                case 'en':
                    {
                       $heading= "404 Page Not Found";
$message = "The page you requested was not found.";
$back ='Return to previous page';
                        break;
                    }
                default:
                    $back ='Return to previous page';break;

            }
        }  
                    echo $heading;  ?></h1>
		<?php echo $message; ?>
        <br />
        <div style="padding: 50px 0 0 0;">
        <a  href="javascript: history.go(-1)" ><?php echo $back;?></a>
        </div>
                    </div>
                    <span class="bottom"><span></span></span>  
                </div>
                
               </td>
            </td>
        </tr>
    </table>
</body>
</html>

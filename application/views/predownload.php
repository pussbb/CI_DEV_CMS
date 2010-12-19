<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Downloading <?=$name?></title>
	<script type="text/javascript" >

	    function move() {
	    window.location = '<?=base_url()?>/apps/download/<?=$id;?>';
	    }
	    setTimeout('move()',3000);
	</script>
    </head>
    <body style="background-color: #E9E5E2;height: 90%;padding: 15px;">
	<div style="background-color: #E9E5E2;height: 90%;padding: 15px;">
	    <p><h3><?=$this->lang->line('predownload')?></h3>
	    </p>
	    <p><span style="font-size: 12px;"><?=$this->lang->line('predownload2')?></span></p>
	    <a href="<?=base_url().$filepath;?>"><?=base_url().$filepath;?></a>
	</div>
    </body>
</html>




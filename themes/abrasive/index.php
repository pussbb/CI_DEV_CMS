<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?=$title?></title>
<meta name="keywords" content="<?= $meta ?>" />
<meta name="description" content="<?= $metadescr ?>" />
<link href="<?php echo base_url() . $this->config->item('pathtemplate'); ?>style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'themes/system/system.css';?>"/>
<?= $_styles ?>
<?= $_scripts ?>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="<?= base_url()?>admin/"><?= $this->config->item('site_name');?></a></h1>
			- <h2> || Administrator Area ||</h2>
		</div>
		<!-- end #logo -->
		<div id="menu">
			<ul>
				<li class="first"><a href="<?php echo lang_url('','apps'); ?>"><?= $this->lang->line('apps'); ?></a></li>
				<li><a href="<?=lang_url(null,'blog');?>"><?= $this->lang->line('blog'); ?></a></li>
				<li><a href="<?=lang_url(null,'news');?>"><?=lang('news')?></a></li>
				<li><a href="<?=lang_url(null,'users');?>"><?=lang('users')?></a></li>
			</ul>
		</div>
		<!-- end #menu -->
	</div>
	<!-- end #header -->
	<div id="page">
         
				<div id="content">
                                   <div class="post">
 <?=$content?>
					
						<div class="title">
							<h2><a href="#">Lorem Ipsum Dolor</a></h2>
							<p>Posted by <a href="#">enks</a> on November 19, 2008</p>
						</div>
						<div class="entry"><img src="images/img01.jpg" alt="" width="112" height="104" class="alignleft" />
							<p>This is abrasive, a free, fully standards-compliant CSS template designed by <a href="http://www.nodethirtythree.com/">NodeThirtyThree</a> for <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>. This free template is released under a <a href="http://creativecommons.org/licenses/by/2.5/">Creative Commons Attributions</a> license, so you’re pretty much free to do whatever you want with it (even use it commercially) provided you keep the links in the footer intact. Aside from that, have fun with it :)</p>
						</div>
					
				<!--- <div class="post"><?=$futures?>---></div>
				</div>
				 
				<!-- end #content -->
				<div class="sidebar">
				 
				<div id="sidebar">
					<ul><?=$sidemenu;?>
                                        </ul>
				</div>

				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
		
	</div>
	<!-- end #page -->
	<div id="footer">
		<p>Copyright (c) 2010</p>
	</div>
	<!-- end #footer -->
</div>
<!-- end #wrapper -->
</body>
</html>

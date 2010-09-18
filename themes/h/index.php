<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <base href="<?= base_url();?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>H Free Software Template</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . $this->config->item('pathtemplate'); ?>style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'themes/system/system.css';?>"/>
<?= $_scripts ?>
<?= $_styles ?>

</head>
<body>

<div id="main_container">
<a href="<?php echo "base_url().'ru'.uri_string()";?>"><img alt="rss news feed" src="<?php echo base_url()?>images/rss/Inside-rss-48.png" style="float: right; border:none; " /></a>
<a href="<?php echo lang_url('ru');?>"><img alt="russian lang" src="<?php echo base_url()?>images/flags/Rossiya-Russia-48.png" style="float: right; border:none; "/></a> 
<a href="<?php echo lang_url('en');?>"><img alt="english lang" src="<?php echo base_url()?>images/flags/UK-48.png" style="float: right; border:none; " /></a> 
<div id="header">
    	<div class="logo">
            <img alt="logo" src="<?= base_url() . $this->config->item('pathtemplate'); ?>images/logo.png" />
          <div class="logo_text"><?= $this->config->item('site_name');?></div>     </div>
             
    </div>
        <div class="menu">
        	<ul>                                                                         
        		<li class="selected"><a href="<?php echo base_url(true); ?>"><?php echo $this->lang->line('home'); ?></a></li>
                <li><a href="<?php echo base_url(true).'apps'; ?>"><?= $this->lang->line('apps'); ?></a></li>
                <li><a href="<?php echo base_url(true).'blog'; ?>"><?= $this->lang->line('blog'); ?></a></li>
                <li><a href="<?php echo base_url(true).'forum'; ?>"><?= $this->lang->line('forum'); ?></a></li>
                <li><a href="<?php echo base_url(true).'sitemap'; ?>"><?= $this->lang->line('sitemap'); ?></a></li>
                <!--
<li><a href="<?php echo base_url(true); ?>">themes</a></li>
-->
                <li><a href="<?php echo base_url(true).'about'; ?>"><?= $this->lang->line('contact'); ?></a></li>
        	</ul>
        </div>
        
    <div class="center_content">
  
     	<div class="center_left">
        	<div class="title_welcome"><span class="red">Get</span>Random app name</div>
        <div class="welcome_box">
<div class="welcome">
<p>

  <?php echo autogtrans('Привет  я переведен  с помощью гугла','ru'); ?>
   
  </p>
<a href="#" class="read_more"><?= $this->lang->line('readmore'); ?></a>			 
</div>
         </div>
         <div class="features">   
          <!--
  <div class="title">Main features</div>
            
                    <ul class="list">
                    <li><span>1</span><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</a></li>
                    <li><span>2</span><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</a></li>
                    <li><span>3</span><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</a></li>
                    <li><span>4</span><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</a></li>
                    </ul> 
-->
         </div> 
         
         
         <div class="features">   
           <?=$futures?>

         </div> 
        </div> 
        
        
        <div class="center_right">
        
       <!--- <div class="software_box"></div>-->
        
                        <div class="text_box">
                      <?php print $usermenu; ?>
                        </div>
                        <div class="testimonials">
                            <div class="text_box">
                             <p class="testimonial"><div class="title"><?= $this->lang->line('benchmark'); ?></div>
                             <?php echo $this->lang->line('time').': '.$this->benchmark->elapsed_time().'<br />'; ?>
                             <?= $this->lang->line('memory').': '.$this->benchmark->memory_usage().'<br />'; ?>
                              </p>
                           </div>                    
                        </div>
         </div>  
        
        <div class="clear"></div> 
    
    </div>    

    
    <div id="footer">                                              
        <div class="left_footer"><a href="<?php echo base_url(true); ?>"><?php echo $this->lang->line('home'); ?></a> <a href="<?php echo base_url(true).'apps'; ?>"><?= $this->lang->line('apps'); ?></a>
        <a href="<?php echo base_url(true).'forum'; ?>"><?= $this->lang->line('forum'); ?></a>
        <a href="<?php echo base_url(true).'about'; ?>"><?= $this->lang->line('contact'); ?></a></div>
        <div class="right_footer">#
        </div>   
    
    </div>
    
    
    
</div>
<!-- end of main_container -->

</body>
</html>
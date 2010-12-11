<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <base href="<?= base_url();?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?= $title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?= $meta ?>"/>
<meta name="description" content="<?= $metadescr ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . $this->config->item('pathtemplate'); ?>style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'themes/system/system.css';?>"/>
<?= $_styles ?>
<?= $_scripts ?>
<script type="text/javascript">
  lang_url='<?=  lang_id()?>';
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9529419-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>

<div id="main_container">
<a href="<?php echo base_url().'welcome/rss';?>"><img alt="rss news feed" src="<?php echo base_url()?>images/rss/Inside-rss-48.png" style="float: right; border:none; " /></a>
<a href="<?php echo lang_url('ru');?>"><img alt="russian lang" src="<?php echo base_url()?>images/flags/Rossiya-Russia-48.png" style="float: right; border:none; "/></a>
<a href="<?php echo lang_url('en');?>"><img alt="english lang" src="<?php echo base_url()?>images/flags/UK-48.png" style="float: right; border:none; " /></a>
<div id="header">
    	<div class="logo">
            <img alt="logo" src="<?= base_url() . $this->config->item('pathtemplate'); ?>images/logo.png" />
          <div class="logo_text"><?= $this->config->item('site_name');?></div>     </div>
             
    </div>
        <div class="menu">
        	<ul>  <?php $selected=$this->uri->segment(2, 0);?>
        	<li <?=($selected===0)?"class=\"selected\"":""?>><a href="<?php echo lang_url(); ?>"><?php echo $this->lang->line('home'); ?></a></li>
                <li <?=($selected==="apps")?"class=\"selected\"":""?>><a href="<?php echo lang_url('','apps'); ?>"><?= $this->lang->line('apps'); ?></a></li>
                <li <?=($selected==="blog")?"class=\"selected\"":""?>><a href="<?php echo lang_url('','blog'); ?>"><?= $this->lang->line('blog'); ?></a></li>
                <li <?=($selected==="forum")?"class=\"selected\"":""?>><a href="<?php echo base_url().'forum/'; ?>"><?= $this->lang->line('forum'); ?></a></li>
                <li <?=($selected==="sitemap")?"class=\"selected\"":""?>><a href="<?php echo lang_url('','sitemap'); ?>"><?= $this->lang->line('sitemap'); ?></a></li>
                <!--
<li><a href="<?php echo lang_url(); ?>">themes</a></li>
-->
                <li <?=($selected==="about")?"class=\"selected\"":""?>><a href="<?php echo lang_url(null,'about'); ?>"><?= $this->lang->line('contact'); ?></a></li>
        	</ul>
        </div>
        
    <div class="center_content">
   <!-- <iframe frameborder=0 marginwidth=0 marginheight=0 border=0 style="border:0;margin-left: 20px;width:728px;height:90px;" src="http://www.google.com/uds/modules/elements/newsshow/iframe.html?rsz=large&format=728x90&q=linux%2Cqt%2Cubuntu%2Ckubuntu%2Ckde&element=true" scrolling="no" allowtransparency="true"></iframe>
 -->
     	<div class="center_left">
            <div class="tmp_container" style="display:none;"></div>
           <div class="content">     <!-- Google News Element Code -->
                <?=$content?>
                 <div class="features">
                   <?=$futures?>

                 </div>
           </div>
        </div>
 
        
        
        <div class="center_right">
                        <div class="text_box">
			<?php print $usermenu; ?>
                        </div>
			
			<?=$sidemenu;?>
                        
			
                        
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
        <div class="left_footer"><a href="<?php echo lang_url(); ?>"><?php echo $this->lang->line('home'); ?></a> <a href="<?php echo lang_url().'apps'; ?>"><?= $this->lang->line('apps'); ?></a>
        <a href="<?php echo lang_url().'forum'; ?>"><?= $this->lang->line('forum'); ?></a>
        <a href="<?php echo lang_url().'about'; ?>"><?= $this->lang->line('contact'); ?></a></div>
        <div class="right_footer">#
        </div>   
    
    </div>
    
    
    
</div>
<!-- end of main_container -->

</body>
</html>
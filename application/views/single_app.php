<script type="text/javascript">
$(function(){ 

$('.rating<?=$id?> .starrate').rating({split:2});
$('.rating<?=$id?> .starrate').rating('select','<?=$rate?>')
$('.rating<?=$id?> .starrate').click(function(){
    //alert($('.rating .starrate:radio:checked').val());
	    $.post('<?=base_url()."apps/ratethis"?>',{ id:<?=$id?>, rate:$('.rating<?=$id?> .starrate:radio:checked').val() } ,
	function(data){

	    //$('.rating<?=$id?> .starrate').rating('select',data);
	});
	
});
});
</script>
<p class="title_welcome"><span class="red"><?=$name?></span>
<br /></p>
     <div class="welcome_box">
<div class="welcome">

<div class="app_side">
  <?php
  if(empty($image))
  {
      echo '<img src="'.base_url().'public/img/default.png" title="application icon">';
  }
  else
  {
      echo '<img src="'.base_url().$image.'" title="application icon">';
  }
 ?><br />
<span id="rating_box" class="rating<?=$id?>">
<input style="display: none;" class="starrate " type="radio" name="star" value="0.50"/>
<input style="display: none;"  class="starrate" type="radio" name="star" value="1.00"/>
<input style="display: none;"  class="starrate" type="radio" name="star" value="1.50"/>
<input style="display: none;"  class="starrate" type="radio" name="star" value="2.00"/>
<input style="display: none;"  class="starrate" type="radio" name="star"value="2.50"/>
<input style="display: none;"  class="starrate" type="radio" name="star" value="3.00"/>
<input style="display: none;"  class="starrate" type="radio" name="star" value="3.50" />
<input style="display: none;"  class="starrate" type="radio" name="star" value="4.00"/>
<input style="display: none;"  class="starrate" type="radio" name="star" value="4.50"/>
<input style="display: none;"  class="starrate" type="radio" name="star" value="5.00"/>
</span></div>
 <p> <?=autogtrans($descr,'ru'); ?>

  </p>
  <a class="downloadbox read_more tool_tip" title="<?=$details?>" href="<?php echo lang_url(null, 'apps/predownload/'.$id);?>" ><?= $this->lang->line('download'); ?></a>
</div>
         </div>
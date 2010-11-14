<div class="title_welcome"><span class="red"><?=$name?></span> </div>
        <div class="welcome_box">
<div class="welcome">
<p>

  <?php
  if(empty($image))
  {
      echo '<img src="./public/img/default.png" title="application icon">';
  }
  echo autogtrans($descr,'ru'); ?>

  </p>
<a href="#" class="read_more"><?= $this->lang->line('download'); ?></a>
</div>
         </div>
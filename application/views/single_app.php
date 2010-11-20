<!--stdClass Object (
[id] => 26
[filepath] => public/linux/hda/qhda_0_0_2_alpha_bin.tar.gz
[name] => QHDA binary
[descr] => Help Doc Assistant обыкновенная программа справки только отличаеться тем что есть возможность синхронизации с сайтом. Подробнее сюда
[rate] => 0.00
[catid] => 4
[image] =>
[details] => Size: 881.9 KB
Date :23.03.10 [downed] => 26 )-->
<div class="title_welcome"><span class="red"><?=$name?></span> </div>
        <div class="welcome_box">
<div class="welcome">
<p>

  <?php
  if(empty($image))
  {
      echo '<img src="'.base_url().'public/img/default.png" title="application icon">';
  }
  else
  {
      echo '<img src="'.base_url().$image.'" title="application icon">';
  }
  echo autogtrans($descr,'ru'); ?>

  </p>
  <a class="downloadbox read_more" href="<?php echo base_url().'apps/'?>" title="<?= $this->lang->line('download').'-'.$name; ?>"><?= $this->lang->line('download'); ?></a>
</div>
         </div>
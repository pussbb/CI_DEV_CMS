<?php
if ($this->uri->segment(3) != 'pdf') {
?><span style="float: right;margin:-9px 10px 0px 0px;">
      <!--  <a href="<?=  base_url().'blog/print/'.$url?>" title="printable version">
            <img width="22" src="<?=base_url()?>images/print.png">
        </a>-->
        <a href="<?=  lang_url(null,'blog/pdf/'.$url)?>.pdf" title="pdf export">
            <img width="22" src="<?=base_url()?>images/pdf.png" >
        </a>
    </span>
<?php

}
?>
<div class="title" align="center"><?=$title?></div>
<hr>
<div ><?php echo $this->lang->line('cat').": ".anchor(lang_id().'/blog/viewcat/'.$catid, $blogcat_name,
        "title=\"$blogcat_name\"")."  ".$this->lang->line('author').": <a href=\"".  lang_url(null,'user/profile/'.$name)."\"> $name</a>";?>
          <?=date("F j, Y, g:i a",  strtotime($datepost)); ?></div>
<hr>
<br />
<div style="margin:5px;">
    <?=$textpost?>
</div>

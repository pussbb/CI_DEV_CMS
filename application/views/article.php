<div class="title" align="center"><?=$title?></div>
<hr>
<div ><?php echo $this->lang->line('cat').":&nbsp;".anchor(lang_id().'/blog/viewcat/'.$catid, $blogcat_name,
        "title=\"$blogcat_name\"")."&nbsp;&nbsp;".$this->lang->line('author').":&nbsp;&nbsp$name";?>
    &nbsp;&nbsp&nbsp;&nbsp<?=date("F j, Y, g:i a",  strtotime($datepost)); ?><span style="float: right;margin:-9px 10px 0px 0px;">
        <a href="<?=  base_url().'blog/print/'.$url?>" title="printable version">
            <img width="22" src="<?=base_url()?>images/print.png">
        </a>
        <a href="<?=  base_url().'blog/pdf/'.$url?>.pdf" title="pdf export">
            <img width="22" src="<?=base_url()?>images/pdf.png" >
        </a>
    </span></div>
<hr>
<br />
<div style="margin:5px;">
    <?=$textpost?>
</div>

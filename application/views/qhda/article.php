<div class="title" align="center"><?=$name?></div>
<hr>
<div ><?php
echo $this->lang->line('cat').": ".anchor(lang_id().'/blog/qhda/'.$book_title['id'], $book_title['name'].' - '.$book_title['catname'],"title=\"".$book_title['name'].' - '.$book_title['catname']."\"")." || ".$this->lang->line('author').": ". $author;?>
          || <?=date("F j, Y, g:i a",  strtotime($pdate)); ?></div>
<hr>
<br />
<div style="margin:5px;">
    <?= syntaxhilight($body)?>
</div>

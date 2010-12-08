<div id="ajax_content" style="width: 490px;">
<span class="ajax_pag"><?=$pag_links;?> </span>
<?foreach($articles as $item):?>

<div align="center"><h3><a  href="<?=  lang_url('','blog/qhda/article/'.$item->id.'.html');?>"><?=$item->name?></a></h3></div><br />
  <p> <?=$item->body?></p>
<hr>
<?endforeach;?>

<span class="ajax_pag"><?=$pag_links;?> </span></div>
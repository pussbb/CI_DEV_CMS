<div id="ajax_content">
<span class="ajax_pag"><?=$pag_links;?> </span>
<?foreach($articles as $item):?>

<div align="center"><h3><a  href="<?=  lang_url('','blog/article/'.$item->url.'.html');?>"><?=$item->title?></a></h3></div><br />
  <p> <?=$item->shorttext?></p>
<hr>
<?endforeach;?>

<span class="ajax_pag"><?=$pag_links;?> </span></div>
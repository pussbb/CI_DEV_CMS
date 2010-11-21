
<div id="ajax_content">
<span class="ajax_pag"><?=$pag_links;?> </span>
<?foreach($articles as $item):?>
<h3><?=$item->title?></h3><br />
  <p> <?=$item->shorttext?></p>

<?endforeach;?>

<span class="ajax_pag"><?=$pag_links;?> </span></div>
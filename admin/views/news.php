<script type="text/javascript">
  function display_msg(id)
{
    $('#msg'+id).toggle();
}
function delete_me(id)
{   <?php if($this->config->item('folder')==true)
    $url=  base_url().$this->config->item('folder_name')."/";
        else $url=  base_url();?>
    $.post("<?=$url?>actions/delete_news",{"id":id},function(data)
              {

              });
     $('#msg'+id).remove();
     $('#title'+id).remove();
}
</script>
<table id="rounded-corner" style="width:100%;" summary="inbox pms">
    <thead>
    	<tr>
            <th scope="col" class="rounded-company">#</th>
            <th scope="col" class="rounded-q3"><?= lang('title');?></th>
            <th scope="col" class="rounded-q4"><?= lang('option');?></th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="3" class="rounded-foot-left"><em><?= lang('inbox_help');?></em></td>

        </tr>
    </tfoot>
    <tbody>
    	<?php
foreach($news as $item)
{
 echo '<tr id="title'.$item->id.'"><td>'.$item->id.'</td><td>'.$item->title.'</td>
     <td><img title="'.lang('delete').'" onclick="delete_me('.$item->id.');" src="'.  base_url().'images/Remove.png">
         <img title="'.lang('view').'"  onclick="display_msg('.$item->id.');" src="'.  base_url().'images/Preview.png">
</td></tr>' ;
 echo '<tr id="msg'.$item->id.'" new="" style="display:none;"><td colspan="3">'.lang('text').': '.$item->text.'</td></tr>' ;
}
?>
    </tbody>
</table>
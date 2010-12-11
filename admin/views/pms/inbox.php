<script type="text/javascript">
  function display_msg(id)
{
    if($('#msg'+id).attr('new')==1)
        {
            $.post(url+lang_url+"/user/pms/toold",{"id":id},function(data)
              {
                  
              });
              $('#msg'+id).attr('new',0);
        }
     
    $('#msg'+id).toggle();
}
function delete_me(id)
{
    $.post(url+lang_url+"/user/pms/del",{"id":id},function(data)
              {

              });
     $('#msg'+id).remove();
     $('#title'+id).remove();
}
</script>
<table id="rounded-corner" summary="inbox pms">
    <thead>
    	<tr>
            <th scope="col" class="rounded-company"><?= lang('from');?></th>
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
foreach($inbox as $item)
{
 echo '<tr id="title'.$item->id.'"><td>'.$item->namefrom.'</td><td>'.$item->title.'</td>
     <td><img title="'.lang('delete').'" onclick="delete_me('.$item->id.');" src="'.  base_url().'images/Remove.png">
         <img title="'.lang('view').'"  onclick="display_msg('.$item->id.');" src="'.  base_url().'images/Preview.png">
</td></tr>' ;
 echo '<tr id="msg'.$item->id.'" new="'.$item->inbox.'" style="display:none;"><td colspan="3">'.lang('text').': '.$item->msg.'</td></tr>' ;
}
?>
    </tbody>
</table>
<input class="cancel_new_pms" type="button" onclick="pms_close();" value="<?= lang('cancel')?>">
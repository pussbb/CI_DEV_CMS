
<div class="status" style="display:none;"></div>
<div>
<div class="user_info"  style="float:left;margin-right: 10px;">
 <img class="avatar" style="border:none;float:left;" src="<?php echo base_url().$user->avatar;?>" alt="avatar" />
 User name:<?= $user->name;?><br />
 E-mail:<?= $user->email?> <br />
 Created: <?=$user->created?><br />
 Last IP: <?=$user->lastip?><br />
 Last Login: <?=$user->last_login?><br />
</div>
<div style="float:left;">
<form id="useredit<?=$user->id?>" name="useredit" >
<p style="float:left;margin-right: 5px;" >
    <input type="checkbox" name="banned" value="1" <?=$user->banned>0?"checked":""?>/>Banned<br />
     <legend>Bann reason</legend><br/>
     <textarea cols="39" rows="9" name="banedreason" ><?=$user->banedreason?></textarea>
      
</p>
<p style="float:left;margin-right: 5px;" >
<legend>Permissions </legend> <br/>
      <table border="1" >
          <thead>
              <tr>
                  <th>User Type</th>
                  <th>Edit</th>
                  <th>add</th>
                  <th>Read</th>
              </tr>
          </thead>
          <tbody>
              
                  <?php $all=1;
                  foreach (unserialize($user->permission) as $key => $value) {
                      
                      if(is_array($value))
                      { echo "<tr><td>$key</td>";
                      $i=0;
                          
                          foreach ($value as $item)
                          {
                              $checked="";
                              if($item>0) $checked="checked";
                              echo '<td><input type="checkbox" id="permission'.$user->id.'"   value="'.$user->id.$all.'" '.$checked.'  /> </td>';
                              echo '<input id="'.$user->id.$all++.'" type="hidden" name="'.$key.'['.$i++.']" value="'.$item.'" />';
                          }
                          echo "</tr>";
                      }
                       else
                      {
                          echo '<input name="'.$key.'" type="hidden" value="'.$value.'" />';
                      }
                  }
                  ?>
          </tbody>
      </table> </p>
      <input type="hidden" name="user_id" value="<?=$user->id?>" />
      <input id="saveForm" class="button_text" type="button" value="Submit" onclick="update_user(<?=$user->id?>)"/>
     
</form>
     </div>
    </div>
<script type="text/javascript" >
 
        //var v=$(this).val;
        $('input:checkbox').click(function(){
            if($(this).attr('id')=='permission<?=$user->id?>')
                {
                    if($(this).is(':checked'))
                       $('#'+$(this).val()).val(1);
                   else $('#'+$(this).val()).val(0);
                  
                }
            
        });
   
 function update_user(id)
 {
      $.post('<?=base_url()?>admin/welcome/edituser',$('#useredit'+id).serialize(),function(data)
        {
            $('.status').show().html(data);
           // $('#useredit').hide();
        });
 }
</script>
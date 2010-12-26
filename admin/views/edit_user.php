<?php
/* `ci_users`.`id`,
`ci_users`.`name`,
`ci_users`.`pass`,
`ci_users`.`email`,
`ci_users`.`banned`,
`ci_users`.`banedreason`,
`ci_users`.`created`,
`ci_users`.`lastip`,
`ci_users`.`last_login`,
`ci_users`.`permission`,
`ci_users`.`groupid`,
`ci_users`.`avatar`
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="status" style="display:none;"></div>
<div class="user_info">
 <img class="avatar" style="border:none;float:left;" src="<?php echo base_url().$user->avatar;?>" alt="avatar" />
 User name:<?= $user->name;?><br />
 E-mail:<?= $user->email?> <br />
 Created: <?=$user->created?><br />
 Last IP: <?=$user->lastip?><br />
 Last Login: <?=$user->last_login?><br />
</div>

<form id="useredit" name="useredit" >
   
    <input type="checkbox" name="banned" value="1" <?=$user->banned>0?"checked":""?>/>Banned<br />
     <legend>Bann reason</legend><br/>
     <textarea name="banedreason" ><?=$user->banedreason?></textarea>
      <legend>Permissions</legend><br/>
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
                              echo '<td><input type="checkbox" id="permission"   value="'.$all.'" '.$checked.'  /> </td>';
                              echo '<input id="'.$all++.'" type="hidden" name="'.$key.'['.$i++.']" value="'.$item.'" />';
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
      </table>
      <input type="hidden" name="user_id" value="<?=$user->id?>" />
      <input id="saveForm" class="button_text" type="button" value="Submit" onclick="update_user()"/>
</form>
<script type="text/javascript" >
 
        //var v=$(this).val;
        $('input:checkbox').click(function(){
            if($(this).attr('id')=='permission')
                {
                    if($(this).is(':checked'))
                       $('#'+$(this).val()).val(1);
                   else $('#'+$(this).val()).val(0);
                  
                }
            
        });
   
 function update_user()
 {
      $.post('<?=  base_url()?>admin/welcome/edituser',$('#useredit').serialize(),function(data)
        {
            $('.status').show().html(data);
           // $('#useredit').hide();
        });
 }
</script>
<script>
    $(function() {
$(":date").dateinput({
    format: 'dd.mm.yyyy',
    selectors: true
});
if($('input[name=visible]').val()==1)
            {
               $('input[name=visible]').attr('checked', true);
            }
    });
    function visibility()
    {
        if($('input[name=visible]').is(':checked'))
            {
                $('input[name=visible]').val(1);
            }
            else
                {
                    $('input[name=visible]').val(0);
                }

    }
</script>
Avatar<br/>
<img class="avatar" style="border:none;" src="<?php echo base_url().$avatar;?>" alt="avatar" />
<input type="button" onclick="$('.postava').toggle( 200 );" value="<?=lang('change')?>">
            <form class="postava" style="display:none;" action="<?= base_url();?>user/avatarup" method="POST" enctype="multipart/form-data">
                <input type="file" name="file" id="file" value="" /><input type="submit" value="Send" />
</form>
<form style="margin-left:25%;" action="" method="POST">
<fieldset style="border:none;">
    <legend><?=lang('sername');?></legend>
    <input type="text" name="sername" value="<?= $sername;?>" />
      <legend><?=lang('real_name');?></legend>
    <input type="text" name="real_name" value="<?= $real_name;?>" />
      <legend><?=lang('second_name');?></legend>
    <input type="text" name="second_name" value="<?= $second_name?>" />
      <legend><?=lang('company');?></legend>
    <input type="text" name="company" value="<?= $company;?>" />
     <legend><?=lang('phone');?></legend>
     <input type="text" name="phone" value="<?= $phone;?>" maxlength="13" />
     <legend>icq</legend>
     <input type="text" name="icq" value="<?= $icq;?>"  />
      <legend>fax</legend>
     <input type="text" name="fax" value="<?= $fax;?>" maxlength="13" />
      <legend><?=lang('post');?></legend>
     <input type="text" name="post" value="<?= $post;?>" maxlength="13" />
        <legend><?=lang('adress');?></legend>
     <input type="text" name="adress" value="<?= $adress;?>" maxlength="13" />
           <legend><?=lang('birthday');?></legend>
     <input type="date" name="birthday" value="<?=$birthday?>"/>
         
     <input type="checkbox" name="visible" value="<?=$visible?>" onclick="visibility();"/><?=lang('visible_prof')?><br/>
     <input type="submit" value="<?=lang('change')?>" />
</fieldset>
 </form>

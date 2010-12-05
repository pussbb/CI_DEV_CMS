<?php
if(isset($visible) && $visible!=0)
{

?>
Avatar<br/>
<img class="avatar" style="border:none;" src="<?php echo base_url().$avatar;?>" alt="avatar" /><br/>
<?=lang('sername');?> :<?= $sername;?>" <br/>
<?=lang('real_name');?>  : <?= $real_name;?> <br/>
<?=lang('second_name');?> :  <?= $second_name?>"<br/>
<?=lang('company');?>  : <?= $company;?>"<br/>
<?=lang('phone');?> : <?= $phone;?> <br/>
icq : <?= $icq;?> <br/>
fax :  <?= $fax;?><br/>
<?=lang('post');?> : <?= $post;?><br/>
<?=lang('adress');?>  : <?= $adress;?><br/>
<?=lang('birthday');?> : <?=$birthday?><br/>
<?php
}
else {
 echo lang('profile_denied');
}
?>
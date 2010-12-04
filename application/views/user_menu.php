<div class="title" style="font-size:12px;">
<?=$this->lang->line('username')?> :  <?=$this->session->userdata('username') ?></div>
<p>
    <?=$this->lang->line('pms');?>
    <ul style="list-style: none;margin-top: -3px;" class="pms_list" >
        <li class="pms_new"><?=$this->lang->line('newpms');?></li>
        <li class="pms_inbox"><?=$this->lang->line('inbox');?> : <?=$inbox?></li>
        <li class="pms_outbox"><?=$this->lang->line('outbox');?></li>
    </ul>
<a href="<?=  lang_url(null,"user/settings");?>">user settings</a>
</p>
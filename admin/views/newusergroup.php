<div class="status" style="display:none;"></div>
<form id="newusergroup" name="newusergroup">
    <legend>Title</legend><br/>
    <input type="input" name="title" value="<?=$data['name']?>"/><br/>
    <br/>

    <?php $this->load->view('perm_builder',array('id'=>$data['id'],'permission'=>$data['permissions']))?>
        <?php
                            if($data['id']!=0)
                            {
                                echo '<input type="hidden" name="usergroup_id" value="'.$data['id'].'" />';
                            }
                          ?>
        <input id="saveForm" class="button_text" type="button" value="Submit" onclick="save_blogcat()"/>

</form>
<script type="text/javascript" >
 function save_blogcat()
 {
      $.post('<?=  base_url()?>admin/welcome/newusergroup',$('#newusergroup').serialize(),function(data)
        {
            $('.status').show().html(data);
            $('#newusergroup').hide();
        });
 }
</script>
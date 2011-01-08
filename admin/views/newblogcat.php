<div class="status" style="display:none;"></div>
<form id="blogcatname" name="blogcatname">
    <legend>Title</legend><br/>
    <input type="input" name="title" value="<?=$data['blogcat_name']?>"/><br/>
    <legend>Description</legend><br/>
    <textarea name="blogcat_desr" rows="4" style="width:40%;" name="blogcat_desr"><?=$data['blogcat_desr']?>
        </textarea><br/>
    <?php $this->load->view('perm_builder',array('id'=>$data['id'],'permission'=>$data['permissions']))?>
        <?php
                            if($data['id']!=0)
                            {
                                echo '<input type="hidden" name="blogcat_id" value="'.$data['id'].'" />';
                            }
                          ?>
        <input id="saveForm" class="button_text" type="button" value="Submit" onclick="save_blogcat()"/>

</form>
<script type="text/javascript" >
 function save_blogcat()
 {
      $.post('<?=  base_url()?>admin/welcome/newblogcat',$('#blogcatname').serialize(),function(data)
        {
            $('.status').show().html(data);
            $('#blogcatname').hide();
        });
 }
</script>
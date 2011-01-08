<div class="status" style="display:none;"></div>
<form id="downcatname" name="downcatname">
    <legend>Title</legend><br/>
    <input type="input" name="title" value="<?=$data['catname']?>"/><br/>
    <legend>Description</legend><br/>
    <textarea rows="4" style="width:40%;" name="catdescr"><?=$data['catdescr']?>
        </textarea><br/>
    <?php $this->load->view('perm_builder',array('id'=>$data['id'],'permission'=>$data['permission']))?>
        <?php
                            if($data['id']!=0)
                            {
                                echo '<input type="hidden" name="downcat_id" value="'.$data['id'].'" />';
                            }
                          ?>
        <input id="saveForm" class="button_text" type="button" value="Submit" onclick="save_downcat()"/>

</form>
<script type="text/javascript" >
 function save_downcat()
 {
      $.post('<?=  base_url()?>admin/welcome/newdowncat',$('#downcatname').serialize(),function(data)
        {
            $('.status').show().html(data);
            $('#downcatname').hide();
        });
 }
</script>
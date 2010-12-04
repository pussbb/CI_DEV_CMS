
<form name="new_pms" style="width:500px">
    <fieldset style="width:450px;border: none;">
        <legend><?= lang('title')?></legend>
        <input type="text" name="title" value="" />
      <?=lang('to')?>  <select name="user">
            <?foreach($users as $user){?>
            <option value="<?=$user->id?>"><?=$user->name?></option>
            <?php }?>
        </select>
   <legend><?= lang('text')?></legend>
    <textarea style="width:450px" class="ckeditor" id="editor1" name="text" rows="10" >
    </textarea>
   <br/><script type="text/javascript">
       var text_new;
			text_new=CKEDITOR.replace( 'text' ,{
                                    toolbar:
        [
            ['Source','-','Preview','Templates'],['TextColor','BGColor'],'/'
            ['Cut','Copy','Paste','PasteText','PasteFromWord'],
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            ['Bold','Italic','Underline','Strike'],
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['Link','Unlink','Anchor'],
            ['Image','Smiley','SpecialChar'],
            ['Styles','Format','Font','FontSize'],
        ]
       
                                });
        function cancel_new_msg()
        {
            text_new.destroy();
            pms_close();
        }
			</script>
    <input class="send_new_pms" type="button" value="<?= lang('send')?>">
    <input class="cancel_new_pms" type="button" onclick="cancel_new_msg();" value="<?= lang('cancel')?>">
    </fieldset>
</form>
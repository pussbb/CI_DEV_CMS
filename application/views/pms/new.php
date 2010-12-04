<?php print_r($users);?>
<form name="new_pms">
    <fieldset>
        <legend><?= lang('title')?></legend>
        <input type="text" name="title" value="" />
        <select name="user">
            <?foreach($users as $user)?>
            <option value=""></option>
            
        </select>
   <legend><?= lang('text')?></legend>
    <textarea class="ckeditor" cols="50" id="editor1" name="text" rows="10" >
    </textarea>
   <br/><script type="text/javascript">
				CKEDITOR.replace( 'text' ,{
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
			</script>
    <input class="send_new_pms" type="button" value="<?= lang('send')?>">
    </fieldset>
</form>
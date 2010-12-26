<div class="status" style="display:none;"></div>
<form  id="newfile" name="newfile">
 
        <legend>Name</legend>
        <input style="width:40%;" type="text" name="namefile" value="<?=$data['name']?>" /><br/>
        <div style="display:table;">
            <div style="float:left;">
                <legend>File  || <span style="cursor: pointer;color: red;" onclick="$('#filetree').toggle();">Show/Hide file tree</span>
                </legend>
                <br/>
                <input  id="file" type="text" name="file" value="<?=$data['filepath']?>"/>
                <div id="filetree" style="display: none;"></div>
            </div>
            <div style="float:right;">
                <legend>Image  || <span style="cursor: pointer;color: red;" onclick="$('#filetreeimage').toggle();">Show/Hide file tree</span></legend>
                <br/>
                <input   id="fileimage" type="text" name="image" value="<?=$data['image']?>">
                <div id="filetreeimage" style="display: none;"></div>
            </div>
        </div><br/>
        <legend><?= lang('cats') ?></legend>
        <select name="catid">
            <?php
            $selected = "";
            foreach ($cats as $cat) {
                if ($data['catid'] == $cat->id)
                    $selected = "selected";
                else
                    $selected="";
                echo "<option value=\"$cat->id\" $selected>$cat->catname</option>";
            }
            ?>
        </select><br/>
        <legend>Description</legend>
        <textarea id="descr" name="descr">
<?=$data['descr']?>
        </textarea>
        <input type="button" value="Submit" onclick="save_file()"/>
<?php
if(isset($data['id']))
{
   echo '<input type="hidden" name="app_id" value="'.$data['id'].'" />';
}
?>
</form>

<script src="<?= base_url() ?>system/js/jqueryFileTree/jqueryFileTree.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>system/js/jqueryFileTree/jqueryFileTree.css"/>
<script type="text/javascript" >
    $('#descr').ckeditor(
    {
        customConfig : 'admin_config.js',
        extraPlugins : 'syntaxhighlight'

    });
    $('#filetree').fileTree({ root: '../../../../public/'
        ,script: '<?= base_url() ?>system/js/jqueryFileTree/connectors/jqueryFileTree.php'}, function(file) {
        $('#file').val(file);
    });
    $('#filetreeimage').fileTree({ root: '../../../../public/'
        ,script: '<?= base_url() ?>system/js/jqueryFileTree/connectors/jqueryFileTree.php'}, function(file) {
        $('#fileimage').val(file);
    });
    function save_file()
    {
        $.post('<?= base_url() ?>admin/welcome/newfile',$('#newfile').serialize(),function(data)
        {
            $('.status').show().html(data);
            $('#newfile').hide();
        });
    }
</script>
<form name="newfile">
    <fieldset>
        <legend>Name</legend>
        <input style="width:40%;" type="text" name="namefile">
        <legend>File  || <span style="cursor: pointer;color: red;" onclick="$('#filetree').toggle();">Show/Hide file tree</span></legend>
        <input style="width:40%;" id="file" type="text" name="file">
        <div id="filetree" style="display: none;"></div>
        <legend>Description</legend>
        <textarea id="descr" name="descr">
        </textarea>
        <input type="button" value="Submit" />
    </fieldset>
</form>

<script src="<?=  base_url()?>system/js/jqueryFileTree/jqueryFileTree.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?=  base_url()?>system/js/jqueryFileTree/jqueryFileTree.css"/>
<script type="text/javascript" >
    $('#descr').ckeditor(
    {
        customConfig : 'admin_config.js',
        extraPlugins : 'syntaxhighlight'

    });
$('#filetree').fileTree({ root: '../../../../public/'
    ,script: '<?=  base_url()?>system/js/jqueryFileTree/connectors/jqueryFileTree.php'}, function(file) {
    $('#file').val(file);
    });

</script>
<form id="addnews_form" action="addnews">
    <?=lang('title')?><input type="text" name="title" value="" />
   <br/><?=lang('text')?><br/>
    <textarea id="newsbody" name="body" rows="4" cols="20">
    </textarea>
    <input type="button" value="Submit" onclick="addnews_form">
</form>
<script type="text/javascript" >
   $('#newsbody').ckeditor(
    {
        extraPlugins : 'syntaxhighlight',
        toolbar:
        [
            ['Source','-','Save','NewPage','Preview','-','Templates'],
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            ['BidiLtr', 'BidiRtl'],
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],'/',
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['Link','Unlink','Anchor'],
            ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
            ['TextColor','BGColor','Code'],'/',
            ['Styles','Format','Font','FontSize'],
        ]
    });
</script>
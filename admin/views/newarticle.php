<div class="status" style="display:none;"></div>
<form id="form_71837" class="appnitro"  method="post" action="">
<div class="form_description">
<h2><?=lang('newarticle')?></h2>
			<p><!-- description --></p>
		</div>
			<ul >

					<li id="li_1" >
		<label class="description" for="element_1">Title</label>
		<div>
			<input id="element_1" name="title" class="element text medium" type="text" maxlength="255" value="<?=$data['title']?>"/>
		</div>
		</li>		<li id="li_2" >
		<label class="description" for="element_2">URL </label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value="<?=$data['url']?>"/>
                        <input id="url" name="url" class="element text medium" type="hidden" maxlength="255" value="<?=$data['url']?>"/>
		</div>
		</li>		<li id="li_5" >
		<label class="description" for="element_5"><?=lang('cat')?> </label>
		<div>
		<select class="element select medium" id="element_5" name="catid">
                        <?php
                        $selected="";
                            foreach($cats as $cat)
                            {
                                if($data['catid']==$cat->id) $selected="selected";
                                    else $selected="";
                                echo "<option value=\"$cat->id\" $selected>$cat->blogcat_name</option>";
                            }
                        ?>
		</select>
		</div>
		</li>		<li id="li_4" >
		<label class="description" for="element_4">keywords </label>
		<div>
			<input id="element_4" name="keywords" class="element text medium" type="text" maxlength="255" value="<?=$data['keywords']?>"/>
		</div>
		</li>
                <li id="li_4" >
		<label class="description" for="mainpage"></label>
		<div>
                    <input type="checkbox" name="mainpage" value="1"<?=$data['mainpage']>0?"checked":""?> />In main page
		</div>
		</li>
                <li id="li_3" >
		<label class="description" for="text">Text </label>
		<div>
			<textarea id="text_blog" name="text" class="element textarea medium"><?=$data['textpost']?></textarea>
		</div>
		</li>

					<li class="buttons">
			  <?php
                            if(!empty($data['title']))
                            {
                                echo '<input type="hidden" name="article_id" value="'.$data['id'].'" />';
                            }
                          ?>

				<input id="saveForm" class="button_text" type="button" value="Submit" onclick="save_article()"/>
		</li>
			</ul>
		</form>
<script type="text/javascript" >
   $('#text_blog').ckeditor(
    {
        customConfig : 'admin_config.js',
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

        $('#element_2').syncTranslit({destination: 'url'});
 function save_article()
 {
      $.post('<?=  base_url()?>admin/welcome/article',$('#form_71837').serialize(),function(data)
        {
            $('.status').show().html(data);
            $('#form_71837').hide();
        });
 }
</script>
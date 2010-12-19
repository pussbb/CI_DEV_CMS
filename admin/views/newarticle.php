<form id="form_71837" class="appnitro"  method="post" action="">
<div class="form_description">
<h2><?=lang('newarticle')?></h2>
			<p><!-- description --></p>
		</div>
			<ul >

					<li id="li_1" >
		<label class="description" for="element_1">Title</label>
		<div>
			<input id="element_1" name="title" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>		<li id="li_2" >
		<label class="description" for="element_2">URL </label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value=""/>
                        <input id="url" name="url" class="element text medium" type="hidden" maxlength="255" value=""/>
		</div>
		</li>		<li id="li_5" >
		<label class="description" for="element_5"><?=lang('cat')?> </label>
		<div>
		<select class="element select medium" id="element_5" name="catid">
			<option value="" selected="selected"></option>
                        <option value="1" >First option</option>
                        <option value="2" >Second option</option>
                        <option value="3" >Third option</option>
		</select>
		</div>
		</li>		<li id="li_4" >
		<label class="description" for="element_4">keywords </label>
		<div>
			<input id="element_4" name="element_4" class="element text medium" type="text" maxlength="255" value=""/>
		</div>
		</li>
                <li id="li_4" >
		<label class="description" for="mainpage"></label>
		<div>
                    <input type="checkbox" name="mainpage" value="1" />In main page
		</div>
		</li>
                <li id="li_3" >
		<label class="description" for="text">Text </label>
		<div>
			<textarea id="text_blog" name="text" class="element textarea medium"></textarea>
		</div>
		</li>

					<li class="buttons">
			    <input type="hidden" name="form_id" value="71837" />

				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>
<script type="text/javascript" >
   $('#text_blog').ckeditor(
    {
        customConfig : 'admin_config.js',
        extraPlugins : 'syntaxhighlight'
       
    });
   // $(document).ready(function(){
        $('#element_2').syncTranslit({destination: 'url'});
   //..// });
</script>
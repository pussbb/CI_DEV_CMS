<li><h2><?=lang('quick_start')?></h2>
    <ul>
        <li><a href="#" onclick="addnews();"> <?=  lang('addnews')?></a></li>
        <li><a href="#" onclick="load('article');"> <?=  lang(('newarticle'))?></a></li>
        <li><a href="#"  onclick="load('newfile');"> <?=  lang(('new_file'))?></a></li>
    </ul>
</li>
<li><h2><?=lang('manage')?></h2>
    <ul>
        <li><a href="#" > <?=  lang('downcat')?></a></li>
        <li><a href="#"> <?=  lang('blogcat')?></a></li>
        <li><a target="_blank" href="<?=base_url()?>admin/third_party/ajaxplorer/index.php?ignore_tests=true"> File Manager</a></li>

    </ul>
</li>
<div class="title"><?= $this->lang->line('news'); ?></div>

<?php
$default_permision = array(
	'gid' => "",
	// edit , add, read
	'permissions'=> array('admin' => array(0, 0, 0),
	'user' => array(0, 1, 1),
	'guest' => array(0, 0, 1))
    );
$func = array('edit','add','read');
//$this->permissions->proceed($default_permision,$func);
//print_r($this->permissions->user_role);
$rss_items=$this->ns->welcome_page();

   foreach($rss_items as $item) {
        echo " <div class=\"news_box\">
                    <div class=\"news_icon\"></div>
                    <div class=\"news_content\">";
        echo "<a href='" .$item->get_permalink(). "'>".$item->get_title()."</a><br />";
       echo $item->get_description().$item->get_enclosure();
               echo '<br /><span style="float:right;">'. $item->get_date('j M Y | g:i a').'</span>';

        echo "   </div>
                </div>";
    }



 ?>

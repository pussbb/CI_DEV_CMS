<div class="title"><?= $this->lang->line('news'); ?></div>
<?php
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

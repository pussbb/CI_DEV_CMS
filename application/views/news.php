<?php
$rss_items=$this->ns->welcome_page();
echo "<li>";
    foreach($rss_items as $item) {
        echo "<li>";
        echo "<a href='" .$item->get_link() . "'>";
        echo $item->get_title(); 
        echo "</a>";
        echo "</li>";
    }

    echo "</li>";

 ?>
 <div class="title"><?= $this->lang->line('news'); ?></div>
                <div class="news_box">
                    <div class="news_icon"></div>
                    <div class="news_content">
                    “Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>
                <div class="news_box">
                    <div class="news_icon"></div>
                    <div class="news_content">
                    “Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                </div>    
<?php
echo "<li>";
    foreach($rss_items as $item) {
        echo "<li>";
        echo "<a href='" .$item->get_link() . "'>";
        echo $item->get_title(); 
        echo "</a>";
        echo "</li>";
    }

    echo "</li>";
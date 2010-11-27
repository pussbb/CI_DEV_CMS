<?php

class News_syndication extends CI_Model {

    function News_syndication() {
        parent::CI_Model();
    }

    function welcome_page() {
        $feeds = array(
            'My Google Buzz' => 'https://www.googleapis.com/buzz/v1/activities/pussbb/@public',
            'My site' => 'http://' . base_url() . '/welcome/rss'
        );
        $feed = '';
        foreach ($feeds as $key => $value) {
            $feed.="feedControl.addFeed(\"$value\", \"$key\");\n";
        }
        return "<div class=\"title\">" . $this->lang->line('news') . "</div><script type=\"text/javascript\">
                google.load(\"feeds\", \"1\");
                function OnLoad() {
                // Create a feed control
                var feedControl = new google.feeds.FeedControl();
                $feed
                feedControl.draw(document.getElementById(\"newscontent\"));
                }
                google.setOnLoadCallback(OnLoad);</script><div id=\"newscontent\"></div>​";
    }

}

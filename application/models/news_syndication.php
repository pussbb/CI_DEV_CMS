<?php

class News_syndication extends CI_Model {

    function News_syndication() {
        parent::CI_Model();
    }
    function  welcome_page() {
        $this->load->library('simplepie');
        $feeds = array(
           'https://www.googleapis.com/buzz/v1/activities/pussbb/@public',
           'http://krabik/welcome/rss'
        );// 
  
           // $feed = new SimplePie();
            $this->simplepie->enable_cache(true);
            $this->simplepie->set_cache_location(BASEPATH.'cache/');
            $this->simplepie->set_feed_url($feeds);
            $this->simplepie->set_item_limit(5);
            $this->simplepie->enable_order_by_date(true);
            $this->simplepie->set_javascript('embed');
            $this->simplepie->init();
            //$this->simplepie->handle_content_type();
            $feeds=$this->simplepie->get_items();
            $this->simplepie->__destruct();
            //unset($feed);

        return $feeds;
    }
   
}

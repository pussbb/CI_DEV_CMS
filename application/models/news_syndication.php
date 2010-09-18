<?php
  class News_syndication  extends CI_Model {
    function News_syndication ()
    {
        parent::CI_Model();
     
    }
    function welcome_page()
    {
          $this->load->library('simplepie');
    $this->simplepie->set_feed_url(array('https://www.googleapis.com/buzz/v1/activities/pussbb/@public','http://krabik/welcome/rss'));
    $this->simplepie->set_cache_location(BASEPATH.'cache');
    $this->simplepie->init();
    $this->simplepie->handle_content_type();
  return  $this->simplepie->get_items();
 
    }
}

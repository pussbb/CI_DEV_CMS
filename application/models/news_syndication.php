<?php
  class News_syndication extends Model {
    public function __contructor()
    {
        parent::Model();
     
    }
    function welcome_page()
    {
          $this->load->library('simplepie');
    $this->simplepie->set_feed_url(array('https://www.googleapis.com/buzz/v1/activities/pussbb/@public','http://krabik/welcome/rss'));
    $this->simplepie->set_cache_location(APPPATH.'third_party');
    $this->simplepie->init();
    $this->simplepie->handle_content_type();
    $data['rss_items'] = $this->simplepie->get_items();
$this->load->view('s',$data);
    }
}

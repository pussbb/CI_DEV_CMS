<?php

class Welcome extends Controller
{

    function __construct()
    {
        parent::Controller();

    }

    function index()
    {
	$this->load->model('news_syndication','ns');
       $this->load->model('app','app');
       //$this->app->get_one();
       //$this->template->write('title',"Hello",false);
       //$this->template->write_view('usermenu', 'loginbox');
       $this->template->write('content', $this->app->random());
       $this->template->write('futures', $this->ns->welcome_page());
       $this->template->render();
    }
    function picassa()
    {
       $this->template->write('content', '<div id="pics"></div>');
        $this->template->add_js("system/js/embedPicassaGallary/slimbox2.js", 'import');
        $this->template->add_js("system/js/embedPicassaGallary/jquery.EmbedPicasaGallery.js", 'import');
        $this->template->add_js("jQuery(document).ready(function() {jQuery(\"#pics\").EmbedPicasaGallery('pussbb',{loading_animation: 'images/loading.gif'})})", 'embed');
	$this->template->add_css("system/js/embedPicassaGallary/css/slimbox2.css", 'link','screen');
       $this->template->render();
    }
    function rss()
    {
        $this->load->library('wxml');
        //echo 'Initiate class';
        $xml = new WXml();
        $xml->setRootName('rss');
        $xml->initiate();
        $xml->writeAttribute('version',"2.0");
        $xml->startBranch('channel');
        $xml->addNode('title',"Krabik Rss ");
        $xml->addNode('description',"News rss system notify");
        $xml->addNode('language',"ru-ru");
        $xml->addNode('pubDate',date(DATE_RSS));
        $xml->addNode('lastBuildDate',date(DATE_RSS));
        $xml->addNode('docs',site_url());
        $xml->addNode('generator',"PHP Site rss system");
        $xml->addNode('managingEditor',"pussbb@gmail.com (_pussbb)");
        $xml->addNode('webMaster',"_pussbb@mail.ru (_pussbb)");
        $query=$this->db->query("SELECT * FROM ci_news where datepost <= NOW() ORDER BY datepost DESC limit 25; ");
        if($query->num_rows()>0) {
            foreach($query->result()  as $row) {
                $xml->startBranch('item');
                $xml->addNode('title',$row->title);
                $xml->addNode('link',site_url());
                $xml->addNode('description',html_entity_decode($row->text),array(),true);
                $xml->addNode('pubDate',$row->datepost);
                $xml->addNode('guid' ,$row->id,array('isPermaLink'=>"false"),true);
                $xml->endBranch();
            }
        }
        $xml->endBranch();
        // $xml->endBranch();
        $xml->getXml(true);
    }

   
    
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */

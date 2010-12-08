<?php

class Sitemap extends Controller {

    function Sitemap() {
        parent::Controller();
    }
	function index()
	{
		$this->template->add_css("themes/sitemap/slickmap.css",'link', 'screen, print');
		$this->template->write_view('content','sitemap/index.php');
		
		$this->template->render();
	}
}

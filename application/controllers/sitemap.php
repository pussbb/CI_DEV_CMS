<?php

class Sitemap extends Controller {

    function Sitemap() {
        parent::Controller();
    }
	function index()
	{
                $this->load->model('qhda_mod');
                $data['qhda']=$this->qhda_mod->get_books(FALSE);
		$this->template->add_css("themes/sitemap/slickmap.css",'link', 'screen, print');
		$this->template->write_view('content','sitemap/index.php',$data);
		
		$this->template->render();
	}
}

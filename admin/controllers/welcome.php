<?php

class Welcome extends Controller
{

    function __construct()
    {
        parent::Controller();

    }

    function index()
    {
       // print_r($this);
      //$this->template->write('title', $this->lang->line('settings'), true);
//$this->log_path = ($config['log_path'] != '') ? $config['log_path'] : BASEPATH.'logs/';
        $this->template->write('content', $this->config->item('log_path').'log-'.date($this->config->item('log_date_format')).EXT);

        $this->template->render();
    }
    function addnews()
    {
        if(isset($_POST['title'])==false)
        {
            $this->load->view('addnews');
        }
        else
        {
            
        }
    }
    function article()
    {
        if(isset($_POST['title'])==false)
        {
            $this->load->view('newarticle');
        }
        else
        {

        }
    }

    function newfile()
    {
        if(isset($_POST['title'])==false)
        {
            $this->load->view('newfile');
        }
        else
        {

        }
    }
    
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */

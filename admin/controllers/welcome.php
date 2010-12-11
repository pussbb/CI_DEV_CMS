<?php

class Welcome extends Controller
{

    function __construct()
    {
        parent::Controller();

    }

    function index()
    {
      $this->template->write('title', $this->lang->line('settings'), true);

        $this->template->write('content', $this->user_mod->settings());

        $this->template->render();
    }
    
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */

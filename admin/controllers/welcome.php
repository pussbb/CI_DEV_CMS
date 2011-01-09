<?php

class Welcome extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model("action");
    }

    function index() {

        //$this->template->write('content', $this->config->item('log_path') . 'log-' . date($this->config->item('log_date_format')) . EXT);
        $this->template->write('content',$this->action->downfiles_statistic());
        $this->template->render();
    }
    function errorlog()
    {
         $this->action->errorlog();
    }
    function addnews() {
        if (isset($_POST['title']) == false) {
            $this->load->view('addnews');
        } else {
            if (isset($_POST['title']) && isset($_POST['body'])) {
                $data = array(
                    'title' => $this->input->post('title'),
                    'text' => $this->input->post('body'),
                    'datepost' => date("Y-m-d h:m:s")
                );
                if ($this->db->insert('news', $data) == 1)
                    echo 'Added';
                else
                    echo 'error';
            }
        }
    }

    function news() {
        $this->db->select("*");
        $this->db->from("news");
        $this->db->order_by("datepost", "desc");
        ;
        $query = $this->db->get();
        $this->load->view('news', array("news" => $query->result()));
    }

    function users() {
        echo $this->action->userpagination(null, 0);
    }
    function edituser() {
        $this->action->user_edit();
    }
    function blog() {
        echo $this->action->blogpagination(null, 0);
    }

    function app() {
        echo $this->action->apppagination(null, 0);
    }
    function blogcomments()
    {
        echo $this->action->blogcomments(null, 0);
    }
    function article() {
        $this->action->article();
    }

    function newfile() {
        $this->action->newfile();
    }
    function downcat()
    {
        $query = $this->db->get('downcat');
        $this->load->view('downcat', array('cats' => $query->result()));
    }
     function blogcat()
    {
         $query = $this->db->get('catblog');
         $this->load->view('blogcat', array('cats' => $query->result()));
    }
    function newdowncat()
    {
        $this->action->newdowncat();
    }
     function newblogcat()
    {
        $this->action->newblogcat();
    }
    function newusergroup()
    {
        $this->action->newusergroup();
    }
    function usergroups()
    {
        $query = $this->db->get('group');
         $this->load->view('usergroup', array('cats' => $query->result()));
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */

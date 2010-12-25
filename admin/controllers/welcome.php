<?php

class Welcome extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model("action");
    }

    function index() {

        $this->template->write('content', $this->config->item('log_path') . 'log-' . date($this->config->item('log_date_format')) . EXT);

        $this->template->render();
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

    function blog() {
        echo $this->action->blogpagination(null, 0);
    }

    function app() {
        echo $this->action->apppagination(null, 0);
    }

    function article() {
        $this->action->article();
    }

    function newfile() {
        if (isset($_POST['title']) == false) {
            $this->load->view('newfile');
        } else {

        }
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */

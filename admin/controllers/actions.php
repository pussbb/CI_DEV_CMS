<?php

class Actions extends Controller
{

    function __construct()
    {
        parent::Controller();
         if ($this->permissions->admin_access() == false) {
         redirect(base_url());
        }
        $this->load->model("action");

    }
    function delete_news()
    {
        $this->db->delete('news', array('id' => $this->input->post("id")));
    }
    function delete_user()
    {
        $this->db->delete('users', array('id' => $this->input->post("id")));
    }
    function delete_article()
    {
        $this->db->delete('blog', array('id' => $this->input->post("id")));
    }
    function delete_app()
    {
        $this->db->delete('downfiles', array('id' => $this->input->post("id")));
    }
    function userpaginate()
    {
        echo $this->action->userpagination($this->uri->segment(5, 0), $this->uri->segment(4, 0));
    }
     function blogpaginate()
    {
        echo $this->action->blogpagination($this->uri->segment(5, 0), $this->uri->segment(4, 0));
    }
      function apppaginate()
    {
        echo $this->action->apppagination($this->uri->segment(5, 0), $this->uri->segment(4, 0));
    }
}
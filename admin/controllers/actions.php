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
    function delete_blogcatname()
    {
        $this->db->delete('catblog', array('id' => $this->input->post("id")));
    }
    function delete_downcatname()
    {
        $this->db->delete('downcat', array('id' => $this->input->post("id")));
    }
    function delete_blogcomment()
    {
        $this->db->delete('blog_comments', array('id' => $this->input->post("id")));
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
    function bcommentspaginate()
    {
        echo $this->action->blogcomments($this->uri->segment(5, 0), $this->uri->segment(4, 0));
    }
    function delete_logfile()
    {
        if(!isset($_POST['id'])) return;
        $file_path=$this->config->item('log_path');
        if($file_path=='')
            $file_path =BASEPATH.'logs/';
        unlink($file_path.$_POST['id']);
    }
}
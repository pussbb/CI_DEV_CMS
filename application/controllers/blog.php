<?php

class Blog extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model('blogs', 'blogs');
        $this->template->write('sidemenu', $this->blogs->cat_menu());
        
    }

    function index() {

        $this->template->write('title', " " . $this->lang->line('blog'), false);
        
        $this->template->write('content', $this->blogs->random());
        //$this->template->write_view('futures', 'news');
        
        $this->template->render();
    }

    function viewcat() {
        $query = $this->db->get_where($this->db->dbprefix('catblog'), array('id' => $this->uri->segment(4, 0)), 1);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            if($this->permissions->simple(2,unserialize($row[0]->permissions))==true)
            {
            $this->template->write('title', $row[0]->blogcat_name, true);
            $this->template->write('content', $this->blogs->pagination(null, $row[0]->id));
            $this->template->write('meta',$row[0]->blogcat_name , TRUE);
            $this->template->write('metadescr', $row[0]->blogcat_name . ' ,' . $row[0]->blogcat_desr, TRUE);
            }
            else
            {
               $this->template->write_view('content','access_denied');
            }
            $this->template->render();
        } else {
            show_404();
        }
    }
    function comments()
    {
     echo  $this->blogs->comments($this->input->post('id',true));
    }

    function addcomment()
    {
        if(isset($_POST['add']))
        {
            $data = array(
               'title' => 'My title' ,
               'author' => $this->session->userdata('userid'),
               'author_name' => $this->session->userdata('username'),
               'date' => date("Y-m-d H:i:s"),
               'artid' => $this->uri->segment(4, 0),
                'text' => $this->input->post('add',true)
            );

            $this->db->insert('blog_comments', $data);
            $this->blogs->comments($this->uri->segment(4, 0));
        }

    }
    function paginate() {
        echo $this->blogs->pagination($this->uri->segment(5, 0), $this->uri->segment(4, 0));
    }

    function article() {
        if ($this->uri->segment(4) != NULL) {
            $s = str_replace("_html", "", $this->uri->segment(4));
            $this->blogs->article($this->blogs->article_data($s));
        }
    }

    function pdf() {
       
        if ($this->uri->segment(4) != NULL) {
            $s = str_replace("_pdf", "", $this->uri->segment(4));
            $this->blogs->pdf($this->blogs->article_data($s));
        }
    }

}
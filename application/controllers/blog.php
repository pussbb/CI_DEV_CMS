<?php

class Blog extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->model('blogs', 'blogs');
    }

    function index() {

        $this->template->write('title', " " . $this->lang->line('blog'), false);
        $this->template->write_view('usermenu', 'loginbox');
        $this->template->write('content', $this->blogs->random());
        //$this->template->write_view('futures', 'news');
        $this->template->write('sidemenu', $this->blogs->cat_menu());
        $this->template->render();
    }

    function viewcat() {
        $query = $this->db->get_where($this->db->dbprefix('catblog'), array('id' => $this->uri->segment(4, 0)), 1);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            $this->template->write('title', $row[0]->blogcat_name, true);
            $this->template->write_view('usermenu', 'loginbox');
            $this->template->write('content', $this->blogs->pagination(null, $row[0]->id));
            $this->template->write('sidemenu', $this->blogs->cat_menu());
            $this->template->render();
        } else {
            show_404();
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
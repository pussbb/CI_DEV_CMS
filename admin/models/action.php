<?php

class Action extends CI_Model {
    function Action() {
        parent::CI_Model();
        $this->load->library('pagination');
    }
    function count($id) {
        $query = $this->db->get('users');
        return $query->num_rows();
    }
    function article()
    {
        $uri = 0;
        if ($this->uri->total_rsegments() > 3)
            $uri = $this->uri->segment(4, 0);
        else
            $uri=$this->uri->segment(3, 0);
        if (is_numeric($uri) && $uri != 0) {

            $query = $this->db->get_where('blog', array('id' => $uri));
            $query2 = $this->db->get('catblog');

            $this->load->view('newarticle', array('cats' => $query2->result(), 'data' => $query->row_array()));
            return;
        }
        if (isset($_POST['title']) == false) {
            $data = array(
                'title' => '',
                'textpost' => '',
                'catid' => -1,
                'url' => '',
                'keywords' => "  ",
                'mainpage' => 0,
            );
            $query = $this->db->get('catblog');
            $this->load->view('newarticle', array('cats' => $query->result(), 'data' => $data));
        } else {

            if (isset($_POST['title']) && isset($_POST['catid']) && isset($_POST['text'])) {
                $perm = $this->userauth->default_permision;
                $catid = $this->input->post('catid');
                $query = $this->db->get_where('catblog', array('id' => $this->input->post('catid')));
                if ($query->num_rows > 0) {
                    $row = $query->row();
                    $perm = $row->permissions;
                }
                $data = array(
                    'title' => $this->input->post('title'),
                    'textpost' => $this->input->post('text'),
                    'permissions' => $perm,
                    'catid' => $catid,
                    'author' => $this->session->userdata('userid'),
                    'url' => isset($_POST['url']) && !empty($_POST['url']) ? $this->input->post('url') : date("Y_m_d_h_m"),
                    'keywords' => isset($_POST['keywords']) && !empty($_POST['keywords']) ? $this->input->post('keywords') : "  ",
                    'shorttext' => truncate($this->input->post('text'), 200),
                    'datepost' => date("Y-m-d"),
                    'mainpage' => isset($_POST['mainpage']) ? $this->input->post('mainpage') : 0,
                );
                if (isset($_POST['article_id'])) {
                    $this->db->where('id', $this->input->post('article_id'));
                    if ($this->db->update('blog', $data) == 1)
                        echo 'Added';
                    else
                        echo 'error';
                }
                else {
                    if ($this->db->insert('blog', $data) == 1)
                        echo 'Added';
                    else
                        echo 'error';
                }
            }
        }
    }
    // $limit - кол-во получаемых записей
    // $offset - смещение, с какой записи начинать выборку
    function user_count($limit, $offset, $id) {
        $this->db->limit($limit, $offset);
        $this->db->from("users");
        $query = $this->db->get();
        return $query->result();
    }

    function userpagination($offset ='', $id) {
        $limit = 10;
        $this->data['users'] = $this->user_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'actions/userpaginate/' . $id);
        $config['total_rows'] = $this->count($id);
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();
        $this->data['inner_view'] = "pagination";
        return $this->load->view('users', $this->data, true);
    }
    function blog_count($limit, $offset, $id) {
        $this->db->limit($limit, $offset);
        $this->db->select('blog.*,catblog.blogcat_name');
        $this->db->from("blog");
        $this->db->join('catblog', 'catblog.id = blog.catid');
        $query = $this->db->get();
        return $query->result();
    }

    function blogpagination($offset ='', $id) {
        $limit = 10;
        $this->data['blog'] = $this->blog_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'actions/blogpaginate/' . $id);
        $query = $this->db->get('blog');
        $config['total_rows'] = $query->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();
        $this->data['inner_view'] = "pagination";
        return $this->load->view('blog', $this->data, true);
    }
    function app_count($limit, $offset, $id) {
        $this->db->limit($limit, $offset);
        $this->db->select('downfiles.*,downcat.catname');
        $this->db->from("downfiles");
        $this->db->join('downcat', 'downcat.id = downfiles.catid');
        $query = $this->db->get();
        return $query->result();
    }

    function apppagination($offset ='', $id) {
        $limit = 10;
        $this->data['app'] = $this->app_count($limit, $offset, $id);
        $config['base_url'] = lang_url(null, 'actions/apppaginate/' . $id);
        $query = $this->db->get('downfiles');
        $config['total_rows'] = $query->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['anchor_class'] = 'class="pagination "';
        $this->pagination->initialize($config);
        $this->data['pag_links'] = $this->pagination->create_links();
        $this->data['inner_view'] = "pagination";
        return $this->load->view('app', $this->data, true);
    }
}
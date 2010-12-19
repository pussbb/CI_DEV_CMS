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
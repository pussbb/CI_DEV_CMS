<?php

class User_mod extends CI_Model {

    function User_mod() {
        parent::CI_Model();
        $this->user_menu();
    }

    function user_menu() {
        if ($this->session->userdata('username') != NULL) {
            $this->menu($this->session->userdata('userid'));
        } else {
            $this->template->write_view('usermenu', 'loginbox');
        }
    }
    function menu($userid)
    {       $this->template->add_js("system/js/ckeditor/ckeditor.js", 'import');
            $this->template->add_js("system/js/ckeditor/adapters/jquery.js", 'import');
       $query=$this->db->get_where($this->db->dbprefix('messages'),array('userid'=>$userid));
        $data['inbox']=$query->num_rows();
        $this->template->write_view('usermenu', 'user_menu',$data);
    }
    function pms($action)
    {
        switch ($action)
        {
            case 'new' : $this->pms_new();break;
            case 'inbox': $this->pms_inbox();break;
            case 'outbox':break;
            default: break;
        }
    }
    function pms_new()
    {
        if(!empty($_POST))
        {
            $title=$this->input->post('title');
            $text=$this->input->post('text');
            if ($this->session->userdata('username') != NULL
                    && !empty($title) && !empty($text) ) {
                    $data = array(
                       'userid' => $this->input->post('user')  ,
                       'title' =>$title,
                       'msg' => $text,
                        'new'=>1,
                        'outbox'=>1,
                        'inbox'=>1,
                        'fromid'=>$this->session->userdata('userid'),
                        'namefrom'=>$this->session->userdata('username')
                    );
                    $this->db->insert('messages', $data);
                     echo lang('msg_send')."<script type=\"text/javascript\">cancel_new_msg();</script>";
            }
             else {
                echo lang('fill_form_error');            }
        }
        else
        {
            $this->db->select('id,name');
            $query=$this->db->get('users');
            //print_r($query->result());
            $data['users']=$query->result();
            $this->load->view("pms/new",$data);
        }
    }
    function pms_inbox()
    {
        $this->session->userdata('userid');
        $query=$this->db->get_where($this->db->dbprefix('messages'),array('userid'=>$this->session->userdata('userid')));
        $this->load->view("pms/inbox",$query->result());
    }

}
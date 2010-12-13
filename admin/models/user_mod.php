<?php

class User_mod extends CI_Model {

    function User_mod() {
        parent::CI_Model();
        $this->user_menu();
    }

    function user_menu() {
       /// print_r($this->session->userdata);
        if ($this->permissions->admin_access() == TRUE) {
               $this->menu($this->session->userdata('userid'));
         //   $this->template->write_view('usermenu', 'user_menu', $data);
        } 
    }

    function menu($userid) {
      $this->template->write_view('sidemenu', 'quick_start');
    }

   

    function profile($name)
    {
        if ($this->session->userdata('username') != NULL) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('name', $name);
        $query = $this->db->get();
            if($query->num_rows>0)
            {
                $row=$query->row();
                $this->db->select('user_data.*,users.avatar');
                $this->db->from('user_data');
                $this->db->where('user_data.id', $row->id);
                $this->db->join('users', 'users.id =user_data.id');

                $query = $this->db->get();
                return $this->load->view("userauth/profile", $query->row(), true);
            }
            else {
                return lang('user_notfound');
            }
        } else {
            return lang('authr_user_only');
        }
    }

}
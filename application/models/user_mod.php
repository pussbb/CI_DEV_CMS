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
    {
        $this->template->write_view('usermenu', 'user_menu');
    }
    

}
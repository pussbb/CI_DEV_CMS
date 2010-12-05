<?php

class User extends Controller {

    function User() {
        parent::Controller();
    }

    function login() {
        $this->userauth->login();
    }

    function register() {
        //$this->load->view('reg/register');
        $this->userauth->register();
    }

    function lostpass() {
        //$this->userauth->_lostpass();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        //$this->form_validation->set_rules($rules);
        //$this->form_validation->run();
        if (isset($_POST['email']) && $this->form_validation->run() == TRUE) { //print_r($_POST);
            $this->load->view("userauth/user_lostpass", array("showform" => false, 'msg' => $this->userauth->lostpass()));
        } else {
            $this->load->view("userauth/user_lostpass", array("showform" => true));
        }
    }

    function pms() {
        $this->user_mod->pms($this->uri->segment(4, 0));
    }

    function logout() {
        $this->userauth->logout();
    }

    function settings() {
        $this->template->write('title', $this->lang->line('settings'), true);

        $this->template->write('content', $this->user_mod->settings());

        $this->template->render();
    }

    function avatarup() {

        $this->user_mod->avatarup();
    }

    function profile()
    {
        $this->template->write('title', lang('profile').' : '.$this->uri->segment(4, 0), true);
        $this->template->write('content', $this->user_mod->profile($this->uri->segment(4, 0)));
        $this->template->render();
    }
}

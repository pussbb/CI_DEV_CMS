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

}

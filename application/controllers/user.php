<?php

class User extends Controller
{

    function User()
    {
        parent::Controller();

    }

    function login()
    { 
       // print_r($_POST);
        
    }
function register()
{
   //$this->load->view('reg/register');
    $this->userauth->register();
}
}

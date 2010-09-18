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
         
//$this->load->view('reg/error_register',array('heading'=>$this->lang->line('regerror'),'message'=>'hjhgj'));
 
    $this->load->view('reg/register');
}
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * Author _pussbb
 * Class for managing users
 */
class Userauth
{
    //temprory solution
    var $register=array('username','email','password','confirm_password','captca');
    //
    var $error = "";
    function Userauth()
    {
        // Copy an instance of CI so we can use the entire framework.
        $this->ci = &get_instance();
        // Load naccery lib's
        $this->ci->load->helper('security');
    }

    function check_post($name)
    {
        foreach ($name as $item)
        {
            if(isset($_POST[$item]) && empty($_POST[$item]))
            {
                return false;//
            }
        }
        return true;
    }

    function register()
    {
        if(empty($_POST)){
        $this->ci->load->view('userauth/register');
        }
        else {
            
            if($this->check_post($this->register)===false)
            {
                $this->ci->load->view('userauth/error_register');
            }
            //redirect(base_url().lang_id().'/');
        }
    }
     
}
?>

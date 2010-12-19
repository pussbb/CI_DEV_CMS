<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Author _pussbb
 * Class for managing users
 */

class Userauth {
    const USER =1;
    const EMAIL= 2;
    //temprory solution
    var $table = 'users';
    var $register_var = array('username', 'email', 'password', 'confirm_password', 'captcha');
    var $login_var = array('name', 'pass');
    //
    var $default_permision = array(
	'grid' => "",
	// edit , add, read
	'admin' => array(0, 0, 0),
	'user' => array(0, 1, 1),
	'guest' => array(0, 0, 1)
    );
    var $error = "";
    function Userauth() {
	// Copy an instance of CI so we can use the entire framework.
	$this->ci = &get_instance();
	// Load naccery lib's
	$this->ci->load->helper('security');
    }

    function get_permissions($mvc = "")
    {
	
    }

    function check_post($name) {
	foreach ($name as $item) {
	    if (!isset($_POST[$item]) && empty($_POST[$item])) {
		return false; //
	    }
	}
	return true;
    }

    function register() {
	if (empty($_POST)) {
	    $this->ci->load->view('userauth/register');
	} else {

	    if ($this->check_post($this->register_var) === false) {
		$this->reg_error($this->lang->line('reg_error'));
	    } else {
		$this->_register();
	    }
	}
    }
    function lostpass()
    {
        if (isset($_POST['email']) && empty($_POST['email']) !== true) {
            $query = $this->ci->db->get_where($this->ci->db->dbprefix('users'), array('email' =>
                $this->ci->input->post($_POST['email'])), 1);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $strpass = dohash($row->pass);
                return $this->_send_mail('Your password :' . $strpass, 'Password recovery',$row->email);
            } else {
                return $this->ci->lang->line('email_notexist');
            }
        } 
    }
    function _send_mail($text, $subject, $list)
    {
        $this->ci->load->library('email');
        $this->ci->email->from($this->ci->config->item('e-mail'));
        $this->ci->email->to($list);
        $this->ci->email->subject($subject);
        $this->ci->email->message($text);
        if (!$this->ci->email->send()) {
            return '<h2>'.$this->ci->lang->line('email_error_send').' <br /><br /></h2>'; // Генерация ошибки
        } else {

            return '<h2>'.$this->ci->lang->line('email_error_send') . $list .'<h2><br /><br />';
        }
    }
    function login() {
	if (!empty($_POST) && $this->check_post($this->login_var)) {
	    $tmp = $this->_clean_data();
	    $query = $this->ci->db->get_where($this->ci->db->dbprefix($this->table), array('name' => $tmp[$this->login_var[0]]), 1);
	    if ($query->num_rows() > 0) {
		$row = $query->row();
		if ($row->banned == 1) {
		    $this->ci->load->view('userauth/user_banned', array('msg' => $row->banedreason));
		} 
		else
		{
		   if ($row->pass == dohash($this->ci->input->post('pass')))
		   {
		    $username=$row->name;
		    $newdata = array('username' => $row->name, 'permission' => $row->permission,
                        'userid' => $row->id, 'gid' => $row->groupid);
                    $this->ci->session->set_userdata($newdata);
                    $today = date("d.m.Y");
		    $sql = "UPDATE " . $this->ci->db->dbprefix('users') .
                        " SET `last_login` = CURRENT_DATE, `lastip` = '" . $this->ci->input->ip_address() .
                        "' WHERE id =" . $row->id . " ";
                    $query = $this->ci->db->query($sql);
		     if($this->ci->config->item('smf')==TRUE)
			{
			    require_once(FCPATH.$this->ci->config->item('smfpath'));
			    smf_setLoginCookie(720000, addslashes($username), addslashes($this->ci->input->post('pass')), false);
                            smf_authenticateUser();
			}
		    
                        if(isset($_SERVER['HTTP_REFERER'])) {
                             redirect( $_SERVER['HTTP_REFERER']);
                        }
                        else{redirect(base_url());}
		   }
		}
	    } 
	    else
	    {
		$this->ci->load->view('userauth/error_login', array('msg' => $this->ci->lang->line('user_notfound')));
	    }
	} else {
	    $this->ci->load->view('userauth/error_login', array('msg' => ''));
	}
    }

    function _clean_data() {
	return $this->ci->security->xss_clean($_POST);
    }

    function _register() {
	$tmp = $this->_clean_data();
	$data['name'] = $tmp[$this->register_var[0]];
	$data['pass'] = dohash($tmp[$this->register_var[2]]);
	$data['email'] = $tmp[$this->register_var[1]];
	$data['lastip'] = $this->ci->input->ip_address();
	$data['permission'] = serialize($this->default_permision);
	$data = $this->ci->db->escape($data);
	$sql = "INSERT INTO " . $this->ci->db->dbprefix($this->table) .
		"(name,pass,email,created,lastip,permission) VALUES(?,?,?,NOW(),?,?);";

	if (!$this->if_exist(self::EMAIL, $data['email']) && !$this->if_exist(self::USER, $data['name'])) {
	    $this->ci->db->query($sql, $data);
	    if($this->ci->config->item('smf')==TRUE)
	    {
				require_once(FCPATH.$this->ci->config->item('smfpath'));
                smf_registerMember($data['name'],$data['email'],$tmp[$this->register_var[2]],$extra_fields = array(), $theme_options = array());
              
	    }
	    redirect(base_url() . lang_id() . '/');
	}
	unset($tmp);
	unset($data);
    }

    function if_exist($id, $str) {
	switch ($id) {
	    case self::USER:

		$this->ci->db->where('name', $str);
		$this->ci->db->from($this->ci->db->dbprefix($this->table));
		if ($this->ci->db->count_all_results() == 0) {
		    return false;
		} else {
		    $this->reg_error($this->ci->lang->line('user_exist'));
		    return true;
		}

		break;

	    case self::EMAIL:

		$this->ci->db->where('email', $str);
		$this->ci->db->from($this->ci->db->dbprefix($this->table));
		if ($this->ci->db->count_all_results() == 0) {
		    return false;
		} else {
		    $this->reg_error($this->ci->lang->line('email_exist'));
		    return true;
		}

		break;
	    default:
		break;
	}
    }

    function reg_error($msg) {//this->lang->line('reg_error')
	$this->ci->load->view('userauth/error_register', array('msg' => $msg));
    }

    function logout() {
	$this->ci->session->sess_destroy();
	redirect(base_url() . lang_id() . '/');
    }

}

?>

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Author _pussbb
 * Class for managing users
 */

class Permissions {

	var $user_type="";
	var $group="";
	///var $admin=array();
	protected $user_role=array();
	///var $user=array();
	///var $guest=array();
	var $error = "";
    function Permissions()
    {
	// Copy an instance of CI so we can use the entire framework.
	$this->ci = &get_instance();
	// Load naccery lib's
	//$this->ci->load->helper('security');
	$this->_check_user_type();
    }

    function _check_user_type()
    {
	 if ($this->ci->session->userdata('username')==NULL)
	 {
	     $this->user_type="guest";
	     $this->user_role=$this->ci->userauth->default_permision;
	 }
	 else
	 {//a:4:{s:5:"group";s:1:"1";s:5:"admin";a:3:{i:0;i:1;i:1;i:1;i:2;i:1;}s:4:"user";a:3:{i:0;i:1;i:1;i:1;i:2;i:1;}s:5:"guest";a:3:{i:0;i:1;i:1;i:1;i:2;i:1;}}//
		
	     if($this->ci->session->userdata('gid')>0)
	     {
		 //get in db table permission for a group
		 $query =$this->ci->db->get_where($this->ci->db->dbprefix('group'),array('id'=>$this->ci->session->userdata('gid')));
		 
		 if($query->num_rows() > 0)
		 {
		     $row = $query->row();
		     $this->user_type=$row->name;
		     $this->user_role=unserialize($row->permissions);
		 }
		else{ $this->ci->userauth->login();}
	     }
	     else
	     {
		 $this->user_type="user";
		 $this->user_role=unserialize($this->ci->session->userdata('permission'));
		 //print_r($this->user_role);
	     }

	 }

    } 

    function proceed($module,$mvl_perm,$mvl_funct)
    {
	if($mvl_perm['gid']!=0)
	{
	    //get in db table permission for a group
	}
	else
	{
	    $status=false;
	   for($i=0;$i<count($mvl_perm['permissions'][$this->user_type]);$i++)
	   {
		if($this->user_type=='admin' || $mvl_perm['permissions'][$this->user_type][$i]==$this->user_role[$this->user_type][$i])  {$status=true;}
		else {$status=false;}
		$this->ci->{$module}->{$mvl_funct[$i]}($status);
	   }
	}
    }
    //$role variable as int for array index for user
    function simple($role)
    {
	if($this->user_role[$this->user_type][$role]==1)
	{
	    return true;
	}
	else return false;
    }
}
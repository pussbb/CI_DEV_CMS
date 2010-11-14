<?php

class Apps extends CI_Model {
    var $perm_func=array();
    const EDIT=0;
    const ADD=1;
    const READ=2;
    function Apps() {
        parent::CI_Model();
    }
    function read($role)
    {
	//echo 'read';
    }
    function edit($role)
    {
	if($role==false)
	{
		//echo 'You don\'t have permission to acces edit<br />';
	}
	else
	{
	    //echo 'edit<br />';
	}
    }
    function add($role)
    {
	if($role==false)
		{
			//echo 'You don\'t have permission to acces add<br />';
		}
		else
		{
		    //echo 'add<br />';
		}
    }
    function get_one()
    {
	//get appss .....
	$default_permision = array(
	'gid' => "",
	// edit , add, read
	'permissions'=> array('admin' => array(0, 0, 0),
	'user' => array(0, 1, 1),
	'guest' => array(0, 0, 1))
    );
$func = array('edit','add','read');
$this->permissions->proceed($module='apps',$default_permision,$func);
    }
    function random()
    {
	$query=$this->db->get($this->db->dbprefix('downfiles'));
	if($query->num_rows()>0)
	{
	    $this->load->helper('array');
	    $row=random_element($query->result());
	    if($this->permissions->simple(self::READ))
	    {
		return	$this->load->view('single_app',$row,true);
	    }

	}
    }
}
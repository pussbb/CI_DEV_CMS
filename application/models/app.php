<?php

class App extends CI_Model {
    var $perm_func=array();
    const EDIT=0;
    const ADD=1;
    const READ=2;
    function App() {
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
	$this->permissions->proceed($module='app',$default_permision,$func);
    }
    //a:4:{s:5:"group";s:1:"0";s:5:"admin";a:3:{i:0;i:1;i:1;i:1;i:2;i:1;}s:4:"user";a:3:{i:0;i:0;i:1;i:1;i:2;i:1;}s:5:"guest";a:3:{i:0;i:0;i:1;i:0;i:2;i:1;}}
    function random()
    {
	$query=$this->db->get($this->db->dbprefix('downfiles'));
	if($query->num_rows()>0)
	{
	    $this->load->helper('array');
	    $shows=false;
	    
	    while($shows==false)
	    {
		$row=random_element($query->result());
		if($this->permissions->simple(self::READ,unserialize($row->permission)))
		{
		    ///$this->template->add_js("system/js/jstarrating/jquery.MetaData.js", 'import');
		    $this->template->add_js("system/js/jstarrating/self::jquery.rating.pack.js", 'import');
		    $this->template->add_css("system/js/jstarrating/jquery.rating.css", 'link');
		    return	$this->load->view('single_app',$row,true);
		    $shows=true;
		}
	    }
	    

	}
    }
    function download_app($filename) {
	$this->load->helper("file");
	if (file_exists($filename)) {
	    @apache_setenv('no-gzip', 1);
	    header('Content-Description: File Transfer');
	    header("Content-type: application/force-download");
	    header('Content-Type: '.get_mime_by_extension($filename));
	    header('Content-Disposition: attachment; filename='.basename($filename));
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($filename));
	    ob_clean();
	    flush();
	    readfile($filename);
	    exit;
	}
	else
	{
	    show_404();
	}

    }
    function view_allcat()
    {self::
	$result='';
	$query=$this->db->get($this->db->dbprefix('downcat'));
	if($query->num_rows>0)
	{
	    foreach($query->result()  as $row)
	    {
	 //print_r($row);
		$href="";
		$title="";
		if($this->permissions->simple(self::READ,unserialize($row->permission))==true)
		{
		    $href=  lang_url('','apps/viewcat/'.$row->id);
		     $title='title=""';
		}
		else{
		    $href=current_url()."#";
		    $title='title="'.$this->lang->line('accesdenie').'"';
		    }
		$result.="<p style=\"margin:10px;\"><div class=\"title\"><a $title href=\"$href\" class=\"tool_tip\">$row->catname</a></div>$row->catdescr</p>";
	    }
	}
	return $result;
    }
    function view_cat($cat)
    {
    $result=''; 
	$this->template->add_js("system/js/jstarrating/jquery.rating.pack.js", 'import');
	$this->template->add_css("system/js/jstarrating/jquery.rating.css", 'link');
	$this->template->add_css("themes/system/scrollable-horizontal.css", 'link');
	//$this->template->add_css("themes/system/scrollable-buttons.css", 'link');
	$query=$this->db->get_where($this->db->dbprefix('downfiles'),array('catid'=>$cat->id));
	if($query->num_rows>0)
	{
	    foreach($query->result()  as $row)
	    {
		$result.="<div><div class=\"item\">".$this->load->view('single_app',$row,true)."</div></div>";
	    }
	}
	return "<div id=\"actions\">
   <a class=\"prev\">&laquo;".$this->lang->line('prev')."</a>
   <a class=\"next\">".$this->lang->line('next')." &raquo;</a>
</div><div class=\"scrollable\"><div class=\"items\">
         $result</div></div>";
    }

}
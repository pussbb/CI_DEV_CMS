<?php
class Blogs extends CI_Model {
    
    const EDIT=0;
    const ADD=1;
    const READ=2;
    
    function Blogs(){
        parent::CI_Model();
	$this->load->library('pagination');
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
    function cat_menu()
    {
	$text='<div class="title">'.$this->lang->line('cat').'</div><ul>';
	$query=$this->db->get($this->db->dbprefix('catblog'));
	if($query->num_rows>0)
	{
	    foreach ($query->result() as $row)
	    {	$href='';
	    $title='';
		
		if($this->permissions->simple(self::READ,unserialize($row->permissions))==true)
		{
		    $href= 'href="'. lang_url('','blog/viewcat/'.$row->id).'"';
		    
		}
		else {$title='<br />'.$this->lang->line('accesdenie');}
		$text.='<li style="list-style:none;"><a title="'.$row->blogcat_desr.$title.'" '.$href.'>'.$row->blogcat_name."</a></li>";
	    }
	}
	return "<div class=\"text_box\">$text</ul></div>";
    }
   function count($id)
   {
       $query = $this->db->get_where($this->db->dbprefix('blog'),array('catid'=>$id));
      return $query->num_rows();
   }
   // $limit - кол-во получаемых записей
   // $offset - смещение, с какой записи начинать выборку
   function articles_count($limit,$offset,$id)
   {
      $this->db->limit($limit,$offset);
      $query = $this->db->get_where($this->db->dbprefix('blog'),array('catid'=>$id));
      return $query->result();
   }
   function pagination($offset ='',$id)
   {
      $limit = 5;
      $this->data['articles'] = $this->articles_count($limit,$offset,$id);
      $config['base_url'] = lang_url(null,'blog/paginate/'.$id);
      $config['total_rows'] = $this->count($id);
      $config['per_page'] = $limit;
      $config['uri_segment'] = 5;
      $config['anchor_class']='class="pagination "';
      $this->pagination->initialize($config);
      $this->data['pag_links'] = $this->pagination->create_links();

	$this->data['inner_view'] = "pagination";
      return $this->load->view('articles_in_cat', $this->data,true);

   }
}
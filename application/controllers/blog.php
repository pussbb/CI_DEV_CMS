<?php

class Blog extends Controller
{

    function __construct()
    {
        parent::Controller();
	$this->load->model('blogs','blogs');
	
    }

    function index()
    {
	
       $this->template->write('title'," ".$this->lang->line('blog'),false);
       $this->template->write_view('usermenu', 'loginbox');
       $this->template->write('content', $this->blogs->random());
       //$this->template->write_view('futures', 'news');
       $this->template->write('sidemenu',$this->blogs->cat_menu());
       $this->template->render();
    }

    function viewcat()
    {
	$query=$this->db->get_where($this->db->dbprefix('catblog'),array('id'=>$this->uri->segment(4, 0)),1);
	if($query->num_rows()>0)
	{
	    $row=$query->result();
	    $this->template->write('title',$row[0]->blogcat_name,true);
	    $this->template->write_view('usermenu', 'loginbox');
	    $this->template->write('content',  $this->blogs->pagination(null,$row[0]->id));
	    $this->template->write('sidemenu',$this->blogs->cat_menu());
	    $this->template->render();
	}
	else
	{
	    show_404();
	}
    }

   function paginate()
   {
	echo $this->blogs->pagination($this->uri->segment(5, 0),$this->uri->segment(4, 0));
   }
   function article()
   {
    if($this->uri->segment(1)!=NULL)
            { $s=current(explode(".", $this->uri->segment(1)));
                $query=$this->db->get_where($this->db->dbprefix('blog'),array('url'=>$s));
                if($query->num_rows()>0)
                { $row=$query->row();
                    $this->template->write_view('usermenu', 'loginbox');

                    $this->template->write('title', $row->name, TRUE);
                    $this->template->write('meta', $row->keywords, TRUE);
                    $this->template->write('metadescr', $row->description, TRUE);
                    $this->template->write('title2', $row->name, TRUE);
                    $this->template->write('text', $row->content, TRUE);
                    $this->template->render();
                }

	    }
   }
}
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
    if($this->uri->segment(4)!=NULL)
            { 
                $s=str_replace("_html","", $this->uri->segment(4));
                $prefix= $this->config->item('dbprefix');
                $this->db->select("users.name,catblog.*,blog.*");
                $this->db->from('blog');
                $this->db->where('url',$s);
                $this->db->join('catblog', 'catblog.id = blog.catid');
                $this->db->join('users', 'users.id = blog.author');
                $query = $this->db->get();
                if($query->num_rows()>0)
                {
                      $row=$query->row();
                      $this->blogs->article($row);
                }
                else
                {
                    show_404();
                }

	    }
   }
   function pdf()
   {
       $this->load->model("pdf");
       
       if($this->uri->segment(4)!=NULL)
            {
                $s=str_replace("_pdf","", $this->uri->segment(4));
                $prefix= $this->config->item('dbprefix');
                $this->db->select("users.name,catblog.*,blog.*");
                $this->db->from('blog');
                $this->db->where('url',$s);
                $this->db->join('catblog', 'catblog.id = blog.catid');
                $this->db->join('users', 'users.id = blog.author');
                $query = $this->db->get();
                if($query->num_rows()>0)
                {
                      $row=$query->row();
                      $this->pdf->article($row);
                }
                else
                {
                    show_404();
                }

	    }
       
       
   }
}
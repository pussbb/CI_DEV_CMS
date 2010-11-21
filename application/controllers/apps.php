<?php
class Apps extends Controller
{

    function Apps()
    {
        parent::Controller();
	 $this->load->model('app');
    }
    
    function index()
    {
       $this->template->write('title',$this->lang->line('apps').'  '.$this->lang->line('cat'),true);
       $this->template->write_view('usermenu', 'loginbox');
       $this->template->write('content', $this->app->view_allcat());
 
       $this->template->render();
    }
    function viewcat()
    {
	$query=$this->db->get_where($this->db->dbprefix('downcat'),array('id'=>$this->uri->segment(4, 0)),1);
	if($query->num_rows()>0)
	{
	    $row=$query->result();
	    $this->template->write('title',$row[0]->catname,true);
	$this->template->write_view('usermenu', 'loginbox');
	$this->template->write('content', $this->app->view_cat($row[0]));

	$this->template->render();
	}
	else
	{
	    show_404();
	}
	
    }
    function predownload()
    {
	$query=$this->db->get_where($this->db->dbprefix('downfiles'),array('id'=>$this->uri->segment(4, 0)),1);
	if($query->num_rows()>0)
	{
	    $row=$query->result();
	    $this->load->view("predownload",$row[0]);
	}
	else
	{
	    show_404();
	}
    }
    function download()
    {
	
	$query=$this->db->get_where($this->db->dbprefix('downfiles'),array('id'=>$this->uri->segment(3, 0)),1);
	
	if($query->num_rows()>0)
	{
	    $row = $query->row();
	    $this->db->where('id', $row->id);
	    $i=$row->downed;
	    $this->db->update('downfiles',array('downed'=>++$i));
	    $this->app->download_app($row->filepath);
	}
	else
	{
	    show_404();
	}
	
    }

}
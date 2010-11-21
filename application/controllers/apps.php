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

    function ratethis()
    {
	$query=$this->db->get_where($this->db->dbprefix('downfiles'),array('id'=>$this->input->post('id')),1);
	if($query->num_rows()>0)
	{
		 $row=$query->result();
		 $i = $row[0]->rate;
		// $i =(float) ($i + $this->input->post('rate')) ;
		  $i = explode(".",(float)($i + $this->input->post('rate'))/2);;// explode(".",($i + $this->input->post('rate'))/4);\
		if(isset($i[1]))
		{
		    if(strlen($i[1])==1){$i[1].='0';}
		    if((int)$i[1]<=50){$i[1]=50;}
		    if((int)$i[1]>50){$i[0]=(int)$i[0]+1;$i[1]="00";}
		   
		}
		else{$i[1]="00";}
		$i=  implode(".",$i);
		 /// print_r($i);
		$this->db->where('id', $row[0]->id);
		$this->db->update('downfiles',array('rate'=>$i));
		 echo $i;
	}
	else
	{
	    show_404();
	}
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
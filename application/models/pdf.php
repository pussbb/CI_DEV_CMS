<?php
class PDF extends CI_Model {

    function __construct() {
        parent::CI_Model();
	$this->load->library("third_party/tcpdf/tcpdf.php");
       ///$this->tcpdf->AddPage();
      /// $this->tcpdf->SetY(5);
      // $this->tcpdf->Output('example_003.pdf', 'I');
    }
    function article($data)
    {
        $this->tcpdf->AddPage();
        $this->tcpdf->SetY(15);
      // 
        $html =$this->load->view('article',$data,true);
        $this->tcpdf->writeHTML($html, true, false, true, false, '');
        $this->tcpdf->Output('example_003.pdf', 'I');
    }
}
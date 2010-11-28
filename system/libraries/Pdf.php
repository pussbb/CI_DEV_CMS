<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * Author _pussbb
 * Class for managing users
 */

require_once(BASEPATH . 'libraries/third_party/tcpdf/tcpdf.php');

class Pdf extends TCPDF {

    var $base_url='';
    var $link='';
    function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false) {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);
        ///$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
       // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $this->setPDFVersion('1.5');//for support Adobe PDF Reader
        $this->SetFont('dejavuserif', '', 14, '', true);//utf support font as default
        $this->ci = &get_instance();
        $this->base_url=$this->ci->config->item('base_url');

    }

    public function Header() {
        // Logo
        //$image_file = K_PATH_IMAGES.'logo_example.jpg';
        //$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetTextColor(121);
        // Title
       // $this->Cell(0, 15, $this->ci->config->item('site_name'), 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 25, $this->link, 0, false, 'R', 0,  $this->link, 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetTextColor(121);
        // Page numberdate("F j, Y, g:i a",  strtotime($datepost));
        $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10,date("F j, Y, g:i a"), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }

}
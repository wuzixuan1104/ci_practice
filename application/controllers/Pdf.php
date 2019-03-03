<?php defined('BASEPATH') OR exit('No direct script access allowed');

use setasign\Fpdi\TcpdfFpdi;

class Pdf extends CI_Controller {

  public function index() {
    $pdf = new TcpdfFpdi();

    $pagecount = $pdf->setSourceFile(FCPATH . 'asset/doc/trip2.0.pdf');

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    // $pdf->SetMargins(10, 10, -10, true);
    $tpl = $pdf->importPage(2);
    
    $pdf->AddPage();

    $pdf->useTemplate($tpl);

    // $pdf->SetFont('msungstdlight', '', 20);
    // $pdf->SetFont('kozminproregular', '', 12);
    $pdf->SetFont('cid0jp', '', 12);
    $pdf->SetFontSize('12'); // set font size
    $pdf->SetXY(10, 89); // set the position of the box
    $pdf->Cell(0, 10, '哈好哈 x8 x8 x8 好哈哈哈 Shari', 1, 0, 'C'); // add the text, align to Center of cell

    $pdf->Output();
    die;
  }
}

// class MyPDF extends TCPDF {
//   private $file = FCPATH . 'asset/doc/tripsaas.pdf';

//   public function __construct() {
//     $this->numPages = $this->setSourceFile($this->file);
//     print_r($this->numPages);
//     die;
//   }
// }
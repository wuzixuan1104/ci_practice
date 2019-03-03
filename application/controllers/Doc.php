<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\WordTpl;
use PhpOffice\PhpWord\TemplateProcessor;

class Doc extends CI_Controller {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $path = FCPATH . 'asset/doc/';

    WordTpl::create($path . 'tipsaas_template.docx')
                ->with('company_name', '大胖bo公司')
                ->with('year', '2019')
                ->with('month', '06')
                ->with('day', '12')
                ->saveTo($path . 'new.docx')
                ->download();

  }
}
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
                ->with('company_name', '玩咖旅行社公司')
                ->with('expire_date_start', '108 年 03 月 01 日')
                ->with('expire_date_end', '108 年 03 月 02 日')
                ->with('total_price', '7,000')
                ->with('explain_2', '嘿嘿嘿test嘿嘿嘿test嘿嘿嘿test嘿嘿嘿test嘿嘿嘿test嘿嘿嘿test')
                ->with('explain_4', '嘿嘿嘿test嘿嘿嘿test嘿嘿嘿test嘿嘿嘿test嘿嘿嘿test嘿嘿嘿test')
                ->with('create_at', '108 年 03 月 02 日')
                ->saveTo($path . 'new.docx')
                ->toPDF()
                ->download();

  }
}
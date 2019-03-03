<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\WordTpl;
use PhpOffice\PhpWord\TemplateProcessor;

class Doc extends CI_Controller {
  public function __construct() {
    parent::__construct();
  }

  public function index() {
    $path = FCPATH . 'asset/doc/';

    // $templateProcessor = new TemplateProcessor($path . 'tipsaas_template.docx');

    // $templateProcessor->setValue('company_name','大胖BO公司', 1);
    // $templateProcessor->setValue('year',2019, 1);
    // $templateProcessor->setValue('month','03', 1);
    // $templateProcessor->setValue('day', 6);

    // $contracts = [
    //   ['day' => date('Y-m-d H:i:s'), 'desc' => '哈哈好哈YOYOyoyo'],
    //   ['day' => date('Y-m-d H:i:s'), 'desc' => '測試123']
    // ];

    // $templateProcessor->cloneBlock('CONTRACTBLOCK', count($contracts));
    // $templateProcessor->saveAs($path . 'new.docx');

    // print_r($templateProcessor);
    // die;


    WordTpl::create($path . 'tipsaas_template.docx')
                ->with('company_name', '大胖bo公司')
                ->with('year', '2019')
                ->with('month', '06')
                ->with('day', '12')
                ->saveTo($path . 'new.docx')
                ->output('download');


    // WordTpl::create($path . 'tipsaas_template.docx')
    //             ->with('company_name', '大胖bo公司')
    //             ->with('year', '2019')
    //             ->with('month', '06')
    //             ->with('day', '12')
    //             ->saveTo($path . 'new.pdf')
    //             ->download();

    exit();
  }
}
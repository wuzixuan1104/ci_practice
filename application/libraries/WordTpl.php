<?php
namespace Lib;

defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

class WordTpl extends TemplateProcessor {
  static $processor;
  public $tplFile = null;
  public $targetFile = null;

  public function __construct($path) {
    if ($this->setTplPath($path))
      self::processor($this->tplFile);
  }

  public static function create($path) {
    return new WordTpl($path);
  }

  public static function processor($tplFile) {
    if (self::$processor)
      return self::$processor;

    return self::$processor = new TemplateProcessor($tplFile);
  }

  public function with($text, $value, $limit = -1) {
    if (is_string($text) && $value) {
      self::$processor->setValue($text, $value, $limit);
    }
    return $this;
  }

  public function saveTo($filename) {
    if (!(is_string($filename) && file_exists(dirname($filename)) && is_writable(dirname($filename)))) 
      $this->error(__FUNCTION__, 'saveTo 找不到資料夾或權限不足！');

    if (pathinfo($filename, PATHINFO_EXTENSION) != 'docx') 
      $this->error(__FUNCTION__, 'saveTo 必須為「 .docx 」的檔案格式！', false);

    $this->targetFile = $filename;
    self::$processor->saveAs($filename);

    return $this;
  }

  public function download($filename = null) {
    $filename || $filename = $this->targetFile;
    if ($filename === null)
      $this->error(__FUNCTION__, 'download 為給予指定檔案下載！', false);

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!in_array($ext, ['docx', 'pdf']))
      $this->error(__FUNCTION__, 'saveTo 必須為「 .docx 」的檔案格式！', false);

    header('Content-Type: application/' . ($ext == 'pdf' ? 'pdf' : 'vnd.ms-word'));
    header('Content-Disposition: attachment;filename="' . basename($filename) . '"');
    header('Cache-Control: max-age=0');

    $fp = fopen($filename, 'rb');
    fpassthru($fp);

    return true;
  }

  public function toPDF($filename = null) {
    $filename || $filename = $this->targetFile;
    if ($filename === null)
      $this->error(__FUNCTION__, 'toPDF 為給予指定檔案下載！', false);

    $pdfPath = substr_replace($filename , 'pdf', strrpos($filename , '.') + 1);
    
    exec('/usr/local/bin/unoconv -f pdf -o  ' . $pdfPath . ' ' . $filename);
    @unlink($this->targetFile);

    $this->targetFile = $pdfPath;

    return $this;
  }

  private function setTplPath($filename) {
    if (!(is_string($filename) && file_exists($filename) && is_readable($filename))) {
      $this->error(__FUNCTION__, '找不到樣本檔案或權限不足！');
      return false;
    }

    $this->tplFile = $filename;
    return $this;
  }

  private function error($function, $msg, $bool = true) {
    if($bool)
      log_message('error', '[' . date('Y-m-d H:i:s') . '] Word Template - ' . $function . ' : ' . $msg);
    
    echo $msg;
    die;
  }
}
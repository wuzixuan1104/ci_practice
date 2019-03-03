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
    if (!(is_string($filename) && file_exists(dirname($filename)) && is_writable(dirname($filename)))) {
      $this->output(__FUNCTION__, '找不到資料夾或權限不足！');
      return false;
    }

    $this->targetFile = $filename;
    self::$processor->saveAs($filename);
    return $this;
  }

  public function download($filename = null) {
    $filename || $filename = $this->targetFile;
    if ($filename === null)
      return false;

    header('Content-Type: application/vnd.ms-word');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $fp = fopen($filename, 'rb');
    fpassthru($fp);

    return true;
  }

  private function setTplPath($filename) {
    if (!(is_string($filename) && file_exists($filename) && is_readable($filename))) {
      $this->output(__FUNCTION__, '找不到樣本檔案或權限不足！');
      return false;
    }

    $this->tplFile = $filename;
    return $this;
  }

  private function error($function, $msg) {
    log_message('error', '[' . date('Y-m-d H:i:s') . '] Word Template - ' . $function . ' : ' . $msg);
  }
}
<?php
namespace Lib;

defined('BASEPATH') OR exit('No direct script access allowed');

class Asset {
  protected $list = [];
  public function __constuct() {

  }

  public static function create() {
    return new Asset();
  }

  private function addList($type, $path) {
    if(!preg_match('/^https?:\/\/.*/', $path) && !(is_string($path) && file_exists(FCPATH . 'asset' . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . trim($path))))
      return $this;

    isset($this->list[$type]) || $this->list[$type] = [];
    in_array($path, $this->list[$type]) || $this->list[$type][] = $path;

    return $this;
  }

  public function addJS($path) {
    return $this->addList('js', $path);
  } 

  public function addCSS($path) {
    return $this->addList('css', $path);
  }

  public function render() {
    if(!$this->list)
      return false;

    $output = '';
    $output .= isset($this->list['css']) ? implode('', array_map(function($value) {
      if (preg_match('/^https?:\/\/.*/', $value))
        return '<link rel="stylesheet" type="text/css" href="' . $value . '">';

      return '<link rel="stylesheet" type="text/css" href="asset/css/' . $value . '">';
    }, $this->list['css'])) : '';

    $output .= isset($this->list['js']) ? implode('', array_map(function($value) {
      if (preg_match('/^https?:\/\/.*/', $value))
        return '<script src="' . $value . '"></script>';

      return '<script src="asset/js/' . $value . '"></script>';
    }, $this->list['js'])) : '';

    return $output;
  }
}
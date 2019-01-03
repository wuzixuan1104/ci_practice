<?php
namespace Lib;

defined('BASEPATH') OR exit('No direct script access allowed');

class View {
  public $vpath, $vparam;
  public function __construct($name, $path) {
    $this->setPath($path);
  }

  public static function create($path, $name = null) {
    return new View($name, $path);
  }

  public function setPath($path) {
    $path && is_string($path) && $this->vpath = trim($path);
    return $this;
  }

  public function with($text, $value) {
    if(is_string($text) && $value)
      $this->vparam[$text] = $value;
    return $this;
  }
}


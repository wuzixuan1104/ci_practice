<?php
namespace Model;

defined('BASEPATH') OR exit('No direct script access allowed');

class Bar {
  public function __construct() {
    // parent::__construct();
  }

  public function show() {
    return 'Bar';
  }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MDB {
  public function __construct() {
    ActiveRecord\Config::initialize(function($cfg) {
      $cfg->set_model_directory(FCPATH . 'application/models');
      $cfg->set_connections([
        'development' => 'mysql://root:1234@localhost/ci_practice',
      ]);
    });
  }
}


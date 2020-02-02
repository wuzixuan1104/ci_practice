<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

  public function index() {
    $this->load->view('admin/layout/main', [
      'contentView' => 'admin/financial/report'
    ]);
  }

  public function dashboard() {
    $this->load->view('admin/layout/main', [
      'contentView' => 'admin/marketing/dashboard'
    ]);
  }
}

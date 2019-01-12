<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Asset as Asset;

class MY_Controller extends CI_Controller{
  protected $asset, $data, $layout, $params = [];

  public function __construct() {
    parent::__construct();

    $this->params = ['flash' => $this->session->flashdata('flash')];

    $this->layout = 'site/layout.php';
    $this->asset = Asset::create()->addJS('public.js');
  }
}
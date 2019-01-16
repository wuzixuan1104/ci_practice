<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Asset as Asset;

class MY_Controller extends CI_Controller{
  protected $asset, $data, $layout, $params = [];

  public function __construct() {
    parent::__construct();

    // if($this->session->userdata('id') === null && $this->uri->segment(1) != 'login')
    //   redirect('login');

    // if($this->uri->segment(1) == 'login' && $this->session->userdata('id') !== null)
    //   redirect('/');

    $this->params = ['flash' => $this->session->flashdata('flash')];

    $this->layout = 'site/layout.php';
    $this->asset = Asset::create()->addJS('public.js');
  }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Asset as Asset;

class MY_Controller extends CI_Controller{
  protected $asset, $data, $layout;

  public function __construct() {
    parent::__construct();

    $this->layout = 'site/layout.php';
    $this->asset = Asset::create()->addJS('public.js');
  }
}
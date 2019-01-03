<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\Asset as Asset;

class MY_Controller extends CI_Controller{
  protected $asset, $data;

  public function __construct() {
    parent::__construct();

    $this->asset = Asset::create()->addJS('public.js');
  }
}
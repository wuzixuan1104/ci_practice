<?php
use Lib\Asset as Asset;

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
  protected $asset;
  public function __construct() {
    parent::__construct();

    $asset = Asset::create();

  }
}
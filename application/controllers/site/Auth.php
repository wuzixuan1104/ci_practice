<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\View as View;

class Auth extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->asset->addCSS('site/auth.css');
  }

  public function login() {
    // $cfg = \ActiveRecord\Config::instance();
    // var_dump($cfg);
    // die;

    $view = View::create('site/login.php');
                   // ->with('name', 'cherry')
                   // ->with('birthday', '83-11-04')
                   // ->with('part', View::create('site/test.php')->with('user', 'OA') );

    $this->load->view($this->layout, [
      'path' => $view->vpath,
      // 'params' => $view->vparam,
      'asset' => $this->asset,
      'title' => 'LOGIN IN',
    ]);
  }
}

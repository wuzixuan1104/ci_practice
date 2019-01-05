<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\View as View;

class Auth extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->asset->addCSS('site/auth.css');
  }

  public function login() {
    $this->load->model('User', 'user');
    $data = $this->user->show(1);
    print_r($data);
    die;
    $content = View::create('site/login.php');
                   // ->with('name', 'cherry');
                   // ->with('birthday', '83-11-04')
                   // ->with('part', View::create('site/test.php')->with('user', 'OA') );

    $this->load->view($this->layout, [
      'content' => $content,
      'asset' => $this->asset,
      'title' => 'LOGIN IN',
    ]);
  }
}

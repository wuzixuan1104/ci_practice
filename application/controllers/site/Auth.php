<?php
// use Model\Bar as Bar;
// use Lib\Marco as Marco;

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

  public function login()
  {
    $this->load->view('site/login.php');
    // $bar = new Bar();
    // echo $bar->show();

    // $marco = new Marco();
    // echo $marco->show();
  }
}

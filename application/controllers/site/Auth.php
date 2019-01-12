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
  
    $content = View::create('site/login.php');
                   // ->with('name', 'cherry');
                   // ->with('birthday', '83-11-04')
                   // ->with('part', View::create('site/test.php')->with('user', 'OA') );

    $this->load->view($this->layout, array_merge($this->params, [
      'content' => $content,
      'asset' => $this->asset,
      'title' => 'LOGIN IN',
    ]));
  }

  public function loginProcess() {
    $posts = $this->input->post();

    $errorMsg = '';
    $posts['account'] && is_string($posts['account'] ) || $errorMsg = '帳號格式錯誤！';
    $posts['password'] && is_string($posts['password']) || $errorMsg = '密碼格式錯誤！';
    // $errorMsg && errorOutput();
    $errorMsg = '錯誤！！！';
    $this->session->set_flashdata('flash', ['type' => 'active', 'msg' => $errorMsg, 'param' => $posts]);
    
    header('Refresh:0;url=' . base_url('login'));
    
    // if(password_verify($_POST["password"],$hashed_password))
    // echo "Welcome"; 


    // $hashed_password = password_hash($_POST["password"],PASSWORD_DEFAULT);
  }


}

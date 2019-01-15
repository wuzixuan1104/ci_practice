<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\View as View;

class Auth extends MY_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('User', 'user');
    $this->asset->addCSS('site/auth.css');
  }

  public function login() {
    $this->load->view($this->layout, array_merge($this->params, [
      'content' => View::create('site/login.php'),
      'asset' => $this->asset,
      'title' => 'LOGIN IN',
    ]));

    // $content = View::create('site/login.php');
                   // ->with('name', 'cherry');
                   // ->with('birthday', '83-11-04')
                   // ->with('part', View::create('site/test.php')->with('user', 'OA') );
  }

  public function loginProcess() {
    $validator = function(&$posts) {
      if(!($posts['account'] && ($posts['account'] = trim(strip_tags($posts['account']))) && is_string($posts['account'])))
        return '帳號格式錯誤！';
      
      if(!($posts['password'] && ($posts['password'] = trim(strip_tags($posts['password']))) && is_string($posts['password'])))
        return '密碼格式錯誤！';
      
      if($user = $this->user->findOne(['where' => ['account = ?', $posts['account']]])) {
        if(!password_verify($posts['password'], $user['password'])) 
          return '密碼輸入不正確！';

        $this->session->set_userdata('id', $user['id']);
      } else {
        return '查無此使用者帳號！';
      }
      return false;
    };

    $posts = $this->input->post();

    if($errorMsg = $validator($posts)) {
      $this->session->set_flashdata('flash', ['type' => 'active', 'msg' => $errorMsg, 'param' => $posts]);
      header('Refresh:0;url=' . base_url('login'));
    } else {
      redirect('/');
    }
  }


}

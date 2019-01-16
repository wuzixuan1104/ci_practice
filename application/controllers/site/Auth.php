<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\View as View;

class Auth extends MY_Controller {
  public function __construct() {
    parent::__construct();
    $this->asset->addCSS('site/auth.css');
  }

  public function login() {
    $this->load->view($this->layout, array_merge($this->params, [
      'content' => View::create('site/login.php'),
      'asset' => $this->asset,
      'title' => 'LOGIN IN',
    ]));

    // $content = View::create('site/login.php')->with('name', 'cherry')->with('birthday', '83-11-04')->with('part', View::create('site/test.php')->with('user', 'OA') );
  }

  public function loginProcess() {
    $validator = function(&$posts) {
      if(!($posts['account'] && ($posts['account'] = trim(strip_tags($posts['account']))) && is_string($posts['account'])))
        return '帳號格式錯誤！';
      
      if(!($posts['password'] && ($posts['password'] = trim(strip_tags($posts['password']))) && is_string($posts['password'])))
        return '密碼格式錯誤！';
      
      if($user = Mdb::model('User')->findOne(['where' => ['account = ?', $posts['account']]])) {
        if(!password_verify($posts['password'], $user['password'])) 
          return '密碼輸入不正確！';

        $this->session->set_userdata('id', $user['id']);
      } else {
        return '查無此使用者帳號！';
      }
      return false;
    };

    $posts = $this->input->post();

    if($error = $validator($posts)) {
      $this->session->set_flashdata('flash', ['type' => 'active', 'msg' => $error, 'param' => $posts]);
      header('Refresh:0;url=' . base_url('login'));
    } else {
      redirect('/');
    }
  }

  public function register() {
    $this->load->view($this->layout, array_merge($this->params, [
      'content' => View::create('site/signin.php'),
      'asset' => $this->asset,
      'title' => 'Sign In',
    ]));
  }

  public function registerProcess() {
    $validator = function(&$posts) {
      if(!($posts['account'] && ($posts['account'] = trim(strip_tags($posts['account']))) && is_string($posts['account'])))
        return '帳號格式錯誤！';
      
      if(!($posts['password'] && ($posts['password'] = trim(strip_tags($posts['password']))) && is_string($posts['password'])))
        return '密碼格式錯誤！';

      if(!($posts['chkpassword'] && ($posts['chkpassword'] = trim(strip_tags($posts['chkpassword']))) && is_string($posts['chkpassword']) && $posts['chkpassword'] == $posts['password']))
        return '確認密碼錯誤！';

      if(!($posts['name'] && ($posts['name'] = trim(strip_tags($posts['name']))) && is_string($posts['name'])))
        return '名稱格式錯誤！';

      if(Mdb::model('User')->findOne(['where' => ['account = ?', $posts['account']]]))
        return '此帳號的用戶已存在！';

      $posts['password'] = password_hash($posts['password'], PASSWORD_DEFAULT);

      return false;
    };

    $posts = $this->input->post();

    if($error = $validator($posts)) {
      $url = 'register';
    } elseif (Mdb::transaction(function() use ($posts) { return Mdb::model('User')->insert($posts); })) {
      unset($posts['password']);
      ($url = 'login') && $error = '已註冊成功！您已經可以登入了！';
    } else {
      ($url = 'register') && $error = '系統發生錯誤！';
    }

    $this->session->set_flashdata('flash', ['type' => 'active', 'msg' => $error, 'param' => $posts]);
    header('Refresh:0;url=' . base_url($url));
  }
}

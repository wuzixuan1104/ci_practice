<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Lib\View as View;

class Search extends MY_Controller {
  public function __construct() {
    parent::__construct();
    
  }

  public function index() {
    $this->asset->addJS('https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js')
                ->addJS('https://unpkg.com/vuejs-paginate@0.9.0')
                ->addJS('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');

    $this->load->view($this->layout, array_merge($this->params, [
      'content' => View::create('site/search.php'),
      'asset' => $this->asset,
      'title' => 'Search',
    ]));
  }

  public function place() {
    $keyword = $_GET['keyword'];
    $data = [
      '東' => ['東北', '東京', '東南'],
      '北' => ['北美', '北灣'],
      '東南' => ['東南1', '東南3']
    ];

    die (json_encode($data[$keyword]));
  }

  public function result() {
    $gets = $_GET;

    $data = [
      ['title' => '飯店1', 'star' => 5, 'price' => '1,800'],
      ['title' => '飯店2', 'star' => 4, 'price' => '2,800'],
      ['title' => '飯店3', 'star' => 3, 'price' => '3,800'],
      ['title' => '飯店4', 'star' => 1, 'price' => '4,800'],
      ['title' => '飯店5', 'star' => 3, 'price' => '2,800'],
      ['title' => '飯店6', 'star' => 3, 'price' => '6,800'],
      ['title' => '飯店7', 'star' => 2, 'price' => '9,800'],
      ['title' => '飯店8', 'star' => 2, 'price' => '10,800'],
      ['title' => '飯店9', 'star' => 5, 'price' => '11,800'],
    ];

    die (json_encode($data));
  }
}

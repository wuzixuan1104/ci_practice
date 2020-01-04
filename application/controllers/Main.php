<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function index() {
    echo $this->lang->line('welcome_message');
	}
}

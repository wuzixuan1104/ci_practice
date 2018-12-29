<?php
use Model\Bar as Bar;
use Lib\Marco as Marco;

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$bar = new Bar();
		echo $bar->show();

		$marco = new Marco();
		echo $marco->show();
	}
}

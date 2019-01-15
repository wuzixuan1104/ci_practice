<?php defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'main';
$route['login'] = 'site/auth/login';
$route['login/process'] = 'site/auth/loginProcess';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

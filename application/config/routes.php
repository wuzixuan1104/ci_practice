<?php defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'main/index';
$route['/'] = 'main/index';
$route['search'] = 'search/index';

$route['login'] = 'site/auth/login';
$route['login/process'] = 'site/auth/loginProcess';
$route['register'] = 'site/auth/register';
$route['register/process'] = 'site/auth/registerProcess';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

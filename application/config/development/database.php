<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'dev';
$active_record = TRUE;
$query_builder = TRUE;

$db['default'] = array(
  'dsn' => '',
  'hostname' => 'localhost',
  'username' => '',
  'password' => '',
  'database' => '',
  'dbdriver' => 'mysqli',
  'dbprefix' => '',
  'pconnect' => FALSE,
  'db_debug' => (ENVIRONMENT !== 'production'),
  'cache_on' => FALSE,
  'cachedir' => '',
  'char_set' => 'utf8',
  'dbcollat' => 'utf8_general_ci',
  'swap_pre' => '',
  'encrypt' => FALSE,
  'compress' => FALSE,
  'stricton' => FALSE,
  'failover' => array(),
  'save_queries' => TRUE
);

$db['dev'] = array(
  'dsn' => 'mysql:host=localhost;port=3306;dbname=ci_practice',
  'hostname' => 'localhost',
  'username' => 'root',
  'password' => '1234',
  'database' => 'ci_practice',
  'dbdriver' => 'pdo',
  'dbprefix' => '',
  'pconnect' => FALSE,
  'db_debug' => (ENVIRONMENT !== 'production'),
  'cache_on' => FALSE,
  'cachedir' => '',
  'char_set' => 'utf8mb4',
  'dbcollat' => 'utf8mb4_general_ci',
  'swap_pre' => '',
  'encrypt' => FALSE,
  'compress' => FALSE,
  'stricton' => FALSE,
  'failover' => array(),
  'save_queries' => TRUE
);

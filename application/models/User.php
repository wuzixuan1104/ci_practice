<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Mdb {
  protected $tableName = 'User';

  protected $columns = ['account', 'password', 'name'];

  public function __construct() {
    parent::__construct();
  }
}
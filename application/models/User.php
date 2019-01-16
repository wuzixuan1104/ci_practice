<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Mdb {
  protected $tableName = 'User';

  public function __construct() {
    parent::__construct();
  }
}
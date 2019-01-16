<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Mdb {
  protected $tableName = 'User';
  private $columns = ['account', 'password', 'name'];

  public function __construct() {
    parent::__construct();
  }

  public function insert($params) {
    if(!(is_array($params) && count(array_intersect_key(array_flip($this->columns), $params)) === count($this->columns) ))
      return false;

    $q = $this->db->prepare("INSERT INTO `User` (`account`, `password`, `name`) VALUES (:account, :password, :name)");
    
    $q->bindParam(':account', $params['account']);
    $q->bindParam(':password', $params['password']);
    $q->bindParam(':name', $params['name']);

    return $q->execute();
  }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
  private $dbh;

  static $tableName = 'User';

  public function __construct() {
    parent::__construct();
    $this->dbh = $this->db->conn_id; 
  }

  public function findOne($condition = '') {
    if($q = $this->find($condition))
      return $q->fetch(PDO::FETCH_ASSOC);
    return false; 
  }

  public function findAll($condition = '') {
    if($q = $this->find($condition))
      return $q->fetchAll(PDO::FETCH_ASSOC);
    return false; 
  }

  public function find($condition) {
    $sql = "SELECT * FROM `User` ";

    $params = [];
    if(isset($condition['where'])) {
      $where = array_shift($condition['where']);
      if(substr_count($where, '?') != count($condition['where']))
        return false;

      foreach($condition['where'] as $key => $value) {
        $where = str_replace('?', ':con' . $key, $where);
        $params[':con' . $key] = $value;
      }
      $sql .= "WHERE " . $where;
    }

    (isset($condition['order']) && $sql .= " ORDER BY " . $condition['order']) || $sql .= " ORDER BY `id` DESC ";

    $q = $this->dbh->prepare($sql);
    if($params) 
      foreach($params as $k => $v) 
        $q->bindParam($k, $v);
    
    $q->execute();
    return $q;
  }
}
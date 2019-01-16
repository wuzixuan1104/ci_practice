<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mdb extends CI_Model {
  private static $load;
  private static $curClass;
  private static $dbContainer = [];
  private static $dbConf = [
    'db' => 'dev',
    '_db' => 'default'
  ];
  protected $dbh;

  public function __construct() {
    parent::__construct();

    self::$load =& $this->load;
    self::$curClass =& $this;
    $this->db = $this->db->conn_id;
  }

  public static function model($name) {
    self::$load->model($name);
    return self::$curClass->{$name};
  }

  public static function transaction($closure) {
    $db = self::initDB('db');
    $db->trans_begin();

    try {
      $exec = call_user_func($closure);
      if($db->trans_status() === false) {
        throw new \Exception('Transaction Exception!');
      }
      $db->trans_commit();
      return $exec;

    } catch (\Exception $e) {
      $db->trans_rollback();
      throw new \Exception($e->getMessage(), $e->getCode(), $e);
    }
  }

  protected static function initDB($name) {
    $dbConfName = self::$dbConf[$name];
    if(!isset(self::$dbContainer[$dbConfName]) || !is_a(self::$dbContainer[$dbConfName], 'CI_DB')) {
      self::$dbContainer[$dbConfName] = self::$load->database($dbConfName, true);
    }
    return self::$dbContainer[$dbConfName];
  }

  public function __get($key) {
    if(array_key_exists($key, self::$dbConf)) {
      return self::initDB($key);
    } else {
      return parent::__get($key);
    }
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
    $sql = "SELECT * FROM {$this->tableName} ";
    $params = [];

    if(isset($condition['where'])) {
      $where = array_shift($condition['where']);
      if(substr_count($where, '?') != count($condition['where']))
        return false;

      foreach($condition['where'] as $key => $value) 
        ($where = str_replace('?', ':con' . $key, $where)) && $params[':con' . $key] = $value;
      
      $sql .= "WHERE " . $where;
    }

    (isset($condition['order']) && $sql .= " ORDER BY " . $condition['order']) || $sql .= " ORDER BY `id` DESC ";

    $q = $this->db->prepare($sql);

    foreach($params as $k => $v) 
      $q->bindParam($k, $v);
    
    $q->execute();
    return $q;
  }
}


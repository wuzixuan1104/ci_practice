<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
  private $dbh;
  public function __construct() {
    parent::__construct();
    $this->dbh = $this->db->conn_id; 
  }

  public function show($id) {
    $q = $this->dbh->prepare("SELECT * FROM `User` WHERE `id` = :id");

    $q->bindParam(":id", $id);
    $q->execute();    

    return $q->fetch(PDO::FETCH_ASSOC);
  }

  public function search() {

  }
}
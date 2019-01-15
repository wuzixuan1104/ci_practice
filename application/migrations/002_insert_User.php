<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_insert_User extends CI_Migration {

  public function up() {
    if($this->db->table_exists('User')) {

      $data = [
        [
          'account' => "admin",
          'password' => "$2y$10$TlFeuoqwraov6oTxjnkazuS1VaOn4aKOP5EluryCI2IM4aavE7PjK",
          'name' => "admin"
        ]
      ];
      
      return $this->db->insert_batch('User', $data);
    }
    
  }

  public function down() {
    $this->db->where('id', "1");
    $this->db->delete('User');
    
    return $this->db->affected_rows();
  }
}
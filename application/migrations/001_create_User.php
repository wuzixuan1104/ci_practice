<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_User extends CI_Migration {

  public function up() {
    if(!$this->db->table_exists('User')) {
      $this->dbforge->add_field([
        'id' => [
          'type' => 'INT',
          'constraint' => 11,
          'unsigned' => TRUE,
          'auto_increment' => TRUE
        ],
        'account' => [
          'type' => 'VARCHAR',
          'constraint' => '100',
        ],
        'password' => [
          'type' => 'VARCHAR',
          'constraint' => '100',
        ],
        'name' => [
          'type' => 'VARCHAR',
          'constraint' => '50',
          'null' => TRUE,
        ]
      ]);

      $this->dbforge->add_key('id', TRUE);
      return $this->dbforge->create_table('User');
    }
  }

  public function down() {
    return $this->dbforge->drop_table('User');
  }
}
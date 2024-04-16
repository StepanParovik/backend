<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'uuid',
                'unsigned' => true,
            ],
            'create_date' => [
                'type' => 'timestamp'
            ],
            'update_date' => [
                'type' => 'timestamp'
            ],
            'is_del' => [
                'type' => 'boolean',
                'default' => false,
            ],
            'name' => [
                'type' => 'VARCHAR',
            ],
            'surname' => [
                'type' => 'VARCHAR',
            ],
            'patronymic' => [
                'type' => 'VARCHAR',
                'null' => true
            ],
            'login' => [
                'type' => 'VARCHAR',
            ],
            'password' => [
                'type' => 'VARCHAR',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        $DEFAULT_sql = "ALTER TABLE users ALTER COLUMN id SET DEFAULT uuid_generate_v4();";
        $this->db->query($DEFAULT_sql);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

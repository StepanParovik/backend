<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public string $table = 'users';

    public function up()
    {
        $this->db->transStart();

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
        $this->forge->createTable($this->table);

        // добавление значений по умолчанию
        $defaults = [
            'id' => 'uuid_generate_v4()',
            'create_date' => 'CURRENT_TIMESTAMP',
            'update_date' => 'CURRENT_TIMESTAMP'
            ];
        $sql = '';

        foreach($defaults as $column => $value){
            $sql .= "ALTER TABLE $this->table ALTER COLUMN $column SET DEFAULT $value;";
            $this->db->query($sql);
        }

        $this->db-> transComplete();
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

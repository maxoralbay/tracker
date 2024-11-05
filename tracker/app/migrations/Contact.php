<?php

namespace App\Migrations;

use AppBase\Migrations;

class Contact extends Migrations
{
    public function up()
    {   $fields = [
        'id' => 'INT AUTO_INCREMENT PRIMARY KEY',
        'name' => 'VARCHAR(100) NOT NULL',
        'email' => 'VARCHAR(100) NOT NULL',
        'phone' => 'VARCHAR(100) NOT NULL',
        'message' => 'TEXT NOT NULL',
        'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
    ];
        $this->createTable('contacts', $fields);
    }
    public function down()
    {
        $this->dropTable('contacts');
    }
}
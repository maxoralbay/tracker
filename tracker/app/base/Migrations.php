<?php

namespace App\Base;
use App\Base\Database;
class Migrations extends Database
{
    public function __construct()
    {
        parent::__construct();
    }



    public function createTable($table, $fields)
    {
        $sql = "CREATE TABLE IF NOT EXISTS $table (";
        foreach ($fields as $field) {
            $sql .= $field . ",";
        }
        $sql = rtrim($sql, ",");
        $sql .= ")";
        $this->db->exec($sql);
    }

    public function dropTable($table)
    {
        $sql = "DROP TABLE IF EXISTS $table";
        $this->db->exec($sql);
    }

    public function truncateTable($table)
    {
        $sql = "TRUNCATE TABLE $table";
        $this->db->exec($sql);
    }

    public function addColumn($table, $column)
    {
        $sql = "ALTER TABLE $table ADD $column";
        $this->db->exec($sql);
    }

    public function dropColumn($table, $column)
    {
        $sql = "ALTER TABLE $table DROP COLUMN $column";
        $this->db->exec($sql);
    }

    public function renameColumn($table, $old_column, $new_column)
    {
        $sql = "ALTER TABLE $table CHANGE $old_column $new_column";
        $this->db->exec($sql);
    }

    public function addForeignKey($table, $column, $ref_table, $ref_column)
    {
        $sql = "ALTER TABLE $table ADD FOREIGN KEY ($column) REFERENCES $ref_table($ref_column)";
        $this->db->exec($sql);
    }

    public function dropForeignKey($table, $column)
    {
        $sql = "ALTER TABLE $table DROP FOREIGN KEY $column";
        $this->db->exec($sql);
    }

    public function addIndex($table, $column)
    {
        $sql = "ALTER TABLE $table ADD INDEX $column";
        $this->db->exec($sql);
    }

    public function dropIndex($table, $column)
    {
        $sql = "ALTER TABLE $table DROP INDEX $column";
        $this->db->exec($sql);
    }
}
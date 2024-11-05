<?php

namespace App\Base;
use App\Base\Database;
class Model
{
    protected $db;
    protected $table = null;
    protected $fillable = [];
    protected $database = 'database';
    public function __construct($database=null)
    {
        if($database == null){
            $database = require_once __DIR__ . '/../config/' . $this->database . '.php';
            $this->db = new Database($database);
        }
        $this->db = new Database();
    }

}
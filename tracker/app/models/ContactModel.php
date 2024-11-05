<?php

namespace App\Models;

use App\Base\Model;
class ContactModel extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['name', 'email', 'phone', 'message'];

    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
    }
}
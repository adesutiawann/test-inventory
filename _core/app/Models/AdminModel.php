<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admin';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nik', 'username', 'password', 'nama', 'whatsapp', 'level', 'tgl'];

    protected $validationRules = [
        'username' => 'required|is_unique[admin.username,id,{id}]',
    ];
}

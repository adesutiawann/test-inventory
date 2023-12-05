<?php

namespace App\Models;

use CodeIgniter\Model;

class PortModel extends Model
{
    protected $table            = 'tb_Port';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'port', 'tgl'];

    protected $validationRules = [
        'port' => 'required|is_unique[tb_port.port,id,{id}]',
    ];
}

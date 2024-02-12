<?php

namespace App\Models;

use CodeIgniter\Model;

class KabelModel extends Model
{
    protected $table            = 'tb_kabel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jumlah'];
}

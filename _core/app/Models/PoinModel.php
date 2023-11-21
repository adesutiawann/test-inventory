<?php

namespace App\Models;

use CodeIgniter\Model;

class PoinModel extends Model
{
    protected $table            = 'poin';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pelanggaran', 'poin'];
}

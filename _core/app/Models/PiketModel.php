<?php

namespace App\Models;

use CodeIgniter\Model;

class PiketModel extends Model
{
    protected $table            = 'piket';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru'];
}

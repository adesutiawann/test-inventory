<?php

namespace App\Models;

use CodeIgniter\Model;

class BpModel extends Model
{
    protected $table            = 'bp';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru'];
}

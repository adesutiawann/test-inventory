<?php

namespace App\Models;

use CodeIgniter\Model;

class PembinaModel extends Model
{
    protected $table            = 'pembina';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru', 'extra'];
}

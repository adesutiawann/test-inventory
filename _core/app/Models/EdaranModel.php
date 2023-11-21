<?php

namespace App\Models;

use CodeIgniter\Model;

class EdaranModel extends Model
{
    protected $table            = 'edaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','kelas', 'text','file','tanggal'];
}

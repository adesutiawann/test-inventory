<?php

namespace App\Models;

use CodeIgniter\Model;

class WalikelasModel extends Model
{
    protected $table            = 'walikelas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['guru', 'kelas', 'tahun_pelajaran'];
}

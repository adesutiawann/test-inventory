<?php

namespace App\Models;

use CodeIgniter\Model;

class PanggilanModel extends Model
{
    protected $table            = 'panggilan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['siswa', 'file', 'tahun_pelajaran', 'semester', 'jenis'];
}

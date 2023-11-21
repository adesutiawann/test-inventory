<?php

namespace App\Models;

use CodeIgniter\Model;

class Tahun_pelajaranModel extends Model
{
    protected $table            = 'tahun_pelajaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tahun', 'semester','aktif'];
}

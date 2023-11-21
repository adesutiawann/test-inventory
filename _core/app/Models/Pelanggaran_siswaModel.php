<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelanggaran_siswaModel extends Model
{
    protected $table            = 'pelanggaran_siswa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'siswa', 'poin'];
}

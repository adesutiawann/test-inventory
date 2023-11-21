<?php

namespace App\Models;

use CodeIgniter\Model;

class Absensi_dhuhurModel extends Model
{
    protected $table            = 'absensi_dhuhur';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'guru', 'siswa'];
}

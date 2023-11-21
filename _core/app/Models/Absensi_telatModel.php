<?php

namespace App\Models;

use CodeIgniter\Model;

class Absensi_telatModel extends Model
{
    protected $table            = 'absensi_telat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'guru', 'siswa', 'notif'];
}

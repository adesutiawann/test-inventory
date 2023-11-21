<?php

namespace App\Models;

use CodeIgniter\Model;

class Absensi_kegiatanModel extends Model
{
    protected $table            = 'absensi_kegiatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pembina', 'tanggal', 'extra', 'siswa', 'absensi', 'tahun_pelajaran', 'semester'];
}

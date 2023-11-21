<?php

namespace App\Models;

use CodeIgniter\Model;

class Laporan_kegiatanModel extends Model
{
    protected $table            = 'laporan_kegiatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'guru', 'extra', 'foto_absensi', 'foto_kegiatan1', 'foto_kegiatan2'];
}

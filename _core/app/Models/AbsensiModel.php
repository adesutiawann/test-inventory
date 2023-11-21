<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table            = 'absensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['walikelas','id_mengajar','tanggal', 'kelas', 'siswa', 'absensi', 'tahun_pelajaran', 'semester', 'notifikasi'];
}

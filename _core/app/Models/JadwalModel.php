<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'tb_mengajar';
    protected $primaryKey       = 'id_mengajar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_pelajaran', 'hari', 'jam_mengajar', 'jamke', 'id_guru', 'id_mapel','kelas','id_tahun'];

   // protected $validationRules = [
     //   'id' => 'required|is_unique[tb_mengajar.kode_pelajaran,kode,{kode_pelajaran}]',
   // ];
}

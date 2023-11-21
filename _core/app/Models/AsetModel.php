<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetModel extends Model
{
    protected $table            = 'tb_aset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','tgl_masuk','tgl_keluar','manufacture','type','prosesor',
    'generasi','serial','hdd','ram','rincian','status','stock','kondisi','ket'];

    protected $validationRules = [
      //  'Aset' => 'required|is_unique[tb_aset.aset,id,{id}]',
    ];

  
}

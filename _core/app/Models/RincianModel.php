<?php

namespace App\Models;

use CodeIgniter\Model;

class RincianModel extends Model
{
    protected $table            = 'tb_rincian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nama','tgl'];

    protected $validationRules = [
       'nama' => 'required|is_unique[tb_rincian.nama,id,{id}]',
    ];
}

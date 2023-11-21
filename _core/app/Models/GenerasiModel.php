<?php

namespace App\Models;

use CodeIgniter\Model;

class GenerasiModel extends Model
{
    protected $table            = 'tb_generasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nama','tgl'];

    protected $validationRules = [
       'nama' => 'required|is_unique[tb_generasi.nama,id,{id}]',
    ];
}

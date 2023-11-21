<?php

namespace App\Models;

use CodeIgniter\Model;

class KondisiModel extends Model
{
    protected $table            = 'tb_kondisi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','nama','tgl'];

    protected $validationRules = [
       'nama' => 'required|is_unique[tb_kondisi.nama,id,{id}]',
    ];
}

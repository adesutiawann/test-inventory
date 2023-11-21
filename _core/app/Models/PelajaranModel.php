<?php

namespace App\Models;

use CodeIgniter\Model;

class PelajaranModel extends Model
{
    protected $table            = 'tb_mapel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['mapel'];

    protected $validationRules = [
        'mapel' => 'required|is_unique[tb_mapel.mapel,id,{id}]',
    ];
}

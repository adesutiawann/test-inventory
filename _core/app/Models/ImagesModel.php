<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagesModel extends Model
{
    protected $table            = 'tb_images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'serial', 'tgl', 'image'];

    protected $validationRules = [
        //'nama' => 'required|is_unique[tb_stok.nama,id,{id}]',
    ];
}

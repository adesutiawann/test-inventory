<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table            = 'tb_riwayat';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['serial', 'tgl', 'ket', 'user', 'lokasi', 'teknisi'];

    protected $validationRules = [
        //'nama' => 'required|is_unique[tb_ram.nama,id,{id}]',
    ];
}

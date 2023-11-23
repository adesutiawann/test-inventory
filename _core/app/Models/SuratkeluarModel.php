<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratkeluarModel extends Model
{
  protected $table            = 'tb_asetk';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'object';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['id', 'id_sk', 'id_aset', 'tgl'];


  protected $validationRules = [
    //  'Aset' => 'required|is_unique[tb_aset.aset,id,{id}]',
  ];
}

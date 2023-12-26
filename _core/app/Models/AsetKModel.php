<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use PhpParser\Node\Stmt\Else_;

class AsetKModel extends Model
{
  protected $table            = 'tb_asetk';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'object';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['id', 'id_sk', 'serial', 'tgl'];


  protected $validationRules = [
    //  'Aset' => 'required|is_unique[tb_aset.aset,id,{id}]',
  ];

  function getAll()
  {
    // Membuat instance query builder untuk tabel 'tb_aset'      
    $builder = $this->db->table('tb_asetk')
      ->select(
        'tb_asetk.id,tb_asetk.serial,
            tb_aset.type,tb_aset.manufacture, tb_aset.status, tb_aset.stock, tb_aset.kondisi',

      )

      ->join('tb_aset', 'tb_aset.serial = tb_asetk.serial')


      ->where('tb_asetk.id_sk', '1')

      ->orderBy('tb_asetk.id', 'desc');
    $query = $builder->get();
    return $query->getResult();
  }
}

<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use PhpParser\Node\Stmt\Else_;

class SuratkeluarModel extends Model
{
  protected $table            = 'tb_suratkeluar';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'object';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['id', 'nomor', 'jumlah', 'satuan', 'ket', 'penerima', 'nik', 'lokasi', 'telpon', 'tgl', 'status'];


  protected $validationRules = [
    // 'Aset' => 'required|is_unique[tb_aset.aset,id,{id}]',
  ];


  public function updateDatax($post)
  {
    //$tgl = '1';
    $this->where('id', '1');
    $this->set($post);
    return $this->update();
  }


  function getAllsuratkeluar()
  {
    $builder = $this->db->table('tb_suratkeluar')
      ->select(
        'tb_suratkeluar.id,tb_suratkeluar.nomor,tb_suratkeluar.jumlah,tb_suratkeluar.satuan,tb_suratkeluar.ket,
        tb_suratkeluar.penerima,tb_suratkeluar.nik,tb_suratkeluar.lokasi,tb_suratkeluar.telpon,
        tb_suratkeluar.status,tb_suratkeluar.tgl,',
      )

      ->orderBy('tb_suratkeluar.nomor', 'desc');
    $query = $builder->get();
    return $query->getResult();
  }
}

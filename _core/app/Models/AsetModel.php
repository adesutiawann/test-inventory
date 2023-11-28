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
  protected $allowedFields    = [
    'id', 'tgl_masuk', 'tgl_keluar', 'manufacture', 'type', 'prosesor',
    'generasi', 'serial', 'hdd', 'ram', 'rincian', 'status', 'stock', 'kondisi', 'ket'
  ];


  protected $validationRules = [
    //  'Aset' => 'required|is_unique[tb_aset.aset,id,{id}]',
  ];

  function getAll()
  {
    // Membuat instance query builder untuk tabel 'tb_aset'      
    $builder = $this->db->table('tb_aset')
      ->select(
        'tb_aset.id,tb_aset.tgl_masuk,tb_aset.tgl_keluar,tb_aset.serial,tb_aset.ket,
            tb_hdd.nama as hdd ,
            tb_manufacture.nama as manufacture,
            tb_prosesor.nama as prosesor,
            tb_type.nama as type,
            tb_generasi.nama as generasi,
            tb_ram.nama as ram,
            tb_rincian.nama as rincian,
            tb_status.nama as status,
            tb_stok.nama as stok,
            tb_kondisi.nama as kondisi',

      )

      ->join('tb_hdd', 'tb_hdd.id = tb_aset.hdd')
      ->join('tb_manufacture', 'tb_manufacture.id = tb_aset.manufacture')
      ->join('tb_type', 'tb_type.id = tb_aset.type')
      ->join('tb_prosesor', 'tb_prosesor.id = tb_aset.prosesor')
      ->join('tb_generasi', 'tb_generasi.id = tb_aset.generasi')
      ->join('tb_ram', 'tb_ram.id = tb_aset.ram')
      ->join('tb_rincian', 'tb_rincian.id = tb_aset.rincian')
      ->join('tb_status', 'tb_status.id = tb_aset.status')
      ->join('tb_stok', 'tb_stok.id = tb_aset.stock')
      ->join('tb_kondisi', 'tb_kondisi.id = tb_aset.kondisi')

      //->where('tb_kondisi.nama', $id)

      ->orderBy('tb_aset.id', 'desc');
    $query = $builder->get();
    return $query->getResult();
  }
  function getId($id)
  {
    $builder = $this->db->table('tb_aset')
      ->select(
        'tb_aset.id,tb_aset.tgl_masuk,tb_aset.tgl_keluar,tb_aset.serial,tb_aset.ket,
              tb_hdd.nama as hdd ,
              tb_manufacture.nama as manufacture,
              tb_prosesor.nama as prosesor,
              tb_type.nama as type,
              tb_generasi.nama as generasi,
              tb_ram.nama as ram,
              tb_rincian.nama as rincian,
              tb_status.nama as status,
              tb_stok.nama as stok,
              tb_kondisi.nama as kondisi',

      )

      ->join('tb_hdd', 'tb_hdd.id = tb_aset.hdd')
      ->join('tb_manufacture', 'tb_manufacture.id = tb_aset.manufacture')
      ->join('tb_type', 'tb_type.id = tb_aset.type')
      ->join('tb_prosesor', 'tb_prosesor.id = tb_aset.prosesor')
      ->join('tb_generasi', 'tb_generasi.id = tb_aset.generasi')
      ->join('tb_ram', 'tb_ram.id = tb_aset.ram')
      ->join('tb_rincian', 'tb_rincian.id = tb_aset.rincian')
      ->join('tb_status', 'tb_status.id = tb_aset.status')
      ->join('tb_stok', 'tb_stok.id = tb_aset.stock')
      ->join('tb_kondisi', 'tb_kondisi.id = tb_aset.kondisi')

      ->where('tb_kondisi.nama', $id)

      ->orderBy('tb_aset.id', 'desc');
    $query = $builder->get();
    return $query->getResult();
  }
}

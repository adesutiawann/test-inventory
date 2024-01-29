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

  public function generateCode()
  {
    $builder = $this->table('tb_suratkeluar');
    $builder->selectMax('nomor', 'invoiceMax');
    $query = $builder->get()->getResult();

    $serialNumber = 1;

    if (!empty($query)) {
      $maxInvoice = $query[0]->invoiceMax;
      // Assuming the serial number is the first 4 characters of the invoice
      if ($maxInvoice && strlen($maxInvoice) >= 4) {
        $ambilKode = substr($maxInvoice, 0, 4);
        $serialNumber = (intval($ambilKode)) + 1;
      }
    }

    $formattedSerialNumber = sprintf('%04s', $serialNumber);
    $romanMonth = $this->numberToRomanRepresentation(date("m"));
    $year = date("Y");

    return $formattedSerialNumber . '/PRY-MSI/KITECH/' . $romanMonth . '/' . $year;
  }

  private function numberToRomanRepresentation($number)
  {
    $map = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    return $map[$number - 1] ?? '';
  }


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

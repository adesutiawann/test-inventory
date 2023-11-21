<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AsetModel;
use App\Models\SiswaModel;

use App\Models\ManufactureModel;
use App\Models\TypeModel;
use App\Models\ProsesorModel;
use App\Models\GenerasiModel;
use App\Models\HddModel;
use App\Models\RamModel;
use App\Models\RincianModel;
use App\Models\StatusModel;
use App\Models\StokModel;
use App\Models\KondisiModel;
//use App\Models\PelajaranModel;

class aset extends BaseController
{
    protected $admin;
    protected $aset;

    protected $manufacture;
    protected $type;
    protected $prosesor;
    protected $generasi;
    protected $hdd;
    protected $ram;
    protected $rincian;
    protected $status;
    protected $stok;
    protected $kondisi;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->aset = new AsetModel();
        $this->siswa     = new SiswaModel();
        
       // $this->pelajaran     = new PelajaranModel();

       $this->manufacture=new ManufactureModel;
        $this->type=new TypeModel;
        $this->prosesor=new ProsesorModel;
        $this->generasi=new GenerasiModel;
        $this->hdd=new HddModel;
        $this->ram=new RamModel;
        $this->rincian=new RincianModel;
        $this->status=new StatusModel;
        $this->stok=new StokModel;
        $this->kondisi=new KondisiModel;
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Aset',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),            
            'type'    => $this->type->orderBy('nama', 'asc')->findAll(),            
            'prosesor'    => $this->prosesor->orderBy('nama', 'asc')->findAll(),
            'generasi'    => $this->generasi->orderBy('nama', 'asc')->findAll(),
            'hdd'    => $this->hdd->orderBy('nama', 'asc')->findAll(),
            'ram'    => $this->ram->orderBy('nama', 'asc')->findAll(),
            'rincian'    => $this->rincian->orderBy('nama', 'asc')->findAll(),
            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),
            // 'kelas'   => $this->siswa->groupBy('kelas')->findAll(),

       //  $id='',
         //'aset'    => $this->aset->find($id),
         //'nama'   => $this->aset->select('nama'),
           //perintah hiden insert edit
           //'input'   => '',
           //'edit'   => 'disabled',

        ];

        return view('admin/aset2', $data);
    }

    public function data()
    {
        // Menghubungkan ke database
$db = db_connect();

// Membuat instance query builder untuk tabel 'tb_aset'
//$builder = $db->table('tb_aset')
 
/*$builder = $db->table('tb_aset')
->select('tb_hdd.nama')
->join('tb_hdd', 'tb_hdd.id = tb_aset.hdd')
->orderBy('tb_aset.id','desc');
*/
$builder = $db->table('tb_aset')
->select('tb_aset.id,tb_aset.tgl_masuk,tb_aset.tgl_keluar,tb_aset.serial,tb_aset.ket,
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

->orderBy('tb_aset.id', 'desc');

/*$builder = $db->table('walikelas')
    ->select('walikelas.id, walikelas.kelas, admin.nama')
    ->join('admin', 'admin.id=walikelas.guru')
    ->orderBy('walikelas.id', 'desc');*/

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/aset/edit/' . $row->id) . 
                '" class="btn btn-sm btn-info text-white">
                <i class="fa-solid fa-pen-to-square"></i></a> 
                <a href="' . base_url('admin/aset/delete/' . $row->id) .
                 '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')"><i class="fa-solid fa-trash-can"></i></a>';
            })
            ->addNumbering('no')->toJson(true);
    }




    public function edit($id)
    {
        
       // $tgl= date("Y-m-d");
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        

        $data = [

            'title'   => 'Edit aset',
            'input'   => 'hidden',
            'edit'   => '',
            'ade'=>'1',

            'segment' => $this->request->uri->getSegments(),
            //'pel'   => $this->admin->find(session()->get('id')),
            
            'aset'    => $this->aset->find($id),
            'nama'   => $this->aset->select('nama'),
        ];

        return view('admin/aset', $data);
    }
    
    public function save()
    {
        
        $tgl= date("Y-m-d");
        if ($this->request->getVar('id')) {
             
                $post = [
                    'id'       => $this->request->getVar('id'),
                    'nama'            => $this->request->getVar('nama'),
                    'tgl'           => $tgl,
                    //'tahun_pelajaran' => $this->tp->tahun,
                ];

                if ($this->aset->save($post)) {
                    session()->setFlashdata('success', 'Data berhasil di edit.');
                    return redirect()->to(base_url('admin/aset'));
                } else {
                    session()->setFlashdata('error', 'Data Gagal di simpan.');
                    return redirect()->to(base_url('admin/aset'));
                }
        }else{
           // $tgl= date("Y-m-d");
            $post = [
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => $this->request->getVar('type'),
                'prosesor'            => $this->request->getVar('prosesor'),
                'generasi'            => $this->request->getVar('generasi'),
                'hdd'            => $this->request->getVar('hdd'),
                'ram'            => $this->request->getVar('ram'),
                'rincian'            => $this->request->getVar('rincian'),
                'status'            => $this->request->getVar('status'),
                'stock'            => $this->request->getVar('stock'),
                'kondisi'            => $this->request->getVar('kondisi'),
                'ket'            => $this->request->getVar('ket'),
                'tgl_masuk'            => $this->request->getVar('masuk'),
                'tgl_keluar'            => $this->request->getVar('keluar'),
                'serial'            => $this->request->getVar('serial'),
                //'kelas'           => $this->request->getVar('kelas'),
                //'tahun_aset' => $this->tp->tahun,
            ];

            if ($this->aset->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan.');
                return redirect()->to(base_url('admin/aset'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/aset'));
            }
            
        }
    }


    public function saveedit()
    {
        
        $tgl= date("Y-m-d");
            
                $post = [
                    'id'       => $this->request->getVar('id'),
                    'nama'            => $this->request->getVar('nama'),
                    'tgl'           => $tgl,
                    //'tahun_pelajaran' => $this->tp->tahun,
                ];

                if ($this->aset->save($post)) {
                    session()->setFlashdata('success', 'Data berhasil di edit.');
                    return redirect()->to(base_url('admin/aset'));
                } else {
                    session()->setFlashdata('error', 'Data Gagal di simpan.');
                    return redirect()->to(base_url('admin/aset'));
                }
    }
    public function delete($id)
    {
        if ($this->aset->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/aset'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/aset'));
        }
    }
}

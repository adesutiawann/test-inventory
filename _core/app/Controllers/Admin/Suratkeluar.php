<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AsetModel;

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

use App\Models\Suratkeluar_sk_Model;
use App\Models\SuratkeluarModel;

class Suratkeluar extends BaseController
{
    protected $admin;
    protected $suratkeluar;

    protected $suratkeluar_sk;

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

    protected $aset;


    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->aset = new AsetModel();
        $this->suratkeluar     = new SuratkeluarModel();

        $this->suratkeluar_sk     = new Suratkeluar_sk_Model();

        // $this->pelajaran     = new PelajaranModel();

        $this->manufacture = new ManufactureModel;
        $this->type = new TypeModel;
        $this->prosesor = new ProsesorModel;
        $this->generasi = new GenerasiModel;
        $this->hdd = new HddModel;
        $this->ram = new RamModel;
        $this->rincian = new RincianModel;
        $this->status = new StatusModel;
        $this->stok = new StokModel;
        $this->kondisi = new KondisiModel;
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        // $data['aset'] = $this->aset->findAll();

        $data = [
            'title'   => 'Surat Keluar',
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
            'aktiv'   => 'ALL',
            'aset' => $this->aset->getAll(),
            'suratkeluar_sk' => $this->suratkeluar_sk->getAllsuratkeluar(),



            'asetk' => $this->suratkeluar->getIdasetkeluar(),
            //'suratkeluar'    => $this->suratkeluar->find($id),

        ];



        return view('admin/suratkeluar', $data);
    }

    public function ok($id)
    {
        $data = [
            'title'   => 'Surat Keluar',
            'aktiv'   => $id,
            'segment' => $this->request->uri->getSegments(),
            //'aset' =>  $this->suratkeluar->where('kondisi', 'OK')->getAll(),
            'aset'    => $this->suratkeluar->getId($id),

        ];
        return view('admin/suratkeluar', $data);
    }
    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        //  $id = '1';
        $data = [
            'title'   => 'Surat Keluar',
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
            'asetk' => $this->suratkeluar->getIdasetkeluar(),
            // 'asetk' => $this->suratkeluar->getIdasetkeluar(),

        ];

        return view('admin/suratkeluaradd', $data);
    }

    public function data()
    {
        // Menghubungkan ke database
        $db = db_connect();
        // Membuat instance query builder untuk tabel 'tb_suratkeluar'      
        $builder = $db->table('tb_suratkeluar')
            ->select(
                'tb_suratkeluar.id,tb_suratkeluar.tgl_masuk,tb_suratkeluar.tgl_keluar,tb_suratkeluar.serial,tb_suratkeluar.ket,
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

            ->join('tb_hdd', 'tb_hdd.id = tb_suratkeluar.hdd')
            ->join('tb_manufacture', 'tb_manufacture.id = tb_suratkeluar.manufacture')
            ->join('tb_type', 'tb_type.id = tb_suratkeluar.type')
            ->join('tb_prosesor', 'tb_prosesor.id = tb_suratkeluar.prosesor')
            ->join('tb_generasi', 'tb_generasi.id = tb_suratkeluar.generasi')
            ->join('tb_ram', 'tb_ram.id = tb_suratkeluar.ram')
            ->join('tb_rincian', 'tb_rincian.id = tb_suratkeluar.rincian')
            ->join('tb_status', 'tb_status.id = tb_suratkeluar.status')
            ->join('tb_stok', 'tb_stok.id = tb_suratkeluar.stock')
            ->join('tb_kondisi', 'tb_kondisi.id = tb_suratkeluar.kondisi')

            //->where('tb_suratkeluar.kondisi',$id)

            ->orderBy('tb_suratkeluar.id', 'desc');


        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/suratkeluar/edit/' . $row->id) .
                    '" class="btn btn-sm btn-info text-white">
                <i class="fa-solid fa-pen-to-square"></i></a> 
                <a href="' . base_url('admin/suratkeluar/delete/' . $row->id) .
                    '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')"><i class="fa-solid fa-trash-can"></i></a>';
            })
            ->addNumbering('no')->toJson(true);
        //return view('admin/suratkeluar', $data);
    }



    public function edit($id)
    {

        // $tgl= date("Y-m-d");
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }



        $data = [

            'title'   => 'Edit suratkeluar',
            'input'   => 'hidden',
            'edit'   => '',
            'ade' => '1',

            'segment' => $this->request->uri->getSegments(),
            //'pel'   => $this->admin->find(session()->get('id')),

            'suratkeluar'    => $this->suratkeluar->find($id),
            'nama'   => $this->suratkeluar->select('nama'),
        ];

        return view('admin/suratkeluar', $data);
    }

    public function save()
    {

        $tgl = date("Y-m-d");
        if ($this->request->getVar('id')) {

            $post = [
                'id'       => $this->request->getVar('id'),
                'nama'            => $this->request->getVar('nama'),
                'tgl'           => $tgl,
                //'tahun_pelajaran' => $this->tp->tahun,
            ];

            if ($this->suratkeluar->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di edit.');
                return redirect()->to(base_url('admin/suratkeluar'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/suratkeluar'));
            }
        } else {
            $tgl = date("Y-m-d");
            $post = [
                'id_sk'            => $this->request->getVar('id_sk'),
                'id_aset'            => $this->request->getVar('id_aset'),
                'tgl'           => $tgl,
            ];

            if ($this->suratkeluar->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan.');
                return redirect()->to(base_url('admin/suratkeluar/add'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/suratkeluar/add'));
            }
        }
    }


    public function saveedit()
    {

        $tgl = date("Y-m-d");

        $post = [
            'id'       => $this->request->getVar('id'),
            'nama'            => $this->request->getVar('nama'),
            'tgl'           => $tgl,
            //'tahun_pelajaran' => $this->tp->tahun,
        ];

        if ($this->suratkeluar->save($post)) {
            session()->setFlashdata('success', 'Data berhasil di edit.');
            return redirect()->to(base_url('admin/suratkeluar'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/suratkeluar'));
        }
    }
    public function savesuratkeluar()
    {

        $tgl = date("Y-m-d");
        if ($this->request->getVar('id')) {
            $post = [
                'nomor'       => $this->request->getVar('nomor'),
                'jumlah'            => $this->request->getVar('jumlah'),
                'satuan'            => $this->request->getVar('satuan'),
                'ket'            => $this->request->getVar('ket'),

                'nik'            => $this->request->getVar('nik'),
                'penerima'            => $this->request->getVar('penerima'),
                'telpon'            => $this->request->getVar('telpon'),
                'lokasi'            => $this->request->getVar('lokasi'),

                'tgl'           => $tgl,

                'status'            => $this->request->getVar('status'),
                //'tahun_pelajaran' => $this->tp->tahun,
            ];

            if ($this->suratkeluar_sk->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di EDIT surat keluar !');
                return redirect()->to(base_url('admin/suratkeluar'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/suratkeluar'));
            }
        } else {

            $post = [
                //'nomor'       => $this->request->getVar('nomor'),
                'jumlah'            => $this->request->getVar('jumlah'),
                'satuan'            => $this->request->getVar('satuan'),
                'ket'            => $this->request->getVar('ket'),

                'nik'            => $this->request->getVar('nik'),
                'penerima'            => $this->request->getVar('penerima'),
                'telpon'            => $this->request->getVar('telpon'),
                'lokasi'            => $this->request->getVar('lokasi'),

                'tgl'           => $tgl,

                'status'            => $this->request->getVar('status'),
                //'tahun_pelajaran' => $this->tp->tahun,
            ];

            if ($this->suratkeluar_sk->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan surat keluar !');
                return redirect()->to(base_url('admin/suratkeluar'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/suratkeluar'));
            }
        }
    }
    public function delete_asetk($id)
    {
        if ($this->suratkeluar->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/suratkeluar/add'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/suratkeluar/add'));
        }
    }
}

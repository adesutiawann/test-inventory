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

use App\Models\SuratpinjamModel;
use App\Models\AsetKModel;

class Suratpinjam extends BaseController
{
    protected $admin;
    protected $asetk;

    protected $suratkeluar;

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
        $this->asetk     = new AsetKModel();

        $this->suratkeluar     = new SuratpinjamModel();

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
        // script pengulangan;
        $suratKeluar = $this->suratkeluar->findAll();
        foreach ($suratKeluar as $key => $value) {
            $aset = $this->aset->where('id_sk', $value->nomor)->findAll();
            $suratKeluar[$key]->aset = $aset;
        }

        $data = [
            'title'   => 'Surat Pinjam',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),

            'aktiv'   => 'ALL',

            //'suratkeluar' => $this->suratkeluar->findAll(),
            'suratpinjam' => $suratKeluar,
            // 'total_pc_ok' => $this->aset->where('type', 'pc')->where('kondisi', 'OK')->countAllResults(),
            'suratpinjamttl' => $this->suratkeluar->countAllResults(),
            'suratpinjamdis' => $this->suratkeluar->where('status', 'Terdistribusi')->countAllResults(),
            'suratpinjambac' => $this->suratkeluar->where('status', 'Backup')->countAllResults(),


            //'asetk' => $this->asetk->findAll(),
            //'suratkeluar'    => $this->asetk->find($id),

        ];



        return view('admin/suratpinjam', $data);
    }

    public function search($id)
    {
        $data = [
            'title'   => 'Data Personal Computer',
            'aktiv'   => $id,
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'suratkeluar' => $this->suratkeluar->where('status', $id)->findAll(),
            'suratkeluarttl' => $this->suratkeluar->countAllResults(),
            'suratkeluardis' => $this->suratkeluar->where('status', 'Terdistribusi')->countAllResults(),
            'suratkeluarbac' => $this->suratkeluar->where('status', 'Backup')->countAllResults(),
            //'asetk' => $this->asetk->where('status', $id)->orderBy('id', 'desc')->findAll(),
            //'asetk' => $this->asetk->findAll(),
            // 'total_pc' => $this->aset->where('type', 'pc')->countAllResults(),
            //'total_pc_ok' => $this->aset->where('type', 'pc')->where('kondisi', 'OK')->countAllResults(),
            //'total_pc_rusak' => $this->aset->where('type', 'pc')->where('kondisi', 'rusak')->countAllResults(),
            //'total_pc_blanks' => $this->aset->where('type', 'pc')->where('kondisi', 'blanks')->countAllResults(),
            //'aset'    => $this->aset->getId($id),

        ];
        return view('admin/suratkeluar', $data);
    }

    public function cetaksuratkeluar()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        // $data['aset'] = $this->aset->findAll();

        $cari = $this->request->getVar('cari');
        $tglin = $this->request->getVar('tglin');
        $tglout = $this->request->getVar('tglout');

        // Inisialisasi Query Builder untuk data aset utama
        //$asetQuery = $this->aset->where('type', 'pc');

        $asetQuery = $this->suratkeluar;
        // Filter berdasarkan kriteria pencarian
        if ($cari) {
            $asetQuery->groupStart()
                ->orWhere('serial', $cari)
                ->orWhere('manufacture', $cari)
                ->groupEnd();
        }

        // Filter berdasarkan rentang tanggal
        if ($tglin && $tglout) {
            $asetQuery->where('tgl=', $tglin)
                ->where('tgl<=', $tglout);
        }

        // Urutkan hasil query
        $asetQuery->orderBy('id', 'desc');

        $suratKeluar = $this->suratkeluar->findAll();
        foreach ($suratKeluar as $key => $value) {
            $aset = $this->aset->where('id_sk', $value->nomor)->findAll();
            $suratKeluar[$key]->aset = $aset;
        }
        $data = [
            'title'   => 'Surat Pinjam',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'aset' => $this->aset->getAll(),

            //'suratkeluar' => $this->suratkeluar->findAll(),
            'suratkeluar' => $suratKeluar,

            // 'total_pc_ok' => $this->aset->where('type', 'pc')->where('kondisi', 'OK')->countAllResults(),
            'suratkeluarttl' => $this->suratkeluar->countAllResults(),
            'suratkeluardis' => $this->suratkeluar->where('status', 'Terdistribusi')->countAllResults(),
            'suratkeluarbac' => $this->suratkeluar->where('status', 'Backup')->countAllResults(),


            'asetk' => $this->asetk->findAll(),
            //'suratkeluar'    => $this->asetk->find($id),

        ];



        return view('admin/cetaksuratkeluar', $data);
    }
    public function print()
    {
        $id = urldecode($this->request->getGet('id'));
        $nomor = urldecode($this->request->getGet('nomor'));
        $data = [
            'title'   => 'Print',
            // 'id' = urldecode($this->request->getGet('id')),
            //'nomor' = urldecode($this->request->getGet('nomor')),
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'aset' =>  $this->aset->where('id_sk', $nomor)->findAll(),
            //'aset'    => $this->asetk->getId($id),
            'suratkeluar' => $this->suratkeluar->where('id', $id)->findAll(),

        ];
        return view('admin/cetaksp', $data);
    }
    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        // $code = $this->suratkeluar->generateCode();
        //  $id = '1';
        $data = [
            'title'   => 'Surat Pinjam',
            'nomor' => $this->suratkeluar->generateCode(),
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
            //'asetk' => $this->asetk->getIdasetkeluar(),
            'asetk' => $this->aset->where('id_sk', '2')->findAll(),
            //'suratkeluar' => $this->suratkeluar->where('id_sk', '1')->getAllsuratkeluar(),

            // 'asetk' => $this->asetk->getIdasetkeluar(),

        ];

        return view('admin/suratpinjamadd', $data);
    }


    public function editsk($id)
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        // $code = $this->suratkeluar->generateCode();
        //  $id = '1';
        $nos = $this->suratkeluar->where('id', $id)->first();
        $data = [
            'title'   => 'Edit Surat Keluar',
            'nomor' => $this->suratkeluar->generateCode(),
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
            //'asetk' => $this->asetk->getIdasetkeluar(),
            //'asetk' => $this->aset->where('id_sk', '1')->findAll(),
            'suratkeluar' => $this->suratkeluar->where('id', $id)->first(),
            'asetk' => $this->aset->where('id_sk', $nos->nomor)->findAll(),

            // 'asetk' => $this->asetk->getIdasetkeluar(),

        ];

        return view('admin/suratkeluaredit', $data);
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

            'suratkeluar'    => $this->asetk->find($id),
            'nama'   => $this->asetk->select('nama'),
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

            if ($this->asetk->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di edit update.');
                return redirect()->to(base_url('admin/suratkeluar'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/suratkeluar'));
            }
        } else {

            $serial = $this->request->getVar('serial');
            $existingData = $this->aset->where('serial', $serial)->first();
            if ($existingData) {
                $tgl = date("Y-m-d");
                $post = [
                    // 'id' => '1',

                    //'serial'            => $this->request->getVar('serial'),
                    //'tgl_keluar'           => $tgl,
                    'id_sk'            => '1',
                ];

                if ($this->aset->updateDatax($serial, $post)) {
                    // if ($this->suratkeluar->updateDatax($post)) {
                    session()->setFlashdata('success', 'Data berhasil masuk list.');
                    return redirect()->to(base_url('admin/suratkeluar/add'));
                } else {
                    session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                    return redirect()->to(base_url('admin/suratkeluar/add'));
                }
            } else {
                //  session()->setFlashdata('warning', '<strong>Peringatan!</strong> Data dengan nomor serial <b>' . $serial . '</b> sudah terdaftar.');
                //return redirect()->to(base_url('admin/suratkeluar/add')); //break; // Exit the loop if any data already exists
                session()->setFlashdata('warning', 'Serial <b>' . $serial . '</b>  tidak terdaftar dalam system !');
                return redirect()->to(base_url('admin/suratkeluar/add'));
            }
        }
    }

    public function keranjang($serial)
    {

        $tgl = date("Y-m-d");
        // $serial = $this->request->getVar('serial');
        $existingData = $this->aset->where('serial', $serial)->first();
        if ($existingData) {
            $tgl = date("Y-m-d");
            $post = [
                // 'id' => '1',

                //'serial'            => $this->request->getVar('serial'),
                //'tgl_keluar'           => $tgl,
                'id_sk'            => '2',
            ];

            if ($this->aset->updateDatax($serial, $post)) {
                // if ($this->suratkeluar->updateDatax($post)) {
                session()->setFlashdata('success', 'Data berhasil masuk list.');
                return redirect()->to(base_url('admin/suratpinjam/add'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/suratpinjam/add'));
            }
        } else {
            //  session()->setFlashdata('warning', '<strong>Peringatan!</strong> Data dengan nomor serial <b>' . $serial . '</b> sudah terdaftar.');
            //return redirect()->to(base_url('admin/suratkeluar/add')); //break; // Exit the loop if any data already exists
            session()->setFlashdata('warning', 'Serial <b>' . $serial . '</b>  tidak terdaftar dalam system !');
            return redirect()->to(base_url('admin/suratkeluar/add'));
        }
    }



    public function saveedit()
    {


        $tgl = date("Y-m-d");

        $post = [
            'id_sk'       => '1',
            'id_sk'            => $this->request->getVar('id_sk'),
            'tgl'           => $tgl,
            //'tahun_pelajaran' => $this->tp->tahun,
        ];

        if ($this->asetk->save($post)) {
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
        $serial = $this->request->getVar('nomor');
        $existingData = $this->suratkeluar->where('nomor', $serial)->first();
        if (!$existingData) {

            $post = [
                //'nomor'       =>  $this->request->getVar('nomor'),
                'jumlah'            => $this->request->getVar('jumlah'),
                'satuan'            => $this->request->getVar('satuan'),
                'ket'            => $this->request->getVar('ket'),

                'nik'            => $this->request->getVar('nik'),
                'penerima'            => $this->request->getVar('penerima'),
                'telpon'            => $this->request->getVar('telpon'),
                'lokasi'            => $this->request->getVar('lokasi'),

                'tgl'           => $tgl,
                'nomor'       =>  $this->request->getVar('nomor'),
                'status'            => $this->request->getVar('status')
                //'tahun_pelajaran' => $this->tp->tahun,
            ];
            $postask = [
                //'id_sk'            => '1',
                'id_sk'       =>  $this->request->getVar('nomor'),
                'ket'            => $this->request->getVar('ket'),
                'stock'            => $this->request->getVar('status'),
                'tgl_keluar'           => $tgl,

            ];

            if ($this->suratkeluar->save($post) && $this->aset->insertno_sk($postask)) {

                session()->setFlashdata('success', 'Data berhasil di simpan surat keluar ' . $serial . 'MASA !');
                return redirect()->to(base_url('admin/suratkeluar'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/suratkeluar'));
            }
        } else {
            session()->setFlashdata('error', 'NOMOR SURAT SUDAH DI GUNAKAN .');
            return redirect()->to(base_url('admin/suratkeluar'));
        }
    }
    public function delete_asetk($serial)
    {
        $post = [
            //'id_sk'            => '1',
            'id_sk'       => '',

        ];
        if ($this->aset->updateDatax($serial, $post)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/suratkeluar/add'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/suratkeluar/add'));
        }
    }
    public function delete_sk($id)
    {
        if ($this->suratkeluar->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/suratkeluar'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/suratkeluar'));
        }
    }
}

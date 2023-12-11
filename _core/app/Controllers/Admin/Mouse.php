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

use App\Models\PortModel;
//use App\Models\PelajaranModel;

class Mouse extends BaseController
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
    protected $port;
    protected $kondisi;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->aset = new AsetModel();
        $this->siswa     = new SiswaModel();

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
        $this->port = new PortModel;
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Data Mouse',
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
            'port'    => $this->port->orderBy('port', 'asc')->findAll(),
            'aktiv'   => 'ALL',
            'aset' => $this->aset->getAllmouse(),
            //'aset' =>  $this->aset->where('tb_type.nama', 'Destop')->getAll(),
        ];

        return view('admin/mouse', $data);
    }
    public function ok($id)
    {
        $data = [
            'title'   => 'Data keyboard',
            'aktiv'   => $id,
            'segment' => $this->request->uri->getSegments(),
            //'aset' =>  $this->suratkeluar->where('kondisi', 'OK')->getAll(),
            'aset'    => $this->aset->getId($id),

        ];
        return view('admin/keyboard', $data);
    }

    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Add Mouse',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'manufacture'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            'namax'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            //'type'    => $this->type->orderBy('nama', 'asc')->findAll(),
            'type' => $this->type->where('nama', 'mouse')->orderBy('nama', 'asc')->findAll(),
            // 'type' => $this->type->where('nama', 'keyboard')->orderBy('nama', 'asc')->findAll(),
            'prosesor'    => $this->prosesor->orderBy('nama', 'asc')->findAll(),
            'generasi'    => $this->generasi->orderBy('nama', 'asc')->findAll(),
            'hdd'    => $this->hdd->orderBy('nama', 'asc')->findAll(),
            'ram'    => $this->ram->orderBy('nama', 'asc')->findAll(),
            'rincian'    => $this->rincian->orderBy('nama', 'asc')->findAll(),
            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),
            'port'    => $this->port->orderBy('port', 'asc')->findAll(),


        ];

        return view('admin/mouseadd', $data);
    }



    public function edit($id)
    {

        // $tgl= date("Y-m-d");
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [

            'title'   => 'Edit aset',
            'menu'   => 'Edit aset',
            'input'   => 'hidden',
            'edit'   => '',
            'segment' => $this->request->uri->getSegments(),

            // 'aset' => $this->aset->where('id', $id)->getAll(),
            'aset'    => $this->aset->find($id),
            //'manufactureid' => $this->manufacture->where('id', 'aset.id')->orderBy('nama', 'asc')->findAll(),
            'manufacture'   => $this->aset->select('manufacture')->groupBy('manufacture')->findAll(),
            //'aset' => $this->aset->where('id', $id)->findAll(),
            // 'manufacture' => $this->manufacture->join('aset', 'manufacture.id = aset.id')->orderBy('manufacture.nama', 'asc')->findAll(),

            //'pel'   => $this->admin->find(session()->get('id')),
            // 'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            //'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),

            'manufacture'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            //'namax'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),            
            //'namax'    => $this->manufacture->find($id),

            //'type'    => $this->type->orderBy('nama', 'asc')->findAll(),
            'type' => $this->type->where('nama', 'mouse')->orderBy('nama', 'asc')->findAll(),

            'prosesor'    => $this->prosesor->orderBy('nama', 'asc')->findAll(),
            'generasi'    => $this->generasi->orderBy('nama', 'asc')->findAll(),
            'hdd'    => $this->hdd->orderBy('nama', 'asc')->findAll(),
            'ram'    => $this->ram->orderBy('nama', 'asc')->findAll(),
            'rincian'    => $this->rincian->orderBy('nama', 'asc')->findAll(),
            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),
            'port'    => $this->port->orderBy('port', 'asc')->findAll(),
            'aktiv'   => 'ALL',
            // 'aset' => $this->aset->getAllkeyboard($id),

            //'aset'    => $this->aset->find($id),
            'nama'   => $this->aset->select('nama'),
        ];

        return view('admin/mouseedit', $data);
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

            if ($this->aset->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di edit.');
                return redirect()->to(base_url('admin/keyboard'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/keyboard'));
            }
        } else {
            // $tgl= date("Y-m-d");
            $post = [
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => $this->request->getVar('type'),
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
                return redirect()->to(base_url('admin/keyboard'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/keyboard'));
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
            return redirect()->to(base_url('admin/keyboard'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/keyboard'));
        }
    }
}

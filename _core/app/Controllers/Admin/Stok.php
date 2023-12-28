<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\StokModel;
use App\Models\SiswaModel;
//use App\Models\PelajaranModel;

class stok extends BaseController
{
    protected $admin;
    protected $stok;
    protected $siswa;
    //  protected $pelajaran;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->stok = new StokModel();
        $this->siswa     = new SiswaModel();

        // $this->pelajaran     = new PelajaranModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'stok',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
           
        ];

        return view('admin/stok', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('tb_stok');
        // ->select('tb_mapel');
        //->join('admin', 'admin.id=stok.guru')
        // ->orderBy('mapel', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/stok/edit/' . $row->id) .
                    '" class="btn btn-sm btn-info text-white">
<i class="fa-solid fa-pen-to-square"></i></a> 
                <a href="' . base_url('admin/stok/delete/' . $row->id) .
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

            'title'   => 'Edit stok',
            'input'   => 'hidden',
            'edit'   => '',
            'ade' => '1',

            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'stok'    => $this->stok->find($id),
            'nama'   => $this->stok->select('nama'),
        ];

        return view('admin/stok', $data);
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

            if ($this->stok->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di edit.');
                return redirect()->to(base_url('admin/stok'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/stok'));
            }
        } else {
            // $tgl= date("Y-m-d");
            $post = [
                'nama'            => $this->request->getVar('nama'),
                'tgl'           =>  $tgl,
                //'kelas'           => $this->request->getVar('kelas'),
                //'tahun_stok' => $this->tp->tahun,
            ];

            if ($this->stok->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan.');
                return redirect()->to(base_url('admin/stok'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/stok'));
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

        if ($this->stok->save($post)) {
            session()->setFlashdata('success', 'Data berhasil di edit.');
            return redirect()->to(base_url('admin/stok'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/stok'));
        }
    }
    public function delete($id)
    {
        if ($this->stok->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/stok'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/stok'));
        }
    }
}

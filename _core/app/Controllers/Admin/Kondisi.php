<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\kondisiModel;
use App\Models\SiswaModel;
//use App\Models\PelajaranModel;

class Kondisi extends BaseController
{
    protected $admin;
    protected $kondisi;
    protected $siswa;
    //  protected $pelajaran;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->kondisi = new kondisiModel();
        $this->siswa     = new SiswaModel();

        // $this->pelajaran     = new PelajaranModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'kondisi',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            // 'mapel'    => $this->admin->orderBy('mapel', 'asc')->findAll(),
            // 'kelas'   => $this->siswa->groupBy('kelas')->findAll(),

            //  $id='',
            'kondisi'    => $this->kondisi->findAll(),
            //'nama'   => $this->kondisi->select('nama'),
            //perintah hiden insert edit
            //'input'   => '',
            //'edit'   => 'disabled',

        ];

        return view('admin/kondisi', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('tb_kondisi');
        // ->select('tb_mapel');
        //->join('admin', 'admin.id=kondisi.guru')
        // ->orderBy('mapel', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/kondisi/edit/' . $row->id) .
                    '" class="btn btn-sm btn-info text-white">
<i class="fa-solid fa-pen-to-square"></i></a> 
                <a href="' . base_url('admin/kondisi/delete/' . $row->id) .
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

            'title'   => 'Edit kondisi',
            'input'   => 'hidden',
            'edit'   => '',
            'ade' => '1',

            'segment' => $this->request->uri->getSegments(),
            //'pel'   => $this->admin->find(session()->get('id')),

            'kondisi'    => $this->kondisi->find($id),
            'nama'   => $this->kondisi->select('nama'),
        ];

        return view('admin/kondisi', $data);
    }

    public function save()
    {

        $tgl = date("Y-m-d");
        if ($this->request->getVar('id')) {

            $post = [
                'id'       => $this->request->getVar('id'),
                'kondisi'            => $this->request->getVar('nama'),
                'tgl'           => $tgl,
                //'tahun_pelajaran' => $this->tp->tahun,
            ];

            if ($this->kondisi->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di edit.');
                return redirect()->to(base_url('admin/kondisi'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/kondisi'));
            }
        } else {
            // $tgl= date("Y-m-d");
            $post = [
                'kondisi'            => $this->request->getVar('nama'),
                'tgl'           =>  $tgl,
                //'kelas'           => $this->request->getVar('kelas'),
                //'tahun_kondisi' => $this->tp->tahun,
            ];

            if ($this->kondisi->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan.');
                return redirect()->to(base_url('admin/kondisi'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/kondisi'));
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

        if ($this->kondisi->save($post)) {
            session()->setFlashdata('success', 'Data berhasil di edit.');
            return redirect()->to(base_url('admin/kondisi'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/kondisi'));
        }
    }
    public function delete($id)
    {
        if ($this->kondisi->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/kondisi'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/kondisi'));
        }
    }
}

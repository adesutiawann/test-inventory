<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\SiswaModel;
use App\Models\PelajaranModel;

class Pelajaran extends BaseController
{
    protected $admin;
    protected $walikelas;
    protected $siswa;
    protected $pelajaran;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->walikelas = new WalikelasModel();
        $this->siswa     = new SiswaModel();
        $this->pelajaran     = new PelajaranModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Pelajaran',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
           // 'mapel'    => $this->admin->orderBy('mapel', 'asc')->findAll(),
           // 'kelas'   => $this->siswa->groupBy('kelas')->findAll(),
        ];

        return view('admin/pelajaran', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('tb_mapel');
           // ->select('tb_mapel');
            //->join('admin', 'admin.id=walikelas.guru')
           // ->orderBy('mapel', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/pelajaran/edit/' . $row->id) . '" class="btn btn-sm btn-info text-white">Edit</a> <a href="' . base_url('admin/pelajaran/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }


    public function data11()
    {
        
        $db = db_connect();
        $builder = $db->table('siswa')->orderBy('id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/siswa/edit/' . $row->id) . '" class="btn btn-sm btn-info text-white">Edit</a> <a href="' . base_url('admin/siswa/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function saveoff()
    {
        $post = [
            'mapel'       => $this->request->getVar('mapel')
        ];
        
        if ($this->pelajaran->save($post)===false) {
            session()->setFlashdata('error', 'Gagal menyimpan data. MataPelajaran sudah terdaftar.');
            return redirect()->to(base_url('admin/pelajaran'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('admin/pelajaran'));
        }
    }


    public function edit($id)
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        

        $data = [

            'title'   => 'Edit Admin & Wali Kelas',
            'segment' => $this->request->uri->getSegments(),
            //'pel'   => $this->admin->find(session()->get('id')),
            
            'pelajaran'    => $this->pelajaran->find($id),
            'mapel'   => $this->pelajaran->select('mapel'),
        ];

        return view('admin/pelajaran_edit', $data);
    }
    
    public function save()
    {
        if ($this->request->getVar('id')) {
                $post = [
                    'id'       => $this->request->getVar('id'),
                    'mapel'            => $this->request->getVar('mapel'),
                    //'kelas'           => $this->request->getVar('kelas'),
                    //'tahun_pelajaran' => $this->tp->tahun,
                ];

                if ($this->pelajaran->save($post)) {
                    session()->setFlashdata('success', 'Data berhasil di simpan.');
                    return redirect()->to(base_url('admin/pelajaran'));
                } else {
                    session()->setFlashdata('error', 'Data Gagal di simpan.');
                    return redirect()->to(base_url('admin/pelajaran'));
                }
        }else{

            $post = [
                'mapel'            => $this->request->getVar('mapel'),
                //'kelas'           => $this->request->getVar('kelas'),
                //'tahun_pelajaran' => $this->tp->tahun,
            ];

            if ($this->pelajaran->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan.');
                return redirect()->to(base_url('admin/pelajaran'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/pelajaran'));
            }
            
        }
    }

    public function delete($id)
    {
        if ($this->pelajaran->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/pelajaran'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/pelajaran'));
        }
    }
}

<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\TypeModel;
use App\Models\SiswaModel;
//use App\Models\PelajaranModel;

class Type extends BaseController
{
    protected $admin;
    protected $type;
    protected $siswa;
  //  protected $pelajaran;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->type = new TypeModel();
        $this->siswa     = new SiswaModel();
        
       // $this->pelajaran     = new PelajaranModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'type',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
           // 'mapel'    => $this->admin->orderBy('mapel', 'asc')->findAll(),
           // 'kelas'   => $this->siswa->groupBy('kelas')->findAll(),
        ];

        return view('admin/type', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('tb_type');
           // ->select('tb_mapel');
            //->join('admin', 'admin.id=type.guru')
           // ->orderBy('mapel', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/type/edit/' . $row->id) . 
                '" class="btn btn-sm btn-info text-white">
<i class="fa-solid fa-pen-to-square"></i></a> 
                <a href="' . base_url('admin/type/delete/' . $row->id) .
                 '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')"><i class="fa-solid fa-trash-can"></i></a>';
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


    public function edit($id)
    {
        
       // $tgl= date("Y-m-d");
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        

        $data = [

            'title'   => 'Edit Type',
            'segment' => $this->request->uri->getSegments(),
            //'pel'   => $this->admin->find(session()->get('id')),
            
            'type'    => $this->type->find($id),
            'nama'   => $this->type->select('nama'),
        ];

        return view('admin/type_edit', $data);
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

                if ($this->type->save($post)) {
                    session()->setFlashdata('success', 'Data berhasil di edit.');
                    return redirect()->to(base_url('admin/type'));
                } else {
                    session()->setFlashdata('error', 'Data Gagal di simpan.');
                    return redirect()->to(base_url('admin/type'));
                }
        }else{
           // $tgl= date("Y-m-d");
            $post = [
                'nama'            => $this->request->getVar('nama'),
                'tgl'           =>  $tgl,
                //'kelas'           => $this->request->getVar('kelas'),
                //'tahun_type' => $this->tp->tahun,
            ];

            if ($this->type->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan.');
                return redirect()->to(base_url('admin/type'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/type'));
            }
            
        }
    }

    public function delete($id)
    {
        if ($this->type->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/type'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/type'));
        }
    }
}

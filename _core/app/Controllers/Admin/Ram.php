<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\RamModel;
use App\Models\SiswaModel;
//use App\Models\PelajaranModel;

class ram extends BaseController
{
    protected $admin;
    protected $ram;
    protected $siswa;
  //  protected $pelajaran;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->ram = new RamModel();
        $this->siswa     = new SiswaModel();
        
       // $this->pelajaran     = new PelajaranModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Random Access Memory',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
           // 'mapel'    => $this->admin->orderBy('mapel', 'asc')->findAll(),
           // 'kelas'   => $this->siswa->groupBy('kelas')->findAll(),

       //  $id='',
         //'ram'    => $this->ram->find($id),
         //'nama'   => $this->ram->select('nama'),
           //perintah hiden insert edit
           //'input'   => '',
           //'edit'   => 'disabled',

        ];

        return view('admin/ram', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('tb_ram');
           // ->select('tb_mapel');
            //->join('admin', 'admin.id=ram.guru')
           // ->orderBy('mapel', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/ram/edit/' . $row->id) . 
                '" class="btn btn-sm btn-info text-white">
<i class="fa-solid fa-pen-to-square"></i></a> 
                <a href="' . base_url('admin/ram/delete/' . $row->id) .
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

            'title'   => 'Edit ram',
            'input'   => 'hidden',
            'edit'   => '',
            'ade'=>'1',

            'segment' => $this->request->uri->getSegments(),
            //'pel'   => $this->admin->find(session()->get('id')),
            
            'ram'    => $this->ram->find($id),
            'nama'   => $this->ram->select('nama'),
        ];

        return view('admin/ram', $data);
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

                if ($this->ram->save($post)) {
                    session()->setFlashdata('success', 'Data berhasil di edit.');
                    return redirect()->to(base_url('admin/ram'));
                } else {
                    session()->setFlashdata('error', 'Data Gagal di simpan.');
                    return redirect()->to(base_url('admin/ram'));
                }
        }else{
           // $tgl= date("Y-m-d");
            $post = [
                'nama'            => $this->request->getVar('nama'),
                'tgl'           =>  $tgl,
                //'kelas'           => $this->request->getVar('kelas'),
                //'tahun_ram' => $this->tp->tahun,
            ];

            if ($this->ram->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan.');
                return redirect()->to(base_url('admin/ram'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/ram'));
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

                if ($this->ram->save($post)) {
                    session()->setFlashdata('success', 'Data berhasil di edit.');
                    return redirect()->to(base_url('admin/ram'));
                } else {
                    session()->setFlashdata('error', 'Data Gagal di simpan.');
                    return redirect()->to(base_url('admin/ram'));
                }
    }
    public function delete($id)
    {
        if ($this->ram->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/ram'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/ram'));
        }
    }
}

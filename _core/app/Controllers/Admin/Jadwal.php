<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\JadwalModel;

class Jadwal extends BaseController
{
    protected $admin;
    protected $jadwal;
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->jadwal = new JadwalModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Data Jadwal',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            
            
        ];

        return view('admin/jadwal', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('tb_mengajar')
        //->orderBy('id_mengajar', 'desc');
          ->select('tb_mapel');
            $builder->join('tb_mapel', 'tb_mengajar.id_mengajar=tb_mapel.id');
           // ->orderBy('mapel', 'desc');
            //$reslut=$builder->get()->getResultArray();

            $builder = $db->table('tb_mengajar')
            ->select('tb_mengajar.id_mengajar, tb_mengajar.hari , tb_mengajar.jam_mengajar , tb_mengajar.kelas, tb_mengajar.jamke, admin.nama, tb_mapel.mapel')
            ->join('admin', 'admin.id=tb_mengajar.id_guru')
            ->join('tb_mapel', 'tb_mapel.id=tb_mengajar.id_mapel')
           // ->join('tahun_pelajaran', 'tahun_pelajaran.id=tb_mengajar.id_thajaran')
            ->orderBy('tb_mengajar.id_mengajar', 'desc');
            
        return DataTable::of($builder)
            ->add('action', function ($row) {
                return ' 
                <a href="' . base_url('admin/Laporan_rekap_mapel?id_mk=' . $row->id_mengajar.'&kelas='. $row->kelas) . '" class="btn btn-sm btn-primary text-white mr-1" ><i class="fas fa-list-alt"></i> Rekap Absen</a>
                <a href="' . base_url('admin/jadwal/edit/' . $row->id_mengajar) . '" class="btn btn-sm btn-info text-white">Edit</a>
                 <a href="' . base_url('admin/jadwal/delete/' . $row->id_mengajar) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
           
            ->add('waktu', function ($row) {
                return ' <ul>
                <li> Hari : '.$row->hari.'<br> </li>
                <li> Jam Ke '.$row->jamke.'</li>
                <li> Waktu : '.$row->jam_mengajar.' </li>
                </ul>';
            }) 
            ->addNumbering('no')->toJson(true);
    }

    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Tambah jadwal',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->jadwal->find(session()->get('id')),
            'kelas'   => $this->jadwal->groupBy('kelas')->findAll(),
            
        ];

        return view('admin/jadwal_add', $data);
    }
    public function edit($id)
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Edit jadwal',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'jadwal'   => $this->jadwal->find($id),
            'kelas'   => $this->jadwal->select('kelas')->groupBy('kelas')->findAll(),
        ];

        return view('admin/jadwal_edit', $data);
    }

    public function save()
    {
        
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        if ($this->request->getVar('id')) {
            $post = [
                'id_mengajar'             => $this->request->getVar('id'),
                'kode_pelajaran'           => $this->request->getVar('kode'),
                'id_tahun'          => $this->request->getVar('ta'),
                'id_guru' => $this->request->getVar('guru'),
                'id_mapel'  => $this->request->getVar('mapel'),
                'hari'          => $this->request->getVar('hari'),
                'kelas'          => $this->request->getVar('kelas'),
                'jam_mengajar' => $this->request->getVar('waktu'),
                'jamke'  => $this->request->getVar('jamke'),
            ];

            if ($this->jadwal->save($post) === false) {
                session()->setFlashdata('error', 'Gagal menyimpan data Diedit.');
                return redirect()->to(base_url('admin/jadwal/edit/' . $this->request->getVar('id')));
            } else {
                session()->setFlashdata('success', 'Data berhasil Diedit.');
                return redirect()->to(base_url('admin/jadwal'));
            }
    }else{
        $post = [
          
            'kode_pelajaran'           => $this->request->getVar('kode'),
            'id_tahun'          => $this->request->getVar('ta'),
            'id_guru' => $this->request->getVar('guru'),
            'id_mapel'  => $this->request->getVar('mapel'),
            'hari'          => $this->request->getVar('hari'),
            'kelas'          => $this->request->getVar('kelas'),
            'jam_mengajar' => $this->request->getVar('waktu'),
            'jamke'  => $this->request->getVar('jamke'),
        ];

        if ($this->jadwal->save($post) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan data.');
            return redirect()->to(base_url('admin/jadwal'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('admin/jadwal'));
        }
    }
    }

    public function delete($id)
    {
        if ($this->jadwal->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('admin/jadwal'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/jadwal'));
        }
    }
}

<?php

namespace App\Controllers\Walikelas;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\JadwalModel;
use App\Models\WalikelasModel;

class Jadwalku extends BaseController
{
    protected $admin;
    protected $jadwal;
    protected $walikelas;
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->jadwal = new JadwalModel();
        $this->walikelas = new WalikelasModel();
    }

    public function index()
    {
        if (session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }
        $walikelas = $this->walikelas->where('guru', session()->get('id'))->first();

        $data = [
            'title'   => 'Data Jadwal',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'walikelas' => $walikelas,
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $this->pembina->where('guru', session()->get('id'))->first(),
    
            
        ];

        return view('walikelas/jadwalku', $data);
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
            $admin = $this->admin->where('id', session()->get('id'))->first();

            $builder = $db->table('tb_mengajar')
            ->select('tb_mengajar.id_mengajar, tb_mengajar.hari , tb_mengajar.jam_mengajar , tb_mengajar.kelas, tb_mengajar.jamke, admin.nama, tb_mapel.mapel')
            ->join('admin', 'admin.id=tb_mengajar.id_guru')
            ->join('tb_mapel', 'tb_mapel.id=tb_mengajar.id_mapel')
           // ->join('tahun_pelajaran', 'tahun_pelajaran.id=tb_mengajar.id_thajaran')
           ->where('id_guru', $admin->id) 
           ->orderBy('tb_mengajar.hari', 'desc');
           
          
            
        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('walikelas/absensi?id_mk='. $row->id_mengajar.'&id_kls='. $row->kelas) . '" class="btn btn-sm btn-info text-white"><i class="fas fa-clipboard-check"> </i> Isi Absen</a> 
                <a href="' . base_url('walikelas/laporan_rekap?id_mk=' . $row->id_mengajar.'&kelas='. $row->kelas) . '" class="btn btn-sm btn-danger text-white" ><i class="fas fa-list-alt"></i>
                Rekap Absen</a>';
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

        return view('walikelas/jadwal_add', $data);
    }
    public function edit($id)
    {
        if (session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Edit jadwal',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'jadwal'   => $this->jadwal->find($id),
            'kelas'   => $this->jadwal->select('kelas')->groupBy('kelas')->findAll(),
        ];

        return view('walikelas/jadwal_edit', $data);
    }

    public function save()
    {
        
        if (session()->get('logged_walikelas') != true) {
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
                return redirect()->to(base_url('walikelas/jadwal/edit/' . $this->request->getVar('id')));
            } else {
                session()->setFlashdata('success', 'Data berhasil Diedit.');
                return redirect()->to(base_url('walikelas/jadwal'));
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
            return redirect()->to(base_url('walikelas/jadwal'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('walikelas/jadwal'));
        }
    }
    }

    public function delete($id)
    {
        if ($this->jadwal->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('walikelas/jadwal'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('walikelas/jadwal'));
        }
    }
}

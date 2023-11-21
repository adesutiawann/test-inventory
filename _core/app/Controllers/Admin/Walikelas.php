<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\SiswaModel;

class Walikelas extends BaseController
{
    protected $admin;
    protected $walikelas;
    protected $siswa;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->walikelas = new WalikelasModel();
        $this->siswa     = new SiswaModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Data Wali Kelas',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'guru'    => $this->admin->orderBy('nama', 'asc')->findAll(),
            'kelas'   => $this->siswa->groupBy('kelas')->findAll(),
        ];

        return view('admin/walikelas', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('walikelas')
            ->select('walikelas.id, walikelas.kelas, admin.nama')
            ->join('admin', 'admin.id=walikelas.guru')
            ->orderBy('walikelas.id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/walikelas/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function save()
    {
        $post = [
            'guru'            => $this->request->getVar('guru'),
            'kelas'           => $this->request->getVar('kelas'),
            'tahun_pelajaran' => $this->tp->tahun,
        ];

        if ($this->walikelas->save($post)) {
            session()->setFlashdata('success', 'Data berhasil di simpan.');
            return redirect()->to(base_url('admin/walikelas'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/walikelas'));
        }
    }

    public function delete($id)
    {
        if ($this->walikelas->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/walikelas'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/walikelas'));
        }
    }
}

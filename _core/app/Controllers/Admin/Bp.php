<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PiketModel;
use App\Models\SiswaModel;

class Bp extends BaseController
{
    protected $admin;
    protected $piket;
    protected $siswa;

    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->piket = new PiketModel();
        $this->siswa = new SiswaModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Data Guru BP/BK',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'guru'    => $this->admin->orderBy('nama', 'asc')->findAll(),
        ];

        return view('admin/bp', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('bp')
            ->select('bp.id, bp.guru, admin.nama')
            ->join('admin', 'admin.id=bp.guru')
            ->orderBy('bp.id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/bp/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function save()
    {
        $post = [
            'guru' => $this->request->getVar('guru'),
        ];

        if ($this->bp->save($post)) {
            session()->setFlashdata('success', 'Data berhasil di simpan.');
            return redirect()->to(base_url('admin/bp'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/bp'));
        }
    }

    public function delete($id)
    {
        if ($this->bp->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/pembina'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/pembina'));
        }
    }
}

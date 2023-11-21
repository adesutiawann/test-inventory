<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PembinaModel;
use App\Models\SiswaModel;

class Pembina extends BaseController
{
    protected $admin;
    protected $pembina;
    protected $siswa;

    public function __construct()
    {
        $this->admin   = new AdminModel();
        $this->pembina = new PembinaModel();
        $this->siswa   = new SiswaModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Data Pembina',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'guru'    => $this->admin->orderBy('nama', 'asc')->findAll(),
            'kelas'   => $this->siswa->groupBy('kelas')->findAll(),
        ];

        return view('admin/pembina', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('pembina')
            ->select('pembina.id, pembina.extra, admin.nama')
            ->join('admin', 'admin.id=pembina.guru')
            ->orderBy('pembina.id', 'desc');

        return DataTable::of($builder)
            ->add('extra', function ($row) {
                $ex = unserialize(base64_decode($row->extra));
                $ex = implode(', ', $ex);
                return $ex;
            })
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/pembina/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function save()
    {
        $extra = base64_encode(serialize($this->request->getVar('extra')));
        $post = [
            'guru'  => $this->request->getVar('guru'),
            'extra' => $extra
        ];

        if ($this->pembina->save($post)) {
            session()->setFlashdata('success', 'Data berhasil di simpan.');
            return redirect()->to(base_url('admin/pembina'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/pembina'));
        }
    }

    public function delete($id)
    {
        if ($this->pembina->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/pembina'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/pembina'));
        }
    }
}

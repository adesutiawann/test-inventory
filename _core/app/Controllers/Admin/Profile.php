<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\WalikelasModel;

class Profile extends BaseController
{
    protected $admin;
    protected $siswa;
    protected $walikelas;

    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->siswa = new SiswaModel();
        $this->walikelas = new WalikelasModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        $data = [
            'title'     => 'Update Profile',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
        ];

        return view('admin/profile', $data);
    }

    public function save()
    {
        $post = [
            'id'       => $this->request->getVar('id'),
            'username' => $this->request->getVar('username'),
            'nama'     => $this->request->getVar('nama'),
            'whatsapp' => $this->request->getVar('whatsapp')
        ];

        if ($this->admin->save($post) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan data. Username sudah terdaftar.');
            return redirect()->to(base_url('admin/profile'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('admin/profile'));
        }
    }

    public function password()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'     => 'Ganti Password',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
        ];

        return view('admin/password', $data);
    }

    public function password_proses()
    {
        if ($this->request->getVar('password_baru') != $this->request->getVar('password_baru2')) {
            session()->setFlashdata('error', 'Password baru tidak cocok.');
            return redirect()->to(base_url('admin/profile/password'));
        }

        $post = [
            'id'       => $this->request->getVar('id'),
            'password' => password_hash($this->request->getVar('password_baru'), PASSWORD_BCRYPT)
        ];

        if ($this->admin->save($post) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan data. Username sudah terdaftar.');
            return redirect()->to(base_url('admin/profile/password'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('admin/profile/password'));
        }
    }
}

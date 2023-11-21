<?php

namespace App\Controllers\Walikelas;

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
        if (session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }
        $walikelas = $this->walikelas->where('guru', session()->get('id'))->first();

        $data = [
            'title'     => 'Update Profile',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $walikelas,
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $this->pembina->where('guru', session()->get('id'))->first(),
        ];

        return view('walikelas/profile', $data);
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
            return redirect()->to(base_url('walikelas/profile'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('walikelas/profile'));
        }
    }

    public function password()
    {
        if (session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }
        $walikelas = $this->walikelas->where('guru', session()->get('id'))->first();

        $data = [
            'title'     => 'Ganti Password',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $walikelas,
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $this->pembina->where('guru', session()->get('id'))->first(),
        ];

        return view('walikelas/password', $data);
    }

    public function password_proses()
    {
        if ($this->request->getVar('password_baru') != $this->request->getVar('password_baru2')) {
            session()->setFlashdata('error', 'Password baru tidak cocok.');
            return redirect()->to(base_url('walikelas/profile/password'));
        }

        $post = [
            'id'       => $this->request->getVar('id'),
            'password' => password_hash($this->request->getVar('password_baru'), PASSWORD_BCRYPT)
        ];

        if ($this->admin->save($post) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan data. Username sudah terdaftar.');
            return redirect()->to(base_url('walikelas/profile/password'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('walikelas/profile/password'));
        }
    }
}

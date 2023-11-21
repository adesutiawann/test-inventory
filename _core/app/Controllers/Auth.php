<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth');
    }

    public function proses()
    {
        $admin = new AdminModel();

        $cek = $admin->where('username', $this->request->getVar('username'))->first();

        if ($cek) {

            if (password_verify($this->request->getVar('password'), $cek->password)) {
                if ($cek->level == 1) {
                    $data = [
                        'id'           => $cek->id,
                        'logged_admin' => true,
                    ];

                    session()->set($data);
                    return redirect()->to(base_url('admin/dashboard'));
                } else if ($cek->level == 2) {
                    $cek_pembina = $this->pembina->find($cek->id);
                    if ($cek_pembina != null) {
                        $logged_pembina = true;
                    } else {
                        $logged_pembina = false;
                    }

                    $cek_piket = $this->pembina->find($cek->id);
                    if ($cek_piket != null) {
                        $logged_piket = true;
                    } else {
                        $logged_piket = false;
                    }

                    $cek_bk = $this->pembina->find($cek->id);
                    if ($cek_bk != null) {
                        $logged_bp = true;
                    } else {
                        $logged_bp = false;
                    }

                    $data = [
                        'id'               => $cek->id,
                        'logged_walikelas' => true,
                        'logged_pembina'   => $logged_pembina,
                        'logged_piket'     => $logged_piket,
                        'logged_bp'        => $logged_bp,
                    ];

                    session()->set($data);
                    return redirect()->to(base_url('walikelas/dashboard'));
                } else {
                    session()->setFlashdata('error', 'Tidak ada level buat anda masuk.');
                    return redirect()->to(base_url());
                }
            } else {
                session()->setFlashdata('error', 'Password tidak cocok.');
                return redirect()->to(base_url());
            }
        } else {
            session()->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->to(base_url());
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}

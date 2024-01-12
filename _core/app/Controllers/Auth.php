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

            //if (password_verify($this->request->getVar('password'), $cek->password)) {
            if ($this->request->getVar('password') === $cek->password) {

                $data = [
                    'id'           => $cek->id,
                    'logged_admin' => true,
                ];

                session()->set($data);
                session()->setFlashdata('login', 'Anda Berhail Login !');
                return redirect()->to(base_url('admin/dashboard'));
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

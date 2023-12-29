<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class User extends BaseController
{
    protected $admin;
    public function __construct()
    {
        $this->admin = new AdminModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Account',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            // 'user'   => $this->admin->orderBy('id', 'desc'),
            'user'    => $this->admin->orderBy('nama', 'asc')->findAll(),
        ];

        return view('admin/user', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('admin')->orderBy('id', 'desc');

        return DataTable::of($builder)
            ->add('level', function ($row) {
                if ($row->level == 1) {
                    $l = '<span class="badge bg-primary">Administrator</span>';
                } else if ($row->level == 2) {
                    $l = '<span class="badge bg-warning">Guru</span>';
                } else {
                    $l = '<span class="badge bg-danger">Belum di set</span>';
                }
                return $l;
            })
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/user/edit/' . $row->id) .
                    '" class="btn btn-xm btn-info text-white"><i class="fa-solid fa-pen-to-square"></i></a> <a href="' . base_url('admin/user/delete/' . $row->id) . '" 
                class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')"><i class="fa-solid fa-trash-can"></i></a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Account',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
        ];

        return view('admin/user_add', $data);
    }

    public function edit($id)
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Edit Account',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'user'    => $this->admin->find($id),
        ];

        return view('admin/user_edit', $data);
    }

    public function save()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        $tgl = date("Y-m-d");
        if ($this->request->getVar('id')) {

            $post = [
                'id'       => $this->request->getVar('id'),
                'nik' => $this->request->getVar('nik'),

                'nama'     => $this->request->getVar('nama'),


                'username' => $this->request->getVar('username'),
                'password'     => $this->request->getVar('password'),
                //'password' => password_hash($this->request->getVar('username'), PASSWORD_BCRYPT),
                'whatsapp' => $this->request->getVar('whatsapp'),
                'level'    => $this->request->getVar('level'),
                'tgl'           =>  $tgl,
            ];

            if ($this->admin->save($post) === false) {
                session()->setFlashdata('error', 'Gagal menyimpan data.');
                return redirect()->to(base_url('admin/user'));
            } else {
                session()->setFlashdata('success', 'Data berhasil disimpan.');
                return redirect()->to(base_url('admin/user'));
            }
        } else {
            $post = [
                'nik' => $this->request->getVar('nik'),

                'nama'     => $this->request->getVar('nama'),


                'username' => $this->request->getVar('username'),
                'password'     => $this->request->getVar('password'),
                //'password' => password_hash($this->request->getVar('username'), PASSWORD_BCRYPT),
                'whatsapp' => $this->request->getVar('whatsapp'),
                'level'    => $this->request->getVar('level'),
                'tgl'           =>  $tgl,
            ];

            if ($this->admin->save($post) === false) {
                session()->setFlashdata('error', 'Gagal menyimpan data.');
                return redirect()->to(base_url('admin/user/add'));
            } else {
                session()->setFlashdata('success', 'Data berhasil disimpan.');
                return redirect()->to(base_url('admin/user'));
            }
        }
    }

    public function delete($id)
    {
        if ($this->admin->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('admin/user'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/user'));
        }
    }
}

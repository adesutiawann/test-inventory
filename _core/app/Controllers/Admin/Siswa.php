<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    protected $admin;
    protected $siswa;
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->siswa = new SiswaModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Data Siswa',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->siswa->find(session()->get('id')),
            
            
        ];

        return view('admin/siswa', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('siswa')->orderBy('id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/siswa/edit/' . $row->id) . '" class="btn btn-sm btn-info text-white">Edit</a> 
                <a href="' . base_url('admin/siswa/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Tambah Siswa',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->siswa->find(session()->get('id')),
            'kelas'   => $this->siswa->groupBy('kelas')->findAll(),
            
        ];

        return view('admin/siswa_add', $data);
    }
    public function edit($id)
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Edit Siswa',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'siswa'   => $this->siswa->find($id),
            'kelas'   => $this->siswa->select('kelas')->groupBy('kelas')->findAll(),
        ];

        return view('admin/siswa_edit', $data);
    }

    public function save()
    {
        
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        if ($this->request->getVar('id')) {
            $post = [
                'id'             => $this->request->getVar('id'),
                'nama'           => $this->request->getVar('nama'),
                'email'          => $this->request->getVar('email'),
                'whatsapp_siswa' => $this->request->getVar('whatsapp_siswa'),
                'whatsapp_wali'  => $this->request->getVar('whatsapp_wali'),
                'kelas'          => $this->request->getVar('kelas'),
            ];

            if ($this->siswa->save($post) === false) {
                session()->setFlashdata('error', 'Gagal menyimpan data Diedit.');
                return redirect()->to(base_url('admin/siswa/edit/' . $this->request->getVar('id')));
            } else {
                session()->setFlashdata('success', 'Data berhasil Diedit.');
                return redirect()->to(base_url('admin/siswa/edit/' . $this->request->getVar('id')));
            }
    }else{
        $post = [
            'nama'           => $this->request->getVar('nama'),
            'email'          => $this->request->getVar('email'),
            'whatsapp_siswa' => $this->request->getVar('whatsapp_siswa'),
            'whatsapp_wali'  => $this->request->getVar('whatsapp_wali'),
            'kelas'          => $this->request->getVar('kelas'),
        ];

        if ($this->siswa->save($post) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan data.');
            return redirect()->to(base_url('admin/siswa'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('admin/siswa'));
        }
    }
    }

    public function delete($id)
    {
        if ($this->siswa->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('admin/siswa'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('admin/siswa'));
        }
    }
}

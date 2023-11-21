<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PembinaModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\SettingModel;

class Setting extends BaseController
{
    protected $admin;
    protected $tahun_pelajaran;
    protected $set;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        $this->tahun_pelajaran = new Tahun_pelajaranModel();
        $this->set             = new SettingModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Setting',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'setting' => $this->setting,
        ];

        return view('admin/setting', $data);
    }

    public function data_tp()
    {
        $db = db_connect();
        $builder = $db->table('tahun_pelajaran')->orderBy('id', 'desc');
        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/setting/delete_tp/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->add('aktif', function ($row) {              
              })
            ->addNumbering('no')->toJson(true);
    }

    public function save_tp()
    {
        $post = [
            'tahun' => $this->request->getVar('tahun'),
            'semester' => $this->request->getVar('semester'),
        ];

        if ($this->tahun_pelajaran->save($post)) {
            session()->setFlashdata('success', 'Data berhasil di simpan.');
            return redirect()->to(base_url('admin/setting'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/setting'));
        }
    }

    public function delete_tp($id)
    {
        if ($this->tahun_pelajaran->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/setting'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/setting'));
        }
    }

    public function save_wa()
    {
        $post = [
            'id'         => 1,
            'wa_api_url' => $this->request->getVar('wa_api_url'),
            'wa_api_key' => $this->request->getVar('wa_api_key'),
            'text_message1' => $this->request->getVar('text_message1'),
            'text_message2' => $this->request->getVar('text_message2'),
            'text_message3' => $this->request->getVar('text_message3'),
            'text_message4' => $this->request->getVar('text_message4'),
        ];

        if ($this->set->save($post)) {
            session()->setFlashdata('success_wa', 'Data berhasil di simpan.');
            return redirect()->to(base_url('admin/setting'));
        } else {
            session()->setFlashdata('error_wa', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/setting'));
        }
    }
}

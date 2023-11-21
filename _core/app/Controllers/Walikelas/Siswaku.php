<?php

namespace App\Controllers\Walikelas;

use App\Controllers\Admin\Walikelas;
use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\WalikelasModel;

class Siswaku extends BaseController
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
            'title'     => 'Data Siswa',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $walikelas,
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $this->pembina->where('guru', session()->get('id'))->first(),
        ];

        return view('walikelas/siswaku', $data);
    }

    public function data()
    {
        $walikelas = $this->walikelas->where('guru', session()->get('id'))->first();

        $db = db_connect();
        $builder = $db->table('siswa')->where('kelas', $walikelas->kelas)->orderBy('id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('walikelas/siswaku/edit/' . $row->id) . '" class="btn btn-sm btn-info text-white">Edit</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function edit($id)
    {
        if (session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $walikelas = $this->walikelas->where('guru', session()->get('id'))->first();

        $data = [
            'title'     => 'Edit Siswa',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'siswa'     => $this->siswa->find($id),
            'walikelas' => $walikelas,
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $this->pembina->where('guru', session()->get('id'))->first(),
            'kelas'     => $this->siswa->select('kelas')->groupBy('kelas')->findAll(),
        ];

        return view('walikelas/siswaku_edit', $data);
    }

    public function save($id)
    {
        $post = [
            'id'             => $id,
            'nama'           => $this->request->getVar('nama'),
            'email'          => $this->request->getVar('email'),
            'whatsapp_siswa' => $this->request->getVar('whatsapp_siswa'),
            'whatsapp_wali'  => $this->request->getVar('whatsapp_wali'),
            'kelas'          => $this->request->getVar('kelas'),
        ];

        if ($this->siswa->save($post) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan data.');
            return redirect()->to(base_url('walikelas/siswaku/edit/' . $id));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('walikelas/siswaku/edit/' . $id));
        }
    }

    public function delete($id)
    {
        if ($this->siswa->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('walikelas/siswaku'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('walikelas/siswaku'));
        }
    }
}

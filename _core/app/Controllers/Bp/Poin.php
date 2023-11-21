<?php

namespace App\Controllers\Bp;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\PembinaModel;
use App\Models\AnggotaModel;

class Poin extends BaseController
{
    protected $admin;
    protected $siswa;
    protected $pembina;
    protected $anggota;

    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->siswa = new SiswaModel();
        $this->pembina = new PembinaModel();
        $this->anggota = new AnggotaModel();
    }

    public function index()
    {
        if (session()->get('logged_bp') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $pembina = $this->pembina->where('guru', session()->get('id'))->first();

        $data = [
            'title'     => 'Data Poin Pelanggaran',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $pembina,
            'siswa'     => $this->siswa->findAll(),
        ];

        return view('bp/poin', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('poin')->orderBy('id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('bp/poin/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function save()
    {
        $post = [
            'pelanggaran' => $this->request->getVar('pelanggaran'),
            'poin'        => $this->request->getVar('poin'),
        ];

        if ($this->poin->save($post) === false) {
            session()->setFlashdata('error_add', 'Gagal menyimpan data.');
            return redirect()->to(base_url('bp/poin'));
        } else {
            session()->setFlashdata('success_add', 'Data berhasil disimpan.');
            return redirect()->to(base_url('bp/poin'));
        }
    }

    public function delete($id)
    {
        if ($this->poin->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('bp/poin'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('bp/poin'));
        }
    }
}

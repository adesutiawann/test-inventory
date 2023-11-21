<?php

namespace App\Controllers\Pembina;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\PembinaModel;
use App\Models\AnggotaModel;

class Anggota extends BaseController
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
        if (session()->get('logged_pembina') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $pembina = $this->pembina->where('guru', session()->get('id'))->first();

        $data = [
            'title'     => 'Data Anggota',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $pembina,
            'siswa'     => $this->siswa->findAll(),
        ];

        return view('pembina/anggota', $data);
    }

    public function data()
    {
        $pembina = $this->pembina->where('guru', session()->get('id'))->first();

        $db = db_connect();
        $builder = $db->table('anggota')->select('anggota.id,anggota.extra, siswa.nama, siswa.email, siswa.whatsapp_siswa, siswa.whatsapp_wali, siswa.kelas')
            ->where('anggota.guru', session()->get('id'))
            ->join('siswa', 'siswa.id=anggota.siswa')
            ->orderBy('anggota.id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('pembina/anggota/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function add()
    {
        if (session()->get('logged_pembina') != true) {
            return redirect()->to(base_url());
        }

        $pembina = $this->pembina->where('guru', session()->get('id'))->first();

        $data = [
            'title'   => 'Edit Siswa',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'siswa'   => $this->siswa->findAll(),
            'pembina' => $pembina,
            'extra'   => $this->pembina->select('extra')->groupBy('extra')->findAll(),
        ];

        return view('pembina/anggota_add', $data);
    }

    public function save()
    {
        $post = [
            'guru'  => session()->get('id'),
            'siswa' => $this->request->getVar('siswa'),
            'extra' => $this->request->getVar('extra'),
        ];

        if ($this->anggota->save($post) === false) {
            session()->setFlashdata('error_add', 'Gagal menyimpan data.');
            return redirect()->to(base_url('pembina/anggota/add'));
        } else {
            session()->setFlashdata('success_add', 'Data berhasil disimpan.');
            return redirect()->to(base_url('pembina/anggota'));
        }
    }

    public function delete($id)
    {
        if ($this->anggota->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('pembina/anggota'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('pembina/anggota'));
        }
    }
}

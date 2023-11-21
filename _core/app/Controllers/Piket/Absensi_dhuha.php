<?php

namespace App\Controllers\Piket;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\PembinaModel;
use App\Models\AnggotaModel;

class Absensi_dhuha extends BaseController
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
            'title'     => 'Absensi Sholat Dhuha',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $pembina,
            'siswa'     => $this->siswa->findAll(),
            'poin'      => $this->poin->findAll(),
        ];

        return view('piket/absensi_dhuha', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('absensi_dhuha')
            ->select('absensi_dhuha.id, absensi_dhuha.tanggal, siswa.nama, siswa.kelas, admin.nama as guru')
            ->join('siswa', 'siswa.id=absensi_dhuha.siswa')
            ->join('admin', 'admin.id=absensi_dhuha.guru')
            ->orderBy('absensi_dhuha.id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('piket/absensi_dhuha/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function save()
    {
        $post = [
            'tanggal' => date("Y-m-d"),
            'guru'    => session()->get('id'),
            'siswa'   => $this->request->getVar('siswa'),
        ];

        if ($this->absensi_dhuha->save($post) === false) {
            session()->setFlashdata('error_add', 'Gagal menyimpan data.');
            return redirect()->to(base_url('piket/absensi_dhuha'));
        } else {
            session()->setFlashdata('success_add', 'Data berhasil disimpan.');
            return redirect()->to(base_url('piket/absensi_dhuha'));
        }
    }

    public function delete($id)
    {
        if ($this->absensi_dhuha->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('piket/absensi_dhuha'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('piket/absensi_dhuha'));
        }
    }
}

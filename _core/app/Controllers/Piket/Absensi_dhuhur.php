<?php

namespace App\Controllers\Piket;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\PembinaModel;
use App\Models\AnggotaModel;

class Absensi_dhuhur extends BaseController
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
            'title'     => 'Absensi Sholat Dhuhur',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $pembina,
            'siswa'     => $this->siswa->findAll(),
            'poin'      => $this->poin->findAll(),
        ];

        return view('piket/absensi_dhuhur', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('absensi_dhuhur')
            ->select('absensi_dhuhur.id, absensi_dhuhur.tanggal, siswa.nama, siswa.kelas, admin.nama as guru')
            ->join('siswa', 'siswa.id=absensi_dhuhur.siswa')
            ->join('admin', 'admin.id=absensi_dhuhur.guru')
            ->orderBy('absensi_dhuhur.id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('piket/absensi_dhuhur/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
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

        if ($this->absensi_dhuhur->save($post) === false) {
            session()->setFlashdata('error_add', 'Gagal menyimpan data.');
            return redirect()->to(base_url('piket/absensi_dhuhur'));
        } else {
            session()->setFlashdata('success_add', 'Data berhasil disimpan.');
            return redirect()->to(base_url('piket/absensi_dhuhur'));
        }
    }

    public function delete($id)
    {
        if ($this->absensi_dhuhur->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('piket/absensi_dhuhur'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('piket/absensi_dhuhur'));
        }
    }
}

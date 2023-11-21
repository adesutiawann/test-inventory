<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PembinaModel;
use App\Models\SiswaModel;
use App\Models\Laporan_kegiatanModel;

class Laporan_extra extends BaseController
{
    protected $admin;
    protected $pembina;
    protected $siswa;
    protected $laporan_kegiatan;

    public function __construct()
    {
        $this->admin            = new AdminModel();
        $this->pembina          = new PembinaModel();
        $this->siswa            = new SiswaModel();
        $this->laporan_kegiatan = new Laporan_kegiatanModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Laporan Kegiatan Extra',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'guru'    => $this->admin->orderBy('nama', 'asc')->findAll(),
            'kelas'   => $this->siswa->groupBy('kelas')->findAll(),
        ];

        if (!empty($_GET['tanggal'])) {
            $tgl = $_GET['tanggal'];
            $cek = $this->laporan_kegiatan->where('tanggal', $tgl)->findAll();
            $data['laporan'] = $cek;
        }

        return view('admin/laporan_extra', $data);
    }

    public function cetak($id)
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Laporan Kegiatan Extra',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'guru'    => $this->admin->orderBy('nama', 'asc')->findAll(),
            'kelas'   => $this->siswa->groupBy('kelas')->findAll(),
        ];

        $cek = $this->laporan_kegiatan->where('laporan_kegiatan.id', $id)->join('admin', 'admin.id=laporan_kegiatan.guru')->first();
        $data['laporan'] = $cek;


        return view('admin/laporan_extra_cetak', $data);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\SiswaModel;
use App\Models\AbsensiModel;

class Dashboard extends BaseController
{
    protected $admin;
    protected $tahun_pelajaran;
    protected $siswa;
    protected $absensi;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        $this->tahun_pelajaran = new Tahun_pelajaranModel();
        $this->siswa           = new SiswaModel();
        $this->absensi         = new AbsensiModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $ta = $this->tahun_pelajaran->where('aktif', 1)->first();

        $data = [
            'title'       => 'Dashboard',
            'segment'     => $this->request->uri->getSegments(),
            'admin'       => $this->admin->find(session()->get('id')),
            'total_siswa' => $this->siswa->where(['tahun_pelajaran' => $ta->tahun])->countAllResults(),
            'total_s'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 's', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
            'total_i'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 'i', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
            'total_a'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 'a', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;

class Laporan_all extends BaseController
{
    protected $admin;
    protected $walikelas;
    protected $absensi;
    protected $siswa;
    protected $tahun_pelajaran;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        $this->walikelas       = new WalikelasModel();
        $this->absensi         = new AbsensiModel();
        $this->siswa           = new SiswaModel();
        $this->tahun_pelajaran = new Tahun_pelajaranModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true && session()->get('logged_bp') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'           => 'Laporan Absensi',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'kelas'           => $this->siswa->groupBy('kelas')->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];
        $data['siswa']     = $this->siswa;
        $data['absensi']   = $this->absensi;
        $data['walikelas'] = $this->walikelas;

        return view('admin/laporan_all', $data);
    }
}

<?php

namespace App\Controllers\Walikelas;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;

class Laporan_siswa extends BaseController
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
        if (session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $walikelas = $this->walikelas->where('guru', session()->get('id'))->first();

        $data = [
            'title'           => 'Laporan Absensi Siswa',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'walikelas'       => $walikelas,
            'piket'           => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'              => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'         => $this->pembina->where('guru', session()->get('id'))->first(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        $data['absensi'] = $this->absensi;


        return view('walikelas/laporan_siswa', $data);
    }
}

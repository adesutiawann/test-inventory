<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\SiswaModel;
use App\Models\AbsensiModel;

use App\Models\AsetModel;

class Dashboard extends BaseController
{
    protected $admin;
    protected $tahun_pelajaran;
    protected $siswa;
    protected $absensi;


    protected $aset;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        $this->tahun_pelajaran = new Tahun_pelajaranModel();
        $this->siswa           = new SiswaModel();
        $this->absensi         = new AbsensiModel();


        $this->aset = new AsetModel();
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

            //'total_destop' => $this->aset->where(['type' => "Destop"])->countAllResults(),
            'total_m' => $this->aset->where('type', '6')->countAllResults(),
            'total_pc' => $this->aset->where('type', '2')->countAllResults(),
            'total_l' => $this->aset->where('type', '7')->countAllResults(),
            'total_p' => $this->aset->where('type', '3')->countAllResults(),

            'total_k' => $this->aset->where('type', '8')->countAllResults(),
            'total_m' => $this->aset->where('type', '9')->countAllResults(),


            'total_siswa' => $this->siswa->where(['tahun_pelajaran' => $ta->tahun])->countAllResults(),
            'total_s'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 's', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
            'total_i'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 'i', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
            'total_a'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 'a', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}

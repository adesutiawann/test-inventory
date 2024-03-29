<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\KabelModel;
use App\Models\SiswaModel;
use App\Models\AbsensiModel;

use App\Models\AsetModel;

class Dashboard extends BaseController
{
    protected $admin;
    protected $tahun_pelajaran;
    protected $siswa;
    protected $absensi;
    protected $kabel;


    protected $aset;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        //$this->tahun_pelajaran = new Tahun_pelajaranModel();
        // $this->siswa           = new SiswaModel();
        //$this->absensi         = new AbsensiModel();
        $this->aset = new AsetModel();
        $this->kabel = new KabelModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        //  $ta = $this->tahun_pelajaran->where('aktif', 1)->first();
        //$total_kb_pw = $this->kabel->find();
        $result = $this->kabel->where('type', 'POWER')->find();
        $data = [
            'title'       => 'Dashboard',
            'segment'     => $this->request->uri->getSegments(),
            'admin'       => $this->admin->find(session()->get('id')),

            //'total_destop' => $this->aset->where(['type' => "Destop"])->countAllResults(),
            'total_admin' => $this->admin->countAllResults(),
            'total_aset' => $this->aset->countAllResults(),
            'total_tersedia' => $this->aset->where('stock', 'Tersedia')->countAllResults(),
            'total_terdistribusi' => $this->aset->where('stock', 'Sewa')->countAllResults(),
            'total_backup' => $this->aset->where('stock', 'Backup')->countAllResults(),
            'total_peminjaman' => $this->aset->where('stock', 'Dipinjam')->countAllResults(),
            // perhitungan pc
            'total_pc' => $this->aset->where('type', 'pc')->countAllResults(),
            'total_pc_ok' => $this->aset->where('type', 'pc')->where('kondisi', 'OK')->countAllResults(),
            'total_pc_rusak' => $this->aset->where('type', 'pc')->where('kondisi', 'RUSAK')->countAllResults(),
            'total_pc_blanks' => $this->aset->where('type', 'pc')->where('kondisi', 'BLANK')->countAllResults(),

            'total_mo' => $this->aset->where('type', 'monitor')->countAllResults(),
            'total_mo_ok' => $this->aset->where('type', 'monitor')->where('kondisi', 'OK')->countAllResults(),
            'total_mo_rusak' => $this->aset->where('type', 'monitor')->where('kondisi', 'RUSAK')->countAllResults(),
            'total_mo_blanks' => $this->aset->where('type', 'monitor')->where('kondisi', 'BLANK')->countAllResults(),

            'total_ky' => $this->aset->where('type', 'keyboard')->countAllResults(),
            'total_ky_ok' => $this->aset->where('type', 'keyboard')->where('kondisi', 'OK')->countAllResults(),
            'total_ky_rusak' => $this->aset->where('type', 'keyboard')->where('kondisi', 'RUSAK')->countAllResults(),
            'total_ky_blanks' => $this->aset->where('type', 'keyboard')->where('kondisi', 'BLANK')->countAllResults(),


            'total_ms' => $this->aset->where('type', 'mouse')->countAllResults(),
            'total_ms_ok' => $this->aset->where('type', 'mouse')->where('kondisi', 'OK')->countAllResults(),
            'total_ms_rusak' => $this->aset->where('type', 'mouse')->where('kondisi', 'RUSAK')->countAllResults(),
            'total_ms_blanks' => $this->aset->where('type', 'mouse')->where('kondisi', 'BLANK')->countAllResults(),


            'total_la' => $this->aset->where('type', 'Leptop')->countAllResults(),
            'total_la_ok' => $this->aset->where('type', 'Leptop')->where('kondisi', 'OK')->countAllResults(),
            'total_la_rusak' => $this->aset->where('type', 'Leptop')->where('kondisi', 'RUSAK')->countAllResults(),
            'total_la_blanks' => $this->aset->where('type', 'Leptop')->where('kondisi', 'BLANK')->countAllResults(),

            'total_pr' => $this->aset->where('type', 'Printer')->countAllResults(),
            'total_pr_ok' => $this->aset->where('type', 'Printer')->where('kondisi', 'OK')->countAllResults(),
            'total_pr_rusak' => $this->aset->where('type', 'Printer')->where('kondisi', 'RUSAK')->countAllResults(),
            'total_pr_blanks' => $this->aset->where('type', 'Printer')->where('kondisi', 'BLANK')->countAllResults(),


            'kabel'    => $this->kabel->find(),
            //'aset' => $this->aset->where('type', 'pc')->orderBy('id', 'desc')->findAll(),

            'total_kb' => $this->kabel->where('type', 'Printer')->countAllResults(),
            //'total_kb_pw' => $this->kabel->where('type', 'POWER')->find(),
            'total_kb_pw' => isset($result['jumlah']) ? $result['jumlah'] : null,

            'total_kb_vga' => $this->kabel->where('type', 'VGA')->findAll(),
            'total_kb_hdmi' => $this->kabel->where('type', 'HDMI')->findAll(),
            'total_kb_dp' => $this->kabel->where('type', 'DISPLAY')->findAll(),

            //'total_siswa' => $this->siswa->where(['tahun_pelajaran' => $ta->tahun])->countAllResults(),
            //  'total_s'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 's', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
            //  'total_i'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 'i', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
            // 'total_a'     => $this->absensi->where(['tanggal' => date("Y-m-d"), 'absensi' => 'a', 'tahun_pelajaran' => $ta->tahun])->countAllResults(),
        ];

        return view('admin/dashboard', $data);
    }
}

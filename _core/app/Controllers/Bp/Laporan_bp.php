<?php

namespace App\Controllers\Bp;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;

class Laporan_bp extends BaseController
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
        if (session()->get('logged_bp') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'           => 'Laporan Absensi',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'walikelas'       => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'           => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'              => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'         => $this->pembina->where('guru', session()->get('id'))->first(),
            'kelas'           => $this->siswa->groupBy('kelas')->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        if (isset($_GET['bulan'])) {
            $data['siswa'] = $this->siswa->where('kelas', $_GET['kelas'])->orderBy('nama', 'asc')->findAll();
            $data['siswa_count'] = $this->siswa->where('kelas', $_GET['kelas'])->orderBy('nama', 'asc')->countAllResults();
            $data['absensi'] = $this->absensi;
            $data['wali'] = $this->walikelas->select('admin.nama as walikelas')->where('kelas', $_GET['kelas'])->join('admin', 'admin.id=walikelas.guru')->first();

            $bulan = explode('-', $_GET['bulan']);

            $where = "MONTH(absensi.tanggal) = '09' AND YEAR(absensi.tanggal) = '2022' AND absensi.kelas='X TKR'";

            $data['laporan'] = $this->absensi->select('absensi.*, siswa.nama')
                ->where($where)
                ->join('siswa', 'siswa.id=absensi.siswa')
                ->orderBy('siswa.nama', 'asc')
                ->groupBy('siswa')->findAll();


            // $data['total_h'] = $this->absensi->where(['absensi.tanggal' => $_GET['start'], 'absensi.kelas' => $_GET['kelas'], 'absensi' => 'h'])->countAllResults();
            // $data['total_s'] = $this->absensi->where(['absensi.tanggal' => $_GET['start'], 'absensi.kelas' => $_GET['kelas'], 'absensi' => 's'])->countAllResults();
            // $data['total_i'] = $this->absensi->where(['absensi.tanggal' => $_GET['start'], 'absensi.kelas' => $_GET['kelas'], 'absensi' => 'i'])->countAllResults();
            // $data['total_a'] = $this->absensi->where(['absensi.tanggal' => $_GET['start'], 'absensi.kelas' => $_GET['kelas'], 'absensi' => 'a'])->countAllResults();
        }

        return view('bp/laporan', $data);
    }
}

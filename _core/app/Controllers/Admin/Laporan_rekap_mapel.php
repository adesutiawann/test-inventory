<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\JadwalModel;

class Laporan_rekap_mapel extends BaseController
{
    protected $admin;
    protected $walikelas;
    protected $absensi;
    protected $siswa;
    protected $tahun_pelajaran;
    protected $jadwal;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        $this->jadwal           = new JadwalModel();
        $this->walikelas       = new WalikelasModel();
        $this->absensi         = new AbsensiModel();
        $this->siswa           = new SiswaModel();
        $this->tahun_pelajaran = new Tahun_pelajaranModel();
    }

    public function index()
    {
       // if (session()->get('logged_walikelas') != true) {
       //     return redirect()->to(base_url());
       // }

        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        //$walikelas = $this->admin->where('guru', session()->get('id'))->first();
        $admin  = $this->admin->find(session()->get('id'));

        $data = [
            'title'           => 'Laporan Absensi Mata Pelajaran',
            'segment'         => $this->request->uri->getSegments(),
            'mk'              => $this->jadwal->where('id_mengajar', $_GET['id_mk'])->first(),
            'admin'           => $this->admin->find(session()->get('id')),
            //'walikelas'       => $walikelas,
            'piket'           => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'              => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'         => $this->pembina->where('guru', session()->get('id'))->first(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        if (isset($_GET['bulan'])) {
            $pelajaran=$_GET['id_mk'];
            $data['mk']   =             
            $this->jadwal->where('id_mengajar', $pelajaran)
            ->join('tb_mapel', 'tb_mapel.id=tb_mengajar.id_mapel')->findAll();
            
           // $data['mapel'] = $this->siswa->where('id_mengajar', $_GET['id_mk'])->orderBy('id_mengajar', 'asc')->findAll();
           
           // $data['count_siswa']     = $this->siswa->where('kelas',$_GET['id_kls'])->countAllResults();
            $data['siswa'] = $this->siswa->where('kelas', $_GET['kelas'])->orderBy('id', 'asc')->findAll();
            $data['siswa_count'] = $this->siswa->where('kelas', $_GET['kelas'])->orderBy('nama', 'asc')->countAllResults();
            $data['absensi'] = $this->absensi;
            //$data['absensi'] = $this->absensi->where('id_mengajar', '20');
            $data['wali'] = $this->walikelas->select('admin.nama as walikelas')->where('kelas', $_GET['kelas'])->join('admin', 'admin.id=walikelas.guru')->first();
        }

        return view('admin/laporan_rekap_mapel', $data);
    }
}

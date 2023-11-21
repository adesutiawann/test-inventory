<?php

namespace App\Controllers\Piket;

use App\Controllers\Admin\Pembina;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\Absensi_kegiatanModel;
use App\Models\AnggotaModel;

class Laporan_telat extends BaseController
{
    protected $admin;
    protected $pembina;
    protected $absensi_kegiatan;
    protected $siswa;
    protected $tahun_pelajaran;
    protected $anggota;

    public function __construct()
    {
        $this->admin            = new AdminModel();
        $this->absensi_kegiatan = new Absensi_kegiatanModel();
        $this->siswa            = new SiswaModel();
        $this->tahun_pelajaran  = new Tahun_pelajaranModel();
        $this->anggota          = new AnggotaModel();
    }

    public function index()
    {
        if (session()->get('logged_piket') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $piket = $this->piket->where(['guru' => session()->get('id')])->join('admin', 'admin.id=piket.guru')->first();

        $data = [
            'title'           => 'Laporan Absensi Terlambat',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'walikelas'       => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'           => $piket,
            'bp'              => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'         => $this->pembina->where('guru', session()->get('id'))->first(),
            'siswa'           => $this->siswa->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        if (isset($_GET['tanggal'])) {
            $data['laporan'] = $this->absensi_telat->select('absensi_telat.id, siswa.nama, siswa, whatsapp_siswa, siswa.whatsapp_wali, siswa.kelas')->where(['tanggal' => $_GET['tanggal']])->join('siswa', 'siswa.id=absensi_telat.siswa')->findAll();
        }

        return view('piket/laporan_absensi_telat', $data);
    }
}

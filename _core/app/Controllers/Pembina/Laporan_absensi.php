<?php

namespace App\Controllers\Pembina;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\PembinaModel;
use App\Models\AnggotaModel;
use App\Models\Laporan_kegiatanModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\Absensi_kegiatanModel;

class Laporan_absensi extends BaseController
{
    protected $admin;
    protected $siswa;
    protected $pembina;
    protected $anggota;
    protected $laporan_kegiatan;
    protected $tahun_pelajaran;
    protected $absensi_kegiatan;

    public function __construct()
    {
        $this->admin            = new AdminModel();
        $this->siswa            = new SiswaModel();
        $this->pembina          = new PembinaModel();
        $this->anggota          = new AnggotaModel();
        $this->laporan_kegiatan = new Laporan_kegiatanModel();
        $this->tahun_pelajaran  = new Tahun_pelajaranModel();
        $this->absensi_kegiatan = new Absensi_kegiatanModel();
    }

    public function index()
    {
        if (session()->get('logged_pembina') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $pembina = $this->pembina->where('guru', session()->get('id'))->first();

        $data = [
            'title'           => 'Laporan Absensi',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'walikelas'       => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'           => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'              => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'         => $pembina,
            'siswa'           => $this->siswa->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        if (isset($_GET['tanggal'])) {
            $data['anggota'] = $this->anggota->where('extra', $_GET['extra'])->join('siswa', 'siswa.id=anggota.siswa')->orderBy('siswa.nama', 'asc')->findAll();
            $data['absensi_kegiatan'] = $this->absensi_kegiatan;

            $cek = $this->absensi_kegiatan->select('absensi_kegiatan.*, siswa.nama, siswa.kelas')->where(['absensi_kegiatan.tanggal' => $_GET['tanggal'], 'absensi_kegiatan.tahun_pelajaran' => $_GET['tahun_pelajaran'], 'absensi_kegiatan.semester' => $_GET['semester'], 'absensi_kegiatan.extra' => $_GET['extra']])->join('siswa', 'siswa.id=absensi_kegiatan.siswa')->findAll();
            $data['laporan_kegiatan'] = $cek;
        }

        return view('pembina/laporan_absensi', $data);
    }

    public function data()
    {

        $db = db_connect();
        $builder = $db->table('laporan_kegiatan')->where('guru', session()->get('id'))
            ->orderBy('id', 'desc');

        return DataTable::of($builder)
            ->add('foto_absensi', function ($row) {
                return '<a href="' . base_url('uploads/kegiatan/' . $row->foto_absensi) . '" class="btn btn-sm btn-info text-white" target="_blank">Lihat Foto</a>';
            })
            ->add('foto_kegiatan1', function ($row) {
                return '<a href="' . base_url('uploads/kegiatan/' . $row->foto_kegiatan1) . '" class="btn btn-sm btn-info text-white" target="_blank">Lihat Foto</a>';
            })
            ->add('foto_kegiatan2', function ($row) {
                return '<a href="' . base_url('uploads/kegiatan/' . $row->foto_kegiatan2) . '" class="btn btn-sm btn-info text-white" target="_blank">Lihat Foto</a>';
            })
            ->add('action', function ($row) {
                return '<a href="' . base_url('pembina/laporan_kegiatan/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function save()
    {
        $foto_absensi = $this->request->getFile('foto_absensi');
        $file_absensi   = $foto_absensi->getRandomName();
        $file_absensi   = 'absensi-' . $file_absensi;
        $foto_absensi->move('uploads/kegiatan/', $file_absensi);

        $foto_k1 = $this->request->getFile('foto_kegiatan1');
        $file_k1   = $foto_k1->getRandomName();
        $file_k1   = 'kegiatan1' . $file_k1;
        $foto_k1->move('uploads/kegiatan/', $file_k1);

        $foto_k2 = $this->request->getFile('foto_kegiatan2');
        $file_k2   = $foto_k2->getRandomName();
        $file_k2   = 'kegiatan2' . $file_k2;
        $foto_k2->move('uploads/kegiatan/', $file_k2);

        $pembina = $this->pembina->where('guru', session()->get('id'))->first();

        $post = [
            'tanggal'        => $this->request->getVar('tanggal'),
            'guru'           => session()->get('id'),
            'extra'          => $this->request->getVar('extra'),
            'foto_absensi'   => $file_absensi,
            'foto_kegiatan1' => $file_k1,
            'foto_kegiatan2' => $file_k2,
        ];

        if ($this->laporan_kegiatan->save($post) === false) {
            session()->setFlashdata('error', 'Gagal menyimpan data.');
            return redirect()->to(base_url('pembina/laporan_kegiatan'));
        } else {
            session()->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->to(base_url('pembina/laporan_kegiatan'));
        }
    }

    public function delete($id)
    {
        if ($this->laporan_kegiatan->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('pembina/laporan_kegiatan'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('pembina/laporan_kegiatan'));
        }
    }
}

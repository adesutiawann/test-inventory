<?php

namespace App\Controllers\Piket;

use \Hermawan\DataTables\DataTable;
use App\Controllers\Admin\Pembina;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\Absensi_kegiatanModel;
use App\Models\AnggotaModel;

class Absensi_telat extends BaseController
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
            'title'           => 'Input Absensi Terlambat',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'walikelas'       => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'           => $piket,
            'bp'              => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'         => $this->pembina->where('guru', session()->get('id'))->first(),
            'siswa'           => $this->siswa->findAll(),
            'siswa_telat'     => $this->absensi_telat->select('absensi_telat.id, siswa.nama, siswa, whatsapp_siswa, siswa.whatsapp_wali, siswa.kelas')->where(['tanggal' => date("Y-m-d")])->join('siswa', 'siswa.id=absensi_telat.siswa')->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        return view('piket/absensi_telat', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('absensi_telat')
            ->select('absensi_telat.id, absensi_telat.tanggal, siswa.nama, siswa.kelas, admin.nama as guru')
            ->join('siswa', 'siswa.id=absensi_telat.siswa')
            ->join('admin', 'admin.id=absensi_telat.guru')
            ->orderBy('absensi_telat.id', 'desc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('piket/absensi_telat/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function save()
    {
        if (session()->get('logged_piket') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }
        $admin = $this->admin->find(session()->get('id'));

        $setting = $this->setting;
        $pesan = $setting->text_message4;
        $wa_url = $setting->wa_api_url;
        $wa_key = $setting->wa_api_key;

        $cek = $this->absensi_telat->where(['tanggal' => date("Y-m-d"), 'siswa' => $this->request->getVar('siswa')])->countAllResults();
        if ($cek == 0) {
            $post = [
                'tanggal' => date("Y-m-d"),
                'guru'    => session()->get('id'),
                'siswa'   => $this->request->getVar('siswa'),
                'notif'   => 0,
            ];

            $telat = [
                'tanggal' => date("Y-m-d"),
                'siswa'   => $this->request->getVar('siswa'),
                'poin'    => 60,
            ];

            $masuk = date("Y-m-d 06:45:00");
            $sekarang = date("Y-m-d H:i:s");
            $masuk = strtotime($masuk);
            $sekarang = strtotime($sekarang);
            $terlambat = round(abs($masuk - $sekarang) / 60, 2) . " Menit";
            

            if ($this->absensi_telat->save($post) && $this->pelanggaran_siswa->save($telat)) {
                $abs = $this->absensi_telat->select('absensi_telat.*, siswa.nama, siswa.kelas, siswa.whatsapp_wali')->where(['absensi_telat.tanggal' => date("Y-m-d"), 'absensi_telat.siswa' => $this->request->getVar('siswa')])->join('siswa', 'siswa.id=absensi_telat.siswa')->first();

                $search  = array('{tanggal}', '{terlambat}', '{nama}');
                $replace = array(date("Y-m-d"), $terlambat, $abs->nama);

                $msg = str_replace($search, $replace, $pesan);

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL            => $wa_url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING       => '',
                    CURLOPT_MAXREDIRS      => 10,
                    CURLOPT_TIMEOUT        => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_CUSTOMREQUEST  => 'POST',
                    CURLOPT_POSTFIELDS     => '{
                        "recipient_type": "individual",
                        "to": "' . $abs->whatsapp_wali . '",
                        "type": "text",
                        "text": {
                            "body": ' . json_encode($msg) . '
                        }
                    }',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer ' . $wa_key,
                        'Content-Type: application/json'
                    ),
                ));

                $res = json_decode(curl_exec($curl));

                curl_close($curl);


                session()->setFlashdata('success', 'Sukses menambahkan data.');
                return redirect()->to(base_url('piket/absensi_telat'));
            } else {
                session()->setFlashdata('error', 'Gagal menambahkan data.');
                return redirect()->to(base_url('piket/absensi_telat'));
            }
        } else {
            session()->setFlashdata('error', 'Data siswa sudah ada.');
            return redirect()->to(base_url('piket/absensi_telat'));
        }
    }

    public function delete($id)
    {
        $cek = $this->absensi_telat->first($id);

        $db = db_connect();
        $db->table('pelanggaran_siswa')->where(['tanggal' => $cek->tanggal, 'siswa' => $cek->siswa])->delete();

        if ($this->absensi_telat->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('piket/absensi_telat'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('piket/absensi_telat'));
        }
    }

    public function laporan_telat()
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


    public function notifikasi_siswa($tgl, $kls, $siswa)
    {


        return redirect()->to(session()->get()['_ci_previous_url']);
    }
}

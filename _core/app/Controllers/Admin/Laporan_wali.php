<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;

class Laporan_wali extends BaseController
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
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'           => 'Laporan Wali Kelas',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'kelas'           => $this->siswa->groupBy('kelas')->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        $data['absensi'] = $this->absensi;

        if (isset($_GET['tanggal'])) {
            $data['walikelas'] = $this->walikelas->join('admin', 'admin.id=walikelas.guru')->groupBy('kelas')->findAll();
        }

        return view('admin/laporan_wali', $data);
    }

    public function notif($id)
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $setting = $this->setting;
        $wa_url = $setting->wa_api_url;
        $wa_key = $setting->wa_api_key;

        $walikelas = $this->walikelas->where('guru', $id)->join('admin', 'admin.id=walikelas.guru')->first();
        $nama = $walikelas->nama;
        $kelas = $walikelas->kelas;
        $wa = $walikelas->whatsapp;

        $msg = "Hai *$nama*. Anda belum melakukan rekap absensi hari ini untuk kelas  *$kelas*. Segera lakukan rekap absensi ya...!";
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
                    "to": "' . $wa . '",
                    "type": "text",
                    "text": {
                        "body": "' . $msg . '"
                    }
                }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $wa_key,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        session()->setFlashdata('success', 'Notifikasi berhasil dikirim.');
        return redirect()->to(session()->get()['_ci_previous_url']);
    }
}

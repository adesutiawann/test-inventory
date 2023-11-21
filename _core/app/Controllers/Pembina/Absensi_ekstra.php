<?php

namespace App\Controllers\Pembina;

use App\Controllers\Admin\Pembina;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\Absensi_kegiatanModel;
use App\Models\PembinaModel;
use App\Models\AnggotaModel;

class Absensi_ekstra extends BaseController
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
        $this->pembina          = new PembinaModel();
        $this->absensi_kegiatan = new Absensi_kegiatanModel();
        $this->siswa            = new SiswaModel();
        $this->tahun_pelajaran  = new Tahun_pelajaranModel();
        $this->anggota          = new AnggotaModel();
    }

    public function index()
    {
        if (session()->get('logged_pembina') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $pembina = $this->pembina->where(['guru' => session()->get('id')])->join('admin', 'admin.id=pembina.guru')->first();


        if (isset($_GET['tanggal'])) {
            if ($_GET['tanggal'] > date("Y-m-d")) {
                session()->setFlashdata('error', 'Absensi tidak boleh melebihi tanggal hari ini.');
                return redirect()->to(base_url('pembina/absensi_ekstra'));
            }

            $cek = $this->absensi_kegiatan->where(['tanggal' => $_GET['tanggal'], 'extra' => $_GET['extra']])->countAllResults();

            if ($cek == 0) {
                $siswa = $this->anggota->where(['guru' => session()->get('id'), 'extra' => $_GET['extra']])->findAll();
                // dd($siswa);
                if (!empty($siswa)) {
                    $data = array();
                    foreach ($siswa as $s) {
                        $data[] = [
                            'tanggal'         => $_GET['tanggal'],
                            'pembina'         => session()->get('id'),
                            'extra'           => $s->extra,
                            'siswa'           => $s->siswa,
                            'absensi'         => 'h',
                            'tahun_pelajaran' => $_GET['tahun_pelajaran'],
                            'semester'        => $_GET['semester'],
                        ];
                    }
                    $this->absensi_kegiatan->insertBatch($data);
                } else {
                    session()->setFlashdata('error', 'Tidak ditemukan Siswa.');
                    return redirect()->to(base_url('pembina/absensi_ekstra'));
                }
            }

            $absensi_kegiatan = $this->absensi_kegiatan->select('absensi_kegiatan.*, siswa.nama')->where(['absensi_kegiatan.tanggal' => $_GET['tanggal'], 'absensi_kegiatan.extra' => $_GET['extra']])->join('siswa', 'siswa.id=absensi_kegiatan.siswa')->orderBy('siswa.nama', 'asc')->findAll();
        }
        if (!empty($absensi_kegiatan)) {
            $absensi_kegiatan = $absensi_kegiatan;
        } else {
            $absensi_kegiatan = 0;
        }

        $data = [
            'title'            => 'Input Absensi Kegiatan',
            'segment'          => $this->request->uri->getSegments(),
            'admin'            => $this->admin->find(session()->get('id')),
            'walikelas'        => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'            => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'               => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'          => $pembina,
            'siswa'            => $this->anggota->where('extra', $pembina->extra)->findAll(),
            'count_siswa'      => $this->siswa->where('kelas', $pembina->extra)->countAllResults(),
            'absensi_kegiatan' => $absensi_kegiatan,
            'tahun_pelajaran'  => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        return view('pembina/absensi', $data);
    }

    public function update()
    {
        $post = [
            'id'      => $_POST['id'],
            'absensi' => $_POST['absensi'],
        ];

        $this->absensi_kegiatan->save($post);
        return true;
    }

    public function notifikasi($tgl, $tp1,$smt,$extra)
    {
        $setting = $this->setting;
        $pesan = $setting->text_message2;
        $wa_url = $setting->wa_api_url;
        $wa_key = $setting->wa_api_key;

        $pembina = $this->pembina->where(['guru' => session()->get('id')])->first();

        $tanggal = $tgl;
         //$extra = $ekstra;
        $tahun_pelajaran = $tp1;
        $semester = $smt;

        $admin = $this->admin->find(session()->get('id'));

        $absensi = $this->absensi_kegiatan->select('absensi_kegiatan.*, siswa.nama, siswa.whatsapp_siswa, siswa.whatsapp_wali')
        ->where(['absensi_kegiatan.tanggal' => $tanggal, 'absensi_kegiatan.tahun_pelajaran' => $tahun_pelajaran, 'absensi_kegiatan.semester' => $semester, 'absensi_kegiatan.extra' => $pembina->extra])
        ->join('siswa', 'siswa.id=absensi_kegiatan.siswa')->findAll();

        foreach ($absensi as $abs) {
            if ($abs->absensi == 'h') {
                $status = 'HADIR';
            } else if ($abs->absensi == 's') {
                $status = 'SAKIT';
            } else if ($abs->absensi == 'i') {
                $status = 'IZIN';
            } else if ($abs->absensi == 'a') {
                $status = 'ALPHA';
            }

            $search  = array('{tanggal}', '{nama}', '{extra}', '{status}', '{nama_pembina}', '{nomor_pembina}');
            $replace = array($tanggal, $abs->nama, $extra, $status, $admin->nama, $admin->whatsapp);

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

           
           // curl_exec($curl);
            $res = json_decode(curl_exec($curl));
            curl_close($curl);

           // $response = curl_exec($curl);

          //curl_close($curl);
    
           // $res = json_decode($response);
    
    
            if ($res->code == 200) {
            }
          
        }

        return redirect()->to(base_url('pembina/absensi_ekstra?tanggal=' . $tanggal . '&tahun_pelajaran=' . $tahun_pelajaran . '&semester=' . $semester. '&extra=' . $extra));
    
    }

public function delete($tgl,$th,$smt,$extra)
        {
        //$id_mapel = $_GET['id_mk'];
       // $kelas = $_GET['extra'];
      // end();
       //$pembina =  $admin = $this->admin->find(session()->get('id'));
        $id_wali = session()->get('id');
        if ($this->absensi_kegiatan->where(['tanggal'=>$tgl])->delete()) {
          
                session()->setFlashdata('success', 'Data berhasil di hapus.');
                return redirect()->to(base_url('pembina/absensi_ekstra?extra='.$extra.'&tanggal='.$tgl. '&tahun_pelajaran=' . $th . '&semester=' . $smt));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('pembina/absensi_ekstra?extra='.$extra.'&tanggal='.$tgl. '&tahun_pelajaran=' . $th . '&semester=' . $smt));
            }
        }
}

<?php

namespace App\Controllers\Walikelas;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\JadwalModel;



class Absensi extends BaseController
{
    protected $admin;
    protected $walikelas;
    protected $absensi;
    protected $siswa;
    protected $jadwal;
    
    protected $tahun_pelajaran;

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
        if (session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $walikelas = $this->walikelas->where(['guru' => session() ->get('id'),
        'tahun_pelajaran'=> $this->tp->tahun])->join('admin', 'admin.id=walikelas.guru')->first();
       //$admin  = $this->admin->find(session()->get('id'));
        //$mk = $this->jadwal->where(['id_mengajar' => $_GET['mk']]);
         
                   

        if (isset($_GET['tanggal'])) {
            if ($_GET['tanggal'] > date("Y-m-d")) {
                session()->setFlashdata('error', 'Absensi tidak boleh melebihi tanggal hari ini.');
                return redirect()->to(base_url('walikelas/absensi?id_mk='.$_GET['id_mk'].'&id_kls='.$_GET['id_kls']));
            }
           // $kls   = $this->request->getPost('id_kls');
           $id_wali = session()->get('id');
            $cek = $this->absensi->where(['tanggal' => $_GET['tanggal'], 'walikelas'=>$id_wali, 'absensi.id_mengajar' => $_GET['id_mk'] ,'kelas' =>  $_GET['id_kls'], 'tahun_pelajaran' => $_GET['tahun_pelajaran'], 'semester' => $_GET['semester']])->countAllResults();

            if ($cek == 0) {
                $siswa = $this->siswa->where('kelas', $_GET['id_kls'])->findAll();
                $data = array();
                foreach ($siswa as $s) {
                    $data[] = [
                        'walikelas' => session()->get('id'),
                        'id_mengajar' => $_GET['id_mk'],
                        'tanggal'   => $_GET['tanggal'],
                        'kelas'     => $_GET['id_kls'],
                        'siswa'     => $s->id,
                        'absensi'   => 'h',
                        'tahun_pelajaran' => $_GET['tahun_pelajaran'],
                        'semester'   => $_GET['semester'],
                    ];
                }
                $this->absensi->insertBatch($data);
            }

            $absensi = $this->absensi->select('absensi.*, siswa.nama')
            ->where(['absensi.tanggal' => $_GET['tanggal'],'walikelas'=>$id_wali,'absensi.id_mengajar' => $_GET['id_mk'] ,'absensi.kelas' => $_GET['id_kls']])
            ->join('siswa', 'siswa.id=absensi.siswa')
            ->orderBy('siswa.nama', 'asc')->findAll();
        }
        if (!empty($absensi)) {
            $absensi = $absensi;
        } else {
            $absensi = 0;
        }
        
        
        $data = [
            'title'           => 'Input Absensi',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'mk'              => $this->jadwal->where('id_mengajar', $_GET['id_mk'])
                                ->join('tb_mapel', 'tb_mapel.id=tb_mengajar.id_mapel')->findAll(),
            'walikelas'       => $walikelas,
            //'mk'              => $mk,
            'piket'           => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'              => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'         => $this->pembina->where('guru', session()->get('id'))->first(),
            'siswa'           => $this->siswa->where('kelas',$_GET['id_kls'])->findAll(),
            'count_siswa'     => $this->siswa->where('kelas',$_GET['id_kls'])->countAllResults(),
            'absensi'         => $absensi,
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
    
            'tahun_pelajaran_aktif' => $this->tahun_pelajaran->where('aktif',1)->groupBy('tahun')->findAll(),
        ];

        return view('walikelas/absensi', $data);
    }

    public function update()
    {
        $post = [
            'id'      => $_POST['id'],
            'absensi' => $_POST['absensi'],
        ];

        if ($_POST['absensi'] == 'a') {
            $poin = [
                'tanggal' => $_POST['tanggal'],
                'siswa'   => $_POST['siswa'],
                'poin'    => 2,
            ];
            $this->pelanggaran_siswa->save($poin);
        } else {
            $db = db_connect();
            $db->table('pelanggaran_siswa')->where(['tanggal' => $_POST['tanggal'], 'siswa' => $_POST['siswa']])->delete();
        }

        $this->absensi->save($post);
        return true;
    }

    public function notifikasi_siswa($tgl, $kls, $siswa,$id_mk,$pel,$waktu,$jam,$jamke)
    {
        $setting = $this->setting;
        $pesan = $setting->text_message1;
        $wa_url = $setting->wa_api_url;
        $wa_key = $setting->wa_api_key;

        //$mapel = $this->jadwal->where(['id_mengajar' => session()->get('id_mengajar')])->first();
        $walikelas = $this->walikelas->where(['guru' => session()->get('id')])->first();

        //$pelajaran = $id_mk;
        $mk  = $this->jadwal ->select('tb_mengajar.*, tb_mengajar.id_mengajar, tb_mengajar.hari , tb_mengajar.jam_mengajar , tb_mengajar.kelas, tb_mengajar.jamke,tb_mapel.mapel')
        ->where(['id_mengajar', 24])
        ->join('tb_mapel', 'tb_mapel.id=tb_mengajar.id_mapel');
       
        $tanggal = $tgl;

        $admin = $this->admin->find(session()->get('id'));
        //$admin = $_GET['id_mk'];
       
        $kls   = $this->request->getPost('kelas');
        $id_wali = session()->get('id');
        $absensi = $this->absensi->select('absensi.*, siswa.nama, siswa.whatsapp_siswa, siswa.whatsapp_wali')
        ->where(['absensi.tanggal' => $tanggal, 'walikelas'=>$id_wali,'absensi.siswa' => $siswa])
        ->join('siswa', 'siswa.id=absensi.siswa')->findAll();

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

            $search  = array('{tanggal}', '{nama}', '{kelas}', '{status}','{mapel}','{hari}','{jam}','{jamke}', '{nama_walikelas}', '{nomor_walikelas}');
            $replace = array($tanggal, $abs->nama, $abs->kelas, $status, $pel,$waktu,$jam,$jamke,$admin->nama, $admin->whatsapp);

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

            if ($res->code == 200) {
                $post = [
                    'id'         => $abs->id,
                    'notifikasi' => 1,
                ];
            } else if ($res->code == 400) {
                $post = [
                    'id'         => $abs->id,
                    'notifikasi' => 0,
                ];
            }

            $this->absensi->save($post);
        }

        return redirect()->to(session()->get()['_ci_previous_url']);
    }

    public function notifikasi($tgl,$tp1, $tp2, $smt,$id_mk, $kls,$pel,$waktu,$jam,$jamke)
    {
        $setting = $this->setting;
        $pesan = $setting->text_message1;
        $wa_url = $setting->wa_api_url;
        $wa_key = $setting->wa_api_key;

        $mk  = $this->jadwal->select('tb_mengajar.*, tb_mengajar.jam_mengajar, tb_mengajar.hari, tb_mengajar.jamke,tb_mapel.mapel')
        ->where('id_mengajar', $id_mk)
        ->join('tb_mapel', 'tb_mapel.id=tb_mengajar.id_mapel')->findAll();

       $walikelas = $this->walikelas->where(['guru' => session()->get('id')])->first();
      
        //$harii =  $hari;

        $tanggal = $tgl;
        $tahun_pelajaran = $tp1 . '/' . $tp2;
        $semester = $smt;

        $admin = $this->admin->find(session()->get('id'));
        $kelas   = $kls;
        $absensi = $this->absensi->select('absensi.*, siswa.nama, siswa.whatsapp_siswa, siswa.whatsapp_wali')
        ->where(['absensi.tanggal' => $tanggal, 'absensi.tahun_pelajaran' => $tahun_pelajaran, 'absensi.semester' => $semester, 'absensi.kelas' => $kls])
        ->join('siswa', 'siswa.id=absensi.siswa')->findAll();

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

            $search  = array('{tanggal}', '{nama}', '{kelas}', '{status}','{mapel}','{hari}','{jam}','{jamke}','{nama_walikelas}', '{nomor_walikelas}');
            $replace = array($tanggal, $abs->nama, $abs->kelas, $status, $pel,$waktu,$jam,$jamke,$admin->nama, $admin->whatsapp);

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

            if ($res->code == 200) {
                $post = [
                    'id'         => $abs->id,
                    'notifikasi' => 1,
                    

                ];
            } else if ($res->code == 400) {
                $post = [
                    'id'         => $abs->id,
                    'notifikasi' => 0,
                ];
            }

            $this->absensi->save($post);
           
        }
        //return redirect()->to(session()->get()['_ci_previous_url']);
    return redirect()->to(base_url('walikelas/absensi?tanggal=' . $tanggal . '&tahun_pelajaran=' . $tahun_pelajaran . '&semester=' . $semester. '&id_mk=' .$id_mk.'&id_kls=' .$kls));
       
    }
    
     public function delete($tgl)
    {
      $id_mapel = $_GET['id_mk'];
      $kelas = $_GET['id_kls'];
       $id_wali = session()->get('id');
       if ($this->absensi->where(['walikelas'=>$id_wali,'id_mengajar'=>$id_mapel,'kelas'=>$kelas, 'tanggal'=>$tgl])->delete()) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('walikelas/absensi?id_mk='.$_GET['id_mk'].'&id_kls='.$_GET['id_kls']));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('walikelas/absensi?id_mk='.$_GET['id_mk'].'&id_kls='.$_GET['id_kls']));
        }
    }
}

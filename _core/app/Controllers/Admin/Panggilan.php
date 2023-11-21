<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\PanggilanModel;
use App\Models\EdaranModel;

class Panggilan extends BaseController
{
    protected $admin;
    protected $walikelas;
    protected $absensi;
    protected $siswa;
    protected $tahun_pelajaran;
    protected $panggilan;
    protected $edaran;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        $this->walikelas       = new WalikelasModel();
        $this->absensi         = new AbsensiModel();
        $this->siswa           = new SiswaModel();
        $this->edaran           = new EdaranModel();
        $this->tahun_pelajaran = new Tahun_pelajaranModel();
        $this->panggilan       = new PanggilanModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'           => 'Kirim Informasi/Edaran',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'kelas'           => $this->siswa->groupBy('kelas')->findAll(),
            'siswa'           => $this->siswa->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        return view('admin/panggilan', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('edaran')->orderBy('edaran.id', 'desc');

        return DataTable::of($builder)
            ->add('kelas', function ($row) {
                return $row->kelas;
            })
            ->add('text', function ($row) {
                return $row->text;
            })
            ->add('file', function ($row) {
                return ' <a href="' . base_url('uploads/' . $row->file) . '" class="badge bg-warning">Download</a>';
            })
            ->add('action', function ($row) {
                return '<a href="' . base_url('admin/panggilan/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function notifikasi()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        $siswa =  $this->siswa->select('kelas')->groupBy('kelas')->findAll();
       // 'id_mengajar'             => $this->request->getVar('id'),
        $setting = $this->setting;
        $pesan   = $this->request->getPost('text_message6');
        $kls   = $this->request->getPost('kelas');
        $tgl= date("Y-m-d");
        $wa_url  = $setting->wa_api_url;
        $wa_key  = $setting->wa_api_key;

       // $dataBerkas = $this->request->getFile('file');
       // $fileName   = $dataBerkas->getRandomName();
      //  $dataBerkas->move('uploads/',$fileName);
        $absensi = $this->siswa->select('siswa.*, siswa.nama, siswa.whatsapp_siswa, siswa.whatsapp_wali')
        ->where(['siswa.kelas' => $kls ])->findAll();

    foreach ($absensi as $abs) {
        $search  = array('{kelas}','{nomor_walikelas}');
        $replace = array($abs->kelas, $abs->whatsapp_wali);

        $msg = str_replace($search, $replace, $pesan);

        $curl2 = curl_init();

        curl_setopt_array($curl2, array(
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
                    "body": ' . json_encode($pesan) . '
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $wa_key,
                'Content-Type: application/json'
            ),
        ));

        $response2 = curl_exec($curl2);

        curl_close($curl2);

  //      $curl = curl_init();

    //    curl_setopt_array($curl, array(
     //       CURLOPT_URL            => $wa_url,
     //       CURLOPT_RETURNTRANSFER => true,
    //        CURLOPT_ENCODING       => '',
     //       CURLOPT_MAXREDIRS      => 10,
      //      CURLOPT_TIMEOUT        => 0,
      //      CURLOPT_FOLLOWLOCATION => true,
       //     CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
      //      CURLOPT_SSL_VERIFYHOST => 0,
       //     CURLOPT_SSL_VERIFYPEER => 0,
      //      CURLOPT_CUSTOMREQUEST  => 'POST',
       //     CURLOPT_POSTFIELDS     => '{
       //         "recipient_type": "individual",
      //          "to": "' . $abs->whatsapp_wali . '",
       //         "type": "document",
         //       "document": {
          //          "link": "'.base_url('uploads/'.$fileName).'"
            //    }
          //  }',
    //        CURLOPT_HTTPHEADER => array(
      //          'Authorization: Bearer ' . $wa_key,
        //        'Content-Type: application/json'
          //  ),
    //    ));

       // $response = curl_exec($curl);

       // curl_close($curl);

        $res = json_decode($response2);


        if ($res->code == 200) {

           
        }
      else {
            session()->setFlashdata('error', 'GAGAL mengirim surat panggilan');
            return redirect()->to(session()->get()['_ci_previous_url']);
        }
    }
    $data = [
        'kelas'           => $kls,
       // 'file'            => $fileName,
        'text'           => $pesan,
        'tanggal'           => $tgl,
    ];

    if ($this->edaran->save($data)) {
        session()->setFlashdata('success', 'Surat panggilan berhasil di kirim.');
        return redirect()->to(session()->get()['_ci_previous_url']);
    } else {
        session()->setFlashdata('error', 'GAGAL mengirim surat panggilan');
        return redirect()->to(session()->get()['_ci_previous_url']);
    }

    }

    public function delete($id)
    {
        if ($this->edaran->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/panggilan'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/panggilan'));
        }
    }
}
    


<?php

namespace App\Controllers\Bp;

use \Hermawan\DataTables\DataTable;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\AbsensiModel;
use App\Models\SiswaModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\PanggilanModel;

class Panggilan extends BaseController
{
    protected $admin;
    protected $walikelas;
    protected $absensi;
    protected $siswa;
    protected $tahun_pelajaran;
    protected $panggilan;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        $this->walikelas       = new WalikelasModel();
        $this->absensi         = new AbsensiModel();
        $this->siswa           = new SiswaModel();
        $this->tahun_pelajaran = new Tahun_pelajaranModel();
        $this->panggilan       = new PanggilanModel();
    }

    public function index()
    {
        if (session()->get('logged_bp') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'           => 'Surat Panggilan',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'walikelas'       => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'           => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'              => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'         => $this->pembina->where('guru', session()->get('id'))->first(),
            'kelas'           => $this->siswa->groupBy('kelas')->findAll(),
            'siswa'           => $this->siswa->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        return view('bp/panggilan', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('panggilan')
            ->select('panggilan.id, panggilan.tahun_pelajaran, panggilan.semester, panggilan.file, panggilan.jenis, siswa.nama, siswa.kelas')
            ->join('siswa', 'siswa.id=panggilan.siswa')
            ->orderBy('panggilan.id', 'desc');

        return DataTable::of($builder)
            ->add('tp', function ($row) {
                return $row->tahun_pelajaran . '/' . $row->semester;
            })
            ->add('file', function ($row) {
                return '<a href="' . base_url('uploads/' . $row->file) . '" class="badge bg-warning">Download</a>';
            })
            ->add('action', function ($row) {
                return '<a href="' . base_url('bp/panggilan/delete/' . $row->id) . '" class="btn btn-sm btn-danger text-white" onclick="return confirm(\'Yakin?\')">Delete</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function panggilan()
    {
        if (session()->get('logged_bp') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }
        $siswa = $this->siswa->find($this->request->getVar('siswa'));

        $setting = $this->setting;
        $pesan   = $setting->text_message3;
        $wa_url  = $setting->wa_api_url;
        $wa_key  = $setting->wa_api_key;

        $dataBerkas = $this->request->getFile('file');
        $fileName   = $dataBerkas->getRandomName();
        $dataBerkas->move('uploads/', $fileName);

        $search  = array('{nama}');
        $replace = array($siswa->nama);

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
                "to": "' . $siswa->whatsapp_wali . '",
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

        $response2 = curl_exec($curl2);

        curl_close($curl2);

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
                "to": "' . $siswa->whatsapp_wali . '",
                "type": "document",
                "document": {
                    "link": "' . base_url('uploads/' . $fileName) . '"
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $wa_key,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($response);


        if ($res->code == 200) {

            $data = [
                'siswa'           => $this->request->getVar('siswa'),
                'file'            => $fileName,
                'tahun_pelajaran' => $this->tp->tahun,
                'semester'        => $this->tp->semester,
                'jenis'           => 'umum',
            ];

            if ($this->panggilan->save($data)) {
                session()->setFlashdata('success', 'Surat panggilan berhasil di kirim.');
                return redirect()->to(session()->get()['_ci_previous_url']);
            } else {
                session()->setFlashdata('error', 'GAGAL mengirim surat panggilan');
                return redirect()->to(session()->get()['_ci_previous_url']);
            }
        } else {
            session()->setFlashdata('error', 'GAGAL mengirim surat panggilan');
            return redirect()->to(session()->get()['_ci_previous_url']);
        }
    }
}

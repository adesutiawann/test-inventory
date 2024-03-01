<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AsetModel;
use App\Models\RiwayatModel;

use App\Models\ManufactureModel;
use App\Models\TypeModel;
use App\Models\ProsesorModel;
use App\Models\GenerasiModel;
use App\Models\HddModel;
use App\Models\RamModel;
use App\Models\RincianModel;
use App\Models\StatusModel;
use App\Models\StokModel;
use App\Models\KondisiModel;
use App\Models\ImagesModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class leptop extends BaseController
{
    protected $admin;
    protected $aset;
    protected $riwayat;
    protected $manufacture;
    protected $type;
    protected $prosesor;
    protected $generasi;
    protected $hdd;
    protected $ram;
    protected $rincian;
    protected $status;
    protected $stok;
    protected $kondisi;
    protected $images;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->aset = new AsetModel();
        $this->riwayat = new RiwayatModel;
        $this->manufacture = new ManufactureModel;
        $this->type = new TypeModel;
        $this->prosesor = new ProsesorModel;
        $this->generasi = new GenerasiModel;
        $this->hdd = new HddModel;
        $this->ram = new RamModel;
        $this->rincian = new RincianModel;
        $this->status = new StatusModel;
        $this->stok = new StokModel;
        $this->kondisi = new KondisiModel;
        $this->images = new ImagesModel;
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Persediaan / leptop',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'aktiv'   => 'ALL',
            'aset' => $this->aset->where('type', 'leptop')->orderBy('id', 'desc')->findAll(),

            // 'aset' => $this->aset->where('type', 'leptop')->where('kondisi', $id)->orderBy('id', 'desc')->findAll(),

            'total_leptop' => $this->aset->where('type', 'leptop')->countAllResults(),
            'total_leptop_ok' => $this->aset->where('type', 'leptop')->where('kondisi', 'OK')->countAllResults(),
            'total_leptop_rusak' => $this->aset->where('type', 'leptop')->where('kondisi', 'rusak')->countAllResults(),
            'total_leptop_blanks' => $this->aset->where('type', 'leptop')->where('kondisi', 'blanks')->countAllResults(),

        ];

        return view('admin/leptop', $data);
    }



    public function cetakqrcode()
    {
        if (session()->get('logged_admin') !== true) {
            return redirect()->to(base_url());
        }

        $cari = $this->request->getVar('cari');
        $tglin = $this->request->getVar('tglin');
        $tglout = $this->request->getVar('tglout');

        // Inisialisasi Query Builder untuk data aset utama
        $asetQuery = $this->aset->where('type', 'pc');

        // Filter berdasarkan kriteria pencarian
        if ($cari) {
            $asetQuery->groupStart()
                ->orWhere('serial', $cari)
                ->orWhere('manufacture', $cari)
                ->groupEnd();
        }

        // Filter berdasarkan rentang tanggal
        if ($tglin && $tglout) {
            $asetQuery->where('tgl_masuk>=', $tglin)
                ->where('tgl_keluar <=', $tglout);
        }

        // Urutkan hasil query
        $asetQuery->orderBy('id', 'desc');

        // Data yang akan dikirim ke view
        $data = [
            'title'        => 'Print/QRcode',
            'segment'      => $this->request->uri->getSegments(),
            'admin'        => $this->admin->find(session()->get('id')),
            'aktiv'        => 'ALL',
            'aset'         => $asetQuery->findAll(),
            'total_pc'     => $this->aset->where('type', 'pc')->countAllResults(),
            'total_pc_ok'  => $this->getTotalByCondition('OK'),
            'total_pc_rusak' => $this->getTotalByCondition('rusak'),
            'total_pc_blanks' => $this->getTotalByCondition('blanks'),
        ];

        return view('admin/cetakqrcode', $data);
    }

    public function cetakpdf()
    {
        if (session()->get('logged_admin') !== true) {
            return redirect()->to(base_url());
        }

        $cari = $this->request->getVar('cari');
        $tglin = $this->request->getVar('tglin');
        $tglout = $this->request->getVar('tglout');

        // Inisialisasi Query Builder untuk data aset utama
        $asetQuery = $this->aset->where('type', 'pc');

        // Filter berdasarkan kriteria pencarian
        if ($cari) {
            $asetQuery->groupStart()
                ->orWhere('serial', $cari)
                ->orWhere('manufacture', $cari)
                ->groupEnd();
        }

        // Filter berdasarkan rentang tanggal
        if ($tglin && $tglout) {
            $asetQuery->where('tgl_masuk>=', $tglin)
                ->where('tgl_keluar <=', $tglout);
        }

        // Urutkan hasil query
        $asetQuery->orderBy('id', 'desc');

        // Data yang akan dikirim ke view
        $data = [
            'title'        => 'Print/QRcode',
            'segment'      => $this->request->uri->getSegments(),
            'admin'        => $this->admin->find(session()->get('id')),
            'aktiv'        => 'ALL',
            'aset'         => $asetQuery->findAll(),
            'total_pc'     => $this->aset->where('type', 'pc')->countAllResults(),
            'total_pc_ok'  => $this->getTotalByCondition('OK'),
            'total_pc_rusak' => $this->getTotalByCondition('rusak'),
            'total_pc_blanks' => $this->getTotalByCondition('blanks'),
        ];
        if (isset($_GET['excel'])) {
            return view('admin/cetakexcel', $data);
        } else {
            return view('admin/cetakpdf', $data);
        }
    }

    // Helper method to get total by condition
    private function getTotalByCondition($condition)
    {
        return $this->aset->where('type', 'pc')->where('kondisi', $condition)->countAllResults();
    }


    public function search($id)
    {
        $data = [
            'title'   => 'Data leptop',
            'aktiv'   => $id,
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'aset' => $this->aset->where('type', 'leptop')->where('kondisi', $id)->orderBy('id', 'desc')->findAll(),

            'total_leptop' => $this->aset->where('type', 'leptop')->countAllResults(),
            'total_leptop_ok' => $this->aset->where('type', 'leptop')->where('kondisi', 'OK')->countAllResults(),
            'total_leptop_rusak' => $this->aset->where('type', 'leptop')->where('kondisi', 'RUSAK')->countAllResults(),
            'total_leptop_blanks' => $this->aset->where('type', 'leptop')->where('kondisi', 'BLANK')->countAllResults(),
            //'aset'    => $this->aset->getId($id),

        ];
        return view('admin/leptop', $data);
    }

    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Persediaan/Pc/Add',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            'type' => $this->type->where('nama', 'pc')->orderBy('nama', 'asc')->findAll(),
            'prosesor'    => $this->prosesor->orderBy('nama', 'asc')->findAll(),
            'generasi'    => $this->generasi->orderBy('nama', 'asc')->findAll(),
            'hdd'    => $this->hdd->orderBy('nama', 'asc')->findAll(),
            'ram'    => $this->ram->orderBy('nama', 'asc')->findAll(),
            'rincian'    => $this->rincian->orderBy('nama', 'asc')->findAll(),
            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),
        ];
        return view('admin/leptopadd', $data);
    }
    public function view($id)
    {
        // Check if the admin is logged in
        if (!session()->get('logged_admin')) {
            return redirect()->to(base_url());
        }

        // Find the asset by its serial number
        $aset = $this->aset->where('serial', $id)->first();

        // Redirect if the asset is not found
        if (!$aset) {
            session()->setFlashdata('error', 'Asset not found.');
            return redirect()->to(base_url());
        }

        // Retrieve additional data
        $manufacture = $aset->manufacture; // Assuming $aset is returned as an array

        $data = [
            'title' => 'Persediaan/Pc/Details',
            'segment' => $this->request->uri->getSegments(),
            'admin' => $this->admin->find(session()->get('id')),
            'aset' => $aset,
            'jumlahmanufaktur' => $this->aset->where('stock', 'Tersedia')
                ->where('type', 'PC')
                ->where('manufacture', $manufacture)
                ->countAllResults(),
            'images' => $this->images->where('serial', $id)->findAll(),
            'riwayat' => $this->riwayat->where('serial', $id)->orderBy('id', 'desc')->findAll(),
        ];

        // Load the view with the data
        return view('admin/view', $data);
    }



    public function edit($id)
    {
        // $tgl= date("Y-m-d");
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        //$aset  = $this->aset->find($id);
        //$serialx = $aset->serial;
        $aset = $this->aset->where('serial', $id)->first();
        $data = [
            'title'   => 'Persediaan/Pc/Edit',
            'edit'   => 'redy',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            'nama2'   => $this->aset->groupBy('manufacture')->findAll(),


            'type' => $this->type->where('nama', 'pc')->orderBy('nama', 'asc')->findAll(),
            'prosesor'    => $this->prosesor->orderBy('nama', 'asc')->findAll(),
            'generasi'    => $this->generasi->orderBy('nama', 'asc')->findAll(),
            'hdd'    => $this->hdd->orderBy('nama', 'asc')->findAll(),
            'ram'    => $this->ram->orderBy('nama', 'asc')->findAll(),
            'rincian'    => $this->rincian->orderBy('nama', 'asc')->findAll(),
            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),
            // 'aset'    => $this->aset->where('serial', $id)->findAll(),
            'aset'    => $aset,
            'images' => $this->images->where('serial', $id)->findAll(),
            'riwayat' => $this->riwayat->where('serial', $id)->orderBy('id', 'desc')->findAll(),
        ];
        return view('admin/leptopedit', $data);
    }

    public function save()
    {
        //if (isset($_POST['Simpan'])) {


        // $tgl = date("Y-m-d");
        if ($this->request->getVar('id')) {
            //$tgl = date("Y-m-d");
            $idlink = $this->request->getVar('serial');
            $post = [
                'id'       => $this->request->getVar('id'),
                'manufacture'            => $this->request->getVar('manufacture'),
                // 'type'            => $this->request->getVar('type'),
                'prosesor'            => $this->request->getVar('prosesor'),
                'generasi'            => $this->request->getVar('generasi'),
                'hdd'            => $this->request->getVar('hdd'),
                'ram'            => $this->request->getVar('ram'),
                'rincian'            => $this->request->getVar('rincian'),
                'status'            => $this->request->getVar('status'),
                'stock'            => $this->request->getVar('stock'),
                'kondisi'            => $this->request->getVar('kondisi'),
                'ket'            => $this->request->getVar('ket'),
                'tgl_masuk'            => $this->request->getVar('masuk'),
                'tgl_keluar'            => $this->request->getVar('keluar'),
                'serial'            => $this->request->getVar('serial'),
                'user'            => $this->request->getVar('user'),
                'lokasi'            => $this->request->getVar('lokasi'),
            ];

            $tgl = date("Y-m-d H:i:s");
            // $admin = $this->Admin_model->find($this->session->userdata('id'));
            $admin   = $this->admin->find(session()->get('id'));
            $postx = [
                //'id'       => $this->request->getVar('id'),      

                'serial'            => $this->request->getVar('serial'),
                'tgl'            => $tgl,
                'ket'            => $this->request->getVar('ketupdate'),
                'user'            => $this->request->getVar('user'),
                'lokasi'            => $this->request->getVar('lokasi'),
                //'teknisi'   => $this->admin->find(session()->get('id')),
                'teknisi'   => $admin->nama,
            ];

            if ($this->aset->save($post) &&   $this->riwayat->save($postx)) {
                //saveriwayat();
                if (!empty($_FILES['foto']['name'][0])) {
                    $tgl = date("Y-m-d");
                    $files = $this->request->getFileMultiple('foto');
                    $namaFiles = []; // Array untuk menyimpan nama-nama file

                    foreach ($files as $file) {
                        $nama = $file->getRandomName();
                        $file->move('uploads/kegiatan/', $nama);

                        // Simpan nama file ke dalam array
                        $namaFiles[] = $nama;
                    }

                    // Persiapkan data untuk disimpan ke dalam database
                    foreach ($namaFiles as $nama) {
                        $postData = [
                            'tgl' => $tgl,
                            'serial' => $this->request->getVar('serial'),
                            'image' => $nama,
                        ];

                        // Simpan data ke dalam database
                        if ($this->images->insert($postData) === false) {
                            session()->setFlashdata('error', 'Data gagal disimpan.');
                            return redirect()->to(base_url('admin/leptop/edit/' . $idlink));
                        }
                    }

                    session()->setFlashdata('success', 'Upload foto berhasil.');
                    return redirect()->to(base_url('admin/leptop/edit/' . $idlink));
                }
                session()->setFlashdata('success', 'Data berhasil di edit.');
                return redirect()->to(base_url('admin/leptop/edit/' . $idlink));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/leptop/edit/' . $idlink));
            }
        } else {
            // $tgl= date("Y-m-d");
            $post = [
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => 'PC',
                'prosesor'            => $this->request->getVar('prosesor'),
                'generasi'            => $this->request->getVar('generasi'),
                'hdd'            => $this->request->getVar('hdd'),
                'ram'            => $this->request->getVar('ram'),
                'rincian'            => $this->request->getVar('rincian'),
                'status'            => $this->request->getVar('status'),
                'stock'            => $this->request->getVar('stock'),
                'kondisi'            => $this->request->getVar('kondisi'),
                'ket'            => $this->request->getVar('ket'),
                'tgl_masuk'            => $this->request->getVar('masuk'),
                'tgl_keluar'            => $this->request->getVar('keluar'),
                'serial'            => $this->request->getVar('serial'),

            ];

            if ($this->aset->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di simpan.');
                return redirect()->to(base_url('admin/leptop'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/leptop'));
            }
        }
    }


    public function process()
    {
        // Validate the form data (add validation rules as needed)
        $validation = \Config\Services::validation();
        $validation->setRules([
            'images' => 'uploaded[images]|max_size[images,10240]|mime_in[images,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/upload')->withInput()->with('errors', $validation->getErrors());
        }

        // Handle image upload
        $uploadedFiles = $this->request->getFiles('images');

        foreach ($uploadedFiles as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('./assets/images/aset/', $newName);
                // You can save the file name or other relevant information to the database here
            }
        }

        session()->setFlashdata('success', 'Data berhasil di edit.');
        return redirect()->to(base_url('admin/leptop'));
    }

    public function saveriwayat()
    {
        // $tgl = date("Y-m-d");
        // if ($this->request->getVar('id')) {
        $tgl = date("Y-m-d");

        $post = [
            //'id'       => $this->request->getVar('id'),      

            'serial'            => $this->request->getVar('serial'),
            'tgl'            => $tgl,
            'ket'            => $this->request->getVar('ketupdate'),
            'user'            => $this->request->getVar('user'),
            'lokasi'            => $this->request->getVar('lokasi'),
            //'teknisi'   => $this->admin->find(session()->get('id')),
            'teknisi'   => 'Ade Sutiawan',
        ];

        if ($this->riwayat->save($post)) {

            //  $this->riwayat->save($postr);
            session()->setFlashdata('success', 'Data berhasil di edit.');
            return redirect()->to(base_url('admin/leptop'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/leptop'));
        }
    }

    public function saveedit()
    {

        $tgl = date("Y-m-d");

        $post = [
            'id'       => $this->request->getVar('id'),
            'nama'            => $this->request->getVar('nama'),
            'tgl'           => $tgl,
            //'tahun_pelajaran' => $this->tp->tahun,
        ];

        if ($this->aset->save($post)) {
            session()->setFlashdata('success', 'Data berhasil di edit.');
            return redirect()->to(base_url('admin/leptop'));
        } else {
            session()->setFlashdata('error', 'Data Gagal di simpan.');
            return redirect()->to(base_url('admin/leptop'));
        }
    }
    public function delete($id)
    {
        if ($this->aset->delete($id)) {
            session()->setFlashdata('hapussuccess', 'a');
            return redirect()->to(base_url('admin/leptop'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/leptop'));
        }
    }
    public function deleteall($id)
    {
        // if ($this->aset->deleteByType($id)) {
        if ($this->aset->where('type', $id)->delete()) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/leptop'));
        } else {
            session()->setFlashdata('danger', 'Data gagal di hapus.');
            return redirect()->to(base_url('admin/leptop'));
        }
    }
    public function deleteriwayat($id, $id2)
    {
        if ($this->riwayat->delete($id)) {
            session()->setFlashdata('success', 'Data Riwayat berhasil di hapus.');
            return redirect()->to(base_url('admin/leptop/edit/' . $id2));
        } else {
            session()->setFlashdata('danger', 'Data Gagal berhasil di hapus.');
            return redirect()->to(base_url('admin/leptop/edit/' . $id2));
        }
    }

    public function deleteimagesaa($id, $id2)
    {
        if ($this->images->delete($id)) {
            session()->setFlashdata('success', 'Foto berhasil di hapus.');
            return redirect()->to(base_url('admin/leptop/edit/' . $id));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/leptop/edit/' . $id));
        }
    }

    public function deleteimages($id, $id2)
    {
        // Assuming you have a model method to get the image record based on $id
        $img = $this->images->find($id);

        if ($img) {
            $filePath = 'uploads/kegiatan/' . $img->image; // Assuming the filename field stores the image name

            // Check if the file exists and then try to delete it

            if (unlink($filePath)) {
                // Only delete the database record if the file deletion was successful
                if ($this->images->delete($id)) {
                    session()->setFlashdata('success', 'Foto dan data berhasil dihapus.');
                } else {
                    session()->setFlashdata('error', 'Gagal menghapus data.');
                }
            } else {
                session()->setFlashdata('error', 'Gagal menghapus file.');
            }
        } else {
            session()->setFlashdata('error', 'Data tidak ditemukan.');
        }

        return redirect()->to(base_url('admin/leptop/edit/' . $id2));
    }





    public function import()
    {
        $file = $this->request->getFile('file_excel');
        $extension = $file->getClientExtension();

        if ($extension == 'xlsx' || $extension == 'xls') {

            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheed = $reader->load($file);
            $contak = $spreadsheed->getActiveSheet()->toArray();
            //print_r($contak);
            foreach ($contak as $key => $value) {
                if ($key == 0) {
                    continue;
                }
                $data = [

                    'tgl_masuk' => $value[1],
                    'tgl_keluar' => $value[2],
                    'serial' => $value[3],

                    'manufacture'    => $value[4],
                    'type'    => 'Leptop',
                    'prosesor'    => $value[5],
                    'generasi'    => $value[6],

                    'hdd' => $value[7],
                    'ram'    => $value[8],
                    'rincian'    => $value[9],
                    'status' => $value[10],
                    'stock'    => $value[11],
                    'kondisi' => $value[12],

                    'user' => $value[13],
                    'lokasi' => $value[14],
                    'ket' => $value[15],
                ];
                $this->aset->insert($data);
            }
            session()->setFlashdata('success', 'Data Berhasil di Import.');
            return redirect()->to(base_url('admin/leptop'));
        } else {
            session()->setFlashdata('error', 'Format file tidak didukung; hanya format file <b>.xls</b> dan <b>.xlsx</b> yang diizinkan.');
            return redirect()->to(base_url('admin/leptop'));
        }
    }
    public function downloadExcel()
    {
        // $file = 'public/Ex_pc.csv';
        $file = 'assets/Exel/Ex.Import file data pc .xlsx';

        $response = $this->response
            ->download($file, null)
            ->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return $response;
    }
    public function export()
    {
        if (session()->get('logged_admin') !== true) {
            return redirect()->to(base_url());
        }

        $cari = $this->request->getVar('cari');
        $tglin = $this->request->getVar('tglin');
        $tglout = $this->request->getVar('tglout');

        // Inisialisasi Query Builder untuk data aset utama
        $asetQuery = $this->aset->where('type', 'pc');

        // Filter berdasarkan kriteria pencarian
        if ($cari) {
            $asetQuery->groupStart()
                ->orWhere('serial', $cari)
                ->orWhere('manufacture', $cari)
                ->groupEnd();
        }

        // Filter berdasarkan rentang tanggal
        if ($tglin && $tglout) {
            $asetQuery->where('tgl_masuk>=', $tglin)
                ->where('tgl_keluar <=', $tglout);
        }

        // Urutkan hasil query
        $asetQuery->orderBy('id', 'desc');
        $contacts = $asetQuery->findAll();
        // $contacts = $this->aset->where('type', 'PC')->orderBy('id', 'desc')->findAll();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tgl Masuk');
        $sheet->setCellValue('C1', 'Tgl Keluar');
        $sheet->setCellValue('D1', 'Manufacture');
        $sheet->setCellValue('E1', 'Prosessor');
        $sheet->setCellValue('F1', 'Generasi');

        $sheet->setCellValue('G1', 'Serial');
        $sheet->setCellValue('H1', 'HDD/SSD');
        $sheet->setCellValue('I1', 'RAM');
        $sheet->setCellValue('J1', 'Rincian');
        $sheet->setCellValue('K1', 'Status');
        $sheet->setCellValue('L1', 'Stock');
        $sheet->setCellValue('M1', 'Kondisi');
        $sheet->setCellValue('N1', 'Keterangan');

        $column = 2; // kolom start

        foreach ($contacts as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value->tgl_masuk);
            $sheet->setCellValue('C' . $column, $value->tgl_keluar);
            $sheet->setCellValue('D' . $column, $value->manufacture);
            $sheet->setCellValue('E' . $column, $value->prosesor);
            $sheet->setCellValue('F' . $column, $value->generasi);
            $sheet->setCellValue('G' . $column, $value->serial);
            $sheet->setCellValue('H' . $column, $value->hdd);
            $sheet->setCellValue('I' . $column, $value->ram);
            $sheet->setCellValue('J' . $column, $value->rincian);
            $sheet->setCellValue('K' . $column, $value->status);
            $sheet->setCellValue('L' . $column, $value->stock);
            $sheet->setCellValue('M' . $column, $value->kondisi);
            $sheet->setCellValue('N' . $column, $value->ket);
            $column++;
        }

        $sheet->getStyle('A1:N1')->getFont()->setBold(true);
        $sheet->getStyle('A1:N1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFFF00');
        $styleArray = [
            'borders' => [

                'allBorders' => [

                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,

                    ' color' => ['argb' => 'FF000000'],

                ],

            ],

        ];

        $sheet->getStyle('A1:N' . ($column - 1))->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=Export Data PC.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        exit();
    }
}

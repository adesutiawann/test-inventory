<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AsetModel;
use App\Models\SiswaModel;

use App\Models\ManufactureModel;
use App\Models\TypeModel;

use App\Models\PortModel;
use App\Models\GenerasiModel;
use App\Models\HddModel;
use App\Models\RamModel;
use App\Models\RincianModel;

use App\Models\StatusModel;
use App\Models\StokModel;
use App\Models\KondisiModel;
//use App\Models\PelajaranModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Mouse extends BaseController
{
    protected $admin;
    protected $aset;

    protected $manufacture;
    protected $type;

    protected $port;
    protected $generasi;
    protected $hdd;
    protected $ram;
    protected $rincian;

    protected $status;
    protected $stok;
    protected $kondisi;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->aset = new AsetModel();
        $this->siswa     = new SiswaModel();

        // $this->pelajaran     = new PelajaranModel();

        $this->manufacture = new ManufactureModel;
        $this->type = new TypeModel;

        $this->port = new PortModel;
        $this->generasi = new GenerasiModel;
        $this->hdd = new HddModel;
        $this->ram = new RamModel;
        $this->rincian = new RincianModel;
        $this->status = new StatusModel;
        $this->stok = new StokModel;
        $this->kondisi = new KondisiModel;
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Mouse',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'aktiv'   => 'ALL',
            //'aset' => $this->aset->orderBy('id', 'desc')->findAll(),
            'aset' => $this->aset->where('type', 'mouse')->orderBy('id', 'desc')->findAll(),


            'total_mo' => $this->aset->where('type', 'mouse')->countAllResults(),
            'total_mo_ok' => $this->aset->where('type', 'mouse')->where('kondisi', 'OK')->countAllResults(),
            'total_mo_rusak' => $this->aset->where('type', 'mouse')->where('kondisi', 'rusak')->countAllResults(),
            'total_mo_blanks' => $this->aset->where('type', 'mouse')->where('kondisi', 'blanks')->countAllResults(),
        ];

        return view('admin/mouse', $data);
    }
    public function search($id)
    {
        $data = [
            'title'   => 'Mouse',
            'aktiv'   => $id,
            'segment' => $this->request->uri->getSegments(),

            'aset' => $this->aset->where('type', 'mouse')->where('kondisi', $id)->orderBy('id', 'desc')->findAll(),

            'total_mo' => $this->aset->where('type', 'mouse')->countAllResults(),
            'total_mo_ok' => $this->aset->where('type', 'mouse')->where('kondisi', 'OK')->countAllResults(),
            'total_mo_rusak' => $this->aset->where('type', 'mouse')->where('kondisi', 'rusak')->countAllResults(),
            'total_mo_blanks' => $this->aset->where('type', 'mouse')->where('kondisi', 'blanks')->countAllResults(),


        ];
        return view('admin/mouse', $data);
    }

    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Add Mouse',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            'type' => $this->type->where('nama', 'mouse')->orderBy('nama', 'asc')->findAll(),

            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),

            'port'    => $this->port->orderBy('port', 'asc')->findAll(),
        ];
        return view('admin/mouseadd', $data);
    }
    public function edit($id)
    {
        // $tgl= date("Y-m-d");
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        $data = [
            'title'   => 'Edit Mouse',
            'edit'   => 'redy',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            'type' => $this->type->where('nama', 'mouse')->orderBy('nama', 'asc')->findAll(),


            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),
            'aset'    => $this->aset->find($id),
        ];
        return view('admin/mouseedit', $data);
    }

    public function save()
    {
        // $tgl = date("Y-m-d");
        if ($this->request->getVar('id')) {

            $post = [
                'id'       => $this->request->getVar('id'),
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => 'Mouse',
                'status'            => $this->request->getVar('status'),
                'stock'            => $this->request->getVar('stock'),
                'kondisi'            => $this->request->getVar('kondisi'),
                'ket'            => $this->request->getVar('ket'),
                'tgl_masuk'            => $this->request->getVar('masuk'),
                'tgl_keluar'            => $this->request->getVar('keluar'),
                'serial'            => $this->request->getVar('serial'),
            ];

            if ($this->aset->save($post)) {
                session()->setFlashdata('success', 'Data berhasil di edit.');
                return redirect()->to(base_url('admin/mouse'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/mouse'));
            }
        } else {
            // $tgl= date("Y-m-d");
            $post = [
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => 'Mouse',

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
                return redirect()->to(base_url('admin/mouse'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/mouse'));
            }
        }
    }

    public function importXX()
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
                    'manufacture'    => $value[3],
                    'type'    => 'Mouse',
                    'serial' => $value[4],
                    'status' => $value[5],
                    'stock'    => $value[6],
                    'kondisi' => $value[7],
                    'ket' => $value[8],
                ];
                //$this->aset->insert($data);
                if ($this->aset->insert($data)) {
                    $data = true;
                }
                if ($data) {
                    session()->setFlashdata('success', 'Data Berhasil di Import.');
                } else {
                    session()->setFlashdata('danger', 'Data gagal di import.');
                }
            }
        } else {
            session()->setFlashdata('error', 'Format file tidak didukung; hanya format file <b>.xls</b> dan <b>.xlsx</b> yang diizinkan.');
            return redirect()->to(base_url('admin/mouse'));
        }
    }
    public function importxzzz()
    {
        $file = $this->request->getFile('file_excel');
        $extension = $file->getClientExtension();

        if ($extension == 'xlsx' || $extension == 'xls') {

            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($file);
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach ($data as $key => $value) {
                if ($key == 0) {
                    continue;
                }
                $rowData = [
                    'tgl_masuk' => $value[1],
                    'tgl_keluar' => $value[2],
                    'manufacture' => $value[3],
                    'type' => 'Mouse',
                    'serial' => $value[4],
                    'status' => $value[5],
                    'stock' => $value[6],
                    'kondisi' => $value[7],
                    'ket' => $value[8],
                ];

                // Insert data and check for success
                $insertSuccess = $this->aset->insert($rowData);

                if ($insertSuccess) {
                    $importSuccess = true;
                } else {
                    $importSuccess = false;
                    break; // Exit the loop if any insertion fails
                }
            }

            if ($importSuccess) {
                session()->setFlashdata('success', '<strong>Berhasil!</strong> Data tabel berhasil masuk kedalam database di bawah tabel ini.');
                return redirect()->to(base_url('admin/mouse'));
            } else {
                session()->setFlashdata('warning', 'Data Sudah Terdaftar !.');
                // return redirect()->to(base_url('admin/mouse'));
            }
        } else {
            session()->setFlashdata('error', 'Format file tidak didukung; hanya format file <b>.xls</b> dan <b>.xlsx</b> yang diizinkan.');
        }

        return redirect()->to(base_url('admin/mouse'));
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

            $spreadsheet = $reader->load($file);
            $data = $spreadsheet->getActiveSheet()->toArray();

            $importSuccess = true; // Assume success until proven otherwise

            foreach ($data as $key => $value) {
                if ($key == 0) {
                    continue;
                }

                $rowData = [
                    'tgl_masuk' => $value[1],
                    'tgl_keluar' => $value[2],
                    'manufacture' => $value[3],
                    'type' => 'Mouse',
                    'serial' => $value[4],
                    'status' => $value[5],
                    'stock' => $value[6],
                    'kondisi' => $value[7],
                    'ket' => $value[8],
                ];

                // Check if the data already exists in the database
                $existingData = $this->aset->where('serial', $rowData['serial'])->first();

                if (!$existingData) {
                    // Data doesn't exist, proceed with insertion
                    $insertSuccess = $this->aset->insert($rowData);
                } else {
                    // Data already exists, set importSuccess to false
                    $importSuccess = false;
                    session()->setFlashdata('warning', '<strong>Peringatan!</strong> Data dengan nomor serial <b>' . $rowData['serial'] . '</b> sudah terdaftar.');
                    break; // Exit the loop if any data already exists
                }
            }

            if ($importSuccess) {
                session()->setFlashdata('success', 'Data Berhasil di Import.');
            } else {
                session()->setFlashdata('danger', 'Data gagal di import.');
            }
        } else {
            session()->setFlashdata('error', 'Format file tidak didukung; hanya format file <b>.xls</b> dan <b>.xlsx</b> yang diizinkan.');
        }

        return redirect()->to(base_url('admin/mouse'));
    }



    public function delete($id)
    {
        if ($this->aset->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/mouse'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/mouse'));
        }
    }

    public function downloadExcel()
    {
        // $file = 'public/Ex_pc.csv';
        $file = 'assets/Exel/Ex.Import file data mouse.xlsx';

        $response = $this->response
            ->download($file, null)
            ->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return $response;
    }
    public function export()
    {

        $contacts =  $this->aset->where('type', 'mouse')->orderBy('id', 'desc')->findAll();


        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tgl Masuk');
        $sheet->setCellValue('C1', 'Tgl Keluar');
        $sheet->setCellValue('D1', 'Manufacture');

        $sheet->setCellValue('E1', 'Serial');
        $sheet->setCellValue('F1', 'Port');

        $sheet->setCellValue('G1', 'Status');
        $sheet->setCellValue('H1', 'Stock');
        $sheet->setCellValue('I1', 'Kondisi');
        $sheet->setCellValue('J1', 'Keterangan');

        $column = 2; // kolom start

        foreach ($contacts as $key => $value) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, $value->tgl_masuk);
            $sheet->setCellValue('C' . $column, $value->tgl_keluar);
            $sheet->setCellValue('D' . $column, $value->manufacture);

            $sheet->setCellValue('E' . $column, $value->serial);

            $sheet->setCellValue('F' . $column, $value->status);
            $sheet->setCellValue('G' . $column, $value->stock);
            $sheet->setCellValue('H' . $column, $value->kondisi);
            $sheet->setCellValue('I' . $column, $value->ket);
            $column++;
        }

        $sheet->getStyle('A1:I1')->getFont()->setBold(true);
        $sheet->getStyle('A1:I1')->getFill()
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

        $sheet->getStyle('A1:I' . ($column - 1))->applyFromArray($styleArray);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=Export Data mouse.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        exit();
    }
}

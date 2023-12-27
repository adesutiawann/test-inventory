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

class Monitor extends BaseController
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
            'title'   => 'Monitor',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'aktiv'   => 'ALL',
            //'aset' => $this->aset->orderBy('id', 'desc')->findAll(),
            'aset' => $this->aset->where('type', 'monitor')->orderBy('id', 'desc')->findAll(),


            'total_mo' => $this->aset->where('type', 'monitor')->countAllResults(),
            'total_mo_ok' => $this->aset->where('type', 'monitor')->where('kondisi', 'OK')->countAllResults(),
            'total_mo_rusak' => $this->aset->where('type', 'monitor')->where('kondisi', 'rusak')->countAllResults(),
            'total_mo_blanks' => $this->aset->where('type', 'monitor')->where('kondisi', 'blanks')->countAllResults(),
        ];

        return view('admin/monitor', $data);
    }
    public function search($id)
    {
        $data = [
            'title'   => 'Monitor',
            'aktiv'   => $id,
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'aset' => $this->aset->where('type', 'monitor')->where('kondisi', $id)->orderBy('id', 'desc')->findAll(),

            'total_mo' => $this->aset->where('type', 'monitor')->countAllResults(),
            'total_mo_ok' => $this->aset->where('type', 'monitor')->where('kondisi', 'OK')->countAllResults(),
            'total_mo_rusak' => $this->aset->where('type', 'monitor')->where('kondisi', 'rusak')->countAllResults(),
            'total_mo_blanks' => $this->aset->where('type', 'monitor')->where('kondisi', 'blanks')->countAllResults(),


        ];
        return view('admin/monitor', $data);
    }

    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Add Monitor',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            'type' => $this->type->where('nama', 'monitor')->orderBy('nama', 'asc')->findAll(),

            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),

            'port'    => $this->port->orderBy('port', 'asc')->findAll(),
        ];
        return view('admin/monitoradd', $data);
    }
    public function edit($id)
    {
        // $tgl= date("Y-m-d");
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        $data = [
            'title'   => 'Edit Monitor',
            'edit'   => 'redy',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            'type' => $this->type->where('nama', 'monitor')->orderBy('nama', 'asc')->findAll(),

            'port'    => $this->port->orderBy('port', 'asc')->findAll(),

            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),
            'aset'    => $this->aset->find($id),
        ];
        return view('admin/monitoredit', $data);
    }

    public function save()
    {
        // $tgl = date("Y-m-d");
        if ($this->request->getVar('id')) {

            $post = [
                'id'       => $this->request->getVar('id'),
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => $this->request->getVar('type'),
                'port'            => $this->request->getVar('port'),
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
                return redirect()->to(base_url('admin/monitor'));
            } else {
                session()->setFlashdata('error', 'Data Gagal di simpan.');
                return redirect()->to(base_url('admin/monitor'));
            }
        } else {
            // $tgl= date("Y-m-d");
            $post = [
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => $this->request->getVar('type'),

                'port'            => $this->request->getVar('port'),

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
                return redirect()->to(base_url('admin/monitor'));
            } else {
                session()->setFlashdata('error', 'Data Sudah Terdaftar !');
                return redirect()->to(base_url('admin/monitor'));
            }
        }
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
                    'manufacture'    => $value[3],

                    'type'    => 'Monitor',


                    'port'    => $value[4],
                    'serial' => $value[5],


                    'status' => $value[6],
                    'stock'    => $value[7],
                    'kondisi' => $value[8],
                    'ket' => $value[9],
                ];
                $this->aset->insert($data);
            }
            session()->setFlashdata('success', 'Data Berhasil di Import.');
            return redirect()->to(base_url('admin/monitor'));
        } else {
            session()->setFlashdata('error', 'Format file tidak didukung; hanya format file <b>.xls</b> dan <b>.xlsx</b> yang diizinkan.');
            return redirect()->to(base_url('admin/monitor'));
        }
    }

    public function delete($id)
    {
        if ($this->aset->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/monitor'));
        } else {
            session()->setFlashdata('danger', 'Data berhasil di hapus.');
            return redirect()->to(base_url('admin/monitor'));
        }
    }

    public function downloadExcel()
    {
        // $file = 'public/Ex_pc.csv';
        $file = 'assets/Exel/Ex.Import file data monitor.xlsx';

        $response = $this->response
            ->download($file, null)
            ->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return $response;
    }
    public function export()
    {

        $contacts =  $this->aset->where('type', 'monitor')->orderBy('id', 'desc')->findAll();


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
            $sheet->setCellValue('F' . $column, $value->port);

            $sheet->setCellValue('G' . $column, $value->status);
            $sheet->setCellValue('H' . $column, $value->stock);
            $sheet->setCellValue('I' . $column, $value->kondisi);
            $sheet->setCellValue('J' . $column, $value->ket);
            $column++;
        }

        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFill()
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

        $sheet->getStyle('A1:J' . ($column - 1))->applyFromArray($styleArray);

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

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=Export Data Monitor.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        exit();
    }
}

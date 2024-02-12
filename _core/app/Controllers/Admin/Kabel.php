<?php

namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AsetModel;
use App\Models\KabelModel;

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

class Kabel extends BaseController
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

    protected $kabel;

    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->aset = new AsetModel();
        $this->kabel     = new KabelModel();

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
            'title'   => 'Kabel',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'aktiv'   => 'ALL',
            //'aset' => $this->aset->orderBy('id', 'desc')->findAll(),
            'aset' => $this->aset->where('type', 'printer')->orderBy('id', 'desc')->findAll(),
            'kabel'    => $this->kabel->findAll(),

            'total_mo' => $this->aset->where('type', 'printer')->countAllResults(),
            'total_mo_ok' => $this->aset->where('type', 'printer')->where('kondisi', 'OK')->countAllResults(),
            'total_mo_rusak' => $this->aset->where('type', 'printer')->where('kondisi', 'rusak')->countAllResults(),
            'total_mo_blanks' => $this->aset->where('type', 'printer')->where('kondisi', 'blanks')->countAllResults(),
        ];

        return view('admin/kabel', $data);
    }

    public function minus($id)
    {
        $item = $this->kabel->find($id); // Fetch the item from the database based on $id

        if ($item) {
            // Perform logic to decrement the quantity
            $newQuantity = max(0, $item->jumlah - 1); // Ensure the quantity does not go below zero

            // Update the database with the new quantity
            $this->kabel->update($id, ['jumlah' => $newQuantity]);
        }

        return redirect()->to(base_url('admin/kabel')); // Redirect back to the kabel page
    }

    public function plus($id)
    {
        //$kabelModel = new KabelModel();
        $item = $this->kabel->find($id); // Fetch the item from the database based on $id

        if ($item) {
            // Perform logic to update the stock
            $newStock = $item->jumlah + 1;

            // Update the database
            $data = ['jumlah' => $newStock];
            $updated = $this->kabel->update($id, $data);

            if ($updated) {
                // Redirect back to the kabel page upon successful update
                return redirect()->to(base_url('admin/kabel'))->with('success', 'Stock updated successfully.');
            } else {
                // Handle the case where the update failed
                return redirect()->to(base_url('admin/kabel'))->with('error', 'Update failed.');
            }
        } else {
            // Handle the case where the item with $id is not found
            return redirect()->to(base_url('admin/kabel'))->with('error', 'Item not found.');
        }
    }





    public function search($id)
    {
        $data = [
            'title'   => 'printer',
            'aktiv'   => $id,
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'aset' => $this->aset->where('type', 'printer')->where('kondisi', $id)->orderBy('id', 'desc')->findAll(),

            'total_mo' => $this->aset->where('type', 'printer')->countAllResults(),
            'total_mo_ok' => $this->aset->where('type', 'printer')->where('kondisi', 'OK')->countAllResults(),
            'total_mo_rusak' => $this->aset->where('type', 'printer')->where('kondisi', 'rusak')->countAllResults(),
            'total_mo_blanks' => $this->aset->where('type', 'printer')->where('kondisi', 'blanks')->countAllResults(),


        ];
        return view('admin/kabel', $data);
    }

    public function add()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'   => 'Add printer',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),
            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            // 'type' => $this->type->where('nama', 'printer')->orderBy('nama', 'asc')->findAll(),
            'type' => $this->type->orderBy('nama', 'asc')->findAll(),

            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),

            'port'    => $this->port->orderBy('port', 'asc')->findAll(),
        ];
        return view('admin/kabeladd', $data);
    }
    public function edit($id)
    {
        // $tgl= date("Y-m-d");
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }
        $data = [
            'title'   => 'Edit printer',
            'edit'   => 'redy',
            'segment' => $this->request->uri->getSegments(),
            'admin'   => $this->admin->find(session()->get('id')),

            'nama'    => $this->manufacture->orderBy('nama', 'asc')->findAll(),
            'port' => $this->type->orderBy('nama', 'asc')->findAll(),


            'status'    => $this->status->orderBy('nama', 'asc')->findAll(),
            'kondisi'    => $this->kondisi->orderBy('nama', 'asc')->findAll(),
            'stock'    => $this->stok->orderBy('nama', 'asc')->findAll(),
            'aset'    => $this->aset->find($id),
        ];
        return view('admin/kabeledit', $data);
    }

    public function save()
    {
        // $tgl = date("Y-m-d");
        if ($this->request->getVar('id')) {

            $post = [
                'id'       => $this->request->getVar('id'),
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => 'Printer',
                'port' => $this->request->getVar('type'),

                'status'            => $this->request->getVar('status'),
                'stock'            => $this->request->getVar('stock'),
                'kondisi'            => $this->request->getVar('kondisi'),
                'ket'            => $this->request->getVar('ket'),
                'tgl_masuk'            => $this->request->getVar('masuk'),
                'tgl_keluar'            => $this->request->getVar('keluar'),
                'serial'            => $this->request->getVar('serial'),
            ];

            if ($this->aset->save($post)) {
                session()->setFlashdata('success', '<strong>Berhasil !</strong> Data berhasil di edit.');
                return redirect()->to(base_url('admin/kabel'));
            } else {
                session()->setFlashdata('error', '<strong>Gagal !</strong> Data Gagal di edit.');
                return redirect()->to(base_url('admin/kabel'));
            }
        } else {
            // $tgl= date("Y-m-d");
            $post = [
                'manufacture'            => $this->request->getVar('manufacture'),
                'type'            => 'Printer',
                'port'            => $this->request->getVar('type'),

                'status'            => $this->request->getVar('status'),
                'stock'            => $this->request->getVar('stock'),
                'kondisi'            => $this->request->getVar('kondisi'),
                'ket'            => $this->request->getVar('ket'),
                'tgl_masuk'            => $this->request->getVar('masuk'),
                'tgl_keluar'            => $this->request->getVar('keluar'),
                'serial'            => $this->request->getVar('serial'),

            ];

            $existingData = $this->aset->where('serial', $post['serial'])->first();

            if (!$existingData) {
                // Data doesn't exist, proceed with insertion
                if ($this->aset->save($post)) {
                    session()->setFlashdata('success', '<strong>Berhasil !</strong> Data berhasil di simpan kedalam database.');
                    return redirect()->to(base_url('admin/kabel'));
                } else {
                    session()->setFlashdata('error', '<strong>Pringatan !</strong> Data sudah terdaftar kedalam database !');
                    return redirect()->to(base_url('admin/kabel'));
                }
            } else {
                // Data already exists, set importSuccess to false
                // $importSuccess = false;
                session()->setFlashdata('warning', '<strong>Peringatan!</strong> Data dengan nomor serial <b>' . $post['serial'] . '</b> sudah terdaftar.');
                return redirect()->to(base_url('admin/kabel')); //break; // Exit the loop if any data already exists
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
                    'type' => 'Printer',
                    'port' => $value[4],
                    'serial' => $value[5],
                    'status' => $value[6],
                    'stock' => $value[7],
                    'kondisi' => $value[8],
                    'ket' => $value[9],
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
                session()->setFlashdata('success', '<strong>Berhasil !</strong>Data Berhasil di Import.');
            } else {
                session()->setFlashdata('danger', '<strong>Gagal !</strong>Data gagal di import.');
            }
        } else {
            session()->setFlashdata('error', 'Format file tidak didukung; hanya format file <b>.xls</b> dan <b>.xlsx</b> yang diizinkan.');
        }

        return redirect()->to(base_url('admin/kabel'));
    }



    public function delete($id)
    {
        if ($this->aset->delete($id)) {
            session()->setFlashdata('warning', '<strong>Berhasil !</strong> Data berhasil terhapus.');

            return redirect()->to(base_url('admin/kabel'));
        } else {
            session()->setFlashdata('danger', '<strong>Gagal !</strong> Data gagal di hapus !');

            return redirect()->to(base_url('admin/kabel'));
        }
    }

    public function downloadExcel()
    {
        // $file = 'public/Ex_pc.csv';
        $file = 'assets/Exel/Ex.Import file data printer.xlsx';

        $response = $this->response
            ->download($file, null)
            ->setContentType('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        return $response;
    }
    public function export()
    {

        $contacts =  $this->aset->where('type', 'printer')->orderBy('id', 'desc')->findAll();


        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Tgl Masuk');
        $sheet->setCellValue('C1', 'Tgl Keluar');
        $sheet->setCellValue('D1', 'Manufacture');
        $sheet->setCellValue('E1', 'Type');
        $sheet->setCellValue('F1', 'Serial');
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
            $sheet->setCellValue('E' . $column, $value->port);
            $sheet->setCellValue('F' . $column, $value->serial);

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
        header('Content-Disposition: attachment;filename=Export Data Printer.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

        exit();
    }
}

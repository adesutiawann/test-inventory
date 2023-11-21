<?php

namespace App\Controllers\Admin;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;
use App\Models\Tahun_pelajaranModel;
use App\Models\SiswaModel;

class Import extends BaseController
{
    protected $admin;
    protected $walikelas;
    protected $tahun_pelajaran;
    protected $siswa;

    public function __construct()
    {
        $this->admin           = new AdminModel();
        $this->walikelas       = new WalikelasModel();
        $this->tahun_pelajaran = new Tahun_pelajaranModel();
        $this->siswa           = new SiswaModel();
    }

    public function index()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'           => 'Import Absensi',
            'segment'         => $this->request->uri->getSegments(),
            'admin'           => $this->admin->find(session()->get('id')),
            'kelas'           => $this->siswa->groupBy('kelas')->findAll(),
            'tahun_pelajaran' => $this->tahun_pelajaran->groupBy('tahun')->findAll(),
        ];

        return view('admin/import', $data);
    }

    public function format()
    {
        if (session()->get('logged_admin') != true) {
            return redirect()->to(base_url());
        }

        $siswa = $this->siswa->where(['kelas' => $this->request->getVar('kelas'), 'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran')])->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'BULAN :')
            ->setCellValue('B1', '')
            ->setCellValue('C1', 'TAHUN :')
            ->setCellValue('D1', '')
            ->setCellValue('A2', 'ID')
            ->setCellValue('B2', 'NAMA')
            ->setCellValue('C2', 'TAHUN PELAJARAN')
            ->setCellValue('D2', 'SEMESTER (1 / 2)')
            ->setCellValue('E2', '01')
            ->setCellValue('F2', '02')
            ->setCellValue('G2', '03')
            ->setCellValue('H2', '04')
            ->setCellValue('I2', '05')
            ->setCellValue('J2', '06')
            ->setCellValue('K2', '07')
            ->setCellValue('L2', '08')
            ->setCellValue('M2', '09')
            ->setCellValue('N2', '10')
            ->setCellValue('O2', '11')
            ->setCellValue('P2', '12')
            ->setCellValue('Q2', '13')
            ->setCellValue('R2', '14')
            ->setCellValue('S2', '15')
            ->setCellValue('T2', '16')
            ->setCellValue('U2', '17')
            ->setCellValue('V2', '18')
            ->setCellValue('W2', '19')
            ->setCellValue('X2', '20')
            ->setCellValue('Y2', '21')
            ->setCellValue('Z2', '22')
            ->setCellValue('AA2', '23')
            ->setCellValue('AB2', '24')
            ->setCellValue('AC2', '25')
            ->setCellValue('AD2', '26')
            ->setCellValue('AE2', '27')
            ->setCellValue('AF2', '28')
            ->setCellValue('AG2', '29')
            ->setCellValue('AH2', '30')
            ->setCellValue('AI2', '31');
        $column = 3;

        foreach ($siswa as $siswa) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $siswa->id)
                ->setCellValue('B' . $column, $siswa->nama)
                ->setCellValue('C' . $column, $this->request->getVar('tahun_pelajaran'))
                ->setCellValue('D' . $column, '')
                ->setCellValue('E' . $column, 'h');

            $column++;
        }
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('V')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('W')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('X')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('Y')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('Z')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AA')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AB')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AC')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AD')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AE')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AF')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AG')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AH')->setAutoSize(TRUE);
        $spreadsheet->getActiveSheet()->getColumnDimension('AI')->setAutoSize(TRUE);

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His') . '-' . $this->request->getVar('kelas');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}

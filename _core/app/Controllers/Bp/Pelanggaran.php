<?php

namespace App\Controllers\Bp;

use \Hermawan\DataTables\DataTable;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\PembinaModel;
use App\Models\AnggotaModel;

class Pelanggaran extends BaseController
{
    protected $admin;
    protected $siswa;
    protected $pembina;
    protected $anggota;

    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->siswa = new SiswaModel();
        $this->pembina = new PembinaModel();
        $this->anggota = new AnggotaModel();
    }

    public function index()
    {
        if (session()->get('logged_bp') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $pembina = $this->pembina->where('guru', session()->get('id'))->first();

        $data = [
            'title'     => 'Data Pelanggaran Siswa',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $pembina,
            'siswa'     => $this->siswa->findAll(),
            'poin'      => $this->poin->findAll(),
        ];

        return view('bp/pelanggaran', $data);
    }

    public function data()
    {
        $db = db_connect();
        $builder = $db->table('pelanggaran_siswa')
            ->select('pelanggaran_siswa.id, pelanggaran_siswa.tanggal, pelanggaran_siswa.siswa, siswa.nama, siswa.kelas, poin.pelanggaran, sum(poin.poin) as total_poin')
            ->join('siswa', 'siswa.id=pelanggaran_siswa.siswa')
            ->join('poin', 'poin.id=pelanggaran_siswa.poin')
            ->groupBy('pelanggaran_siswa.siswa')
            ->orderBy('pelanggaran_siswa.poin', 'asc');

        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<a href="' . base_url('bp/pelanggaran/detail/' . $row->siswa) . '" class="btn btn-sm btn-info text-white">Detail</a>';
            })
            ->addNumbering('no')->toJson(true);
    }

    public function save()
    {
        $post = [
            'tanggal' => date("Y-m-d"),
            'siswa'   => $this->request->getVar('siswa'),
            'poin'    => $this->request->getVar('poin'),
        ];

        if ($this->pelanggaran_siswa->save($post) === false) {
            session()->setFlashdata('error_add', 'Gagal menyimpan data.');
            return redirect()->to(base_url('bp/pelanggaran'));
        } else {
            session()->setFlashdata('success_add', 'Data berhasil disimpan.');
            return redirect()->to(base_url('bp/pelanggaran'));
        }
    }

    public function detail($siswa)
    {
        if (session()->get('logged_bp') != true && session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $pembina = $this->pembina->where('guru', session()->get('id'))->first();

        $data = [
            'title'       => 'Data Pelanggaran Siswa',
            'segment'     => $this->request->uri->getSegments(),
            'admin'       => $this->admin->find(session()->get('id')),
            'walikelas'   => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'       => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'          => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'     => $pembina,
            'siswa'       => $this->siswa->find($siswa),
            'pelanggaran' => $this->pelanggaran_siswa->where('siswa', $siswa)->join('poin', 'poin.id=pelanggaran_siswa.poin')->findAll(),
        ];

        return view('bp/detail', $data);
    }

    public function delete($id)
    {
        if ($this->pelanggaran_siswa->delete($id) === false) {
            session()->setFlashdata('error', 'Gagal menghapus data.');
            return redirect()->to(base_url('bp/pelanggaran'));
        } else {
            session()->setFlashdata('success', 'Data berhasil dihapus.');
            return redirect()->to(base_url('bp/pelanggaran'));
        }
    }
}

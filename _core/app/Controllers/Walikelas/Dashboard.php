<?php

namespace App\Controllers\Walikelas;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\WalikelasModel;

class Dashboard extends BaseController
{
    protected $admin;
    protected $walikelas;
    public function __construct()
    {
        $this->admin     = new AdminModel();
        $this->walikelas = new WalikelasModel();
    }

    public function index()
    {
        if (session()->get('logged_walikelas') != true) {
            return redirect()->to(base_url());
        }

        $data = [
            'title'     => 'Dashboard',
            'segment'   => $this->request->uri->getSegments(),
            'admin'     => $this->admin->find(session()->get('id')),
            'walikelas' => $this->walikelas->where('guru', session()->get('id'))->first(),
            'piket'     => $this->piket->where('guru', session()->get('id'))->first(),
            'bp'        => $this->bp->where('guru', session()->get('id'))->first(),
            'pembina'   => $this->pembina->where('guru', session()->get('id'))->first(),
        ];

        return view('walikelas/dashboard', $data);
    }
}

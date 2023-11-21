<?php

namespace App\Controllers;

use App\Controllers\Pembina\Absensi_ekstra;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Tahun_pelajaranModel;
use App\Models\SettingModel;
use App\Models\PembinaModel;
use App\Models\WalikelasModel;
use App\Models\PiketModel;
use App\Models\BpModel;
use App\Models\Absensi_telatModel;
use App\Models\PoinModel;
use App\Models\Pelanggaran_siswaModel;
use App\Models\Absensi_dhuhaModel;
use App\Models\Absensi_dhuhurModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $tp;
    protected $setting;
    protected $pembina;
    protected $siswa;
    protected $walikelas        ; 
    protected $piket            ;
    protected $bp               ; 
    protected $absensi_telat    ; 
    protected $poin             ;
    protected $pelanggaran_siswa; 
    protected $absensi_dhuha    ; 
    protected $absensi_dhuhur ;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->tp = new Tahun_pelajaranModel();
        $this->tp = $this->tp->where('aktif', '1')->first();

        $this->setting   = new SettingModel();
        $this->setting   = $this->setting->find(1);

        $this->pembina           = new PembinaModel();
        
       // $this->walikelas         = new WalikelasModel();
        $this->walikelas         = new WalikelasModel();
        $this->piket             = new PiketModel();
        $this->bp                = new BpModel();
        $this->absensi_telat     = new Absensi_telatModel();
        $this->poin              = new PoinModel();
        $this->pelanggaran_siswa = new Pelanggaran_siswaModel();
        $this->absensi_dhuha     = new Absensi_dhuhaModel();
        $this->absensi_dhuhur    = new Absensi_dhuhurModel();
    }
}

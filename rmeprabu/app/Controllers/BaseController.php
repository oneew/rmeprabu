<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Models\Modelperawat;
use CodeIgniter\Controller;

class BaseController extends Controller
{

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url', 'check_asesmen_medis_ranap_helper', 'check_asesmen_perawat_ranap_helper', 'check_asesmen_perawat_rajal_helper', 'check_resume_medis_igd_helper', 'check_resume_ranap_helper', 'hitung_biaya_ranap_helper', 'rupiah_helper', 'check_resume_medis_rj_helper', 'hitung_biaya_rajal_helper', 'check_lap_ibs_helper', 'check_lap_katarak_helper', 'tgl_indo_helper', 'hitung_umur_helper', 'cari_sip_helper', 'barcode_helper', 'idr_to_text_helper', 'hitung_umur_old_helper', 'cari_nip_helper', 'get_data_penunjang_helper', 'check_obat_racikan', 'check_triase_igd_helper', 'check_asesmen_perawat_igd_helper', 'radiologi_detail_helper'];

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        // E.g.:
        // $this->session = \Config\Services::session();
        session();
    }
}

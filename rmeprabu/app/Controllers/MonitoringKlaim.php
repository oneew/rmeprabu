<?php

namespace App\Controllers;


use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;

class MonitoringKlaim extends BaseController
{

    public function index()
    {
        return view('dashboard/monitoringklaim');
    }

    public function JasaRaharja()
    {
        return view('dashboard/monitoringklaimJasaRaharja');
    }
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_dakurajal;
use App\Models\ModelRawatJalanDaftar;
use App\Models\Modelrajal;

use Config\Services;

class RekMedDakuRajal extends Controller
{


    public function index()
    {

        $data = [
            'cabar' => $this->data_payment(),
            'poli' => $this->data_poli(),
        ];

        echo view('rekammedik/datakunjunganrajal', $data);
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new Model_dakurajal($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->documentdate;
                $row[] = $list->pasienid;
                $row[] = $list->pasienname;
                $row[] = $list->paymentmethodname;
                $row[] = $list->poliklinikname;
                $row[] = $list->doktername;
                $row[] = $list->statuspasien;
                $data[] = $row;
            }

            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $m_icd->count_all(),
                "recordsFiltered" => $m_icd->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }



    public function data_payment()
    {

        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_payment();
        return $list;
    }

    public function data_poli()
    {
        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli();
        return $list;
    }
}

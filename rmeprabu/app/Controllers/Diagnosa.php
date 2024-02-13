<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_diagnosa;

use Config\Services;

class Diagnosa extends Controller
{


    public function index()
    {

        $data = [
            'diagnosa' => '',
        ];

        echo view('rekammedik/diagnosasepuluh', $data);
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new Model_diagnosa($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->code;
                $row[] = $list->originalcode;
                $row[] = $list->name;
                $row[] = $list->subname;
                $row[] = $list->inpatient;
                $row[] = $list->outpatient;
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
}

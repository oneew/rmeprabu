<?php

namespace App\Controllers;

use App\Models\Model_BedInfo;
use CodeIgniter\Controller;
use App\Models\Model_pelayanan;
use Config\Services;

class PelayananBedInfo extends Controller
{


    public function index()
    {
        echo view('igd/bedinfo');
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new Model_BedInfo($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->name;
                $row[] = $list->classroomname;
                $row[] = $list->smf;
                $row[] = $list->code;
                $row[] = $list->status;
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

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_pelayanan_visite;
use Config\Services;

class TarifPelayananVisite extends Controller
{


    public function index()
    {
        echo view('dashboard/tarif_pelayanan_visite');
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new Model_pelayanan_visite($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->groupname;
                $row[] = $list->code;
                $row[] = $list->name;
                $row[] = $list->classroomname;
                $row[] = $list->category;
                $row[] = $list->price;
                $row[] = $list->share1;
                $row[] = $list->share2;
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

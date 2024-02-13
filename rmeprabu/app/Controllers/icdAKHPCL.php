<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_icd;
use App\Models\Model_icdCL;
use App\Models\Model_autocomplete;
use Config\Services;

class icdAKHPCL extends Controller
{


    public function index()
    {
        $db = db_connect();
        $smf = $db->query("SELECT * FROM pelayanan_smf WHERE vclaimcode IS NOT NULL ORDER BY name DESC")->getResult();

        $data = [
            'smf' => $smf,
        ];

        echo view('ibs/index_akhp_cl', $data);
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new Model_icdCL($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tomboledit = '<form method="post" action="IBSAKHPCL/lihatdetailibs2">
                <input type="hidden" name="id" id="id" value="' . $list->id . '">
                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-tags"></i></button>
                </form>';
                $row[] = $tomboledit;
                $row[] = $no;
                $row[] = $list->documentdate;
                $row[] = $list->journalnumber;

                $row[] = $list->pasienid;
                $row[] = $list->pasienname;
                $row[] = $list->paymentmethodname;
                $row[] = $list->smfname;
                $row[] = $list->doktername;


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

    public function berangkat($token_ibs)
    {
        echo $token_ibs;
    }
}

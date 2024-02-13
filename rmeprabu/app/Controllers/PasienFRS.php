<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelPasienFRS;
use App\Models\Modelrajal;
use Config\Services;

class PasienFRS extends Controller
{


    public function index()
    {
        $data = [
            'smf' => $this->smf_ranap(),
        ];
        echo view('forensik/index', $data);
    }
    public function smf_ranap()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_smf_real();
        return $list;
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new ModelPasienFRS($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tomboledit = '<form method="post" action="PelayananFRS/inputdetailFRS2">
                <input type="hidden" name="id" id="id" value="' . $list->id . '">
                <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-file-medical-alt"></i></button>
                </form>';
                $row[] = $tomboledit;
                $row[] = $no;
                $row[] = $list->note;
                $row[] = $list->documentdate;
                $row[] = $list->pasienid;
                $row[] = $list->pasienname;
                $row[] = $list->paymentmethod;
                $row[] = $list->smfname;
                $row[] = $list->doktername;
                $row[] = $list->roomname;
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

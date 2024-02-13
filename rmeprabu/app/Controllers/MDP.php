<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_mdp;
use App\Models\ModelRawatJalanDaftar;

use Config\Services;

class MDP extends Controller
{


    public function index()
    {

        $data = [
            'cabar' => $this->data_payment(),
        ];

        echo view('rekammedik/mdp', $data);
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new Model_mdp($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $tomboledit = '<form method="post" action="RekamMedis/detailpasien">
                <input type="hidden" name="id" id="id" value="' . $list->id . '">
                <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-street-view"></i></button>
                </form>';
                $row[] = $tomboledit;
                $row[] = $no;
                $row[] = $list->created_at;
                $row[] = $list->code;
                $row[] = $list->name;
                $row[] = $list->gender;
                $row[] = $list->paymentmethodname;
                $row[] = $list->cardnumber;
                $row[] = $list->education;
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
}

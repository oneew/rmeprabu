<?php



namespace App\Controllers;



use CodeIgniter\Controller;

use App\Models\ModelPasienRadiologi;

use App\Models\ModelPasienLPA;

use App\Models\ModelRawatJalanDaftar;

use Config\Services;



class PasienLPA extends Controller

{





    public function index()

    {

        $db = db_connect();

        $smf = $db->query("SELECT * FROM pelayanan_smf WHERE vclaimcode IS NOT NULL ORDER BY name DESC")->getResult();

        $data = [

            'smf' => $smf,

        ];

        echo view('patologianatomi/index', $data);

    }



    public function ajax_list()

    {

        $request = Services::request();

        $m_icd = new ModelPasienLPA($request);



        if ($request->getMethod(true) == 'POST') {

            $lists = $m_icd->get_datatables();

            $data = [];

            $no = $request->getPost("start");

            foreach ($lists as $list) {

                $no++;

                $row = [];



                $tomboledit = '<form method="post" action="PelayananLPA/inputdetailLPA2">

                <input type="hidden" name="id" id="id" value="' . $list->id . '">

                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>

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

            return json_encode($output);

        }

    }



    public function berangkat($token_ibs)

    {

        echo $token_ibs;

    }



    public function Expertise()

    {

        $data = [

            'list' => $this->data_payment(),

        ];

        return view('patologianatomi/registerexpertise', $data);

    }



    public function ambildataExpertise()

    {

        if ($this->request->isAJAX()) {



            $register = new ModelRawatJalanDaftar();

            $data = [

                'tampildata' => $register->get_expertise_lpa()

            ];

            $msg = [

                'data' => view('patologianatomi/dataexpertise', $data)

            ];

            return json_encode($msg);

        } else {

            exit('tidak dapat diproses');

        }

    }





    public function caridataExpertise()

    {

        if ($this->request->isAJAX()) {



            $search = $this->request->getPost();

            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);

            $sampai = str_replace('/', '-', $dateout[1]);



            $mulai = str_replace('/', '-', $dateout[0]);

            $sampai = str_replace('/', '-', $dateout[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));

            $search['sampai'] = date('Y-m-d', strtotime($sampai));







            $register = new ModelRawatJalanDaftar();

            $data = [

                'tampildata' => $register->search_expertise_lpa($search)

            ];





            $msg = [

                'data' => view('patologianatomi/dataexpertise', $data)

            ];



            return json_encode($msg);

        } else {

            exit('tidak dapat diproses');

        }

    }



    public function data_payment()

    {



        $m_auto = new ModelRawatJalanDaftar();

        $list = $m_auto->get_list_payment();

        return $list;

    }

}


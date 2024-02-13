<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_icd;


use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\Modelranapvalidasi;
use App\Models\Modellogactivity;
use Config\Services;

class PasienRanap extends Controller
{
    public function index()
    {
        $db = db_connect();
        $smf = $db->query("SELECT * FROM pelayanan_smf WHERE vclaimcode IS NOT NULL ORDER BY name DESC")->getResult();

        $data = [
            'smf' => $smf,
        ];

        echo view('rawatinap/index', $data);
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new ModelPasienRanap($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tomboledit = '<form method="post" action="PelayananRanap/rincianranap">
                <input type="hidden" name="id" id="id" value="' . $list->id . '">
                <button type="submit" class="btn btn-success btn-rounded btn-sm"><i class="fa fa-tags"></i></button>
                </form>';
                $row[] = $tomboledit;
                $row[] = $no;
                $row[] = $list->documentdate;
                $row[] = $list->pasienid;
                $row[] = $list->pasienname;
                $row[] = $list->paymentmethodname;
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

    public function Dact()
    {

        return view('rawatinap/DactRanap');
    }

    public function ambildataDact()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelranapvalidasi();
            $data = [
                'tampildata' => $perawat->ambildataranap_exist()
            ];
            $msg = [
                'data' => view('rawatinap/data_dact_ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriDact()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_ibs($id);
            $referencenumber = $row['referencenumber'];
            $merge = $m_icd->get_data_merge($referencenumber);

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Melihat Rincian Pasien ' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' Rawat Inap [Pelayanan Ranap]',

            ];

            $catat = new Modellogactivity;
            $catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => $row['types'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['referencenumber'],
                'pasienid' => $row['pasienid'],
                'oldcode' => $row['oldcode'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_spr'],
                'email' => '',
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => $row['statusrawatinap'],
                'pasienclassroom' => $row['pasienclassroom'],
                'merge' => $merge,
                'koinsiden' => $row['koinsiden'],
            ];
            $msg = [
                'sukses' => view('rawatinap/modaldactranap', $data)
            ];
            echo json_encode($msg);
        }
    }

    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }

    public function Jendela()
    {

        return view('rawatinap/jendela');
    }

    public function ambildataJendela()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelranapvalidasi();
            $data = [
                'tampildata' => $perawat->ambildataranap_exist_jendela()
            ];
            $msg = [
                'data' => view('rawatinap/data_jendela', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

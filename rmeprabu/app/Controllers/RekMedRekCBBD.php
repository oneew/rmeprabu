<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;

class RekMedReKCBBD extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerbd_rekapcabar', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "UNIT BANK DARAH";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_bd_cabar_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatabd_rekapcabar(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/datarekapkunjunganbd_cabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoli()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $lokasikasir = "UNIT BANK DARAH";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_bd_cabar_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterBD_rekapcabar($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/datarekapkunjunganbd_cabar', $data)
            ];
            echo json_encode($msg);
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

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli();
        return $list;
    }

    public function poli_igd()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli_igd();
        return $list;
    }

    public function smf_ranap()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_smf_real();
        return $list;
    }


    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }
}

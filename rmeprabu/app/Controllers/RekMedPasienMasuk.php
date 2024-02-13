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

class RekMedPasienMasuk extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerpoliklinik_pasienmasuk', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_masuk_rajal_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_pasienmasuk(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataregisterpoliklinik_pasienmasuk', $data)
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
            // $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            // $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            // $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            // $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_masuk_rajal_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_pasienmasuk($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/dataregisterpoliklinik_pasienmasuk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function PasienMasukIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->poli_igd(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerigd_pasienmasuk', $data);
    }

    public function ambildataPasienMasukIGD()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_masuk_igd_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataigd_pasienmasuk(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];


            $msg = [
                'data' => view('rekammedik/dataregisterigd_pasienmasuk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliPasienMasukIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_masuk_igd_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterIGD_pasienmasuk($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'kelompok' => $row['kelompok'],
                'deskripsi' => $row['deskripsi']
            ];

            $msg = [
                'data' => view('rekammedik/dataregisterigd_pasienmasuk', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function PasienMasukRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->ruangan(),
            'smf' => $this->smf_ranap(),
        ];
        return view('rekammedik/registerranap_pasienmasuk', $data);
    }

    public function ambildataPasienMasukRanap()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_masuk_ranap_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_pasienmasuk(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataregisterranap_pasienmasuk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliPasienMasukRanap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            // $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            // $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            // $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            // $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_masuk_ranap_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRanap_pasienmasuk($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/dataregisterranap_pasienmasuk', $data)
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

    public function smf_ranap()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_smf_real();
        return $list;
    }

    public function poli_igd()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli_igd();
        return $list;
    }

    public function ruangan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_room_name_coding();
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

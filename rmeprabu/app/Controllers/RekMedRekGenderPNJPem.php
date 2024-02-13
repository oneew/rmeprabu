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

class RekMedRekGenderPNJPem extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerradiologi_rekapgender_pem', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI RADIOLOGI";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rad_gender_pem_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarad_rekapgender_pem(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/datarekapkunjunganradiologi_gender_pem', $data)
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

            $lokasikasir = "INSTALASI RADIOLOGI";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rad_gender_pem_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRAD_rekapgender_pem($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/datarekapkunjunganradiologi_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function LPK()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerlpk_rekapgender_pem', $data);
    }

    public function ambildataLPK()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI LABORATORIUM PATOLOGI KLINIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_lpk_gender_pem_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatalpk_rekapgender_pem(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/datarekapkunjunganlpk_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliLPK()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);


            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $lokasikasir = "INSTALASI LABORATORIUM PATOLOGI KLINIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_lpk_gender_pem_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterLPK_rekapgender_pem($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/datarekapkunjunganlpk_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function LPA()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerlpa_rekapgender_pem', $data);
    }

    public function ambildataLPA()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI LABORATORIUM PATOLOGI ANATOMI";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_lpa_gender_pem_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatalpa_rekapgender_pem(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/datarekapkunjunganlpa_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliLPA()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);;

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $lokasikasir = "INSTALASI LABORATORIUM PATOLOGI ANATOMI";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_lpa_gender_pem_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterLPA_rekapgender_pem($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/datarekapkunjunganlpa_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerbd_rekapgender_pem', $data);
    }

    public function ambildataBD()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "UNIT BANK DARAH";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_bd_gender_pem_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatabd_rekapgender_pem(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/datarekapkunjunganbd_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliBD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);;

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $lokasikasir = "UNIT BANK DARAH";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_bd_gender_pem_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterBD_rekapgender_pem($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/datarekapkunjunganbd_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ABL()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('ambulance/registerabl_rekapgender_pem', $data);
    }

    public function ambildataABL()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI AMBULANCE";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_abl_gender_pem_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataabl_rekapgender_pem(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('ambulance/datarekapkunjunganabl_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliABL()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $lokasikasir = "INSTALASI AMBULANCE";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_abl_gender_pem_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterABL_rekapgender_pem($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('ambulance/datarekapkunjunganabl_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function FRS()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('forensik/registerfrs_rekapgender_pem', $data);
    }

    public function ambildataFRS()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI FORENSIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_frs_gender_pem_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatafrs_rekapgender_pem(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('forensik/datarekapkunjunganfrs_gender_pem', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliFRS()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI FORENSIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_frs_gender_pem_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterFRS_rekapgender_pem($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('forensik/datarekapkunjunganfrs_gender_pem', $data)
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

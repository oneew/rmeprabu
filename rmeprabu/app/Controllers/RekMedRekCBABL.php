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

class RekMedReKCBABL extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('ambulance/registerabl_rekapcabar', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI AMBULANCE";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_abl_cabar_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataABL_rekapcabar(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('ambulance/datarekapkunjunganabl_cabar', $data)
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

            $lokasikasir = "INSTALASI AMBULANCE";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_abl_cabar_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterABL_rekapcabar($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('ambulance/datarekapkunjunganabl_cabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RekapCabarIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerigd_rekapcabar', $data);
    }

    public function ambildataRekapCabarIGD()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rekap_kunjungan_cabar_igd_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataigd_rekapcabar(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/datarekapkunjunganigd_cabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRekapCabarIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rekap_kunjungan_cabar_igd_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterIGD_rekapcabar($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/datarekapkunjunganigd_cabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RekapCabarRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerranap_rekapcabar', $data);
    }

    public function ambildataRekapCabarRanap()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rekap_kunjungan_cabar_ranap_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_rekapcabar(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/datarekapkunjunganranap_cabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRekapCabarRanap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rekap_kunjungan_cabar_igd_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRanap_rekapcabar($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/datarekapkunjunganranap_cabar', $data)
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

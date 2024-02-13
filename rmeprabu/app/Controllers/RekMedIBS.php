<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPasienRanap;
use App\Models\ModelLaporanIBS;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;

class RekMedIBS extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'smf' => $this->data_smf(),
            'dokter' => $this->data_dokter()
        ];
        return view('rekammedik/registeribs_operasi', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {


            $register = new ModelLaporanIBS();

            $master = $register->search_RegisterIBS_today();

            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
            }

            foreach ($master as $index => $row) {

                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['pasienaddress'] = $row['pasienaddress'];
                $pem[$index]['pasiengender'] = $row['pasiengender'];
                $pem[$index]['paymentmethod'] = $row['paymentmethod'];
                $pem[$index]['ibsdoktername'] = $row['ibsdoktername'];
                $pem[$index]['ibsanestesiname'] = $row['ibsanestesiname'];

                $detail = $register->search_IBS_detail($id);
                $pem[$index]['list'] = [];
                foreach ($detail as $item) {

                    if ($item['journalnumber'] == $row['journalnumber']) {
                        $pem[$index]['list'][] = $item;
                    }
                }
            }

            $lokasikasir = "INSTALASI BEDAH SENTRAL";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_ibs_kop($lokasikasir);

            $data = [
                'tampildata' => $pem,
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataregisteribs_operasi', $data)
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


            $register = new ModelLaporanIBS();
            $master = $register->search_RegisterIBS($search);

            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
            }




            foreach ($master as $index => $row) {
                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['pasienaddress'] = $row['pasienaddress'];
                $pem[$index]['pasiengender'] = $row['pasiengender'];
                $pem[$index]['paymentmethod'] = $row['paymentmethod'];
                $pem[$index]['ibsdoktername'] = $row['ibsdoktername'];
                $pem[$index]['ibsanestesiname'] = $row['ibsanestesiname'];

                $detail = $register->search_IBS_detail($id);

                $pem[$index]['list'] = [];
                foreach ($detail as $item) {

                    if ($item['journalnumber'] == $row['journalnumber']) {
                        $pem[$index]['list'][] = $item;
                    }
                }
            }

            $lokasikasir = "INSTALASI BEDAH SENTRAL";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_ibs_kop($lokasikasir);


            $data = [
                'tampildata' => $pem,
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok'],
            ];
            $msg = [
                'data' => view('rekammedik/dataregisteribs_operasi', $data)
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

    public function data_smf()
    {
        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_smf();
        return $list;
    }

    public function data_dokter()
    {
        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_dokter();
        return $list;
    }
}

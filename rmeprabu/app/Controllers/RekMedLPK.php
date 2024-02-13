<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\ModelLaporanLPK;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;

class RekMedLPK extends BaseController
{



    public function index()
    {
        $data = [
            'list' => $this->data_payment()
        ];
        return view('rekammedik/registerlpk_pemeriksaan', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {


            $register = new ModelLaporanLPK();

            $master = $register->search_RegisterLPK_today();

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

                $detail = $register->search_LPK_detail($id);
                $pem[$index]['list'] = [];
                foreach ($detail as $item) {

                    if ($item['journalnumber'] == $row['journalnumber']) {
                        $pem[$index]['list'][] = $item;
                    }
                }
            }

            $lokasikasir = "INSTALASI LABORATORIUM PATOLOGI KLINIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_lpk_kop($lokasikasir);

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
                'data' => view('rekammedik/dataregisterlpk_pemeriksaan', $data)
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

            $register = new ModelLaporanLPK();
            $master = $register->search_RegisterLPK($search);

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

                $detail = $register->search_LPK_detail($id);

                $pem[$index]['list'] = [];
                foreach ($detail as $item) {

                    if ($item['journalnumber'] == $row['journalnumber']) {
                        $pem[$index]['list'][] = $item;
                    }
                }
            }

            $lokasikasir = "INSTALASI LABORATORIUM PATOLOGI KLINIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_lpk_kop($lokasikasir);


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
                'data' => view('rekammedik/dataregisterlpk_pemeriksaan', $data)
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
}

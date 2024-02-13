<?php

namespace App\Controllers;

use App\Models\Modelibs;
use App\Models\Model_autocomplete;
use App\Models\ModelEnJadwal;
use App\Models\Modelrajal;
use App\Models\ModelRawatJalanDaftar;

use Config\Services;
use Dompdf\Dompdf;


class EnJadwal extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->_data_dokter(),
            'anestesi' => $this->_data_dokter_anestesi(),
            'kamarok' => $this->_data_ruangan_ok(),
        ];

        return view('ibs/InputJadwalOperasi', $data);
    }

    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }
    private function _data_dokter_anestesi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_anestesi();
        return $list;
    }

    private function _data_ruangan_ok()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_room_ok();
        return $list;
    }

    public function simpandatajadwal()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'ibsdoktername' => [
                    'label' => 'Nama Dokter',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'ibsdoktername' => $validation->getError('ibsdoktername')
                    ]
                ];
            } else {

                $simpandata = [
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                    'pasienaddress' => $this->request->getVar('pasienaddress'),
                    'ibsdoktername' => $this->request->getVar('ibsdoktername'),
                    'ibsanestesiname' => $this->request->getVar('ibsanestesiname'),
                    'name' => $this->request->getVar('name'),
                    'room' => $this->request->getVar('kamarok'),
                    'dateOp' => $this->request->getVar('tanggaloperasi'),
                    'datetimeOp' => $this->request->getVar('jamoperasi'),
                    'asalRuangan' => $this->request->getVar('asalRuangan'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                    'kodebooking' => $this->request->getVar('kodebooking'),
                    'kodepoli' => $this->request->getVar('kodepoli'),
                    'tanggaljaminput' => $this->request->getVar('tanggaljaminput'),
                    'timpelaksana' => $this->request->getVar('timpelaksana'),
                    'timanestesi' => $this->request->getVar('timanestesi'),
                    'diagnosa' => $this->request->getVar('diagnosa'),
                    'tgl_keputusan' => $this->request->getVar('tanggal_keputusan'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),

                ];
                $perawat = new ModelEnJadwal;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Penjadwalan Operasi Berhasil',
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function PasienRajal()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),
            ];
            $msg = [
                'data' => view('ibs/modalpasienrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli();
        return $list;
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelEnJadwal();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('ibs/dataregisterrajal', $data)
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
            $dateout1 = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout1[0]);
            $sampai = str_replace('/', '-', $dateout1[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelEnJadwal();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('ibs/dataregisterrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DetailPasien()
    {
        if ($this->request->isAJAX()) {

            $pasienid = $this->request->getVar('pasienid');
            $pasienname = $this->request->getVar('pasienname');
            $pasiendateofbirth = $this->request->getVar('pasiendateofbirth');
            $poliklinikname = $this->request->getVar('poliklinikname');
            $pasienaddress = $this->request->getVar('pasienaddress');
            $journalnumber = $this->request->getVar('journalnumber');
            $paymentcardnumber = $this->request->getVar('paymentcardnumber');
            $paymentmethodname = $this->request->getVar('paymentmethodname');

            $register = new ModelEnJadwal();
            $bpjs = $register->getPoliBpjsp($poliklinikname);
            $kode_bpjs = $bpjs['bpjs'];

            $data = [
                'pasienid' => $pasienid,
                'pasienname' => $pasienname,
                'pasiendateofbirth' => $pasiendateofbirth,
                'poliklinikname' => $poliklinikname,
                'pasienaddress' => $pasienaddress,
                'journalnumber' => $journalnumber,
                'paymentcardnumber' => $paymentcardnumber,
                'kodepoli' => $kode_bpjs,
                'paymentmethodname' => $paymentmethodname,
            ];
            echo json_encode($data);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DetailPasienRanap()
    {
        if ($this->request->isAJAX()) {

            $pasienid = $this->request->getVar('pasienid');
            $pasienname = $this->request->getVar('pasienname');
            $pasiendateofbirth = $this->request->getVar('pasiendateofbirth');
            $poliklinikname = $this->request->getVar('poliklinikname');
            $pasienaddress = $this->request->getVar('pasienaddress');
            $journalnumber = $this->request->getVar('journalnumber');
            $paymentcardnumber = $this->request->getVar('paymentcardnumber');
            $poliklinik = $this->request->getVar('poliklinik');
            $paymentmethodname = $this->request->getVar('paymentmethodname');

            $register = new ModelEnJadwal();
            $bpjs = $register->getPoliBpjspRanap($poliklinik);
            $kode_bpjs = $bpjs['bpjs'];

            $data = [
                'pasienid' => $pasienid,
                'pasienname' => $pasienname,
                'pasiendateofbirth' => $pasiendateofbirth,
                'poliklinikname' => $poliklinikname,
                'pasienaddress' => $pasienaddress,
                'journalnumber' => $journalnumber,
                'paymentcardnumber' => $paymentcardnumber,
                'kodepoli' => $kode_bpjs,
                'paymentmethodname' => $paymentmethodname
            ];
            echo json_encode($data);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function PasienRanap()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),
            ];
            $msg = [
                'data' => view('ibs/modalpasienranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataregisterranap()
    {
        if ($this->request->isAJAX()) {


            $search = $this->request->getPost();
            $dateout1 = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout1[0]);
            $sampai = str_replace('/', '-', $dateout1[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelEnJadwal();
            $data = [
                'tampildata' => $register->search_RegisterRanap($search)
            ];

            $msg = [
                'data' => view('ibs/dataregisterranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\ModelTNODetailRJ;
use App\Models\ModelTNOHeaderRajal;
use App\Models\ModelValidasiPembayaranRajal;
use App\Models\ModelValidasiPembayaranPenunjang;
use App\Models\ModelranapOrderPenunjang;
use App\Models\ModelPasienMaster;
use App\Models\ModelValidasiPembayaranFarmasi;
use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;
use Dompdf\Options;


class KasirFAR extends BaseController
{


    public function Validasi()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'penunjang' => $this->data_apotek(),
        ];
        return view('kasirFAR/registerkasirfarmasi', $data);
    }

    public function ambildataBelumValidasi()
    {
        if ($this->request->isAJAX()) {
            $register = new ModelValidasiPembayaranFarmasi();
            $data = [
                'tampildata' => $register->ambildatapenunjang_close()
            ];
            $msg = [
                'data' => view('kasirFAR/dataregisterkasirfarmasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function cariBelumValidasi()
    {
        if ($this->request->isAJAX()) {
            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelValidasiPembayaranFarmasi();
            $data = [
                'tampildata' => $register->search_RegisterPenunjang_close($search)
            ];

            $msg = [
                'data' => view('kasirFAR/dataregisterkasirfarmasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'penunjang' => $this->data_penunjang(),
        ];
        return view('kasirPNJ/registerpenunjang_kasirPNJ', $data);
    }

    public function PaymentPenunjang()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'penunjang' => $this->data_penunjang(),
        ];
        return view('kasirPNJ/registerpenunjang_kasirPNJ', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatapenunjang_close()
            ];
            $msg = [
                'data' => view('kasirPNJ/dataregisterpenunjang_kasirPNJ', $data)
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
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));


            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterPenunjang_close($search)
            ];

            $msg = [
                'data' => view('kasirPNJ/dataregisterpenunjang_kasirPNJ', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildatavalidasi()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_close_validasi()
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataregisterpolivalidasi()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_close_validasi($search)
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function rincianpenunjang($id = '')
    {
        $id = $this->request->getVar('id');
        $perawat = new ModelranapOrderPenunjang();
        $row = $perawat->get_data_tokenByID($id);

        $data = [
            'id' => $row['id'],
            'types' => $row['types'],
            'visited' => $row['visited'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'documentyear' => $row['documentyear'],
            'documentmonth' => $row['documentmonth'],
            'registernumber' => $row['registernumber'],
            'referencenumber' => $row['referencenumber'],
            'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
            'registernumber_rawatinap' => $row['registernumber_rawatinap'],
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
            'faskes' => $row['faskes'],
            'faskesname' => $row['faskesname'],
            'dokter' => $row['dokter'],
            'doktername' => $row['doktername'],
            'employee' => $row['employee'],
            'employeename' => $row['employeename'],
            'smf' => $row['smf'],
            'smfname' => $row['smfname'],
            'classroom' => $row['classroom'],
            'classroomname' => $row['classroomname'],
            'room' => $row['room'],
            'roomname' => $row['roomname'],
            'locationcode' => $row['locationcode'],
            'locationname' => $row['locationname'],
            'referencenumberparent' => $row['referencenumberparent'],
            'icdx' => $row['icdx'],
            'icdxname' => $row['icdxname'],
            'parentid' => $row['parentid'],
            'parentname' => $row['parentname'],
            'createdby' => $row['createdby'],
            'createddate' => $row['createddate'],
            'tgl_order' => $row['tgl_order'],
            'memo' => $row['memo'],
            'token_radiologi' => $row['token_radiologi'],
            'list' => $this->_data_dokter(),
        ];
        echo view('KasirPNJ/detail_penunjang', $data);
    }

    public function rincianrawatjalan_aftervalidasi($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_rajal($id);
        $data = [
            'id' => $row['id'],
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
            'locationcode' => $row['locationcode'],
            'locationname' => $row['locationname'],
            'referencenumberparent' => $row['referencenumberparent'],
            'parentid' => $row['parentid'],
            'parentname' => $row['parentname'],
            'createdby' => $row['createdby'],
            'createddate' => $row['createddate'],
            'reasoncode' => $row['reasoncode'],
            'memo' => $row['memo'],
            'token_rajal' => $row['token_rajal'],
            'email' => $row['email'],
            'poliklinikname' => $row['poliklinikname'],
            'icdx' => $row['icdx'],
            'icdxname' => $row['icdxname'],
            'advicedokter' => $row['advicedokter'],
            'pasienstatus' => $this->status_pasien(),
        ];

        return view('kasirRJ/DRJ_kasirRJ_validasi', $data);
    }



    public function register()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
            ];
            $msg = [
                'data' => view('rawatjalan/modaldaftarrawatjalan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function data_apotek()
    {

        $m_auto = new ModelValidasiPembayaranFarmasi();
        $list = $m_auto->get_list_apotek();
        return $list;
    }

    public function data_payment()
    {

        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_payment();
        return $list;
    }

    public function data_penunjang()
    {

        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_penunjang();
        return $list;
    }

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli();
        return $list;
    }

    public function pelayanan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pelayanan();
        return $list;
    }

    public function sebabsakit()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_sebab_sakit();
        return $list;
    }

    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }

    private function _data_dokter_penunjang($groups)
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_penunjang($groups);
        return $list;
    }

    private function _data_dokter_gizi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_gizi2();
        return $list;
    }

    public function ajax_diagnosa()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        //$term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_diagnosa($key);



        foreach ($data as $row) {

            $json[] = [
                'value' => $row['originalcode'] . ' | ' . $row['name'],
                'id' => $row['id'],
                'code' => $row['code'],
                'subname' => $row['subname'],
                'name' => $row['name']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }



    public function resumeGabungValidasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir($referencenumber);
            $row2 = $m_icd->get_data_rajal_kasir_validasi($referencenumber);
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'OPERASI' => $resume->Operasirajal($referencenumber),
                'PENUNJANG' => $resume->Penunjangrajal($referencenumber),
                'FARMASI' => $resume->FARMASIrajal($referencenumber),
                'BHP' => $resume->BHPrajal($referencenumber),
                'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
                'advicedokter' => $row['advicedokter'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'pasienstatus' => $this->status_pasien(),
                'list' => $this->_data_dokter(),
                'id' => $row['id'],
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

                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'reasoncode' => $row['reasoncode'],
                'memo' => $row['memo'],
                'token_rajal' => $row['token_rajal'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'code' => $row['code'],
                'description' => $row['description'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['disc'],
                'referensibank' => $row2['referensibank'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'idbayar' => $row2['id'],
                'metodepembayaran' => $row2['metodepembayaran'],

            ];
            $msg = [
                'data' => view('kasirRJ/data_resume_gabung_kasirRJ_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }




    public function hubunganpjb()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pjb();
        return $list;
    }

    public function kelasrawat()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kelas();
        return $list;
    }

    public function kamarrawat()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kamar();
        return $list;
    }

    public function bed()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_bed();
        return $list;
    }






    public function status_pasien()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pasien_status_rajal();
        return $list;
    }

    public function metodebayar()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_metodebayar();
        return $list;
    }

    public function daftar_bank()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_bank();
        return $list;
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));
            $simpandata = [
                'dokter' => $this->request->getVar('ibsdokter'),
                'doktername' => $this->request->getVar('ibsdoktername'),
                'email' => $this->request->getVar('email'),
                'memo' => $this->request->getVar('memo'),
                'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
            ];
            $perawat = new ModelPelayananPoli;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data pasien sudah berhasil diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function update_validasipembayaran()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername' => [
                    'label' => 'Nama Dokter',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ],

                'paymentamount' => [
                    'label' => 'Nominal Pembayaran',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
                    ]

                ],

                'statuspasien' => [
                    'label' => 'Cara Pulang',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
                    ]

                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'paymentamount' => $validation->getError('paymentamount'),
                        'statuspasien' => $validation->getError('statuspasien')
                    ]
                ];
            } else {


                $tagihan = $this->request->getVar('grandtotal');
                $nominal = $this->request->getVar('paymentamount');
                $nominal_awal = $this->request->getVar('paymentamount_awal');
                $nominaldebet = $this->request->getVar('nominaldebet');
                $nominaldebet_awal = $this->request->getVar('nominaldebet_awal');
                $metodepembayaran = $this->request->getVar('metodepembayaran');
                $daftarbank = $this->request->getVar('daftarbank');
                $daftarbank_awal = $this->request->getVar('daftarbank_awal');
                $diskon = $this->request->getVar('disc');
                $totaldiscount = $tagihan * ($diskon / 100);




                if ($nominal_awal == $nominal) {
                    $pembayaran = preg_replace("/[^0-9]/", "", $nominal_awal);
                    $kata = "A";
                } else {
                    $pembayaran = preg_replace("/[^0-9]/", "", $nominal);
                    $kata = "B";
                }



                if ($nominaldebet_awal == $nominaldebet) {
                    $debet = preg_replace("/[^0-9]/", "", $nominaldebet_awal);
                } else {
                    $debet = preg_replace("/[^0-9]/", "", $nominaldebet);
                }

                if (($metodepembayaran == "Non Tunai") and ($daftarbank == $daftarbank_awal)) {
                    $bank = $daftarbank_awal;
                } else {
                    if (($metodepembayaran == "Mixed") and ($daftarbank == $daftarbank_awal)) {
                        $bank = $daftarbank_awal;
                    } else {
                        if (($metodepembayaran == "Non Tunai") and ($daftarbank <> $daftarbank_awal)) {
                            $bank = $daftarbank;
                        } else {
                            if (($metodepembayaran == "Mixed") and ($daftarbank <> $daftarbank_awal)) {
                                $bank = $daftarbank;
                            } else {
                                $bank = "";
                            }
                        }
                    }
                }


                if ($debet > 0) {
                    $pay = $pembayaran + $debet;
                } else {
                    if ($debet < 0) {
                        $pay = $pembayaran;
                    } else {
                        $pay = $pembayaran;
                    }
                }



                $totaltagihan = $tagihan - $totaldiscount;



                if ($pay > $totaltagihan) {
                    $paymentstatus = "LUNAS";
                } else if ($pay == $totaltagihan) {
                    $paymentstatus = "LUNAS";
                } else if ($pay < $totaltagihan) {
                    $paymentstatus = "PIUTANG";
                }



                $simpandata = [
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'statuspasien' => $this->request->getVar('statuspasien'),
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('referensibank'),
                    'paymentamount' => $this->request->getVar('paymentamount'),
                    'disc' => $this->request->getVar('disc'),
                    'referensibank' => $bank,
                    'noreferensidebet' => $this->request->getVar('referensibank'),
                    'nominaldebet' => $debet,
                    'payersname' => $this->request->getVar('payersname'),
                    'paymentstatus' => $paymentstatus,
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'modifiedby' => $this->request->getVar('createdby'),
                    'modifieddate' => $this->request->getVar('createddate'),

                ];
                $perawat = new ModelValidasiPembayaranRajal;
                $id = $this->request->getVar('idbayar');
                $perawat->update($id, $simpandata);
                $msg = [
                    'sukses' => 'Data pembayaran sudah berhasil diubah'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ambildataberitaacara()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR PENUNJANG MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac_penunjang($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatapenunjang_beritaacara(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirPNJ/dataregisterpoliklinik_kasirPNJ_beritaacara', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataregisterpoliberitaacara()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR PENUNJANG MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac_penunjang($lokasikasir);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterPenunjang_close_beritaacara($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirPNJ/dataregisterpoliklinik_kasirPNJ_beritaacara', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function cetakkwitansi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienRanap($this->request);
            $lokasikasir = "KASIR RAWAT JALAN";

            $row2 = $m_icd->get_data_rajal_kasir_validasi_print($id);
            $row3 = $m_icd->get_data_kasir($lokasikasir);
            $data = [
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['disc'],
                'referensibank' => $row2['referensibank'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'idbayar' => $row2['id'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'journalnumber' => $row2['journalnumber'],
                'referencenumber' => $row2['referencenumber'],
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi'],
                'waktu' => $row2['created_at'],
                'pasienid' => $row2['pasienid'],
                'pasienname' => $row2['pasienname'],
                'poliklinikname' => $row2['poliklinikname'],
                'paymentmethodname' => $row2['paymentmethodname'],
                'pemeriksaan' => $row2['totaldaftar'],
                'tindakan' => $row2['totaltindakan'],
                'penunjang' => $row2['totalpenunjang'],
                'bhp' => $row2['totalbhp'],
                'farmasi' => $row2['totalfarmasi'],
                'dokter' => $row2['doktername'],
                'pasienstatus' => $row2['statuspasien'],
                'paymentstatus' => $row2['paymentstatus'],
                'kasir' => $row2['createdby'],
                'signaturekasir' => $row2['signaturekasir'],
                'signaturepasien' => $row2['signaturepasien'],


            ];
            $msg = [
                'sukses' => view('kasirRJ/modalprintkwitansi', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function emailkwitansi()
    {

        if ($this->request->isAJAX()) {


            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienRanap($this->request);
            $lokasikasir = "KASIR RAWAT JALAN";
            $row2 = $m_icd->get_data_rajal_kasir_validasi_print($id);
            $row3 = $m_icd->get_data_kasir($lokasikasir);
            $row4 = $m_icd->get_email($id);


            $data = [
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['disc'],
                'referensibank' => $row2['referensibank'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'idbayar' => $row2['id'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'journalnumber' => $row2['journalnumber'],
                'referencenumber' => $row2['referencenumber'],
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi'],
                'waktu' => $row2['created_at'],
                'pasienid' => $row2['pasienid'],
                'pasienname' => $row2['pasienname'],
                'poliklinikname' => $row2['poliklinikname'],
                'paymentmethodname' => $row2['paymentmethodname'],
                'pemeriksaan' => $row2['totaldaftar'],
                'tindakan' => $row2['totaltindakan'],
                'penunjang' => $row2['totalpenunjang'],
                'bhp' => $row2['totalbhp'],
                'farmasi' => $row2['totalfarmasi'],
                'dokter' => $row2['doktername'],
                'pasienstatus' => $row2['statuspasien'],
                'paymentstatus' => $row2['paymentstatus'],
                'kasir' => $row2['createdby'],
                'signaturekasir' => $row2['signaturekasir'],
                'signaturepasien' => $row2['signaturepasien'],
                'email' => $row4['email'],


            ];

            $email = \Config\Services::email();


            $tujuan = $data['email'];
            $dompdf = new Dompdf();
            $html = view('pdf/stylebootstrap');
            $html .= view('pdf/Emailkwitansirajal', $data);
            $dompdf->loadhtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $journalnumber = $data['journalnumber'];
            $name = date('d-m-Y') . '-' . $journalnumber . '-' . 'Informasipelayanan';
            $email->setFrom('simrs2021.syamsudin@gmail.com', 'Informasi Pasien');
            $email->setTo($tujuan);

            $email->setSubject('Kwitansi Pembayaran Pelayanan Pasien Rawat Jalan RSUD R Syamsudin, SH Kota Sukabumi');
            $email->setMessage('Berikut kami sampaikan bukti  pembayaran pelayanan pasien Rawat Jalan');
            $email->attach($dompdf->output(), 'application/pdf', $name . '.pdf', false);
            $email->send();
            $msg = [
                'sukses' => 'Email berhasil dikirim'
            ];
        }
        echo json_encode($msg);
    }

    public function SignatureKasir()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('journalnumber');
            $perawat = new ModelPasienRanap($this->request);
            $row = $perawat->get_data_penunjang_kasir_validasi_signature($referencenumber);
            $data = [
                'id' => $row['id'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['referencenumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'signaturekasir' => $row['signaturekasir'],
                'signaturepasien' => $row['signaturepasien'],
                'kasir' => $row['createdby'],
                'penyetor' => $row['payersname'],
            ];
            $msg = [
                'sukses' => view('kasirPNJ/modalsignaturePNJ', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpansignature()
    {
        if ($this->request->isAJAX()) {


            $simpandata = [
                'signaturekasir' => $this->request->getVar('signature'),
                'signaturepasien' => $this->request->getVar('signaturepasien'),
            ];
            $perawat = new ModelValidasiPembayaranPenunjang;
            $id = $this->request->getVar('id');

            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Tanda tangan berhasil dibubuhkan'
            ];


            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function cetakkwitansikasir()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $referencenumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienRanap($this->request);
            $lokasikasir = "KASIR RAWAT JALAN";

            $row2 = $m_icd->get_data_rajal_kasir_validasi_print2($referencenumber);
            $row3 = $m_icd->get_data_kasir_rajal_print($lokasikasir);
            $data = [
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['disc'],
                'referensibank' => $row2['referensibank'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'idbayar' => $row2['id'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'journalnumber' => $row2['journalnumber'],
                'referencenumber' => $row2['referencenumber'],
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi'],
                'waktu' => $row2['created_at'],
                'pasienid' => $row2['pasienid'],
                'pasienname' => $row2['pasienname'],
                'poliklinikname' => $row2['poliklinikname'],
                'paymentmethodname' => $row2['paymentmethodname'],
                'pemeriksaan' => $row2['totaldaftar'],
                'tindakan' => $row2['totaltindakan'],
                'penunjang' => $row2['totalpenunjang'],
                'bhp' => $row2['totalbhp'],
                'farmasi' => $row2['totalfarmasi'],
                'dokter' => $row2['doktername'],
                'pasienstatus' => $row2['statuspasien'],
                'paymentstatus' => $row2['paymentstatus'],
                'kasir' => $row2['createdby'],
                'signaturekasir' => $row2['signaturekasir'],
                'signaturepasien' => $row2['signaturepasien'],


            ];
            $msg = [
                'sukses' => view('kasirRJ/modalprintkwitansi', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function emailkwitansikasir()
    {

        if ($this->request->isAJAX()) {


            $referencenumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienRanap($this->request);
            $journalnumber = $this->request->getVar('journalnumber');


            $lokasikasir = "KASIR RAWAT JALAN";
            $row2 = $m_icd->get_data_rajal_kasir_validasi_print2($referencenumber);
            $row3 = $m_icd->get_data_kasir($lokasikasir);
            $row4 = $m_icd->get_data_rajal_close_email($journalnumber);
            $data = [
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['disc'],
                'referensibank' => $row2['referensibank'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'idbayar' => $row2['id'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'journalnumber' => $row2['journalnumber'],
                'referencenumber' => $row2['referencenumber'],
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi'],
                'waktu' => $row2['created_at'],
                'pasienid' => $row2['pasienid'],
                'pasienname' => $row2['pasienname'],
                'poliklinikname' => $row2['poliklinikname'],
                'paymentmethodname' => $row2['paymentmethodname'],
                'pemeriksaan' => $row2['totaldaftar'],
                'tindakan' => $row2['totaltindakan'],
                'penunjang' => $row2['totalpenunjang'],
                'bhp' => $row2['totalbhp'],
                'farmasi' => $row2['totalfarmasi'],
                'dokter' => $row2['doktername'],
                'pasienstatus' => $row2['statuspasien'],
                'paymentstatus' => $row2['paymentstatus'],
                'email' => $row4['email'],
                'kasir' => $row2['createdby'],
                'signaturekasir' => $row2['signaturekasir'],
                'signaturepasien' => $row2['signaturepasien'],


            ];

            $email = \Config\Services::email();


            $tujuan = $data['email'];
            $dompdf = new Dompdf();
            $html = view('pdf/stylebootstrap');
            $html .= view('pdf/Emailkwitansirajal', $data);
            $dompdf->loadhtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $journalnumber = $data['journalnumber'];
            $name = date('d-m-Y') . '-' . $journalnumber . '-' . 'Informasipelayanan';
            $email->setFrom('simrs2021.syamsudin@gmail.com', 'Informasi Pasien');
            $email->setTo($tujuan);

            $email->setSubject('Kwitansi Pembayaran Pelayanan Pasien Rawat Jalan RSUD R Syamsudin, SH Kota Sukabumi');
            $email->setMessage('Berikut kami sampaikan bukti  pembayaran pelayanan pasien Rawat Jalan');
            $email->attach($dompdf->output(), 'application/pdf', $name . '.pdf', false);
            $email->send();
            $msg = [
                'sukses' => 'Email berhasil dikirim'
            ];
        }
        echo json_encode($msg);
    }

    public function printdetailkwitansi()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR PENUNJANG MEDIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_penunjang($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganpenunjangprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'PENUNJANG' => $resume->Kasir_Penunjangrajal($referencenumber),
            'BHP' => $resume->KasirBHPrajal_penunjang($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/printdetailpenunjang', $data);
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }



    public function ambildatavalidasiPNJ()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatapenunjang_close_validasi()
            ];
            $msg = [
                'data' => view('kasirPNJ/dataregisterpenunjang_kasirPNJ_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataregisterpolivalidasiPNJ()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterPenunjang_close_validasi($search)
            ];

            $msg = [
                'data' => view('kasirPNJ/dataregisterpenunjang_kasirPNJ_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function rincianpenunjang_aftervalidasi($id = '')
    {
        $id = $this->request->getVar('id');
        $perawat = new ModelranapOrderPenunjang();
        $row = $perawat->get_data_tokenByID_validasi($id);

        $data = [
            'id' => $row['id'],
            'types' => $row['types'],
            'visited' => $row['visited'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'documentyear' => $row['documentyear'],
            'documentmonth' => $row['documentmonth'],
            'registernumber' => $row['registernumber'],
            'referencenumber' => $row['referencenumber'],
            'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
            'registernumber_rawatinap' => $row['registernumber_rawatinap'],
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
            'faskes' => $row['faskes'],
            'faskesname' => $row['faskesname'],
            'dokter' => $row['dokter'],
            'doktername' => $row['doktername'],
            'employee' => $row['employee'],
            'employeename' => $row['employeename'],
            'smf' => $row['smf'],
            'smfname' => $row['smfname'],
            'classroom' => $row['classroom'],
            'classroomname' => $row['classroomname'],
            'room' => $row['room'],
            'roomname' => $row['roomname'],
            'locationcode' => $row['locationcode'],
            'locationname' => $row['locationname'],
            'referencenumberparent' => $row['referencenumberparent'],
            'icdx' => $row['icdx'],
            'icdxname' => $row['icdxname'],
            'parentid' => $row['parentid'],
            'parentname' => $row['parentname'],
            'createdby' => $row['createdby'],
            'createddate' => $row['createddate'],
            'tgl_order' => $row['tgl_order'],
            'memo' => $row['memo'],
            'token_radiologi' => $row['token_radiologi'],
            'list' => $this->_data_dokter(),
        ];
        echo view('KasirPNJ/detail_penunjang_validasi', $data);
    }


    public function lihatrincianFarmasi()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $pasienid = $this->request->getVar('pasienid');
            $m_icd = new ModelValidasiPembayaranFarmasi();
            $data = [
                'pasienlama' => $m_icd->get_data_penunjang($id),
                'pasienstatus' => $this->status_pasien(),
            ];
            $msg = [
                'sukseslihat' => view('kasirFAR/modalpembayaranfarmasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function resumeGabung()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelValidasiPembayaranFarmasi();
            $row = $m_icd->get_data_rajal_kasir_penunjang($referencenumber);
            $groups = $row['groups'];
            $id = $row['id'];
            $data = [

                'DetailObat' => $m_icd->get_data_detail_apotek($referencenumber),
                'kodejournal' => $referencenumber,
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'pasienlama' => $m_icd->get_data_penunjang($id),
            ];
            $msg = [
                'data' => view('kasirFAR/data_form_pelayanan_apotek', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function validasipembayaranFAR()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'paymentamount' => [
                    'label' => 'Nominal Pembayaran',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'paymentamount' => $validation->getError('paymentamount')
                    ]
                ];
            } else {
                $db = db_connect();
                $locationcode = $this->request->getVar('locationcode');
                $kodekasir = "RSUD45";
                $kwi = "KWI-APO";
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(validationnumber) as kode_jurnal FROM transaksi_kasir_apotek WHERE  created_at='$documentdate' ORDER BY id DESC LIMIT 1");
                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                $today = date('ymd');
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                $newkode = $kwi . $underscore . $kodekasir . $underscore  . $today . $underscore . sprintf('%06s', $nourut);

                $tanggallahir = $this->request->getVar('pasiendateofbirth');
                $dob = strtotime($tanggallahir);
                $current_time = time();
                $age_years = date('Y', $current_time) - date('Y', $dob);
                $age_months = date('m', $current_time) - date('m', $dob);
                $age_days = date('d', $current_time) - date('d', $dob);

                if ($age_days < 0) {
                    $days_in_month = date('t', $current_time);
                    $age_months--;
                    $age_days = $days_in_month + $age_days;
                }

                if ($age_months < 0) {
                    $age_years--;
                    $age_months = 12 + $age_months;
                }
                $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";

                $tagihan = $this->request->getVar('grandtotal');
                $nominal = $this->request->getVar('paymentamount');
                $nominaldebet = $this->request->getVar('nominaldebet');
                $diskon = $this->request->getVar('disc');
                $totaldiscount = $tagihan * ($diskon / 100);
                $pembayaran = preg_replace("/[^0-9]/", "", $nominal);

                $pay = $pembayaran + $nominaldebet;
                $totaltagihan = $tagihan - $totaldiscount;

                if ($pay >= $totaltagihan) {
                    $paymentstatus = "LUNAS";
                } else {
                    $paymentstatus = "PIUTANG";
                }

                $pembayar = $this->request->getVar('payersname');

                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'documentdate' => $documentdate,
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'oldcode' => $this->request->getVar('oldcode'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'pasiengender' => $this->request->getVar('pasiengender'),
                    'pasienage' => $umur,
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                    'pasienaddress' => $this->request->getVar('pasienaddress'),
                    'pasienarea' => $this->request->getVar('pasienarea'),
                    'pasiensubarea' => $this->request->getVar('pasiensubarea'),
                    'pasiensubareaname' => $this->request->getVar('pasiensubareaname'),
                    'paymentmethod' => $this->request->getVar('paymentmethod'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'dokter' => $this->request->getVar('dokter_pengirim'),
                    'doktername' => $this->request->getVar('doktername_pengirim'),
                    'employee' => $this->request->getVar('dokter'),
                    'employeename' => $this->request->getVar('doktername'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'disc' => $this->request->getVar('disc'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'paymentamount' => $this->request->getVar('paymentamount'),
                    'memo' => $this->request->getVar('memo'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),

                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'payersname' => $this->request->getVar('payersname'),
                    'paymentstatus' => $paymentstatus,
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('daftarbank'),
                    'nominaldebet' => $this->request->getVar('nominaldebet'),
                    'noreferensidebet' => $this->request->getVar('referensibank'),


                ];
                if ($pay < 0) {
                    $msg = [
                        'gagal' => 'Validasi pembayaran Penunjang Berhasil',
                    ];
                } else {
                    $perawat = new ModelValidasiPembayaranFarmasi;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Validasi pembayaran Resep Berhasil',
                        'jumlahbayar' => $pembayaran,
                        'pembayar' => $pembayar,
                        'validationnumber' => $newkode,
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printbuktipembayaranpenunjang()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR PENUNJANG MEDIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_buktipembayaran_penunjang($lokasikasir);
        $row3 = $pasien->get_data_print_detail_penunjang($journalnumber);
        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganpenunjangprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'PENUNJANG' => $resume->Kasir_Penunjangrajal($referencenumber),
            'BHP' => $resume->KasirBHPrajal_penunjang($referencenumber),

        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_buktipembayaran_penunjang', $data);
        $options = new Options();
        $options->setIsRemoteEnabled(true);

        $dompdf->setOptions($options);
        $dompdf->output();
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }


    public function AfterValidasi()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'penunjang' => $this->data_apotek(),
        ];
        return view('kasirFAR/registerkasirfarmasivalidasi', $data);
    }

    public function ambildataAfterValidasi()
    {
        if ($this->request->isAJAX()) {
            $register = new ModelValidasiPembayaranFarmasi();
            $data = [
                'tampildata' => $register->ambildatapenunjang_close_validasi()
            ];
            $msg = [
                'data' => view('kasirFAR/dataregisterkasirfarmasivalidasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function cariDataAfterValidasi()
    {
        if ($this->request->isAJAX()) {
            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelValidasiPembayaranFarmasi();
            $data = [
                'tampildata' => $register->search_RegisterPenunjang_close_validasi($search)
            ];
            $msg = [
                'data' => view('kasirFAR/dataregisterkasirfarmasivalidasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatrincianFarmasiValidasi()
    {
        if ($this->request->isAJAX()) {
            $journalnumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelValidasiPembayaranFarmasi();
            $data = [
                'pasienlama' => $m_icd->get_data_penunjang_header($journalnumber),
                'pasienstatus' => $this->status_pasien(),
            ];
            $msg = [
                'suksesvalidasi' => view('kasirFAR/modalpembayaranfarmasivalidasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function resumeGabung_aftervalidasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_penunjang($referencenumber);
            $row2 = $m_icd->get_data_rajal_kasir_penunjang_validasi($referencenumber);
            $groups = $row['groups'];
            $data = [

                'PENUNJANG' => $resume->Kasir_Penunjangrajal($referencenumber),
                'BHP' => $resume->KasirBHPrajal_penunjang($referencenumber),
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'id' => $row['id'],
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
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'memo' => $row['memo'],
                'token_rajal' => $row['token_radiologi'],
                'validation' => $row['validation'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'employee' => $row['employee'],
                'employeename' => $row['employeename'],
                'list' => $this->_data_dokter_penunjang($groups),
                'roomname' => $row['roomname'],
                'room' => $row['room'],
                'classroomname' => $row['classroomname'],
                'classroom' => $row['classroom'],
                'paymentamount' => $row2['paymentamount'],
                'payersname' => $row2['payersname'],
                'referensibank' => $row2['referensibank'],
                'nominaldebet' => $row2['nominaldebet'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'idbayar' => $row2['id'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'disc' => $row2['disc'],
            ];
            $msg = [
                'data' => view('kasirPNJ/data_resume_gabung_kasirPNJ_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function update_validasipembayaranFAR()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([

                'paymentamount' => [
                    'label' => 'Nominal Pembayaran',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
                    ]

                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [

                        'paymentamount' => $validation->getError('paymentamount')
                    ]
                ];
            } else {


                $tagihan = $this->request->getVar('grandtotal');
                $nominal = $this->request->getVar('paymentamount');
                $nominal_awal = $this->request->getVar('paymentamount_awal');
                $nominaldebet = $this->request->getVar('nominaldebet');
                $nominaldebet_awal = $this->request->getVar('nominaldebet_awal');
                $metodepembayaran = $this->request->getVar('metodepembayaran');
                $daftarbank = $this->request->getVar('daftarbank');
                $daftarbank_awal = $this->request->getVar('daftarbank_awal');
                $diskon = $this->request->getVar('disc');
                $totaldiscount = $tagihan * ($diskon / 100);

                if ($nominal_awal == $nominal) {
                    $pembayaran = preg_replace("/[^0-9]/", "", $nominal_awal);
                    $kata = "A";
                } else {
                    $pembayaran = preg_replace("/[^0-9]/", "", $nominal);
                    $kata = "B";
                }

                if ($nominaldebet_awal == $nominaldebet) {
                    $debet = preg_replace("/[^0-9]/", "", $nominaldebet_awal);
                } else {
                    $debet = preg_replace("/[^0-9]/", "", $nominaldebet);
                }

                if (($metodepembayaran == "Non Tunai") and ($daftarbank == $daftarbank_awal)) {
                    $bank = $daftarbank_awal;
                } else {
                    if (($metodepembayaran == "Mixed") and ($daftarbank == $daftarbank_awal)) {
                        $bank = $daftarbank_awal;
                    } else {
                        if (($metodepembayaran == "Non Tunai") and ($daftarbank <> $daftarbank_awal)) {
                            $bank = $daftarbank;
                        } else {
                            if (($metodepembayaran == "Mixed") and ($daftarbank <> $daftarbank_awal)) {
                                $bank = $daftarbank;
                            } else {
                                $bank = "";
                            }
                        }
                    }
                }


                if ($debet > 0) {
                    $pay = $pembayaran + $debet;
                } else {
                    if ($debet < 0) {
                        $pay = $pembayaran;
                    } else {
                        $pay = $pembayaran;
                    }
                }

                $totaltagihan = $tagihan - $totaldiscount;
                if ($pay > $totaltagihan) {
                    $paymentstatus = "LUNAS";
                } else if ($pay == $totaltagihan) {
                    $paymentstatus = "LUNAS";
                } else if ($pay < $totaltagihan) {
                    $paymentstatus = "PIUTANG";
                }

                $simpandata = [
                    'dokter' => $this->request->getVar('dokter_pengirim'),
                    'doktername' => $this->request->getVar('doktername_pengirim'),
                    'employee' => $this->request->getVar('dokter'),
                    'employeename' => $this->request->getVar('doktername'),
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('referensibank'),
                    'paymentamount' => $this->request->getVar('paymentamount'),
                    'disc' => $this->request->getVar('disc'),
                    'referensibank' => $bank,
                    'noreferensidebet' => $this->request->getVar('referensibank'),
                    'nominaldebet' => $debet,
                    'payersname' => $this->request->getVar('payersname'),
                    'paymentstatus' => $paymentstatus,
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'modifiedby' => $this->request->getVar('createdby'),
                    'modifieddate' => $this->request->getVar('createddate'),

                ];
                $perawat = new ModelValidasiPembayaranFarmasi;
                $id = $this->request->getVar('idbayar');
                $perawat->update($id, $simpandata);
                $msg = [
                    'sukses' => 'Data pembayaran sudah berhasil diubah'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function BatalValidasi()
    {
        if ($this->request->isAJAX()) {

            $journalnumber = $this->request->getVar('journalnumber');
            $deletedby = $this->request->getVar('deletedby');
            $canceldate = date('Y-m-d h:m:s');
            $kasir = new ModelValidasiPembayaranFarmasi();
            $databayar = $kasir->ambildatapembayaran_apotek($journalnumber);
            $id = $databayar['id'];
            $nokwi = $databayar['validationnumber'];
            $kasir->delete($id);

            $msg = [
                'sukses' => "Data pembayaran dengan no Kwitansi : $nokwi Berhasil dibatalkan"
            ];

            echo json_encode($msg);
        }
    }


    public function BeritaAcara()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'penunjang' => $this->data_apotek(),
        ];
        return view('kasirFAR/registerkasirfarmasiberitaacara', $data);
    }


    public function ambildataberitaacaraFAR()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR PENUNJANG MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);
            $register = new ModelValidasiPembayaranFarmasi();
            $data = [
                'tampildata' => $register->ambildatapenunjang_beritaacara(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirFAR/dataregister_farmasi_beritaacara', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataberitaacaraFAR()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR PENUNJANG MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelValidasiPembayaranFarmasi();
            $data = [
                'tampildata' => $register->search_RegisterPenunjang_close_beritaacara($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirFAR/dataregister_farmasi_beritaacara', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function printdetailkwitansiTagihan()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR PENUNJANG MEDIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_penunjang($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganpenunjangprintTagihanPenunjang($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'PENUNJANG' => $resume->Kasir_Penunjangrajal($referencenumber),
            'BHP' => $resume->KasirBHPrajal_penunjang($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/printdetailtagihanpenunjang', $data);
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printdetailkwitansiTagihanKonvensional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR PENUNJANG MEDIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_penunjang($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganpenunjangprintTagihanPenunjang($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'PENUNJANG' => $resume->Kasir_Penunjangrajal($referencenumber),
            'BHP' => $resume->KasirBHPrajal_penunjang($referencenumber),
        ];
        return view('cetakan/printdetailtindakanpenunjang', $data);
    }

    public function printdetailkwitansiTagihanKonvensionalKasir()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR PENUNJANG MEDIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_penunjang($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganpenunjangprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'PENUNJANG' => $resume->Kasir_Penunjangrajal($referencenumber),
            'BHP' => $resume->KasirBHPrajal_penunjang($referencenumber),
        ];
        return view('cetakan/printdetailtindakanpenunjangkasir', $data);
    }

    public function printbuktipembayaranpenunjangKonvensional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR PENUNJANG MEDIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_buktipembayaran_penunjang($lokasikasir);
        $row3 = $pasien->get_data_print_detail_penunjang($journalnumber);
        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganpenunjangprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'PENUNJANG' => $resume->Kasir_Penunjangrajal($referencenumber),
            'BHP' => $resume->KasirBHPrajal_penunjang($referencenumber),

        ];
        return view('cetakan/print_buktipembayaran_penunjang', $data);
    }

    public function resumeGabungValidasiApotek()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelValidasiPembayaranFarmasi();
            $row = $m_icd->get_data_rajal_kasir_penunjang($referencenumber);
            $groups = $row['groups'];
            $id = $row['id'];
            $data = [

                'DetailObat' => $m_icd->get_data_detail_apotek($referencenumber),
                'kodejournal' => $referencenumber,
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'pasienlama' => $m_icd->get_data_penunjang($id),
            ];
            $msg = [
                'data' => view('kasirFAR/data_form_pelayanan_apotek_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printbuktipembayaranapotekKonvensional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR PENUNJANG MEDIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelValidasiPembayaranFarmasi();
        $row2 = $pasien->get_data_buktipembayaran_penunjang($lokasikasir);
        $row3 = $pasien->get_data_print_detail_penunjang($journalnumber);
        $resume = new ModelValidasiPembayaranFarmasi();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganpenunjangprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'PENUNJANG' => $resume->Kasir_Penunjangrajal($referencenumber),
        ];
        return view('cetakan/print_buktipembayaran_apotek', $data);
    }
}

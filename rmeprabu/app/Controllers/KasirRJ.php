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
use App\Models\ModelPasienMaster;
use App\Models\ModelDeletePembayaranRajal;
use App\Models\ModelTNODetail;
use App\Models\ModelBayarTindakanRajal;
use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;
use Dompdf\Options;


class KasirRJ extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('kasirRJ/registerpoliklinik_kasirRJ', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_close()
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ', $data)
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

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_close($search)
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ', $data)
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
            // $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            // $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));


            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            // $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            // $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

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





    public function rincianrawatjalan($id = '')
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

        return view('kasirRJ/DRJ_kasirRJ', $data);
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


    public function validasipembayaran()
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


                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $lokasi = $this->request->getVar('poliklinik');
                $kwi = "KWI";
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, noantrian as noantrian FROM transaksi_kasir_rawatjalan WHERE  created_at='$documentdate' and groups='$groups' LIMIT 1");
                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                $today = date('ymd');
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                $newkode = $kwi . $underscore . $groups . $underscore  . $today . $underscore . sprintf('%06s', $nourut);




                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);



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
                $payersname = $this->request->getVar('payersname');
                $diskon = $this->request->getVar('disc');
                $totaldiscount = $tagihan * ($diskon / 100);
                $pembayaran = preg_replace("/[^0-9]/", "", $nominal);

                if ($nominaldebet == "") {
                    $nominaldebet = 0;
                }

                $pay = $pembayaran + $nominaldebet;
                $totaltagihan = $tagihan - $totaldiscount;




                $karcis = $this->request->getVar('totaldaftar');
                $bersih = $totaltagihan - $karcis;
                $cabarpasien = $this->request->getVar('paymentmethodname');

                if ($cabarpasien == "TUNAI") {
                    if ($pay > $bersih) {
                        $paymentstatus = "LUNAS";
                    } else if ($pay == $bersih) {
                        $paymentstatus = "LUNAS";
                    } else if ($pay < $bersih) {
                        $paymentstatus = "PIUTANG";
                    }
                } else {
                    if ($pay > $totaltagihan) {
                        $paymentstatus = "LUNAS";
                    } else if ($pay == $totaltagihan) {
                        $paymentstatus = "LUNAS";
                    } else if ($pay < $totaltagihan) {
                        $paymentstatus = "PIUTANG";
                    }
                }



                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $documentdate,
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'registernumber' => $this->request->getVar('registernumber'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                    'noantrian' => $no_antrian,
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
                    'code' => $this->request->getVar('code_pelayanan'),
                    'description' => $this->request->getVar('description'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'employee' => $this->request->getVar('employee'),
                    'employeename' => $this->request->getVar('employeename'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'reasoncode' => $this->request->getVar('reasoncode'),
                    'statuspasien' => $this->request->getVar('statuspasien'),
                    'totaldaftar' => $this->request->getVar('totaldaftar'),
                    'totaltindakan' => $this->request->getVar('totaltindakan'),
                    'totalbhp' => $this->request->getVar('totalbhp'),
                    'totalitembhp' => $this->request->getVar('totalitembhp'),
                    'totalfarmasi' => $this->request->getVar('totalfarmasi'),
                    'totalpenunjang' => $this->request->getVar('totalpenunjang'),
                    'kasirpenunjang' => $this->request->getVar('kasirpenunjang'),
                    'subtotal' => $this->request->getVar('grandtotal'),
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'grandtotal' => $totaltagihan,
                    'paymentamount' => $pembayaran,
                    'memo' => $this->request->getVar('memo'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'penunjang' => $this->request->getVar('penunjang'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'payersname' => $this->request->getVar('payersname'),
                    'paymentstatus' => $paymentstatus,
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('daftarbank'),
                    'nominaldebet' => $nominaldebet,
                    'noreferensidebet' => $this->request->getVar('referensibank'),


                ];
                $perawat = new ModelValidasiPembayaranRajal;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Validasi pembayaran Berhasil',
                    'paymentamount' => $pembayaran,
                    'payersname' => $payersname,
                    'nominaldebet' => $nominaldebet
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function formubahmaster()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new ModelPelayananPoli();
            $row = $perawat->find($id);
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
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['referencedate'],
                'email' => $row['email'],
                'token_rajal' => $row['token_rajal'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'list' => $this->_data_dokter(),
                'namasmf' => $this->smf(),


            ];
            $msg = [
                'sukses' => view('rawatjalan/modaleditrajal', $data)
            ];
            echo json_encode($msg);
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

    public function resumeGabung()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir($referencenumber);
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
                'validation' => $row['validation'],
                'description' => $row['description'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
            ];
            $msg = [
                'data' => view('kasirRJ/data_resume_gabung_kasirRJ', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
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
                'list' => $this->_data_dokter_all(),
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



    public function TNO()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal($id);
            $namapoli = $row['poliklinikname'];
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['journalnumber'],
                'bpjs_sep' => $row['bpjs_sep'],
                'noantrian' => $row['noantrian'],
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
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'paymentmethod_payment' => $row['paymentmethod_payment'],
                'paymentmethodname_payment' => $row['paymentmethodname_payment'],
                'paymentcardnumber_payment' => $row['paymentcardnumber_payment'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['poliklinik'],
                'smfname' => $row['poliklinikname'],
                'datein' => $row['registerdate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'classroom' => $row['poliklinikclass'],
                'classroomname' => $row['poliklinikclassname'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],

                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),
                'paramedic' => $this->data_paramedic($namapoli),

            ];
            $msg = [
                'sukses' => view('kasirRJ/modalinputTNOrajal', $data)
            ];
            echo json_encode($msg);
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

    public function simpanTNOheader()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername_TH' => [
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
                        'doktername_TH' => $validation->getError('doktername_TH')
                    ]
                ];
            } else {
                $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));

                $db = db_connect();
                $groups = "IRJ";
                $lokasi = $this->request->getVar('poliklinik_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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

                $newkode = $groups . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $dokter = $this->request->getVar('dokter_TH');
                $doktername = $this->request->getVar('doktername_TH');

                $smf = "NONE";
                $employee = "NONE";

                $simpandata = [

                    'groups' => $this->request->getVar('groups_TH'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep_TH'),
                    'noantrian' => $this->request->getVar('noantrian_TH'),
                    'pasienid' => $this->request->getVar('pasienid_TH'),
                    'oldcode' => $this->request->getVar('oldcode_TH'),
                    'pasienname' => $this->request->getVar('pasienname_TH'),
                    'pasiengender' => $this->request->getVar('pasiengender_TH'),
                    'pasienage' => $this->request->getVar('pasienage_TH'),
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth_TH'),
                    'pasienaddress' => $this->request->getVar('pasienaddress_TH'),
                    'pasienarea' => $this->request->getVar('pasienarea_TH'),
                    'pasiensubarea' => $this->request->getVar('pasiensubarea_TH'),
                    'pasiensubareaname' => $this->request->getVar('pasiensubareaname_TH'),
                    'paymentmethod' => $this->request->getVar('paymentmethod_TH'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname_TH'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber_TH'),
                    'poliklinik' => $this->request->getVar('poliklinik_TH'),
                    'poliklinikname' => $this->request->getVar('poliklinikname_TH'),
                    'smf' => $smf,
                    'employee' => $employee,
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),

                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelTNOHeaderRajal;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Header Berhasil, silahkan isi detail',
                    'JN' => $newkode,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ajax_pelayanan()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan_rajal($term, $key);



        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'],
                'id' => $row['id'],
                'code' => $row['code'],
                'groupname' => $row['groupname'],
                'price' => $row['price'],
                'category' => $row['category'],
                'groups' => $row['groups'],
                'share1ori' => $row['share1'],
                'share2ori' => $row['share2'],
                'types' => $row['types'],

            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function ajax_pelayanan_gizi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan_rajal_gizi($term, $key);



        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'],
                'id' => $row['id'],
                'code' => $row['code'],
                'groupname' => $row['groupname'],
                'price' => $row['price'],
                'category' => $row['category'],
                'groups' => $row['groups'],
                'share1ori' => $row['share1'],
                'share2ori' => $row['share2'],
                'types' => $row['types'],

            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function simpanTNODetail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Tindakan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'name' => $validation->getError('name')
                    ]
                ];
            } else {

                $price = $this->request->getVar('price');
                $bhp = $this->request->getVar('bhp');
                $qty = $this->request->getVar('qty');
                $totaltarif = $price * $qty;
                $totalbhp = $bhp;
                $subtotal = $totaltarif + $totalbhp;


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'relation' => $this->request->getVar('relation'),
                    'relationname' => $this->request->getVar('relationname'),
                    'paymentmethod' => $this->request->getVar('paymentmethod'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'employee' => $this->request->getVar('employee'),
                    'employeename' => $this->request->getVar('employeename'),
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),
                    'price' => $price,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $tno = new ModelTNODetailRJ;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Berhasil Ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeTNO()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetailRJ();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->search($referencenumber)
            ];
            $msg = [
                'data' => view('rawatjalan/data_resume_TNO_rajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusTNO()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelTNODetailRJ;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Tindakan dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function APG()
    {
        if ($this->request->isAJAX()) {

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
                'referencenumber' => $row['journalnumber'],
                'bpjs_sep' => $row['bpjs_sep'],
                'noantrian' => $row['noantrian'],
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
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'paymentmethod_payment' => $row['paymentmethod_payment'],
                'paymentmethodname_payment' => $row['paymentmethodname_payment'],
                'paymentcardnumber_payment' => $row['paymentcardnumber_payment'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['poliklinik'],
                'smfname' => $row['poliklinikname'],
                'datein' => $row['registerdate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'classroom' => $row['poliklinikclass'],
                'classroomname' => $row['poliklinikclassname'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],

                'list' => $this->_data_dokter_gizi(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatjalan/modalinputAPGrajal', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanAPGheader()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername_TH' => [
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
                        'doktername_TH' => $validation->getError('doktername_TH')
                    ]
                ];
            } else {
                $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));

                $db = db_connect();
                $groups = "IRJ";
                $lokasi = $this->request->getVar('poliklinik_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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

                $newkode = $groups . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $dokter = $this->request->getVar('dokter_TH');
                $doktername = $this->request->getVar('doktername_TH');

                $smf = "NONE";
                $employee = "NONE";

                $simpandata = [

                    'groups' => $this->request->getVar('groups_TH'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep_TH'),
                    'noantrian' => $this->request->getVar('noantrian_TH'),
                    'pasienid' => $this->request->getVar('pasienid_TH'),
                    'oldcode' => $this->request->getVar('oldcode_TH'),
                    'pasienname' => $this->request->getVar('pasienname_TH'),
                    'pasiengender' => $this->request->getVar('pasiengender_TH'),
                    'pasienage' => $this->request->getVar('pasienage_TH'),
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth_TH'),
                    'pasienaddress' => $this->request->getVar('pasienaddress_TH'),
                    'pasienarea' => $this->request->getVar('pasienarea_TH'),
                    'pasiensubarea' => $this->request->getVar('pasiensubarea_TH'),
                    'pasiensubareaname' => $this->request->getVar('pasiensubareaname_TH'),
                    'paymentmethod' => $this->request->getVar('paymentmethod_TH'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname_TH'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber_TH'),
                    'poliklinik' => $this->request->getVar('poliklinik_TH'),
                    'poliklinikname' => $this->request->getVar('poliklinikname_TH'),
                    'smf' => $smf,
                    'employee' => $employee,
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),

                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelTNOHeaderRajal;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Header Berhasil, silahkan isi detail',
                    'JN' => $newkode,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanAPGDetail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Tindakan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'name' => $validation->getError('name')
                    ]
                ];
            } else {

                $price = $this->request->getVar('price');
                $bhp = $this->request->getVar('bhp');
                $qty = $this->request->getVar('qty');
                $totaltarif = $price * $qty;
                $totalbhp = $bhp;
                $subtotal = $totaltarif + $totalbhp;


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'relation' => $this->request->getVar('relation'),
                    'relationname' => $this->request->getVar('relationname'),
                    'paymentmethod' => $this->request->getVar('paymentmethod'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'employee' => $this->request->getVar('employee'),
                    'employeename' => $this->request->getVar('employeename'),
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),
                    'price' => $price,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $tno = new ModelTNODetailRJ;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Berhasil Ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGizi()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetailRJ();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->searchAsupanGizi($referencenumber)
            ];
            $msg = [
                'data' => view('rawatjalan/data_resume_gizi_rajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusAPG()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelTNODetailRJ;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Tindakan dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function tambahTNOdetail()
    {
        if ($this->request->isAJAX()) {

            $journalnumber = $this->request->getVar('journalnumber');

            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_by_journalnumber($journalnumber);
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['referencenumber'],
                'bpjs_sep' => $row['bpjs_sep'],
                'noantrian' => $row['noantrian'],
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
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['poliklinik'],
                'smfname' => $row['poliklinikname'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatjalan/modalinputTNOrajal_add', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function ValidasiPemeriksaan()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new ModelPelayananPoli();
            $row = $perawat->find($id);
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
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['referencedate'],
                'email' => $row['email'],
                'token_rajal' => $row['token_rajal'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'list' => $this->_data_dokter(),
                'pasienstatus' => $this->status_pasien(),
                'signature' => $row['signaturedokter'],
                'anamnesa' => $row['anamnesa'],
                'hasilperiksa' => $row['hasilperiksa'],
                'advicedokter' => $row['advicedokter'],
                'indikasirawat' => $row['indikasirawat'],


            ];
            $msg = [
                'sukses' => view('kasirRJ/modalvalidasipoli_kasirRJ', $data)
            ];
            echo json_encode($msg);
        }
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

    public function simpanpemeriksaan()
    {
        if ($this->request->isAJAX()) {

            $signature_awal = $this->request->getVar('signature_awal');
            $signature_baru = $this->request->getVar('signature');

            // if ($signature_baru = " ") {
            //     $signature = $signature_awal;
            // } else {
            //     if ($signature_baru != " ") {
            //         $signature = $signature_baru;
            //     }
            // }

            $simpandata = [
                'anamnesa' => $this->request->getVar('anamnesa'),
                'hasilperiksa' => $this->request->getVar('hasilperiksa'),
                'advicedokter' => $this->request->getVar('advicedokter'),
                'indikasirawat' => $this->request->getVar('indikasi'),
                'signaturedokter' => $signature_baru,
                'validasipemeriksaan' => $this->request->getVar('validasipemeriksaan'),
            ];
            $perawat = new ModelPelayananPoli;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Pemeriksaan Pasien Telah Selesai'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
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


                if ($nominaldebet == "") {
                    $nominaldebet = 0;
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
                $karcis = $this->request->getVar('totaldaftar');
                $bersih = $totaltagihan - $karcis;
                $cabarpasien = $this->request->getVar('paymentmethodname');

                if ($cabarpasien == "TUNAI") {
                    if ($pay > $bersih) {
                        $paymentstatus = "LUNAS";
                    } else if ($pay == $bersih) {
                        $paymentstatus = "LUNAS";
                    } else if ($pay < $bersih) {
                        $paymentstatus = "PIUTANG";
                    }
                } else {
                    if ($pay > $totaltagihan) {
                        $paymentstatus = "LUNAS";
                    } else if ($pay == $totaltagihan) {
                        $paymentstatus = "LUNAS";
                    } else if ($pay < $totaltagihan) {
                        $paymentstatus = "PIUTANG";
                    }
                }


                $simpandata = [
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'statuspasien' => $this->request->getVar('statuspasien'),
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('referensibank'),
                    'paymentamount' => $pembayaran,
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

            $lokasikasir = "KASIR RAWAT JALAN";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_beritaacara(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_beritaacara', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataregisterpoliberitaacara()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR RAWAT JALAN";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));


            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_close_beritaacara($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_beritaacara', $data)
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
            $row = $perawat->get_data_rajal_kasir_validasi_signature($referencenumber);
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
                'sukses' => view('kasirRJ/modalsignature', $data)
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
            $perawat = new ModelValidasiPembayaranRajal;
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

        $lokasikasir = "KASIR RAWAT JALAN";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganigdprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'TNO' => $resume->search_rajal2($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'OPERASI' => $resume->Operasirajal($referencenumber),
            'PENUNJANG' => $resume->Penunjangheaderrajal($referencenumber),
            'FARMASI' => $resume->FARMASIrajal($referencenumber),
            'BHP' => $resume->BHPrajal($referencenumber),
            'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
        ];




        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/printdetailrajal', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printbuktipembayaran()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT JALAN";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_buktipembayaran($lokasikasir);
        $row3 = $pasien->get_data_print_detail($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganigdprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'TNO' => $resume->search_igd($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'OPERASI' => $resume->Operasirajal($referencenumber),
            'PENUNJANG' => $resume->Penunjangheaderrajal($referencenumber),
            'FARMASI' => $resume->FARMASIrajal($referencenumber),
            'BHP' => $resume->BHPrajal($referencenumber),
            'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_buktipembayaran_rajal', $data);
        $options = new Options();
        $options->setIsRemoteEnabled(true);

        $dompdf->setOptions($options);
        $dompdf->output();
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function BayarRajal()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'pasienlama' => $m_icd->get_data_rajal($id)
            ];
            $msg = [
                'sukses' => view('kasirRJ/modalbayarkasirrj', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function Validasi()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/registerkasirrajal', $data);
    }

    public function ambildataBelumValidasi()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_close()
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajal', $data)
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

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_close($search)
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatrincianrajal()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_rajal($id),
                'pasienstatus' => $this->status_pasien(),
            ];
            $msg = [
                'suksesbayar' => view('kasirRJ/modalpembayaranrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function simpanTNOheaderBaru()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername_TH' => [
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
                        'doktername_TH' => $validation->getError('doktername_TH')
                    ]
                ];
            } else {
                $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));

                $db = db_connect();
                $groups = "IRJ";
                $lokasi = $this->request->getVar('poliklinik_TH');
                //$documentdate = date('Y-m-d');

                $tanggalpelayanan = $this->request->getVar('documentdate_TH');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }


                //$today = date('ymd');
                $today = date('ymd', strtotime($tanggalpelayanan));
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                $newkode = $groups . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $dokter = $this->request->getVar('dokter_TH');
                $doktername = $this->request->getVar('doktername_TH');

                $smf = "NONE";
                $employee = "NONE";

                $simpandata = [

                    'groups' => $this->request->getVar('groups_TH'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep_TH'),
                    'noantrian' => $this->request->getVar('noantrian_TH'),
                    'pasienid' => $this->request->getVar('pasienid_TH'),
                    'oldcode' => $this->request->getVar('oldcode_TH'),
                    'pasienname' => $this->request->getVar('pasienname_TH'),
                    'pasiengender' => $this->request->getVar('pasiengender_TH'),
                    'pasienage' => $this->request->getVar('pasienage_TH'),
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth_TH'),
                    'pasienaddress' => $this->request->getVar('pasienaddress_TH'),
                    'pasienarea' => $this->request->getVar('pasienarea_TH'),
                    'pasiensubarea' => $this->request->getVar('pasiensubarea_TH'),
                    'pasiensubareaname' => $this->request->getVar('pasiensubareaname_TH'),
                    'paymentmethod' => $this->request->getVar('paymentmethod_TH'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname_TH'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber_TH'),
                    'poliklinik' => $this->request->getVar('poliklinik_TH'),
                    'poliklinikname' => $this->request->getVar('poliklinikname_TH'),
                    'smf' => $smf,
                    'employee' => $employee,
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),

                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelTNOHeaderRajal;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Silahkan isi detail',
                    'JN' => $newkode,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'tanggalpelayanan' => $documentdate,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function simpanTNODetailBaru()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Tindakan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'name' => $validation->getError('name')
                    ]
                ];
            } else {

                $price = $this->request->getVar('price');
                $bhp = $this->request->getVar('bhp');
                $qty = $this->request->getVar('qty');
                $totaltarif = $price * $qty;
                $totalbhp = $bhp;
                $subtotal = $totaltarif + $totalbhp;

                $pelaksana = $this->request->getVar('pelaksana2');
                if ($pelaksana == 1) {
                    $pelaksana = "Paramedis";
                } else {
                    $pelaksana = "Dokter";
                }


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'journalnumber' => $this->request->getVar('journalnumberkasir'),
                    'documentdate' => $this->request->getVar('documentdatekasir'),
                    'relation' => $this->request->getVar('relationkasir'),
                    'relationname' => $this->request->getVar('relationnamekasir'),
                    'paymentmethod' => $this->request->getVar('paymentmethodkasir'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodnamekasir'),
                    'poliklinik' => $this->request->getVar('poliklinikkasir'),
                    'poliklinikname' => $this->request->getVar('polikliniknamekasir'),
                    'smf' => $this->request->getVar('smfkasir'),
                    'smfname' => $this->request->getVar('smfnamekasir'),
                    'employee' => $this->request->getVar('employeekasir'),
                    'employeename' => $this->request->getVar('employeenamekasir'),
                    'dokter' => $this->request->getVar('dokterkasir'),
                    'doktername' => $this->request->getVar('dokternamekasir'),
                    'referencenumber' => $this->request->getVar('referencenumberkasir'),
                    'locationcode' => $this->request->getVar('locationcodekasir'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),
                    'price' => $price,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdbykasir'),
                    'createddate' => $this->request->getVar('createddatekasir'),
                    'pelaksana' => $pelaksana,
                    'paramedicName' => $this->request->getVar('paramedicName'),

                ];
                $tno = new ModelTNODetailRJ;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Berhasil Ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function AfterValidasi()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/registerkasirrajal_aftervalidasi', $data);
    }

    public function ambildataAfterValidasi()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_aftervalidasi()
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajal_aftervalidasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function cariAfterValidasi()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);


            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_aftervalidasi($search)
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajal_aftervalidasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatrincianrajal_validasi()
    {
        if ($this->request->isAJAX()) {

            $journalnumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_rajal_validasi($journalnumber),
                'pasienstatus' => $this->status_pasien(),
            ];
            $msg = [
                'suksesbayar' => view('kasirRJ/modalpembayaranrajal_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalValidasi()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('journalnumber');
            $deletedby = $this->request->getVar('deletedby');
            $canceldate = date('Y-m-d h:m:s');
            $kasir = new ModelValidasiPembayaranRajal();
            $databayar = $kasir->ambilpasienbayar($referencenumber);
            $id = $databayar['id'];
            $nokwi = $databayar['journalnumber'];
            $kasir->delete($id);
            $datahapus = $kasir->ambildatahapus();
            $id_datahapus = $datahapus['id'];

            $simpandata = [
                'cancelby' => $deletedby,
                'canceldate' => $canceldate,
            ];
            $datahapus = new ModelDeletePembayaranRajal;
            $id = $id_datahapus;
            $datahapus->update($id, $simpandata);
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
        ];
        return view('kasirRJ/registerkasirrajal_beritaacara', $data);
    }

    public function LogBatalValidasi()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/register_logbatal_validasi', $data);
    }

    public function ambildataLogBatal()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatabatal()
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajal_batal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataLogBatal()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);


            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_ambildata_log($search)
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajal_batal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function LaporanKarcisRajal()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/registerkasirrajal_karcis', $data);
    }


    public function ambildatakarcisRajal()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR RAWAT JALAN";
            $hal = "Laporan Penerimaan Karcis";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_detail_validasi($lokasikasir, $hal);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_karcis(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_karcis', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatakarcisRajal()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR RAWAT JALAN";
            $hal = "Laporan Penerimaan Karcis";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_detail_validasi($lokasikasir, $hal);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_close_karcis($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_karcis', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function LaporanRekapPendapatan()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/registerrekap_pendapatan', $data);
    }


    public function ambildataRekapPendapatan()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR";
            $hal = "Laporan Rekap Pendapatan";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_detail_validasi($lokasikasir, $hal);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarekap_pendapatan_rajal(),
                'tampildataigd' => $register->ambildatarekap_pendapatan_igd(),
                'tampildataranap' => $register->ambildatarekap_pendapatan_ranap(),
                'tampildatapenunjang' => $register->ambildatarekap_pendapatan_penunjang(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRJ/dataregister_rekap_pendapatan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataRekapPendapatan()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR";
            $hal = "Laporan Rekap Pendapatan";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_detail_validasi($lokasikasir, $hal);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_datarekap_pendapatan_rajal($search),
                'tampildataigd' => $register->search_datarekap_pendapatan_igd($search),
                'tampildataranap' => $register->search_datarekap_pendapatan_ranap($search),
                'tampildatapenunjang' => $register->search_datarekap_pendapatan_penunjang($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRJ/dataregister_rekap_pendapatan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ValidasiTindakan()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/registerkasirrajalTindakan', $data);
    }

    public function ambildataValidasiTindakan()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_tindakan()
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajalTindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function cariValidasiTindakan()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);


            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_Tindakan($search)
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajalTindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function LihatTindakanRajal()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_rajal($id),
                'pasienstatus' => $this->status_pasien(),
            ];
            $msg = [
                'suksesbayar' => view('kasirRJ/modalpembayaranTindakanrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabungValidasiTindakan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir($referencenumber);
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
                'journalnumber' => $row['journalnumber'],
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
                'validation' => $row['validation'],
                'description' => $row['description'],
                'validasipembayarantindakanAll' => $row['validasipembayarantindakanAll'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
            ];
            $msg = [
                'data' => view('kasirRJ/data_resume_gabung_kasirRJ_Tindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ValidasiPembayaranTindakan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'tindakan' => $m_icd->get_data_tindakan($id),
            ];
            $msg = [
                'sukses' => view('kasirRJ/modalvalidasipembayarantindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function SimpanValidasiBayarTindakan()
    {
        if ($this->request->isAJAX()) {

            $validasipembayaran = $this->request->getVar('validasipembayaran');
            $kodevalidasipembayaran = $this->request->getVar('kodevalidasipembayaran');
            $kasirvalidasi = $this->request->getVar('kasirvalidasi');
            $tanggalvalidasipembayaran = $this->request->getVar('tanggalvalidasipembayaran');
            $nominalpembayaran = $this->request->getVar('nominalpembayaran');
            $subtotal = $this->request->getVar('subtotal');

            if (($kodevalidasipembayaran == 0) || ($kodevalidasipembayaran == 2)) {
                $validasipembayaran = 1;
            } else {
                $validasipembayaran = 2;
            }

            if ($subtotal > $nominalpembayaran) {
                $msg = [
                    'pesan' => 'Nominal Pembayaran Kurang!',
                    'gagal' => true,
                ];
            } else {

                $simpandata = [
                    'validasipembayaran' => $validasipembayaran,
                    'kasirvalidasi' => $kasirvalidasi,
                    'tanggalvalidasipembayaran' => $tanggalvalidasipembayaran,
                ];
                $perawat = new ModelTNODetailRJ;
                $id = $this->request->getVar('idtindakan');
                $perawat->update($id, $simpandata);
                $msg = [
                    'sukses' => 'Pembayaran Tindakan Berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printkarcisTindakan()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $data = [
            'datapasien' => $pasien->tindakanRajal($id),

        ];

        $html = view('pdf/stylebootstrap');
        //$html .= view('pdf/karcisrajal', $data);
        $html = view('pdf/karcistindakanrajal', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A6', 'landscape');
        $dompdf->render();
        $namafile = 'Karcis Tindakan Rajal' . $id;
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }



    public function resumeGabungVerifikasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir($referencenumber);
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
                'validation' => $row['validation'],
                'description' => $row['description'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'verifikasi' => $row['verifikasi'],
                'idverifikasi' => $row['id'],
            ];
            $msg = [
                'data' => view('kasirRJ/data_resume_gabung_kasirRJ_verifikasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ValidasiPembayaranKarcis()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'tindakan' => $m_icd->get_data_rajal_verifikasi_karcis($id),
            ];
            $msg = [
                'sukses' => view('kasirRJ/modalvalidasipembayarankarcis', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function SimpanValidasiBayarKarcis()
    {
        if ($this->request->isAJAX()) {

            $validasipembayaran = $this->request->getVar('validasipembayaran');
            $kodevalidasipembayaran = $this->request->getVar('kodevalidasipembayaran');
            $kasirvalidasi = $this->request->getVar('kasirvalidasi');
            $tanggalvalidasipembayaran = $this->request->getVar('tanggalvalidasipembayaran');
            $nominalpembayaran = $this->request->getVar('nominalpembayaran');
            $subtotal = $this->request->getVar('subtotal');

            if (($kodevalidasipembayaran == 0) || ($kodevalidasipembayaran == 2)) {
                $validasipembayaran = 1;
            } else {
                $validasipembayaran = 2;
            }

            if ($subtotal > $nominalpembayaran) {
                $msg = [
                    'pesan' => 'Nominal Pembayaran Kurang!',
                    'gagal' => true,
                ];
            } else {

                $simpandata = [
                    'validasipembayaran' => $validasipembayaran,
                    'kasirvalidasi' => $kasirvalidasi,

                ];
                $perawat = new ModelRawatJalanDaftar;
                $id = $this->request->getVar('idtindakan');
                $perawat->update($id, $simpandata);
                $msg = [
                    'sukses' => 'Pembayaran Karcis Berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function printkarcis()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $data = [
            'datapasien' => $pasien->get_karcis_rajal($id),
            'datapasien' => $pasien->get_karcis_rajal_aliit($id),
        ];

        // $html = view('pdf/stylebootstrap');
        //$html .= view('pdf/karcisrajal', $data);
        $html = view('pdf/karcistindakanrajalbayar', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('F4', 'portrait');
        $dompdf->render();
        $namafile = 'Karcis Tindakan Rajal' . $id;
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function BeritaAcaraTindakan()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/registerkasirrajal_beritaacara_tindakan', $data);
    }


    public function dataBeritaAcaraTindakan()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR RAWAT JALAN";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_beritaacara_tindakan(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_beritaacara_tindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CaridataberitaacaraTindakan()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR RAWAT JALAN";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));


            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_close_beritaacara_tindakan($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_beritaacara_tindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function BeritaAcaraKarcis()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/registerkasirrajal_beritaacara_karcis', $data);
    }


    public function dataBeritaAcaraKarcis()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR RAWAT JALAN";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_beritaacara_karcis(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_beritaacara_karcis', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CaridataberitaacaraKarcis()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR RAWAT JALAN";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));


            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_close_beritaacara_karcis($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterpoliklinik_kasirRJ_beritaacara_karcis', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function PindahCabar()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRJ/registerkasirrajalPindahCabar', $data);
    }

    public function ambildataPindahCabar()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_tindakan()
            ];
            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajalPindahCabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function cariPindahCabar()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);


            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal_Tindakan($search)
            ];

            $msg = [
                'data' => view('kasirRJ/dataregisterkasirrajalPindahCabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function LihatUbahCabarRajal()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_rajal($id),
                'pasienstatus' => $this->status_pasien(),
                'cabar' => $this->data_payment(),
                'pelayanan' => $this->pelayanan(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),
                'sebabsakit' => $this->sebabsakit(),
            ];
            $msg = [
                'suksesbayar' => view('kasirRJ/modalubahcabarrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ValidasiUbahCabar()
    {
        if ($this->request->isAJAX()) {

            $tglrujukan1 = $this->request->getVar("referencedate");

            $mulai = str_replace('/', '-', $tglrujukan1);
            $tglrujukan = date('Y-m-d', strtotime($mulai));

            $simpandata = [
                'paymentchange' => $this->request->getVar('paymentchange'),
                'paymentmethod' => $this->request->getVar('paymentmethod'),
                'paymentmethodname' => $this->request->getVar('paymentmethodname'),
            ];


            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('iddaftar');
            $perawat->update($id, $simpandata);

            $msg = [
                'sukses' => 'Data Cara Pembayaran Berhasil Diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ValidasiPembayaranTindakanAll()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienMaster();
            $pasien = $m_icd->get_identitas_data_tindakan_all($id);


            $data = [
                'tindakan' => $m_icd->get_data_tindakan_all($id),
                'journalnumber' => $pasien['journalnumber'],
                'pasienid' => $pasien['pasienid'],
                'pasienname' => $pasien['pasienname'],
                'poliklinikname' => $pasien['poliklinikname'],
                'paymentmethodname' => $pasien['paymentmethodname'],
                'doktername' => $pasien['doktername'],
                'documentdate' => $pasien['documentdate'],
                'iddaftar' => $pasien['id'],
                'validasipembayarantindakanAll' => $pasien['validasipembayarantindakanAll'],
            ];


            $msg = [
                'sukses' => view('kasirRJ/modalvalidasipembayarantindakanAll', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function SimpanValidasiBayarTindakanAll()
    {
        if ($this->request->isAJAX()) {

            $validasipembayarantindakanAll = $this->request->getVar('validasipembayaran');
            $createdby = $this->request->getVar('kasirvalidasi');
            $paymentamount = $this->request->getVar('nominalpembayaran');
            $subtotal = $this->request->getVar('subtotal');
            $journalnumber = $this->request->getVar('journalnumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $pasienid = $this->request->getVar('pasienid');
            $pasienname = $this->request->getVar('pasienname');
            $poliklinikname = $this->request->getVar('poliklinikname');
            $paymentmethodname = $this->request->getVar('paymentmethodname');
            $doktername = $this->request->getVar('doktername');
            $paymentamount = $this->request->getVar('nominalpembayaran');
            $createdby = $this->request->getVar('kasirvalidasi');
            $kodevalidasipembayaran = $this->request->getVar('kodevalidasipembayaran');

            if ($kodevalidasipembayaran == 0) {

                if ($subtotal > $paymentamount) {
                    $msg = [
                        'pesan' => 'Nominal Pembayaran Kurang!',
                        'gagal' => true,
                    ];
                } else {
                    $simpandata = [
                        'groups' => 'IRJ',
                        'journalnumber' => $referencenumber,
                        'referencenumber' => $referencenumber,
                        'pasienid' => $pasienid,
                        'pasienname' => $pasienname,
                        'poliklinikname' => $poliklinikname,
                        'paymentmethodname' => $paymentmethodname,
                        'doktername' => $doktername,
                        'subtotal' => $subtotal,
                        'paymentamount' => $paymentamount,
                        'createdby' => $createdby,

                    ];

                    $tindakan = new ModelBayarTindakanRajal;
                    $tindakan->insert($simpandata);
                    // $perawat = new ModelRawatJalanDaftar;
                    // $id = $this->request->getVar('idtindakan');
                    // $perawat->update($id, $simpandata);
                    $msg = [
                        'sukses' => 'Pembayaran Tindakan Berhasil'
                    ];
                }
            } else {
                $tindakan = new ModelBayarTindakanRajal;
                $cekpembayaran = $tindakan->get_pembayaran_tindakan_rajal($referencenumber);
                $idbayar = $cekpembayaran['id'];
                $tindakan->delete($idbayar);
                $msg = [
                    'sukses' => 'Pembatalan Pembayaran Berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printkarcisTindakanKonvensional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $data = [
            'datapasien' => $pasien->tindakanRajal($id),

        ];
        return view('cetakan/pembayaran_tindakan_rajal', $data);
    }

    public function printdetailkwitansiTagihanTindakanGabung()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR PENUNJANG MEDIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_tindakan_rajal_detail($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->get_data_print_detail_tindakan_rajal_array($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'PENUNJANG' => $resume->Kasir_Tindakanrajal($journalnumber),

        ];


        return view('cetakan/printdetailtindakanrajal', $data);
    }

    private function _data_dokter_all()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_all();
        return $list;
    }

    public function printdetailkwitansiVerifikasi()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT JALAN";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganigdprintverifikasi($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'TNO' => $resume->search_rajal2($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'OPERASI' => $resume->Operasirajal($referencenumber),
            'PENUNJANG' => $resume->Penunjangheaderrajal($referencenumber),
            'FARMASI' => $resume->FARMASIrajal($referencenumber),
            'BHP' => $resume->BHPrajal($referencenumber),
            'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
        ];

        return view('cetakan/printdetailrajalverifikasifix', $data);
    }
    private function data_paramedic($namapoli)
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_paramedic($namapoli);
        return $list;
    }
}

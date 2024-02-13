<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\ModelTNODetailRJ;
use App\Models\ModelTNODetail;
use App\Models\ModelTNOHeaderRajal;
use App\Models\ModelValidasiPembayaranRajal;
use App\Models\ModelValidasiPembayaranRanap;
use App\Models\ModelPasienMaster;
use App\Models\ModelDeletePembayaranRajal;
use App\Models\ModelKlaim;
use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;
use Dompdf\Options;


class KasirRanap extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->kamarrawat(),
        ];
        return view('kasirRI/registerranap_kasirRI', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_close()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI', $data)
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
                'tampildata' => $register->search_Registerranap_close($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI', $data)
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
                'tampildata' => $register->ambildataranap_close_validasi()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi', $data)
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
                'tampildata' => $register->search_RegisterRanap_close_validasi($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }





    public function rincianigd($id = '')
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

        return view('kasirIGD/DRJ_kasirIGD', $data);
    }

    public function rincianranap($id = '')
    {
        $referencenumber = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ranap($referencenumber);

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
            'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
        ];

        return view('KasirRI/detail_rincian_ranap_kasir', $data);
    }


    public function rincianranap_aftervalidasi($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ranap_validasi($id);
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
            'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
        ];

        return view('KasirRI/detail_rincian_ranap_kasir_validasi', $data);
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

                ],
                'types' => [
                    'label' => 'Jenis Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus dipilih terlebih dahulu'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'paymentamount' => $validation->getError('paymentamount'),
                        'statuspasien' => $validation->getError('statuspasien'),
                        'types' => $validation->getError('types')
                    ]
                ];
            } else {


                $db = db_connect();
                $types = $this->request->getVar('types');
                $lokasi = "KASIRRI";
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(validationnumber) as kode_jurnal, noantrian as noantrian FROM transaksi_pelayanan_kasir_rawatinap WHERE  created_at='$documentdate' and types='$types' LIMIT 1");

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

                $newkode = $types . $underscore . $lokasi . $underscore  . $today . $underscore . sprintf('%06s', $nourut);

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
                $diskon = $this->request->getVar('disc');
                $totaldiscount = $tagihan * ($diskon / 100);
                $pembayaran = preg_replace("/[^0-9]/", "", $nominal);

                $pay = $pembayaran + $nominaldebet;
                $totaltagihan = $tagihan - $totaldiscount;

                $paymentstatus = $this->request->getVar('paymentstatus');
                $pembayar = $this->request->getVar('payersname');


                if ($pay >= $totaltagihan) {
                    $paymentstatus = "LUNAS";
                } else {
                    $paymentstatus = "PIUTANG";
                }



                $naik = $this->request->getVar('pasienclassroomchange');
                $inacbgsname = $this->request->getVar('inacbgsname');
                $tarifkelas1 = $this->request->getVar('tarifkelas1');
                $tarifkelas2 = $this->request->getVar('tarifkelas2');
                $tarifkelas3 = $this->request->getVar('tarifkelas3');
                $pasienclassroom = $this->request->getVar('pasienclassroom');
                $classroom = $this->request->getVar('classroom');

                $paymentstatus = $this->request->getVar('paymentstatus');

                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'paymentstatus' => $this->request->getVar('paymentstatus'),
                    'groups' => $this->request->getVar('groups'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'bpjs_sep_poli' => $this->request->getVar('bpjs_sep_poli'),
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
                    'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                    'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                    'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokterpoli' => $this->request->getVar('dokterpoli'),
                    'dokterpoliname' => $this->request->getVar('dokterpoliname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'inacbgsclass' => $this->request->getVar('classroom'),
                    'inacbgs' => $this->request->getVar('inacbgs'),
                    'inacbgsname' => $this->request->getVar('inacbgsname'),
                    'reasoncode' => $this->request->getVar('reasoncode'),
                    'statuspasien' => $this->request->getVar('statuspasien'),
                    'lakalantas' => $this->request->getVar('lakalantas'),
                    'lokasilakalantas' => $this->request->getVar('lokasilakalantas'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                    'telppjb' => $this->request->getVar('telppjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),
                    'pasienclassroom' => $this->request->getVar('pasienclassroom'),
                    'bumil' => $this->request->getVar('bumil'),
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'bedname' => $this->request->getVar('bedname'),
                    'bednumber' => $this->request->getVar('bednumber'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getVar('memo'),
                    'datein' => $this->request->getVar('datein'),
                    'timein' => $this->request->getVar('timein'),
                    'datetimein' => $this->request->getVar('datetimein'),
                    'dateout' => $this->request->getVar('dateout'),
                    'timeout' => $this->request->getVar('timeout'),
                    'totaldaftarklinik' => $this->request->getVar('totaldaftarklinik'),
                    'totaltindakanklinik' => $this->request->getVar('totaltindakanklinik'),
                    'totalbhptindakanklinik' => $this->request->getVar('totalbhptindakanklinik'),
                    'totalfarmasiklinik' => $this->request->getVar('totalfarmasiklinik'),
                    'totalpenunjangklinik' => $this->request->getVar('totalpenunjangklinik'),
                    'totalbhppenunjangklinik' => $this->request->getVar('totalbhppenunjangklinik'),
                    'totalkasirklinik' => $this->request->getVar('totalkasirklinik'),
                    'totalkamar' => $this->request->getVar('totalkamar'),
                    'totalvisite' => $this->request->getVar('totalvisite'),
                    'totaltindakanruang' => $this->request->getVar('totaltindakanruang'),
                    'totalmakan' => $this->request->getVar('totalmakan'),
                    'totalbhptindakanruang' => $this->request->getVar('totalbhptindakanruang'),
                    'totaltindakanoperasi' => $this->request->getVar('totaltindakanoperasi'),
                    'totalbhptindakanoperasi' => $this->request->getVar('totalbhptindakanoperasi'),
                    'totalfarmasi' => $this->request->getVar('totalfarmasi'),
                    'totalpenunjang' => $this->request->getVar('totalpenunjang'),
                    'totalbhppenunjang' => $this->request->getVar('totalbhppenunjang'),
                    'totallainnya' => $this->request->getVar('totallainnya'),
                    'totalbhplainnya' => $this->request->getVar('totalbhplainnya'),
                    'totalkasirranap' => $this->request->getVar('totalkasirranap'),
                    'totalkasirpenunjang' => $this->request->getVar('totalkasirpenunjang'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'discount' => $this->request->getVar('disc'),
                    'tarifkelas1' => $this->request->getVar('tarifkelas1'),
                    'tarifkelas2' => $this->request->getVar('tarifkelas2'),
                    'tarifkelas3' => $this->request->getVar('tarifkelas3'),
                    'selisih' => $this->request->getVar('selisih'),
                    'realcost' => $this->request->getVar('grandtotal'),
                    'paymentamount' => $pembayaran,
                    'paymentmethodnew' => $this->request->getVar('paymentmethodnew'),
                    'paymentmethodnamenew' => $this->request->getVar('paymentmethodnamenew'),
                    'paymentcardnumbernew' => $this->request->getVar('paymentcardnumbernew'),
                    'paymentchange' => $this->request->getVar('paymentchange'),
                    'pasienclassroomnew' => $this->request->getVar('pasienclassroomnew'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'payersname' => $this->request->getVar('payersname'),
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('daftarbank'),
                    'nominaldebet' => $this->request->getVar('nominaldebet'),
                    'noreferensidebet' => $this->request->getVar('referensibank'),
                    'totalTagihanAsal' => $this->request->getVar('totalTagihanAsal'),
                ];

                if (($naik == 1) and ($paymentstatus == "SELISIH KELAS")) {
                    if (($inacbgsname <> "") and ($tarifkelas1 <> "") and ($tarifkelas2 <> "") and ($tarifkelas3 <> "") and ($pay > 0)) {
                        $perawat = new ModelValidasiPembayaranRanap;
                        $perawat->insert($simpandata);
                        $msg = [
                            'sukses' => 'Validasi Pembayaran Selisih Pasien Naik Kelas Berhasil',
                            'jumlahbayar' => $pembayaran,
                            'pembayar' => $pembayar,
                        ];
                    } else {
                        $msg = [
                            'gagal' => 'Silahkan Isi Coding Grouper INA CBG Terlebih Dahulu, Untuk Mendapatkan Nilai Selisih Biaya',
                            'jumlahbayar' => $pembayaran,
                            'pembayar' => $pembayar,
                        ];
                    }
                } else {
                    if (($naik == 0) and ($paymentstatus == "PEMBAYARAN")) {
                        if ($pay > 0) {
                            $perawat = new ModelValidasiPembayaranRanap;
                            $perawat->insert($simpandata);
                            $msg = [
                                'sukses' => 'Validasi pembayaran Berhasil',
                                'jumlahbayar' => $pembayaran,
                                'pembayar' => $pembayar,
                            ];
                        } else {
                            $msg = [
                                'gagal' => 'Nominal Pembayaran Harus Lebih Dari 0 Rupiah',
                                'jumlahbayar' => $pembayaran,
                                'pembayar' => $pembayar,
                            ];
                        }
                    } else {
                        if (($naik == 0) and ($paymentstatus == "NON TUNAI")) {
                            $perawat = new ModelValidasiPembayaranRanap;
                            $perawat->insert($simpandata);
                            $msg = [
                                'sukses' => 'Validasi  Berhasil',
                                'jumlahbayar' => $pembayaran,
                                'pembayar' => $pembayar,
                            ];
                        }
                    }
                }
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

    public function data_payment_pindahcabar()
    {

        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_payment_pindahcabar();
        return $list;
    }

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_igd();
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

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);

            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjangranap($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAP($referencenumber),
                'BHP' => $resume->BHPpenunjangranap2($referencenumber),
                //'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),

                //'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                //'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAPVERIFIKASI($referencenumber),
                //'BHP' => $resume->BHP($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'FARMASIIGD' => $resume->FarmasiRajalIgd($referencenumber),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'jpkasir' => $this->jp_kasir(),
                'pilihankoinsiden' => 0,
            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function resumeGabungValidasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $row2 = $m_icd->get_data_ranap_kasir_validasi_print2($referencenumber);
            //$row_bayar = $m_icd->get_data_kasir_ranap_validasi($referencenumber);
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjangranap($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAP($referencenumber),
                'BHP' => $resume->BHPpenunjangranap2($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),

                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'FARMASIIGD' => $resume->FarmasiRajalIgd($referencenumber),

                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'jpkasir' => $this->jp_kasir(),
                'paymentamount' => $row2['paymentamount'],
                'referensibank' => $row2['referensibank'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'inacbgsclass' => $row2['inacbgsclass'],
                'inacbgs' => $row2['inacbgs'],
                'inacbgsname' => $row2['inacbgsname'],
                'tarifkelas1' => $row2['tarifkelas1'],
                'tarifkelas2' => $row2['tarifkelas2'],
                'tarifkelas3' => $row2['tarifkelas3'],
                'disc' => $row2['discount'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'types' => $row2['types'],
                'paymentstatus' => $row2['paymentstatus'],
                'memo' => $row2['memo'],
                'id' => $row2['id'],


            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_after_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabung_uangmuka_validasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $row2 = $m_icd->get_data_ranap_kasir_validasi_print3($referencenumber);
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjangranap($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASI($referencenumber),
                'BHP' => $resume->BHPpenunjangranap2($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'paymentamount' => $row2['paymentamount'],
                'referensibank' => $row2['referensibank'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'inacbgsclass' => $row2['inacbgsclass'],
                'inacbgs' => $row2['inacbgs'],
                'inacbgsname' => $row2['inacbgsname'],
                'tarifkelas1' => $row2['tarifkelas1'],
                'tarifkelas2' => $row2['tarifkelas2'],
                'tarifkelas3' => $row2['tarifkelas3'],
                'disc' => $row2['discount'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'types' => $row2['types'],
                'paymentstatus' => $row2['paymentstatus'],
                'memo' => $row2['memo'],
                'id' => $row2['id'],
                'jpkasir' => $this->jp_kasir_uangmuka(),


            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_uangmuka_validasi', $data)
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

            ];
            $msg = [
                'sukses' => view('igd/modalinputTNOigd', $data)
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
                $groups = "IGD";
                $lokasi = $this->request->getVar('poliklinik_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups'  AND documentdate='$documentdate' LIMIT 1");

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

                    'groups' => $groups,
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
                'sukses' => view('kasirIGD/modalvalidasipoli_kasirIGD', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function status_pasien()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pasien_status_igd();
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

    public function jp_kasir()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_jpkasir();
        return $list;
    }
    public function jp_kasir_uangmuka()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_jpkasir_uangmuka();
        return $list;
    }

    public function jp_kasir_pindahcabar()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_jpkasir_pindahcabar();
        return $list;
    }

    public function simpanpemeriksaan()
    {
        if ($this->request->isAJAX()) {

            $signature_awal = $this->request->getVar('signature_awal');
            $signature_baru = $this->request->getVar('signature');



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

    public function BeritaAcara()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRI/registerkasirranap_beritaacara_fix', $data);
    }


    public function ambildataberitaacara()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR RAWAT INAP";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_beritaacara(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRI/dataregister_kasirRanap_beritaacara', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataregisterpoliberitaacara()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR RAWAT INAP";
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
                'tampildata' => $register->search_RegisterRanap_close_beritaacara($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRI/dataregister_kasirRanap_beritaacara', $data)
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
            $lokasikasir = "KASIR INSTALASI GAWAT DARURAT";

            $row2 = $m_icd->get_data_rajal_kasir_validasi_print($id);
            $row3 = $m_icd->get_data_buktipembayaran($lokasikasir);
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
                'sukses' => view('kasirIGD/modalprintkwitansiigd', $data)
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
            $email->setFrom('simrs.syamsudin@gmail.com', 'Informasi Pasien');
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

            $referencenumber = $this->request->getVar('referencenumber');
            $perawat = new ModelPasienRanap($this->request);
            $row = $perawat->get_data_ranap_kasir_validasi_signature($referencenumber);
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
                'sukses' => view('kasirRI/modalsignaturekasirranap', $data)
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
            $perawat = new ModelValidasiPembayaranRanap;
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
            $m_icd = new ModelPasienRanap($this->request);
            $lokasikasir = "KASIR RAWAT INAP";
            $row2 = $m_icd->get_data_ranap_kasir_validasi_print2($referencenumber);
            $row3 = $m_icd->get_data_kasir_ranap3($lokasikasir);
            $data = [
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['discount'],
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
                'kamar' => $row2['totalkamar'],
                'pemeriksaan' => $row2['totalvisite'],
                'tindakan' => $row2['totaltindakanruang'],
                'penunjang' => $row2['totalpenunjang'],
                'bhp' => $row2['totalbhppenunjang'],
                'farmasi' => $row2['totalfarmasi'],
                'makan' => $row2['totalmakan'],
                'bhptindakanruang' => $row2['totalbhptindakanruang'],
                'operasi' => $row2['totaltindakanoperasi'],
                'bhpoperasi' => $row2['totalbhptindakanoperasi'],
                'dokter' => $row2['doktername'],
                'pasienstatus' => $row2['statuspasien'],
                'paymentstatus' => $row2['paymentstatus'],
                'kasir' => $row2['createdby'],
                'signaturekasir' => $row2['signaturekasir'],
                'signaturepasien' => $row2['signaturepasien'],
                'groups' => $row2['groups'],
                'totaldaftarklinik' => $row2['totaldaftarklinik'],
                'totaltindakanklinik' => $row2['totaltindakanklinik'],
                'totalbhptindakanklinik' => $row2['totalbhptindakanklinik'],
                'totalfarmasiklinik' => $row2['totalfarmasiklinik'],
                'totalpenunjangklinik' => $row2['totalpenunjangklinik'],
                'totalbhppenunjangklinik' => $row2['totalbhppenunjangklinik'],
            ];
            $msg = [
                'sukses' => view('kasirRI/modalprintkwitansikasirranap', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function emailkwitansikasir()
    {

        if ($this->request->isAJAX()) {


            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $journalnumber = $this->request->getVar('referencenumber');


            $lokasikasir = "KASIR RAWAT INAP";
            $row2 = $m_icd->get_data_ranap_kasir_validasi_print2($referencenumber);
            $row3 = $m_icd->get_data_kasir($lokasikasir);
            $row4 = $m_icd->get_data_ranap_close_email($journalnumber);
            $data = [
                'datapasien' => $m_icd->kunjunganranapprint($journalnumber),
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['discount'],
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
                'pemeriksaan' => $row2['totaldaftarklinik'],
                'tindakan' => $row2['totaltindakanruang'],
                'penunjang' => $row2['totalpenunjang'],
                'bhp' => $row2['totalbhptindakanruang'],
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
            $html .= view('pdf/email_buktipembayaran_ranap', $data);
            $dompdf->loadhtml($html);

            $dompdf->setPaper('A5', 'landscape');
            $dompdf->render();
            $journalnumber = $data['journalnumber'];
            $name = date('d-m-Y') . '-' . $journalnumber . '-' . 'Informasipembayaran';
            $email->setFrom('simrs.syamsudin@gmail.com', 'Informasi Pembayaran');
            $email->setTo($tujuan);

            $email->setSubject('Kwitansi Pembayaran Pelayanan Pasien Rawat Inap RSUD R Syamsudin, SH Kota Sukabumi');
            $email->setMessage('Berikut kami sampaikan bukti  pembayaran pelayanan pasien Rawat Inap');
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

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap($journalnumber);

        $resume = new ModelTNODetail();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $resume->search($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'VISITE' => $resume->searchVisite($referencenumber),
            'OPERASI' => $resume->Operasi($referencenumber),
            'PENUNJANG' => $resume->Penunjangheader($referencenumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD($referencenumber),
            'FARMASI' => $resume->FARMASI($referencenumber),
            'BHP' => $resume->BHPpenunjangranap($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/printdetailranapfix', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printbuktipembayaran()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_buktipembayaran($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap_kasir($journalnumber);


        $resume = new ModelTNODetail();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $resume->search($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'VISITE' => $resume->searchVisite($referencenumber),
            'OPERASI' => $resume->Operasi($referencenumber),
            'PENUNJANG' => $resume->Penunjangheader($referencenumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD($referencenumber),
            'FARMASI' => $resume->FARMASI($referencenumber),
            'BHP' => $resume->BHPpenunjangranap($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_buktipembayaran_ranap', $data);
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

    public function ajax_inacbg()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $key = $request->getGet('term');
        $kelas = $this->request->getVar('kelas');
        // $hakkelas = $this->request->getVar('hakKelas');

        $datakelas = explode("NaN", $kelas);
        $takeclass = $datakelas[0];
        $hakkelas = $datakelas[1];
        $grandtotal = $datakelas[2];
        $disc = $datakelas[3];


        $data = $m_auto->get_list_inacbg($key);
        foreach ($data as $row) {

            if (($takeclass == "KLS2") and ($hakkelas == "KLS3")) {
                $tarif_kelas_diambil = $row['kls2'];
                $tarif_hak_kelas = $row['kls3'];
                $tarif_selisih = $tarif_kelas_diambil - $tarif_hak_kelas;
            }

            if (($takeclass == "KLS1") and ($hakkelas == "KLS2")) {
                $tarif_kelas_diambil = $row['kls1'];
                $tarif_hak_kelas = $row['kls2'];
                $tarif_selisih = $tarif_kelas_diambil - $tarif_hak_kelas;
            }

            if (($takeclass == "VIP") and ($hakkelas == "KLS1")) {
                $tarif_kelas_diambil = $row['kls1'];
                $tarif_hak_kelas = $row['kls1'];
                $selisihrealcost = $grandtotal - $tarif_hak_kelas;

                if ($grandtotal > $tarif_hak_kelas) {

                    if ($selisihrealcost > $tarif_hak_kelas) {
                        $tarif_selisih = $row['kls1'] * 0.75;
                    } else {
                        if ($selisihrealcost < $tarif_hak_kelas) {
                            $tarif_selisih = $selisihrealcost;
                        } else {
                            if ($tarif_hak_kelas > $selisihrealcost) {
                                $tarif_selisih = 0;
                            }
                        }
                    }
                } else {
                    if ($grandtotal <= $tarif_hak_kelas) {
                        $tarif_selisih = 0;
                    }
                }
            }

            if (($takeclass == "KLS3") and ($hakkelas == "KLS3")) {
                $tarif_kelas_diambil = $row['kls3'];
                $tarif_hak_kelas = $row['kls3'];
                $tarif_selisih = 0;
            }

            if (($takeclass == "KLS2") and ($hakkelas == "KLS2")) {
                $tarif_kelas_diambil = $row['kls2'];
                $tarif_hak_kelas = $row['kls2'];
                $tarif_selisih = 0;
            }

            if (($takeclass == "KLS1") and ($hakkelas == "KLS1")) {
                $tarif_kelas_diambil = $row['kls1'];
                $tarif_hak_kelas = $row['kls1'];
                $tarif_selisih = 0;
            }

            $json[] = [
                'value' => $row['INACBG'] . ' | ' . $row['DESKRIPSI'],
                'inacbg' => $row['INACBG'],
                'deskripsi' => $row['DESKRIPSI'],
                'tariff' => $row['TARIFF'],
                'kls1' => $row['kls1'],
                'kls2' => $row['kls2'],
                'kls3' => $row['kls3'],
                'tarif_naik_kelas' => $tarif_kelas_diambil,
                'tarif_hak_kelas' => $tarif_hak_kelas,
                'tarif_selisih' => $tarif_selisih
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function ajax_selisih_inacbg()
    {
        $request = Services::request();
        $keterangan = $request->getPost('keterangan');

        $m_combo_pulang = new Modelrajal();
        $list['name'] = $m_combo_pulang->get_pemicu_inacbg($keterangan);
        echo json_encode($list['name']);
    }



    public function rincianranap_uangmuka($id = '')
    {
        $referencenumber = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ranap($referencenumber);

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
            'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
        ];

        return view('KasirRI/detail_rincian_ranap_kasir_uangmuka', $data);
    }

    public function resumeGabung_uangmuka()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjangranap($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASI($referencenumber),
                'BHP' => $resume->BHPpenunjangranap2($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],
                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'jpkasir' => $this->jp_kasir_uangmuka(),
            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_uangmuka', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function validasi_uangmuka()
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
                    'label' => 'Nominal Uang Muka',
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

                ],
                'types' => [
                    'label' => 'Jenis Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus dipilih terlebih dahulu'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg2 = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'paymentamount' => $validation->getError('paymentamount'),
                        'statuspasien' => $validation->getError('statuspasien'),
                        'types' => $validation->getError('types')
                    ]
                ];
            } else {


                $db = db_connect();
                $types = $this->request->getVar('types');
                $lokasi = "KASIRRI";
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(validationnumber) as kode_jurnal, noantrian as noantrian FROM transaksi_pelayanan_kasir_rawatinap WHERE  created_at='$documentdate' and types='$types' LIMIT 1");

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

                $newkode = $types . $underscore . $lokasi . $underscore  . $today . $underscore . sprintf('%06s', $nourut);

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
                $diskon = $this->request->getVar('disc');
                $totaldiscount = $tagihan * ($diskon / 100);
                $pembayaran = preg_replace("/[^0-9]/", "", $nominal);

                $pay = $pembayaran + $nominaldebet;
                $totaltagihan = $tagihan - $totaldiscount;

                $paymentstatus = $this->request->getVar('paymentstatus');
                $pembayar = $this->request->getVar('payersname');
                $memo = $this->request->getVar('memo');


                $selisih = 0;
                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'paymentstatus' => $this->request->getVar('paymentstatus'),
                    'groups' => $this->request->getVar('groups'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'bpjs_sep_poli' => $this->request->getVar('bpjs_sep_poli'),
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
                    'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                    'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                    'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokterpoli' => $this->request->getVar('dokterpoli'),
                    'dokterpoliname' => $this->request->getVar('dokterpoliname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'inacbgsclass' => $this->request->getVar('classroom'),
                    'inacbgs' => $this->request->getVar('inacbgs'),
                    'inacbgsname' => $this->request->getVar('inacbgsname'),
                    'reasoncode' => $this->request->getVar('reasoncode'),
                    'statuspasien' => $this->request->getVar('statuspasien'),
                    'lakalantas' => $this->request->getVar('lakalantas'),
                    'lokasilakalantas' => $this->request->getVar('lokasilakalantas'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                    'telppjb' => $this->request->getVar('telppjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),
                    'pasienclassroom' => $this->request->getVar('pasienclassroom'),
                    'bumil' => $this->request->getVar('bumil'),
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'bedname' => $this->request->getVar('bedname'),
                    'bednumber' => $this->request->getVar('bednumber'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getVar('memo'),
                    'datein' => $this->request->getVar('datein'),
                    'timein' => $this->request->getVar('timein'),
                    'datetimein' => $this->request->getVar('datetimein'),
                    'dateout' => $this->request->getVar('dateout'),
                    'timeout' => $this->request->getVar('timeout'),
                    'totaldaftarklinik' => $this->request->getVar('totaldaftarklinik'),
                    'totaltindakanklinik' => $this->request->getVar('totaltindakanklinik'),
                    'totalbhptindakanklinik' => $this->request->getVar('totalbhptindakanklinik'),
                    'totalfarmasiklinik' => $this->request->getVar('totalfarmasiklinik'),
                    'totalpenunjangklinik' => $this->request->getVar('totalpenunjangklinik'),
                    'totalbhppenunjangklinik' => $this->request->getVar('totalbhppenunjangklinik'),
                    'totalkasirklinik' => $this->request->getVar('totalkasirklinik'),
                    'totalkamar' => $this->request->getVar('totalkamar'),
                    'totalvisite' => $this->request->getVar('totalvisite'),
                    'totaltindakanruang' => $this->request->getVar('totaltindakanruang'),
                    'totalmakan' => $this->request->getVar('totalmakan'),
                    'totalbhptindakanruang' => $this->request->getVar('totalbhptindakanruang'),
                    'totaltindakanoperasi' => $this->request->getVar('totaltindakanoperasi'),
                    'totalbhptindakanoperasi' => $this->request->getVar('totalbhptindakanoperasi'),
                    'totalfarmasi' => $this->request->getVar('totalfarmasi'),
                    'totalpenunjang' => $this->request->getVar('totalpenunjang'),
                    'totalbhppenunjang' => $this->request->getVar('totalbhppenunjang'),
                    'totallainnya' => $this->request->getVar('totallainnya'),
                    'totalbhplainnya' => $this->request->getVar('totalbhplainnya'),
                    'totalkasirranap' => $this->request->getVar('totalkasirranap'),
                    'totalkasirpenunjang' => $this->request->getVar('totalkasirpenunjang'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'discount' => $this->request->getVar('disc'),
                    'tarifkelas1' => $this->request->getVar('tarifkelas1'),
                    'tarifkelas2' => $this->request->getVar('tarifkelas2'),
                    'tarifkelas3' => $this->request->getVar('tarifkelas3'),
                    'selisih' => $selisih,
                    'realcost' => $this->request->getVar('grandtotal'),
                    'paymentamount' => $pembayaran,
                    'paymentmethodnew' => $this->request->getVar('paymentmethodnew'),
                    'paymentmethodnamenew' => $this->request->getVar('paymentmethodnamenew'),
                    'paymentcardnumbernew' => $this->request->getVar('paymentcardnumbernew'),
                    'paymentchange' => $this->request->getVar('paymentchange'),
                    'pasienclassroomnew' => $this->request->getVar('pasienclassroomnew'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'payersname' => $this->request->getVar('payersname'),
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('daftarbank'),
                    'nominaldebet' => $this->request->getVar('nominaldebet'),
                    'noreferensidebet' => $this->request->getVar('referensibank'),
                ];

                if ($pay > 0) {
                    $perawat = new ModelValidasiPembayaranRanap;
                    $perawat->insert($simpandata);
                    $msg2 = [
                        'sukses' => 'Validasi pembayaran Uang Muka Berhasil',
                        'jumlahbayar' => $pembayaran,
                        'pembayar' => $pembayar,
                        'memo' => $memo,
                    ];
                } else {
                    $msg2 = [
                        'gagal' => 'Nominal uang muka harus lebih besar dari nol Rupiah',
                        'jumlahbayar' => $pembayaran,
                        'pembayar' => $pembayar,
                        'memo' => $memo,
                    ];
                }
            }
            echo json_encode($msg2);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printbuktipembayaran_uangmuka()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_buktipembayaran_uangmuka($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap_kasir($journalnumber);


        $resume = new ModelTNODetail();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $resume->search($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'VISITE' => $resume->searchVisite($referencenumber),
            'OPERASI' => $resume->Operasi($referencenumber),
            'PENUNJANG' => $resume->Penunjangheader($referencenumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD($referencenumber),
            'FARMASI' => $resume->FARMASI($referencenumber),
            'BHP' => $resume->BHPpenunjangranap($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_buktipembayaran_ranap_uangmuka', $data);
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

    public function emailkwitansikasir_uangmuka()
    {

        if ($this->request->isAJAX()) {


            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $journalnumber = $this->request->getVar('referencenumber');


            $lokasikasir = "KASIR RAWAT INAP";
            $row2 = $m_icd->get_data_ranap_kasir_validasi_print2($referencenumber);
            $row3 = $m_icd->get_data_buktipembayaran_uangmuka($lokasikasir);
            $row4 = $m_icd->get_data_ranap_close_email($journalnumber);
            $data = [
                'datapasien' => $m_icd->kunjunganranapprint($journalnumber),
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['discount'],
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
                'pemeriksaan' => $row2['totaldaftarklinik'],
                'tindakan' => $row2['totaltindakanruang'],
                'penunjang' => $row2['totalpenunjang'],
                'bhp' => $row2['totalbhptindakanruang'],
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
            $html .= view('pdf/email_buktipembayaran_ranap_uangmuka', $data);
            $dompdf->loadhtml($html);

            $dompdf->setPaper('A5', 'landscape');
            $dompdf->render();
            $journalnumber = $data['journalnumber'];
            $name = date('d-m-Y') . '-' . $journalnumber . '-' . 'Informasipembayaran';
            $email->setFrom('simrs.syamsudin@gmail.com', 'Informasi Pembayaran');
            $email->setTo($tujuan);

            $email->setSubject('Kwitansi Pembayaran Uang Muka Pelayanan Pasien Rawat Inap RSUD R Syamsudin, SH Kota Sukabumi');
            $email->setMessage('Berikut kami sampaikan bukti  pembayaran uang muka pelayanan pasien Rawat Inap');
            $email->attach($dompdf->output(), 'application/pdf', $name . '.pdf', false);
            $email->send();
            $msg = [
                'sukses' => 'Email berhasil dikirim'
            ];
        }
        echo json_encode($msg);
    }


    public function rincianranap_aftervalidasi_uangmuka($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ranap_validasi($id);
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
            'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
        ];

        return view('KasirRI/detail_rincian_ranap_kasir_validasi_uangmuka', $data);
    }

    public function update_validasi_uangmuka()
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

                ],
                'types' => [
                    'label' => 'Jenis Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus dipilih terlebih dahulu'
                    ]

                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'paymentamount' => $validation->getError('paymentamount'),
                        'statuspasien' => $validation->getError('statuspasien'),
                        'types' => $validation->getError('types')
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



                if ($nominal_awal = $nominal) {
                    $pembayaran = preg_replace("/[^0-9]/", "", $nominal_awal);
                } else {
                    $pembayaran = preg_replace("/[^0-9]/", "", $nominal);
                }

                if ($nominaldebet_awal == $nominaldebet) {
                    //$debet = $this->request->getVar('nominaldebet_awal');
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

                if ($debet == '') {
                    $debet = 0;
                }
                $pay = $pembayaran + $debet;
                $totaltagihan = $tagihan - $totaldiscount;



                $pembayar = $this->request->getVar('payersname');
                $memo = $this->request->getVar('memo');


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
                    'payersname' => $pembayar,
                    'paymentstatus' => $this->request->getVar('paymentstatus'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'modifiedby' => $this->request->getVar('createdby'),
                    'modifieddate' => $this->request->getVar('createddate'),
                    'types' => $this->request->getVar('types'),
                    'inacbgsclass' => $this->request->getVar('inacbgsclass'),
                    'inacbgsname' => $this->request->getVar('inacbgsname'),
                    'inacbgs' => $this->request->getVar('inacbgs'),
                    'tarifkelas1' => $this->request->getVar('tarifkelas1'),
                    'tarifkelas2' => $this->request->getVar('tarifkelas2'),
                    'tarifkelas3' => $this->request->getVar('tarifkelas3'),

                ];
                $perawat = new ModelValidasiPembayaranRanap;
                $id = $this->request->getVar('idbayar');
                $perawat->update($id, $simpandata);
                $msg = [
                    'sukses' => 'Data pembayaran uang muka sudah berhasil diubah',
                    'jumlahbayar' => $pembayaran,
                    'pembayar' => $pembayar,
                    'memo' => $memo,

                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildataberitaacara_uangmuka()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR RAWAT INAP";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac_uangmuka($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_beritaacara_uangmuka(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_beritaacara_uangmuka', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataregisterpoliberitaacara_uangmuka()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR RAWAT INAP";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_bac_uangmuka($lokasikasir);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRanap_close_beritaacara_uangmuka($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_beritaacara_uangmuka', $data)
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
            'poli' => $this->kamarrawat(),
        ];
        return view('kasirRI/registerranap_kasirRI_pindahcabar', $data);
    }

    public function ambildatapasienranap_cabar()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_uangmuka()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_pindahcabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienranap_cabar()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Registerranap_uangmuka($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_pindahcabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function rincianranap_pindahcabar($id = '')
    {
        $referencenumber = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ranap($referencenumber);

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
            'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
        ];

        return view('KasirRI/detail_rincian_ranap_kasir_pindahcabar', $data);
    }




    public function SignatureKasir_pindahcabar()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('referencenumber');
            $perawat = new ModelPasienRanap($this->request);
            $row = $perawat->get_data_ranap_kasir_validasi_signature($referencenumber);
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
                'sukses' => view('kasirRI/modalsignaturekasirranap_pindahcabar', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function printbukti_pindahcabar()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_bukti_pindahcabar($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap_kasir($journalnumber);


        $resume = new ModelTNODetail();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $resume->search($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'VISITE' => $resume->searchVisite($referencenumber),
            'OPERASI' => $resume->Operasi($referencenumber),
            'PENUNJANG' => $resume->Penunjangheader($referencenumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD($referencenumber),
            'FARMASI' => $resume->FARMASI($referencenumber),
            'BHP' => $resume->BHPpenunjangranap($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_bukti_pindahcabar', $data);
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



    public function rincianranap_aftervalidasi_pindahcabar($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ranap_validasi($id);
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
            'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
        ];

        return view('KasirRI/detail_rincian_ranap_kasir_validasi_pindahcabar', $data);
    }

    public function resumeGabung_pindahcabar_validasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $carabayar = $row['paymentmethod'];
            $row2 = $m_icd->get_data_ranap_kasir_validasi_print4($referencenumber);
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjangranap($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASI($referencenumber),
                'BHP' => $resume->BHPpenunjangranap2($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'paymentamount' => $row2['paymentamount'],
                'referensibank' => $row2['referensibank'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'inacbgsclass' => $row2['inacbgsclass'],
                'inacbgs' => $row2['inacbgs'],
                'inacbgsname' => $row2['inacbgsname'],
                'tarifkelas1' => $row2['tarifkelas1'],
                'tarifkelas2' => $row2['tarifkelas2'],
                'tarifkelas3' => $row2['tarifkelas3'],
                'disc' => $row2['discount'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'types' => $row2['types'],
                'paymentstatus' => $row2['paymentstatus'],
                'memo' => $row2['memo'],
                'id' => $row2['id'],
                'paymentcardnumbernew' => $row2['paymentcardnumbernew'],
                'jpkasir' => $this->jp_kasir_pindahcabar(),
                'datacabar' => $this->data_payment(),


            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_pindahcabar_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function update_validasi_pindahcabar()
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
                'types' => [
                    'label' => 'Jenis Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus dipilih terlebih dahulu'
                    ]

                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'types' => $validation->getError('types')
                    ]
                ];
            } else {

                $pembayar = $this->request->getVar('payersname');
                $memo = $this->request->getVar('memo');


                $simpandata = [
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'payersname' => $pembayar,
                    'paymentstatus' => $this->request->getVar('paymentstatus'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'modifiedby' => $this->request->getVar('createdby'),
                    'modifieddate' => $this->request->getVar('createddate'),
                    'types' => $this->request->getVar('types'),

                ];
                $perawat = new ModelValidasiPembayaranRanap;
                $id = $this->request->getVar('idbayar');
                $perawat->update($id, $simpandata);
                $msg = [
                    'sukses' => 'Data pembayaran uang muka sudah berhasil diubah',
                    'pembayar' => $pembayar,
                    'memo' => $memo,

                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus_pindahcabar()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $pindahcabar = new ModelValidasiPembayaranRanap;
            $pindahcabar->delete($id);

            $msg = [
                'sukses' => "Data Transaksi pindah cara bayar dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function PindahHakKelas()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->kamarrawat(),
        ];
        return view('kasirRI/registerranap_kasirRI_pindahhakkelas', $data);
    }

    public function ambildatapasienranap_pindahhakkelas()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_uangmuka()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_pindahhakkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienranap_pindahhakkelas()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Registerranap_uangmuka($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_pindahhakkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function rincianranap_pindahhakkelas($id = '')
    {
        $referencenumber = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ranap($referencenumber);

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
            'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
        ];

        return view('KasirRI/detail_rincian_ranap_kasir_pindahhakkelas', $data);
    }




    public function SignatureKasir_pindahhakkelas()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('referencenumber');
            $perawat = new ModelPasienRanap($this->request);
            $row = $perawat->get_data_ranap_kasir_validasi_signature_pindahhakkelas($referencenumber);
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
                'sukses' => view('kasirRI/modalsignaturekasirranap_pindahhakkelas', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function ambildatavalidasi_pindahhakkelas()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_close_validasi_pindahhakkelas()
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi_pindahhakkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataregisterpolivalidasi_pindahhakkelas()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRanap_close_validasi_pindahhakkelas($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi_pindahhakkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function rincianranap_aftervalidasi_pindahhakkelas($id = '')
    {
        $referencenumber = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ranap($referencenumber);

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
            'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
        ];

        return view('KasirRI/detail_rincian_ranap_kasir_validasi_pindahhakkelas', $data);
    }

    public function resumeGabung_pindahhakkelas_validasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $carabayar = $row['paymentmethod'];
            $kelas = $row['pasienclassroom'];
            $hakkelas = new Modelrajal();
            $row2 = $hakkelas->get_jpkasir_pindahhakkelas();
            $row3 = $m_icd->get_data_ranap_kasir_validasi_print5($referencenumber);

            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjangranap($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASI($referencenumber),
                'BHP' => $resume->BHPpenunjangranap2($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'datacabar' => $m_icd->pindahcarabayar($carabayar),
                'datakelas' => $m_icd->pindahhakkelas($kelas),
                'paymentstatus' => $row2['deskripsi'],
                'paymentstatusname' => $row2['keteranganpembayaran'],
                'types' => $row2['jenispembayaran'],
                'pasienclassroomnew' => $row3['pasienclassroomnew'],
                'payersname' => $row3['payersname'],
            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_validasi_pindahhakkelas', $data)
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
            'poli' => $this->kamarrawat(),
        ];
        return view('kasirRI/registerkasirranap', $data);
    }

    public function ambildataBelumValidasi()
    {
        if ($this->request->isAJAX()) {
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_close()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap', $data)
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
                'tampildata' => $register->search_Registerranap_close($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatrincianranap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $pasienid = $this->request->getVar('pasienid');
            $m_icd = new ModelPasienMaster();
            $klaim = new ModelKlaim();
            $mergeasal = $klaim->get_data_pulang_ranap($id);
            $referencenumber = $mergeasal['referencenumber'];
            $merge = $klaim->get_data_merge($referencenumber);
            $data = [
                'pasienlama' => $m_icd->get_data_pulang_ranap($id),
                'pasienstatus' => $this->status_pasien(),
                'merge' => $merge,
            ];
            $msg = [
                'suksesbayar' => view('kasirRI/modalpembayaranranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function resumeGabung_RincianIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir($referencenumber);
            $asal = $row['groups'];
            $data = [
                'TNO' => $resume->search_igd_rajal($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'OPERASI' => $resume->Operasiigd($referencenumber),
                'PENUNJANG' => $resume->Penunjang_igd($referencenumber, $asal),
                'FARMASI' => $resume->FARMASIigd_rajal($referencenumber, $asal),
                'BHP' => $resume->BHPigd($referencenumber),
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
                'data' => view('KasirRI/data_rincian_igd_rajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function AfterValidasi()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->kamarrawat(),
        ];
        return view('kasirRI/registerkasirranap_validasi', $data);
    }

    public function ambildataAfterValidasi()
    {
        if ($this->request->isAJAX()) {
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_close_validasi()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap_aftervalidasi', $data)
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
                'tampildata' => $register->search_RegisterRanap_close_validasi($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap_aftervalidasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatrincianranap_validasi()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('referencenumber');
            $pasienid = $this->request->getVar('pasienid');
            $m_icd = new ModelPasienMaster();
            $klaim = new ModelKlaim();
            $id = $this->request->getVar('id');
            $mergeasal = $klaim->get_data_pulang_ranap_kasir($referencenumber);
            $referencenumber = $mergeasal['referencenumber'];
            $merge = $klaim->get_data_merge($referencenumber);
            $data = [
                'pasienlama' => $m_icd->get_data_pulang_ranap_kasir($referencenumber),
                'pasienstatus' => $this->status_pasien(),
                'transaksikasir' => $m_icd->get_validasi_kasir_ranap($referencenumber),
                'merge' => $merge,
            ];
            $msg = [
                'suksesbayar' => view('kasirRI/modalpembayaranranap_validasi', $data)
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

                ],
                'types' => [
                    'label' => 'Jenis Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus dipilih terlebih dahulu'
                    ]

                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'paymentamount' => $validation->getError('paymentamount'),
                        'statuspasien' => $validation->getError('statuspasien'),
                        'types' => $validation->getError('types')
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



                if ($nominal_awal = $nominal) {
                    $pembayaran = preg_replace("/[^0-9]/", "", $nominal_awal);
                } else {
                    $pembayaran = preg_replace("/[^0-9]/", "", $nominal);
                }

                if ($nominaldebet_awal == $nominaldebet) {
                    //$debet = $this->request->getVar('nominaldebet_awal');
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

                if ($debet == '') {
                    $debet = 0;
                }
                $pay = $pembayaran + $debet;
                $totaltagihan = $tagihan - $totaldiscount;

                if ($pay > $totaltagihan) {
                    $paymentstatus = "LUNAS";
                } else if ($pay = $totaltagihan) {
                    $paymentstatus = "LUNAS";
                } else {
                    $paymentstatus = "PIUTANG";
                }


                $naik = $this->request->getVar('pasienclassroomchange');
                $inacbgsname = $this->request->getVar('inacbgsname');
                $tarifkelas1 = $this->request->getVar('tarifkelas1');
                $tarifkelas2 = $this->request->getVar('tarifkelas2');
                $tarifkelas3 = $this->request->getVar('tarifkelas3');
                $pasienclassroom = $this->request->getVar('pasienclassroom');
                $classroom = $this->request->getVar('classroom');

                $paymentstatus = $this->request->getVar('paymentstatus');

                $pembayar = $this->request->getVar('payersname');

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
                    'types' => $this->request->getVar('types'),
                    'inacbgsclass' => $this->request->getVar('inacbgsclass'),
                    'inacbgsname' => $this->request->getVar('inacbgsname'),
                    'inacbgs' => $this->request->getVar('inacbgs'),
                    'tarifkelas1' => $this->request->getVar('tarifkelas1'),
                    'tarifkelas2' => $this->request->getVar('tarifkelas2'),
                    'tarifkelas3' => $this->request->getVar('tarifkelas3'),

                ];



                if (($naik == 1) and ($paymentstatus == "SELISIH KELAS")) {
                    if (($inacbgsname <> "") and ($tarifkelas1 <> "") and ($tarifkelas2 <> "") and ($tarifkelas3 <> "") and ($pay > 0)) {
                        $perawat = new ModelValidasiPembayaranRanap;
                        $id = $this->request->getVar('idbayar');
                        $perawat->update($id, $simpandata);
                        $msg = [
                            'sukses' => 'Validasi Pembayaran Selisih Pasien Naik Kelas Berhasil',
                            'jumlahbayar' => $pembayaran,
                            'pembayar' => $pembayar,
                        ];
                    } else {
                        $msg = [
                            'gagal' => 'Silahkan Isi Coding Grouper INA CBG Terlebih Dahulu, Untuk Mendapatkan Nilai Selisih Biaya',
                            'jumlahbayar' => $pembayaran,
                            'pembayar' => $pembayar,
                        ];
                    }
                } else {
                    if (($naik == 0) and ($paymentstatus == "PEMBAYARAN")) {
                        if ($pay > 0) {
                            $perawat = new ModelValidasiPembayaranRanap;
                            $id = $this->request->getVar('idbayar');
                            $perawat->update($id, $simpandata);
                            $msg = [
                                'sukses' => 'Validasi pembayaran Berhasil',
                                'jumlahbayar' => $pembayaran,
                                'pembayar' => $pembayar,
                            ];
                        } else {
                            $msg = [
                                'gagal' => 'Nominal Pembayaran Harus Lebih Dari 0 Rupiah',
                                'jumlahbayar' => $pembayaran,
                                'pembayar' => $pembayar,
                            ];
                        }
                    } else {
                        if (($naik == 0) and ($paymentstatus == "NON TUNAI")) {
                            $perawat = new ModelValidasiPembayaranRanap;
                            $id = $this->request->getVar('idbayar');
                            $perawat->update($id, $simpandata);
                            $msg = [
                                'sukses' => 'Validasi  Berhasil',
                                'jumlahbayar' => $pembayaran,
                                'pembayar' => $pembayar,
                            ];
                        }
                    }
                }
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalValidasi()
    {
        if ($this->request->isAJAX()) {

            $validationnumber = $this->request->getVar('validationnumber');
            $deletedby = $this->request->getVar('deletedby');
            $alasanBatal = $this->request->getVar('alasanBatal');
            $canceldate = date('Y-m-d h:m:s');
            $kasir = new ModelValidasiPembayaranRanap();
            $databayar = $kasir->ambilpasienbayarRanap($validationnumber);
            $id = $databayar['id'];
            $nokwi = $databayar['validationnumber'];

            $kasir->delete($id);
            $datahapus = $kasir->ambildatahapus();
            $id_datahapus = $datahapus['id'];

            $simpandata = [
                'cancelby' => $deletedby,
                'canceldate' => $canceldate,
                'alasanBatal' => $alasanBatal,
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

    public function UangMuka()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->kamarrawat(),
        ];
        return view('kasirRI/registerkasirranap_uangmuka', $data);
    }

    public function ambildatapasienranap()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_uangmuka()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap_uangmuka', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienranap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Registerranap_uangmuka($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap_uangmuka', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatrincianranap_uangmuka()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $pasienid = $this->request->getVar('pasienid');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_pulang_ranap_on($id),
                'pasienstatus' => $this->status_pasien(),
            ];

            $msg = [
                'suksesuangmuka' => view('kasirRI/modalpembayaranranap_uangmuka', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function dataUangMuka()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'cabar' => $this->data_payment(),
            ];
            $msg = [
                'data' => view('KasirRI/modaldatauangmuka', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ambildatavalidasi_uangmuka()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_close_validasi_uangmuka()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi_uangmuka', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatavalidasi_uangmuka()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['tglpembayaran']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRanap_close_validasi_uangmuka($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi_uangmuka', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalUangMuka()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $deletedby = $this->request->getVar('deletedby');
            $canceldate = date('Y-m-d h:m:s');
            $kasir = new ModelValidasiPembayaranRanap();
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
                'sukses' => "Data pembayaran Uang Muka Berhasil dibatalkan"
            ];

            echo json_encode($msg);
        }
    }


    public function PaymentChange()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->kamarrawat(),
        ];
        return view('kasirRI/registerkasirranap_pindahcabar', $data);
    }

    public function ambildatapasienranapPaymentChange()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_uangmuka()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap_pindahcabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienranapPaymentChange()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Registerranap_uangmuka($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap_pindahcabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatrincianranap_pindahcabar()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $pasienid = $this->request->getVar('pasienid');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_pulang_ranap_on($id),
                'pasienstatus' => $this->status_pasien(),
            ];

            $msg = [
                'suksespindahcabar' => view('kasirRI/modalpembayaranranap_pindahcabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabung_pindahcabar()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $carabayar = $row['paymentmethod'];

            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjangranap($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASI($referencenumber),
                'BHP' => $resume->BHPpenunjangranap2($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'jpkasir' => $this->jp_kasir_pindahcabar(),
                'datacabar' => $m_icd->pindahcarabayar($carabayar),
            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_paymentchange', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function validasi_pindahcabar()
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
                'types' => [
                    'label' => 'Jenis Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus dipilih terlebih dahulu'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg2 = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'types' => $validation->getError('types')
                    ]
                ];
            } else {


                $db = db_connect();
                $types = $this->request->getVar('types');
                $lokasi = "KASIRRI";
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(validationnumber) as kode_jurnal, noantrian as noantrian FROM transaksi_pelayanan_kasir_rawatinap WHERE  created_at='$documentdate' and types='$types' LIMIT 1");

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

                $newkode = $types . $underscore . $lokasi . $underscore  . $today . $underscore . sprintf('%06s', $nourut);

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
                $diskon = $this->request->getVar('disc');
                $totaldiscount = $tagihan * ($diskon / 100);
                $pembayaran = preg_replace("/[^0-9]/", "", $nominal);



                $paymentstatus = $this->request->getVar('paymentstatus');
                $pembayar = $this->request->getVar('payersname');
                $memo = $this->request->getVar('memo');

                $selisih = 0;
                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'paymentstatus' => $this->request->getVar('paymentstatus'),
                    'groups' => $this->request->getVar('groups'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'bpjs_sep_poli' => $this->request->getVar('bpjs_sep_poli'),
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
                    'paymentmethodname' => $this->request->getVar('paymentmethod'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                    'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                    'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                    'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokterpoli' => $this->request->getVar('dokterpoli'),
                    'dokterpoliname' => $this->request->getVar('dokterpoliname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'inacbgsclass' => $this->request->getVar('classroom'),
                    'inacbgs' => $this->request->getVar('inacbgs'),
                    'inacbgsname' => $this->request->getVar('inacbgsname'),
                    'reasoncode' => $this->request->getVar('reasoncode'),
                    'statuspasien' => $this->request->getVar('statuspasien'),
                    'lakalantas' => $this->request->getVar('lakalantas'),
                    'lokasilakalantas' => $this->request->getVar('lokasilakalantas'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                    'telppjb' => $this->request->getVar('telppjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),
                    'pasienclassroom' => $this->request->getVar('pasienclassroom'),
                    'bumil' => $this->request->getVar('bumil'),
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'bedname' => $this->request->getVar('bedname'),
                    'bednumber' => $this->request->getVar('bednumber'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getVar('memo'),
                    'datein' => $this->request->getVar('datein'),
                    'timein' => $this->request->getVar('timein'),
                    'datetimein' => $this->request->getVar('datetimein'),
                    'dateout' => $this->request->getVar('dateout'),
                    'timeout' => $this->request->getVar('timeout'),
                    'totaldaftarklinik' => $this->request->getVar('totaldaftarklinik'),
                    'totaltindakanklinik' => $this->request->getVar('totaltindakanklinik'),
                    'totalbhptindakanklinik' => $this->request->getVar('totalbhptindakanklinik'),
                    'totalfarmasiklinik' => $this->request->getVar('totalfarmasiklinik'),
                    'totalpenunjangklinik' => $this->request->getVar('totalpenunjangklinik'),
                    'totalbhppenunjangklinik' => $this->request->getVar('totalbhppenunjangklinik'),
                    'totalkasirklinik' => $this->request->getVar('totalkasirklinik'),
                    'totalkamar' => $this->request->getVar('totalkamar'),
                    'totalvisite' => $this->request->getVar('totalvisite'),
                    'totaltindakanruang' => $this->request->getVar('totaltindakanruang'),
                    'totalmakan' => $this->request->getVar('totalmakan'),
                    'totalbhptindakanruang' => $this->request->getVar('totalbhptindakanruang'),
                    'totaltindakanoperasi' => $this->request->getVar('totaltindakanoperasi'),
                    'totalbhptindakanoperasi' => $this->request->getVar('totalbhptindakanoperasi'),
                    'totalfarmasi' => $this->request->getVar('totalfarmasi'),
                    'totalpenunjang' => $this->request->getVar('totalpenunjang'),
                    'totalbhppenunjang' => $this->request->getVar('totalbhppenunjang'),
                    'totallainnya' => $this->request->getVar('totallainnya'),
                    'totalbhplainnya' => $this->request->getVar('totalbhplainnya'),
                    'totalkasirranap' => $this->request->getVar('totalkasirranap'),
                    'totalkasirpenunjang' => $this->request->getVar('totalkasirpenunjang'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'discount' => $this->request->getVar('disc'),
                    'tarifkelas1' => $this->request->getVar('tarifkelas1'),
                    'tarifkelas2' => $this->request->getVar('tarifkelas2'),
                    'tarifkelas3' => $this->request->getVar('tarifkelas3'),
                    'selisih' => $selisih,
                    'realcost' => $this->request->getVar('grandtotal'),
                    'paymentmethodnew' => $this->request->getVar('paymentmethodnamenew'),
                    'paymentmethodnamenew' => $this->request->getVar('paymentmethodnamenew'),
                    'paymentcardnumbernew' => $this->request->getVar('paymentcardnumbernew'),
                    'paymentchange' => $this->request->getVar('paymentchange'),
                    'pasienclassroomnew' => $this->request->getVar('pasienclassroomnew'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'payersname' => $this->request->getVar('payersname'),
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('daftarbank'),
                    'nominaldebet' => $this->request->getVar('nominaldebet'),
                    'noreferensidebet' => $this->request->getVar('referensibank'),
                    'rincian' => $this->request->getVar('rincian'),
                ];
                $perawat = new ModelValidasiPembayaranRanap;
                $perawat->insert($simpandata);
                $msg2 = [
                    'sukses' => 'Validasi pindah cara bayar Berhasil',
                    'memo' => $memo,
                    'validationnumber' => $newkode,
                ];
            }
            echo json_encode($msg2);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function printbukti_pindahcabar_baru()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_bukti_pindahcabar($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap_kasir_pindahcabar($journalnumber);


        $resume = new ModelTNODetail();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganranapprint_pindahcabar($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $resume->search($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'VISITE' => $resume->searchVisite($referencenumber),
            'OPERASI' => $resume->Operasi($referencenumber),
            'PENUNJANG' => $resume->Penunjangheader($referencenumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD($referencenumber),
            'FARMASI' => $resume->FARMASI($referencenumber),
            'BHP' => $resume->BHPpenunjangranap($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_bukti_pindahcabar', $data);
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

    public function dataPindahCabar()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'cabar' => $this->data_payment(),
            ];
            $msg = [
                'data' => view('KasirRI/modaldatapindahcabar', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildata_pindahcabar()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_close_validasi_pindahcabar()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi_paymentchange', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridata_pindahcabar()
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
                'tampildata' => $register->search_RegisterRanap_close_validasi_pindahcabar($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi_paymentchange', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ClassroomChange()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->kamarrawat(),
        ];
        return view('kasirRI/registerkasirranap_pindahkelas', $data);
    }

    public function ambildatapasienranapClassroomChange()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_uangmuka()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap_pindahkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienranapClassroomChange()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Registerranap_uangmuka($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterkasirranap_pindahkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatrincianranap_pindahkelas()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $pasienid = $this->request->getVar('pasienid');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_pulang_ranap_on($id),
                'pasienstatus' => $this->status_pasien(),
            ];

            $msg = [
                'suksespindahkelas' => view('kasirRI/modalpembayaranranap_pindahkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabung_pindahkelas()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $carabayar = $row['paymentmethod'];
            $kelas = $row['pasienclassroom'];
            $hakkelas = new Modelrajal();
            $row2 = $hakkelas->get_jpkasir_pindahhakkelas();

            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjangranap($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASI($referencenumber),
                'BHP' => $resume->BHPpenunjangranap2($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'datacabar' => $m_icd->pindahcarabayar($carabayar),
                'datakelas' => $m_icd->pindahhakkelas($kelas),
                'paymentstatus' => $row2['deskripsi'],
                'paymentstatusname' => $row2['keteranganpembayaran'],
                'types' => $row2['jenispembayaran'],
            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_pindahkelas_fix', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function validasi_pindahhakkelas()
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
                'types' => [
                    'label' => 'Jenis Transaksi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus dipilih terlebih dahulu'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg2 = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'types' => $validation->getError('types')
                    ]
                ];
            } else {


                $db = db_connect();
                $types = $this->request->getVar('types');
                $lokasi = "KASIRRI";
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(validationnumber) as kode_jurnal, noantrian as noantrian FROM transaksi_pelayanan_kasir_rawatinap WHERE  created_at='$documentdate' and types='$types' LIMIT 1");

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

                $newkode = $types . $underscore . $lokasi . $underscore  . $today . $underscore . sprintf('%06s', $nourut);

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
                $diskon = $this->request->getVar('disc');
                $totaldiscount = $tagihan * ($diskon / 100);
                $pembayaran = preg_replace("/[^0-9]/", "", $nominal);



                $paymentstatus = $this->request->getVar('paymentstatus');
                $pembayar = $this->request->getVar('payersname');
                $memo = $this->request->getVar('memo');

                $selisih = 0;
                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'paymentstatus' => $this->request->getVar('paymentstatus'),
                    'groups' => $this->request->getVar('groups'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'bpjs_sep_poli' => $this->request->getVar('bpjs_sep_poli'),
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
                    'paymentmethodname' => $this->request->getVar('paymentmethod'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                    'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                    'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                    'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokterpoli' => $this->request->getVar('dokterpoli'),
                    'dokterpoliname' => $this->request->getVar('dokterpoliname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'inacbgsclass' => $this->request->getVar('classroom'),
                    'inacbgs' => $this->request->getVar('inacbgs'),
                    'inacbgsname' => $this->request->getVar('inacbgsname'),
                    'reasoncode' => $this->request->getVar('reasoncode'),
                    'statuspasien' => $this->request->getVar('statuspasien'),
                    'lakalantas' => $this->request->getVar('lakalantas'),
                    'lokasilakalantas' => $this->request->getVar('lokasilakalantas'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                    'telppjb' => $this->request->getVar('telppjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),
                    'pasienclassroom' => $this->request->getVar('pasienclassroom'),
                    'bumil' => $this->request->getVar('bumil'),
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'bedname' => $this->request->getVar('bedname'),
                    'bednumber' => $this->request->getVar('bednumber'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getVar('memo'),
                    'datein' => $this->request->getVar('datein'),
                    'timein' => $this->request->getVar('timein'),
                    'datetimein' => $this->request->getVar('datetimein'),
                    'dateout' => $this->request->getVar('dateout'),
                    'timeout' => $this->request->getVar('timeout'),
                    'totaldaftarklinik' => $this->request->getVar('totaldaftarklinik'),
                    'totaltindakanklinik' => $this->request->getVar('totaltindakanklinik'),
                    'totalbhptindakanklinik' => $this->request->getVar('totalbhptindakanklinik'),
                    'totalfarmasiklinik' => $this->request->getVar('totalfarmasiklinik'),
                    'totalpenunjangklinik' => $this->request->getVar('totalpenunjangklinik'),
                    'totalbhppenunjangklinik' => $this->request->getVar('totalbhppenunjangklinik'),
                    'totalkasirklinik' => $this->request->getVar('totalkasirklinik'),
                    'totalkamar' => $this->request->getVar('totalkamar'),
                    'totalvisite' => $this->request->getVar('totalvisite'),
                    'totaltindakanruang' => $this->request->getVar('totaltindakanruang'),
                    'totalmakan' => $this->request->getVar('totalmakan'),
                    'totalbhptindakanruang' => $this->request->getVar('totalbhptindakanruang'),
                    'totaltindakanoperasi' => $this->request->getVar('totaltindakanoperasi'),
                    'totalbhptindakanoperasi' => $this->request->getVar('totalbhptindakanoperasi'),
                    'totalfarmasi' => $this->request->getVar('totalfarmasi'),
                    'totalpenunjang' => $this->request->getVar('totalpenunjang'),
                    'totalbhppenunjang' => $this->request->getVar('totalbhppenunjang'),
                    'totallainnya' => $this->request->getVar('totallainnya'),
                    'totalbhplainnya' => $this->request->getVar('totalbhplainnya'),
                    'totalkasirranap' => $this->request->getVar('totalkasirranap'),
                    'totalkasirpenunjang' => $this->request->getVar('totalkasirpenunjang'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'discount' => $this->request->getVar('disc'),
                    'tarifkelas1' => $this->request->getVar('tarifkelas1'),
                    'tarifkelas2' => $this->request->getVar('tarifkelas2'),
                    'tarifkelas3' => $this->request->getVar('tarifkelas3'),
                    'selisih' => $selisih,
                    'realcost' => $this->request->getVar('grandtotal'),
                    'paymentcardnumbernew' => $this->request->getVar('paymentcardnumbernew'),
                    'paymentchange' => $this->request->getVar('paymentchange'),
                    'pasienclassroomnew' => $this->request->getVar('pasienclassroomnew'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'payersname' => $this->request->getVar('payersname'),
                    'metodepembayaran' => $this->request->getVar('metodepembayaran'),
                    'referensibank' => $this->request->getVar('daftarbank'),
                    'nominaldebet' => $this->request->getVar('nominaldebet'),
                    'noreferensidebet' => $this->request->getVar('referensibank'),
                ];
                $perawat = new ModelValidasiPembayaranRanap;
                $perawat->insert($simpandata);
                $msg2 = [
                    'sukses' => 'Validasi Pindah Hak Kelas Berhasil',
                    'memo' => $memo,
                    'validationnumber' => $newkode,
                ];
            }
            echo json_encode($msg2);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function printbukti_pindahhakkelas()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_bukti_pindahhakkelas($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap_kasir_pindahhakkelas($journalnumber);


        $resume = new ModelTNODetail();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganranapprint_pindahhakkelas($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $resume->search($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'VISITE' => $resume->searchVisite($referencenumber),
            'OPERASI' => $resume->Operasi($referencenumber),
            'PENUNJANG' => $resume->Penunjangheader($referencenumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD($referencenumber),
            'FARMASI' => $resume->FARMASI($referencenumber),
            'BHP' => $resume->BHPpenunjangranap($referencenumber),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_bukti_pindahhakkelas', $data);
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


    public function dataPindahKelas()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'cabar' => $this->data_payment(),
            ];
            $msg = [
                'data' => view('KasirRI/modaldatapindahkelas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildata_pindahkelas()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_close_validasi_pindahhakkelas()
            ];
            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi_classroomchange', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridata_pindahkelas()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['tglpembayaran']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRanap_close_validasi_pindahhakkelas($search)
            ];

            $msg = [
                'data' => view('kasirRI/dataregisterranap_kasirRI_validasi_classroomchange', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalPindahKelas()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $deletedby = $this->request->getVar('deletedby');
            $canceldate = date('Y-m-d h:m:s');
            $kasir = new ModelValidasiPembayaranRanap();
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
                'sukses' => "Data pindah kelas Berhasil dibatalkan"
            ];

            echo json_encode($msg);
        }
    }

    public function LaporanPenerimaan()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRI/registerkasir_penerimaan', $data);
    }


    public function ambildatapenerimaan()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_penerimaan($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_penerimaan(),
                'tampildatarajal' => $register->ambildatarajal_penerimaan(),
                'tampildataigd' => $register->ambildataigd_penerimaan(),
                'tampildatapenunjang' => $register->ambildatapenunjang_penerimaan(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRI/dataregister_kasirRanap_penerimaan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapenerimaan()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_penerimaan($lokasikasir);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRanap_penerimaan($search),
                'tampildatarajal' => $register->search_RegisterRajal_penerimaan($search),
                'tampildataigd' => $register->search_RegisterIgd_penerimaan($search),
                'tampildatapenunjang' => $register->search_RegisterPenunjang_penerimaan($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRI/dataregister_kasirRanap_penerimaan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function LaporanPiutang()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRI/registerkasir_piutang', $data);
    }


    public function ambildatapiutang()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_piutang($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_penerimaan(),
                'tampildatarajal' => $register->ambildatarajal_penerimaan(),
                'tampildataigd' => $register->ambildataigd_penerimaan(),
                'tampildatapenunjang' => $register->ambildatapenunjang_penerimaan(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRI/dataregister_kasirRanap_piutang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapiutang()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_kasir_piutang($lokasikasir);

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRanap_piutang($search),
                'tampildatarajal' => $register->search_RegisterRajal_piutang($search),
                'tampildataigd' => $register->search_RegisterIgd_piutang($search),
                'tampildatapenunjang' => $register->search_RegisterPenunjang_piutang($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRI/dataregister_kasirRanap_piutang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function LaporanValidasiDetail()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('kasirRI/registerkasir_validasi', $data);
    }


    public function ambildataValidasiDetail()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "KASIR";
            $hal = "Laporan Detail Validasi";
            $m_icd = new ModelPasienRanap($this->request);
            $row3 = $m_icd->get_data_detail_validasi($lokasikasir, $hal);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataranap_beritaacara(),
                'tampildatarajal' => $register->ambildatarajal_beritaacara(),
                'tampildataigd' => $register->ambildataIgd_beritaacara(),
                'tampildatapenunjang' => $register->ambildatapenunjang_beritaacara(),
                'tampiluangmuka' => $register->ambildataregister_uangmuka(),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];
            $msg = [
                'data' => view('kasirRI/dataregister_kasir_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataValidasiDetail()
    {
        if ($this->request->isAJAX()) {
            $lokasikasir = "KASIR";
            $hal = "Laporan Detail Validasi";
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
                'tampildata' => $register->search_RegisterRanap_detail_beritaacara($search),
                'tampildatarajal' => $register->search_RegisterRajal_close_beritaacara($search),
                'tampildataigd' => $register->search_RegisterIgd_close_beritaacara($search),
                'tampildatapenunjang' => $register->search_RegisterPenunjang_detail_beritaacara($search),
                'tampiluangmuka' => $register->search_Register_uangmuka($search),
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi']
            ];

            $msg = [
                'data' => view('kasirRI/dataregister_kasir_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printdetailkwitansiVerifikasi()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap($journalnumber);

        $resume = new ModelTNODetail();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganranapverifikasi($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $resume->search($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'VISITE' => $resume->searchVisite($referencenumber),
            'OPERASI' => $resume->Operasi($referencenumber),
            'PENUNJANG' => $resume->Penunjangheader($referencenumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD($referencenumber),
            'FARMASI' => $resume->FARMASI($referencenumber),
            'BHP' => $resume->BHPpenunjangranap($referencenumber),
            'PENUNJANGIGD' => $resume->SummaryPenunjangigdrajal($referencenumber),
            'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
            'TagihanAsal' => $resume->TagihanAsal($referencenumber),
            'UangMuka' => $resume->UangMuka($referencenumber),
        ];

        return view('cetakan/printdetailranapverifikasi', $data);
    }

    public function resumeGabungPilihan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $pilihancabar = $this->request->getVar('pilihancabar');
            $klaim = new ModelKlaim();
            //$row = $klaim->get_data_ranap_kasir($referencenumber);
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);

            $data = [
                'TNO' => $resume->searchPilihan($referencenumber, $pilihancabar),
                'GIZI' => $resume->searchAsupanGiziPilihan($referencenumber, $pilihancabar),
                'VISITE' => $resume->searchVisitePilihan($referencenumber, $pilihancabar),
                'OPERASI' => $resume->OperasiPilihan($referencenumber, $pilihancabar),
                'PENUNJANG' => $resume->PenunjangPilihan($referencenumber, $pilihancabar),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAPPILIHAN($referencenumber, $pilihancabar),
                'BHP' => $resume->BHPPilihan($referencenumber, $pilihancabar),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
                'FARMASIIGD' => $resume->FarmasiRajalIgd($referencenumber),
                'klaim' => 0,
                'verifikasi' => 0,
                'idverifikasi' => $row['id'],
                'referencenumber' => $referencenumber,
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'jpkasir' => $this->jp_kasir(),
                'pilihankoinsiden' => 0,

            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabungPilihanKoinsiden()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $pilihancabar = $this->request->getVar('pilihancabar');
            $koinsiden = $this->request->getVar('koinsiden');
            $klaim = new ModelKlaim();
            //$row = $klaim->get_data_ranap_kasir($referencenumber);
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);

            $data = [
                'TNO' => $resume->searchPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'GIZI' => $resume->searchAsupanGiziPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'VISITE' => $resume->searchVisitePilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'OPERASI' => $resume->OperasiPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'PENUNJANG' => $resume->PenunjangPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGDKoinsiden($referencenumber),
                'TINIGD' => $resume->TindakanIGDKoinsiden($referencenumber, $koinsiden),
                'FARMASI' => $resume->FARMASIRANAPPILIHANKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'BHP' => $resume->BHPPilihan($referencenumber, $pilihancabar),
                'PENUNJANGIGD' => $resume->PenunjangigdrajalKoinsiden($referencenumber, $koinsiden),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
                'FARMASIIGD' => $resume->FarmasiRajalIgdKoinsiden($referencenumber, $koinsiden),
                'klaim' => 0,
                'verifikasi' => 0,
                'idverifikasi' => $row['id'],
                'referencenumber' => $referencenumber,
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'jpkasir' => $this->jp_kasir(),
                'pilihankoinsiden' => $koinsiden,

            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printdetailkwitansiKlaim()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap($journalnumber);

        $resume = new ModelTNODetail();

        $referencenumber = $this->request->getVar('page');
        $pilihancabar = $this->request->getVar('rincian');

        $split = new ModelKlaim();
        $data = [
            'datapasien' => $split->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $split->searchPilihan($referencenumber, $pilihancabar),
            'GIZI' => $split->searchAsupanGiziPilihan($referencenumber, $pilihancabar),
            'VISITE' => $split->searchVisitePilihan($referencenumber, $pilihancabar),
            'OPERASI' => $split->OperasiPilihan($referencenumber, $pilihancabar),
            'PENUNJANG' => $split->PenunjangdetailPilihanRanap($referencenumber, $pilihancabar),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD($referencenumber),
            'FARMASI' => $split->FARMASIPilihan($referencenumber, $pilihancabar),
            'BHP' => $split->BHPpenunjangranapPilihan($referencenumber, $pilihancabar),
            'cabar' => $pilihancabar,
        ];


        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/printdetailranapklaim', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function resumeGabungValidasiPilihan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $pilihancabar = $this->request->getVar('pilihancabar');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $row2 = $m_icd->get_data_ranap_kasir_validasi_print2($referencenumber);
            //$row_bayar = $m_icd->get_data_kasir_ranap_validasi($referencenumber);
            $data = [
                'TNO' => $resume->searchPilihan($referencenumber, $pilihancabar),
                'GIZI' => $resume->searchAsupanGiziPilihan($referencenumber, $pilihancabar),
                'VISITE' => $resume->searchVisitePilihan($referencenumber, $pilihancabar),
                'OPERASI' => $resume->OperasiPilihan($referencenumber, $pilihancabar),
                'PENUNJANG' => $resume->PenunjangPilihan($referencenumber, $pilihancabar),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAPPILIHAN($referencenumber, $pilihancabar),
                'BHP' => $resume->BHPPilihan($referencenumber, $pilihancabar),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'FARMASIIGD' => $resume->FarmasiRajalIgd($referencenumber),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'jpkasir' => $this->jp_kasir(),
                'paymentamount' => $row2['paymentamount'],
                'referensibank' => $row2['referensibank'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'inacbgsclass' => $row2['inacbgsclass'],
                'inacbgs' => $row2['inacbgs'],
                'inacbgsname' => $row2['inacbgsname'],
                'tarifkelas1' => $row2['tarifkelas1'],
                'tarifkelas2' => $row2['tarifkelas2'],
                'tarifkelas3' => $row2['tarifkelas3'],
                'disc' => $row2['discount'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'types' => $row2['types'],
                'paymentstatus' => $row2['paymentstatus'],
                'memo' => $row2['memo'],
                'id' => $row2['id'],


            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_after_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabungPilihanKoinsidenValidasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $pilihancabar = $this->request->getVar('pilihancabar');
            $koinsiden = $this->request->getVar('koinsiden');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);
            $row2 = $m_icd->get_data_ranap_kasir_validasi_print2($referencenumber);
            //$row_bayar = $m_icd->get_data_kasir_ranap_validasi($referencenumber);
            $data = [
                'TNO' => $resume->searchPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'GIZI' => $resume->searchAsupanGiziPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'VISITE' => $resume->searchVisitePilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'OPERASI' => $resume->OperasiPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'PENUNJANG' => $resume->PenunjangPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGDKoinsiden($referencenumber, $koinsiden),
                'FARMASI' => $resume->FARMASIRANAPPILIHANKoinsiden($referencenumber, $pilihancabar, $koinsiden),
                'BHP' => $resume->BHPPilihan($referencenumber, $pilihancabar),

                'PENUNJANGIGD' => $resume->PenunjangigdrajalKoinsiden($referencenumber, $koinsiden),
                'BHPPENUNJANGIGD' => $resume->BHPpenunjangigd2($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),

                'FARMASIIGD' => $resume->FarmasiRajalIgdKoinsiden($referencenumber, $koinsiden),
                'statuspasienpulang' => $row['statuspasienpulang'],
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
                'token_ranap' => $row['token_ranap'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'validation' => $row['validation'],

                'parentjournalnumber' => $row['parentjournalnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => $row['namapjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'alamatpjb' => $row['alamatpjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'dateout' => $row['dateout'],
                'timeout' => $row['timeout'],
                'datetimeout' => $row['datetimeout'],
                'payment' => $row['payment'],
                'paymentchange' => $row['paymentchange'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'metodebayar' => $this->metodebayar(),
                'daftarbank' => $this->daftar_bank(),
                'jpkasir' => $this->jp_kasir(),
                'paymentamount' => $row2['paymentamount'],
                'referensibank' => $row2['referensibank'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'inacbgsclass' => $row2['inacbgsclass'],
                'inacbgs' => $row2['inacbgs'],
                'inacbgsname' => $row2['inacbgsname'],
                'tarifkelas1' => $row2['tarifkelas1'],
                'tarifkelas2' => $row2['tarifkelas2'],
                'tarifkelas3' => $row2['tarifkelas3'],
                'disc' => $row2['discount'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'types' => $row2['types'],
                'paymentstatus' => $row2['paymentstatus'],
                'memo' => $row2['memo'],
                'id' => $row2['id'],
                'pilihankoinsiden' => $koinsiden,


            ];
            $msg = [
                'data' => view('kasirRI/data_resume_gabung_kasirRI_after_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

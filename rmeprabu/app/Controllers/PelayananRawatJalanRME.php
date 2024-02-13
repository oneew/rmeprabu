<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\Model_gambar_rme;
use App\Models\ModelPasienRanap;
use App\Models\ModelTNODetailRJ;
use App\Models\ModelDepoSPHeader;

use App\Models\ModelTNOHeaderRajal;
use App\Models\ModelPenunjangDetail;
use App\Models\ModelPasienMaster;
use App\Models\ModelPelayananPoliRME;
use App\Models\ModelPelayananPoliHDRME;
use App\Models\ModelPelayananPoliRMEMedis;
use App\Models\Modellogactivity;
use App\Models\ModelRME;
use App\Models\ModelDaftarRadiologi;
use App\Models\ModelranapOrderPenunjang;
use App\Models\ModelFarmasiPelayananHeader;
use App\Models\ModelMasterObat;
use App\Models\ModelFarmasiPelayananDetail;
use App\Models\ModelTerimaPBFDetail;
use App\Models\ModelPelayananPoliRMETRIAGE;
use App\Models\ModelRekMedHeader;
use App\Models\ModelPelayananPoliRMEMonitoring;
use App\Models\ModelPelayananPoliHDRMEMonitoring;
use App\Models\ModelPelayananPoliRMETRansfer;
use App\Models\ModelCPPTRME;
use App\Models\ModelLaporanOperasiRME;
use App\Models\ModelPelayananPoliRMENICU;
use App\Models\ModelPelayananPoliRMEICU;
use App\Models\ModelPelayananPoliRMEEdukasiPraBedah;
use App\Models\ModelAsesmenPasienPulangRME;
use App\Models\ModelCetakDetail_A;
use App\Models\ModelDaftarRanap;
use App\Models\ModelTNODetail;
use App\Models\ModelKlaim;
use App\Models\ModelPulangRanap;
use App\Models\ModelTempletEresepDetail;
use App\Models\ModelTempletEresepHeader;
use App\Models\ModelDisabilitasMcu;
use App\Models\ModelDokter;
use App\Models\ModelObatRacikan;
use App\Models\ModelSkdMcu;
use App\Models\ModelTNOHeader;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;


class PelayananRawatJalanRME extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme', $data)
            ];
            return json_encode($msg);
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

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function rincianrajal($id = '')
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
            ];
            $msg = [
                'data' => view('rawatjalan/DRJ', $data)
            ];
            return json_encode($msg);
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
            'validation' => $row['validation'],
        ];

        return view('rawatjalan/DRJ', $data);
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
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }






    public function simpandataregister()
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

                ],

                'poliklinikname' => [
                    'label' => 'Kontak Email Pasien',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'ibsdoktername' => $validation->getError('ibsdoktername'),
                        'poliklinikname' => $validation->getError('poliklinikname')
                    ]
                ];
            } else {
                $tglrujukan = date('Y-m-d', strtotime($this->request->getVar("referencedate")));

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $lokasi = $this->request->getVar('poliklinik');
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinik='$lokasi' AND groups='$groups'  LIMIT 1");

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

                $newkode = $groups . $underscore . $lokasi . $underscore  . $today . $underscore . sprintf('%06s', $nourut);



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

                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'visited' => $this->request->getVar('visited'),
                    'journalnumber' => $newkode,
                    'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'noantrian' => $no_antrian,
                    'numberseq' => $no_antrian,
                    'pasienid' => $this->request->getVar('pasienid'),
                    'oldcode' => $this->request->getVar('oldcode'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'pasiengender' => $this->request->getVar('pasiengender'),
                    'pasienmaritalstatus' => $this->request->getVar('pasienmaritalstatus'),
                    'pasienage' => $umur,
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                    'registerdate' => $this->request->getVar('registerdate'),
                    'pasienaddress' => $this->request->getVar('pasienaddress'),
                    'pasienarea' => $this->request->getVar('pasienarea'),
                    'pasiensubarea' => $this->request->getVar('pasiensubarea'),
                    'pasiensubareaname' => $this->request->getVar('pasiensubareaname'),
                    'pasienparentname' => $this->request->getVar('pasienparentname'),
                    'pasienssn' => $this->request->getVar('pasienssn'),
                    'pasientelephone' => $this->request->getVar('pasientelephone'),
                    'paymentmethod' => $this->request->getVar('paymentmethod'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'paymentcardnumber' => $this->request->getVar('pasiencard'),
                    'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                    'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                    'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                    'paymentmethod_payment' => $this->request->getVar('paymentmethod'),
                    'paymentmethodname_payment' => $this->request->getVar('paymentmethodname'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'dokter' => $this->request->getVar('ibsdokter'),
                    'doktername' => $this->request->getVar('ibsdoktername'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'referencedate' => $tglrujukan,

                    'code' => $this->request->getVar('code_pelayanan'),
                    'description' => $this->request->getVar('description'),
                    'price' => $this->request->getVar('price'),
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),

                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'noantrian' => $no_antrian,
                    'createdip' => $this->request->getVar('createdip'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                    'reasoncode' => $this->request->getVar('reasoncode'),
                    'memo' => $this->request->getVar('memo'),
                    'email' => $this->request->getVar('email'),
                    'token_rajal' => $this->request->getVar('token_rajal'),
                ];
                $perawat = new ModelRawatJalanDaftar;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Pendaftaran Rawat Jalan Berhasil'
                ];
            }
            return json_encode($msg);
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
            return json_encode($msg);
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

    private function _data_dokter_all()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_all();
        return $list;
    }

    private function data_paramedic($namapoli)
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_paramedic($namapoli);
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
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'OPERASI' => $resume->Operasirajal($referencenumber),
                'PENUNJANG' => $resume->Penunjangrajal($referencenumber),
                'FARMASI' => $resume->FARMASIrajal($referencenumber),
                'BHP' => $resume->BHPrajal($referencenumber),
                'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber)
            ];
            $msg = [
                'data' => view('rawatjalan/data_resume_gabung', $data)
            ];
            return json_encode($msg);
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

                'list' => $this->_data_dokter_all(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),
                'paramedic' => $this->data_paramedic($namapoli),

            ];
            $msg = [
                'sukses' => view('rawatjalan/modalinputTNOrajal', $data)
            ];
            return json_encode($msg);
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
            return json_encode($msg);
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

                $pelaksana = $this->request->getVar('pelaksana2');
                if ($pelaksana == 1) {
                    $pelaksana = "Paramedis";
                } else {
                    $pelaksana = "Dokter";
                }


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
                    'pelaksana' => $pelaksana,
                    'paramedicName' => $this->request->getVar('paramedicName')

                ];
                $tno = new ModelTNODetailRJ;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Berhasil Ditambahkan'
                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeTNO()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetailRJ();

            $referencenumber = $this->request->getVar('referencenumber');
            $row = $perawat->search_rajal($referencenumber);
            $data = [
                'tampildata' => $perawat->search($referencenumber),
                'pasienid' => $row['pasienid'],
                'validation' => $row['validation']
            ];
            $msg = [
                'data' => view('rawatjalan/data_resume_TNO_rajal', $data)
            ];
            return json_encode($msg);
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

            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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

            return json_encode($msg);
        }
    }

    public function tambahTNOdetail()
    {
        if ($this->request->isAJAX()) {

            $journalnumber = $this->request->getVar('journalnumber');

            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_by_journalnumber($journalnumber);
            $namapoli = $row['poliklinikname'];
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
                'paramedic' => $this->data_paramedic($namapoli),

            ];
            $msg = [
                'sukses' => view('rawatjalan/modalinputTNOrajal_add', $data)
            ];
            return json_encode($msg);
        }
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
    public function ValidasiPemeriksaanIgd()
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
                'sukses' => view('igd/modalvalidasiigdrme', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function simpanpemeriksaanigd()
    {
        if ($this->request->isAJAX()) {

            $signature_awal = $this->request->getVar('signature_awal');
            $signature_baru = $this->request->getVar('signature');
            $cabar = $this->request->getVar('paymentmethodname');

            if ($cabar == "TUNAI") {
                $simpandata = [
                    'anamnesa' => $this->request->getVar('anamnesa'),
                    'hasilperiksa' => $this->request->getVar('hasilperiksa'),
                    'advicedokter' => $this->request->getVar('advicedokter'),
                    'indikasirawat' => $this->request->getVar('indikasi'),
                    'signaturedokter' => $signature_baru,
                    'validasipemeriksaan' => $this->request->getVar('validasipemeriksaan'),
                ];
            } else {
                $simpandata = [
                    'anamnesa' => $this->request->getVar('anamnesa'),
                    'hasilperiksa' => $this->request->getVar('hasilperiksa'),
                    'advicedokter' => $this->request->getVar('advicedokter'),
                    'indikasirawat' => $this->request->getVar('indikasi'),
                    'signaturedokter' => $signature_baru,
                    'validasipemeriksaan' => $this->request->getVar('validasipemeriksaan'),
                    'statuspasien' => $this->request->getVar('advicedokter'),
                ];
            }

            $perawat = new ModelPelayananIGD;
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
                'sukses' => view('rawatjalan/modalvalidasipolirme', $data)
            ];
            return json_encode($msg);
        }
    }

    public function status_pasien()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pasien_status_rajal();
        return $list;
    }

    public function simpanpemeriksaanrme()
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

            return json_encode($msg);
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

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Order()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelPenunjangDetail();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->search_penunjang_rajal($referencenumber)
            ];

            $msg = [
                'data' => view('igd/data_resume_penunjang', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ValidasiFromModal()
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
                'suksesmodalvalidasi' => view('rawatjalan/modalvalidasipoliNew', $data)
            ];
            return json_encode($msg);
        }
    }

    public function VerifikasiRincian()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rawatjalan/verifikasipasienpulang', $data);
    }

    public function ambildataVerifikasi()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatapasienpulangRajal()
            ];
            $msg = [
                'data' => view('rawatjalan/verifikasidatapasienpulang', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienVerifikasi()
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
                'tampildata' => $register->search_pasienpulang_Rajal($search)
            ];

            $msg = [
                'data' => view('rawatjalan/verifikasidatapasienpulang', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatverifikasirajal()
    {
        if ($this->request->isAJAX()) {
            $journalnumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_rajal_verifikasi($journalnumber),

            ];
            $msg = [
                'suksesverif' => view('rawatjalan/modalverifikasirajal', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeTNO_Verifikasi()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetailRJ();

            $referencenumber = $this->request->getVar('referencenumber');
            $row = $perawat->search_rajal($referencenumber);
            $data = [
                'tampildata' => $perawat->search($referencenumber),
                'pasienid' => $row['pasienid'],
                'validation' => $row['validation']
            ];
            $msg = [
                'data' => view('rawatjalan/data_resume_TNO_rajal_verifikasi', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiSelesai()
    {
        if ($this->request->isAJAX()) {

            $verifikasi = 1;
            $petugasverifikasi = $this->request->getVar('petugasverifikasi');
            $tanggalverifikasi = $this->request->getVar('tanggalverifikasi');
            $simpandata = [
                'verifikasi' => $verifikasi,
                'petugasverifikasi' => $petugasverifikasi,
                'tanggalverifikasi' => $tanggalverifikasi,
                'tandaverifikasi' => 1,

            ];
            $verifikasirincian = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('id');
            $verifikasirincian->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Selesai, Rincian Sudah Dapat Divalidasi Kasir!'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiBatal()
    {
        if ($this->request->isAJAX()) {

            $verifikasi = 0;
            $simpandata = [
                'verifikasi' => $verifikasi,
                'petugasverifikasi' => 'NONE',
                'tanggalverifikasi' => '',
                'tandaverifikasi' => 1,

            ];
            $verifikasirincian = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('id');
            $verifikasirincian->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Telah Dibatalkan!'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function RegisterPerjanjian()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rawatjalan/registerpoliklinikperjanjian', $data);
    }

    public function ambildataPerjanjian()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajalPerjanjian()
            ];
            $msg = [
                'data' => view('rawatjalan/dataregisterpoliklinikperjanjian', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliPerjanjian()
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
                'tampildata' => $register->search_RegisterRajalPerjanjian($search)
            ];

            $msg = [
                'data' => view('rawatjalan/dataregisterpoliklinikperjanjian', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function entriRME()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_poli($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME Rajal',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'noSuratKontrol' => $row['noSuratKontrol'],

                'referencenumber' => $row['journalnumber'],
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_rajal'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
                'nomorreferensi' => $row['journalnumber'],
            ];
            $msg = [
                'sukses' => view('rme/modalrmerajal_poliklinik', $data)
            ];
            return json_encode($msg);
        }
    }

    public function AsesmenAwalPerawat()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULUT1") {
                $file = 'rme/asesmen_awal_keperawatan_gigi';
            } else if ($poliklinikname == "HEMODIALISA") {
                $file = 'rme/asesmen_awal_keperawatan_hemodialisa';
            } else  if ($poliklinikname == "KEBIDANAN") {
                $file = 'rme/asesmen_awal_keperawatan_ginekologi';
            } else {
                $file = 'rme/asesmen_awal_keperawatan_umum';
            }



            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'KB' => $this->kb(),
                'createdBy' => $this->request->getVar('createdBy'),
                'alatBantuBerjalan' => $this->alatBantuBerjalan(),
                'mobilisasi' => $this->mobilisasi(),
                // 'admissionDateTime' => $row['registerdate'],


            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    // hemodialisa 

    public function AsesmenAwalPerawatHDMonitoring()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];
            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";


            $file = 'rme/asesmen_awal_keperawatan_HD_monitoring';
            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $data = [
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'turunbb' => $this->turunbb_detail(),
                'diagnosis' => $diagnosis,
            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function AsesmenAwalPerawatHDHasilMonitoring()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliHDRMEMonitoring();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_monitoring($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_monitoring_hd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanAsesmenPerawatHDMonitoring()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'monitoring_paramedicName' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'monitoring_paramedicName' => $validation->getError('monitoring_paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM monitoring_perawathd_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRJ-RME';
                $groups = 'IRJ';
                $underscore = '_';

                $admissionDateTimeAsesmen = $this->request->getVar('executionDateTime');
                $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
                $asesmenDate = $tglasesmen[0];
                $asesmenTime = $tglasesmen[1];

                $explode_tanggal = explode("-", $asesmenDate);
                $tahun = $explode_tanggal[2];
                $bulan = $explode_tanggal[1];
                $hari = $explode_tanggal[0];

                $tanggal_jam_asesmen = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;
                $tanggal_jam = $tahun . '-' . $bulan . '-' . $hari;
                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;



                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('monitoring_nomorreferensi'),
                    'pasienid' => $this->request->getVar('monitoring_pasienid'),
                    'monitoring_hd' => $this->request->getVar('monitoring_hd'),
                    'monitoring_qb' => $this->request->getVar('monitoring_qb'),
                    'monitoring_uf' => $this->request->getVar('monitoring_uf'),
                    'monitoring_Nacl' => $this->request->getVar('monitoring_Nacl'),
                    'monitoring_dext' => $this->request->getVar('monitoring_dext'),
                    'monitoring_Mkn' => $this->request->getVar('monitoring_Mkn'),
                    'monitoring_Lain' => $this->request->getVar('monitoring_Lain'),
                    'monitoring_UFVolume' => $this->request->getVar('monitoring_UFVolume'),
                    'KeteranganUF' => $this->request->getVar('KeteranganUF'),
                    'monitoring_jumlah' => $this->request->getVar('monitoring_jumlah'),
                    'monitoring_TotalUF' => $this->request->getVar('monitoring_TotalUF'),
                    'akses' => $this->request->getVar('akses'),
                    'Fisuse' => $this->request->getVar('Fisuse'),
                    'headache' => $this->request->getVar('headache'),
                    'kram' => $this->request->getVar('kram'),
                    'hipotensi' => $this->request->getVar('hipotensi'),
                    'nyeridada' => $this->request->getVar('nyeridada'),
                    'hipertensi' => $this->request->getVar('hipertensi'),
                    'gatal' => $this->request->getVar('gatal'),
                    'demam' => $this->request->getVar('demam'),
                    'dingin' => $this->request->getVar('dingin'),
                    'Lainya' => $this->request->getVar('Lainya'),
                    'pasienname' => $this->request->getVar('monitoring_pasienname'),
                    'paymentmethodname' => $this->request->getVar('monitoring_paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('monitoring_poliklinikname'),
                    'admissionDate' => $this->request->getVar('monitoring_admissionDate'),
                    'doktername' => $this->request->getVar('monitoring_doktername'),
                    'frekuensiNadi' => $this->request->getVar('monitoring_frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('monitoring_tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('monitoring_tdDiastolik'),
                    'suhu' => $this->request->getVar('monitoring_suhu'),
                    'frekuensiNafas' => $this->request->getVar('monitoring_frekuensiNafas'),
                    'createdBy' => $this->request->getVar('monitoring_createdBy'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'paramedicName' => $this->request->getVar('monitoring_paramedicName'),
                    'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                    'muntah' => $this->request->getVar('muntah'),
                    'perdarahan' => $this->request->getVar('perdarahan'),
                    'balance' => $this->request->getVar('balance'),
                    'diuresis' => $this->request->getVar('monitoring_diuresis'),
                    'diagnosa' => $this->request->getVar('monitoring_diagnosa'),
                    'executionDate' => $tanggal_jam,
                    'executionDateTime' => $tanggal_jam_asesmen,


                ];

                $perawat = new ModelPelayananPoliHDRMEMonitoring;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function simpanAsesmenPerawatHD()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'paramedicName' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'paramedicName' => $validation->getError('paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_perawatan_rjhd_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRJ-RME';
                $groups = 'IRJ';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;


                $Alergi = $this->request->getVar('Alergi');
                if ($Alergi == 1) {
                    $Alergi = 1;
                } else {
                    $Alergi = 0;
                }
                $uraianAlergi = $this->request->getVar('Alergi');

                $Komunikasi = $this->request->getVar('Komunikasi');
                if ($Komunikasi == 1) {
                    $Komunikasi = 1;
                } else {
                    $Komunikasi = 0;
                }
                $uraianKomunikasi = $this->request->getVar('Komunikasi');

                $merawat = $this->request->getVar('merawat');
                if ($merawat == 1) {
                    $merawat = 1;
                } else {
                    $merawat = 0;
                }
                $uraianmerawat = $this->request->getVar('merawat');

                $nutrisiTurunBb = $this->request->getVar('nutrisiTurunBb');
                if ($nutrisiTurunBb == 1) {
                    $nutrisiTurunBb = 1;
                } else {
                    $nutrisiTurunBb = 0;
                }


                $rujukAhliGizi = $this->request->getVar('rujukAhliGizi');
                if ($rujukAhliGizi == 1) {
                    $rujukAhliGizi = 1;
                } else {
                    $rujukAhliGizi = 0;
                }


                $uraianAskep = nl2br($this->request->getVar('uraianAskep'));

                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'admissionDate' => $this->request->getVar('createddate'),
                    'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                    'doktername' => $this->request->getVar('doktername'),
                    'paramedicName' => $this->request->getVar('paramedicName'),
                    'nomesin' => $this->request->getVar('nomesin'),
                    'hdke' => $this->request->getVar('hdke'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'diagnosahd' => $this->request->getVar('diagnosahd'),
                    'tipeDL' => $this->request->getVar('tipeDL'),
                    'tipedialiser' => $this->request->getVar('tipedialiser'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'Alergi' => $this->request->getVar('Alergi'),
                    'uraianAlergi' => $this->request->getVar('uraianAlergi'),
                    'keluhanUtama' => $this->request->getVar('keluhanUtama'),
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'riwayatPenyakitSekarang' => $this->request->getVar('riwayatPenyakitSekarang'),
                    'riwayatPenyakitKeluarga' => $this->request->getVar('riwayatPenyakitKeluarga'),
                    'riwayatPenyakitDahulu' => $this->request->getVar('riwayatPenyakitDahulu'),
                    'riwayatPenggunaanObat' => $this->request->getVar('riwayatPenggunaanObat'),
                    'bb' => $this->request->getVar('bb'),
                    'tb' => $this->request->getVar('tb'),
                    'skalaNyeri' => $this->request->getVar('skalaNyeri'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'frekuensiNafas' => $this->request->getVar('frekuensiNafas'),
                    'bbprehd' => $this->request->getVar('bbprehd'),
                    'Konjugtiva' => $this->request->getVar('Konjugtiva'),
                    'Ektremitas' => $this->request->getVar('Ektremitas'),
                    'bbkering' => $this->request->getVar('bbkering'),
                    'bbposthd' => $this->request->getVar('bbposthd'),
                    'akvaskular' => $this->request->getVar('akvaskular'),
                    'hdkateter1' => $this->request->getVar('hdkateter1'),
                    'avalinya' => $this->request->getVar('avalinya'),

                    'fungsionalRiwayatJatuh' => $this->request->getVar('fungsionalRiwayatJatuh'),
                    'diagnosisSekunder' => $this->request->getVar('diagnosisSekunder'),
                    'alatBantuBerjalan' => $this->request->getVar('alatBantuBerjalan'),
                    'heparin' => $this->request->getVar('heparin'),
                    'mobilisasi' => $this->request->getVar('mobilisasi'),
                    'statusMental' => $this->request->getVar('statusMental'),
                    'kriteriaHasil' => $this->request->getVar('kriteriaHasil'),

                    'tglgizi' => $this->request->getVar('tglgizi'),
                    'misscore' => $this->request->getVar('misscore'),
                    'kesimpulannutrisi' => $this->request->getVar('kesimpulannutrisi'),
                    'rujukAhliGizi' => $this->request->getVar('rujukAhliGizi'),

                    'Psikososial' => $this->request->getVar('Psikososial'),
                    'Komunikasi' => $this->request->getVar('Komunikasi'),
                    'uraianKomunikasi' => $this->request->getVar('uraianKomunikasi'),
                    'merawat' => $this->request->getVar('merawat'),
                    'uraianmerawat' => $this->request->getVar('uraianmerawat'),
                    'kondisi' => $this->request->getVar('kondisi'),
                    'tdmedik' => $this->request->getVar('tdmedik'),
                    'QB' => $this->request->getVar('QB'),
                    'QD' => $this->request->getVar('QD'),
                    'UFG' => $this->request->getVar('UFG'),
                    'Profiling' => $this->request->getVar('Profiling'),
                    'UF' => $this->request->getVar('UF'),
                    'Bicarbonat' => $this->request->getVar('Bicarbonat'),
                    'Asetat' => $this->request->getVar('Asetat'),
                    'DLBicarbonat' => $this->request->getVar('DLBicarbonat'),
                    'Condativity' => $this->request->getVar('Condativity'),
                    'Temperatur' => $this->request->getVar('Temperatur'),
                    'Sirkulasi' => $this->request->getVar('Sirkulasi'),
                    'Heparinisasiawal' => $this->request->getVar('Heparinisasiawal'),
                    'Continue' => $this->request->getVar('Continue'),
                    'Intermitten' => $this->request->getVar('Intermitten'),
                    'LMWH' => $this->request->getVar('LMWH'),
                    'TpHeparin' => $this->request->getVar('TpHeparin'),
                    'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                    'sasaranRencana' => $this->request->getVar('sasaranRencana'),

                    'uraianAskep' => $this->request->getVar('uraianAskep'),
                    'created_at' => $this->request->getVar('created_at'),
                    'updated_at' => $this->request->getVar('updated_at'),
                    'verifikasiDPJP' => $this->request->getVar('verifikasiDPJP'),
                    'tanggalJamVerifikasi' => $this->request->getVar('tanggalJamVerifikasi'),
                    'verifikator' => $this->request->getVar('verifikator'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'createddate' => $this->request->getVar('createddate'),
                    'PenggunaanObat' => $this->request->getVar('PenggunaanObat'),



                ];

                $perawat = new ModelPelayananPoliHDRME;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CPPTPerawatHD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliHDRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_cppt_perawat($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_cppt_perawatHD', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function pekerjaan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pekerjaan();
        return $list;
    }

    public function data_skala_nyeri()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_skala_nyeri();
        return $list;
    }

    public function data_kesadaran()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_kesadaran();
        return $list;
    }

    public function data_diagnosa_perawat()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_diagnosa_perawat();
        return $list;
    }

    public function ajax_paramedicName()
    {
        $request = Services::request();
        $m_auto = new ModelPelayananPoliRME();
        $key = $request->getGet('term');
        $term = $this->request->getVar('poliklinikname');
        $data = $m_auto->get_list_paramedic($term, $key);

        foreach ($data as $row) {

            $json[] = [
                'value' => $row['nama'],

            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }



    public function simpanAsesmenPerawat()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'paramedicName' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'paramedicName' => $validation->getError('paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_perawatan_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRJ-RME';
                $groups = 'IRJ';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $psikologisTak = $this->request->getVar('psikologisTak');
                if ($psikologisTak == 1) {
                    $psikologisTak = 1;
                } else {
                    $psikologisTak = 0;
                }

                $psikologisTakut = $this->request->getVar('psikologisTakut');
                if ($psikologisTakut == 1) {
                    $psikologisTakut = 1;
                } else {
                    $psikologisTakut = 0;
                }

                $psikologisSedih = $this->request->getVar('psikologisSedih');
                if ($psikologisSedih == 1) {
                    $psikologisSedih = 1;
                } else {
                    $psikologisSedih = 0;
                }


                $psikologisRendahDiri = $this->request->getVar('psikologisRendahDiri');
                if ($psikologisRendahDiri == 1) {
                    $psikologisRendahDiri = 1;
                } else {
                    $psikologisRendahDiri = 0;
                }

                $psikologisMarah = $this->request->getVar('psikologisMarah');
                if ($psikologisMarah == 1) {
                    $psikologisMarah = 1;
                } else {
                    $psikologisMarah = 0;
                }

                $psikologisMudahTersinggung = $this->request->getVar('psikologisMudahTersinggung');
                if ($psikologisMudahTersinggung == 1) {
                    $psikologisMudahTersinggung = 1;
                } else {
                    $psikologisMudahTersinggung = 0;
                }

                $sosiologisTak = $this->request->getVar('sosiologisTak');
                if ($sosiologisTak == 1) {
                    $sosiologisTak = 1;
                } else {
                    $sosiologisTak = 0;
                }

                $sosiologisIsolasi = $this->request->getVar('sosiologisIsolasi');
                if ($sosiologisIsolasi == 1) {
                    $sosiologisIsolasi = 1;
                } else {
                    $sosiologisIsolasi = 0;
                }

                $sosiologisLain = $this->request->getVar('sosiologisLain');
                if ($sosiologisLain == 1) {
                    $sosiologisLain = 1;
                } else {
                    $sosiologisLain = 0;
                }

                $spritualTak = $this->request->getVar('spritualTak');
                if ($spritualTak == 1) {
                    $spritualTak = 1;
                } else {
                    $spritualTak = 0;
                }

                $spiritualPerluDibantu = $this->request->getVar('spiritualPerluDibantu');
                if ($spiritualPerluDibantu == 1) {
                    $spiritualPerluDibantu = 1;
                } else {
                    $spiritualPerluDibantu = 0;
                }

                $spiritualAgama = $this->request->getVar('spiritualAgama');
                if ($spiritualAgama == 1) {
                    $spiritualAgama = 1;
                } else {
                    $spiritualAgama = 0;
                }

                $Alergi = $this->request->getVar('Alergi');
                if ($Alergi == 1) {
                    $Alergi = 1;
                } else {
                    $Alergi = 0;
                }


                $uraianAlergi = $this->request->getVar('Alergi');

                $nutrisiTurunBb = $this->request->getVar('nutrisiTurunBb');
                if ($nutrisiTurunBb == 1) {
                    $nutrisiTurunBb = 1;
                } else {
                    $nutrisiTurunBb = 0;
                }


                $nutrisiKurus = $this->request->getVar('nutrisiKurus');
                if ($nutrisiKurus == 1) {
                    $nutrisiKurus = 1;
                } else {
                    $nutrisiKurus = 0;
                }

                $nutrisiMuntahDiare = $this->request->getVar('nutrisiMuntahDiare');
                if ($nutrisiMuntahDiare == 1) {
                    $nutrisiMuntahDiare = 1;
                } else {
                    $nutrisiMuntahDiare = 0;
                }

                $nutrisiKondisiKhusus = $this->request->getVar('nutrisiKondisiKhusus');
                if ($nutrisiKondisiKhusus == 1) {
                    $nutrisiKondisiKhusus = 1;
                } else {
                    $nutrisiKondisiKhusus = 0;
                }

                $rujukAhliGizi = $this->request->getVar('rujukAhliGizi');
                if ($rujukAhliGizi == 1) {
                    $rujukAhliGizi = 1;
                } else {
                    $rujukAhliGizi = 0;
                }


                $fungsionalAlatBantu = $this->request->getVar('fungsionalAlatBantu');
                if ($fungsionalAlatBantu == 1) {
                    $fungsionalAlatBantu = 1;
                } else {
                    $fungsionalAlatBantu = 0;
                }

                $fungsionalProthesis = $this->request->getVar('fungsionalProthesis');
                if ($fungsionalProthesis == 1) {
                    $fungsionalProthesis = 1;
                } else {
                    $fungsionalProthesis = 0;
                }

                $fungsionalAdl = $this->request->getVar('fungsionalAdl');
                if ($fungsionalAdl == 1) {
                    $fungsionalAdl = 1;
                } else {
                    $fungsionalAdl = 0;
                }


                $fungsionalRiwayatJatuh = $this->request->getVar('fungsionalRiwayatJatuh');
                if ($fungsionalRiwayatJatuh == 1) {
                    $fungsionalRiwayatJatuh = 1;
                } else {
                    $fungsionalRiwayatJatuh = 0;
                }

                $caraBerjalan = $this->request->getVar('caraBerjalan');
                if ($caraBerjalan == 1) {
                    $caraBerjalan = 1;
                } else {
                    $caraBerjalan = 0;
                }

                $dudukMenopang = $this->request->getVar('dudukMenopang');
                if ($dudukMenopang == 1) {
                    $dudukMenopang = 1;
                } else {
                    $dudukMenopang = 0;
                }

                $uraianAskep = nl2br($this->request->getVar('uraianAskep'));



                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'bb' => $this->request->getVar('bb'),
                    'tb' => $this->request->getVar('tb'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'frekuensiNafas' => $this->request->getVar('frekuensiNafas'),
                    'skalaNyeri' => $this->request->getVar('skalaNyeri'),
                    'psikologisTak' => $psikologisTak,
                    'psikologisTakut' => $psikologisTakut,
                    'psikologisSedih' => $psikologisSedih,
                    'psikologisRendahDiri' => $psikologisRendahDiri,
                    'psikologisMarah' => $psikologisMarah,
                    'psikologisMudahTersinggung' => $psikologisMudahTersinggung,
                    'sosiologisTak' => $sosiologisTak,
                    'sosiologisIsolasi' => $sosiologisIsolasi,
                    'sosiologisLain' => $sosiologisLain,
                    'spritualTak' => $spritualTak,
                    'spiritualPerluDibantu' => $spiritualPerluDibantu,
                    'spiritualAgama' => $spiritualAgama,
                    'Alergi' => $Alergi,
                    'uraianAlergi' => $uraianAlergi,
                    'nutrisiTurunBb' => $nutrisiTurunBb,
                    'nutrisiKurus' => $nutrisiKurus,
                    'nutrisiMuntahDiare' => $nutrisiMuntahDiare,
                    'nutrisiKondisiKhusus' => $nutrisiKondisiKhusus,
                    'uraianKondisiKhusus' => $this->request->getVar('uraianKondisiKhusus'),
                    'rujukAhliGizi' => $rujukAhliGizi,
                    'fungsionalAlatBantu' => $fungsionalAlatBantu,
                    'fungsionalNamaAlatBantu' => $this->request->getVar('fungsionalNamaAlatBantu'),
                    'fungsionalProthesis' => $fungsionalProthesis,
                    'fungsionalCacatTubuh' => $this->request->getVar('fungsionalCacatTubuh'),
                    'fungsionalAdl' => $fungsionalAdl,
                    'fungsionalRiwayatJatuh' => $fungsionalRiwayatJatuh,
                    'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                    'uraianAskep' => $uraianAskep,
                    'createdBy' => $this->request->getVar('createdBy'),
                    'createddate' => $this->request->getVar('createddate'),
                    'paramedicName' => $this->request->getVar('paramedicName'),
                    'keluhanUtama' => $this->request->getVar('keluhanUtama'),
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'caraBerjalan' => $caraBerjalan,
                    'dudukMenopang' => $dudukMenopang,
                    'skoringJatuh' => $this->request->getVar('skoringJatuh'),
                    'sasaranRencana' => $this->request->getVar('sasaranRencana'),

                ];

                $perawat = new ModelPelayananPoliRME;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function cariAskep1()
    {
        if ($this->request->isAJAX()) {
            $diagnosa = $this->request->getVar('diagnosakeperawatan');
            $askep = new ModelPelayananPoliRME();
            $data = [
                'list_askep' => $askep->get_list_askep($diagnosa),

            ];
            $msg = [
                'sukses' => view('rme/modalpilihaskep', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function cariAskep()
    {
        if ($this->request->isAJAX()) {
            $diagnosa = $this->request->getVar('diagnosakeperawatan');
            $askep = new ModelPelayananPoliRME();
            $data = [
                'list_askep' => $askep->get_list_askep($diagnosa),

            ];
            $msg = [
                'sukses' => view('rme/modalpilihaskep', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    // public function carimasalahkeperawatan()
    // {
    //     if ($this->request->isAJAX()) {
    //         $diagnosa = $this->request->getVar('diagnosakeperawatan');
    //         $askep = new ModelPelayananPoliRME();
    //         $data = [
    //             'list_askep' => $askep->get_list_askep_MKep($diagnosa),

    //         ];
    //         $msg = [
    //             'sukses' => view('rme/modalpilihaskep', $data)
    //         ];

    //         return json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }
    // public function cariintervensikeperawatan()
    // {
    //     if ($this->request->isAJAX()) {
    //         $diagnosa = $this->request->getVar('diagnosakeperawatan');
    //         $askep = new ModelPelayananPoliRME();
    //         $data = [
    //             'list_askep' => $askep->get_list_askep_IKep($diagnosa),

    //         ];
    //         $msg = [
    //             'sukses' => view('rme/modalpilihaskep', $data)
    //         ];

    //         return json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }
    // public function cariintervensikolaborasi()
    // {
    //     if ($this->request->isAJAX()) {
    //         $diagnosa = $this->request->getVar('diagnosakeperawatan');
    //         $askep = new ModelPelayananPoliRME();
    //         $data = [
    //             'list_askep' => $askep->get_list_askep_MKol($diagnosa),

    //         ];
    //         $msg = [
    //             'sukses' => view('rme/modalpilihaskep', $data)
    //         ];

    //         return json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }

    public function simpanpilihAskep()
    {
        if ($this->request->isAJAX()) {
            $tandai = $this->request->getVar('tandai');
            if ($tandai <> null) {
                for ($i = 0; $i < count($tandai); $i++) {
                    $data = explode("|", $tandai[$i]);
                    $new_data[$i] = [
                        'rencana' => $data[0],
                    ];
                }

                foreach ($new_data as $item) {
                    $data_rencana[] = $item;
                }


                $dataawal = json_encode($data_rencana);
                $data_rencana_fix = json_decode($dataawal, true);
                $data_rencana_fix = json_encode($data_rencana_fix);


                $arrayData = json_decode($data_rencana_fix, true);
                $jumlahBaris = count($arrayData);
                $joinedData = '';
                //foreach ($arrayData as $data) {
                foreach ($arrayData as $index => $data) {

                    $rencana = $data['rencana'];
                    //$joinedData .= $rencana . "\n";
                    $joinedData .= ($index + 1) . '. ' . $rencana . "\n";
                    $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
                }

                $msg = [
                    'sukses' => "Rencana Keperawatan Sudah Dipilih",
                    'rencana_askep' => $joinedData
                ];
            } else {
                $msg = [
                    'gagal' => "Rencana Keperawatan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }



    public function data_konsultasi()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_konsultasi();
        return $list;
    }

    public function data_tindak_lanjut()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_tindaklanjut();
        return $list;
    }

    public function Medis()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme_medis', $data);
    }

    public function ambildataRMEMedis()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_medis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRMEMedis()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_medis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMedis()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_poli($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME Rajal',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['journalnumber'],
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_rajal'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
            ];
            $msg = [
                'sukses' => view('rme/modalrmerajal_poliklinik_medis', $data)
            ];
            return json_encode($msg);
        }
    }

    public function riwayatCPPTkonsul()

    {
        if ($this->request->isAJAX()) {
            $pasienid = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'pasienid' => $pasienid,
            ];

            $msg = [
                'sukses' => view('rme/modal_resume_cppt_konsul', $data)
            ];
            return json_encode($msg);
        }
    }


    public function resumeCPPTkonsul()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $pasienid = $this->request->getVar('pasienid');
            $data = [
                'tampildata' => $resume->get_cppt_medis_konsul($pasienid)
            ];
            $msg = [
                'data' => view('rme/riwayat_data_resume_cppt_konsul', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function AsesmenAwalMedisLama()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULUT1") {
                $file = 'rme/asesmen_awal_medis_gigi';
            } else {
                $file = 'rme/asesmen_awal_medis_umum';
            }

            $asesmen_perawat = $resume->get_data_asesmen_perawat_poli_rme_view($referencenumber);
            $asesmen_bb = isset($asesmen_perawat['bb']) != null ? $asesmen_perawat['bb'] : "";
            $asesmen_tb = isset($asesmen_perawat['tb']) != null ? $asesmen_perawat['tb'] : "";
            $asesmen_frekuensiNadi = isset($asesmen_perawat['frekuensiNadi']) != null ? $asesmen_perawat['frekuensiNadi'] : "";
            $asesmen_tdSistolik = isset($asesmen_perawat['tdSistolik']) != null ? $asesmen_perawat['tdSistolik'] : "";
            $asesmen_tdDiastolik = isset($asesmen_perawat['tdDiastolik']) != null ? $asesmen_perawat['tdDiastolik'] : "";
            $asesmen_suhu = isset($asesmen_perawat['suhu']) != null ? $asesmen_perawat['suhu'] : "";
            $asesmen_frekuensiNafas = isset($asesmen_perawat['frekuensiNafas']) != null ? $asesmen_perawat['frekuensiNafas'] : "";
            $asesmen_kesadaran = isset($asesmen_perawat['kesadaran']) != null ? $asesmen_perawat['kesadaran'] : "";


            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'konsultasi' => $this->data_konsultasi(),
                'tindaklanjut' => $this->data_tindak_lanjut(),
                'asesmen_bb' => $asesmen_bb,
                'asesmen_tb' => $asesmen_tb,
                'asesmen_frekuensiNadi' => $asesmen_frekuensiNadi,
                'asesmen_tdSistolik' => $asesmen_tdSistolik,
                'asesmen_tdDiastolik' => $asesmen_tdDiastolik,
                'asesmen_suhu' => $asesmen_suhu,
                'asesmen_frekuensiNafas' => $asesmen_frekuensiNafas,
                'asesmen_kesadaran' => $asesmen_kesadaran,
                'list' => $this->_data_dokter(),

            ];

            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    // convert base64 to image
    function conv($base64string, $output_file)
    {
        $ifp = fopen('assets/images/statuslokalis_rme/' . $output_file, 'wb');
        $data = explode(',', $base64string);

        fwrite($ifp, base64_decode($data[1]));

        fclose($ifp);

        return $output_file;
    }
    // end convert base64 to image

    public function simpanAsesmenMedisLama()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_medis_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRJ-RME-MEDIS';
                $groups = 'IRJ';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $kepala = $this->request->getVar('kepala');
                $uraiankepala = $this->request->getVar('uraiankepala');
                if ($kepala == 1) {
                    $isikepala = $uraiankepala;
                } else {
                    $isikepala = 0;
                }

                $mata = $this->request->getVar('mata');
                $uraianmata = $this->request->getVar('uraianmata');
                if ($mata == 1) {
                    $isimata = $uraianmata;
                } else {
                    $isimata = 0;
                }

                $telinga = $this->request->getVar('telinga');
                $uraiantelinga = $this->request->getVar('uraiantelinga');
                if ($telinga == 1) {
                    $isitelinga = $uraiantelinga;
                } else {
                    $isitelinga = 0;
                }

                $hidung = $this->request->getVar('hidung');
                $uraianhidung = $this->request->getVar('uraianhidung');
                if ($hidung == 1) {
                    $isihidung = $uraianhidung;
                } else {
                    $isihidung = 0;
                }

                $bibir = $this->request->getVar('bibir');
                $uraianbibir = $this->request->getVar('uraianbibir');
                if ($bibir == 1) {
                    $isibibir = $uraianbibir;
                } else {
                    $isibibir = 0;
                }

                $rambut = $this->request->getVar('rambut');
                $uraianrambut = $this->request->getVar('uraianrambut');
                if ($rambut == 1) {
                    $isirambut = $uraianrambut;
                } else {
                    $isirambut = 0;
                }

                $gigiGeligi = $this->request->getVar('gigiGeligi');
                $uraiangigiGeligi = $this->request->getVar('uraiangigiGeligi');
                if ($gigiGeligi == 1) {
                    $isigigiGeligi = $uraiangigiGeligi;
                } else {
                    $isigigiGeligi = 0;
                }

                $lidah = $this->request->getVar('lidah');
                $uraianlidah = $this->request->getVar('uraianlidah');
                if ($lidah == 1) {
                    $isilidah = $uraianlidah;
                } else {
                    $isilidah = 0;
                }

                $LangitLangit = $this->request->getVar('LangitLangit');
                $uraianLangitLangit = $this->request->getVar('uraianLangitLangit');
                if ($LangitLangit == 1) {
                    $isiLangitLangit = $uraianLangitLangit;
                } else {
                    $isiLangitLangit = 0;
                }

                $leher = $this->request->getVar('leher');
                $uraianleher = $this->request->getVar('uraianleher');
                if ($leher == 1) {
                    $isileher = $uraianleher;
                } else {
                    $isileher = 0;
                }

                $tenggorokan = $this->request->getVar('tenggorokan');
                $uraiantenggorokan = $this->request->getVar('uraiantenggorokan');
                if ($tenggorokan == 1) {
                    $isitenggorokan = $uraiantenggorokan;
                } else {
                    $isitenggorokan = 0;
                }

                $dada = $this->request->getVar('dada');
                $uraiandada = $this->request->getVar('uraiandada');
                if ($dada == 1) {
                    $isidada = $uraiandada;
                } else {
                    $isidada = 0;
                }

                $tonsil = $this->request->getVar('tonsil');
                $uraiantonsil = $this->request->getVar('uraiantonsil');
                if ($tonsil == 1) {
                    $isitonsil = $uraiantonsil;
                } else {
                    $isitonsil = 0;
                }

                $payudara = $this->request->getVar('payudara');
                $uraianpayudara = $this->request->getVar('uraianpayudara');
                if ($payudara == 1) {
                    $isipayudara = $uraianpayudara;
                } else {
                    $isipayudara = 0;
                }

                $perut = $this->request->getVar('perut');
                $uraianperut = $this->request->getVar('uraianperut');
                if ($perut == 1) {
                    $isiperut = $uraianperut;
                } else {
                    $isiperut = 0;
                }

                $punggung = $this->request->getVar('punggung');
                $uraianpunggung = $this->request->getVar('uraianpunggung');
                if ($punggung == 1) {
                    $isipunggung = $uraianpunggung;
                } else {
                    $isipunggung = 0;
                }

                $genital = $this->request->getVar('genital');
                $uraiangenital = $this->request->getVar('uraiangenital');
                if ($genital == 1) {
                    $isigenital = $uraiangenital;
                } else {
                    $isigenital = 0;
                }

                $anus = $this->request->getVar('anus');
                $uraiananus = $this->request->getVar('uraiananus');
                if ($anus == 1) {
                    $isianus = $uraiananus;
                } else {
                    $isianus = 0;
                }

                $lenganAtas = $this->request->getVar('lenganAtas');
                $uraianlenganAtas = $this->request->getVar('uraianlenganAtas');
                if ($lenganAtas == 1) {
                    $isilenganAtas = $uraianlenganAtas;
                } else {
                    $isilenganAtas = 0;
                }

                $lenganBawah = $this->request->getVar('lenganBawah');
                $uraianlenganBawah = $this->request->getVar('uraianlenganBawah');
                if ($lenganBawah == 1) {
                    $isilenganBawah = $uraianlenganBawah;
                } else {
                    $isilenganBawah = 0;
                }

                $jariTangan = $this->request->getVar('jariTangan');
                $uraianjariTangan = $this->request->getVar('uraianjariTangan');
                if ($jariTangan == 1) {
                    $isijariTangan = $uraianjariTangan;
                } else {
                    $isijariTangan = 0;
                }

                $kukuTangan = $this->request->getVar('kukuTangan');
                $uraiankukuTangan = $this->request->getVar('uraiankukuTangan');
                if ($kukuTangan == 1) {
                    $isikukuTangan = $uraiankukuTangan;
                } else {
                    $isikukuTangan = 0;
                }

                $persendianTangan = $this->request->getVar('persendianTangan');
                $uraianpersendianTangan = $this->request->getVar('uraianpersendianTangan');
                if ($persendianTangan == 1) {
                    $isipersendianTangan = $uraianpersendianTangan;
                } else {
                    $isipersendianTangan = 0;
                }

                $tungkaiAtas = $this->request->getVar('tungkaiAtas');
                $uraiantungkaiAtas = $this->request->getVar('uraiantungkaiAtas');
                if ($tungkaiAtas == 1) {
                    $isitungkaiAtas = $uraiantungkaiAtas;
                } else {
                    $isitungkaiAtas = 0;
                }

                $tungkaiBawah = $this->request->getVar('tungkaiBawah');
                $uraiantungkaiBawah = $this->request->getVar('uraiantungkaiBawah');
                if ($tungkaiBawah == 1) {
                    $isitungkaiBawah = $uraiantungkaiBawah;
                } else {
                    $isitungkaiBawah = 0;
                }

                $jariKaki = $this->request->getVar('jariKaki');
                $uraianjariKaki = $this->request->getVar('uraianjariKaki');
                if ($jariKaki == 1) {
                    $isijariKaki = $uraianjariKaki;
                } else {
                    $isijariKaki = 0;
                }

                $kukuKaki = $this->request->getVar('kukuKaki');
                $uraiankukuKaki = $this->request->getVar('uraiankukuKaki');
                if ($kukuKaki == 1) {
                    $isikukuKaki = $uraiankukuKaki;
                } else {
                    $isikukuKaki = 0;
                }

                $persendianKaki = $this->request->getVar('persendianKaki');
                $uraianpersendianKaki = $this->request->getVar('uraianpersendianKaki');
                if ($persendianKaki == 1) {
                    $isipersendianKaki = $uraianpersendianKaki;
                } else {
                    $isipersendianKaki = 0;
                }

                $keluhanUTama = nl2br($this->request->getVar('keluhanUtama'));
                $riwayatPenyakitSekarang = nl2br($this->request->getVar('riwayatPenyakitSekarang'));
                $riwayatPenyakitKeluarga = nl2br($this->request->getVar('riwayatPenyakitKeluarga'));
                $objective = nl2br($this->request->getVar('objective'));
                $planning = nl2br($this->request->getVar('objective_medis'));

                // status lokalis
                $anatomi = $this->request->getVar('anatomi');

                if ($anatomi != "") {
                    $imageName = md5(uniqid(rand(), true)) . '.jpeg';
                    $image = $this->conv($this->request->getVar('anatomi'), $imageName);
                    $status_lokalis = $imageName;
                    // end status lokalis
                } else {
                    $status_lokalis = '';
                }

                // handle file record audio
                $dataAudio = $this->request->getFile('audData');
                $nameFile = null;
                if (!$dataAudio->getError() == 4) {
                    $nameFile = $dataAudio->getRandomName();
                    $dataAudio->move('assets/audio_rme', $nameFile);
                }
                // end handle file record audio



                $simpandata = [
                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'gambar_anatomi_tubuh' => $status_lokalis,
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'tb' => $this->request->getVar('tb'),
                    'bb' => $this->request->getVar('bb'),
                    'denyut_jantung' => $this->request->getVar('frekuensiNadi'),
                    'pernapasan' => $this->request->getVar('pernapasan'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'kepala' => $isikepala,
                    'mata' => $isimata,
                    'telinga' => $isitelinga,
                    'hidung' => $isihidung,
                    'rambut' => $isirambut,
                    'bibir' => $isibibir,
                    'gigiGeligi' => $isigigiGeligi,
                    'lidah' => $isilidah,
                    'langitLangit' => $isiLangitLangit,
                    'tonsil' => $isitonsil,
                    'dada' => $isidada,
                    'payudara' => $isipayudara,
                    'punggung' => $isipunggung,
                    'perut' => $isiperut,
                    'genital' => $isigenital,
                    'anus' => $isianus,
                    'lengan_atas' => $isilenganAtas,
                    'lengan_bawah' => $isilenganBawah,
                    'jari_tangan' => $isijariTangan,
                    'kuku_tangan' => $isikukuTangan,
                    'persendian_tangan' => $isipersendianTangan,
                    'tungkai_atas' => $isitungkaiAtas,
                    'tungkai_bawah' => $isitungkaiBawah,
                    'jariKaki' => $isijariKaki,
                    'kukuKaki' => $isikukuKaki,
                    'persendianKaki' => $isipersendianKaki,
                    'createdBy' => $this->request->getVar('createdBy'),
                    'createddate' => $this->request->getVar('createddate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'keluhanUtama' => $keluhanUTama,
                    'objektive' => $objective,
                    'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                    'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                    'diagnosis' => $this->request->getVar('diagnosis'),
                    'diagnosisBanding' => $this->request->getVar('diagnosisBanding'),
                    'planning' => $planning,
                    'deskripsiKonsultasi' => $this->request->getVar('deskripsiKonsultasi'),
                    'tujuanKonsultasi' => $this->request->getVar('tujuanKonsultasi'),
                    'tindakLanjut' => $this->request->getVar('tindakLanjut'),
                    'konsulen' => $this->request->getVar('konsulen'),
                    'file_audio' => $nameFile,
                ];

                $perawat = new ModelPelayananPoliRMEMedis;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function cariTemplateRME()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('referencenumber');
            $askep = new ModelPelayananPoliRME();
            $pasien = $askep->get_data_pasien_rme($referencenumber);
            $namapoli = $pasien['poliklinikname'];

            $template = $askep->get_list_template_rme($namapoli);
            $data = [
                'list_askep' => $askep->get_data_pasien_rme($referencenumber),
                'template' => $template,

            ];

            $msg = [
                'sukses' => view('rme/modalpilihtemplaterme', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ReferensiRME()
    {
        $data = [
            'judul' => 'Templet SOAP RME',
        ];
        return view('rme/referensi_rme', $data);
    }

    public function ambildataRME()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelRME();
            $data = [
                'tampildata' => $register->ambildatarme()
            ];
            $msg = [
                'data' => view('rme/datareferensi_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CreateDiagnosaRME()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'namaform' => 'Create Diagnosa RME',

            ];
            $msg = [
                'data' => view('rme/modalcreate_diagnosa_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDataDiagnosaRME()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'createdBy' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum ada penulis',
                    ]
                ],
                'smf' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih smf',
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih keterangan',
                    ]
                ],
                'subjective' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih subjective',
                    ]
                ],
                'objective' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih objective',
                    ]
                ],
                'asesmen' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih asesmen',
                    ]
                ],
                'planning' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih planning',
                    ]
                ],
            ]);

            $simpandata = [
                'created_by' => $this->request->getVar('createdBy'),
                'smf' => $this->request->getVar('smf'),
                'keterangan' => $this->request->getVar('keterangan'),
                'subjective' => nl2br($this->request->getVar('subjective')),
                'objective' => nl2br($this->request->getVar('objective')),
                'asesmen' => nl2br($this->request->getVar('asesmen')),
                'planning' => $this->request->getVar('planning'),
            ];
            $datadiri = new ModelRME();
            $datadiri->insert_diagnosa($simpandata);
            $msg = [
                'sukses' => 'Data Diagnosa Telah Disimpan',

            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ViewRME()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pegawai = new ModelRME();
            $diagnosa = $pegawai->get_data_rme_detail($id);
            $data = [
                'id' => $diagnosa['id'],
                'smf' => $diagnosa['smf'],
                'keterangan' => $diagnosa['keterangan'],
                'subjective' => $diagnosa['subjective'],
                'objective' => $diagnosa['objective'],
                'asesmen' => $diagnosa['asesmen'],
                'planning' => $diagnosa['planning'],
            ];
            $msg = [
                'sukses' => view('rme/modalreferensi_rme', $data)
            ];
            return json_encode($msg);
        }
    }

    public function updateDataDiagnosaRME()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'createdBy' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum ada penulis',
                    ]
                ],
                'smf' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih smf',
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih keterangan',
                    ]
                ],
                'subjective' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih subjective',
                    ]
                ],
                'objective' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih objective',
                    ]
                ],
                'asesmen' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih asesmen',
                    ]
                ],
                'planning' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih planning',
                    ]
                ],
            ]);
            $datadiri = new ModelRME();
            $simpandata = [
                'created_by' => $this->request->getVar('createdBy'),
                'id' => $this->request->getVar('id'),
                'smf' => $this->request->getVar('smf'),
                'keterangan' => $this->request->getVar('keterangan'),
                'subjective' => nl2br($this->request->getVar('subjective')),
                'objective' => nl2br($this->request->getVar('objective')),
                'asesmen' => nl2br($this->request->getVar('asesmen')),
                'planning' => $this->request->getVar('planning'),
            ];

            $datadiri->update_diagnosa($simpandata);
            $msg = [
                'sukses' => 'Data Diagnosa Telah Disimpan',

            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function deleteDataDiagnosaRME()
    {

        if ($this->request->isAJAX()) {
            $data = new ModelRME();
            $id = $this->request->getVar('id');
            $data->delete_diagnosa($id);
            $msg = [
                'sukses' => 'Data Diagnosa Telah Dihapus',

            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderRADRajal()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'RAD';
            $namalokasi = 'RADIOLOGI';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='RAD' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IRJ';
            $classroomname = 'IRJ';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => $registernumber,
                'registernumber_rawatinap' => 'NONE',
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d G:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokLab(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderRADrme_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    private function kelompokLab()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_kelompok_rad();
        return $list;
    }

    public function caripaket()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $m_auto = new Model_autocomplete($request);
            $kelompokLab = $this->request->getVar('kelompokLab');
            $classroom = $this->request->getVar('classroom');

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $journalnumber = $this->request->getVar('id');
            //$row = $perawat->find($id);
            $row = $perawat->get_data_header_penunjang($journalnumber);
            $asal_lab = $this->request->getVar('asal_lab');
            $koinsiden = $this->request->getVar('koinsiden');
            if ($koinsiden == 1) {
                $koinsiden = 1;
            } else {
                $koinsiden = 0;
            }


            $jen_kel = $row['pasiengender'];
            if ($jen_kel == "L") {
                $jenkel = 1;
            } else {
                $jenkel = 0;
            }

            $tanggallahir = $row['pasiendateofbirth'];
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

            $umur = $age_years . " tahun " . $age_months . " bulan ";

            $data = [
                'tampildata' => $m_auto->get_list_pemeriksaan_RAD_paket($kelompokLab, $classroom),
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
                'registernumber_rawatinap' => $row['registernumber_rawatinap'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
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
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'asal_lab' => $asal_lab,
                'jenkel' => $jenkel,
                'usia' => $umur,
                'jns_rawat' => '1',
                'koinsiden' => $koinsiden,
            ];
            $msg = [
                'data' => view('rme/datapaketRAD', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanpemeriksaanPaket()
    {
        if ($this->request->isAJAX()) {
            $tandai = $this->request->getVar('tandai');
            if ($tandai <> null) {
                for ($i = 0; $i < count($tandai); $i++) {
                    $data = explode("|", $tandai[$i]);
                    $new_data[$i] = [
                        'types' => $data[0],
                        'journalnumber' => $data[1],
                        'documentdate' => $data[2],
                        'relation' => $data[3],
                        'relationname' => $data[4],
                        'paymentmethod' => $data[6],
                        'paymentmethodname' => $data[6],
                        'classroom' => $data[7],
                        'classroomname' => $data[8],
                        'room' => $data[9],
                        'roomname' => $data[10],
                        'smf' => $data[11],
                        'smfname' => $data[12],
                        'dokter' => $data[13],
                        'doktername' => $data[14],
                        'employee' => $data[15],
                        'employeename' => $data[16],
                        'registernumber' => $data[17],
                        'referencenumber' => $data[18],
                        'referencenumberparent' => $data[19],
                        'locationcode' => $data[20],
                        'code' => $data[21],
                        'name' => $data[22],
                        'qty' => $data[23],
                        'groups' => $data[24],
                        'groupname' => $data[25],
                        'category' => $data[26],
                        'categoryname' => $data[27],
                        'price' => $data[28],
                        'bhp' => $data[29],
                        'totaltarif' => $data[30],
                        'totalbhp' => $data[31],
                        'subtotal' => $data[32],
                        'share1' => $data[33],
                        'share2' => $data[34],
                        'memo' => $data[35],
                        'expertisegroup' => $data[36],
                        'createdby' => $data[37],
                        'createddate' => $data[38],
                        'kelompokLab' => $data[39],
                        'pasienaddress' => $data[40],
                        'asal_lab' => $data[41],
                        'pasiengender' => $data[42],
                        'pasiendateofbirth' => $data[43],
                        'usia' => $data[44],
                        'icdxname' => $data[45],
                        'jns_rawat' => $data[46],
                        'created_at' => $data[38],
                        'koinsiden' => $data[47],
                    ];
                }
                $radiologi = new ModelPenunjangDetail;
                $radiologi->insertBatch($new_data);
                $msg = [
                    'sukses' => "Pemeriksaan Sudah ditambahkan"
                ];
            } else {
                $msg = [
                    'gagal' => "Pemeriksaan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }

    public function orderLPKRajal()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'LPK';
            $namalokasi = 'LABORATORIUM PATOLOGI KLINIK';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='LPK' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);
            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];

            // $caripasien = $perawat->get_data_header_penunjang_baru($id);
            // $pasienid = $caripasien['pasienid'];
            // $cari_ssn = $perawat->get_data_nik($pasienid);
            // $ssn = $cari_ssn['ssn'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IRJ';
            $classroomname = 'IRJ';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';
            $cari_ssn = $perawat->get_data_nik($pasienid);


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => $registernumber,
                'registernumber_rawatinap' => 'NONE',
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d G:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,
                // 'ssn' => $ssn,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokLPK(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderLPKrme_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    public function caripaketLPK()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $m_auto = new Model_autocomplete($request);
            $kelompokLab = $this->request->getVar('kelompokLab');
            $classroom = $this->request->getVar('classroom');

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $journalnumber = $this->request->getVar('id');
            //$row = $perawat->find($id);
            $row = $perawat->get_data_header_penunjang($journalnumber);
            $asal_lab = $this->request->getVar('asal_lab');
            $koinsiden = $this->request->getVar('koinsiden');
            if ($koinsiden == 1) {
                $koinsiden = 1;
            } else {
                $koinsiden = 0;
            }


            $jen_kel = $row['pasiengender'];
            if ($jen_kel == "L") {
                $jenkel = 1;
            } else {
                $jenkel = 0;
            }

            $tanggallahir = $row['pasiendateofbirth'];
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

            $umur = $age_years . " tahun " . $age_months . " bulan ";

            $data = [
                'tampildata' => $m_auto->get_list_pemeriksaan_LPK_paket($kelompokLab, $classroom),
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
                'registernumber_rawatinap' => $row['registernumber_rawatinap'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
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
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'asal_lab' => $asal_lab,
                'jenkel' => $jenkel,
                'usia' => $umur,
                'jns_rawat' => '1',
                'koinsiden' => $koinsiden,
            ];
            $msg = [
                'data' => view('rme/datapaketLPK', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    private function kelompokLPK()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_kelompok_lab();
        return $list;
    }

    public function orderLPARajal()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'LPA';
            $namalokasi = 'LABORATORIUM PATOLOGI ANATOMI';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='LPA' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IRJ';
            $classroomname = 'IRJ';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => $registernumber,
                'registernumber_rawatinap' => 'NONE',
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d G:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokLPA(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderLPArme_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    private function kelompokLPA()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_kelompok_lab_pa();
        return $list;
    }

    public function caripaketLPA()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $m_auto = new Model_autocomplete($request);
            $kelompokLab = $this->request->getVar('kelompokLab');
            $classroom = $this->request->getVar('classroom');

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $journalnumber = $this->request->getVar('id');
            //$row = $perawat->find($id);
            $row = $perawat->get_data_header_penunjang($journalnumber);
            $asal_lab = $this->request->getVar('asal_lab');
            $koinsiden = $this->request->getVar('koinsiden');
            if ($koinsiden == 1) {
                $koinsiden = 1;
            } else {
                $koinsiden = 0;
            }


            $jen_kel = $row['pasiengender'];
            if ($jen_kel == "L") {
                $jenkel = 1;
            } else {
                $jenkel = 0;
            }

            $tanggallahir = $row['pasiendateofbirth'];
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

            $umur = $age_years . " tahun " . $age_months . " bulan ";

            $data = [
                'tampildata' => $m_auto->get_list_pemeriksaan_LPA_paket($kelompokLab, $classroom),
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
                'registernumber_rawatinap' => $row['registernumber_rawatinap'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
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
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'asal_lab' => $asal_lab,
                'jenkel' => $jenkel,
                'usia' => $umur,
                'jns_rawat' => '1',
                'koinsiden' => $koinsiden,
            ];
            $msg = [
                'data' => view('rme/datapaketLPA', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderRHMRajal()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'RHM';
            $namalokasi = 'REHABILITASI MEDIS';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='RHM' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IRJ';
            $classroomname = 'IRJ';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => $registernumber,
                'registernumber_rawatinap' => 'NONE',
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d G:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokRHM(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderRHMrme_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    private function kelompokRHM()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_kelompok_rhm();
        return $list;
    }

    public function caripaketRHM()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $m_auto = new Model_autocomplete($request);
            $kelompokLab = $this->request->getVar('kelompokLab');
            $classroom = $this->request->getVar('classroom');

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $journalnumber = $this->request->getVar('id');
            //$row = $perawat->find($id);
            $row = $perawat->get_data_header_penunjang($journalnumber);
            $asal_lab = $this->request->getVar('asal_lab');
            $koinsiden = $this->request->getVar('koinsiden');
            if ($koinsiden == 1) {
                $koinsiden = 1;
            } else {
                $koinsiden = 0;
            }


            $jen_kel = $row['pasiengender'];
            if ($jen_kel == "L") {
                $jenkel = 1;
            } else {
                $jenkel = 0;
            }

            $tanggallahir = $row['pasiendateofbirth'];
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

            $umur = $age_years . " tahun " . $age_months . " bulan ";

            $data = [
                'tampildata' => $m_auto->get_list_pemeriksaan_RHM_paket($kelompokLab, $classroom),
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
                'registernumber_rawatinap' => $row['registernumber_rawatinap'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
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
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'asal_lab' => $asal_lab,
                'jenkel' => $jenkel,
                'usia' => $umur,
                'jns_rawat' => '1',
                'koinsiden' => $koinsiden,
            ];
            $msg = [
                'data' => view('rme/datapaketRHM', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeOrderPenunjangRajal()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modalresumeorder_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    public function resumeOrderPenunjang()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $resume->get_list_resume_penunjang($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_penunjang', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderTNORajal()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IRJ";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);



            $lokasi = $row['poliklinik'];
            $documentdate = $row['documentdate'];

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
            }

            $today = date('ymd', strtotime($documentdate));
            $underscore = '_';

            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');

            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);


            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $oldcode = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IRJ';
            $classroomname = 'IRJ';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';
            $bpjs_sep = $row['bpjs_sep'];
            $poliklinik = $row['poliklinik'];
            $poliklinikname = $row['poliklinikname'];
            $employee = 'NONE';
            $namapoli = $row['poliklinikname'];


            $simpandata = [

                'groups' => $groups,
                'journalnumber' => $newkode,
                'documentdate' => $documentdate,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'bpjs_sep' => $bpjs_sep,
                'noantrian' => $nourut,
                'pasienid' => $pasienid,
                'oldcode' => $oldcode,
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'paymentcardnumber' => $paymentcardnumber,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'smf' => $smf,
                'employee' => $employee,
                'dokter' => $dokter,
                'doktername' => $doktername,

                'locationcode' => $poliklinik,
                'locationname' => $poliklinikname,
                'createdby' => session()->get('firstname'),
                'createddate' => date('Y-m-d G:i:s'),


            ];
            $perawat = new ModelTNOHeaderRajal;
            $perawat->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'pasienid' => $pasienid,
                'pasienname' => $pasienname,
                'paymentmethodname' => $paymentmethodname,
                'paymentmethod' => $paymentmethod,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'referencenumber' => $referencenumber,
                'paramedic' => $this->data_paramedic2($namapoli),
                'documentdate' => $documentdate,
                'list_dokter' => $this->_data_dokter_all()

            ];
            $msg = [
                'sukses' => view('rme/modalinputTNOrajal_rme', $data)
            ];
            return json_encode($msg);
        }
    }

    private function data_paramedic2($namapoli)
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_paramedic($namapoli);
        return $list;
    }



    public function simpanTNORajalDetail()
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

                $data_dokter = explode('|', $this->request->getVar('dokter'));

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
                    'dokter' => $data_dokter[0],
                    'doktername' => $data_dokter[1],
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
                    'createdby' => session()->get('firstname'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'pelaksana' => $pelaksana,
                    'paramedicName' => $this->request->getVar('paramedicName')

                ];
                $tno = new ModelTNODetailRJ;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Berhasil Ditambahkan'
                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CPPTPerawat()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_cppt_perawat($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_cppt_perawat', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeTNOMedisRajal()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetailRJ();

            $referencenumber = $this->request->getVar('referencenumber');
            $row = $perawat->search_rajal($referencenumber);
            $data = [
                'tampildata' => $perawat->search($referencenumber),
            ];
            $msg = [
                'data' => view('rme/data_resume_TNO_rajal_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CPPTMedis()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_cppt_medis($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_cppt_medis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CPPTMedistambah()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_cppt_medis($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_cppt_medistambah', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function riwayatCPPT()
    {
        if ($this->request->isAJAX()) {
            $pasienid = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'pasienid' => $pasienid,
            ];

            $msg = [
                'sukses' => view('rme/modalresume_cppt', $data)
            ];
            return json_encode($msg);
        }
    }

    public function riwayatCPPTtambah()
    {
        if ($this->request->isAJAX()) {
            $pasienid = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'pasienid' => $pasienid,
            ];

            $msg = [
                'sukses' => view('rme/modalresume_cppttambah', $data)
            ];
            return json_encode($msg);
        }
    }


    public function resumeCPPTPasien()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $pasienid = $this->request->getVar('pasienid');
            $data = [
                'tampildata' => $resume->get_cppt_medis_pasien($pasienid)
            ];
            $msg = [
                'data' => view('rme/riwayat_data_resume_cppt_medis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeCPPTPasientambah()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $pasienid = $this->request->getVar('pasienid');
            $data = [
                'tampildata' => $resume->get_cppt_medis_pasien($pasienid)
            ];
            $msg = [
                'data' => view('rme/riwayat_data_resume_cppt_medistambah', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailCPPT()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_cppt_id($id);
            return json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailCPPTtambah()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_cppt_id($id);
            return json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function riwayatPelayananMedis()
    {
        if ($this->request->isAJAX()) {
            $pasienid = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'pasienid' => $pasienid,
            ];

            $msg = [
                'sukses' => view('rme/modalriwayatpelayananmedis', $data)
            ];
            return json_encode($msg);
        }
    }

    public function resumePelayananPasien()
    {
        if ($this->request->isAJAX()) {

            $pasienid = $this->request->getVar('pasienid');
            $register = new ModelPelayananPoliRME();
            $master = $register->search_RiwayatPasien($pasienid);


            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
            }


            foreach ($master as $index => $row) {
                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['poliklinikname'] = $row['poliklinikname'];


                $detailTindakan = $register->search_tindakan_detail($id);

                $pem[$index]['list'] = [];
                foreach ($detailTindakan as $item) {

                    if ($item['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['list'][] = $item;
                    }
                }

                $detailDiagnosa = $register->search_diagnosa_detail($id);
                $pem[$index]['listDiagnosa'] = [];
                foreach ($detailDiagnosa as $itemDiagnosa) {

                    if ($itemDiagnosa['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listDiagnosa'][] = $itemDiagnosa;
                    }
                }

                $detailRadiologi = $register->search_rad_detail($id);
                $pem[$index]['listRad'] = [];
                foreach ($detailRadiologi as $itemRadiologi) {

                    if ($itemRadiologi['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listRad'][] = $itemRadiologi;
                    }
                }

                $detailLPK = $register->search_lpk_detail($id);
                $pem[$index]['listLpk'] = [];
                foreach ($detailLPK as $itemLPK) {

                    if ($itemLPK['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listLpk'][] = $itemLPK;
                    }
                }

                $detailLPA = $register->search_lpa_detail($id);
                $pem[$index]['listLpa'] = [];
                foreach ($detailLPA as $itemLPA) {

                    if ($itemLPA['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listLpa'][] = $itemLPA;
                    }
                }

                $detailResep = $register->search_resep_detail($id);
                $pem[$index]['listResep'] = [];
                foreach ($detailResep as $itemResep) {

                    if ($itemResep['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listResep'][] = $itemResep;
                    }
                }
            }

            $data = [
                'tampildata' => $pem,
            ];





            $msg = [
                'data' => view('rme/riwayat_data_pelayanan_medis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeHasilRad()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $expertise = $perawat->get_data_expertise_rad($id);
            $data = [
                'expertise' => $expertise['expertise']
            ];

            $msg = [
                'sukses' => view('rme/modalexpertiseradiologi_hasil', $data)
            ];
            return json_encode($msg);
        }
    }

    public function resumeHasilLpk()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'expertiseLPK' => $perawat->get_data_expertise_lpk($id),
            ];

            $msg = [
                'sukses' => view('rme/modalexpertiselpk_hasil', $data)
            ];
            return json_encode($msg);
        }
    }

    public function riwayatCPPTPerawat()
    {
        if ($this->request->isAJAX()) {
            $pasienid = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'pasienid' => $pasienid,
            ];

            $msg = [
                'sukses' => view('rme/modalresume_cppt_perawat', $data)
            ];
            return json_encode($msg);
        }
    }

    public function resumeCPPTPasienPerawat()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $pasienid = $this->request->getVar('pasienid');
            $data = [
                'tampildata' => $resume->get_cppt_perawat_pasien($pasienid)
            ];
            $msg = [
                'data' => view('rme/riwayat_data_resume_cppt_perawat', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailCPPTPerawat()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_cppt_id_perawat($id);
            return json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function riwayatCPPTPerawatVerifikasi()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'noKunjungan' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modalresume_cppt_perawat_verifikasi', $data)
            ];
            return json_encode($msg);
        }
    }

    public function CPPTPerawatVerifikasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('noKunjungan');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_cppt_perawat($referencenumber)
            ];

            $msg = [
                'data' => view('rme/data_resume_cppt_perawat_verifikasi', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiCPPTPerawatSelesai()
    {
        if ($this->request->isAJAX()) {

            $verifikasiDPJP = 1;
            $tanggalJamVerifikasi = date('Y-m-d G:i:s');
            $verifikator = session()->get('firstname');
            $simpandata = [
                'verifikasiDPJP' => $verifikasiDPJP,
                'tanggalJamVerifikasi' => $tanggalJamVerifikasi,
                'verifikator' => $verifikator,

            ];
            $perawat = new ModelPelayananPoliRME;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Selesai'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function BatalkanVerifikasiCPPTPerawat()
    {
        if ($this->request->isAJAX()) {

            $verifikasiDPJP = 0;
            $tanggalJamVerifikasi = '';
            $verifikator = '';
            $simpandata = [
                'verifikasiDPJP' => $verifikasiDPJP,
                'tanggalJamVerifikasi' => $tanggalJamVerifikasi,
                'verifikator' => $verifikator,

            ];
            $perawat = new ModelPelayananPoliRME;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Selesai'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderEresepRajal()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('id');
            $cekregister = new ModelPelayananPoliRME;
            $groups = 'RJ';
            $hasilcek = $cekregister->get_data_cek_farmasi_rme($referencenumber, $groups);
            $cekdulu = isset($hasilcek['pasienid']) != null ? $hasilcek['pasienid'] : "";

            if ($cekdulu == "") {

                $groups = "IRJ";
                $db = db_connect();
                $locationcode = 'DEPORAJAL';
                $locationname = 'DEPO RAWAT JALAN';

                $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header  ORDER BY id desc LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                $underscore = '_';
                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }


                $perawat = new ModelPelayananPoliRME();
                $row = $perawat->get_data_pasien_rme($referencenumber);


                $tanda = 'RRJ';
                $documentdate = date('Y-m-d');
                $today = date('ymd', strtotime($documentdate));
                $pasienid = $row['pasienid'];
                $tahun = date('Y');
                $bulan = date('m');

                $newkode = $tanda . $underscore . $pasienid . $underscore . $locationcode . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $no_antrian = sprintf($nourutantrian);

                $documentdate = $documentdate;
                $karyawan = '';
                $dispensasi = '';
                $pasienid = $pasienid;
                $pasienname = $row['pasienname'];
                $paymentmethod = $row['paymentmethod'];
                $paymentmethodname = $row['paymentmethodname'];
                $poliklinik = $row['poliklinik'];
                $poliklinikname = $row['poliklinikname'];
                $poliklinikclass = '';
                $dokter = $row['dokter'];
                $doktername = $row['doktername'];
                $employee = 'NONE';
                $employeename = '';
                $tandamemo = '/';
                $memo = $doktername . $tandamemo . $paymentmethod;
                $locationname = $locationname;
                $ranap = 1;
                $pasiendateofbirth = $row['pasiendateofbirth'];
                $tanggallahir = $pasiendateofbirth;
                $dob = strtotime($tanggallahir);
                $current_time = time();
                $age_years = date('Y', $current_time) - date('Y', $dob);
                $age_months = date('m', $current_time) - date('m', $dob);
                $age_days = date('d', $current_time) - date('d', $dob);

                $bpjs_sep = $row['bpjs_sep'];
                $pasienaddress = $row['pasienaddress'];
                $pasiengender = $row['pasiengender'];
                $pasienarea = $row['pasienarea'];
                $pasiensubarea = $row['pasiensubarea'];
                $pasiensubareaname = $row['pasiensubareaname'];
                $paymentcardnumber = $row['paymentcardnumber'];
                $paymentmethodori = $row['paymentmethodori'];
                $paymentmethodnameori = $row['paymentmethodnameori'];
                $paymentmethodnameori = $row['paymentmethodnameori'];
                $smf = $row['smf'];
                $smfname = $row['smfname'];

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
                $groups = "RJ";



                $lokasi = $row['poliklinik'];
                $documentdate = $row['documentdate'];

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                $today = date('ymd', strtotime($documentdate));
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }


                $simpandata = [
                    'isenaranap' => $ranap,
                    'groups' => $groups,
                    'journalnumber' => $newkode,
                    'documentdate' => $documentdate,
                    'documentyear' => $tahun,
                    'documentmonth' => $bulan,
                    'noreg' => $referencenumber,
                    'referencenumber' => $referencenumber,
                    'bpjs_sep' => $bpjs_sep,
                    'pasienid' => $pasienid,
                    'oldcode' => '',
                    'pasienname' => $pasienname,
                    'pasiengender' => $pasiengender,
                    'dateofbirth' => $tanggallahir,
                    'pasienage' => $umur,
                    'pasienaddress' => $pasienaddress,
                    'pasienarea' => $pasienarea,
                    'pasiensubarea' => $pasiensubarea,
                    'pasiensubareaname' => $pasiensubareaname,
                    'karyawan' => $karyawan,
                    'dispensasi' => $dispensasi,
                    'dispensasipejabat' => '',
                    'dispensasialasan' => '',
                    'paymentmethod' => $paymentmethod,
                    'paymentmethodname' => $paymentmethodname,
                    'paymentcardnumber' => $paymentcardnumber,
                    'paymentmethodori' => $paymentmethodori,
                    'paymentmethodnameori' => $paymentmethodnameori,
                    'paymentcardnumberori' => '',
                    'smf' => $smf,
                    'smfname' => $smfname,
                    'poliklinik' => $poliklinik,
                    'poliklinikname' => $poliklinikname,
                    'poliklinikclass' => $poliklinikclass,
                    'poliklinikclassname' => '',
                    'bednumber' => '',
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'employee' => $employee,
                    'employeename' => $employeename,
                    'locationcode' => $locationcode,
                    'locationname' => $locationname,
                    'numberseq' => $no_antrian,
                    'createdby' => session()->get('firstname'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'eresep' => 1,
                ];


                $perawat = new ModelFarmasiPelayananHeader();
                $perawat->insert($simpandata);
                $resume = new ModelTerimaPBFDetail();
                $data = [
                    'journalnumber' => $newkode,
                    'documentdate' => $documentdate,
                    'karyawan' => $karyawan,
                    'dispensasi' => $dispensasi,
                    'relation' => $pasienid,
                    'relationname' => $pasienname,
                    'paymentmethod' => $paymentmethod,
                    'paymentmethodname' => $paymentmethodname,
                    'poliklinik' => $poliklinik,
                    'poliklinikname' => $poliklinikname,
                    'poliklinikclass' => $poliklinikclass,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'employee' => $employee,
                    'employeename' => $employeename,
                    'referencenumber' => $memo,
                    'locationcode' => $locationcode,
                    'locationname' => $locationname,
                    'racikan' => $this->racikan_rme(),
                    'itemracikan' => $this->itemracikan(),
                    'aturanpakai' => $resume->aturan_pakai(),
                    'carapakai' => $resume->cara_pakai(),
                    'carapetunjuk' => $resume->cara_petunjuk(),

                ];
            } else {

                $perawat = new ModelPelayananPoliRME();
                $row = $perawat->get_data_pasien_rme($referencenumber);


                $tanda = 'RRJ';
                $documentdate = date('Y-m-d');
                $today = date('ymd', strtotime($documentdate));
                $pasienid = $row['pasienid'];
                $tahun = date('Y');
                $bulan = date('m');
                $locationcode = 'DEPORAJAL';
                $locationname = 'DEPO RAWAT JALAN';


                $documentdate = $documentdate;
                $karyawan = '';
                $dispensasi = '';
                $pasienid = $pasienid;
                $pasienname = $row['pasienname'];
                $paymentmethod = $row['paymentmethod'];
                $paymentmethodname = $row['paymentmethodname'];
                $poliklinik = $row['poliklinik'];
                $poliklinikname = $row['poliklinikname'];
                $poliklinikclass = '';
                $dokter = $row['dokter'];
                $doktername = $row['doktername'];
                $employee = 'NONE';
                $employeename = '';
                $tandamemo = '/';
                $memo = $doktername . $tandamemo . $paymentmethod;
                $locationname = $locationname;
                $ranap = 1;
                $pasiendateofbirth = $row['pasiendateofbirth'];
                $tanggallahir = $pasiendateofbirth;
                $dob = strtotime($tanggallahir);
                $current_time = time();
                $age_years = date('Y', $current_time) - date('Y', $dob);
                $age_months = date('m', $current_time) - date('m', $dob);
                $age_days = date('d', $current_time) - date('d', $dob);

                $bpjs_sep = $row['bpjs_sep'];
                $pasienaddress = $row['pasienaddress'];
                $pasiengender = $row['pasiengender'];
                $pasienarea = $row['pasienarea'];
                $pasiensubarea = $row['pasiensubarea'];
                $pasiensubareaname = $row['pasiensubareaname'];
                $paymentcardnumber = $row['paymentcardnumber'];
                $paymentmethodori = $row['paymentmethodori'];
                $paymentmethodnameori = $row['paymentmethodnameori'];
                $paymentmethodnameori = $row['paymentmethodnameori'];
                $smf = $row['smf'];
                $smfname = $row['smfname'];

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
                $groups = "RJ";
                $resume = new ModelTerimaPBFDetail();
                $data = [
                    'journalnumber' => $hasilcek['journalnumber'],
                    'documentdate' => $hasilcek['documentdate'],
                    'karyawan' => $hasilcek['karyawan'],
                    'dispensasi' => $hasilcek['dispensasi'],
                    'relation' => $hasilcek['pasienid'],
                    'relationname' => $hasilcek['pasienname'],
                    'paymentmethod' => $hasilcek['paymentmethod'],
                    'paymentmethodname' => $hasilcek['paymentmethodname'],
                    'poliklinik' => $hasilcek['poliklinik'],
                    'poliklinikname' => $hasilcek['poliklinikname'],
                    'poliklinikclass' => $hasilcek['poliklinikclass'],
                    'dokter' => $hasilcek['dokter'],
                    'doktername' => $hasilcek['doktername'],
                    'employee' => $hasilcek['employee'],
                    'employeename' => $hasilcek['employeename'],
                    'referencenumber' => $referencenumber,
                    'locationcode' => $locationcode,
                    'locationname' => $locationname,
                    'racikan' => $this->racikan_rme(),
                    'itemracikan' => $this->itemracikan(),
                    'aturanpakai' => $resume->aturan_pakai(),
                    'carapakai' => $resume->cara_pakai(),
                    'carapetunjuk' => $resume->cara_petunjuk(),

                ];
            }
            $msg = [
                'sukses' => view('rme/modalinputeresepRajal_rme', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpandataeresep_detail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Obat',
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
                $jumlah = $this->request->getVar('qtyresep');
                $jumlahstock = $this->request->getVar('qtystock');
                $qty = -1 * $jumlah;
                $qtypaket = ABS($qty);

                $subtotal = $price * $qty;

                $code = $this->request->getVar('code');
                $m_icd = new ModelMasterObat();
                $sm = $m_icd->get_minstock_obat($code);
                $stockminimal = $sm['minstock'];

                $beli = $jumlahstock - $jumlah;

                if ($jumlah > $jumlahstock) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Jumlah Dilayani Tidak Boleh Lebih Besar Daripada Jumlah Stock Saat ini'

                    ];
                } else if ($beli < $stockminimal) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Jumlah Dilayani Tidak Boleh Lebih Besar Daripada Jumlah Stock Minimal [' . $stockminimal . ']',

                    ];
                } else {
                    $dosisfull = $this->request->getVar('signa1');
                    $dosis_exp = explode("X", $dosisfull);


                    $signa1 = $dosis_exp[0];
                    $signa2 = $dosis_exp[1];

                    $simpandata = [

                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'documentdate' => $this->request->getVar('documentdate_detail'),
                        'karyawan' => $this->request->getVar('karyawan_detail'),
                        'dispensasi' => $this->request->getVar('dispensasi_detail'),
                        'relation' => $this->request->getVar('relation'),
                        'relationname' => $this->request->getVar('relationname'),
                        'paymentmethod' => $this->request->getVar('paymentmethod_detail'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname_detail'),
                        'poliklinik' => $this->request->getVar('poliklinik_detail'),
                        'poliklinikname' => $this->request->getVar('poliklinikname_detail'),
                        'poliklinikclass' => $this->request->getVar('poliklinikclass_detail'),
                        'dokter' => $this->request->getVar('dokter_detail'),
                        'doktername' => $this->request->getVar('doktername_detail'),
                        'employee' => $this->request->getVar('employee_detail'),
                        'employeename' => $this->request->getVar('employeename_detail'),
                        'referencenumber' => $this->request->getVar('referencenumber_detail'),
                        'locationcode' => $this->request->getVar('locationcode_detail'),
                        'locationname' => $this->request->getVar('locationname_detail'),
                        'racikan' => $this->request->getVar('racikan'),
                        'r' => $this->request->getVar('koderacikan'),
                        'koderacikan' => $this->request->getVar('koderacikan'),
                        'jumlahracikan' => $this->request->getVar('jumlahracikan'),
                        'code' => $this->request->getVar('code'),
                        'name' => $this->request->getVar('name'),
                        'batchnumber' => $this->request->getVar('batchnumber'),
                        'expireddate' => $this->request->getVar('expireddate'),
                        'qty' => $qty,
                        'uom' => $this->request->getVar('uom'),
                        'signa1' => $signa1,
                        'signa2' => $signa2,
                        'emptydate' => date('Y-m-d', strtotime('+3 day')),
                        'price' => $this->request->getVar('price'),
                        'subtotal' => $subtotal,
                        'createdby' => session()->get('firstname'),
                        'createddate' => date('Y-m-d G:i:s'),
                        'qtypaket' => $qtypaket,
                        'qtyluarpaket' => 0,
                        'eticket_aturan' => $this->request->getVar('aturanpakai'),
                        'eticket_carapakai' => $this->request->getVar('carapakai'),
                        'eticket_petunjuk' => '',
                        'terapiPulang' => $this->request->getVar('terapiPulang'),

                    ];
                    $perawat = new ModelFarmasiPelayananDetail;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Detail Obat telah disimpan'
                    ];
                }
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function racikan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_racikan();
        return $list;
    }

    public function racikan_rme()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_racikan_rme();
        return $list;
    }




    public function itemracikan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_item_racikan();
        return $list;
    }

    public function ajax_cari_obat()
    {
        $request = Services::request();
        $m_auto = new ModelPelayananPoliRME();

        $key = $request->getGet('term');
        $locationcode = $this->request->getVar('locationcode');

        $data = $m_auto->get_list_obat_rme($key, $locationcode);

        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'],
                'code' => $row['code'],
                'name' => $row['name'],
                'salesprice' => $row['salesprice'],
                'uom' => $row['uom'],
                'balance' => $row['balance'],
                'expireddate' => $row['expireddate'],
                'batchnumber' => $row['batchnumber'],


            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function detaileResep()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $headerpelayanan = $resume->search_header_pelayanan($journalnumber);
            $data = [
                'DetailObat' => $resume->search_detail_pelayanan($journalnumber),
                'kodejournal' => $journalnumber,
                'validasilunas' => $headerpelayanan['validasilunas'],
                'luarpaketinacbg' => $headerpelayanan['luarpaketinacbg'],
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
                'referencenumber' => $headerpelayanan['referencenumber'],

            ];
            $msg = [
                'data' => view('rme/detail_eReseprajal', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function IGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_igd_rme', $data);
    }

    public function ambildataIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataigdrme()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_igd_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterIgdrme($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_igd_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMETriage()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_poli($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' Triase IGD',

            ];

            $catat = new Modellogactivity;
            $catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['journalnumber'],
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_rajal'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
                'nomorreferensi' => $row['journalnumber'],
            ];
            $msg = [
                'sukses' => view('rme/modal_triase', $data)
            ];
            return json_encode($msg);
        }
    }

    public function AsesmenTriageIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $file = 'rme/asesmen_triage_igd';
            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'mobil' => $this->mobil(),
                'airway' => $this->airway(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'list' => $this->_data_dokter_all(),

            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function mobil()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_mobil();
        return $list;
    }

    public function airway()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_airway();
        return $list;
    }
    public function breathing()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_breathing();
        return $list;
    }

    public function circulation()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_circulation();
        return $list;
    }
    public function eye()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_eye();
        return $list;
    }
    public function verbal()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_verbal();
        return $list;
    }
    public function motorik()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_motorik();
        return $list;
    }

    public function simpanTriaseIGD()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'paramedicName' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'paramedicName' => $validation->getError('paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_triase_igd_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IGD-TRIAGE-RME';
                $groups = 'IGD';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $airway = $this->request->getVar('airway');
                $breathing = $this->request->getVar('breathing');
                $circulation = $this->request->getVar('circulation');
                $skor_gcs = $this->request->getVar('gcs');


                if (($airway == "Sumbatan") and ($breathing == "Henti Nafas") and ($circulation == "Henti Jantung") and ($skor_gcs < 9)) {
                    $hasilTriase = "Merah";
                } else if (($airway == "Stridor/ Distress Nafas") and (($breathing == "Tachipneu") or ($breathing == "Bradipneu")) and (($circulation == "Nadi Lemah") or ($circulation == "Takikardi"))  and ($skor_gcs < 12)) {
                    $hasilTriase = "Kuning";
                } else if (($airway == "Bebas") and ($breathing == "Nafas Normal")  and ($circulation == "Nadi Normal")  and ($skor_gcs > 12)) {
                    $hasilTriase = "Hijau";
                } else {
                    $hasilTriase = "Tidak ada Kriteria";
                }


                $admissionDate = $this->request->getVar('admissionDate');
                $admissionDateTime = $this->request->getVar('admissionDateTime');

                $split = ' ';

                $tanggaljam = $admissionDate . $split . $admissionDateTime;


                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'admissionDateTime' => $tanggaljam,
                    'doktername' => $this->request->getVar('doktername'),
                    'bb' => $this->request->getVar('bb'),
                    'tb' => $this->request->getVar('tb'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'frekuensiNafas' => $this->request->getVar('frekuensiNafas'),
                    'spo2' => $this->request->getVar('spo2'),
                    'transportasi' => $this->request->getVar('transportasi'),
                    'airway' => $this->request->getVar('airway'),
                    'breathing' => $this->request->getVar('breathing'),
                    'circulation' => $this->request->getVar('circulation'),
                    'eye' => $this->request->getVar('eye'),
                    'motorik' => $this->request->getVar('motorik'),
                    'verbal' => $this->request->getVar('verbal'),
                    'totalGcs' => $this->request->getVar('gcs'),
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'kondisiPasien' => $this->request->getVar('kondisiPasien'),
                    'kelompokTriase' => $this->request->getVar('kelompokTriase'),
                    'paramedicName' => $this->request->getVar('paramedicName'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'createddate' => $this->request->getVar('createddate'),
                ];



                $perawat = new ModelPelayananPoliRMETRIAGE;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeTriage()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRMETRIAGE();
            $resume2 = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume2->get_cppt_perawat($referencenumber);

            $row = $resume2->get_data_pasien_poli_rme($referencenumber);
            $data = [
                'tampiltriase' => $resume->get_data_triase($referencenumber),
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'mobil' => $this->mobil(),
                'airway' => $this->airway(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'list' => $this->_data_dokter_all(),
            ];

            $msg = [
                'data' => view('rme/data_asesmen_triage_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function HapusTriase()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelPelayananPoliRMETRIAGE;
            $cek = $TNO->cek_triase($id);
            $nama_tindakan = $cek['registernumber'];
            $dokter = $cek['doktername'];
            $TNO->delete($id);

            $norm = $cek['relation'];
            $aktifitas = $nama_tindakan;
            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Hapus Triase   Pada pasien ' . $norm . '  Dengan Dokter : ' . $dokter,
                'pasienid' => $norm,
                'menu' => ' IGD [Hapus Triase IGD]',

            ];

            $catat = new Modellogactivity;
            $catat->insert($datalog_activity);

            $msg = [
                'sukses' => "Data Triase dengan ID : $id Berhasil dihapus"
            ];

            return json_encode($msg);
        }
    }

    public function AsesmenPerawatIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_asesmen_igd_rme', $data);
    }

    public function ambildataAsesmenPerawatIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataigdrme()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_asesmen_igd_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterAsesmenPerawatIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterIgdrme($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_asesmen_igd_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriAsesmenPerawatIGD()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_poli($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' Triase IGD',

            ];

            $catat = new Modellogactivity;
            $catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['journalnumber'],
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_rajal'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
                'nomorreferensi' => $row['journalnumber'],
            ];
            $msg = [
                'sukses' => view('rme/modal_asesmen_perawat_igd', $data)
            ];
            return json_encode($msg);
        }
    }


    public function AsesmenAwalPerawatIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULU") {
                $file = 'rme/asesmen_awal_keperawatan_gigi';
            } else  if ($poliklinikname == "IGD PONEK") {
                $file = 'rme/asesmen_awal_keperawatan_ginekologi_igd';
            } else {
                $file = 'rme/asesmen_awal_keperawatan_igd';
            }


            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'] ?? null,
                'admissionDateTime' => $cek_triase['admissionDateTime'] ?? null,
                'bb' => $cek_triase['bb'] ?? null,
                'tb' => $cek_triase['tb'] ?? null,
                'suhu' => $cek_triase['suhu'] ?? null,
                'frekuensiNafas' => $cek_triase['frekuensiNafas'] ?? null,
                'frekuensiNadi' => $cek_triase['frekuensiNadi'] ?? null,
                'tdSistolik' => $cek_triase['tdSistolik'] ?? null,
                'tdDiastolik' => $cek_triase['tdDiastolik'] ?? null,
                'spo2' => $cek_triase['spo2'] ?? null,
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'] ?? null,
                'motorik_triase' => $cek_triase['motorik'] ?? null,
                'verbal_triase' => $cek_triase['verbal'] ?? null,
                'totalGcs' => $cek_triase['totalGcs'] ?? null,
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'KB' => $this->kb(),


            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function airway_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_airway_detail();
        return $list;
    }

    public function suaraNafas_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_suaraNafas_detail();
        return $list;
    }

    public function polaNafas_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_polaNafas_detail();
        return $list;
    }

    public function bunyiNafas_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_bunyiNafas_detail();
        return $list;
    }

    public function iramaNafas_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_iramaNafas_detail();
        return $list;
    }

    public function tandaDistressNafas_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_tandaDistressNafas_detail();
        return $list;
    }

    public function akral_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_akral_detail();
        return $list;
    }

    public function sianosis_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_sianosis_detail();
        return $list;
    }

    public function kapiler_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_kapiler_detail();
        return $list;
    }

    public function kelembapan_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_kelembapan_detail();
        return $list;
    }

    public function turgor_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_turgor_detail();
        return $list;
    }

    public function pupil_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_pupil_detail();
        return $list;
    }

    public function asesmen_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_asesmen_detail();
        return $list;
    }

    public function provokes_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_provokes_detail();
        return $list;
    }

    public function quality_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_quality_detail();
        return $list;
    }

    public function severity_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_severity_detail();
        return $list;
    }

    public function spiritual_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_spiritual_detail();
        return $list;
    }

    public function psikologis_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_psikologis_detail();
        return $list;
    }

    public function sosiologis_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_sosiologis_detail();
        return $list;
    }

    public function kb()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_kb();
        return $list;
    }

    public function turunbb_detail()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_turunbb_detail();
        return $list;
    }

    public function KodifikasiDiagnosa()
    {
        if ($this->request->isAJAX()) {


            $db = db_connect();
            $groups = "IRJ";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);
            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $oldcode = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IRJ';
            $classroomname = 'IRJ';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';
            $bpjs_sep = $row['bpjs_sep'];
            $poliklinik = $row['poliklinik'];
            $poliklinikname = $row['poliklinikname'];
            $employee = 'NONE';
            $namapoli = $row['poliklinikname'];

            $lokasi = $row['poliklinik'];
            $documentdate = date('Y-m-d');
            $kata = "KDIRJ";

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian  FROM transaksi_rekammedik_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);

            if ($antrian == "") {
                $nourutantrian = '1';
            } else {
                $nourutantrian = (int)($antrian);
                $nourutantrian++;
            }
            $no_antrian = sprintf($nourutantrian);

            $doktername = $this->request->getVar('doktername_TH');
            $dokter = $this->request->getVar('dokter_TH');

            $tanggallahir = $pasiendateofbirth;
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

            $cekregister = new ModelPelayananPoliRME;
            $groups = 'IRJ';
            $hasilcek = $cekregister->get_data_cek_coding($referencenumber);
            $cekdulu = isset($hasilcek['pasienid']) != null ? $hasilcek['pasienid'] : "";
            if ($cekdulu == "") {

                $simpandata = [
                    'groups' => $groups,
                    'journalnumber' => $newkode,
                    'documentdate' => $documentdate,
                    'documentyear' => date('Y'),
                    'documentmonth' => date('m'),
                    'referencenumber' => $referencenumber,
                    'referencenumber_rawatjalan' => $referencenumber,
                    'referencenumber_rawatinap' => 'NONE',
                    'bpjs_sep' => $bpjs_sep,
                    'noantrian' => $no_antrian,
                    'pasienid' => $pasienid,
                    'oldcode' => $oldcode,
                    'pasienname' => $pasienname,
                    'pasiengender' => $pasiengender,
                    'pasienage' => $umur,
                    'pasiendateofbirth' => $pasiendateofbirth,
                    'pasienaddress' => $pasienaddress,
                    'pasienarea' => $pasienarea,
                    'pasiensubarea' => $pasiensubarea,
                    'pasiensubareaname' => $pasiensubareaname,
                    'paymentmethod' => $paymentmethod,
                    'paymentmethodname' => $paymentmethodname,
                    'paymentcardnumber' => $paymentcardnumber,
                    'poliklinik' => $poliklinik,
                    'poliklinikname' => $poliklinikname,
                    'pasienclassroom' => $classroom,
                    'classroom' => $classroom,
                    'classroomname' => $classroomname,
                    'bednumber' => $poliklinik,
                    'smf' => $smf,
                    'smfname' => $smfname,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'locationcode' => 'RCM',
                    'locationname' => 'REKAM MEDIS',
                    'numberseq' => $no_antrian,
                    'createdby' => session()->get('firstname'),
                    'createddate' => date('Y-m-d G:i:s'),

                ];
                $perawat = new ModelRekMedHeader;
                $perawat->insert($simpandata);
                $data = [
                    'journalnumber_header' => $newkode,
                    'pasienid' => $pasienid,
                    'pasienname' => $pasienname,
                    'paymentmethodname' => $paymentmethodname,
                    'paymentmethod' => $paymentmethod,
                    'poliklinik' => $poliklinik,
                    'poliklinikname' => $poliklinikname,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'referencenumber' => $referencenumber,
                    'paramedic' => $this->data_paramedic2($namapoli),
                    'documentdate' => $documentdate,
                    'groups' => $groups,
                    'bpjs_sep' => $bpjs_sep,
                    'oldcode' => $oldcode,
                    'pasienid' => $pasienid,
                    'pasiengender' => $pasiengender,
                    'pasienaddress' => $pasienaddress,
                    'pasienarea' => $pasienarea,
                    'pasiensubarea' => $pasiensubarea,
                    'pasiensubareaname' => $pasiensubareaname,
                    'paymentcardnumber' => $paymentcardnumber,
                    'pasienclassroom' => $classroom,
                    'classroom' => $classroom,
                    'classroomname' => $classroomname,
                    'bednumber' => $poliklinik,
                    'smf' => $smf,
                    'smfname' => $smfname,
                    'locationcode' => 'RCM',
                    'locationname' => 'REKAM MEDIS',
                    'pasienaddress' => $pasienaddress,
                    'umur' => $umur,
                    'age_years' => $age_years,
                    'age_months' => $age_months,
                    'age_days' => $age_days,

                ];
            } else {

                $data = [
                    'journalnumber_header' => $hasilcek['journalnumber'],
                    'pasienid' => $pasienid,
                    'pasienname' => $pasienname,
                    'paymentmethodname' => $paymentmethodname,
                    'paymentmethod' => $paymentmethod,
                    'poliklinik' => $poliklinik,
                    'poliklinikname' => $poliklinikname,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'referencenumber' => $referencenumber,
                    'paramedic' => $this->data_paramedic2($namapoli),
                    'documentdate' => $documentdate,
                    'groups' => $groups,
                    'bpjs_sep' => $bpjs_sep,
                    'oldcode' => $oldcode,
                    'pasienid' => $pasienid,
                    'pasiengender' => $pasiengender,
                    'pasienaddress' => $pasienaddress,
                    'pasienarea' => $pasienarea,
                    'pasiensubarea' => $pasiensubarea,
                    'pasiensubareaname' => $pasiensubareaname,
                    'paymentcardnumber' => $paymentcardnumber,
                    'pasienclassroom' => $classroom,
                    'classroom' => $classroom,
                    'classroomname' => $classroomname,
                    'bednumber' => $poliklinik,
                    'smf' => $smf,
                    'smfname' => $smfname,
                    'locationcode' => 'RCM',
                    'locationname' => 'REKAM MEDIS',
                    'pasienaddress' => $pasienaddress,
                    'umur' => $umur,
                    'age_years' => $age_years,
                    'age_months' => $age_months,
                    'age_days' => $age_days,

                ];
            }
            $msg = [
                'sukses' => view('rme/modalinputDiagnosa_rme', $data)
            ];
            return json_encode($msg);
        }
    }


    public function riwayatPelayananResep()
    {
        if ($this->request->isAJAX()) {
            $pasienid = $this->request->getVar('id');
            $nomorKunjungan = $this->request->getVar('nomorreferensi');

            $perawat = new ModelPelayananPoliRME();
            $data = [
                'pasienid' => $pasienid,
                'nomorKunjungan' => $nomorKunjungan,
            ];

            $msg = [
                'sukses' => view('rme/modalriwayatpelayananresep', $data)
            ];
            return json_encode($msg);
        }
    }


    public function resumeRiwayatResep()
    {
        if ($this->request->isAJAX()) {

            $pasienid = $this->request->getVar('pasienid');
            $register = new ModelPelayananPoliRME();
            $master = $register->search_RiwayatPasien($pasienid);
            $nomorKunjungan = $this->request->getVar('nomorKunjungan');


            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
            }
            foreach ($master as $index => $row) {
                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['poliklinikname'] = $row['poliklinikname'];

                $detailResep = $register->search_resep_detail($id);
                $pem[$index]['listResep'] = [];
                foreach ($detailResep as $itemResep) {

                    if ($itemResep['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listResep'][] = $itemResep;
                    }
                }
            }

            $data = [
                'tampildata' => $pem,
                'nomorKunjungan' => $nomorKunjungan,
            ];

            $msg = [
                'data' => view('rme/riwayat_data_pelayanan_medis_resep', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function cariImplementasi()
    {
        if ($this->request->isAJAX()) {
            $diagnosa = $this->request->getVar('diagnosakeperawatan');
            $askep = new ModelPelayananPoliRME();
            $data = [
                'list_askep' => $askep->get_list_askep($diagnosa),

            ];
            $msg = [
                'sukses' => view('rme/modalpilihaskep_implementasi', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanpilihAskepImplementasi()
    {
        if ($this->request->isAJAX()) {
            $tandai = $this->request->getVar('tandai');
            if ($tandai <> null) {
                for ($i = 0; $i < count($tandai); $i++) {
                    $data = explode("|", $tandai[$i]);
                    $new_data[$i] = [
                        'implementasi' => $data[0],
                    ];
                }

                foreach ($new_data as $item) {
                    $data_rencana[] = $item;
                }


                $dataawal = json_encode($data_rencana);
                $data_rencana_fix = json_decode($dataawal, true);
                $data_rencana_fix = json_encode($data_rencana_fix);


                $arrayData = json_decode($data_rencana_fix, true);
                $jumlahBaris = count($arrayData);
                $joinedData = '';
                //foreach ($arrayData as $data) {
                foreach ($arrayData as $index => $data) {

                    $rencana = $data['implementasi'];
                    //$joinedData .= $rencana . "\n";
                    $joinedData .= ($index + 1) . '. ' . $rencana . "\n";
                    $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
                }



                $msg = [
                    'sukses' => "Implementasi Sudah Dipilih",
                    'rencana_implementasi' => $joinedData
                ];
            } else {
                $msg = [
                    'gagal' => "Rencana Keperawatan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }
    public function simpanpilihAskepMKeperawatan()
    {
        if ($this->request->isAJAX()) {
            $tandai = $this->request->getVar('tandai');
            if ($tandai <> null) {
                for ($i = 0; $i < count($tandai); $i++) {
                    $data = explode("|", $tandai[$i]);
                    $new_data[$i] = [
                        'Masalahkeperawatan' => $data[0],
                    ];
                }

                foreach ($new_data as $item) {
                    $data_rencana[] = $item;
                }


                $dataawal = json_encode($data_rencana);
                $data_rencana_fix = json_decode($dataawal, true);
                $data_rencana_fix = json_encode($data_rencana_fix);


                $arrayData = json_decode($data_rencana_fix, true);
                $jumlahBaris = count($arrayData);
                $joinedData = '';
                //foreach ($arrayData as $data) {
                foreach ($arrayData as $index => $data) {

                    $rencana = $data['Masalahkeperawatan'];
                    //$joinedData .= $rencana . "\n";
                    $joinedData .= ($index + 1) . '. ' . $rencana . "\n";
                    $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
                }



                $msg = [
                    'sukses' => "Implementasi Sudah Dipilih",
                    'rencana_implementasi' => $joinedData
                ];
            } else {
                $msg = [
                    'gagal' => "Rencana Keperawatan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }

    public function simpanAsesmenPerawatIGD()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'paramedicName' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'paramedicName' => $validation->getError('paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_perawatan_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IGD-RME';
                $groups = 'IGD';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;



                $Alergi = $this->request->getVar('Alergi');
                if ($Alergi == 1) {
                    $Alergi = 1;
                } else {
                    $Alergi = 0;
                }


                $uraianAlergi = $this->request->getVar('Alergi');



                $rujukAhliGizi = $this->request->getVar('rujukAhliGizi');
                if ($rujukAhliGizi == 1) {
                    $rujukAhliGizi = 1;
                } else {
                    $rujukAhliGizi = 0;
                }




                $caraBerjalan = $this->request->getVar('caraBerjalan');
                if ($caraBerjalan == 1) {
                    $caraBerjalan = 1;
                } else {
                    $caraBerjalan = 0;
                }

                $dudukMenopang = $this->request->getVar('dudukMenopang');
                if ($dudukMenopang == 1) {
                    $dudukMenopang = 1;
                } else {
                    $dudukMenopang = 0;
                }

                $fungsionalAlatBantu = $this->request->getVar('alatBantu');
                if ($fungsionalAlatBantu == 1) {
                    $fungsionalAlatBantu = 1;
                } else {
                    $fungsionalAlatBantu = 0;
                }

                $uraianAskep = nl2br($this->request->getVar('uraianAskep'));
                $tindakanEvaluasi = nl2br($this->request->getVar('tindakanEvaluasi'));



                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'anamnesis' => $this->request->getVar('anamnesis'),
                    'uraianAllo' => $this->request->getVar('uraianAllo'),
                    'bb' => $this->request->getVar('bb'),
                    'tb' => $this->request->getVar('tb'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'frekuensiNafas' => $this->request->getVar('frekuensiNafas'),
                    'spo2' => $this->request->getVar('spo2'),
                    'airway' => $this->request->getVar('airway'),
                    'suaraNafas' => $this->request->getVar('suaraNafas'),
                    'polaNafas' => $this->request->getVar('polaNafas'),
                    'bunyiNafas' => $this->request->getVar('bunyiNafas'),
                    'iramaNafas' => $this->request->getVar('iramaNafas'),
                    'distressPernafasan' => $this->request->getVar('tandaDistressNafas'),
                    'akral' => $this->request->getVar('akral'),
                    'sianosis' => $this->request->getVar('sianosis'),
                    'pengisianKapiler' => $this->request->getVar('pengisianKapiler'),
                    'kelembapanKulit' => $this->request->getVar('kelembapanKulit'),
                    'turgor' => $this->request->getVar('turgor'),
                    'eye' => $this->request->getVar('eye'),
                    'verbal' => $this->request->getVar('verbal'),
                    'motorik' => $this->request->getVar('motorik'),
                    'totalGcs' => $this->request->getVar('gcs'),
                    'keadaanUmum' => $this->request->getVar('keadaanUmum'),
                    'pupil' => $this->request->getVar('pupil'),
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'asesmenFungsional' => $this->request->getVar('asesmenFungsional'),
                    'caraBerjalan' => $caraBerjalan,
                    'dudukMenopang' => $dudukMenopang,
                    'fungsionalAlatBantu' => $fungsionalAlatBantu,
                    'skoringJatuh' => $this->request->getVar('skoringJatuh'),
                    'edema' => $this->request->getVar('edema'),
                    'daerahEdema' => $this->request->getVar('uraianEdema'),
                    'laserasi' => $this->request->getVar('laserasi'),
                    'daerahLaserasi' => $this->request->getVar('uraianLaserasi'),
                    'kondisiLain' => $this->request->getVar('kondisiLain'),
                    'skalaNyeri' => $this->request->getVar('skalaNyeri'),
                    'provokes' => $this->request->getVar('provokes'),
                    'quality' => $this->request->getVar('quality'),
                    'regio' => $this->request->getVar('regio'),
                    'severity' => $this->request->getVar('severity'),
                    'durasiNyeri' => $this->request->getVar('durasiNyeri'),
                    'spiritual' => $this->request->getVar('spiritual'),
                    'psikologis' => $this->request->getVar('psikologis'),
                    'sosiologis' => $this->request->getVar('sosiologis'),
                    'riwayatPenyakitSekarang' => $this->request->getVar('riwayatPenyakitSekarang'),
                    'riwayatPenyakitKeluarga' => $this->request->getVar('riwayatPenyakitKeluarga'),
                    'riwayatPenggunaanObat' => $this->request->getVar('riwayatPenggunaanObat'),
                    'nutrisiturunBbDewasa' => $this->request->getVar('penurunanBb'),
                    'asupanMakanDewasa' => $this->request->getVar('asupanMakanan'),
                    'psikologis' => $this->request->getVar('psikologis'),
                    'alergi' => $Alergi,
                    'uraianAlergi' => $uraianAlergi,
                    'nutrisiKurus' => $this->request->getVar('nutrisiKurus'),
                    'nutrisiTurunBb' => $this->request->getVar('turunBbAnak'),
                    'nutrisiKondisiKhusus' => $this->request->getVar('penyakitMalnutrisi'),
                    'nutrisiMuntahDiare' => $this->request->getVar('nutrisiMuntahDiare'),
                    'rujukAhliGizi' => $this->request->getVar('rujukAhliGizi'),
                    'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                    'uraianAskep' => $uraianAskep,
                    'sasaranRencana' => $this->request->getVar('sasaranRencana'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'paramedicName' => $this->request->getVar('paramedicName'),
                    'keluhanUtama' => $this->request->getVar('keluhanUtama'),
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'implementasiAskep' => $tindakanEvaluasi,
                    'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                    'keadaanPasien' => $this->request->getVar('keadaanPasien'),
                    'pupil' => $this->request->getVar('pupil'),
                    'riwayatPenyakitDahulu' => $this->request->getVar('riwayatPenyakitDahulu'),
                    'kondisiPasien' => $this->request->getVar('kondisiPasien'),


                ];

                $perawat = new ModelPelayananPoliRME;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function HasilAsesmenAwalPerawatRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_ranap_rme($referencenumber);
            $poliklinikname = $row['roomname'];

            $file = 'rme/hasil_asesmen_awal_keperawatan_ranap';

            $cek_triase = $resume->get_data_triase_rme($referencenumber);
            $cek_transfer = $resume->cek_hasil_transfer_rme_ranap($referencenumber);

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['referencenumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['roomname'],
                'admissionDate' => $row['datein'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => '',
                'admissionDateTime' => $row['datetimein'],
                'bb' => $cek_transfer['bbTiba'],
                'tb' => $cek_transfer['tbTiba'],
                'suhu' => $cek_transfer['suhuTiba'],
                'frekuensiNafas' => $cek_transfer['frekuensiNafasTiba'],
                'frekuensiNadi' => $cek_transfer['frekuensiNadiTiba'],
                'tdSistolik' => $cek_transfer['tdSistolikTiba'],
                'tdDiastolik' => $cek_transfer['tdDiastolikTiba'],
                'spo2' => $cek_transfer['spo2Tiba'],
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_transfer['eye'],
                'motorik_triase' => $cek_transfer['motorik'],
                'verbal_triase' => $cek_transfer['verbal'],
                'totalGcs' => $cek_transfer['totalGcs'],
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'alat_transport' => $cek_transfer['alat_transport'],
                'kasus_trauma' => $this->kasus_trauma(),
                'transport_transfer' => $this->transport(),
                'rpd' => $this->rpd(),
                'komplementari' => $this->komplementari(),
                'kepala' => $this->kepala(),
                'rambut' => $this->rambut(),
                'muka' => $this->muka(),
                'mata' => $this->mata(),
                'telinga' => $this->telinga(),
                'hidung' => $this->hidung(),
                'gigi' => $this->gigi(),
                'lidah' => $this->lidah(),
                'mulut' => $this->mulut(),
                'tenggorokan' => $this->tenggorokan(),
                'leher' => $this->leher(),
                'punggung' => $this->punggung(),
                'payudara' => $this->payudara(),
                'dada' => $this->dada(),
                'perut' => $this->perut(),
                'genital' => $this->genital(),
                'anus' => $this->anus(),
                'integumen' => $this->integumen(),
                'ektstremitas' => $this->ekstremitas(),
                'ginekologi' => $this->ginekologi(),
                'obstetri' => $this->obstetri(),
                'kebutuhan_edukasi' => $this->kebutuhan_edukasi(),
                'bahasa' => $this->bahasa(),
                'pendidikan' => $this->pendidikan(),
                'hambatan' => $this->hambatanEdukasi(),
                'penurunanBb' => $this->penurunanBb(),
                'alatBantuBerjalan' => $this->alatBantuBerjalan(),
                'mobilisasi' => $this->mobilisasi(),

                'tampilasesmen' => $resume->get_data_asesmen_perawat_ranap_rme($referencenumber),


            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function AsesmenAwalPerawatRanapMonitoring()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];
            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";


            $file = 'rme/asesmen_awal_keperawatan_ranap_monitoring';
            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'] ?? null,
                'admissionDateTime' => $cek_triase['admissionDateTime'] ?? null,
                'bb' => $cek_triase['bb'] ?? null,
                'tb' => $cek_triase['tb'] ?? null,
                'suhu' => $cek_triase['suhu'] ?? null,
                'frekuensiNafas' => $cek_triase['frekuensiNafas'] ?? null,
                'frekuensiNadi' => $cek_triase['frekuensiNadi'] ?? null,
                'tdSistolik' => $cek_triase['tdSistolik'] ?? null,
                'tdDiastolik' => $cek_triase['tdDiastolik'] ?? null,
                'spo2' => $cek_triase['spo2'] ?? null,
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'] ?? null,
                'motorik_triase' => $cek_triase['motorik'] ?? null,
                'verbal_triase' => $cek_triase['verbal'] ?? null,
                'totalGcs' => $cek_triase['totalGcs'] ?? null,
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'diagnosis' => $diagnosis,


            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function AsesmenAwalPerawatRanapHasilMonitoring()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_monitoring($referencenumber, "IRI")
            ];
            $msg = [
                'data' => view('rme/data_resume_monitoring_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    // public function ResumeAsesmenAwalPerawat()
    // {
    //     if ($this->request->isAJAX()) {

    //         $resume = new ModelPelayananPoliRME();
    //         $referencenumber = $this->request->getVar('referencenumber');
    //         $row = $resume->get_data_pasien_poli_rme($referencenumber);
    //         $poliklinikname = $row['poliklinikname'];

    //         if ($poliklinikname == "GIGI DAN MULUT1") {
    //             $file = 'rme/asesmen_awal_keperawatan_gigi';
    //         } else  if ($poliklinikname == "KEBIDANAN") {
    //             $file = 'rme/asesmen_awal_keperawatan_ginekologi';
    //         } else {
    //             $file = 'rme/hasil_asesmen_awal_keperawatan_umum';
    //         }

    //         $data = [
    //             'skala_nyeri' => $this->data_skala_nyeri(),
    //             'id' => $row['id'],
    //             'pasienid' => $row['pasienid'],
    //             'pasienname' => $row['pasienname'],
    //             'nomorreferensi' => $row['journalnumber'],
    //             'paymentmethodname' => $row['paymentmethodname'],
    //             'poliklinikname' => $row['poliklinikname'],
    //             'admissionDate' => $row['documentdate'],
    //             'doktername' => $row['doktername'],
    //             'hasil_bb' => $row['bb'],
    //             'kesadaran' => $this->data_kesadaran(),
    //             'diagnosa_perawat' => $this->data_diagnosa_perawat(),
    //             'spiritual' => $this->spiritual_detail(),
    //             'psikologis' => $this->psikologis_detail(),
    //             'sosiologis' => $this->sosiologis_detail(),
    //             'pendidikan' => $this->pendidikan(),
    //             'pekerjaan' => $this->pekerjaan(),
    //             'KB' => $this->kb(),
    //             'tampilasesmen' => $resume->get_data_asesmen_perawat_poli_rme($referencenumber),

    //         ];
    //         $msg = [
    //             'data' => view($file, $data)
    //         ];
    //         return json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }

    public function HasilAsesmenAwalPerawat()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULU") {
                $file = 'rme/asesmen_awal_keperawatan_gigi';
            } else  if ($poliklinikname == "KEBIDANAN DAN KANDUNGAN") {
                $file = 'rme/hasil_asesmen_awal_keperawatan_ginekologi';
            } else {
                $file = 'rme/hasil_asesmen_awal_keperawatan_umum';
            }

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'KB' => $this->kb(),
                'tampilasesmen' => $resume->get_data_asesmen_perawat_igd_rme($referencenumber),

            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function HasilAsesmenAwalPerawatIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            $file = 'rme/hasil_asesmen_awal_keperawatan_igd';

            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'],
                'admissionDateTime' => $cek_triase['admissionDateTime'],
                'bb' => $cek_triase['bb'],
                'tb' => $cek_triase['tb'],
                'suhu' => $cek_triase['suhu'],
                'frekuensiNafas' => $cek_triase['frekuensiNafas'],
                'frekuensiNadi' => $cek_triase['frekuensiNadi'],
                'tdSistolik' => $cek_triase['tdSistolik'],
                'tdDiastolik' => $cek_triase['tdDiastolik'],
                'spo2' => $cek_triase['spo2'],
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'],
                'motorik_triase' => $cek_triase['motorik'],
                'verbal_triase' => $cek_triase['verbal'],
                'totalGcs' => $cek_triase['totalGcs'],
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'tampilasesmen' => $resume->get_data_asesmen_perawat_igd_rme($referencenumber),


            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CPPTPerawatIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_cppt_perawat($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_cppt_perawat_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function MedisIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme_medis_igd', $data);
    }

    public function ambildataRMEMedisIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataigd()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_medis_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRMEMedisIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_Registerigd($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_medis_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMedisIGD()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_poli($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME IGD',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['journalnumber'],
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_rajal'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
            ];
            $msg = [
                'sukses' => view('rme/modalrmerajal_poliklinik_medis_igd', $data)
            ];
            return json_encode($msg);
        }
    }

    // andi prabu
    public function HasilresumeMedis()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRMEMedis();
            $resume2 = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume2->get_cppt_perawat($referencenumber);

            $row = $resume2->get_data_pasien_poli_rme($referencenumber);
            $data = [
                'tampilmedis' => $resume->get_data_medis($referencenumber),
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'mobil' => $this->mobil(),
                'airway' => $this->airway(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'list' => $this->_data_dokter_all(),
            ];

            $msg = [
                'data' => view('rme/data_asesmen_awal_medis_umum_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function HapusHasilMedis()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelPelayananPoliRMETRIAGE;
            $cek = $TNO->cek_triase($id);
            $nama_tindakan = $cek['registernumber'];
            $dokter = $cek['doktername'];
            $TNO->delete($id);

            $norm = $cek['relation'];
            $aktifitas = $nama_tindakan;
            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Hapus Triase   Pada pasien ' . $norm . '  Dengan Dokter : ' . $dokter,
                'pasienid' => $norm,
                'menu' => ' IGD [Hapus Triase IGD]',

            ];

            $catat = new Modellogactivity;
            $catat->insert($datalog_activity);

            $msg = [
                'sukses' => "Data Triase dengan ID : $id Berhasil dihapus"
            ];

            return json_encode($msg);
        }
    }

    public function AsesmenAwalMedisIGDLama()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULUT") {
                $file = 'rme/asesmen_awal_medis_gigi';
            } else {
                $file = 'rme/asesmen_awal_medis_umum_igd';
            }

            $asesmen_perawat = $resume->get_data_asesmen_perawat_igd_rme_view($referencenumber);
            $asesmen_bb = isset($asesmen_perawat['bb']) != null ? $asesmen_perawat['bb'] : "";
            $asesmen_tb = isset($asesmen_perawat['tb']) != null ? $asesmen_perawat['tb'] : "";
            $asesmen_frekuensiNadi = isset($asesmen_perawat['frekuensiNadi']) != null ? $asesmen_perawat['frekuensiNadi'] : "";
            $asesmen_tdSistolik = isset($asesmen_perawat['tdSistolik']) != null ? $asesmen_perawat['tdSistolik'] : "";
            $asesmen_tdDiastolik = isset($asesmen_perawat['tdDiastolik']) != null ? $asesmen_perawat['tdDiastolik'] : "";
            $asesmen_suhu = isset($asesmen_perawat['suhu']) != null ? $asesmen_perawat['suhu'] : "";
            $asesmen_frekuensiNafas = isset($asesmen_perawat['frekuensiNafas']) != null ? $asesmen_perawat['frekuensiNafas'] : "";
            $asesmen_kesadaran = isset($asesmen_perawat['kesadaran']) != null ? $asesmen_perawat['kesadaran'] : "";
            $asesmen_spo2 = isset($asesmen_perawat['spo2']) != null ? $asesmen_perawat['spo2'] : "";
            $asesmen_eye = isset($asesmen_perawat['eye']) != null ? $asesmen_perawat['eye'] : "";
            $asesmen_verbal = isset($asesmen_perawat['verbal']) != null ? $asesmen_perawat['verbal'] : "";
            $asesmen_motorik = isset($asesmen_perawat['motorik']) != null ? $asesmen_perawat['motorik'] : "";
            $asesmen_totalGcs = isset($asesmen_perawat['totalGcs']) != null ? $asesmen_perawat['totalGcs'] : "";
            $admissionDateTime = isset($asesmen_perawat['admissionDateTime']) != null ? $asesmen_perawat['admissionDateTime'] : "";
            $kondisiPasien = isset($asesmen_perawat['kondisiPasien']) != null ? $asesmen_perawat['kondisiPasien'] : "";
            $DiagnosaAskep = isset($asesmen_perawat['DiagnosaAskep']) != null ? $asesmen_perawat['DiagnosaAskep'] : "";
            $uraianAskep = isset($asesmen_perawat['uraianAskep']) != null ? $asesmen_perawat['uraianAskep'] : "";
            $implementasiAskep = isset($asesmen_perawat['implementasiAskep']) != null ? $asesmen_perawat['implementasiAskep'] : "";
            $sasaranRencana = isset($asesmen_perawat['sasaranRencana']) != null ? $asesmen_perawat['sasaranRencana'] : "";
            $keadaanUmum = isset($asesmen_perawat['keadaanUmum']) != null ? $asesmen_perawat['keadaanUmum'] : "";



            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'konsultasi' => $this->data_konsultasi(),
                'tindaklanjut' => $this->data_tindak_lanjut(),
                'asesmen_bb' => $asesmen_bb,
                'asesmen_tb' => $asesmen_tb,
                'asesmen_frekuensiNadi' => $asesmen_frekuensiNadi,
                'asesmen_tdSistolik' => $asesmen_tdSistolik,
                'asesmen_tdDiastolik' => $asesmen_tdDiastolik,
                'asesmen_suhu' => $asesmen_suhu,
                'asesmen_frekuensiNafas' => $asesmen_frekuensiNafas,
                'asesmen_kesadaran' => $asesmen_kesadaran,
                'list' => $this->_data_dokter(),
                'asesmen_spo2' => $asesmen_spo2,
                'asesmen_eye' => $asesmen_eye,
                'asesmen_verbal' => $asesmen_verbal,
                'asesmen_motorik' => $asesmen_motorik,
                'asesmen_totalGcs' => $asesmen_totalGcs,
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'admissionDateTime' => $admissionDateTime,
                'kondisiPasien' =>  $kondisiPasien,
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'DiagnosaAskep' =>  $DiagnosaAskep,
                'uraianAskep' =>  $uraianAskep,
                'implementasiAskep' =>  $implementasiAskep,
                'sasaranRencana' => $sasaranRencana,
                'asalPasien' => $this->asalpasienRME(),
                'master_ats' => $this->AtsRME(),
                'keadaanUmum' => $keadaanUmum,
                'alasanRujuk' => $this->AlasanRujuk(),
                'mobil' => $this->mobil(),

            ];

            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderTNOIGD()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IGD";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);



            $lokasi = $row['poliklinik'];
            $documentdate = $row['documentdate'];

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
            }

            $today = date('ymd', strtotime($documentdate));
            $underscore = '_';

            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');

            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);


            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $oldcode = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IGD';
            $classroomname = 'IGD';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';
            $bpjs_sep = $row['bpjs_sep'];
            $poliklinik = $row['poliklinik'];
            $poliklinikname = $row['poliklinikname'];
            $employee = 'NONE';
            $namapoli = $row['poliklinik'];


            $simpandata = [

                'groups' => $groups,
                'journalnumber' => $newkode,
                'documentdate' => $documentdate,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'bpjs_sep' => $bpjs_sep,
                'noantrian' => $nourut,
                'pasienid' => $pasienid,
                'oldcode' => $oldcode,
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'paymentcardnumber' => $paymentcardnumber,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'smf' => $smf,
                'employee' => $employee,
                'dokter' => $dokter,
                'doktername' => $doktername,

                'locationcode' => $poliklinik,
                'locationname' => $poliklinikname,
                'createdby' => session()->get('firstname'),
                'createddate' => date('Y-m-d G:i:s'),


            ];
            $perawat = new ModelTNOHeaderRajal;
            $perawat->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'pasienid' => $pasienid,
                'pasienname' => $pasienname,
                'paymentmethodname' => $paymentmethodname,
                'paymentmethod' => $paymentmethod,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'referencenumber' => $referencenumber,
                'paramedic' => $this->data_paramedic2($namapoli),
                'documentdate' => $documentdate,
                'list_dokter' => $this->_data_dokter(),
            ];
            $msg = [
                'sukses' => view('rme/modalinputTNOigd_rme', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanTNOIGDDetail()
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

                $dokter = explode('|', $this->request->getVar('dokter'));

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
                    'dokter' => $dokter[0],
                    'doktername' => $dokter[1],
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
                    'createdby' => session()->get('firstname'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'pelaksana' => $pelaksana,
                    'paramedicName' => $this->request->getVar('paramedicName')

                ];
                $tno = new ModelTNODetailRJ;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Berhasil Ditambahkan'
                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeTNOMedisIGD()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetailRJ();

            $referencenumber = $this->request->getVar('referencenumber');
            $row = $perawat->search_igd_register($referencenumber);
            $data = [
                'tampildata' => $perawat->search_tindakan_igd_rme($referencenumber),
            ];
            $msg = [
                'data' => view('rme/data_resume_TNO_igd_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function asalpasienRME()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_asal_pasien_rme();
        return $list;
    }

    public function AtsRME()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_ats_rme();
        return $list;
    }

    public function fill_ats()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_ats();
        return json_encode($data);
    }

    public function AlasanRujuk()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_alasan_rujuk();
        return $list;
    }

    public function AsesmenAwalPerawatIGDMonitoring()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];
            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";


            $file = 'rme/asesmen_awal_keperawatan_igd_monitoring';
            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'],
                'admissionDateTime' => $cek_triase['admissionDateTime'],
                'bb' => $cek_triase['bb'],
                'tb' => $cek_triase['tb'],
                'suhu' => $cek_triase['suhu'],
                'frekuensiNafas' => $cek_triase['frekuensiNafas'],
                'frekuensiNadi' => $cek_triase['frekuensiNadi'],
                'tdSistolik' => $cek_triase['tdSistolik'],
                'tdDiastolik' => $cek_triase['tdDiastolik'],
                'spo2' => $cek_triase['spo2'],
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'],
                'motorik_triase' => $cek_triase['motorik'],
                'verbal_triase' => $cek_triase['verbal'],
                'totalGcs' => $cek_triase['totalGcs'],
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'diagnosis' => $diagnosis,


            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function AsesmenAwalPerawatIGDTransfer()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $ranap = $resume->get_data_pasien_poli_rme_to_ranap($referencenumber);
            $ruangan_ranap = isset($ranap['roomname']) != null ? $ranap['roomname'] : "";

            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";

            $poliklinikname = $row['poliklinikname'];

            $file = 'rme/form_transfer_pasien';

            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $cek_data_asesmen_perawat = $resume->get_data_asesmen_perawat_rme($referencenumber);
            $keluhanUtama = isset($cek_data_asesmen_perawat['keluhanUtama']) != null ? $cek_data_asesmen_perawat['keluhanUtama'] : "";
            $riwayatPenyakitSekarang = isset($cek_data_asesmen_perawat['riwayatPenyakitSekarang']) != null ? $cek_data_asesmen_perawat['riwayatPenyakitSekarang'] : "";
            $Alergi = isset($cek_data_asesmen_perawat['Alergi']) != null ? $cek_data_asesmen_perawat['Alergi'] : "";
            $uraianAlergi = isset($cek_data_asesmen_perawat['uraianAlergi']) != null ? $cek_data_asesmen_perawat['uraianAlergi'] : "";
            $keadaanUmum = isset($cek_data_asesmen_perawat['keadaanUmum']) != null ? $cek_data_asesmen_perawat['keadaanUmum'] : "";

            if ($Alergi == "1") {
                $isialergi = "Ada";
            } else {
                $isialergi = "Tidak ada";
            }

            $cek_prosedur = $resume->get_data_prosedur_rme($referencenumber);
            $joinedData = '';
            foreach ($cek_prosedur as $index => $data) {
                $prosedur = $data['name'];
                $joinedData .= ($index + 1) . '. ' . $prosedur . "\n";
                $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
            }

            $cek_obat = $resume->get_data_resep_rme($referencenumber);
            $joinedDataObat = '';
            foreach ($cek_obat as $index => $dataobat) {
                $obat = $dataobat['name'];
                $joinedDataObat .= ($index + 1) . '. ' . $obat . "\n";
                $joinedDataObat = str_replace(array("\r", "\r"), '', $joinedDataObat);
            }


            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'] ?? null,
                'admissionDateTime' => $cek_triase['admissionDateTime'] ?? null,
                'bb' => $cek_triase['bb'] ?? null,
                'tb' => $cek_triase['tb'] ?? null,
                'suhu' => $cek_triase['suhu'] ?? null,
                'frekuensiNafas' => $cek_triase['frekuensiNafas'] ?? null,
                'frekuensiNadi' => $cek_triase['frekuensiNadi'] ?? null,
                'tdSistolik' => $cek_triase['tdSistolik'] ?? null,
                'tdDiastolik' => $cek_triase['tdDiastolik'] ?? null,
                'spo2' => $cek_triase['spo2'] ?? null,
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'] ?? null,
                'motorik_triase' => $cek_triase['motorik'] ?? null,
                'verbal_triase' => $cek_triase['verbal'] ?? null,
                'totalGcs' => $cek_triase['totalGcs'] ?? null,
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'transport_transfer' => $this->transport(),
                'derajat_transfer' => $this->derajat(),
                'ruangan' => $ruangan_ranap,
                'diagnosis' => $diagnosis,
                'alergi' => $isialergi,
                'uraianAlergi' => $uraianAlergi,
                'keluhanUtama' => $keluhanUtama,
                'rps' => $riwayatPenyakitSekarang,
                'keadaanUmum' => $keadaanUmum,
                'prosedur' => $joinedData,
                'dataObat' => $joinedDataObat,


            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function transport()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_transfer();
        return $list;
    }
    public function derajat()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_derajat();
        return $list;
    }

    public function simpanAsesmenMedisIGDLama()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_medis_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IGD-RME-MEDIS';
                $groups = 'IGD';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $kepala = $this->request->getVar('kepala');
                $uraiankepala = $this->request->getVar('uraiankepala');
                if ($kepala == 1) {
                    $isikepala = $uraiankepala;
                } else {
                    $isikepala = 0;
                }

                $mata = $this->request->getVar('mata');
                $uraianmata = $this->request->getVar('uraianmata');
                if ($mata == 1) {
                    $isimata = $uraianmata;
                } else {
                    $isimata = 0;
                }

                $telinga = $this->request->getVar('telinga');
                $uraiantelinga = $this->request->getVar('uraiantelinga');
                if ($telinga == 1) {
                    $isitelinga = $uraiantelinga;
                } else {
                    $isitelinga = 0;
                }

                $hidung = $this->request->getVar('hidung');
                $uraianhidung = $this->request->getVar('uraianhidung');
                if ($hidung == 1) {
                    $isihidung = $uraianhidung;
                } else {
                    $isihidung = 0;
                }

                $bibir = $this->request->getVar('bibir');
                $uraianbibir = $this->request->getVar('uraianbibir');
                if ($bibir == 1) {
                    $isibibir = $uraianbibir;
                } else {
                    $isibibir = 0;
                }

                $rambut = $this->request->getVar('rambut');
                $uraianrambut = $this->request->getVar('uraianrambut');
                if ($rambut == 1) {
                    $isirambut = $uraianrambut;
                } else {
                    $isirambut = 0;
                }

                $gigiGeligi = $this->request->getVar('gigiGeligi');
                $uraiangigiGeligi = $this->request->getVar('uraiangigiGeligi');
                if ($gigiGeligi == 1) {
                    $isigigiGeligi = $uraiangigiGeligi;
                } else {
                    $isigigiGeligi = 0;
                }

                $lidah = $this->request->getVar('lidah');
                $uraianlidah = $this->request->getVar('uraianlidah');
                if ($lidah == 1) {
                    $isilidah = $uraianlidah;
                } else {
                    $isilidah = 0;
                }

                $LangitLangit = $this->request->getVar('LangitLangit');
                $uraianLangitLangit = $this->request->getVar('uraianLangitLangit');
                if ($LangitLangit == 1) {
                    $isiLangitLangit = $uraianLangitLangit;
                } else {
                    $isiLangitLangit = 0;
                }

                $leher = $this->request->getVar('leher');
                $uraianleher = $this->request->getVar('uraianleher');
                if ($leher == 1) {
                    $isileher = $uraianleher;
                } else {
                    $isileher = 0;
                }

                $tenggorokan = $this->request->getVar('tenggorokan');
                $uraiantenggorokan = $this->request->getVar('uraiantenggorokan');
                if ($tenggorokan == 1) {
                    $isitenggorokan = $uraiantenggorokan;
                } else {
                    $isitenggorokan = 0;
                }

                $dada = $this->request->getVar('dada');
                $uraiandada = $this->request->getVar('uraiandada');
                if ($dada == 1) {
                    $isidada = $uraiandada;
                } else {
                    $isidada = 0;
                }

                $tonsil = $this->request->getVar('tonsil');
                $uraiantonsil = $this->request->getVar('uraiantonsil');
                if ($tonsil == 1) {
                    $isitonsil = $uraiantonsil;
                } else {
                    $isitonsil = 0;
                }

                $payudara = $this->request->getVar('payudara');
                $uraianpayudara = $this->request->getVar('uraianpayudara');
                if ($payudara == 1) {
                    $isipayudara = $uraianpayudara;
                } else {
                    $isipayudara = 0;
                }

                $perut = $this->request->getVar('perut');
                $uraianperut = $this->request->getVar('uraianperut');
                if ($perut == 1) {
                    $isiperut = $uraianperut;
                } else {
                    $isiperut = 0;
                }

                $punggung = $this->request->getVar('punggung');
                $uraianpunggung = $this->request->getVar('uraianpunggung');
                if ($punggung == 1) {
                    $isipunggung = $uraianpunggung;
                } else {
                    $isipunggung = 0;
                }

                $genital = $this->request->getVar('genital');
                $uraiangenital = $this->request->getVar('uraiangenital');
                if ($genital == 1) {
                    $isigenital = $uraiangenital;
                } else {
                    $isigenital = 0;
                }

                $anus = $this->request->getVar('anus');
                $uraiananus = $this->request->getVar('uraiananus');
                if ($anus == 1) {
                    $isianus = $uraiananus;
                } else {
                    $isianus = 0;
                }

                $lenganAtas = $this->request->getVar('lenganAtas');
                $uraianlenganAtas = $this->request->getVar('uraianlenganAtas');
                if ($lenganAtas == 1) {
                    $isilenganAtas = $uraianlenganAtas;
                } else {
                    $isilenganAtas = 0;
                }

                $lenganBawah = $this->request->getVar('lenganBawah');
                $uraianlenganBawah = $this->request->getVar('uraianlenganBawah');
                if ($lenganBawah == 1) {
                    $isilenganBawah = $uraianlenganBawah;
                } else {
                    $isilenganBawah = 0;
                }

                $jariTangan = $this->request->getVar('jariTangan');
                $uraianjariTangan = $this->request->getVar('uraianjariTangan');
                if ($jariTangan == 1) {
                    $isijariTangan = $uraianjariTangan;
                } else {
                    $isijariTangan = 0;
                }

                $kukuTangan = $this->request->getVar('kukuTangan');
                $uraiankukuTangan = $this->request->getVar('uraiankukuTangan');
                if ($kukuTangan == 1) {
                    $isikukuTangan = $uraiankukuTangan;
                } else {
                    $isikukuTangan = 0;
                }

                $persendianTangan = $this->request->getVar('persendianTangan');
                $uraianpersendianTangan = $this->request->getVar('uraianpersendianTangan');
                if ($persendianTangan == 1) {
                    $isipersendianTangan = $uraianpersendianTangan;
                } else {
                    $isipersendianTangan = 0;
                }

                $tungkaiAtas = $this->request->getVar('tungkaiAtas');
                $uraiantungkaiAtas = $this->request->getVar('uraiantungkaiAtas');
                if ($tungkaiAtas == 1) {
                    $isitungkaiAtas = $uraiantungkaiAtas;
                } else {
                    $isitungkaiAtas = 0;
                }

                $tungkaiBawah = $this->request->getVar('tungkaiBawah');
                $uraiantungkaiBawah = $this->request->getVar('uraiantungkaiBawah');
                if ($tungkaiBawah == 1) {
                    $isitungkaiBawah = $uraiantungkaiBawah;
                } else {
                    $isitungkaiBawah = 0;
                }

                $jariKaki = $this->request->getVar('jariKaki');
                $uraianjariKaki = $this->request->getVar('uraianjariKaki');
                if ($jariKaki == 1) {
                    $isijariKaki = $uraianjariKaki;
                } else {
                    $isijariKaki = 0;
                }

                $kukuKaki = $this->request->getVar('kukuKaki');
                $uraiankukuKaki = $this->request->getVar('uraiankukuKaki');
                if ($kukuKaki == 1) {
                    $isikukuKaki = $uraiankukuKaki;
                } else {
                    $isikukuKaki = 0;
                }

                $persendianKaki = $this->request->getVar('persendianKaki');
                $uraianpersendianKaki = $this->request->getVar('uraianpersendianKaki');
                if ($persendianKaki == 1) {
                    $isipersendianKaki = $uraianpersendianKaki;
                } else {
                    $isipersendianKaki = 0;
                }

                $keluhanUTama = nl2br($this->request->getVar('keluhanUtama'));
                $riwayatPenyakitSekarang = nl2br($this->request->getVar('riwayatPenyakitSekarang'));
                $riwayatPenyakitKeluarga = nl2br($this->request->getVar('riwayatPenyakitKeluarga'));
                $objective = nl2br($this->request->getVar('objective'));
                $planning = nl2br($this->request->getVar('planning'));

                // status lokalis
                $anatomi = $this->request->getVar('anatomi');

                if ($anatomi != "") {
                    $imageName = md5(uniqid(rand(), true)) . '.jpeg';
                    $image = $this->conv($this->request->getVar('anatomi'), $imageName);
                    $status_lokalis = $imageName;
                    // end status lokalis
                } else {
                    $status_lokalis = '';
                }

                // handle file record audio
                $dataAudio = $this->request->getFile('audData');
                $nameFile = null;
                if (!$dataAudio->getError() == 4) {
                    $nameFile = $dataAudio->getRandomName();
                    $dataAudio->move('assets/audio_rme', $nameFile);
                }
                // end handle file record audio


                $preventif = $this->request->getVar('preventif');
                if ($preventif == 1) {
                    $isipreventif = 1;
                } else {
                    $isipreventif = 0;
                }

                $kuratif = $this->request->getVar('kuratif');
                if ($kuratif == 1) {
                    $isikuratif = 1;
                } else {
                    $isikuratif = 0;
                }

                $paliatif = $this->request->getVar('paliatif');
                if ($paliatif == 1) {
                    $isipaliatif = 1;
                } else {
                    $isipaliatif = 0;
                }

                $rehabilitatif = $this->request->getVar('rehabilitatif');
                if ($rehabilitatif == 1) {
                    $isirehabilitatif = 1;
                } else {
                    $isirehabilitatif = 0;
                }


                $admissionDateTimeAsesmen = $this->request->getVar('admissionDateTimeAsesmen');
                $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
                $asesmenDate = $tglasesmen[0];
                $asesmenTime = $tglasesmen[1];

                $explode_tanggal = explode("-", $asesmenDate);
                $tahun = $explode_tanggal[2];
                $bulan = $explode_tanggal[1];
                $hari = $explode_tanggal[0];

                $tanggal_jam_asesmen = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;



                $simpandata = [
                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'gambar_anatomi_tubuh' => $status_lokalis,
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'tb' => $this->request->getVar('tb'),
                    'bb' => $this->request->getVar('bb'),
                    'denyut_jantung' => $this->request->getVar('frekuensiNadi'),
                    'pernapasan' => $this->request->getVar('pernapasan'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'kepala' => $isikepala,
                    'mata' => $isimata,
                    'telinga' => $isitelinga,
                    'hidung' => $isihidung,
                    'rambut' => $isirambut,
                    'bibir' => $isibibir,
                    'gigiGeligi' => $isigigiGeligi,
                    'lidah' => $isilidah,
                    'langitLangit' => $isiLangitLangit,
                    'tonsil' => $isitonsil,
                    'dada' => $isidada,
                    'payudara' => $isipayudara,
                    'punggung' => $isipunggung,
                    'perut' => $isiperut,
                    'genital' => $isigenital,
                    'anus' => $isianus,
                    'lengan_atas' => $isilenganAtas,
                    'lengan_bawah' => $isilenganBawah,
                    'jari_tangan' => $isijariTangan,
                    'kuku_tangan' => $isikukuTangan,
                    'persendian_tangan' => $isipersendianTangan,
                    'tungkai_atas' => $isitungkaiAtas,
                    'tungkai_bawah' => $isitungkaiBawah,
                    'jariKaki' => $isijariKaki,
                    'kukuKaki' => $isikukuKaki,
                    'persendianKaki' => $isipersendianKaki,
                    'createdBy' => $this->request->getVar('createdBy'),
                    'createddate' => $this->request->getVar('createddate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'keluhanUtama' => $keluhanUTama,
                    'objektive' => $objective,
                    'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                    'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                    'diagnosis' => $this->request->getVar('diagnosis'),
                    'diagnosisBanding' => $this->request->getVar('diagnosisBanding'),
                    'planning' => $planning,
                    'deskripsiKonsultasi' => $this->request->getVar('deskripsiKonsultasi'),
                    'tujuanKonsultasi' => $this->request->getVar('tujuanKonsultasi'),
                    'tindakLanjut' => $this->request->getVar('tindakLanjut'),
                    'konsulen' => $this->request->getVar('konsulen'),
                    'file_audio' => $nameFile,
                    'preventif' => $isipreventif,
                    'kuratif' => $isikuratif,
                    'paliatif' => $isipaliatif,
                    'rehabilitatif' => $isirehabilitatif,
                    'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                    'admissionDateTimeAsesmen' => $tanggal_jam_asesmen,
                    'kondisiPasien' => $this->request->getVar('kondisiPasien'),
                    'ats' => $this->request->getVar('ats'),
                    'asalPasien' => $this->request->getVar('asalPasien'),
                    'hamil' => $this->request->getVar('hamil'),
                    'grapida' => $this->request->getVar('grapida'),
                    'partus' => $this->request->getVar('partus'),
                    'abortus' => $this->request->getVar('abortus'),
                    'umurKehamilan' => $this->request->getVar('umurKehamilan'),
                    'alergi' => $this->request->getVar('alergi'),
                    'alergiObat' => $this->request->getVar('alergiObat'),
                    'eye' => $this->request->getVar('eye'),
                    'verbal' => $this->request->getVar('verbal'),
                    'motorik' => $this->request->getVar('motorik'),
                    'totalGcs' => $this->request->getVar('totalGcs'),
                    'keadaanUmum' => $this->request->getVar('keadaanUmum'),
                    'riwayatPenyakitDahulu' => $this->request->getVar('riwayatPenyakitDahulu'),
                    'anamnesis' => $this->request->getVar('anamnesis'),
                    'uraianAllo' => $this->request->getVar('uraianAllo'),
                    'pemeriksaanFisik' => $this->request->getVar('pemeriksaanFisik'),
                    'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                    'hasil_uraianAskep' => $this->request->getVar('hasil_uraianAskep'),
                    'hasil_sasaranRencana' => $this->request->getVar('hasil_sasaranRencana'),
                    'hasil_tindakanEvaluasi' => $this->request->getVar('hasil_tindakanEvaluasi'),
                    'obatRutin' => $this->request->getVar('obatRutin'),
                    'namaObatRutin' => $this->request->getVar('namaObatRutin'),
                    'tujuanRujuk' => $this->request->getVar('tujuanRujuk'),
                    'indikasiRujuk' => $this->request->getVar('indikasiRujuk'),
                ];

                $perawat = new ModelPelayananPoliRMEMedis;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderRADIGD()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'RAD';
            $namalokasi = 'RADIOLOGI';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='RAD' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IGD';
            $classroomname = 'IGD';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => $registernumber,
                'registernumber_rawatinap' => 'NONE',
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d G:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokLab(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderRADrme_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    public function orderLPKIGD()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'LPK';
            $namalokasi = 'LABORATORIUM PATOLOGI KLINIK';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='LPK' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IGD';
            $classroomname = 'IGD';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => $registernumber,
                'registernumber_rawatinap' => 'NONE',
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d H:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokLPK(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderLPKrme_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    public function orderEresepIGD()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('id');
            $cekregister = new ModelPelayananPoliRME;
            $groups = 'IGD';
            $hasilcek = $cekregister->get_data_cek_farmasi_rme($referencenumber, $groups);
            $cekdulu = isset($hasilcek['pasienid']) != null ? $hasilcek['pasienid'] : "";

            $groups = "IGD";
            $db = db_connect();
            $locationcode = 'DEPOIGD';
            $locationname = 'DEPO IGD';

            $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header  ORDER BY id desc LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
                $antrian = $row->noantrian;
            }


            $underscore = '_';
            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }

            if ($antrian == "") {
                $nourutantrian = '1';
            } else {
                $nourutantrian = (int)($antrian);
                $nourutantrian++;
            }


            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);


            $tanda = 'RIGD';
            $documentdate = date('Y-m-d');
            $today = date('ymd', strtotime($documentdate));
            $pasienid = $row['pasienid'];
            $tahun = date('Y');
            $bulan = date('m');

            $newkode = $tanda . $underscore . $pasienid . $underscore . $locationcode . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $no_antrian = sprintf($nourutantrian);

            $documentdate = $documentdate;
            $karyawan = '';
            $dispensasi = '';
            $pasienid = $pasienid;
            $pasienname = $row['pasienname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $poliklinik = $row['poliklinik'];
            $poliklinikname = $row['poliklinikname'];
            $poliklinikclass = '';
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $employee = 'NONE';
            $employeename = '';
            $tandamemo = '/';
            $memo = $doktername . $tandamemo . $paymentmethod;
            $locationname = $locationname;
            $ranap = 1;
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $tanggallahir = $pasiendateofbirth;
            $dob = strtotime($tanggallahir);
            $current_time = time();
            $age_years = date('Y', $current_time) - date('Y', $dob);
            $age_months = date('m', $current_time) - date('m', $dob);
            $age_days = date('d', $current_time) - date('d', $dob);

            $bpjs_sep = $row['bpjs_sep'];
            $pasienaddress = $row['pasienaddress'];
            $pasiengender = $row['pasiengender'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $paymentmethodori = $row['paymentmethodori'];
            $paymentmethodnameori = $row['paymentmethodnameori'];
            $paymentmethodnameori = $row['paymentmethodnameori'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];

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
            $groups = "IGD";



            $lokasi = $row['poliklinik'];
            $documentdate = $row['documentdate'];

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
            }

            $today = date('ymd', strtotime($documentdate));
            $underscore = '_';

            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }


            $simpandata = [
                'isenaranap' => $ranap,
                'groups' => $groups,
                'journalnumber' => $newkode,
                'documentdate' => $documentdate,
                'documentyear' => $tahun,
                'documentmonth' => $bulan,
                'noreg' => $referencenumber,
                'referencenumber' => $referencenumber,
                'bpjs_sep' => $bpjs_sep,
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'dateofbirth' => $tanggallahir,
                'pasienage' => $umur,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'karyawan' => $karyawan,
                'dispensasi' => $dispensasi,
                'dispensasipejabat' => '',
                'dispensasialasan' => '',
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'paymentcardnumber' => $paymentcardnumber,
                'paymentmethodori' => $paymentmethodori,
                'paymentmethodnameori' => $paymentmethodnameori,
                'paymentcardnumberori' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'poliklinikclass' => $poliklinikclass,
                'poliklinikclassname' => '',
                'bednumber' => '',
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => $employee,
                'employeename' => $employeename,
                'locationcode' => $locationcode,
                'locationname' => $locationname,
                'numberseq' => $no_antrian,
                'createdby' => session()->get('firstname'),
                'createddate' => date('Y-m-d G:i:s'),
                'eresep' => 1,
            ];


            $perawat = new ModelFarmasiPelayananHeader();
            $perawat->insert($simpandata);
            $resume = new ModelTerimaPBFDetail();
            $data = [
                'journalnumber' => $newkode,
                'documentdate' => $documentdate,
                'karyawan' => $karyawan,
                'dispensasi' => $dispensasi,
                'relation' => $pasienid,
                'relationname' => $pasienname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'poliklinikclass' => $poliklinikclass,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => $employee,
                'employeename' => $employeename,
                'referencenumber' => $memo,
                'locationcode' => $locationcode,
                'locationname' => $locationname,
                'racikan' => $this->racikan_rme(),
                'itemracikan' => $this->itemracikan(),
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),

            ];

            $msg = [
                'sukses' => view('rme/modalinputeresepRajal_rme', $data)
            ];
            return json_encode($msg);
        }
    }


    public function simpanAsesmenPerawatIGDMonitoring()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'monitoring_paramedicName' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'monitoring_paramedicName' => $validation->getError('monitoring_paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM monitoring_perawat_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IGD-RME';
                $groups = 'IGD';
                $underscore = '_';

                $admissionDateTimeAsesmen = $this->request->getVar('executionDateTime');
                $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
                $asesmenDate = $tglasesmen[0];
                $asesmenTime = $tglasesmen[1];

                $explode_tanggal = explode("-", $asesmenDate);
                $tahun = $explode_tanggal[2];
                $bulan = $explode_tanggal[1];
                $hari = $explode_tanggal[0];

                $tanggal_jam_asesmen = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;
                $tanggal_jam = $tahun . '-' . $bulan . '-' . $hari;
                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;



                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('monitoring_nomorreferensi'),
                    'pasienid' => $this->request->getVar('monitoring_pasienid'),
                    'pasienname' => $this->request->getVar('monitoring_pasienname'),
                    'paymentmethodname' => $this->request->getVar('monitoring_paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('monitoring_poliklinikname'),
                    'admissionDate' => $this->request->getVar('monitoring_admissionDate'),
                    'doktername' => $this->request->getVar('monitoring_doktername'),
                    'kesadaran' => $this->request->getVar('monitoring_kesadaran'),
                    'bb' => $this->request->getVar('monitoring_bb'),
                    'tb' => $this->request->getVar('monitoring_tb'),
                    'frekuensiNadi' => $this->request->getVar('monitoring_frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('monitoring_tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('monitoring_tdDiastolik'),
                    'suhu' => $this->request->getVar('monitoring_suhu'),
                    'frekuensiNafas' => $this->request->getVar('monitoring_frekuensiNafas'),
                    'spo2' => $this->request->getVar('monitoring_spo2'),
                    'eye' => $this->request->getVar('monitoring_eye'),
                    'verbal' => $this->request->getVar('monitoring_verbal'),
                    'motorik' => $this->request->getVar('monitoring_motorik'),
                    'totalGcs' => $this->request->getVar('monitoring_gcs'),
                    'skalaNyeri' => $this->request->getVar('monitoring_skalaNyeri'),
                    'createdBy' => $this->request->getVar('monitoring_createdBy'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'paramedicName' => $this->request->getVar('monitoring_paramedicName'),
                    'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                    'pemberianOral' => $this->request->getVar('monitoring_pemberianOral'),
                    'pemberianParental' => $this->request->getVar('monitoring_pemberianParental'),
                    'pemberianNgt' => $this->request->getVar('monitoring_pemberianNgt'),
                    'pemberianObat' => $this->request->getVar('monitoring_pemberianObat'),
                    'muntah' => $this->request->getVar('monitoring_muntah'),
                    'drain' => $this->request->getVar('monitoring_drain'),
                    'iwl' => $this->request->getVar('monitoring_iwl'),
                    'perdarahan' => $this->request->getVar('monitoring_perdarahan'),
                    'urin' => $this->request->getVar('monitoring_urin'),
                    'balance' => $this->request->getVar('monitoring_balance'),
                    'kontraksiUterus' => $this->request->getVar('monitoring_kontraksiUterus'),
                    'durasi' => $this->request->getVar('monitoring_durasi'),
                    'diuresis' => $this->request->getVar('monitoring_diuresis'),
                    'intensitas' => $this->request->getVar('monitoring_intensitas'),
                    'periksaDalam' => $this->request->getVar('monitoring_periksaDalam'),
                    'pervaginam' => $this->request->getVar('monitoring_pervaginam'),
                    'janin' => $this->request->getVar('monitoring_janin'),
                    'tinggiPundusUteri' => $this->request->getVar('monitoring_tinggiPundusUteri'),
                    'diagnosa' => $this->request->getVar('monitoring_diagnosa'),
                    'executionDate' => $tanggal_jam,
                    'executionDateTime' => $tanggal_jam_asesmen,


                ];

                $perawat = new ModelPelayananPoliRMEMonitoring;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function AsesmenAwalPerawatIGDHasilMonitoring()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_monitoring($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_monitoring_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanTransferPasienIGD()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'transfer_paramedicName' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'transfer_paramedicName' => $validation->getError('transfer_paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM transfer_pasien_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IGD-RME';
                $groups = 'IGD';
                $underscore = '_';

                $admissionDateTimeAsesmen = $this->request->getVar('transfer_pindahDateTime');
                $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
                $asesmenDate = $tglasesmen[0];
                $asesmenTime = $tglasesmen[1];

                $explode_tanggal = explode("-", $asesmenDate);
                $tahun = $explode_tanggal[2];
                $bulan = $explode_tanggal[1];
                $hari = $explode_tanggal[0];

                $tanggal_jam_asesmen = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;
                $tanggal_jam = $tahun . '-' . $bulan . '-' . $hari;
                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;



                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('transfer_nomorreferensi'),
                    'pasienid' => $this->request->getVar('transfer_pasienid'),
                    'pasienname' => $this->request->getVar('transfer_pasienname'),
                    'paymentmethodname' => $this->request->getVar('transfer_paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('transfer_poliklinikname'),
                    'admissionDate' => $this->request->getVar('transfer_admissionDate'),
                    'doktername' => $this->request->getVar('transfer_doktername'),
                    'bb' => $this->request->getVar('transfer_bb'),
                    'tb' => $this->request->getVar('transfer_tb'),
                    'frekuensiNadi' => $this->request->getVar('transfer_frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('transfer_tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('transfer_tdDiastolik'),
                    'suhu' => $this->request->getVar('transfer_suhu'),
                    'frekuensiNafas' => $this->request->getVar('transfer_frekuensiNafas'),
                    'spo2' => $this->request->getVar('transfer_spo2'),
                    'skalaNyeri' => $this->request->getVar('transfer_skalaNyeri'),
                    'eye' => $this->request->getVar('transfer_eye'),
                    'verbal' => $this->request->getVar('transfer_verbal'),
                    'motorik' => $this->request->getVar('transfer_motorik'),
                    'totalGcs' => $this->request->getVar('transfer_pindah_gcs'),
                    'createdBy' => $this->request->getVar('transfer_createdBy'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'paramedicName' => $this->request->getVar('transfer_paramedicName'),
                    'admissionDateTime' => $this->request->getVar('transfer_admissionDateTime'),
                    'pindahDate' => $tanggal_jam,
                    'pindahDateTime' => $tanggal_jam_asesmen,
                    'keluhanUtama' => $this->request->getVar('transfer_keluhanUtama'),
                    'riwayatPenyakitSekarang' => $this->request->getVar('transfer_riwayatPenyakitSekarang'),
                    'riwayatAlergi' => $this->request->getVar('transfer_riwayatAlergi'),
                    'uraianAlergi' => $this->request->getVar('transfer_uraianAlergi'),
                    'pemeriksaanFisik' => $this->request->getVar('transfer_pemeriksaanFisik'),
                    'kesadaran' => $this->request->getVar('transfer_kesadaran'),
                    'diagnosa' => $this->request->getVar('transfer_diagnosa'),
                    'dariRuang' => $this->request->getVar('transfer_dariRuang'),
                    'ruangTujuan' => $this->request->getVar('transfer_ruangTujuan'),
                    'indikasiRawat' => $this->request->getVar('transfer_indikasiRawat'),
                    'keadaanUmum' => $this->request->getVar('transfer_keadaanUmum'),
                    'alasanTransfer' => $this->request->getVar('transfer_alasan'),
                    'hasilPenunjang' => $this->request->getVar('transfer_hasilPenunjang'),
                    'prosedur' => $this->request->getVar('transfer_prosedur'),
                    'obat' => $this->request->getVar('transfer_obat'),
                    'lain_lain' => $this->request->getVar('transfer_lain_lain'),
                    'keadaanUmumPindah' => $this->request->getVar('transfer_keadaanUmumPindah'),
                    'bbPindah' => $this->request->getVar('transfer_pindah_bb'),
                    'tbPindah' => $this->request->getVar('transfer_pindah_tb'),
                    'tdSistolikPindah' => $this->request->getVar('transfer_pindah_tdSistolik'),
                    'tdDiastolikPindah' => $this->request->getVar('transfer_pindah_tdDiastolik'),
                    'suhuPindah' => $this->request->getVar('transfer_pindah_suhu'),
                    'frekuensiNafasPindah' => $this->request->getVar('transfer_pindah_frekuensiNafas'),
                    'frekuensiNadiPindah' => $this->request->getVar('transfer_pindah_frekuensiNadi'),
                    'spo2Pindah' => $this->request->getVar('transfer_pindah_spo2'),
                    'tinggiFundusUteriPindah' => $this->request->getVar('transfer_tinggiFundusUteri'),
                    'kontraksiUterusPindah' => $this->request->getVar('transfer_kontraksi_kontraksiUterus'),
                    'janin' => $this->request->getVar('transfer_janin'),
                    'perdarahan' => $this->request->getVar('transfer_perdarahan'),
                    'diet' => $this->request->getVar('transfer_diet'),
                    'mobilisasi' => $this->request->getVar('transfer_mobilisasi'),
                    'dekubitus' => $this->request->getVar('transfer_dekubitus'),
                    'nyeri' => $this->request->getVar('transfer_nyeri'),
                    'jatuh' => $this->request->getVar('transfer_jatuh'),
                    'alergi' => $this->request->getVar('transfer_alergi'),
                    'phlebitis' => $this->request->getVar('transfer_phlebitis'),
                    'lain_lainPindah' => $this->request->getVar('transfer_lain_asesmen'),
                    'uraianLain' => $this->request->getVar('uraianLain'),
                    'ngt' => $this->request->getVar('transfer_ngt'),
                    'folley' => $this->request->getVar('transfer_folley'),
                    'chest' => $this->request->getVar('transfer_chest'),
                    'ett' => $this->request->getVar('transfer_ett'),
                    'alat_transport' => $this->request->getVar('transfer_alat_transport'),
                    'derajatPasien' => $this->request->getVar('transfer_derajat'),
                    'petugasPendamping' => $this->request->getVar('transfer_petugasPendamping'),
                    'paramedicNamePemindah' => $this->request->getVar('transfer_perawat_pemindah'),

                ];

                $perawat = new ModelPelayananPoliRMETRansfer;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function AsesmenAwalPerawatIGDTransferHasil()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $ranap = $resume->get_data_pasien_poli_rme_to_ranap($referencenumber);
            $ruangan_ranap = isset($ranap['roomname']) != null ? $ranap['roomname'] : "";

            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";

            $poliklinikname = $row['poliklinikname'];

            $file = 'rme/form_transfer_pasien_hasil';

            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $cek_data_asesmen_perawat = $resume->get_data_asesmen_perawat_rme($referencenumber);
            $keluhanUtama = isset($cek_data_asesmen_perawat['keluhanUtama']) != null ? $cek_data_asesmen_perawat['keluhanUtama'] : "";
            $riwayatPenyakitSekarang = isset($cek_data_asesmen_perawat['riwayatPenyakitSekarang']) != null ? $cek_data_asesmen_perawat['riwayatPenyakitSekarang'] : "";
            $Alergi = isset($cek_data_asesmen_perawat['Alergi']) != null ? $cek_data_asesmen_perawat['Alergi'] : "";
            $uraianAlergi = isset($cek_data_asesmen_perawat['uraianAlergi']) != null ? $cek_data_asesmen_perawat['uraianAlergi'] : "";
            $keadaanUmum = isset($cek_data_asesmen_perawat['keadaanUmum']) != null ? $cek_data_asesmen_perawat['keadaanUmum'] : "";

            if ($Alergi == "1") {
                $isialergi = "Ada";
            } else {
                $isialergi = "Tidak ada";
            }

            $cek_prosedur = $resume->get_data_prosedur_rme($referencenumber);
            $joinedData = '';
            foreach ($cek_prosedur as $index => $data) {
                $prosedur = $data['name'];
                $joinedData .= ($index + 1) . '. ' . $prosedur . "\n";
                $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
            }

            $cek_obat = $resume->get_data_resep_rme($referencenumber);
            $joinedDataObat = '';
            foreach ($cek_obat as $index => $dataobat) {
                $obat = $dataobat['name'];
                $joinedDataObat .= ($index + 1) . '. ' . $obat . "\n";
                $joinedDataObat = str_replace(array("\r", "\r"), '', $joinedDataObat);
            }


            $data = [
                'cek_Hasil_transfer' => $resume->cek_hasil_transfer_rme($referencenumber),
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'] ?? null,
                'admissionDateTime' => $cek_triase['admissionDateTime'] ?? null,
                'bb' => $cek_triase['bb'] ?? null,
                'tb' => $cek_triase['tb'] ?? null,
                'suhu' => $cek_triase['suhu'] ?? null,
                'frekuensiNafas' => $cek_triase['frekuensiNafas'] ?? null,
                'frekuensiNadi' => $cek_triase['frekuensiNadi'] ?? null,
                'tdSistolik' => $cek_triase['tdSistolik'] ?? null,
                'tdDiastolik' => $cek_triase['tdDiastolik'] ?? null,
                'spo2' => $cek_triase['spo2'] ?? null,
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'] ?? null,
                'motorik_triase' => $cek_triase['motorik'] ?? null,
                'verbal_triase' => $cek_triase['verbal'] ?? null,
                'totalGcs' => $cek_triase['totalGcs'] ?? null,
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'transport_transfer' => $this->transport(),
                'derajat_transfer' => $this->derajat(),
                'ruangan' => $ruangan_ranap,
                'diagnosis' => $diagnosis,
                'alergi' => $isialergi,
                'uraianAlergi' => $uraianAlergi,
                'keluhanUtama' => $keluhanUtama,
                'rps' => $riwayatPenyakitSekarang,
                'keadaanUmum' => $keadaanUmum,
                'prosedur' => $joinedData,
                'dataObat' => $joinedDataObat,
            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeTransferVerifikasi()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'noKunjungan' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modalresume_transfer_verifikasi', $data)
            ];
            return json_encode($msg);
        }
    }

    public function AsesmenAwalPerawatIGDTransferHasilVerifikasi()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $ranap = $resume->get_data_pasien_poli_rme_to_ranap($referencenumber);
            $ruangan_ranap = isset($ranap['roomname']) != null ? $ranap['roomname'] : "";

            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";

            $poliklinikname = $row['poliklinikname'];

            $file = 'rme/form_transfer_pasien_hasil_verifikasi';

            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $cek_data_asesmen_perawat = $resume->get_data_asesmen_perawat_rme($referencenumber);
            $keluhanUtama = isset($cek_data_asesmen_perawat['keluhanUtama']) != null ? $cek_data_asesmen_perawat['keluhanUtama'] : "";
            $riwayatPenyakitSekarang = isset($cek_data_asesmen_perawat['riwayatPenyakitSekarang']) != null ? $cek_data_asesmen_perawat['riwayatPenyakitSekarang'] : "";
            $Alergi = isset($cek_data_asesmen_perawat['Alergi']) != null ? $cek_data_asesmen_perawat['Alergi'] : "";
            $uraianAlergi = isset($cek_data_asesmen_perawat['uraianAlergi']) != null ? $cek_data_asesmen_perawat['uraianAlergi'] : "";
            $keadaanUmum = isset($cek_data_asesmen_perawat['keadaanUmum']) != null ? $cek_data_asesmen_perawat['keadaanUmum'] : "";

            if ($Alergi == "1") {
                $isialergi = "Ada";
            } else {
                $isialergi = "Tidak ada";
            }

            $cek_prosedur = $resume->get_data_prosedur_rme($referencenumber);
            $joinedData = '';
            foreach ($cek_prosedur as $index => $data) {
                $prosedur = $data['name'];
                $joinedData .= ($index + 1) . '. ' . $prosedur . "\n";
                $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
            }

            $cek_obat = $resume->get_data_resep_rme($referencenumber);
            $joinedDataObat = '';
            foreach ($cek_obat as $index => $dataobat) {
                $obat = $dataobat['name'];
                $joinedDataObat .= ($index + 1) . '. ' . $obat . "\n";
                $joinedDataObat = str_replace(array("\r", "\r"), '', $joinedDataObat);
            }


            $data = [
                'cek_Hasil_transfer' => $resume->cek_hasil_transfer_rme($referencenumber),
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'],
                'admissionDateTime' => $cek_triase['admissionDateTime'],
                'bb' => $cek_triase['bb'],
                'tb' => $cek_triase['tb'],
                'suhu' => $cek_triase['suhu'],
                'frekuensiNafas' => $cek_triase['frekuensiNafas'],
                'frekuensiNadi' => $cek_triase['frekuensiNadi'],
                'tdSistolik' => $cek_triase['tdSistolik'],
                'tdDiastolik' => $cek_triase['tdDiastolik'],
                'spo2' => $cek_triase['spo2'],
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'],
                'motorik_triase' => $cek_triase['motorik'],
                'verbal_triase' => $cek_triase['verbal'],
                'totalGcs' => $cek_triase['totalGcs'],
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'transport_transfer' => $this->transport(),
                'derajat_transfer' => $this->derajat(),
                'ruangan' => $ruangan_ranap,
                'diagnosis' => $diagnosis,
                'alergi' => $isialergi,
                'uraianAlergi' => $uraianAlergi,
                'keluhanUtama' => $keluhanUtama,
                'rps' => $riwayatPenyakitSekarang,
                'keadaanUmum' => $keadaanUmum,
                'prosedur' => $joinedData,
                'dataObat' => $joinedDataObat,
            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiTransferSelesai()
    {
        if ($this->request->isAJAX()) {

            $verifikasiDPJP = 1;
            $tanggalJamVerifikasi = date('Y-m-d G:i:s');
            $verifikator = session()->get('firstname');
            $simpandata = [
                'verifikasiDPJP' => $verifikasiDPJP,
                'tanggalJamVerifikasi' => $tanggalJamVerifikasi,
                'verifikator' => $verifikator,

            ];
            $perawat = new ModelPelayananPoliRMETRansfer;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Selesai'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiTransferBatal()
    {
        if ($this->request->isAJAX()) {

            $verifikasiDPJP = 0;
            $tanggalJamVerifikasi = '';
            $verifikator = '';
            $simpandata = [
                'verifikasiDPJP' => $verifikasiDPJP,
                'tanggalJamVerifikasi' => $tanggalJamVerifikasi,
                'verifikator' => $verifikator,

            ];
            $perawat = new ModelPelayananPoliRMETRansfer;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Dibatalkan'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ResumeMedisIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_cppt_medis($referencenumber)
            ];
            $msg = [
                'data' => view('rme/resume_medis_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ResumeResepIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelDepoSPHeader();
            $data = [
                'tampildata' => $register->ambildataDFIGD()
            ];
            $msg = [
                'data' => view('depofarmasi/dataregisterresepIGD', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function AsesmenPerawatRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/register_asesmen_ranap_rme', $data);
    }

    public function ambildataAsesmenPerawatRanap()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataranap_exist()
            ];
            $msg = [
                'data' => view('rme/dataregister_asesmen_ranap_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function KodifikasiDiagnosaIGD()
    {
        if ($this->request->isAJAX()) {


            $db = db_connect();
            $groups = "IGD";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);
            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $oldcode = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IGD';
            $classroomname = 'IGD';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';
            $bpjs_sep = $row['bpjs_sep'];
            $poliklinik = $row['poliklinik'];
            $poliklinikname = $row['poliklinikname'];
            $employee = 'NONE';
            $namapoli = $row['poliklinikname'];

            $lokasi = $row['poliklinik'];
            $documentdate = date('Y-m-d');
            $kata = "KDIGD";

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian  FROM transaksi_rekammedik_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);

            if ($antrian == "") {
                $nourutantrian = '1';
            } else {
                $nourutantrian = (int)($antrian);
                $nourutantrian++;
            }
            $no_antrian = sprintf($nourutantrian);

            $doktername = $this->request->getVar('doktername_TH');
            $dokter = $this->request->getVar('dokter_TH');

            $tanggallahir = $pasiendateofbirth;
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

            $cekregister = new ModelPelayananPoliRME;
            $groups = 'IGD';
            $hasilcek = $cekregister->get_data_cek_coding($referencenumber);
            $cekdulu = isset($hasilcek['pasienid']) != null ? $hasilcek['pasienid'] : "";
            if ($cekdulu == "") {

                $simpandata = [
                    'groups' => $groups,
                    'journalnumber' => $newkode,
                    'documentdate' => $documentdate,
                    'documentyear' => date('Y'),
                    'documentmonth' => date('m'),
                    'referencenumber' => $referencenumber,
                    'referencenumber_rawatjalan' => $referencenumber,
                    'referencenumber_rawatinap' => 'NONE',
                    'bpjs_sep' => $bpjs_sep,
                    'noantrian' => $no_antrian,
                    'pasienid' => $pasienid,
                    'oldcode' => $oldcode,
                    'pasienname' => $pasienname,
                    'pasiengender' => $pasiengender,
                    'pasienage' => $umur,
                    'pasiendateofbirth' => $pasiendateofbirth,
                    'pasienaddress' => $pasienaddress,
                    'pasienarea' => $pasienarea,
                    'pasiensubarea' => $pasiensubarea,
                    'pasiensubareaname' => $pasiensubareaname,
                    'paymentmethod' => $paymentmethod,
                    'paymentmethodname' => $paymentmethodname,
                    'paymentcardnumber' => $paymentcardnumber,
                    'poliklinik' => $poliklinik,
                    'poliklinikname' => $poliklinikname,
                    'pasienclassroom' => $classroom,
                    'classroom' => $classroom,
                    'classroomname' => $classroomname,
                    'bednumber' => $poliklinik,
                    'smf' => $smf,
                    'smfname' => $smfname,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'locationcode' => 'RCM',
                    'locationname' => 'REKAM MEDIS',
                    'numberseq' => $no_antrian,
                    'createdby' => session()->get('firstname'),
                    'createddate' => date('Y-m-d G:i:s'),

                ];
                $perawat = new ModelRekMedHeader;
                $perawat->insert($simpandata);
                $data = [
                    'journalnumber_header' => $newkode,
                    'pasienid' => $pasienid,
                    'pasienname' => $pasienname,
                    'paymentmethodname' => $paymentmethodname,
                    'paymentmethod' => $paymentmethod,
                    'poliklinik' => $poliklinik,
                    'poliklinikname' => $poliklinikname,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'referencenumber' => $referencenumber,
                    'paramedic' => $this->data_paramedic2($namapoli),
                    'documentdate' => $documentdate,
                    'groups' => $groups,
                    'bpjs_sep' => $bpjs_sep,
                    'oldcode' => $oldcode,
                    'pasienid' => $pasienid,
                    'pasiengender' => $pasiengender,
                    'pasienaddress' => $pasienaddress,
                    'pasienarea' => $pasienarea,
                    'pasiensubarea' => $pasiensubarea,
                    'pasiensubareaname' => $pasiensubareaname,
                    'paymentcardnumber' => $paymentcardnumber,
                    'pasienclassroom' => $classroom,
                    'classroom' => $classroom,
                    'classroomname' => $classroomname,
                    'bednumber' => $poliklinik,
                    'smf' => $smf,
                    'smfname' => $smfname,
                    'locationcode' => 'RCM',
                    'locationname' => 'REKAM MEDIS',
                    'pasienaddress' => $pasienaddress,
                    'umur' => $umur,
                    'age_years' => $age_years,
                    'age_months' => $age_months,
                    'age_days' => $age_days,

                ];
            } else {

                $data = [
                    'journalnumber_header' => $hasilcek['journalnumber'],
                    'pasienid' => $pasienid,
                    'pasienname' => $pasienname,
                    'paymentmethodname' => $paymentmethodname,
                    'paymentmethod' => $paymentmethod,
                    'poliklinik' => $poliklinik,
                    'poliklinikname' => $poliklinikname,
                    'dokter' => $dokter,
                    'doktername' => $doktername,
                    'referencenumber' => $referencenumber,
                    'paramedic' => $this->data_paramedic2($namapoli),
                    'documentdate' => $documentdate,
                    'groups' => $groups,
                    'bpjs_sep' => $bpjs_sep,
                    'oldcode' => $oldcode,
                    'pasienid' => $pasienid,
                    'pasiengender' => $pasiengender,
                    'pasienaddress' => $pasienaddress,
                    'pasienarea' => $pasienarea,
                    'pasiensubarea' => $pasiensubarea,
                    'pasiensubareaname' => $pasiensubareaname,
                    'paymentcardnumber' => $paymentcardnumber,
                    'pasienclassroom' => $classroom,
                    'classroom' => $classroom,
                    'classroomname' => $classroomname,
                    'bednumber' => $poliklinik,
                    'smf' => $smf,
                    'smfname' => $smfname,
                    'locationcode' => 'RCM',
                    'locationname' => 'REKAM MEDIS',
                    'pasienaddress' => $pasienaddress,
                    'umur' => $umur,
                    'age_years' => $age_years,
                    'age_months' => $age_months,
                    'age_days' => $age_days,

                ];
            }
            $msg = [
                'sukses' => view('rme/modalinputDiagnosa_rme', $data)
            ];
            return json_encode($msg);
        }
    }


    public function entriAsesmenPerawatRanap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_ranap($id);

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' Asesmen Rawat Inap',

            ];

            $catat = new Modellogactivity;
            $catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
                'nomorreferensi' => $row['referencenumber'],
            ];
            $msg = [
                'sukses' => view('rme/modal_asesmen_perawat_ranap', $data)
            ];
            return json_encode($msg);
        }
    }

    public function AsesmenAwalPerawatRanapTerimaTransfer()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');

            $row = $resume->get_data_pasien_ranap_rme($referencenumber);
            $ranap = $resume->get_data_pasien_poli_rme_to_ranap($referencenumber);
            $ruangan_ranap = isset($ranap['roomname']) != null ? $ranap['roomname'] : "";

            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";

            $poliklinikname = $row['roomname'];

            $file = 'rme/form_transfer_pasien_terima';

            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $cek_data_asesmen_perawat = $resume->get_data_asesmen_perawat_rme($referencenumber);
            $keluhanUtama = isset($cek_data_asesmen_perawat['keluhanUtama']) != null ? $cek_data_asesmen_perawat['keluhanUtama'] : "";
            $riwayatPenyakitSekarang = isset($cek_data_asesmen_perawat['riwayatPenyakitSekarang']) != null ? $cek_data_asesmen_perawat['riwayatPenyakitSekarang'] : "";
            $Alergi = isset($cek_data_asesmen_perawat['Alergi']) != null ? $cek_data_asesmen_perawat['Alergi'] : "";
            $uraianAlergi = isset($cek_data_asesmen_perawat['uraianAlergi']) != null ? $cek_data_asesmen_perawat['uraianAlergi'] : "";
            $keadaanUmum = isset($cek_data_asesmen_perawat['keadaanUmum']) != null ? $cek_data_asesmen_perawat['keadaanUmum'] : "";

            if ($Alergi == "1") {
                $isialergi = "Ada";
            } else {
                $isialergi = "Tidak ada";
            }

            $cek_prosedur = $resume->get_data_prosedur_rme($referencenumber);
            $joinedData = '';
            foreach ($cek_prosedur as $index => $data) {
                $prosedur = $data['name'];
                $joinedData .= ($index + 1) . '. ' . $prosedur . "\n";
                $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
            }

            $cek_obat = $resume->get_data_resep_rme($referencenumber);
            $joinedDataObat = '';
            foreach ($cek_obat as $index => $dataobat) {
                $obat = $dataobat['name'];
                $joinedDataObat .= ($index + 1) . '. ' . $obat . "\n";
                $joinedDataObat = str_replace(array("\r", "\r"), '', $joinedDataObat);
            }


            $data = [
                'cek_Hasil_transfer' => $resume->cek_hasil_transfer_rme($referencenumber),
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'],
                'admissionDateTime' => $cek_triase['admissionDateTime'],
                'bb' => $cek_triase['bb'],
                'tb' => $cek_triase['tb'],
                'suhu' => $cek_triase['suhu'],
                'frekuensiNafas' => $cek_triase['frekuensiNafas'],
                'frekuensiNadi' => $cek_triase['frekuensiNadi'],
                'tdSistolik' => $cek_triase['tdSistolik'],
                'tdDiastolik' => $cek_triase['tdDiastolik'],
                'spo2' => $cek_triase['spo2'],
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'],
                'motorik_triase' => $cek_triase['motorik'],
                'verbal_triase' => $cek_triase['verbal'],
                'totalGcs' => $cek_triase['totalGcs'],
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'transport_transfer' => $this->transport(),
                'derajat_transfer' => $this->derajat(),
                'ruangan' => $ruangan_ranap,
                'diagnosis' => $diagnosis,
                'alergi' => $isialergi,
                'uraianAlergi' => $uraianAlergi,
                'keluhanUtama' => $keluhanUtama,
                'rps' => $riwayatPenyakitSekarang,
                'keadaanUmum' => $keadaanUmum,
                'prosedur' => $joinedData,
                'dataObat' => $joinedDataObat,
            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanTerimaTransferPasien()
    {
        if ($this->request->isAJAX()) {


            $admissionDateTimeAsesmen = $this->request->getVar('hasil_transfer_pindahDateTime');
            $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
            $asesmenDate = $tglasesmen[0];
            $asesmenTime = $tglasesmen[1];

            $explode_tanggal = explode("-", $asesmenDate);
            $tahun = $explode_tanggal[2];
            $bulan = $explode_tanggal[1];
            $hari = $explode_tanggal[0];

            $tanggal_jam_pindah = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;
            $tanggal_jam = $tahun . '-' . $bulan . '-' . $hari;

            $status = 1;

            $simpandata = [
                'status' => $status,
                'paramedicNamePenerima' => $this->request->getVar('hasil_transfer_perawat_penerima'),
                'acceptDateTime' => date('Y-m-d G:i:s'),
                'pindahDateTime' => $tanggal_jam_pindah,
                'keadaanUmumTiba' => $this->request->getVar('hasil_transfer_keadaanUmumtiba'),
                'totalGcsTiba' => $this->request->getVar('hasil_transfer_tiba_gcs'),
                'bbTiba' => $this->request->getVar('hasil_transfer_tiba_bb'),
                'tbTiba' => $this->request->getVar('hasil_transfer_tiba_tb'),
                'frekuensiNadiTiba'  => $this->request->getVar('hasil_transfer_tiba_frekuensiNadi'),
                'tdSistolikTiba' => $this->request->getVar('hasil_transfer_tiba_tdSistolik'),
                'tdDiastolikTiba' => $this->request->getVar('hasil_transfer_tiba_tdDiastolik'),
                'suhuTiba'  => $this->request->getVar('hasil_transfer_tiba_suhu'),
                'frekuensiNafasTiba' => $this->request->getVar('hasil_transfer_tiba_frekuensiNafas'),
                'spo2Tiba' => $this->request->getVar('hasil_transfer_tiba_spo2'),
                'tinggiFundusUteriTiba' => $this->request->getVar('hasil_transfer_tinggiFundusUteri_tiba'),
                'kontraksiUterusTiba' => $this->request->getVar('hasil_transfer_kontraksi_kontraksiUterus_tiba'),
                'janinTiba' => $this->request->getVar('hasil_transfer_janin_tiba'),
                'perdarahanTiba' => $this->request->getVar('hasil_transfer_perdarahan_tiba'),

            ];
            $perawat = new ModelPelayananPoliRMETRansfer;
            $id = $this->request->getVar('no_id_transfer');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Terima Pasien Selesai'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function AsesmenAwalPerawatRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_ranap_rme($referencenumber);
            $poliklinikname = $row['roomname'];

            $file = 'rme/asesmen_awal_keperawatan_ranap';

            $cek_triase = $resume->get_data_triase_rme($referencenumber);
            $cek_transfer = $resume->cek_hasil_transfer_rme_ranap($referencenumber);

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['referencenumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['roomname'],
                'admissionDate' => $row['datein'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => '',
                'admissionDateTime' => $row['datetimein'],
                'bb' => isset($cek_transfer['bbTiba']) != null ? $cek_transfer['bbTiba'] : "",
                'tb' => isset($cek_transfer['tbTiba']) != null ? $cek_transfer['tbTiba'] : "",
                'suhu' => isset($cek_transfer['suhuTiba']) != null ? $cek_transfer['suhuTiba'] : "",
                'frekuensiNafas' => isset($cek_transfer['frekuensiNafasTiba']) != null ? $cek_transfer['frekuensiNafasTiba'] : "",
                'frekuensiNadi' => isset($cek_transfer['frekuensiNadiTiba']) != null ? $cek_transfer['frekuensiNadiTiba'] : "",
                'tdSistolik' => isset($cek_transfer['tdSistolikTiba']) != null ? $cek_transfer['tdSistolikTiba'] : "",
                'tdDiastolik' => isset($cek_transfer['tdDiastolikTiba']) != null ? $cek_transfer['tdDiastolikTiba'] : "",
                'spo2' => isset($cek_transfer['spo2Tiba']) != null ? $cek_transfer['spo2Tiba'] : "",
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => isset($cek_transfer['eye']) != null ? $cek_transfer['eye'] : "",
                'motorik_triase' => isset($cek_transfer['motorik']) != null ? $cek_transfer['motorik'] : "",
                'verbal_triase' => isset($cek_transfer['verbal']) != null ? $cek_transfer['verbal'] : "",
                'totalGcs' => isset($cek_transfer['totalGcs']) != null ? $cek_transfer['totalGcs'] : "",
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'alat_transport' => isset($cek_transfer['alat_transport']) != null ? $cek_transfer['alat_transport'] : "",
                'kasus_trauma' => $this->kasus_trauma(),
                'transport_transfer' => $this->transport(),
                'rpd' => $this->rpd(),
                'komplementari' => $this->komplementari(),
                'kepala' => $this->kepala(),
                'rambut' => $this->rambut(),
                'muka' => $this->muka(),
                'mata' => $this->mata(),
                'telinga' => $this->telinga(),
                'hidung' => $this->hidung(),
                'gigi' => $this->gigi(),
                'lidah' => $this->lidah(),
                'mulut' => $this->mulut(),
                'tenggorokan' => $this->tenggorokan(),
                'leher' => $this->leher(),
                'punggung' => $this->punggung(),
                'payudara' => $this->payudara(),
                'dada' => $this->dada(),
                'perut' => $this->perut(),
                'genital' => $this->genital(),
                'anus' => $this->anus(),
                'integumen' => $this->integumen(),
                'ektstremitas' => $this->ekstremitas(),
                'ginekologi' => $this->ginekologi(),
                'obstetri' => $this->obstetri(),
                'kebutuhan_edukasi' => $this->kebutuhan_edukasi(),
                'bahasa' => $this->bahasa(),
                'pendidikan' => $this->pendidikan(),
                'hambatan' => $this->hambatanEdukasi(),
                'penurunanBb' => $this->penurunanBb(),
                'alatBantuBerjalan' => $this->alatBantuBerjalan(),
                'mobilisasi' => $this->mobilisasi(),
                'umur' => $this->umur(),
                'jenisKL' => $this->jenisKL(),
                'DiagAnak' => $this->DiagAnak(),
                'Kognitif' => $this->Kognitif(),
                'Lingkungan' => $this->Lingkungan(),
                'ResponObat' => $this->ResponObat(),
                'PenggunaanObat' => $this->PenggunaanObat(),



            ];
            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanAsesmenPerawatRanap()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'paramedicName' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'paramedicName' => $validation->getError('paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_perawatan_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRI-RME';
                $groups = 'IRI';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;



                $Alergi = $this->request->getVar('alergi');
                if ($Alergi == 1) {
                    $Alergi = 1;
                } else {
                    $Alergi = 0;
                }


                $uraianAlergi = $this->request->getVar('uraianAlergi');



                $rujukAhliGizi = $this->request->getVar('rujukAhliGizi');
                if ($rujukAhliGizi == 1) {
                    $rujukAhliGizi = 1;
                } else {
                    $rujukAhliGizi = 0;
                }






                $uraianAskep = nl2br($this->request->getVar('uraianAskep'));
                $tindakanEvaluasi = nl2br($this->request->getVar('tindakanEvaluasi'));
                $edukasi = nl2br($this->request->getVar('edukasi'));
                $observasi = nl2br($this->request->getVar('observasi'));
                $terapeutik = nl2br($this->request->getVar('terapeutik'));
                $kolaborasi = nl2br($this->request->getVar('kolaborasi'));



                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'anamnesis' => $this->request->getVar('anamnesis'),
                    'uraianAllo' => $this->request->getVar('uraianAllo'),
                    'bb' => $this->request->getVar('bb'),
                    'tb' => $this->request->getVar('tb'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'frekuensiNafas' => $this->request->getVar('frekuensiNafas'),
                    'spo2' => $this->request->getVar('spo2'),
                    'lingkarKepala' => $this->request->getVar('lingkarKepala'),
                    'lingkarLengan' => $this->request->getVar('lingkarLengan'),
                    'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                    'caraTiba' => $this->request->getVar('caraTiba'),
                    'kasusTrauma' => $this->request->getVar('kasusTrauma'),
                    'riwayatPenyakitDahulu' => $this->request->getVar('riwayatPenyakitDahulu'),
                    'rpdLain' => $this->request->getVar('rpdLain'),
                    'riwayatOperasi' => $this->request->getVar('riwayatOperasi'),
                    'obatSaatIni' => $this->request->getVar('obatSaatIni'),
                    'terapiKomplementari' => $this->request->getVar('terapiKomplementari'),
                    'terapiKomplementariLain' => $this->request->getVar('terapiKomplementariLain'),
                    'alergi' => $this->request->getVar('alergi'),
                    'uraianAlergi' => $this->request->getVar('uraianAlergi'),
                    'merokok' => $this->request->getVar('merokok'),
                    'uraianMerokok' => $this->request->getVar('uraianMerokok'),
                    'alkohol' => $this->request->getVar('alkohol'),
                    'uraianAlkohol' => $this->request->getVar('uraianAlkohol'),
                    'obatTidur' => $this->request->getVar('obatTidur'),
                    'hamil' => $this->request->getVar('hamil'),
                    'perkiraanKelahiran' => $this->request->getVar('perkiraanKelahiran'),
                    'menyusui' => $this->request->getVar('menyusui'),
                    'spontan' => $this->request->getVar('spontan'),
                    'caesar' => $this->request->getVar('caesar'),
                    'kurangBulan' => $this->request->getVar('kurangBulan'),
                    'cukupBulan' => $this->request->getVar('cukupBulan'),
                    'Keguguran' => $this->request->getVar('Keguguran'),
                    'Kembar' => $this->request->getVar('Kembar'),
                    'bcg' => $this->request->getVar('bcg'),
                    'dpt' => $this->request->getVar('dpt'),
                    'polio' => $this->request->getVar('polio'),
                    'campak' => $this->request->getVar('campak'),
                    'hepatitisB' => $this->request->getVar('hepatitisB'),
                    'pcv' => $this->request->getVar('pcv'),
                    'varicela' => $this->request->getVar('varicela'),
                    'rotavirus' => $this->request->getVar('rotavirus'),
                    'typoid' => $this->request->getVar('typoid'),
                    'hib' => $this->request->getVar('hib'),
                    'mmr' => $this->request->getVar('mmr'),
                    'influenza' => $this->request->getVar('influenza'),
                    'pneumokokus' => $this->request->getVar('pneumokokus'),
                    'hpv' => $this->request->getVar('hpv'),
                    'tetantus' => $this->request->getVar('tetantus'),
                    'zooster' => $this->request->getVar('zooster'),
                    'yellowFever' => $this->request->getVar('yellowFever'),
                    'caCervix' => $this->request->getVar('caCervix'),
                    'hepatitisA' => $this->request->getVar('hepatitisA'),
                    'hepatitisBDewasa' => $this->request->getVar('hepatitisBDewasa'),
                    'polioDewasa' => $this->request->getVar('polioDewasa'),
                    'tidakSemangat' => $this->request->getVar('tidakSemangat'),
                    'rasaTertekan' => $this->request->getVar('rasaTertekan'),
                    'depresi' => $this->request->getVar('depresi'),
                    'sulitTidur' => $this->request->getVar('sulitTidur'),
                    'cepatLelah' => $this->request->getVar('cepatLelah'),
                    'sulitBerbicara' => $this->request->getVar('sulitBerbicara'),
                    'kurangNafsuMakan' => $this->request->getVar('kurangNafsuMakan'),
                    'sulitKonsentrasi' => $this->request->getVar('sulitKonsentrasi'),
                    'obatPenenang' => $this->request->getVar('obatPenenang'),
                    'merasaBersalah' => $this->request->getVar('merasaBersalah'),
                    'keluhanUtama' => $this->request->getVar('keluhanUtama'),
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'eye' => $this->request->getVar('eye'),
                    'verbal' => $this->request->getVar('verbal'),
                    'motorik' => $this->request->getVar('motorik'),
                    'totalGcs' => $this->request->getVar('gcs'),
                    'kepala' => $this->request->getVar('kepala'),
                    'rambut' => $this->request->getVar('rambut'),
                    'muka' => $this->request->getVar('muka'),
                    'mata' => $this->request->getVar('mata'),
                    'telinga' => $this->request->getVar('telinga'),
                    'hidung' => $this->request->getVar('hidung'),
                    'gigi' => $this->request->getVar('gigi'),
                    'lidah' => $this->request->getVar('lidah'),
                    'mulut' => $this->request->getVar('mulut'),
                    'tenggorokan' => $this->request->getVar('tenggorokan'),
                    'leher' => $this->request->getVar('leher'),
                    'punggung' => $this->request->getVar('punggung'),
                    'payudara' => $this->request->getVar('payudara'),
                    'dada' => $this->request->getVar('dada'),
                    'perut' => $this->request->getVar('perut'),
                    'genital' => $this->request->getVar('genital'),
                    'anus' => $this->request->getVar('anus'),
                    'integumen' => $this->request->getVar('integumen'),
                    'ekstremitas' => $this->request->getVar('ekstremitas'),
                    'crt' => $this->request->getVar('crt'),
                    'kananAtas' => $this->request->getVar('kananAtas'),
                    'kiriAtas' => $this->request->getVar('kiriAtas'),
                    'kananBawah' => $this->request->getVar('kananBawah'),
                    'kiriBawah' => $this->request->getVar('kiriBawah'),
                    'ginekologi' => $this->request->getVar('ginekologi'),
                    'obstetri' => $this->request->getVar('obstetri'),
                    'tfuObstetri' => $this->request->getVar('tfuObstetri'),
                    'kebutuhanEdukasi' => $this->request->getVar('kebutuhanEdukasi'),
                    'bahasaSehari' => $this->request->getVar('bahasaSehari'),
                    'perluPenterjemah' => $this->request->getVar('perluPenterjemah'),
                    'tingkatPendidikan' => $this->request->getVar('tingkatPendidikan'),
                    'dapatMembaca' => $this->request->getVar('dapatMembaca'),
                    'keyakinanPenyakit' => $this->request->getVar('keyakinanPenyakit'),
                    'uraianKeyakinanPenyakit' => $this->request->getVar('uraianKeyakinanPenyakit'),
                    'visual' => $this->request->getVar('visual'),
                    'audio' => $this->request->getVar('audio'),
                    'kinestetik' => $this->request->getVar('kinestetik'),
                    'hambatanEdukasi' => $this->request->getVar('hambatanEdukasi'),
                    'kesediaanMenerimaInformasi' => $this->request->getVar('kesediaanMenerimaInformasi'),
                    'penurunanBBRencana' => $this->request->getVar('penurunanBBRencana'),
                    'nutrisiTurunBb' => $this->request->getVar('nutrisiTurunBb'),
                    'asupanMakananDewasa' => $this->request->getVar('asupanMakananDewasa'),
                    'nutrisiMuntahDiare' => $this->request->getVar('nutrisiMuntahDiare'),
                    'nutrisiKurus' => $this->request->getVar('nutrisiKurus'),
                    'penyakitMalnutrisi' => $this->request->getVar('penyakitMalnutrisi'),
                    'penyakitBerat' => $this->request->getVar('penyakitBerat'),
                    'nutrisiKondisiKhusus' => $this->request->getVar('nutrisiKondisiKhusus'),
                    'uraianKondisiKhusus' => $this->request->getVar('uraianKondisiKhusus'),
                    'totalSkorNutrisiDewasa' => $this->request->getVar('skorNutrisi'),
                    'rujukAhliGizi' => $rujukAhliGizi,
                    'fungsionalRiwayatJatuh' => $this->request->getVar('fungsionalRiwayatJatuh'),
                    'diagnosisSekunder' => $this->request->getVar('diagnosisSekunder'),
                    'alatBantuBerjalan' => $this->request->getVar('alatBantuBerjalan'),
                    'heparin' => $this->request->getVar('heparin'),
                    'mobilisasi' => $this->request->getVar('mobilisasi'),
                    'statusMental' => $this->request->getVar('statusMental'),
                    'riwayatPenyakitSekarang' => $this->request->getVar('riwayatPenyakitSekarang'),
                    'skalaNyeri' => $this->request->getVar('skalaNyeri'),
                    'provokes' => $this->request->getVar('provokes'),
                    'quality' => $this->request->getVar('quality'),
                    'regio' => $this->request->getVar('regio'),
                    'severity' => $this->request->getVar('severity'),
                    'durasiNyeri' => $this->request->getVar('durasiNyeri'),
                    'spiritual' => $this->request->getVar('spiritual'),
                    'sosiologis' => $this->request->getVar('sosiologis'),
                    'kriteriaHasil' => $this->request->getVar('kriteriaHasil'),
                    'riwayatPenyakitDahulu' => $this->request->getVar('riwayatPenyakitDahulu'),
                    'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                    'Diagnosakebidanan' => $this->request->getVar('Diagnosakebidanan'),
                    'uraianAskep' => $this->request->getVar('uraianAskep'),
                    'sasaranRencana' => $this->request->getVar('sasaranRencana'),
                    'implementasiAskep' => $this->request->getVar('tindakanEvaluasi'),
                    'observasi' => $this->request->getVar('observasi'),
                    'terapeutik' => $this->request->getVar('terapeutik'),
                    'edukasi' => $this->request->getVar('edukasi'),
                    'kolaborasi' => $this->request->getVar('kolaborasi'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'umur' => $this->request->getVar('umur'),
                    'jenisKL' => $this->request->getVar('jenisKL'),
                    'DiagAnak' => $this->request->getVar('DiagAnak'),
                    'Kognitif' => $this->request->getVar('Kognitif'),
                    'Lingkungan' => $this->request->getVar('Lingkungan'),
                    'ResponObat' => $this->request->getVar('ResponObat'),
                    'PenggunaanObat' => $this->request->getVar('PenggunaanObat'),
                    'kriteriaHasilAnak' => $this->request->getVar('kriteriaHasilAnak'),
                    'ObTFU' => $this->request->getVar('ObTFU'),


                ];

                $perawat = new ModelPelayananPoliRME;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function umur()
    {
        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_umur();
        return $list;
    }
    public function jenisKL()
    {
        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_jeniskelaminanak();
        return $list;
    }
    public function DiagAnak()
    {
        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_diagnosisanak();
        return $list;
    }
    public function Kognitif()
    {
        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_gangguankognitif();
        return $list;
    }
    public function Lingkungan()
    {
        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_faktorlingkungan();
        return $list;
    }
    public function ResponObat()
    {
        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_responobatanak();
        return $list;
    }
    public function PenggunaanObat()
    {
        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_penggunaanobat();
        return $list;
    }

    public function kasus_trauma()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_kasus_trauma();
        return $list;
    }

    public function rpd()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_rpd();
        return $list;
    }

    public function komplementari()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_komplementari();
        return $list;
    }

    public function kepala()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_kepala();
        return $list;
    }

    public function rambut()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_rambut();
        return $list;
    }
    public function mata()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_mata();
        return $list;
    }
    public function muka()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_muka();
        return $list;
    }

    public function telinga()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_telinga();
        return $list;
    }

    public function hidung()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_hidung();
        return $list;
    }

    public function gigi()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_gigi();
        return $list;
    }

    public function lidah()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_lidah();
        return $list;
    }

    public function mulut()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_mulut();
        return $list;
    }

    public function tenggorokan()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_tenggorokan();
        return $list;
    }

    public function leher()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_leher();
        return $list;
    }

    public function punggung()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_punggung();
        return $list;
    }

    public function payudara()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_payudara();
        return $list;
    }

    public function dada()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_dada();
        return $list;
    }

    public function perut()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_perut();
        return $list;
    }

    public function genital()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_genital();
        return $list;
    }

    public function anus()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_anus();
        return $list;
    }

    public function integumen()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_integumen();
        return $list;
    }

    public function ekstremitas()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_ekstremitas();
        return $list;
    }

    public function ginekologi()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_ginekologi();
        return $list;
    }

    public function obstetri()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_obstetri();
        return $list;
    }
    public function kebutuhan_edukasi()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_kebutuhan_edukasi();
        return $list;
    }

    public function bahasa()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_bahasa();
        return $list;
    }

    public function pendidikan()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_pendidikan();
        return $list;
    }

    public function hambatanEdukasi()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_hambatan();
        return $list;
    }
    public function penurunanBB()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_penurunanBB();
        return $list;
    }

    public function alatBantuBerjalan()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_alat_bantu_berjalan();
        return $list;
    }

    public function mobilisasi()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_mobilisasi();
        return $list;
    }

    public function cariObservasi()
    {
        if ($this->request->isAJAX()) {
            $diagnosa = $this->request->getVar('diagnosakeperawatan');
            $askep = new ModelPelayananPoliRME();
            $data = [
                'list_askep' => $askep->get_list_askep_observasi($diagnosa),

            ];
            $msg = [
                'sukses' => view('rme/modalpilihaskep_observasi', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanpilihAskepObservasi()
    {
        if ($this->request->isAJAX()) {
            $tandai = $this->request->getVar('tandai');
            if ($tandai <> null) {
                for ($i = 0; $i < count($tandai); $i++) {
                    $data = explode("|", $tandai[$i]);
                    $new_data[$i] = [
                        'otec' => $data[0],
                    ];
                }

                foreach ($new_data as $item) {
                    $data_rencana[] = $item;
                }


                $dataawal = json_encode($data_rencana);
                $data_rencana_fix = json_decode($dataawal, true);
                $data_rencana_fix = json_encode($data_rencana_fix);


                $arrayData = json_decode($data_rencana_fix, true);
                $jumlahBaris = count($arrayData);
                $joinedData = '';
                //foreach ($arrayData as $data) {
                foreach ($arrayData as $index => $data) {

                    $rencana = $data['otec'];
                    //$joinedData .= $rencana . "\n";
                    $joinedData .= ($index + 1) . '. ' . $rencana . "\n";
                    $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
                }



                $msg = [
                    'sukses' => "Rencana Observasi Sudah Dipilih",
                    'otec' => $joinedData
                ];
            } else {
                $msg = [
                    'gagal' => "Rencana Keperawatan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }

    public function cariTerapeutik()
    {
        if ($this->request->isAJAX()) {
            $diagnosa = $this->request->getVar('diagnosakeperawatan');
            $askep = new ModelPelayananPoliRME();
            $data = [
                'list_askep' => $askep->get_list_askep_terapeutik($diagnosa),

            ];
            $msg = [
                'sukses' => view('rme/modalpilihaskep_terapeutik', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanpilihAskepTerapeutik()
    {
        if ($this->request->isAJAX()) {
            $tandai = $this->request->getVar('tandai');
            if ($tandai <> null) {
                for ($i = 0; $i < count($tandai); $i++) {
                    $data = explode("|", $tandai[$i]);
                    $new_data[$i] = [
                        'otec' => $data[0],
                    ];
                }

                foreach ($new_data as $item) {
                    $data_rencana[] = $item;
                }


                $dataawal = json_encode($data_rencana);
                $data_rencana_fix = json_decode($dataawal, true);
                $data_rencana_fix = json_encode($data_rencana_fix);


                $arrayData = json_decode($data_rencana_fix, true);
                $jumlahBaris = count($arrayData);
                $joinedData = '';
                //foreach ($arrayData as $data) {
                foreach ($arrayData as $index => $data) {

                    $rencana = $data['otec'];
                    //$joinedData .= $rencana . "\n";
                    $joinedData .= ($index + 1) . '. ' . $rencana . "\n";
                    $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
                }



                $msg = [
                    'sukses' => "Rencana Terapeutik Sudah Dipilih",
                    'terapeutik' => $joinedData
                ];
            } else {
                $msg = [
                    'gagal' => "Rencana Keperawatan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }

    public function cariEdukasi()
    {
        if ($this->request->isAJAX()) {
            $diagnosa = $this->request->getVar('diagnosakeperawatan');
            $askep = new ModelPelayananPoliRME();
            $data = [
                'list_askep' => $askep->get_list_askep_edukasi($diagnosa),

            ];
            $msg = [
                'sukses' => view('rme/modalpilihaskep_edukasi', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanpilihAskepEdukasi()
    {
        if ($this->request->isAJAX()) {
            $tandai = $this->request->getVar('tandai');
            if ($tandai <> null) {
                for ($i = 0; $i < count($tandai); $i++) {
                    $data = explode("|", $tandai[$i]);
                    $new_data[$i] = [
                        'otec' => $data[0],
                    ];
                }

                foreach ($new_data as $item) {
                    $data_rencana[] = $item;
                }


                $dataawal = json_encode($data_rencana);
                $data_rencana_fix = json_decode($dataawal, true);
                $data_rencana_fix = json_encode($data_rencana_fix);


                $arrayData = json_decode($data_rencana_fix, true);
                $jumlahBaris = count($arrayData);
                $joinedData = '';
                //foreach ($arrayData as $data) {
                foreach ($arrayData as $index => $data) {

                    $rencana = $data['otec'];
                    //$joinedData .= $rencana . "\n";
                    $joinedData .= ($index + 1) . '. ' . $rencana . "\n";
                    $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
                }



                $msg = [
                    'sukses' => "Rencana Edukasi Sudah Dipilih",
                    'edukasi' => $joinedData
                ];
            } else {
                $msg = [
                    'gagal' => "Rencana Keperawatan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }

    public function cariKolaborasi()
    {
        if ($this->request->isAJAX()) {
            $diagnosa = $this->request->getVar('diagnosakeperawatan');
            $askep = new ModelPelayananPoliRME();
            $data = [
                'list_askep' => $askep->get_list_askep_kolaborasi($diagnosa),

            ];
            $msg = [
                'sukses' => view('rme/modalpilihaskep_kolaborasi', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanpilihAskepKolaborasi()
    {
        if ($this->request->isAJAX()) {
            $tandai = $this->request->getVar('tandai');
            if ($tandai <> null) {
                for ($i = 0; $i < count($tandai); $i++) {
                    $data = explode("|", $tandai[$i]);
                    $new_data[$i] = [
                        'otec' => $data[0],
                    ];
                }

                foreach ($new_data as $item) {
                    $data_rencana[] = $item;
                }


                $dataawal = json_encode($data_rencana);
                $data_rencana_fix = json_decode($dataawal, true);
                $data_rencana_fix = json_encode($data_rencana_fix);


                $arrayData = json_decode($data_rencana_fix, true);
                $jumlahBaris = count($arrayData);
                $joinedData = '';
                //foreach ($arrayData as $data) {
                foreach ($arrayData as $index => $data) {

                    $rencana = $data['otec'];
                    //$joinedData .= $rencana . "\n";
                    $joinedData .= ($index + 1) . '. ' . $rencana . "\n";
                    $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
                }



                $msg = [
                    'sukses' => "Rencana Edukasi Sudah Dipilih",
                    'kolaborasi' => $joinedData
                ];
            } else {
                $msg = [
                    'gagal' => "Rencana Keperawatan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }


    public function CPPTPerawatRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $data = [
                'tampildata' => $resume->get_cppt_perawat_ranap($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_cppt_perawat_ranap', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tambahCPPTRanap()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IRJ";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_ranap_rme($referencenumber);
            $data = [
                'referencenumber' => $row['referencenumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'poliklinik' => $row['room'],
                'poliklinikname' => $row['roomname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'referencenumber' => $row['referencenumber'],
                'admissionDate' => $row['datein'],
                'list' => $this->_data_dokter(),

            ];
            $msg = [
                'sukses' => view('rme/modalcreate_cppt_ranap', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanCPPTRanap()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'createdBy' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'createdBy' => $validation->getError('createdBy')
                    ]
                ];

                return json_encode([
                    'error' => 'Session anda habis silahkan login kembali'
                ]);
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM resume_cppt_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRI-RME';
                $groups = 'IRI';
                $underscore = '_';

                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $s = nl2br($this->request->getVar('subjective'));
                $o = nl2br($this->request->getVar('objective'));
                $a = nl2br($this->request->getVar('asesmen'));
                $p = nl2br($this->request->getVar('planning'));

                try {
                    $simpandata = [
                        'groups' => $groups,
                        'registernumber' => $newkode,
                        'referencenumber' => $this->request->getVar('nomorreferensi'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                        'poliklinikname' => $this->request->getVar('poliklinikname'),
                        'admissionDate' => $this->request->getVar('admissionDate'),
                        'doktername' => $this->request->getVar('doktername'),
                        's' => $s,
                        'o' => $o,
                        'a' => $a,
                        'p' => $p,
                        'createddate' => date('Y-m-d G:i:s'),
                        // 'kelompokCppt' => $this->request->getVar('kelompokCPPT'),
                        'cpptGenerik' => 1,
                        'createdBy' => $this->request->getVar('createdBy'),
                    ];

                    $perawat = new ModelCPPTRME;
                    $perawat->insert($simpandata);
                    return json_encode([
                        'sukses' => 'Simpan Berhasil',
                        'JN' => $newkode,
                    ]);
                } catch (\Throwable $th) {
                    return json_encode([
                        'error' => 'Gagal simpan cppt ' . $th->getMessage()
                    ]);
                }
            }
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeCPPTRanap()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_ranap_rme($referencenumber);
            $data = [
                'noKunjungan' => $referencenumber,
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'dob' => $row['pasiendateofbirth'],
                'dpjp' => $row['doktername'],
                'ruangan' => $row['roomname'],
                'carabayar' => $row['paymentmethodname']
            ];

            $msg = [
                'sukses' => view('rme/modalresume_cppt_ranap', $data)
            ];
            return json_encode($msg);
        }
    }

    public function CPPTAllProfesi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('noKunjungan');
            $data = [
                'tampildata' => $resume->get_cppt_all($referencenumber),
            ];

            $msg = [
                'data' => view('rme/data_resume_cppt_all', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function MedisRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/register_asesmen_medis_ranap_rme', $data);
    }

    public function ambildataRMEMedisRanap()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataranap_exist()
            ];
            $msg = [
                'data' => view('rme/dataregister_asesmen_medis_ranap_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMedisRanap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_ranap_rme_dokter($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME IGD',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
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
                'classroom' => '',
                'classroomname' => '',
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
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
            ];
            $msg = [
                'sukses' => view('rme/modalrme_ranap_medis', $data)
            ];
            return json_encode($msg);
        }
    }

    public function AsesmenAwalMedisRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_ranap_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULUT") {
                $file = 'rme/asesmen_awal_medis_gigi';
            } else {
                $file = 'rme/asesmen_awal_medis_umum_ranap';
            }

            $asesmen_perawat = $resume->get_data_asesmen_perawat_ranap_rme_view($referencenumber);
            $asesmen_bb = isset($asesmen_perawat['bb']) != null ? $asesmen_perawat['bb'] : "";
            $asesmen_tb = isset($asesmen_perawat['tb']) != null ? $asesmen_perawat['tb'] : "";
            $asesmen_frekuensiNadi = isset($asesmen_perawat['frekuensiNadi']) != null ? $asesmen_perawat['frekuensiNadi'] : "";
            $asesmen_tdSistolik = isset($asesmen_perawat['tdSistolik']) != null ? $asesmen_perawat['tdSistolik'] : "";
            $asesmen_tdDiastolik = isset($asesmen_perawat['tdDiastolik']) != null ? $asesmen_perawat['tdDiastolik'] : "";
            $asesmen_suhu = isset($asesmen_perawat['suhu']) != null ? $asesmen_perawat['suhu'] : "";
            $asesmen_frekuensiNafas = isset($asesmen_perawat['frekuensiNafas']) != null ? $asesmen_perawat['frekuensiNafas'] : "";
            $asesmen_kesadaran = isset($asesmen_perawat['kesadaran']) != null ? $asesmen_perawat['kesadaran'] : "";
            $asesmen_spo2 = isset($asesmen_perawat['spo2']) != null ? $asesmen_perawat['spo2'] : "";
            $asesmen_eye = isset($asesmen_perawat['eye']) != null ? $asesmen_perawat['eye'] : "";
            $asesmen_verbal = isset($asesmen_perawat['verbal']) != null ? $asesmen_perawat['verbal'] : "";
            $asesmen_motorik = isset($asesmen_perawat['motorik']) != null ? $asesmen_perawat['motorik'] : "";
            $asesmen_totalGcs = isset($asesmen_perawat['totalGcs']) != null ? $asesmen_perawat['totalGcs'] : "";
            $admissionDateTime = isset($asesmen_perawat['admissionDateTime']) != null ? $asesmen_perawat['admissionDateTime'] : "";
            $kondisiPasien = isset($asesmen_perawat['kondisiPasien']) != null ? $asesmen_perawat['kondisiPasien'] : "";
            $DiagnosaAskep = isset($asesmen_perawat['DiagnosaAskep']) != null ? $asesmen_perawat['DiagnosaAskep'] : "";
            $uraianAskep = isset($asesmen_perawat['uraianAskep']) != null ? $asesmen_perawat['uraianAskep'] : "";
            $implementasiAskep = isset($asesmen_perawat['implementasiAskep']) != null ? $asesmen_perawat['implementasiAskep'] : "";
            $sasaranRencana = isset($asesmen_perawat['sasaranRencana']) != null ? $asesmen_perawat['sasaranRencana'] : "";
            $keadaanUmum = isset($asesmen_perawat['keadaanUmum']) != null ? $asesmen_perawat['keadaanUmum'] : "";


            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['referencenumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['roomname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'classroom' => $row['classroom'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'konsultasi' => $this->data_konsultasi(),
                'tindaklanjut' => $this->data_tindak_lanjut(),
                'asesmen_bb' => $asesmen_bb,
                'asesmen_tb' => $asesmen_tb,
                'asesmen_frekuensiNadi' => $asesmen_frekuensiNadi,
                'asesmen_tdSistolik' => $asesmen_tdSistolik,
                'asesmen_tdDiastolik' => $asesmen_tdDiastolik,
                'asesmen_suhu' => $asesmen_suhu,
                'asesmen_frekuensiNafas' => $asesmen_frekuensiNafas,
                'asesmen_kesadaran' => $asesmen_kesadaran,
                'list' => $this->_data_dokter(),
                'asesmen_spo2' => $asesmen_spo2,
                'asesmen_eye' => $asesmen_eye,
                'asesmen_verbal' => $asesmen_verbal,
                'asesmen_motorik' => $asesmen_motorik,
                'asesmen_totalGcs' => $asesmen_totalGcs,
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'admissionDateTime' => $admissionDateTime,
                'kondisiPasien' =>  $kondisiPasien,
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'DiagnosaAskep' =>  $DiagnosaAskep,
                'uraianAskep' =>  $uraianAskep,
                'implementasiAskep' =>  $implementasiAskep,
                'sasaranRencana' => $sasaranRencana,
                'asalPasien' => $this->asalpasienRME(),
                'master_ats' => $this->AtsRME(),
                'keadaanUmum' => $keadaanUmum,
                'alasanRujuk' => $this->AlasanRujuk(),
                'mobil' => $this->mobil(),

            ];

            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function cariTemplateRMERanap()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('referencenumber');

            $askep = new ModelPelayananPoliRME();
            $pasien = $askep->get_data_pasien_ranap_rme($referencenumber);
            $namapoli = $pasien['poliklinikname'];

            $template = $askep->get_list_template_rme($namapoli);
            $data = [
                'list_askep' => $askep->get_data_pasien_rme($referencenumber),
                'template' => $template,

            ];

            $msg = [
                'sukses' => view('rme/modalpilihtemplaterme', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function cariTemplateRMERanap_tambah()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('referencenumber');

            $askep = new ModelPelayananPoliRME();
            $pasien = $askep->get_data_pasien_ranap_rme($referencenumber);
            $namapoli = $pasien['poliklinikname'];

            $template = $askep->get_list_template_rme($namapoli);
            $data = [
                'list_askep' => $askep->get_data_pasien_rme($referencenumber),
                'template' => $template,

            ];

            $msg = [
                'sukses' => view('rme/modalpilihtemplaterme_tambah', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function simpanAsesmenMedisRanap()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_medis_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRI-RME-MEDIS';
                $groups = 'IRI';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $kepala = $this->request->getVar('kepala');
                $uraiankepala = $this->request->getVar('uraiankepala');
                if ($kepala == 1) {
                    $isikepala = $uraiankepala;
                } else {
                    $isikepala = 0;
                }

                $mata = $this->request->getVar('mata');
                $uraianmata = $this->request->getVar('uraianmata');
                if ($mata == 1) {
                    $isimata = $uraianmata;
                } else {
                    $isimata = 0;
                }

                $telinga = $this->request->getVar('telinga');
                $uraiantelinga = $this->request->getVar('uraiantelinga');
                if ($telinga == 1) {
                    $isitelinga = $uraiantelinga;
                } else {
                    $isitelinga = 0;
                }

                $hidung = $this->request->getVar('hidung');
                $uraianhidung = $this->request->getVar('uraianhidung');
                if ($hidung == 1) {
                    $isihidung = $uraianhidung;
                } else {
                    $isihidung = 0;
                }

                $bibir = $this->request->getVar('bibir');
                $uraianbibir = $this->request->getVar('uraianbibir');
                if ($bibir == 1) {
                    $isibibir = $uraianbibir;
                } else {
                    $isibibir = 0;
                }

                $rambut = $this->request->getVar('rambut');
                $uraianrambut = $this->request->getVar('uraianrambut');
                if ($rambut == 1) {
                    $isirambut = $uraianrambut;
                } else {
                    $isirambut = 0;
                }

                $gigiGeligi = $this->request->getVar('gigiGeligi');
                $uraiangigiGeligi = $this->request->getVar('uraiangigiGeligi');
                if ($gigiGeligi == 1) {
                    $isigigiGeligi = $uraiangigiGeligi;
                } else {
                    $isigigiGeligi = 0;
                }

                $lidah = $this->request->getVar('lidah');
                $uraianlidah = $this->request->getVar('uraianlidah');
                if ($lidah == 1) {
                    $isilidah = $uraianlidah;
                } else {
                    $isilidah = 0;
                }

                $LangitLangit = $this->request->getVar('LangitLangit');
                $uraianLangitLangit = $this->request->getVar('uraianLangitLangit');
                if ($LangitLangit == 1) {
                    $isiLangitLangit = $uraianLangitLangit;
                } else {
                    $isiLangitLangit = 0;
                }

                $leher = $this->request->getVar('leher');
                $uraianleher = $this->request->getVar('uraianleher');
                if ($leher == 1) {
                    $isileher = $uraianleher;
                } else {
                    $isileher = 0;
                }

                $tenggorokan = $this->request->getVar('tenggorokan');
                $uraiantenggorokan = $this->request->getVar('uraiantenggorokan');
                if ($tenggorokan == 1) {
                    $isitenggorokan = $uraiantenggorokan;
                } else {
                    $isitenggorokan = 0;
                }

                $dada = $this->request->getVar('dada');
                $uraiandada = $this->request->getVar('uraiandada');
                if ($dada == 1) {
                    $isidada = $uraiandada;
                } else {
                    $isidada = 0;
                }

                $tonsil = $this->request->getVar('tonsil');
                $uraiantonsil = $this->request->getVar('uraiantonsil');
                if ($tonsil == 1) {
                    $isitonsil = $uraiantonsil;
                } else {
                    $isitonsil = 0;
                }

                $payudara = $this->request->getVar('payudara');
                $uraianpayudara = $this->request->getVar('uraianpayudara');
                if ($payudara == 1) {
                    $isipayudara = $uraianpayudara;
                } else {
                    $isipayudara = 0;
                }

                $perut = $this->request->getVar('perut');
                $uraianperut = $this->request->getVar('uraianperut');
                if ($perut == 1) {
                    $isiperut = $uraianperut;
                } else {
                    $isiperut = 0;
                }

                $punggung = $this->request->getVar('punggung');
                $uraianpunggung = $this->request->getVar('uraianpunggung');
                if ($punggung == 1) {
                    $isipunggung = $uraianpunggung;
                } else {
                    $isipunggung = 0;
                }

                $genital = $this->request->getVar('genital');
                $uraiangenital = $this->request->getVar('uraiangenital');
                if ($genital == 1) {
                    $isigenital = $uraiangenital;
                } else {
                    $isigenital = 0;
                }

                $anus = $this->request->getVar('anus');
                $uraiananus = $this->request->getVar('uraiananus');
                if ($anus == 1) {
                    $isianus = $uraiananus;
                } else {
                    $isianus = 0;
                }

                $lenganAtas = $this->request->getVar('lenganAtas');
                $uraianlenganAtas = $this->request->getVar('uraianlenganAtas');
                if ($lenganAtas == 1) {
                    $isilenganAtas = $uraianlenganAtas;
                } else {
                    $isilenganAtas = 0;
                }

                $lenganBawah = $this->request->getVar('lenganBawah');
                $uraianlenganBawah = $this->request->getVar('uraianlenganBawah');
                if ($lenganBawah == 1) {
                    $isilenganBawah = $uraianlenganBawah;
                } else {
                    $isilenganBawah = 0;
                }

                $jariTangan = $this->request->getVar('jariTangan');
                $uraianjariTangan = $this->request->getVar('uraianjariTangan');
                if ($jariTangan == 1) {
                    $isijariTangan = $uraianjariTangan;
                } else {
                    $isijariTangan = 0;
                }

                $kukuTangan = $this->request->getVar('kukuTangan');
                $uraiankukuTangan = $this->request->getVar('uraiankukuTangan');
                if ($kukuTangan == 1) {
                    $isikukuTangan = $uraiankukuTangan;
                } else {
                    $isikukuTangan = 0;
                }

                $persendianTangan = $this->request->getVar('persendianTangan');
                $uraianpersendianTangan = $this->request->getVar('uraianpersendianTangan');
                if ($persendianTangan == 1) {
                    $isipersendianTangan = $uraianpersendianTangan;
                } else {
                    $isipersendianTangan = 0;
                }

                $tungkaiAtas = $this->request->getVar('tungkaiAtas');
                $uraiantungkaiAtas = $this->request->getVar('uraiantungkaiAtas');
                if ($tungkaiAtas == 1) {
                    $isitungkaiAtas = $uraiantungkaiAtas;
                } else {
                    $isitungkaiAtas = 0;
                }

                $tungkaiBawah = $this->request->getVar('tungkaiBawah');
                $uraiantungkaiBawah = $this->request->getVar('uraiantungkaiBawah');
                if ($tungkaiBawah == 1) {
                    $isitungkaiBawah = $uraiantungkaiBawah;
                } else {
                    $isitungkaiBawah = 0;
                }

                $jariKaki = $this->request->getVar('jariKaki');
                $uraianjariKaki = $this->request->getVar('uraianjariKaki');
                if ($jariKaki == 1) {
                    $isijariKaki = $uraianjariKaki;
                } else {
                    $isijariKaki = 0;
                }

                $kukuKaki = $this->request->getVar('kukuKaki');
                $uraiankukuKaki = $this->request->getVar('uraiankukuKaki');
                if ($kukuKaki == 1) {
                    $isikukuKaki = $uraiankukuKaki;
                } else {
                    $isikukuKaki = 0;
                }

                $persendianKaki = $this->request->getVar('persendianKaki');
                $uraianpersendianKaki = $this->request->getVar('uraianpersendianKaki');
                if ($persendianKaki == 1) {
                    $isipersendianKaki = $uraianpersendianKaki;
                } else {
                    $isipersendianKaki = 0;
                }

                $keluhanUTama = nl2br($this->request->getVar('keluhanUtama'));
                $riwayatPenyakitSekarang = nl2br($this->request->getVar('riwayatPenyakitSekarang'));
                $riwayatPenyakitKeluarga = nl2br($this->request->getVar('riwayatPenyakitKeluarga'));
                $objective = nl2br($this->request->getVar('objective'));
                $planning = nl2br($this->request->getVar('planning'));

                // status lokalis
                $anatomi = $this->request->getVar('anatomi');

                if ($anatomi != "") {
                    $imageName = md5(uniqid(rand(), true)) . '.jpeg';
                    $image = $this->conv($this->request->getVar('anatomi'), $imageName);
                    $status_lokalis = $imageName;
                    // end status lokalis
                } else {
                    $status_lokalis = '';
                }

                // handle file record audio
                $dataAudio = $this->request->getFile('audData');
                $nameFile = null;
                if (!$dataAudio->getError() == 4) {
                    $nameFile = $dataAudio->getRandomName();
                    $dataAudio->move('assets/audio_rme', $nameFile);
                }
                // end handle file record audio


                $preventif = $this->request->getVar('preventif');
                if ($preventif == 1) {
                    $isipreventif = 1;
                } else {
                    $isipreventif = 0;
                }

                $kuratif = $this->request->getVar('kuratif');
                if ($kuratif == 1) {
                    $isikuratif = 1;
                } else {
                    $isikuratif = 0;
                }

                $paliatif = $this->request->getVar('paliatif');
                if ($paliatif == 1) {
                    $isipaliatif = 1;
                } else {
                    $isipaliatif = 0;
                }

                $rehabilitatif = $this->request->getVar('rehabilitatif');
                if ($rehabilitatif == 1) {
                    $isirehabilitatif = 1;
                } else {
                    $isirehabilitatif = 0;
                }


                $admissionDateTimeAsesmen = $this->request->getVar('admissionDateTimeAsesmen');
                $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
                $asesmenDate = $tglasesmen[0];
                $asesmenTime = $tglasesmen[1];

                $explode_tanggal = explode("-", $asesmenDate);
                $tahun = $explode_tanggal[2];
                $bulan = $explode_tanggal[1];
                $hari = $explode_tanggal[0];

                $tanggal_jam_asesmen = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;



                $simpandata = [
                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'gambar_anatomi_tubuh' => $status_lokalis,
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'tb' => $this->request->getVar('tb'),
                    'bb' => $this->request->getVar('bb'),
                    'denyut_jantung' => $this->request->getVar('frekuensiNadi'),
                    'pernapasan' => $this->request->getVar('pernapasan'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'kepala' => $isikepala,
                    'mata' => $isimata,
                    'telinga' => $isitelinga,
                    'hidung' => $isihidung,
                    'rambut' => $isirambut,
                    'bibir' => $isibibir,
                    'gigiGeligi' => $isigigiGeligi,
                    'lidah' => $isilidah,
                    'langitLangit' => $isiLangitLangit,
                    'tonsil' => $isitonsil,
                    'dada' => $isidada,
                    'payudara' => $isipayudara,
                    'punggung' => $isipunggung,
                    'perut' => $isiperut,
                    'genital' => $isigenital,
                    'anus' => $isianus,
                    'lengan_atas' => $isilenganAtas,
                    'lengan_bawah' => $isilenganBawah,
                    'jari_tangan' => $isijariTangan,
                    'kuku_tangan' => $isikukuTangan,
                    'persendian_tangan' => $isipersendianTangan,
                    'tungkai_atas' => $isitungkaiAtas,
                    'tungkai_bawah' => $isitungkaiBawah,
                    'jariKaki' => $isijariKaki,
                    'kukuKaki' => $isikukuKaki,
                    'persendianKaki' => $isipersendianKaki,
                    'createdby' => $this->request->getVar('createdBy'),
                    'createddate' => $this->request->getVar('createddate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'keluhanUtama' => $keluhanUTama,
                    'objektive' => $objective,
                    'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                    'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                    'diagnosis' => $this->request->getVar('diagnosis'),
                    'diagnosisBanding' => $this->request->getVar('diagnosisBanding'),
                    'planning' => $planning,
                    'deskripsiKonsultasi' => $this->request->getVar('deskripsiKonsultasi'),
                    'tujuanKonsultasi' => $this->request->getVar('tujuanKonsultasi'),
                    'tindakLanjut' => $this->request->getVar('tindakLanjut'),
                    'konsulen' => $this->request->getVar('konsulen'),
                    'file_audio' => $nameFile,
                    'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                    'admissionDateTimeAsesmen' => $tanggal_jam_asesmen,
                    'kondisiPasien' => $this->request->getVar('kondisiPasien'),
                    'alergi' => $this->request->getVar('alergi'),
                    'alergiObat' => $this->request->getVar('alergiObat'),
                    'eye' => $this->request->getVar('eye'),
                    'verbal' => $this->request->getVar('verbal'),
                    'motorik' => $this->request->getVar('motorik'),
                    'totalGcs' => $this->request->getVar('totalGcs'),
                    'keadaanUmum' => $this->request->getVar('keadaanUmum'),
                    'riwayatPenyakitDahulu' => $this->request->getVar('riwayatPenyakitDahulu'),
                    'pemeriksaanFisik' => $this->request->getVar('pemeriksaanFisik'),
                    'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                    'hasil_uraianAskep' => $this->request->getVar('hasil_uraianAskep'),
                    'hasil_sasaranRencana' => $this->request->getVar('hasil_sasaranRencana'),
                    'hasil_tindakanEvaluasi' => $this->request->getVar('hasil_tindakanEvaluasi'),
                    'obatRutin' => $this->request->getVar('obatRutin'),
                    'namaObatRutin' => $this->request->getVar('namaObatRutin'),
                    'tujuanRujuk' => $this->request->getVar('tujuanRujuk'),
                    'indikasiRujuk' => $this->request->getVar('indikasiRujuk'),
                ];

                $perawat = new ModelPelayananPoliRMEMedis;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiCPPTAll()
    {
        if ($this->request->isAJAX()) {
            $simpandata = [
                'verifikasiDPJP' => '1',
                'tanggalJamVerifikasi' => date('Y-m-d H:i:s'),
                'verifikator' => session()->get('firstname'),

            ];
            try {
                $perawat = new ModelCPPTRME;

                $perawat->update($this->request->getVar('id'), $simpandata);

                return json_encode([
                    'sukses' => 'Verifikasi Selesai'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Gagal Verifikasi !'
                ]);
            }
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalkanVerifikasiCPPTAll()
    {
        if ($this->request->isAJAX()) {

            $verifikasiDPJP = 0;
            $tanggalJamVerifikasi = '';
            $verifikator = '';
            $simpandata = [
                'verifikasiDPJP' => $verifikasiDPJP,
                'tanggalJamVerifikasi' => $tanggalJamVerifikasi,
                'verifikator' => $verifikator,

            ];
            $perawat = new ModelCPPTRME;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Selesai'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function riwayatCPPTGOS()
    {
        if ($this->request->isAJAX()) {
            $pasienid = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'pasienid' => $pasienid,
            ];

            $msg = [
                'sukses' => view('rme/modal_cppt_gos', $data)
            ];
            return json_encode($msg);
        }
    }

    public function caridataCPPTGOS()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_cppt_gos($search)
            ];

            $msg = [
                'data' => view('rme/data_resume_cppt_gos', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderRADRanap()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'RAD';
            $namalokasi = 'RADIOLOGI';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='RAD' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();


            $row = $perawat->get_data_pasien_rme_ranap($referencenumber);

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['referencenumber'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = $row['classroom'];
            $classroomname = $row['classroomname'];
            $room = $row['room'];
            $roomname = $row['roomname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => 'NONE',
                'registernumber_rawatinap' => $registernumber,
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d G:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokLab(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderRADrme_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    public function orderLPKRanap()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'LPK';
            $namalokasi = 'LABORATORIUM PATOLOGI KLINIK';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='LPK' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme_ranap($referencenumber);

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['referencenumber'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = $row['classroom'];
            $classroomname = $row['classroomname'];
            $room = $row['room'];
            $roomname = $row['roomname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => $registernumber,
                'registernumber_rawatinap' => 'NONE',
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d G:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokLPK(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderLPKrme_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    public function ResumeMedisRajal()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $cppt = $resume->get_cppt_perawat($referencenumber);
            $cek_resume_medis = $resume->get_cek_resume_medis_rajal($referencenumber);
            $norm = isset($cek_resume_medis['pasienid']) != null ? $cek_resume_medis['pasienid'] : "";
            $cek_master_pasien = $resume->get_cek_master_pasien($referencenumber);
            $dob = isset($cek_master_pasien['pasiendateofbirth']) != null ? $cek_master_pasien['pasiendateofbirth'] : "";
            $nama = isset($cek_resume_medis['pasienname']) != null ? $cek_resume_medis['pasienname'] : "";
            $diagnosis = isset($cek_resume_medis['diagnosis']) != null ? $cek_resume_medis['diagnosis'] : "";
            $terapi = isset($cek_resume_medis['planning']) != null ? $cek_resume_medis['planning'] : "";
            $namaDokter = isset($cek_resume_medis['doktername']) != null ? $cek_resume_medis['doktername'] : "";
            $tanggalPeriksa = isset($cek_resume_medis['admissionDate']) != null ? $cek_resume_medis['admissionDate'] : "";
            $anamnesa = isset($cek_resume_medis['riwayatPenyakitSekarang']) != null ? $cek_resume_medis['riwayatPenyakitSekarang'] : "";

            $data = [
                'tampildata' => $resume->get_resume_medis_rajal($referencenumber),
                'norm' => $norm,
                'dob' => $dob,
                'nama' => $nama,
                'terapi' => $terapi,
                'namaDokter' => $namaDokter,
                'diagnosis' => $diagnosis,
                'tanggalperiksa' => $tanggalPeriksa,
                'anamnesa' => $anamnesa,

            ];
            $msg = [
                'data' => view('rme/resumeMedisRajal', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambilRiwayatResep()
    {
        if ($this->request->isAJAX()) {
            $journalnumber = $this->request->getVar('id');
            $resume = new ModelPelayananPoliRME();
            $resume2 = new ModelTerimaPBFDetail();

            $referencenumber = $this->request->getVar('nomorKunjungan');

            $groups = "IRJ";
            $db = db_connect();
            $locationcode = 'DEPORAJAL';
            $locationname = 'DEPO RAWAT JALAN';

            $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header  ORDER BY id desc LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
                $antrian = $row->noantrian;
            }


            $underscore = '_';
            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }

            if ($antrian == "") {
                $nourutantrian = '1';
            } else {
                $nourutantrian = (int)($antrian);
                $nourutantrian++;
            }


            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);


            $tanda = 'RRJ';
            $documentdate = date('Y-m-d');
            $today = date('ymd', strtotime($documentdate));
            $pasienid = $row['pasienid'];
            $tahun = date('Y');
            $bulan = date('m');

            $newkode = $tanda . $underscore . $pasienid . $underscore . $locationcode . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $no_antrian = sprintf($nourutantrian);

            $documentdate = $documentdate;
            $karyawan = '';
            $dispensasi = '';
            $pasienid = $pasienid;
            $pasienname = $row['pasienname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $poliklinik = $row['poliklinik'];
            $poliklinikname = $row['poliklinikname'];
            $poliklinikclass = '';
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $employee = 'NONE';
            $employeename = '';
            $tandamemo = '/';
            $memo = $doktername . $tandamemo . $paymentmethod;
            $locationname = $locationname;
            $ranap = 1;
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $tanggallahir = $pasiendateofbirth;
            $dob = strtotime($tanggallahir);
            $current_time = time();
            $age_years = date('Y', $current_time) - date('Y', $dob);
            $age_months = date('m', $current_time) - date('m', $dob);
            $age_days = date('d', $current_time) - date('d', $dob);

            $bpjs_sep = $row['bpjs_sep'];
            $pasienaddress = $row['pasienaddress'];
            $pasiengender = $row['pasiengender'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $paymentmethodori = $row['paymentmethodori'];
            $paymentmethodnameori = $row['paymentmethodnameori'];
            $paymentmethodnameori = $row['paymentmethodnameori'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];

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
            $groups = "RJ";



            $lokasi = $row['poliklinik'];
            $documentdate = $row['documentdate'];

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
            }

            $today = date('ymd', strtotime($documentdate));
            $underscore = '_';

            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }


            $simpandata = [
                'isenaranap' => $ranap,
                'groups' => $groups,
                'journalnumber' => $newkode,
                'documentdate' => $documentdate,
                'documentyear' => $tahun,
                'documentmonth' => $bulan,
                'noreg' => $referencenumber,
                'referencenumber' => $referencenumber,
                'bpjs_sep' => $bpjs_sep,
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'dateofbirth' => $tanggallahir,
                'pasienage' => $umur,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'karyawan' => $karyawan,
                'dispensasi' => $dispensasi,
                'dispensasipejabat' => '',
                'dispensasialasan' => '',
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'paymentcardnumber' => $paymentcardnumber,
                'paymentmethodori' => $paymentmethodori,
                'paymentmethodnameori' => $paymentmethodnameori,
                'paymentcardnumberori' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'poliklinikclass' => $poliklinikclass,
                'poliklinikclassname' => '',
                'bednumber' => '',
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => $employee,
                'employeename' => $employeename,
                'locationcode' => $locationcode,
                'locationname' => $locationname,
                'numberseq' => $no_antrian,
                'createdby' => session()->get('firstname'),
                'createddate' => date('Y-m-d G:i:s'),
                'eresep' => 1,
            ];


            $perawat = new ModelFarmasiPelayananHeader();
            //$perawat->insert($simpandata);
            //$resume = new ModelTerimaPBFDetail();
            $resume3 = new ModelTerimaPBFDetail();
            $data = [
                'journalnumber' => $newkode,
                'documentdate' => $documentdate,
                'karyawan' => $karyawan,
                'dispensasi' => $dispensasi,
                'relation' => $pasienid,
                'relationname' => $pasienname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'poliklinikclass' => $poliklinikclass,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => $employee,
                'employeename' => $employeename,
                'referencenumber' => $memo,
                'locationcode' => $locationcode,
                'locationname' => $locationname,
                'racikan' => $this->racikan_rme(),
                'itemracikan' => $this->itemracikan(),
                'tampildatariwayat' => $resume->get_riwayat_resep_detail_join($journalnumber),
                'aturanpakai' => $resume3->aturan_pakai(),
                'carapakai' => $resume3->cara_pakai(),
                'carapetunjuk' => $resume3->cara_petunjuk(),

            ];

            $msg = [
                'sukses' => view('rme/modalpilihriwayatresep', $data)
            ];
            return json_encode($msg);
        }
    }

    public function printResumeMedisRanap()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $kunjungan_pasien = $pasien->get_data_pasien_rme_ranap($referencenumber);
        $kunjungan_pasien2 = $pasien->get_data_pasien_rme_ranap_pulang($referencenumber);
        $resume_medis = $pasien->get_data_resume_medis_ranap($referencenumber);
        $data = [
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'doktername' => $resume_medis['doktername'],
            'pasienid' => $kunjungan_pasien['pasienid'],
            'pasienname' => $kunjungan_pasien['pasienname'],
            'pasiengender' => $kunjungan_pasien['pasiengender'],
            'pasiendateofbirth' => $kunjungan_pasien['pasiendateofbirth'],
            'namapjb' => $kunjungan_pasien['namapjb'],
            'roomname' => $kunjungan_pasien['roomname'],
            'pasienage' => $resume_medis['pasienage'],
            'dateout' => $kunjungan_pasien['dateout'],
            'datein' => $kunjungan_pasien['datein'],
            'documentdate' => $kunjungan_pasien['documentdate'],
            'alasanRawat' => $resume_medis['alasanRawat'],
            'pemeriksaanPenunjang' => $resume_medis['pemeriksaanPenunjang'],
            'terapiSelamaRawat' => $resume_medis['terapiSelamaRawat'],
            'perkembanganSetelahPerawatan' => $resume_medis['perkembanganSetelahPerawatan'],
            'alergiObat' => $resume_medis['alergiObat'],
            'kondisiWaktuKeluar' => $resume_medis['kondisiWaktuKeluar'],
            'tanggalKontrol' => $resume_medis['tanggalKontrol'],
            'diagnosisUtama' => $resume_medis['diagnosisUtama'],
            'createddate' => $resume_medis['createddate'],
            'diagnosisSekunder' => $resume_medis['diagnosisSekunder'],
            'prosedur' => $resume_medis['prosedur'],
            'tglpulang' => $resume_medis['dateOut'],
            'pengobatanDilanjutkan' => $resume_medis['pengobatanDilanjutkan'],
            'ringkasanRiwayatPenyakit' => $resume_medis['ringkasanRiwayatPenyakit'],
            'hasilPemeriksaanFisik' => $resume_medis['hasilPemeriksaanFisik'],
            // 'pasienage' => $resume_medis['pasienage'],
            'dateout2' => $kunjungan_pasien2['dateout'],
            'statuspasien' => $kunjungan_pasien2['statuspasien'],
            'pasienaddress' => $kunjungan_pasien2['pasienaddress'],
            'DetailObat' => $pasien->search_detail_resep_pulang($referencenumber),

        ];



        $databarcode = $pasien->kunjunganranap_pasienid($referencenumber);
        $pasienid_barcode = $databarcode['doktername'];
        $pasienid = $databarcode['doktername'];
        $datapasien = $pasien->data_pasienid($pasienid);

        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(75)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';
        // $data['agama'] = $datapasien['religion'];

        $html = view('pdf/stylebootstrap');
        $html = view('rme/resume_medis_ranap', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('F4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }


    public function transfer_icu_in()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('id');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $ranap = $resume->get_data_pasien_poli_rme_to_ranap($referencenumber);
            $ruangan_ranap = isset($ranap['roomname']) != null ? $ranap['roomname'] : "";

            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";
            $riwayatPenyakitSekarang = isset($diagnosa['riwayatPenyakitSekarang']) != null ? $diagnosa['riwayatPenyakitSekarang'] : "";

            $poliklinikname = $row['poliklinikname'];

            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $cek_data_asesmen_perawat = $resume->get_data_asesmen_perawat_rme($referencenumber);
            $keluhanUtama = isset($cek_data_asesmen_perawat['keluhanUtama']) != null ? $cek_data_asesmen_perawat['keluhanUtama'] : "";
            $riwayatPenyakitSekarang = isset($cek_data_asesmen_perawat['riwayatPenyakitSekarang']) != null ? $cek_data_asesmen_perawat['riwayatPenyakitSekarang'] : "";
            $Alergi = isset($cek_data_asesmen_perawat['Alergi']) != null ? $cek_data_asesmen_perawat['Alergi'] : "";
            $uraianAlergi = isset($cek_data_asesmen_perawat['uraianAlergi']) != null ? $cek_data_asesmen_perawat['uraianAlergi'] : "";
            $keadaanUmum = isset($cek_data_asesmen_perawat['keadaanUmum']) != null ? $cek_data_asesmen_perawat['keadaanUmum'] : "";
            $paramedicName = isset($cek_data_asesmen_perawat['paramedicName']) != null ? $cek_data_asesmen_perawat['paramedicName'] : "";

            if ($Alergi == "1") {
                $isialergi = "Ada";
            } else {
                $isialergi = "Tidak ada";
            }

            $cek_prosedur = $resume->get_data_prosedur_rme($referencenumber);
            $joinedData = '';
            foreach ($cek_prosedur as $index => $data) {
                $prosedur = $data['name'];
                $joinedData .= ($index + 1) . '. ' . $prosedur . "\n";
                $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
            }

            $cek_obat = $resume->get_data_resep_rme($referencenumber);
            $joinedDataObat = '';
            foreach ($cek_obat as $index => $dataobat) {
                $obat = $dataobat['name'];
                $joinedDataObat .= ($index + 1) . '. ' . $obat . "\n";
                $joinedDataObat = str_replace(array("\r", "\r"), '', $joinedDataObat);
            }


            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'],
                'admissionDateTime' => $cek_triase['admissionDateTime'],
                'bb' => $cek_triase['bb'],
                'tb' => $cek_triase['tb'],
                'suhu' => $cek_triase['suhu'],
                'frekuensiNafas' => $cek_triase['frekuensiNafas'],
                'frekuensiNadi' => $cek_triase['frekuensiNadi'],
                'tdSistolik' => $cek_triase['tdSistolik'],
                'tdDiastolik' => $cek_triase['tdDiastolik'],
                'spo2' => $cek_triase['spo2'],
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'],
                'motorik_triase' => $cek_triase['motorik'],
                'verbal_triase' => $cek_triase['verbal'],
                'totalGcs' => $cek_triase['totalGcs'],
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'transport_transfer' => $this->transport(),
                'derajat_transfer' => $this->derajat(),
                'ruangan' => $ruangan_ranap,
                'diagnosis' => $diagnosis,
                'alergi' => $isialergi,
                'uraianAlergi' => $uraianAlergi,
                'keluhanUtama' => $keluhanUtama,
                'rps' => $riwayatPenyakitSekarang,
                'keadaanUmum' => $keadaanUmum,
                'prosedur' => $joinedData,
                'dataObat' => $joinedDataObat,
                'paramedicName' => $paramedicName,
                'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,

            ];

            $msg = [
                'sukses' => view('rme/modal_transfer_icu_in', $data)
            ];
            return json_encode($msg);
        }
    }


    public function WLP()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme_wlp', $data);
    }

    public function ambildataWLP()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataWLP()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlp', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliWLP()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajalWLP($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlp', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function transfer_nicu_in()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('id');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $ranap = $resume->get_data_pasien_poli_rme_to_ranap($referencenumber);
            $ruangan_ranap = isset($ranap['roomname']) != null ? $ranap['roomname'] : "";

            $diagnosa = $resume->get_data_diagnosa_rme($referencenumber);
            $diagnosis = isset($diagnosa['diagnosis']) != null ? $diagnosa['diagnosis'] : "";
            $riwayatPenyakitSekarang = isset($diagnosa['riwayatPenyakitSekarang']) != null ? $diagnosa['riwayatPenyakitSekarang'] : "";

            $poliklinikname = $row['poliklinikname'];

            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $cek_data_asesmen_perawat = $resume->get_data_asesmen_perawat_rme($referencenumber);
            $keluhanUtama = isset($cek_data_asesmen_perawat['keluhanUtama']) != null ? $cek_data_asesmen_perawat['keluhanUtama'] : "";
            $riwayatPenyakitSekarang = isset($cek_data_asesmen_perawat['riwayatPenyakitSekarang']) != null ? $cek_data_asesmen_perawat['riwayatPenyakitSekarang'] : "";
            $Alergi = isset($cek_data_asesmen_perawat['Alergi']) != null ? $cek_data_asesmen_perawat['Alergi'] : "";
            $uraianAlergi = isset($cek_data_asesmen_perawat['uraianAlergi']) != null ? $cek_data_asesmen_perawat['uraianAlergi'] : "";
            $keadaanUmum = isset($cek_data_asesmen_perawat['keadaanUmum']) != null ? $cek_data_asesmen_perawat['keadaanUmum'] : "";
            $paramedicName = isset($cek_data_asesmen_perawat['paramedicName']) != null ? $cek_data_asesmen_perawat['paramedicName'] : "";

            if ($Alergi == "1") {
                $isialergi = "Ada";
            } else {
                $isialergi = "Tidak ada";
            }

            $cek_prosedur = $resume->get_data_prosedur_rme($referencenumber);
            $joinedData = '';
            foreach ($cek_prosedur as $index => $data) {
                $prosedur = $data['name'];
                $joinedData .= ($index + 1) . '. ' . $prosedur . "\n";
                $joinedData = str_replace(array("\r", "\r"), '', $joinedData);
            }

            $cek_obat = $resume->get_data_resep_rme($referencenumber);
            $joinedDataObat = '';
            foreach ($cek_obat as $index => $dataobat) {
                $obat = $dataobat['name'];
                $joinedDataObat .= ($index + 1) . '. ' . $obat . "\n";
                $joinedDataObat = str_replace(array("\r", "\r"), '', $joinedDataObat);
            }


            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'kondisiPasien' => $cek_triase['kondisiPasien'],
                'admissionDateTime' => $cek_triase['admissionDateTime'],
                'bb' => $cek_triase['bb'],
                'tb' => $cek_triase['tb'],
                'suhu' => $cek_triase['suhu'],
                'frekuensiNafas' => $cek_triase['frekuensiNafas'],
                'frekuensiNadi' => $cek_triase['frekuensiNadi'],
                'tdSistolik' => $cek_triase['tdSistolik'],
                'tdDiastolik' => $cek_triase['tdDiastolik'],
                'spo2' => $cek_triase['spo2'],
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'eye_triase' => $cek_triase['eye'],
                'motorik_triase' => $cek_triase['motorik'],
                'verbal_triase' => $cek_triase['verbal'],
                'totalGcs' => $cek_triase['totalGcs'],
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'transport_transfer' => $this->transport(),
                'derajat_transfer' => $this->derajat(),
                'ruangan' => $ruangan_ranap,
                'diagnosis' => $diagnosis,
                'alergi' => $isialergi,
                'uraianAlergi' => $uraianAlergi,
                'keluhanUtama' => $keluhanUtama,
                'rps' => $riwayatPenyakitSekarang,
                'keadaanUmum' => $keadaanUmum,
                'prosedur' => $joinedData,
                'dataObat' => $joinedDataObat,
                'paramedicName' => $paramedicName,
                'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,

            ];

            $msg = [
                'sukses' => view('rme/modal_transfer_nicu_in', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanTransferNicuIn()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'transfer_admissionDateTime_transfer_nicu' => [
                    'label' => 'Jam Transfer',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'transfer_admissionDateTime_transfer_nicu' => $validation->getError('transfer_admissionDateTime_transfer_nicu')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM transfer_pasien_nicu_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IGD-RME';
                $groups = 'IGD';
                $underscore = '_';

                $admissionDateTimeAsesmen = $this->request->getVar('transfer_pindahDateTime_transfer_nicu');
                $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
                $asesmenDate = $tglasesmen[0];
                $asesmenTime = $tglasesmen[1];

                $explode_tanggal = explode("-", $asesmenDate);
                $tahun = $explode_tanggal[2];
                $bulan = $explode_tanggal[1];
                $hari = $explode_tanggal[0];

                $tanggal_jam_asesmen = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;
                $tanggal_jam = $tahun . '-' . $bulan . '-' . $hari;
                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $simpandata = [
                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('transfer_nomorreferensi_transfer_nicu'),
                    'pasienid' => $this->request->getVar('transfer_pasienid_transfer_nicu'),
                    'pasienname' => $this->request->getVar('transfer_pasienname_transfer_nicu'),
                    'paymentmethodname' => $this->request->getVar('transfer_paymentmethodname_transfer_nicu'),
                    'poliklinikname' => $this->request->getVar('transfer_poliklinikname_transfer_nicu'),
                    'admissionDate' => $this->request->getVar('transfer_admissionDate_transfer_nicu'),
                    'doktername' => $this->request->getVar('transfer_doktername_transfer_nicu'),
                    'createdBy' => $this->request->getVar('transfer_createdBy_transfer_nicu'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'paramedicName' => $this->request->getVar('transfer_paramedicName_transfer_nicu'),
                    'admissionDateTime' => $this->request->getVar('transfer_admissionDateTime_transfer_nicu'),
                    'pindahDate' => $tanggal_jam,
                    'pindahDateTime' => $tanggal_jam_asesmen,
                    'diagnosis' => $this->request->getVar('transfer_diagnosis_transfer_nicu'),
                    'riwayatPemeriksan' => $this->request->getVar('riwayatSingkat_transfer_nicu'),
                    'kondisi1' => $this->request->getVar('kondisi1'),
                    'kondisi2' => $this->request->getVar('kondisi2'),
                    'kondisi3' => $this->request->getVar('kondisi3'),
                ];

                $perawat = new ModelPelayananPoliRMENICU;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanTransferIcuIn()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'transfer_admissionDateTime_transfer_nicu' => [
                    'label' => 'Jam Transfer',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'transfer_admissionDateTime_transfer_nicu' => $validation->getError('transfer_admissionDateTime_transfer_nicu')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM transfer_pasien_icu_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IGD-RME';
                $groups = 'IGD';
                $underscore = '_';

                $admissionDateTimeAsesmen = $this->request->getVar('transfer_pindahDateTime_transfer_nicu');
                $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
                $asesmenDate = $tglasesmen[0];
                $asesmenTime = $tglasesmen[1];

                $explode_tanggal = explode("-", $asesmenDate);
                $tahun = $explode_tanggal[2];
                $bulan = $explode_tanggal[1];
                $hari = $explode_tanggal[0];

                $tanggal_jam_asesmen = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;
                $tanggal_jam = $tahun . '-' . $bulan . '-' . $hari;
                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $simpandata = [
                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('transfer_nomorreferensi_transfer_icu'),
                    'pasienid' => $this->request->getVar('transfer_pasienid_transfer_icu'),
                    'pasienname' => $this->request->getVar('transfer_pasienname_transfer_icu'),
                    'paymentmethodname' => $this->request->getVar('transfer_paymentmethodname_transfer_icu'),
                    'poliklinikname' => $this->request->getVar('transfer_poliklinikname_transfer_icu'),
                    'admissionDate' => $this->request->getVar('transfer_admissionDate_transfer_icu'),
                    'doktername' => $this->request->getVar('transfer_doktername_transfer_icu'),
                    'createdBy' => $this->request->getVar('transfer_createdBy_transfer_icu'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'paramedicName' => $this->request->getVar('transfer_paramedicName_transfer_icu'),
                    'admissionDateTime' => $this->request->getVar('transfer_admissionDateTime_transfer_icu'),
                    'pindahDate' => $tanggal_jam,
                    'pindahDateTime' => $tanggal_jam_asesmen,
                    'diagnosis' => $this->request->getVar('transfer_diagnosis_transfer_icu'),
                    'riwayatPemeriksan' => $this->request->getVar('riwayatSingkat_transfer_icu'),
                    'kondisi1' => $this->request->getVar('kondisi1'),
                    'kondisi2' => $this->request->getVar('kondisi2'),
                    'kondisi3' => $this->request->getVar('kondisi3'),
                ];

                $perawat = new ModelPelayananPoliRMEICU;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanAsesmenPerawatGinekologi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'paramedicName' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'paramedicName' => $validation->getError('paramedicName')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_perawatan_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRJ-RME';
                $groups = 'IRJ';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $psikologisTak = $this->request->getVar('psikologisTak');
                if ($psikologisTak == 1) {
                    $psikologisTak = 1;
                } else {
                    $psikologisTak = 0;
                }

                $psikologisTakut = $this->request->getVar('psikologisTakut');
                if ($psikologisTakut == 1) {
                    $psikologisTakut = 1;
                } else {
                    $psikologisTakut = 0;
                }

                $psikologisSedih = $this->request->getVar('psikologisSedih');
                if ($psikologisSedih == 1) {
                    $psikologisSedih = 1;
                } else {
                    $psikologisSedih = 0;
                }


                $psikologisRendahDiri = $this->request->getVar('psikologisRendahDiri');
                if ($psikologisRendahDiri == 1) {
                    $psikologisRendahDiri = 1;
                } else {
                    $psikologisRendahDiri = 0;
                }

                $psikologisMarah = $this->request->getVar('psikologisMarah');
                if ($psikologisMarah == 1) {
                    $psikologisMarah = 1;
                } else {
                    $psikologisMarah = 0;
                }

                $psikologisMudahTersinggung = $this->request->getVar('psikologisMudahTersinggung');
                if ($psikologisMudahTersinggung == 1) {
                    $psikologisMudahTersinggung = 1;
                } else {
                    $psikologisMudahTersinggung = 0;
                }

                $sosiologisTak = $this->request->getVar('sosiologisTak');
                if ($sosiologisTak == 1) {
                    $sosiologisTak = 1;
                } else {
                    $sosiologisTak = 0;
                }

                $sosiologisIsolasi = $this->request->getVar('sosiologisIsolasi');
                if ($sosiologisIsolasi == 1) {
                    $sosiologisIsolasi = 1;
                } else {
                    $sosiologisIsolasi = 0;
                }

                $sosiologisLain = $this->request->getVar('sosiologisLain');
                if ($sosiologisLain == 1) {
                    $sosiologisLain = 1;
                } else {
                    $sosiologisLain = 0;
                }

                $spritualTak = $this->request->getVar('spritualTak');
                if ($spritualTak == 1) {
                    $spritualTak = 1;
                } else {
                    $spritualTak = 0;
                }

                $spiritualPerluDibantu = $this->request->getVar('spiritualPerluDibantu');
                if ($spiritualPerluDibantu == 1) {
                    $spiritualPerluDibantu = 1;
                } else {
                    $spiritualPerluDibantu = 0;
                }

                $spiritualAgama = $this->request->getVar('spiritualAgama');
                if ($spiritualAgama == 1) {
                    $spiritualAgama = 1;
                } else {
                    $spiritualAgama = 0;
                }

                $Alergi = $this->request->getVar('Alergi');
                if ($Alergi == 1) {
                    $Alergi = 1;
                } else {
                    $Alergi = 0;
                }


                $uraianAlergi = $this->request->getVar('Alergi');

                $nutrisiTurunBb = $this->request->getVar('nutrisiTurunBb');
                if ($nutrisiTurunBb == 1) {
                    $nutrisiTurunBb = 1;
                } else {
                    $nutrisiTurunBb = 0;
                }


                $nutrisiKurus = $this->request->getVar('nutrisiKurus');
                if ($nutrisiKurus == 1) {
                    $nutrisiKurus = 1;
                } else {
                    $nutrisiKurus = 0;
                }

                $nutrisiMuntahDiare = $this->request->getVar('nutrisiMuntahDiare');
                if ($nutrisiMuntahDiare == 1) {
                    $nutrisiMuntahDiare = 1;
                } else {
                    $nutrisiMuntahDiare = 0;
                }

                $nutrisiKondisiKhusus = $this->request->getVar('nutrisiKondisiKhusus');
                if ($nutrisiKondisiKhusus == 1) {
                    $nutrisiKondisiKhusus = 1;
                } else {
                    $nutrisiKondisiKhusus = 0;
                }

                $rujukAhliGizi = $this->request->getVar('rujukAhliGizi');
                if ($rujukAhliGizi == 1) {
                    $rujukAhliGizi = 1;
                } else {
                    $rujukAhliGizi = 0;
                }


                $fungsionalAlatBantu = $this->request->getVar('fungsionalAlatBantu');
                if ($fungsionalAlatBantu == 1) {
                    $fungsionalAlatBantu = 1;
                } else {
                    $fungsionalAlatBantu = 0;
                }

                $fungsionalProthesis = $this->request->getVar('fungsionalProthesis');
                if ($fungsionalProthesis == 1) {
                    $fungsionalProthesis = 1;
                } else {
                    $fungsionalProthesis = 0;
                }

                $fungsionalAdl = $this->request->getVar('fungsionalAdl');
                if ($fungsionalAdl == 1) {
                    $fungsionalAdl = 1;
                } else {
                    $fungsionalAdl = 0;
                }


                $fungsionalRiwayatJatuh = $this->request->getVar('fungsionalRiwayatJatuh');
                if ($fungsionalRiwayatJatuh == 1) {
                    $fungsionalRiwayatJatuh = 1;
                } else {
                    $fungsionalRiwayatJatuh = 0;
                }

                $caraBerjalan = $this->request->getVar('caraBerjalan');
                if ($caraBerjalan == 1) {
                    $caraBerjalan = 1;
                } else {
                    $caraBerjalan = 0;
                }

                $dudukMenopang = $this->request->getVar('dudukMenopang');
                if ($dudukMenopang == 1) {
                    $dudukMenopang = 1;
                } else {
                    $dudukMenopang = 0;
                }

                $uraianAskep = nl2br($this->request->getVar('uraianAskep'));



                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'bb' => $this->request->getVar('bb'),
                    'tb' => $this->request->getVar('tb'),
                    'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                    'tdSistolik' => $this->request->getVar('tdSistolik'),
                    'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                    'suhu' => $this->request->getVar('suhu'),
                    'frekuensiNafas' => $this->request->getVar('frekuensiNafas'),
                    'skalaNyeri' => $this->request->getVar('skalaNyeri'),
                    'psikologisTak' => $psikologisTak,
                    'psikologisTakut' => $psikologisTakut,
                    'psikologisSedih' => $psikologisSedih,
                    'psikologisRendahDiri' => $psikologisRendahDiri,
                    'psikologisMarah' => $psikologisMarah,
                    'psikologisMudahTersinggung' => $psikologisMudahTersinggung,
                    'sosiologisTak' => $sosiologisTak,
                    'sosiologisIsolasi' => $sosiologisIsolasi,
                    'sosiologisLain' => $sosiologisLain,
                    'spritualTak' => $spritualTak,
                    'spiritualPerluDibantu' => $spiritualPerluDibantu,
                    'spiritualAgama' => $spiritualAgama,
                    'Alergi' => $Alergi,
                    'uraianAlergi' => $uraianAlergi,
                    'nutrisiTurunBb' => $nutrisiTurunBb,
                    'nutrisiKurus' => $nutrisiKurus,
                    'nutrisiMuntahDiare' => $nutrisiMuntahDiare,
                    'nutrisiKondisiKhusus' => $nutrisiKondisiKhusus,
                    'uraianKondisiKhusus' => $this->request->getVar('uraianKondisiKhusus'),
                    'rujukAhliGizi' => $rujukAhliGizi,
                    'fungsionalAlatBantu' => $fungsionalAlatBantu,
                    'fungsionalNamaAlatBantu' => $this->request->getVar('fungsionalNamaAlatBantu'),
                    'fungsionalProthesis' => $fungsionalProthesis,
                    'fungsionalCacatTubuh' => $this->request->getVar('fungsionalCacatTubuh'),
                    'fungsionalAdl' => $fungsionalAdl,
                    'fungsionalRiwayatJatuh' => $fungsionalRiwayatJatuh,
                    'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                    'uraianAskep' => $uraianAskep,
                    'createdBy' => $this->request->getVar('createdBy'),
                    'createddate' => $this->request->getVar('createddate'),
                    'paramedicName' => $this->request->getVar('paramedicName'),
                    'keluhanUtama' => $this->request->getVar('keluhanUtama'),
                    'kesadaran' => $this->request->getVar('kesadaran'),
                    'caraBerjalan' => $caraBerjalan,
                    'dudukMenopang' => $dudukMenopang,
                    'skoringJatuh' => $this->request->getVar('skoringJatuh'),
                    'sasaranRencana' => $this->request->getVar('sasaranRencana'),
                    'namaSuami'  => $this->request->getVar('namaSuami'),
                    'umurSuami'  => $this->request->getVar('umurSuami'),
                    'pendidikanSuami'  => $this->request->getVar('pendidikanSuami'),
                    'pekerjaanSuami'  => $this->request->getVar('pekerjaanSuami'),
                    'alamatSuami'  => $this->request->getVar('alamatSuami'),
                    'lla'  => $this->request->getVar('lla'),
                    'bmt'  => $this->request->getVar('bmt'),
                    'hpht'  => $this->request->getVar('hpht'),
                    'usiaKehamilan'  => $this->request->getVar('usiaKehamilan'),
                    'riwayatKb'  => $this->request->getVar('riwayatKb'),
                    'tanggalKunjunganPertama'  => $this->request->getVar('tanggalKunjunganPertama'),
                    'kehamilan'  => $this->request->getVar('kehamilan'),
                    'penolongPersalinan'  => $this->request->getVar('penolongPersalinan'),
                    'jenisPersalinan'  => $this->request->getVar('jenisPersalinan'),
                    'masalahPersalinan'  => $this->request->getVar('masalahPersalinan'),
                    'keadaanBayi'  => $this->request->getVar('keadaanBayi'),
                    'menarche'  => $this->request->getVar('menarche'),
                    'lamaHaid'  => $this->request->getVar('lamaHaid'),
                    'siklusHaid'  => $this->request->getVar('siklusHaid'),
                    'jumlahDarah'  => $this->request->getVar('jumlahDarah'),
                    'keluhanHaid'  => $this->request->getVar('keluhanHaid'),
                    'keluhanFluorAlbus'  => $this->request->getVar('keluhanFluorAlbus'),
                    'keluhanperdarahan'  => $this->request->getVar('keluhanperdarahan'),
                    'keluhanBabBak'  => $this->request->getVar('keluhanBabBak'),
                    'keluhanAir'  => $this->request->getVar('keluhanAir'),
                    'keluhanHis'  => $this->request->getVar('keluhanHis'),
                    'keluhanGerakAnak'  => $this->request->getVar('keluhanGerakAnak'),
                    'anc'  => $this->request->getVar('anc'),
                    'djj'  => $this->request->getVar('djj'),
                    'lokasiAnc'  => $this->request->getVar('lokasiAnc'),
                    'tripleEliminasi'  => $this->request->getVar('tripleEliminasi'),
                    'tfuObstetri'  => $this->request->getVar('tfuObstetri'),
                    'bjaObstetri'  => $this->request->getVar('bjaObstetri'),
                    'hisObstetri'  => $this->request->getVar('hisObstetri'),
                    'leopold1'  => $this->request->getVar('leopold1'),
                    'leopold2'  => $this->request->getVar('leopold2'),
                    'leopold3'  => $this->request->getVar('leopold3'),
                    'leopold4'  => $this->request->getVar('leopold4'),
                    'pemeriksaanInspekulo'  => $this->request->getVar('pemeriksaanInspekulo'),
                    'pemeriksaanDalam'  => $this->request->getVar('pemeriksaanDalam'),
                    'pemeriksaanPanggul'  => $this->request->getVar('pemeriksaanPanggul'),
                    'inspeksiGinekologi'  => $this->request->getVar('inspeksiGinekologi'),
                    'palpasiGinekologi'  => $this->request->getVar('palpasiGinekologi'),
                    'perkusiGinekologi'  => $this->request->getVar('perkusiGinekologi'),
                    'auskyltasiGinekologi'  => $this->request->getVar('auskyltasiGinekologi'),
                    'deskripsiTumorGinekologi'  => $this->request->getVar('deskripsiTumorGinekologi'),
                    'letakBesarGinekologi'  => $this->request->getVar('letakBesarGinekologi'),
                    'batasPermukaanGinekolog'  => $this->request->getVar('batasPermukaanGinekolog'),
                    'PergerakanGinekologi'  => $this->request->getVar('PergerakanGinekologi'),
                    'nyeriTekanGinekologi'  => $this->request->getVar('nyeriTekanGinekologi'),
                    'lainGinekologi'  => $this->request->getVar('lainGinekologi'),
                ];

                $perawat = new ModelPelayananPoliRME;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function EdukasiPraBedah()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('id');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $cppt = $resume->get_diagnosa_pra_bedah($referencenumber);

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'admissionDateTime' => $row['createddate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'transport_transfer' => $this->transport(),
                'derajat_transfer' => $this->derajat(),
                'diagnosis' => $cppt['diagnosis'],
                'groups' => $row['groups'],


            ];

            $msg = [
                'sukses' => view('rme/modal_edukasi_pra_bedah', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanEdukasiPraBedah()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pemberInformasi' => [
                    'label' => 'Jam Transfer',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'pemberInformasi' => $validation->getError('pemberInformasi')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM edukasi_pra_bedah_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRJ-RME';
                $groups = $this->request->getVar('groups');
                $rme = $groups . '-RME';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $simpandata = [
                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi_edukasi'),
                    'pasienid' => $this->request->getVar('pasienid_edukasi'),
                    'pasienname' => $this->request->getVar('pasienname_edukasi'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname_edukasi'),
                    'poliklinikname' => $this->request->getVar('poliklinikname_edukasi'),
                    'admissionDate' => $this->request->getVar('admissionDate_edukasi'),
                    'doktername' => $this->request->getVar('doktername_edukasi'),
                    'createdBy' => $this->request->getVar('createdBy_edukasi'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'paramedicName' => $this->request->getVar('paramedicName_edukasi'),
                    'admissionDateTime' => $this->request->getVar('admissionDateTime_edukasi'),
                    'diagnosis' => $this->request->getVar('diagnosis_edukasi'),
                    'dokterOperator' => $this->request->getVar('dokterOperator'),
                    'pemberInformasi' => $this->request->getVar('pemberInformasi'),
                    'penerimaInformasi' => $this->request->getVar('penerimaInformasi'),
                    'kondisiPasien' => $this->request->getVar('kondisiPasien'),
                    'tindakan' => $this->request->getVar('tindakan'),
                    'manfaatTindakan' => $this->request->getVar('manfaatTindakan'),
                    'uraianProsedur' => $this->request->getVar('uraianProsedur'),
                    'risikoTindakan' => $this->request->getVar('risikoTindakan'),
                    'komplikasiTindakan' => $this->request->getVar('komplikasiTindakan'),
                    'dampakTindakan' => $this->request->getVar('dampakTindakan'),
                    'prognosisTindakan' => $this->request->getVar('prognosisTindakan'),
                    'alternatifTindakan' => $this->request->getVar('alternatifTindakan'),
                    'bilaTidakDitindak' => $this->request->getVar('bilaTidakDitindak'),
                ];

                $perawat = new ModelPelayananPoliRMEEdukasiPraBedah;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function PascaBedah()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/register_pasca_bedah_medis_rme', $data);
    }

    public function ambildataRMEPascaBedah()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataibs_pasca_bedah()
            ];
            $msg = [
                'data' => view('rme/dataregister_asesmen_medis_pasca_bedah_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEPascaBedah()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_ranap_rme_dokter($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME IGD',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
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
                'classroom' => '',
                'classroomname' => '',
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
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
            ];
            $msg = [
                'sukses' => view('rme/modalrme_ranap_medis', $data)
            ];
            return json_encode($msg);
        }
    }

    public function entriRMEMedisPascaBedah()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $ibs = $m_icd->get_data_pasien_ranap_rme_bedah($id);
            $referencenumber = $ibs['referencenumber'];
            $row = $m_icd->get_data_pasien_ranap_rme_dokter_bedah($referencenumber);

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME IGD',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
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
                'classroom' => '',
                'classroomname' => '',
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
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
            ];
            $msg = [
                'sukses' => view('rme/modalrme_ranap_medis_pasca_bedah', $data)
            ];
            return json_encode($msg);
        }
    }

    public function LOKatarak()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IRJ";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_ranap_rme($referencenumber);
            $data = [
                'referencenumber' => $row['referencenumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'poliklinik' => $row['room'],
                'poliklinikname' => $row['roomname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'referencenumber' => $row['referencenumber'],
                'admissionDate' => $row['datein'],
                'anesthesia' => $this->anesthesia(),
                'approach' => $this->approach(),
                'capsulotomy' => $this->capsulotomy(),
                'nucleus' => $this->nucleus(),
                'phaco' => $this->phaco(),
                'iol' => $this->iol(),
                'stitch' => $this->stitch(),
                'perawat_katarak' => $this->perawat_katarak(),

            ];
            $msg = [
                'sukses' => view('rme/modalcreate_lo_katarak', $data)
            ];
            return json_encode($msg);
        }
    }

    public function anesthesia()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_anesthesia();
        return $list;
    }
    public function approach()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_approach();
        return $list;
    }
    public function capsulotomy()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_capsulotomy();
        return $list;
    }
    public function nucleus()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_nucleus();
        return $list;
    }

    public function phaco()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_phaco();
        return $list;
    }
    public function iol()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_iol();
        return $list;
    }
    public function stitch()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_stitch();
        return $list;
    }

    public function perawat_katarak()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_perawat_katarak_rme();
        return $list;
    }

    public function skin()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_skin();
        return $list;
    }

    public function jenisPembedahan()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_jenisPembedahan();
        return $list;
    }
    public function kamarOperasi()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_kamar_operasi();
        return $list;
    }

    public function simpanLOKatarak()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'createdBy' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'createdBy' => $validation->getError('createdBy')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM laporan_operasi_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IBS-RME';
                $groups = 'IRI';
                $underscore = '_';

                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'od' => $this->request->getVar('od'),
                    'os' => $this->request->getVar('os'),
                    'cataractGrade' => $this->request->getVar('cataractGrade'),
                    'noteOp' => $this->request->getVar('noteOp'),
                    'ucva' => $this->request->getVar('ucva'),
                    'bcva' => $this->request->getVar('bcva'),
                    'retinometry' => $this->request->getVar('retinometry'),
                    'k1' => $this->request->getVar('k1'),
                    'k2' => $this->request->getVar('k2'),
                    'axl' => $this->request->getVar('axl'),
                    'acd' => $this->request->getVar('acd'),
                    'lt' => $this->request->getVar('lt'),
                    'formula' => $this->request->getVar('formula'),
                    'emetropia' => $this->request->getVar('emetropia'),
                    'visus' => $this->request->getVar('visus'),
                    'intraOperativeDate' => $this->request->getVar('intraOperativeDate'),
                    'intraOperativeTime' => $this->request->getVar('intraOperativeTime'),
                    'typeOperasi' => $this->request->getVar('typeOperasi'),
                    'anesthesilogist' => $this->request->getVar('anesthesilogist'),
                    'scrub' => $this->request->getVar('scrub'),
                    'cukator' => $this->request->getVar('cukator'),
                    'anestehesia' => $this->request->getVar('anestehesia'),
                    'approach' => $this->request->getVar('approach'),
                    'capsulotomy' => $this->request->getVar('capsulotomy'),
                    'hydrodissection' => $this->request->getVar('hydrodissection'),
                    'nucleus' => $this->request->getVar('nucleus'),
                    'phaco' => $this->request->getVar('phaco'),
                    'iol' => $this->request->getVar('iol'),
                    'stitch' => $this->request->getVar('stitch'),
                    'phacoMachine' => $this->request->getVar('phacoMachine'),
                    'phacoTime' => $this->request->getVar('phacoTime'),
                    'irigatingSolution' => $this->request->getVar('irigatingSolution'),
                    'komplikasi' => $this->request->getVar('komplikasi'),
                    'posterior' => $this->request->getVar('posterior'),
                    'vitreus' => $this->request->getVar('vitreus'),
                    'vitrectomy' => $this->request->getVar('vitrectomy'),
                    'retained' => $this->request->getVar('retained'),
                    'cortex' => $this->request->getVar('cortex'),
                    'katarak' => 1,

                ];

                $perawat = new ModelLaporanOperasiRME;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function WLMDRajal()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme_wlmdrajal', $data);
    }

    public function ambildataWLMDRajal()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataWLMDRajal()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlmdrajal', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliWLMDRajal()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajalWLMDRajal($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlmdrajal', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function WLMDIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme_wlmdigd', $data);
    }

    public function ambildataWLMDIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataWLMDIgd()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlmdigd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliWLMDIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajalWLMDIgd($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlmdigd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function WLPIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme_wlpigd', $data);
    }

    public function ambildataWLPIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataWLPIgd()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlpigd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliWLPIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajalWLPIgd($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlpigd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function WLPRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme_wlpranap', $data);
    }

    public function ambildataWLPRanap()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataWLPRanap()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlpranap', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliWLPRanap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajalWLPRanap($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlpranap', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function WLMDRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerpoliklinik_rme_wlmdranap', $data);
    }

    public function ambildataWLMDRanap()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataWLMDRanap()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlmdranap', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliWLMDRanap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajalWLMDRanap($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_wlmdranap', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function EdukasiPraBedahRanap()
    {
        if ($this->request->isAJAX()) {
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('id');
            $row = $resume->get_data_pasien_ranap_rme_bedah_pra($referencenumber);
            $cppt = $resume->get_diagnosa_pra_bedah($referencenumber);

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'admissionDateTime' => $row['createddate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'airway' => $this->airway_detail(),
                'breathing' => $this->breathing(),
                'circulation' => $this->circulation(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'suaraNafas' => $this->suaraNafas_detail(),
                'polaNafas' => $this->polaNafas_detail(),
                'bunyiNafas' => $this->bunyiNafas_detail(),
                'iramaNafas' => $this->iramaNafas_detail(),
                'tandaDistressNafas' => $this->tandaDistressNafas_detail(),
                'akral' => $this->akral_detail(),
                'sianosis' => $this->sianosis_detail(),
                'kapiler' => $this->kapiler_detail(),
                'kelembapan' => $this->kelembapan_detail(),
                'turgor' => $this->turgor_detail(),
                'pupil' => $this->pupil_detail(),
                'asesmen' => $this->asesmen_detail(),
                'provokes' => $this->provokes_detail(),
                'quality' => $this->quality_detail(),
                'severity' => $this->severity_detail(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'turunbb' => $this->turunbb_detail(),
                'transport_transfer' => $this->transport(),
                'derajat_transfer' => $this->derajat(),
                'diagnosis' => $cppt['diagnosis'],
                'groups' => $row['groups'],


            ];

            $msg = [
                'sukses' => view('rme/modal_edukasi_pra_bedah_ranap', $data)
            ];
            return json_encode($msg);
        }
    }

    public function printLaporanOperasiKatarak()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();

        $data = [
            'kop' => $pasien->get_data_kasir2($lokasikasir),
            'kunjungan_pasien_ranap' => $pasien->get_data_pasien_rme_ranap($referencenumber),
            'data_laporan_ok_katarak' => $pasien->get_lo_katarak($referencenumber)
        ];

        return view('rme/laporan_operasi_katarak', $data);
    }

    public function PraBedah()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/register_pra_bedah_medis_rme', $data);
    }

    public function ambildataRMEPraBedah()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataibs_pra_bedah()
            ];
            $msg = [
                'data' => view('rme/dataregister_asesmen_medis_pra_bedah_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMedisPraBedah()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $ibs = $m_icd->get_data_pasien_ranap_rme_bedah($id);
            $referencenumber = $ibs['referencenumber'];
            $row = $m_icd->get_data_pasien_ranap_rme_dokter_bedah($referencenumber);

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME IGD',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
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
                'classroom' => '',
                'classroomname' => '',
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
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
            ];
            $msg = [
                'sukses' => view('rme/modalrme_ranap_medis_pra_bedah', $data)
            ];
            return json_encode($msg);
        }
    }

    public function AsesmenPraBedah()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_ranap_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            $file = 'rme/asesmen_awal_pra_bedah';
            $asesmen_perawat = $resume->get_data_asesmen_perawat_ranap_rme_view($referencenumber);



            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['referencenumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['roomname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'classroom' => $row['classroom'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'konsultasi' => $this->data_konsultasi(),
                'tindaklanjut' => $this->data_tindak_lanjut(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'admissionDateTime' => $asesmen_perawat['admissionDateTime'],
                'kondisiPasien' =>  $asesmen_perawat['kondisiPasien'],
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'DiagnosaAskep' =>  $asesmen_perawat['DiagnosaAskep'],
                'uraianAskep' =>  $asesmen_perawat['uraianAskep'],
                'implementasiAskep' =>  $asesmen_perawat['implementasiAskep'],
                'sasaranRencana' => $asesmen_perawat['sasaranRencana'],
                'asalPasien' => $this->asalpasienRME(),
                'master_ats' => $this->AtsRME(),
                'keadaanUmum' => $asesmen_perawat['keadaanUmum'],
                'alasanRujuk' => $this->AlasanRujuk(),
                'mobil' => $this->mobil(),
                'nutrisi' => $this->nutrisi(),
                'konsul' => $this->konsul(),
                'riwayat' => $this->riwayat(),
                'resiko' => $this->resiko(),

            ];

            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function nutrisi()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_nutrisi_rme();
        return $list;
    }
    public function konsul()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_konsul_rme();
        return $list;
    }

    public function riwayat()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_riwayat_rme();
        return $list;
    }

    public function resiko()
    {

        $m_auto = new ModelPelayananPoliRME();
        $list = $m_auto->get_list_resiko_rme();
        return $list;
    }

    public function cariDiagnosaAskep()
    {
        if ($this->request->isAJAX()) {
            $diagnosa = $this->request->getVar('rektal');
            $askep = new ModelPelayananPoliRME();
            $data = [
                'list_askep' => $askep->get_list_diagnosa_askep(),

            ];
            $msg = [
                'sukses' => view('rme/modalpilihdiagnosaaskep', $data)
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function MedisRanapPulang()
    {
        $model_dokter = new ModelDokter();

        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'list_dokter' => $model_dokter->select('types, code, name')->findAll()
        ];
        return view('rme/register_asesmen_medis_ranap_pulang_rme', $data);
    }

    public function ambildataRMEMedisRanapPulang()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataranap_pulang_exist()
            ];
            $msg = [
                'data' => view('rme/dataregister_asesmen_medis_ranap_pulang_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMedisRanapPulang()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_ranap_rme_dokter_pulang($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME IGD',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
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
                'classroom' => '',
                'classroomname' => '',
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
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => '',
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
            ];
            $msg = [
                'sukses' => view('rme/modalrme_ranap_medis_pulang', $data)
            ];
            return json_encode($msg);
        }
    }

    public function AsesmenPulangMedisRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_ranap_rme_pulang($referencenumber);
            $pjb = $resume->get_data_pasien_ranap_rme_pulang_pjb($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULUT") {
                $file = 'rme/asesmen_awal_medis_gigi';
            } else {
                $file = 'rme/asesmen_awal_medis_umum_ranap_pulang';
            }



            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['referencenumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['roomname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'classroom' => $row['classroom'],
                'tanggalMasuk' => $row['datein'],
                'tanggalPulang' => $row['dateout'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'konsultasi' => $this->data_konsultasi(),
                'tindaklanjut' => $this->data_tindak_lanjut(),
                'list' => $this->_data_dokter(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),

                'asalPasien' => $this->asalpasienRME(),
                'master_ats' => $this->AtsRME(),

                'alasanRujuk' => $this->AlasanRujuk(),
                'mobil' => $this->mobil(),
                'admissionDateTime' => $row['datetimein'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'lastRoomName' => $row['roomname'],
                'namaPjb' => $pjb['namapjb'],

            ];

            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanAsesmenMedisRanapPulang()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'createdBy' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'createdBy' => $validation->getError('createdBy')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_pulang_ranap_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRI-RME';
                $groups = 'IRI';
                $underscore = '_';

                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $tanggalKontrol = $this->request->getVar('tanggalKontrol');
                $kontrol = str_replace('/', '-', $tanggalKontrol);
                $tglkontrol = date('Y-m-d', strtotime($kontrol));

                $id = $this->request->getVar('id');
                if ($id == "") {

                    $simpandata = [

                        'groups' => $groups,
                        'registernumber' => $newkode,
                        'referencenumber' => $this->request->getVar('nomorreferensi'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                        'poliklinikname' => $this->request->getVar('poliklinikname'),
                        'admissionDate' => $this->request->getVar('admissionDate'),
                        'doktername' => $this->request->getVar('doktername'),
                        'createddate' => date('Y-m-d G:i:s'),
                        'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                        'pasienage' => $this->request->getVar('pasienage'),
                        'diagnosisMasuk' => $this->request->getVar('diagnosisMasuk'),
                        'lastRoom' => $this->request->getVar('lastRoom'),
                        'dateIn' => $this->request->getVar('dateIn'),
                        'dateOut' => $this->request->getVar('dateOut'),
                        'namaPjb' => $this->request->getVar('namaPjb'),
                        'alasanRawat' => $this->request->getVar('alasanRawat'),
                        'pemeriksaanPenunjang' => $this->request->getVar('pemeriksaanPenunjang'),
                        'terapiSelamaRawat' => $this->request->getVar('terapiSelamaRawat'),
                        'perkembanganSetelahPerawatan' => $this->request->getVar('perkembanganSetelahPerawatan'),
                        'alergiObat' => $this->request->getVar('alergiObat'),
                        'kondisiWaktuKeluar' => $this->request->getVar('kondisiWaktuKeluar'),
                        'pengobatanDilanjutkan' => $this->request->getVar('pengobatanDilanjutkan'),
                        'tanggalKontrol' => $tglkontrol,
                        'diagnosisUtama' => $this->request->getVar('diagnosisUtama'),
                        'diagnosisSekunder' => $this->request->getVar('diagnosisSekunder'),
                        'prosedur' => $this->request->getVar('prosedur'),
                        'ringkasanRiwayatPenyakit' => $this->request->getVar('ringkasanRiwayatPenyakit'),
                        'hasilPemeriksaanFisik' => $this->request->getVar('hasilPemeriksaanFisik'),

                    ];

                    $perawat = new ModelAsesmenPasienPulangRME;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Simpan Berhasil',
                        'JN' => $newkode,

                    ];
                } else {
                    $simpandata = [

                        'groups' => $groups,
                        'registernumber' => $newkode,
                        'referencenumber' => $this->request->getVar('nomorreferensi'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                        'poliklinikname' => $this->request->getVar('poliklinikname'),
                        'admissionDate' => $this->request->getVar('admissionDate'),
                        'doktername' => $this->request->getVar('doktername'),
                        'createddate' => date('Y-m-d G:i:s'),
                        'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                        'pasienage' => $this->request->getVar('pasienage'),
                        'diagnosisMasuk' => $this->request->getVar('diagnosisMasuk'),
                        'lastRoom' => $this->request->getVar('lastRoom'),
                        'dateIn' => $this->request->getVar('dateIn'),
                        'dateOut' => $this->request->getVar('dateOut'),
                        'namaPjb' => $this->request->getVar('namaPjb'),
                        'alasanRawat' => $this->request->getVar('alasanRawat'),
                        'pemeriksaanPenunjang' => $this->request->getVar('pemeriksaanPenunjang'),
                        'terapiSelamaRawat' => $this->request->getVar('terapiSelamaRawat'),
                        'perkembanganSetelahPerawatan' => $this->request->getVar('perkembanganSetelahPerawatan'),
                        'alergiObat' => $this->request->getVar('alergiObat'),
                        'kondisiWaktuKeluar' => $this->request->getVar('kondisiWaktuKeluar'),
                        'pengobatanDilanjutkan' => $this->request->getVar('pengobatanDilanjutkan'),
                        'tanggalKontrol' => $tglkontrol,
                        'diagnosisUtama' => $this->request->getVar('diagnosisUtama'),
                        'diagnosisSekunder' => $this->request->getVar('diagnosisSekunder'),
                        'prosedur' => $this->request->getVar('prosedur'),
                        'ringkasanRiwayatPenyakit' => $this->request->getVar('ringkasanRiwayatPenyakit'),
                        'hasilPemeriksaanFisik' => $this->request->getVar('hasilPemeriksaanFisik'),

                    ];
                    $perawat = new ModelAsesmenPasienPulangRME;
                    $id = $this->request->getVar('id');
                    $perawat->update($id, $simpandata);
                    $msg = [
                        'sukses' => 'Update Berhasil',
                        'JN' => $newkode,

                    ];
                }
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderEresepPulang()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('id');
            $cekregister = new ModelPelayananPoliRME;
            $groups = 'RI';
            $hasilcek = $cekregister->get_data_cek_farmasi_pulang_rme($referencenumber, $groups);
            $cekdulu = isset($hasilcek['pasienid']) != null ? $hasilcek['pasienid'] : "";

            $groups = "RI";
            $db = db_connect();
            $locationcode = 'DEPORINAP';
            $locationname = 'DEPO RAWAT INAP';

            $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header  ORDER BY id desc LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
                $antrian = $row->noantrian;
            }


            $underscore = '_';
            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }

            if ($antrian == "") {
                $nourutantrian = '1';
            } else {
                $nourutantrian = (int)($antrian);
                $nourutantrian++;
            }


            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme_ranap($referencenumber);


            $tanda = 'RRI';
            $documentdate = date('Y-m-d');
            $today = date('ymd', strtotime($documentdate));
            $pasienid = $row['pasienid'];
            $tahun = date('Y');
            $bulan = date('m');

            $newkode = $tanda . $underscore . $pasienid . $underscore . $locationcode . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $no_antrian = sprintf($nourutantrian);

            $documentdate = $documentdate;
            $karyawan = '';
            $dispensasi = '';
            $pasienid = $pasienid;
            $pasienname = $row['pasienname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $poliklinik = $row['room'];
            $poliklinikname = $row['roomname'];
            $poliklinikclass = '';
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $employee = 'NONE';
            $employeename = '';
            $tandamemo = '/';
            $memo = $doktername . $tandamemo . $paymentmethod;
            $locationname = $locationname;
            $ranap = 1;
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $tanggallahir = $pasiendateofbirth;
            $dob = strtotime($tanggallahir);
            $current_time = time();
            $age_years = date('Y', $current_time) - date('Y', $dob);
            $age_months = date('m', $current_time) - date('m', $dob);
            $age_days = date('d', $current_time) - date('d', $dob);

            $bpjs_sep = $row['bpjs_sep'];
            $pasienaddress = $row['pasienaddress'];
            $pasiengender = $row['pasiengender'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $paymentmethodori = $row['paymentmethodori'];
            $paymentmethodnameori = $row['paymentmethodnameori'];
            $paymentmethodnameori = $row['paymentmethodnameori'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];

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
            $groups = "RI";



            $lokasi = $row['poliklinik'];
            $documentdate = $row['documentdate'];

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
            }

            $today = date('ymd', strtotime($documentdate));
            $underscore = '_';

            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }


            $simpandata = [
                'isenaranap' => $ranap,
                'groups' => $groups,
                'journalnumber' => $newkode,
                'documentdate' => date('Y-m-d'),
                'documentyear' => $tahun,
                'documentmonth' => $bulan,
                'noreg' => $referencenumber,
                'referencenumber' => $referencenumber,
                'bpjs_sep' => $bpjs_sep,
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'dateofbirth' => $tanggallahir,
                'pasienage' => $umur,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'karyawan' => $karyawan,
                'dispensasi' => $dispensasi,
                'dispensasipejabat' => '',
                'dispensasialasan' => '',
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'paymentcardnumber' => $paymentcardnumber,
                'paymentmethodori' => $paymentmethodori,
                'paymentmethodnameori' => $paymentmethodnameori,
                'paymentcardnumberori' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'poliklinikclass' => $poliklinikclass,
                'poliklinikclassname' => '',
                'bednumber' => '',
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => $employee,
                'employeename' => $employeename,
                'locationcode' => $locationcode,
                'locationname' => $locationname,
                'numberseq' => $no_antrian,
                'createdby' => session()->get('firstname'),
                'createddate' => date('Y-m-d G:i:s'),
                'eresep' => 1,
                'terapiPulang' => 1,
            ];


            $perawat = new ModelFarmasiPelayananHeader();
            $perawat->insert($simpandata);
            $resume = new ModelTerimaPBFDetail();
            $data = [
                'journalnumber' => $newkode,
                'documentdate' => date('Y-m-d'),
                'karyawan' => $karyawan,
                'dispensasi' => $dispensasi,
                'relation' => $pasienid,
                'relationname' => $pasienname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'poliklinikclass' => $poliklinikclass,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => $employee,
                'employeename' => $employeename,
                'referencenumber' => $memo,
                'locationcode' => $locationcode,
                'locationname' => $locationname,
                'racikan' => $this->racikan_rme(),
                'itemracikan' => $this->itemracikan(),
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),

            ];
            $msg = [
                'sukses' => view('rme/modalinputereseppulang_rme', $data)
            ];
            return json_encode($msg);
        }
    }



    public function asesmenPulangRanap()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IRI";
            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('id');

            $row = $resume->get_data_pasien_ranap_rme_akan_pulang($referencenumber);
            $pjb = $resume->get_data_pasien_ranap_rme_pulang_pjb($referencenumber);
            $cek_resume_pulang = $resume->get_cek_resume_pulang_ranap($referencenumber);

            $diagnosisMasuk = isset($cek_resume_pulang['diagnosisMasuk']) != null ? $cek_resume_pulang['diagnosisMasuk'] : "";
            $lastRoom = isset($cek_resume_pulang['lastRoom']) != null ? $cek_resume_pulang['lastRoom'] : "";
            $alasanRawat = isset($cek_resume_pulang['alasanRawat']) != null ? $cek_resume_pulang['alasanRawat'] : "";
            $pemeriksaanPenunjang = isset($cek_resume_pulang['pemeriksaanPenunjang']) != null ? $cek_resume_pulang['pemeriksaanPenunjang'] : "";
            $terapiSelamaRawat = isset($cek_resume_pulang['terapiSelamaRawat']) != null ? $cek_resume_pulang['terapiSelamaRawat'] : "";
            $perkembanganSetelahPerawatan = isset($cek_resume_pulang['perkembanganSetelahPerawatan']) != null ? $cek_resume_pulang['perkembanganSetelahPerawatan'] : "";
            $alergiObat = isset($cek_resume_pulang['alergiObat']) != null ? $cek_resume_pulang['alergiObat'] : "";
            $kondisiWaktuKeluar = isset($cek_resume_pulang['kondisiWaktuKeluar']) != null ? $cek_resume_pulang['kondisiWaktuKeluar'] : "";
            $pengobatanDilanjutkan = isset($cek_resume_pulang['pengobatanDilanjutkan']) != null ? $cek_resume_pulang['pengobatanDilanjutkan'] : "";
            $tanggalKontrol = isset($cek_resume_pulang['tanggalKontrol']) != null ? $cek_resume_pulang['tanggalKontrol'] : "";
            $diagnosisUtama = isset($cek_resume_pulang['diagnosisUtama']) != null ? $cek_resume_pulang['diagnosisUtama'] : "";
            $diagnosisSekunder = isset($cek_resume_pulang['diagnosisSekunder']) != null ? $cek_resume_pulang['diagnosisSekunder'] : "";
            $prosedur = isset($cek_resume_pulang['prosedur']) != null ? $cek_resume_pulang['prosedur'] : "";
            $ringkasanRiwayatPenyakit = isset($cek_resume_pulang['ringkasanRiwayatPenyakit']) != null ? $cek_resume_pulang['ringkasanRiwayatPenyakit'] : "";
            $hasilPemeriksaanFisik = isset($cek_resume_pulang['hasilPemeriksaanFisik']) != null ? $cek_resume_pulang['hasilPemeriksaanFisik'] : "";
            $id = isset($cek_resume_pulang['id']) != null ? $cek_resume_pulang['id'] : "";


            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['referencenumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['roomname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'classroom' => $row['classroom'],
                'tanggalMasuk' => $row['datein'],
                'tanggalPulang' => $row['dateout'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'konsultasi' => $this->data_konsultasi(),
                'tindaklanjut' => $this->data_tindak_lanjut(),
                'list' => $this->_data_dokter(),
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'asalPasien' => $this->asalpasienRME(),
                'master_ats' => $this->AtsRME(),
                'alasanRujuk' => $this->AlasanRujuk(),
                'mobil' => $this->mobil(),
                'admissionDateTime' => $row['datetimein'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'lastRoomName' => $row['roomname'],
                'namaPjb' => $pjb['namapjb'],
                'diagnosisMasuk' => $diagnosisMasuk,
                'lastRoom' => $lastRoom,
                'diagnosisMasuk' => $diagnosisMasuk,
                'alasanRawat' => $alasanRawat,
                'pemeriksaanPenunjang' => $pemeriksaanPenunjang,
                'diagnosisMasuk' => $diagnosisMasuk,
                'terapiSelamaRawat' => $terapiSelamaRawat,
                'perkembanganSetelahPerawatan' => $perkembanganSetelahPerawatan,
                'alergiObat' => $alergiObat,
                'kondisiWaktuKeluar' => $kondisiWaktuKeluar,
                'pengobatanDilanjutkan' => $pengobatanDilanjutkan,
                'tanggalKontrol' => $tanggalKontrol,
                'diagnosisUtama' => $diagnosisUtama,
                'diagnosisSekunder' => $diagnosisSekunder,
                'prosedur' => $prosedur,
                'ringkasanRiwayatPenyakit' => $ringkasanRiwayatPenyakit,
                'hasilPemeriksaanFisik' => $hasilPemeriksaanFisik,
                'id' => $id,


            ];
            $msg = [
                'sukses' => view('rme/modal_asesmen_pulang_ranap', $data)
            ];
            return json_encode($msg);
        }
    }


    public function resumeOrderPenunjangRanap()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modalresumeorder_ranap', $data)
            ];
            return json_encode($msg);
        }
    }

    public function resumeOrderPenunjangRanap2()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $resume->get_list_resume_penunjang_ranap_2($referencenumber),
            ];
            $msg = [
                'data' => view('rme/data_resume_penunjang', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderEresepRanap()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('id');
            $cekregister = new ModelPelayananPoliRME;
            $groups = 'RI';

            $groups = "RI";
            $db = db_connect();
            $locationcode = 'DEPORINAP';
            $locationname = 'DEPO RAWAT INAP';

            $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header  ORDER BY id desc LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
                $antrian = $row->noantrian;
            }


            $underscore = '_';
            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }

            if ($antrian == "") {
                $nourutantrian = '1';
            } else {
                $nourutantrian = (int)($antrian);
                $nourutantrian++;
            }


            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme_ranap($referencenumber);


            $tanda = 'RRI';
            $documentdate = date('Y-m-d');
            $today = date('ymd', strtotime($documentdate));
            $pasienid = $row['pasienid'];
            $tahun = date('Y');
            $bulan = date('m');

            $newkode = $tanda . $underscore . $pasienid . $underscore . $locationcode . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $no_antrian = sprintf($nourutantrian);

            $documentdate = $documentdate;
            $karyawan = '';
            $dispensasi = '';
            $pasienid = $pasienid;
            $pasienname = $row['pasienname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $poliklinik = $row['room'];
            $poliklinikname = $row['roomname'];
            $poliklinikclass = '';
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $employee = 'NONE';
            $employeename = '';
            $tandamemo = '/';
            $memo = $doktername . $tandamemo . $paymentmethod;
            $locationname = $locationname;
            $ranap = 1;
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $tanggallahir = $pasiendateofbirth;
            $dob = strtotime($tanggallahir);
            $current_time = time();
            $age_years = date('Y', $current_time) - date('Y', $dob);
            $age_months = date('m', $current_time) - date('m', $dob);
            $age_days = date('d', $current_time) - date('d', $dob);

            $bpjs_sep = $row['bpjs_sep'];
            $pasienaddress = $row['pasienaddress'];
            $pasiengender = $row['pasiengender'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $paymentmethodori = $row['paymentmethodori'];
            $paymentmethodnameori = $row['paymentmethodnameori'];
            $paymentmethodnameori = $row['paymentmethodnameori'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];

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
            $groups = "RI";



            $lokasi = $row['poliklinik'];
            $documentdate = $row['documentdate'];

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
            }

            $today = date('ymd', strtotime($documentdate));
            $underscore = '_';

            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }


            $simpandata = [
                'isenaranap' => $ranap,
                'groups' => $groups,
                'journalnumber' => $newkode,
                'documentdate' => date('Y-m-d'),
                'documentyear' => date('Y'),
                'documentmonth' => $bulan,
                'noreg' => $referencenumber,
                'referencenumber' => $referencenumber,
                'bpjs_sep' => $bpjs_sep,
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'dateofbirth' => $tanggallahir,
                'pasienage' => $umur,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'karyawan' => $karyawan,
                'dispensasi' => $dispensasi,
                'dispensasipejabat' => '',
                'dispensasialasan' => '',
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'paymentcardnumber' => $paymentcardnumber,
                'paymentmethodori' => $paymentmethodori,
                'paymentmethodnameori' => $paymentmethodnameori,
                'paymentcardnumberori' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'poliklinikclass' => $poliklinikclass,
                'poliklinikclassname' => '',
                'bednumber' => '',
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => $employee,
                'employeename' => $employeename,
                'locationcode' => $locationcode,
                'locationname' => $locationname,
                'numberseq' => $no_antrian,
                'createdby' => session()->get('firstname'),
                'createddate' => date('Y-m-d G:i:s'),
                'eresep' => 1,
                'terapiPulang' => 0,
            ];


            $perawat = new ModelFarmasiPelayananHeader();
            $perawat->insert($simpandata);

            $resume = new ModelTerimaPBFDetail();
            $data = [
                'journalnumber' => $newkode,
                'documentdate' => $documentdate,
                'karyawan' => $karyawan,
                'dispensasi' => $dispensasi,
                'relation' => $pasienid,
                'relationname' => $pasienname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'poliklinikclass' => $poliklinikclass,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => $employee,
                'employeename' => $employeename,
                'referencenumber' => $referencenumber,
                'locationcode' => $locationcode,
                'locationname' => $locationname,
                'racikan' => $this->racikan_rme(),
                'itemracikan' => $this->itemracikan(),
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),

            ];

            $msg = [
                'sukses' => view('rme/modalinputeresepranap_rme', $data)
            ];
            return json_encode($msg);
        }
    }

    public function detaileResepRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $headerpelayanan = $resume->search_header_pelayanan($journalnumber);
            $data = [
                'DetailObat' => $resume->search_detail_pelayanan($journalnumber),
                'kodejournal' => $journalnumber,
                'validasilunas' => $headerpelayanan['validasilunas'],
                'luarpaketinacbg' => $headerpelayanan['luarpaketinacbg'],
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
                'referencenumber' => $headerpelayanan['referencenumber'],

            ];
            $msg = [
                'data' => view('rme/detail_eResepranap', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function LOGeneral()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IRJ";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_ranap_rme($referencenumber);
            $data = [
                'referencenumber' => $row['referencenumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'poliklinik' => $row['room'],
                'poliklinikname' => $row['roomname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'referencenumber' => $row['referencenumber'],
                'admissionDate' => $row['datein'],
                'anesthesia' => $this->anesthesia(),
                'approach' => $this->approach(),
                'capsulotomy' => $this->capsulotomy(),
                'nucleus' => $this->nucleus(),
                'phaco' => $this->phaco(),
                'iol' => $this->iol(),
                'stitch' => $this->stitch(),
                'perawat_katarak' => $this->perawat_katarak(),
                'skin' => $this->skin(),
                'jenisPembedahan' => $this->jenisPembedahan(),
                'asalRuangan' => $row['roomname'],
                'kamarOperasi' => $this->kamarOperasi(),

            ];
            $msg = [
                'sukses' => view('rme/modalcreate_lo_general', $data)
            ];
            return json_encode($msg);
        }
    }

    public function MobilisasiDanaRajal()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'pasienstatus' => $this->status_pasien(),
        ];
        return view('rme/registerpoliklinik_rme_mobilisasi_dana_rajal', $data);
    }

    public function ambildataMobilisasiDanaRajal()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterMobilisasiDanaRajal()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterpoliklinik_rme_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMobilisasiDana()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_poli($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME Rajal',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['journalnumber'],
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_rajal'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
                'nomorreferensi' => $row['journalnumber'],
                'verifikasimobdan' => $row['verifikasimobdan'],
                'verifikasidiagnosarajal' => $row['verifikasidiagnosarajal'],

            ];
            $msg = [
                'sukses' => view('rme/modalrmerajal_poliklinik_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        }
    }

    public function ArsipDigitalPoli()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            $pasienid = $row['pasienid'];
            $register = new ModelPelayananPoliRME();
            $master = $register->search_RiwayatPasien($pasienid);


            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
            }


            foreach ($master as $index => $row) {
                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['poliklinikname'] = $row['poliklinikname'];


                $detailTindakan = $register->search_tindakan_detail($id);

                $pem[$index]['list'] = [];
                foreach ($detailTindakan as $item) {

                    if ($item['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['list'][] = $item;
                    }
                }

                $detailDiagnosa = $register->search_diagnosa_detail($id);
                $pem[$index]['listDiagnosa'] = [];
                foreach ($detailDiagnosa as $itemDiagnosa) {

                    if ($itemDiagnosa['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listDiagnosa'][] = $itemDiagnosa;
                    }
                }

                $detailRadiologi = $register->search_rad_detail($id);
                $pem[$index]['listRad'] = [];
                foreach ($detailRadiologi as $itemRadiologi) {

                    if ($itemRadiologi['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listRad'][] = $itemRadiologi;
                    }
                }

                $detailLPK = $register->search_lpk_detail($id);
                $pem[$index]['listLpk'] = [];
                foreach ($detailLPK as $itemLPK) {

                    if ($itemLPK['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listLpk'][] = $itemLPK;
                    }
                }

                $detailLPA = $register->search_lpa_detail($id);
                $pem[$index]['listLpa'] = [];
                foreach ($detailLPA as $itemLPA) {

                    if ($itemLPA['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listLpa'][] = $itemLPA;
                    }
                }

                $detailResep = $register->search_resep_detail($id);
                $pem[$index]['listResep'] = [];
                foreach ($detailResep as $itemResep) {

                    if ($itemResep['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listResep'][] = $itemResep;
                    }
                }
            }

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'KB' => $this->kb(),
                'tampildata' => $pem,
                'referencenumber' => $referencenumber,

            ];
            $msg = [
                'data' => view('rme/arsip_digital_poli', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printResumeMedisRajal()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $kunjungan_pasien = $pasien->get_data_pasien_rme_rajal_resume($referencenumber);
        $resume_medis = $pasien->get_data_resume_medis_rajal($referencenumber);
        $diagnosa_primer_skunder = $pasien->get_data_diagnosa_primer_skunder_rajal($referencenumber);

        $resume = new ModelPelayananPoliRME();

        $cek_resume_medis = $resume->get_cek_resume_medis_rajal($referencenumber);
        $norm = isset($cek_resume_medis['pasienid']) != null ? $cek_resume_medis['pasienid'] : "";
        $cek_master_pasien = $resume->get_cek_master_pasien($referencenumber);
        $dob = isset($cek_master_pasien['pasiendateofbirth']) != null ? $cek_master_pasien['pasiendateofbirth'] : "";
        $nama = isset($cek_resume_medis['pasienname']) != null ? $cek_resume_medis['pasienname'] : "";
        $diagnosis = isset($cek_resume_medis['diagnosis']) != null ? $cek_resume_medis['diagnosis'] : "";
        $terapi = isset($cek_resume_medis['planning']) != null ? $cek_resume_medis['planning'] : "";
        $namaDokter = isset($cek_resume_medis['doktername']) != null ? $cek_resume_medis['doktername'] : "";
        $tanggalPeriksa = isset($cek_resume_medis['admissionDate']) != null ? $cek_resume_medis['admissionDate'] : "";
        $anamnesa = isset($cek_resume_medis['keluhanUtama']) != null ? $cek_resume_medis['keluhanUtama'] : "";
        $anamnesa = isset($cek_resume_medis['keluhanUtama']) != null ? $cek_resume_medis['keluhanUtama'] : "";
        $objective = isset($cek_resume_medis['objektive']) != null ? $cek_resume_medis['objektive'] : "";
        $dateResume = isset($cek_resume_medis['createddate']) != null ? $cek_resume_medis['createddate'] : "";
        $asesmen_bb = isset($cek_resume_medis['bb']) != null ? $cek_resume_medis['bb'] : "";
        $createddate = isset($cek_resume_medis['createddate']) != null ? $cek_resume_medis['createddate'] : "";
        $asesmen_tb = isset($cek_resume_medis['tb']) != null ? $cek_resume_medis['tb'] : "";
        $asesmen_frekuensiNadi = isset($cek_resume_medis['frekuensiNadi']) != null ? $cek_resume_medis['frekuensiNadi'] : "";
        $asesmen_tdSistolik = isset($cek_resume_medis['tdSistolik']) != null ? $cek_resume_medis['tdSistolik'] : "";
        $asesmen_tdDiastolik = isset($cek_resume_medis['tdDiastolik']) != null ? $cek_resume_medis['tdDiastolik'] : "";
        $asesmen_suhu = isset($cek_resume_medis['suhu']) != null ? $cek_resume_medis['suhu'] : "";
        $asesmen_frekuensiNafas = isset($cek_resume_medis['frekuensiNafas']) != null ? $cek_resume_medis['frekuensiNafas'] : "";


        $data = [
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'pasienid' => $kunjungan_pasien['pasienid'],
            'pasienname' => $kunjungan_pasien['pasienname'],
            'pasiengender' => $kunjungan_pasien['pasiengender'],
            'pasiendateofbirth' => $kunjungan_pasien['pasiendateofbirth'],
            'namapjb' => '',
            'roomname' => $kunjungan_pasien['poliklinikname'],
            'tanggalperiksa' => $kunjungan_pasien['documentdate'],
            'alasanRawat' => '',
            'pasienage' => $kunjungan_pasien['pasienage'],
            'diagnosis' => $diagnosis,
            'terapi' => $terapi,
            'poliklinik' => $kunjungan_pasien['poliklinikname'],
            'dokter' => $kunjungan_pasien['doktername'],
            'anamnesa' => $anamnesa,
            'objective' => $objective,
            'createddate' => $createddate,
            'asesmen_bb' => $asesmen_bb,
            'asesmen_tb' => $asesmen_tb,
            'asesmen_frekuensiNadi' => $asesmen_frekuensiNadi,
            'asesmen_tdSistolik' => $asesmen_tdSistolik,
            'asesmen_tdDiastolik' => $asesmen_tdDiastolik,
            'asesmen_suhu' => $asesmen_suhu,
            'asesmen_frekuensiNafas' => $asesmen_frekuensiNafas,
            'diagnosa_ps' => $pasien->get_data_diagnosa_primer_skunder_rajal($referencenumber),

            // 'diagnosa_ps' => $pasien->get_data_diagnosa_primer_skunder_rajal($referencenumber),

            // 'code_diagnosaprimer' => $diagnosa_primer_skunder['codeicdx'],
            // 'diagnosaprimer' => $diagnosa_primer_skunder['nameicdx'],
            // 'code_diagnosaskunder' => $diagnosa_primer_skunder['codeicdix'],
            // 'diagnosaskunder' => $diagnosa_primer_skunder['nameicdix'],


        ];

        $html = view('pdf/stylebootstrap');
        $html = view('rme/resume_medis_rajal', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printResumeMedisRajalmobdan()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page2');

        $pasien = new ModelPelayananPoliRME();
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $kunjungan_pasien = $pasien->get_data_pasien_rme_rajal_resume($referencenumber);
        $resume_medis = $pasien->get_data_resume_medis_rajalmobdan($referencenumber);

        $resume = new ModelPelayananPoliRME();

        $cek_resume_medis = $resume->get_cek_resume_medis_rajalmobdan($referencenumber);
        $norm = isset($cek_resume_medis['pasienid']) != null ? $cek_resume_medis['pasienid'] : "";
        $cek_master_pasien = $resume->get_cek_master_pasien($referencenumber);
        $dob = isset($cek_master_pasien['pasiendateofbirth']) != null ? $cek_master_pasien['pasiendateofbirth'] : "";
        $nama = isset($cek_resume_medis['pasienname']) != null ? $cek_resume_medis['pasienname'] : "";
        $diagnosis = isset($cek_resume_medis['diagnosis']) != null ? $cek_resume_medis['diagnosis'] : "";
        $terapi = isset($cek_resume_medis['planning']) != null ? $cek_resume_medis['planning'] : "";
        $namaDokter = isset($cek_resume_medis['doktername']) != null ? $cek_resume_medis['doktername'] : "";
        $tanggalPeriksa = isset($cek_resume_medis['admissionDate']) != null ? $cek_resume_medis['admissionDate'] : "";
        $anamnesa = isset($cek_resume_medis['keluhanUtama']) != null ? $cek_resume_medis['keluhanUtama'] : "";


        $data = [
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'pasienid' => $kunjungan_pasien['pasienid'],
            'pasienname' => $kunjungan_pasien['pasienname'],
            'pasiengender' => $kunjungan_pasien['pasiengender'],
            'pasiendateofbirth' => $kunjungan_pasien['pasiendateofbirth'],
            'namapjb' => '',
            'roomname' => $kunjungan_pasien['poliklinikname'],
            'tanggalperiksa' => $kunjungan_pasien['documentdate'],
            'alasanRawat' => '',
            'pasienage' => $kunjungan_pasien['pasienage'],
            'diagnosis' => $diagnosis,
            'terapi' => $terapi,
            'poliklinik' => $kunjungan_pasien['poliklinikname'],
            'dokter' => $kunjungan_pasien['doktername'],
            'anamnesa' => $anamnesa,


        ];



        $databarcode = $pasien->kunjunganrajal_pasienid($referencenumber);
        $pasienid_barcode = $databarcode['pasienid'];
        $pasienid = $databarcode['pasienid'];
        $datapasien = $pasien->data_pasienid($pasienid);

        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(55)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';
        // $data['agama'] = $datapasien['religion'];

        $html = view('pdf/stylebootstrap');
        $html = view('rme/resume_medis_rajal', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function PelayananResepRajal()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modal_pelayanan_farmasi_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        }
    }


    public function detaileResepRMERajal()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $headerpelayanan = $resume->search_header_pelayanan_rme_rajal($journalnumber);
            $journalnumber_resep = $headerpelayanan['journalnumber'];


            $data = [
                'DetailObat' => $resume->search_detail_pelayanan($journalnumber_resep),
                'kodejournal' => $journalnumber,
                'validasilunas' => $headerpelayanan['validasilunas'],
                'luarpaketinacbg' => $headerpelayanan['luarpaketinacbg'],
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
                'referencenumber' => $headerpelayanan['referencenumber'],
                'nomorjournal' => $journalnumber_resep,

            ];
            $msg = [
                'data' => view('rme/detail_eReseprajal_mobilisasi', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function PelayananRadRajal()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modal_pelayanan_rad_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        }
    }

    public function ExpertiseRad()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('journalnumber');

            $data = [
                'Radiologi' => $resume->search_rad_expertise($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_expertise_radiologi_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printexpertise()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "RADIOLOGI";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_expertise_rad($lokasikasir);
        $penunjangdetail = $pasien->tindakan_penunjang_detail_rad($id);
        $journalnumber = $penunjangdetail['journalnumber'];
        $headerpenunjang = $pasien->headerpenunjang($journalnumber);
        $expertise = $pasien->expertisepenunjang_rad($id);
        $detail = $pasien->tindakan_penunjang_rad($id);

        $namaDokter = $expertise['employeename'];

        $exp = new ModelPelayananPoliRME();
        $sipDokter = $exp->search_sip_dokter($namaDokter);
        $data = [
            'datapasien' => $pasien->headerpenunjang($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'expertiseid' => $expertise['expertiseid'],
            'Dokterrad' => $expertise['employeename'],
            'pacsnumber' => $expertise['pacsnumber'],
            'expertise' => $expertise['expertise'],
            'tanggalexpertise' => $expertise['created_at'],
            'createdby' => $expertise['createdby'],
            'pemeriksaan' => $detail['name'],
            'klinis' => $expertise['klinis'],
            'sip' => $sipDokter['sip'],
        ];


        $databarcode = $namaDokter . $sipDokter['sip'] . $expertise['createddate'] . $expertise['expertiseid'];
        $pasienid_barcode = $databarcode;
        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(70)
            ->setPadding(12)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))

            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';
        return view('cetakan/expertiseradiologi', $data);
    }

    public function printexpertiseKonvensional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "RADIOLOGI";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_expertise_rad($lokasikasir);
        $penunjangdetail = $pasien->tindakan_penunjang_detail_rad($id);
        $journalnumber = $penunjangdetail['journalnumber'];
        $headerpenunjang = $pasien->headerpenunjang($journalnumber);
        $expertise = $pasien->expertisepenunjang_rad($id);
        $detail = $pasien->tindakan_penunjang_rad($id);
        $data = [
            'datapasien' => $pasien->headerpenunjang($journalnumber),
            'kop' => $pasien->get_data_kasir2($lokasikasir),
            'kunjungan_pasien_ranap' => $pasien->get_data_pasien_rme_ranap($referencenumber),
            'resume_medis_ranap' => $pasien->get_data_resume_medis_ranap($referencenumber),
            'expertise' =>  $pasien->expertisepenunjang_rad($referencenumber)

        ];
        return view('cetakan/expertiseradiologi', $data);
    }

    public function PelayananLpkRajal()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modal_pelayanan_lpk_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        }
    }

    public function ExpertiseLpk()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('journalnumber');

            $data = [
                'Radiologi' => $resume->search_lpk_expertise($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_expertise_lpk_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function MobilisasiDanaIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'pasienstatus' => $this->status_pasien(),
        ];
        return view('rme/registerigd_rme_mobilisasi_dana_rajal', $data);
    }

    public function ambildataMobilisasiDanaIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataigd()
            ];
            $msg = [
                'data' => view('rme/dataregisterigd_rme_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterMobilisasiDanaIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterigdMobDana($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterigd_rme_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMobilisasiDanaIGD()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_poli($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME Rajal',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['journalnumber'],
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => $row['token_rajal'],
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
                'nomorreferensi' => $row['journalnumber'],
                'verifikasimobdan' => $row['verifikasimobdan'],
                'verifikasidiagnosarajal' => $row['verifikasidiagnosarajal'],


            ];
            $msg = [
                'sukses' => view('rme/modalrmerajal_igd_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        }
    }

    public function MobilisasiDanaRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerranap_rme_mobilisasi_dana', $data);
    }

    public function ambildataMobilisasiDanaRanap()
    {
        if ($this->request->isAJAX()) {
            $register = new ModelPelayananPoliRME();

            $data = [
                'tampildata' => $register->ambildatapasienpulang(),
                'registernumber' => $register['registernumber'],
            ];

            $msg = [
                'data' => view('rme/dataregisterranap_rme_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterMobilisasiDanaRanap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $datein = explode('-', $search['Datein']);

            $mulai = str_replace('/', '-', $datein[0]);
            $sampai = str_replace('/', '-', $datein[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_pasienpulang($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterranap_rme_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMobilisasiDanaRanap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();
            $row = $m_icd->get_data_pasien_ranap_rme_pulang_fix($id);
            // $row = $m_icd->get_data_resume_medis_igd($id);
            //$referencenumber = $row['journalnumber'];

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row['pasienid'],
                'pasienid' => $row['pasienid'],
                'menu' => ' RME Ranap',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);

            $data = [
                'id' => $row['id'],
                'types' => '',
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
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => '',
                'email' => $row['icdxname'],
                'token_ranap' => '',
                'memo' => $row['memo'],
                'roomfisik' => $row['poliklinik'],
                'roomfisikname' => $row['poliklinikname'],
                'list' => $this->_data_dokter(),
                'statusrawatinap' => '',
                'pasienclassroom' => '',
                'merge' => '',
                'koinsiden' => '',
                'nomorreferensi' => $row['journalnumber'],
                'tanggalmasuk' => $row['datein'],
                'tanggalPulang' => $row['dateout'],
                'jamPulang' => $row['timeout'],
                'verifikasimobdan' => $row['verifikasimobdan'],
                'verifikasidiagnosa' => $row['verifikasidiagnosa'],
                'bataldiagnosa' => $row['bataldiagnosa'],

            ];
            $msg = [
                'sukses' => view('rme/modalrmeranap_mobilisasi_dana', $data)
            ];
            return json_encode($msg);
        }
    }

    public function ArsipDigitalIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            $pasienid = $row['pasienid'];
            $register = new ModelPelayananPoliRME();
            $master = $register->search_RiwayatPasien($pasienid);


            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
            }


            foreach ($master as $index => $row) {
                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['poliklinikname'] = $row['poliklinikname'];


                $detailTindakan = $register->search_tindakan_detail($id);

                $pem[$index]['list'] = [];
                foreach ($detailTindakan as $item) {

                    if ($item['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['list'][] = $item;
                    }
                }

                $detailDiagnosa = $register->search_diagnosa_detail($id);
                $pem[$index]['listDiagnosa'] = [];
                foreach ($detailDiagnosa as $itemDiagnosa) {

                    if ($itemDiagnosa['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listDiagnosa'][] = $itemDiagnosa;
                    }
                }

                $detailRadiologi = $register->search_rad_detail($id);
                $pem[$index]['listRad'] = [];
                foreach ($detailRadiologi as $itemRadiologi) {

                    if ($itemRadiologi['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listRad'][] = $itemRadiologi;
                    }
                }

                $detailLPK = $register->search_lpk_detail($id);
                $pem[$index]['listLpk'] = [];
                foreach ($detailLPK as $itemLPK) {

                    if ($itemLPK['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listLpk'][] = $itemLPK;
                    }
                }

                $detailLPA = $register->search_lpa_detail($id);
                $pem[$index]['listLpa'] = [];
                foreach ($detailLPA as $itemLPA) {

                    if ($itemLPA['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listLpa'][] = $itemLPA;
                    }
                }

                $detailResep = $register->search_resep_detail($id);
                $pem[$index]['listResep'] = [];
                foreach ($detailResep as $itemResep) {

                    if ($itemResep['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listResep'][] = $itemResep;
                    }
                }
            }

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'KB' => $this->kb(),
                'tampildata' => $pem,
                'referencenumber' => $referencenumber,

            ];


            $msg = [
                'data' => view('rme/arsip_digital_igd', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printResumeMedisIGD()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $kunjungan_pasien = $pasien->get_data_pasien_rme_rajal_resume($referencenumber);
        $resume_medis = $pasien->get_data_resume_medis_igd($referencenumber);
        // $diagnosa_primer_skunder = $pasien->get_data_diagnosa_primer_skunder_rajal($referencenumber);


        $resume = new ModelPelayananPoliRME();

        // $asesmen_perawat = $resume->get_data_asesmen_perawat_igd_rme_view($referencenumber);
        $cek_resume_medis = $resume->get_cek_resume_medis_igd($referencenumber);
        $norm = isset($cek_resume_medis['pasienid']) != null ? $cek_resume_medis['pasienid'] : "";
        $cek_master_pasien = $resume->get_cek_master_pasien($referencenumber);
        $dob = isset($cek_master_pasien['pasiendateofbirth']) != null ? $cek_master_pasien['pasiendateofbirth'] : "";
        $nama = isset($cek_resume_medis['pasienname']) != null ? $cek_resume_medis['pasienname'] : "";
        $diagnosis = isset($cek_resume_medis['diagnosis']) != null ? $cek_resume_medis['diagnosis'] : "";
        $terapi = isset($cek_resume_medis['planning']) != null ? $cek_resume_medis['planning'] : "";
        $namaDokter = isset($cek_resume_medis['doktername']) != null ? $cek_resume_medis['doktername'] : "";
        $tanggalPeriksa = isset($cek_resume_medis['admissionDate']) != null ? $cek_resume_medis['admissionDate'] : "";
        $anamnesa = isset($cek_resume_medis['keluhanUtama']) != null ? $cek_resume_medis['keluhanUtama'] : "";
        $objective = isset($cek_resume_medis['objektive']) != null ? $cek_resume_medis['objektive'] : "";
        $dateResume = isset($cek_resume_medis['createddate']) != null ? $cek_resume_medis['createddate'] : "";
        $asesmen_bb = isset($cek_resume_medis['bb']) != null ? $cek_resume_medis['bb'] : "";
        $createddate = isset($cek_resume_medis['createddate']) != null ? $cek_resume_medis['createddate'] : "";
        $asesmen_tb = isset($cek_resume_medis['tb']) != null ? $cek_resume_medis['tb'] : "";
        $asesmen_frekuensiNadi = isset($cek_resume_medis['frekuensiNadi']) != null ? $cek_resume_medis['frekuensiNadi'] : "";
        $asesmen_tdSistolik = isset($cek_resume_medis['tdSistolik']) != null ? $cek_resume_medis['tdSistolik'] : "";
        $asesmen_tdDiastolik = isset($cek_resume_medis['tdDiastolik']) != null ? $cek_resume_medis['tdDiastolik'] : "";
        $asesmen_suhu = isset($cek_resume_medis['suhu']) != null ? $cek_resume_medis['suhu'] : "";
        $asesmen_frekuensiNafas = isset($cek_resume_medis['frekuensiNafas']) != null ? $cek_resume_medis['frekuensiNafas'] : "";


        $data = [
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'pasienid' => $kunjungan_pasien['pasienid'],
            'pasienname' => $kunjungan_pasien['pasienname'],
            'pasiengender' => $kunjungan_pasien['pasiengender'],
            'pasiendateofbirth' => $kunjungan_pasien['pasiendateofbirth'],
            'namapjb' => '',
            'roomname' => $kunjungan_pasien['poliklinikname'],
            'tanggalperiksa' => $kunjungan_pasien['documentdate'],
            'alasanRawat' => '',
            'pasienage' => $kunjungan_pasien['pasienage'],
            'diagnosis' => $diagnosis,
            'terapi' => $terapi,
            'poliklinik' => $kunjungan_pasien['poliklinikname'],
            'dokter' => $kunjungan_pasien['doktername'],
            'anamnesa' => $anamnesa,
            'objective' => $objective,
            'asesmen_bb' => $asesmen_bb,
            'createddate' => $createddate,
            'asesmen_tb' => $asesmen_tb,
            'asesmen_frekuensiNadi' => $asesmen_frekuensiNadi,
            'asesmen_tdSistolik' => $asesmen_tdSistolik,
            'asesmen_tdDiastolik' => $asesmen_tdDiastolik,
            'asesmen_suhu' => $asesmen_suhu,
            'asesmen_frekuensiNafas' => $asesmen_frekuensiNafas,
            'diagnosa_ps' => $pasien->get_data_diagnosa_primer_skunder_rajal($referencenumber),

            // 'code_diagnosaprimer' => $diagnosa_primer_skunder['codeicdx'],
            // 'diagnosaprimer' => $diagnosa_primer_skunder['nameicdx'],
            // 'code_diagnosaskunder' => $diagnosa_primer_skunder['codeicdix'],
            // 'diagnosaskunder' => $diagnosa_primer_skunder['nameicdix'],


        ];

        $exp = new ModelPelayananPoliRME();
        $sipDokter = $exp->search_sip_dokter($namaDokter);

        $databarcode = $namaDokter . $sipDokter['sip'] . $dateResume . $kunjungan_pasien['journalnumber'];
        $pasienid_barcode = $databarcode;
        $pasienid = $kunjungan_pasien['pasienid'];
        $datapasien = $pasien->data_pasienid($pasienid);

        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(75)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';
        // $data['agama'] = $datapasien['religion'];

        $html = view('pdf/stylebootstrap');
        $html = view('rme/resume_medis_igd', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }


    public function Radiologi()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerrad_rme_medis', $data);
    }

    public function ambildataRMERadiologi()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataradiologi()
            ];
            $msg = [
                'data' => view('rme/dataregisterrad_rme_medis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRMERadiologi()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterRadiologi($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterrad_rme_medis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriRMEMedisRad()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPelayananPoliRME();

            $row_asal = $m_icd->get_data_pasien_penunjang($id);

            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Membuka Rincian' . '' . $row_asal['pasienid'],
                'pasienid' => $row_asal['pasienid'],
                'menu' => ' RME Rajal',

            ];

            $catat = new Modellogactivity;
            //$catat->insert($datalog_activity);
            $registernumber = $row_asal['registernumber_rawatinap'];
            $journalnumber = $row_asal['journalnumber'];
            $referencenumber = $row_asal['referencenumber'];
            if ($registernumber == "NONE") {
                $row = $m_icd->get_data_pasien_penunjang_rajal($referencenumber);
                $data = [
                    'id' => $row['id'],
                    'types' => '',
                    'groups' => $row['groups'],
                    'journalnumber' => $journalnumber,
                    'documentdate' => $row['documentdate'],
                    'documentyear' => $row['documentyear'],
                    'documentmonth' => $row['documentmonth'],

                    'referencenumber' => $row['journalnumber'],
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
                    'classroom' => '',
                    'classroomname' => '',
                    'room' => $row['poliklinik'],
                    'roomname' => $row['poliklinikname'],
                    'locationcode' => $row['locationcode'],
                    'locationname' => $row['locationname'],
                    'referencenumberparent' => $row['referencenumberparent'],
                    'parentid' => $row['parentid'],
                    'parentname' => $row['parentname'],
                    'createdby' => $row['createdby'],
                    'createddate' => $row['createddate'],
                    'icdx' => $row['icdx'],
                    'icdxname' => $row['icdxname'],
                    'tglspr' => '',
                    'email' => $row['icdxname'],
                    'token_ranap' => '',
                    'memo' => $row['memo'],
                    'roomfisik' => $row['poliklinik'],
                    'roomfisikname' => $row['poliklinikname'],
                    'list' => $this->_data_dokter(),
                    'statusrawatinap' => '',
                    'pasienclassroom' => '',
                    'merge' => '',
                    'koinsiden' => '',
                    'asal' => $row['groups'],
                ];
            } else {
                $row = $m_icd->get_data_pasien_penunjang_ranap($referencenumber);
                $data = [
                    'id' => $row['id'],
                    'types' => '',
                    'groups' => $row['groups'],
                    'journalnumber' => $journalnumber,
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
                    'classroom' => '',
                    'classroomname' => '',
                    'room' => $row['poliklinik'],
                    'roomname' => $row['poliklinikname'],
                    'locationcode' => $row['locationcode'],
                    'locationname' => $row['locationname'],
                    'referencenumberparent' => $row['referencenumberparent'],
                    'parentid' => $row['parentid'],
                    'parentname' => $row['parentname'],
                    'createdby' => $row['createdby'],
                    'createddate' => $row['createddate'],
                    'icdx' => $row['icdx'],
                    'icdxname' => $row['icdxname'],
                    'tglspr' => '',
                    'email' => $row['icdxname'],
                    'token_ranap' => '',
                    'memo' => $row['memo'],
                    'roomfisik' => $row['poliklinik'],
                    'roomfisikname' => $row['poliklinikname'],
                    'list' => $this->_data_dokter(),
                    'statusrawatinap' => '',
                    'pasienclassroom' => '',
                    'merge' => '',
                    'koinsiden' => '',
                    'asal' => 'IRI',
                ];
            }
            $msg = [
                'sukses' => view('rme/modalrme_rad_medis', $data)
            ];
            return json_encode($msg);
        }
    }

    public function pemeriksaanRad()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPenunjangDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'Radiologi' => $resume->searchbyjournalnumber($journalnumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_expertise_radiologi_to_create', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    private function _data_dokter_radiologi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_rad();
        return $list;
    }


    public function CreateExpertiseRad()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelPenunjangDetail();
            $row = $perawat->find($id);
            $expertiseid = $row['id'];

            $hasilperiksa = $perawat->search_expertise($expertiseid);
            $data = [
                'id' => $row['id'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'referencenumber' => $row['referencenumber'],
                'relation' => $row['relation'],
                'relationname' => $row['relationname'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'locationcode' => $row['locationcode'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'name' => $row['name'],
                'code' => $row['code'],
                'list' => $this->_data_dokter_radiologi(),
                'expertiseid' => $row['id'],
                'pacsnumber' => $row['pacsnumber'],
                'employee' => $row['employee'],
                'employeename' => $row['employeename'],
                'expertiseidhasil' => isset($hasilperiksa['expertiseid']) != null ? $hasilperiksa['expertiseid'] : "",
                'pacsnumberhasil' => isset($hasilperiksa['pacsnumber']) != null ? $hasilperiksa['pacsnumber'] : "",
                'expertise' => isset($hasilperiksa['expertise']) != null ? $hasilperiksa['expertise'] : "",
                'fotoradiologi' => isset($hasilperiksa['fotoradiologi']) != null ? $hasilperiksa['fotoradiologi'] : null,
                'klinis' => isset($hasilperiksa['klinis']) != null ? $hasilperiksa['klinis'] : null,
            ];
            $msg = [
                'sukses' => view('rme/modalexpertiseradiologi_rme', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function tambahCPPTRadRajal()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IRJ";
            $referencenumber = $this->request->getVar('id');
            $asal = $this->request->getVar('asal');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rajala_rme($referencenumber);

            $data = [
                'referencenumber' => $row['journalnumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'referencenumber' => $row['journalnumber'],
                'admissionDate' => $row['documentdate'],
                'asalPasien' => $asal,

            ];
            $msg = [
                'sukses' => view('rme/modalcreate_cppt_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanCPPTRad()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'createdBy' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'createdBy' => $validation->getError('createdBy')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM resume_cppt_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');



                $groups = $this->request->getVar('asalPasien');
                $rme = $groups . '-RME';
                $underscore = '_';

                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $s = nl2br($this->request->getVar('subjective'));
                $o = nl2br($this->request->getVar('objective'));
                $a = nl2br($this->request->getVar('asesmen'));
                $p = nl2br($this->request->getVar('planning'));

                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => 'RADIOLOGI',
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'keluhanUtama' => $s,
                    'riwayatPenyakitSekarang' => $s,
                    'objektive' => $o,
                    'diagnosis' => $a,
                    'planning' => $p,
                    'createddate' => date('Y-m-d G:i:s'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'tdSistolik' => 0,
                    'tdDiastolik' => 0,
                    'suhu' => 0,
                    'pernapasan' => 0,

                ];

                $perawat = new ModelPelayananPoliRMEMedis;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CPPTMedisGabungan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $asal = $this->request->getVar('asal');
            $cppt = $resume->get_cppt_perawat($referencenumber);

            if ($asal == "IRJ") {
                $data = [
                    'tampildata' => $resume->get_cppt_medis($referencenumber)
                ];
                $msg = [
                    'data' => view('rme/data_resume_cppt_medis', $data)
                ];
            }
            if ($asal == "IGD") {
                $data = [
                    'tampildata' => $resume->get_cppt_medis($referencenumber)
                ];
                $msg = [
                    'data' => view('rme/data_resume_cppt_all', $data)
                ];
            }
            if ($asal == "IRI") {
                $data = [
                    'tampildata' => $resume->get_cppt_all($referencenumber)
                ];
                $msg = [
                    'data' => view('rme/data_resume_cppt_all', $data)
                ];
            }

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ArsipDigitalRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_ranap_rme($referencenumber);
            //$poliklinikname = $row['poliklinikname'];
            $carabayar = $row['paymentmethodname'];


            $pasienid = $row['pasienid'];
            $register = new ModelPelayananPoliRME();
            $master = $register->search_RiwayatPasien($pasienid);


            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
            }


            foreach ($master as $index => $row) {
                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['poliklinikname'] = $row['poliklinikname'];


                $detailTindakan = $register->search_tindakan_detail($id);

                $pem[$index]['list'] = [];
                foreach ($detailTindakan as $item) {

                    if ($item['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['list'][] = $item;
                    }
                }

                $detailDiagnosa = $register->search_diagnosa_detail($id);
                $pem[$index]['listDiagnosa'] = [];
                foreach ($detailDiagnosa as $itemDiagnosa) {

                    if ($itemDiagnosa['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listDiagnosa'][] = $itemDiagnosa;
                    }
                }

                $detailRadiologi = $register->search_rad_detail($id);
                $pem[$index]['listRad'] = [];
                foreach ($detailRadiologi as $itemRadiologi) {

                    if ($itemRadiologi['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listRad'][] = $itemRadiologi;
                    }
                }

                $detailLPK = $register->search_lpk_detail($id);
                $pem[$index]['listLpk'] = [];
                foreach ($detailLPK as $itemLPK) {

                    if ($itemLPK['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listLpk'][] = $itemLPK;
                    }
                }

                $detailLPA = $register->search_lpa_detail($id);
                $pem[$index]['listLpa'] = [];
                foreach ($detailLPA as $itemLPA) {

                    if ($itemLPA['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listLpa'][] = $itemLPA;
                    }
                }

                $detailResep = $register->search_resep_detail($id);
                $pem[$index]['listResep'] = [];
                foreach ($detailResep as $itemResep) {

                    if ($itemResep['referencenumber'] == $row['journalnumber']) {
                        $pem[$index]['listResep'][] = $itemResep;
                    }
                }
            }

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $carabayar,
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'spiritual' => $this->spiritual_detail(),
                'psikologis' => $this->psikologis_detail(),
                'sosiologis' => $this->sosiologis_detail(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'KB' => $this->kb(),
                'tampildata' => $pem,
                'referencenumber' => $referencenumber,

            ];
            $msg = [
                'data' => view('rme/arsip_digital_ranap', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function PelayananResepRanap()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modal_pelayanan_farmasi_mobilisasi_dana_ranap', $data)
            ];
            return json_encode($msg);
        }
    }


    public function detaileResepRMERanap()
    {
        if ($this->request->isAJAX()) {

            $resume2 = new ModelPelayananPoliRME();
            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $headerpelayanan = $resume2->search_header_pelayanan_rme_ranap($journalnumber);
            $journalnumber_resep = $headerpelayanan['journalnumber'];
            $nomor_referensi = $headerpelayanan['referencenumber'];


            $data = [
                'DetailObat' => $resume2->FARMASIRANAP($nomor_referensi),
                'kodejournal' => $journalnumber,
                'validasilunas' => $headerpelayanan['validasilunas'],
                'luarpaketinacbg' => $headerpelayanan['luarpaketinacbg'],
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
                'referencenumber' => $headerpelayanan['referencenumber'],
                'nomorjournal' => $nomor_referensi,

            ];
            $msg = [
                'data' => view('rme/detail_eResepranap_mobilisasi', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printpenjualanKonvesional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "DEPO FARMASI RAWAT INAP";
        $id = $this->request->getVar('page');
        $pasien = new ModelPelayananPoliRME();
        $referencenumber = $this->request->getVar('page');

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeader($id),
            'tampildata' => $pasien->penjualanDetail($referencenumber),

        ];

        return view('cetakan/buktireseprajal', $data);
    }


    public function WLResumeMedis()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rme/registerranap_rme_wlresumemedis', $data);
    }

    public function ambildataWLResumeMedis()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->ambildataWLResumeMedis()
            ];
            $msg = [
                'data' => view('rme/dataregisterranap_rme_wlresumemedis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliWLResumeMedis()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->search_RegisterResumeMedis($search)
            ];

            $msg = [
                'data' => view('rme/dataregisterranap_rme_wlresumemedis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabungRanap()
    {
        if ($this->request->isAJAX()) {

            $cetak = new ModelCetakDetail_A();
            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');

            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir_ranap($referencenumber);

            $apotekKasir_RI = $resume->kasir_apotek_rinap_aliit($referencenumber);
            $apotekKasir_RJ = $resume->kasir_apotek_rajal_aliit($referencenumber);

            $pnjKasir_RI = $resume->kasir_pnj_rinap_aliit($referencenumber);
            $pnjKasir_RJ = $resume->kasir_pnj_rajal_aliit($referencenumber);

            $kasir_RJ = $resume->kasir_rajal_aliit($referencenumber);
            $kasir_Tindakan = $resume->kasir_pembayaran_tindakan_aliit($referencenumber);

            $data = [
                'TotalKasirApotek_RI' => $apotekKasir_RI['paymentamount'],
                'TotalKasirApotek_RJ' => $apotekKasir_RJ['paymentamount'],

                'TotalKasirPnj_RI' => $pnjKasir_RI['paymentamount'],
                'TotalKasirPnj_RJ' => $pnjKasir_RJ['paymentamount'],

                'TotalKasir_RJ' => $kasir_RJ['paymentamount'],
                'TotalKasir_Tindakan' => $kasir_Tindakan['paymentamount'],

                'KAMAR' => $resume->Kamar($referencenumber),
                'KAMAR_GROUP' => $resume->Kamar_group_aliit($referencenumber),

                'VISITE' => $resume->searchVisite($referencenumber),
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'PENUNJANG' => $resume->Penunjang($referencenumber),
                'BHP' => $resume->BHP($referencenumber),
                'FARMASI' => $resume->FARMASIRANAP_detail_aliit($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),

                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangdetailigdrajal_aliit($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'FARMASIIGD' => $resume->FARMASIIGD_detail_aliit($referencenumber),
                'OPERASIIGD' => $resume->Operasi_detail($referencenumber),

                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),

                'statuspasienpulang' => $row['statuspasienpulang'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
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

            ];
            $msg = [
                'data' => view('rme/tagihan_pulang_ranap', $data)
            ];
            return json_encode($msg);
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
        $cetak = new ModelCetakDetail_A();

        $apotekKasir_RI = $resume->kasir_apotek_rinap_aliit($referencenumber);
        $apotekKasir_RJ = $resume->kasir_apotek_rajal_aliit($referencenumber);

        $pnjKasir_RI = $resume->kasir_pnj_rinap_aliit($referencenumber);
        $pnjKasir_RJ = $resume->kasir_pnj_rajal_aliit($referencenumber);

        $kasir_RJ = $resume->kasir_rajal_aliit($referencenumber);
        $kasir_Tindakan = $resume->kasir_pembayaran_tindakan_aliit($referencenumber);

        $data = [
            'TotalKasirApotek_RI' => $apotekKasir_RI['paymentamount'],
            'TotalKasirApotek_RJ' => $apotekKasir_RJ['paymentamount'],

            'TotalKasirPnj_RI' => $pnjKasir_RI['paymentamount'],
            'TotalKasirPnj_RJ' => $pnjKasir_RJ['paymentamount'],

            'TotalKasir_RJ' => $kasir_RJ['paymentamount'],
            'TotalKasir_Tindakan' => $kasir_Tindakan['paymentamount'],

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

            'KAMAR' => $resume->Kamar($referencenumber),
            'KAMAR_GROUP' => $resume->Kamar_group_aliit($referencenumber),


            'VISITE' => $cetak->searchVisitePilihan_Al_non_group($referencenumber, $pilihancabar),
            'TNO' => $cetak->searchTNOPilihan_Al_non_group($referencenumber, $pilihancabar),
            'PENUNJANG' => $cetak->PenunjangRanap_Al_detail_non_group($referencenumber, $pilihancabar),
            'FARMASI' => $cetak->FARMASIPilihan_Al_detail_non_group($referencenumber, $pilihancabar),
            'BHP' => $cetak->BHPpenunjangranapPilihan_Al_non_group($referencenumber, $pilihancabar),
            'GIZI' => $cetak->searchAsupanGiziPilihan_Al_non_group($referencenumber, $pilihancabar),
            'OPERASI' => $cetak->OperasiPilihan_Al_non_group($referencenumber, $pilihancabar),

            'PEMIGD' => $cetak->PemeriksaanIGD_Al_non_group($referencenumber),
            'TINIGD' => $cetak->TindakanIGD_AL_non_group($referencenumber),
            'PENUNJANGIGD' => $cetak->Penunjangigdrajal_Al_non_group($referencenumber),
            'FARMASIIGD' => $cetak->FarmasiRajalIgdDetail_Al_non_group($referencenumber),
            'BHPIGD' => $cetak->BHPpenunjangIgd_Pilihan_Al_non_group($referencenumber, $pilihancabar),

            'cabar' => $pilihancabar,


        ];

        $pasienid_barcode = $journalnumber;


        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(55)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))

            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';

        // $html = view('pdf/stylebootstrap');
        $html = view('rme/printdetailklaim', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function PelayananLpkRanap()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modal_pelayanan_lpk_mobilisasi_dana_ranap', $data)
            ];
            return json_encode($msg);
        }
    }

    public function ExpertiseLpkRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('journalnumber');

            $data = [
                'Radiologi' => $resume->search_lpk_expertise_ranap($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_expertise_lpk_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function PelayananRadRanap()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modal_pelayanan_rad_mobilisasi_dana_ranap', $data)
            ];
            return json_encode($msg);
        }
    }

    public function ExpertiseRadRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('journalnumber');

            $data = [
                'Radiologi' => $resume->search_rad_expertise_ranap($referencenumber)
            ];
            $msg = [
                'data' => view('rme/data_resume_expertise_radiologi_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanLOGeneral()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'createdBy' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'createdBy' => $validation->getError('createdBy')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM laporan_operasi_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IBS-RME';
                $groups = 'IRI';
                $underscore = '_';

                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;



                $startDateTimeOpawal = $this->request->getVar("startDateTimeOp");
                $tglmulai = explode(" ", $startDateTimeOpawal);
                $tglmulaiOp = $tglmulai[0];
                $jammulaiOp = $tglmulai[1];
                $stopDateTimeOpConvert = date('Y-m-d', strtotime($tglmulaiOp));
                $startDateTimeOp = $stopDateTimeOpConvert . ' ' . $jammulaiOp;


                $stopDateTimeOpawal = $this->request->getVar("stopDateTimeOp");
                $tglselesai = explode(" ", $stopDateTimeOpawal);
                $tglselesaiOp = $tglselesai[0];
                $jamselesaiOp = $tglselesai[1];
                $stopDateTimeOpConvert = date('Y-m-d', strtotime($tglselesaiOp));
                $stopDateTimeOp = $stopDateTimeOpConvert . ' ' . $jamselesaiOp;



                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'doktername' => $this->request->getVar('doktername'),
                    'dokterAnestesi' => $this->request->getVar('dokterAnestesi'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'cito' => $this->request->getVar('cito'),
                    'elektif' => $this->request->getVar('elektif'),
                    'asalRuangan' => $this->request->getVar('asalRuangan'),
                    'kamarOperasi' => $this->request->getVar('kamarOperasi'),
                    'smfName' => $this->request->getVar('smfName'),
                    'perawatAnestesi' => $this->request->getVar('perawatAnestesi'),
                    'scrubNurse' => $this->request->getVar('scrubNurse'),
                    'asisten1' => $this->request->getVar('asisten1'),
                    'asisten2' => $this->request->getVar('asisten2'),
                    'circulationNurse' => $this->request->getVar('circulationNurse'),
                    'posisiOperasi' => $this->request->getVar('posisiOperasi'),
                    'jenisSayatan' => $this->request->getVar('jenisSayatan'),
                    'skinPerparasi' => $this->request->getVar('skinPerparasi'),
                    'jenisPembedahan' => $this->request->getVar('jenisPembedahan'),
                    'diagnosaPraBedah' => $this->request->getVar('diagnosaPraBedah'),
                    'indikasiOperasi' => $this->request->getVar('indikasiOperasi'),
                    'jenisOperasi' => $this->request->getVar('jenisOperasi'),
                    'diagnosaPascaBedah' => $this->request->getVar('diagnosaPascaBedah'),
                    'startDateTimeOp' => $startDateTimeOp,
                    'stopDateTimeOp' => $stopDateTimeOp,
                    'lamaOperasi' => $this->request->getVar('lamaOperasi'),
                    'jaringanSpesimenOperasi' => $this->request->getVar('jaringanSpesimenOperasi'),
                    'jaringanSpesimenAspirasi' => $this->request->getVar('jaringanSpesimenAspirasi'),
                    'jaringanSpesimenkaterisasi' => $this->request->getVar('jaringanSpesimenkaterisasi'),
                    'lokalisasi' => $this->request->getVar('lokalisasi'),
                    'dikirimPA' => $this->request->getVar('dikirimPA'),
                    'profilaksisAntibiotik' => $this->request->getVar('profilaksisAntibiotik'),
                    'jamPemberian' => $this->request->getVar('jamPemberian'),
                    'laporanJalanOperasi' => $this->request->getVar('laporanJalanOperasi'),
                    'komplikasiPascaBedah' => $this->request->getVar('komplikasiPascaBedah'),
                    'jumlahPerdarahan' => $this->request->getVar('jumlahPerdarahan'),
                    'transfusiDarah' => $this->request->getVar('transfusiDarah'),
                    'pcr' => $this->request->getVar('pcr'),
                    'wb' => $this->request->getVar('wb'),
                    'jumlahPcrWb' => $this->request->getVar('jumlahPcrWb'),
                    'jenisInplan' => $this->request->getVar('jenisInplan'),
                    'noRegInplan' => $this->request->getVar('noRegInplan'),
                    'prosedurOp' => $this->request->getVar('prosedurOp'),
                    'katarak' => 0,

                ];

                $perawat = new ModelLaporanOperasiRME;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printLaporanOperasiGeneral()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();

        $laporan_operasi = $pasien->get_lo_general($referencenumber);
        $data = [
            'kop' => $pasien->get_data_kasir2($lokasikasir),
            'kunjungan_pasien_ranap' => $pasien->get_data_pasien_rme_ranap($referencenumber),

            'data_laporan_ok' => $laporan_operasi,
        ];

        return view('rme/print_laporan_operasi', $data);
    }

    public function simpandataeresep_detail_multiple()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Obat',
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
                $jumlah = $this->request->getVar('qtyresep');
                $jumlahstock = $this->request->getVar('qtystock');

                $qty = -1 * $jumlah;
                var_dump($qty);
                die();

                $qtypaket = ABS($qty);

                $subtotal = $price * $qty;

                $code = $this->request->getVar('code');
                $m_icd = new ModelMasterObat();
                $sm = $m_icd->get_minstock_obat($code);
                $stockminimal = $sm['minstock'];

                $beli = $jumlahstock - $jumlah;

                $dosisfull = $this->request->getVar('signa1');
                $dosis_exp = explode("X", $dosisfull);


                $signa1 = $dosis_exp[0];
                $signa2 = $dosis_exp[1];

                $emptydate = date('Y-m-d', strtotime($this->request->getVar("emptydate")));

                $journalnumber = $this->request->getVar('journalnumber');
                $documentdate = $this->request->getVar('documentdate_detail');
                $karyawan = $this->request->getVar('karyawan_detail');
                $dispensasi = $this->request->getVar('dispensasi_detail');
                $relation = $this->request->getVar('relation');
                $relationname = $this->request->getVar('relationname');
                $paymentmethod = $this->request->getVar('paymentmethod_detail');
                $paymentmethodname = $this->request->getVar('paymentmethodname_detail');
                $poliklinik = $this->request->getVar('poliklinik_detail');
                $poliklinikname = $this->request->getVar('poliklinikname_detail');
                $poliklinikclass = $this->request->getVar('poliklinikclass_detail');
                $dokter = $this->request->getVar('dokter_detail');
                $doktername = $this->request->getVar('doktername_detail');
                $employee = $this->request->getVar('employee_detail');
                $employeename = $this->request->getVar('employeename_detail');
                $referencenumber = $this->request->getVar('referencenumber_detail');
                $locationcode = $this->request->getVar('locationcode_detail');
                $locationname = $this->request->getVar('locationname_detail');
                $racikan = $this->request->getVar('racikan');
                $r = $this->request->getVar('koderacikan');
                $koderacikan = $this->request->getVar('koderacikan');
                $jumlahracikan = $this->request->getVar('jumlahracikan');
                $code = $this->request->getVar('code');
                $name = $this->request->getVar('name');
                $batchnumber = $this->request->getVar('batchnumber');
                $expireddate = $this->request->getVar('expireddate');
                $qty = $qty;
                $uom = $this->request->getVar('uom');
                $signa1 = $signa1;
                $signa2 = $signa2;
                $emptydate = $emptydate;
                $price = $this->request->getVar('price');
                $subtotal = $subtotal;
                $createdby = session()->get('firstname');
                $createddate = date('Y-m-d G:i:s');
                $qtypaket = $qtypaket;
                $qtyluarpaket = 0;
                $eticket_aturan = '';
                $eticket_carapakai = $this->request->getVar('carapakai');
                $eticket_petunjuk = '';
                $terapiPulang = 0;
                $createdby = session()->get('firstname');
                $createddate = date('Y-m-d G:i:s');

                $jmldata =  count($journalnumber);
                for ($i = 0; $i < $jmldata; $i++) {
                    if ($jumlah[$i] > 0) {
                        $data[$i]['journalnumber'] = $journalnumber[$i];
                        $data[$i]['documentdate'] = $documentdate[$i];
                        $data[$i]['karyawan'] = $karyawan[$i];
                        $data[$i]['dispensasi'] = $dispensasi[$i];
                        $data[$i]['relation'] = $relation[$i];
                        $data[$i]['relationname'] = $relationname[$i];
                        $data[$i]['paymentmethod'] = $paymentmethod[$i];
                        $data[$i]['paymentmethodname'] = $paymentmethodname[$i];
                        $data[$i]['poliklinik'] = $poliklinik[$i];
                        $data[$i]['poliklinikname'] = $poliklinikname[$i];
                        $data[$i]['poliklinikclass'] = $poliklinikclass[$i];
                        $data[$i]['dokter'] = $dokter[$i];
                        $data[$i]['doktername'] = $doktername[$i];
                        $data[$i]['employee'] = $employee[$i];
                        $data[$i]['employeename'] = $employeename[$i];
                        $data[$i]['referencenumber'] = $referencenumber[$i];
                        $data[$i]['locationcode'] = $locationcode[$i];
                        $data[$i]['locationname'] = $locationname[$i];
                        $data[$i]['racikan'] = $racikan[$i];
                        $data[$i]['r'] = $r[$i];
                        $data[$i]['koderacikan'] = $koderacikan[$i];
                        $data[$i]['jumlahracikan'] = $jumlahracikan[$i];
                        $data[$i]['code'] = $code[$i];
                        $data[$i]['name'] = $name[$i];
                        $data[$i]['batchnumber'] = $batchnumber[$i];
                        $data[$i]['expireddate'] = $expireddate[$i];
                        $data[$i]['qty'] = $qty[$i];
                        $data[$i]['uom'] = $uom[$i];
                        $data[$i]['signa1'] = $signa1[$i];
                        $data[$i]['signa2'] = $signa2[$i];
                        $data[$i]['emptydate'] = $emptydate[$i];
                        $data[$i]['price'] = $price[$i];
                        $data[$i]['subtotal'] = $subtotal[$i];
                        $data[$i]['createdby'] = $createdby[$i];
                        $data[$i]['cerateddate'] = $createddate[$i];
                        $data[$i]['qtypaket'] = $qtypaket[$i];
                        $data[$i]['qtyluarpaket'] = $qtyluarpaket[$i];
                        $data[$i]['eticket_aturan'] = $eticket_aturan[$i];
                        $data[$i]['eticket_carapakai'] = $eticket_carapakai[$i];
                        $data[$i]['eticket_petunjuk'] = $eticket_petunjuk[$i];
                        $data[$i]['terapiPulang'] = $terapiPulang[$i];
                    }
                }


                $perawat = new ModelPelayananPoliRME;
                $perawat->insert_banyak_data($data);
                $msg = [
                    'sukses' => 'Detail Obat telah disimpan'
                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiMobDan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $verifikasimobdan = $this->request->getVar('verifikasimobdan');
            $catatanVerifikasi = $this->request->getVar('catatanVerifikasi');
            $simpandata = [
                'verifikasimobdan' => $verifikasimobdan,
                'catatanVerifikasiMobdan' => $catatanVerifikasi,

            ];
            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalVerifikasiMobDan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $catatanVerifikasi = $this->request->getVar('catatanVerifikasi');
            $simpandata = [
                'verifikasimobdan' => 0,
                'catatanVerifikasiMobdan' => $catatanVerifikasi,

            ];
            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Batal Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiMobDan_RawatInap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $verifikasimobdan = $this->request->getVar('verifikasimobdan');
            $catatanVerifikasi = $this->request->getVar('catatanVerifikasi');
            $simpandata = [
                'verifikasimobdan' => $verifikasimobdan,
                'catatanVerifikasiMobdan' => $catatanVerifikasi,

            ];
            $perawat = new ModelPulangRanap;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalVerifikasiMobDan_RawatInap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $catatanVerifikasi = $this->request->getVar('catatanVerifikasi');
            $simpandata = [
                'verifikasimobdan' => 0,
                'catatanVerifikasiMobdan' => $catatanVerifikasi,

            ];
            $perawat = new ModelPulangRanap;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Batal Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiDiagnosa()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $verifikasidiagnosa = $this->request->getVar('verifikasidiagnosa');
            $bataldiagnosa = $this->request->getVar('bataldiagnosa');
            $simpandata = [
                'verifikasidiagnosa' => 1,
                'bataldiagnosa' => $bataldiagnosa,

            ];
            $perawat = new ModelPulangRanap;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalDiagnosa()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $verifikasidiagnosa = $this->request->getVar('verifikasidiagnosa');
            $bataldiagnosa = $this->request->getVar('bataldiagnosa');
            $simpandata = [
                'verifikasidiagnosa' => $verifikasidiagnosa,
                'bataldiagnosa' => 1,

            ];
            $perawat = new ModelPulangRanap;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Batal Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function jawabKonsulRajal()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IRJ";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rajal_rme($referencenumber);
            $data = [
                'referencenumber' => $row['journalnumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'referencenumber' => $row['journalnumber'],
                'admissionDate' => $row['datein'],
                'tampildata' => $perawat->get_cppt_medis($referencenumber)

            ];
            $msg = [
                'sukses' => view('rme/modalcreate_jawabkonsul_rajal', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanCPPTKonsul()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'createdBy' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'createdBy' => $validation->getError('createdBy')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM resume_cppt_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRJ-RME';
                $groups = 'IRJ';
                $underscore = '_';

                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $s = nl2br($this->request->getVar('subjective'));
                $o = nl2br($this->request->getVar('objective'));
                $a = nl2br($this->request->getVar('asesmen'));
                $p = nl2br($this->request->getVar('planning'));

                $simpandata = [

                    'groups' => $groups,
                    'registernumber' => $newkode,
                    'referencenumber' => $this->request->getVar('nomorreferensi'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'admissionDate' => $this->request->getVar('admissionDate'),
                    'doktername' => $this->request->getVar('doktername'),
                    's' => $s,
                    'o' => $o,
                    'a' => $a,
                    'p' => $p,
                    'createddate' => date('Y-m-d G:i:s'),
                    // 'kelompokCppt' => $this->request->getVar('kelompokCPPT'),
                    'cpptGenerik' => 1,
                    'createdBy' => $this->request->getVar('createdBy'),
                ];

                $perawat = new ModelCPPTRME;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Simpan Berhasil',
                    'JN' => $newkode,

                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiDiagnosarajal()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $verifikasidiagnosarajal = $this->request->getVar('verifikasidiagnosarajal');
            $simpandata = [
                'verifikasidiagnosarajal' => 1,

            ];
            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalDiagnosarajal()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $verifikasidiagnosarajal = $this->request->getVar('verifikasidiagnosarajal');
            $simpandata = [
                'verifikasidiagnosarajal' => 0,

            ];
            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Batal Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function uploadFile()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('referencenumber');

            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modalupload_file', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanFile()
    {
        if ($this->request->isAJAX()) {
            $data = new Model_gambar_rme();

            $referencenumber = $this->request->getVar('referencenumber');
            $jenis_file = $this->request->getVar('jenis_file');

            $dataFile = $this->request->getFile('nama_file');
            $dataCamera = $this->request->getFile('camera_file');
            $nameFile = null;

            if (!$dataFile->getError() == 4) {
                $nameFile = $dataFile->getRandomName();
                $dataFile->move('assets/data_file_rme', $nameFile);
            }

            if (!$dataCamera->getError() == 4) {
                $nameFile = $dataCamera->getRandomName();
                $dataCamera->move('assets/data_file_rme', $nameFile);
            }

            $data->insert([
                'referencenumber' => $referencenumber,
                'type' => $jenis_file,
                'nama_file' => $nameFile
            ]);

            $msg = [
                'sukses' => 'data file berhasil di simpan'
            ];

            return json_encode($msg);
        }
    }

    public function historyFile()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'sukses' => view('rme/modalhistory_file', [
                    'ref' => $this->request->getVar('referencenumber')
                ])
            ];
            return json_encode($msg);
        }
    }

    public function ambilHistoryFile()
    {
        $referencenumber = $this->request->getVar('referencenumber');

        $data = new Model_gambar_rme();
        $get_data = $data->where('referencenumber', $referencenumber)->findAll();

        $msg = [
            'sukses' => view('rme/data_history_file', [
                'dataGambar' => $get_data
            ])
        ];
        return json_encode($msg);
    }

    public function hapusfile_rme()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = new Model_gambar_rme();
            $get_data = $data->find($id);
            if (file_exists(FCPATH . 'assets/data_file_rme/' . $get_data['nama_file'])) {
                unlink(FCPATH . 'assets/data_file_rme/' . $get_data['nama_file']);
            }
            $data->delete($id);

            $msg = [
                'sukses' => "Data file rme : " . $get_data['nama_file'] . " Berhasil dihapus"
            ];

            return json_encode($msg);
        }
    }

    public function uploadFileigd()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('referencenumber');

            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modalupload_file', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanFileigd()
    {
        if ($this->request->isAJAX()) {
            $data = new Model_gambar_rme();

            $referencenumber = $this->request->getVar('referencenumber');
            $jenis_file = $this->request->getVar('jenis_file');

            $dataFile = $this->request->getFile('nama_file');
            $nameFile = null;

            if (!$dataFile->getError() == 4) {
                $nameFile = $dataFile->getRandomName();
                $dataFile->move('assets/data_file_rme', $nameFile);
            }

            $data->insert([
                'referencenumber' => $referencenumber,
                'type' => $jenis_file,
                'nama_file' => $nameFile
            ]);

            $msg = [
                'sukses' => 'data file berhasil di simpan'
            ];

            return json_encode($msg);
        }
    }

    public function historyFileigd()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'sukses' => view('rme/modalhistory_file', [
                    'ref' => $this->request->getVar('referencenumber')
                ])
            ];
            return json_encode($msg);
        }
    }

    public function ambilHistoryFileigd()
    {
        $referencenumber = $this->request->getVar('referencenumber');

        $data = new Model_gambar_rme();
        $get_data = $data->where('referencenumber', $referencenumber)->findAll();

        $msg = [
            'sukses' => view('rme/data_history_fileigd', [
                'dataGambar' => $get_data
            ])
        ];
        return json_encode($msg);
    }

    public function hapusfile_rmeigd()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = new Model_gambar_rme();
            $get_data = $data->find($id);
            if (file_exists(FCPATH . 'assets/data_file_rme/' . $get_data['nama_file'])) {
                unlink(FCPATH . 'assets/data_file_rme/' . $get_data['nama_file']);
            }
            $data->delete($id);

            $msg = [
                'sukses' => "Data file rme : " . $get_data['nama_file'] . " Berhasil dihapus"
            ];

            return json_encode($msg);
        }
    }

    public function uploadFileranap()
    {
        if ($this->request->isAJAX()) {
            $referencenumber = $this->request->getVar('referencenumber');

            $data = [
                'referencenumber' => $referencenumber,
            ];

            $msg = [
                'sukses' => view('rme/modalupload_file', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanFileranap()
    {
        if ($this->request->isAJAX()) {
            $data = new Model_gambar_rme();

            $referencenumber = $this->request->getVar('referencenumber');
            $jenis_file = $this->request->getVar('jenis_file');

            $dataFile = $this->request->getFile('nama_file');
            $nameFile = null;

            if (!$dataFile->getError() == 4) {
                $nameFile = $dataFile->getRandomName();
                $dataFile->move('assets/data_file_rme', $nameFile);
            }

            $data->insert([
                'referencenumber' => $referencenumber,
                'type' => $jenis_file,
                'nama_file' => $nameFile
            ]);

            $msg = [
                'sukses' => 'data file berhasil di simpan'
            ];

            return json_encode($msg);
        }
    }

    public function historyFileranap()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'sukses' => view('rme/modalhistory_file', [
                    'ref' => $this->request->getVar('referencenumber')
                ])
            ];
            return json_encode($msg);
        }
    }

    public function ambilHistoryFileranap()
    {
        $referencenumber = $this->request->getVar('referencenumber');

        $data = new Model_gambar_rme();
        $get_data = $data->where('referencenumber', $referencenumber)->findAll();

        $msg = [
            'sukses' => view('rme/data_history_fileranap', [
                'dataGambar' => $get_data
            ])
        ];
        return json_encode($msg);
    }

    public function hapusfile_rmeranap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = new Model_gambar_rme();
            $get_data = $data->find($id);
            if (file_exists(FCPATH . 'assets/data_file_rme/' . $get_data['nama_file'])) {
                unlink(FCPATH . 'assets/data_file_rme/' . $get_data['nama_file']);
            }
            $data->delete($id);

            $msg = [
                'sukses' => "Data file rme : " . $get_data['nama_file'] . " Berhasil dihapus"
            ];

            return json_encode($msg);
        }
    }

    public function riwayatPelayananResepAll()
    {
        if ($this->request->isAJAX()) {
            $pasienid = $this->request->getVar('id');
            $nomorKunjungan = $this->request->getVar('nomorKunjungan');

            $perawat = new ModelPelayananPoliRME();
            $data = [
                'pasienid' => $pasienid,
                'nomorKunjungan' => $nomorKunjungan,
            ];

            $msg = [
                'sukses' => view('rme/modalriwayatpelayananresepAll', $data)
            ];
            return json_encode($msg);
        }
    }

    public function resumeRiwayatResepAll()
    {
        if ($this->request->isAJAX()) {

            $pasienid = $this->request->getVar('pasienid');
            $register = new ModelPelayananPoliRME();
            $master = $register->search_RiwayatPasien_resep($pasienid);
            $nomorKunjungan = $this->request->getVar('nomorKunjungan');

            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
                $id2[] = $row_master['referencenumber'];
            }
            foreach ($master as $index => $row) {
                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['poliklinikname'] = $row['poliklinikname'];

                $detailResep = $register->search_resep_detail_all($id2);




                $pem[$index]['listResep'] = [];
                foreach ($detailResep as $itemResep) {

                    if ($itemResep['journalnumber'] == $row['journalnumber']) {
                        $pem[$index]['listResep'][] = $itemResep;
                    }
                }
            }

            $data = [
                'tampildata' => $pem,
                'nomorKunjungan' => $nomorKunjungan,
            ];

            $msg = [
                'data' => view('rme/riwayat_data_pelayanan_medis_resep_all_new', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function AsesmenAwalMedis()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULUT") {
                $file = 'rme/asesmen_awal_medis_gigi';
            } else {
                $file = 'rme/asesmen_awal_medis_umum';
            }

            $asesmen_perawat = $resume->get_data_asesmen_perawat_poli_rme_view($referencenumber);
            $asesmen_bb = isset($asesmen_perawat['bb']) != null ? $asesmen_perawat['bb'] : "";
            $asesmen_tb = isset($asesmen_perawat['tb']) != null ? $asesmen_perawat['tb'] : "";
            $asesmen_frekuensiNadi = isset($asesmen_perawat['frekuensiNadi']) != null ? $asesmen_perawat['frekuensiNadi'] : "";
            $asesmen_tdSistolik = isset($asesmen_perawat['tdSistolik']) != null ? $asesmen_perawat['tdSistolik'] : "";
            $asesmen_tdDiastolik = isset($asesmen_perawat['tdDiastolik']) != null ? $asesmen_perawat['tdDiastolik'] : "";
            $asesmen_suhu = isset($asesmen_perawat['suhu']) != null ? $asesmen_perawat['suhu'] : "";
            $asesmen_frekuensiNafas = isset($asesmen_perawat['frekuensiNafas']) != null ? $asesmen_perawat['frekuensiNafas'] : "";
            $asesmen_kesadaran = isset($asesmen_perawat['kesadaran']) != null ? $asesmen_perawat['kesadaran'] : "";
            $alergi = isset($asesmen_perawat['uraianAlergi']) != null ? $asesmen_perawat['uraianAlergi'] : "";

            $cek_cppt = $resume->get_cek_resume_medis_rajal($referencenumber);
            $keluhanUtama = isset($cek_cppt['keluhanUtama']) != null ? strip_tags($cek_cppt['keluhanUtama']) : "";
            $riwayatPenyakitSekarang = isset($cek_cppt['riwayatPenyakitSekarang']) != null ? strip_tags($cek_cppt['riwayatPenyakitSekarang']) : "";
            $riwayatPenyakitKeluarga = isset($cek_cppt['riwayatPenyakitKeluarga']) != null ? strip_tags($cek_cppt['riwayatPenyakitKeluarga']) : "";
            $objektive = isset($cek_cppt['objektive']) != null ? strip_tags($cek_cppt['objektive']) : "";
            $diagnosis = isset($cek_cppt['diagnosis']) != null ? strip_tags($cek_cppt['diagnosis']) : "";
            $diagnosisSekunder = isset($cek_cppt['diagnosisSekunder']) != null ? strip_tags($cek_cppt['diagnosisSekunder']) : "";
            $planning = isset($cek_cppt['planning']) != null ? strip_tags($cek_cppt['planning']) : "";
            $id_cppt = isset($cek_cppt['id']) != null ? $cek_cppt['id'] : "";
            $tindakLanjut = isset($cek_cppt['tindakLanjut']) != null ? $cek_cppt['tindakLanjut'] : "";
            $deskripsiKonsultasi = isset($cek_cppt['deskripsiKonsultasi']) != null ? strip_tags($cek_cppt['deskripsiKonsultasi']) : "";
            $tujuanKonsultasi = isset($cek_cppt['tujuanKonsultasi']) != null ? $cek_cppt['tujuanKonsultasi'] : "";
            $konsulen = isset($cek_cppt['konsulen']) != null ? $cek_cppt['konsulen'] : "";


            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'konsultasi' => $this->data_konsultasi(),
                'tindaklanjut' => $this->data_tindak_lanjut(),
                'asesmen_bb' => $asesmen_bb,
                'asesmen_tb' => $asesmen_tb,
                'asesmen_frekuensiNadi' => $asesmen_frekuensiNadi,
                'asesmen_tdSistolik' => $asesmen_tdSistolik,
                'asesmen_tdDiastolik' => $asesmen_tdDiastolik,
                'asesmen_suhu' => $asesmen_suhu,
                'asesmen_frekuensiNafas' => $asesmen_frekuensiNafas,
                'asesmen_kesadaran' => $asesmen_kesadaran,
                'list' => $this->_data_dokter(),
                'keluhanUtama' => $keluhanUtama,
                'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                'objective' => $objektive,
                'diagnosis' => $diagnosis,
                'diagnosisSekunder' => $diagnosisSekunder,
                'planning' => $planning,
                'id_cppt' => $id_cppt,
                'tindakLanjut' => $tindakLanjut,
                'deskripsiKonsultasi' =>  $deskripsiKonsultasi,
                'tujuanKonsultasi' => $tujuanKonsultasi,
                'konsulen' => $konsulen,
                'alergi' => $alergi
            ];

            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanAsesmenMedis()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_medis_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IRJ-RME-MEDIS';
                $groups = 'IRJ';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $kepala = $this->request->getVar('kepala');
                $uraiankepala = $this->request->getVar('uraiankepala');
                if ($kepala == 1) {
                    $isikepala = $uraiankepala;
                } else {
                    $isikepala = 0;
                }

                $mata = $this->request->getVar('mata');
                $uraianmata = $this->request->getVar('uraianmata');
                if ($mata == 1) {
                    $isimata = $uraianmata;
                } else {
                    $isimata = 0;
                }

                $telinga = $this->request->getVar('telinga');
                $uraiantelinga = $this->request->getVar('uraiantelinga');
                if ($telinga == 1) {
                    $isitelinga = $uraiantelinga;
                } else {
                    $isitelinga = 0;
                }

                $hidung = $this->request->getVar('hidung');
                $uraianhidung = $this->request->getVar('uraianhidung');
                if ($hidung == 1) {
                    $isihidung = $uraianhidung;
                } else {
                    $isihidung = 0;
                }

                $bibir = $this->request->getVar('bibir');
                $uraianbibir = $this->request->getVar('uraianbibir');
                if ($bibir == 1) {
                    $isibibir = $uraianbibir;
                } else {
                    $isibibir = 0;
                }

                $rambut = $this->request->getVar('rambut');
                $uraianrambut = $this->request->getVar('uraianrambut');
                if ($rambut == 1) {
                    $isirambut = $uraianrambut;
                } else {
                    $isirambut = 0;
                }

                $gigiGeligi = $this->request->getVar('gigiGeligi');
                $uraiangigiGeligi = $this->request->getVar('uraiangigiGeligi');
                if ($gigiGeligi == 1) {
                    $isigigiGeligi = $uraiangigiGeligi;
                } else {
                    $isigigiGeligi = 0;
                }

                $lidah = $this->request->getVar('lidah');
                $uraianlidah = $this->request->getVar('uraianlidah');
                if ($lidah == 1) {
                    $isilidah = $uraianlidah;
                } else {
                    $isilidah = 0;
                }

                $LangitLangit = $this->request->getVar('LangitLangit');
                $uraianLangitLangit = $this->request->getVar('uraianLangitLangit');
                if ($LangitLangit == 1) {
                    $isiLangitLangit = $uraianLangitLangit;
                } else {
                    $isiLangitLangit = 0;
                }

                $leher = $this->request->getVar('leher');
                $uraianleher = $this->request->getVar('uraianleher');
                if ($leher == 1) {
                    $isileher = $uraianleher;
                } else {
                    $isileher = 0;
                }

                $tenggorokan = $this->request->getVar('tenggorokan');
                $uraiantenggorokan = $this->request->getVar('uraiantenggorokan');
                if ($tenggorokan == 1) {
                    $isitenggorokan = $uraiantenggorokan;
                } else {
                    $isitenggorokan = 0;
                }

                $dada = $this->request->getVar('dada');
                $uraiandada = $this->request->getVar('uraiandada');
                if ($dada == 1) {
                    $isidada = $uraiandada;
                } else {
                    $isidada = 0;
                }

                $tonsil = $this->request->getVar('tonsil');
                $uraiantonsil = $this->request->getVar('uraiantonsil');
                if ($tonsil == 1) {
                    $isitonsil = $uraiantonsil;
                } else {
                    $isitonsil = 0;
                }

                $payudara = $this->request->getVar('payudara');
                $uraianpayudara = $this->request->getVar('uraianpayudara');
                if ($payudara == 1) {
                    $isipayudara = $uraianpayudara;
                } else {
                    $isipayudara = 0;
                }

                $perut = $this->request->getVar('perut');
                $uraianperut = $this->request->getVar('uraianperut');
                if ($perut == 1) {
                    $isiperut = $uraianperut;
                } else {
                    $isiperut = 0;
                }

                $punggung = $this->request->getVar('punggung');
                $uraianpunggung = $this->request->getVar('uraianpunggung');
                if ($punggung == 1) {
                    $isipunggung = $uraianpunggung;
                } else {
                    $isipunggung = 0;
                }

                $genital = $this->request->getVar('genital');
                $uraiangenital = $this->request->getVar('uraiangenital');
                if ($genital == 1) {
                    $isigenital = $uraiangenital;
                } else {
                    $isigenital = 0;
                }

                $anus = $this->request->getVar('anus');
                $uraiananus = $this->request->getVar('uraiananus');
                if ($anus == 1) {
                    $isianus = $uraiananus;
                } else {
                    $isianus = 0;
                }

                $lenganAtas = $this->request->getVar('lenganAtas');
                $uraianlenganAtas = $this->request->getVar('uraianlenganAtas');
                if ($lenganAtas == 1) {
                    $isilenganAtas = $uraianlenganAtas;
                } else {
                    $isilenganAtas = 0;
                }

                $lenganBawah = $this->request->getVar('lenganBawah');
                $uraianlenganBawah = $this->request->getVar('uraianlenganBawah');
                if ($lenganBawah == 1) {
                    $isilenganBawah = $uraianlenganBawah;
                } else {
                    $isilenganBawah = 0;
                }

                $jariTangan = $this->request->getVar('jariTangan');
                $uraianjariTangan = $this->request->getVar('uraianjariTangan');
                if ($jariTangan == 1) {
                    $isijariTangan = $uraianjariTangan;
                } else {
                    $isijariTangan = 0;
                }

                $kukuTangan = $this->request->getVar('kukuTangan');
                $uraiankukuTangan = $this->request->getVar('uraiankukuTangan');
                if ($kukuTangan == 1) {
                    $isikukuTangan = $uraiankukuTangan;
                } else {
                    $isikukuTangan = 0;
                }

                $persendianTangan = $this->request->getVar('persendianTangan');
                $uraianpersendianTangan = $this->request->getVar('uraianpersendianTangan');
                if ($persendianTangan == 1) {
                    $isipersendianTangan = $uraianpersendianTangan;
                } else {
                    $isipersendianTangan = 0;
                }

                $tungkaiAtas = $this->request->getVar('tungkaiAtas');
                $uraiantungkaiAtas = $this->request->getVar('uraiantungkaiAtas');
                if ($tungkaiAtas == 1) {
                    $isitungkaiAtas = $uraiantungkaiAtas;
                } else {
                    $isitungkaiAtas = 0;
                }

                $tungkaiBawah = $this->request->getVar('tungkaiBawah');
                $uraiantungkaiBawah = $this->request->getVar('uraiantungkaiBawah');
                if ($tungkaiBawah == 1) {
                    $isitungkaiBawah = $uraiantungkaiBawah;
                } else {
                    $isitungkaiBawah = 0;
                }

                $jariKaki = $this->request->getVar('jariKaki');
                $uraianjariKaki = $this->request->getVar('uraianjariKaki');
                if ($jariKaki == 1) {
                    $isijariKaki = $uraianjariKaki;
                } else {
                    $isijariKaki = 0;
                }

                $kukuKaki = $this->request->getVar('kukuKaki');
                $uraiankukuKaki = $this->request->getVar('uraiankukuKaki');
                if ($kukuKaki == 1) {
                    $isikukuKaki = $uraiankukuKaki;
                } else {
                    $isikukuKaki = 0;
                }

                $persendianKaki = $this->request->getVar('persendianKaki');
                $uraianpersendianKaki = $this->request->getVar('uraianpersendianKaki');
                if ($persendianKaki == 1) {
                    $isipersendianKaki = $uraianpersendianKaki;
                } else {
                    $isipersendianKaki = 0;
                }

                $keluhanUTama = nl2br($this->request->getVar('keluhanUtama'));
                $riwayatPenyakitSekarang = nl2br($this->request->getVar('riwayatPenyakitSekarang'));
                $riwayatPenyakitKeluarga = nl2br($this->request->getVar('riwayatPenyakitKeluarga'));
                $riwayatPenyakitDahulu = nl2br($this->request->getVar('riwayatPenyakitDahulu'));
                $objective = nl2br($this->request->getVar('objective'));
                $planning = nl2br($this->request->getVar('objective_medis'));

                // status lokalis
                $anatomi = $this->request->getVar('anatomi');

                if ($anatomi != "") {
                    $imageName = md5(uniqid(rand(), true)) . '.jpeg';
                    $image = $this->conv($this->request->getVar('anatomi'), $imageName);
                    $status_lokalis = $imageName;
                    // end status lokalis
                } else {
                    $status_lokalis = '';
                }

                $anatomigigi = $this->request->getVar('anatomigigi');

                if ($anatomigigi != "") {
                    $imageName = md5(uniqid(rand(), true)) . '.jpeg';
                    $image = $this->conv($this->request->getVar('anatomigigi'), $imageName);
                    $status_lokalis = $imageName;
                    // end status lokalis
                } else {
                    $status_lokalis = '';
                }

                // handle file record audio
                $dataAudio = $this->request->getFile('audData');
                $nameFile = null;
                if (!$dataAudio->getError() == 4) {
                    $nameFile = $dataAudio->getRandomName();
                    $dataAudio->move('assets/audio_rme', $nameFile);
                }
                // end handle file record audio

                $data_alergi = "Tidak";
                $data_alergi_obat = null;

                if ($this->request->getVar('alergiObat') != "") {
                    $data_alergi = "Ya";
                    $data_alergi_obat = $this->request->getVar('alergiObat');
                }

                $id_cppt = $this->request->getVar('id_cppt');
                if ($id_cppt == "") {

                    $simpandata = [
                        'groups' => $groups,
                        'registernumber' => $newkode,
                        'referencenumber' => $this->request->getVar('nomorreferensi'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                        'poliklinikname' => $this->request->getVar('poliklinikname'),
                        'admissionDate' => $this->request->getVar('admissionDate'),
                        'gambar_anatomi_tubuh' => $status_lokalis,
                        'kesadaran' => $this->request->getVar('kesadaran'),
                        'tb' => $this->request->getVar('tb'),
                        'bb' => $this->request->getVar('bb'),
                        'denyut_jantung' => $this->request->getVar('frekuensiNadi'),
                        'pernapasan' => $this->request->getVar('pernapasan'),
                        'tdSistolik' => $this->request->getVar('tdSistolik'),
                        'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                        'suhu' => $this->request->getVar('suhu'),
                        'kepala' => $isikepala,
                        'mata' => $isimata,
                        'telinga' => $isitelinga,
                        'hidung' => $isihidung,
                        'rambut' => $isirambut,
                        'bibir' => $isibibir,
                        'gigiGeligi' => $isigigiGeligi,
                        'lidah' => $isilidah,
                        'langitLangit' => $isiLangitLangit,
                        'tonsil' => $isitonsil,
                        'dada' => $isidada,
                        'payudara' => $isipayudara,
                        'punggung' => $isipunggung,
                        'perut' => $isiperut,
                        'genital' => $isigenital,
                        'anus' => $isianus,
                        'lengan_atas' => $isilenganAtas,
                        'lengan_bawah' => $isilenganBawah,
                        'jari_tangan' => $isijariTangan,
                        'kuku_tangan' => $isikukuTangan,
                        'persendian_tangan' => $isipersendianTangan,
                        'tungkai_atas' => $isitungkaiAtas,
                        'tungkai_bawah' => $isitungkaiBawah,
                        'jariKaki' => $isijariKaki,
                        'kukuKaki' => $isikukuKaki,
                        'persendianKaki' => $isipersendianKaki,
                        'createdBy' => $this->request->getVar('createdBy'),
                        'createddate' => $this->request->getVar('createddate'),
                        'doktername' => $this->request->getVar('doktername'),
                        'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                        'keluhanUtama' => $keluhanUTama,
                        'objektive' => $objective,
                        'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                        'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                        'diagnosis' => $this->request->getVar('diagnosis'),
                        'diagnosisSekunder' => $this->request->getVar('diagnosisSekunder'),
                        'planning' => $planning,
                        'deskripsiKonsultasi' => $this->request->getVar('deskripsiKonsultasi'),
                        'tujuanKonsultasi' => $this->request->getVar('tujuanKonsultasi'),
                        'tindakLanjut' => $this->request->getVar('tindakLanjut'),
                        'konsulen' => $this->request->getVar('konsulen'),
                        'file_audio' => $nameFile,
                        'alergi' => $data_alergi,
                        'alergiObat' => $data_alergi_obat,
                        'riwayatPenyakitDahulu' => $riwayatPenyakitDahulu,
                    ];

                    $perawat = new ModelPelayananPoliRMEMedis;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Simpan Berhasil',
                        'JN' => $newkode,

                    ];
                } else {
                    $simpandata = [
                        'groups' => $groups,
                        'registernumber' => $newkode,
                        'referencenumber' => $this->request->getVar('nomorreferensi'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                        'poliklinikname' => $this->request->getVar('poliklinikname'),
                        'admissionDate' => $this->request->getVar('admissionDate'),
                        'gambar_anatomi_tubuh' => $status_lokalis,
                        'kesadaran' => $this->request->getVar('kesadaran'),
                        'tb' => $this->request->getVar('tb'),
                        'bb' => $this->request->getVar('bb'),
                        'denyut_jantung' => $this->request->getVar('frekuensiNadi'),
                        'pernapasan' => $this->request->getVar('pernapasan'),
                        'tdSistolik' => $this->request->getVar('tdSistolik'),
                        'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                        'suhu' => $this->request->getVar('suhu'),
                        'kepala' => $isikepala,
                        'mata' => $isimata,
                        'telinga' => $isitelinga,
                        'hidung' => $isihidung,
                        'rambut' => $isirambut,
                        'bibir' => $isibibir,
                        'gigiGeligi' => $isigigiGeligi,
                        'lidah' => $isilidah,
                        'langitLangit' => $isiLangitLangit,
                        'tonsil' => $isitonsil,
                        'dada' => $isidada,
                        'payudara' => $isipayudara,
                        'punggung' => $isipunggung,
                        'perut' => $isiperut,
                        'genital' => $isigenital,
                        'anus' => $isianus,
                        'lengan_atas' => $isilenganAtas,
                        'lengan_bawah' => $isilenganBawah,
                        'jari_tangan' => $isijariTangan,
                        'kuku_tangan' => $isikukuTangan,
                        'persendian_tangan' => $isipersendianTangan,
                        'tungkai_atas' => $isitungkaiAtas,
                        'tungkai_bawah' => $isitungkaiBawah,
                        'jariKaki' => $isijariKaki,
                        'kukuKaki' => $isikukuKaki,
                        'persendianKaki' => $isipersendianKaki,
                        'createdBy' => $this->request->getVar('createdBy'),
                        'createddate' => $this->request->getVar('createddate'),
                        'doktername' => $this->request->getVar('doktername'),
                        'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                        'keluhanUtama' => $keluhanUTama,
                        'objektive' => $objective,
                        'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                        'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                        'diagnosis' => $this->request->getVar('diagnosis'),
                        'diagnosisSekunder' => $this->request->getVar('diagnosisSekunder'),
                        'planning' => $planning,
                        'deskripsiKonsultasi' => $this->request->getVar('deskripsiKonsultasi'),
                        'tujuanKonsultasi' => $this->request->getVar('tujuanKonsultasi'),
                        'tindakLanjut' => $this->request->getVar('tindakLanjut'),
                        'konsulen' => $this->request->getVar('konsulen'),
                        'file_audio' => $nameFile,
                    ];
                    $perawat = new ModelPelayananPoliRMEMedis;
                    $id = $this->request->getVar('id_cppt');
                    $perawat->update($id, $simpandata);
                    $msg = [
                        'sukses' => 'Perubahan Berhasil Disimpan',
                        'JN' => $newkode,

                    ];
                }
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function AsesmenAwalMedisIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();
            $referencenumber = $this->request->getVar('referencenumber');
            $row = $resume->get_data_pasien_poli_rme($referencenumber);
            $poliklinikname = $row['poliklinikname'];

            if ($poliklinikname == "GIGI DAN MULUT") {
                $file = 'rme/asesmen_awal_medis_gigi';
            } else {
                $file = 'rme/asesmen_awal_medis_umum_igd';
            }

            $cek_triase = $resume->get_data_triase_rme($referencenumber);

            $asesmen_perawat = $resume->get_data_triase_rme($referencenumber);
            // $asesmen_bb = isset($cek_triase['bb']) != null ? $cek_triase['bb'] : "";
            $asesmen_tb = isset($asesmen_perawat['tb']) != null ? $asesmen_perawat['tb'] : "";
            $asesmen_frekuensiNadi = isset($asesmen_perawat['frekuensiNadi']) != null ? $asesmen_perawat['frekuensiNadi'] : "";
            $asesmen_tdSistolik = isset($asesmen_perawat['tdSistolik']) != null ? $asesmen_perawat['tdSistolik'] : "";
            $asesmen_tdDiastolik = isset($asesmen_perawat['tdDiastolik']) != null ? $asesmen_perawat['tdDiastolik'] : "";
            $asesmen_suhu = isset($asesmen_perawat['suhu']) != null ? $asesmen_perawat['suhu'] : "";
            $asesmen_frekuensiNafas = isset($asesmen_perawat['frekuensiNafas']) != null ? $asesmen_perawat['frekuensiNafas'] : "";
            $asesmen_kesadaran = isset($asesmen_perawat['kesadaran']) != null ? $asesmen_perawat['kesadaran'] : "";
            $asesmen_spo2 = isset($asesmen_perawat['spo2']) != null ? $asesmen_perawat['spo2'] : "";
            $asesmen_eye = isset($asesmen_perawat['eye']) != null ? $asesmen_perawat['eye'] : "";
            $asesmen_verbal = isset($asesmen_perawat['verbal']) != null ? $asesmen_perawat['verbal'] : "";
            $asesmen_motorik = isset($asesmen_perawat['motorik']) != null ? $asesmen_perawat['motorik'] : "";
            $asesmen_totalGcs = isset($asesmen_perawat['totalGcs']) != null ? $asesmen_perawat['totalGcs'] : "";
            $admissionDateTime = isset($asesmen_perawat['admissionDateTime']) != null ? $asesmen_perawat['admissionDateTime'] : "";
            $kondisiPasien = isset($asesmen_perawat['kondisiPasien']) != null ? $asesmen_perawat['kondisiPasien'] : "";
            $DiagnosaAskep = isset($asesmen_perawat['DiagnosaAskep']) != null ? $asesmen_perawat['DiagnosaAskep'] : "";
            $uraianAskep = isset($asesmen_perawat['uraianAskep']) != null ? $asesmen_perawat['uraianAskep'] : "";
            $implementasiAskep = isset($asesmen_perawat['implementasiAskep']) != null ? $asesmen_perawat['implementasiAskep'] : "";
            $sasaranRencana = isset($asesmen_perawat['sasaranRencana']) != null ? $asesmen_perawat['sasaranRencana'] : "";
            $keadaanUmum = isset($asesmen_perawat['keadaanUmum']) != null ? $asesmen_perawat['keadaanUmum'] : "";
            $alergi = isset($asesmen_perawat['uraianAlergi']) != null ? $asesmen_perawat['uraianAlergi'] : "";

            $cek_cppt = $resume->get_cek_resume_medis_igd($referencenumber);
            $keluhanUtama = isset($cek_cppt['keluhanUtama']) != null ? strip_tags($cek_cppt['keluhanUtama']) : "";
            $riwayatPenyakitSekarang = isset($cek_cppt['riwayatPenyakitSekarang']) != null ? strip_tags($cek_cppt['riwayatPenyakitSekarang']) : "";
            $riwayatPenyakitKeluarga = isset($cek_cppt['riwayatPenyakitKeluarga']) != null ? strip_tags($cek_cppt['riwayatPenyakitKeluarga']) : "";
            $objektive = isset($cek_cppt['objektive']) != null ? strip_tags($cek_cppt['objektive']) : "";
            $diagnosis = isset($cek_cppt['diagnosis']) != null ? strip_tags($cek_cppt['diagnosis']) : "";
            $diagnosisBanding = isset($cek_cppt['diagnosisBanding']) != null ? strip_tags($cek_cppt['diagnosisBanding']) : "";
            $planning = isset($cek_cppt['planning']) != null ? strip_tags($cek_cppt['planning']) : "";
            $id_cppt = isset($cek_cppt['id']) != null ? $cek_cppt['id'] : "";
            $tindakLanjut = isset($cek_cppt['tindakLanjut']) != null ? $cek_cppt['tindakLanjut'] : "";
            $deskripsiKonsultasi = isset($cek_cppt['deskripsiKonsultasi']) != null ? strip_tags($cek_cppt['deskripsiKonsultasi']) : "";
            $tujuanKonsultasi = isset($cek_cppt['tujuanKonsultasi']) != null ? $cek_cppt['tujuanKonsultasi'] : "";
            $konsulen = isset($cek_cppt['konsulen']) != null ? $cek_cppt['konsulen'] : "";
            $riwayatPenyakitDahulu = isset($cek_cppt['riwayatPenyakitDahulu']) != null ? strip_tags($cek_cppt['riwayatPenyakitDahulu']) : "";

            $data = [
                'skala_nyeri' => $this->data_skala_nyeri(),
                'id' => $row['id'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'nomorreferensi' => $row['journalnumber'],
                'paymentmethodname' => $row['paymentmethodname'],
                'poliklinikname' => $row['poliklinikname'],
                'admissionDate' => $row['documentdate'],
                'doktername' => $row['doktername'],
                'kesadaran' => $this->data_kesadaran(),
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'konsultasi' => $this->data_konsultasi(),
                'tindaklanjut' => $this->data_tindak_lanjut(),
                'asesmen_bb' => $cek_triase['bb'],
                // 'asesmen_bb' => $asesmen_bb,
                'asesmen_tb' => $asesmen_tb,
                'asesmen_frekuensiNadi' => $asesmen_frekuensiNadi,
                'asesmen_tdSistolik' => $asesmen_tdSistolik,
                'asesmen_tdDiastolik' => $asesmen_tdDiastolik,
                'asesmen_suhu' => $asesmen_suhu,
                'asesmen_frekuensiNafas' => $asesmen_frekuensiNafas,
                'asesmen_kesadaran' => $asesmen_kesadaran,
                'list' => $this->_data_dokter(),
                'asesmen_spo2' => $asesmen_spo2,
                'asesmen_eye' => $asesmen_eye,
                'asesmen_verbal' => $asesmen_verbal,
                'asesmen_motorik' => $asesmen_motorik,
                'asesmen_totalGcs' => $asesmen_totalGcs,
                'eye' => $this->eye(),
                'verbal' => $this->verbal(),
                'motorik' => $this->motorik(),
                'admissionDateTime' => $admissionDateTime,
                'kondisiPasien' =>  $kondisiPasien,
                'diagnosa_perawat' => $this->data_diagnosa_perawat(),
                'DiagnosaAskep' =>  $DiagnosaAskep,
                'uraianAskep' =>  $uraianAskep,
                'implementasiAskep' =>  $implementasiAskep,
                'sasaranRencana' => $sasaranRencana,
                'asalPasien' => $this->asalpasienRME(),
                'master_ats' => $this->AtsRME(),
                'keadaanUmum' => $keadaanUmum,
                'alasanRujuk' => $this->AlasanRujuk(),
                'mobil' => $this->mobil(),
                'keluhanUtama' => $keluhanUtama,
                'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                'riwayatPenyakitDahulu' => $riwayatPenyakitDahulu,
                'objective' => $objektive,
                'diagnosis' => $diagnosis,
                'diagnosisBanding' => $diagnosisBanding,
                'planning' => $planning,
                'id_cppt' => $id_cppt,
                'tindakLanjut' => $tindakLanjut,
                'deskripsiKonsultasi' =>  $deskripsiKonsultasi,
                'tujuanKonsultasi' => $tujuanKonsultasi,
                'konsulen' => $konsulen,
                'alergi' => $alergi
            ];

            $msg = [
                'data' => view($file, $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanAsesmenMedisIGD()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {


                $db = db_connect();
                $query = $db->query("SELECT MAX(registernumber) as kode_jurnal  FROM asesmen_awal_medis_rj_rme ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                helper('text');
                $token = random_string('alnum', 6);
                $tokenRME = strtoupper($token);
                $today = date('Y-m-d');
                $rme = 'IGD-RME-MEDIS';
                $groups = 'IGD';
                $underscore = '_';


                $newkode = $tokenRME . $underscore . $today . $underscore . $rme;

                $kepala = $this->request->getVar('kepala');
                $uraiankepala = $this->request->getVar('uraiankepala');
                if ($kepala == 1) {
                    $isikepala = $uraiankepala;
                } else {
                    $isikepala = 0;
                }

                $mata = $this->request->getVar('mata');
                $uraianmata = $this->request->getVar('uraianmata');
                if ($mata == 1) {
                    $isimata = $uraianmata;
                } else {
                    $isimata = 0;
                }

                $telinga = $this->request->getVar('telinga');
                $uraiantelinga = $this->request->getVar('uraiantelinga');
                if ($telinga == 1) {
                    $isitelinga = $uraiantelinga;
                } else {
                    $isitelinga = 0;
                }

                $hidung = $this->request->getVar('hidung');
                $uraianhidung = $this->request->getVar('uraianhidung');
                if ($hidung == 1) {
                    $isihidung = $uraianhidung;
                } else {
                    $isihidung = 0;
                }

                $bibir = $this->request->getVar('bibir');
                $uraianbibir = $this->request->getVar('uraianbibir');
                if ($bibir == 1) {
                    $isibibir = $uraianbibir;
                } else {
                    $isibibir = 0;
                }

                $rambut = $this->request->getVar('rambut');
                $uraianrambut = $this->request->getVar('uraianrambut');
                if ($rambut == 1) {
                    $isirambut = $uraianrambut;
                } else {
                    $isirambut = 0;
                }

                $gigiGeligi = $this->request->getVar('gigiGeligi');
                $uraiangigiGeligi = $this->request->getVar('uraiangigiGeligi');
                if ($gigiGeligi == 1) {
                    $isigigiGeligi = $uraiangigiGeligi;
                } else {
                    $isigigiGeligi = 0;
                }

                $lidah = $this->request->getVar('lidah');
                $uraianlidah = $this->request->getVar('uraianlidah');
                if ($lidah == 1) {
                    $isilidah = $uraianlidah;
                } else {
                    $isilidah = 0;
                }

                $LangitLangit = $this->request->getVar('LangitLangit');
                $uraianLangitLangit = $this->request->getVar('uraianLangitLangit');
                if ($LangitLangit == 1) {
                    $isiLangitLangit = $uraianLangitLangit;
                } else {
                    $isiLangitLangit = 0;
                }

                $leher = $this->request->getVar('leher');
                $uraianleher = $this->request->getVar('uraianleher');
                if ($leher == 1) {
                    $isileher = $uraianleher;
                } else {
                    $isileher = 0;
                }

                $tenggorokan = $this->request->getVar('tenggorokan');
                $uraiantenggorokan = $this->request->getVar('uraiantenggorokan');
                if ($tenggorokan == 1) {
                    $isitenggorokan = $uraiantenggorokan;
                } else {
                    $isitenggorokan = 0;
                }

                $dada = $this->request->getVar('dada');
                $uraiandada = $this->request->getVar('uraiandada');
                if ($dada == 1) {
                    $isidada = $uraiandada;
                } else {
                    $isidada = 0;
                }

                $tonsil = $this->request->getVar('tonsil');
                $uraiantonsil = $this->request->getVar('uraiantonsil');
                if ($tonsil == 1) {
                    $isitonsil = $uraiantonsil;
                } else {
                    $isitonsil = 0;
                }

                $payudara = $this->request->getVar('payudara');
                $uraianpayudara = $this->request->getVar('uraianpayudara');
                if ($payudara == 1) {
                    $isipayudara = $uraianpayudara;
                } else {
                    $isipayudara = 0;
                }

                $perut = $this->request->getVar('perut');
                $uraianperut = $this->request->getVar('uraianperut');
                if ($perut == 1) {
                    $isiperut = $uraianperut;
                } else {
                    $isiperut = 0;
                }

                $punggung = $this->request->getVar('punggung');
                $uraianpunggung = $this->request->getVar('uraianpunggung');
                if ($punggung == 1) {
                    $isipunggung = $uraianpunggung;
                } else {
                    $isipunggung = 0;
                }

                $genital = $this->request->getVar('genital');
                $uraiangenital = $this->request->getVar('uraiangenital');
                if ($genital == 1) {
                    $isigenital = $uraiangenital;
                } else {
                    $isigenital = 0;
                }

                $anus = $this->request->getVar('anus');
                $uraiananus = $this->request->getVar('uraiananus');
                if ($anus == 1) {
                    $isianus = $uraiananus;
                } else {
                    $isianus = 0;
                }

                $lenganAtas = $this->request->getVar('lenganAtas');
                $uraianlenganAtas = $this->request->getVar('uraianlenganAtas');
                if ($lenganAtas == 1) {
                    $isilenganAtas = $uraianlenganAtas;
                } else {
                    $isilenganAtas = 0;
                }

                $lenganBawah = $this->request->getVar('lenganBawah');
                $uraianlenganBawah = $this->request->getVar('uraianlenganBawah');
                if ($lenganBawah == 1) {
                    $isilenganBawah = $uraianlenganBawah;
                } else {
                    $isilenganBawah = 0;
                }

                $jariTangan = $this->request->getVar('jariTangan');
                $uraianjariTangan = $this->request->getVar('uraianjariTangan');
                if ($jariTangan == 1) {
                    $isijariTangan = $uraianjariTangan;
                } else {
                    $isijariTangan = 0;
                }

                $kukuTangan = $this->request->getVar('kukuTangan');
                $uraiankukuTangan = $this->request->getVar('uraiankukuTangan');
                if ($kukuTangan == 1) {
                    $isikukuTangan = $uraiankukuTangan;
                } else {
                    $isikukuTangan = 0;
                }

                $persendianTangan = $this->request->getVar('persendianTangan');
                $uraianpersendianTangan = $this->request->getVar('uraianpersendianTangan');
                if ($persendianTangan == 1) {
                    $isipersendianTangan = $uraianpersendianTangan;
                } else {
                    $isipersendianTangan = 0;
                }

                $tungkaiAtas = $this->request->getVar('tungkaiAtas');
                $uraiantungkaiAtas = $this->request->getVar('uraiantungkaiAtas');
                if ($tungkaiAtas == 1) {
                    $isitungkaiAtas = $uraiantungkaiAtas;
                } else {
                    $isitungkaiAtas = 0;
                }

                $tungkaiBawah = $this->request->getVar('tungkaiBawah');
                $uraiantungkaiBawah = $this->request->getVar('uraiantungkaiBawah');
                if ($tungkaiBawah == 1) {
                    $isitungkaiBawah = $uraiantungkaiBawah;
                } else {
                    $isitungkaiBawah = 0;
                }

                $jariKaki = $this->request->getVar('jariKaki');
                $uraianjariKaki = $this->request->getVar('uraianjariKaki');
                if ($jariKaki == 1) {
                    $isijariKaki = $uraianjariKaki;
                } else {
                    $isijariKaki = 0;
                }

                $kukuKaki = $this->request->getVar('kukuKaki');
                $uraiankukuKaki = $this->request->getVar('uraiankukuKaki');
                if ($kukuKaki == 1) {
                    $isikukuKaki = $uraiankukuKaki;
                } else {
                    $isikukuKaki = 0;
                }

                $persendianKaki = $this->request->getVar('persendianKaki');
                $uraianpersendianKaki = $this->request->getVar('uraianpersendianKaki');
                if ($persendianKaki == 1) {
                    $isipersendianKaki = $uraianpersendianKaki;
                } else {
                    $isipersendianKaki = 0;
                }

                $keluhanUTama = nl2br($this->request->getVar('keluhanUtama'));
                $riwayatPenyakitSekarang = nl2br($this->request->getVar('riwayatPenyakitSekarang'));
                $riwayatPenyakitKeluarga = nl2br($this->request->getVar('riwayatPenyakitKeluarga'));
                $objective = nl2br($this->request->getVar('objective'));
                $planning = nl2br($this->request->getVar('planning'));

                // status lokalis
                $anatomi = $this->request->getVar('anatomi');

                if ($anatomi != "") {
                    $imageName = md5(uniqid(rand(), true)) . '.jpeg';
                    $image = $this->conv($this->request->getVar('anatomi'), $imageName);
                    $status_lokalis = $imageName;
                    // end status lokalis
                } else {
                    $status_lokalis = '';
                }

                // handle file record audio
                $dataAudio = $this->request->getFile('audData');
                $nameFile = null;
                if (!$dataAudio->getError() == 4) {
                    $nameFile = $dataAudio->getRandomName();
                    $dataAudio->move('assets/audio_rme', $nameFile);
                }
                // end handle file record audio


                $preventif = $this->request->getVar('preventif');
                if ($preventif == 1) {
                    $isipreventif = 1;
                } else {
                    $isipreventif = 0;
                }

                $kuratif = $this->request->getVar('kuratif');
                if ($kuratif == 1) {
                    $isikuratif = 1;
                } else {
                    $isikuratif = 0;
                }

                $paliatif = $this->request->getVar('paliatif');
                if ($paliatif == 1) {
                    $isipaliatif = 1;
                } else {
                    $isipaliatif = 0;
                }

                $rehabilitatif = $this->request->getVar('rehabilitatif');
                if ($rehabilitatif == 1) {
                    $isirehabilitatif = 1;
                } else {
                    $isirehabilitatif = 0;
                }


                $admissionDateTimeAsesmen = $this->request->getVar('admissionDateTimeAsesmen');
                $tglasesmen = explode(" ", $admissionDateTimeAsesmen);
                $asesmenDate = $tglasesmen[0];
                $asesmenTime = $tglasesmen[1];

                $explode_tanggal = explode("-", $asesmenDate);
                $tahun = $explode_tanggal[2];
                $bulan = $explode_tanggal[1];
                $hari = $explode_tanggal[0];

                $tanggal_jam_asesmen = $tahun . '-' . $bulan . '-' . $hari . ' ' . $asesmenTime;


                $id_cppt = $this->request->getVar('id_cppt');

                if ($id_cppt == "") {


                    $simpandata = [
                        'groups' => $groups,
                        'registernumber' => $newkode,
                        'referencenumber' => $this->request->getVar('nomorreferensi'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                        'poliklinikname' => $this->request->getVar('poliklinikname'),
                        'admissionDate' => $this->request->getVar('admissionDate'),
                        'gambar_anatomi_tubuh' => $status_lokalis,
                        'kesadaran' => $this->request->getVar('kesadaran'),
                        'tb' => $this->request->getVar('tb'),
                        'bb' => $this->request->getVar('bb'),
                        'denyut_jantung' => $this->request->getVar('frekuensiNadi'),
                        'pernapasan' => $this->request->getVar('pernapasan'),
                        'tdSistolik' => $this->request->getVar('tdSistolik'),
                        'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                        'suhu' => $this->request->getVar('suhu'),
                        'kepala' => $isikepala,
                        'mata' => $isimata,
                        'telinga' => $isitelinga,
                        'hidung' => $isihidung,
                        'rambut' => $isirambut,
                        'bibir' => $isibibir,
                        'gigiGeligi' => $isigigiGeligi,
                        'lidah' => $isilidah,
                        'langitLangit' => $isiLangitLangit,
                        'tonsil' => $isitonsil,
                        'dada' => $isidada,
                        'payudara' => $isipayudara,
                        'punggung' => $isipunggung,
                        'perut' => $isiperut,
                        'genital' => $isigenital,
                        'anus' => $isianus,
                        'lengan_atas' => $isilenganAtas,
                        'lengan_bawah' => $isilenganBawah,
                        'jari_tangan' => $isijariTangan,
                        'kuku_tangan' => $isikukuTangan,
                        'persendian_tangan' => $isipersendianTangan,
                        'tungkai_atas' => $isitungkaiAtas,
                        'tungkai_bawah' => $isitungkaiBawah,
                        'jariKaki' => $isijariKaki,
                        'kukuKaki' => $isikukuKaki,
                        'persendianKaki' => $isipersendianKaki,
                        'createdBy' => $this->request->getVar('createdBy'),
                        'createddate' => $this->request->getVar('createddate'),
                        'doktername' => $this->request->getVar('doktername'),
                        'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                        'keluhanUtama' => $keluhanUTama,
                        'objektive' => $objective,
                        'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                        'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                        'diagnosis' => $this->request->getVar('diagnosis'),
                        'diagnosisBanding' => $this->request->getVar('diagnosisBanding'),
                        'planning' => $planning,
                        'deskripsiKonsultasi' => $this->request->getVar('deskripsiKonsultasi'),
                        'tujuanKonsultasi' => $this->request->getVar('tujuanKonsultasi'),
                        'tindakLanjut' => $this->request->getVar('tindakLanjut'),
                        'konsulen' => $this->request->getVar('konsulen'),
                        'file_audio' => $nameFile,
                        'preventif' => $isipreventif,
                        'kuratif' => $isikuratif,
                        'paliatif' => $isipaliatif,
                        'rehabilitatif' => $isirehabilitatif,
                        'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                        'admissionDateTimeAsesmen' => $tanggal_jam_asesmen,
                        'kondisiPasien' => $this->request->getVar('kondisiPasien'),
                        'ats' => $this->request->getVar('ats'),
                        'asalPasien' => $this->request->getVar('asalPasien'),
                        'hamil' => $this->request->getVar('hamil'),
                        'grapida' => $this->request->getVar('grapida'),
                        'partus' => $this->request->getVar('partus'),
                        'abortus' => $this->request->getVar('abortus'),
                        'umurKehamilan' => $this->request->getVar('umurKehamilan'),
                        'alergi' => $this->request->getVar('alergi'),
                        'alergiObat' => $this->request->getVar('alergiObat'),
                        'eye' => $this->request->getVar('eye'),
                        'verbal' => $this->request->getVar('verbal'),
                        'motorik' => $this->request->getVar('motorik'),
                        'totalGcs' => $this->request->getVar('totalGcs'),
                        'keadaanUmum' => $this->request->getVar('keadaanUmum'),
                        'riwayatPenyakitDahulu' => $this->request->getVar('riwayatPenyakitDahulu'),
                        'anamnesis' => $this->request->getVar('anamnesis'),
                        'uraianAllo' => $this->request->getVar('uraianAllo'),
                        'pemeriksaanFisik' => $this->request->getVar('pemeriksaanFisik'),
                        'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                        'hasil_uraianAskep' => $this->request->getVar('hasil_uraianAskep'),
                        'hasil_sasaranRencana' => $this->request->getVar('hasil_sasaranRencana'),
                        'hasil_tindakanEvaluasi' => $this->request->getVar('hasil_tindakanEvaluasi'),
                        'obatRutin' => $this->request->getVar('obatRutin'),
                        'namaObatRutin' => $this->request->getVar('namaObatRutin'),
                        'tujuanRujuk' => $this->request->getVar('tujuanRujuk'),
                        'indikasiRujuk' => $this->request->getVar('indikasiRujuk'),
                    ];

                    $perawat = new ModelPelayananPoliRMEMedis;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Simpan Berhasil',
                        'JN' => $newkode,

                    ];
                } else {
                    $simpandata = [
                        'groups' => $groups,
                        'registernumber' => $newkode,
                        'referencenumber' => $this->request->getVar('nomorreferensi'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                        'poliklinikname' => $this->request->getVar('poliklinikname'),
                        'admissionDate' => $this->request->getVar('admissionDate'),
                        'gambar_anatomi_tubuh' => $status_lokalis,
                        'kesadaran' => $this->request->getVar('kesadaran'),
                        'tb' => $this->request->getVar('tb'),
                        'bb' => $this->request->getVar('bb'),
                        'denyut_jantung' => $this->request->getVar('frekuensiNadi'),
                        'pernapasan' => $this->request->getVar('pernapasan'),
                        'tdSistolik' => $this->request->getVar('tdSistolik'),
                        'tdDiastolik' => $this->request->getVar('tdDiastolik'),
                        'suhu' => $this->request->getVar('suhu'),
                        'kepala' => $isikepala,
                        'mata' => $isimata,
                        'telinga' => $isitelinga,
                        'hidung' => $isihidung,
                        'rambut' => $isirambut,
                        'bibir' => $isibibir,
                        'gigiGeligi' => $isigigiGeligi,
                        'lidah' => $isilidah,
                        'langitLangit' => $isiLangitLangit,
                        'tonsil' => $isitonsil,
                        'dada' => $isidada,
                        'payudara' => $isipayudara,
                        'punggung' => $isipunggung,
                        'perut' => $isiperut,
                        'genital' => $isigenital,
                        'anus' => $isianus,
                        'lengan_atas' => $isilenganAtas,
                        'lengan_bawah' => $isilenganBawah,
                        'jari_tangan' => $isijariTangan,
                        'kuku_tangan' => $isikukuTangan,
                        'persendian_tangan' => $isipersendianTangan,
                        'tungkai_atas' => $isitungkaiAtas,
                        'tungkai_bawah' => $isitungkaiBawah,
                        'jariKaki' => $isijariKaki,
                        'kukuKaki' => $isikukuKaki,
                        'persendianKaki' => $isipersendianKaki,
                        'createdBy' => $this->request->getVar('createdBy'),
                        'createddate' => $this->request->getVar('createddate'),
                        'doktername' => $this->request->getVar('doktername'),
                        'frekuensiNadi' => $this->request->getVar('frekuensiNadi'),
                        'keluhanUtama' => $keluhanUTama,
                        'objektive' => $objective,
                        'riwayatPenyakitSekarang' => $riwayatPenyakitSekarang,
                        'riwayatPenyakitKeluarga' => $riwayatPenyakitKeluarga,
                        'diagnosis' => $this->request->getVar('diagnosis'),
                        'diagnosisBanding' => $this->request->getVar('diagnosisBanding'),
                        'planning' => $planning,
                        'deskripsiKonsultasi' => $this->request->getVar('deskripsiKonsultasi'),
                        'tujuanKonsultasi' => $this->request->getVar('tujuanKonsultasi'),
                        'tindakLanjut' => $this->request->getVar('tindakLanjut'),
                        'konsulen' => $this->request->getVar('konsulen'),
                        'file_audio' => $nameFile,
                        'preventif' => $isipreventif,
                        'kuratif' => $isikuratif,
                        'paliatif' => $isipaliatif,
                        'rehabilitatif' => $isirehabilitatif,
                        'admissionDateTime' => $this->request->getVar('admissionDateTime'),
                        'admissionDateTimeAsesmen' => $tanggal_jam_asesmen,
                        'kondisiPasien' => $this->request->getVar('kondisiPasien'),
                        'ats' => $this->request->getVar('ats'),
                        'asalPasien' => $this->request->getVar('asalPasien'),
                        'hamil' => $this->request->getVar('hamil'),
                        'grapida' => $this->request->getVar('grapida'),
                        'partus' => $this->request->getVar('partus'),
                        'abortus' => $this->request->getVar('abortus'),
                        'umurKehamilan' => $this->request->getVar('umurKehamilan'),
                        'alergi' => $this->request->getVar('alergi'),
                        'alergiObat' => $this->request->getVar('alergiObat'),
                        'eye' => $this->request->getVar('eye'),
                        'verbal' => $this->request->getVar('verbal'),
                        'motorik' => $this->request->getVar('motorik'),
                        'totalGcs' => $this->request->getVar('totalGcs'),
                        'keadaanUmum' => $this->request->getVar('keadaanUmum'),
                        'riwayatPenyakitDahulu' => $this->request->getVar('riwayatPenyakitDahulu'),
                        'anamnesis' => $this->request->getVar('anamnesis'),
                        'uraianAllo' => $this->request->getVar('uraianAllo'),
                        'pemeriksaanFisik' => $this->request->getVar('pemeriksaanFisik'),
                        'DiagnosaAskep' => $this->request->getVar('DiagnosaAskep'),
                        'hasil_uraianAskep' => $this->request->getVar('hasil_uraianAskep'),
                        'hasil_sasaranRencana' => $this->request->getVar('hasil_sasaranRencana'),
                        'hasil_tindakanEvaluasi' => $this->request->getVar('hasil_tindakanEvaluasi'),
                        'obatRutin' => $this->request->getVar('obatRutin'),
                        'namaObatRutin' => $this->request->getVar('namaObatRutin'),
                        'tujuanRujuk' => $this->request->getVar('tujuanRujuk'),
                        'indikasiRujuk' => $this->request->getVar('indikasiRujuk'),
                    ];
                    $perawat = new ModelPelayananPoliRMEMedis;
                    $id = $this->request->getVar('id_cppt');
                    $perawat->update($id, $simpandata);
                    $msg = [
                        'sukses' => 'Perubahan Berhasil Disimpan',
                        'JN' => $newkode,

                    ];
                }
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ajax_aturan_pakai()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_aturan_pakai($key);
        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'],
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function editCppt()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();

            $data = [
                'tampildata' => $resume->get_cppt_edit($this->request->getVar('id')),
            ];

            $msg = [
                'data' => view('rme/modal_edit_cppt', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function editCpptRajal()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();

            $data = [
                'tampildata' => $resume->get_cppt_edit_rajal($this->request->getVar('id')),
            ];

            $msg = [
                'data' => view('rme/modal_edit_cppt', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function updateCppt()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPelayananPoliRME();

            $updateData = [
                's' => $this->request->getVar('subjektif'),
                'o' => $this->request->getVar('obyektif'),
                'a' => $this->request->getVar('asesmen'),
                'p' => $this->request->getVar('planning'),
            ];

            $data = [
                'tampildata' => $resume->update_cppt_edit($this->request->getVar('id'), $updateData),
            ];

            $msg = [
                'sukses' => 'Data CPPT berhasil di ubah !!'
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function planingFarmakologis()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'pasienid' => $this->request->getVar('id'),
                'nomorKunjungan' => $this->request->getVar('nomorKunjungan'),
            ];

            $msg = [
                'sukses' => view('rme/modal_planing_farmakologis', $data)
            ];
            return json_encode($msg);
        }
    }

    public function resumePlaningFarmakologis()
    {
        if ($this->request->isAJAX()) {

            $pasienid = $this->request->getVar('pasienid');
            $register = new ModelPelayananPoliRME();
            $master = $register->search_RiwayatPasien_resep($pasienid);
            $nomorKunjungan = $this->request->getVar('nomorKunjungan');

            foreach ($master as $row_master) {
                $id[] = $row_master['journalnumber'];
                $id2[] = $row_master['referencenumber'];
            }
            foreach ($master as $index => $row) {
                $pem[$index]['journalnumber'] = $row['journalnumber'];
                $pem[$index]['pasienid'] = $row['pasienid'];
                $pem[$index]['pasienname'] = $row['pasienname'];
                $pem[$index]['documentdate'] = $row['documentdate'];
                $pem[$index]['doktername'] = $row['doktername'];
                $pem[$index]['poliklinikname'] = $row['poliklinikname'];

                $detailResep = $register->search_resep_detail_all($id2);




                $pem[$index]['listResep'] = [];
                foreach ($detailResep as $itemResep) {

                    if ($itemResep['journalnumber'] == $row['journalnumber']) {
                        $pem[$index]['listResep'][] = $itemResep;
                    }
                }
            }

            $data = [
                'tampildata' => $pem,
                'nomorKunjungan' => $nomorKunjungan,
            ];

            $msg = [
                'data' => view('rme/data_planing_farmakologis', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function planingNonFarmakologis()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'pasienid' => $this->request->getVar('id'),
                'nomorKunjungan' => $this->request->getVar('nomorKunjungan'),
            ];

            $msg = [
                'sukses' => view('rme/modal_planing_non_farmakologis', $data)
            ];
            return json_encode($msg);
        }
    }

    public function resumePlaningNonFarmakologis()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetailRJ();

            $referencenumber = $this->request->getVar('nomorKunjungan');
            $data = [
                'tampildata' => $perawat->search_tindakan_igd_rme($referencenumber),
            ];

            return json_encode(view('rme/data_planing_non_farmakologis', $data));
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function templateEresep()
    {
        if ($this->request->isAJAX()) {
            return json_encode([
                'sukses' => view('rme/modal_template_e_resep', [
                    'referencenumber_transaksi' => $this->request->getVar('referencenumber_transaksi'),
                    'journalnumber' => $this->request->getVar('journalnumber')
                ])
            ]);
        }
    }

    public function getDataTemplateEresep()
    {
        if ($this->request->isAJAX()) {
            $data_header = new ModelTempletEresepHeader();
            return json_encode([
                'data' => view('rme/data_e_resep', [
                    'datas' => $data_header->detail_e_resep(),
                    'referencenumber_transaksi' => $this->request->getVar('referencenumber_transaksi'),
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'racikan' => $this->racikan_rme(),
                    'itemracikan' => $this->itemracikan(),
                ])
            ]);
        }
    }

    public function useDataTemplateEresep()
    {
        if ($this->request->isAJAX()) {
            $journalnumber = $this->request->getVar('journalnumber');

            $referencenumber_obat = $this->request->getVar('referencenumber_obat');

            $header = new ModelFarmasiPelayananHeader();
            $data_header_resep = $header->where('journalnumber', $journalnumber)->first();

            $data_detail = new ModelTempletEresepDetail();
            $list_detail = $data_detail->where('referencenumber', $referencenumber_obat)->findAll();
            $counter = 0;

            $result_obat = [];
            foreach ($list_detail as $data) {
                $data_obat = $data_detail->get_obat_rme($data['kode_obat'], $data_header_resep['locationcode']);
                if (count($data_obat) > 0) {
                    if ($data['jumlah_obat'] <= $data_obat[0]['balance']) {
                        $result_obat[] = [
                            'kode_obat' => $data_obat[0]['code'],
                            'batchnumber' => $data_obat[0]['batchnumber'],
                            'uom' => $data_obat[0]['uom'],
                            'price' => $data_obat[0]['salesprice'],
                            'qtystock' => $data_obat[0]['balance'],
                            'signa' => "1X1",
                            'racikan' => "SATUAN",
                            'koderacikan' => $data['koderacikan'] ?? "-",
                            'nama_obat' => $data_obat[0]['name'],
                            'qtyresep' => $data['jumlah_obat'],
                            'expireddate' => $data_obat[0]['expireddate'],
                            'carapakai' => '-'
                        ];
                        ++$counter;
                    }
                }
            }

            if (!empty($result_obat)) {
                return json_encode([
                    'success' => $result_obat
                ]);
            }

            return json_encode([
                'error' => 'Data history obat tidak ada'
            ]);
        }
    }

    function editAsesmenPulangRanap()
    {
        if ($this->request->isAJAX()) {
            $data = new ModelAsesmenPasienPulangRME;
            $asesmen_pulang = $data->where('referencenumber', $this->request->getVar('referencenumber'))
                ->first();
            if ($asesmen_pulang == null) {
                return json_encode([
                    'error' => 'Data asesmen medis tidak ditemukan !!'
                ]);
            }

            return json_encode([
                'sukses' => view('rme/modal_edit_asesmen_pulang_ranap', [
                    'data' => $asesmen_pulang
                ])
            ]);
        }
    }

    function updateAsesmenPulangRanap()
    {
        if ($this->request->isAJAX()) {
            $data = new ModelAsesmenPasienPulangRME;

            $tgl_masuk = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getVar('dateIn'))));
            $tgl_keluar = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getVar('dateOut'))));
            $tgl_kontrol = $this->request->getVar('tanggalKontrol');
            if (!in_array($this->request->getVar('tanggalKontrol'), ['-', null])) {
                $tgl_kontrol = date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getVar('tanggalKontrol'))));
            }

            $data_daftar_ranap = new ModelDaftarRanap();
            $data_ranap = $data_daftar_ranap->orderBy('id', 'DESC')->where('referencenumber', $this->request->getVar('referencenumber'))->first();

            $data->update($this->request->getVar('id'), [
                'diagnosisMasuk' => $this->request->getVar('diagnosisMasuk'),
                'lastRoom' => $this->request->getVar('lastRoom'),
                'dateIn' => $tgl_masuk,
                'dateOut' => $tgl_keluar,
                'alasanRawat' => $this->request->getVar('alasanRawat'),
                'ringkasanRiwayatPenyakit' => $this->request->getVar('ringkasanRiwayatPenyakit'),
                'hasilPemeriksaanFisik' => $this->request->getVar('hasilPemeriksaanFisik'),
                'pemeriksaanPenunjang' => $this->request->getVar('pemeriksaanPenunjang'),
                'terapiSelamaRawat' => $this->request->getVar('terapiSelamaRawat'),
                'perkembanganSetelahPerawatan' => $this->request->getVar('perkembanganSetelahPerawatan'),
                'alergiObat' => $this->request->getVar('alergiObat'),
                'kondisiWaktuKeluar' => $this->request->getVar('kondisiWaktuKeluar'),
                'pengobatanDilanjutkan' => $this->request->getVar('pengobatanDilanjutkan'),
                'tanggalKontrol' => $tgl_kontrol,
                'diagnosisUtama' => $this->request->getVar('diagnosisUtama'),
                'diagnosisSekunder' => $this->request->getVar('diagnosisSekunder'),
                'prosedur' => $this->request->getVar('prosedur'),
                'createdBy' => session()->get('firstname'),
                'updated_at' => date('Y-m-d')
            ]);

            $tb_ranap = new ModelDaftarRanap();
            $tb_ranap->update($data_ranap['id'], [
                'datein' => $tgl_masuk,
                'datetimein' => $tgl_masuk . ' ' . $data_ranap['timein'],
                'dateout' =>  $tgl_keluar,
                'datetimeout' => $tgl_keluar . ' ' . $data_ranap['timeout'],
            ]);

            return json_encode([
                'sukses' => 'Berhasil Update Asesmen Pulang Pasien Rawat Inap'
            ]);
        }
    }

    public function historyEresep()
    {
        if ($this->request->isAJAX()) {
            return json_encode([
                'sukses' => view('rme/modal_history_e_resep')
            ]);
        }
    }

    public function getDataHistoryEresep()
    {
        if ($this->request->isAJAX()) {

            $data_header = new ModelTempletEresepHeader();
            return json_encode([
                'data' => view('rme/data_history_e_resep', [
                    'datas' => $data_header->get_history_e_resep($this->request->getVar('pasienid')),
                    'journalnumberbaru' => $this->request->getVar('journalnumber'),
                    'racikan' => $this->racikan_rme(),
                    'itemracikan' => $this->itemracikan(),
                ])
            ]);
        }
    }

    public function useDataHistoryEresep()
    {
        if ($this->request->isAJAX()) {
            $journalnumber_baru = $this->request->getVar('journalnumberbaru');
            $header = new ModelFarmasiPelayananHeader();
            $data_header_resep = $header->where('journalnumber', $journalnumber_baru)->first();

            $data_detail = new ModelFarmasiPelayananDetail();
            $list_detail = $data_detail
                ->select('journalnumber, qty, racikan, r, koderacikan, jumlahracikan, signa1, signa2, qtypaket, qtyresep, qtyluarpaket, eticket_aturan, eticket_carapakai, eticket_petunjuk, code')
                ->where('journalnumber', $this->request->getVar('journalnumberlama'))->findAll();
            $result_obat = [];
            foreach ($list_detail as $data) {
                $data_obat = $data_detail->get_obat_rme($data['code'], $data_header_resep['locationcode']);
                if ($data['qty'] <= $data_obat[0]['balance']) {
                    $result_obat[] = [
                        'kode_obat' => $data_obat[0]['code'],
                        'batchnumber' => $data_obat[0]['batchnumber'],
                        'uom' => $data_obat[0]['uom'],
                        'price' => $data_obat[0]['salesprice'],
                        'qtystock' => $data_obat[0]['balance'],
                        'signa' => round($data['signa1'], 0) . 'X' . round($data['signa2'], 0),
                        'racikan' => $data['racikan'] == "0.00" ? "SATUAN" : "BUNGKUS",
                        'koderacikan' => $data['koderacikan'] == "" ? "-" : $data['koderacikan'],
                        'nama_obat' => $data_obat[0]['name'],
                        'qtyresep' => round(abs($data['qty']), 0),
                        'expireddate' => $data_obat[0]['expireddate'],
                        'carapakai' => $data['eticket_carapakai']
                    ];
                }
            }

            if (!empty($result_obat)) {
                return json_encode([
                    'success' => $result_obat
                ]);
            }

            return json_encode([
                'error' => 'Data history obat tidak ada'
            ]);
        }
    }

    public function printfilecppt()

    {

        $dompdf = new Dompdf();
        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $kunjungan_pasien = $pasien->get_data_pasien_rme_ranap($referencenumber);
        $resume_medis = $pasien->get_data_resume_medis_ranap($referencenumber);
        $data = [
            // kop
            'kop' => $pasien->get_data_kasir2($lokasikasir),
            'kunjungan_pasien_ranap' => $pasien->get_data_pasien_rme_ranap($referencenumber),
            'resume_medis_ranap' => $pasien->get_data_resume_medis_ranap($referencenumber),
            'Cpptall' =>  $pasien->get_cppt_all($referencenumber)
        ];

        return view('rme/Filecppt_download', $data);
    }

    public function EditLOGeneral()
    {
        if ($this->request->isAJAX()) {
            $lap = new ModelLaporanOperasiRME();
            $data_lap = $lap->select('id, doktername, admissionDate, dokterAnestesi, prosedurop, referencenumber, katarak, cito, elektif, asalRuangan, kamarOperasi, smfName, perawatAnestesi, scrubNurse, asisten1, asisten2, circulationNurse, posisiOperasi, jenisSayatan, skinPerparasi, jenisPembedahan, diagnosaPraBedah,
            indikasiOperasi, jenisOperasi, diagnosaPascaBedah, startDateTimeOp, stopDateTimeOp, lamaOperasi, jaringanSpesimenOperasi, jaringanSpesimenAspirasi, jaringanSpesimenkaterisasi, lokalisasi, dikirimPA, profilaksisAntibiotik, jamPemberian, laporanJalanOperasi, komplikasiPascaBedah, jumlahPerdarahan, transfusiDarah, pcr, wb, jumlahPcrWb, jenisInplan, noRegInplan, skriningNurse, prosedurOp')
                ->orderBy('id', 'DESC')
                ->where('referencenumber', $this->request->getVar('id'))
                ->where('katarak', '0')
                ->first();

            $data = [
                'data' => $data_lap,
                'skin' => $this->skin(),
                'jenisPembedahan' => $this->jenisPembedahan(),
                'kamarOperasi' => $this->kamarOperasi(),
            ];
            $msg = [
                'sukses' => view('rme/modalupdate_lo_general', $data)
            ];
            return json_encode($msg);
        }
    }

    public function updateLOGeneral()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'createdBy' => [
                    'label' => 'Nama Perawat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'createdBy' => $validation->getError('createdBy')
                    ]
                ];
            } else {

                $startDateTimeOpawal = $this->request->getVar("startDateTimeOp");
                $tglmulai = explode(" ", $startDateTimeOpawal);
                $tglmulaiOp = $tglmulai[0];
                $jammulaiOp = $tglmulai[1];
                $stopDateTimeOpConvert = date('Y-m-d', strtotime($tglmulaiOp));
                $startDateTimeOp = $stopDateTimeOpConvert . ' ' . $jammulaiOp;


                $stopDateTimeOpawal = $this->request->getVar("stopDateTimeOp");
                $tglselesai = explode(" ", $stopDateTimeOpawal);
                $tglselesaiOp = $tglselesai[0];
                $jamselesaiOp = $tglselesai[1];
                $stopDateTimeOpConvert = date('Y-m-d', strtotime($tglselesaiOp));
                $stopDateTimeOp = $stopDateTimeOpConvert . ' ' . $jamselesaiOp;

                $simpandata = [
                    'admissionDate' => date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getVar('admissionDate')))),
                    'doktername' => $this->request->getVar('doktername'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'dokterAnestesi' => $this->request->getVar('dokterAnestesi'),
                    'cito' => $this->request->getVar('cito'),
                    'elektif' => $this->request->getVar('elektif'),
                    'asalRuangan' => $this->request->getVar('asalRuangan'),
                    'kamarOperasi' => $this->request->getVar('kamarOperasi'),
                    'smfName' => $this->request->getVar('smfName'),
                    'perawatAnestesi' => $this->request->getVar('perawatAnestesi'),
                    'scrubNurse' => $this->request->getVar('scrubNurse'),
                    'asisten1' => $this->request->getVar('asisten1'),
                    'asisten2' => $this->request->getVar('asisten2'),
                    'circulationNurse' => $this->request->getVar('circulationNurse'),
                    'posisiOperasi' => $this->request->getVar('posisiOperasi'),
                    'jenisSayatan' => $this->request->getVar('jenisSayatan'),
                    'skinPerparasi' => $this->request->getVar('skinPerparasi'),
                    'jenisPembedahan' => $this->request->getVar('jenisPembedahan'),
                    'diagnosaPraBedah' => $this->request->getVar('diagnosaPraBedah'),
                    'indikasiOperasi' => $this->request->getVar('indikasiOperasi'),
                    'jenisOperasi' => $this->request->getVar('jenisOperasi'),
                    'diagnosaPascaBedah' => $this->request->getVar('diagnosaPascaBedah'),
                    'startDateTimeOp' => $startDateTimeOp,
                    'stopDateTimeOp' => $stopDateTimeOp,
                    'lamaOperasi' => $this->request->getVar('lamaOperasi'),
                    'jaringanSpesimenOperasi' => $this->request->getVar('jaringanSpesimenOperasi'),
                    'jaringanSpesimenAspirasi' => $this->request->getVar('jaringanSpesimenAspirasi'),
                    'jaringanSpesimenkaterisasi' => $this->request->getVar('jaringanSpesimenkaterisasi'),
                    'lokalisasi' => $this->request->getVar('lokalisasi'),
                    'dikirimPA' => $this->request->getVar('dikirimPA'),
                    'profilaksisAntibiotik' => $this->request->getVar('profilaksisAntibiotik'),
                    'jamPemberian' => $this->request->getVar('jamPemberian'),
                    'laporanJalanOperasi' => $this->request->getVar('laporanJalanOperasi'),
                    'komplikasiPascaBedah' => $this->request->getVar('komplikasiPascaBedah'),
                    'jumlahPerdarahan' => $this->request->getVar('jumlahPerdarahan'),
                    'transfusiDarah' => $this->request->getVar('transfusiDarah'),
                    'pcr' => $this->request->getVar('pcr'),
                    'wb' => $this->request->getVar('wb'),
                    'jumlahPcrWb' => $this->request->getVar('jumlahPcrWb'),
                    'jenisInplan' => $this->request->getVar('jenisInplan'),
                    'noRegInplan' => $this->request->getVar('noRegInplan'),
                    'prosedurOp' => $this->request->getVar('prosedurOp'),
                ];

                $perawat = new ModelLaporanOperasiRME;
                $perawat->update($this->request->getVar('id'), $simpandata);
                $msg = [
                    'sukses' => 'Update Data Berhasil',
                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function EditLOKatarak()
    {
        if ($this->request->isAJAX()) {

            $lap = new ModelLaporanOperasiRME();
            $data_lap = $lap->select('id, referencenumber, pasienid, pasienname, poliklinikname, paymentmethodname, admissionDate, doktername, createdBy, createddate, verifikasiDPJP, tanggalJamVerifikasi, verifikator, diagnosis, dokterOperator, dokterAnestesi,tindakanOperasi, od, os, cataractGrade, noteOp, ucva, bcva, retinometry, k1, k2, axl, acd, lt, formula, emetropia, visus, typeOperasi, intraOperativeDate, intraOperativeTime, anesthesilogist, scrub, cukator, anestehesia, approach, capsulotomy, hydrodissection, nucleus, phaco, iol, stitch, phacoMachine, phacoTime, irigatingSolution, komplikasi, posterior, vitreus, vitrectomy, retained, cortex, katarak')
                ->orderBy('id', 'DESC')
                ->where('referencenumber', $this->request->getVar('id'))
                ->where('katarak', '1')
                ->first();

            $data = [
                'data' => $data_lap,
                'anesthesia' => $this->anesthesia(),
                'approach' => $this->approach(),
                'capsulotomy' => $this->capsulotomy(),
                'nucleus' => $this->nucleus(),
                'phaco' => $this->phaco(),
                'iol' => $this->iol(),
                'stitch' => $this->stitch(),
                'perawat_katarak' => $this->perawat_katarak(),

            ];
            $msg = [
                'sukses' => view('rme/modalupdate_lo_katarak', $data)
            ];
            return json_encode($msg);
        }
    }

    public function updateLOKatarak()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'createdBy' => [
                    'label' => 'Nama Perawata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'createdBy' => $validation->getError('createdBy')
                    ]
                ];
            } else {
                $simpandata = [
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'doktername' => $this->request->getVar('doktername'),
                    'createddate' => date('Y-m-d G:i:s'),
                    'createdBy' => $this->request->getVar('createdBy'),
                    'od' => $this->request->getVar('od'),
                    'os' => $this->request->getVar('os'),
                    'cataractGrade' => $this->request->getVar('cataractGrade'),
                    'noteOp' => $this->request->getVar('noteOp'),
                    'ucva' => $this->request->getVar('ucva'),
                    'bcva' => $this->request->getVar('bcva'),
                    'retinometry' => $this->request->getVar('retinometry'),
                    'k1' => $this->request->getVar('k1'),
                    'k2' => $this->request->getVar('k2'),
                    'axl' => $this->request->getVar('axl'),
                    'acd' => $this->request->getVar('acd'),
                    'lt' => $this->request->getVar('lt'),
                    'formula' => $this->request->getVar('formula'),
                    'emetropia' => $this->request->getVar('emetropia'),
                    'visus' => $this->request->getVar('visus'),
                    'intraOperativeDate' => $this->request->getVar('intraOperativeDate'),
                    'intraOperativeTime' => $this->request->getVar('intraOperativeTime'),
                    'typeOperasi' => $this->request->getVar('typeOperasi'),
                    'anesthesilogist' => $this->request->getVar('anesthesilogist'),
                    'scrub' => $this->request->getVar('scrub'),
                    'cukator' => $this->request->getVar('cukator'),
                    'anestehesia' => $this->request->getVar('anestehesia'),
                    'approach' => $this->request->getVar('approach'),
                    'capsulotomy' => $this->request->getVar('capsulotomy'),
                    'hydrodissection' => $this->request->getVar('hydrodissection'),
                    'nucleus' => $this->request->getVar('nucleus'),
                    'phaco' => $this->request->getVar('phaco'),
                    'iol' => $this->request->getVar('iol'),
                    'stitch' => $this->request->getVar('stitch'),
                    'phacoMachine' => $this->request->getVar('phacoMachine'),
                    'phacoTime' => $this->request->getVar('phacoTime'),
                    'irigatingSolution' => $this->request->getVar('irigatingSolution'),
                    'komplikasi' => $this->request->getVar('komplikasi'),
                    'posterior' => $this->request->getVar('posterior'),
                    'vitreus' => $this->request->getVar('vitreus'),
                    'vitrectomy' => $this->request->getVar('vitrectomy'),
                    'retained' => $this->request->getVar('retained'),
                    'cortex' => $this->request->getVar('cortex'),
                    'katarak' => 1,

                ];

                $katarak = new ModelLaporanOperasiRME;
                $katarak->update($this->request->getVar('id'), $simpandata);
                $msg = [
                    'sukses' => 'Update Data Laporan Katarak Berhasil',
                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    function downloadAllArsip()
    {

        $dompdf = new Dompdf();
        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();

        $resume = new ModelTNODetail();

        $pilihancabar = $this->request->getVar('rincian');

        $split = new ModelKlaim();
        $cetak = new ModelCetakDetail_A();

        $apotekKasir_RI = $resume->kasir_apotek_rinap_aliit($referencenumber);
        $apotekKasir_RJ = $resume->kasir_apotek_rajal_aliit($referencenumber);

        $pnjKasir_RI = $resume->kasir_pnj_rinap_aliit($referencenumber);
        $pnjKasir_RJ = $resume->kasir_pnj_rajal_aliit($referencenumber);

        $kasir_RJ = $resume->kasir_rajal_aliit($referencenumber);
        $kasir_Tindakan = $resume->kasir_pembayaran_tindakan_aliit($referencenumber);
        $pasien2 = new ModelPasienRanap($this->request);
        $data = [
            // kop
            'kop' => $pasien->get_data_kasir2($lokasikasir),

            'kunjungan_pasien_ranap' => $pasien->get_data_pasien_rme_ranap($referencenumber),
            'resume_medis_ranap' => $pasien->get_data_resume_medis_ranap($referencenumber),

            'DetailObat' => $pasien->search_detail_resep_pulang($referencenumber),

            // data resume IGD
            'kunjungan_pasien_igd' => $pasien->get_cek_resume_medis_igd($referencenumber),
            'diagnosa_ps_rajal' => $pasien->get_data_diagnosa_primer_skunder_rajal($referencenumber),
            // data resume IGD

            // data resume rajal
            'kunjungan_pasien_rajal' => $pasien->get_cek_resume_medis_rajal($referencenumber),
            // data resume rajal

            // data resume rad
            'resume_ra' => $pasien->radiologi_rme($referencenumber),
            // end data resume rad

            // farmasi
            'data_farmasi_header' => $pasien->penjualanHeader($referencenumber),
            'data_obat' => $pasien->penjualanDetail($referencenumber),
            // end farmasi

            // kasir
            'TotalKasirApotek_RI' => $apotekKasir_RI['paymentamount'],
            'TotalKasirApotek_RJ' => $apotekKasir_RJ['paymentamount'],

            'TotalKasirPnj_RI' => $pnjKasir_RI['paymentamount'],
            'TotalKasirPnj_RJ' => $pnjKasir_RJ['paymentamount'],

            'TotalKasir_RJ' => $kasir_RJ['paymentamount'],
            'TotalKasir_Tindakan' => $kasir_Tindakan['paymentamount'],

            'data_header_kasir' => $split->kunjunganranapprint($referencenumber),
            'pasien' => $pasien2->get_detail_ranap($referencenumber),

            'KAMAR' => $resume->Kamar($referencenumber),
            'KAMAR_GROUP' => $resume->Kamar_group_aliit($referencenumber),


            'VISITE' => $cetak->searchVisitePilihan_Al_non_group($referencenumber, $pilihancabar),
            'TNO' => $cetak->searchTNOPilihan_Al_non_group($referencenumber, $pilihancabar),
            'PENUNJANG' => $cetak->PenunjangRanap_Al_detail_non_group($referencenumber, $pilihancabar),
            'FARMASI' => $cetak->FARMASIPilihan_Al_detail_non_group($referencenumber, $pilihancabar),
            'BHP' => $cetak->BHPpenunjangranapPilihan_Al_non_group($referencenumber, $pilihancabar),
            'GIZI' => $cetak->searchAsupanGiziPilihan_Al_non_group($referencenumber, $pilihancabar),
            'OPERASI' => $cetak->OperasiPilihan_Al_non_group($referencenumber, $pilihancabar),

            'PEMIGD' => $cetak->PemeriksaanIGD_Al_non_group($referencenumber),
            'TINIGD' => $cetak->TindakanIGD_AL_non_group($referencenumber),
            'PENUNJANGIGD' => $cetak->Penunjangigdrajal_Al_non_group($referencenumber),
            'FARMASIIGD' => $cetak->FarmasiRajalIgdDetail_Al_non_group($referencenumber),
            'BHPIGD' => $cetak->BHPpenunjangIgd_Pilihan_Al_non_group($referencenumber, $pilihancabar),

            'cabar' => $pilihancabar,
            // end kasir

            // laporan ok
            'data_laporan_ok' => $pasien->get_lo_general($referencenumber),
            'data_laporan_ok_katarak' => $pasien->get_lo_katarak($referencenumber),
        ];

        return view('cetakan/download_all_arsip', $data);
    }

    public function VerifikasiDiagnosaigd()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $verifikasidiagnosarajal = $this->request->getVar('verifikasidiagnosarajal');
            $simpandata = [
                'verifikasidiagnosarajal' => 1,

            ];
            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalDiagnosaigd()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $verifikasidiagnosarajal = $this->request->getVar('verifikasidiagnosarajal');
            $simpandata = [
                'verifikasidiagnosarajal' => 0,

            ];
            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Batal Verifikasi Sudah Selesai !'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function LOGeneralRajal()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rajala_rme($referencenumber);
            $data = [
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'referencenumber' => $row['journalnumber'],
                'admissionDate' => $row['datein'],
                'anesthesia' => $this->anesthesia(),
                'approach' => $this->approach(),
                'capsulotomy' => $this->capsulotomy(),
                'nucleus' => $this->nucleus(),
                'phaco' => $this->phaco(),
                'iol' => $this->iol(),
                'stitch' => $this->stitch(),
                'perawat_katarak' => $this->perawat_katarak(),
                'skin' => $this->skin(),
                'jenisPembedahan' => $this->jenisPembedahan(),
                'asalRuangan' => $row['poliklinikname'],
                'kamarOperasi' => $this->kamarOperasi(),
            ];
            $msg = [
                'sukses' => view('rme/modalcreate_lo_general', $data)
            ];
            return json_encode($msg);
        }
    }

    public function LOKatarakRajal()
    {
        if ($this->request->isAJAX()) {

            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rajala_rme($referencenumber);
            $data = [
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'referencenumber' => $row['journalnumber'],
                'admissionDate' => $row['datein'],
                'anesthesia' => $this->anesthesia(),
                'approach' => $this->approach(),
                'capsulotomy' => $this->capsulotomy(),
                'nucleus' => $this->nucleus(),
                'phaco' => $this->phaco(),
                'iol' => $this->iol(),
                'stitch' => $this->stitch(),
                'perawat_katarak' => $this->perawat_katarak(),

            ];
            $msg = [
                'sukses' => view('rme/modalcreate_lo_katarak', $data)
            ];
            return json_encode($msg);
        }
    }

    public function printLaporanOperasiGeneralRajal()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();

        $data = [
            'kop' => $pasien->get_data_kasir2($lokasikasir),
            'data_laporan_ok' => $pasien->get_lo_general($referencenumber),
            'kunjungan_pasien_ranap' => $pasien->get_data_pasien_rajala_rme($referencenumber)
        ];

        return view('rme/print_laporan_operasi', $data);
    }

    public function printLaporanOperasiKatarakRajal()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();

        $data = [
            'kop' => $pasien->get_data_kasir2($lokasikasir),
            'kunjungan_pasien_ranap' => $pasien->get_data_pasien_rajala_rme($referencenumber),
            'data_laporan_ok_katarak' => $pasien->get_lo_katarak($referencenumber),
        ];

        return view('rme/laporan_operasi_katarak', $data);
    }

    function hapusCPPT()
    {
        if ($this->request->isAjax()) {
            try {
                $asesmen_medis = new ModelPelayananPoliRMEMedis();
                $asesmen_medis->delete($this->request->getVar('id'));
                return json_encode([
                    'success' => 'Data CPPT berhasil di hapus'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'erro' => 'Data CPPT gagal di hapus'
                ]);
            }
        } else {
            exit('Tidak dapat di proses');
        }
    }
    function hapusCPPTRajal()
    {
        if ($this->request->isAjax()) {
            try {
                $table = new ModelPelayananPoliRMEMedis();
                $table->delete($this->request->getVar('id'));
                return json_encode([
                    'success' => 'Data CPPT berhasil di hapus'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'erro' => 'Data CPPT gagal di hapus'
                ]);
            }
        } else {
            exit('Tidak dapat di proses');
        }
    }

    function resumeDisabilitasMcu()
    {
        if ($this->request->isAjax()) {
            $disabilitas = new ModelDisabilitasMcu();

            return json_encode([
                'data' => view('rme/resumeMedisDisabilitasMcu', [
                    'pasienid' => $this->request->getVar('pasienid'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'disabilitas' => $disabilitas->orderBy('id', 'DESC')->where('referencenumber', $this->request->getVar('referencenumber'))->first()
                ]),
            ]);
        } else {
            exit('Tidak dapat di proses');
        }
    }

    function simpanResumeDisabilitasMcu()
    {
        if ($this->request->isAjax()) {
            try {
                $disabilitas = new ModelDisabilitasMcu();
                if ($this->request->getVar('id_disabilitas') == null) {
                    $disabilitas->insert([
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'amputasi' => $this->request->getVar('amputasi'),
                        'lumpuh' => $this->request->getVar('lumpuh'),
                        'paraplegi' => $this->request->getVar('paraplegi'),
                        'deformitas' => $this->request->getVar('deformitas'),
                        'buta_total' => $this->request->getVar('buta_total'),
                        'persepsi_cahaya' => $this->request->getVar('persepsi_cahaya'),
                        'rungu' => $this->request->getVar('rungu'),
                        'wicara' => $this->request->getVar('wicara'),
                        'disabilitas_grahita' => $this->request->getVar('disabilitas_grahita'),
                        'down_syndrome' => $this->request->getVar('down_syndrome'),
                        'psikososial' => $this->request->getVar('psikososial'),
                        'disabilitas_perkembangan' => $this->request->getVar('disabilitas_perkembangan'),
                        'derajat_disabilitas' => $this->request->getVar('derajat_disabilitas'),
                        'penyebab' => $this->request->getVar('penyebab'),
                        'alat_bantu' => $this->request->getVar('alat_bantu'),
                        'keperluan' => $this->request->getVar('keperluan'),
                        'created_by' => session()->get('firstname'),
                    ]);

                    return json_encode([
                        'success' => 'Berhasil menambah data resume disabilitas'
                    ]);
                } else {
                    $disabilitas->update($this->request->getVar('id_disabilitas'), [
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'amputasi' => $this->request->getVar('amputasi'),
                        'lumpuh' => $this->request->getVar('lumpuh'),
                        'paraplegi' => $this->request->getVar('paraplegi'),
                        'deformitas' => $this->request->getVar('deformitas'),
                        'buta_total' => $this->request->getVar('buta_total'),
                        'persepsi_cahaya' => $this->request->getVar('persepsi_cahaya'),
                        'rungu' => $this->request->getVar('rungu'),
                        'wicara' => $this->request->getVar('wicara'),
                        'disabilitas_grahita' => $this->request->getVar('disabilitas_grahita'),
                        'down_syndrome' => $this->request->getVar('down_syndrome'),
                        'psikososial' => $this->request->getVar('psikososial'),
                        'disabilitas_perkembangan' => $this->request->getVar('disabilitas_perkembangan'),
                        'derajat_disabilitas' => $this->request->getVar('derajat_disabilitas'),
                        'penyebab' => $this->request->getVar('penyebab'),
                        'alat_bantu' => $this->request->getVar('alat_bantu'),
                        'keperluan' => $this->request->getVar('keperluan'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => session()->get('firstname'),
                    ]);

                    return json_encode([
                        'success' => 'Berhasil memperbarui data resume disabilitas'
                    ]);
                }
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Gagal menambah data resume medis !!'
                ]);
            }
        } else {
            exit('Tidak dapat di proses');
        }
    }

    function printResumeDisabilitasMcu()
    {
        $disabilitas = new ModelDisabilitasMcu();
        $data_pasien = new ModelPelayananPoli();

        return json_encode([
            'data' => view('cetakan/resume_disabilitas_mcu', [
                'data_pasien' => $data_pasien->select('journalnumber, pasienname, pasiengender pasiendateofbirth, pasienaddress, doktername')->where('journalnumber', $this->request->getVar('page'))->first(),

                'data_disabilitas' => $disabilitas->orderBy('id', 'DESC')->where('referencenumber', $this->request->getVar('page'))->first()
            ])
        ]);
    }


    function resumeSkdMcu()
    {
        if ($this->request->isAJAX()) {
            $skd = new ModelSkdMcu();
            $data_asesmen = new ModelPelayananPoliRME();
            return json_encode([
                'data' => view('rme/resumeSkdMcu', [
                    'pasienid' => $this->request->getVar('pasienid'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'skd' => $skd->orderBy('id', 'DESC')->where('type', 'SKD')->where('referencenumber', $this->request->getVar('referencenumber'))->first(),
                    'data_asesmen' => $data_asesmen->orderBy('id', 'DESC')->where('referencenumber', $this->request->getVar('referencenumber'))->where('groups', 'IRJ')->first(),
                ])
            ]);
        }
    }

    function simpanResumeSkdMcu()
    {
        if ($this->request->isAjax()) {
            try {
                $skd = new ModelSkdMcu();
                if ($this->request->getVar('id_skd') == null) {
                    $skd->insert([
                        'type' => 'SKD',
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'nomor_surat' => $this->request->getVar('nomor_surat'),
                        'keperluan' => $this->request->getVar('keperluan'),
                        'hasil' => $this->request->getVar('hasil'),
                        'created_by' => session()->get('firstname'),
                    ]);

                    return json_encode([
                        'success' => 'Berhasil menambah data resume skd'
                    ]);
                } else {
                    $skd->update($this->request->getVar('id_skd'), [
                        'nomor_surat' => $this->request->getVar('nomor_surat'),
                        'keperluan' => $this->request->getVar('keperluan'),
                        'hasil' => $this->request->getVar('hasil'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => session()->get('firstname'),
                    ]);

                    return json_encode([
                        'success' => 'Berhasil memperbarui data resume mcu'
                    ]);
                }
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Gagal menambah data resume mcu !!'
                ]);
            }
        } else {
            exit('Tidak dapat di proses');
        }
    }

    function printResumeSkdMcu()
    {
        $skd = new ModelSkdMcu();
        $pasien = new ModelPelayananPoliRME();

        return view('cetakan/resume_skd_mcu', [
            'kop' => $pasien->get_data_kasir2('PENDAFTARAN RAWAT INAP'),

            'data_skd' => $skd->select('pasien.code, pasien.name, pasien.gender, pasien.placeofbirth, pasien.dateofbirth, pasien.address, pasien.religion, skd_mcu.pasienid, skd_mcu.referencenumber, skd_mcu.id, skd_mcu.nomor_surat, skd_mcu.keperluan, skd_mcu.hasil, skd_mcu.created_at, skd_mcu.type')->join('pasien', 'pasien.code=skd_mcu.pasienid')
                ->orderBy('skd_mcu.id', 'DESC')
                ->where('skd_mcu.type', 'SKD')
                ->where('skd_mcu.referencenumber', $this->request->getVar('page'))
                ->first(),

            'data_asesmen' => $pasien->orderBy('id', 'DESC')->where('referencenumber', $this->request->getVar('page'))->first()
        ]);
    }

    function resumeSkMcu()
    {
        if ($this->request->isAJAX()) {
            $sk = new ModelSkdMcu();
            return json_encode([
                'data' => view('rme/resumeSkMcu', [
                    'pasienid' => $this->request->getVar('pasienid'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'sk' => $sk->orderBy('id', 'DESC')->where('type', 'SK')->where('referencenumber', $this->request->getVar('referencenumber'))->first(),
                ])
            ]);
        }
    }

    function simpanResumeSkMcu()
    {
        if ($this->request->isAjax()) {
            try {
                $sk = new ModelSkdMcu();
                if ($this->request->getVar('id_sk') == null) {
                    $sk->insert([
                        'type' => 'SK',
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'nomor_surat' => $this->request->getVar('nomor_surat'),
                        'hasil' => nl2br($this->request->getVar('hasil')),
                        'keperluan' => $this->request->getVar('keperluan'),
                        'created_by' => session()->get('firstname'),
                    ]);

                    return json_encode([
                        'success' => 'Berhasil menambah data resume sk mcu'
                    ]);
                } else {
                    $sk->update($this->request->getVar('id_sk'), [
                        'nomor_surat' => $this->request->getVar('nomor_surat'),
                        'keperluan' => $this->request->getVar('keperluan'),
                        'hasil' => nl2br($this->request->getVar('hasil')),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => session()->get('firstname'),
                    ]);

                    return json_encode([
                        'success' => 'Berhasil memperbarui data resume sk mcu'
                    ]);
                }
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Gagal menambah data resume mcu !!'
                ]);
            }
        } else {
            exit('Tidak dapat di proses');
        }
    }

    function printResumeSkMcu()
    {
        $sk = new ModelSkdMcu();
        $pasien = new ModelPelayananPoliRME();

        return view('cetakan/resume_sk_mcu', [
            'kop' => $pasien->get_data_kasir2('PENDAFTARAN RAWAT INAP'),

            'data_sk' => $sk->select('pasien.code, pasien.name, pasien.gender, pasien.placeofbirth, pasien.dateofbirth, pasien.address, pasien.religion, skd_mcu.pasienid, skd_mcu.referencenumber, skd_mcu.id, skd_mcu.nomor_surat, skd_mcu.keperluan, skd_mcu.hasil, skd_mcu.created_at, skd_mcu.type')->join('pasien', 'pasien.code=skd_mcu.pasienid')
                ->orderBy('skd_mcu.id', 'DESC')
                ->where('skd_mcu.type', 'SK')
                ->where('skd_mcu.referencenumber', $this->request->getVar('page'))
                ->first(),

            'data_asesmen' => $pasien->orderBy('id', 'DESC')->where('referencenumber', $this->request->getVar('page'))->first()
        ]);
    }

    public function historyCpptRanap()
    {
        if ($this->request->isAJAX()) {
            return json_encode([
                'sukses' => view('rme/modalhistory_resume_cppt_ranap', [
                    'norm' => $this->request->getVar('id')
                ])
            ]);
        }
    }

    public function dataHistoryCpptRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelCPPTRME();
            $resume->select('groups, createddate, createdBy, kelompokCppt, s, o, a, p, id, instruksiPPA, verifikasiDPJP, verifikator, tanggalJamVerifikasi, pasienid');

            $msg = [
                'data' => view('rme/data_history_resume_cppt_ranap', [
                    'tampildata' => $resume->where('pasienid', $this->request->getVar('norm'))->where('groups', 'IRI')->orderBy('id', 'DESC')->limit(50)->findAll()
                ])
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataRMEMedisRanapPulang()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();

            if ($search['dateOut'] != "") {
                $dateout = explode('-', $search['dateOut']);
                $mulai = str_replace('/', '-', $dateout[0]);
                $sampai = str_replace('/', '-', $dateout[1]);
                $search['mulai'] = date('Y-m-d', strtotime($mulai));
                $search['sampai'] = date('Y-m-d', strtotime($sampai));
            }

            $register = new ModelPelayananPoliRME();
            $data = [
                'tampildata' => $register->caridataranap_pulang_exist($search)
            ];
            $msg = [
                'data' => view('rme/dataregister_asesmen_medis_ranap_pulang_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tampil_seluruh_rad()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $m_auto = new Model_autocomplete($request);

            $classroom = $this->request->getVar('classroom');

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $journalnumber = $this->request->getVar('id');
            //$row = $perawat->find($id);
            $row = $perawat->get_data_header_penunjang($journalnumber);
            $asal_lab = $this->request->getVar('asal_lab');
            $koinsiden = $this->request->getVar('koinsiden');
            if ($koinsiden == 1) {
                $koinsiden = 1;
            } else {
                $koinsiden = 0;
            }


            $jen_kel = $row['pasiengender'];
            if ($jen_kel == "L") {
                $jenkel = 1;
            } else {
                $jenkel = 0;
            }

            $tanggallahir = $row['pasiendateofbirth'];
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

            $umur = $age_years . " tahun " . $age_months . " bulan ";

            $data = [
                'tampildata' => $m_auto->get_list_kelompok_rad(),
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
                'registernumber_rawatinap' => $row['registernumber_rawatinap'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
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
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'asal_lab' => $asal_lab,
                'jenkel' => $jenkel,
                'usia' => $umur,
                'jns_rawat' => '1',
                'koinsiden' => $koinsiden,
                'data_classroom' => $classroom
            ];
            $msg = [
                'data' => view('rme/datapaketRAD_new', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tampil_seluruh_lpk()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $m_auto = new Model_autocomplete($request);
            $kelompokLab = $this->request->getVar('kelompokLab');
            $classroom = $this->request->getVar('classroom');

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $journalnumber = $this->request->getVar('id');
            //$row = $perawat->find($id);
            $row = $perawat->get_data_header_penunjang($journalnumber);
            $asal_lab = $this->request->getVar('asal_lab');
            $koinsiden = $this->request->getVar('koinsiden');
            if ($koinsiden == 1) {
                $koinsiden = 1;
            } else {
                $koinsiden = 0;
            }


            $jen_kel = $row['pasiengender'];
            if ($jen_kel == "L") {
                $jenkel = 1;
            } else {
                $jenkel = 0;
            }

            $tanggallahir = $row['pasiendateofbirth'];
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

            $umur = $age_years . " tahun " . $age_months . " bulan ";

            $data = [
                'tampildata' => $m_auto->get_list_kelompok_lab(),
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
                'registernumber_rawatinap' => $row['registernumber_rawatinap'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
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
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'asal_lab' => $asal_lab,
                'jenkel' => $jenkel,
                'usia' => $umur,
                'jns_rawat' => '1',
                'koinsiden' => $koinsiden,
                'data_classroom' => $classroom
            ];
            $msg = [
                'data' => view('rme/datapaketLPK_new', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tampil_seluruh_lpa()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $m_auto = new Model_autocomplete($request);
            $kelompokLab = $this->request->getVar('kelompokLab');
            $classroom = $this->request->getVar('classroom');

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $journalnumber = $this->request->getVar('id');
            //$row = $perawat->find($id);
            $row = $perawat->get_data_header_penunjang($journalnumber);
            $asal_lab = $this->request->getVar('asal_lab');
            $koinsiden = $this->request->getVar('koinsiden');
            if ($koinsiden == 1) {
                $koinsiden = 1;
            } else {
                $koinsiden = 0;
            }


            $jen_kel = $row['pasiengender'];
            if ($jen_kel == "L") {
                $jenkel = 1;
            } else {
                $jenkel = 0;
            }

            $tanggallahir = $row['pasiendateofbirth'];
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

            $umur = $age_years . " tahun " . $age_months . " bulan ";

            $data = [
                'tampildata' => $m_auto->get_list_kelompok_lab_pa(),
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
                'registernumber_rawatinap' => $row['registernumber_rawatinap'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
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
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'asal_lab' => $asal_lab,
                'jenkel' => $jenkel,
                'usia' => $umur,
                'jns_rawat' => '1',
                'koinsiden' => $koinsiden,
                'data_classroom' => $classroom
            ];
            $msg = [
                'data' => view('rme/datapaketLPA_new', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tampil_seluruh_rhm()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $m_auto = new Model_autocomplete($request);
            $kelompokLab = $this->request->getVar('kelompokLab');
            $classroom = $this->request->getVar('classroom');

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $journalnumber = $this->request->getVar('id');
            //$row = $perawat->find($id);
            $row = $perawat->get_data_header_penunjang($journalnumber);
            $asal_lab = $this->request->getVar('asal_lab');
            $koinsiden = $this->request->getVar('koinsiden');
            if ($koinsiden == 1) {
                $koinsiden = 1;
            } else {
                $koinsiden = 0;
            }


            $jen_kel = $row['pasiengender'];
            if ($jen_kel == "L") {
                $jenkel = 1;
            } else {
                $jenkel = 0;
            }

            $tanggallahir = $row['pasiendateofbirth'];
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

            $umur = $age_years . " tahun " . $age_months . " bulan ";

            $data = [
                'tampildata' => $m_auto->get_list_kelompok_rhm(),
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
                'registernumber_rawatinap' => $row['registernumber_rawatinap'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
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
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'datetimein' => $row['documentdate'],
                'asal_lab' => $asal_lab,
                'jenkel' => $jenkel,
                'usia' => $umur,
                'jns_rawat' => '1',
                'koinsiden' => $koinsiden,
                'data_classroom' => $classroom
            ];
            $msg = [
                'data' => view('rme/datapaketRHM_new', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tambahCPPTRanapPerawat()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "IRJ";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_ranap_rme($referencenumber);
            $data = [
                'referencenumber' => $row['referencenumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'poliklinik' => $row['room'],
                'poliklinikname' => $row['roomname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'referencenumber' => $row['referencenumber'],
                'admissionDate' => $row['datein'],
                'list' => $this->_data_dokter(),

            ];
            $msg = [
                'sukses' => view('rme/modalcreate_cppt_ranap_perawat', $data)
            ];
            return json_encode($msg);
        }
    }

    public function orderLPKIGDlama()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = 'K1';
            $lokasi = 'LPK';
            $namalokasi = 'LABORATORIUM PATOLOGI KLINIK';

            $documentdate = date('Y-m-d');

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);


            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_penunjang_header WHERE  documentdate='$documentdate' AND groups='LPK' LIMIT 1");

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

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');


            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme($referencenumber);

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = 'IGD';
            $classroomname = 'IGD';
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';


            $simpandata = [
                'types' => 'RM',
                'visited' => $visited,
                'groups' => $lokasi,
                'journalnumber' => $newkode,
                'documentdate' => $tgl_order,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'registernumber_rawatjalan' => $registernumber,
                'registernumber_rawatinap' => 'NONE',
                'pasienid' => $pasienid,
                'oldcode' => '',
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethod,
                'paymentcardnumber' => $paymentcardnumber,
                'faskes' => $faskes,
                'faskesname' => $faskesname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'employee' => 'NONE',
                'employeename' => '',
                'smf' => $smf,
                'smfname' => $smfname,
                'titipan' => $titipan,
                'classroom' => $classroom,
                'classroomname' => $classroomname,
                'room' => $room,
                'roomname' => $roomname,
                'locationcode' => $lokasi,
                'locationname' => $namalokasi,
                'icdx' => $icdx,
                'icdxname' => $icdxname,
                'createdby' => $createdBy,
                'createddate' => date('Y-m-d G:i:s'),
                'orderpemeriksaan' => '',
                'tgl_order' => $tgl_order,
                'token_radiologi' => $token_rme,
                'memo' => $memo,
                'note' => $note,
                'status' => $status,

            ];

            $penunjang = new ModelDaftarRadiologi;
            $penunjang->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'kelompokLab' => $this->kelompokLPK(),

            ];
            $msg = [
                'sukses' => view('rme/modalorderLPKrme_rajal_lama', $data)
            ];
            return json_encode($msg);
        }
    }

    public function detaileResepRanapPulang()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $headerpelayanan = $resume->search_header_pelayanan_pulang($journalnumber);
            $data = [
                'DetailObat' => $resume->search_detail_pelayanan_pulang($journalnumber),
                'kodejournal' => $journalnumber,
                'validasilunas' => $headerpelayanan['validasilunas'],
                'luarpaketinacbg' => $headerpelayanan['luarpaketinacbg'],
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
                'referencenumber' => $headerpelayanan['referencenumber'],

            ];
            $msg = [
                'data' => view('rme/detail_eResepranap', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    function downloadAllArsipRajal()
    {
        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $referencenumber = $this->request->getVar('page');

        $pasien = new ModelPelayananPoliRME();

        $resume = new ModelTNODetail();

        $pilihancabar = $this->request->getVar('rincian');

        // kasir
        $pasienRajal = new ModelPasienRanap($this->request);
        $row2 = $pasienRajal->get_data_kasir($lokasikasir);
        $row3 = $pasienRajal->get_data_print_detail($referencenumber);

        $resume = new ModelTNODetailRJ();
        // end kasir

        $data = [
            // kop
            'kop' => $pasien->get_data_kasir2($lokasikasir),

            'kunjungan_pasien_ranap' => $pasien->get_data_pasien_rme_rajal_resume($referencenumber),
            'resume_medis_ranap' => $pasien->get_data_resume_medis_ranap($referencenumber),

            'DetailObat' => $pasien->search_detail_resep_pulang($referencenumber),

            // data resume IGD
            'kunjungan_pasien_igd' => $pasien->get_cek_resume_medis_igd($referencenumber),
            'diagnosa_ps_rajal' => $pasien->get_data_diagnosa_primer_skunder_rajal($referencenumber),
            // data resume IGD

            // data resume rajal
            'kunjungan_pasien_rajal' => $pasien->get_cek_resume_medis_rajal($referencenumber),
            // data resume rajal

            // data resume rad
            'resume_ra' => $pasien->radiologi_rme($referencenumber),
            // end data resume rad

            // farmasi
            'data_farmasi_header' => $pasien->penjualanHeader($referencenumber),
            'data_obat' => $pasien->penjualanDetail($referencenumber),
            // end farmasi

            // kasir
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien_rajal' => $pasienRajal->get_detail_igd($referencenumber),
            'TNO' => $resume->search_rajal2($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'OPERASI' => $resume->Operasirajal($referencenumber),
            'PENUNJANG' => $resume->Penunjangheaderrajal($referencenumber),
            'FARMASI' => $resume->FARMASIrajal($referencenumber),
            'BHP' => $resume->BHPrajal($referencenumber),
            'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
            'kasir_rajal' => $pasienRajal->kunjunganigdprint($referencenumber),
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien_rajal' => $pasienRajal->get_detail_igd($referencenumber),
            'TNO' => $resume->search_rajal2($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'OPERASI' => $resume->Operasirajal($referencenumber),
            'PENUNJANG' => $resume->Penunjangheaderrajal($referencenumber),
            'FARMASI' => $resume->FARMASIrajal($referencenumber),
            'BHP' => $resume->BHPrajal($referencenumber),
            'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
            'kasir_rajal' => $pasienRajal->kunjunganigdprint($referencenumber),
            'cabar' => $pilihancabar,
            // end kasir

            // laporan ok
            'data_laporan_ok' => $pasien->get_lo_general($referencenumber),
            'data_laporan_ok_katarak' => $pasien->get_lo_katarak($referencenumber),
        ];

        return view('cetakan/download_all_arsip_rajal', $data);
    }

    public function orderTNORanap()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $groups = "TNO";
            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme_ranap($referencenumber);

            $lokasi = $row['poliklinik'];
            $documentdate = $row['documentdate'];

            $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_jurnal;
            }

            $today = date('ymd', strtotime($documentdate));
            $underscore = '_';

            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }

            helper('text');
            $token = random_string('alnum', 6);
            $token_rme = strtoupper($token);

            $referencenumber = $this->request->getVar('id');
            $perawat = new ModelPelayananPoliRME();
            $row = $perawat->get_data_pasien_rme_ranap($referencenumber);

            $newkode = $token_rme . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
            $tgl_order = date('Y-m-d');
            $tahun_order = date('Y');
            $bulan_order = date('M');

            $registernumber = $row['journalnumber'];
            $referencenumber = $row['referencenumber'];
            $pasienid = $row['pasienid'];
            $oldcode = $row['pasienid'];
            $pasienname = $row['pasienname'];
            $pasiengender = $row['pasiengender'];
            $pasienage = $row['pasienage'];
            $pasiendateofbirth = $row['pasiendateofbirth'];
            $pasienaddress = $row['pasienaddress'];
            $pasienarea = $row['pasienarea'];
            $pasiensubarea = $row['pasiensubarea'];
            $pasiensubareaname = $row['pasiensubareaname'];
            $paymentmethod = $row['paymentmethod'];
            $paymentmethodname = $row['paymentmethodname'];
            $paymentcardnumber = $row['paymentcardnumber'];
            $faskes = $row['faskes'];
            $faskesname = $row['faskesname'];
            $dokter = $row['dokter'];
            $doktername = $row['doktername'];
            $smf = $row['smf'];
            $smfname = $row['smfname'];
            $titipan = 'TIDAK';
            $classroom = $row['classroom'];
            $classroomname = $row['classroomname'];
            $room = $row['poliklinik'];
            $roomname = $row['poliklinikname'];
            $icdx = $row['icdx'];
            $icdxname = $row['icdxname'];
            $createdBy = session()->get('firstname');
            $memo = '';
            $note = 'ORDER';
            $status = 'ORDER';
            $bpjs_sep = $row['bpjs_sep'];
            $poliklinik = $row['poliklinik'];
            $poliklinikname = $row['poliklinikname'];
            $employee = 'NONE';
            $namapoli = $row['poliklinikname'];


            $simpandata = [

                'groups' => $groups,
                'journalnumber' => $newkode,
                'documentdate' => $documentdate,
                'documentyear' => $tahun_order,
                'documentmonth' => $bulan_order,
                'registernumber' => $registernumber,
                'referencenumber' => $referencenumber,
                'bpjs_sep' => $bpjs_sep,
                'noantrian' => $nourut,
                'pasienid' => $pasienid,
                'oldcode' => $oldcode,
                'pasienname' => $pasienname,
                'pasiengender' => $pasiengender,
                'pasienage' => $pasienage,
                'pasiendateofbirth' => $pasiendateofbirth,
                'pasienaddress' => $pasienaddress,
                'pasienarea' => $pasienarea,
                'pasiensubarea' => $pasiensubarea,
                'pasiensubareaname' => $pasiensubareaname,
                'paymentmethod' => $paymentmethod,
                'paymentmethodname' => $paymentmethodname,
                'paymentcardnumber' => $paymentcardnumber,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'smf' => $smf,
                'employee' => $employee,
                'dokter' => $dokter,
                'doktername' => $doktername,

                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'createdby' => session()->get('firstname'),
                'createddate' => date('Y-m-d G:i:s'),
                'room' => $row['room'],
                'roomname' => $row['roomname']

            ];
            $data = new ModelTNOHeader();
            $data->insert($simpandata);
            $data = [
                'journalnumber' => $newkode,
                'pasienid' => $pasienid,
                'pasienname' => $pasienname,
                'paymentmethodname' => $paymentmethodname,
                'paymentmethod' => $paymentmethod,
                'poliklinik' => $poliklinik,
                'poliklinikname' => $poliklinikname,
                'dokter' => $dokter,
                'doktername' => $doktername,
                'referencenumber' => $referencenumber,
                'paramedic' => $this->data_paramedic2($namapoli),
                'documentdate' => $documentdate,
                'list_dokter' => $this->_data_dokter(),
            ];
            $msg = [
                'sukses' => view('rme/modalinputTNOranap_rme', $data)
            ];
            return json_encode($msg);
        }
    }

    public function simpanTNORanapDetail()
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

                $dokter = explode('|', $this->request->getVar('dokter'));

                try {
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
                        'dokter' => $dokter[0],
                        'doktername' => $dokter[1],
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
                        'createdby' => session()->get('firstname'),
                        'createddate' => date('Y-m-d G:i:s'),
                        'pelaksana' => $pelaksana,
                        'paramedicName' => $this->request->getVar('paramedicName')

                    ];
                    $tno = new ModelTNODetail;
                    $tno->insert($simpandata);
                    $msg = [
                        'sukses' => 'Detail Tindakan Berhasil Ditambahkan'
                    ];
                    return json_encode($msg);
                } catch (\Throwable $th) {
                    // dd($th->getMessage());
                }
            }
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeTNOMedisRanap()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetailRJ();

            $referencenumber = $this->request->getVar('referencenumber');
            $row = $perawat->search_igd_register($referencenumber);
            $data = [
                'tampildata' => $perawat->search_tindakan_ranap($referencenumber),
            ];
            $msg = [
                'data' => view('rme/data_resume_TNO_ranap_rme', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandataeresep_detail_sal()
    {
        if ($this->request->isAJAX()) {
            $total_obat_gagal = 0;
            $total_obat_berhasil = 0;

            $m_icd = new ModelMasterObat();
            $data_obat_detail = new ModelFarmasiPelayananDetail;

            $simpandata = [
                'journalnumber' => $this->request->getVar('journalnumber'),
                'documentdate' => date('Y-m-d'),
                'karyawan' => '0.00',
                'dispensasi' => '0.00',
                'relation' => $this->request->getVar('relation'),
                'relationname' => $this->request->getVar('relationname'),
                'paymentmethod' => $this->request->getVar('paymentmethod_detail'),
                'paymentmethodname' => $this->request->getVar('paymentmethodname_detail'),
                'poliklinik' => $this->request->getVar('poliklinik_detail'),
                'poliklinikname' => $this->request->getVar('poliklinikname_detail'),
                'poliklinikclass' => $this->request->getVar('poliklinikclass_detail'),
                'dokter' => $this->request->getVar('dokter_detail'),
                'doktername' => $this->request->getVar('doktername_detail'),
                'employee' => 'NONE',
                'employeename' => 'NONE',
                'referencenumber' => $this->request->getVar('referencenumber_detail'),
                'locationcode' => $this->request->getVar('locationcode_detail'),
                'locationname' => $this->request->getVar('locationname_detail'),
                'jumlahracikan' => 0,
                'createdby' => session()->get('firstname'),
                'createddate' => date('Y-m-d G:i:s'),
                'qtyluarpaket' => '0',
                'eticket_aturan' => '-',
                'eticket_petunjuk' => '',
                'terapiPulang' => '0',
            ];

            foreach ($this->request->getVar('kode_obat') as $key => $kode_obat) {
                $price = $this->request->getVar('price')[$key];
                $jumlah = $this->request->getVar('qtyresep')[$key];
                $jumlahstock = $this->request->getVar('qtystock')[$key];
                $qty = -1 * $jumlah;
                $qtypaket = ABS($qty);

                $subtotal = $price * $qty;

                $sm = $m_icd->get_minstock_obat($kode_obat);
                $stockminimal = $sm['minstock'];

                $beli = $jumlahstock - $jumlah;


                if ($jumlah > $jumlahstock or $beli < $stockminimal) {
                    ++$total_obat_gagal;
                } else {
                    $data_obat_detail->db->transBegin();
                    try {
                        $dosisfull = explode("X", $this->request->getVar('signa1')[$key]); //looping
                        $simpan_looping = [
                            'signa1' => $dosisfull[0],
                            'signa2' => $dosisfull[0],
                            'emptydate' => date('Y-m-d', strtotime('+3 days')),
                            'subtotal' => $subtotal,
                            'racikan' => $this->request->getVar('racikan')[$key],  //looping
                            'r' => $this->request->getVar('koderacikan')[$key], //looping
                            'koderacikan' => $this->request->getVar('koderacikan')[$key], //looping
                            'code' => $kode_obat, //looping
                            'name' => $this->request->getVar('nama_obat')[$key], //looping
                            'batchnumber' => $this->request->getVar('batchnumber')[$key], //looping
                            'expireddate' => $this->request->getVar('expireddate')[$key], //looping
                            'uom' => $this->request->getVar('uom')[$key], //looping
                            'price' => $this->request->getVar('price')[$key], //looping
                            'eticket_carapakai' => $this->request->getVar('carapakai')[$key], //looping
                            'qtypaket' => $qtypaket,
                            'qty' => $jumlah,
                        ];
                        $data_obat_detail->insert(array_merge($simpandata, $simpan_looping));
                        $data_obat_detail->db->transCommit();
                        ++$total_obat_berhasil;
                    } catch (\Throwable $th) {
                        $data_obat_detail->db->transRollback();
                        ++$total_obat_gagal;

                        return json_encode([
                            'error' => 'Obat gagal di simpan pastikan gk ada obat yang duplicate ya :D'
                        ]);
                    }
                }
            }
            return json_encode([
                'success' => 'Berhasil simpan total obat: ' . $total_obat_berhasil . ', Gagal simpan obat: ' . $total_obat_gagal
            ]);
        } else {
            exit('tidak dapat diproses');
        }
    }

    function getObatRacikan()
    {
        if ($this->request->isAJAX()) {
            $model = new ModelObatRacikan();

            return json_encode([
                'success' => view('rme/obat_racikan', [
                    'data' => $model->where('id', $this->request->getVar('id'))->first()
                ])
            ]);
        }
    }

    function storeObatRacikan()
    {
        if ($this->request->isAJAX()) {
            try {
                $model = new ModelObatRacikan();

                if (!in_array($this->request->getVar('id_obat_racikan'), [null, ''])) {
                    $model->update($this->request->getVar('id_obat_racikan'), [
                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'description' => $this->request->getVar('description'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'created_by' => session()->get('firstname')
                    ]);
                } else {
                    $model->insert([
                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                        'description' => $this->request->getVar('description'),
                        'created_by' => session()->get('firstname')
                    ]);
                }

                return json_encode([
                    'success' => 'Berhasil menambahkan obat racikan'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Gagal menambahkan obat racikan'
                ]);
            }
        } else {
            exit('Tidak dapat di proses');
        }
    }

    function destroyObatRacikan()
    {
        if ($this->request->isAJAX()) {
            try {
                $model = new ModelObatRacikan();
                $model->delete($this->request->getVar('id'));

                return json_encode([
                    'success' => 'Berhasil hapus obat racikan'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Gagal hapus obat racikan'
                ]);
            }
        } else {
            exit('Tidak dapat di proses');
        }
    }
    public function getDataHistoryEresepRacikan()
    {
        if ($this->request->isAJAX()) {

            $model = new ModelObatRacikan();
            return json_encode([
                'success' => view('rme/data_history_e_resep_racikan', [
                    'datas' => $model->where('pasienid', $this->request->getVar('pasienid'))->orderBy('id', 'DESC')->findAll(),
                ])
            ]);
        }
    }

    function reuseObatRacikan()
    {
        if ($this->request->isAJAX()) {
            $model = new ModelObatRacikan();

            return json_encode([
                'success' => view('rme/reuse_obat_racikan', [
                    'data' => $model->select('id, description')
                        ->where('id', $this->request->getVar('id'))->first()
                ])
            ]);
        }
    }


    // IBS 

    function simpanAsesmenPraBedah()
    {
        if ($this->request->isAjax()) {
            try {
                $bedah = new Model_RME_Prabedah();
                if ($this->request->getVar('id') == null) {

                    $bedah->insert([
                        'bedah' => $cek_resume_medis['pasienname'],
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'created_by' => $this->request->getVar('created_by'),
                        // 'referencenumber' => $this->request->getVar('referencenumber'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'diagnosis_prabedah' => $this->request->getVar('diagnosis_prabedah'),
                        'indikasi' => $this->request->getVar('indikasi'),
                        'rencana' => $this->request->getVar('rencana'),
                        'prosedur' => $this->request->getVar('prosedur'),
                        'alternatif' => $this->request->getVar('alternatif'),
                        'resiko_komplikasi' => $this->request->getVar('resiko_komplikasi'),
                        'remantau' => $this->request->getVar('remantau'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                    ]);

                    return json_encode([
                        'success' => 'Berhasil menambah data'
                    ]);
                } else {
                    $bedah->update($this->request->getVar('id'), [
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        // 'referencenumber' => $row['referencenumber'],
                        'created_by' => $this->request->getVar('created_by'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'diagnosis_prabedah' => $this->request->getVar('diagnosis_prabedah'),
                        'indikasi' => $this->request->getVar('indikasi'),
                        'rencana' => $this->request->getVar('rencana'),
                        'prosedur' => $this->request->getVar('prosedur'),
                        'alternatif' => $this->request->getVar('alternatif'),
                        'resiko_komplikasi' => $this->request->getVar('resiko_komplikasi'),
                        'remantau' => $this->request->getVar('remantau'),
                        'pasienid' => $this->request->getVar('pasienid'),
                        'pasienname' => $this->request->getVar('pasienname'),
                    ]);


                    return json_encode([
                        'success' => 'Berhasil memperbarui data'
                    ]);
                }
            } catch (\Throwable $th) {
                var_dump($th->getMessage());
                return json_encode([
                    'error' => 'Gagal menambah data !!' . $th->getMessage()
                ]);
            }
        } else {
            exit('Tidak dapat di proses');
        }
    }

    function printresumeprabedah()
    {
        $referencenumber = $this->request->getVar('page');
        $resume = new ModelPelayananPoliRME();

        $kunjungan = $resume->get_data_pasien_rme_rajal_resume($referencenumber);

        $bedah = new Model_RME_Prabedah();
        $cek_resume_medis = $bedah->get_cek_prabedah($referencenumber);
        $cek_resume_medis = $bedah->get_cek_resume_prabedah($referencenumber);
        $pasinname = isset($cek_resume_medis['pasienname']) != null ? $cek_resume_medis['pasienname'] : "";
        $data = [

            // 'pasienid' => $kunjungan['pasienid'],
            'pasienname' => $cek_resume_medis['pasienname'],
            // 'status' => $kunjungan['status'],
            // 'alamat' => $kunjungan['alamat'],
            // 'deskripsi' => $kunjungan['deskripsi'],
            // 'pasienid' => $kunjungan_pasien['pasienid'],
            // 'pasienname' => $kunjungan_pasien['pasienname'],
            // 'pasiengender' => $kunjungan_pasien['pasiengender'],
            // 'pasiendateofbirth' => $kunjungan_pasien['pasiendateofbirth'],
            // 'namapjb' => '',
            // 'roomname' => $kunjungan_pasien['poliklinikname'],
            // 'tanggalperiksa' => $kunjungan_pasien['documentdate'],
            // 'alasanRawat' => '',
            // 'pasienage' => $kunjungan_pasien['pasienage'],
            // 'diagnosis' => $diagnosis,
            // 'terapi' => $terapi,
            // 'poliklinik' => $kunjungan_pasien['poliklinikname'],
            // 'dokter' => $kunjungan_pasien['doktername'],
            // 'anamnesa' => $anamnesa,
        ];
        return view('rme/print_resume_prabedah', $data);
    }
}

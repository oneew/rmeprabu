<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\ModelTNODetailRJ;
use App\Models\ModelTNOHeaderRajal;
use App\Models\ModelPenunjangDetail;
use App\Models\ModelPasienMaster;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;




class PelayananRawatJalanDokter extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('dokter/registerpoliklinikdokter', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('dokter/dataregisterpoliklinikdokter', $data)
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

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('dokter/dataregisterpoliklinikdokter', $data)
            ];
            echo json_encode($msg);
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
            echo json_encode($msg);
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
                'list' => $this->_data_dokter_all(),
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
            $row = $perawat->search_rajal($referencenumber);
            $data = [
                'tampildata' => $perawat->search($referencenumber),
                'pasienid' => $row['pasienid'],
                'validation' => $row['validation']
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
                'sukses' => view('rawatjalan/modalvalidasipoli', $data)
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

    public function resumePenunjang()
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
            echo json_encode($msg);
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
            echo json_encode($msg);
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
            echo json_encode($msg);
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
            echo json_encode($msg);
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
            echo json_encode($msg);
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
            echo json_encode($msg);
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

            echo json_encode($msg);
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

            echo json_encode($msg);
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
            echo json_encode($msg);
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
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

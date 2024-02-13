<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\ModelPasienRanap;
use App\Models\ModelTNODetailRJ;
use App\Models\Model_autocomplete;
use App\Models\ModelRekMedDetail;
use App\Models\ModelRekMedHeader;
use App\Models\ModelDiagnosa;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;

class RekMedCodingRajal extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rekammedik/registerpoliklinik_codingrajal', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];

            $msg = [
                'data' => view('rekammedik/dataregisterpoliklinik_codingrajal', $data)
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
                'tampildata' => $register->search_RegisterRajal($search)
            ];
            $msg = [
                'data' => view('rekammedik/dataregisterpoliklinik_codingrajal', $data)
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


    public function CodingRajal()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal($id);
            $referencenumber = $row['journalnumber'];
            $pasienid = $row['pasienid'];

            $tanggallahir = ($row['pasiendateofbirth']);
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
            $resume = new ModelTNODetailRJ();
            $rowdiagnosaheader = $resume->search_diagnosa_header($referencenumber);

            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],
                'bpjs_sep' => $row['bpjs_sep'],
                'oldcode' => $row['oldcode'],
                'pasienid' => $row['pasienid'],
                'pasiengender' => $row['pasiengender'],
                'pasienaddress' => $row['pasienaddress'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'pasienname' => $row['pasienname'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'coding' => $row['coding'],
                'pasienclassroom' => '',
                'classroom' => '',
                'classroomname' => '',
                'bednumber' => '',
                'smf' => 'NONE',
                'smfname' => '',
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'doktername' => $row['doktername'],
                'dokter' => $row['dokter'],
                'statuspasien' => $row['statuspasien'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'documentdate' => $row['documentdate'],
                'referencenumber' => $row['journalnumber'],
                'paymentchange' => $row['paymentchange'],
                'paymentchangenumber' => $row['paymentchangenumber'],
                'umur' => $umur,
                'age_years' => $age_years,
                'age_months' => $age_months,
                'age_days' => $age_days,
                'list' => $this->_data_dokter_all(),
                'pemeriksaan' => $m_icd->get_pemeriksaan_rajal($id),
                'TNO' => $resume->search($referencenumber),
                'RAD' => $resume->Penunjangrajalrad($referencenumber),
                'LPK' => $resume->Penunjangrajallpk($referencenumber),
                'LPA' => $resume->Penunjangrajallpa($referencenumber),
                'BD' => $resume->Penunjangrajalbd($referencenumber),
                'FARMASI' => $resume->search_farmasi($referencenumber),
                'DIAGNOSA' => $resume->search_diagnosa($pasienid),
                'journalnumber_header' => isset($rowdiagnosaheader['journalnumber']) != null ? $rowdiagnosaheader['journalnumber'] : "",

                'dateIn_aliit' => $row['documentdate'],
                'dateOut_aliit' => $row['documentdate'],
                'lamabaru' => $row['lamabaru'],
            ];
            $msg = [
                'sukses' => view('rekammedik/modalcodingpoli', $data)
            ];
            echo json_encode($msg);
        }
    }

    // public function simpanrekmedheader()
    // {
    //     if ($this->request->isAJAX()) {
    //         $validation = \Config\Services::validation();
    //         $valid = $this->validate([
    //             'doktername_TH' => [
    //                 'label' => 'Nama Dokter',
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => '{field} tidak boleh kosong'
    //                 ]
    //             ]
    //         ]);
    //         if (!$valid) {
    //             $msg = [
    //                 'error' => [
    //                     'doktername_TH' => $validation->getError('doktername_TH')
    //                 ]
    //             ];
    //         } else {
    //             $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));

    //             $db = db_connect();
    //             $groups = "IRJ";
    //             $lokasi = $this->request->getVar('poliklinik_TH');
    //             $documentdate = date('Y-m-d');
    //             $kata = "KDIRJ";

    //             $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian  FROM transaksi_rekammedik_rawatjalan_header WHERE groups='$groups' AND poliklinik='$lokasi' AND documentdate='$documentdate' LIMIT 1");

    //             foreach ($query->getResult() as $row) {
    //                 $kode = $row->kode_jurnal;
    //                 $antrian = $row->noantrian;
    //             }

    //             $today = date('ymd');
    //             $underscore = '_';

    //             if ($kode == "") {
    //                 $nourut = '000001';
    //             } else {
    //                 $nourut = (int) substr($kode, -6, 6);
    //                 $nourut++;
    //             }

    //             $newkode = $kata . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);

    //             if ($antrian == "") {
    //                 $nourutantrian = '1';
    //             } else {
    //                 $nourutantrian = (int)($antrian);
    //                 $nourutantrian++;
    //             }
    //             $no_antrian = sprintf($nourutantrian);

    //             $doktername = $this->request->getVar('doktername_TH');
    //             $dokter = $this->request->getVar('dokter_TH');


    //             $simpandata = [

    //                 'groups' => $this->request->getVar('groups_TH'),
    //                 'journalnumber' => $newkode,
    //                 'documentdate' => $this->request->getVar('documentdate_TH'),
    //                 'documentyear' => $this->request->getVar('documentyear_TH'),
    //                 'documentmonth' => $this->request->getVar('documentmonth_TH'),
    //                 'referencenumber' => $this->request->getVar('referencenumber_TH'),
    //                 'referencenumber_rawatjalan' => $this->request->getVar('referencenumber_TH'),
    //                 'referencenumber_rawatinap' => $this->request->getVar('referencenumber_rawatinap_TH'),
    //                 'bpjs_sep' => $this->request->getVar('bpjs_sep_TH'),
    //                 'noantrian' => $no_antrian,
    //                 'pasienid' => $this->request->getVar('pasienid_TH'),
    //                 'oldcode' => $this->request->getVar('oldcode_TH'),
    //                 'pasienname' => $this->request->getVar('pasienname_TH'),
    //                 'pasiengender' => $this->request->getVar('pasiengender_TH'),
    //                 'pasienage' => $this->request->getVar('pasienage_TH'),
    //                 'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth_TH'),
    //                 'pasienaddress' => $this->request->getVar('pasienaddress_TH'),
    //                 'pasienarea' => $this->request->getVar('pasienarea_TH'),
    //                 'pasiensubarea' => $this->request->getVar('pasiensubarea_TH'),
    //                 'pasiensubareaname' => $this->request->getVar('pasiensubareaname_TH'),
    //                 'paymentmethod' => $this->request->getVar('paymentmethod_TH'),
    //                 'paymentmethodname' => $this->request->getVar('paymentmethodname_TH'),
    //                 'paymentcardnumber' => $this->request->getVar('paymentcardnumber_TH'),
    //                 'poliklinik' => $this->request->getVar('poliklinik_TH'),
    //                 'poliklinikname' => $this->request->getVar('poliklinikname_TH'),
    //                 'pasienclassroom' => $this->request->getVar('pasienclassroom_TH'),
    //                 'classroom' => $this->request->getVar('classroom_TH'),
    //                 'classroomname' => $this->request->getVar('classroomname_TH'),
    //                 'bednumber' => $this->request->getVar('bednumber_TH'),
    //                 'smf' => $this->request->getVar('smf_TH'),
    //                 'smfname' => $this->request->getVar('smfname_TH'),
    //                 'dokter' => $this->request->getVar('dokter_TH'),
    //                 'doktername' => $this->request->getVar('doktername_TH'),
    //                 'locationcode' => $this->request->getVar('locationcode_TH'),
    //                 'locationname' => $this->request->getVar('locationname_TH'),
    //                 'numberseq' => $no_antrian,
    //                 'createdby' => $this->request->getVar('createdby_TH'),
    //                 'createddate' => $this->request->getVar('createddate_TH'),

    //                 'dateIn' => $this->request->getVar('dateIn_aliit'),
    //                 'dateOut' => $this->request->getVar('dateOut_aliit'),
    //                 'keadaanPulang' => $this->request->getVar('keadaanPulang'),
    //                 'lamabaru' => $this->request->getVar('lamabaru'),
    //             ];
    //             $coding = new ModelRekMedHeader;
    //             $coding->insert($simpandata);
    //             $msg = [
    //                 'sukses' => 'Tambah Header Berhasil, silahkan isi detail diagnosa',
    //                 'JN' => $newkode,
    //                 'dokterdiagnosa' => $dokter,
    //                 'dokternamediagnosa' => $doktername,
    //             ];
    //         }
    //         echo json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }

    // public function simpanDiagnosaDetail()
    // {
    //     if ($this->request->isAJAX()) {
    //         $validation = \Config\Services::validation();
    //         $valid = $this->validate([
    //             'documentdate' => [
    //                 'label' => 'Diagnosa',
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => '{field} tidak boleh kosong'
    //                 ]

    //             ]
    //         ]);
    //         if (!$valid) {
    //             $msg = [
    //                 'error' => [
    //                     'documentdate' => $validation->getError('documentdate')
    //                 ]
    //             ];
    //         } else {
    //             //tambahan
    //             $simpandata = [];

    //             $dokter = $this->request->getVar('dokter_detail');
    //             $doktername = $this->request->getVar('doktername_detail');



    //             $diagnosaprimer = $this->request->getVar('diagnosaprimer');
    //             if ($diagnosaprimer == 1) {
    //                 $diagnosa = "Primer";
    //             } else {
    //                 $diagnosa = "Sekunder";
    //             }

    //             $icdx = $this->request->getVar('name');
    //             $icdix = $this->request->getVar('namaicdix');

    //             // var_dump("Before conditions", $simpandata);
                
    //             if (($icdx != null) and ($icdix == null)) {
    //                 $memo = 'Coding Diagnosa (ICD-X) Pasien Rawat Jalan';
    //                 $jeniscoding = 'ICDX';

    //                 $simpandata = [
    //                     'types' => $this->request->getVar('groups'),
    //                     'journalnumber' => $this->request->getVar('journalnumber'),
    //                     'documentdate' => $this->request->getVar('documentdate'),
    //                     'relation' => $this->request->getVar('pasienid'),
    //                     'relationname' => $this->request->getVar('pasienname'),
    //                     'paymentmethod' => $this->request->getVar('paymentmethod'),
    //                     'paymentmethodname' => $this->request->getVar('paymentmethodname'),
    //                     'poliklinik' => $this->request->getVar('poliklinik'),
    //                     'poliklinikname' => $this->request->getVar('poliklinikname'),
    //                     'smf' => $this->request->getVar('smf'),
    //                     'smfname' => $this->request->getVar('smfname'),
    //                     'dokter' => $dokter,
    //                     'doktername' => $doktername,
    //                     'referencenumber' => $this->request->getVar('referencenumber'),
    //                     'referencenumber_rawatinap' => $this->request->getVar('referencenumber_rawatinap'),
    //                     'coding' => $jeniscoding,
    //                     'codeicdx' => $this->request->getVar('codeicdx'),
    //                     'nameicdx' => $this->request->getVar('nameicdx'),
    //                     'memo' => $memo,
    //                     'createdby' => $this->request->getVar('createdby'),
    //                     'createddate' => $this->request->getVar('createddate'),
    //                     'paymentchange' => $this->request->getVar('paymentchange'),
    //                     'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),
    //                     'locationcode' => $this->request->getVar('locationcode'),
    //                     'kategori' => $diagnosa,
    //                     'pasiengender' => $this->request->getVar('pasiengender'),
    //                     'age_years' => $this->request->getVar('age_years'),
    //                     'age_months' => $this->request->getVar('age_months'),
    //                     'age_days' => $this->request->getVar('age_days'),
    //                     'date_pelayanan' => $this->request->getVar('date_pelayanan'),

    //                 ];
    //             } else {

    //                 // var_dump("After conditions", $simpandata);
                   
    //                 if (($icdx == null) and ($icdix != null)) {
    //                     $memo = 'Coding Diagnosa (ICD-IX) Pasien Rawat Jalan';
    //                     $jeniscoding = 'ICDIX';
    //                     $kategori = '-';

    //                     $simpandata = [
    //                         'types' => $this->request->getVar('groups'),
    //                         'journalnumber' => $this->request->getVar('journalnumber'),
    //                         'documentdate' => $this->request->getVar('documentdate'),
    //                         'relation' => $this->request->getVar('pasienid'),
    //                         'relationname' => $this->request->getVar('pasienname'),
    //                         'paymentmethod' => $this->request->getVar('paymentmethod'),
    //                         'paymentmethodname' => $this->request->getVar('paymentmethodname'),
    //                         'poliklinik' => $this->request->getVar('poliklinik'),
    //                         'poliklinikname' => $this->request->getVar('poliklinikname'),
    //                         'smf' => $this->request->getVar('smf'),
    //                         'smfname' => $this->request->getVar('smfname'),
    //                         'dokter' => $dokter,
    //                         'doktername' => $doktername,
    //                         'referencenumber' => $this->request->getVar('referencenumber'),
    //                         'referencenumber_rawatinap' => $this->request->getVar('referencenumber_rawatinap'),
    //                         'coding' => $jeniscoding,
    //                         'codeicdix' => $this->request->getVar('icdix'),
    //                         'nameicdix' => $this->request->getVar('nameicdix'),
    //                         'memo' => $memo,
    //                         'createdby' => $this->request->getVar('createdby'),
    //                         'createddate' => $this->request->getVar('createddate'),
    //                         'paymentchange' => $this->request->getVar('paymentchange'),
    //                         'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),
    //                         'locationcode' => $this->request->getVar('locationcode'),
    //                         'kategori' => $kategori,
    //                         'pasiengender' => $this->request->getVar('pasiengender'),
    //                         'age_years' => $this->request->getVar('age_years'),
    //                         'age_months' => $this->request->getVar('age_months'),
    //                         'age_days' => $this->request->getVar('age_days'),
    //                         'date_pelayanan' => $this->request->getVar('date_pelayanan'),

    //                     ];
    //                 }
    //             }

    //             // var_dump($simpandata);
    //             $diagnosa = new ModelRekMedDetail;
    //             $diagnosa->insert($simpandata);
    //             $msg = [
    //                 'sukses' => 'Detail Diagnosa Berhasil Ditambahkan'
    //             ];
    //         }
    //         echo json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }

    public function simpanrekmedheader()
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

                $newkode = $kata . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }
                $no_antrian = sprintf($nourutantrian);

                $doktername = $this->request->getVar('doktername_TH');
                $dokter = $this->request->getVar('dokter_TH');


                $simpandata = [

                    'groups' => $this->request->getVar('groups_TH'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
                    'referencenumber_rawatjalan' => $this->request->getVar('referencenumber_TH'),
                    'referencenumber_rawatinap' => $this->request->getVar('referencenumber_rawatinap_TH'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep_TH'),
                    'noantrian' => $no_antrian,
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
                    'pasienclassroom' => $this->request->getVar('pasienclassroom_TH'),
                    'classroom' => $this->request->getVar('classroom_TH'),
                    'classroomname' => $this->request->getVar('classroomname_TH'),
                    'bednumber' => $this->request->getVar('bednumber_TH'),
                    'smf' => $this->request->getVar('smf_TH'),
                    'smfname' => $this->request->getVar('smfname_TH'),
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),
                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),
                ];
                $coding = new ModelRekMedHeader;
                $coding->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Header Berhasil, silahkan isi detail diagnosa',
                    'JN' => $newkode,
                    'dokterdiagnosa' => $dokter,
                    'dokternamediagnosa' => $doktername,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDiagnosaDetail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'documentdate' => [
                    'label' => 'Diagnosa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'documentdate' => $validation->getError('documentdate')
                    ]
                ];
            } else {
              
                $dokter = $this->request->getVar('dokter_detail');
                $doktername = $this->request->getVar('doktername_detail');



                $diagnosaprimer = $this->request->getVar('diagnosaprimer');
                if ($diagnosaprimer == 1) {
                    $diagnosa = "Primer";
                } else {
                    $diagnosa = "Sekunder";
                }

                $icdx = $this->request->getVar('name');
                $icdix = $this->request->getVar('namaicdix');
                if (($icdx != null) and ($icdix == null)) {
                    $memo = 'Coding Diagnosa (ICD-X) Pasien Rawat Jalan';
                    $jeniscoding = 'ICDX';

                    $simpandata = [
                        'types' => $this->request->getVar('groups'),
                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'documentdate' => $this->request->getVar('documentdate'),
                        'relation' => $this->request->getVar('pasienid'),
                        'relationname' => $this->request->getVar('pasienname'),
                        'paymentmethod' => $this->request->getVar('paymentmethod'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                        'poliklinik' => $this->request->getVar('poliklinik'),
                        'poliklinikname' => $this->request->getVar('poliklinikname'),
                        'smf' => $this->request->getVar('smf'),
                        'smfname' => $this->request->getVar('smfname'),
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'referencenumber_rawatinap' => $this->request->getVar('referencenumber_rawatinap'),
                        'coding' => $jeniscoding,
                        'codeicdx' => $this->request->getVar('codeicdx'),
                        'nameicdx' => $this->request->getVar('nameicdx'),
                        'memo' => $memo,
                        'createdby' => $this->request->getVar('createdby'),
                        'createddate' => $this->request->getVar('createddate'),
                        'paymentchange' => $this->request->getVar('paymentchange'),
                        'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),
                        'locationcode' => $this->request->getVar('locationcode'),
                        'kategori' => $diagnosa,
                        'pasiengender' => $this->request->getVar('pasiengender'),
                        'age_years' => $this->request->getVar('age_years'),
                        'age_months' => $this->request->getVar('age_months'),
                        'age_days' => $this->request->getVar('age_days'),
                        'date_pelayanan' => $this->request->getVar('date_pelayanan'),

                    ];
                } else {
                    if (($icdx == null) and ($icdix != null)) {
                        $memo = 'Coding Diagnosa (ICD-IX) Pasien Rawat Jalan';
                        $jeniscoding = 'ICDIX';
                        $kategori = '-';

                        $simpandata = [
                            'types' => $this->request->getVar('groups'),
                            'journalnumber' => $this->request->getVar('journalnumber'),
                            'documentdate' => $this->request->getVar('documentdate'),
                            'relation' => $this->request->getVar('pasienid'),
                            'relationname' => $this->request->getVar('pasienname'),
                            'paymentmethod' => $this->request->getVar('paymentmethod'),
                            'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                            'poliklinik' => $this->request->getVar('poliklinik'),
                            'poliklinikname' => $this->request->getVar('poliklinikname'),
                            'smf' => $this->request->getVar('smf'),
                            'smfname' => $this->request->getVar('smfname'),
                            'dokter' => $dokter,
                            'doktername' => $doktername,
                            'referencenumber' => $this->request->getVar('referencenumber'),
                            'referencenumber_rawatinap' => $this->request->getVar('referencenumber_rawatinap'),
                            'coding' => $jeniscoding,
                            'codeicdix' => $this->request->getVar('icdix'),
                            'nameicdix' => $this->request->getVar('nameicdix'),
                            'memo' => $memo,
                            'createdby' => $this->request->getVar('createdby'),
                            'createddate' => $this->request->getVar('createddate'),
                            'paymentchange' => $this->request->getVar('paymentchange'),
                            'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),
                            'locationcode' => $this->request->getVar('locationcode'),
                            'kategori' => $kategori,
                            'pasiengender' => $this->request->getVar('pasiengender'),
                            'age_years' => $this->request->getVar('age_years'),
                            'age_months' => $this->request->getVar('age_months'),
                            'age_days' => $this->request->getVar('age_days'),
                            'date_pelayanan' => $this->request->getVar('date_pelayanan'),

                        ];
                    }
                }

                $diagnosa = new ModelRekMedDetail;
                $diagnosa->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Diagnosa Berhasil Ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function ajax_icdx()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_icdx($key);
        foreach ($data as $row) {
            $json[] = [
                'value' => $row['originalcode'] . ' | ' . $row['name'],
                'id' => $row['id'],
                'originalcode' => $row['originalcode'],
                'nameicdx' => $row['name'],

            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function ajax_icdix()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_icdix($key);
        foreach ($data as $row) {
            $json[] = [
                'value' => $row['code'] . ' | ' . $row['name'],
                'id' => $row['id'],
                'originalcode' => $row['code'],
                'nameicdix' => $row['name'],

            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function resumediagnosasekarang()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelDiagnosa();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'DIAGNOSA' => $resume->search_diagnosa_sekarang($referencenumber),
            ];
            $msg = [
                'data' => view('rekammedik/data_resume_diagnosa_sekarang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusdiagnosa()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelRekMedDetail;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Diagnosa dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function LapCoding()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rekammedik/registerpoliklinik_codingrajal_lapcoding', $data);
    }

    public function ambildataLapCoding()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatarajal_lapcoding()
            ];

            $msg = [
                'data' => view('rekammedik/dataregisterpoliklinik_codingrajal_lapcoding', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliLapCoding()
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
                'tampildata' => $register->search_RegisterRajal_lapcoding($search)
            ];
            $msg = [
                'data' => view('rekammedik/dataregisterpoliklinik_codingrajal_lapcoding', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

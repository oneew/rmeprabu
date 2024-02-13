<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelIGDDaftar;
use App\Models\ModelPasienMaster;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasien;
use App\Models\ModelPasienRanap;
use App\Models\ModelDataSep;
use App\Models\ModelDataSPRI;
use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

use GuzzleHttp\Client;

use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

class IGD extends BaseController
{

    private $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
    private $service_name = 'vclaim-rest-dev/';


    public function index()
    {
        $ceksession_aliit = session()->get('firstname');
        if ($ceksession_aliit == "") {
            return redirect()->to(base_url() . '/index.php');
        } else {
            $data = [
                'list' => $this->data_payment(),
            ];
            return view('igd/registerigd', $data);
        }
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelIGDDaftar();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('igd/dataregisterigd', $data)
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

            // $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            // $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelIGDDaftar();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('igd/dataregisterigd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
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
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
            ];
            $msg = [
                'data' => view('igd/modaldaftarigd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function registerpasienlama()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
            ];
            $msg = [
                'data' => view('igd/modaldaftarigdpasienlama', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ambildatapasienlama()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPasienMaster();
            $data = [
                'tampildata' => $register->ambildatapasien()
            ];
            $msg = [
                'data' => view('igd/masterdatapasien', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienlama()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getVar();
            $register = new ModelPasienMaster();
            $data = [
                'tampildata' => $register->search_DataPasien($search)
            ];

            $msg = [
                'data' => view('igd/masterdatapasien', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function DaftarkanPasienLama()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'pasienlama' => $m_icd->get_data_pasien_lama($id),
                'triase' => $m_icd->get_data_kelompok_triase(),
            ];

            $msg = [
                'sukses' => view('igd/modalinputdaftarpasienlama', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function detailpasien()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $row = $m_icd->get_data_pasien($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function simpandataregister()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'dokter' => [
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

                ],

                'description' => [
                    'label' => 'Jenis Pelayanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'dokter' => $validation->getError('dokter'),
                        'poliklinikname' => $validation->getError('poliklinikname'),
                        'description' => $validation->getError('description')
                    ]
                ];
            } else {
                $tglrujukan1 = $this->request->getVar("referencedate");

                $mulai = str_replace('/', '-', $tglrujukan1);
                $tglrujukan = date('Y-m-d', strtotime($mulai));
                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $lokasi = $this->request->getVar('poliklinik');
                $visited = $this->request->getVar('visited');
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND groups='IGD'  LIMIT 1");

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
                $token4 = random_string('alnum', 2);
                $token_reborn3 = strtoupper($token4);
                $newkode = $visited . $underscore . $token_reborn3. $groups . $underscore  . $today . $underscore . sprintf('%06s', $nourut);



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



                $kelompok_triase = $this->request->getVar('kelompok_triase');

                if ($kelompok_triase == "KEBIDANAN DAN KANDUNGAN") {
                    $igdkebidanan = "1";
                } else {
                    $igdkebidanan = "0";
                }

                $rencanaOperasi = $this->request->getVar('rencanaOperasi');
                if ($rencanaOperasi == "1") {
                    $rencanaOperasi = "1";
                } else {
                    $rencanaOperasi = "0";
                }

                $kode_dokter = null;
                $nama_dokter = null;
                $kode_bpjs = null;
                if (!is_null($this->request->getVar('dokter'))) {
                    $data_dokter = explode('|', $this->request->getVar('dokter'));
                    $kode_dokter = $data_dokter[0];
                    $nama_dokter = $data_dokter[1];
                    $kode_bpjs = $data_dokter[2];
                }   


                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'visited' => $this->request->getVar('visited'),
                    'journalnumber' => $newkode,
                    'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                    'documentdate' => $documentdate,
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
                    'dokter' => $kode_dokter,
                    'doktername' => $nama_dokter,
                    'kodedokter' => $kode_bpjs,
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
                    'igdkebidanan' => $igdkebidanan,
                    'code_triase' => $this->request->getVar('code_triase'),
                    'kelompok_triase' => $this->request->getVar('triase'),
                    'rencanaOperasi' => $rencanaOperasi,
                ];
                $perawat = new ModelRawatJalanDaftar;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Pendftaran IGD Berhasil',
                    'JN' => $newkode,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function registerpasienbaru()
    {
        if ($this->request->isAJAX()) {
            $m_icd = new ModelPasienMaster();
            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'triase' => $m_icd->get_data_kelompok_triase(),
            ];
            $msg = [
                'data' => view('igd/modaldaftarigdpasienbaru', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function simpandataregisterpasienbaru()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'dokter' => [
                    'label' => 'Nama Dokter',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ],

                'namapoliklinik' => [
                    'label' => 'Pilihan Poli',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'dokter' => $validation->getError('dokter'),
                        'namapoliklinik' => $validation->getError('namapoliklinik')
                    ]
                ];
            } else {

                $db = db_connect();
                $documentdate = date('Y-m-d');
                $inisial = 'R';
                $query = $db->query("SELECT MAX(code) as norm FROM pasien WHERE  denicode=0 AND code NOT LIKE '%%R%%'  ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $norm = $row->norm;
                }

                if ($norm == "") {
                    $nourutnorm = '00000001';
                } else {
                    $nourutnorm = (int) substr($norm, -8, 8);
                    $nourutnorm++;
                }

                //$normbaru = $inisial . sprintf('%08s', $nourutnorm);
                $normbaru = sprintf('%08s', $nourutnorm);



                $groups = $this->request->getVar('groups_baru');
                $lokasi = $this->request->getVar('kodepoliklinik');
                $documentdate = date('Y-m-d');
                $today = date('ymd');
                $underscore = '_';
                $query2 = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE documentdate='$documentdate' AND groups='$groups' LIMIT 1");

                foreach ($query2->getResult() as $row2) {
                    $kode = $row2->kode_jurnal;
                    $antrian = $row2->noantrian;
                }

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

                $no_antrian = sprintf($nourutantrian);
                $visited = "K1";
                $newkode = $visited . $underscore . $groups . $underscore  . $today . $underscore . sprintf('%06s', $nourut);
                $tglrujukan2 = $this->request->getVar("tanggalrujukan");

                $mulai = str_replace('/', '-', $tglrujukan2);
                $tglrujukan = date('Y-m-d', strtotime($mulai));

                //$tglrujukan = date('Y-m-d', strtotime($this->request->getVar("tanggalrujukan")));
                $TL = date('Y-m-d', strtotime($this->request->getVar("tanggallahir")));
                $tanggallahir = $this->request->getVar('tanggallahir');
                $lahir = str_replace('/', '-', $tanggallahir);
                $tgllahir = date('Y-m-d', strtotime($lahir));
                $dob = strtotime($tgllahir);
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
                $locationcode_baru = "NONE";

                $kelompok_triase = $this->request->getVar('kelompok_triase');

                if ($kelompok_triase == "KEBIDANAN DAN KANDUNGAN") {
                    $igdkebidanan = "1";
                } else {
                    $igdkebidanan = "0";
                }

                $metodepembayaran = $this->request->getVar('carabayar');
                $kode_pelayanan = $this->request->getVar('kode_pelayanan');
                $sebab_masuk = $this->request->getVar('sebabmasuk');
                $dokter = $this->request->getVar('dokter');
                $incorrectNik = $this->request->getVar('tandaNik');

                if ($incorrectNik == 1) {
                    $incorrectNik = 1;
                } else {
                    $incorrectNik = 0;
                }

                $kode_dokter = null;
                $nama_dokter = null;
                $kode_bpjs = null;
                if (!is_null($this->request->getVar('dokter'))) {
                    $data_dokter = explode('|', $this->request->getVar('dokter'));
                    $kode_dokter = $data_dokter[0];
                    $nama_dokter = $data_dokter[1];
                    $kode_bpjs = $data_dokter[2];
                }   

                if (($metodepembayaran != "") and ($kode_pelayanan != "") and ($sebab_masuk != "") and ($dokter != "")) {

                    $simpandata = [
                        'registerdate' => $this->request->getVar('documentdate_baru'),
                        'code' => $normbaru,
                        'oldcode' => $this->request->getVar('oldcode_baru'),
                        'initial' => $this->request->getVar('initial'),
                        'name' => $this->request->getVar('name'),
                        'gender' => $this->request->getVar('jeniskelamin'),
                        'maritalstatus' => $this->request->getVar('statusnikah'),
                        'religion' => $this->request->getVar('agama'),
                        'bloodtype' => $this->request->getVar('golongandarah'),
                        'bloodrhesus' => $this->request->getVar('rhesus'),
                        'ssn' => $this->request->getVar('nik'),
                        'placeofbirth' => $this->request->getVar('tempatlahir'),
                        'dateofbirth' => $tgllahir,
                        'education' => $this->request->getVar('pendidikan'),
                        'citizenship' => $this->request->getVar('citizenship'),
                        'work' => $this->request->getVar('pekerjaan'),
                        'telephone' => $this->request->getVar('telepon'),
                        'mobilephone' => $this->request->getVar('teleponseluler'),
                        'area' => $this->request->getVar('area'),
                        'subarea' => $this->request->getVar('kodewilayah'),
                        'subareaname' => $this->request->getVar('namasubarea'),
                        'address' => $this->request->getVar('alamat'),
                        'postalcode' => $this->request->getVar('kodepos'),
                        'parentname' => $this->request->getVar('penanggungjawab'),
                        'parenttelephone' => $this->request->getVar('penangungjawabtelephone'),
                        'couplename' => $this->request->getVar('couplename'),
                        'paymentmethod' => $this->request->getVar('carabayar'),
                        'paymentmethodname' => $this->request->getVar('carabayar'),
                        'cardnumber' => $this->request->getVar('nomorasuransi'),
                        'numberseq' => $nourutnorm,
                        'locationcode' => $locationcode_baru,
                        'createdby' => $this->request->getVar('createdby_baru'),
                        'createddate' => $this->request->getVar('createddate_baru'),
                        'district' => $this->request->getVar('kelurahan'),
                        'rt' => $this->request->getVar('rt'),
                        'rw' => $this->request->getVar('rw'),
                        'kecamatan' => $this->request->getVar('namakecamatan'),
                        'kabupaten' => $this->request->getVar('kabupaten'),
                        'propinsi' => $this->request->getVar('propinsi'),
                        'namaibukandung' => $this->request->getVar('namaorangtua'),
                        'incorrectNik' => $incorrectNik,

                    ];
                    $pasien = new ModelPasien;
                    $pasien->insert($simpandata);


                    $lamabaru = "B";
                    $postingdata = [
                        'groups' => $this->request->getVar('groups_baru'),
                        'visited' => $visited,
                        'journalnumber' => $newkode,
                        'bpjs_sep' => $this->request->getVar('bpjs_sep_baru'),
                        'documentdate' => $documentdate,
                        'documentyear' => $this->request->getVar('documentyear_baru'),
                        'documentmonth' => $this->request->getVar('documentmonth_baru'),
                        'noantrian' => $no_antrian,
                        'numberseq' => $no_antrian,
                        'pasienid' => $normbaru,
                        'oldcode' => $this->request->getVar('oldcode_baru'),
                        'pasienname' => $this->request->getVar('name'),
                        'pasiengender' => $this->request->getVar('jeniskelamin'),
                        'pasienmaritalstatus' => $this->request->getVar('statusnikah'),
                        'pasienage' => $umur,
                        'pasiendateofbirth' => $tgllahir,
                        'registerdate' => $this->request->getVar('registerdate_baru'),
                        'pasienaddress' => $this->request->getVar('alamat'),
                        'pasienarea' => $this->request->getVar('area'),
                        'pasiensubarea' => $this->request->getVar('kodewilayah'),
                        'pasiensubareaname' => $this->request->getVar('namasubarea'),
                        'pasienparentname' => $this->request->getVar('penanggungjawab'),
                        'pasienssn' => $this->request->getVar('nik'),
                        'pasientelephone' => $this->request->getVar('telepon'),
                        'paymentmethod' => $this->request->getVar('carabayar'),
                        'paymentmethodname' => $this->request->getVar('carabayar'),
                        'paymentcardnumber' => $this->request->getVar('nomorasuransi'),
                        'paymentmethodori' => $this->request->getVar('carabayar'),
                        'paymentmethodnameori' => $this->request->getVar('carabayar'),
                        'paymentcardnumberori' => $this->request->getVar('nomorasuransi'),
                        'paymentmethod_payment' => $this->request->getVar('carabayar'),
                        'paymentmethodname_payment' => $this->request->getVar('carabayar'),
                        'poliklinik' => $this->request->getVar('kodepoliklinik'),
                        'poliklinikname' => $this->request->getVar('namapoliklinik'),
                        'dokter' => $kode_dokter,
                        'doktername' => $nama_dokter,
                        'kodedokter' => $kode_bpjs,
                        'faskes' => $this->request->getVar('kodefaskes'),
                        'faskesname' => $this->request->getVar('namafaskes'),
                        'referencedate' => $tglrujukan,

                        'code' => $this->request->getVar('kode_pelayanan'),
                        'description' => $this->request->getVar('nama_pelayanan'),
                        'price' => $this->request->getVar('price_pelayanan'),
                        'share1' => $this->request->getVar('share1_pelayanan'),
                        'share2' => $this->request->getVar('share2_pelayanan'),

                        'icdx' => $this->request->getVar('kodeicdx'),
                        'icdxname' => $this->request->getVar('namaicdx'),
                        'locationcode' => $this->request->getVar('locationcode_baru'),
                        'locationname' => $this->request->getVar('locationname_baru'),
                        'noantrian' => $no_antrian,
                        'createdip' => $this->request->getVar('createdip_baru'),
                        'createdby' => $this->request->getVar('createdby_baru'),
                        'createddate' => $this->request->getVar('createddate_baru'),

                        'reasoncode' => $this->request->getVar('sebabmasuk'),
                        'memo' => $this->request->getVar('catatan'),
                        'email' => $this->request->getVar('email_baru'),
                        'token_rajal' => $this->request->getVar('token_rajal_baru'),
                        'lamabaru' => $lamabaru,
                        'igdkebidanan' => $igdkebidanan,
                        'code_triase' => $this->request->getVar('code_triase'),
                        'kelompok_triase' => $this->request->getVar('triase'),
                    ];

                    $rajal = new ModelRawatJalanDaftar;
                    $rajal->insert($postingdata);
                }

                $msg = [
                    'sukses' => 'Pendftaran IGD Berhasil',
                    'JN' => $newkode,
                ];
            }
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

    public function pelayanan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pelayanan_igd();
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


    public function ajax_faskes()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');
        $data = $m_auto->get_list_faskes($key);



        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'],
                'id' => $row['id'],
                'code' => $row['code']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function inisial()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_inisial();
        return $list;
    }

    public function agama()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_agama();
        return $list;
    }

    public function statusnikah()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_nikah();
        return $list;
    }

    public function pendidikan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pendidikan();
        return $list;
    }

    public function pekerjaan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pekerjaan();
        return $list;
    }

    public function ajax_wilayah()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');
        $data = $m_auto->get_list_wilayah($key);
        foreach ($data as $row) {

            $json[] = [
                'value' => $row['NAMA_KEC'] . ' | ' . $row['NAMA_KEL'] . ' | ' . $row['NAMA_KAB'],
                'id' => $row['ID'],
                'kecamatan' => $row['NAMA_KEC'],
                'kelurahan' => $row['NAMA_KEL'],
                'kabupaten' => $row['NAMA_KAB'],
                'propinsi' => $row['NAMA_PROP'],
                'kodewilayah' => $row['code'],
                'namasubarea' => $row['name']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function metodepembayaran()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_metode_pembayaran();
        return $list;
    }

    public function hubunganpjb()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pjb();
        return $list;
    }

    public function printkarcis()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN IGD";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_karcis_igd($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganrajal($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        //$html .= view('pdf/karcisigd', $data);
        $html = view('pdf/karcisigd', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A6', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function UbahMasterPasien()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'pasienlama' => $m_icd->get_data_pasien_lama($id),
            ];

            $msg = [
                'data' => view('igd/modaleditmasterpasien', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function updatedatamasterpasien()
    {
        if ($this->request->isAJAX()) {

            $tanggallahir = $this->request->getVar('tanggallahir');
            $lahir = str_replace('/', '-', $tanggallahir);
            $tgllahir = date('Y-m-d', strtotime($lahir));
            $dob = strtotime($tgllahir);
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

            $gender = $this->request->getVar('jeniskelamin');
            if (($umur < 1) and ($age_months < 7)) {
                $inisial = "BY";
            }
            if (($umur > 1) and ($gender == "LAKI-LAKI")) {
                $inisial = "TN";
            }

            if (($umur > 1) and ($gender == "PEREMPUAN")) {
                $inisial = "NY";
            }


            $simpandata = [


                'initial' => $inisial,
                'name' => $this->request->getVar('name'),
                'gender' => $this->request->getVar('jeniskelamin'),
                'maritalstatus' => $this->request->getVar('statusnikah'),
                'religion' => $this->request->getVar('agama'),
                'bloodtype' => $this->request->getVar('golongandarah'),
                'bloodrhesus' => $this->request->getVar('rhesus'),
                'ssn' => $this->request->getVar('nik'),
                'placeofbirth' => $this->request->getVar('tempatlahir'),
                'dateofbirth' => $tgllahir,
                'education' => $this->request->getVar('pendidikan'),
                'citizenship' => $this->request->getVar('citizenship'),
                'work' => $this->request->getVar('pekerjaan'),
                'telephone' => $this->request->getVar('telepon'),
                'mobilephone' => $this->request->getVar('teleponseluler'),
                'area' => $this->request->getVar('area'),
                'subarea' => $this->request->getVar('kodewilayah'),
                'subareaname' => $this->request->getVar('namasubarea'),
                'address' => $this->request->getVar('alamat'),
                'postalcode' => $this->request->getVar('kodepos'),
                'parentname' => $this->request->getVar('penanggungjawab'),
                'parenttelephone' => $this->request->getVar('penangungjawabtelephone'),
                'couplename' => $this->request->getVar('couplename'),
                'paymentmethod' => $this->request->getVar('carabayar'),
                'paymentmethodname' => $this->request->getVar('carabayar'),
                'cardnumber' => $this->request->getVar('cardnumber'),
                'modifiedby' => $this->request->getVar('createdby_baru'),
                'modifieddate' => $this->request->getVar('modifieddate'),
                'district' => $this->request->getVar('kelurahan'),
                'rt' => $this->request->getVar('rt'),
                'rw' => $this->request->getVar('rw'),
                'kecamatan' => $this->request->getVar('namakecamatan'),
                'kabupaten' => $this->request->getVar('kabupaten'),
                'propinsi' => $this->request->getVar('propinsi'),
                'namaibukandung' => $this->request->getVar('namaorangtua'),

            ];
            $perawat = new ModelPasienMaster;
            $id = $this->request->getVar('idpasien');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data pasien sudah berhasil diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function UbahIGD()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'pasienlama' => $m_icd->get_data_rajal($id),
                'cabar' => $this->data_payment(),
                'pelayanan' => $this->pelayanan(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'sebabsakit' => $this->sebabsakit(),
                'triase' => $m_icd->get_data_kelompok_triase(),
            ];
            $msg = [
                'sukses' => view('igd/modalubahigd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function UbahDataRegister()
    {
        if ($this->request->isAJAX()) {

            $tglrujukan1 = $this->request->getVar("referencedate");

            $mulai = str_replace('/', '-', $tglrujukan1);
            $tglrujukan = date('Y-m-d', strtotime($mulai));

            $kelompok_triase = $this->request->getVar('kelompok_triase');

            if ($kelompok_triase == "KEBIDANAN DAN KANDUNGAN") {
                $igdkebidanan = "1";
            } else {
                $igdkebidanan = "0";
            }

            $dokter = $this->request->getVar('ibsdokter');
            $doktername = $this->request->getVar('ibsdoktername');

            $description = $this->request->getVar('description');
            if ($description == "RENCANA OPERASI") {
                $rencanaOperasi = 1;
            } else {
                $rencanaOperasi = 0;
            }


            $simpandata = [

                'pasienarea' => $this->request->getVar('pasienarea'),
                'pasiengender' => $this->request->getVar('pasiengender'),
                'pasiensubarea' => $this->request->getVar('pasiensubarea'),
                'pasiensubareaname' => $this->request->getVar('pasiensubareaname'),
                'pasienparentname' => $this->request->getVar('pasienparentname'),
                'pasienssn' => $this->request->getVar('pasienssn'),
                'paymentmethod' => $this->request->getVar('paymentmethod'),
                'paymentmethodname' => $this->request->getVar('paymentmethodname'),
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
                'modifiedby' => $this->request->getVar('createdby'),
                'createddate' => $this->request->getVar('createddate'),
                'reasoncode' => $this->request->getVar('reasoncode'),
                'memo' => $this->request->getVar('memo'),
                'kelompok_triase' => $kelompok_triase,
                'code_triase' => $this->request->getVar('code_triase'),
                'igdkebidanan' => $igdkebidanan,
                'pasienname' => $this->request->getVar('pasienname'),
                'pasienaddress' => $this->request->getVar('pasienaddress'),
                'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                'rencanaOperasi' => $rencanaOperasi,
            ];

            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('iddaftar');
            $perawat->update($id, $simpandata);

            $pasien = new ModelPasienMaster;
            $code = $this->request->getVar('norm');

            $simpandatapasien = [
                'name' => $this->request->getVar('pasienname'),
                'dateofbirth' => $this->request->getVar('pasiendateofbirth'),
                'address' => $this->request->getVar('pasienaddress'),
            ];
            $pasien->update_dataPasien($code, $simpandatapasien);
            $msg = [
                'sukses' => 'Data Register Berhasil Diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Cetak()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'pasienlama' => $m_icd->get_data_rajal($id),
            ];
            $msg = [
                'sukses' => view('igd/modalprintregisterigd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printsjp()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN IGD";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_sjp_igd($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganrajal_sjp($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        //$html .= view('pdf/sjpigd', $data);
        $html = view('pdf/sjpigd', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printsep()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_sjp($lokasikasir);
        $databarcode = $pasien->dataSepBarcode($id);
        $kodedokter = $databarcode['kodeDPJP'];
        $namadoktersep = $pasien->caridokter($kodedokter);
        $namaDokter = $namadoktersep['name'];
        $data = [
            'datapasien' => $pasien->dataSep($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'namaDokter' => $namaDokter,
        ];


        $pasienid_barcode = $databarcode['noSep'];


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
        $html = view('pdf/sepigd', $data);

        // $dompdf->loadhtml($html);
        // $customPaper = array(0, 0, 620, 260);
        // $dompdf->setPaper($customPaper);
        // $dompdf->render();
        // $namafile = $data['header1'];
        // $dompdf->stream($namafile, ['Attachment' => 0]);
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




    public function printsticker()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganrajal($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];



        $databarcode = $pasien->kunjunganrajal_pasienid($id);
        $pasienid_barcode = $databarcode['pasienid'];


        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(40)
            ->setPadding(4)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))

            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';

        $html = view('pdf/stylebootstrap');
        $html = view('pdf/stickerrajal', $data);

        $dompdf->loadhtml($html);

        $dompdf->setPaper('A8', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }


    public function printheader()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');

        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganrajal($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $databarcode = $pasien->kunjunganrajal_pasienid($id);
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
        $data['agama'] = $datapasien['religion'];

        $html = view('pdf/stylebootstrap');
        $html = view('pdf/headerstatusigd', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printgelang()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganrajal($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];
        $databarcode = $pasien->kunjunganrajal_pasienid($id);
        $pasienid_barcode = $databarcode['pasienid'];
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

        $html = view('pdf/stylebootstrap');
        $html = view('pdf/gelangigd', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A8', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }


    //SEP...................
    public function CreateSep()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];

            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->referensiPropinsi(),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => 'IGD',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'icdx' => $rajal['icdx'],
                'tglMasuk' => $rajal['documentdate'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'jeniskll' => $this->jeniskllsep(),
            ];

            $msg = [
                'suksesmodalsep' => view('igd/modalcreatesepugd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function referensiPropinsi()
    {
        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest-dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $response = $client->request('GET', $base_url .  $service_name . 'referensi/propinsi', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "2mSA7604B8";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        //var_dump($data);

        return $data['list'];
    }


    public function CreateSepDirect()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row_direct($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];

            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsiBpjs(),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => 'IGD',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'icdx' => $rajal['icdx'],
                'tglMasuk' => $rajal['documentdate'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'jeniskll' => $this->jeniskllsep(),

            ];

            $msg = [
                'suksesmodalsep' => view('igd/modalcreatesepugd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function penjaminKL()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_penjaminKLL();
        return $list;
    }

    public function propinsi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_propinsi();
        return $list;
    }

    public function propinsiBpjs()
    {
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $request->propinsi();

        return $data['response']['list'];
    }

    public function ajax_propinsiBPJS()
    {
        $request = Services::request();
        $kelas = $request->getPost('kelas');
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $request->kabupaten($kelas);

        echo json_encode($data['response']['list']);
    }

    public function ajax_kabupatenBPJS()
    {
        $request = Services::request();
        $room = $request->getPost('room');
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $request->kecamatan($room);

        echo json_encode($data['response']['list']);
    }

    public function diagnosaBpjs()
    {
        $request = Services::request();
        $keyword = $request->getGet('term');
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $request->diagnosa($keyword);
        //return $data['response']['diagnosa'];
        echo json_encode($data['response']['diagnosa']);
    }

    public function dokterBpjsV1()
    {

        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $jnsPelayanan = 1;
        $tglPelayanan = date('Y-m-d');
        $spesialis = 'Spesialis';
        $data = $request->dokterDpjp($jnsPelayanan, $tglPelayanan, $spesialis);
        return $data['response']['list'];
    }

    public function dokterBpjs()
    {
        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest-dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = '1';
        $tglPelayanan = date('Y-m-d');
        $spesialis = "spesialis";




        $response = $client->request('GET', $base_url .  $service_name . 'referensi/dokter/pelayanan/' . $filter . '/' . 'tglPelayanan/'  . $tglPelayanan . '/' . 'Spesialis/' . $spesialis, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "2mSA7604B8";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        return $data['list'];
    }

    public function simpanSEPV1()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');
            $pilihan_eksekutif = $this->request->getVar('eksekutif');
            $pilihan_cob = $this->request->getVar('cob');
            $pilihan_katarak = $this->request->getVar('katarak');
            $pilihan_lakalantas = $this->request->getVar('lakalantas2');
            $pilihan_suplesi = $this->request->getVar('suplesi2');
            $dpjp = $this->request->getVar('kodeDPJP');


            if ($pilihan_eksekutif == "1") {
                $datasep['eksekutif'] = "1";
            } else {
                $datasep['eksekutif'] = "0";
            }

            if ($pilihan_cob == "1") {
                $datasep['cob'] = "1";
            } else {
                $datasep['cob'] = "0";
            }
            if ($pilihan_katarak == "1") {
                $datasep['katarak'] = "1";
            } else {
                $datasep['katarak'] = "0";
            }
            if ($pilihan_lakalantas == "1") {
                $datasep['lakalantas'] = "1";
            } else {
                $datasep['lakalantas'] = "0";
            }

            if ($pilihan_suplesi == "1") {
                $datasep['suplesi'] = "1";
            } else {
                $datasep['suplesi'] = "0";
            }

            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['ppkPelayanan'] = $this->request->getVar('ppkPelayanan');
            $datasep['jnsPelayanan'] = $this->request->getVar('jnsPelayanan');
            $datasep['klsRawat'] = $this->request->getVar('klsRawat');
            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['asalRujukan'] = $this->request->getVar('asalRujukan');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['ppkRujukan'] = $this->request->getVar('ppkRujukan');
            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagAwal'] = $this->request->getVar('diagAwal');
            $datasep['tujuan'] = $this->request->getVar('tujuan');
            $datasep['penjamin'] = $this->request->getVar('penjamin');
            $datasep['tglKejadian'] = $this->request->getVar('tglKejadian');
            $datasep['keterangan'] = $this->request->getVar('keterangan');
            $datasep['noSepSuplesi'] = $this->request->getVar('noSepSuplesi');
            $datasep['kdPropinsi'] = $this->request->getVar('kdPropinsi');
            $datasep['kdKabupaten'] = $this->request->getVar('kdKabupaten');
            $datasep['kdKecamatan'] = $this->request->getVar('kdKecamatan');
            $datasep['noSurat'] = $this->request->getVar('noSurat');
            $datasep['kodeDPJP'] = $dpjp;
            $datasep['noTelp'] = $this->request->getVar('noTelp');
            $datasep['user'] = $this->request->getVar('user');
            $createdby = $this->request->getVar('createdby');
            $journalnumber = $this->request->getVar('journalnumberrajal');

            $sep = json_decode($this->insert_sep($datasep));
            if ($sep->response->sep == null) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep->metaData->message
                ];
            } else {

                $noSep = $sep->response->sep->noSep;
                $diagnosa = $sep->response->sep->diagnosa;
                $jnsPelayanan = $sep->response->sep->jnsPelayanan;
                $kelasRawat = $sep->response->sep->kelasRawat;
                $penjamin = $sep->response->sep->penjamin;
                $asuransi = $sep->response->sep->peserta->asuransi;
                $hakKelas = $sep->response->sep->peserta->hakKelas;
                $jnsPeserta = $sep->response->sep->peserta->jnsPeserta;
                $kelamin = $sep->response->sep->peserta->kelamin;
                $nama = $sep->response->sep->peserta->nama;
                $noKartu = $sep->response->sep->peserta->noKartu;
                $noMr = $sep->response->sep->peserta->noMr;
                $tglLahir = $sep->response->sep->peserta->tglLahir;
                $dinsos = $sep->response->sep->informasi->dinsos;
                $prolanisPRB = $sep->response->sep->informasi->prolanisPRB;
                $noSKTM = $sep->response->sep->informasi->noSKTM;
                $poli = $sep->response->sep->poli;
                $poliEksekutif = $sep->response->sep->poliEksekutif;
                //$cob = $sep->response->sep->cob;
                //$katarak = $sep->response->sep->katarak;
                $tglSep = $sep->response->sep->tglSep;
                $pelayanan = 'IGD';
                $kelasRawat = $sep->response->sep->kelasRawat;

                $simpandata = [

                    'pelayanan' => $pelayanan,
                    'journalnumber' => $journalnumber,
                    'norm' => $datasep['noMR'],
                    'catatan' => $datasep['catatan'],
                    'diagnosa' => $diagnosa,
                    'jnsPelayanan' => $jnsPelayanan,
                    'kelasRawat' => $kelasRawat,
                    'noSep' => $noSep,
                    'kelasRawat' => $kelasRawat,
                    'penjamin' => $penjamin,
                    'asuransi' => $asuransi,
                    'hakKelas' => $hakKelas,
                    'jnsPeserta' => $jnsPeserta,
                    'kelamin' => $kelamin,
                    'nama' => $nama,
                    'noKartu' => $noKartu,
                    'tglLahir' => $tglLahir,
                    'dinsos' => $dinsos,
                    'prolanisPRB' => $prolanisPRB,
                    'noSKTM' => $noSKTM,
                    'poli' => $poli,
                    'poliEksekutif' => $poliEksekutif,
                    'tglSep' => $tglSep,
                    'asalRujukan' => $datasep['asalRujukan'],
                    'tglRujukan' => $datasep['tglRujukan'],
                    'noRujukan' => $datasep['noRujukan'],
                    'ppkRujukan' => $datasep['ppkRujukan'],
                    'lakaLantas' => $datasep['lakalantas'],
                    'tglKejadian' => $datasep['tglKejadian'],
                    'suplesi' => $datasep['suplesi'],
                    'noSuplesi' => $datasep['noSepSuplesi'],
                    'kdPropinsi' => $datasep['kdPropinsi'],
                    'kdKabupaten' => $datasep['kdKabupaten'],
                    'kdKecamatan' => $datasep['kdKecamatan'],
                    'createdby' => $createdby,
                    'noTelp' => $datasep['noTelp'],
                    'cob' => $datasep['cob'],
                    'katarak' => $datasep['katarak'],
                    'keterangan' => $datasep['keterangan'],

                ];

                $simpannomorsep = new ModelDataSep;
                $simpannomorsep->insert($simpandata);
                $msg = [
                    'success' => true,
                    'response' => $sep->response,
                    'pesan' => $sep->metaData->message
                ];
            }
        }
        echo json_encode($msg);
    }

    public function simpanSEP()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');
            $pilihan_eksekutif = $this->request->getVar('eksekutif');
            $pilihan_cob = $this->request->getVar('cob');
            $pilihan_katarak = $this->request->getVar('katarak');
            $pilihan_lakalantas = $this->request->getVar('lakalantas2');
            $pilihan_suplesi = $this->request->getVar('suplesi2');
            $dpjp = $this->request->getVar('kodeDPJP');
            $dpjpLayan = $this->request->getVar('dpjpLayan');

            if ($pilihan_eksekutif == "1") {
                $datasep['eksekutif'] = "1";
            } else {
                $datasep['eksekutif'] = "0";
            }

            if ($pilihan_cob == "1") {
                $datasep['cob'] = "1";
            } else {
                $datasep['cob'] = "0";
            }
            if ($pilihan_katarak == "1") {
                $datasep['katarak'] = "1";
            } else {
                $datasep['katarak'] = "0";
            }
            if ($pilihan_lakalantas == "1") {
                $datasep['lakalantas'] = "1";
            } else {
                $datasep['lakalantas'] = "0";
            }

            if ($pilihan_suplesi == "1") {
                $datasep['suplesi'] = "1";
            } else {
                $datasep['suplesi'] = "0";
            }



            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['ppkPelayanan'] = $this->request->getVar('ppkPelayanan');
            $datasep['jnsPelayanan'] = $this->request->getVar('jnsPelayanan');
            $datasep['klsRawat'] = $this->request->getVar('klsRawat');

            //field baru
            $datasep['klsRawatHak'] = $this->request->getVar('klsRawat');
            $datasep['klsRawatNaik'] = '';
            $datasep['pembiayaan'] = '';
            $datasep['penanggungJawab'] = '';
            $datasep['tujuanKunj'] = $this->request->getVar('tujuanKunj');
            $datasep['flagProcedure'] = $this->request->getVar('flagProcedure');

            $datasep['kdPenunjang'] = $this->request->getVar('kdPenunjang');

            $datasep['assesmentPel'] = $this->request->getVar('assesmentPel');
            $datasep['dpjpLayan'] = $dpjpLayan;
            $datasep['ketLakalantas'] = $this->request->getVar('ketLakalantas');

            //



            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['asalRujukan'] = $this->request->getVar('asalRujukan');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['ppkRujukan'] = $this->request->getVar('ppkRujukan');

            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagAwal'] = $this->request->getVar('diagAwal');
            $datasep['tujuan'] = $this->request->getVar('tujuan');

            //$datasep['ketLakalantas'] = $this->request->getVar('ketLakalantas');

            $datasep['penjamin'] = $this->request->getVar('penjamin');
            $datasep['tglKejadian'] = $this->request->getVar('tglKejadian');
            $datasep['keterangan'] = $this->request->getVar('keterangan');

            $datasep['noSepSuplesi'] = $this->request->getVar('noSepSuplesi');

            $datasep['kdPropinsi'] = $this->request->getVar('kdPropinsix');
            $datasep['kdKabupaten'] = $this->request->getVar('kdKabupaten');
            $datasep['kdKecamatan'] = $this->request->getVar('kdKecamatan');

            $datasep['noSurat'] = $this->request->getVar('noSurat');
            $datasep['kodeDPJP'] = $dpjp;
            $datasep['noTelp'] = $this->request->getVar('noTelp');
            $datasep['user'] = $this->request->getVar('user');
            $createdby = $this->request->getVar('createdby');
            $journalnumber = $this->request->getVar('journalnumberrajal');
            $tglMasuk = $this->request->getVar('tglMasuk');


            $hari_ini = date('Y-m-d');

            $tgl1 = strtotime($tglMasuk);
            $tgl2 = strtotime($hari_ini);
            $jarak = $tgl2 - $tgl1;

            $hari = $jarak / 60 / 60 / 24;



            if ($datasep['tujuanKunj'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Tujuan Kunjungan Terlebih Dahulu'
                ];
            } else if (($datasep['tujuanKunj'] == 0) and ($datasep['flagProcedure'] <> "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tidak Diperkanankan Mengisi Flag Procedure Jika Tujuan Kunjungan Normal'
                ];
            } else if ($hari > 3) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Pembuatan SEP Sudah Melebihi 3x24 Jam, Silahkan untuk melakukan Pengajuan Penjaminan SEP'
                ];
            } else if (($datasep['ketLakalantas'] <> 0) and ($datasep['tglSep'] < $datasep['tglKejadian'])) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tanggal Kejadian KLL Tidak Boleh Lebih Besar daripada Tanggal SEP'
                ];
            } else if (($datasep['ketLakalantas'] <> 0) and ($datasep['tglSep'] < $datasep['tglKejadian'])) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tanggal Kejadian KLL Tidak Boleh Lebih Besar daripada Tanggal SEP'
                ];
            } else if (($datasep['ketLakalantas'] != 0) and ($datasep['kdPropinsi'] == "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Telerbih Dahulu Propinsi Kejadian KLL'
                ];
            } else if (($datasep['ketLakalantas'] != 0) and ($datasep['kdKabupaten'] == null)) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Telerbih Dahulu Kabupaten Kejadian KLL'
                ];
            } else if (($datasep['ketLakalantas'] != 0) and ($datasep['kdKecamatan'] == null)) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Telerbih Dahulu Kecamatan Kejadian KLL'
                ];
            } else {
                $header = $this->header();

                $sep = json_decode($this->insert_sep($datasep, $header), true);

                $cons_id = $header['X-cons-id'];
                $secretKey = "2mSA7604B8";
                $tStamp = $header['X-timestamp'];

                $key = $cons_id . $secretKey . $tStamp;
                $keluaran = $this->stringDecrypt($key, $sep['response']);
                $datakeluaran = json_decode($keluaran, true);

                if ($sep['response'] == null) {
                    $msg = [
                        'success' => false,
                        'pesan' => $sep['metaData']['message']
                    ];
                } else {
                    $noSep = $datakeluaran['sep']['noSep'];
                    $diagnosa = $datakeluaran['sep']['diagnosa'];
                    $jnsPelayanan = $datakeluaran['sep']['jnsPelayanan'];
                    $kelasRawat = $datakeluaran['sep']['kelasRawat'];
                    $penjamin = $datakeluaran['sep']['penjamin'];
                    $asuransi = $datakeluaran['sep']['peserta']['asuransi'];
                    $hakKelas = $datakeluaran['sep']['peserta']['hakKelas'];
                    $jnsPeserta = $datakeluaran['sep']['peserta']['jnsPeserta'];
                    $kelamin = $datakeluaran['sep']['peserta']['kelamin'];
                    $nama = $datakeluaran['sep']['peserta']['nama'];
                    $noKartu = $datakeluaran['sep']['peserta']['noKartu'];
                    $noMr = $datakeluaran['sep']['peserta']['noMr'];
                    $tglLahir = $datakeluaran['sep']['peserta']['tglLahir'];
                    $dinsos = $datakeluaran['sep']['informasi']['dinsos'];
                    $prolanisPRB = $datakeluaran['sep']['informasi']['prolanisPRB'];
                    $noSKTM = $datakeluaran['sep']['informasi']['noSKTM'];
                    $poli = $datakeluaran['sep']['poli'];
                    $poliEksekutif = $datakeluaran['sep']['poliEksekutif'];

                    $tglSep = $datakeluaran['sep']['tglSep'];
                    $pelayanan = 'IGD';
                    $kelasRawat = $datakeluaran['sep']['kelasRawat'];

                    $simpandata = [

                        'pelayanan' => $pelayanan,
                        'journalnumber' => $journalnumber,
                        'norm' => $datasep['noMR'],
                        'catatan' => $datasep['catatan'],
                        'diagnosa' => $diagnosa,
                        'jnsPelayanan' => $jnsPelayanan,
                        'noSep' => $noSep,
                        'kelasRawat' => $datasep['klsRawat'],
                        'penjamin' => $penjamin,
                        'asuransi' => $asuransi,
                        'hakKelas' => $hakKelas,
                        'jnsPeserta' => $jnsPeserta,
                        'kelamin' => $kelamin,
                        'nama' => $nama,
                        'noKartu' => $noKartu,
                        'tglLahir' => $tglLahir,
                        'dinsos' => $dinsos,
                        'prolanisPRB' => $prolanisPRB,
                        'noSKTM' => $noSKTM,
                        'poli' => $poli,
                        'poliEksekutif' => $poliEksekutif,
                        'tglSep' => $tglSep,
                        'asalRujukan' => $datasep['asalRujukan'],
                        'tglRujukan' => $datasep['tglRujukan'],
                        'noRujukan' => $datasep['noRujukan'],
                        'ppkRujukan' => $datasep['ppkRujukan'],
                        'lakaLantas' => $datasep['lakalantas'],
                        'tglKejadian' => $datasep['tglKejadian'],
                        'suplesi' => $datasep['suplesi'],
                        'noSuplesi' => $datasep['noSepSuplesi'],
                        'kdPropinsi' => $datasep['kdPropinsi'],
                        'kdKabupaten' => $datasep['kdKabupaten'],
                        'kdKecamatan' => $datasep['kdKecamatan'],
                        'createdby' => $createdby,
                        'noTelp' => $datasep['noTelp'],
                        'cob' => $datasep['cob'],
                        'katarak' => $datasep['katarak'],
                        'keterangan' => $datasep['keterangan'],
                        'pembiayaan' => $datasep['pembiayaan'],
                        'penanggungJawab' => $datasep['penanggungJawab'],
                        'tujuanKunj' => $datasep['tujuanKunj'],
                        'flagProcedure' => $datasep['flagProcedure'],
                        'kdPenunjang' => $datasep['kdPenunjang'],
                        'dpjpLayan' => $datasep['dpjpLayan'],
                        'jenislakaLantas' => $datasep['ketLakalantas'],
                        'kodeDPJP' => $datasep['kodeDPJP'],

                    ];

                    $simpannomorsep = new ModelDataSep;
                    $simpannomorsep->insert($simpandata);
                    $msg = [
                        'success' => true,
                        'response' => $datakeluaran,
                        'pesan' => $sep['metaData']['message']
                    ];
                }
            }
        }
        echo json_encode($msg);
    }

    function vclaim_conf()
    {
        $vclaim_conf = [
            'cons_id' => '17036',
            'secret_key' => '2mSA7604B8',
            'base_url' => 'https://new-api.bpjs-kesehatan.go.id:8080',
            'service_name' => 'new-vclaim-rest-dev',


        ];
        return $vclaim_conf;
    }

    function vclaim_confV2()
    {
        $vclaim_conf = [
            'cons_id' => '17036',
            'secret_key' => 'eb5b7d30510d81809eb3a9a5f4eb7344',
            'base_url' => 'https://new-api.bpjs-kesehatan.go.id:8080',
            'service_name' => 'new-vclaim-rest-dev',
            'user_key' => 'eb5b7d30510d81809eb3a9a5f4eb7344'

        ];
        return $vclaim_conf;
    }

    private function insert_sep($param, $header)
    {

        $data = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noKartu" => $param['noKartu'],
                    "tglSep" => $param['tglSep'],
                    "ppkPelayanan" => $param['ppkPelayanan'],
                    "jnsPelayanan" => $param['jnsPelayanan'],

                    "klsRawat" => [
                        "klsRawatHak" => $param['klsRawatHak'],
                        "klsRawatNaik" => $param['klsRawatNaik'],
                        "pembiayaan" => $param['pembiayaan'],
                        "penanggungJawab" => $param['penanggungJawab']

                    ],
                    "noMR" => $param['noMR'],
                    "rujukan" => [
                        "asalRujukan" => $param['asalRujukan'],
                        "tglRujukan" => $param['tglSep'],
                        "noRujukan" => $param['noRujukan'],
                        "ppkRujukan" => $param['ppkRujukan']
                    ],
                    "catatan" => $param['catatan'],
                    "diagAwal" => $param['diagAwal'],
                    "poli" => [
                        "tujuan" => $param['tujuan'],
                        "eksekutif" => $param['eksekutif']
                    ],
                    "cob" => [
                        "cob" => $param['cob']
                    ],
                    "katarak" => [
                        "katarak" => $param['katarak']
                    ],
                    "jaminan" => [
                        "lakaLantas" => $param['ketLakalantas'],
                        "penjamin" => [
                            //"penjamin" => $param['penjamin'],
                            "tglKejadian" => $param['tglKejadian'],
                            "keterangan" => $param['keterangan'],
                            "suplesi" => [
                                "suplesi" => $param['suplesi'],
                                "noSepSuplesi" => $param['noSepSuplesi'],
                                "lokasiLaka" => [
                                    "kdPropinsi" => $param['kdPropinsi'],
                                    "kdKabupaten" => $param['kdKabupaten'],
                                    "kdKecamatan" => $param['kdKecamatan']
                                ]
                            ]
                        ]
                    ],
                    "tujuanKunj" => $param['tujuanKunj'],
                    "flagProcedure" => $param['flagProcedure'],
                    "kdPenunjang" => $param['kdPenunjang'],
                    "assesmentPel" => $param['assesmentPel'],
                    "skdp" => [
                        "noSurat" => $param['noSurat'],
                        "kodeDPJP" => $param['kodeDPJP']
                    ],
                    "dpjpLayan" => $param['dpjpLayan'],
                    "noTelp" => $param['noTelp'],
                    "user" => $param['user']
                ]
            ]
        ];
        // $vclaim_conf = $this->vclaim_confV2();
        // $request = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        // $data = $request->insertSEPV2($data);

        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $this->base_url . $this->service_name . 'SEP/2.0/insert', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;

        //return json_encode($response);
    }

    private function insert_sepV1($param)
    {

        $data = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noKartu" => $param['noKartu'],
                    "tglSep" => $param['tglSep'],
                    "ppkPelayanan" => $param['ppkPelayanan'],
                    "jnsPelayanan" => $param['jnsPelayanan'],
                    "klsRawat" => $param['klsRawat'],
                    "noMR" => $param['noMR'],
                    "rujukan" => [
                        "asalRujukan" => $param['asalRujukan'],
                        "tglRujukan" => $param['tglSep'],
                        "noRujukan" => $param['noRujukan'],
                        "ppkRujukan" => $param['ppkRujukan']
                    ],
                    "catatan" => $param['catatan'],
                    "diagAwal" => $param['diagAwal'],
                    "poli" => [
                        "tujuan" => $param['tujuan'],
                        "eksekutif" => $param['eksekutif']
                    ],
                    "cob" => [
                        "cob" => $param['cob']
                    ],
                    "katarak" => [
                        "katarak" => $param['katarak']
                    ],
                    "jaminan" => [
                        "lakaLantas" => $param['lakalantas'],
                        "penjamin" => [
                            "penjamin" => $param['penjamin'],
                            "tglKejadian" => $param['tglKejadian'],
                            "keterangan" => $param['keterangan'],
                            "suplesi" => [
                                "suplesi" => $param['suplesi'],
                                "noSepSuplesi" => $param['noSepSuplesi'],
                                "lokasiLaka" => [
                                    "kdPropinsi" => $param['kdPropinsi'],
                                    "kdKabupaten" => $param['kdKabupaten'],
                                    "kdKecamatan" => $param['kdKecamatan']
                                ]
                            ]
                        ]
                    ],
                    "skdp" => [
                        "noSurat" => $param['noSurat'],
                        "kodeDPJP" => $param['kodeDPJP']
                    ],
                    "noTelp" => $param['noTelp'],
                    "user" => $param['user']
                ]
            ]
        ];
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $data = $request->insertSEP($data);

        return json_encode($data);
    }

    public function HapusSep()
    {
        if ($this->request->isAJAX()) {

            //$id = $this->request->getVar('id');
            $noSep = $this->request->getVar('nomorSep');
            $datasep['noSep'] = $this->request->getVar('nomorSep');
            $datasep['user'] = 'Coba Ws';
            $sep = json_decode($this->delete_sep($datasep));

            $hapussep = new ModelPasienMaster;
            if ($noSep != "") {
                $carisep = $hapussep->get_data_dataSep($noSep);
                $id = $carisep['id'];
                $sepdihapus = new ModelDataSep;
                $sepdihapus->delete($id);
            }
            $msg = [
                'success' => true,
                'pesan' => $sep->metaData->message
            ];

            echo json_encode($msg);
        }
    }

    private function delete_sep($param)
    {

        $data = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noSep" => $param['noSep'],
                    "user" => $param['user']
                ]
            ]
        ];
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $data = $request->deleteSEP($data);

        return json_encode($data);
    }


    public function CariSepV1()
    {

        $vclaim_conf = $this->vclaim_conf();
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $keyword = $this->request->getVar('nomorSep');
        $data = $peserta->cariSEP($keyword);

        echo json_encode($data);
    }

    private function cari_sep($param)
    {

        $keyword = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noSep" => $param['noSep']
                ]
            ]
        ];
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $keyword = $request->cariSEP($keyword);

        return json_encode($keyword);
    }

    public function tujuanKunjunganSep()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_tujuanKunjunganSep();
        return $list;
    }


    public function flagprocedure()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_flagprocedure();
        return $list;
    }

    public function penunjangsep()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_penunjangsep();
        return $list;
    }

    public function assesmentpelayanansep()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_assesmnetpelayanansep();
        return $list;
    }

    public function jeniskllsep()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_jeniskllsep();
        return $list;
    }

    public function UpdateSep()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row_sep($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];



            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsiBpjs(),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => 'IGD',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'noSep' => $rajal['noSep'],
                'noRujukan' => $rajal['noRujukan'],
                'tglRujukan' => $rajal['tglRujukan'],
                'ppkRujukan' => $rajal['ppkRujukan'],
                'diagnosa' => $rajal['diagnosa'],
                'catatan' => $rajal['catatan'],
                'poliEksekutif' => $rajal['poliEksekutif'],
                'cob' => $rajal['cob'],
                'katarak' => $rajal['katarak'],
                'lakaLantas' => $rajal['lakaLantas'],
                'penjamin' => $rajal['penjamin'],
                'keterangan' => $rajal['keterangan'],
                'tglKejadian' => $rajal['tglKejadian'],
                'suplesi' => $rajal['suplesi'],
                'noSuplesi' => $rajal['noSuplesi'],
                'kdPropinsi' => $rajal['kdPropinsi'],
                'kdKabupaten' => $rajal['kdKabupaten'],
                'kdKecamatan' => $rajal['kdKecamatan'],
                'hakKelas' => $rajal['hakKelas'],
                'kelasRawat' => $rajal['kelasRawat'],
                'noTelp' => $rajal['noTelp'],

                'tujuanKunj' => $rajal['tujuanKunj'],
                'flagProcedureSep' => $rajal['flagProcedure'],
                'kdPenunjang' => $rajal['kdPenunjang'],
                'jenislakaLantas' => $rajal['jenislakaLantas'],
                'dpjpLayan' => $rajal['dpjpLayan'],
                'assesmentPel' => $rajal['assesmentPel'],

                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'jeniskll' => $this->jeniskllsep(),
            ];

            $msg = [
                'suksesmodalsep' => view('igd/modalupdatesepugd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanUpdateSEPV1()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');
            $pilihan_eksekutif = $this->request->getVar('eksekutif');
            $pilihan_cob = $this->request->getVar('cob');
            $pilihan_katarak = $this->request->getVar('katarak');
            $pilihan_lakalantas = $this->request->getVar('lakalantas2');
            $pilihan_suplesi = $this->request->getVar('suplesi2');
            $dpjp = $this->request->getVar('kodeDPJP');

            if ($pilihan_eksekutif == "1") {
                $datasep['eksekutif'] = "1";
            } else {
                $datasep['eksekutif'] = "0";
            }

            if ($pilihan_cob == "1") {
                $datasep['cob'] = "1";
            } else {
                $datasep['cob'] = "0";
            }
            if ($pilihan_katarak == "1") {
                $datasep['katarak'] = "1";
            } else {
                $datasep['katarak'] = "0";
            }
            if ($pilihan_lakalantas == "1") {
                $datasep['lakalantas'] = "1";
            } else {
                $datasep['lakalantas'] = "0";
            }

            if ($pilihan_suplesi == "1") {
                $datasep['suplesi'] = "1";
            } else {
                $datasep['suplesi'] = "0";
            }


            $datasep['noSep'] = $this->request->getVar('noSep');
            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['ppkPelayanan'] = $this->request->getVar('ppkPelayanan');
            $datasep['jnsPelayanan'] = $this->request->getVar('jnsPelayanan');
            $datasep['klsRawat'] = $this->request->getVar('klsRawat');
            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['asalRujukan'] = $this->request->getVar('asalRujukan');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['ppkRujukan'] = $this->request->getVar('ppkRujukan');
            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagAwal'] = $this->request->getVar('diagAwal');
            $datasep['tujuan'] = $this->request->getVar('tujuan');
            $datasep['penjamin'] = $this->request->getVar('penjamin');
            $datasep['tglKejadian'] = $this->request->getVar('tglKejadian');
            $datasep['keterangan'] = $this->request->getVar('keterangan');
            $datasep['noSepSuplesi'] = $this->request->getVar('nosuplesi');
            $datasep['kdPropinsi'] = $this->request->getVar('kdPropinsi');
            $datasep['kdKabupaten'] = $this->request->getVar('kdKabupaten');
            $datasep['kdKecamatan'] = $this->request->getVar('kdKecamatan');
            $datasep['noSurat'] = $this->request->getVar('noSurat');
            $datasep['kodeDPJP'] = $dpjp;
            $datasep['noTelp'] = $this->request->getVar('noTelp');
            $datasep['user'] = $this->request->getVar('user');
            $createdby = $this->request->getVar('createdby');
            $journalnumber = $this->request->getVar('journalnumberrajal');

            $sep = json_decode($this->updatesepv1($datasep));


            if ($sep->metaData->message !== "Sukses") {
                $msg = [
                    'success' => false,
                    'pesan' => $sep->metaData->message
                ];
            } else {

                $simpandata = [
                    'catatan' => $datasep['catatan'],
                    'penjamin' =>  $datasep['penjamin'],
                    'asalRujukan' => $datasep['asalRujukan'],
                    'tglRujukan' => $datasep['tglRujukan'],
                    'noRujukan' => $datasep['noRujukan'],
                    'ppkRujukan' => $datasep['ppkRujukan'],
                    'lakaLantas' => $datasep['lakalantas'],
                    'tglKejadian' => $datasep['tglKejadian'],
                    'suplesi' => $datasep['suplesi'],
                    'noSuplesi' => $datasep['noSepSuplesi'],
                    'kdPropinsi' => $datasep['kdPropinsi'],
                    'kdKabupaten' => $datasep['kdKabupaten'],
                    'kdKecamatan' => $datasep['kdKecamatan'],
                    'updatedBy' => $createdby,
                    'noTelp' => $datasep['noTelp'],
                    'cob' => $datasep['cob'],
                    'katarak' => $datasep['katarak'],
                    'keterangan' => $datasep['keterangan'],
                ];

                $simpannomorsep = new ModelDataSep;
                $nosep = $datasep['noSep'];
                $simpannomorsep->update_dataSep($nosep, $simpandata);
                $msg = [
                    'success' => true,
                    'pesan' => $sep->metaData->message
                ];
            }
        }

        echo json_encode($msg);
    }



    private function updatesepv1($param)
    {

        $data = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noSep" => $param['noSep'],
                    "klsRawat" => $param['klsRawat'],
                    "noMR" => $param['noMR'],
                    "rujukan" => [
                        "asalRujukan" => $param['asalRujukan'],
                        "tglRujukan" => $param['tglRujukan'],
                        "noRujukan" => $param['noRujukan'],
                        "ppkRujukan" => $param['ppkRujukan']
                    ],
                    "catatan" => $param['catatan'],
                    "diagAwal" => $param['diagAwal'],
                    "poli" => [
                        "eksekutif" => $param['eksekutif']
                    ],
                    "cob" => [
                        "cob" => $param['cob']
                    ],
                    "katarak" => [
                        "katarak" => $param['katarak']
                    ],
                    "skdp" => [
                        "noSurat" => $param['noSurat'],
                        "kodeDPJP" => $param['kodeDPJP']
                    ],
                    "jaminan" => [
                        "lakaLantas" => $param['lakalantas'],
                        "penjamin" => [
                            "penjamin" => $param['penjamin'],
                            "tglKejadian" => $param['tglKejadian'],
                            "keterangan" => $param['keterangan'],
                            "suplesi" => [
                                "suplesi" => $param['suplesi'],
                                "noSepSuplesi" => $param['noSepSuplesi'],
                                "lokasiLaka" => [
                                    "kdPropinsi" => $param['kdPropinsi'],
                                    "kdKabupaten" => $param['kdKabupaten'],
                                    "kdKecamatan" => $param['kdKecamatan']
                                ]
                            ]
                        ]
                    ],

                    "noTelp" => $param['noTelp'],
                    "user" => $param['user']
                ]
            ]
        ];
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $data = $request->updateSEP($data);

        return json_encode($data);
    }

    public function CreateSPRI()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row_sep($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];
            $namapoli = $rajal['poliklinikname'];

            //$mapingpoli = $m_icd->get_data_poli_bpjs($kodepoli);

            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsiBpjs(),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => $kodepoli,
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'noSep' => $rajal['noSep'],
                'noRujukan' => $rajal['noRujukan'],
                'tglRujukan' => $rajal['tglRujukan'],
                'ppkRujukan' => $rajal['ppkRujukan'],
                'diagnosa' => $rajal['diagnosa'],
                'catatan' => $rajal['catatan'],
                'poliEksekutif' => $rajal['poliEksekutif'],
                'cob' => $rajal['cob'],
                'katarak' => $rajal['katarak'],
                'lakaLantas' => $rajal['lakaLantas'],
                'penjamin' => $rajal['penjamin'],
                'keterangan' => $rajal['keterangan'],
                'tglKejadian' => $rajal['tglKejadian'],
                'suplesi' => $rajal['suplesi'],
                'noSuplesi' => $rajal['noSuplesi'],
                'kdPropinsi' => $rajal['kdPropinsi'],
                'kdKabupaten' => $rajal['kdKabupaten'],
                'kdKecamatan' => $rajal['kdKecamatan'],
                'hakKelas' => $rajal['hakKelas'],
                'kelasRawat' => $rajal['kelasRawat'],
                'noTelp' => $rajal['noTelp'],
                'kode_poliBpjs' => 'IGD',
                'namapoli' => $namapoli,
            ];

            $msg = [
                'suksesmodalspri' => view('igd/modalcreateSPRIigd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function historipelayananSep()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
            ];
            $msg = [
                'data' => view('igd/modalhistoripelayananSep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function UbahMasterPasienNik()
    {
        if ($this->request->isAJAX()) {
            $nik = $this->request->getVar('nomorinduk');
            $m_icd = new ModelPasienMaster();
            $data = [
                'pasienlama' => $m_icd->get_data_pasien_lama_nik($nik),
            ];

            $msg = [
                'data' => view('igd/modalupdatenik', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function updateNikPasien()
    {
        if ($this->request->isAJAX()) {

            $nik = $this->request->getVar('noindukpasien');
            $incorrectNik = $this->request->getVar('incorrectNik');
            $modifiedby = $this->request->getVar('modifiedby');

            $cek = new ModelPasienMaster();
            $id = $this->request->getVar('idpasien');
            $hasilcek = $cek->search_pasien_update_nik($nik);

            $cekdulu = isset($hasilcek['id']) != null ? $hasilcek['id'] : "";
            if ($cekdulu == "") {
                $simpandata = [
                    'ssn' => $nik,
                    'incorrectNik' => $incorrectNik,
                    'modifiedby' => $modifiedby,
                ];
                $perawat = new ModelPasienMaster;
                $id = $this->request->getVar('idpasien');
                $perawat->update($id, $simpandata);
                $msg = [
                    'sukses' => 'Data Nik sudah berhasil diubah'
                ];
            } else {
                $msg = [
                    'gagal' => 'Data Nik sudah dimiliki data pasien yang lain'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function stringDecrypt($key, $string)
    {

        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);

        return $output;
    }

    public function header()
    {
        //const id
        $data = "17036";
        //secret key
        $secretKey = "2mSA7604B8";
        $user_key = "eb5b7d30510d81809eb3a9a5f4eb7344";
        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $data . "&" . $tStamp, $secretKey, true);

        $encodedSignature = base64_encode($signature);


        $header = [
            "X-cons-id" => $data,
            "X-timestamp" => $tStamp,
            "X-signature" => $encodedSignature,
            "user_key" => $user_key,
        ];
        return $header;
    }

    public function simpanUpdateSEP()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');
            $pilihan_eksekutif = $this->request->getVar('eksekutif');
            $pilihan_cob = $this->request->getVar('cob');
            $pilihan_katarak = $this->request->getVar('katarak');
            $pilihan_lakalantas = $this->request->getVar('lakalantas2');
            $pilihan_suplesi = $this->request->getVar('suplesi2');
            $dpjp = $this->request->getVar('kodeDPJP');
            $dpjpLayan = $this->request->getVar('dpjpLayan');

            $dpjp = $this->request->getVar('dokterbpjs');
            if ($pilihan_eksekutif == "1") {
                $datasep['eksekutif'] = "1";
            } else {
                $datasep['eksekutif'] = "0";
            }

            if ($pilihan_cob == "1") {
                $datasep['cob'] = "1";
            } else {
                $datasep['cob'] = "0";
            }
            if ($pilihan_katarak == "1") {
                $datasep['katarak'] = "1";
            } else {
                $datasep['katarak'] = "0";
            }
            if ($pilihan_lakalantas == "1") {
                $datasep['lakalantas'] = "1";
            } else {
                $datasep['lakalantas'] = "0";
            }

            if ($pilihan_suplesi == "1") {
                $datasep['suplesi'] = "1";
                $datasep['noSepSuplesi'] = $this->request->getVar('noSepSuplesi');
            } else {
                $datasep['suplesi'] = "0";
                $datasep['noSepSuplesi'] = '';
            }


            $datasep['noSep'] = $this->request->getVar('noSep');
            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['ppkPelayanan'] = $this->request->getVar('ppkPelayanan');
            $datasep['jnsPelayanan'] = $this->request->getVar('jnsPelayanan');
            $datasep['klsRawat'] = $this->request->getVar('klsRawat');

            //field baru
            $datasep['klsRawatHak'] = $this->request->getVar('klsRawat');
            $datasep['klsRawatNaik'] = '';
            $datasep['pembiayaan'] = '';
            $datasep['penanggungJawab'] = '';
            $datasep['tujuanKunj'] = $this->request->getVar('tujuanKunj');
            $datasep['flagProcedure'] = $this->request->getVar('flagProcedure');
            $datasep['kdPenunjang'] = $this->request->getVar('kdPenunjang');
            $datasep['assesmentPel'] = $this->request->getVar('assesmentPel');
            $datasep['dpjpLayan'] = $dpjpLayan;
            //

            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['asalRujukan'] = $this->request->getVar('asalRujukanSep');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['ppkRujukan'] = $this->request->getVar('ppkRujukan');
            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagAwal'] = $this->request->getVar('diagAwal');
            $datasep['namadiagAwal'] = $this->request->getVar('namadiagAwal');



            $datasep['tujuan'] = $this->request->getVar('tujuan');

            $datasep['ketLakalantas'] = $this->request->getVar('ketLakalantas');

            if ($datasep['ketLakalantas'] == 0) {

                $datasep['penjamin'] = '';
                $datasep['tglKejadian'] = '';
                $datasep['keterangan'] = '';
                $datasep['kdPropinsi'] = '';
                $datasep['kdKabupaten'] = '';
                $datasep['kdKecamatan'] = '';
            } else {
                $datasep['penjamin'] = $this->request->getVar('penjamin');
                $datasep['tglKejadian'] = $this->request->getVar('tglKejadian');
                $datasep['keterangan'] = $this->request->getVar('keterangan');
                $datasep['kdPropinsi'] = $this->request->getVar('kdPropinsix');
                $datasep['kdKabupaten'] = $this->request->getVar('kdKabupaten');
                $datasep['kdKecamatan'] = $this->request->getVar('kdKecamatan');
            }


            $datasep['noSurat'] = $this->request->getVar('noSurat');
            $datasep['kodeDPJP'] = $dpjp;
            $datasep['noTelp'] = $this->request->getVar('noTelp');
            $datasep['user'] = $this->request->getVar('user');
            $createdby = $this->request->getVar('createdby');

            $journalnumber = $this->request->getVar('journalnumberrajal');

            if ($datasep['tujuanKunj'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Tujuan Kunjungan Terlebih Dahulu'
                ];
            } else if (($datasep['tujuanKunj'] == 0) and ($datasep['flagProcedure'] <> "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tidak Diperkanankan Mengisi Flag Procedure Jika Tujuan Kunjungan Normal'
                ];
            } else {

                $header = $this->header();
                $sep = json_decode($this->update_sep($datasep, $header), true);




                $cons_id = $header['X-cons-id'];
                $secretKey = "2mSA7604B8";
                $tStamp = $header['X-timestamp'];

                $key = $cons_id . $secretKey . $tStamp;
                //$string = json_decode($response, true);
                $keluaran = $this->stringDecrypt($key, $sep['response']);
                $datakeluaran = json_decode($keluaran, true);


                if ($sep['metaData']['message'] !== "Sukses") {
                    $msg = [
                        'success' => false,
                        'pesan' => $sep['metaData']['message']
                    ];
                } else {

                    $simpandata = [
                        'catatan' => $datasep['catatan'],
                        'diagnosa' =>  $datasep['namadiagAwal'],
                        'penjamin' =>  $datasep['penjamin'],
                        'asalRujukan' => $datasep['asalRujukan'],
                        'tglRujukan' => $datasep['tglRujukan'],
                        'noRujukan' => $datasep['noRujukan'],
                        'ppkRujukan' => $datasep['ppkRujukan'],
                        'lakaLantas' => $datasep['lakalantas'],
                        'jenislakaLantas' => $datasep['ketLakalantas'],
                        'tglKejadian' => $datasep['tglKejadian'],
                        'suplesi' => $datasep['suplesi'],
                        'noSuplesi' => $datasep['noSepSuplesi'],
                        'kdPropinsi' => $datasep['kdPropinsi'],
                        'kdKabupaten' => $datasep['kdKabupaten'],
                        'kdKecamatan' => $datasep['kdKecamatan'],
                        'updatedBy' => $createdby,
                        'noTelp' => $datasep['noTelp'],
                        'cob' => $datasep['cob'],
                        'katarak' => $datasep['katarak'],
                        'keterangan' => $datasep['keterangan'],
                        'dpjpLayan' =>  $datasep['dpjpLayan'],

                    ];

                    $simpannomorsep = new ModelDataSep;
                    $nosep = $datasep['noSep'];
                    $simpannomorsep->update_dataSep($nosep, $simpandata);
                    $msg = [
                        'success' => true,
                        'pesan' => $sep['metaData']['message']
                    ];
                }
            }
        }

        echo json_encode($msg);
    }



    private function update_sep($param, $header)
    {
        $data = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noSep" => $param['noSep'],
                    "klsRawat" => [
                        "klsRawatHak" => '3',
                        "klsRawatNaik" => '',
                        "pembiayaan" => '',
                        "penanggungJawab" => ''
                    ],
                    "noMR" => $param['noMR'],
                    "catatan" => $param['catatan'],
                    "diagAwal" => $param['diagAwal'],
                    "poli" => [
                        "tujuan" => $param['tujuan'],
                        "eksekutif" => $param['eksekutif']
                    ],
                    "cob" => [
                        "cob" => $param['cob']
                    ],
                    "katarak" => [
                        "katarak" => $param['katarak']
                    ],
                    "jaminan" => [
                        "lakaLantas" => $param['ketLakalantas'],
                        "penjamin" => [
                            "tglKejadian" => $param['tglKejadian'],
                            "keterangan" => $param['keterangan'],
                            "suplesi" => [
                                "suplesi" => $param['suplesi'],
                                "noSepSuplesi" => $param['noSepSuplesi'],
                                "lokasiLaka" => [
                                    "kdPropinsi" => $param['kdPropinsi'],
                                    "kdKabupaten" => $param['kdKabupaten'],
                                    "kdKecamatan" => $param['kdKecamatan']
                                ]
                            ]
                        ]
                    ],
                    "dpjpLayan" => $param['dpjpLayan'],
                    "noTelp" => $param['noTelp'],
                    "user" => $param['user']
                ]
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request(
            'PUT',
            $this->base_url . $this->service_name . 'SEP/2.0/update',
            [
                'headers' => $header,
                'json' => $data,
            ]
        )->getBody()->getContents();
        return $response;
    }

    public function CariSep()
    {
        //base url
        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest-dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $keyword = $this->request->getVar('nomorSep');

        $response = $client->request('GET', $base_url . $service_name . 'SEP/' . $keyword, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "2mSA7604B8";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        $data = [
            "metaData" => $string["metaData"],
            "response" => $datakeluaran,
        ];

        echo json_encode($data);
    }

    public function insertSpri()
    {
        if ($this->request->isAJAX()) {

            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['kodeDokter'] = $this->request->getVar('kodeDokter');
            $datasep['poliKontrol'] = $this->request->getVar('poliKontrol');
            $datasep['tglRencanaKontrol'] = $this->request->getVar('tglRencanaKontrol');
            $datasep['user'] = $this->request->getVar('createdby');

            $journalnumber = $this->request->getVar('journalnumberrajal');
            $referencenumber = $this->request->getVar('journalnumberrajal');
            $noMR = $this->request->getVar('noMR');
            $diagnosa = $this->request->getVar('diagnosaAwal');
            $noSep = $this->request->getVar('noSep');
            $nama = $this->request->getVar('namaPasien');
            $createdby = $this->request->getVar('createdby');

            $header = $this->header();
            $sep = json_decode($this->insert_spri($datasep, $header), true);


            $cons_id = $header['X-cons-id'];
            $secretKey = "2mSA7604B8";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            //$string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $sep['response']);
            $datakeluaran = json_decode($keluaran, true);



            $data['message'] = $sep['metaData']['message'];
            if ($sep['response'] == null) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep['metaData']['message']
                ];
            } else {

                $noSuratKontrol = $datakeluaran['noSPRI'];
                $tglRencanaKontrol = $datakeluaran['tglRencanaKontrol'];
                $namaDokter = $datakeluaran['namaDokter'];
                $noKartu = $datakeluaran['noKartu'];
                $nama = $datakeluaran['nama'];
                $kelamin = $datakeluaran['kelamin'];
                $tglLahir = $datakeluaran['tglLahir'];
                $simpandata = [

                    'journalnumber' => $journalnumber,
                    'referencenumber' => $referencenumber,
                    'norm' => $noMR,
                    'diagnosa' => $diagnosa,
                    'noSep' => $noSep,
                    'nama' => $nama,
                    'noSuratKontrol' => $noSuratKontrol,
                    'tglRencanaKontrol' => $tglRencanaKontrol,
                    'kodeDokter' => $datasep['kodeDokter'],
                    'namaDokter' => $namaDokter,
                    'createdby' => $createdby,
                    'nama' => $nama,
                    'noKartu' => $noKartu,
                    'tglLahir' => $tglLahir,
                    'poliKontrol' => $datasep['poliKontrol'],
                ];

                $simpannomorkontrol = new ModelDataSPRI;
                $simpannomorkontrol->insert($simpandata);
                $msg = [
                    'success' => true,
                    'response' => $datakeluaran,
                    'pesan' => $sep['metaData']['message']
                ];
            }
        }
        echo json_encode($msg);
    }
    private function insert_spri($param, $header)
    {

        $data = [
            "request" =>
            [
                "noKartu" => $param['noKartu'],
                "kodeDokter" => $param['kodeDokter'],
                "poliKontrol" => $param['poliKontrol'],
                "tglRencanaKontrol" => $param['tglRencanaKontrol'],
                "user" => $param['user']
            ]

        ];

        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $this->base_url . $this->service_name . 'RencanaKontrol/InsertSPRI', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function CariSPRI()
    {
        //base url
        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest-dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $keyword = $this->request->getVar('nomorSuratPerintahRawat');

        $response = $client->request('GET', $base_url . $service_name . 'RencanaKontrol/noSuratKontrol/' . $keyword, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "2mSA7604B8";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);




        $data = [
            "metaData" => $string["metaData"],
            "response" => $datakeluaran,
            "pesan" => $string['metaData']['message']
        ];

        echo json_encode($data);
    }

    public function HapusSPRI()
    {
        if ($this->request->isAJAX()) {

            $noSuratKontrol = $this->request->getVar('nomorSuratPerintahRawat');
            $datasep['noSuratKontrol'] = $this->request->getVar('nomorSuratPerintahRawat');
            $datasep['user'] = 'Coba Ws';
            $sep = json_decode($this->delete_surat_kontrol($datasep), true);

            $header = $this->header();
            $cons_id = $header['X-cons-id'];
            $secretKey = "2mSA7604B8";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $keluaran = $this->stringDecrypt($key, $sep['response']);
            $datakeluaran = json_decode($keluaran, true);

            if ($sep['metaData']['code'] != 200) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep['metaData']['message']
                ];
            } else {
                $hapussep = new ModelPasienMaster;

                $carisep = $hapussep->get_data_dataSPRI($noSuratKontrol);
                $id = $carisep['id'];
                $sepdihapus = new ModelDataSPRI;
                $sepdihapus->delete($id);

                $msg = [
                    'success' => true,
                    'pesan' => $sep['metaData']['message']
                ];
            }
            echo json_encode($msg);
        }
    }

    private function delete_surat_kontrol($param)
    {
        $data = [
            "request" =>
            [
                "t_suratkontrol" => [
                    "noSuratKontrol" => $param['noSuratKontrol'],
                    "user" => $param['user']
                ]
            ]
        ];

        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('DELETE', $this->base_url . $this->service_name . 'RencanaKontrol/Delete', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function printSPRI()
    {
        $dompdf = new Dompdf();

        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $databarcode = $pasien->dataSPRI($id);

        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest-dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $keyword = $this->request->getVar('page');

        $response = $client->request('GET', $base_url . $service_name . 'RencanaKontrol/noSuratKontrol/' . $keyword, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "2mSA7604B8";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        $cek = $string['metaData']['code'];
        $pesan = $string['metaData']['message'];

        if ($cek == 201) {
            echo ". $pesan .";
        } else {
            $data = [
                'datapasien' => $pasien->dataSPRI_all($id),
                'noSuratKontrol' => $datakeluaran['noSuratKontrol'],
                'tglRencanaKontrol' => $datakeluaran['tglRencanaKontrol'],
                'namaDokter' => $datakeluaran['namaDokter'],
                'noKartu' => $databarcode['noKartu'],
                'nama' => $databarcode['nama'],
                'tglLahir' => $datakeluaran['sep']['peserta']['tglLahir'],
                'diagnosa' => $datakeluaran['sep']['diagnosa'],
                'tglTerbit' => $datakeluaran['tglTerbit'],
                'jenkel' => $datakeluaran['sep']['peserta']['kelamin'],
            ];

            $pasienid_barcode = $databarcode['noSuratKontrol'];

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

            $html = view('pdf/stylebootstrap');
            $html = view('pdf/printSPRIIgd', $data);

            $dompdf->loadhtml($html);
            $dompdf->setPaper('A6', 'landscape');
            $dompdf->render();
            $namafile = $id;
            $dompdf->stream($namafile, ['Attachment' => 0]);
        }
    }

    public function UpdateSPRI()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row_spri($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];
            $namapoli = $rajal['poliklinikname'];

            $mapingpoli = $m_icd->get_data_poli_bpjs($kodepoli);

            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsiBpjs(),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => $kodepoli,
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'noSep' => $rajal['noSep'],
                'noSPRI' => $rajal['noSuratKontrol'],
                'diagnosa' => $rajal['diagnosa'],
                'kode_poliBpjs' => 'IGD',
                'namapoli' => $namapoli,
                'tglRencanaKontrol' => $rajal['tglRencanaKontrol'],
                'noSPRI' => $rajal['noSPRI'],
                'kodeDokter' => $rajal['kodeDokter'],
                'tglTerbit' => $rajal['created_at'],
                'poliKontrol' => $rajal['poliKontrol'],
            ];

            $msg = [
                'suksesmodalspri' => view('igd/modalupdateSPRIIgd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function SimpanUpdateSpri()
    {
        if ($this->request->isAJAX()) {

            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['kodeDokter'] = $this->request->getVar('kodeDokter');
            $datasep['poliKontrol'] = $this->request->getVar('poliKontrol');
            $datasep['tglRencanaKontrol'] = $this->request->getVar('tglRencanaKontrol');
            $datasep['user'] = $this->request->getVar('createdby');

            $journalnumber = $this->request->getVar('journalnumberrajal');
            $referencenumber = $this->request->getVar('journalnumberrajal');
            $noMR = $this->request->getVar('noMR');
            $diagnosa = $this->request->getVar('diagnosaAwal');
            $noSep = $this->request->getVar('noSep');
            $nama = $this->request->getVar('namaPasien');
            $createdby = $this->request->getVar('createdby');
            $datasep['noSPRI'] = $this->request->getVar('noSPRI');

            $header = $this->header();
            $sep = json_decode($this->update_spri($datasep, $header), true);


            $cons_id = $header['X-cons-id'];
            $secretKey = "2mSA7604B8";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            //$string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $sep['response']);
            $datakeluaran = json_decode($keluaran, true);

            $data['message'] = $sep['metaData']['message'];
            if ($sep['response'] == null) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep['metaData']['message']
                ];
            } else {
                $noSuratKontrol = $datakeluaran['noSPRI'];
                $tglRencanaKontrol = $datakeluaran['tglRencanaKontrol'];
                $namaDokter = $datakeluaran['namaDokter'];
                $noKartu = $datakeluaran['noKartu'];
                $nama = $datakeluaran['nama'];
                $kelamin = $datakeluaran['kelamin'];
                $tglLahir = $datakeluaran['tglLahir'];
                $simpandata = [

                    'journalnumber' => $journalnumber,
                    'referencenumber' => $referencenumber,
                    'norm' => $noMR,
                    'diagnosa' => $diagnosa,
                    'noSep' => $noSep,
                    'nama' => $nama,
                    'noSuratKontrol' => $noSuratKontrol,
                    'kodeDokter' =>  $datasep['kodeDokter'],
                    'namaDokter' => $namaDokter,
                    'createdby' => $createdby,
                    'nama' => $nama,
                    'noKartu' => $noKartu,
                    'tglLahir' => $tglLahir,
                    'poliKontrol' => $datasep['poliKontrol'],
                ];

                $simpannomorspri = new ModelDataSPRI;
                $noSuratKontrol = $datasep['noSPRI'];
                $simpannomorspri->update_dataSuratKontrol($noSuratKontrol, $simpandata);

                $msg = [
                    'success' => true,
                    'pesan' => $sep['metaData']['message'],
                    'response' => $datakeluaran,
                ];
            }
        }
        echo json_encode($msg);
    }

    private function update_spri($param, $header)
    {

        $data = [
            "request" =>
            [
                "noSPRI" => $param['noSPRI'],
                "kodeDokter" => $param['kodeDokter'],
                "poliKontrol" => $param['poliKontrol'],
                "tglRencanaKontrol" => $param['tglRencanaKontrol'],
                "user" => $param['user']
            ]

        ];

        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('PUT', $this->base_url . $this->service_name . 'RencanaKontrol/UpdateSPRI', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function UpdateSepPulang()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row_sep($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];

            $data = [

                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                'penjaminKLL' => $this->penjaminKL(),
                //'Propinsi' => $this->propinsiBpjs(),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => 'IGD',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'referencenumber' => $rajal['referencenumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'noSep' => $rajal['noSep'],
                'noRujukan' => $rajal['noRujukan'],
                'tglRujukan' => $rajal['tglRujukan'],
                'ppkRujukan' => $rajal['ppkRujukan'],
                'diagnosa' => $rajal['diagnosa'],
                'catatan' => $rajal['catatan'],
                'poliEksekutif' => $rajal['poliEksekutif'],
                'cob' => $rajal['cob'],
                'katarak' => $rajal['katarak'],
                'lakaLantas' => $rajal['lakaLantas'],
                'penjamin' => $rajal['penjamin'],
                'keterangan' => $rajal['keterangan'],
                'tglKejadian' => $rajal['tglKejadian'],
                'suplesi' => $rajal['suplesi'],
                'noSuplesi' => $rajal['noSuplesi'],
                'kdPropinsi' => $rajal['kdPropinsi'],
                'kdKabupaten' => $rajal['kdKabupaten'],
                'kdKecamatan' => $rajal['kdKecamatan'],
                'hakKelas' => $rajal['hakKelas'],
                'kelasRawat' => $rajal['kelasRawat'],
                'noTelp' => $rajal['noTelp'],
                'statusPulangSep' => $this->statusPulangSep(),
                'tglSep' => $rajal['tglSep'],
                'jenislakaLantas' => $rajal['jenislakaLantas'],

            ];

            $msg = [
                'suksesmodalsep' => view('igd/modalupdatepulangSepIgd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function statusPulangSep()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_statusPulangSep();
        return $list;
    }

    public function simpanPulangSEP()
    {
        if ($this->request->isAJAX()) {

            $datasep['noSep'] = $this->request->getVar('noSep');
            $datasep['statusPulang'] = $this->request->getVar('statusPulang');
            $datasep['noSuratMeninggal'] = $this->request->getVar('noSuratMeninggal');
            $datasep['tglMeninggal'] = $this->request->getVar('tglMeninggal');
            $datasep['tglPulang'] = $this->request->getVar('tglPulang');
            $datasep['tglPlg'] = $this->request->getVar('tglPulang');
            $datasep['noLPManual'] = $this->request->getVar('noLPManual');
            $datasep['user'] = $this->request->getVar('user');
            $datasep['ppkPelayanan'] = $this->request->getVar('ppkPelayanan');
            $createdby = $this->request->getVar('createdby');
            $journalnumber = $this->request->getVar('journalnumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $jenislakaLantas = $this->request->getVar('jenislakaLantas');

            $datasep['tglSep'] = $this->request->getVar('tglSep');


            $hari_ini = date('Y-m-d');


            if ($datasep['statusPulang'] == "4") {
                $datasep['tglMeninggal'] = $datasep['tglMeninggal'];
                $datasep['noSuratMeninggal'] = $datasep['noSuratMeninggal'];
            } else {
                $datasep['tglMeninggal'] = '';
                $datasep['noSuratMeninggal'] = '';
            }

            $jumlah_karakter_noSuratMeninggal = strlen($datasep['noSuratMeninggal']);
            $jumlah_karakter_noLPManual = strlen($datasep['noLPManual']);

            if (($datasep['statusPulang'] == "4") and ($datasep['tglMeninggal'] == "") || ($datasep['noSuratMeninggal'] == "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Untuk Status Pulang meninggal Silahkan isi Tanggal Meninggal dan No Surat meninggal'
                ];
            } else if (($datasep['statusPulang'] == "4") and ($jumlah_karakter_noSuratMeninggal < 5)) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'No Surat meninggal Minimal 5 Karakter !!'
                ];
            } else if ($datasep['tglPulang'] > $hari_ini) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tanggal Pulang Tidak Boleh Lebih Besar Dari Hari Ini !!!'
                ];
            } else if ($datasep['tglPulang'] < $datasep['tglSep']) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tanggal Pulang Tidak Boleh Lebih Kecil Dari Tanggal SEP !!!'
                ];
            } else if (($jenislakaLantas <> 0) and ($datasep['noLPManual'] == "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Untuk SEP KLL Wajib Menyertakan No Laporan Polisi !!!'
                ];
            } else if (($jenislakaLantas <> 0) and ($jumlah_karakter_noLPManual < 5)) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Untuk SEP KLL, No Laporan Polisi  Diisi Minimal 5 Karakter !!!'
                ];
            } else {

                $header = $this->header();
                $sep = json_decode($this->update_tglpulang_sep($datasep, $header), true);


                $cons_id = $header['X-cons-id'];
                $secretKey = "2mSA7604B8";
                $tStamp = $header['X-timestamp'];

                $key = $cons_id . $secretKey . $tStamp;
                $keluaran = $this->stringDecrypt($key, $sep['response']);
                $datakeluaran = json_decode($keluaran, true);

                $data['message'] = $sep['metaData']['code'];
                if ($data['message'] != 200) {
                    $msg = [
                        'success' => false,
                        'pesan' => $sep['metaData']['message']
                    ];
                } else {

                    $simpandata = [
                        'statusPulang' => $datasep['statusPulang'],
                        'noSuratMeninggal' =>  $datasep['noSuratMeninggal'],
                        'tglMeninggal' =>  $datasep['tglMeninggal'],
                        'tglPulang' =>  $datasep['tglPlg'],
                        'noLPManual' =>  $datasep['noLPManual'],
                        'userSepPulang' =>  $createdby,

                    ];

                    $simpannomorsep = new ModelDataSep;
                    $nosep = $datasep['noSep'];
                    $simpannomorsep->update_dataSep($nosep, $simpandata);
                    $msg = [
                        'success' => true,
                        'pesan' => $sep['metaData']['message'],
                        'pesanadd' => 'Update SEP Pulang berhasil'
                    ];
                }
            }
        }

        echo json_encode($msg);
    }

    private function update_tglpulang_sep($param, $header)
    {
        $data = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noSep" => $param['noSep'],
                    "statusPulang" => $param['statusPulang'],
                    "noSuratMeninggal" => $param['noSuratMeninggal'],
                    "tglMeninggal" => $param['tglMeninggal'],
                    "tglPulang" => $param['tglPulang'],
                    "noLPManual" => $param['noLPManual'],
                    "user" => $param['user']
                ]
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('PUT', $this->base_url . $this->service_name . 'SEP/2.0/updtglplg', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function DaftarkanPasienLamaBackdate()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'pelayanan' => $this->pelayanan(),
                'sebabsakit' => $this->sebabsakit(),
                'inisial' => $this->inisial(),
                'agama' => $this->agama(),
                'statusnikah' => $this->statusnikah(),
                'pendidikan' => $this->pendidikan(),
                'pekerjaan' => $this->pekerjaan(),
                'metodepembayaran' => $this->metodepembayaran(),
                'HPJB' => $this->hubunganpjb(),
                'pasienlama' => $m_icd->get_data_pasien_lama($id),
                'triase' => $m_icd->get_data_kelompok_triase(),
            ];


            $msg = [
                'suksesbackdate' => view('igd/modalinputdaftarpasienlamabackdate', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandataregisterBackDate()
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

                ],

                'description' => [
                    'label' => 'Jenis Pelayanan',
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
                        'poliklinikname' => $validation->getError('poliklinikname'),
                        'description' => $validation->getError('description')
                    ]
                ];
            } else {
                $tglrujukan1 = $this->request->getVar("referencedate");

                $mulai = str_replace('/', '-', $tglrujukan1);
                $tglrujukan = date('Y-m-d', strtotime($mulai));
                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $lokasi = $this->request->getVar('poliklinik');
                $visited = $this->request->getVar('visited');
                $documentdate = $this->request->getVar("documentdate");
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND groups='$groups'  LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                //$today = date('ymd');
                $today = date('ymd', strtotime($documentdate));
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                $newkode = $visited . $underscore . $groups . $underscore  . $today . $underscore . sprintf('%06s', $nourut);



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



                $kelompok_triase = $this->request->getVar('kelompok_triase');

                if ($kelompok_triase == "KEBIDANAN DAN KANDUNGAN") {
                    $igdkebidanan = "1";
                } else {
                    $igdkebidanan = "0";
                }



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
                    'igdkebidanan' => $igdkebidanan,
                    'code_triase' => $this->request->getVar('code_triase'),
                    'kelompok_triase' => $this->request->getVar('triase'),
                    'backdate' => $this->request->getVar('backdate'),
                ];
                $perawat = new ModelRawatJalanDaftar;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Pendftaran IGD BackDate Berhasil',
                    'JN' => $newkode,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printsepKonvesional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_sjp($lokasikasir);
        $databarcode = $pasien->dataSepBarcode($id);
        $kodedokter = $databarcode['kodeDPJP'];
        $namadoktersep = $pasien->caridokter($kodedokter);
        $namaDokter = $namadoktersep['name'];
        $data = [
            'datapasien' => $pasien->dataSep($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'namaDokter' => $namaDokter,
        ];


        $pasienid_barcode = $databarcode['noSep'];


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

        return view('cetakan/sepigd', $data);
    }

    public function printstickerbarcode()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganrajal($id),
        ];



        $databarcode = $pasien->kunjunganrajal_pasienid($id);
        $pasienid_barcode = $databarcode['pasienid'];


        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(40)
            ->setPadding(6)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))

            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';

        return view('cetakan/stickerigd', $data);
    }

    public function referensiDokterVclaim()
    {
        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest-dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = '1';
        $tglPelayanan = date('Y-m-d');
        $spesialis = "spesialis";

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/dokter/pelayanan/' . $filter . '/' . 'tglPelayanan/'  . $tglPelayanan . '/' . 'Spesialis/' . $spesialis, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "2mSA7604B8";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        return $data['list'];
    }

    public function BatalPeriksa()
    {
        if ($this->request->isAJAX()) {

            $cancel = 1;
            $modifiedby = $this->request->getVar('modifiedby');
            $simpandata = [
                'cancel' => $cancel,
                'modifiedby' => $modifiedby,

            ];
            $perawat = new ModelIGDDaftar;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Pendaftaran sudah dibatalkan, anda masih dapat merestore nya jika terjadi kesalahan seleksi data pembatalan !'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Batal()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('igd/registerigdBatal', $data);
    }

    public function ambildataBatal()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelIGDDaftar();
            $data = [
                'tampildata' => $register->ambildataigdBatal()
            ];
            $msg = [
                'data' => view('igd/dataregisterigdbatal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliBatal()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelIGDDaftar();
            $data = [
                'tampildata' => $register->search_RegisterigdBatal($search)
            ];

            $msg = [
                'data' => view('igd/dataregisterigdbatal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function RestoreBatalPeriksa()
    {
        if ($this->request->isAJAX()) {

            $cancel = 0;
            $modifiedby = $this->request->getVar('modifiedby');
            $simpandata = [
                'cancel' => $cancel,
                'modifiedby' => $modifiedby,

            ];
            $perawat = new ModelIGDDaftar;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Registrasi Sudah Direstore Kembali !'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

}
 

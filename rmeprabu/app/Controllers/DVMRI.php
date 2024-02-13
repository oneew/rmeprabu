<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPasienMaster;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasien;
use App\Models\ModelPasienRanap;
use App\Models\ModelDataSepRanap;
use App\Models\ModelDataSep;
use App\Models\ModelDataSuratKontrol;
use App\Models\ModelDataSuratRujukan;
use App\Models\ModelDataPengajuanSEPRanap;
use App\Models\ModelDaftarRanap;
use App\Models\ModelValidasiPasienMasuk;
use App\Models\ModelValidasiRanap;
use App\Models\Modelranapvalidasi;
use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

use GuzzleHttp\Client;

class DVMRI extends BaseController
{

    private $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
    private $service_name = 'vclaim-rest/';

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('rawatinap/registerranap_validasi', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelValidasiPasienMasuk();
            $data = [
                'tampildata' => $register->ambildataranap_masuk_validasi()
            ];
            $msg = [
                'data' => view('rawatinap/dataregisterranap_validasi', $data)
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

            $register = new ModelValidasiPasienMasuk();
            $data = [
                'tampildata' => $register->search_RegisterRanap_masuk_validasi($search)
            ];

            $msg = [
                'data' => view('rawatinap/dataregisterranap_validasi', $data)
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
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsi(),
            ];
            $msg = [
                'data' => view('rawatjalan/modaldaftarrawatjalan', $data)
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
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsi(),
            ];
            $msg = [
                'data' => view('rawatjalan/modaldaftarrajalpasienlama', $data)
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
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsi(),
            ];


            $msg = [
                'sukses' => view('rawatjalan/modalinputdaftarpasienlama', $data)
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

    public function ajax_propinsi()
    {
        $request = Services::request();
        $kelas = $request->getPost('kelas');
        $m_combo_room = new Modelrajal();
        $list['NAMA_KAB'] = $m_combo_room->get_kabupaten_name($kelas);

        echo json_encode($list['NAMA_KAB']);
    }

    public function ajax_kabupaten()
    {
        $request = Services::request();
        $room = $request->getPost('room');
        // select room 
        $m_combo_room = new Modelrajal();
        $list['NAMA_KEC'] = $m_combo_room->get_kecamatan_list($room);

        echo json_encode($list['NAMA_KEC']);
    }


    public function ambildatapasienlama()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPasienMaster();
            $data = [
                'tampildata' => $register->ambildatapasien()
            ];
            $msg = [
                'data' => view('rawatjalan/masterdatapasien', $data)
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
                'data' => view('rawatjalan/masterdatapasien', $data)
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

                // proses SEP
                //lalu nomor sep dipakai di bpjs_sep



                $tglrujukan1 = $this->request->getVar("referencedate");

                $mulai = str_replace('/', '-', $tglrujukan1);
                $tglrujukan = date('Y-m-d', strtotime($mulai));

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

                ///dipnggil mnethod



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
                    'code_triase' => $this->request->getVar('code_triase'),
                    'kelompok_triase' => $this->request->getVar('kelompok_triase'),
                    'referencenumber' => $this->request->getVar('noRujukan'),

                ];
                $perawat = new ModelRawatJalanDaftar;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Pendftaran Rawat Jalan Berhasil',
                    'JN' => $newkode,
                ];
            }
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
                'namadokterpoli' => [
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
                        'namadokterpoli' => $validation->getError('namadokterpoli'),
                        'namapoliklinik' => $validation->getError('namapoliklinik')
                    ]
                ];
            } else {

                $db = db_connect();
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(code) as norm FROM pasien WHERE  denicode=0 AND code NOT LIKE '%%R%%'  ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $norm = $row->norm;
                }





                $inisial = 'R';

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
                $query2 = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinik='$lokasi' AND groups='$groups'  LIMIT 1");

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

                $newkode = $groups . $underscore . $lokasi . $underscore  . $today . $underscore . sprintf('%06s', $nourut);

                //$tglrujukan = date('Y-m-d', strtotime($this->request->getVar("tanggalrujukan")));
                //$TL = date('Y-m-d', strtotime($this->request->getVar("tanggallahir")));

                $tglrujukan2 = $this->request->getVar("tanggalrujukan");

                $mulai = str_replace('/', '-', $tglrujukan2);
                $tglrujukan = date('Y-m-d', strtotime($mulai));
                //$tanggallahir = $this->request->getVar('tanggallahir');

                $tanggallahir = $this->request->getVar('tanggallahir');
                $lahir = str_replace('/', '-', $tanggallahir);
                $tgllahir = date('Y-m-d', strtotime($lahir));
                $dob = strtotime($tgllahir);

                //$dob = strtotime($tanggallahir);
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

                $metodepembayaran = $this->request->getVar('carabayar');
                $kode_pelayanan = $this->request->getVar('kode_pelayanan');
                $sebab_masuk = $this->request->getVar('sebabmasuk');
                $namadokterpoli = $this->request->getVar('namadokterpoli');

                if (($metodepembayaran != "") and ($kode_pelayanan != "") and ($sebab_masuk != "") and ($namadokterpoli != "")) {



                    $simpandata = [
                        'registerdate' => $this->request->getVar('registerdate_baru'),
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

                    ];
                    $pasien = new ModelPasien;
                    $pasien->insert($simpandata);

                    $lamabaru = "B";
                    $postingdata = [
                        'groups' => $this->request->getVar('groups_baru'),
                        'visited' => $this->request->getVar('visited'),
                        'journalnumber' => $newkode,
                        'bpjs_sep' => $this->request->getVar('bpjs_sep_baru'),
                        'documentdate' => $this->request->getVar('documentdate_baru'),
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
                        'dokter' => $this->request->getVar('kodedokterpoli'),
                        'doktername' => $this->request->getVar('namadokterpoli'),
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
                        'code_triase' => $this->request->getVar('code_triase'),
                        'kelompok_triase' => $this->request->getVar('kelompok_triase'),
                        'referencenumber' => $this->request->getVar('nomorrujukan'),
                    ];

                    $rajal = new ModelRawatJalanDaftar;
                    $rajal->insert($postingdata);
                }

                $msg = [
                    'sukses' => 'Pendftaran Rawat Jalan Berhasil',
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
                'namasubarea' => $row['name'],
                'zipcode' => $row['zipcode']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function ajax_kota()
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
                'propinsi' => $row['NAMA_PROP']
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

    public function naikKelas()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_naikKelas_Bpjs();
        return $list;
    }

    public function pembiayaan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_pembiayaan_Bpjs();
        return $list;
    }

    public function printkarcis()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganranap($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        $html = view('pdf/karcisranap', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A6', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printkarcisdirect()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $journalnumber = $this->request->getVar('page');



        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_karcis($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganrajaldirect($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/karcisrajal', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function enkripsi()
    {
        $encrypter = \Config\Services::encrypter();
        $nama = 'deni';
        $idx = $encrypter->encrypt($nama);
        echo $idx;

        $dekrip = $encrypter->decrypt($idx);
        echo $dekrip;
    }

    public function registerpasienbaru()
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

                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsi(),
            ];
            $msg = [
                'data' => view('rawatjalan/modaldaftarrajalpasienbaru', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
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
                'data' => view('rawatjalan/modaleditmasterpasien', $data)
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
                'cardnumber' => $this->request->getVar('nomorasuransi'),
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

    public function check_nik()
    {
        if ($this->request->isAJAX()) {

            $nik = $this->request->getVar('nik');

            $m_icd = new ModelPasienMaster();
            $row = $m_icd->get_data_pasien_nik($nik);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Cetak()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $perawat = new ModelValidasiRanap();
            $row = $perawat->find($id);
            //$rajal = $m_icd->get_data_ranap_row($id);
            $referencenumber = $row['referencenumber'];
            $SPRI = $m_icd->get_data_rajal_row_cek_spri($referencenumber);
            $data = [
                'pasienlama' => $m_icd->get_data_ranap_validasi($id),
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
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'bednumber' => $row['bednumber'],

                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'memo' => $row['memo'],
                'namapjb' => $row['namapjb'],
                'alamatpjb' => $row['alamatpjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'datetimein' => $row['datetimein'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],

                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bedranap(),
                'namasmf' => $this->smf(),
            ];
            $msg = [
                'sukses' => view('rawatinap/modalprintregisterranap_validasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function bedranap()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_bed_ranap();
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

    public function kelasrawat()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kelas();
        return $list;
    }

    public function HistoriKunjungan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPasienMaster();
            $pasienid = $this->request->getVar('pasienid');
            $data = [
                'kunjungan' => $resume->get_data_ranap_kunjungan($pasienid)
            ];

            $msg = [
                'data' => view('rawatinap/data_histori_kunjungan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printsjp()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_sjp_ranap($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganranap_sjp($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        //$html .= view('pdf/sjprajanap', $data);
        $html = view('pdf/sjprajanap', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A6', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printsep()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');
        $referencenumber = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_sjp($lokasikasir);
        $databarcode = $pasien->dataSepBarcodeRanap($referencenumber);
        $kodedokter = $databarcode['kodeDokter'];
        $namadoktersep = $pasien->caridokter($kodedokter);
        $namaDokter = $namadoktersep['name'];
        $data = [
            'datapasien' => $pasien->dataSepRanap($referencenumber),
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
        $html = view('pdf/sepranap', $data);

        $dompdf->loadhtml($html);
        $customPaper = array(0, 0, 620, 260);
        $dompdf->setPaper($customPaper);
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function UbahRajal()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'pasienlama' => $m_icd->get_data_rajal($id),
                'cabar' => $this->data_payment(),
                'pelayanan' => $this->pelayanan(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter(),

                'sebabsakit' => $this->sebabsakit(),

            ];
            $msg = [
                'sukses' => view('rawatjalan/modalubahrajal', $data)
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

            $simpandata = [

                'pasienarea' => $this->request->getVar('pasienarea'),
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
            ];


            $perawat = new ModelRawatJalanDaftar;
            $id = $this->request->getVar('iddaftar');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Register Berhasil Diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function QrCode()
    {
        $qrCode = new QrCode();
        $qrCode
            ->setText('0192102012')
            ->setSize(300)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
            ->setLabel('Scan Qr Code')
            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);
        echo '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';
    }


    public function QrCode2()
    {
        $barcode = new BarcodeGenerator();
        $barcode->setText("0123456");
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(0);
        $barcode->setThickness(25);
        $barcode->setFontSize(10);
        $code = $barcode->generate();

        echo '<img src="data:image/png;base64,' . $code . '" />';
    }

    public function printsticker()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganranap($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];
        $databarcode = $pasien->kunjunganranap_pasienid($id);
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
        $html = view('pdf/stickerranap', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A8', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printheader()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $id = $this->request->getVar('page');

        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganranap($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $databarcode = $pasien->kunjunganranap_pasienid($id);
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
        $html = view('pdf/headerstatusranap', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printgelang()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT INAP";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganranap($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];
        $databarcode = $pasien->kunjunganranap_pasienid($id);
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
        $html = view('pdf/gelangranap', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A8', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printRMK()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "INSTALASI RAWAT INAP";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kop_RMK($lokasikasir);
        $row3 = $pasien->get_data_pasien_RMK($id);
        $pasienid = $row3['pasienid'];
        $masterpasien = $pasien->get_data_pasien_master($pasienid);

        $data = [
            'dataopname' => $pasien->get_data_RMK($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'agama' => $masterpasien['religion'],
            'tgllahir' => $masterpasien['dateofbirth'],
            'pekerjaan' => $masterpasien['work'],
            'nik' => $masterpasien['ssn'],
            'pendidikan' => $masterpasien['education'],
            'status' => $masterpasien['maritalstatus']

        ];


        $pasienid_barcode = $row3['pasienid'];
        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(65)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))

            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_rmk_ranap', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printPersetujuanKelas()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "INSTALASI RAWAT INAP";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kop_Persetujuan($lokasikasir);
        $row3 = $pasien->get_data_pasien_RMK($id);
        $pasienid = $row3['pasienid'];
        $masterpasien = $pasien->get_data_pasien_master($pasienid);

        $data = [
            'dataopname' => $pasien->get_data_RMK($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'agama' => $masterpasien['religion'],
            'tgllahir' => $masterpasien['dateofbirth'],
            'pekerjaan' => $masterpasien['work'],
            'nik' => $masterpasien['ssn'],
            'pendidikan' => $masterpasien['education'],
            'status' => $masterpasien['maritalstatus']

        ];


        $pasienid_barcode = $row3['pasienid'];
        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(65)
            ->setPadding(10)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))

            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_persetujuan_kelas_ranap', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function CreateSep()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];
            $referencenumber = $rajal['referencenumber'];

            $SPRI = $m_icd->get_data_rajal_row_cek_spri($referencenumber);



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
                'kode_poli' => 'IRI',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'referencenumber' => $rajal['referencenumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'naikKelas' => $this->naikKelas(),
                'pembiayaan' => $this->pembiayaan(),
                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'jeniskll' => $this->jeniskllsep(),
                'noSPRI' => $SPRI['noSPRI'],
                'tglMasukRanap' => $rajal['datein'],
                'bpjs_sep_poli' => $rajal['bpjs_sep_poli'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalcreatesepranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function propinsiBpjs2()
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

    public function dokterBpjs2()
    {

        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $jnsPelayanan = 1;
        $tglPelayanan = date('Y-m-d');
        $spesialis = 'Spesialis';
        $data = $request->dokterDpjp($jnsPelayanan, $tglPelayanan, $spesialis);
        return $data['response']['list'];
        //echo json_encode($data['response']['list']);
    }

    public function poliBpjs()
    {

        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $keyword = 'dalam';
        $data = $request->poli($keyword);
        //return $data['response']['poli'];
        echo json_encode($data['response']['poli']);
    }

    public function simpanSEP()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');
            $pilihan_eksekutif = $this->request->getVar('eksekutif');
            $pilihan_cob = $this->request->getVar('cob');
            $pilihan_katarak = $this->request->getVar('katarak');
            $pilihan_lakalantas = $this->request->getVar('lakalantas');
            $pilihan_suplesi = $this->request->getVar('suplesi');
            $dpjp = $this->request->getVar('kodeDPJP');
            $dpjpLayan = '';



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


            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['ppkPelayanan'] = $this->request->getVar('ppkPelayanan');
            $datasep['jnsPelayanan'] = $this->request->getVar('jnsPelayanan');

            $datasep['tujuanKunj'] = $this->request->getVar('tujuanKunj');
            $datasep['flagProcedure'] = $this->request->getVar('flagProcedure');
            $datasep['kdPenunjang'] = $this->request->getVar('kdPenunjang');
            $datasep['assesmentPel'] = '';
            $datasep['dpjpLayan'] = $dpjpLayan;

            //

            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['asalRujukan'] = $this->request->getVar('asalRujukan');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['ppkRujukan'] = $this->request->getVar('ppkRujukan');
            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagAwal'] = $this->request->getVar('diagAwal');
            $datasep['tujuan'] = $this->request->getVar('tujuan');

            $datasep['noSurat'] = $this->request->getVar('noSurat');
            $datasep['kodeDPJP'] = $dpjp;
            $datasep['noTelp'] = $this->request->getVar('noTelp');
            $datasep['user'] = $this->request->getVar('user');
            $createdby = $this->request->getVar('createdby');
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
                $datasep['kdPropinsi'] = $this->request->getVar('kdPropinsi');
                $datasep['kdKabupaten'] = $this->request->getVar('kdKabupaten');
                $datasep['kdKecamatan'] = $this->request->getVar('kdKecamatan');
            }


            $journalnumber = $this->request->getVar('journalnumberrajal');
            $referencenumber = $this->request->getVar('referencenumber');
            $apakahnaik = $this->request->getVar('apakahnaik2');

            if ($apakahnaik == 0) {
                $datasep['klsRawat'] = $this->request->getVar('klsRawat');
                $datasep['klsRawatHak'] = $this->request->getVar('klsRawat');
                $datasep['klsRawatNaik'] = '';
                $datasep['pembiayaan'] = '';
                $datasep['penanggungJawab'] = '';
            } else {
                $datasep['klsRawat'] = $this->request->getVar('klsRawat');
                $datasep['klsRawatHak'] = $this->request->getVar('klsRawat');
                $datasep['klsRawatNaik'] = $this->request->getVar('klsRawatNaik');
                $datasep['pembiayaan'] = $this->request->getVar('pembiayaan');
                $datasep['penanggungJawab'] = $this->request->getVar('penanggungJawab');
            }






            $hak = ($datasep['klsRawatHak']);
            $naik = ($datasep['klsRawatNaik']);

            if ($apakahnaik == 1) {
                if (($hak == 3) and ($naik == 3)) {
                    $kesimpulannaik = 0;
                } else {
                    if (($hak == 3) and ($naik == 2)) {
                        $kesimpulannaik = 0;
                    } else {
                        if (($hak == 3) and ($naik == 1)) {
                            $kesimpulannaik = 0;
                        } else {
                            if (($hak == 2) and ($naik == 2)) {
                                $kesimpulannaik = 0;
                            } else {
                                if (($hak == 2) and ($naik == 1)) {
                                    $kesimpulannaik = 0;
                                } else {
                                    if (($hak == 1) and ($naik == 1)) {
                                        $kesimpulannaik = 0;
                                    } else {
                                        $kesimpulannaik = 1;
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $kesimpulannaik = 9;
            }


            $datasep['tglMasukRanap'] = $this->request->getVar('tglMasukRanap');

            $tglmasukranap = $datasep['tglMasukRanap'];
            $hari_ini = date('Y-m-d');

            $tgl1 = strtotime($tglmasukranap);
            $tgl2 = strtotime($hari_ini);

            $jarak = $tgl2 - $tgl1;

            $hari = $jarak / 60 / 60 / 24;

            if (($apakahnaik == 1) and (($datasep['klsRawatNaik'] == "") || ($datasep['pembiayaan'] == "") || ($datasep['penanggungJawab'] == ""))) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Naik Kelas Ke Kelas Berapa, Atau Isi Keterangan Pembiayaan, Atau Isi Penjamin Pembiayaan'
                ];
            } else if (($apakahnaik == 1) and (($datasep['klsRawatNaik'] <> "") || ($datasep['pembiayaan'] <> "") || ($datasep['penanggungJawab'] == "") and ($kesimpulannaik == 0))) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Naik kelas Tidak Diperkenankan Naik (2 Tingkat Atau Lebih)'
                ];
            } else if ($datasep['kodeDPJP'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'DPJP Tidak Boleh Kosong !!!'
                ];
            } else if ($hari > 3) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Pembuatan SEP Melebihi 3x24 Jam!!!'
                ];
            } else {

                $header = $this->header();
                $sep = json_decode($this->insert_sep($datasep, $header), true);
                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
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
                    $pelayanan = 'IRI';
                    $kelasRawat = $datakeluaran['sep']['kelasRawat'];
                    $simpandata = [
                        'pelayanan' => $pelayanan,
                        'journalnumber' => $journalnumber,
                        'referencenumber' => $referencenumber,
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
                        'klsRawatNaik' => $datasep['klsRawatNaik'],
                        'pembiayaan' => $datasep['pembiayaan'],
                        'penanggungJawab' => $datasep['penanggungJawab'],
                        'tujuanKunj' => $datasep['tujuanKunj'],
                        'flagProcedure' => $datasep['flagProcedure'],
                        'kdPenunjang' => $datasep['kdPenunjang'],
                        'dpjpLayan' => $datasep['dpjpLayan'],
                        'naikKelas' => $apakahnaik,
                        'jenislakaLantas' => $datasep['ketLakalantas'],
                        'kodeDokter' => $datasep['kodeDPJP'],
                        'kodeHakKelas' => $datasep['klsRawatHak'],


                    ];
                    $id = $idrajal;
                    $simpannomorsep = new ModelDataSepRanap;
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

    public function simpanSEPV1()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');
            $pilihan_eksekutif = $this->request->getVar('eksekutif');
            $pilihan_cob = $this->request->getVar('cob');
            $pilihan_katarak = $this->request->getVar('katarak');
            $pilihan_lakalantas = $this->request->getVar('lakalantas');
            $pilihan_suplesi = $this->request->getVar('suplesi');

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
            $referencenumber = $this->request->getVar('referencenumber');

            //tambahan pada versi2
            $datasep['klsRawatHak'] = $this->request->getVar('klsRawat');
            $datasep['klsRawatNaik'] = $this->request->getVar('klsRawatNaik');
            $datasep['pembiayaan'] = $this->request->getVar('pembiayaan');
            $datasep['penanggungJawab'] = $this->request->getVar('penanggungJawab');
            $datasep['tujuanKunj'] = $this->request->getVar('tujuanKunj');
            $datasep['flagProcedure'] = $this->request->getVar('flagProcedure');
            $datasep['kdPenunjang'] = $this->request->getVar('kdPenunjang');
            $datasep['assesmentPel'] = '';
            $datasep['dpjpLayan'] = '';

            //


            //

            $sep = json_decode($this->insert_sepV1($datasep));
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
                $tglSep = $sep->response->sep->tglSep;
                $pelayanan = 'IRI';
                $kelasRawat = $sep->response->sep->kelasRawat;

                $simpandata = [

                    'pelayanan' => $pelayanan,
                    'journalnumber' => $journalnumber,
                    'referencenumber' => $referencenumber,
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

                ];
                //$id = $idrajal;
                $simpannomorsep = new ModelDataSepRanap;
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

    function vclaim_conf()
    {
        $vclaim_conf = [
            'cons_id' => '1168',
            'secret_key' => '4iK5B08401',
            'base_url' => 'https://new-api.bpjs-kesehatan.go.id:8080',
            'service_name' => 'new-vclaim-rest'

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
                        "tujuan" => '',
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


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $this->base_url . $this->service_name . 'SEP/2.0/insert', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
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

    public function statusPulangSep()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_statusPulangSep();
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

    public function UpdateSepPulang()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row_sep($id);
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

            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalupdatepulangSep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
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
            } else {

                $header = $this->header();

                $sep = json_decode($this->update_tglpulang_sep($datasep, $header), true);


                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
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

                    $simpannomorsep = new ModelDataSepRanap;
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

    public function historipelayananSep()
    {
        if ($this->request->isAJAX()) {

            $noKartu = $this->request->getVar('noKartu');
            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'noKartu' => $noKartu,
            ];
            $msg = [
                'data' => view('rawatinap/modalhistoripelayananSep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function InsertRencanaKontrol()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row_sep($id);
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
                'statuspasienpulang' => $rajal['statuspasienpulang'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalinsertrencanakontrol', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanRencanaKontrol()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');

            $datasep['noSEP'] = $this->request->getVar('noSEP');
            $datasep['kodeDokter'] = $this->request->getVar('kodeDokter');
            $datasep['poliKontrol'] = $this->request->getVar('poliKontrol');
            $datasep['tglRencanaKontrol'] = $this->request->getVar('tglRencanaKontrol');
            $datasep['user'] = $this->request->getVar('user');
            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['tglSep'] = $this->request->getVar('tglSep');


            $journalnumber = $this->request->getVar('journalnumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $norm = $this->request->getVar('noMR');
            $diagnosa = $this->request->getVar('diagAwal');
            $klsRawat = $this->request->getVar('klsRawat');
            $hakKelas = $this->request->getVar('hakKelas');
            $jnsPeserta = $this->request->getVar('jnsPeserta');
            $nama = $this->request->getVar('nama');
            $createdby = $this->request->getVar('createdby');

            if ($datasep['noSEP'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'No SEP Tidak Boleh Kosong !!!'
                ];
            } else  if ($datasep['tglRencanaKontrol'] <= $datasep['tglSep']) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tgl Rencana Kontrol Tidak Boleh Sama Atau lebih Dahulu Dari Tanggal Penerbitan SEP !!!'
                ];
            } else {
                $header = $this->header();
                $sep = json_decode($this->insert_rencana_kontrol($datasep, $header), true);


                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
                $tStamp = $header['X-timestamp'];

                $key = $cons_id . $secretKey . $tStamp;
                //$string = json_decode($response, true);
                $keluaran = $this->stringDecrypt($key, $sep['response']);
                $datakeluaran = json_decode($keluaran, true);
                //var_dump($datakeluaran);
                //

                if ($sep['response'] == null) {
                    $msg = [
                        'success' => false,
                        'pesan' => $sep['metaData']['message']
                    ];
                } else {
                    $noSuratKontrol = $datakeluaran['noSuratKontrol'];
                    $tglRencanaKontrol = $datakeluaran['tglRencanaKontrol'];
                    $namaDokter = $datakeluaran['namaDokter'];
                    $noKartu = $datakeluaran['noKartu'];
                    $nama = $datakeluaran['nama'];
                    $kelamin = $datakeluaran['kelamin'];
                    $tglLahir = $datakeluaran['tglLahir'];

                    $simpandata = [

                        'journalnumber' => $journalnumber,
                        'referencenumber' => $referencenumber,
                        'norm' => $datasep['noMR'],
                        'diagnosa' => $diagnosa,
                        'kelasRawat' => $klsRawat,
                        'noSep' => $datasep['noSEP'],
                        'hakKelas' => $hakKelas,
                        'jnsPeserta' => $jnsPeserta,
                        'kelamin' => $kelamin,
                        'nama' => $nama,
                        'noKartu' => $noKartu,
                        'tglLahir' => $tglLahir,
                        'poliKontrol' => $datasep['poliKontrol'],
                        'tglRencanaKontrol' => $datasep['tglRencanaKontrol'],
                        'noSuratKontrol' => $noSuratKontrol,
                        'kodeDokter' => $datasep['kodeDokter'],
                        'namaDokter' => $namaDokter,
                        'createdby' => $createdby,
                    ];

                    $simpannomorkontrol = new ModelDataSuratKontrol;
                    $simpannomorkontrol->insert($simpandata);
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

    private function insert_rencana_kontrol($param, $header)
    {

        $data = [
            "request" =>
            [
                "noSEP" => $param['noSEP'],
                "kodeDokter" => $param['kodeDokter'],
                "poliKontrol" => $param['poliKontrol'],
                "tglRencanaKontrol" => $param['tglRencanaKontrol'],
                "user" => $param['user']
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $this->base_url . $this->service_name . 'RencanaKontrol/insert', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
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
        $data = "1168";
        //secret key
        $secretKey = "4iK5B08401";
        $user_key = "783a9f584e4ec299389c10185b90235b";
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

    public function UpdateRencanaKontrol()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row_dataSuratKontrolBpjs($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];

            $poliKontrol = $rajal['poliKontrol'];
            $carikode = new ModelPasienMaster;
            $kodepolibpjs = $carikode->get_data_poliV2($poliKontrol);

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

                'diagnosa' => $rajal['diagnosa'],

                'hakKelas' => $rajal['hakKelas'],
                'kelasRawat' => $rajal['kelasRawat'],

                'statusPulangSep' => $this->statusPulangSep(),
                'statuspasienpulang' => $rajal['statuspasienpulang'],
                'noSuratKontrol' => $rajal['noSuratKontrol'],
                'kodeDokter' => $rajal['kodeDokter'],
                'namaDokter' => $rajal['namaDokter'],
                'poliKontrol' => $rajal['poliKontrol'],
                'namapoliKontrol' => $kodepolibpjs['name'],
                'tglRencanaKontrol' => $rajal['tglRencanaKontrol'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalupdaterencanakontrol', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function simpanUpdateRencanaKontrol()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');

            $datasep['noSEP'] = $this->request->getVar('noSEP');
            $datasep['noSuratKontrol'] = $this->request->getVar('noSuratKontrol');
            $datasep['kodeDokter'] = $this->request->getVar('kodeDokter');
            $datasep['poliKontrol'] = $this->request->getVar('poliKontrol');
            $datasep['tglRencanaKontrol'] = $this->request->getVar('tglRencanaKontrol');
            $datasep['user'] = $this->request->getVar('user');
            $datasep['noMR'] = $this->request->getVar('noMR');

            $journalnumber = $this->request->getVar('journalnumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $norm = $this->request->getVar('noMR');
            $diagnosa = $this->request->getVar('diagAwal');
            $klsRawat = $this->request->getVar('klsRawat');
            $hakKelas = $this->request->getVar('hakKelas');
            $jnsPeserta = $this->request->getVar('jnsPeserta');
            $nama = $this->request->getVar('nama');
            $createdby = $this->request->getVar('createdby');

            // penambahan
            $header = $this->header();
            $sep = json_decode($this->update_rencana_kontrol($datasep, $header), true);

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            //$string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $sep['response']);
            $datakeluaran = json_decode($keluaran, true);
            //var_dump($datakeluaran);
            //

            if ($sep['response'] == null) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep['metaData']['message']
                ];
            } else {



                $noSuratKontrol = $datakeluaran['noSuratKontrol'];
                $tglRencanaKontrol = $datakeluaran['tglRencanaKontrol'];
                $namaDokter = $datakeluaran['namaDokter'];
                $noKartu = $datakeluaran['noKartu'];
                $nama = $datakeluaran['nama'];
                $kelamin = $datakeluaran['kelamin'];
                $tglLahir = $datakeluaran['tglLahir'];

                $simpandata = [

                    'journalnumber' => $journalnumber,
                    'referencenumber' => $referencenumber,
                    'norm' => $datasep['noMR'],
                    'diagnosa' => $diagnosa,
                    'kelasRawat' => $klsRawat,
                    'noSep' => $datasep['noSEP'],
                    'hakKelas' => $hakKelas,
                    'jnsPeserta' => $jnsPeserta,
                    'kelamin' => $kelamin,
                    'nama' => $nama,
                    'noKartu' => $noKartu,
                    'tglLahir' => $tglLahir,
                    'poliKontrol' => $datasep['poliKontrol'],
                    'tglRencanaKontrol' => $datasep['tglRencanaKontrol'],
                    'noSuratKontrol' => $noSuratKontrol,
                    'kodeDokter' => $datasep['kodeDokter'],
                    'namaDokter' => $namaDokter,
                    'createdby' => $createdby,
                ];

                $simpannomorkontrol = new ModelDataSuratKontrol;
                $simpannomorkontrol->update_dataSuratKontrol($noSuratKontrol, $simpandata);
                $msg = [
                    'success' => true,
                    'response' => $datakeluaran,
                    'pesan' => $sep['metaData']['message']
                ];
            }
        }
        echo json_encode($msg);
    }

    private function update_rencana_kontrol($param, $header)
    {

        $data = [
            "request" =>
            [
                "noSuratKontrol" => $param['noSuratKontrol'],
                "noSEP" => $param['noSEP'],
                "kodeDokter" => $param['kodeDokter'],
                "poliKontrol" => $param['poliKontrol'],
                "tglRencanaKontrol" => $param['tglRencanaKontrol'],
                "user" => $param['user']
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('PUT', $this->base_url . $this->service_name . 'RencanaKontrol/Update', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function CariSuratKontrol()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $noSuratKontrol = $param['noSuratKontrol'];
        //$noPeserta = '0000000953559';

        $response = $client->request('GET', $base_url . $service_name . 'RencanaKontrol/noSuratKontrol/' . $noSuratKontrol, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
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

    public function HapusSuratKontrol()
    {
        if ($this->request->isAJAX()) {

            $noSuratKontrol = $this->request->getVar('noSuratKontrol');
            $datasep['noSuratKontrol'] = $this->request->getVar('noSuratKontrol');
            //$datasep['noSuratKontrol'] = '1020R0010122K000003';

            $datasep['user'] = 'Coba Ws';
            $sep = json_decode($this->delete_surat_kontrol($datasep), true);

            if ($sep['metaData']['code'] != 200) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep['metaData']['message']
                ];
            } else {
                $hapussep = new ModelPasienMaster;
                $carisep = $hapussep->get_data_dataSuratKontrol($noSuratKontrol);
                $id = $carisep['id'];
                $sepdihapus = new ModelDataSuratKontrol;
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

    public function CariSepV1()
    {

        $vclaim_conf = $this->vclaim_conf();
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $keyword = $this->request->getVar('nomorSep');
        $data = $peserta->cariSEP($keyword);

        echo json_encode($data);
    }

    public function CariSep()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $keyword = $this->request->getVar('nomorSep');

        $response = $client->request('GET', $base_url . $service_name . 'SEP/' . $keyword, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
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

    public function HapusSepV1()
    {
        if ($this->request->isAJAX()) {

            //$id = $this->request->getVar('id');
            $noSep = $this->request->getVar('nomorSep');
            $datasep['noSep'] = $this->request->getVar('nomorSep');
            $datasep['user'] = 'Coba Ws';
            $sep = json_decode($this->delete_sep($datasep));

            $hapussep = new ModelPasienMaster;
            if ($noSep != "") {
                $carisep = $hapussep->get_data_dataSepRanap($noSep);
                $id = $carisep['id'];
                $sepdihapus = new ModelDataSepRanap;
                $sepdihapus->delete($id);
            }
            $msg = [
                'success' => true,
                'pesan' => $sep->metaData->message
            ];

            echo json_encode($msg);
        }
    }

    public function HapusSep()
    {
        if ($this->request->isAJAX()) {

            //$id = $this->request->getVar('id');
            $noSep = $this->request->getVar('nomorSep');
            $datasep['noSep'] = $this->request->getVar('nomorSep');
            $datasep['user'] = 'Coba Ws';
            $header = $this->header();
            $sep = json_decode($this->delete_sepV2($datasep, $header), true);

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            //$string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $sep['response']);
            $datakeluaran = json_decode($keluaran, true);

            $hapussep = new ModelPasienMaster;
            if ($noSep != "") {
                $carisep = $hapussep->get_data_dataSepRanap($noSep);
                $id = $carisep['id'];
                $sepdihapus = new ModelDataSepRanap;
                $sepdihapus->delete($id);
            }
            $msg = [
                'success' => true,
                'pesan' => $sep['metaData']['message'],
                'response' => $datakeluaran,
                'pesantambahan' => 'Hapus Sep Berhasil',

            ];

            echo json_encode($msg);
        }
    }

    private function delete_sepv2($param, $header)
    {

        $data = [
            "request" =>
            [
                "t_sep" => [
                    "noSep" => $param['noSep'],
                    "user" => $param['user']
                ]
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('DELETE', $this->base_url . $this->service_name . 'SEP/2.0/delete', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function UpdateSepRanap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row_sep($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $referencenumber = $rajal['referencenumber'];
            $SPRI = $m_icd->get_data_rajal_row_cek_spri($referencenumber);
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
                'kode_poli' => 'IRI',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'referencenumber' => $rajal['referencenumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'noSep' => $rajal['noSep'],
                'tglSep' => $rajal['tglSep'],
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
                'apakahnaikkelas' => $rajal['naikKelas'],
                'klsRawatNaik' => $rajal['klsRawatNaik'],
                'kodeHakKelas' => $rajal['kodeHakKelas'],
                'pembiayaanPasien' => $rajal['pembiayaan'],
                'penanggungJawab' => $rajal['penanggungJawab'],
                'tujuanKunj' => $rajal['tujuanKunj'],
                'flagProcedure' => $rajal['flagProcedure'],
                'kdPenunjang' => $rajal['kdPenunjang'],
                'jenislakaLantas' => $rajal['jenislakaLantas'],
                'kodeDokter' => $rajal['kodeDokter'],
                'naikKelas' => $this->naikKelas(),
                'pembiayaan' => $this->pembiayaan(),
                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'jeniskll' => $this->jeniskllsep(),
                'noSPRI' => $SPRI['noSPRI'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalupdatesepranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanUpdateSEP()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');
            $pilihan_eksekutif = $this->request->getVar('eksekutif');
            $pilihan_cob = $this->request->getVar('cob');
            $pilihan_katarak = $this->request->getVar('katarak');
            $pilihan_lakalantas = $this->request->getVar('lakalantas');
            $pilihan_suplesi = $this->request->getVar('suplesi');
            $dpjp = $this->request->getVar('kodeDPJP');
            $dpjpLayan = '';



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

            $datasep['tujuanKunj'] = $this->request->getVar('tujuanKunj');
            $datasep['flagProcedure'] = $this->request->getVar('flagProcedure');
            $datasep['kdPenunjang'] = $this->request->getVar('kdPenunjang');
            $datasep['assesmentPel'] = '';
            $datasep['dpjpLayan'] = $dpjpLayan;

            //

            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['asalRujukan'] = $this->request->getVar('asalRujukan');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['ppkRujukan'] = $this->request->getVar('ppkRujukan');
            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagAwal'] = $this->request->getVar('diagAwal');
            $datasep['namadiagAwal'] = $this->request->getVar('namadiagAwal');
            $datasep['tujuan'] = $this->request->getVar('tujuan');

            $datasep['noSurat'] = $this->request->getVar('noSurat');
            $datasep['kodeDPJP'] = $dpjp;
            $datasep['noTelp'] = $this->request->getVar('noTelp');
            $datasep['user'] = $this->request->getVar('user');
            $createdby = $this->request->getVar('createdby');
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
                $datasep['kdPropinsi'] = $this->request->getVar('kdPropinsi');
                $datasep['kdKabupaten'] = $this->request->getVar('kdKabupaten');
                $datasep['kdKecamatan'] = $this->request->getVar('kdKecamatan');
            }



            $journalnumber = $this->request->getVar('journalnumberrajal');
            $referencenumber = $this->request->getVar('referencenumber');
            $apakahnaik = $this->request->getVar('apakahnaik2');

            if ($apakahnaik == 0) {
                $datasep['klsRawatNaik'] = '';
                $datasep['pembiayaan'] = '';
                $datasep['penanggungJawab'] = '';
            } else {
                $datasep['klsRawatNaik'] = $this->request->getVar('klsRawatNaik');
                $datasep['pembiayaan'] = $this->request->getVar('pembiayaan');
                $datasep['penanggungJawab'] = $this->request->getVar('penanggungJawab');
            }

            $hak = ($datasep['klsRawatHak']);
            $naik = ($datasep['klsRawatNaik']);

            if ($apakahnaik == 1) {
                if (($hak == 3) and ($naik == 3)) {
                    $kesimpulannaik = 0;
                } else {
                    if (($hak == 3) and ($naik == 2)) {
                        $kesimpulannaik = 0;
                    } else {
                        if (($hak == 3) and ($naik == 1)) {
                            $kesimpulannaik = 0;
                        } else {
                            if (($hak == 2) and ($naik == 2)) {
                                $kesimpulannaik = 0;
                            } else {
                                if (($hak == 2) and ($naik == 1)) {
                                    $kesimpulannaik = 0;
                                } else {
                                    if (($hak == 1) and ($naik == 1)) {
                                        $kesimpulannaik = 0;
                                    } else {
                                        $kesimpulannaik = 1;
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $kesimpulannaik = 9;
            }

            $noSepPasien = $datasep['noSep'];

            $carisuratkontrol = new ModelPasienMaster;
            $cariSuratkontrolmaster = $carisuratkontrol->get_data_data_surat_kontrol_master($noSepPasien);
            $ceknoSuratkontrol = isset($cariSuratkontrolmaster['noSep']) != null ? $cariSuratkontrolmaster['noSep'] : "-";




            if (($apakahnaik == 1) and (($datasep['klsRawatNaik'] == "") || ($datasep['pembiayaan'] == "") || ($datasep['penanggungJawab'] == ""))) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Naik Kelas Ke Kelas Berapa, Atau Isi Keterangan Pembiayaan, Atau Isi Penjamin Pembiayaan'
                ];
            } else if (($apakahnaik == 1) and (($datasep['klsRawatNaik'] <> "") || ($datasep['pembiayaan'] <> "") || ($datasep['penanggungJawab'] == "") and ($kesimpulannaik == 0))) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Naik kelas Tidak Diperkenankan Naik (2 Tingkat Atau Lebih)'
                ];
            } else if ($datasep['klsRawatHak'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Hak Kelas Rawat Tidak Boleh Kosong !!!'
                ];
            } else if ($datasep['noMR'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Norm Tidak Boleh Kosong !!!'
                ];
            } else if ($datasep['diagAwal'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'DiagnosaTidak Boleh Kosong !!!'
                ];
            } else if ($datasep['noTelp'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'No Telepon Tidak Boleh Kosong !!!'
                ];
            } else if ($createdby == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Nama User Tidak Boleh Kosong !!!'
                ];
            } else if ($ceknoSuratkontrol == $noSepPasien) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'SEP Tidak Dapat Diubah Karena Pasien Sudah Dibuatkan Surat Kontrol !!!'
                ];
            } else {

                $header = $this->header();
                $sep = json_decode($this->update_sep($datasep, $header), true);

                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
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




                    $pelayanan = 'IRI';


                    $simpandata = [
                        'pelayanan' => $pelayanan,
                        'journalnumber' => $journalnumber,
                        'referencenumber' => $referencenumber,
                        'norm' => $datasep['noMR'],
                        'catatan' => $datasep['catatan'],
                        'diagnosa' => $datasep['namadiagAwal'],
                        'jnsPelayanan' => $datasep['ppkPelayanan'],
                        'kelasRawat' => $datasep['klsRawat'],
                        'penjamin' => $datasep['penjamin'],

                        'hakKelas' => $datasep['klsRawatHak'],

                        //'tglSep' => $tglSep,
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
                        'updatedby' => $createdby,
                        'noTelp' => $datasep['noTelp'],
                        'klsRawatNaik' => $datasep['klsRawatNaik'],
                        'pembiayaan' => $datasep['pembiayaan'],
                        'penanggungJawab' => $datasep['penanggungJawab'],
                        'tujuanKunj' => $datasep['tujuanKunj'],
                        'flagProcedure' => $datasep['flagProcedure'],
                        'kdPenunjang' => $datasep['kdPenunjang'],
                        'dpjpLayan' => $datasep['dpjpLayan'],
                        'naikKelas' => $apakahnaik,
                        'jenislakaLantas' => $datasep['ketLakalantas'],
                        'kodeDokter' => $datasep['kodeDPJP'],
                        'kodeHakKelas' => $datasep['klsRawatHak'],

                    ];
                    $id = $idrajal;
                    $simpannomorsep = new ModelDataSepRanap;
                    $nosep = $datasep['noSep'];
                    $simpannomorsep->update_dataSep($nosep, $simpandata);
                    $msg = [
                        'success' => true,
                        'response' => $sep['response'],
                        'pesanberhasil' => 'Update SEP Berhasil'
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
                        "klsRawatHak" => $param['klsRawatHak'],
                        "klsRawatNaik" => $param['klsRawatNaik'],
                        "pembiayaan" => $param['pembiayaan'],
                        "penanggungJawab" => $param['penanggungJawab']

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


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('PUT', $this->base_url . $this->service_name . 'SEP/2.0/update', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function printSuratKontrol()
    {
        $dompdf = new Dompdf();

        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $databarcode = $pasien->dataSuratKontrolBpjs($id);

        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $keyword = $this->request->getVar('page');

        $noSuratKontrol = $this->request->getVar('page');
        //$noPeserta = '0000000953559';

        $response = $client->request('GET', $base_url . $service_name . 'RencanaKontrol/noSuratKontrol/' . $noSuratKontrol, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        $cek = $string['metaData']['code'];
        $pesan = $string['metaData']['message'];

        // var_dump(json_encode($datakeluaran), true);
        // die();

        if ($cek == 201) {
            echo ". $pesan .";
        } else {
            $data = [
                'datapasien' => $pasien->dataSuratKontrol_all($id),
                'noSuratKontrol' => $datakeluaran['noSuratKontrol'],
                'tglRencanaKontrol' => $datakeluaran['tglRencanaKontrol'],
                'namaDokter' => $datakeluaran['namaDokter'],
                'noKartu' => $databarcode['noKartu'],
                'nama' => $databarcode['nama'],
                'tglLahir' => $datakeluaran['sep']['peserta']['tglLahir'],
                'diagnosa' => $datakeluaran['sep']['diagnosa'],
                'tglTerbit' => $datakeluaran['tglTerbit'],
                'jenkel' => $datakeluaran['sep']['peserta']['kelamin'],
                'poliTujuan' => $datakeluaran['namaPoliTujuan'],
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
            $html = view('pdf/printSuratKontrol', $data);

            $dompdf->loadhtml($html);
            $dompdf->setPaper('A6', 'landscape');
            $dompdf->render();
            $namafile = $id;
            $dompdf->stream($namafile, ['Attachment' => 0]);
        }
    }

    public function InsertRencanaRujukan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row_sep($id);
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
                'statuspasienpulang' => $rajal['statuspasienpulang'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalinsertrujukan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanRencanaRujukan()
    {
        if ($this->request->isAJAX()) {


            $datasep['noSEP'] = $this->request->getVar('noSEP');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['tglRencanaKunjungan'] = $this->request->getVar('tglRencanaKunjungan');
            $datasep['ppkDirujuk'] = $this->request->getVar('ppkDirujuk');
            $datasep['jnsPelayanan'] = $this->request->getVar('jnsPelayanan');
            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagRujukan'] = $this->request->getVar('diagAwal');
            $datasep['tipeRujukan'] = $this->request->getVar('tipeRujukan');
            $datasep['poliRujukan'] = $this->request->getVar('poliRujukan');

            $datasep['kodeDokter'] = $this->request->getVar('kodeDokter');
            $datasep['user'] = $this->request->getVar('user');
            $datasep['noMR'] = $this->request->getVar('noMR');

            $journalnumber = $this->request->getVar('journalnumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $norm = $this->request->getVar('noMR');
            $diagnosa = $this->request->getVar('diagAwal');
            $klsRawat = $this->request->getVar('klsRawat');
            $hakKelas = $this->request->getVar('hakKelas');
            $jnsPeserta = $this->request->getVar('jnsPeserta');
            $nama = $this->request->getVar('nama');
            $createdby = $this->request->getVar('createdby');

            if (($datasep['tglRujukan'] < $datasep['tglSep']) and ($datasep['tglRujukan'] <> "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tanggal Rujukan Tidak Boleh Lebih Kecil Dari Tanggal SEP'
                ];
            } else if ($datasep['tglRujukan'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tanggal Rujukan Tidak Boleh Kosong'
                ];
            } else {

                // penambahan
                $header = $this->header();
                $sep = json_decode($this->insert_rencana_rujukan($datasep, $header), true);


                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
                $tStamp = $header['X-timestamp'];

                $key = $cons_id . $secretKey . $tStamp;
                //$string = json_decode($response, true);
                $keluaran = $this->stringDecrypt($key, $sep['response']);
                $datakeluaran = json_decode($keluaran, true);



                if ($sep['response'] == null) {
                    $msg = [
                        'success' => false,
                        'pesan' => $sep['metaData']['message']
                    ];
                } else {
                    $noRujukan = $datakeluaran['rujukan']['noRujukan'];
                    $tglRujukan = $datakeluaran['rujukan']['tglRujukan'];
                    $tglRencanaKunjungan = $datakeluaran['rujukan']['tglRencanaKunjungan'];
                    $tglBerlakuKunjungan = $datakeluaran['rujukan']['tglBerlakuKunjungan'];
                    $kodeDiagnosa = $datakeluaran['rujukan']['diagnosa']['kode'];
                    $namaDiagnosa = $datakeluaran['rujukan']['diagnosa']['nama'];
                    $jnsPeserta = $datakeluaran['rujukan']['peserta']['jnsPeserta'];
                    $noKartu = $datakeluaran['rujukan']['peserta']['noKartu'];
                    $nama = $datakeluaran['rujukan']['peserta']['nama'];
                    $kelamin = $datakeluaran['rujukan']['peserta']['kelamin'];
                    $tglLahir = $datakeluaran['rujukan']['peserta']['tglLahir'];
                    $hakKelas = $datakeluaran['rujukan']['peserta']['hakKelas'];
                    $kodepoliTujuan = $datakeluaran['rujukan']['poliTujuan']['kode'];
                    $namapoliTujuan = $datakeluaran['rujukan']['poliTujuan']['nama'];
                    $kodeTujuanRujukan = $datakeluaran['rujukan']['tujuanRujukan']['kode'];
                    $namaTujuanRujukan = $datakeluaran['rujukan']['tujuanRujukan']['nama'];
                    $kodeDokter = $datasep['kodeDokter'];

                    $simpandata = [

                        'journalnumber' => $journalnumber,
                        'referencenumber' => $referencenumber,
                        'norm' => $datasep['noMR'],
                        'kodediagnosa' => $kodeDiagnosa,
                        'namaDiagnosa' => $namaDiagnosa,
                        'kelasRawat' => $klsRawat,
                        'noSep' => $datasep['noSEP'],
                        'hakKelas' => $hakKelas,
                        'jnsPeserta' => $jnsPeserta,
                        'kelamin' => $kelamin,
                        'nama' => $nama,
                        'noKartu' => $noKartu,
                        'tglLahir' => $tglLahir,
                        'tipeRujukan' => $datasep['tipeRujukan'],
                        'kodepoliTujuan' => $kodepoliTujuan,
                        'namapoliTujuan' => $namapoliTujuan,
                        'tglRujukan' => $tglRujukan,
                        'tglRencanaKunjungan' => $tglRencanaKunjungan,
                        'tglBerlakuKunjungan' => $tglBerlakuKunjungan,
                        'noRujukan' => $noRujukan,
                        'kodeTujuanRujukan' => $kodeTujuanRujukan,
                        'namaTujuanRujukan' => $namaTujuanRujukan,
                        'kodeDokter' => $datasep['kodeDokter'],
                        'namaDokter' => $kodeDokter,
                        'createdby' => $createdby,
                        'catatan' => $datasep['catatan'],
                        'jnsPelayanan' => $datasep['jnsPelayanan'],
                    ];

                    $simpannomorkontrol = new ModelDataSuratRujukan;
                    $simpannomorkontrol->insert($simpandata);
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

    private function insert_rencana_rujukan($param, $header)
    {

        $data = [
            "request" =>
            [
                "t_rujukan" =>
                [
                    "noSep" => $param['noSEP'],
                    "tglRujukan" => $param['tglRujukan'],
                    "tglRencanaKunjungan" => $param['tglRencanaKunjungan'],
                    "ppkDirujuk" => $param['ppkDirujuk'],
                    "jnsPelayanan" => $param['jnsPelayanan'],
                    "catatan" => $param['catatan'],
                    "diagRujukan" => $param['diagRujukan'],
                    "tipeRujukan" => $param['tipeRujukan'],
                    "poliRujukan" => $param['poliRujukan'],
                    "user" => $param['user']
                ]
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $this->base_url . $this->service_name . 'Rujukan/2.0/insert', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }


    public function CariSuratRujukan()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $noSuratRujukan = $param['nomorSuratRujukan'];


        $response = $client->request('GET', $base_url . $service_name . 'Rujukan/RS/' . $noSuratRujukan, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);
        $data = [
            "metaData" => $string["metaData"],
            "response" => $datakeluaran,
        ];

        var_dump($data);

        echo json_encode($data);
    }

    public function HapusSuratRujukan()
    {
        if ($this->request->isAJAX()) {

            $noSuratRujukan = $this->request->getVar('noSuratRujukan');
            $datasep['noSuratRujukan'] = $this->request->getVar('noSuratRujukan');
            $datasep['user'] = 'Coba Ws';

            $sep = json_decode($this->delete_surat_rujukan($datasep), true);

            $hapussep = new ModelPasienMaster;


            if ($sep['metaData']['code'] != 200) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep['metaData']['message']
                ];
            } else {
                $hapussep = new ModelPasienMaster;
                $carisep = $hapussep->get_data_dataSuratRujukanRS($noSuratRujukan);
                $id = $carisep['id'];
                $sepdihapus = new ModelDataSuratRujukan;
                $sepdihapus->delete($id);

                $msg = [
                    'success' => true,
                    'pesan' => $sep['metaData']['message']
                ];
            }


            echo json_encode($msg);
        }
    }

    private function delete_surat_rujukan($param)
    {

        $data = [
            "request" =>
            [
                "t_rujukan" => [
                    "noRujukan" => $param['noSuratRujukan'],
                    "user" => $param['user']
                ]
            ]
        ];


        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('DELETE', $this->base_url . $this->service_name . 'Rujukan/delete', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function printSuratRujukan()
    {
        $dompdf = new Dompdf();

        $noSuratRujukan = $this->request->getVar('page');
        $pasien = new ModelPasienMaster;
        $databarcode = $pasien->get_data_dataSuratRujukanRS($noSuratRujukan);


        $data = [
            'noRujukan' => $databarcode['noRujukan'],
            'tglRencanaKunjungan' => $databarcode['tglRencanaKunjungan'],
            'noKartu' => $databarcode['noKartu'],
            'nama' => $databarcode['nama'],
            'tglLahir' => $databarcode['tglLahir'],
            'namadiagnosa' => $databarcode['namaDiagnosa'],
            'tglRujukan' => $databarcode['tglRujukan'],
            'namaTujuanRujukan' => $databarcode['namaTujuanRujukan'],
            'namapoliTujuan' => $databarcode['namapoliTujuan'],
            'catatan' => $databarcode['catatan'],
            'jnsPelayanan' => $databarcode['jnsPelayanan'],
            'tipeRujukan' => $databarcode['tipeRujukan'],
            'tglBerlakuKunjungan' => $databarcode['tglBerlakuKunjungan'],
        ];

        $pasienid_barcode = $databarcode['noRujukan'];

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
        $html = view('pdf/printSuratRujukanRS', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A6', 'landscape');
        $dompdf->render();
        $namafile = $noSuratRujukan;
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function UpdateRencanaRujukan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row_dataSuratRujukanBpjs($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];

            $data = [

                'list' => $this->_data_dokter(),
                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                //'Propinsi' => $this->propinsiBpjs(),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                // 'kode_poli' => 'IGD',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'referencenumber' => $rajal['referencenumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'noSep' => $rajal['noSep'],

                'hakKelas' => $rajal['hakKelas'],
                'kelasRawat' => $rajal['kelasRawat'],

                'statusPulangSep' => $this->statusPulangSep(),
                'statuspasienpulang' => $rajal['statuspasienpulang'],
                'noRujukan' => $rajal['noRujukan'],
                'kodeDokter' => $rajal['kodeDokter'],
                'diagnosa' => $rajal['namaDiagnosa'],
                'tglRujukan' => $rajal['tglRujukan'],
                'namaTujuanRujukan' => $rajal['namaTujuanRujukan'],
                'namapoliTujuan' => $rajal['namapoliTujuan'],
                'catatan' => $rajal['catatan'],
                'jnsPelayanan' => $rajal['jnsPelayanan'],
                'tipeRujukan' => $rajal['tipeRujukan'],
                'tglRencanaKunjungan' => $rajal['tglRencanaKunjungan'],
                'kodeTujuanRujukan' => $rajal['kodeTujuanRujukan'],
                'namaTujuanRujukan' => $rajal['namaTujuanRujukan'],
                'kodepoliTujuan' => $rajal['kodepoliTujuan'],
                'namapoliTujuan' => $rajal['namapoliTujuan'],
                'catatan' => $rajal['catatan'],


            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalupdaterujukan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanUpdateRencanaRujukan()
    {
        if ($this->request->isAJAX()) {


            $datasep['noSEP'] = $this->request->getVar('noSEP');
            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['tglRencanaKunjungan'] = $this->request->getVar('tglRencanaKunjungan');
            $datasep['ppkDirujuk'] = $this->request->getVar('ppkDirujuk');
            $namappkDirujuk = $this->request->getVar('namappkDirujuk');
            $datasep['jnsPelayanan'] = $this->request->getVar('jnsPelayanan');
            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagRujukan'] = $this->request->getVar('diagAwal');
            $namadiagAwal = $this->request->getVar('namadiagAwal');


            $datasep['tipeRujukan'] = $this->request->getVar('tipeRujukan');

            if ($datasep['tipeRujukan'] == 2) {
                $datasep['poliRujukan'] = '';
            } else {
                $datasep['poliRujukan'] = $this->request->getVar('poliRujukan');
            }


            $namapoliRujukan = $this->request->getVar('namapoliRujukan');

            $datasep['kodeDokter'] = $this->request->getVar('kodeDokter');
            $datasep['user'] = $this->request->getVar('user');
            $datasep['noMR'] = $this->request->getVar('noMR');

            $journalnumber = $this->request->getVar('journalnumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $norm = $this->request->getVar('noMR');
            $diagnosa = $this->request->getVar('diagAwal');
            $klsRawat = $this->request->getVar('klsRawat');
            $hakKelas = $this->request->getVar('hakKelas');
            $jnsPeserta = $this->request->getVar('jnsPeserta');
            $nama = $this->request->getVar('nama');
            $createdby = $this->request->getVar('createdby');

            if (($datasep['tipeRujukan'] <> 2) and ($datasep['poliRujukan'] == "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Untuk Tipe Rujukan Penuh Atau Partial Harap Mengisi Kode Poli Tujuan Pelayanan'
                ];
            } else {
                $header = $this->header();
                $sep = json_decode($this->update_rencana_rujukan($datasep, $header), true);


                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
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



                    $tglRujukan =  $datasep['tglRujukan'];
                    $tglRencanaKunjungan = $datasep['tglRencanaKunjungan'];

                    $kodeDiagnosa = $datasep['diagRujukan'];
                    $namaDiagnosa = $namadiagAwal;

                    $kodepoliTujuan = $datasep['poliRujukan'];
                    $namapoliTujuan = $namapoliRujukan;
                    $kodeTujuanRujukan = $datasep['ppkDirujuk'];
                    $namaTujuanRujukan = $namappkDirujuk;
                    $kodeDokter = $datasep['kodeDokter'];

                    $simpandata = [


                        'kodediagnosa' => $kodeDiagnosa,
                        'namaDiagnosa' => $namaDiagnosa,

                        'tipeRujukan' => $datasep['tipeRujukan'],
                        'kodepoliTujuan' => $kodepoliTujuan,
                        'namapoliTujuan' => $namapoliTujuan,
                        'tglRujukan' => $tglRujukan,
                        'tglRencanaKunjungan' => $tglRencanaKunjungan,


                        'kodeTujuanRujukan' => $kodeTujuanRujukan,
                        'namaTujuanRujukan' => $namaTujuanRujukan,
                        'kodeDokter' => $datasep['kodeDokter'],

                        'updatedBy' => $createdby,
                        'catatan' => $datasep['catatan'],
                        'jnsPelayanan' => $datasep['jnsPelayanan'],
                    ];

                    $simpannomorkontrol = new ModelDataSuratRujukan;
                    $simpannomorkontrol->update_dataSuratRujukan($datasep['noRujukan'], $simpandata);
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

    private function update_rencana_rujukan($param, $header)
    {

        $data = [
            "request" =>
            [
                "t_rujukan" =>
                [
                    "noRujukan" => $param['noRujukan'],
                    "tglRujukan" => $param['tglRujukan'],
                    "tglRencanaKunjungan" => $param['tglRencanaKunjungan'],
                    "ppkDirujuk" => $param['ppkDirujuk'],
                    "jnsPelayanan" => $param['jnsPelayanan'],
                    "catatan" => $param['catatan'],
                    "diagRujukan" => $param['diagRujukan'],
                    "tipeRujukan" => $param['tipeRujukan'],
                    "poliRujukan" => $param['poliRujukan'],
                    "user" => $param['user']
                ]
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('PUT', $this->base_url . $this->service_name . 'Rujukan/2.0/Update', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function CreateSepPenjamin()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];
            $referencenumber = $rajal['referencenumber'];

            $SPRI = $m_icd->get_data_rajal_row_cek_spri($referencenumber);



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
                'kode_poli' => 'IRI',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'referencenumber' => $rajal['referencenumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'naikKelas' => $this->naikKelas(),
                'pembiayaan' => $this->pembiayaan(),
                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'jeniskll' => $this->jeniskllsep(),
                'noSPRI' => $SPRI['noSPRI'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalcreatesepranappenjamin', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanPenjaminSEP()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');

            $jnsPelayanan = $this->request->getVar('jnsPelayanan');
            $jnsPengajuan = $this->request->getVar('jnsPengajuan');
            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['user'] = $this->request->getVar('createdby');
            $createdby = $this->request->getVar('createdby');
            $norm = $this->request->getVar('noMR');
            $datasep['keterangan'] = $this->request->getVar('keterangan');
            $datasep['jnsPelayanan'] = $jnsPelayanan;
            $datasep['jnsPengajuan'] = $jnsPengajuan;


            $journalnumber = $this->request->getVar('journalnumberrajal');
            $referencenumber = $this->request->getVar('referencenumber');



            if ($jnsPelayanan == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Jenis Pelayanan'
                ];
            } else if ($jnsPengajuan == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Jenis Pengajuan'
                ];
            } else {

                $header = $this->header();
                $sep = json_decode($this->insert_sep_penjamin($datasep, $header), true);
                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
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
                    $noSuratPengajuan = $datakeluaran;
                    $jnsPelayanan = $datasep['jnsPelayanan'];
                    $jnsPengajuan = $datasep['jnsPengajuan'];
                    $keterangan = $datasep['keterangan'];


                    $simpandata = [

                        'journalnumber' => $journalnumber,
                        'referencenumber' => $referencenumber,
                        'noKartu' => $datasep['noKartu'],
                        'norm' => $norm,
                        'tglSep' => $datasep['tglSep'],
                        'jnsPelayanan' => $jnsPelayanan,
                        'jnsPengajuan' => $jnsPengajuan,
                        'keterangan' => $keterangan,
                        'noSuratPengajuan' => $noSuratPengajuan,
                        'createdby' => $createdby,
                    ];

                    $simpannomorkontrol = new ModelDataPengajuanSEPRanap;
                    $simpannomorkontrol->insert($simpandata);
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

    private function insert_sep_penjamin($param, $header)
    {

        $data = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noKartu" => $param['noKartu'],
                    "tglSep" => $param['tglSep'],
                    "jnsPelayanan" => $param['jnsPelayanan'],
                    "jnsPengajuan" => $param['jnsPengajuan'],
                    "keterangan" => $param['keterangan'],
                    "user" => $param['user'],
                ]
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $this->base_url . $this->service_name . 'Sep/pengajuanSEP', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function AprovalSepPenjamin()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_ranap_row($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];
            $referencenumber = $rajal['referencenumber'];

            $PenjaminSep = $m_icd->get_data_penjaminan_sep_ranap($referencenumber);



            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'pelayanan' => $this->pelayanan(),
                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => 'IRI',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'referencenumber' => $rajal['referencenumber'],
                'icdx' => $rajal['icdx'],
                'tglSep' => $PenjaminSep['tglSep'],
                'jnsPelayanan' => $PenjaminSep['jnsPelayanan'],
                'jnsPengajuan' => $PenjaminSep['jnsPengajuan'],
                'keterangan' => $PenjaminSep['keterangan'],
                'noSuratPengajuan' => $PenjaminSep['noSuratPengajuan'],
                'noKartu' => $PenjaminSep['noKartu'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatinap/modalaprovalsepranappenjamin', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanAprovalPenjaminSEP()
    {
        if ($this->request->isAJAX()) {

            $idrajal = $this->request->getVar('idrajal');

            $jnsPelayanan = $this->request->getVar('jnsPelayanan');
            $jnsPengajuan = $this->request->getVar('jnsPengajuan');
            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['user'] = $this->request->getVar('createdby');
            $createdby = $this->request->getVar('createdby');
            $norm = $this->request->getVar('noMR');
            $datasep['keterangan'] = $this->request->getVar('keterangan');
            $datasep['jnsPelayanan'] = $jnsPelayanan;
            $datasep['jnsPengajuan'] = $jnsPengajuan;


            $journalnumber = $this->request->getVar('journalnumberrajal');
            $referencenumber = $this->request->getVar('referencenumber');



            if ($jnsPelayanan == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Jenis Pelayanan'
                ];
            } else if ($jnsPengajuan == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Jenis Pengajuan'
                ];
            } else {

                $header = $this->header();
                $sep = json_decode($this->insert_aproval_sep_penjamin($datasep, $header), true);
                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
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
                    $noSuratPengajuan = $datakeluaran;
                    $statusAproval = 1;

                    $simpandata = [
                        'noSuratPengajuan' => $noSuratPengajuan,
                        'statusAproval' => $statusAproval,
                    ];

                    $simpannomorkontrol = new ModelDataPengajuanSEPRanap;
                    $simpannomorkontrol->update_dataPenjamin_SEP($referencenumber, $simpandata);
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

    private function insert_aproval_sep_penjamin($param, $header)
    {

        $data = [
            "request" =>
            [
                "t_sep" =>
                [
                    "noKartu" => $param['noKartu'],
                    "tglSep" => $param['tglSep'],
                    "jnsPelayanan" => $param['jnsPelayanan'],
                    "jnsPengajuan" => $param['jnsPengajuan'],
                    "keterangan" => $param['keterangan'],
                    "user" => $param['user'],
                ]
            ]
        ];


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $this->base_url . $this->service_name . 'Sep/aprovalSEP', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function printsepKonvensional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');
        $referencenumber = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_sjp($lokasikasir);
        $databarcode = $pasien->dataSepBarcodeRanap($referencenumber);
        $kodedokter = $databarcode['kodeDokter'];
        $namadoktersep = $pasien->caridokter($kodedokter);
        $namaDokter = $namadoktersep['name'];
        $data = [
            'datapasien' => $pasien->dataSepRanap($referencenumber),
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
        return view('cetakan/sepranap', $data);
    }

    public function printstickerbarcode()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganranap($id),
        ];



        $databarcode = $pasien->kunjunganranap_pasienid($id);
        $pasienid_barcode = $databarcode['pasienid'];


        $qrCode = new QrCode();
        $qrCode
            ->setText($pasienid_barcode)
            ->setSize(40)
            ->setPadding(8)
            ->setErrorCorrection('high')
            ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
            ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))

            ->setLabelFontSize(16)
            ->setImageType(QrCode::IMAGE_TYPE_PNG);

        $data['barcode'] = '<img src="data:' . $qrCode->getContentType() . ';base64,' . $qrCode->generate() . '" />';

        return view('cetakan/stickerigd', $data);
    }


    public function UbahAdmisiRanap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();

            $data = [
                'pasienlama' => $m_icd->get_data_ranap($id),
                'cabar' => $this->data_payment(),
                'pelayanan' => $this->pelayanan(),
                'namasmf' => $this->smf(),
                'list' => $this->_data_dokter_all(),
                'sebabsakit' => $this->sebabsakit(),
            ];
            $msg = [
                'sukses' => view('rawatinap/modalubahadmisiranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanUbahAdmisi()
    {
        if ($this->request->isAJAX()) {

            $tanggalmasuk = $this->request->getVar('datein');
            $jammasuk = $this->request->getVar('timein');
            $tanggalkeluar = $this->request->getVar('dateout');
            $jamkeluar = $this->request->getVar('timeout');
            $tanggaljammasuk = $tanggalmasuk . ' ' . $jammasuk;
            $tanggaljamkeluar = $tanggalkeluar . ' ' . $jamkeluar;
            $simpandata = [

                'datein' => $this->request->getVar('datein'),
                'dateout' => $this->request->getVar('dateout'),
                'datetimein' => $tanggaljammasuk,
                'datetimeout' => $tanggaljamkeluar,
                'timeout' => $this->request->getVar('timeout'),
                'timein' => $this->request->getVar('timein'),
                'documentdate' => $this->request->getVar('datein'),
            ];

            $perawat = new ModelDaftarRanap;
            $id = $this->request->getVar('idadmisi');
            $perawat->update($id, $simpandata);
            $msg = [
                'pesan' => 'Data Admission Berhasil Diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function propinsiBpjs()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $response = $client->request('GET', $base_url .  $service_name . 'referensi/propinsi', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        //var_dump($data);

        return $data['list'];
    }

    public function dokterBpjs()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

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
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        return $data['list'];
    }


    public function updatedatavalidasi()
    {
        if ($this->request->isAJAX()) {
            $masuk = $this->request->getVar('datein');
            $jammasuk = $this->request->getVar('timein');
            $datetimein = $masuk . ' ' . $jammasuk;
            $simpandata = [

                'smfname' => $this->request->getVar('smfname'),
                'smf' => $this->request->getVar('smf'),
                'dokter' => $this->request->getVar('ibsdokter'),
                'doktername' => $this->request->getVar('ibsdoktername'),
                'datein' => $masuk,
                'timein' => $jammasuk,
                'datetimein' => $datetimein,

            ];
            $perawat = new ModelValidasiRanap;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Validasi Masuk Rawat Inap sudah berhasil diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

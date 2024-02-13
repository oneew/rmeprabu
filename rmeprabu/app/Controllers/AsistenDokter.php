<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPasienMaster;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasien;
use App\Models\ModelPasienRanap;
use App\Models\ModelDataSep;
use App\Models\ModelDataSPRI;
use App\Models\ModelDataPengajuanSEPRajal;
use App\Models\ModelDataSuratRujukanRajal;
use App\Models\ModelDataSuratKontrol;
use App\Models\ModelDataSuratKontrolFromRajal;
use App\Models\ModelAsistenDokter;
use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use GuzzleHttp\Client;
use Dompdf\Options;




class AsistenDokter extends BaseController
{
    private $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
    private $service_name = 'vclaim-rest/';

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/registerrajal', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterrajal', $data)
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

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('asistendokter/dataregisterrajal', $data)
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
                // 'tampildata'=>$register->datapasienrsud45()
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
                    'label' => 'Nama Poli',
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


                $tglrujukan1 = $this->request->getVar("referencedate");

                $mulai = str_replace('/', '-', $tglrujukan1);
                $tglrujukan = date('Y-m-d', strtotime($mulai));

                $db = db_connect();
                $groups = $this->request->getVar('groups');

                $poliklinikname = $this->request->getVar('poliklinikname');
                $pasienid = $this->request->getVar('pasienid');
                $documentdate = date('Y-m-d');


                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinikname='$poliklinikname' AND groups='$groups'  LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    //$antrian = $row->noantrian;
                }
                $query2 = $db->query("SELECT  MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinikname='$poliklinikname' AND groups='$groups'  LIMIT 1");

                foreach ($query2->getResult() as $row2) {

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


                $cekregister = new ModelRawatJalanDaftar;
                $cekkodepoli = $cekregister->cek_kode_poli($poliklinikname);
                //$lokasi = $this->request->getVar('poliklinik');
                $lokasi = $cekkodepoli['code'];


                $newkode = $groups . $underscore . $pasienid . $underscore  . $today . $underscore . sprintf('%06s', $nourut);
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

                $cekregister = new ModelRawatJalanDaftar;
                $hasilcek = $cekregister->cek_register_today($pasienid, $poliklinikname, $documentdate);

                $cekdulu = isset($hasilcek['pasienid']) != null ? $hasilcek['pasienid'] : "";

                $deskripsipoli = $this->request->getVar('poliklinik');
                if (($deskripsipoli == "PL-015") or ($deskripsipoli == "PL-011") or
                    ($deskripsipoli == "PL-026") or ($deskripsipoli == "PL-31") or
                    ($deskripsipoli == "PL-028")
                ) {
                    $cekkonsul = $cekregister->cek_konsul($deskripsipoli);
                } else {
                    $cekkonsul = $cekregister->cek_konsul_lainnya();
                }

                $nama_konsul = $cekkonsul['name'];
                $harga_konsul = $cekkonsul['price'];
                $jasars_konsul = $cekkonsul['share1'];
                $jasajp_konsul = $cekkonsul['share2'];
                $jasadokter_konsul = $cekkonsul['share21'];

                if ($cekdulu == "") {
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
                        'poliklinik' => $lokasi,
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
                        'referencenumber' => $this->request->getVar('noRujukanDaftar'),
                        'noSuratKontrol' => $this->request->getVar('noSuratKontrol'),
                        'noSepAsalKontrol' => $this->request->getVar('noSepAsalKontrol'),
                        'tglSuratKontrol' => $this->request->getVar('tglSuratKontrol'),
                        'tanggalperiksa' => $this->request->getVar('documentdate'),
                        'kodedokter' => $this->request->getVar('kodedokter'),
                        'kodepoli' => $this->request->getVar('kodepoli'),

                        'nama_konsul' => $nama_konsul,
                        'harga_konsul' => $harga_konsul,
                        'jasars_konsul' => $jasars_konsul,
                        'jasajp_konsul' => $jasajp_konsul,
                        'jasadokter_konsul' => $jasadokter_konsul,


                    ];
                    $perawat = new ModelRawatJalanDaftar;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Pendftaran Rawat Jalan Berhasil',
                        'JN' => $newkode,
                    ];
                } else {
                    $msg = [
                        'gagal' => 'Pasien Tersebut sudah didaftarkan pada poli yang sama pada hari ini'
                    ];
                }
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
                    $nourutnorm = '000000000000001';
                } else {
                    $nourutnorm = (int) substr($norm, -15, 15);
                    $nourutnorm++;
                }

                //$normbaru = $inisial . sprintf('%08s', $nourutnorm);
                $normbaru = sprintf('%15s', $nourutnorm);

                // var_dump($normbaru);
                // var_dump($nourutnorm);
                // die();


                $groups = $this->request->getVar('groups_baru');
                $lokasi = $this->request->getVar('kodepoliklinik');
                $namalokasi = $this->request->getVar('namapoliklinik');
                $documentdate = date('Y-m-d');
                $today = date('ymd');
                $underscore = '_';
                $query2 = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinikname='$namalokasi' AND groups='$groups'  LIMIT 1");

                foreach ($query2->getResult() as $row2) {
                    $kode = $row2->kode_jurnal;
                    //$antrian = $row2->noantrian;
                }

                $query4 = $db->query("SELECT  MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinikname='$namalokasi' AND groups='$groups'  LIMIT 1");

                foreach ($query4->getResult() as $row4) {
                    //$kode = $row2->kode_jurnal;
                    $antrian = $row4->noantrian;
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

                $cekregister = new ModelRawatJalanDaftar;
                $poliklinikname = $this->request->getVar('namapoliklinik');
                $cekkodepoli = $cekregister->cek_kode_poli($poliklinikname);
                //$lokasi = $this->request->getVar('poliklinik');
                $lokasi = $cekkodepoli['code'];

                $newkode = $groups . $underscore . $normbaru . $underscore  . $today . $underscore . sprintf('%06s', $nourut);

                // var_dump($poliklinikname);
                // var_dump($newkode);
                // var_dump($no_antrian);
                // var_dump($lokasi);
                // die();

                $tglrujukan2 = $this->request->getVar("tanggalrujukan");

                $mulai = str_replace('/', '-', $tglrujukan2);
                $tglrujukan = date('Y-m-d', strtotime($mulai));

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

                $metodepembayaran = $this->request->getVar('carabayar');
                $kode_pelayanan = $this->request->getVar('kode_pelayanan');
                $sebab_masuk = $this->request->getVar('sebabmasuk');
                $namadokterpoli = $this->request->getVar('namadokterpoli');
                $incorrectNik = $this->request->getVar('tandaNik');

                if ($incorrectNik == 1) {
                    $incorrectNik = 1;
                } else {
                    $incorrectNik = 0;
                }

                $deskripsipoli = $this->request->getVar('poliklinik');
                if (($deskripsipoli == "PL-015") or ($deskripsipoli == "PL-011") or
                    ($deskripsipoli == "PL-026") or ($deskripsipoli == "PL-31") or
                    ($deskripsipoli == "PL-028")
                ) {
                    $cekkonsul = $cekregister->cek_konsul($deskripsipoli);
                } else {
                    $cekkonsul = $cekregister->cek_konsul_lainnya();
                }

                $nama_konsul = $cekkonsul['name'];
                $harga_konsul = $cekkonsul['price'];
                $jasars_konsul = $cekkonsul['share1'];
                $jasajp_konsul = $cekkonsul['share2'];
                $jasadokter_konsul = $cekkonsul['share21'];


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
                        'incorrectNik' => $incorrectNik,

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
                        'poliklinik' => $lokasi,
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
                        'tanggalperiksa' => $this->request->getVar('documentdate_baru'),
                        'kodedokter' => $this->request->getVar('kodedokter'),
                        'kodepoli' => $this->request->getVar('kodebpjs'),
                        'tanggalperiksa' => $documentdate,
                        'kodedokter' => $this->request->getVar('kodedokter'),
                        'kodepoli' => $this->request->getVar('kodepoli'),

                        'nama_konsul' => $nama_konsul,
                        'harga_konsul' => $harga_konsul,
                        'jasars_konsul' => $jasars_konsul,
                        'jasajp_konsul' => $jasajp_konsul,
                        'jasadokter_konsul' => $jasadokter_konsul,
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

    public function printkarcis()
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

        $html = view('pdf/stylebootstrap');
        //$html .= view('pdf/karcisrajal', $data);
        $html = view('pdf/karcisrajal', $data);

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

            $data = [
                'pasienlama' => $m_icd->get_data_rajal($id),
            ];
            $msg = [
                'sukses' => view('rawatjalan/modalprintregisterrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function HistoriKunjungan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPasienMaster();
            $pasienid = $this->request->getVar('pasienid');
            $data = [
                'kunjungan' => $resume->get_data_rajal_kunjungan($pasienid)
            ];

            $msg = [
                'data' => view('rawatjalan/data_histori_kunjungan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printsjp()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_sjp($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganrajal_sjp($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/sjprajal', $data);

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


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_sjp($lokasikasir);
        $databarcode = $pasien->dataSepBarcode($id);
        $kodedokter = $databarcode['kodeDPJP'];
        $namadoktersep = $pasien->caridokter($kodedokter);
        $namaDokter = $namadoktersep['name'];


        $cari_faskes = $pasien->dataSep_faskes($id);

        $kode_faskes = $cari_faskes['faskes'];
        $nama_faskes = $cari_faskes['faskesname'];



        $data = [
            'datapasien' => $pasien->dataSep($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'namaDokter' => $namaDokter,
            'kodefaskes' => $kode_faskes,
            'nama_faskes' => $nama_faskes,
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
        $html = view('pdf/seprajal', $data);

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
                'list' => $this->_data_dokter_all(),
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
                'pasienname' => $this->request->getVar('pasienname'),
                'pasienaddress' => $this->request->getVar('pasienaddress'),
                'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
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
            ->setSize(30)
            ->setPadding(8)
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
        $html = view('pdf/headerstatusrajal', $data);

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
        $html = view('pdf/gelangrajal', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A8', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

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
            $poli_bpjs = $m_icd->get_data_poli_bpjs($kodepoli);

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
                'kode_poli' => $poli_bpjs['bpjscode'],
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'jeniskll' => $this->jeniskllsep(),
                'noSuratKontrol' => $rajal['noSuratKontrol'],
                'noSepAsalKontrol' => $rajal['noSepAsalKontrol'],
                'tglSuratKontrol' => $rajal['tglSuratKontrol'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatjalan/modalcreatesep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
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
            $poli_bpjs = $m_icd->get_data_poli_bpjs($kodepoli);

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
                'kode_poli' => $poli_bpjs['bpjscode'],
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'icdx' => $rajal['icdx'],
                'dokterBPJS' => $this->dokterBpjs(),
                'tujuanKunjungan' => $this->tujuanKunjunganSep(),
                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'noSuratKontrol' => $rajal['noSuratKontrol'],
                'noSepAsalKontrol' => $rajal['noSepAsalKontrol'],
                'tglSuratKontrol' => $rajal['tglSuratKontrol'],

                'jeniskll' => $this->jeniskllsep(),
            ];

            $msg = [
                'suksesmodalsep' => view('rawatjalan/modalcreatesep', $data)
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
    }

    public function referensiPoli()
    {

        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $keyword = 'HEMODIALISA';
        $data = $request->poli($keyword);
        echo json_encode($data['response']);
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
            } else {
                $datasep['suplesi'] = "0";
            }

            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['tglSep'] = $this->request->getVar('tglSep');
            $datasep['ppkPelayanan'] = $this->request->getVar('ppkPelayanan');
            $datasep['jnsPelayanan'] = $this->request->getVar('jnsPelayanan');
            $datasep['klsRawat'] = $this->request->getVar('klsRawat');
            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['asalRujukan'] = $this->request->getVar('asalRujukanSep');
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
                $pelayanan = 'IRJ';
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
            //$datasep['flagProcedure'] = '';
            $datasep['kdPenunjang'] = $this->request->getVar('kdPenunjang');
            ///$datasep['kdPenunjang'] = '';
            $datasep['assesmentPel'] = $this->request->getVar('assesmentPel');
            //$datasep['assesmentPel'] = "";
            $datasep['dpjpLayan'] = $dpjpLayan;
            $datasep['ketLakalantas'] = '0';

            $datasep['noMR'] = $this->request->getVar('noMR');
            $datasep['asalRujukan'] = $this->request->getVar('asalRujukanSep');
            $datasep['tglRujukan'] = $this->request->getVar('tglRujukan');
            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['ppkRujukan'] = $this->request->getVar('ppkRujukan');

            $datasep['catatan'] = $this->request->getVar('catatan');
            $datasep['diagAwal'] = $this->request->getVar('diagAwal');
            $datasep['tujuan'] = $this->request->getVar('tujuan');
            $datasep['tujuanRujukan'] = $this->request->getVar('tujuanRujukan');

            //$datasep['ketLakalantas'] = $this->request->getVar('ketLakalantas');

            $datasep['penjamin'] = '';
            $datasep['tglKejadian'] = '';
            $datasep['keterangan'] = '';

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

            $tandakontrol = $this->request->getVar('tandakontrol');
            $nomorKunjungan = $this->request->getVar('nomorKunjungan');
            $namaPerujuk = $this->request->getVar('namaPerujuk');

            $tanggalSep = $datasep['tglSep'];
            $noKartu = $datasep['noKartu'];
            $tanggal = $tanggalSep;

            $fingerprint = json_encode($this->caridatapelayananfingerprintPeserta($tanggal, $noKartu), true);

            $FP = json_decode($fingerprint, true);

            $tglRujukan = $datasep['tglRujukan'];
            $hari_ini = date('Y-m-d');

            $tgl1 = strtotime($tglRujukan);
            $tgl2 = strtotime($hari_ini);

            $jarak = $tgl2 - $tgl1;

            $hari = $jarak / 60 / 60 / 24;

            if ($tandakontrol == 1) {
                $noSuratKontrol = $datasep['noSurat'];
                $carisuratkontrol = new ModelPasienMaster;
                $cariSK = $carisuratkontrol->get_data_data_surat_kontrol($noSuratKontrol);
                $ceknoSuratKontrol = isset($cariSK['noSuratKontrol']) != null ? $cariSK['noSuratKontrol'] : "";
            }


            if ($datasep['tujuanKunj'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Isi Tujuan Kunjungan Terlebih Dahulu'
                ];
            }
            // else if (($datasep['tujuanKunj'] == 0) and ($datasep['flagProcedure'] <> "")) {
            //     $msg = [
            //         'gagal' => true,
            //         'pesan' => 'Tidak Diperkanankan Mengisi Flag Procedure Jika Tujuan Kunjungan Normal'
            //     ];
            // } 
            else if ($hari > 90) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Masa Berlaku Surat Rujukan Telah Habis, maksimal 3(tiga) bulan dari tanggal rujukan, silahkan ke faskes Perujuk Untuk Memperbaharui Rujukan'
                ];
            } else if ($dpjp == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'DPJP Tidak Boleh Kosong !!!'
                ];
            } else if (($nomorKunjungan == 1) and ($datasep['tujuanRujukan'] <> $datasep['tujuan'])) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Poli Tujuan Tidak Boleh Berbeda Dengan Tujuan Pada Surat Rujukan !!!'
                ];
            }
            //else if (($tandakontrol == 1) and ($datasep['noSurat'] <> $ceknoSuratKontrol)) {
            //     $msg = [
            //         'gagal' => true,
            //         'pesan' => 'Pasien Belum Dipulangkan Dari Pelayanan RITL!!!'
            //     ];
            // } 
            else if ($datasep['tglSep'] > $hari_ini) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tanggal SEP Tidak Boleh Lebih Besar Dari Tanggal hari Ini!!!'
                ];
            } else if ($datasep['tglRujukan'] > $hari_ini) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Tanggal Rujukan Tidak Boleh Lebih Besar Dari Tanggal hari Ini!!!'
                ];
            } else if ($datasep['noRujukan'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'No Rujukan Tidak Boleh Kosong!!!'
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

                // var_dump($sep);
                // var_dump($datakeluaran);
                // die();

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
                    $pelayanan = 'IRJ';
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
                        'kunjunganke' => $nomorKunjungan,
                        'faskesPerujuk' => $datasep['namaPerujuk'], //$namaPerujuk,

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
                        "klsRawatNaik" => '',
                        "pembiayaan" => '',
                        "penanggungJawab" => ''

                    ],
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

        //var_dump($data);

        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $this->base_url . $this->service_name . 'SEP/2.0/insert', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
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

    private function insert_sepv1($param)
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

    public function HapusSep()
    {
        if ($this->request->isAJAX()) {

            //$id = $this->request->getVar('id');
            $noSep = $this->request->getVar('nomorSep');
            $datasep['noSep'] = $this->request->getVar('nomorSep');
            $journalnumber = $this->request->getVar('journalnumber');
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

            if ($sep['metaData']['message'] != 200) {
                $msg = [
                    'success' => true,
                    'pesan' => $sep['metaData']['message'],

                ];
            } else {

                $hapussep = new ModelPasienMaster;
                if ($noSep != "") {
                    $carisep = $hapussep->get_data_dataSep_delete($noSep, $journalnumber);
                    $id = $carisep['id'];
                    $sepdihapus = new ModelDataSep;
                    $sepdihapus->delete($id);
                }
                $msg = [
                    'success' => true,
                    'pesan' => $sep['metaData']['message'],
                    'response' => $datakeluaran,
                ];
            }
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

    public function CariSPRI()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $keyword = $this->request->getVar('nomorSuratPerintahRawat');

        $response = $client->request('GET', $base_url . $service_name . 'RencanaKontrol/noSuratKontrol/' . $keyword, [
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
            "pesan" => $string['metaData']['message']
        ];

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
            $polibpjs = $m_icd->get_data_poli_bpjs($kodepoli);

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
                'kodeDPJP' => $rajal['kodeDPJP'],
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => $polibpjs['bpjscode'],
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
                'penanggungJawab' => $rajal['penanggungJawab'],
                'tujuanKunj' => $rajal['tujuanKunj'],
                'flagProceduresep' => $rajal['flagProcedure'],
                'kdPenunjang' => $rajal['kdPenunjang'],
                'jenislakaLantas' => $rajal['jenislakaLantas'],
                'dpjpLayan' => $rajal['dpjpLayan'],
                'assesmentPel' => $rajal['assesmentPel'],
                'flagprocedure' => $this->flagprocedure(),
                'penunjangsep' => $this->penunjangsep(),
                'assesmentpelayanansep' => $this->assesmentpelayanansep(),
                'jeniskll' => $this->jeniskllsep(),
                'noSuratKontrol' => $rajal['noSuratKontrol'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatjalan/modalupdateseprajal', $data)
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

            //$dpjp = $this->request->getVar('dokterbpjs');
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

            $sep = json_decode($this->update_sepv1($datasep));


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

    private function update_sepv1($param)
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
                                "noSepSuplesi" => '',
                                "lokasiLaka" => [
                                    "kdPropinsi" => '',
                                    "kdKabupaten" => '',
                                    "kdKecamatan" => ''
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
                            "penjamin" => '',
                            "tglKejadian" => '',
                            "keterangan" => '',
                            "suplesi" => [
                                "suplesi" => $param['suplesi'],
                                "noSepSuplesi" => '',
                                "lokasiLaka" => [
                                    "kdPropinsi" => '',
                                    "kdKabupaten" => '',
                                    "kdKecamatan" => ''
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

        $response = $client->request('PUT', $this->base_url . $this->service_name . 'SEP/2.0/update', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;

        //return json_encode($response);
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
            } else {
                $datasep['suplesi'] = "0";
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

            $datasep['ketLakalantas'] = '0';
            $datasep['penjamin'] = '';
            $datasep['tglKejadian'] = '';
            $datasep['keterangan'] = '';

            $datasep['noSepSuplesi'] = $this->request->getVar('noSepSuplesi');
            $datasep['kdPropinsi'] = '';
            $datasep['kdKabupaten'] = '';
            $datasep['kdKecamatan'] = '';

            $datasep['noSurat'] = $this->request->getVar('noSurat');
            $datasep['kodeDPJP'] = $dpjp;
            $datasep['noTelp'] = $this->request->getVar('noTelp');
            $datasep['user'] = $this->request->getVar('user');
            $createdby = $this->request->getVar('createdby');

            $journalnumber = $this->request->getVar('journalnumberrajal');
            $header = $this->header();
            $sep = json_decode($this->update_sep($datasep, $header), true);


            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
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
                    'diagnosa' => $datasep['namadiagAwal'],
                ];

                $simpannomorsep = new ModelDataSep;
                $nosep = $datasep['noSep'];
                $simpannomorsep->update_dataSep($nosep, $simpandata);
                $msg = [
                    'success' => true,
                    'pesan' => $sep['metaData']['message'],
                    'berhasil' => $sep['response'],
                ];
            }
        }

        echo json_encode($msg);
    }

    public function registerkontrol()
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
                'data' => view('rawatjalan/modaldaftarkontrol', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
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
                'kode_poliBpjs' => $mapingpoli['bpjscode'],
                'namapoli' => $namapoli,
            ];

            $msg = [
                'suksesmodalspri' => view('rawatjalan/modalcreateSPRI', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function registerrujukan()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
            ];
            $msg = [
                'data' => view('rawatjalan/modaldaftarrujukan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function check_rujukan_kartu()
    {
        $searchBy = $this->request->getVar('filter');
        $keyword = $this->request->getVar('card');
        $vclaim_conf = $this->vclaim_conf();
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);
        $data = $peserta->cariByNoKartuBaru($searchBy, $keyword);
        $msg = [
            'data' => view('rawatjalan/datarujukan', $data)
        ];
        echo json_encode($msg);
    }


    public function insertSpriV1()
    {
        if ($this->request->isAJAX()) {

            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['kodeDokter'] = $this->request->getVar('kodeDokter');
            $datasep['poliKontrol'] = $this->request->getVar('poliKontrol');
            $datasep['tglRencanaKontrol'] = $this->request->getVar('tglRencanaKontrol');
            $datasep['user'] = $this->request->getVar('createdby');

            $sep = json_decode($this->insert_spriV1($datasep));
            $data['message'] = $sep->metaData->message;
            if ($sep->response == null) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep->metaData->message
                ];
            } else {
                $msg = [
                    'success' => true,
                    'response' => $sep->response,
                    'pesan' => $sep->metaData->message
                ];
            }
        }
        echo json_encode($msg);
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
            $secretKey = "4iK5B08401";
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

    private function insert_spriV1($param)
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
        $vclaim_conf = $this->vclaim_conf();
        $request = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);
        $data = $request->insertSpri($data);

        return json_encode($data);
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

    public function historipelayananSep()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
            ];
            $msg = [
                'data' => view('rawatjalan/modalhistoripelayananSep', $data)
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
                'data' => view('rawatjalan/modalupdatenik', $data)
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

    public function DataPelayananFingerPrint()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
            ];
            $msg = [
                'data' => view('rawatjalan/modalDaPelFingerPrint', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapelayananfingerprint()
    {
        $vclaim_conf = $this->vclaim_conf();
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Monitoring($vclaim_conf);
        $search = $this->request->getPost();
        $dateout = explode('-', $search['tglpelayanan']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $tglawal = date('Y-m-d', strtotime($mulai));
        $data = $peserta->getListFingerPrint($tglawal);
        echo json_encode($data);
    }

    public function DataPesertaFingerPrint()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
            ];
            $msg = [
                'data' => view('rawatjalan/modalDataFingerPrint', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapelayananfingerprintPesertaV1()
    {
        $vclaim_conf = $this->vclaim_conf();
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Monitoring($vclaim_conf);
        $search = $this->request->getPost();
        $dateout = explode('-', $search['tglpelayanan']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $tglawal = date('Y-m-d', strtotime($mulai));
        $nokartu = $search['nokartu'];
        $data = $peserta->getDataFingerPrint($nokartu, $tglawal);
        echo json_encode($data);
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
            $perawat = new ModelRawatJalanDaftar;
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
        return view('rawatjalan/registerrajalBatal', $data);
    }

    public function ambildataBatal()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->ambildatarajalBatal()
            ];
            $msg = [
                'data' => view('rawatjalan/dataregisterrajalBatal', $data)
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

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->search_RegisterRajalBatal($search)
            ];

            $msg = [
                'data' => view('rawatjalan/dataregisterrajalBatal', $data)
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
            $perawat = new ModelRawatJalanDaftar;
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

    public function stringDecrypt($key, $string)
    {

        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);

        return $output;
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
                'suksesmodalspri' => view('rawatjalan/modalupdateSPRI', $data)
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
            $secretKey = "4iK5B08401";
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

    public function caridatapelayananfingerprintPeserta($tanggal, $noKartu)
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $response = $client->request('GET', $base_url .  $service_name . 'SEP/FingerPrint/Peserta/' . $noKartu . '/' . 'TglPelayanan/' . $tanggal, [
            'headers' => $this->header(),
        ])->getBody()->getContents();


        $header = $this->header();
        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $output = $this->stringDecrypt($key, $string['response']);
        $dataoutput = json_decode($output, true);

        return $dataoutput;
    }

    public function CreateSepPenjamin()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row2($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];
            $referencenumber = $rajal['journalnumber'];

            $data = [

                'pasienlama' => $m_icd->get_data_pasien_lama_rajal($pasienid),
                'dokterpemeriksa' => $dokter,
                'kodeDPJP' => $kodedokter_bpjs,
                'cabarpasien' => $rajal['paymentmethodname'],
                'kode_poli' => 'IRI',
                'idrajal' => $rajal['id'],
                'journalnumber' => $rajal['journalnumber'],
                'referencenumber' => $rajal['referencenumber'],
                'icdx' => $rajal['icdx'],

            ];

            $msg = [
                'suksesmodalsep' => view('rawatjalan/modalcreateseprajalpenjamin', $data)
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
                        'referencenumber' => $journalnumber,
                        'noKartu' => $datasep['noKartu'],
                        'norm' => $norm,
                        'tglSep' => $datasep['tglSep'],
                        'jnsPelayanan' => $jnsPelayanan,
                        'jnsPengajuan' => $jnsPengajuan,
                        'keterangan' => $keterangan,
                        'noSuratPengajuan' => $noSuratPengajuan,
                        'createdby' => $createdby,
                    ];

                    $simpannomorkontrol = new ModelDataPengajuanSEPRajal;
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
            $rajal = $m_icd->get_data_rajal_row2($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];
            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];
            $referencenumber = $rajal['journalnumber'];

            $PenjaminSep = $m_icd->get_data_penjaminan_sep_rajal($referencenumber);
            $data = [

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
                'suksesmodalsep' => view('rawatjalan/modalaprovalseprajalpenjamin', $data)
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

                    $simpannomorkontrol = new ModelDataPengajuanSEPRajal;
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

    public function InsertRencanaRujukan()
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
                //'statuspasienpulang' => $rajal['statuspasienpulang'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatjalan/modalinsertrujukanRajal', $data)
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
                        'referencenumber' => $journalnumber,
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

                    $simpannomorkontrol = new ModelDataSuratRujukanRajal;
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

    public function HapusSuratRujukan()
    {
        if ($this->request->isAJAX()) {

            $noSuratRujukan = $this->request->getVar('noSuratRujukan');
            $datasep['noSuratRujukan'] = $this->request->getVar('noSuratRujukan');
            $datasep['user'] = 'Coba Ws';

            $sep = json_decode($this->delete_surat_rujukan($datasep), true);

            if ($sep['metaData']['code'] != 200) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep['metaData']['message']
                ];
            } else {
                $hapussep = new ModelPasienMaster;
                $carisep = $hapussep->get_data_dataSuratRujukanRSRajal($noSuratRujukan);
                $id = $carisep['id'];
                $sepdihapus = new ModelDataSuratRujukanRajal;
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
        $databarcode = $pasien->get_data_dataSuratRujukanRSRajal($noSuratRujukan);


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

    public function InsertRencanaPRB()
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
                'alamat' => $rajal['pasienaddress'],
                'programPRB' => $this->programPRB(),

            ];

            $msg = [
                'suksesmodalsep' => view('rawatjalan/modalinsertPRBRajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function programPRB()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_PRB();
        return $list;
    }


    public function InsertRencanaKontrol()
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
                //'statuspasienpulang' => $rajal['statuspasienpulang'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatjalan/modalinsertrencanakontrol', $data)
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
                        'referencenumber' => $journalnumber,
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

                    $simpannomorkontrol = new ModelDataSuratKontrolFromRajal;
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



    public function MobileJkn()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('rawatjalan/registermobilejkn', $data);
    }

    public function ambildataMobileJkn()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->ambildatarajalMobileJKn()
            ];
            $msg = [
                'data' => view('rawatjalan/dataregisterrajalMobileJkn', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataMobileJkn()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->search_RegisterRajalMobileJkn($search)
            ];

            $msg = [
                'data' => view('rawatjalan/dataregisterrajalMobileJkn', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printtracer()
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

        return view('cetakan/stickerrajal_tracer', $data);
    }

    public function TracertRajal()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('rawatjalan/registerrajal_tracert', $data);
    }

    public function ambildataTracert()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('rawatjalan/dataregisterrajalTracert', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliTracert()
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

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('rawatjalan/dataregisterrajalTracert', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function UpdateRencanaKontrol()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row_dataSuratKontrolBpjsRajal($id);
            $pasienid = $rajal['pasienid'];
            $dokter = $rajal['doktername'];
            $kodedokter = $rajal['dokter'];

            $maping = $m_icd->get_data_dokter_bpjs($kodedokter);
            $kodedokter_bpjs = $maping['kode_bpjs'];
            $kodepoli = $rajal['poliklinik'];
            $poliKontrol = $rajal['poliklinikname'];
            $carikode = new ModelPasienMaster;
            $kodepolibpjs = $carikode->get_data_poliV2_poli($poliKontrol);

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
                'statuspasienpulang' => '',
                'noSuratKontrol' => $rajal['noSuratKontrol'],
                'kodeDokter' => $rajal['kodeDokter'],
                'namaDokter' => $rajal['namaDokter'],
                'poliKontrol' => $rajal['poliklinik'],
                'namapoliKontrol' => $kodepolibpjs['name'],
                'tglRencanaKontrol' => $rajal['tglRencanaKontrol'],
            ];

            $msg = [
                'suksesmodalsep' => view('rawatjalan/modalupdaterencanakontrol', $data)
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
                    'referencenumber' => $journalnumber,
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

                $simpannomorkontrol = new ModelDataSuratKontrolFromRajal;
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

    public function HapusSuratKontrol()
    {
        if ($this->request->isAJAX()) {

            $noSuratKontrol = $this->request->getVar('noSuratKontrol');
            $datasep['noSuratKontrol'] = $this->request->getVar('noSuratKontrol');
            //$datasep['noSuratKontrol'] = '1020R0010122K000003';

            $datasep['user'] = 'Coba Ws';
            $sep = json_decode($this->delete_surat_kontrol_poli($datasep), true);

            if ($sep['metaData']['code'] != 200) {
                $msg = [
                    'success' => false,
                    'pesan' => $sep['metaData']['message']
                ];
            } else {
                $hapussep = new ModelPasienMaster;
                $carisep = $hapussep->get_data_dataSuratKontrol_rajal($noSuratKontrol);
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

    private function delete_surat_kontrol_poli($param)
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
                'penjaminKLL' => $this->penjaminKL(),
                'Propinsi' => $this->propinsi(),
            ];

            $msg = [
                'suksesbackdate' => view('rawatjalan/modalinputdaftarpasienlamabackdate', $data)
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
                    'label' => 'Nama Poli',
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


                $tglrujukan1 = $this->request->getVar("referencedate");

                $mulai = str_replace('/', '-', $tglrujukan1);
                $tglrujukan = date('Y-m-d', strtotime($mulai));

                $db = db_connect();
                $groups = $this->request->getVar('groups');

                $poliklinikname = $this->request->getVar('poliklinikname');
                $pasienid = $this->request->getVar('pasienid');
                //$documentdate = date('Y-m-d');
                $documentdate = $this->request->getVar("documentdateperjanjian");


                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinikname='$poliklinikname' AND groups='$groups'  LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    //$antrian = $row->noantrian;
                }

                $query2 = $db->query("SELECT  MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinikname='$poliklinikname' AND groups='$groups'  LIMIT 1");

                foreach ($query2->getResult() as $row2) {

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


                $cekregister = new ModelRawatJalanDaftar;
                $cekkodepoli = $cekregister->cek_kode_poli($poliklinikname);
                //$lokasi = $this->request->getVar('poliklinik');
                $lokasi = $cekkodepoli['code'];

                $newkode = $groups . $underscore . $pasienid . $underscore  . $today . $underscore . sprintf('%06s', $nourut);
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

                $cekregister = new ModelRawatJalanDaftar;
                $hasilcek = $cekregister->cek_register_today($pasienid, $poliklinikname, $documentdate);

                $cekdulu = isset($hasilcek['pasienid']) != null ? $hasilcek['pasienid'] : "";

                // Menambah konsul auto di daftar
                $deskripsipoli = $this->request->getVar('poliklinik');
                if (($deskripsipoli == "PL-015") or ($deskripsipoli == "PL-011") or
                    ($deskripsipoli == "PL-026") or ($deskripsipoli == "PL-31") or
                    ($deskripsipoli == "PL-028")
                ) {
                    $cekkonsul = $cekregister->cek_konsul($deskripsipoli);
                } else {
                    $cekkonsul = $cekregister->cek_konsul_lainnya();
                }

                $nama_konsul = $cekkonsul['name'];
                $harga_konsul = $cekkonsul['price'];
                $jasars_konsul = $cekkonsul['share1'];
                $jasajp_konsul = $cekkonsul['share2'];
                $jasadokter_konsul = $cekkonsul['share21'];

                if ($cekdulu == "") {
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
                        'poliklinik' => $lokasi,
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
                        'referencenumber' => $this->request->getVar('noRujukanDaftar'),
                        'noSuratKontrol' => $this->request->getVar('noSuratKontrol'),
                        'noSepAsalKontrol' => $this->request->getVar('noSepAsalKontrol'),
                        'tglSuratKontrol' => $this->request->getVar('tglSuratKontrol'),
                        'perjanjian' => 1,

                        'nama_konsul' => $nama_konsul,
                        'harga_konsul' => $harga_konsul,
                        'jasars_konsul' => $jasars_konsul,
                        'jasajp_konsul' => $jasajp_konsul,
                        'jasadokter_konsul' => $jasadokter_konsul,

                    ];
                    $perawat = new ModelRawatJalanDaftar;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Pendftaran Perjanjian Rawat Jalan Berhasil',
                        'JN' => $newkode,
                    ];
                } else {
                    $msg = [
                        'gagal' => 'Pasien Tersebut sudah didaftarkan pada poli yang sama pada hari ini'
                    ];
                }
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
        return view('cetakan/seprajal', $data);
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
        return view('cetakan/stickerrajal', $data);
    }

    public function HistoriPasienLama()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $resume = new ModelPasienMaster();
            $pasienid = $this->request->getVar('pasienid');
            $m_icd = new ModelPasienMaster();
            $data = [
                'rajal' => $resume->get_data_rajal_kunjungan($pasienid),
                'ranap' => $resume->get_data_ranap_kunjungan_pulang($pasienid),
                'pasienlama' => $m_icd->get_data_pasien_lama($id),
                'penunjang' => $resume->get_data_penunjang_histori($pasienid),
                'obat' => $resume->get_data_obat_histori($pasienid),
            ];

            $msg = [
                'sukseshistori' => view('rawatjalan/modalhistoripasienlama', $data)
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


    public function printRM1()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "INSTALASI RAWAT INAP";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kop_RMK($lokasikasir);
        $row3 = $pasien->get_data_pasien_RM1($id);
        $pasienid = $row3['pasienid'];
        $masterpasien = $pasien->get_data_pasien_master($pasienid);

        $data = [
            'dataopname' => $pasien->get_data_RM1($id),
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
        $html .= view('pdf/print_rm1_rajal', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function RiwayatTindakan()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/registerrajaltindakan', $data);
    }

    public function ambildataRiwayatTindakan()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatarajaltindakan()
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterrajaltindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataRiwayatTindakan()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterRajalTindakan($search)
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterrajaltindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function IGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/registerigd', $data);
    }

    public function ambildataIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildataIGD()
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterigd', $data)
            ];
            echo json_encode($msg);
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

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterIGD($search)
            ];

            $msg = [
                'data' => view('asistendokter/dataregisterigd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RiwayatTindakanIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/registerrajaltindakanigd', $data);
    }

    public function ambildataRiwayatTindakanIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatarajaltindakanIGD()
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterrajaltindakanigd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataRiwayatTindakanIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterRajalTindakanIGD($search)
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterrajaltindakanigd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DPJP()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/registerdpjp', $data);
    }

    public function ambildataDPJP()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildataDPJP()
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterdpjp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterDPJP()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterDPJP($search)
            ];

            $msg = [
                'data' => view('asistendokter/dataregisterdpjp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RiwayatVisite()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/riwayatvisite', $data);
    }

    public function ambildataRiwayatVisite()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatavisite()
            ];
            $msg = [
                'data' => view('asistendokter/datariwayatvisite', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataRiwayatVisite()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_Registervisite($search)
            ];
            $msg = [
                'data' => view('asistendokter/datariwayatvisite', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RiwayatTindakanRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/riwayattindakanranap', $data);
    }

    public function ambildataRiwayatTindakanRanap()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatatindakanranap()
            ];
            $msg = [
                'data' => view('asistendokter/datariwayattindakanranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataRiwayatTindakanRanap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_Registertindakanranap($search)
            ];
            $msg = [
                'data' => view('asistendokter/datariwayattindakanranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function BS()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/riwayattindakanranapBS', $data);
    }

    public function ambildataBS()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatatindakanranapBS()
            ];
            $msg = [
                'data' => view('asistendokter/datariwayattindakanranapBS', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataBS()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegistertindakanranapBS($search)
            ];
            $msg = [
                'data' => view('asistendokter/datariwayattindakanranapBS', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function JadwalBS()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/jadwalBS', $data);
    }

    public function ambildataJadwalBS()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatajadwalBS()
            ];
            $msg = [
                'data' => view('asistendokter/datajadwalBS', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataJadwalBS()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterjadwalBS($search)
            ];
            $msg = [
                'data' => view('asistendokter/datajadwalBS', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Resep()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/Resep', $data);
    }

    public function ambildataResep()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'DetailObat' => $register->search_detail_pelayanan_resep()
            ];
            $msg = [
                'data' => view('asistendokter/dataresep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataResep()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelAsistenDokter();
            $data = [
                'DetailObat' => $register->search_detail_pelayanan_resep_periodik($search)
            ];
            $msg = [
                'data' => view('asistendokter/dataresep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Penunjang()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/penunjang', $data);
    }

    public function ambildataPenunjang()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatapenunjang()
            ];
            $msg = [
                'data' => view('asistendokter/datapenunjang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataPenunjang()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));
            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterPenunjang($search)
            ];
            $msg = [
                'data' => view('asistendokter/datapenunjang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function FKRajal()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/registerrajalfk', $data);
    }

    public function ambildataFKRajal()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatafkrajal()
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterrajalfk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataFKRajal()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterFKRajal($search)
            ];

            $msg = [
                'data' => view('asistendokter/dataregisterrajalfk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function FKIGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/registerigdfk', $data);
    }

    public function ambildataFKIGD()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatafkigd()
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterigdfk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataFKIGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterFKigd($search)
            ];

            $msg = [
                'data' => view('asistendokter/dataregisterigdfk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function FKRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'pilihanpoli' => $this->smf(),
        ];
        return view('asistendokter/registerranapfk', $data);
    }

    public function ambildataFKRanap()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->ambildatafkranap()
            ];
            $msg = [
                'data' => view('asistendokter/dataregisterranapfk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataFKRanap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelAsistenDokter();
            $data = [
                'tampildata' => $register->search_RegisterFKranap($search)
            ];

            $msg = [
                'data' => view('asistendokter/dataregisterranapfk', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

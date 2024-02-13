<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelIGDDaftar;
use App\Models\ModelPasienMaster;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasien;
use App\Models\ModelPasienRanap;
use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;




class JadwalIBS extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('ibs/registerjadwal', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelIGDDaftar();
            $data = [
                'tampildata' => $register->ambildatarajalibs()
            ];
            $msg = [
                'data' => view('ibs/dataregisterjadwal', $data)
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

            $register = new ModelIGDDaftar();
            $data = [
                'tampildata' => $register->search_RegisterRajal_ibs($search)
            ];

            $msg = [
                'data' => view('ibs/dataregisterjadwal', $data)
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
                $tglrujukan = date('Y-m-d', strtotime($this->request->getVar("referencedate")));

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $lokasi = $this->request->getVar('poliklinik');
                $visited = $this->request->getVar('visited');
                $documentdate = date('Y-m-d');
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND groups='$groups'  LIMIT 1");

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
                    'sukses' => 'Pendftaran IGD Berhasil'
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
                $query = $db->query("SELECT MAX(code) as norm FROM pasien WHERE  denicode=0  LIMIT 1");

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

                $normbaru = $inisial . sprintf('%08s', $nourutnorm);


                $groups = $this->request->getVar('groups_baru');
                $lokasi = $this->request->getVar('kodepoliklinik');
                $documentdate = date('Y-m-d');
                $today = date('ymd');
                $underscore = '_';
                $query2 = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND groups='$groups'  LIMIT 1");

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

                $tglrujukan = date('Y-m-d', strtotime($this->request->getVar("tanggalrujukan")));
                $TL = date('Y-m-d', strtotime($this->request->getVar("tanggallahir")));
                $tanggallahir = $this->request->getVar('tanggallahir');
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
                $locationcode_baru = "NONE";

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
                    'placeofbirth' => $this->request->getVar('tanggallahir'),
                    'dateofbirth' => $TL,
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
                    'visited' => $visited,
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
                    'pasiendateofbirth' => $TL,
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
                ];

                $rajal = new ModelRawatJalanDaftar;
                $rajal->insert($postingdata);

                $msg = [
                    'sukses' => 'Pendftaran IGD Berhasil'
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
        $html .= view('pdf/karcisigd', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }
}

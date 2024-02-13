<?php

namespace App\Controllers;

use App\Models\Modelrajal;
use App\Models\Modelibs;
use App\Models\Model_autocomplete;
use App\Models\ModelDaftarRanap;
use App\Models\Model_icd;
use App\Models\ModelDetailibs;
use App\Models\ModelranapOrderRad;
use App\Models\ModelrajalOrderRad;
use App\Models\ModelPasienMaster;
use App\Models\ModelRawatJalanDaftar;
use Config\Services;
use Dompdf\Dompdf;


class RegisterRAD extends BaseController
{

    public function index()
    {

        $data = [
            'metodepembayaran' => $this->metodepembayaran(),
            'list' => $this->_data_dokter(),
            'dokterradiologi' => $this->_data_dokter_radiologi(),
            'kelas' => $this->_data_kelas(),
        ];
        return view('radiologi/datapasien_to_register_rad', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelranapOrderRad();
            $data = [
                'tampildata' => $perawat->ambildatarajal()
            ];
            $msg = [
                'data' => view('radiologi/data_pasien_ranap_to_order_rad', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildatapasienrajal()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelrajalOrderRad();
            $data = [
                'tampildata' => $perawat->ambildatarajal()
            ];
            $msg = [
                'data' => view('radiologi/data_pasien_rajal_to_order_rad', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function formedit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelrajal();
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['referencenumber'],

                'bpjs_sep' => $row['bpjs_sep'],
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
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'datein' => $row['datein'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatinap/modaldaftarranap', $data)
            ];
            echo json_encode($msg);
        }
    }



    public function simpandata()
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

                'email' => [
                    'label' => 'Kontak Email Pasien',
                    'rules' => 'valid_email',
                    'errors' => [
                        'valid_email' => ' {field} tidak sesuai'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'ibsdoktername' => $validation->getError('ibsdoktername'),
                        'email' => $validation->getError('email')
                    ]
                ];
            } else {
                $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));

                $db = db_connect();
                $groups = $this->request->getVar('locationcode');
                $lokasi = "RI";

                $documentdate = date('Y-m-d');


                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_daftar_rawatinap WHERE  documentdate='$documentdate' LIMIT 1");

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

                $newkode = $lokasi . $underscore . $groups . $underscore  . $today . $underscore . sprintf('%06s', $nourut);


                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'types' => $this->request->getVar('types'),
                    'journalnumber' => $newkode,
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'transferjournalnumber' => $this->request->getVar('transferjournalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'bpjs_sep_poli' => $this->request->getVar('bpjs_sep_poli'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                    'noantrian' => $this->request->getVar('noantrian'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'oldcode' => $this->request->getVar('oldcode'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'pasiengender' => $this->request->getVar('pasiengender'),
                    'pasienage' => $this->request->getVar('pasienage'),
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                    'pasienaddress' => $this->request->getVar('pasienaddress'),
                    'pasienarea' => $this->request->getVar('pasienarea'),
                    'pasiensubarea' => $this->request->getVar('pasiensubarea'),
                    'pasiensubareaname' => $this->request->getVar('pasiensubareaname'),
                    'paymentmethod' => $this->request->getVar('paymentmethod'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                    'paymentmethodori' => $this->request->getVar('paymentmethodname'),
                    'paymentmethodnameori' => $this->request->getVar('paymentmethodname'),
                    'paymentcardnumberori' => $this->request->getVar('paymentcardnumber'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokterpoli' => $this->request->getVar('dokterpoli'),
                    'dokterpoliname' => $this->request->getVar('dokterpoliname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'statuspasien' => $this->request->getVar('statuspasien'),
                    'bumil' => $this->request->getVar('bumil'),
                    'lakalantas' => $this->request->getVar('lakalantas'),
                    'lokasilakalantas' => $this->request->getVar('lokasilakalantas'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),
                    'telppjb' => $this->request->getVar('telppjb'),
                    'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                    'pasienclassroom' => $this->request->getVar('classroom'),
                    'dokter' => $this->request->getVar('ibsdokter'),
                    'doktername' => $this->request->getVar('ibsdoktername'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'titipan' => $this->request->getVar('titipan'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'roomfisik' => $this->request->getVar('room'),
                    'roomfisikname' => $this->request->getVar('roomname'),
                    'bednumber' => $this->request->getVar('bednumber'),
                    'bedname' => $this->request->getVar('bedname'),
                    'parentid' => $this->request->getVar('parentid'),
                    'datein' => $this->request->getVar('datein'),
                    'timein' => $this->request->getVar('timein'),
                    'datetimein' => $this->request->getVar('datetimein'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'statusrawatinap' => $this->request->getVar('statusrawatinap'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'memo' => $this->request->getPost('memo'),
                    'email' => $this->request->getPost('email'),
                    'tgl_spr' => $tglspr,
                    'token_ranap' => $this->request->getVar('token_ranap'),


                ];
                $perawat = new ModelDaftarRanap;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Pasien Berhasil didaftarkan di Rawat Inap'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }




    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }

    private function _data_dokter_anestesi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $listdokteranestesi = $m_auto->get_list_dokter_anestesi();
        return $listdokteranestesi;
    }

    public function fill_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_dokter();
        return json_encode($data);
    }

    public function inputdetailibs($page = '')
    {
        $token_ibs = $this->request->getVar('page');
        //var_dump($token_ibs);
        //$token_ibs = 'FyjCBcYx';
        //$id = '21586';
        $db = db_connect();
        $groups_ibs = $db->query("SELECT * FROM list_groups_ibs")->getResult();
        $perawat = new Modelibs();

        $row = $perawat->get_data_token($token_ibs);
        //$row = $perawat->find($id);
        $data = [
            'id' => $row['id'],
            'types' => $row['types'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'documentyear' => $row['documentyear'],
            'documentmonth' => $row['documentmonth'],
            'registernumber' => $row['registernumber'],
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
            'ibsdokter' => $row['ibsdokter'],
            'ibsdoktername' => $row['ibsdoktername'],
            'ibsnurse' => $row['ibsnurse'],
            'ibsnursename' => $row['ibsnursename'],
            'ibsanestesi' => $row['ibsanestesi'],
            'ibsanestesiname' => $row['ibsanestesiname'],
            'ibspenata' => $row['ibspenata'],
            'ibspenataname' => $row['ibspenataname'],
            'cases' => $row['cases'],
            'operatorroom' => $row['operatorroom'],
            'anestesi' => $row['anestesi'],
            'createdby' => $row['createdby'],
            'createddate' => $row['createddate'],
            'icdx' => $row['icdx'],
            'icdxname' => $row['icdxname'],
            'tglspr' => $row['tglspr'],
            'email' => $row['email'],
            'token_ibs' => $row['token_ibs'],
            'memo' => $row['memo'],
            'list' => $this->_data_dokter(),
            'kelompok' => $groups_ibs,



        ];

        echo view('ibs/detail_ibs', $data);
    }


    public function ambildatadetailibs()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelDetailibs();
            //$journalnumber = 'BORT_IBS_200422_000001';
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'tampildata' => $perawat->where('journalnumber', $journalnumber)
                    ->orderBy('documentdate', 'DESC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/data_detail_ibs', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ambildatadetailibs_histori()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelibs();

            $pasienid = $this->request->getVar('pasienid');
            $data = [
                'tampildata' => $perawat->where('pasienid', $pasienid)
                    ->orderBy('documentdate', 'DESC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/data_ibs_histori', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildatadetailibs_histori_tindakan()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelDetailibs();

            $pasienid = $this->request->getVar('pasienid');
            $data = [
                'tampildata' => $perawat->where('relation', $pasienid)
                    ->orderBy('documentdate', 'DESC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/data_ibs_histori_tindakan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function simpandatadetailibs()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'doktername' => [
                    'label' => 'Nama Dokter Operator',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ],
                'name' => [
                    'label' => 'Nama Tindakan Operasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus Diisi!'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername'),
                        'name' => $validation->getError('name')
                    ]
                ];
            } else {
                //$tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));
                //price dan totaltarif sama dari price ori * markup
                //subtotal adalah totaltarif + totalbhp
                //share1 adalah share1ori * markup
                //share2 adalah share2ori *markup
                $cases = $this->request->getVar('operationgroup');
                if ($cases == 'ELEKTIF') {
                    $markup = 0.00;
                } else {
                    $markup = 30.00;
                }

                //$markup = '30';
                $priceoriasli = $this->request->getVar('priceori');
                $tambahanharga = $priceoriasli * ($markup / 100);
                $price = $priceoriasli + $tambahanharga;
                //$price = '2500000';
                $total_bhp = $this->request->getVar('bhpori');
                $totaltarif = $price + $total_bhp;
                //$totaltarif = '4000000';
                //$subtotal = $totaltarif + $total_bhp;
                $subtotal = $totaltarif;
                //$subtotal = '6000000';

                $share1ori = $this->request->getVar('share1ori');
                $share2ori = $this->request->getVar('share2ori');

                $a = $share1ori * $markup;
                $b = $share2ori * $markup;

                $share1 = $share1ori + $a;
                //$share1 = '240000';
                $share2 = $share2ori + $b;
                //$share2 = '300000';

                //var_dump($markup);



                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'relation' => $this->request->getVar('relation'),
                    'relationname' => $this->request->getVar('relationname'),
                    'paymentmethod' => $this->request->getVar('paymentmethod'),
                    'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'doktergeneral' => $this->request->getVar('doktergeneral'),
                    'doktergeneralname' => $this->request->getVar('doktergeneralname'),
                    'registernumber' => $this->request->getVar('registernumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'operationgroup' => $this->request->getVar('operationgroup'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),
                    'category' => $this->request->getVar('category'),
                    'categoryname' => $this->request->getVar('categoryname'),
                    'priceori' => $this->request->getVar('priceori'),
                    'bhpori' => $this->request->getVar('bhpori'),
                    'share1ori' => $this->request->getVar('share1ori'),
                    'share2ori' => $this->request->getVar('share2ori'),
                    'price' => $price,
                    'bhp' => $this->request->getVar('bhpori'),
                    'markup' => $markup,
                    'totaltarif' => $totaltarif,
                    'totalbhp' => $this->request->getVar('bhpori'),
                    'subtotal' => $subtotal,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'share1' => $share1,
                    'share2' => $share2,
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'token_ibs' => $this->request->getVar('token_ibs'),

                ];
                $ibs = new ModelDetailibs;
                //$ibs = new Modelibs;
                $ibs->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Operasi Berhasil Ditambahkan'
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
        // menangkap data yang dikirim dengan method get
        $key = $request->getGet('term');
        //$term = "KLS1";
        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan($term, $key);



        foreach ($data as $row) {
            // menulis ulang array/ mengganti key nama menjadi value
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
                'categoryname' => $row['categoryname']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelDetailibs;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data Perawat Penata dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    private function list_groups_ibs()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $listgroupsibs = $m_auto->get_list_groups_ibs();
        return $listgroupsibs;
    }


    public function formubah()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new Modelibs();
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'types' => $row['types'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'registernumber' => $row['registernumber'],
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
                'ibsdokter' => $row['ibsdokter'],
                'ibsdoktername' => $row['ibsdoktername'],
                'ibsnurse' => $row['ibsnurse'],
                'ibsnursename' => $row['ibsnursename'],
                'ibsanestesi' => $row['ibsanestesi'],
                'ibsanestesiname' => $row['ibsanestesiname'],
                'ibspenata' => $row['ibspenata'],
                'ibspenataname' => $row['ibspenataname'],
                'cases' => $row['cases'],
                'operatorroom' => $row['operatorroom'],
                'anestesi' => $row['anestesi'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tglspr'],
                'email' => $row['email'],
                'token_ibs' => $row['token_ibs'],
                'memo' => $row['memo'],
                'namapjb' => $row['namapjb'],
                'alamatpjb' => $row['alamatpjb'],


            ];
            $msg = [
                'sukses' => view('ibs/modaleditmaster', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $simpandata = [
                'namapjb' => $this->request->getVar('namapjb'),
                'alamatpjb' => $this->request->getVar('alamatpjb'),
                'email' => $this->request->getVar('email'),
                // 'cases' => $this->request->getVar('cases'),
                // 'locationcode' => $this->request->getVar('locationcode'),
                // 'pasienid' => $this->request->getVar('pasienid'),
                // 'documentdate' => $this->request->getVar('documentdate'),
                // 'paymentmethod' => $this->request->getVar('paymentmethod'),
                // 'registernumber' => $this->request->getVar('registernumber'),
                // 'referencenumber' => $this->request->getVar('referencenumber'),
                // 'classroom' => $this->request->getVar('classroom'),
                // 'room' => $this->request->getVar('room'),
                // 'smf' => $this->request->getVar('smf'),


            ];
            $perawat = new Modelibs;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data register pelayanan bedah  Berhasil diupdate'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function lihatdetailibs2($id = '')
    {
        $id = $this->request->getVar('id');
        //echo $id;
        $db = db_connect();
        $groups_ibs = $db->query("SELECT * FROM list_groups_ibs")->getResult();
        $list = $db->query("SELECT * FROM dokter")->getResult();
        $m_icd = new Model_icd($this->request);
        $row = $m_icd->get_data_ibs($id);
        //var_dump($row);

        //$data = $row;


        $data = [
            'id' => $row['id'],
            'types' => $row['types'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'documentyear' => $row['documentyear'],
            'documentmonth' => $row['documentmonth'],
            'registernumber' => $row['registernumber'],
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
            'ibsdokter' => $row['ibsdokter'],
            'ibsdoktername' => $row['ibsdoktername'],
            'ibsnurse' => $row['ibsnurse'],
            'ibsnursename' => $row['ibsnursename'],
            'ibsanestesi' => $row['ibsanestesi'],
            'ibsanestesiname' => $row['ibsanestesiname'],
            'ibspenata' => $row['ibspenata'],
            'ibspenataname' => $row['ibspenataname'],
            'cases' => $row['cases'],
            'operatorroom' => $row['operatorroom'],
            'anestesi' => $row['anestesi'],
            'createdby' => $row['createdby'],
            'createddate' => $row['createddate'],
            'icdx' => $row['icdx'],
            'icdxname' => $row['icdxname'],
            'tglspr' => $row['tglspr'],
            'email' => $row['email'],
            'token_ibs' => $row['token_ibs'],
            'memo' => $row['memo'],
            'list' => $this->_data_dokter(),
            'kelompok' => $groups_ibs,




        ];
        //var_dump($list);
        return view('ibs/detail_ibs', $data);
    }


    public function formlihatEPB($id = '')
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $m_icd = new Model_icd($this->request);
            $head = $m_icd->get_data_ibs($id);
            $row = $m_icd->get_data_edukasibedah($id);
            $data = [
                'id' => $row['id'],
                'journalnumber' => $row['journalnumber'],
                'referencenumber' => $row['referencenumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'roomname' => $row['roomname'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pemberiinformasi' => $row['pemberiinformasi'],
                'penerimainformasi' => $row['penerimainformasi'],
                'ibsdoktername' => $row['ibsdoktername'],
                'ibsanestesiname' => $row['ibsanestesiname'],
                'diagnosis' => $row['diagnosis'],
                'kondisipasien' => $row['kondisipasien'],
                'name' => $row['name'],
                'manfaattindakan' => $row['manfaattindakan'],
                'tatacara' => $row['tatacara'],
                'risikotindakan' => $row['risikotindakan'],
                'komplikasitindakan' => $row['komplikasitindakan'],
                'dampaktindakan' => $row['dampaktindakan'],
                'prognosistindakan' => $row['prognosistindakan'],
                'alternatif' => $row['alternatif'],
                'bilatidakditindak' => $row['bilatidakditindak'],
                'created_at' => $row['created_at'],
                'id_tproh' => $row['id_tproh'],
                'signature' => $row['signature'],
                'paymentmethodname' => $head['paymentmethodname'],
                'doktername' => $head['doktername'],
                'smfname' => $head['smfname'],
            ];
            $msg = [
                'sukses' => view('ibs/modallihatEPB', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function GeneratePDF()
    {
        $id = $this->request->getVar('idbaris');
        $m_icd = new Model_icd($this->request);
        $head = $m_icd->get_data_ibs($id);
        $row = $m_icd->get_data_edukasibedah($id);
        $data = [
            'id' => $row['id'],
            'journalnumber' => $row['journalnumber'],
            'referencenumber' => $row['referencenumber'],
            'pasienid' => $row['pasienid'],
            'pasienname' => $row['pasienname'],
            'pasiengender' => $row['pasiengender'],
            'roomname' => $row['roomname'],
            'pasiendateofbirth' => $row['pasiendateofbirth'],
            'pemberiinformasi' => $row['pemberiinformasi'],
            'penerimainformasi' => $row['penerimainformasi'],
            'ibsdoktername' => $row['ibsdoktername'],
            'ibsanestesiname' => $row['ibsanestesiname'],
            'diagnosis' => $row['diagnosis'],
            'kondisipasien' => $row['kondisipasien'],
            'name' => $row['name'],
            'manfaattindakan' => $row['manfaattindakan'],
            'tatacara' => $row['tatacara'],
            'risikotindakan' => $row['risikotindakan'],
            'komplikasitindakan' => $row['komplikasitindakan'],
            'dampaktindakan' => $row['dampaktindakan'],
            'prognosistindakan' => $row['prognosistindakan'],
            'alternatif' => $row['alternatif'],
            'bilatidakditindak' => $row['bilatidakditindak'],
            'created_at' => $row['created_at'],
            'id_tproh' => $row['id_tproh'],
            'signature' => $row['signature'],
            'paymentmethodname' => $head['paymentmethodname'],
            'doktername' => $head['doktername'],
            'smfname' => $head['smfname'],
        ];
        $html = view('ibs/EBPpdf', $data);

        $filename = $data['journalnumber'];
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream($filename . ".pdf");
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

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_smf();
        return $list;
    }

    public function ajax_kelas()
    {
        $request = Services::request();
        $kelas = $request->getPost('kelas');
        // select list uniq room
        $m_combo_room = new Modelrajal();
        $list['room_name'] = $m_combo_room->get_room_name($kelas);

        echo json_encode($list['room_name']);
    }

    public function ajax_roomname()
    {
        $request = Services::request();
        $room = $request->getPost('room');
        $kelas = $request->getPost('kelas');
        // select room 
        $m_combo_room = new Modelrajal();
        $list['room_list'] = $m_combo_room->get_room_list($room, $kelas);

        echo json_encode($list['room_list']);
    }

    public function metodepembayaran()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_metode_pembayaran();
        return $list;
    }

    private function _data_dokter_radiologi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_rad();
        return $list;
    }

    private function _data_kelas()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_kelas();
        return $list;
    }

    public function caripasiennonRM()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'ip' => $this->request->getIPAddress(),
            ];
            $msg = [
                'data' => view('radiologi/modalcaripasiennonrm', $data)
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
                'data' => view('radiologi/masterdatapasien', $data)
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
                'data' => view('radiologi/masterdatapasien', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DaftarkanPasienLamaNonRM()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $row = $m_icd->get_data_pasien($id);
            $date = date('d-m-Y', strtotime($row['dateofbirth']));
            $data = $row;
            $jenkel = $row['gender'];
            if ($jenkel == "LAKI-LAKI") {
                $kelamin = "L";
            } else {
                $kelamin = "P";
            }
            $data['dateofbirth'] = $date;
            $data['gender'] = $kelamin;
            echo json_encode($data);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function registerpasienbaru()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'cabar' => $this->data_payment(),
                'ip' => $this->request->getIPAddress(),
                'namasmf' => $this->smf(),
                //'list' => $this->_data_dokter_all(),
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
                'metodepembayaran' => $this->metodepembayaran(),
                'list' => $this->_data_dokter(),
                'dokterradiologi' => $this->_data_dokter_radiologi(),
                'kelas' => $this->_data_kelas(),
            ];
            $msg = [
                'data' => view('radiologi/modaldaftarrajalpasienbarurad', $data)
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

    private function _data_dokter_all()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_all();
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

    public function simpandataregisterpasienbaru_rad()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'employeename_baru' => [
                    'label' => 'Nama Dokter Pemeriksa',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'employeename_baru' => $validation->getError('employeename_baru')
                       
                    ]
                ];
            } else {

                $db = db_connect();
                $documentdate = date('Y-m-d');
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

                $normbaru = sprintf('%08s', $nourutnorm);


                $groups = $this->request->getVar('groups_baru');
                $lokasi = $this->request->getVar('kodepoliklinik');
                $namalokasi = $this->request->getVar('namapoliklinik');
                $documentdate = date('Y-m-d');
                $today = date('ymd');
                $underscore = '_';
                $query2 = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(noantrian)as noantrian FROM transaksi_pelayanan_daftar_rawatjalan WHERE  documentdate='$documentdate' AND poliklinikname='$namalokasi' AND groups='$groups'  LIMIT 1");

                foreach ($query2->getResult() as $row2) {
                    $kode = $row2->kode_jurnal;
                  
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
               
                $lokasi = $cekkodepoli['code'];

                $newkode = $groups . $underscore . $normbaru . $underscore  . $today . $underscore . sprintf('%08s', $nourut);


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
                    ];

                    $rajal = new ModelRawatJalanDaftar;
                    $rajal->insert($postingdata);
                

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

}

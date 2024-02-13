<?php

namespace App\Controllers;

use App\Models\Modelrajal;
use App\Models\Modelibs;
use App\Models\Model_autocomplete;
use App\Models\ModelDaftarRanap;
use App\Models\Model_icd;
use App\Models\ModelDetailibs;
use App\Models\ModelRanapOrderRad;
use App\Models\ModelRajalOrderRad2;
use App\Models\ModeligdOrderRad2;
use App\Models\ModelDaftarRadiologi;
use App\Models\ModelranapOrderPenunjang;
use Config\Services;
use Dompdf\Dompdf;


class OrderPendaftaranPA extends BaseController
{




    public function index()
    {

        return view('rawatinap/datapasienrajaligd');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelrajal();
            $data = [
                'tampildata' => $perawat->ambildatarajal()
            ];
            $msg = [
                'data' => view('rawatinap/data_pasien_rajaligd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function order()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new ModelRanapOrderRad();
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
                'namapjb' => $row['namapjb'],
                'alamatpjb' => $row['alamatpjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'telppjb' => $row['telppjb'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'bednumber' => $row['bednumber'],
                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),
                'Radiologi' => $this->_data_pa(),
                'kelompokLab' => $this->kelompokLab(),

            ];
            $msg = [
                'sukses' => view('rawatinap/modalorderdaftarpa', $data)
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

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'ibsdoktername' => $validation->getError('ibsdoktername')
                    ]
                ];
            } else {
                $tgl_order1 = $this->request->getVar("tgl_order");
                $mulai = str_replace('/', '-', $tgl_order1);
                $tgl_order = date('Y-m-d', strtotime($mulai));


                $db = db_connect();
                $visited = $this->request->getVar('visited');
                $lokasi = "LPA";

                $documentdate = date('Y-m-d');


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

                helper('text');
                $token = random_string('alnum', 6);
                $token_reborn = strtoupper($token);

                $newkode = $visited . $underscore . $lokasi . $underscore . $token . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $orderpemeriksaan = $this->request->getPost('orderpemeriksaan');


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'visited' => $this->request->getVar('visited'),
                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'registernumber' => $this->request->getVar('registernumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'registernumber_rawatjalan' => $this->request->getVar('registernumber_rawatjalan'),
                    'registernumber_rawatinap' => $this->request->getVar('registernumber_rawatinap'),
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
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokter' => $this->request->getVar('ibsdokter'),
                    'doktername' => $this->request->getVar('ibsdoktername'),
                    'employee' => $this->request->getVar('employee'),
                    'employeename' => $this->request->getVar('employeename'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'titipan' => $this->request->getVar('titipan'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                    'orderpemeriksaan' => $orderpemeriksaan,
                    'tgl_order' => $tgl_order,
                    'token_radiologi' => $this->request->getPost('token_radiologi'),
                    'memo' => $this->request->getPost('memo'),
                    'note' => $this->request->getPost('note'),
                    'status' => $this->request->getPost('status'),

                ];
                $perawat = new ModelDaftarRadiologi;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Order Pemeriksaan Laboratorium Patologi Anatomi Sudah Dikirimkan',
                    'JN' => $newkode,
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

    private function _data_pa()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_pelayanan_PA();
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

    public function orderparajal()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new ModelRajalOrderRad2();
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
                'datein' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => '',
                'alamatpjb' => '',
                'hubunganpjb' => '',
                'telppjb' => '',
                'classroom' => $row['groups'],
                'classroomname' => $row['poliklinikname'],
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'bednumber' => $row['poliklinik'],
                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),
                'Radiologi' => $this->_data_pa(),
                'kelompokLab' => $this->kelompokLab(),

            ];
            $msg = [
                'sukses' => view('rawatjalan/modalorderdaftarpa_rajal', $data)
            ];
            echo json_encode($msg);
        }
    }



    public function simpandataparajal()
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

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'ibsdoktername' => $validation->getError('ibsdoktername')
                    ]
                ];
            } else {
                $tgl_order1 = $this->request->getVar("tgl_order");
                $mulai = str_replace('/', '-', $tgl_order1);
                $tgl_order = date('Y-m-d', strtotime($mulai));

                $db = db_connect();
                $visited = $this->request->getVar('visited');
                $lokasi = "LPA";

                $documentdate = date('Y-m-d');


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

                helper('text');
                $token3 = random_string('alnum', 4);
                $token_reborn3 = strtoupper($token3);
                
                $newkode = $visited . $underscore . $lokasi . $underscore . $token_reborn3 . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                // $newkode = $visited . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                // $orderpemeriksaan = implode(",", $this->request->getPost('orderpemeriksaan'));
                $orderpemeriksaan = '';


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'visited' => $this->request->getVar('visited'),
                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'registernumber' => $this->request->getVar('registernumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'registernumber_rawatjalan' => $this->request->getVar('registernumber_rawatjalan'),
                    'registernumber_rawatinap' => $this->request->getVar('registernumber_rawatinap'),
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
                    'paymentmethodname' => $this->request->getVar('paymentmethod'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokter' => $this->request->getVar('ibsdokter'),
                    'doktername' => $this->request->getVar('ibsdoktername'),
                    'employee' => $this->request->getVar('employee'),
                    'employeename' => $this->request->getVar('employeename'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'titipan' => $this->request->getVar('titipan'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                    'orderpemeriksaan' => $orderpemeriksaan,
                    'tgl_order' => $tgl_order,
                    'token_radiologi' => $this->request->getPost('token_radiologi'),
                    'memo' => $this->request->getPost('memo'),
                    'note' => $this->request->getPost('note'),
                    'status' => $this->request->getPost('status'),

                ];
                $perawat = new ModelDaftarRadiologi;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Order Pemeriksaan Laboratorium Patologi Anatomi Sudah Dikirimkan',
                    'JN' => $newkode,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function orderpaigd()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new ModeligdOrderRad2();
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
                'datein' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => '',
                'alamatpjb' => '',
                'hubunganpjb' => '',
                'telppjb' => '',
                'classroom' => $row['groups'],
                'classroomname' => $row['poliklinikname'],
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'bednumber' => $row['poliklinik'],
                'list' => $this->_data_dokter_all(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),
                'Radiologi' => $this->_data_pa(),
                'kelompokLab' => $this->kelompokLab(),

            ];
            $msg = [
                'sukses' => view('igd/modalorderdaftarpa_igd', $data)
            ];
            echo json_encode($msg);
        }
    }

    private function _data_dokter_all()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_all();
        return $list;
    }

    private function kelompokLab()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_kelompok_lab_pa();
        return $list;
    }

    public function simpandatapaigd()
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

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'ibsdoktername' => $validation->getError('ibsdoktername')
                    ]
                ];
            } else {
                $tgl_order = date('Y-m-d', strtotime($this->request->getVar("tgl_order")));

                $db = db_connect();
                $visited = $this->request->getVar('visited');
                $lokasi = "LPA";

                $documentdate = date('Y-m-d');


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

                $newkode = $visited . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);

                $orderpemeriksaan = implode(",", $this->request->getPost('orderpemeriksaan'));


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'visited' => $this->request->getVar('visited'),
                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'registernumber' => $this->request->getVar('registernumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'registernumber_rawatjalan' => $this->request->getVar('registernumber_rawatjalan'),
                    'registernumber_rawatinap' => $this->request->getVar('registernumber_rawatinap'),
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
                    'paymentmethodname' => $this->request->getVar('paymentmethod'),
                    'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokter' => $this->request->getVar('ibsdokter'),
                    'doktername' => $this->request->getVar('ibsdoktername'),
                    'employee' => $this->request->getVar('employee'),
                    'employeename' => $this->request->getVar('employeename'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'titipan' => $this->request->getVar('titipan'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                    'orderpemeriksaan' => $orderpemeriksaan,
                    'tgl_order' => $tgl_order,
                    'token_radiologi' => $this->request->getPost('token_radiologi'),
                    'memo' => $this->request->getPost('memo'),
                    'note' => $this->request->getPost('note'),
                    'status' => $this->request->getPost('status'),

                ];
                $perawat = new ModelDaftarRadiologi;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Order Pemeriksaan Laboratorium Patologi Anatomi Sudah Dikirimkan',
                    'JN' => $newkode,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
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
                'koinsiden' => '0',
            ];
            $msg = [
                'data' => view('igd/datapaketLPA', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caripaketRanap()
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
                'data' => view('igd/datapaketLab', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

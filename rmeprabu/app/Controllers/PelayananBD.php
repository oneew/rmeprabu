<?php

namespace App\Controllers;

use App\Models\Modelranap;
use App\Models\Modelibs;
use App\Models\Model_autocomplete;
use App\Models\Model_icd;
use App\Models\ModelDaftarRadiologi;
use App\Models\ModelPasienRanap;
use App\Models\ModelDetailibs;
use App\Models\Modelranapvalidasi;
use App\Models\Modelrajal;
use App\Models\ModelTNODetail;
use App\Models\ModelTNOHeader;
use App\Models\ModelVisiteDetail;
use App\Models\ModelVisiteHeader;
use App\Models\ModelOperasiDetail;
use App\Models\ModelPenunjangDetail;
use App\Models\ModelranapOrderPenunjang;
use Config\Services;
use Dompdf\Dompdf;


class PelayananBD extends BaseController
{

    public function index()
    {

        return view('ibs/datapasienranap');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelranap();
            $data = [
                'tampildata' => $perawat->where('statusrawatinap', 'RAWAT')
                    ->orderBy('documentdate', 'DESC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/data_pasien_ranap', $data)
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

            $perawat = new Modelranap();

            $db = db_connect();

            $perawatpenataibs = $db->query("SELECT * FROM petugas_penunjang WHERE code_ibs=1 ORDER BY name")->getResult();
            $perawatpenataibs2 = $db->query("SELECT * FROM petugas_penunjang WHERE code_ibs=1 ORDER BY name DESC")->getResult();
            $kamarok = $db->query("SELECT * FROM rooms WHERE status=0 ORDER BY kode")->getResult();
            $groups_ibs = $db->query("SELECT * FROM list_groups_ibs")->getResult();
            $teknikanestesi = $db->query("SELECT * FROM teknik_anestesi ORDER BY deskripsi")->getResult();

            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'journalnumber' => $row['journalnumber'],
                'parentjournalnumber' => $row['parentjournalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['referencenumber'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
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
                'namapjb' => $row['namapjb'],
                'alamatpjb' => $row['alamatpjb'],
                'telppjb' => $row['telppjb'],
                'pasienclassroom' => $row['pasienclassroom'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'perawatpenataibs' => $perawatpenataibs,
                'perawatpenataibs2' => $perawatpenataibs2,
                'kamarok' => $kamarok,
                'groups_ibs' => $groups_ibs,
                'teknikanestesi' => $teknikanestesi,
                'list' => $this->_data_dokter(),
                'listdokteranestesi' => $this->_data_dokter_anestesi(),

            ];
            $msg = [
                'sukses' => view('ibs/modaldaftaribs', $data)
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
                    'label' => 'Nama Dokter Operator',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ],
                'ibsanestesiname' => [
                    'label' => 'Nama Dokter Anestesi',
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
                        'ibsanestesiname' => $validation->getError('ibsanestesiname'),
                        'email' => $validation->getError('email')
                    ]
                ];
            } else {
                $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $lokasi = $this->request->getVar('types');

                $documentdate = date('Y-m-d');


                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_operasi_header WHERE groups='$groups' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                //script untuk generate number

                //$kode = 'KSHKHAKHKFHSKAFHKFKSH000000';
                $today = date('ymd');
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }
                //$newkode = sprintf('%06s', $nourut);
                $newkode = $groups . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                //


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'groups' => $this->request->getVar('groups'),
                    //'journalnumber' => $this->request->getVar('journalnumber'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'registernumber' => $this->request->getVar('registernumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
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
                    'dokter' => $this->request->getVar('dokter'),
                    'doktername' => $this->request->getVar('doktername'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'ibsdokter' => $this->request->getVar('ibsdokter'),
                    'ibsdoktername' => $this->request->getVar('ibsdoktername'),
                    'ibsnurse' => $this->request->getVar('ibsnurse'),
                    'ibsnursename' => $this->request->getVar('ibsnursename'),
                    'ibsanestesi' => $this->request->getVar('ibsanestesi'),
                    'ibsanestesiname' => $this->request->getVar('ibsanestesiname'),
                    'ibspenata' => $this->request->getVar('ibspenata'),
                    'ibspenataname' => $this->request->getVar('ibspenataname'),
                    'cases' => $this->request->getVar('cases'),
                    'operatorroom' => $this->request->getVar('operatorroom'),
                    'anestesi' => $this->request->getVar('anestesi'),
                    'validation' => $this->request->getVar('validation'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'memo' => $this->request->getPost('memo'),
                    'email' => $this->request->getPost('email'),
                    'tglspr' => $tglspr,
                    'token_ibs' => $this->request->getVar('token_ibs'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),

                ];
                $perawat = new Modelibs;
                //$ibs = new Modelibs;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Pasien sudah didaftarkan pada pelayanan operasi, silhakan lanjut mengisi detail operasi'
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

    private function _data_dokter_gizi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_gizi();
        return $list;
    }

    private function _data_perawat_askep()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_perawat_askep();
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

    public function inputdetailBD2($id = '')
    {
        $id = $this->request->getVar('id');
        $perawat = new ModelranapOrderPenunjang();
        $row = $perawat->get_data_tokenByID($id);

        $data = [
            'id' => $row['id'],
            'types' => $row['types'],
            'visited' => $row['visited'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'documentyear' => $row['documentyear'],
            'documentmonth' => $row['documentmonth'],
            'registernumber' => $row['registernumber'],
            'referencenumber' => $row['referencenumber'],
            'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
            'registernumber_rawatinap' => $row['registernumber_rawatinap'],
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
            'referencenumberparent' => $row['referencenumberparent'],
            'icdx' => $row['icdx'],
            'icdxname' => $row['icdxname'],
            'parentid' => $row['parentid'],
            'parentname' => $row['parentname'],
            'createdby' => $row['createdby'],
            'createddate' => $row['createddate'],
            'tgl_order' => $row['tgl_order'],
            'memo' => $row['memo'],
            'token_radiologi' => $row['token_radiologi'],
            'orderpemeriksaan' => $row['orderpemeriksaan'],
            'list' => $this->_data_dokter(),
            // 'goldar' => $row['goldar'],
        ];
        echo view('bankdarah/detail_bd', $data);
    }



    public function inputdetailBD($page = '')
    {
        $token_radiologi = $this->request->getVar('page');
        $perawat = new ModelranapOrderPenunjang();
        $row = $perawat->get_data_token($token_radiologi);

        $data = [
            'id' => $row['id'],
            'types' => $row['types'],
            'visited' => $row['visited'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'documentyear' => $row['documentyear'],
            'documentmonth' => $row['documentmonth'],
            'registernumber' => $row['registernumber'],
            'referencenumber' => $row['referencenumber'],
            'registernumber_rawatjalan' => $row['registernumber_rawatjalan'],
            'registernumber_rawatinap' => $row['registernumber_rawatinap'],
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
            'referencenumberparent' => $row['referencenumberparent'],
            'icdx' => $row['icdx'],
            'icdxname' => $row['icdxname'],
            'parentid' => $row['parentid'],
            'parentname' => $row['parentname'],
            'createdby' => $row['createdby'],
            'createddate' => $row['createddate'],
            'tgl_order' => $row['tgl_order'],
            'memo' => $row['memo'],
            'token_radiologi' => $row['token_radiologi'],
            'list' => $this->_data_dokter(),
            'orderpemeriksaan' => $row['orderpemeriksaan'],
            'goldar' => $row['goldar'],
        ];
        echo view('bankdarah/detail_bd', $data);
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

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan($term, $key);



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
                'categoryname' => $row['categoryname']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function ajax_pelayanan_PSN()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan_PSN($term, $key);



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
                'categoryname' => $row['categoryname']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function ajax_pelayanan_Gizi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan_Gizi($term, $key);



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
                'categoryname' => $row['categoryname']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function ajax_pelayanan_Gizi2()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan_Gizi2($term, $key);



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
                'categoryname' => $row['categoryname']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function ajax_pelayanan_visite()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan_visite($term, $key);



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
                'share2ori' => $row['share2']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function ajax_pelayanan_askep()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan_askep($term, $key);



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
                'share2ori' => $row['share2']
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



    public function rincianranap($id = '')
    {
        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_ibs($id);



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


        ];

        return view('rawatinap/detail_rincian_ranap', $data);
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

    public function resume()
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

    public function formubahmaster()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new ModelranapOrderPenunjang();
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
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_order'],
                'token_radiologi' => $row['token_radiologi'],
                'memo' => $row['memo'],
                'status' => $row['status'],
                'datetimein' => $row['documentdate'],
                'list' => $this->_data_dokter(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('bankdarah/modaleditBD', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function AddPemeriksaan()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new ModelranapOrderPenunjang();
            $row = $perawat->find($id);
            $data = [
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
                'list' => $this->_data_dokter(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('bankdarah/modalinputBD', $data)
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

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_smf();
        return $list;
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));
            $simpandata = [
                'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                'dokter' => $this->request->getVar('ibsdokter'),
                'doktername' => $this->request->getVar('ibsdoktername'),
                'memo' => $this->request->getVar('memo'),
                'status' => $this->request->getVar('status'),
            ];
            $perawat = new ModelDaftarRadiologi;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data sudah berhasil diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function simpantindakanranap()
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


    public function TNO()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelranap();
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
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],

                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatinap/modalinputTNO', $data)
            ];
            echo json_encode($msg);
        }
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
                $groups = "TNO";
                $lokasi = $this->request->getVar('room_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_tindakan_header WHERE groups='$groups' AND room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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



                $simpandata = [

                    'groups' => $this->request->getVar('groups_TH'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
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
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),
                    'smf' => $this->request->getVar('smf_TH'),
                    'smfname' => $this->request->getVar('smfname_TH'),
                    'classroom' => $this->request->getVar('classroom_TH'),
                    'classroomname' => $this->request->getVar('classroomname_TH'),
                    'room' => $this->request->getVar('room_TH'),
                    'roomname' => $this->request->getVar('roomname_TH'),
                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent_TH'),
                    'parentid' => $this->request->getVar('parentid_TH'),
                    'parentname' => $this->request->getVar('parentname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelTNOHeader;
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
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),
                    'category' => $this->request->getVar('category'),
                    'categoryname' => $this->request->getVar('categoryname'),
                    'status' => $this->request->getVar('status'),
                    'price' => $price,
                    'bhp' => $this->request->getVar('bhp'),
                    'totaltarif' => $totaltarif,
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $tno = new ModelTNODetail;
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


    public function PSN()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelranap();
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
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],

                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatinap/modalinputPSN', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanPSNheader()
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
                $groups = "PSN";
                $lokasi = $this->request->getVar('room_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_tindakan_header WHERE groups='$groups' AND room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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



                $simpandata = [

                    'groups' => $this->request->getVar('groups_TH'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
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
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),
                    'smf' => $this->request->getVar('smf_TH'),
                    'smfname' => $this->request->getVar('smfname_TH'),
                    'classroom' => $this->request->getVar('classroom_TH'),
                    'classroomname' => $this->request->getVar('classroomname_TH'),
                    'room' => $this->request->getVar('room_TH'),
                    'roomname' => $this->request->getVar('roomname_TH'),
                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent_TH'),
                    'parentid' => $this->request->getVar('parentid_TH'),
                    'parentname' => $this->request->getVar('parentname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelTNOHeader;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Header PSN Berhasil, silahkan isi detail',
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

    public function simpanPSNDetail()
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
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),
                    'category' => $this->request->getVar('category'),
                    'categoryname' => $this->request->getVar('categoryname'),
                    'status' => $this->request->getVar('status'),
                    'price' => $price,
                    'bhp' => $this->request->getVar('bhp'),
                    'totaltarif' => $totaltarif,
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $tno = new ModelTNODetail;
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

    public function APG()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelranap();
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
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],

                'list' => $this->_data_dokter_gizi(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatinap/modalinputAPG', $data)
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
                $groups = "APG";
                $lokasi = $this->request->getVar('room_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_tindakan_header WHERE groups='$groups' AND room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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



                $simpandata = [

                    'groups' => $this->request->getVar('groups_TH'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
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
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),
                    'smf' => $this->request->getVar('smf_TH'),
                    'smfname' => $this->request->getVar('smfname_TH'),
                    'classroom' => $this->request->getVar('classroom_TH'),
                    'classroomname' => $this->request->getVar('classroomname_TH'),
                    'room' => $this->request->getVar('room_TH'),
                    'roomname' => $this->request->getVar('roomname_TH'),
                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent_TH'),
                    'parentid' => $this->request->getVar('parentid_TH'),
                    'parentname' => $this->request->getVar('parentname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelTNOHeader;
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
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),
                    'category' => $this->request->getVar('category'),
                    'categoryname' => $this->request->getVar('categoryname'),
                    'status' => $this->request->getVar('status'),
                    'price' => $price,
                    'bhp' => $this->request->getVar('bhp'),
                    'totaltarif' => $totaltarif,
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $tno = new ModelTNODetail;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Gizi Berhasil Ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function GIZI()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelranap();
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
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],

                'list' => $this->_data_dokter_gizi(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatinap/modalinputGIZI', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function simpanGIZIheader()
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
                $groups = "GIZI";
                $lokasi = $this->request->getVar('room_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_tindakan_header WHERE groups='$groups' AND room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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



                $simpandata = [

                    'groups' => $this->request->getVar('groups_TH'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
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
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),
                    'smf' => $this->request->getVar('smf_TH'),
                    'smfname' => $this->request->getVar('smfname_TH'),
                    'classroom' => $this->request->getVar('classroom_TH'),
                    'classroomname' => $this->request->getVar('classroomname_TH'),
                    'room' => $this->request->getVar('room_TH'),
                    'roomname' => $this->request->getVar('roomname_TH'),
                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent_TH'),
                    'parentid' => $this->request->getVar('parentid_TH'),
                    'parentname' => $this->request->getVar('parentname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelTNOHeader;
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

    public function simpanGIZIDetail()
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
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),
                    'category' => $this->request->getVar('category'),
                    'categoryname' => $this->request->getVar('categoryname'),
                    'status' => $this->request->getVar('status'),
                    'price' => $price,
                    'bhp' => $this->request->getVar('bhp'),
                    'totaltarif' => $totaltarif,
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $tno = new ModelTNODetail;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Tindakan Gizi Berhasil Ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VISITE()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelranap();
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
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],

                'list' => $this->_data_dokter_gizi(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatinap/modalinputVISITE', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanVISITEheader()
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
                $groups = "VD";
                $lokasi = $this->request->getVar('room_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_visite_header WHERE room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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



                $simpandata = [


                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
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
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),
                    'smf' => $this->request->getVar('smf_TH'),
                    'smfname' => $this->request->getVar('smfname_TH'),
                    'classroom' => $this->request->getVar('classroom_TH'),
                    'classroomname' => $this->request->getVar('classroomname_TH'),
                    'room' => $this->request->getVar('room_TH'),
                    'roomname' => $this->request->getVar('roomname_TH'),
                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent_TH'),
                    'parentid' => $this->request->getVar('parentid_TH'),
                    'parentname' => $this->request->getVar('parentname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelVisiteHeader;
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

    public function simpanVISITEDetail()
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

                    'registernumber' => $this->request->getVar('registernumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),


                    'price' => $price,
                    'bhp' => $this->request->getVar('bhp'),
                    'totaltarif' => $totaltarif,
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $tno = new ModelVisiteDetail;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Visite Berhasil Ditambahkan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ASKEP()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelranap();
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
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],

                'list' => $this->_data_perawat_askep(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),

            ];
            $msg = [
                'sukses' => view('rawatinap/modalinputASKESP', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanASKEPheader()
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
                $groups = "VD";
                $lokasi = $this->request->getVar('room_TH');
                $documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_visite_header WHERE room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

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



                $simpandata = [


                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate_TH'),
                    'documentyear' => $this->request->getVar('documentyear_TH'),
                    'documentmonth' => $this->request->getVar('documentmonth_TH'),
                    'registernumber' => $this->request->getVar('registernumber_TH'),
                    'referencenumber' => $this->request->getVar('referencenumber_TH'),
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
                    'dokter' => $this->request->getVar('dokter_TH'),
                    'doktername' => $this->request->getVar('doktername_TH'),
                    'smf' => $this->request->getVar('smf_TH'),
                    'smfname' => $this->request->getVar('smfname_TH'),
                    'classroom' => $this->request->getVar('classroom_TH'),
                    'classroomname' => $this->request->getVar('classroomname_TH'),
                    'room' => $this->request->getVar('room_TH'),
                    'roomname' => $this->request->getVar('roomname_TH'),
                    'locationcode' => $this->request->getVar('locationcode_TH'),
                    'locationname' => $this->request->getVar('locationname_TH'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent_TH'),
                    'parentid' => $this->request->getVar('parentid_TH'),
                    'parentname' => $this->request->getVar('parentname_TH'),
                    'createdby' => $this->request->getVar('createdby_TH'),
                    'createddate' => $this->request->getVar('createddate_TH'),


                ];
                $perawat = new ModelVisiteHeader;
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

    public function simpanASKEPDetail()
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

                    'registernumber' => $this->request->getVar('registernumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'referencenumberparent' => $this->request->getVar('referencenumberparent'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'groups' => $this->request->getVar('groups'),
                    'groupname' => $this->request->getVar('groupname'),


                    'price' => $price,
                    'bhp' => $this->request->getVar('bhp'),
                    'totaltarif' => $totaltarif,
                    'totalbhp' => $totalbhp,
                    'subtotal' => $subtotal,
                    'disc' => $this->request->getVar('disc'),
                    'totaldiscount' => $this->request->getVar('totaldiscount'),
                    'grandtotal' => $this->request->getVar('grandtotal'),
                    'share1' => $this->request->getVar('share1'),
                    'share2' => $this->request->getVar('share2'),
                    'share21' => $this->request->getVar('share21'),
                    'share22' => $this->request->getVar('share22'),
                    'memo' => $this->request->getVar('memo'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $tno = new ModelVisiteDetail;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Visite Berhasil Ditambahkan'
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

            $perawat = new ModelTNODetail();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->search($referencenumber)
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_TNO', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusBD()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelPenunjangDetail;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Tindakan dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function resumeVISITE()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelVisiteDetail();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->search($referencenumber)
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_VISITE', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeAskep()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelVisiteDetail();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->searchAskep($referencenumber)
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_askep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusAskep()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelVisiteDetail;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Visite dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function resumeOperasi()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelOperasiDetail();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->search($referencenumber)
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_operasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function resumeAsupanGizi()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelTNODetail();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->searchAsupanGizi($referencenumber)
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_gizi', $data)
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
                'tampildata' => $perawat->search($referencenumber)
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_penunjang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function resumeGabung()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPenunjangDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'Radiologi' => $resume->searchbyjournalnumber_BD($journalnumber)
            ];
            $msg = [
                'data' => view('bankdarah/data_resume_bd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function historiBD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPenunjangDetail();
            $relation = $this->request->getVar('relation');
            $data = [
                'Radiologi' => $resume->search_histori_BD($relation)
            ];
            $msg = [
                'data' => view('bankdarah/data_histori_bd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ajax_pemeriksaan()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');
        $kelas = $request->getGet('kelas');
        $data = $m_auto->get_list_pemeriksaan_BD($key, $kelas);
        foreach ($data as $row) {
            $json[] = [
                'value' => $row['name'],
                'id' => $row['id'],
                'price' => $row['price'],
                'code' => $row['code'],
                'groups' => $row['groups'],
                'groupname' => $row['groupname'],
                'category' => $row['category'],
                'categoryname' => $row['categoryname'],
                'expertisegroup' => $row['expertisegroup'],
                'bhp' => $row['bhp'],
                'share1' => $row['share1'],
                'share2' => $row['share2']

            ];
        }
        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function resumeexpertise()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPenunjangDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'Radiologi' => $resume->searchbyjournalnumber_BD($journalnumber)
            ];
            $msg = [
                'data' => view('bankdarah/data_resume_expertise_bd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function simpanpemeriksaan()
    {
        if ($this->request->isAJAX()) {
            $types = $this->request->getVar('types');
            $journalnumber = $this->request->getVar('journalnumber');
            $documentdate = $this->request->getVar('documentdate');
            $relation = $this->request->getVar('relation');
            $relationname = $this->request->getVar('relationname');
            $paymentmethod = $this->request->getVar('paymentmethod');
            $paymentmethodname = $this->request->getVar('paymentmethodname');
            $classroom = $this->request->getVar('classroom');
            $classroomname = $this->request->getVar('classroomname');
            $room = $this->request->getVar('room');
            $roomname = $this->request->getVar('roomname');
            $smf = $this->request->getVar('smf');
            $smfname = $this->request->getVar('smfname');
            $dokter = $this->request->getVar('dokter');
            $doktername = $this->request->getVar('doktername');
            $employee = $this->request->getVar('employee');
            $employeename = $this->request->getVar('employeename');
            $registernumber = $this->request->getVar('registernumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $referencenumberparent = $this->request->getVar('referencenumberparent');
            $locationcode = $this->request->getVar('locationcode');
            $code = $this->request->getVar('code');
            $name = $this->request->getVar('name');
            $qty = $this->request->getVar('qty');
            $groups = $this->request->getVar('groups');
            $groupname = $this->request->getVar('groupname');
            $category = $this->request->getVar('category');
            $categoryname = $this->request->getVar('categoryname');
            $price = $this->request->getVar('price');
            $bhp = $this->request->getVar('bhp');
            $totaltarif = $this->request->getVar('price');
            $totalbhp = $this->request->getVar('bhp');

            $subtotal = $totaltarif + $totalbhp;
            $share1 = $this->request->getVar('share1');
            $share2 = $this->request->getVar('share2');
            $memo = $this->request->getVar('memo');
            $expertisegroup = $this->request->getVar('expertisegroup');
            $createdby = $this->request->getVar('createdby');
            $createddate = $this->request->getVar('createddate');


            //$totaltarif = $qty * $price;
            //$totalbhp = $bhp;

            $jmldata =  count($name);
            for ($i = 0; $i < $jmldata; $i++) {

                $radiologi = new ModelPenunjangDetail;
                $radiologi->insert([
                    'types' => $types[$i],
                    'journalnumber' => $journalnumber[$i],
                    'documentdate' => $documentdate[$i],
                    'relation' => $relation[$i],
                    'relationname' => $relationname[$i],
                    'paymentmethod' => $paymentmethod[$i],
                    'paymentmethodname' => $paymentmethodname[$i],
                    'classroom' => $classroom[$i],
                    'classroomname' => $classroomname[$i],
                    'room' => $room[$i],
                    'roomname' => $roomname[$i],
                    'smf' => $smf[$i],
                    'smfname' => $smfname[$i],
                    'dokter' => $dokter[$i],
                    'doktername' => $doktername[$i],
                    'employee' => $employee[$i],
                    'employeename' => $employeename[$i],
                    'registernumber' => $registernumber[$i],
                    'paymentmethod' => $paymentmethod[$i],
                    'referencenumber' => $referencenumber[$i],
                    'referencenumberparent' => $referencenumberparent[$i],
                    'locationcode' => $locationcode[$i],
                    'code' => $code[$i],
                    'name' => $name[$i],
                    'qty' => $qty[$i],
                    'groups' => $groups[$i],
                    'groupname' => $groupname[$i],
                    'category' => $category[$i],
                    'categoryname' => $categoryname[$i],
                    'price' => $price[$i],
                    'bhp' => $bhp[$i],
                    'totaltarif' => $totaltarif[$i],
                    'totalbhp' => $totalbhp[$i],
                    'subtotal' => $subtotal[$i],
                    'share1' => $share1[$i],
                    'memo' => $memo[$i],
                    'expertisegroup' => $expertisegroup[$i],
                    'createdby' => $createdby[$i],
                    'createddate' => $createddate[$i],
                ]);
            }

            $msg = [
                'sukses' => "$jmldata Pemeriksaan Bank Darah Sudah ditambahkan"
            ];
            echo json_encode($msg);
        }
    }

    public function CreateExpertise()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new ModelPenunjangDetail();
            $row = $perawat->find($id);
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
                'list' => $this->_data_dokter(),
            ];
            $msg = [
                'sukses' => view('bankdarah/modalexpertisebd', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function AddPemeriksaanPaket()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelranapOrderPenunjang();
            $row = $perawat->find($id);
            $data = [
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
                'list' => $this->_data_dokter(),
                'namasmf' => $this->smf(),
                'kelompokLab' => $this->kelompokLab(),
                'goldar' => $row['goldar'],

            ];
            $msg = [
                'sukses' => view('bankdarah/modalinputPaketBD', $data)
            ];
            echo json_encode($msg);
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
            $row = $perawat->find($id);
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
                'tampildata' => $m_auto->get_list_pemeriksaan_BD_paket($kelompokLab, $classroom),
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
                'datetimein' => $row['documentdate'],
                'goldar' => $row['goldar'],

            ];
            $msg = [
                'data' => view('bankdarah/datapaketBD', $data)
            ];
            echo json_encode($msg);
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
                        // 'goldar' => $data[48],
                    ];
                }
                $radiologi = new ModelPenunjangDetail;
                $radiologi->insertBatch($new_data);
                $msg = [
                    'sukses' => "Pemeriksaan Bank Darah Sudah ditambahkan"
                ];
            } else {
                $msg = [
                    'gagal' => "Pemeriksaan Belum Dipilih"
                ];
            }
            echo json_encode($msg);
        }
    }

    private function kelompokLab()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_kelompok_BD();
        return $list;
    }


    public function hapusHeaderBD()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelDaftarRadiologi;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data Header Penunjang : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }


    public function tambahitemBD()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $m_icd = new ModelPenunjangDetail();
            $row = $m_icd->get_data_tokenbyID($id);

            $data = [
                'id' => $row['id'],
                'name' => $row['name'],
                'qty' => $row['qty'],
                'price' => $row['price'],
                'bhp' => $row['bhp'],

            ];
            $msg = [
                'sukses' => view('bankdarah/modalinputTambahBD', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function simpanTambahBD()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar("id");
            $qty = $this->request->getVar("qty");
            $price = $this->request->getVar("price");
            $bhp = $this->request->getVar("bhp");

            $totaltarif = $qty * $price;
            $totalbhp = $qty * $bhp;
            $subtotal = $totaltarif + $totalbhp;
            $simpandata = [
                'qty' => $qty,
                'totaltarif' => $totaltarif,
                'totalbhp' => $totalbhp,
                'subtotal' => $subtotal,

            ];
            $perawat = new ModelPenunjangDetail;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data sudah berhasil diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

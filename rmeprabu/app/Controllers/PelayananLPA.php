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
use App\Models\ModelPenunjangExpertiseLPA;
use App\Models\ModelPinjamExpertiseLPA;
use App\Models\ModelPasienMaster;
use Config\Services;
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\FontMetrics;


class PelayananLPA extends BaseController
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }




    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_pa();
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
        $data = $m_auto->get_list_pelayanan_PA();
        return json_encode($data);
    }

    public function inputdetailLPA2($id = '')
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
            'status_pemeriksaan' => $row['status_periksa'],
        ];
        return view('patologianatomi/detail_lpa', $data);
    }



    public function inputdetailLPA($page = '')
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
            'status_pemeriksaan' => $row['status_periksa'],
        ];
        return view('patologianatomi/detail_lpa', $data);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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

            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
                'sukses' => view('patologianatomi/modaleditLPA', $data)
            ];
            return json_encode($msg);
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
                'sukses' => view('patologianatomi/modalinputLPA', $data)
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

            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusLPA()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelPenunjangDetail;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Pemeriksaan dengan ID : $id Berhasil dihapus"
            ];

            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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

            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
            return json_encode($msg);
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
                'Radiologi' => $resume->searchbyjournalnumberLPA($journalnumber)
            ];
            $msg = [
                'data' => view('patologianatomi/data_resume_LPA', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function historiLPA()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPenunjangDetail();
            $relation = $this->request->getVar('relation');
            $data = [
                'Radiologi' => $resume->search_histori_LPA($relation)
            ];
            $msg = [
                'data' => view('patologianatomi/data_histori_LPA', $data)
            ];
            return json_encode($msg);
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
        $data = $m_auto->get_list_pemeriksaan_LPA($key, $kelas);
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
                'Radiologi' => $resume->searchbyjournalnumberLPA($journalnumber)
            ];
            $msg = [
                'data' => view('patologianatomi/data_resume_expertise_LPA', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function simpanpemeriksaan()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $visited = $this->request->getVar('visited');
            $lokasi = "LPA";
            $expertise = "EXP";

            $documentdate = date('Y-m-d');


            $query = $db->query("SELECT MAX(expertiseid) as kode_expertise FROM transaksi_pelayanan_penunjang_detail WHERE  documentdate='$documentdate' AND types='LPA' ORDER BY id DESC LIMIT 1");

            foreach ($query->getResult() as $row) {
                $kode = $row->kode_expertise;
            }


            $today = date('ymd');
            $underscore = '_';

            if ($kode == "") {
                $nourut = '000001';
            } else {
                $nourut = (int) substr($kode, -6, 6);
                $nourut++;
            }

            $expertise = $expertise . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);

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
            $expertiseid = $expertise;
            $pacsnumber = $expertise;


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
                    'expertiseid' => $expertiseid,
                    'pacsnumber' => $expertiseid,
                ]);
            }

            $msg = [
                'sukses' => "$jmldata Pemeriksaan Patologi Anatomi Sudah ditambahkan"
            ];
            return json_encode($msg);
        }
    }

    public function CreateExpertise()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $perawat = new ModelPenunjangDetail();
            $row = $perawat->find($id);

            $tno = new ModelPenunjangExpertiseLPA;
            $data_exp=  $tno->orderBy('id', 'DESC')
                        ->where('id_penunjang_detail', $row['id'])
                        ->first();

            $data = [
                'data_pasien' => $row,
                'list' => $this->_data_dokter(),
                'data_expertise' => $data_exp,
            ];


            return json_encode([
                'sukses' => view('patologianatomi/modalexpertiseLPA', $data)
            ]);
        }else{
            exit('Tidak dapat di proses');
        }
    }


    public function simpanExpertise()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $validation->setRule('makroskopis', 'makroskopis', 'required|min_length[3]');
            $validation->setRule('mikroskopis', 'mikroskopis', 'required|min_length[3]');
            $validation->setRule('kesan', 'kesan', 'required|min_length[3]');

            $perawat = new ModelPenunjangExpertiseLPA();

            $data_exp = $perawat->orderBy('id', 'DESC')
                        ->where('id_penunjang_detail', $this->request->getVar('id_detail'))
                        ->first();

            $dokter = explode('|', $this->request->getVar('employee'));

            if ($validation->run($this->request->getVar())) {
                if ($data_exp == null) {
                    try {
                        $perawat->insert([
                            'id_penunjang_detail' => $this->request->getVar('id_detail'),
                            'makroskopis' => nl2br($this->request->getVar('makroskopis')),
                            'mikroskopis' => nl2br($this->request->getVar('mikroskopis')),
                            'kesan' => nl2br($this->request->getVar('kesan')),
                            'employee' => $dokter[0],
                            'employeename' => $dokter[1],
                            'created_by' => session()->get('firstname'),
                        ]);
                        return json_encode([
                            'sukses' => 'Data expertise LPA berhasil di tambahkan'
                        ]);
                    } catch (\Throwable $th) {
                        return json_encode([
                            'error' => 'Data expertise LPA gagal di tambahkan'
                        ]);
                    }
                } else {
                    try {
                        $perawat->update($data_exp['id'],[
                            'makroskopis' => nl2br($this->request->getVar('makroskopis')),
                            'mikroskopis' => nl2br($this->request->getVar('mikroskopis')),
                            'kesan' => nl2br($this->request->getVar('kesan')),
                            'employee' => $dokter[0],
                            'employeename' => $dokter[1],
                            'updated_at' => date('Y-m-d H:i:s'),
                            'updated_by' => session()->get('firstname')
                        ]);
                        return json_encode([
                            'sukses' => 'Data expertise LPA berhasil di perbarui'
                        ]);
                    } catch (\Throwable $th) {
                        return json_encode([
                            'error' => 'Data expertise LPA gagal di perbarui'
                        ]);
                    }
                }
                
            }else{
                return json_encode([
                    'error' =>  'Pastikan makroskopis, mikroskopis, kesan terisi !!'
                ]);
            }

        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printexpertise()
    {
        $lokasikasir = "INSTALASI LABORATORIUM PATOLOGI ANATOMI";
        
        $pasien = new ModelPasienRanap($this->request);
        $perawat = new ModelPenunjangExpertiseLPA();
        $data = $perawat
                ->select('transaksi_pelayanan_penunjang_expertise_lpa.id,
                transaksi_pelayanan_penunjang_expertise_lpa.id_penunjang_detail,
                transaksi_pelayanan_penunjang_expertise_lpa.makroskopis,
                transaksi_pelayanan_penunjang_expertise_lpa.mikroskopis,
                transaksi_pelayanan_penunjang_expertise_lpa.kesan,
                transaksi_pelayanan_penunjang_expertise_lpa.created_at,
                transaksi_pelayanan_penunjang_detail.journalnumber,
                transaksi_pelayanan_penunjang_detail.documentdate,
                transaksi_pelayanan_penunjang_detail.relation,
                transaksi_pelayanan_penunjang_detail.paymentmethodname,
                transaksi_pelayanan_penunjang_expertise_lpa.employeename,
                transaksi_pelayanan_penunjang_detail.doktername,
                pasien.code,
                pasien.name,
                pasien.gender,
                pasien.dateofbirth,
                pasien.mobilephone')
                ->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.id=transaksi_pelayanan_penunjang_expertise_lpa.id_penunjang_detail')
                ->join('pasien', 'pasien.code=transaksi_pelayanan_penunjang_detail.relation')
                ->orderBy('transaksi_pelayanan_penunjang_expertise_lpa.id', 'DESC')
                ->where('transaksi_pelayanan_penunjang_expertise_lpa.id_penunjang_detail', $this->request->getVar('page'))
                ->first();

        $data = [
            'kop' => $pasien->get_data_expertise_lpa($lokasikasir),
            'data' => $data
        ];

        return view('pdf/expertise_lpa', $data);
    }

    public function PinjamFotoLPA()
    {
        if ($this->request->isAJAX()) {
            $expertiseid = $this->request->getVar('expertiseid');
            $m_icd = new ModelPenunjangDetail();

            $detail = $m_icd->get_expertise($expertiseid);
            $journalnumber = $detail['journalnumber'];
            $header = $m_icd->get_expertise_header($journalnumber);

            $data = [
                'pasienlama' => $m_icd->get_expertise_pinjam_lpa($expertiseid),
                'tanggallahir' => $header['pasiendateofbirth'],
                'jeniskelamin' => $header['pasiengender'],
                'alamat' => $header['pasienaddress'],
                'nokartu' => $header['paymentcardnumber'],
                'unit' => $this->unitpeminjam(),
            ];

            $msg = [
                'sukses' => view('patologianatomi/modalpinjamfotoLPA', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function unitpeminjam()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_unit();
        return $list;
    }


    public function simpandataPinjam()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'peminjamname' => [
                    'label' => 'Nama Peminjam',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'peminjamname' => $validation->getError('peminjamname')
                    ]
                ];
            } else {
                $pinjam = $this->request->getVar('pinjamdate');
                $tanggalpinjam = str_replace('/', '-', $pinjam);
                $tglpinjam = date('Y-m-d', strtotime($tanggalpinjam));
                $simpandata = [
                    'expertiseid' => $this->request->getVar('expertisepinjam'),
                    'pinjamdate' => $tglpinjam,
                    'asalpeminjam' => $this->request->getVar('asalpeminjam'),
                    'peminjamname' => $this->request->getVar('peminjamname'),
                    'statuspinjam' => $this->request->getVar('statuspinjam'),
                    'created_by' => $this->request->getVar('createdby'),
                ];
                $tno = new ModelPinjamExpertiseLPA;
                $tno->insert($simpandata);
                $msg = [
                    'sukses' => 'Peminjaman Foto/ Expertise berhasil disimpan'
                ];
            }
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function HistoriPinjam()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPasienMaster();
            $expertiseid = $this->request->getVar('expertiseid');
            $data = [
                'kunjungan' => $resume->get_data_pinjam_expertise_lpa($expertiseid),
            ];

            $msg = [
                'data' => view('patologianatomi/data_histori_pinjam_expertise', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusPinjam()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelPinjamExpertiseLPA;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Pinjam dengan ID : $id Berhasil dihapus"
            ];

            return json_encode($msg);
        }
    }

    public function Pengembalian()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPenunjangDetail();

            $data = [
                'pinjam' => $m_icd->get_expertise_kembali_lpa($id),

            ];
            $msg = [
                'suksesmodal' => view('patologianatomi/modalpengembalianfoto', $data)
            ];
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandatakembali()
    {
        if ($this->request->isAJAX()) {
            $kembali = $this->request->getVar('kembalidate');
            $tanggalkembali = str_replace('/', '-', $kembali);
            $tglkembali = date('Y-m-d', strtotime($tanggalkembali));


            $statuspinjam = $this->request->getVar('statuspinjam');
            $pengembaliname = $this->request->getVar('pengembaliname');
            if ($statuspinjam == 1) {
                $tglkembali = $tglkembali;
                $pengembaliname = $pengembaliname;
            } else {
                $tglkembali = '';
                $pengembaliname = '';
            }
            $simpandata = [
                'kembalidate' => $tglkembali,
                'updated_by' => $this->request->getVar('updatedby'),
                'pengembaliname' => $pengembaliname,
                'statuspinjam' => $this->request->getVar('statuspinjam'),
                'pacsnumber' => $this->request->getVar('expertisepinjam'),
            ];
            $perawat = new ModelPinjamExpertiseLPA;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Status sudah diperbaharui'
            ];

            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function ViewExpertise()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelPenunjangDetail();
            $row = $perawat->find($id);
            $expertiseid = $row['expertiseid'];

            $hasilperiksa = $perawat->search_expertise_lpa($expertiseid);
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
                'expertiseid' => $row['expertiseid'],
                'pacsnumber' => $row['pacsnumber'],
                'expertiseidhasil' => isset($hasilperiksa['expertiseid']) != null ? $hasilperiksa['expertiseid'] : "",
                'pacsnumberhasil' => isset($hasilperiksa['pacsnumber']) != null ? $hasilperiksa['pacsnumber'] : "",
                'expertise' => isset($hasilperiksa['expertise']) != null ? $hasilperiksa['expertise'] : "",
                'fotoradiologi' => isset($hasilperiksa['fotoradiologi']) != null ? $hasilperiksa['fotoradiologi'] : null,
                'lokasiorgan' => isset($hasilperiksa['lokasiorgan']) != null ? $hasilperiksa['lokasiorgan'] : "",
                'makroskopis' => isset($hasilperiksa['makroskopis']) != null ? $hasilperiksa['makroskopis'] : "",
                'mikroskopis' => isset($hasilperiksa['mikroskopis']) != null ? $hasilperiksa['mikroskopis'] : "",
                'catatan' => isset($hasilperiksa['catatan']) != null ? $hasilperiksa['catatan'] : "",
                'saran' => isset($hasilperiksa['saran']) != null ? $hasilperiksa['saran'] : "",

            ];
            $msg = [
                'sukses' => view('rawatinap/modalexpertiseLPA_view', $data)
            ];
            return json_encode($msg);
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

            ];
            $msg = [
                'sukses' => view('patologianatomi/modalinputPaketLPA', $data)
            ];
            return json_encode($msg);
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
                'data' => view('patologiklinik/datapaketLab', $data)
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


                    $bhp = $data[29];
                    $price = $data[28];
                    $totaltarif = $bhp + $price;
                    $totalbhp = $bhp;
                    $subtotal = $totaltarif;

                    // var_dump($bhp);
                    // var_dump($price);
                    // var_dump($totaltarif);
                    // var_dump($subtotal);

                    // die();
                    $new_data[$i] = [
                        'types' => $data[0],
                        'journalnumber' => $data[1],
                        'documentdate' => $data[2],
                        'relation' => $data[3],
                        'relationname' => $data[4],
                        'paymentmethod' => $data[5],
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
                        //'bhp' => $data[29],
                        'totaltarif' => $totaltarif,
                        'totalbhp' => $totalbhp,
                        'subtotal' => $subtotal,
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
                        //'bhp' => $data[48],
                        'bhp' => 0,
                        'totalbhp' => 0,

                    ];
                }
                $radiologi = new ModelPenunjangDetail;
                $radiologi->insertBatch($new_data);
                $msg = [
                    'sukses' => "Pemeriksaan Patologi Klinik Sudah ditambahkan"
                ];
            } else {
                $msg = [
                    'gagal' => "Pemeriksaan Belum Dipilih"
                ];
            }
            return json_encode($msg);
        }
    }

    private function kelompokLab()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_kelompok_lab_pa();
        return $list;
    }

    public function CreateExpertisePap()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $perawat = new ModelPenunjangDetail();
            $row = $perawat->find($id);

            $tno = new ModelPenunjangExpertiseLPA;
            $data_exp=  $tno->orderBy('id', 'DESC')
                        ->where('id_penunjang_detail', $row['id'])
                        ->first();

            $data = [
                'data_pasien' => $row,
                'list' => $this->_data_dokter(),
                'kelainan_sitologis' => $data_exp['kelainan_sitologis'] ?? null,
                'kualitas_smear' => $data_exp['kualitas_smear'] ?? null,
                'interpretasi' => $data_exp['interpretasi'] ?? null,
                'endocervix' => $data_exp['endocervix'] ?? null,
                'reaktif' => $data_exp['reaktif'] ?? null,
                'infeksi' => $data_exp['infeksi'] ?? null,
                'evaluasi' => $data_exp['evaluasi'] ?? null,
                'asc_data' => $data_exp['asc_data'] ?? null,
                'lis' => $data_exp['lis'] ?? null,
                'ssc' => $data_exp['ssc'] ?? null,
                'nos' => $data_exp['nos'] ?? null,
                'atipik' => $data_exp['atipik'] ?? null,
                'ais' => $data_exp['ais'] ?? null,
                'adenocarcinoma' => $data_exp['adenocarcinoma'] ?? null,
                'kesimpulan' => $data_exp['kesimpulan'] ?? null,
                'saran' => $data_exp['saran'] ?? null,
                'employee' => $data_exp['employee'] ?? null
            ];


            return json_encode([
                'sukses' => view('patologianatomi/modalexpertiseLPA_pap', $data)
            ]);
        }else{
            exit('Tidak dapat di proses');
        }
    }

    public function simpanExpertisePap()
    {
        if ($this->request->isAJAX()) {
            $perawat = new ModelPenunjangExpertiseLPA();

            $data_exp = $perawat->orderBy('id', 'DESC')
                        ->where('id_penunjang_detail', $this->request->getVar('id_detail'))
                        ->first();
            $dokter = explode('|', $this->request->getVar('employee'));

            $simpandata = [
                'groups' => $this->request->getVar('groups'),
                'kelainan_sitologis' => $this->request->getVar('kelainan_sitologis'),
                'kualitas_smear' => $this->request->getVar('kualitas_smear'),
                'interpretasi' => $this->request->getVar('interpretasi'),
                'endocervix' => $this->request->getVar('endocervix'),
                'reaktif' => $this->request->getVar('reaktif'),
                'infeksi' => $this->request->getVar('infeksi'),
                'evaluasi' => $this->request->getVar('evaluasi'),
                'asc_data' => $this->request->getVar('asc_data'),
                'lis' => $this->request->getVar('lis'),
                'ssc' => $this->request->getVar('ssc'),
                'nos' => $this->request->getVar('nos'),
                'atipik' => $this->request->getVar('atipik'),
                'ais' => $this->request->getVar('ais'),
                'adenocarcinoma' => $this->request->getVar('adenocarcinoma'),
                'kesimpulan' => nl2br($this->request->getVar('kesimpulan')),
                'saran' => nl2br($this->request->getVar('saran')),
                'employee' => $dokter[0],
                'employeename' => $dokter[1],
            ];

            try {
                if ($data_exp == null) {
                    $perawat->insert(array_merge(
                        [
                            'id_penunjang_detail' => $this->request->getVar('id_detail'),
                            'created_by' => session()->get('firstname'),
                        ],
                        $simpandata
                    ));
                } else {
                    $perawat->update($data_exp['id'],
                        array_merge(
                            [
                                'updated_at' => date('Y-m-d H:i:s'),
                                'updated_by' => session()->get('firstname')
                            ],
                            $simpandata
                        )
                    );
                }
                
                return json_encode([
                    'sukses' => 'Data expertise LPA berhasil di tambahkan'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Data expertise LPA gagal di tambahkan'
                ]);
            }

        } else {
            exit('tidak dapat diproses');
        }
    }

    public function print_expertise_pap()
    {
        $lokasikasir = "INSTALASI LABORATORIUM PATOLOGI ANATOMI";
        
        $pasien = new ModelPasienRanap($this->request);
        $perawat = new ModelPenunjangExpertiseLPA();
        $data = $perawat
                ->select('
                        transaksi_pelayanan_penunjang_expertise_lpa.id,
                        transaksi_pelayanan_penunjang_expertise_lpa.kelainan_sitologis,
                        transaksi_pelayanan_penunjang_expertise_lpa.kualitas_smear,
                        transaksi_pelayanan_penunjang_expertise_lpa.interpretasi,
                        transaksi_pelayanan_penunjang_expertise_lpa.endocervix,
                        transaksi_pelayanan_penunjang_expertise_lpa.reaktif,
                        transaksi_pelayanan_penunjang_expertise_lpa.infeksi,
                        transaksi_pelayanan_penunjang_expertise_lpa.evaluasi,
                        transaksi_pelayanan_penunjang_expertise_lpa.asc_data,
                        transaksi_pelayanan_penunjang_expertise_lpa.lis,
                        transaksi_pelayanan_penunjang_expertise_lpa.ssc,
                        transaksi_pelayanan_penunjang_expertise_lpa.nos,
                        transaksi_pelayanan_penunjang_expertise_lpa.atipik,
                        transaksi_pelayanan_penunjang_expertise_lpa.ais,
                        transaksi_pelayanan_penunjang_expertise_lpa.adenocarcinoma,
                        transaksi_pelayanan_penunjang_expertise_lpa.kesimpulan,
                        transaksi_pelayanan_penunjang_expertise_lpa.saran,
                        transaksi_pelayanan_penunjang_expertise_lpa.created_at,
                        transaksi_pelayanan_penunjang_expertise_lpa.employeename,
                        transaksi_pelayanan_penunjang_detail.journalnumber,
                        transaksi_pelayanan_penunjang_detail.documentdate,
                        transaksi_pelayanan_penunjang_detail.relation,
                        transaksi_pelayanan_penunjang_detail.paymentmethodname,
                        transaksi_pelayanan_penunjang_detail.doktername,
                        pasien.code,
                        pasien.name,
                        pasien.gender,
                        pasien.dateofbirth,
                        pasien.mobilephone
                ')
                ->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.id=transaksi_pelayanan_penunjang_expertise_lpa.id_penunjang_detail')
                ->join('pasien', 'pasien.code=transaksi_pelayanan_penunjang_detail.relation')
                ->orderBy('transaksi_pelayanan_penunjang_expertise_lpa.id', 'DESC')
                ->where('transaksi_pelayanan_penunjang_expertise_lpa.id_penunjang_detail', $this->request->getVar('page'))
                ->first();

        $data = [
            'kop' => $pasien->get_data_expertise_lpa($lokasikasir),
            'data' => $data
        ];

        return view('pdf/expertise_lpa_pap', $data);
    }
}

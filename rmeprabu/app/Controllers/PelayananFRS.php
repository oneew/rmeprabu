<?php

namespace App\Controllers;

use App\Models\Modelranap;
use App\Models\Modelibs;
use App\Models\Model_autocomplete;
use App\Models\Model_icd;
use App\Models\ModelDaftarRadiologi;
use App\Models\ModelPasienRanap;
use App\Models\ModelDetailibs;
use App\Models\Modelrajal;
use App\Models\ModelTNODetail;
use App\Models\ModelTNOHeader;
use App\Models\ModelVisiteDetail;
use App\Models\ModelVisiteHeader;
use App\Models\ModelOperasiDetail;
use App\Models\ModelPenunjangDetail;
use App\Models\ModelranapOrderPenunjang;
use App\Models\ModelDaftarAmbulance;
use App\Models\ModelDaftarforensik;
use App\Models\ModelDaftarSuratKematian;
use Config\Services;
use Dompdf\Dompdf;
use Dompdf\Options;


class PelayananFRS extends BaseController
{


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

    private function _data_dokter_forensik()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_forensik();
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

    public function inputdetailFRS($page = '')
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
            'ambulance' => $perawat->get_data_admission_forensik($token_radiologi),
        ];
        echo view('forensik/detail_frs', $data);
    }

    public function inputdetailFRS2($id = '')
    {
        $id = $this->request->getVar('id');
        $perawat = new ModelranapOrderPenunjang();
        $row = $perawat->get_data_tokenbyID($id);
        $journalnumber = $row['journalnumber'];

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
            'ambulance' => $perawat->get_data_admission_forensik_journalnumber($journalnumber),
        ];
        echo view('forensik/detail_frs', $data);
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
            $groups = 'FRS';
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
                'listdokter' => $this->_data_dokter_penunjang($groups),
                'employee' => $row['employee'],
                'employeename' => $row['employeename'],

            ];
            $msg = [
                'sukses' => view('forensik/modaleditFRS', $data)
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
                'sukses' => view('forensik/modalinputFRS', $data)
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

    public function penyebabkematian()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_penyebab_kematian();
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
                'employee' => $this->request->getVar('dokter'),
                'employeename' => $this->request->getVar('doktername'),
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

    public function hapusFRS()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelPenunjangDetail;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Pelayanan dengan ID : $id Berhasil dihapus"
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
                'Radiologi' => $resume->searchbyjournalnumber_FRS($journalnumber)
            ];
            $msg = [
                'data' => view('forensik/data_resume_frs', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function mobil()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_mobil();
        return $list;
    }

    public function supir()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_supir();
        return $list;
    }

    public function admission()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPenunjangDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $row = $resume->search_header_ambulance($journalnumber);
            $data = [
                'ambulance' => $resume->searchadmission($journalnumber),
                'alamatpasien' => $row['pasienaddress'],
                'pasienarea' => $row['pasienarea'],
                'mobil' => $this->mobil(),
                'supir' => $this->supir(),
            ];
            $msg = [
                'data' => view('ambulance/form_admission', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function historiABL()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelPenunjangDetail();
            $relation = $this->request->getVar('relation');
            $data = [
                'ambulance' => $resume->search_histori_ABL($relation)
            ];
            $msg = [
                'data' => view('ambulance/data_histori_abl', $data)
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
        $data = $m_auto->get_list_pemeriksaan_FRS($key);
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
                $pemeriksaan = $this->request->getVar('name');
                $namapemeriksaan = $pemeriksaan[$i];
                if (($namapemeriksaan == "PERAWATAN JENAZAH ANAK DAN BALITA") or ($namapemeriksaan == "PERAWATAN JENAZAH MUSLIM DEWASA") or ($namapemeriksaan == "PERAWATAN JENAZAH NON MUSLIM")) {
                    $simpandata_forensik = [
                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'pasienid' => $this->request->getVar('relation'),
                        'pasienname' => $this->request->getVar('relationname'),
                    ];
                    $forensik = new ModelDaftarSuratKematian;
                    $forensik->insert($simpandata_forensik);
                }
            }


            $msg = [
                'sukses' => "$jmldata Pelayanan Forensik ditambahkan"
            ];
            echo json_encode($msg);
        }
    }



    public function printbuktisuratkematian()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "INSTALASI FORENSIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_kop_kematian_forensik($lokasikasir);

        $data = [
            'datapasien' => $pasien->data_surat_kematian($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_surat_kematian', $data);
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

    public function printbuktiVisum()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "INSTALASI FORENSIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_kop_visum_forensik($lokasikasir);

        $data = [
            'datapasien' => $pasien->data_surat_visum($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_VER', $data);
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

    public function CreateExpertise()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $journalnumber = $this->request->getVar('journalnumber');
            $perawat = new ModelranapOrderPenunjang();
            $row = $perawat->get_data_FRS($journalnumber);

            $data = [
                'id' => $row['id'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'referencenumber' => $row['referencenumber'],
                'relation' => $row['pasienid'],
                'relationname' => $row['pasienname'],
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
                'list' => $this->_data_dokter(),
                'dokterforensik' => $this->_data_dokter_forensik(),
                'forensik' => $perawat->get_data_admission_FRS_journalnumber($journalnumber),
            ];
            $msg = [
                'sukses' => view('forensik/modalexpertisevisum', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpan_expertise()
    {
        if ($this->request->isAJAX()) {



            $simpandata = [
                'anamnesis' => nl2br($this->request->getVar('anamnesis')),
                'dokter_forensik' => $this->request->getVar('dokter_forensik'),
                'nip_dokter_forensik' => $this->request->getVar('nip_dokter_forensik'),
                'suhutubuh' => $this->request->getVar('suhutubuh'),
                'pernapasan' => $this->request->getVar('pernapasan'),
                'kesadaran' => $this->request->getVar('kesadaran'),
                'pakaian' => $this->request->getVar('pakaian'),
                'tekanandarah' => $this->request->getVar('tekanandarah'),
                'denyutnadi' => $this->request->getVar('denyutnadi'),
                'tinggibadan' => $this->request->getVar('tinggibadan'),
                'beratbadan' => $this->request->getVar('beratbadan'),
                'cirikhusus' => $this->request->getVar('cirikhusus'),
                'kepala' => $this->request->getVar('kepala'),
                'leher' => $this->request->getVar('leher'),
                'bahu' => $this->request->getVar('bahu'),
                'dada' => $this->request->getVar('dada'),
                'punggung' => $this->request->getVar('punggung'),
                'perut' => $this->request->getVar('perut'),
                'pinggang' => $this->request->getVar('pinggang'),
                'bokong' => $this->request->getVar('bokong'),
                'dubur' => $this->request->getVar('dubur'),
                'alatkelamin' => $this->request->getVar('alatkelamin'),
                'anggota_gerak_atas' => nl2br($this->request->getVar('anggota_gerak_atas')),
                'anggota_gerak_bawah' => nl2br($this->request->getVar('anggota_gerak_bawah')),
                'penunjang_lab' => $this->request->getVar('penunjang_lab'),
                'penunjang_radiologi' => $this->request->getVar('penunjang_radiologi'),
                'penunjang_odontogram' => $this->request->getVar('penunjang_odontogram'),
                'penunjang_lain' => $this->request->getVar('penunjang_lain'),
                'ringkasan_pemeriksaan' => nl2br($this->request->getVar('ringkasan_pemeriksaan')),
                'icd' => $this->request->getVar('icd'),
                'penyebab_A1' => $this->request->getVar('penyebab_a1'),
                'penyebab_A2' => $this->request->getVar('penyebab_a2'),
                'penyebab_mendasari' => nl2br($this->request->getVar('penyebab_mendasari')),
                'b_1' => $this->request->getVar('b_1'),
                'b_2' => $this->request->getVar('b_2'),
                'b_n' => $this->request->getVar('b_n'),
                'pengobatan_tindakan' => $this->request->getVar('pengobatan_tindakan'),
                'prognosis' => $this->request->getVar('prognosis'),
                'kesimpulan' => nl2br($this->request->getVar('kesimpulan')),
                'updatedby' => $this->request->getVar('updatedby'),
                'dokter_signature' => $this->request->getVar('signature'),
                'lampiran_klinis' => $this->request->getVar('lampiran_klinis'),
                'lampiran_toksikologi' => $this->request->getVar('lampiran_toksikologi'),
                'lampiran_histopatologi' => $this->request->getVar('lampiran_histopatologi'),
                'lampiran_foto' => $this->request->getVar('lampiran_foto'),
                'lampiran_video' => $this->request->getVar('lampiran_video'),
                'lampiran_lain' => $this->request->getVar('lampiran_lain'),

            ];
            $perawat = new ModelDaftarforensik;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Expertise Visum Sudah Berhasil Disimpan'
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CreateSuratKematian()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $journalnumber = $this->request->getVar('journalnumber');
            $perawat = new ModelranapOrderPenunjang();
            $row = $perawat->get_data_FRS($journalnumber);
            $pasienid = $row['pasienid'];
            $rowpasien = $perawat->get_data_pasien($pasienid);

            $tanggallahir = $rowpasien['dateofbirth'];
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

            $data = [
                'id' => $row['id'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'referencenumber' => $row['referencenumber'],
                'relation' => $row['pasienid'],
                'relationname' => $row['pasienname'],
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
                'list' => $this->_data_dokter(),
                'dokterforensik' => $this->_data_dokter_forensik(),
                'forensik' => $perawat->get_data_admission_surat_kematian_journalnumber($journalnumber),
                'pasienaddress' => $rowpasien['address'],
                'nik' => $rowpasien['ssn'],
                'pasiengender' => $row['pasiengender'],
                'umur' => $umur,
                'pasiendateofbirth' => $rowpasien['dateofbirth'],
                'placeofbirth' => $rowpasien['placeofbirth'],
                'agama' => $rowpasien['religion'],
                'kelurahan' => $rowpasien['subdistrict'],
                'kecamatan' => $rowpasien['district'],
                'kabupatenkota' => $rowpasien['city'],
                'propinsi' => $rowpasien['provinsi'],
                'citizenship' => $rowpasien['citizenship'],
                'HPJB' => $this->hubunganpjb(),
                'sebabmati' => $this->penyebabkematian(),
            ];

            $msg = [
                'sukses' => view('forensik/modalsuratkematian', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function update_suratkematian()
    {
        if ($this->request->isAJAX()) {
            $tglmeninggal = date('Y-m-d', strtotime($this->request->getVar("datedie")));
            $tglperiksa = date('Y-m-d', strtotime($this->request->getVar("date_periksa")));
            $simpandata = [
                'placeofbirth' => $this->request->getVar('placeofbirth'),
                'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                'umur' => $this->request->getVar('umur'),
                'agama' => $this->request->getVar('agama'),
                'alamat' => $this->request->getVar('alamat'),
                'kelurahan' => $this->request->getVar('kelurahan'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kabupatenkota' => $this->request->getVar('kabupatenkota'),
                'propinsi' => $this->request->getVar('propinsi'),
                'nik' => $this->request->getVar('nik'),
                'wna' => $this->request->getVar('wna'),
                'hubungan_dengan_pjb' => $this->request->getVar('hubungan_dengan_pjb'),
                'documentdate' => $this->request->getVar('documentdate'),
                'datedie' => $tglmeninggal,
                'timedie' => $this->request->getVar('timedie'),
                'locationdie' => $this->request->getVar('locationdie'),
                'status_jenazah' => $this->request->getVar('status_jenazah'),
                'dokter_forensik' => $this->request->getVar('dokter_forensik'),
                'nip_dokter_forensik' => $this->request->getVar('nip_dokter_forensik'),
                'date_periksa' => $tglperiksa,
                'time_periksa' => $this->request->getVar('time_periksa'),
                'dasar_rm' => $this->request->getVar('dasar_rm'),
                'dasar_pemeriksaan_luar' => $this->request->getVar('dasar_pemeriksaan_luar'),
                'dasar_autopsi_forensik' => $this->request->getVar('dasar_autopsi_forensik'),
                'dasar_autopsi_medis' => $this->request->getVar('dasar_autopsi_medis'),
                'dasar_autopsi_verbal' => $this->request->getVar('dasar_autopsi_verbal'),
                'dasar_lain' => $this->request->getVar('dasar_lain'),
                'penyebab_kematian' => $this->request->getVar('penyebab_kematian'),
                'updatedby' => $this->request->getVar('updatedby'),
                'dokter_signature' => $this->request->getVar('signature'),
            ];
            $surat = new ModelDaftarSuratKematian;
            $id = $this->request->getVar('id');
            $surat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Sertifikat kematian sudah berhasil disimpan'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printbuktiVisumIgd()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "INSTALASI FORENSIK";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_kop_visum_forensik($lokasikasir);

        $data = [
            'datapasien' => $pasien->data_surat_visum_igd($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_visum_hidup', $data);
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

    private function _data_dokter_penunjang($groups)
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_penunjang($groups);
        return $list;
    }
}

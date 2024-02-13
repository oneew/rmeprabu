<?php

namespace App\Controllers;

use App\Models\Modelranap;
use App\Models\Modelibs;
use App\Models\Model_autocomplete;
use App\Models\Model_icd;
use App\Models\ModelDetailibs;
use App\Models\ModelEdukasi;
use App\Models\Modelpasienranap;
use App\Models\ModelDataSepRanap;
use Config\Services;
use Dompdf\Dompdf;


class IBSAKHPCL extends BaseController
{
    public function index()
    {
        return view('ibs/datapasienranap');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelranap();
            $status = ['RAWAT', 'PULANG'];
            $data = [
                'tampildata' => $perawat->whereIn('statusrawatinap', $status)
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
                'email' => $row['email'],
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

                $tanggalspr = $this->request->getVar('tglspr');
                $spr = str_replace('/', '-', $tanggalspr);
                $tglao = date('Y-m-d', strtotime($spr));


                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $lokasi = $this->request->getVar('types');

                $pasienid = $this->request->getVar('pasienid');

                $documentdate = $tglao;


                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_operasi_header WHERE groups='$groups' AND documentdate='$documentdate' order by id desc LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }

                $today = date('ymd', strtotime($documentdate));
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }
                $newkode = $groups . $underscore . $lokasi . $underscore . $pasienid . $underscore . $today . $underscore . sprintf('%06s', $nourut);


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $documentdate,
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
                    'tglspr' => $tglao,
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
        $db = db_connect();
        $groups_ibs = $db->query("SELECT * FROM list_groups_ibs")->getResult();
        $perawat = new Modelibs();
        $row = $perawat->get_data_token($token_ibs);
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

                $koinsiden = $this->request->getVar('koinsiden2');
                if ($koinsiden == 1) {
                    $koinsiden = 1;
                } else {
                    $koinsiden = 0;
                }


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
                    'koinsiden' => $koinsiden,

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
        $data = $m_auto->get_list_pelayanan_IBS($term, $key);

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

    public function ajax_pelayanan_ibs()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan_IBS45($term, $key);

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
        $db = db_connect();
        $groups_ibs = $db->query("SELECT * FROM list_groups_ibs")->getResult();
        $list = $db->query("SELECT * FROM dokter")->getResult();
        $m_icd = new Model_icd($this->request);
        $row = $m_icd->get_data_ibs($id);



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
        return view('ibs/detail_ibs_akhp_cl', $data);
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

        $lokasikasir = "INSTALASI BEDAH SENTRAL";
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_edukasi_bedah($lokasikasir);

        $data = [
            'datapasien' => $pasien->edukasibedah($id),
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

            'header1' => $row2['header1'],
            'unit' => $row2['kelompok'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];
        $html = view('pdf/stylebootstrap');

        $html .= view('pdf/edukasiprabedah', $data);

        $filename = $data['journalnumber'];
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream($filename . ".pdf");
    }

    public function forminformconcent()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $perawat = new Modelibs();
            $row = $perawat->find($id);
            $journalnumber = $row['journalnumber'];
            $pasien = new ModelPasienRanap($this->request);
            $data = [
                'edukasi' => $pasien->get_edukasibedah($journalnumber),
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
                'sukses' => view('ibs/modalinformconcent', $data)
            ];
            echo json_encode($msg);
        }
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

                $tglSep = $sep->response->sep->tglSep;
                $pelayanan = 'IRI';
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
            'cons_id' => '9606',
            'secret_key' => '2aH65269D3',
            'base_url' => 'https://new-api.bpjs-kesehatan.go.id:8080',
            'service_name' => 'new-vclaim-rest'

        ];
        return $vclaim_conf;
    }

    private function insert_sep($param)
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
}

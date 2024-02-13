<?php

namespace App\Controllers;

use App\Models\Modelranap;
use App\Models\Modelibs;
use App\Models\Model_autocomplete;
use App\Models\Model_icd;
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
use App\Models\ModelPulangRanap;
use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\ModelPindahRanap;
use App\Models\ModelDaftarRanap;
use App\Models\Modellogactivity;

use CodeIgniter\HTTP\Request;



use Config\Services;
use Dompdf\Dompdf;
use GuzzleHttp\Client;


class PelayananRanap extends BaseController
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
                'classroom' => $row['pasienclassroom'],
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

    private function data_paramedic($roomname)
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_paramedic_ranap($roomname);
        return $list;
    }

    private function data_paramedic_nutrisi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_paramedic_nutrisi();
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
        $list = $m_auto->get_list_perawat_askep2();
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
                    'pasienclassroom' => $this->request->getVar('classroom'),
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
        $nomor_id = $this->request->getVar('nomor_id');
        $cek_kelas = $m_auto->get_cek_ranap($nomor_id);
        $hak_kelas = $cek_kelas['pasienclassroom'];
        $titipan = $cek_kelas['titipan'];
        if ($titipan == 'YA') {
            $term = $hak_kelas;
        } else {
            $term = $term;
        }



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

        $nomor_id = $this->request->getVar('nomor_id');
        $cek_kelas = $m_auto->get_cek_ranap($nomor_id);
        $hak_kelas = $cek_kelas['pasienclassroom'];
        $titipan = $cek_kelas['titipan'];
        if ($titipan == 'YA') {
            $term = $hak_kelas;
        } else {
            $term = $term;
        }

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
        $nomor_id = $this->request->getVar('nomor_id');
        $cek_kelas = $m_auto->get_cek_ranap($nomor_id);
        $hak_kelas = $cek_kelas['pasienclassroom'];
        $titipan = $cek_kelas['titipan'];
        if ($titipan == 'YA') {
            $term = $hak_kelas;
        } else {
            $term = $term;
        }
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
        $nomor_id = $this->request->getVar('nomor_id');
        $cek_kelas = $m_auto->get_cek_ranap($nomor_id);
        $hak_kelas = $cek_kelas['pasienclassroom'];
        $titipan = $cek_kelas['titipan'];
        if ($titipan == 'YA') {
            $term = $hak_kelas;
        } else {
            $term = $term;
        }

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
        $nomor_id = $this->request->getVar('nomor_id');
        $cek_kelas = $m_auto->get_cek_ranap($nomor_id);
        $hak_kelas = $cek_kelas['pasienclassroom'];
        $titipan = $cek_kelas['titipan'];
        if ($titipan == 'YA') {
            $term = $hak_kelas;
        } else {
            $term = $term;
        }
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
                'classroom' => $row['pasienclassroom'],
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
            'statusrawatinap' => $row['statusrawatinap'],
            'pasienclassroom' => $row['pasienclassroom'],
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
            $perawat = new Modelranapvalidasi();
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
                'classroom' => $row['pasienclassroom'],
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
                'tglspr' => $row['tgl_spr'],
                'email' => $row['email'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'namapjb' => $row['namapjb'],
                'alamatpjb' => $row['alamatpjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'datetimein' => $row['datetimein'],
                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bedranap(),
                'namasmf' => $this->smf(),
                'covid' => $row['covid'],
                'koinsiden' => $row['koinsiden'],

            ];
            $msg = [
                'sukses' => view('rawatinap/modaleditranap', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function pulangpasien()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new Modelranapvalidasi();
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],

                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'pasienid' => $row['pasienid'],
                'oldcode' => $row['oldcode'],
                'parentjournalnumber' => $row['parentjournalnumber'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'bpjs_sep' => $row['bpjs_sep'],
                'noantrian' => $row['noantrian'],

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
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'pasienclassroom' => $row['pasienclassroom'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],

                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'bumil' => $row['bumil'],
                'titipan' => $row['titipan'],
                'memo' => $row['memo'],
                'datein' => $row['datein'],
                'datetimein' => $row['datetimein'],
                'timein' => $row['timein'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'pasienclassroomchangenumber' => $row['pasienclassroomchangenumber'],
                'paymentchange' => $row['paymentchange'],
                'paymentchangenumber' => $row['paymentchangenumber'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_spr'],
                // 'email' => $row['email'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'namapjb' => $row['namapjb'],
                'alamatpjb' => $row['alamatpjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'datetimein' => $row['datetimein'],
                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),
                'statuspulang' => $this->statuspulang(),
                'alasanaps' => $this->alasanaps(),
                'koinsiden' => $row['koinsiden'],
            ];
            $msg = [
                'sukses' => view('rawatinap/modalpulangranap', $data)
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

    public function bedranap()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_bed_ranap();
        return $list;
    }

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_smf();
        return $list;
    }

    public function statuspulang()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_statuspulang();
        return $list;
    }

    public function alasanaps()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_APS();
        return $list;
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));
            $simpandata = [
                'namapjb' => $this->request->getVar('namapjb'),
                'alamatpjb' => $this->request->getVar('alamatpjb'),
                'telppjb' => $this->request->getVar('telppjb'),
                //'email' => $this->request->getVar('email'),
                'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                'pasienaddress' => $this->request->getVar('pasienaddress'),

                'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                'smfname' => $this->request->getVar('smfname'),
                'smf' => $this->request->getVar('smf'),
                'dokter' => $this->request->getVar('ibsdokter'),
                'doktername' => $this->request->getVar('ibsdoktername'),
                //'email' => $this->request->getVar('email'),
                'memo' => $this->request->getVar('memo'),
                'covid' => $this->request->getVar('covid'),
                'koinsiden' => $this->request->getVar('koinsiden'),
                'classroom' => $this->request->getVar('classroom'),
                'classroomname' => $this->request->getVar('classroomname'),
                'pasienclassroom' => $this->request->getVar('classroom'),
                'room' => $this->request->getVar('room'),
                'roomname' => $this->request->getVar('roomname'),
                'bednumber' => $this->request->getVar('bednumber'),
            ];
            $perawat = new Modelranapvalidasi;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data pasien sudah berhasil diubah'
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
            $namaruangan = $row['roomname'];
            $ruangan = explode(" ", $namaruangan);
            $roomname = $ruangan[0];

            //    var_dump($roomname);
            //  die();

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
                'paramedic' => $this->data_paramedic($roomname),
                'titipan' => $row['titipan'],

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

                $tanggalpelayanan = $this->request->getVar('documentdate_TH');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $db = db_connect();
                $groups = "TNO";
                $lokasi = $this->request->getVar('room_TH');
                //$documentdate = date('Y-m-d');
                $new_era = "RBN";

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(numberseq) as antrian  FROM transaksi_pelayanan_rawatinap_tindakan_header WHERE groups='$groups' AND room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->antrian;
                }


                //$today = date('ymd');
                $today = date('ymd', strtotime($tanggalpelayanan));
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                $numberseq = $antrian + 1;
                helper('text');
                $token3 = random_string('alnum', 6);
                $token_reborn3 = strtoupper($token3);

                $newkode = $groups . $underscore . $lokasi . $underscore .  $token_reborn3 . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                //$newkode = $new_era. $underscore. $groups . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $dokter = $this->request->getVar('dokter_TH');
                $doktername = $this->request->getVar('doktername_TH');
                $tglmasukpelayanan = $this->request->getVar('tglmasuk_TH');
                $hariini = date('Y-m-d');

                // if ($documentdate < $tglmasukpelayanan) {
                //     $msg = [
                //         'pesan' => 'Tanggal Pelayanan Tidak Boleh Lebih Kecil Dari Tanggal Masuk Perawatan',
                //         'gagal' => true,

                //     ];
                // } else 
                if ($documentdate > $hariini) {
                    $msg = [
                        'pesan' => 'Tanggal  Pelayanan Tidak Boleh Lebih Besar Dari Tanggal Sekarang',
                        'gagal' => true,

                    ];
                } else {

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
                        'numberseq' => $numberseq,


                    ];
                    $perawat = new ModelTNOHeader;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Silahkan isi detail',
                        'JN' => $newkode,
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'tanggalpelayanan' => $documentdate,
                    ];
                }
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

                $pelaksana = $this->request->getVar('pelaksana2');
                if ($pelaksana == 1) {
                    $pelaksana = "Paramedis";
                } else {
                    $pelaksana = "Dokter";
                }


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
                    'pelaksana' => $pelaksana,
                    'paramedicName' => $this->request->getVar('paramedicName'),
                    'koinsiden' => $koinsiden,

                ];
                $tno = new ModelTNODetail;
                $tno->insert($simpandata);

                $norm = $this->request->getVar('relation');
                $aktifitas = $this->request->getVar('name');
                $datalog_activity = [
                    'firstname' => session()->get('firstname'),
                    'lastname' => session()->get('lastname'),
                    'email' => session()->get('email'),
                    'level' => session()->get('level'),
                    'locationname' => session()->get('locationname'),
                    'locationcode' => session()->get('locationcode'),
                    'dateactivity' => date('Y-m-d'),
                    'datetimeactivity' => date('Y-m-d G:i:s'),
                    'ip' => $this->request->getIPAddress(),
                    'activity' => 'Input Tindakan ' . $aktifitas . ' Pada pasien ' . $norm,
                    'pasienid' => $this->request->getVar('relation'),
                    'menu' => ' Rawat Inap [entri Tindakan Ranap]',

                ];

                $catat = new Modellogactivity;
                $catat->insert($datalog_activity);

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
            $namaruangan = $row['roomname'];
            $ruangan = explode(" ", $namaruangan);
            $roomname = $ruangan[0];
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
                'paramedic' => $this->data_paramedic($roomname),
                'titipan' => $row['titipan'],

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
                $tanggalpelayanan = $this->request->getVar('documentdate_TH');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));


                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_tindakan_header WHERE groups='$groups' AND room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }


                //$today = date('ymd');
                $today = date('ymd', strtotime($tanggalpelayanan));
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
                $tglmasukpelayanan = $this->request->getVar('tglmasuk_TH');

                $hariini = date('Y-m-d');

                // if ($documentdate < $tglmasukpelayanan) {
                //     $msg = [
                //         'pesan' => 'Tanggal Pelayanan Tidak Boleh Lebih Kecil Dari Tanggal Masuk Perawatan',
                //         'gagal' => true,

                //     ];
                // } else 
                if ($documentdate > $hariini) {
                    $msg = [
                        'pesan' => 'Tanggal  Pelayanan Tidak Boleh Lebih Besar Dari Tanggal Sekarang',
                        'gagal' => true,

                    ];
                } else {

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
                        'tanggalpelayanan' => $documentdate,
                    ];
                }
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
                    //'paramedicName' => $this->request->getVar('paramedicName'),
                    //'koinsiden' => $koinsiden,

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
                'paramedic' => $this->data_paramedic_nutrisi(),
                'bednumber' => $row['bednumber'],
                'titipan' => $row['titipan'],

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
                $tanggalpelayanan = $this->request->getVar('documentdate_TH');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));


                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_tindakan_header WHERE groups='$groups' AND room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }




                $today = date('ymd', strtotime($tanggalpelayanan));
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }
                $groups = "RAPG";
                $newkode = $groups . $underscore . $lokasi . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $dokter = $this->request->getVar('dokter_TH');
                $doktername = $this->request->getVar('doktername_TH');
                $tglmasukpelayanan = $this->request->getVar('tglmasuk_TH');
                $hariini = date('Y-m-d');

                // if ($documentdate < $tglmasukpelayanan) {
                //     $msg = [
                //         'pesan' => 'Tanggal Pelayanan Tidak Boleh Lebih Kecil Dari Tanggal Masuk Perawatan',
                //         'gagal' => true,

                //     ];
                // } else 
                if ($documentdate > $hariini) {
                    $msg = [
                        'pesan' => 'Tanggal  Pelayanan Tidak Boleh Lebih Besar Dari Tanggal Sekarang',
                        'gagal' => true,

                    ];
                } else {


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
                        'tanggalpelayanan' => $documentdate,
                    ];
                }
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
                    'ahli_gizi' => $this->request->getVar('paramedicName'),
                    'koinsiden' => $koinsiden,
                    'bed_gizi' => $this->request->getVar('bed_gizi'),

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
                'paramedic' => $this->data_paramedic_nutrisi(),
                'bednumber' => $row['bednumber'],
                'titipan' => $row['titipan'],

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
                $tanggalpelayanan = $this->request->getVar('documentdate_TH');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_tindakan_header WHERE groups='$groups' AND room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }


                $today = date('ymd', strtotime($tanggalpelayanan));
                $underscore = '_';

                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                $pasien = $this->request->getVar('pasienid_TH');
                helper('text');
                $token3 = random_string('alnum', 6);
                $token_reborn3 = strtoupper($token3);
                $newkode = $groups . $underscore . $lokasi . $underscore . $token_reborn3 . $underscore . $today . $underscore . $pasien . $underscore . sprintf('%06s', $nourut);
                $dokter = $this->request->getVar('dokter_TH');
                $doktername = $this->request->getVar('doktername_TH');

                $tglmasukpelayanan = $this->request->getVar('tglmasuk_TH');
                $hariini = date('Y-m-d');

                // if ($documentdate < $tglmasukpelayanan) {
                //     $msg = [
                //         'pesan' => 'Tanggal Pelayanan Tidak Boleh Lebih Kecil Dari Tanggal Masuk Perawatan',
                //         'gagal' => true,

                //     ];
                // } else 
                if ($documentdate > $hariini) {
                    $msg = [
                        'pesan' => 'Tanggal  Pelayanan Tidak Boleh Lebih Besar Dari Tanggal Sekarang',
                        'gagal' => true,

                    ];
                } else {
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
                        'bed_gizi' => $this->request->getVar('bed_gizi'),


                    ];
                    $perawat = new ModelTNOHeader;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Tambah Header Berhasil, silahkan isi detail',
                        'JN' => $newkode,
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'tanggalpelayanan' => $documentdate,
                    ];
                }
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
                    'koinsiden' => $koinsiden,
                    'ahli_gizi' => $this->request->getVar('paramedicName'),
                    'koinsiden' => $koinsiden,
                    'bed_gizi' => $this->request->getVar('bed_gizi'),
                    'waktu' => $this->request->getVar('waktu'),

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
                'titipan' => $row['titipan'],

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
                $tanggalpelayanan = $this->request->getVar('documentdate_TH');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $db = db_connect();
                $groups = "VD";
                $lokasi = $this->request->getVar('room_TH');
                //$documentdate = date('Y-m-d');

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_visite_header WHERE room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }


                //$today = date('ymd');
                $today = date('ymd', strtotime($tanggalpelayanan));
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
                $tglmasukpelayanan = $this->request->getVar('tglmasuk_TH');
                $hariini = date('Y-m-d');

                // if ($documentdate < $tglmasukpelayanan) {
                //     $msg = [
                //         'pesan' => 'Tanggal Pelayanan Tidak Boleh Lebih Kecil Dari Tanggal Masuk Perawatan',
                //         'gagal' => true,

                //     ];
                // } else 
                if ($documentdate > $hariini) {
                    $msg = [
                        'pesan' => 'Tanggal  Pelayanan Tidak Boleh Lebih Besar Dari Tanggal Sekarang',
                        'gagal' => true,

                    ];
                } else {

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
                        'tanggalpelayanan' => $documentdate,
                    ];
                }
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

                $koinsiden = $this->request->getVar('koinsiden2');
                if ($koinsiden == 1) {
                    $koinsiden = 1;
                } else {
                    $koinsiden = 0;
                }

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
                    // 'koinsiden' => $koinsiden,

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
            $namaruangan = $row['roomname'];
            $ruangan = explode(" ", $namaruangan);
            $roomname = $ruangan[0];
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
                'paramedic' => $this->data_paramedic($roomname),
                'apoteker' => $this->_data_apoteker(),
                'titipan' => $row['titipan'],

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
                $tanggalpelayanan = $this->request->getVar('documentdate_TH');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal FROM transaksi_pelayanan_rawatinap_visite_header WHERE room='$lokasi' AND documentdate='$documentdate' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                }


                //$today = date('ymd');
                $today = date('ymd', strtotime($tanggalpelayanan));
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

                $tglmasukpelayanan = $this->request->getVar('tglmasuk_TH');
                $hariini = date('Y-m-d');

                // if ($documentdate < $tglmasukpelayanan) {
                //     $msg = [
                //         'pesan' => 'Tanggal Pelayanan Tidak Boleh Lebih Kecil Dari Tanggal Masuk Perawatan',
                //         'gagal' => true,

                //     ];
                // } else 
                if ($documentdate > $hariini) {
                    $msg = [
                        'pesan' => 'Tanggal  Pelayanan Tidak Boleh Lebih Besar Dari Tanggal Sekarang',
                        'gagal' => true,

                    ];
                } else {

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
                        'tanggalpelayanan' => $documentdate,
                    ];
                }
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

                $koinsiden = $this->request->getVar('koinsiden2');
                if ($koinsiden == 1) {
                    $koinsiden = 1;
                } else {
                    $koinsiden = 0;
                }



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
                    //'paramedicName' => $this->request->getVar('paramedicName'),
                    //'koinsiden' => $koinsiden,

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
            $m_icd = new ModelPasienRanap($this->request);

            $referencenumber = $this->request->getVar('referencenumber');
            $row = $m_icd->get_data_pasien_ranap_pulang($referencenumber);
            $data = [
                'tampildata' => $perawat->search($referencenumber),
                'statusrawatinap' => $row['statusrawatinap'],
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_TNO', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusTNO()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelTNODetail;
            $cek = $TNO->cek_tindakan($id);
            $nama_tindakan = $cek['name'];
            $dokter = $cek['doktername'];


            $TNO->delete($id);

            $norm = $cek['relation'];
            $aktifitas = $nama_tindakan;
            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Hapus Tindakan ' . $aktifitas . ' Pada pasien ' . $norm . '  Dengan Dokter : ' . $dokter,
                'pasienid' => $norm,
                'menu' => ' Rawat Inap [Hapus Tindakan Ranap]',

            ];

            $catat = new Modellogactivity;
            $catat->insert($datalog_activity);

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
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_ranap_pulang($referencenumber);
            $data = [
                'tampildata' => $perawat->search($referencenumber),
                'statusrawatinap' => $row['statusrawatinap'],
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
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_ranap_pulang($referencenumber);
            $data = [
                'tampildata' => $perawat->searchAskep($referencenumber),
                'statusrawatinap' => $row['statusrawatinap'],
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
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasien_ranap_pulang($referencenumber);
            $data = [
                'tampildata' => $perawat->searchAsupanGizi($referencenumber),
                'statusrawatinap' => $row['statusrawatinap'],
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
                'tampildata' => $perawat->search_penunjang_ranap($referencenumber)
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_penunjang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumePenunjangDact()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelPenunjangDetail();

            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'tampildata' => $perawat->search_penunjang_ranap($referencenumber)
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_penunjang_dact', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabung()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');

            $apotekKasir_RI = $resume->kasir_apotek_rinap_aliit($referencenumber);
            $apotekKasir_RJ = $resume->kasir_apotek_rajal_aliit($referencenumber);

            $pnjKasir_RI = $resume->kasir_pnj_rinap_aliit($referencenumber);
            $pnjKasir_RJ = $resume->kasir_pnj_rajal_aliit($referencenumber);

            $kasir_RJ = $resume->kasir_rajal_aliit($referencenumber);
            $kasir_Tindakan = $resume->kasir_pembayaran_tindakan_aliit($referencenumber);

            $data = [
                'TotalKasirApotek_RI' => $apotekKasir_RI['paymentamount'],
                'TotalKasirApotek_RJ' => $apotekKasir_RJ['paymentamount'],

                'TotalKasirPnj_RI' => $pnjKasir_RI['paymentamount'],
                'TotalKasirPnj_RJ' => $pnjKasir_RJ['paymentamount'],

                'TotalKasir_RJ' => $kasir_RJ['paymentamount'],
                'TotalKasir_Tindakan' => $kasir_Tindakan['paymentamount'],

                // 'pasien' => $pasien->get_detail_ranap($journalnumber),

                'KAMAR' => $resume->Kamar($referencenumber),
                'KAMAR_GROUP' => $resume->Kamar_group_aliit($referencenumber),

                'VISITE' => $resume->searchVisite($referencenumber),
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'PENUNJANG' => $resume->Penunjang($referencenumber),
                'BHP' => $resume->BHP($referencenumber),
                'FARMASI' => $resume->FARMASIRANAP_detail_aliit($referencenumber),
                'FARMASI_IBS' => $resume->FARMASIRANAP_IBS_detail_aliit($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),

                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangdetailigdrajal_aliit($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'FARMASIIGD' => $resume->FARMASIIGD_detail_aliit($referencenumber),

                'OPERASIIGD' => $resume->Operasi_detail($referencenumber),

                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_gabung_aliit', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    // public function resumeGabung()
    // {
    //     if ($this->request->isAJAX()) {

    //         $resume = new ModelTNODetail();
    //         $referencenumber = $this->request->getVar('referencenumber');
    //         $cek = $resume->cek_titipan($referencenumber);
    //         $cek_titipan = $cek['titipan'];
    //         $kelas_pasien = $cek['pasienclassroom'];
    //         $cek_harga_kelas = $resume->cek_harga_kelas($kelas_pasien);
    //         $tarif_kelas = $cek_harga_kelas['price'];



    //         $data = [
    //             'TNO' => $resume->search($referencenumber),
    //             'GIZI' => $resume->searchAsupanGizi($referencenumber),
    //             'VISITE' => $resume->searchVisite($referencenumber),
    //             'OPERASI' => $resume->Operasi($referencenumber),
    //             'PENUNJANG' => $resume->Penunjang($referencenumber),
    //             'KAMAR' => $resume->Kamar($referencenumber),
    //             'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
    //             'TINIGD' => $resume->TindakanIGD($referencenumber),
    //             'FARMASI' => $resume->FARMASIRANAP($referencenumber),
    //             'BHP' => $resume->BHP($referencenumber),
    //             'PENUNJANGIGD' => $resume->SummaryPenunjangigdrajal($referencenumber),
    //             'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
    //             'TagihanAsal' => $resume->TagihanAsal($referencenumber),
    //             'UangMuka' => $resume->UangMuka($referencenumber),
    //             'cek_titipan' => $cek_titipan,
    //             'cek_tarif_kelas' => $tarif_kelas,

    //         ];


    //         $msg = [
    //             'data' => view('rawatinap/data_resume_gabung', $data)
    //         ];
    //         echo json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }

    public function ajax_rujuk()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');

        //$term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_rujuk($key);

        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'],
                'id' => $row['id'],
                'code' => $row['code'],
                'address' => $row['address']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function SimpanPulangPasien()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([

                'dateout' => [
                    'label' => 'Waktu Pulang pasien',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'dateout' => $validation->getError('dateout')
                    ]
                ];
            } else {
                $tglpulang = date('Y-m-d', strtotime($this->request->getVar("dateout")));
                $tanggaldie = $this->request->getVar('datedie');

                $lokasi = "PRI";
                $room = $this->request->getVar('room');

                $documentdate = date('Y-m-d');
                $db = db_connect();
                $query = $db->query("SELECT validationnumber as kode_jurnal, MAX(noantrian)as antrian FROM transaksi_pelayanan_pulang_rawatinap WHERE  documentdate='$documentdate' AND room='$room' ORDER BY id DESC LIMIT 1");
                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->antrian;
                }

                $today = date('ymd');
                $underscore = '_';

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
                helper('text');
                $tokenpulang = random_string('alnum', 9);
                $token_reborn_pulang = strtoupper($tokenpulang);


                $newkode = $lokasi . $underscore . $room . $underscore  . $token_reborn_pulang . $underscore . $today . $underscore . sprintf('%06s', $nourut);



                $pulang = $this->request->getVar('dateout');
                $jampulang = $this->request->getVar('jampulang');
                //$splitpulang = explode(" ", $pulang);
                //$tanggalpulang = $splitpulang[0];
                //$jampulang = $splitpulang[1];

                $tglpulang = str_replace('/', '-', $pulang);
                //$tanggalpulang = date('Y-m-d', strtotime($tglpulang));
                $tanggalpulang = $pulang;

                $tanggaljampulang = $tanggalpulang . ' ' . $jampulang;

                $statuspulang = $this->request->getVar('statuspulang');
                $splitstatuspulang = explode(" ", $statuspulang);
                $carapulang = $splitstatuspulang[0];


                if ($carapulang == "MENINGGAL") {

                    $die = $this->request->getVar('datedie');
                    $jamdie = $this->request->getVar('jammeninggal');

                    $tglmeninggal = str_replace('/', '-', $die);
                    $tanggaldie = date('Y-m-d', strtotime($tglmeninggal));
                    $tanggaljammeninggal = $tanggaldie . ' ' . $jamdie;
                } else {
                    $die = '0000-00-00 00:00:00';
                    $tanggaldie = '0000-00-00';
                    $jamdie = '00:00:00';
                    $tanggaljammeninggal = '0000-00-00 00:00:00';
                }


                $bayiSehat = 0;

                $namapasien =  $this->request->getVar('pasienname');
                $nohppjb = $this->request->getVar('telppjb');
                $carakeluar = $this->request->getVar('statuspulang');


                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'documentdate' => $this->request->getVar('createddate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'bpjs_sep_poli' => $this->request->getVar('bpjs_sep_poli'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                    'noantrian' => $no_antrian,
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
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokterpoli' => $this->request->getVar('dokterpoli'),
                    'dokterpoliname' => $this->request->getVar('dokterpoliname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'reasoncode' => $this->request->getVar('reasoncode'),
                    'statuspasien' => $this->request->getVar('statuspulang'),
                    'statusaps' => $this->request->getVar('alasanaps'),
                    'lakalantas' => $this->request->getVar('lakalantas'),
                    'lokasilakalantas' => $this->request->getVar('lokasilakalantas'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),
                    'telppjb' => $this->request->getVar('telppjb'),
                    'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                    'pasienclassroom' => $this->request->getVar('classroom'),
                    'bumil' => $this->request->getVar('bumil'),
                    'dokter' => $this->request->getVar('ibsdokter'),
                    'doktername' => $this->request->getVar('ibsdoktername'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'titipan' => $this->request->getVar('titipan'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'bednumber' => $this->request->getVar('bednumber'),
                    'bedname' => $this->request->getVar('bedname'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getPost('memo'),
                    'datein' => $this->request->getVar('datein'),
                    'timein' => $this->request->getVar('timein'),
                    'datetimein' => $this->request->getVar('datetimein'),
                    'dateout' => $tanggalpulang,
                    'timeout' => $jampulang,
                    'datetimeout' => $tanggaljampulang,
                    'datedie' => $tanggaldie,
                    'timedie' => $jamdie,
                    'datetimedie' => $tanggaljammeninggal,
                    'faskesrujukan' => $this->request->getVar('code_rujuk'),
                    'faskesnamerujukan' => $this->request->getVar('rujuk'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),

                    'validationby' => $this->request->getVar('validationby'),
                    'validationdate' => $this->request->getVar('validationdate'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'pasienclassroomchangenumber' => $this->request->getVar('pasienclassroomchangenumber'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'paymentchange' => $this->request->getPost('paymentchange'),
                    'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),
                    // 'bayiSehat' => $bayiSehat,
                    'koinsiden' => $this->request->getVar('koinsiden'),


                ];
                $perawat = new ModelPulangRanap;
                $perawat->insert($simpandata);

                // if (($carakeluar == "MENINGGAL < 8 JAM") or ($carakeluar == "MENINGGAL < 48 JAM") or ($carakeluar == "MENINGGAL > 48 JAM") or ($carakeluar == "DOA")) {
                //     $client = new Client();

                //     $header['Authorization'] = 'Bearer y12Aam0auhyN-_vfVYTF2sFjK0cNRv2mxexs957otVs';
                //     $header['Content-Type'] = "application/json";

                //     $mobile = substr($nohppjb, 1);
                //     $kodeawal = "62";
                //     $nohandphone = $kodeawal . $mobile;

                //     $request = [
                //         "to_name" => $namapasien,
                //         "to_number" => $nohandphone,
                //         //"message_template_id" => "07f717e9-413f-4248-bba7-e5503d987a2f",
                //         "message_template_id" => "48f64574-e968-4758-8553-2209fc5c6462",
                //         "channel_integration_id" => "7907b6a2-702d-4938-8393-b3a3ef58ed9c",
                //         "language" => ["code" => "id"],
                //         "parameters" => [
                //             "body" => [

                //                 [
                //                     "key" => "1",
                //                     "value_text" => $namapasien,
                //                     "value" => "name"
                //                 ],

                //                 [
                //                     "key" => "2",
                //                     "value_text" => $namapasien,
                //                     "value" => "name"
                //                 ]
                //             ]
                //         ]
                //     ];

                //     $response = $client->request('POST', 'https://chat-service.qontak.com/api/open/v1/broadcasts/whatsapp/direct', [
                //         'headers' => $header,
                //         'json' => $request,
                //     ])->getBody()->getContents();
                // }





                $referencenumber = $this->request->getVar('referencenumber');
                $m_icd = new ModelPasienRanap($this->request);
                $journalnumber = $this->request->getVar('journalnumber');


                $lokasikasir = "KASIR RAWAT INAP";

                $row3 = $m_icd->get_data_kasir_ranap($lokasikasir);
                $resume = new ModelTNODetail();

                // $data = [
                //     'header1' => $row3['header1'],
                //     'header2' => $row3['header2'],
                //     'status' => $row3['status'],
                //     'alamat' => $row3['alamat'],
                //     'deskripsi' => $row3['deskripsi'],
                //     'pasien' => $m_icd->get_data_rajal_close_email_ranap($journalnumber),
                //     'TNO' => $resume->search($referencenumber),
                //     'GIZI' => $resume->searchAsupanGizi($referencenumber),
                //     'VISITE' => $resume->searchVisite($referencenumber),
                //     'OPERASI' => $resume->Operasi($referencenumber),
                //     'PENUNJANG' => $resume->Penunjang($referencenumber),
                //     'KAMAR' => $resume->Kamar($referencenumber),
                //     'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                //     'TINIGD' => $resume->TindakanIGD($referencenumber),
                //     'FARMASI' => $resume->FARMASI($referencenumber),
                //     'BHP' => $resume->BHP($referencenumber),
                // ];


                // $email = \Config\Services::email();


                // $tujuan = $this->request->getVar('email');
                // $dompdf = new Dompdf();
                // $html = view('pdf/stylebootstrap');
                // $html .= view('pdf/Emailinformasitagihanranap', $data);
                // $dompdf->loadhtml($html);

                // $dompdf->setPaper('A4', 'portrait');
                // $dompdf->render();
                // $journalnumber = $this->request->getVar('journalnumber');
                // $name = date('d-m-Y') . '-' . $journalnumber . '-' . 'InformasiTagihan';
                // $email->setFrom('simrs2021.syamsudin@gmail.com', 'Informasi Tagihan Biaya Rawat Inap');
                // $email->setTo($tujuan);

                // $email->setSubject('Informasi Tagihan Biaya Rawat Inap');
                // $email->setMessage('Pasien Sudah Diperbolehkan Pulang, silahkan untuk menyelesaikan administrasi di bagian loket pembayaran (Kasir Rawat Inap)');
                // $email->attach($dompdf->output(), 'application/pdf', $name . '.pdf', false);
                // $email->send();
                $msg = [
                    'sukses' => 'Pasien Berhasil dipulangkan, Informasi Tagihan Biaya Rawat Inap Sudah Diemailkan Ke Keluarga Pasien'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function PasienPulang()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rawatinap/pasienpulang', $data);
    }

    public function ambildatapasienpulang()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatapasienpulang()
            ];
            $msg = [
                'data' => view('rawatinap/datapasienpulang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridatapasienpulang()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_pasienpulang($search)
            ];

            $msg = [
                'data' => view('rawatinap/datapasienpulang', $data)
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

    public function rincianranap_pasienpulang($referencenumber = '')
    {
        $referencenumber = $this->request->getVar('referencenumber');

        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_pasien_ranap_pulang($referencenumber);
        $validasi_kasir = $row['payment'];


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
            // 'email' => $row['email'],
            'token_ranap' => $row['token_ranap'],
            'memo' => $row['memo'],
            'roomfisik' => $row['roomfisik'],
            'roomfisikname' => $row['roomfisikname'],
            'list' => $this->_data_dokter(),
            'statusrawatinap' => $row['statusrawatinap'],
            'pasienclassroom' => $row['pasienclassroom'],
            'validasikasir' => $validasi_kasir,


        ];

        return view('rawatinap/detail_rincian_ranap', $data);
    }

    public function tambahTNOdetail_ranap()
    {
        if ($this->request->isAJAX()) {

            $journalnumber = $this->request->getVar('journalnumber');

            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rawatinap_by_journalnumber2($journalnumber);

            $namaruangan = $row['roomname'];
            $ruangan = explode(" ", $namaruangan);
            $roomname = $ruangan[0];
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['referencenumber'],
                //'bpjs_sep' => $row['bpjs_sep'],
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
                'roomfisik' => $row['room'],
                'roomfisikname' => $row['roomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],

                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),
                'paramedic' => $this->data_paramedic($roomname),

            ];
            $msg = [
                'sukses' => view('rawatinap/modalinputTNOadd', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanTNODetail_add()
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

                $pelaksana = $this->request->getVar('pelaksana');
                if ($pelaksana == 1) {
                    $pelaksana = "Paramedis";
                } else {
                    $pelaksana = "Dokter";
                }

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
                    //'pelaksana' => $pelaksana,
                    //'paramedicName' => $this->request->getVar('paramedicName'),
                    //'koinsiden' => $koinsiden,

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

    public function pindahkamar()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new Modelranapvalidasi();
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],

                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],

                'referencenumber' => $row['referencenumber'],
                'referencenumberparent' => $row['referencenumberparent'],
                'pasienid' => $row['pasienid'],
                'oldcode' => $row['oldcode'],
                'parentjournalnumber' => $row['parentjournalnumber'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'bpjs_sep' => $row['bpjs_sep'],
                'noantrian' => $row['noantrian'],

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
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'pasienclassroom' => $row['pasienclassroom'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],

                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'bumil' => $row['bumil'],
                'titipan' => $row['titipan'],
                'memo' => $row['memo'],
                'datein' => $row['datein'],
                'datetimein' => $row['datetimein'],
                'timein' => $row['timein'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'pasienclassroomchangenumber' => $row['pasienclassroomchangenumber'],
                'paymentchange' => $row['paymentchange'],
                'paymentchangenumber' => $row['paymentchangenumber'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'tglspr' => $row['tgl_spr'],
                'email' => $row['email'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'namapjb' => $row['namapjb'],
                'alamatpjb' => $row['alamatpjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'datetimein' => $row['datetimein'],
                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat(),
                'bed' => $this->bed(),
                'namasmf' => $this->smf(),
                'statuspulang' => $this->statuspulang(),
                'alasanaps' => $this->alasanaps(),
                'titipan' => $row['titipan'],

            ];
            $msg = [
                'sukses' => view('rawatinap/modalpindahkamar', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function SimpanPindahKamar()
    {
        if ($this->request->isAJAX()) {

            $kelastujuan = $this->request->getVar('classroomname');
            $ruangantujuan = $this->request->getVar('roomname');
            $nobedtujuan = $this->request->getVar('bednumber');
            $dateout = $this->request->getVar('dateout');
            $norm = $this->request->getVar('pasienid');

            $tanggaljammasukrawat = $this->request->getVar('datetimein');

            if (($kelastujuan == "") or ($ruangantujuan == null) or ($nobedtujuan == null) or ($dateout == "")) {
                $msg = [
                    'Gagal' => 'Data Tujuan Pindah Belum Lengkap!!'
                ];
            } else {

                $lokasi = "NEWRBN";
                $room = $this->request->getVar('room');
                $documentdate = date('Y-m-d');
                $db = db_connect();
                $query = $db->query("SELECT validationnumber as kode_jurnal, MAX(noantrian) as antrian FROM transaksi_pelayanan_pindah_rawatinap WHERE  documentdate='$documentdate' AND reborn=2 ORDER BY id DESC LIMIT 1");
                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->antrian;
                }


                $underscore = '_';

                $tglpindah = $this->request->getVar('dateout');
                $jampindah = $this->request->getVar('timeout');

                $datepindah = str_replace('/', '-', $tglpindah);
                $documentdate = date('Y-m-d', strtotime($datepindah));
                $tanggaljampindah = $documentdate . ' ' . $jampindah;

                $today = date('ymd', strtotime($documentdate));

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
                $kata = "PDHRBN2023";

                //$newkode = $lokasi . $underscore . $kata . $underscore . $norm . $underscore  . $today . $underscore . sprintf('%06s', $nourut);
                $ruangreborn = $this->request->getVar('roomasal');
                $jurus = $norm . '-' . $ruangreborn . '-VPD';

                helper('text');
                $token = random_string('alnum', 9);
                $token_reborn = strtoupper($token);

                $kata = 'REBORN-VP';
                $newkode = $lokasi . $underscore . $jurus . $underscore  . $token_reborn . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $pulang = $this->request->getVar('dateout');


                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'documentdate' => $this->request->getVar('createddate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'bpjs_sep_poli' => $this->request->getVar('bpjs_sep_poli'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                    'noantrian' => $no_antrian,
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
                    'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                    'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                    'paymentcardnumberori' => $this->request->getVar('paymentcardnumber'),
                    'poliklinik' => $this->request->getVar('poliklinik'),
                    'poliklinikname' => $this->request->getVar('poliklinikname'),
                    'faskes' => $this->request->getVar('faskes'),
                    'faskesname' => $this->request->getVar('faskesname'),
                    'dokterpoli' => $this->request->getVar('dokterpoli'),
                    'dokterpoliname' => $this->request->getVar('dokterpoliname'),
                    'icdx' => $this->request->getVar('icdx'),
                    'icdxname' => $this->request->getVar('icdxname'),
                    'reasoncode' => $this->request->getVar('reasoncode'),
                    'lakalantas' => $this->request->getVar('lakalantas'),
                    'lokasilakalantas' => $this->request->getVar('lokasilakalantas'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),
                    'telppjb' => $this->request->getVar('telppjb'),
                    'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                    'pasienclassroom' => $this->request->getVar('pasienclassroom'),
                    'bumil' => $this->request->getVar('bumil'),
                    'dokter' => $this->request->getVar('ibsdokter'),
                    'doktername' => $this->request->getVar('ibsdoktername'),
                    'smf' => $this->request->getVar('smfasal'),
                    'smfname' => $this->request->getVar('smfnameasal'),
                    'classroom' => $this->request->getVar('classroomasal'),
                    'classroomname' => $this->request->getVar('classroomnameasal'),
                    'room' => $this->request->getVar('roomasal'),
                    'roomname' => $this->request->getVar('roomnameasal'),
                    'bednumber' => $this->request->getVar('bednumberasal'),
                    'bedname' => $this->request->getVar('bednameasal'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getPost('memo'),
                    'datein' => $this->request->getVar('datein'),
                    'timein' => $this->request->getVar('timein'),
                    'datetimein' => $this->request->getVar('datetimein'),
                    'dateout' => $documentdate,
                    'timeout' => $jampindah,
                    'datetimeout' => $tanggaljampindah,
                    'transferclassroom' => $this->request->getVar('classroom'),
                    'transferclassroomname' => $this->request->getVar('classroomname'),
                    'transferroom' => $this->request->getVar('room'),
                    'transferroomname' => $this->request->getVar('roomname'),
                    'transferbednumber' => $this->request->getVar('bednumber'),
                    'transfersmf' => $this->request->getVar('smf'),
                    'transfersmfname' => $this->request->getVar('smfname'),
                    'vsstability' => $this->request->getVar('vsstability'),
                    'vsdifiksasi' => $this->request->getVar('vsdifiksasi'),
                    'transferreason' => $this->request->getVar('transferreason'),
                    'memo' => $this->request->getVar('memo'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'pasienclassroomchangenumber' => $this->request->getVar('pasienclassroomchangenumber'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'paymentchange' => $this->request->getPost('paymentchange'),
                    'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),
                    'reborn' => 2,


                ];
                $perawat = new ModelPindahRanap;
                $perawat->insert($simpandata);


                $db = db_connect();
                $groups = $this->request->getVar('locationcode');
                $lokasi = "NEWRBN";

                $documentdate = date('Y-m-d');
                $query2 = $db->query("SELECT journalnumber as kode_jurnal2, MAX(noantrian) as antrianranap FROM transaksi_pelayanan_daftar_rawatinap WHERE  documentdate='$documentdate' AND types='PINDAHAN' and reborn=2 ORDER BY id DESC LIMIT 1");

                foreach ($query2->getResult() as $rowcek) {
                    $kodelama = $rowcek->kode_jurnal2;
                    $nomorantrianranap = $rowcek->antrianranap;
                }


                $today = date('ymd');
                $underscore = '_';

                if ($kodelama == null) {
                    $nourutbaru = '000001';
                } else {
                    $nourutbaru = (int) substr($kode, -6, 6);
                    $nourutbaru++;
                }

                if ($nomorantrianranap == "") {
                    $nourutantrianranap = '1';
                } else {
                    $nourutantrianranap = (int)($nomorantrianranap);
                    $nourutantrianranap++;
                }

                $kata = "RBNPDH_RI2023";
                $ruangreborn = $this->request->getVar('room');
                $jurus = $norm . '-' . $ruangreborn . '-PDH';

                helper('text');
                $token2 = random_string('alnum', 9);
                $token_reborn2 = strtoupper($token2);

                //$newkodebaru = $lokasi . $underscore . $kata . $underscore . $norm . $underscore  . $today . $underscore . sprintf('%06s', $nourutbaru);
                $newkodebaru = $lokasi . $underscore . $jurus . $underscore  . $token_reborn2 . $underscore . $today . $underscore . sprintf('%06s', $nourutantrianranap);
                //$newkodebaru = 'NEWRBN_R00303816-ASTER-PDH_230321_000021';

                // var_dump($kodelama);
                // var_dump($newkodebaru);
                // die();



                $typespindah = 'PINDAHAN';
                $simpandatabaru = [
                    'groups' => $this->request->getVar('groups'),
                    'types' => $typespindah,
                    'journalnumber' => $newkodebaru,
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'transferjournalnumber' => $newkode,
                    'documentdate' => $documentdate,
                    'documentyear' => $this->request->getVar('documentyear'),
                    'documentmonth' => $this->request->getVar('documentmonth'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'bpjs_sep_poli' => $this->request->getVar('bpjs_sep_poli'),
                    'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                    'noantrian' => $nourutantrianranap,
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
                    'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                    'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
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
                    'pasienclassroom' => $this->request->getVar('pasienclassroom'),
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
                    'datein' => $documentdate,
                    'timein' => $jampindah,
                    'datetimein' => $tanggaljampindah,
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'memo' => $this->request->getPost('memo'),
                    'email' => $this->request->getPost('email'),
                    'tgl_spr' => $this->request->getVar('tglspr'),
                    'token_ranap' => $this->request->getVar('token_ranap'),
                    'reborn' => 2,


                ];
                $pindah = new ModelDaftarRanap;
                $pindah->insert($simpandatabaru);
                $msg = [
                    'sukses' => 'Pasien Berhasil dipindahkan, silahkan tunggu untuk menunggu approve dari ruang tujuan'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function PasienPindah()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rawatinap/pasienpindah', $data);
    }

    public function ambildatapasienpindah()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatapasienpindah()
            ];
            $msg = [
                'data' => view('rawatinap/datapasienpindah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridatapasienpindah()
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

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_pasienpindah($search)
            ];

            $msg = [
                'data' => view('rawatinap/datapasienpindah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function rincianranappindah($journalnumber = '')
    {
        $journalnumber = $this->request->getVar('journalnumber');


        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_pasienpindah($journalnumber);
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
            'statusrawatinap' => $row['statusrawatinap'],
            'pasienclassroom' => $row['pasienclassroom'],
        ];

        return view('rawatinap/detail_rincian_ranap_pindah', $data);
    }

    public function DactPindah()
    {
        if ($this->request->isAJAX()) {
            $journalnumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasienpindah($journalnumber);
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
                'statusrawatinap' => $row['statusrawatinap'],
                'pasienclassroom' => $row['pasienclassroom'],
            ];
            $msg = [
                'suksespindah' => view('rawatinap/mdrp', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function hapusPindahKamar()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelPindahRanap;;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Pindah Kamar dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function hapusPulangPasien()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelPulangRanap;
            $TNO->delete($id);
            $msg = [
                'sukses' => "Data Pulang Pasien dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function CreateSuratKematian()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $journalnumber = $this->request->getVar('journalnumber');
            $perawat = new ModelPulangRanap();
            $row = $perawat->searchpasienpulang($id);
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
                'dokterforensik' => $this->_data_dokter(),
                'forensik' => $perawat->get_data_admission_surat_kematian_journalnumber($journalnumber),
                'pasienaddress' => $rowpasien['address'],
                'nik' => $rowpasien['ssn'],
                'pasiengender' => $row['pasiengender'],
                'umur' => $umur,
                'pasiendateofbirth' => $rowpasien['dateofbirth'],
                'placeofbirth' => $rowpasien['placeofbirth'],
                'agama' => $rowpasien['religion'],
                'kelurahan' => $rowpasien['district'],
                'kecamatan' => $rowpasien['kecamatan'],
                'kabupatenkota' => $rowpasien['kabupaten'],
                'propinsi' => $rowpasien['propinsi'],
                'citizenship' => $rowpasien['citizenship'],
                'HPJB' => $this->hubunganpjb(),
                'sebabmati' => $this->penyebabkematian(),
            ];
            $msg = [
                'suksescari' => view('rawatinap/modalsuratkematian', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function penyebabkematian()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_penyebab_kematian();
        return $list;
    }

    public function VerifikasiRincian()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('rawatinap/verifikasipasienpulang', $data);
    }

    public function ambildataVerifikasi()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatapasienpulang()
            ];
            $msg = [
                'data' => view('rawatinap/verifikasidatapasienpulang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienVerifikasi()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_pasienpulang($search)
            ];

            $msg = [
                'data' => view('rawatinap/verifikasidatapasienpulang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DactPulang()
    {
        if ($this->request->isAJAX()) {
            $journalnumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_pasienpindah($journalnumber);
            $referencenumber = $row['referencenumber'];
            $merge = $m_icd->get_data_merge($referencenumber);
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
                'statusrawatinap' => $row['statusrawatinap'],
                'pasienclassroom' => $row['pasienclassroom'],
                'payment' => $row['payment'],
                'merge' => $merge,
            ];
            $msg = [
                'suksespindah' => view('rawatinap/modalverifikasirincian', $data)
            ];
            echo json_encode($msg);
        }
    }

    // public function resumeGabungVerifikasi()
    // {
    //     if ($this->request->isAJAX()) {

    //         $resume = new ModelTNODetail();
    //         $referencenumber = $this->request->getVar('referencenumber');
    //         $cekverifikasi = $resume->cekverifikasi($referencenumber);

    //         $apotekKasir_RI = $resume->kasir_apotek_rinap_aliit($referencenumber);
    //         $apotekKasir_RJ = $resume->kasir_apotek_rajal_aliit($referencenumber);

    //         $pnjKasir_RI = $resume->kasir_pnj_rinap_aliit($referencenumber);
    //         $pnjKasir_RJ = $resume->kasir_pnj_rajal_aliit($referencenumber);

    //         $kasir_RJ = $resume->kasir_rajal_aliit($referencenumber);
    //         $kasir_Tindakan = $resume->kasir_pembayaran_tindakan_aliit($referencenumber);

    //         $data = [
    //             'TNO' => $resume->search($referencenumber),
    //             'GIZI' => $resume->searchAsupanGizi($referencenumber),
    //             'VISITE' => $resume->searchVisite($referencenumber),
    //             'OPERASI' => $resume->Operasi($referencenumber),
    //             'PENUNJANG' => $resume->Penunjang($referencenumber),
    //             'KAMAR' => $resume->Kamar($referencenumber),
    //             'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
    //             'TINIGD' => $resume->TindakanIGD($referencenumber),
    //             'FARMASI' => $resume->FARMASIRANAPVERIFIKASI($referencenumber),
    //             'BHP' => $resume->BHP($referencenumber),
    //             'PENUNJANGIGD' => $resume->SummaryPenunjangigdrajal($referencenumber),
    //             'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
    //             'FARMASIIGD' => $resume->FARMASIIGDRAJALVERIFIKASI($referencenumber),
    //             'TagihanAsal' => $resume->TagihanAsal($referencenumber),
    //             'UangMuka' => $resume->UangMuka($referencenumber),
    //             'idverifikasi' => $cekverifikasi['id'],
    //             'verifikasi' => $cekverifikasi['verifikasi'],
    //             'referencenumber' => $referencenumber,
    //         ];
    //         $msg = [
    //             'data' => view('rawatinap/data_resume_gabung_verifikasi', $data)
    //         ];
    //         echo json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }

    public function resumeGabungVerifikasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $cekverifikasi = $resume->cekverifikasi($referencenumber);

            $apotekKasir_RI = $resume->kasir_apotek_rinap_aliit($referencenumber);
            $apotekKasir_RJ = $resume->kasir_apotek_rajal_aliit($referencenumber);

            $pnjKasir_RI = $resume->kasir_pnj_rinap_aliit($referencenumber);
            $pnjKasir_RJ = $resume->kasir_pnj_rajal_aliit($referencenumber);

            $kasir_RJ = $resume->kasir_rajal_aliit($referencenumber);
            $kasir_Tindakan = $resume->kasir_pembayaran_tindakan_aliit($referencenumber);

            $data = [
                'TotalKasirApotek_RI' => $apotekKasir_RI['paymentamount'],
                'TotalKasirApotek_RJ' => $apotekKasir_RJ['paymentamount'],

                'TotalKasirPnj_RI' => $pnjKasir_RI['paymentamount'],
                'TotalKasirPnj_RJ' => $pnjKasir_RJ['paymentamount'],

                'TotalKasir_RJ' => $kasir_RJ['paymentamount'],
                'TotalKasir_Tindakan' => $kasir_Tindakan['paymentamount'],

                // 'pasien' => $pasien->get_detail_ranap($journalnumber),

                'KAMAR' => $resume->Kamar($referencenumber),
                'KAMAR_GROUP' => $resume->Kamar_group_aliit($referencenumber),

                'VISITE' => $resume->searchVisite($referencenumber),
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'PENUNJANG' => $resume->Penunjang($referencenumber),
                'BHP' => $resume->BHP($referencenumber),
                'FARMASI' => $resume->FARMASIRANAP_detail_aliit($referencenumber),
                'FARMASI_IBS' => $resume->FARMASIRANAP_IBS_detail_aliit($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),

                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangdetailigdrajal_aliit($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'FARMASIIGD' => $resume->FARMASIIGD_detail_aliit($referencenumber),
                'OPERASIIGD' => $resume->Operasi_detail($referencenumber),

                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
                'idverifikasi' => $cekverifikasi['id'],
                'verifikasi' => $cekverifikasi['verifikasi'],
                'referencenumber' => $referencenumber,
                'paymentmethod' => $cekverifikasi['paymentmethod']
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_gabung_verifikasi_aliit', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    

    public function VerifikasiSelesai()
    {
        if ($this->request->isAJAX()) {

            $verifikasi = 1;
            $petugasverifikasi = $this->request->getVar('petugasverifikasi');
            $tanggalverifikasi = $this->request->getVar('tanggalverifikasi');
            $simpandata = [
                'verifikasi' => $verifikasi,
                'petugasverifikasi' => $petugasverifikasi,
                'tanggalverifikasi' => $tanggalverifikasi,

            ];
            $verifikasirincian = new ModelPulangRanap;
            $id = $this->request->getVar('id');
            $verifikasirincian->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Selesai, Rincian Sudah Dapat Divalidasi Kasir!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function VerifikasiBatal()
    {
        if ($this->request->isAJAX()) {

            $verifikasi = 0;
            $simpandata = [
                'verifikasi' => $verifikasi,
                'petugasverifikasi' => 'NONE',
                'tanggalverifikasi' => '',

            ];
            $verifikasirincian = new ModelPulangRanap;
            $id = $this->request->getVar('id');
            $verifikasirincian->update($id, $simpandata);
            $msg = [
                'sukses' => 'Verifikasi Telah Dibatalkan!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusVISITE()
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

    public function resumeGabungPilihan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $pilihancabar = $this->request->getVar('pilihancabar');

            $data = [
                'TNO' => $resume->searchPilihan($referencenumber, $pilihancabar),
                'GIZI' => $resume->searchAsupanGiziPilihan($referencenumber, $pilihancabar),
                'VISITE' => $resume->searchVisitePilihan($referencenumber, $pilihancabar),
                'OPERASI' => $resume->OperasiPilihan($referencenumber, $pilihancabar),
                'PENUNJANG' => $resume->PenunjangPilihan($referencenumber, $pilihancabar),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAPPILIHAN($referencenumber, $pilihancabar),
                'BHP' => $resume->BHPPilihan($referencenumber, $pilihancabar),
                'PENUNJANGIGD' => $resume->SummaryPenunjangigdrajal($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_gabung', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabungPilihanVerifikasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $pilihancabar = $this->request->getVar('pilihancabar');

            $cekverifikasi = $resume->cekverifikasi($referencenumber);

            $data = [
                'TNO' => $resume->searchPilihan($referencenumber, $pilihancabar),
                'GIZI' => $resume->searchAsupanGiziPilihan($referencenumber, $pilihancabar),
                'VISITE' => $resume->searchVisitePilihan($referencenumber, $pilihancabar),
                'OPERASI' => $resume->OperasiPilihan($referencenumber, $pilihancabar),
                'PENUNJANG' => $resume->PenunjangPilihan($referencenumber, $pilihancabar),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAPPILIHAN($referencenumber, $pilihancabar),
                'BHP' => $resume->BHPPilihan($referencenumber, $pilihancabar),
                'PENUNJANGIGD' => $resume->SummaryPenunjangigdrajal($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
                'idverifikasi' => $cekverifikasi['id'],
                'verifikasi' => $cekverifikasi['verifikasi'],
                'referencenumber' => $referencenumber,
            ];
            $msg = [
                'data' => view('rawatinap/data_resume_gabung_verifikasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function TNOPindah()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelranap();
            $row = $perawat->find($id);
            $namaruangan = $row['roomname'];
            $ruangan = explode(" ", $namaruangan);
            $roomname = $ruangan[0];
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
                'paramedic' => $this->data_paramedic($roomname),
                'titipan' => $row['titipan'],

            ];
            $msg = [
                'sukses' => view('rawatinap/modalinputTNOPindah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanTNODetailPindah()
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

                $pelaksana = $this->request->getVar('pelaksana2');
                if ($pelaksana == 1) {
                    $pelaksana = "Paramedis";
                } else {
                    $pelaksana = "Dokter";
                }


                $koinsiden = $this->request->getVar('koinsiden2');
                if ($koinsiden == 1) {
                    $koinsiden = 1;
                } else {
                    $koinsiden = 0;
                }

                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'journalnumber' => $this->request->getVar('journalnumberpindah'),
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
                    //'pelaksana' => $pelaksana,
                    //'paramedicName' => $this->request->getVar('paramedicName'),
                    //'koinsiden' => $koinsiden,

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

    private function _data_apoteker()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_apoteker();
        return $list;
    }
}

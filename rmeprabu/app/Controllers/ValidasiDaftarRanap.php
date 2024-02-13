<?php

namespace App\Controllers;

use App\Models\Modelrajal;
use App\Models\Modelranapvalidasi;
use App\Models\Modelibs;
use App\Models\Model_autocomplete;
use App\Models\ModelDaftarRanap;
use App\Models\Model_icd;
use App\Models\ModelDetailibs;
use App\Models\ModelEdukasi;
use App\Models\ModelValidasiRanap;
use Config\Services;
use Dompdf\Dompdf;


class ValidasiDaftarRanap extends BaseController
{

    public function index()
    {

        return view('rawatinap/DVR');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelranapvalidasi();
            $data = [
                'tampildata' => $perawat->ambildatarajal()
            ];
            $msg = [
                'data' => view('rawatinap/data_validasi_pasien_ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalPeriksa()
    {
        if ($this->request->isAJAX()) {

            $statusrawatinap = 'PULANG';
            $statuspasienpulang = 'BATAL RAWAT';
            $modifiedby = $this->request->getVar('modifiedby');
            $simpandata = [
                'statusrawatinap' => $statusrawatinap,
                'statuspasienpulang' => $statuspasienpulang,
                'modifiedby' => $modifiedby,

            ];
            $perawat = new Modelranapvalidasi;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Status pasien berhasil diubah menjadi PULANG!'
            ];

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
                'kamar' => $this->kamarrawat($row['classroom']),
                'bed' => $this->bed($row['room']),
                'namasmf' => $this->smf(),
                'KR_active' => $row['classroom'],
                'kamar_active' => $row['room'],
                'bed_active' => $row['bednumber'],


            ];
            $msg = [
                'sukses' => view('rawatinap/modalvalidasiranap', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $tglspr = date('Y-m-d', strtotime($this->request->getVar("tglspr")));
            $simpandata = [
                'namapjb' => $this->request->getVar('namapjb'),
                'alamatpjb' => $this->request->getVar('alamatpjb'),
                'telppjb' => $this->request->getVar('telppjb'),
                'email' => $this->request->getVar('email'),
                'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                'pasienaddress' => $this->request->getVar('pasienaddress'),
                'datetimein' => $this->request->getVar('datetimein'),
                'timein' => $this->request->getVar('timein'),
                'datein' => $this->request->getVar('datein'),
                'classroom' => $this->request->getVar('classroom'),
                'classroomname' => $this->request->getVar('classroomname'),
                'pasienclassroom' => $this->request->getVar('pasienclassroom'),
                'pasienclassroom' => $this->request->getVar('pasienclassroom'),
                'room' => $this->request->getVar('room'),
                'roomname' => $this->request->getVar('roomname'),
                'bednumber' => $this->request->getVar('bednumber'),
                'bedname' => $this->request->getVar('bedname'),
                'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                'smfname' => $this->request->getVar('smfname'),
                'smf' => $this->request->getVar('smf'),
                'dokter' => $this->request->getVar('ibsdokter'),
                'doktername' => $this->request->getVar('ibsdoktername'),
                'email' => $this->request->getVar('email'),
                'memo' => $this->request->getVar('memo'),
                'tgl_spr' => $tglspr,
                'statuspasien' => $this->request->getVar('statuspasien'),
                'statusrawatinap' => $this->request->getVar('statusrawatinap'),
                'validation' => $this->request->getVar('validation'),
                'validationby' => $this->request->getVar('validationby'),
                'validationdate' => $this->request->getVar('validationdate'),


            ];
            $perawat = new Modelranapvalidasi;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data pasien masuk sudah berhasil divalidasi'
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

    public function kamarrawat($classroom = '')
    {

        $m_auto = new Modelranapvalidasi();
        $list = $m_auto->get_list_kamar($classroom);
        return $list;
    }

    public function kamarrawat2()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kamar();
        return $list;
    }

    public function bed($room = '')
    {

        $m_auto = new Modelranapvalidasi();
        $list = $m_auto->get_list_bed($room);
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

    public function validasipasienmasuk()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new Modelranapvalidasi();
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'types' => $row['types'],
                'groups' => $row['groups'],

                'journalnumber' => $row['journalnumber'],
                'parentjournalnumber' => $row['parentjournalnumber'],
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
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],

                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
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
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'bednumber' => $row['bednumber'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'reasoncode' => $row['reasoncode'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
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
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'titipan' => $row['titipan'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'paymentchange' => $row['paymentchange'],
                'paymentchangenumber' => $row['paymentchangenumber'],

                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat2(),
                'bed' => $this->bedranap(),
                'namasmf' => $this->smf(),


            ];
            $msg = [
                'sukses' => view('rawatinap/modalvalidasipasienmasukranap', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function validasipasienpindah()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');


            $perawat = new Modelranapvalidasi();
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'types' => $row['types'],
                'groups' => $row['groups'],

                'journalnumber' => $row['journalnumber'],
                'parentjournalnumber' => $row['parentjournalnumber'],
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
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],

                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
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
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'bednumber' => $row['bednumber'],
                'bpjs_sep' => $row['bpjs_sep'],
                'bpjs_sep_poli' => $row['bpjs_sep_poli'],
                'dokterpoli' => $row['dokterpoli'],
                'dokterpoliname' => $row['dokterpoliname'],
                'reasoncode' => $row['reasoncode'],
                'statuspasien' => $row['statuspasien'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
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
                'datein' => $row['datein'],
                'timein' => $row['timein'],
                'datetimein' => $row['datetimein'],
                'pasienclassroom' => $row['pasienclassroom'],
                'bumil' => $row['bumil'],
                'titipan' => $row['titipan'],
                'classroom' => $row['classroom'],
                'classroomname' => $row['classroomname'],
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'roomfisik' => $row['roomfisik'],
                'roomfisikname' => $row['roomfisikname'],
                'bednumber' => $row['bednumber'],
                'bedname' => $row['bedname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'pasienclassroomchange' => $row['pasienclassroomchange'],
                'paymentchange' => $row['paymentchange'],
                'paymentchangenumber' => $row['paymentchangenumber'],

                'list' => $this->_data_dokter(),
                'HPJB' => $this->hubunganpjb(),
                'KR' => $this->kelasrawat(),
                'kamar' => $this->kamarrawat2(),
                'bed' => $this->bedranap(),
                'namasmf' => $this->smf(),


            ];
            $msg = [
                'sukses' => view('rawatinap/modalvalidasipasienmasukranappindah', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function bedranap()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_bed_ranap();
        return $list;
    }

    public function SimpanPindahKamar()
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

                $lokasi = "MRI";
                $room = $this->request->getVar('room');

                $documentdate = date('Y-m-d');
                $db = db_connect();
                $query = $db->query("SELECT MAX(validationnumber) as kode_jurnal, MAX(noantrian)as antrian FROM transaksi_pelayanan_validasi_rawatinap WHERE  documentdate='$documentdate' AND room='$room' ORDER BY id DESC LIMIT 1");
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

                $newkode = $lokasi . $underscore . $room . $underscore  . $today . $underscore . sprintf('%06s', $nourut);

                $pulang = $this->request->getVar('dateout');
                $splitpulang = explode(" ", $pulang);
                $tanggalpulang = $splitpulang[0];
                $jampulang = $splitpulang[1];

                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'types' => $this->request->getVar('types'),
                    'validationgroups' => $this->request->getVar('types'),
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
                    'titipan' => $this->request->getVar('ibstitipan'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smf'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'bednumber' => $this->request->getVar('bednumbe'),
                    'bedname' => $this->request->getVar('bedname'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getPost('memo'),
                    'datein' => $this->request->getVar('datein'),
                    'timein' => $this->request->getVar('timein'),
                    'datetimein' => $this->request->getVar('datetimein'),
                    'locationcode' => $this->request->getVar('room'),
                    'locationname' => $this->request->getVar('room'),
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
                    'validation' => $this->request->getVar('validation'),
                    'validationby' => $this->request->getVar('validationby'),
                    'validationdate' => $this->request->getVar('validationdate'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'pasienclassroomchangenumber' => $this->request->getVar('pasienclassroomchangenumber'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'paymentchange' => $this->request->getPost('paymentchange'),
                    'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),


                ];
                $perawat = new Modelranapvalidasi;
                $perawat->insert($simpandata);


                // $referencenumber = $this->request->getVar('referencenumber');
                // $m_icd = new ModelPasienRanap($this->request);
                // $journalnumber = $this->request->getVar('journalnumber');


                // $lokasikasir = "KASIR RAWAT INAP";

                // $row3 = $m_icd->get_data_kasir_ranap($lokasikasir);
                // $resume = new ModelTNODetail();

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
                    'sukses' => 'Pasien Berhasil dipindahkan, silahkan tunggu untuk menunggu approve dari ruang tujuan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function SimpanValidasiPasienMasuk()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([

                'ibsdoktername' => [
                    'label' => 'DPJP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
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
                $tglpulang = date('Y-m-d', strtotime($this->request->getVar("dateout")));
                $tanggaldie = $this->request->getVar('datedie');

                $lokasi = "NEWRBN";
                $room = $this->request->getVar('room');
                $pasienid = $this->request->getVar('pasienid');

                $documentdate = date('Y-m-d');
                $db = db_connect();
                $query = $db->query("SELECT MAX(validationnumber) as kode_jurnal, MAX(noantrian)as antrian FROM transaksi_pelayanan_validasi_rawatinap WHERE  documentdate='$documentdate' AND reborn=2 ORDER BY id DESC LIMIT 1");
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
                $kata = 'REBORN-VM';

                helper('text');
                $token3 = random_string('alnum', 9);
                $token_reborn3 = strtoupper($token3);

                $newkode = $lokasi . $underscore . $token_reborn3 . $underscore . $kata . $underscore  . $today . $underscore . sprintf('%06s', $nourut);


                $datein = $this->request->getVar('datein');
                $timein = $this->request->getVar('timein');
                $datetimein = $datein . ' ' . $timein;

                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'types' => $this->request->getVar('types'),
                    'validationgroups' => $this->request->getVar('types'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'documentdate' => $this->request->getVar('documentdate'),
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
                    'lakalantas' => $this->request->getVar('lakalantas'),
                    'lokasilakalantas' => $this->request->getVar('lokasilakalantas'),
                    'namapjb' => $this->request->getVar('namapjb'),
                    'alamatpjb' => $this->request->getVar('alamatpjb'),
                    'telppjb' => $this->request->getVar('telppjb'),
                    'hubunganpjb' => $this->request->getVar('hubunganpjb'),
                    //'pasienclassroom' => $this->request->getVar('pasienclassroom'),
                    'bumil' => $this->request->getVar('bumil'),
                    'dokter' => $this->request->getVar('ibsdokter'),
                    'doktername' => $this->request->getVar('ibsdoktername'),
                    'titipan' => $this->request->getVar('titipan'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'roomfisik' => $this->request->getVar('room'),
                    'roomfisikname' => $this->request->getVar('roomname'),
                    'bednumber' => $this->request->getVar('bednumber'),
                    'bedname' => $this->request->getVar('bedname'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getPost('memo'),
                    'datein' => $datein,
                    'timein' => $timein,
                    'datetimein' => $datetimein,
                    'locationcode' => $this->request->getVar('room'),
                    'locationname' => $this->request->getVar('room'),
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
                    'validation' => $this->request->getVar('validation'),
                    'validationby' => $this->request->getVar('validationby'),
                    'validationdate' => $this->request->getVar('validationdate'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'pasienclassroomchangenumber' => $this->request->getVar('pasienclassroomchangenumber'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'paymentchange' => $this->request->getPost('paymentchange'),
                    'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),
                    'reborn' => 2,


                ];
                $perawat = new ModelValidasiRanap;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Pasien Berhasil divalidasi'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function SimpanValidasiPasienPindah()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([

                'ibsdoktername' => [
                    'label' => 'DPJP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} tidak boleh kosong'
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
                $tglpulang = date('Y-m-d', strtotime($this->request->getVar("dateout")));
                $tanggaldie = $this->request->getVar('datedie');

                $lokasi = "NEWRBN";
                $room = $this->request->getVar('room');
                $norm = $this->request->getVar('pasienid');

                $tglpindah = $this->request->getVar('datein');
                $jampindah = $this->request->getVar('timein');

                $datepindah = str_replace('/', '-', $tglpindah);
                $documentdate = date('Y-m-d', strtotime($datepindah));
                $tanggaljampindah = $documentdate . ' ' . $jampindah;

                //$documentdate = date('Y-m-d');
                $db = db_connect();
                $query = $db->query("SELECT validationnumber as kode_jurnal, MAX(noantrian)as antrian FROM transaksi_pelayanan_validasi_rawatinap WHERE  documentdate='$documentdate' AND room='$room' AND reborn=3 ORDER BY id DESC LIMIT 1");
                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->antrian;
                }

                $tglpindah = $this->request->getVar('datein');
                $jampindah = $this->request->getVar('timein');

                $datepindah = str_replace('/', '-', $tglpindah);
                $documentdate = date('Y-m-d', strtotime($datepindah));
                $tanggaljampindah = $documentdate . ' ' . $jampindah;

                $today = date('ymd', strtotime($documentdate));

                //$today = date('ymd');
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
                //$kata = 'VRI';

                //$newkode = $lokasi . $underscore . $kata . $underscore  . $norm . $underscore . $today . $underscore . sprintf('%06s', $nourut);

                helper('text');
                $token = random_string('alnum', 9);
                $token_reborn = strtoupper($token);

                $migrasi = $this->request->getVar('room');
                $kata = 'REBORN-VP-' . $migrasi;
                $newkode = $lokasi . $underscore . $token_reborn . $underscore . $kata . $underscore  . $today . $underscore . sprintf('%06s', $nourut);





                $simpandata = [
                    'groups' => $this->request->getVar('groups'),
                    'types' => $this->request->getVar('types'),
                    'validationgroups' => $this->request->getVar('types'),
                    'validationnumber' => $newkode,
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'parentjournalnumber' => $this->request->getVar('parentjournalnumber'),
                    'documentdate' => $documentdate,
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
                    'titipan' => $this->request->getVar('titipan'),
                    'smf' => $this->request->getVar('smf'),
                    'smfname' => $this->request->getVar('smfname'),
                    'classroom' => $this->request->getVar('classroom'),
                    'classroomname' => $this->request->getVar('classroomname'),
                    'room' => $this->request->getVar('room'),
                    'roomname' => $this->request->getVar('roomname'),
                    'roomfisik' => $this->request->getVar('room'),
                    'roomfisikname' => $this->request->getVar('roomname'),
                    'bednumber' => $this->request->getVar('bednumber'),
                    'bedname' => $this->request->getVar('bedname'),
                    'parentid' => $this->request->getVar('parentid'),
                    'parentname' => $this->request->getVar('parentname'),
                    'memo' => $this->request->getPost('memo'),
                    'datein' => $documentdate,
                    'timein' => $jampindah,
                    'datetimein' => $tanggaljampindah,
                    'locationcode' => $this->request->getVar('room'),
                    'locationname' => $this->request->getVar('room'),
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
                    'validation' => $this->request->getVar('validation'),
                    'validationby' => $this->request->getVar('validationby'),
                    'validationdate' => $this->request->getVar('validationdate'),
                    'pasienclassroomchange' => $this->request->getVar('pasienclassroomchange'),
                    'pasienclassroomchangenumber' => $this->request->getVar('pasienclassroomchangenumber'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'paymentchange' => $this->request->getPost('paymentchange'),
                    'paymentchangenumber' => $this->request->getVar('paymentchangenumber'),
                    'reborn' => 3,


                ];
                $perawat = new ModelValidasiRanap;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Pasien Berhasil divalidasi'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ValidasiPindah()
    {

        return view('rawatinap/DVRPindah');
    }

    public function ambildataPindah()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelranapvalidasi();
            $data = [
                'tampildata' => $perawat->ambildatarajalpindahan()
            ];
            $msg = [
                'data' => view('rawatinap/data_validasi_pasien_ranap_pindah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

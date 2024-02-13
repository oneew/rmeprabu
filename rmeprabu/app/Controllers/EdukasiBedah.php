<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_icd;
use App\Models\Modeledukasibedahtim;
use App\Models\Model_autocomplete;
use App\Models\ModelDetailibs;
use App\Models\Modeledukasibedah;
use App\Models\Modelibs;
use App\Models\Modeledukasi;
use App\Models\ModelPasienRanap;
use Config\Services;

use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class EdukasiBedah extends Controller
{


    public function index()
    {
        $db = db_connect();
        $smf = $db->query("SELECT * FROM pelayanan_smf WHERE vclaimcode IS NOT NULL ORDER BY name DESC")->getResult();
        $data = [
            'smf' => $smf,
        ];
        echo view('ibs/index_edukasi', $data);
    }

    public function ajax_list()
    {
        $request = Services::request();
        $m_icd = new Model_icd($request);

        if ($request->getMethod(true) == 'POST') {
            $lists = $m_icd->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $tomboledit = '<form method="post" action="EdukasiBedah/prabedah">
                <input type="hidden" name="id" id="id" value="' . $list->id . '">
                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-tags"></i></button>
                </form>';
                $row[] = $tomboledit;
                $row[] = $no;
                $row[] = $list->documentdate;
                $row[] = $list->journalnumber;

                $row[] = $list->pasienid;
                $row[] = $list->pasienname;
                $row[] = $list->paymentmethodname;
                $row[] = $list->smfname;
                $row[] = $list->doktername;


                $data[] = $row;
            }

            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $m_icd->count_all(),
                "recordsFiltered" => $m_icd->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function prabedah($id = '')
    {
        $id = $this->request->getVar('id');
        $db = db_connect();
        $groups_ibs = $db->query("SELECT * FROM list_groups_ibs")->getResult();
        $list = $db->query("SELECT * FROM dokter")->getResult();
        $m_icd = new Model_icd($this->request);
        $row = $m_icd->get_data_ibs($id);
        $EB = $m_icd->get_data_edukasibedah($id);

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
            'namapjb' => $row['namapjb'],
            'diagnosis' => isset($EB['diagnosis']) != null ? $EB['diagnosis'] : "",
            'kondisipasien' => isset($EB['kondisipasien']) != null ? $EB['kondisipasien'] : "",
            'pemberiinformasi' => isset($EB['pemberiinformasi']) != null ? $EB['pemberiinformasi'] : "",
            'tindakandiusulkan' => isset($EB['tindakandiusulkan']) != null ? $EB['tindakandiusulkan'] : "",
            'signature' => isset($EB['signature']) != null ? $EB['signature'] : "",
            'manfaattindakan' => isset($EB['manfaattindakan']) != null ? $EB['manfaattindakan'] : "",
            'tatacara' => isset($EB['tatacara']) != null ? $EB['tatacara'] : "",
            'risikotindakan' => isset($EB['risikotindakan']) != null ? $EB['risikotindakan'] : "",
            'komplikasitindakan' => isset($EB['komplikasitindakan']) != null ? $EB['komplikasitindakan'] : "",
            'dampaktindakan' => isset($EB['dampaktindakan']) != null ? $EB['dampaktindakan'] : "",
            'prognosistindakan' => isset($EB['prognosistindakan']) != null ? $EB['prognosistindakan'] : "",
            'alternatif' => isset($EB['alternatif']) != null ? $EB['alternatif'] : "",
            'bilatidakditindak' => isset($EB['bilatidakditindak']) != null ? $EB['bilatidakditindak'] : "",
        ];

        return view('ibs/detail_edukasi_bedah', $data);
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


    public function ambildatadetailibs()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelDetailibs();

            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'tampildata' => $perawat->where('journalnumber', $journalnumber)
                    ->orderBy('documentdate', 'DESC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/data_detail_ibs_edukasibedah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    // public function ambildataoperasi()
    // {
    //     if ($this->request->isAJAX()) {

    //         $perawat = new ModelDetailibs();

    //         $journalnumber = $this->request->getVar('journalnumber');
    //         $data = [
    //             'tampildata' => $perawat->where('journalnumber', $journalnumber)
    //                 ->orderBy('documentdate', 'DESC')
    //                 ->findAll()
    //         ];
    //         $msg = [
    //             'data' => view('ibs/dataoperasiinputjadwal', $data)
    //         ];
    //         echo json_encode($msg);
    //     } else {
    //         exit('tidak dapat diproses');
    //     }
    // }

    public function cek()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelDetailibs();

            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'tampildata' => $perawat->where('journalnumber', $journalnumber)
                    ->orderBy('documentdate', 'DESC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/doij', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function formsetupjadwal()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new ModelDetailibs();

            $db = db_connect();
            $kamarok = $db->query("SELECT * FROM rooms WHERE status=0 ORDER BY kode")->getResult();
            $teknikanestesi = $db->query("SELECT * FROM teknik_anestesi ORDER BY deskripsi")->getResult();

            $row = $perawat->find($id);
            $journalnumber = $row['journalnumber'];

            $cek_header = $perawat->get_list_perawat($journalnumber);
            $paymentcardnumber = $cek_header['paymentcardnumber'];
            $smf = $cek_header['smfname'];
            $namapoli = $cek_header['smfname'];
            $cekkodepoli = $perawat->get_bpjs_code($namapoli);
            $kodepolibpjs = $cekkodepoli['bpjscode'];



            $data = [
                'id' => $row['id'],
                'journalnumber' => $row['journalnumber'],
                'relation' => $row['relation'],
                'relationname' => $row['relationname'],
                'referencenumber' => $row['referencenumber'],
                'paymentmethod' => $row['paymentmethod'],
                'operationgroup' => $row['operationgroup'],
                'doktername' => $row['doktername'],
                'name' => $row['name'],
                'groupname' => $row['groupname'],
                'kamarok' => $kamarok,
                'teknikanestesi' => $teknikanestesi,
                'paymentcardnumber' => $paymentcardnumber,
                'namapoli' => $smf,
                'kodepoli' => $kodepolibpjs,

            ];
            $msg = [
                'sukses' => view('ibs/modaljadwal', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'room' => [
                    'label' => 'Ruangan Operasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ],
                'dt_advice_op' => [
                    'label' => 'Jadwal Operasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'ibsroom' => $validation->getError('room'),
                        'ibsmindate' => $validation->getError('dt_advice_op')

                    ]
                ];
            } else {
                $tgloperasi = date('Y-m-d H:i:s', strtotime($this->request->getVar("dt_advice_op")));

                $db = db_connect();
                $journalnumber = $this->request->getVar('journalnumber');

                $query = $db->query("SELECT icdxname, ibsanestesiname FROM transaksi_pelayanan_rawatinap_operasi_header WHERE journalnumber='$journalnumber' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $icdxname = $row->icdxname;
                    $ibsanestesiname = $row->ibsanestesiname;
                }


                $simpandata = [

                    'id_tprod' => $this->request->getVar('id_tprod'),
                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'paymentmethod' => $this->request->getVar('paymentmethod'),
                    'cases' => $this->request->getVar('cases'),
                    'name' => $this->request->getVar('name'),
                    'ibsdoktername' => $this->request->getVar('ibsdoktername'),
                    'ibsanestesiname' => $ibsanestesiname,
                    'jenis_anestesi' => $this->request->getVar('jenisanestesi'),
                    'room' => $this->request->getVar('room'),
                    'dt_advice_op' => $tgloperasi,
                    'diagnosa_prabedah' => $icdxname,
                    'user' => $this->request->getVar('user'),
                    'groupname' => $this->request->getVar('groupname'),
                    'kodepoli' => $this->request->getVar('kodepoli'),
                    'namapoli' => $this->request->getVar('namapoli'),
                    'kodebooking' => $this->request->getVar('referencenumber'),
                    'cardnumber' => $this->request->getVar('paymentcardnumber'),
                    'tanggaloperasi' => $tgloperasi,

                ];
                $perawat = new Modeledukasibedah;

                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Operasi sudah berhasil dijadwalkan, silakan mengisi kelengkapan tim'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function datajadwal()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modeledukasibedah();

            $journalnumber = $this->request->getVar('journalnumber');

            $data = [
                'tampildata' => $perawat->where('journalnumber', $journalnumber)
                    ->orderBy('id', 'DESC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/datajadwaloperasibaru', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function hapusjadwal()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new Modeledukasibedah;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data jadwal Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }


    public function formedittim()
    {
        if ($this->request->isAJAX()) {


            $id = $this->request->getVar('id');

            $perawat = new Modeledukasibedah();

            $db = db_connect();



            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'id_tprod' => $row['id_tprod'],
                'journalnumber' => $row['journalnumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'referencenumber' => $row['referencenumber'],
                'paymentmethod' => $row['paymentmethod'],
                'cases' => $row['cases'],
                'ibsdoktername' => $row['ibsdoktername'],
                'ibsanestesiname' => $row['ibsanestesiname'],
                'name' => $row['name'],
                'groupname' => $row['groupname'],
                'room' => $row['room'],
                'jenis_anestesi' => $row['jenis_anestesi'],
                'diagnosa_prabedah' => $row['diagnosa_prabedah'],
                'dt_advice_op' => $row['dt_advice_op'],



            ];
            $msg = [
                'sukses' => view('ibs/inputtim', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function ajax_pelayanan()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_perawat($key);
        foreach ($data as $row) {
            // menulis ulang array/ mengganti key nama menjadi value
            $json[] = [
                'value' => $row['nama'],
                'id' => $row['id'],
                'jabatan' => $row['jabatan']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function simpandatabanyak()
    {
        if ($this->request->isAJAX()) {

            $id_tprod = $this->request->getVar('id_tprod');
            $journalnumber = $this->request->getVar('journalnumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $pasienid = $this->request->getVar('pasienid');
            $pasienname = $this->request->getVar('pasienname');
            $paymentmethod = $this->request->getVar('paymentmethod');
            $cases = $this->request->getVar('cases');
            $name = $this->request->getVar('name');
            $ibsdoktername = $this->request->getVar('ibsdoktername');
            $ibsanestesiname = $this->request->getVar('ibsanestesiname');
            $jenis_anestesi = $this->request->getVar('jenis_anestesi');
            $room = $this->request->getVar('room');
            $dt_advice_op = $this->request->getVar('dt_advice_op');
            $diagnosa_prabedah = $this->request->getVar('diagnosa_prabedah');
            $user = $this->request->getVar('user');
            $groupname = $this->request->getVar('groupname');
            $id_book_operasi = $this->request->getVar('id_book_operasi');
            $nama = $this->request->getVar('nama');
            $peran = $this->request->getVar('jabatan');

            $jmldata =  count($nama);
            for ($i = 0; $i < $jmldata; $i++) {

                $perawat = new Modeledukasibedahtim;
                $perawat->insert([
                    'id_tprod' => $id_tprod[$i],
                    'journalnumber' => $journalnumber[$i],
                    'referencenumber' => $referencenumber[$i],
                    'pasienid' => $pasienid[$i],
                    'pasienname' => $pasienname[$i],
                    'paymentmethod' => $paymentmethod[$i],
                    'cases' => $cases[$i],
                    'name' => $name[$i],
                    'ibsdoktername' => $ibsdoktername[$i],
                    'ibsanestesiname' => $ibsanestesiname[$i],
                    'jenis_anestesi' => $jenis_anestesi[$i],
                    'room' => $room[$i],
                    'dt_advice_op' => $dt_advice_op[$i],
                    'diagnosa_prabedah' => $diagnosa_prabedah[$i],
                    'user' => $user[$i],
                    'groupname' => $groupname[$i],
                    'id_book_operasi' => $id_book_operasi[$i],
                    'pelaksana' => $nama[$i],
                    'peran' => $peran[$i],
                ]);
            }

            $msg = [
                'sukses' => "$jmldata petugas sudah ditambahkan ke tim pelaksana operasi"
            ];
            echo json_encode($msg);
        }
    }


    public function ajax_switch()
    {
        $request = Services::request();
        $book = new Modeledukasibedah();
        $post = $request->getPost();
        $book->edit_book($post);
    }

    function view_dpb()
    {
        $request = Services::request();
        $journalnumber = $request->getPost();
        $book = new Modeledukasibedah();
        $get_book['book'] = $book->get_book($journalnumber);
        echo view('ibs/view_dpb', $get_book);
    }

    public function simpaninformconcent()
    {
        if ($this->request->isAJAX()) {
            $pjbgender = $this->request->getVar('pjbgender');
            if ($pjbgender == 1) {
                $jenkel = "P";
            } else {
                $jenkel = "L";
            }

            $signature_diskusi = $this->request->getVar('signature');
            $signature_informasi = $this->request->getVar('signaturepaham');

            $simpandata = [
                'namapjb' => $this->request->getVar('namapjb'),
                'alamatpjb' => $this->request->getVar('alamatpjb'),
                'pjbdateofbirth' => $this->request->getVar('pjbdateofbirth'),
                'pjbgender' => $jenkel,
                'date_informconcent' => $this->request->getVar('date_informconcent'),
                'hasiltidakterduga' => $this->request->getVar('hasiltidakterduga'),
                'diagnosis' => $this->request->getVar('diagnosis'),
                'kondisipasien' => $this->request->getVar('kondisipasien'),
                'name' => $this->request->getVar('name'),
                'tatacara' => $this->request->getVar('tatacara'),
                'manfaattindakan' => $this->request->getVar('manfaattindakan'),
                'risikotindakan' => $this->request->getVar('risikotindakan'),
                'alternatif' => $this->request->getVar('alternatif'),
                'prognosistindakan' => $this->request->getVar('prognosistindakan'),
                'bilatidakditindak' => $this->request->getVar('bilatidakditindak'),
                'hasiltidakterduga' => $this->request->getVar('hasiltidakterduga'),
                'signature_diskusi' => $signature_diskusi,
                'signature_informasi' => $signature_informasi,
            ];
            $perawat = new Modeledukasi;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Persetujuan Operasi  Berhasil disimpan'
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printbuktiinformconcent()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "INSTALASI BEDAH SENTRAL";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_informconcent_operasi($lokasikasir);

        $data = [
            'datapasien' => $pasien->get_edukasibedah($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_bukti_inform_consent_operasi', $data);
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

    public function printlaporanoperasi()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "INSTALASI BEDAH SENTRAL";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_header_lap_operasi($lokasikasir);

        $data = [
            'datapasien' => $pasien->get_laporan_operasi($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/print_bukti_laporan_operasi', $data);
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
}

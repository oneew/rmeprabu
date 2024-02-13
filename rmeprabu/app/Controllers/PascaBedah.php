<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_icd;
use App\Models\Modeledukasibedahtim;
use App\Models\Model_autocomplete;
use App\Models\ModelDetailibs;
use App\Models\Modeledukasibedah;
use App\Models\ModelLaporanOperasi;
use App\Models\ModelPasienRanap;
use Config\Services;

class PascaBedah extends Controller
{


    public function index()
    {
        $db = db_connect();
        $smf = $db->query("SELECT * FROM pelayanan_smf WHERE vclaimcode IS NOT NULL ORDER BY name DESC")->getResult();

        $data = [
            'smf' => $smf,
        ];
        echo view('ibs/index_pascabedah', $data);
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

                $tomboledit = '<form method="post" action="PascaBedah/pasca_bedah">
                <input type="hidden" name="id" id="id" value="' . $list->id . '">
                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-tags"></i></button>
                </form>';
                $row[] = $tomboledit;
                $row[] = $no;
                $row[] = $list->documentdate;

                $row[] = $list->pasienid;
                $row[] = $list->pasienname;
                $row[] = $list->paymentmethodname;
                $row[] = $list->smfname;
                $row[] = $list->ibsdoktername;
                $row[] = $list->ibsanestesiname;


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

    public function pasca_bedah($id = '')
    {
        $id = $this->request->getVar('id');
        $db = db_connect();
        $groups_ibs = $db->query("SELECT * FROM list_groups_ibs")->getResult();
        $list = $db->query("SELECT * FROM dokter")->getResult();
        $m_icd = new Model_icd($this->request);
        $row = $m_icd->get_data_ibs($id);
        $EB = $m_icd->get_data_edukasibedah($id);
        //$journalnumber = $EB['journalnumber'];
        $journalnumber = isset($EB['journalnumber']) != null ? $EB['journalnumber'] : "";
        $book = new Modeledukasibedah();


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
            'book' => $book->get_book($journalnumber),

        ];



        return view('ibs/detail_pasca_bedah', $data);
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
                'data' => view('ibs/dataoperasilaporan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ceklaporanoperasi()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelDetailibs();

            $journalnumber = $this->request->getVar('journalnumber');
            $pasien = new ModelPasienRanap($this->request);

            $data = [
                'tampildata' => $pasien->get_laporan_operasi($journalnumber),

            ];
            $msg = [
                'data' => view('ibs/datalaporanoperasi', $data)
            ];
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

    public function formedit()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $perawat = new ModelDetailibs();
            $db = db_connect();

            $row = $perawat->find($id);
            $pasien = new ModelPasienRanap($this->request);
            $journalnumber = $row['journalnumber'];
            $LO = $pasien->get_laporan_operasi_before($journalnumber);
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
                'diagnosapascabedah' => isset($LO['diagnosapascabedah']) != null ? $LO['diagnosapascabedah'] : "",
                'indikasioperasi' => isset($LO['indikasioperasi']) != null ? $LO['indikasioperasi'] : "",
                'disinfeksikulit' => isset($LO['disinfeksikulit']) != null ? $LO['disinfeksikulit'] : "",
                'eksisi' => isset($LO['eksisi']) != null ? $LO['eksisi'] : "",
                'pa' => isset($LO['pa']) != null ? $LO['pa'] : "",
                'lab' => isset($LO['lab']) != null ? $LO['lab'] : "",
                'mulaioperasi' => isset($LO['mulaioperasi']) != null ? $LO['mulaioperasi'] : "",
                'selesai' => isset($LO['selesai']) != null ? $LO['selesai'] : "",
                'durasi' => isset($LO['durasi']) != null ? $LO['durasi'] : "",
                'jumlahpendarahan' => isset($LO['jumlahpendarahan']) != null ? $LO['jumlahpendarahan'] : "",
                'transfusi' => isset($LO['transfusi']) != null ? $LO['transfusi'] : "",
                'prc' => isset($LO['prc']) != null ? $LO['prc'] : "",
                'wb' => isset($LO['wb']) != null ? $LO['wb'] : "",
                'jalanoperasi' => isset($LO['jalanoperasi']) != null ? $LO['jalanoperasi'] : "",
                'signature_dokteroperator' => isset($LO['signature_dokteroperator']) != null ? $LO['signature_dokteroperator'] : "",
                'obatanestesi' => isset($LO['obatanestesi']) != null ? $LO['obatanestesi'] : "",
                'jenisbahan' => isset($LO['jenisbahan']) != null ? $LO['jenisbahan'] : "",



            ];
            $msg = [
                'sukses' => view('ibs/inputlaporanoperasi', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanlaporanoperasi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'diagnosapascabedah' => [
                    'label' => 'Nama Diagnosa Pasca Bedah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi!'
                    ]
                ],
                'indikasioperasi' => [
                    'label' => 'Indikasi Operasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus Diisi!'
                    ]
                ],
                'jalanoperasi' => [
                    'label' => 'Deskripsi jalannya/ berlangsungnya kegiatan operasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus Diisi!'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'diagnosapascabedah' => $validation->getError('diagnosapascabedah'),
                        'indikasioperasi' => $validation->getError('indikasioperasi'),
                        'jalanoperasi' => $validation->getError('jalanoperasi')

                    ]
                ];
            } else {
                $eksisi_input = $this->request->getVar('eksisi');
                if ($eksisi_input == 1) {
                    $eksisi = "1";
                } else {
                    $eksisi = "0";
                }
                $pa_input = $this->request->getVar('pa');
                if ($pa_input == 1) {
                    $pa = "1";
                } else {
                    $pa = "0";
                }
                $lab_input = $this->request->getVar('lab');
                if ($lab_input == 1) {
                    $lab = "1";
                } else {
                    $lab = "0";
                }
                $transfusi_input = $this->request->getVar('transfusi');
                if ($transfusi_input == 1) {
                    $transfusi = "1";
                } else {
                    $transfusi = "0";
                }
                $wb_input = $this->request->getVar('wb');
                if ($wb_input == 1) {
                    $wb = "1";
                } else {
                    $wb = "0";
                }
                $prc_input = $this->request->getVar('prc');
                if ($prc_input == 1) {
                    $prc = "1";
                } else {
                    $prc = "0";
                }


                $simpandata = [

                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'ruang' => $this->request->getVar('ruang'),
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                    'pasiengender' => $this->request->getVar('pasiengender'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'operatorroom' => $this->request->getVar('operatorroom'),
                    'tanggaloperasi' => $this->request->getVar('tanggaloperasi'),
                    'cases' => $this->request->getVar('cases'),
                    'ibsdoktername' => $this->request->getVar('ibsdoktername'),
                    'ibsanestesiname' => $this->request->getVar('ibsanestesiname'),
                    'perawatinstrumen' => $this->request->getVar('perawatinstrumen'),
                    'penataanestesi' => $this->request->getVar('penataanestesi'),
                    'jenisanestesi' => $this->request->getVar('jenisanestesi'),
                    'obatanestesi' => $this->request->getVar('obatanestesi'),
                    'diagnosaprabedah' => $this->request->getVar('diagnosaprabedah'),
                    'diagnosapascabedah' => $this->request->getVar('diagnosapascabedah'),
                    'indikasioperasi' => $this->request->getVar('indikasioperasi'),
                    'jenisoperasi' => $this->request->getVar('jenisoperasi'),
                    'disinfeksikulit' => $this->request->getVar('disinfeksikulit'),
                    'jenisbahan' => $this->request->getVar('jenisbahan'),
                    'eksisi' => $eksisi,
                    'pa' => $pa,
                    'lab' => $lab,
                    'mulaioperasi' => $this->request->getVar('mulaioperasi'),
                    'selesai' => $this->request->getVar('selesaioperasi'),
                    'durasi' => $this->request->getVar('durasi'),
                    'jumlahpendarahan' => $this->request->getVar('jumlahpendarahan'),
                    'transfusi' => $transfusi,
                    'prc' => $prc,
                    'wb' => $wb,
                    'jalanoperasi' => $this->request->getVar('jalanoperasi'),
                    'signature_dokteroperator' => $this->request->getVar('signature'),

                ];
                $ibs = new ModelLaporanOperasi;

                $ibs->insert($simpandata);
                $msg = [
                    'sukses' => 'Laporan Operasi Sudah Selesai Dikerjakan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ajax_SSC()
    {
        $request = Services::request();
        $book = new Modeledukasibedah();
        $post = $request->getPost();
        $book->edit_book($post);
    }

    public function hapuslaporanoperasi()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelLaporanOperasi;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data laporan operasi Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }
}

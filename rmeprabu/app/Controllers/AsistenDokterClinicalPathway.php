<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_icd;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\Modelranapvalidasi;
use App\Models\ModelCP;
use App\Models\ModelTNODetail;
use App\Models\ModelCP2;
use Config\Services;

class AsistenDokterClinicalPathway extends Controller
{

    public function Ranap()
    {

        return view('clinicalpathway/CpRanap');
    }

    public function ambildataDact()
    {
        if ($this->request->isAJAX()) {

            $perawat = new ModelCP();
            $data = [
                'tampildata' => $perawat->ambildataranap_exist()
            ];
            $msg = [
                'data' => view('clinicalpathway/data_cp_ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriCP()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_ibs($id);
            $referencenumber = $row['referencenumber'];
            $merge = $m_icd->get_data_merge($referencenumber);

            $cp = new ModelCP();

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
                'merge' => $merge,
                'koinsiden' => $row['koinsiden'],
                'clinical' => $cp->ambildatacp(),
            ];
            $msg = [
                'sukses' => view('clinicalpathway/modalcpranap', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function resumeGabungCP()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjang($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAP($referencenumber),
                'BHP' => $resume->BHP($referencenumber),
                'PENUNJANGIGD' => $resume->SummaryPenunjangigdrajal($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
            ];
            $msg = [
                'data' => view('clinicalpathway/cp_ranap_aksi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CP_Pilihan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $pilihancp = $this->request->getVar('pilihancp');

            $CP = new ModelCP();
            $kolom_cp = $CP->diagnosa_cp_pilihan_kolom($pilihancp);

            $data = [
                'pilihan_cp' => $CP->diagnosa_cp_pilihan($pilihancp),
                'penunjang_cp' => $CP->penunjang_cp_pilihan($pilihancp),
                'max_column' => $kolom_cp['los'],
                'jumlah' => $kolom_cp['los'],
                'diagnosa' => $kolom_cp['diagnosa'],
                'tindakan_cp' => $CP->tindakan_cp_pilihan($pilihancp),
                'obat_cp' => $CP->obat_cp_pilihan($pilihancp),
                'nutrisi_cp' => $CP->nutrisi_cp_pilihan($pilihancp),
                'mobilisasi_cp' => $CP->mobilisasi_cp_pilihan($pilihancp),
                'hasil_cp' => $CP->hasil_cp_pilihan($pilihancp),
                'rencana_cp' => $CP->rencana_pemulihan_cp_pilihan($pilihancp),
            ];


            $msg = [
                'data' => view('clinicalpathway/cp_ranap_aksi_pilihan', $data)
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

    public function ReferensiCP()
    {
        $data = [
            'judul' => 'clinical pathway',
        ];
        return view('clinicalpathway/referensi_cp', $data);
    }

    public function ambildataCP()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelCP();
            $data = [
                'tampildata' => $register->ambildatacp()
            ];
            $msg = [
                'data' => view('clinicalpathway/datareferensi_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ViewCP()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $pegawai = new ModelCP;
            $diagnosa = $pegawai->get_data_cp_detail($id);
            $diagnosa_cp = $diagnosa['diagnosa'];
            $los_cp = $diagnosa['los'];
            $data = [

                'diagnosa' => $diagnosa['diagnosa'],
                'icd' => $diagnosa['icd'],
                'penunjang_cp' => $pegawai->get_data_cp_detail_penunjang($diagnosa_cp),
                'tindakan_cp' => $pegawai->get_data_cp_detail_tindakan($diagnosa_cp),
                'obat_cp' => $pegawai->get_data_cp_detail_obat($diagnosa_cp),
                'nutrisi_cp' => $pegawai->get_data_cp_detail_nutrisi($diagnosa_cp),
                'mobilisasi_cp' => $pegawai->get_data_cp_detail_mobilisasi($diagnosa_cp),
                'hasil_cp' => $pegawai->get_data_cp_detail_hasil($diagnosa_cp),
                'rencana_cp' => $pegawai->get_data_cp_detail_rencana($diagnosa_cp),
                'diagnosacp' => $diagnosa_cp,
                'los_cp' => $los_cp,

            ];
            $msg = [
                'sukses' => view('clinicalpathway/modalreferensi_cp', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function CreateDiagnosaCP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'namaform' => 'Create Diagnosa CP',

            ];
            $msg = [
                'data' => view('clinicalpathway/modalcreate_diagnosa_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDataDiagnosa()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'diagnosa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih diagnosa',
                    ]
                ]
            ]);


            $simpandata = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),
                'icd' => $this->request->getVar('icd'),
                'created_at' => date('Y-m-d'),
            ];
            $datadiri = new ModelCP();
            $datadiri->insert_diagnosa($simpandata);
            $msg = [
                'sukses' => 'Data DIagnosa Telah Disimpan',

            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function PenunjangCP()
    {
        if ($this->request->isAJAX()) {

            $diagnosa_cp = $this->request->getVar('diagnosa_cp');
            $pegawai = new ModelCP();
            $data = [
                'penunjang_cp' => $pegawai->get_data_cp_detail_penunjang($diagnosa_cp),
            ];
            $msg = [
                'data' => view('clinicalpathway/resumePenunjangCP', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function TindakanCP()
    {
        if ($this->request->isAJAX()) {

            $diagnosa_cp = $this->request->getVar('diagnosa_cp');
            $pegawai = new ModelCP();
            $data = [
                'tindakan_cp' => $pegawai->get_data_cp_detail_tindakan($diagnosa_cp),
            ];
            $msg = [
                'data' => view('clinicalpathway/resumeTindakanCP', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ObatCP()
    {
        if ($this->request->isAJAX()) {

            $diagnosa_cp = $this->request->getVar('diagnosa_cp');
            $pegawai = new ModelCP();
            $data = [
                'obat_cp' => $pegawai->get_data_cp_detail_obat($diagnosa_cp),
            ];
            $msg = [
                'data' => view('clinicalpathway/resumeObatCP', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function NutrisiCP()
    {
        if ($this->request->isAJAX()) {

            $diagnosa_cp = $this->request->getVar('diagnosa_cp');
            $pegawai = new ModelCP();
            $data = [
                'nutrisi_cp' => $pegawai->get_data_cp_detail_nutrisi($diagnosa_cp),
            ];
            $msg = [
                'data' => view('clinicalpathway/resumeNutrisiCP', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function MobilisasiCP()
    {
        if ($this->request->isAJAX()) {

            $diagnosa_cp = $this->request->getVar('diagnosa_cp');
            $pegawai = new ModelCP();
            $data = [
                'mobilisasi_cp' => $pegawai->get_data_cp_detail_mobilisasi($diagnosa_cp),
            ];
            $msg = [
                'data' => view('clinicalpathway/resumeMobilisasiCP', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function HasilCP()
    {
        if ($this->request->isAJAX()) {

            $diagnosa_cp = $this->request->getVar('diagnosa_cp');
            $pegawai = new ModelCP();
            $data = [
                'hasil_cp' => $pegawai->get_data_cp_detail_hasil($diagnosa_cp),
            ];
            $msg = [
                'data' => view('clinicalpathway/resumeHasilCP', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function RencanaCP()
    {
        if ($this->request->isAJAX()) {

            $diagnosa_cp = $this->request->getVar('diagnosa_cp');
            $pegawai = new ModelCP();
            $data = [
                'rencana_cp' => $pegawai->get_data_cp_detail_rencana($diagnosa_cp),
            ];
            $msg = [
                'data' => view('clinicalpathway/resumeRencanaCP', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusPenunjangCP()
    {
        if ($this->request->isAJAX()) {
            $hapusdata = [
                'id' => $this->request->getVar('id'),
            ];
            $TNO = new ModelCP;
            $TNO->delete_penunjangCP($hapusdata);
            $msg = [
                'sukses' => "DataBerhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function hapusTindakanCP()
    {
        if ($this->request->isAJAX()) {
            $hapusdata = [
                'id' => $this->request->getVar('id'),
            ];
            $TNO = new ModelCP;
            $TNO->delete_TindakanCP($hapusdata);
            $msg = [
                'sukses' => "DataBerhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function hapusObatCP()
    {
        if ($this->request->isAJAX()) {
            $hapusdata = [
                'id' => $this->request->getVar('id'),
            ];
            $TNO = new ModelCP;
            $TNO->delete_ObatCP($hapusdata);
            $msg = [
                'sukses' => "DataBerhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function hapusNutrisiCP()
    {
        if ($this->request->isAJAX()) {
            $hapusdata = [
                'id' => $this->request->getVar('id'),
            ];
            $TNO = new ModelCP;
            $TNO->delete_NutrisiCP($hapusdata);
            $msg = [
                'sukses' => "DataBerhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function hapusMobilisasiCP()
    {
        if ($this->request->isAJAX()) {
            $hapusdata = [
                'id' => $this->request->getVar('id'),
            ];
            $TNO = new ModelCP;
            $TNO->delete_MobilisasiCP($hapusdata);
            $msg = [
                'sukses' => "DataBerhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function hapusHasilCP()
    {
        if ($this->request->isAJAX()) {
            $hapusdata = [
                'id' => $this->request->getVar('id'),
            ];
            $TNO = new ModelCP;
            $TNO->delete_HasilCP($hapusdata);
            $msg = [
                'sukses' => "DataBerhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function hapusRencanaCP()
    {
        if ($this->request->isAJAX()) {
            $hapusdata = [
                'id' => $this->request->getVar('id'),
            ];
            $TNO = new ModelCP;
            $TNO->delete_RencanaCP($hapusdata);
            $msg = [
                'sukses' => "DataBerhasil dihapus"
            ];
            echo json_encode($msg);
        }
    }

    public function CreatePenunjangCP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),

            ];
            $msg = [
                'data' => view('clinicalpathway/modalcreate_penunjang_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ajax_penunjang()
    {
        $request = Services::request();
        $m_auto = new ModelCP2($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_penunjang($key);
        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'] . ' | ' . $row['types'],
                'name' => $row['name']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function ajax_Tindakan()
    {
        $request = Services::request();
        $m_auto = new ModelCP2($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_tindakan($key);
        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'] . ' | ' . $row['groupname'],
                'name' => $row['name']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function simpanDataPenunjang()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'diagnosa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih diagnosa',
                    ]
                ]
            ]);


            $simpandata = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),
                'penunjang' => $this->request->getVar('penunjang'),
                'created_at' => date('Y-m-d'),
            ];
            $datadiri = new ModelCP();
            $datadiri->insert_penunjang($simpandata);
            $msg = [
                'sukses' => 'Data Penunjang Telah Disimpan',

            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CreateTindakanCP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),

            ];
            $msg = [
                'data' => view('clinicalpathway/modalcreate_tindakan_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDataTindakan()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'diagnosa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih diagnosa',
                    ]
                ]
            ]);

            $simpandata = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),
                'tindakan' => $this->request->getVar('tindakan'),
                'created_at' => date('Y-m-d'),
            ];
            $datadiri = new ModelCP();
            $datadiri->insert_tindakan($simpandata);
            $msg = [
                'sukses' => 'Data Tindakan Telah Disimpan',

            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ajax_Obat()
    {
        $request = Services::request();
        $m_auto = new ModelCP2($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_obat($key);
        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'] . ' | ' . $row['types'],
                'name' => $row['name']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function CreateObatCP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),

            ];
            $msg = [
                'data' => view('clinicalpathway/modalcreate_obat_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDataObat()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'diagnosa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih diagnosa',
                    ]
                ]
            ]);

            $simpandata = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),
                'obat' => $this->request->getVar('obat'),
                'created_at' => date('Y-m-d'),
            ];
            $datadiri = new ModelCP();
            $datadiri->insert_obat($simpandata);
            $msg = [
                'sukses' => 'Data Obat Telah Disimpan',

            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CreateNutrisiCP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),

            ];
            $msg = [
                'data' => view('clinicalpathway/modalcreate_nutrisi_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDataNutrisi()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'diagnosa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih diagnosa',
                    ]
                ]
            ]);

            $simpandata = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),
                'nutrisi' => $this->request->getVar('nutrisi'),
                'created_at' => date('Y-m-d'),
            ];
            $datadiri = new ModelCP();
            $datadiri->insert_nutrisi($simpandata);
            $msg = [
                'sukses' => 'Data Nutrisi Telah Disimpan',

            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CreateMobilisasiCP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),

            ];
            $msg = [
                'data' => view('clinicalpathway/modalcreate_mobilisasi_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDataMobilisasi()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'diagnosa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih diagnosa',
                    ]
                ]
            ]);

            $simpandata = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),
                'mobilisasi' => $this->request->getVar('mobilisasi'),
                'created_at' => date('Y-m-d'),
            ];
            $datadiri = new ModelCP();
            $datadiri->insert_mobilisasi($simpandata);
            $msg = [
                'sukses' => 'Data Mobilisasi Telah Disimpan',

            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CreateHasilCP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),

            ];
            $msg = [
                'data' => view('clinicalpathway/modalcreate_hasil_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDataHasil()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'diagnosa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih diagnosa',
                    ]
                ]
            ]);

            $simpandata = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),
                'hasil' => $this->request->getVar('hasil'),
                'created_at' => date('Y-m-d'),
            ];
            $datadiri = new ModelCP();
            $datadiri->insert_hasil($simpandata);
            $msg = [
                'sukses' => 'Data Hasil(Outcome) Telah Disimpan',

            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CreateRencanaCP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),

            ];
            $msg = [
                'data' => view('clinicalpathway/modalcreate_rencana_cp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanDataRencana()
    {

        if ($this->request->isAJAX()) {

            $validation = \Config\Services::validation();
            $validation->setRules([
                'diagnosa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'belum memilih diagnosa',
                    ]
                ]
            ]);

            $simpandata = [
                'diagnosa' => $this->request->getVar('diagnosa'),
                'los' => $this->request->getVar('los'),
                'rencana' => $this->request->getVar('rencana'),
                'created_at' => date('Y-m-d'),
            ];
            $datadiri = new ModelCP();
            $datadiri->insert_rencana($simpandata);
            $msg = [
                'sukses' => 'Data Hasil(Outcome) Telah Disimpan',

            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

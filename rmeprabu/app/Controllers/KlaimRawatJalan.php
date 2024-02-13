<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\ModelTNODetailRJ;
use App\Models\ModelTNOHeaderRajal;
use App\Models\ModelPenunjangDetail;
use App\Models\ModelPasienMaster;
use App\Models\ModelKlaim;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;


class KlaimRawatJalan extends BaseController
{

    public function data_payment()
    {

        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_payment();
        return $list;
    }

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli();
        return $list;
    }


    public function Klaim()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('klaim/klaimrawatjalan', $data);
    }

    public function ambildataKlaim()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelKlaim();
            $data = [
                'tampildata' => $register->ambildatapasienpulangRajal()
            ];
            $msg = [
                'data' => view('klaim/dataklaimrawatjalan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataKlaim()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelKlaim();
            $data = [
                'tampildata' => $register->search_pasienpulang_Rajal($search)
            ];

            $msg = [
                'data' => view('klaim/dataklaimrawatjalan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatklaimrajal()
    {
        if ($this->request->isAJAX()) {
            $journalnumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienMaster();
            $klaim = new ModelKlaim();
            $konsul = $klaim->get_list_tarif_konsul_rajal($journalnumber);
            $konsulantarpoli = $klaim->get_list_tarif_konsul_rajal_detail($journalnumber);
            $tarifkonsul = $konsul['price'] + $konsulantarpoli['subtotal'];
            $biayakeperawatan = $klaim->get_list_biaya_keperawatan($journalnumber);
            $biayaradiologi = $klaim->Penunjangradiologirajal($journalnumber);
            $biayalab = $klaim->Penunjanglabrajal($journalnumber);
            $biayarehab = $klaim->Penunjangrehabrajal($journalnumber);
            $biayabankdarah = $klaim->Penunjangbankdarahrajal($journalnumber);
            $farmasinonkronis = $klaim->FARMASIRAJALNONKRONIS($journalnumber);
            $farmasikronis = $klaim->FARMASIRAJALKRONIS($journalnumber);
            $data = [
                'pasienlama' => $m_icd->get_data_rajal_verifikasi($journalnumber),
                'tarifkonsul' => $tarifkonsul,
                'keperawatan' => $biayakeperawatan['subtotal'],
                'radiologi' => $biayaradiologi['subtotal'],
                'laboratorium' => $biayalab['subtotal'],
                'rehabmedik' => $biayarehab['subtotal'],
                'bankdarah' => $biayabankdarah['subtotal'],
                'obatnonkronis' => $farmasinonkronis['harga'],
                'obatkronis' => $farmasikronis['harga'],

            ];
            $msg = [
                'suksesverif' => view('klaim/modalklaimrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabungKlaim()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rajal_kasir($referencenumber);
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'OPERASI' => $resume->Operasirajal($referencenumber),
                'PENUNJANG' => $resume->Penunjangrajal($referencenumber),
                'FARMASI' => $resume->FARMASIrajal($referencenumber),
                'BHP' => $resume->BHPrajal($referencenumber),
                'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
                'advicedokter' => $row['advicedokter'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'pasienstatus' => $this->status_pasien(),
                'list' => $this->_data_dokter(),
                'id' => $row['id'],
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

                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'referencenumberparent' => $row['referencenumberparent'],
                'parentid' => $row['parentid'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'reasoncode' => $row['reasoncode'],
                'memo' => $row['memo'],
                'token_rajal' => $row['token_rajal'],
                'email' => $row['email'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'bpjs_sep' => $row['bpjs_sep'],
                'code' => $row['code'],
                'validation' => $row['validation'],
                'description' => $row['description'],
                'verifikasi' => $row['verifikasi'],
                'idverifikasi' => $row['id'],
                'klaim' => $row['klaim'],
            ];
            $msg = [
                'data' => view('klaim/data_resume_gabung_klaim_rawatjalan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function status_pasien()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pasien_status_rajal();
        return $list;
    }

    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }

    public function KlaimSelesai()
    {
        if ($this->request->isAJAX()) {

            $verifikasi = 1;
            $petugasverifikasi = $this->request->getVar('petugasverifikasi');
            $tanggalverifikasi = $this->request->getVar('tanggalverifikasi');
            $simpandata = [
                'klaim' => $verifikasi,
                'petugasklaim' => $petugasverifikasi,
                'tanggalklaim' => $tanggalverifikasi,

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update($id, $simpandata);
            $msg = [
                'sukses' => 'Posting Klaim Selesai!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function KlaimBatal()
    {
        if ($this->request->isAJAX()) {

            $verifikasi = 0;
            $simpandata = [
                'klaim' => 0,
                'petugasklaim' => 'NONE',
                'tanggalklaim' => '',

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update($id, $simpandata);
            $msg = [
                'sukses' => 'Posting Klaim Telah Dibatalkan!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printdetailkwitansiKlaim()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT JALAN";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail($journalnumber);

        $resume = new ModelTNODetailRJ();
        $klaim = new ModelKlaim();
        $referencenumber = $this->request->getVar('page');
        $journalnumber = $this->request->getVar('page');
        $nonkronis = $klaim->FARMASIRAJALNONKRONISHEADER($journalnumber);
        $jurnalfarmasi = $nonkronis['journalnumber'];
        $documentdatefarmasi = $nonkronis['documentdate'];
        $harganonkronis = $nonkronis['harga'];

        $nonkronisdetail = $klaim->FARMASIRAJALNONKRONISHEADERDETAIL($journalnumber);
        $data = [
            'datapasien' => $pasien->kunjunganigdprintverifikasi($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'TNO' => $resume->search_rajal2($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'OPERASI' => $resume->Operasirajal($referencenumber),
            'PENUNJANG' => $resume->Penunjangheaderrajal($referencenumber),
            'FARMASI' => $klaim->FARMASIRAJALNONKRONISHEADERDETAIL($journalnumber),
            'BHP' => $resume->BHPrajal($referencenumber),
            'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
            'jurnalfarmasi' => $jurnalfarmasi,
            'tanggalfarmasi' => $documentdatefarmasi,
            'hargafarmasi' => $harganonkronis,
        ];

        return view('cetakan/printdetailrajalklaim', $data);
    }

    public function printdetailkwitansiVerifikasi()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT JALAN";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail($journalnumber);

        $resume = new ModelTNODetailRJ();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganigdprintverifikasi($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_igd($journalnumber),
            'TNO' => $resume->search_rajal2($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'OPERASI' => $resume->Operasirajal($referencenumber),
            'PENUNJANG' => $resume->Penunjangheaderrajal($referencenumber),
            'FARMASI' => $resume->FARMASIrajal($referencenumber),
            'BHP' => $resume->BHPrajal($referencenumber),
            'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
        ];

        return view('cetakan/printdetailrajalverifikasifixklaim', $data);
    }

    public function AfterKlaimRajal()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('klaim/klaimrawatjalanafter', $data);
    }

    public function DataKlaimRajal()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelKlaim();
            $data = [
                'tampildata' => $register->ambildataklaimRajal()
            ];
            $msg = [
                'data' => view('klaim/dataklaimrawatjalanafter', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataKlaimRajal()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);

            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelKlaim();
            $data = [
                'tampildata' => $register->search_klaim_Rajal($search)
            ];

            $msg = [
                'data' => view('klaim/dataklaimrawatjalanafter', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printpenjualanKonvesional()
    {

        $referencenumber = $this->request->getVar('page');
        $journalnumber = $referencenumber;
        $pasien = new ModelKlaim();

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeaderFarmasi($referencenumber),
            'tampildata' => $pasien->penjualanfarmasirajalklaim($journalnumber),

        ];
        return view('cetakan/buktireseprajalklaim', $data);
    }

    public function printpenjualanKonvesionalKronis()
    {

        $referencenumber = $this->request->getVar('page');
        $journalnumber = $referencenumber;
        $pasien = new ModelKlaim();
        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeaderFarmasi($referencenumber),
            'tampildata' => $pasien->penjualanfarmasirajalklaimkronis($journalnumber),

        ];

        return view('cetakan/buktireseprajalkronisklaim', $data);
    }

    public function printpenjualanKonvesionalNonKronis()
    {

        $id = $this->request->getVar('page');
        $referencenumber = $this->request->getVar('page');
        $journalnumber = $referencenumber;
        $pasien = new ModelKlaim();

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeaderFarmasi($referencenumber),
            'tampildata' => $pasien->penjualanfarmasirajalklaimnonkronis($journalnumber),
        ];

        return view('cetakan/buktireseprajalnonkronisklaim', $data);
    }
}

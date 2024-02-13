<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\ModelTNODetailRJ;
use App\Models\ModelTNODetail;
use App\Models\ModelTNOHeaderRajal;
use App\Models\ModelPenunjangDetail;
use App\Models\ModelPasienMaster;
use App\Models\ModelKlaim;
use App\Models\ModelCetakDetail_A;
use App\Models\ModelCetakKoinsiden_A;
use App\Models\ModelCetakNonKoinsiden_A;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;
use Dompdf\Options;



class KlaimRanap extends BaseController
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
        return view('klaim/klaimranap', $data);
    }

    public function ambildataKlaim()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelKlaim();
            $data = [
                'tampildata' => $register->ambildatapasienpulangranap()
            ];
            $msg = [
                'data' => view('klaim/dataklaimrwatinap', $data)
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
                'tampildata' => $register->search_pasienpulang_ranap($search)
            ];

            $msg = [
                'data' => view('klaim/dataklaimrawatinap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lihatklaimranap()
    {
        if ($this->request->isAJAX()) {
            $journalnumber = $this->request->getVar('journalnumber');
            $m_icd = new ModelPasienMaster();
            $klaim = new ModelKlaim();
            $konsul = $klaim->get_list_tarif_konsul_ranap($journalnumber);
            $tarifkonsul = $konsul['subtotal'];
            $biayakeperawatan = $klaim->get_list_biaya_keperawatan_ranap($journalnumber);
            $biayaradiologi = $klaim->Penunjangradiologiranap($journalnumber);
            $biayalab = $klaim->Penunjanglabigd($journalnumber);
            $biayarehab = $klaim->Penunjanglabranap($journalnumber);
            $biayabankdarah = $klaim->Penunjangbankdararanap($journalnumber);
            $farmasinonkronis = $klaim->FARMASINONKRONISRANAP($journalnumber);
            $farmasikronis = $klaim->FARMASIRANAPKRONIS($journalnumber);
            $sewaalatigd = $klaim->get_list_biaya_sewa_alat_igd($journalnumber);
            $sewaalatranap = $klaim->get_list_biaya_sewa_alat_ranap($journalnumber);
            $sewaalat = $sewaalatigd['subtotal'] + $sewaalatranap['subtotal'];
            $bmhpigd = $klaim->get_list_bmhp_igd($journalnumber);
            $bmhpranap = $klaim->get_list_bmhp_ranap($journalnumber);
            $bmhp = $bmhpigd['subtotal'] + $bmhpranap['subtotal'];
            $referencenumber = $journalnumber;
            $merge = $klaim->get_data_merge($referencenumber);


            $data = [
                'pasienlama' => $m_icd->get_data_ranap_klaim($journalnumber),
                'tarifkonsul' => $tarifkonsul,
                'keperawatan' => $biayakeperawatan['subtotal'],
                'radiologi' => $biayaradiologi['subtotal'],
                'laboratorium' => $biayalab['subtotal'],
                'rehabmedik' => $biayarehab['subtotal'],
                'bankdarah' => $biayabankdarah['subtotal'],
                'obatnonkronis' => $farmasinonkronis['harga'],
                'obatkronis' => $farmasikronis['harga'],
                'sewa_alat' => $sewaalat,
                'bmhp' => $bmhp,
                'merge' => $merge,

            ];
            $msg = [
                'suksesverif' => view('klaim/modalklaimranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeGabungKlaim()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $m_icd = new ModelPasienRanap($this->request);
            $klaim = new ModelKlaim();
            $row = $klaim->get_data_ranap_kasir($referencenumber);


            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'VISITE' => $resume->searchVisite($referencenumber),
                'OPERASI' => $resume->Operasi($referencenumber),
                'PENUNJANG' => $resume->Penunjang($referencenumber),
                'KAMAR' => $resume->Kamar($referencenumber),
                'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
                'TINIGD' => $resume->TindakanIGD($referencenumber),
                'FARMASI' => $resume->FARMASIRANAPVERIFIKASI($referencenumber),
                'BHP' => $resume->BHP($referencenumber),
                //'PENUNJANGIGD' => $resume->SummaryPenunjangigdrajal($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
                'referencenumber' => $referencenumber,
                'klaim' => $row['klaim'],
                'verifikasi' => $row['verifikasi'],
                'idverifikasi' => $row['id'],
                'referencenumber' => $referencenumber,
                'FARMASIIGD' => $resume->FarmasiRajalIgd($referencenumber),
            ];
            $msg = [
                'data' => view('klaim/data_resume_gabung_ranap_klaim', $data)
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
            $verifikasirincian->update_dataKlaim($id, $simpandata);
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

            $simpandata = [
                'klaim' => 0,
                'petugasklaim' => 'NONE',
                'tanggalklaim' => '',

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_dataKlaim($id, $simpandata);
            $msg = [
                'sukses' => 'Posting Klaim Telah Dibatalkan!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
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

    public function AfterKlaimRanap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('klaim/klaimranapafter', $data);
    }

    public function dataklaimRanap()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelKlaim();
            $data = [
                'tampildata' => $register->ambildataklaimRanap()
            ];
            $msg = [
                'data' => view('klaim/dataklaimrawatinapafter', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataKlaimRanap()
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
                'tampildata' => $register->search_klaim_Ranap($search)
            ];

            $msg = [
                'data' => view('klaim/dataklaimrawatinapafter', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printdetailkwitansiKlaimIgd()
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
            'TNO' => $resume->search_igd($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'OPERASI' => $resume->Operasiigd($referencenumber),
            'PENUNJANG' => $resume->Penunjang_igd($referencenumber),
            'FARMASI' => $resume->FARMASIigd($referencenumber),
            'BHP' => $resume->BHPigd($referencenumber),
            'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber),
        ];

        return view('cetakan/printdetailigdklaim', $data);
    }
    public function resumeGabungPilihan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetail();
            $referencenumber = $this->request->getVar('referencenumber');
            $pilihancabar = $this->request->getVar('pilihancabar');
            $klaim = new ModelKlaim();
            $row = $klaim->get_data_ranap_kasir($referencenumber);

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
                //'PENUNJANGIGD' => $resume->SummaryPenunjangigdrajal($referencenumber),
                'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
                'BHPIGD' => $resume->SummaryBHPigdrajal($referencenumber),
                'TagihanAsal' => $resume->TagihanAsal($referencenumber),
                'UangMuka' => $resume->UangMuka($referencenumber),
                'klaim' => $row['klaim'],
                'verifikasi' => $row['verifikasi'],
                'idverifikasi' => $row['id'],
                'referencenumber' => $referencenumber,

            ];
            $msg = [
                'data' => view('klaim/data_resume_gabung_ranap_klaim', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printdetailkwitansiKlaim()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap($journalnumber);

        $resume = new ModelTNODetail();

        $referencenumber = $this->request->getVar('page');
        $pilihancabar = $this->request->getVar('rincian');

        $split = new ModelKlaim();
        $cetak = new ModelCetakDetail_A();
        $data = [
            'datapasien' => $split->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'KAMAR' => $resume->Kamar($referencenumber),

            'VISITE' => $cetak->searchVisitePilihan_Al($referencenumber, $pilihancabar),
            'TNO' => $cetak->searchTNOPilihan_Al($referencenumber, $pilihancabar),
            'PENUNJANG' => $cetak->PenunjangdetailPilihanRanap_Al($referencenumber, $pilihancabar),
            'FARMASI' => $cetak->FARMASIPilihan_Al($referencenumber, $pilihancabar),
            'FARMASIIGD' => $cetak->FarmasiRajalIgdDetail_Al($referencenumber),

            'BHP' => $cetak->BHPpenunjangranapPilihan_Al($referencenumber, $pilihancabar),
            'GIZI' => $cetak->searchAsupanGiziPilihan_Al($referencenumber, $pilihancabar),
            'OPERASI' => $cetak->OperasiPilihan_Al($referencenumber, $pilihancabar),

            'PEMIGD' => $cetak->PemeriksaanIGD_Al($referencenumber),
            'TINIGD' => $cetak->TindakanIGD_AL($referencenumber),
            'PENUNJANGIGD' => $cetak->Penunjangigdrajal_Al($referencenumber),

            'cabar' => $pilihancabar,


        ];


        // $html = view('pdf/stylebootstrap');
        $html = view('pdf/printdetailranapklaim', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printdetailkwitansiKlaimKoinsiden()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap($journalnumber);

        $resume = new ModelTNODetail();

        $referencenumber = $this->request->getVar('page');
        $pilihancabar = $this->request->getVar('rincian');

        $split = new ModelKlaim();
        $cetak = new ModelCetakKoinsiden_A();
        $data = [
            'datapasien' => $split->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'TagihanAsal' => $resume->TagihanAsal($referencenumber),

            'VISITE' => $cetak->searchVisitePilihanNonKoinsiden_Al($referencenumber, $pilihancabar),
            'TNO' => $cetak->searchTNOPilihanNonKoinsiden_Al($referencenumber, $pilihancabar),
            'PENUNJANG' => $cetak->PenunjangdetailPilihanRanapNonKoinsiden_Al($referencenumber, $pilihancabar),
            'BHP' => $cetak->BHPpenunjangranapPilihanKoinsiden_Al($referencenumber, $pilihancabar),
            'GIZI' => $cetak->searchAsupanGiziPilihanNonKoinsiden_Al($referencenumber, $pilihancabar),
            'OPERASI' => $cetak->OperasiPilihan_Al($referencenumber, $pilihancabar),

            'FARMASI' => $cetak->FARMASIPilihanNonKoinsiden_Al($referencenumber, $pilihancabar),
            'FARMASIIGD' => $cetak->FarmasiRajalIgdKoinsiden_Al($referencenumber),
            'PEMIGD' => $cetak->PemeriksaanIGD_Al($referencenumber),
            'TINIGD' => $cetak->TindakanIGD_Al($referencenumber),
            'PENUNJANGIGD' => $cetak->PenunjangigdrajalKoinsidenKasir_Al($referencenumber),

            'cabar' => $pilihancabar,

        ];


        // $html = view('pdf/stylebootstrap');
        $html = view('pdf/printdetailranapklaimkoinsiden', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }
    public function printdetailkwitansiKlaimNonKoinsiden()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap($journalnumber);

        $resume = new ModelTNODetail();

        $referencenumber = $this->request->getVar('page');
        $pilihancabar = $this->request->getVar('rincian');

        $split = new ModelKlaim();
        $cetak = new ModelCetakNonKoinsiden_A();
        $data = [
            'datapasien' => $split->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'TagihanAsal' => $resume->TagihanAsal($referencenumber),

            'VISITE' => $cetak->searchVisitePilihanNonKoinsiden_Al($referencenumber, $pilihancabar),
            'TNO' => $cetak->searchTNOPilihanNonKoinsiden_Al($referencenumber, $pilihancabar),
            'PENUNJANG' => $cetak->PenunjangdetailPilihanRanapNonKoinsiden_Al($referencenumber, $pilihancabar),
            'BHP' => $cetak->BHPpenunjangranapPilihanKoinsiden_Al($referencenumber, $pilihancabar),
            'GIZI' => $cetak->searchAsupanGiziPilihanNonKoinsiden_Al($referencenumber, $pilihancabar),
            'OPERASI' => $cetak->OperasiPilihan_Al($referencenumber, $pilihancabar),

            'FARMASI' => $cetak->FARMASIPilihanNonKoinsiden_Al($referencenumber, $pilihancabar),
            'FARMASIIGD' => $cetak->FarmasiRajalIgdKoinsiden_Al($referencenumber),
            'PEMIGD' => $cetak->PemeriksaanIGD_Al($referencenumber),
            'TINIGD' => $cetak->TindakanIGD_Al($referencenumber),
            'PENUNJANGIGD' => $cetak->PenunjangdetailIgdPilihanRanapNonKoinsiden_Al($referencenumber, $pilihancabar),

            'cabar' => $pilihancabar,
        ];


        // $html = view('pdf/stylebootstrap');
        $html = view('pdf/printdetailranapklaimnonkoinsiden', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function LihatRincianObatPelayanan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelKlaim();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'DetailObat' => $resume->get_data_detail_apotek_master($referencenumber),
                'referensi' => $referencenumber,
            ];

            $msg = [
                'suksesmodalobat' => view('klaim/modalrincianobatranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printpenjualanKonvesional()
    {

        $referencenumber = $this->request->getVar('page');
        $pilihancabar = $this->request->getVar('rincian');
        $journalnumber = $referencenumber;
        $pasien = new ModelKlaim();

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeaderFarmasiRanap($referencenumber, $pilihancabar),
            'tampildata' => $pasien->penjualanfarmasiranapklaim($journalnumber, $pilihancabar),
            'cabar' => $pilihancabar,

        ];
        return view('cetakan/buktiresepranapklaim', $data);
    }
    public function printpenjualanKonvesionalKoinsiden()
    {

        $referencenumber = $this->request->getVar('page');
        $pilihancabar = $this->request->getVar('rincian');
        $journalnumber = $referencenumber;
        $pasien = new ModelKlaim();

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeaderFarmasiRanapKoinsiden($referencenumber, $pilihancabar),
            'tampildata' => $pasien->penjualanfarmasiranapklaimKoinsiden($journalnumber, $pilihancabar),
            'cabar' => $pilihancabar,

        ];
        return view('cetakan/buktiresepranapkoinsidenklaim', $data);
    }

    public function printpenjualanKonvesionalNonKoinsiden()
    {

        $referencenumber = $this->request->getVar('page');
        $pilihancabar = $this->request->getVar('rincian');
        $journalnumber = $referencenumber;
        $pasien = new ModelKlaim();

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeaderFarmasiRanapNonKoinsiden($referencenumber, $pilihancabar),
            'tampildata' => $pasien->penjualanfarmasiranapklaimNonKoinsiden($journalnumber, $pilihancabar),
            'cabar' => $pilihancabar,

        ];
        return view('cetakan/buktiresepranapnonkoinsidenklaim', $data);
    }

    public function UpdateTNOKoinsiden()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 1;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_tno($id, $simpandata);
            $msg = [
                'sukses' => 'Perubahan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function UpdateTNOKoinsidenBatal()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 0;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_tno($id, $simpandata);
            $msg = [
                'sukses' => 'Pembatalan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function UpdateVisiteKoinsiden()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 1;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_visite($id, $simpandata);
            $msg = [
                'sukses' => 'Perubahan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function UpdateVisiteKoinsidenBatal()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 0;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_visite($id, $simpandata);
            $msg = [
                'sukses' => 'Pembatalan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function UpdateOperasiKoinsiden()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 1;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_operasi($id, $simpandata);
            $msg = [
                'sukses' => 'Perubahan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function UpdateOperasiKoinsidenBatal()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 0;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_operasi($id, $simpandata);
            $msg = [
                'sukses' => 'Pembatalan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function UpdatePenunjangKoinsiden()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 1;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_penunjang($id, $simpandata);
            $msg = [
                'sukses' => 'Perubahan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function UpdatePenunjangKoinsidenBatal()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 0;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_penunjang($id, $simpandata);
            $msg = [
                'sukses' => 'Pembatalan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function UpdateFarmasiKoinsiden()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 1;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_farmasi($id, $simpandata);
            $msg = [
                'sukses' => 'Perubahan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function UpdateFarmasiKoinsidenBatal()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 0;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_farmasi($id, $simpandata);
            $msg = [
                'sukses' => 'Pembatalan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printdetailkwitansiKlaimKoinsidenKasir()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap($journalnumber);

        $resume = new ModelTNODetail();

        $referencenumber = $this->request->getVar('page');
        $pilihancabar = $this->request->getVar('rincian');

        $split = new ModelKlaim();
        $data = [
            'datapasien' => $split->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $split->searchPilihanKoinsiden($referencenumber, $pilihancabar),
            'GIZI' => $split->searchAsupanGiziPilihanKoinsiden($referencenumber, $pilihancabar),
            'VISITE' => $split->searchVisitePilihanKoinsiden($referencenumber, $pilihancabar),
            'OPERASI' => $split->OperasiPilihanKoinsiden($referencenumber, $pilihancabar),
            'PENUNJANG' => $split->PenunjangdetailPilihanRanapKoinsiden($referencenumber, $pilihancabar),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGDKoinsiden($referencenumber),
            'TINIGD' => $resume->TindakanIGDKoinsidenKasir($referencenumber),
            'FARMASI' => $split->FARMASIPilihanKoinsiden($referencenumber, $pilihancabar),
            'BHP' => $split->BHPpenunjangranapPilihanKoinsiden($referencenumber, $pilihancabar),
            'PENUNJANGIGD' => $resume->PenunjangigdrajalKoinsidenKasir($referencenumber),
            'FARMASIIGD' => $resume->FarmasiRajalIgdKoinsidenKasir($referencenumber),
            'cabar' => $pilihancabar,
            'TagihanAsal' => $resume->TagihanAsal($referencenumber),
        ];


        //$html = view('pdf/stylebootstrap');
        $html = view('pdf/printdetailranapklaimkoinsidenterbaru', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function UpdateTNOKoinsidenIGD()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 1;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_tno_igd($id, $simpandata);
            $msg = [
                'sukses' => 'Perubahan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function UpdateTNOKoinsidenBatalIGD()
    {
        if ($this->request->isAJAX()) {

            $koinsiden = 0;

            $simpandata = [
                'koinsiden' => $koinsiden

            ];
            $verifikasirincian = new ModelKlaim;
            $id = $this->request->getVar('id');
            $verifikasirincian->update_koinsiden_tno_igd($id, $simpandata);
            $msg = [
                'sukses' => 'Pembatalan Koinsiden Berhasil!'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printbuktiklaim()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "KASIR RAWAT INAP";
        $journalnumber = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_buktipembayaran($lokasikasir);
        $row3 = $pasien->get_data_print_detail_ranap_kasir($journalnumber);


        $resume = new ModelTNODetail();
        $referencenumber = $this->request->getVar('page');
        $data = [
            'datapasien' => $pasien->kunjunganranapprint($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'journalnumber' => $row3['journalnumber'],
            'documentdate' => $row3['documentdate'],
            'createdby' => $row3['createdby'],
            'pasien' => $pasien->get_detail_ranap($journalnumber),
            'TNO' => $resume->search($referencenumber),
            'GIZI' => $resume->searchAsupanGizi($referencenumber),
            'VISITE' => $resume->searchVisite($referencenumber),
            'OPERASI' => $resume->Operasi($referencenumber),
            'PENUNJANG' => $resume->Penunjangheader($referencenumber),
            'KAMAR' => $resume->Kamar($referencenumber),
            'PEMIGD' => $resume->PemeriksaanIGD($referencenumber),
            'TINIGD' => $resume->TindakanIGD2($referencenumber),
            'FARMASI' => $resume->FARMASI($referencenumber),
            'BHP' => $resume->BHPpenunjangranap($referencenumber),
            'PENUNJANGBR' => $resume->Penunjangdetail_Br($referencenumber),
            'PENUNJANGBRUSG' => $resume->Penunjangdetail_BrUSG($referencenumber),
            'TNOEKG' => $resume->search_EKG($referencenumber),
            'TNOEEG' => $resume->search_EEG($referencenumber),
            'TNOUSG' => $resume->search_USG($referencenumber),
            'TNONoPenunjang' => $resume->search_TNO_NoPenunjang($referencenumber),
            'TagihanAsal' => $resume->TagihanAsal($referencenumber),
            'PENUNJANGIGD' => $resume->Penunjangigdrajal($referencenumber),
            'FARMASIIGD' => $resume->FarmasiRajalIgd($referencenumber),
            'KONSULIGD' => $resume->KonsulIGD($referencenumber),
            'PENUNJANG_Gab' => $resume->PenunjangheaderGab($referencenumber),

            'TNOEKGIGD' => $resume->search_EKGIGD($referencenumber),
            'TNOEEGIGD' => $resume->search_EEGIGD($referencenumber),
            'TNOUSGIGD' => $resume->search_USGIGD($referencenumber),
            'TNONoPenunjangIGD' => $resume->search_TNO_NoPenunjangIGD($referencenumber),
            'TNO_SEWAALATIGD' => $resume->search_TINDAKAN_SEWA_ALATIGD($referencenumber),

        ];

        // $html = view('pdf/stylebootstrap');
        $html = view('pdf/printbuktiklaimranap', $data);
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

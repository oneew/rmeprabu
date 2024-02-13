<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\ModelPasienRanap;
use Config\Services;
use CodeIgniter\HTTP\Request;
use CodeItNow\BarcodeBundle\Utils\QrCode;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;


use Dompdf\Dompdf;




class PelayananRegisterCathLab extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('ibs/registerpelayananCathLab', $data);
    }
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

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataCL()
            ];
            $msg = [
                'data' => view('ibs/dataregisterCL', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoli()
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
                'tampildata' => $register->search_RegisterCL($search),
            ];

            $msg = [
                'data' => view('ibs/dataregisterCL', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function SentLis()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('patologiklinik/registerpelayananLPK', $data);
    }

    public function ambildataSentLis()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataSentLis()
            ];
            $msg = [
                'data' => view('patologiklinik/dataregisterLPK', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataSentLis()
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
                'tampildata' => $register->search_RegisterPatologiKlinik($search)
            ];

            $msg = [
                'data' => view('patologiklinik/dataregisterLPK', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ViewExpertise()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
        ];
        return view('patologiklinik/registerexpertiseLPK', $data);
    }

    public function ambildataExpertise()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildatapatologiklinikexpertise()
            ];
            $msg = [
                'data' => view('patologiklinik/dataregisterexpertiseLPK', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataExpertise()
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
                'tampildata' => $register->search_RegisterPatologiKlinikexpertise($search)
            ];

            $msg = [
                'data' => view('patologiklinik/dataregisterexpertiseLPK', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printexpertise()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PATOLOGI KLINIK";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_expertise_lpk($lokasikasir);
        $row3 = $pasien->data_kunjunganlpk($id);
        $journalnumber = $row3['journalnumber'];
        $hasilexpertise = $pasien->hasilexpertiseLpk($journalnumber);
        $data = [
            'datapasien' => $pasien->kunjunganlpk($id),
            'pemeriksaan' => $pasien->get_hasil_lis($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'expertise' => isset($hasilexpertise['expertise']) != null ? $hasilexpertise['expertise'] : "",
        ];

        $html = view('pdf/stylebootstrap');
        $html = view('pdf/expertise_lpk', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('F4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printsticker()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganlpk($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];
        $databarcode = $pasien->kunjunganLPK_pasienid($id);
        $pasienid_barcode = $databarcode['pasienid'];

        $barcode = new BarcodeGenerator();
        $barcode->setText($pasienid_barcode);
        $barcode->setLabel('');
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(1.8);
        $barcode->setThickness(25);
        $barcode->setFontSize(5);
        $code = $barcode->generate();

        $data['barcode'] = '<img src="data:image/png;base64,' . $code . '" />';



        $html = view('pdf/stylebootstrap');
        $html = view('pdf/stickerlpk', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A6', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printstickerDetail()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "PENDAFTARAN RAWAT JALAN";
        $journalnumber = $this->request->getVar('page');
        $id = $this->request->getVar('page');


        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->kunjunganlpk_detail($journalnumber),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];
        $databarcode = $pasien->kunjunganLPK_pasienid2($id);
        $pasienid_barcode = $databarcode['pasienid'];


        $pemeriksaan = $pasien->kunjunganlpk_detail($journalnumber);
        foreach ($pemeriksaan as $pem) {


            $barcode = new BarcodeGenerator();
            $barcode->setText($pem['code']);
            $barcode->setLabel('');
            $barcode->setType(BarcodeGenerator::Code128);
            $barcode->setScale(1.9);
            $barcode->setThickness(25);
            $barcode->setFontSize(5);
            $code = $barcode->generate();
            $data['barcode'][] = '<img src="data:image/png;base64,' . $code . '" />';
        }


        $html = view('pdf/stylebootstrap');
        $html = view('pdf/stickerlpk_detail', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A6', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }
}

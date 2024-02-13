<?php

namespace App\Controllers;

use App\Models\ModelDetailibs;
use Config\Services;
use App\Models\Modelranapvalidasi;
use App\Models\ModelTNODetailRJ;
use App\Models\ModelPasienRanap;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;

class SendEmailKwitansiRajal extends BaseController
{
    public function index()
    {

        if ($this->request->isAJAX()) {


            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienRanap($this->request);
            $lokasikasir = "KASIR RAWAT JALAN";
            $row2 = $m_icd->get_data_rajal_kasir_validasi_print($id);
            $row3 = $m_icd->get_data_kasir($lokasikasir);
            $data = [
                'paymentamount' => $row2['paymentamount'],
                'disc' => $row2['disc'],
                'referensibank' => $row2['referensibank'],
                'nominaldebet' => $row2['nominaldebet'],
                'payersname' => $row2['payersname'],
                'noreferensidebet' => $row2['noreferensidebet'],
                'idbayar' => $row2['id'],
                'metodepembayaran' => $row2['metodepembayaran'],
                'journalnumber' => $row2['journalnumber'],
                'referencenumber' => $row2['referencenumber'],
                'header1' => $row3['header1'],
                'header2' => $row3['header2'],
                'status' => $row3['status'],
                'alamat' => $row3['alamat'],
                'deskripsi' => $row3['deskripsi'],
                'waktu' => $row2['created_at'],
                'pasienid' => $row2['pasienid'],
                'pasienname' => $row2['pasienname'],
                'poliklinikname' => $row2['poliklinikname'],
                'paymentmethodname' => $row2['paymentmethodname'],
                'pemeriksaan' => $row2['totaldaftar'],
                'tindakan' => $row2['totaltindakan'],
                'penunjang' => $row2['totalpenunjang'],
                'bhp' => $row2['totalbhp'],
                'farmasi' => $row2['totalfarmasi'],
                'dokter' => $row2['doktername'],
                'pasienstatus' => $row2['statuspasien'],
                'paymentstatus' => $row2['paymentstatus'],


            ];

            $email = \Config\Services::email();



            $dompdf = new Dompdf();
            $html = view('pdf/stylebootstrap');
            $html .= view('pdf/Emailkwitansirajal', $data);
            $dompdf->loadhtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $name = date('d-m-Y') . 'Informasipelayanan';
            $email->setFrom('simrs.syamsudin@gmail.com', 'Informasi Pasien');
            $email->setTo('deniapriali@gmail.com');

            $email->setSubject('Kwitansi Pembayaran Pelayanan Pasien Rawat Jalan RSUD R Syamsudin, SH Kota Sukabumi');
            $email->setMessage('Berikut Informasi Pembayaran Pasien Rawat Jalan, mohon dibaca dan dicermati');
            $email->attach($dompdf->output(), 'application/pdf', $name . '.pdf', false);
            $email->send();
            $msg = [
                'sukses' => 'Email berhasil dikirim'
            ];
        }
        echo json_encode($msg);
    }
}

<?php

namespace App\Controllers;

use App\Models\ModelDetailibs;
use Config\Services;
use App\Models\Modelranapvalidasi;
use Dompdf\Dompdf;

class SendEmail extends BaseController
{
    public function index()
    {

        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $pasien = new Modelranapvalidasi();
            $row = $pasien->find($id);
            $data = [
                'id' => $row['id'],

                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
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
                'email' => $row['email'],
                'token_ranap' => $row['token_ranap'],
                'memo' => $row['memo'],
                'namapjb' => $row['namapjb'],
                'alamatpjb' => $row['alamatpjb'],
                'telppjb' => $row['telppjb'],
                'hubunganpjb' => $row['hubunganpjb'],
                'datetimein' => $row['datetimein'],
                'token' => $row['token_ranap'],
                'hakpasien' => $pasien->hakpasien(),
                'kewajibanpasien' => $pasien->kewajibanpasien(),
                'administrasi' => $pasien->administrasi(),
                'keuangan' => $pasien->keuangan(),
                'pelayanan' => $pasien->pelayanan(),

            ];

            $email = \Config\Services::email();



            $dompdf = new Dompdf();
            $html = view('pdf/stylebootstrap');
            $html .= view('pdf/informasipasien', $data);
            $dompdf->loadhtml($html);

            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $name = date('d-m-Y') . 'Informasipelayanan';
            $email->setFrom('simrs.syamsudin@gmail.com', 'Informasi Pasien');
            $email->setTo('deniapriali@gmail.com');

            $email->setSubject('Informasi Pelayanan Pasien Rawat Inap RSUD R Syamsudin, SH Kota Sukabumi');
            $email->setMessage('Berikut Informasi Pelayanan Pasien Rawat Inap, mohon dibaca dan dicermati');
            $email->attach($dompdf->output(), 'application/pdf', $name . '.pdf', false);
            $email->send();
            $msg = [
                'sukses' => 'Email berhasil dikirim'
            ];
        }
        echo json_encode($msg);
    }
}

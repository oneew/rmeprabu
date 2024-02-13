<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;

class SpriBpjs extends Controller
{

    private $base_url = 'https://new-api.bpjs-kesehatan.go.id:8080/';
    private $service_name = 'new-vclaim-rest/';

    private function header()
    {

        $data = "9606";
        $secretKey = "2aH65269D3";
        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $data . "&" . $tStamp, $secretKey, true);

        $encodedSignature = base64_encode($signature);


        $header = [
            "X-cons-id" => $data,
            "X-timestamp" => $tStamp,
            "X-signature" => $encodedSignature,
        ];
        return $header;
    }

    public function insertSpri()
    {
        if ($this->request->isAJAX()) {
            $client = new Client();

            $header = $this->header();
            $header['Content-Type'] = "Application/x-www-form-urlencoded";


            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['kodeDokter'] = $this->request->getVar('kodeDokter');
            $datasep['poliKontrol'] = $this->request->getVar('poliKontrol');
            $datasep['tglRencanaKontrol'] = $this->request->getVar('tglRencanaKontrol');
            $datasep['user'] = $this->request->getVar('createdby');

            $data = [
                "request" => [
                    "noKartu" => $datasep['noKartu'],
                    "kodeDokter" => $datasep['kodeDokter'],
                    "poliKontrol" => $datasep['poliKontrol'],
                    "tglRencanaKontrol" => $datasep['tglRencanaKontrol'],
                    "user" => $datasep['user']
                ]
            ];

            $response = $client->request('POST', $this->base_url . $this->service_name . 'RencanaKontrol/InsertSPRI', [
                'headers' => $header,
                'json' => $data

            ])->getBody()->getContents();

            $data['response'] = json_encode($response);

            echo $data['response'];
        }
    }

    public function update()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $data = [
            "request" => [
                "noSuratKontrol" => "0301R0110321K000002",
                "noSEP" => "0301R0111018V000006",
                "kodeDokter" => "11111",
                "poliKontrol" => "INT",
                "tglRencanaKontrol" => "2021-03-18",
                "user" => "coba"
            ]
        ];

        $response = $client->request('PUT', $this->base_url . $this->service_name . 'RencanaKontrol/Update', [
            'headers' => $header,
            'json' => $data

        ])->getBody()->getContents();

        var_dump($response);
    }

    public function simpanPulangSEP()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $datasep['noSep'] = $this->request->getVar('noSep');
        $datasep['statusPulang'] = $this->request->getVar('statusPulang');
        $datasep['noSuratMeninggal'] = $this->request->getVar('noSuratMeninggal');
        $datasep['tglMeninggal'] = $this->request->getVar('tglMeninggal');
        $datasep['tglPulang'] = $this->request->getVar('tglPulang');
        $datasep['tglPlg'] = $this->request->getVar('tglPulang');
        $datasep['noLPManual'] = $this->request->getVar('noLPManual');
        $datasep['user'] = $this->request->getVar('user');
        $datasep['ppkPelayanan'] = $this->request->getVar('ppkPelayanan');
        $createdby = $this->request->getVar('createdby');
        $journalnumber = $this->request->getVar('journalnumber');
        $referencenumber = $this->request->getVar('referencenumber');

        $data = [
            "request" => [
                "t_sep" => [
                    "noSep" => $datasep['noSep'],
                    "tglPlg" => $datasep['tglPlg'],
                    "ppkPelayanan" => $datasep['ppkPelayanan'],
                ]
            ]
        ];

        $response = $client->request('PUT', $this->base_url . $this->service_name . 'RencanaKontrol/Update', [
            'headers' => $header,
            'json' => $data

        ])->getBody()->getContents();

        var_dump($response);
    }
}

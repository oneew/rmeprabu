<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;
use LZCompressor\LZString as LZString;

class KontrolBpjs extends Controller
{

    private $base_url = 'https://new-api.bpjs-kesehatan.go.id:8080/';
    private $service_name = 'new-vclaim-rest/';

    // private $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
    // private $service_name = 'vclaim-rest-dev/';

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


    // private function header()
    // {

    //     $data = "16048";
    //     $secretKey = "2sVF592C78";
    //     $user_key = "e8977b2b19efa441027f84a7d07be053";
    //     date_default_timezone_set('UTC');
    //     $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
    //     $signature = hash_hmac('sha256', $data . "&" . $tStamp, $secretKey, true);

    //     $encodedSignature = base64_encode($signature);


    //     $header = [
    //         "X-cons-id" => $data,
    //         "X-timestamp" => $tStamp,
    //         "X-signature" => $encodedSignature,
    //         "user-key" => $user_key,
    //     ];
    //     return $header;
    // }

    public function insert()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $data = [
            "request" => [
                "noSEP" => "1020R0011021V003690",
                "kodeDokter" => "7615",
                "poliKontrol" => "INT",
                "tglRencanaKontrol" => "2021-10-21",
                "user" => "ws"
            ]
        ];

        $response = $client->request('POST', $this->base_url . $this->service_name . 'RencanaKontrol/insert', [
            'headers' => $header,
            'json' => $data

        ])->getBody()->getContents();

        var_dump($response);
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

    public function delete()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $data = [
            "request" => [
                "t_suratkontrol" =>
                [
                    "noSuratKontrol" => "0301R0010320K000004",
                    "user" => "xxx"
                ]
            ]
        ];

        $response = $client->request('DELETE', $this->base_url . $this->service_name . 'RencanaKontrol/Delete', [
            'headers' => $header,
            'json' => $data

        ])->getBody()->getContents();

        var_dump($response);
    }

    public function carikontrol()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $noSuratKontrol = "0301R0010120K000003";

        $response = $client->request('GET', $this->base_url . $this->service_name . 'RencanaKontrol/noSuratKontrol/' . $noSuratKontrol, [
            'headers' => $header,
        ])->getBody()->getContents();

        var_dump($response);
    }

    public function caridatarencanakontrol()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));
        $filter = $search['filter'];

        $response = $client->request('GET', $this->base_url . $this->service_name . 'RencanaKontrol/ListRencanaKontrol/tglAwal/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir . '/' . 'filter/' . $filter, [
            'headers' => $header,
        ])->getBody()->getContents();

        $data['response'] = json_decode($response);
        $msg = [
            'data' => view('rawatjalan/datarencanakontrolvclaim', $data)
        ];
        echo json_encode($msg);
    }

    public function caridatahistoripelayananSep()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));
        $filter = $search['filter'];

        $response = $client->request('GET', $this->base_url . $this->service_name . 'monitoring/HistoriPelayanan/NoKartu/' . $filter . '/' . 'tglMulai/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir, [
            'headers' => $header,
        ])->getBody()->getContents();

        $data['response'] = json_decode($response);
        $msg = [
            'data' => view('rawatjalan/datahistoripelayananSep', $data)
        ];
        echo json_encode($msg);
    }



    public function caridatahistoripelayananSepIgd()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));
        $filter = $search['filter'];

        $response = $client->request('GET', $this->base_url . $this->service_name . 'monitoring/HistoriPelayanan/NoKartu/' . $filter . '/' . 'tglMulai/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir, [
            'headers' => $header,
        ])->getBody()->getContents();



        $data['response'] = json_decode($response);
        $msg = [
            'data' => view('igd/datahistoripelayananSep', $data)
        ];
        echo json_encode($msg);
    }


    public function caridatahistoripelayananSepIgd_V2()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));
        $filter = $search['filter'];

        $response = $client->request('GET', $this->base_url . $this->service_name . 'monitoring/HistoriPelayanan/NoKartu/' . $filter . '/' . 'tglMulai/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir, [
            'headers' => $header,
        ])->getBody()->getContents();



        $cons_id = $header['X-cons-id'];
        $secretKey = "2sVF592C78";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);


        $data = [
            "metaData" => $string["metaData"],
            "response" => $datakeluaran,
        ];

        $data['response'] = json_decode($response);
        $msg = [
            'data' => view('igd/datahistoripelayananSep', $data)
        ];
        echo json_encode($msg);
    }

    public function caridatahistoripelayananSepRanap()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));
        $filter = $search['filter'];

        $response = $client->request('GET', $this->base_url . $this->service_name . 'monitoring/HistoriPelayanan/NoKartu/' . $filter . '/' . 'tglMulai/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir, [
            'headers' => $header,
        ])->getBody()->getContents();

        $data['response'] = json_decode($response);
        $msg = [
            'data' => view('rawatinap/datahistoripelayananSep', $data)
        ];
        echo json_encode($msg);
    }

    public function caridatapelayananfingerprint()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $dateout = explode('-', $search['tglpelayanan']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));

        $response = $client->request('GET', $this->base_url . $this->service_name . 'SEP/FingerPrint/List/Peserta/TglPelayanan/' . $tglawal, [
            'headers' => $header,
        ])->getBody()->getContents();

        $data['response'] = json_decode($response);

        $msg = [
            'data' => view('rawatjalan/datapelayananFingerPrint', $data)
        ];
        echo json_encode($msg);
    }


    public function stringDecrypt($key, $string)
    {

        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);

        return $output;
    }
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;

class Bpjs2 extends Controller
{

    function header()
    {
        //const id
        $data = "1168";
        //secret key
        $secretKey = "4iK5B08401";
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

    function cek_rujukan()
    {

        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        // jika rujukan tidak ada tambahkan rs Rujukan/RS/List/Peserta/0000066360565
        $nokartu = '0000066360565';
        $response = $client->request('GET', $base_url . $service_name . 'Rujukan/List/Peserta/' . $nokartu, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        echo ($response);
    }
}

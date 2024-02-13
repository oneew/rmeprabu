<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;

class MonitoringBpjs extends Controller
{

    private $base_url = 'https://new-api.bpjs-kesehatan.go.id:8080/';
    private $service_name = 'new-vclaim-rest/';

    // private $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
    // private $service_name = 'vclaim-rest-dev/';

    private function header()
    {
        //yg lama
        $data = "9606";
        $secretKey = "2aH65269D3";
        //yg baru
        // $data = "16048";
        // $secretKey = "2sVF592C78";
        // $user_key = "e8977b2b19efa441027f84a7d07be053";
        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $data . "&" . $tStamp, $secretKey, true);

        $encodedSignature = base64_encode($signature);


        $header = [
            "X-cons-id" => $data,
            "X-timestamp" => $tStamp,
            "X-signature" => $encodedSignature,
            //"user_key" => $user_key,
        ];
        return $header;
    }


    public function caridataklaim()
    {
        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $mulai = $search['tglPulang'];
        $tglpulang = date('Y-m-d', strtotime($mulai));
        $statusKlaim = $search['statusKlaim'];
        $jnsPelayanan = $search['jnsPelayanan'];

        $response = $client->request('GET', $this->base_url . $this->service_name . 'Monitoring/Klaim/Tanggal/' . $tglpulang . '/' . 'JnsPelayanan/' . $jnsPelayanan . '/' . 'Status/' . $statusKlaim, [
            'headers' => $header,
        ])->getBody()->getContents();



        $data['response'] = json_decode($response);

        $msg = [
            'data' => view('dashboard/datamonitoringklaim', $data)
        ];
        echo json_encode($msg);
    }





    public function caridataklaimJasaRaharja()
    {
        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $search = $this->request->getPost();
        $dateout = explode('-', $search['periode']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));

        $response = $client->request('GET', $this->base_url . $this->service_name . 'monitoring/JasaRaharja/tglMulai/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir, [
            'headers' => $header,
        ])->getBody()->getContents();



        $data['response'] = json_decode($response);

        $msg = [
            'data' => view('dashboard/datamonitoringklaimJasaRaharja', $data)
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

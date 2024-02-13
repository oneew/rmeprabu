<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;
use LZCompressor\LZString as LZString;

use App\Models\Modelrajal;

class Vclaim2 extends Controller
{

    public function header()
    {
        //const id
        $data = "1168";
        //secret key
        $secretKey = "4iK5B08401";
        $user_key = "783a9f584e4ec299389c10185b90235b";
        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $data . "&" . $tStamp, $secretKey, true);

        $encodedSignature = base64_encode($signature);


        $header = [
            "X-cons-id" => $data,
            "X-timestamp" => $tStamp,
            "X-signature" => $encodedSignature,
            "user_key" => $user_key,
        ];
        return $header;
    }

    function cek_rujukan()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        //$header['Content-Type'] = "Application/x-www-form-urlencoded";
        $noPeserta = '0000066360565';
        $response = $client->request('GET', $base_url . $service_name . 'Rujukan/List/Peserta/' . $noPeserta, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        var_dump($response);
    }

    public function cek_noKa()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $noPeserta = '0001131506638';
        $tglSep = '2021-12-09';
        $response = $client->request('GET', $base_url . $service_name . 'Peserta/nokartu/' . $noPeserta . '/' . 'tglSEP/'  . $tglSep, [
            'headers' => $this->header(),
        ])->getBody()->getContents();


        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $response = json_decode($keluaran, true);
        echo json_encode($response);
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

    function decompress($string)
    {

        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }

    public function referensiDokter()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $jnsPelayanan = '1';
        $tglSep = '2021-12-08';
        $spesialis = 'Subspesialis';
        $response = $client->request('GET', $base_url . $service_name . 'referensi/dokter/pelayanan/' . $jnsPelayanan . '/' . 'tglPelayanan/'  . $tglSep . '/' . 'Spesialis/' . $spesialis, [
            'headers' => $this->header(),
        ])->getBody()->getContents();



        //$cons_id = "1168";
        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        var_dump($response);

        echo json_encode($data);
    }

    public function referensiPoli()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $poli = 'INT';
        $response = $client->request('GET', $base_url . $service_name . 'referensi/poli/' . $poli, [
            'headers' => $this->header(),
        ])->getBody()->getContents();



        //$cons_id = "1168";
        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        var_dump($response);
        echo json_encode($data);
    }



    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_polibpjs();
        return $list;
    }

    public function Hfis()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/jadwaldokter', $data);
    }
}

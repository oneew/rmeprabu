<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;
use LZCompressor\LZString as LZString;

use App\Models\Modelrajal;
use App\Models\ModelPasienMaster;
use App\Models\Model_autocomplete;
use DateTime;

class WsAntrean extends Controller
{

    public function header()
    {

        $data = "16048";
        $secretKey = "2sVF592C78";
        $user_key = "d59750e5f413ae522ca6de6d656cde36";
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

    public function referensiPoli()
    {
        return view('wsantrean/ListPoli');
    }

    public function datareferensiPoli()
    {

        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'antreanrs_dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url . $service_name . 'ref/poli', [
            'headers' => $this->header(),
        ])->getBody()->getContents();


        $cons_id = $header['X-cons-id'];
        $secretKey = "2sVF592C78";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data['response'] = json_decode($keluaran, true);


        $msg = [
            'data' => view('wsantrean/referensipoli', $data)
        ];
        echo json_encode($msg);
    }

    public function referensiDokter()
    {
        return view('wsantrean/ListDokter');
    }

    public function datareferensiDokter()
    {

        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'antreanrs_dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url . $service_name . 'ref/dokter', [
            'headers' => $this->header(),
        ])->getBody()->getContents();


        $cons_id = $header['X-cons-id'];
        $secretKey = "2sVF592C78";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data['response'] = json_decode($keluaran, true);

        $msg = [
            'data' => view('wsantrean/referensidokter', $data)
        ];
        echo json_encode($msg);
    }

    public function ReferensiJadwalDokter()
    {
        $data = [
            'pelayanan' => $this->smf(),
        ];
        return view('wsantrean/ListJadwalDokter', $data);
    }


    public function DataJadwalDokter()
    {
        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'antreanrs_dev/';

        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');
        $documentdate = $this->request->getVar('tglPelayanan');
        $tglPelayanan = date('Y-m-d', strtotime($documentdate));

        $response = $client->request('GET', $base_url .  $service_name . 'jadwaldokter/kodepoli/' . $filter . '/' . 'tanggal/'  . $tglPelayanan, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "2sVF592C78";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);

        if ($string['metadata']['code'] == 201) {
            $msg = [
                'gagal' => true,
                'pesan' => 'Tidak ada Jadwal',
            ];
        } else {

            $keluaran = $this->stringDecrypt($key, $string['response']);
            $data['response'] = json_decode($keluaran, true);
            $msg = [
                'success' => true,
                'pesan' => $string['metadata']['message'],
                'data' => view('wsantrean/referensijadwaldokter', $data)
            ];
        }
        echo json_encode($msg);
    }



    public function smf()
    {
        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_polibpjs();
        return $list;
    }

    public function DokterHFIS()
    {
        return view('wsantrean/ListDokterHFIS');
    }

    public function datareferensiDokterHFIS()
    {

        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'antreanrs_dev/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url . $service_name . 'ref/dokter', [
            'headers' => $this->header(),
        ])->getBody()->getContents();


        $cons_id = $header['X-cons-id'];
        $secretKey = "2sVF592C78";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data['response'] = json_decode($keluaran, true);

        $msg = [
            'data' => view('wsantrean/referensidokterHFIS', $data)
        ];
        echo json_encode($msg);
    }

    public function UpdateHFIS()
    {
        if ($this->request->isAJAX()) {
            $kodepoli = $this->request->getVar('kodepoli');
            $kodesubspesialis = $this->request->getVar('kodesubspesialis');
            $kodedokter = $this->request->getVar('kodedokter');
            $namadokter = $this->request->getVar('namadokter');

            $data = [
                'kodepoli' => $kodepoli,
                'kodesubspesialis' => $kodesubspesialis,
                'kodedokter' => $kodedokter,
                'namadokter' => $namadokter,
            ];
            $msg = [
                'sukses' => view('wsantrean/modalupdateHFIS', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function SimpanUpdateHFIS()
    {
        if ($this->request->isAJAX()) {
            $datasep['kodepoli'] = $this->request->getVar('kodepoli');
            $datasep['kodesubspesialis'] = $this->request->getVar('kodesubspesialis');
            $datasep['kodedokter'] = $this->request->getVar('kodedokter');
            $datasep['hari'] = $this->request->getVar('hari');
            $datasep['buka'] = $this->request->getVar('buka');
            $datasep['tutup'] = $this->request->getVar('tutup');

            $header = $this->header();
            $sep = json_decode($this->update_hfis($datasep, $header), true);

            $cons_id = $header['X-cons-id'];
            $secretKey = "2sVF592C78";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $keluaran = $this->stringDecrypt($key, $sep);
            $datakeluaran = json_decode($keluaran, true);
            // var_dump($sep);
            // die();
            $msg = [
                'success' => true,
                'pesan' => $sep,
            ];
        }
        echo json_encode($msg);
    }

    private function update_hfis($param, $header)
    {

        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'antreanrs_dev/';

        $data = [
            "kodepoli" => $param['kodepoli'],
            "kodesubspesialis" => $param['kodesubspesialis'],
            "kodedokter" => $param['kodedokter'],
            "jadwal" => [
                [
                    "hari" => $param['hari'],
                    "buka" => $param['buka'],
                    "tutup" => $param['tutup']
                ]
            ]


        ];
        $client = new Client();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $base_url .  $service_name  . 'jadwaldokter/updatejadwaldokter', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();
        //var_dump($data);

        return json_encode($response);
    }

    public function UpdateTaskID()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row($id);
            $milliseconds = round(microtime(true) * 1000);

            $data = [
                'id' => $rajal['id'],
                'statustaskid' => $this->listaskid(),
                'kodeboking' => $rajal['kodebooking'],
                'posisitaskid' => $rajal['taskid'],
                'milisecond' => $milliseconds,
            ];
            $msg = [
                'suksesmodalsep' => view('wsantrean/modaltaskidrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function SimpanUpdateTaskID()
    {
        if ($this->request->isAJAX()) {
            $datasep['kodeboking'] = $this->request->getVar('kodeboking');
            $datasep['taskid'] = $this->request->getVar('taskid');
            $datasep['waktu'] = $this->request->getVar('waktu');

            $header = $this->header();
            $sep = json_decode($this->simpan_taskid($datasep, $header), true);

            $cons_id = $header['X-cons-id'];
            $secretKey = "2sVF592C78";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $keluaran = $this->stringDecrypt($key, $sep);
            $datakeluaran = json_decode($keluaran, true);

            $msg = [
                'success' => true,
                'pesan' => $sep,
            ];
        }
        echo json_encode($msg);
    }

    private function simpan_taskid($param, $header)
    {

        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'antreanrs_dev/';

        $data = [
            "kodebooking" => $param['kodeboking'],
            "taskid" => $param['taskid'],
            "waktu" => $param['waktu']

        ];
        $client = new Client();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $base_url .  $service_name  . 'antrean/updatewaktu', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return json_encode($response);
    }

    public function listaskid()
    {
        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_taskid();
        return $list;
    }

    public function TaskID()
    {

        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row($id);
            $datasep['kodebooking'] = $rajal['kodebooking'];


            $header = $this->header();
            $sep = json_decode($this->listTask($datasep, $header), true);

            $cons_id = $header['X-cons-id'];
            $secretKey = "2sVF592C78";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $keluaran = $this->stringDecrypt($key, $sep);
            $datakeluaran = json_decode($keluaran, true);
            // var_dump($sep);
            // die();
            $msg = [
                'success' => true,
                'pesan' => $sep,
            ];
        }
        echo json_encode($msg);
    }

    private function listTask($param, $header)
    {

        $base_url = 'https://apijkn-dev.bpjs-kesehatan.go.id/';
        $service_name = 'antreanrs_dev/';

        $data = [
            "kodebooking" => $param['kodebooking']
        ];
        $client = new Client();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $base_url .  $service_name  . 'antrean/getlisttask', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();
        //var_dump($data);

        return json_encode($response);
    }

    public function UpdateTaskIDFarmasi()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row_direct($id);
            $milliseconds = round(microtime(true) * 1000);

            $data = [
                'id' => $rajal['id'],
                'statustaskid' => $this->listaskid(),
                'kodeboking' => $rajal['kodebooking'],
                'posisitaskid' => $rajal['taskid'],
                'milisecond' => $milliseconds,
            ];
            $msg = [
                'suksesmodalsep' => view('wsantrean/modaltaskidrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function TaskIDFarmasi()
    {

        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelPasienMaster();
            $rajal = $m_icd->get_data_rajal_row_direct($id);
            $datasep['kodebooking'] = $rajal['kodebooking'];


            $header = $this->header();
            $sep = json_decode($this->listTask($datasep, $header), true);

            $cons_id = $header['X-cons-id'];
            $secretKey = "2sVF592C78";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $keluaran = $this->stringDecrypt($key, $sep);
            $datakeluaran = json_decode($keluaran, true);
            // var_dump($sep);
            // die();
            $msg = [
                'success' => true,
                'pesan' => $sep,
            ];
        }
        echo json_encode($msg);
    }
}

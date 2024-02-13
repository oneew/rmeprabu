<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;
use LZCompressor\LZString as LZString;

use App\Models\Modelrajal;
use App\Models\ModelPasienMaster;
use App\Models\Model_autocomplete;




class VclaimAntrean extends Controller
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



        //$cons_id = "16048";
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



        //$cons_id = "16048";
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

    public function referensiDokterHfis()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        $kodepoli = $search['jnsPelayanan'];
        $tglPelayanan = $search['tglPelayanan'];
        $response = $client->request('GET', $base_url . 'jadwaldokter/kodepoli/' . $kodepoli . '/' . 'tanggal/'  . $tglPelayanan, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

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

    public function Faskes()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/Listfaskes', $data);
    }

    public function referensiFaskes()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $kodefaskes = $this->request->getVar('kodefaskes');
        $jenisfaskes = $this->request->getVar('filter');


        //$kodefaskes = '0121U009';
        // $jenisfaskes = '2';

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/faskes/' . $kodefaskes . '/'  . $jenisfaskes, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistfaskes', $data)
        ];
        echo json_encode($msg);

        //echo json_encode($data);
    }

    public function Poli()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/Listpoli', $data);
    }

    public function referensiPoliVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $kodepoli = $this->request->getVar('kodepoli');

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/poli/' . $kodepoli, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistpoli', $data)
        ];
        echo json_encode($msg);
    }

    public function Diagnosa()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/Listdiagnosa', $data);
    }

    public function referensiDiagnosaVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/diagnosa/' . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistdiagnosa', $data)
        ];
        echo json_encode($msg);
    }

    public function Dokter()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/Listdokter', $data);
    }

    public function referensiDokterVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');
        $tglPelayanan = $this->request->getVar('tglPelayanan');
        $spesialis = $this->request->getVar('spesialis');

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/dokter/pelayanan/' . $filter . '/' . 'tglPelayanan/'  . $tglPelayanan . '/' . 'Spesialis/' . $spesialis, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        // $data = [
        //     'list' => $datakeluaran,
        //     'pesan' => $response,
        // ];


        $msg = [
            'data' => view('vclaim/datalistdokter', $data)
        ];
        echo json_encode($msg);
    }

    public function DiagnosaPRB()
    {
        return view('vclaim/ListdiagnosaPRB');
    }

    public function referensiDiagnosaPRB()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/diagnosaprb', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);
        $msg = [
            'data' => view('vclaim/datalistdiagnosaPRB', $data)
        ];
        echo json_encode($msg);
    }

    public function ObatGenerikPRB()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/ListobatPRB', $data);
    }

    public function referensiObatPRBVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/obatprb/' . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        if ($string['metaData']['code'] == 201) {
            $msg = [
                'success' => false,
                'pesan' => $string['metaData']['message'],
            ];
        } else {

            $msg = [
                'success' => true,
                'data' => view('vclaim/datalistobatPRB', $data)
            ];
        }
        echo json_encode($msg);
    }

    public function ProcedureLPK()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/ListProcedureLPK', $data);
    }

    public function referensiProcedureLPKVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/procedure/' . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistProcedureLPK', $data)
        ];
        echo json_encode($msg);
    }

    public function KelasRawatLPK()
    {
        return view('vclaim/ListkelasrawatLPK');
    }

    public function referensiKelasRawatLPK()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/kelasrawat', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);
        $msg = [
            'data' => view('vclaim/datalistkelasrawatLPK', $data)
        ];
        echo json_encode($msg);
    }

    public function DokterLPK()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/ListDokterLPK', $data);
    }

    public function referensiDokterLPKVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');

        $response = $client->request('GET', $base_url .  $service_name . '/referensi/dokter/' . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistDokterLPK', $data)
        ];
        echo json_encode($msg);
    }

    public function SpesialistikLPK()
    {
        return view('vclaim/ListspesialistikLPK');
    }

    public function referensiSpesialistikLPK()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/spesialistik', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);
        $msg = [
            'data' => view('vclaim/datalistSpesialistikLPK', $data)
        ];
        echo json_encode($msg);
    }

    public function RuangRawatLPK()
    {
        return view('vclaim/ListruangrawatLPK');
    }

    public function referensiruangrawatLPK()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/ruangrawat', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        var_dump($data);
        die();
        $msg = [
            'data' => view('vclaim/datalistruangrawatLPK', $data)
        ];
        echo json_encode($msg);
    }

    public function CaraKeluarLPK()
    {
        return view('vclaim/ListcarakeluarLPK');
    }

    public function referensicarakeluarLPK()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/carakeluar', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);
        $msg = [
            'data' => view('vclaim/datalistcarakeluarLPK', $data)
        ];
        echo json_encode($msg);
    }

    public function PascaPulangLPK()
    {
        return view('vclaim/ListpascapulangLPK');
    }

    public function referensiPascaPulangLPK()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/pascapulang', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);
        $msg = [
            'data' => view('vclaim/datalistpascapulangLPK', $data)
        ];
        echo json_encode($msg);
    }

    public function MonitoringKunjungan()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/Listmonitoringkunjungan', $data);
    }

    public function DataMonitoringKunjunganVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');
        $tglPelayanan = $this->request->getVar('tglPelayanan');



        $response = $client->request('GET', $base_url .  $service_name . 'Monitoring/Kunjungan/Tanggal/' . $tglPelayanan . '/' . 'JnsPelayanan/'  . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        if ($string['metaData']['code'] == 201) {
            $msg = [
                'gagal' => true,
                'pesan' => $string['metaData']['message'],
            ];
        } else {
            $msg = [
                'success' => true,
                'pesan' => $string['metaData']['message'],
                'data' => view('vclaim/datalistmonitoringkunjungan', $data)
            ];
        }
        echo json_encode($msg);
    }

    public function monitoringklaim()
    {
        return view('vclaim/monitoringklaim');
    }

    public function caridataklaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';
        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $mulai = $search['tglPulang'];
        $tglpulang = date('Y-m-d', strtotime($mulai));
        $statusKlaim = $search['statusKlaim'];
        $jnsPelayanan = $search['jnsPelayanan'];

        $response = $client->request('GET', $base_url . $service_name . 'Monitoring/Klaim/Tanggal/' . $tglpulang . '/' . 'JnsPelayanan/' . $jnsPelayanan . '/' . 'Status/' . $statusKlaim, [
            'headers' => $header,
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        var_dump($string);
        die();



        $data['response'] = json_decode($response);

        $msg = [
            'data' => view('vclaim/datamonitoringklaim', $data)
        ];
        echo json_encode($msg);
    }


    public function historipelayananSep()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/historipelsep', $data);
    }

    public function datahistoripelayananSepVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));
        $filter = $search['filter'];

        $response = $client->request('GET', $base_url .  $service_name . 'monitoring/HistoriPelayanan/NoKartu/' . $filter . '/' . 'tglMulai/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        $data = [
            'response' => $datakeluaran,
        ];

        if ($string['metaData']['code'] == 201) {
            $msg = [
                'success' => false,
                'pesan' => $string['metaData']['message'],
            ];
        } else {
            $msg = [
                'success' => true,
                'data' => view('vclaim/datahistoripelayananSep', $data)
            ];
        }
        echo json_encode($msg);
    }

    public function MonitoringKlaimJasaRaharja()
    {
        return view('vclaim/monitoringjasaraharja');
    }

    public function caridataklaimJasaRaharja()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';
        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));

        $response = $client->request('GET', $base_url . $service_name . 'monitoring/JasaRaharja/tglMulai/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir, [
            'headers' => $header,
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        var_dump($string);
        die();



        $data['response'] = json_decode($response);

        $msg = [
            'data' => view('vclaim/datamonitoringklaimjasaraharja', $data)
        ];
        echo json_encode($msg);
    }

    public function caridatarencanakontrol()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));
        $filter = $search['filter'];

        $response = $client->request('GET', $base_url .  $service_name . 'RencanaKontrol/ListRencanaKontrol/tglAwal/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir . '/' . 'filter/' . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        $data = [
            'response' => $datakeluaran,
        ];
        $msg = [
            'data' => view('rawatjalan/datarencanakontrolvclaim', $data)
        ];
        echo json_encode($msg);
    }

    public function check_rujukan_kartu()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $searchBy = $this->request->getVar('filter');
        $keyword = $this->request->getVar('card');

        if ($searchBy == "RS") {
            $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/RS/List/Peserta/' . $keyword, [
                'headers' => $this->header(),
            ])->getBody()->getContents();
        } else {
            $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/List/Peserta/' . $keyword, [
                'headers' => $this->header(),
            ])->getBody()->getContents();
        }


        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        $data = [
            'response' => $datakeluaran,

        ];




        $msg = [
            'data' => view('rawatjalan/datarujukan', $data)
        ];
        echo json_encode($msg);
    }

    public function caridatapelayananfingerprint()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        $dateout = explode('-', $search['tglpelayanan']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        // $tglakhir = date('Y-m-d', strtotime($sampai));
        // $filter = $search['filter'];

        $response = $client->request('GET', $base_url .  $service_name . 'SEP/FingerPrint/List/Peserta/TglPelayanan/' . $tglawal, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        $data = [
            'response' => $datakeluaran,
        ];
        $msg = [
            'data' => view('vclaim/datapelayananfingerprint', $data)
        ];
        echo json_encode($msg);
    }

    public function caridatapelayananfingerprintPeserta()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        $dateout = explode('-', $search['tglpelayanan']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $filter = $search['nokartu'];

        $response = $client->request('GET', $base_url .  $service_name . 'SEP/FingerPrint/Peserta/' . $filter . '/' . 'TglPelayanan/' . $tglawal, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);


        $data = [
            'response' => $datakeluaran,
        ];
        $msg = [
            'data' => view('vclaim/datapelayananfingerprintSpesifik', $data)
        ];
        echo json_encode($msg);
    }

    public function JadwalDokter()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'pelayanan' => $this->pelayanan(),
            ];
            $msg = [
                'suksesjadwal' => view('vclaim/modaldaftarjadwaldokterkontrol', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function pelayanan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli();
        return $list;
    }

    public function JadwalDokterKontrolVclaim()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        // $dateout = explode('-', $search['rencanakontrol']);
        // $mulai = str_replace('/', '-', $dateout[0]);
        // $sampai = str_replace('/', '-', $dateout[1]);
        // $tglawal = date('Y-m-d', strtotime($mulai));
        $filter = $this->request->getVar('filter');
        //$tglPelayanan = $tglawal;
        $tglPelayanan = $this->request->getVar('rencanakontrol');
        $spesialis = $this->request->getVar('pelayanan');

        $response = $client->request('GET', $base_url .  $service_name . 'RencanaKontrol/JadwalPraktekDokter/JnsKontrol/' . $filter . '/' . 'KdPoli/'  . $spesialis . '/' . 'TglRencanaKontrol/' . $tglPelayanan, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);


        $data = [
            'list' => $datakeluaran,
            'pesan' => $response,
            'kodepoli' => $spesialis,
            'rencanakontrol' => $tglPelayanan,
        ];
        $msg = [
            'data' => view('vclaim/datalistjadwaldokter', $data)
        ];
        echo json_encode($msg);
    }

    public function LihatSaranaFaskes()
    {
        if ($this->request->isAJAX()) {

            $kode = $this->request->getVar('kode');
            $namafaskes = $this->request->getVar('nama');

            $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
            $service_name = 'vclaim-rest/';

            $client = new Client();
            $header = $this->header();
            $header['Content-Type'] = "application/json; charset=utf-8";

            $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/ListSarana/PPKRujukan/' . $kode, [
                'headers' => $this->header(),
            ])->getBody()->getContents();

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $string['response']);
            $datakeluaran = json_decode($keluaran, true);

            $hasil = $datakeluaran;
            $data = [
                'list' => $hasil,
                'pesan' => $response,
                'namafaskes' => $namafaskes
            ];
            $msg = [
                'suksessarana' => view('vclaim/modalsaranafaskes', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CariFaskes()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'suksescarifaskes' => view('vclaim/modalcarifaskes')
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function referensiFaskesRujukan()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $kodefaskes = $this->request->getVar('kodefaskes');
        $jenisfaskes = $this->request->getVar('filter');


        // $kodefaskes = '1020R001';
        // $jenisfaskes = '2';

        $response = $client->request('GET', $base_url .  $service_name . 'referensi/faskes/' . $kodefaskes . '/'  . $jenisfaskes, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistfaskesrujukan', $data)
        ];
        echo json_encode($msg);

        //echo json_encode($data);
    }

    public function DetailFaskes()
    {
        if ($this->request->isAJAX()) {

            $kode = $this->request->getVar('kode');
            $nama = $this->request->getVar('nama');
            $data = [
                'kode' => $kode,
                'nama' => $nama
            ];
            echo json_encode($data);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CariSpesialistikRujukan()
    {
        if ($this->request->isAJAX()) {

            $kodefaskes = $this->request->getVar('kodeFaskes');
            $TglRujukan = $this->request->getVar('TglRujukan');

            $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
            $service_name = 'vclaim-rest/';

            $client = new Client();
            $header = $this->header();
            $header['Content-Type'] = "Application/x-www-form-urlencoded";

            $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/ListSpesialistik/PPKRujukan/' . $kodefaskes . '/' . 'TglRujukan/'  . $TglRujukan, [
                'headers' => $this->header(),
            ])->getBody()->getContents();

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $string['response']);
            $datakeluaran = json_decode($keluaran, true);




            $hasil = $datakeluaran;
            $data = [
                'list' => $hasil,
                'pesan' => $response,
            ];
            // var_dump($data);
            // die();
            $msg = [
                'suksesspesialistik' => view('vclaim/modallistSpesialistik', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DetailSpesialistik()
    {
        if ($this->request->isAJAX()) {

            $kode = $this->request->getVar('kodeSpesialis');
            $nama = $this->request->getVar('namaSpesialis');
            $data = [
                'kodeSpesialis' => $kode,
                'namaSpesialis' => $nama
            ];
            echo json_encode($data);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CariDiagnosa()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'suksescaridiagnosa' => view('vclaim/modalcaridiagnosa')
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function referensiDiagnosa()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');


        $response = $client->request('GET', $base_url .  $service_name . 'referensi/diagnosa/' . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistdiagnosaRujukan', $data)
        ];
        echo json_encode($msg);
    }

    public function DetailDiagnosa()
    {
        if ($this->request->isAJAX()) {

            $kode = $this->request->getVar('kode');
            $nama = $this->request->getVar('nama');
            $data = [
                'kode' => $kode,
                'nama' => $nama
            ];
            echo json_encode($data);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function Member()
    {

        return view('vclaim/Peserta');
    }

    public function check_card()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';
        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $noPeserta = $param['card'];
        $tglSep = $param['tanggal'];
        $filter = $param['filter'];

        if ($filter == 1) {
            $response = $client->request('GET', $base_url . $service_name . 'Peserta/nokartu/' . $noPeserta . '/' . 'tglSEP/'  . $tglSep, [
                'headers' => $this->header(),
            ])->getBody()->getContents();
        } else {
            $response = $client->request('GET', $base_url . $service_name . 'Peserta/nik/' . $noPeserta . '/' . 'tglSEP/'  . $tglSep, [
                'headers' => $this->header(),
            ])->getBody()->getContents();
        }


        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);


        if ($string['metaData']['code'] == 201) {
            $data = [
                'pesan' => $string['metaData']['message'],
            ];
            $msg = [
                'pesan' => $string['metaData']['message'],
                'kodepesan' => $string['metaData']['code'],
                'success' => false,
                'data' => view('vclaim/dataPesertaNihil', $data),
            ];
        } else {
            $data = [
                'pesan' => $string['metaData']['code'],
                'noKartu' => $datakeluaran['peserta']['noKartu'],
                'nik' => $datakeluaran['peserta']['nik'],
                'nama' => $datakeluaran['peserta']['nama'],
                'pisa' => $datakeluaran['peserta']['pisa'],
                'sex' => $datakeluaran['peserta']['sex'],
                'noMR' => $datakeluaran['peserta']['mr']['noMR'],
                'noTelepon' => $datakeluaran['peserta']['mr']['noTelepon'],
                'tglLahir' => $datakeluaran['peserta']['tglLahir'],
                'tglCetakKartu' => $datakeluaran['peserta']['tglCetakKartu'],
                'tglTAT' => $datakeluaran['peserta']['tglTAT'],
                'tglTMT' => $datakeluaran['peserta']['tglTMT'],
                'kodeStatusPeserta' => $datakeluaran['peserta']['statusPeserta']['kode'],
                'keteranganStatusPeserta' => $datakeluaran['peserta']['statusPeserta']['keterangan'],
                'kdProvider' => $datakeluaran['peserta']['provUmum']['kdProvider'],
                'nmProvider' => $datakeluaran['peserta']['provUmum']['nmProvider'],
                'kodeJenisPeserta' => $datakeluaran['peserta']['jenisPeserta']['kode'],
                'keteranganJenisPeserta' => $datakeluaran['peserta']['jenisPeserta']['keterangan'],
                'kodehakKelas' => $datakeluaran['peserta']['hakKelas']['kode'],
                'keteranganhakKelas' => $datakeluaran['peserta']['hakKelas']['keterangan'],
                'umursekarang' => $datakeluaran['peserta']['umur']['umurSekarang'],
                'umurSaatPelayanan' => $datakeluaran['peserta']['umur']['umurSaatPelayanan'],
                'dinsos' => $datakeluaran['peserta']['informasi']['dinsos'],
                'prolanisPRB' => $datakeluaran['peserta']['informasi']['prolanisPRB'],
                'noSKTM' => $datakeluaran['peserta']['informasi']['noSKTM'],
                'noAsuransiCob' => $datakeluaran['peserta']['cob']['noAsuransi'],
                'nmAsuransiAsuransiCob' => $datakeluaran['peserta']['cob']['nmAsuransi'],
                'tglTMTCob' => $datakeluaran['peserta']['cob']['tglTMT'],
                'tglTATCob' => $datakeluaran['peserta']['cob']['tglTAT'],
            ];

            $msg = [
                'data' => view('vclaim/dataPeserta', $data),
                'success' => true,
                'kodepesan' => $string['metaData']['code'],
            ];
        }
        echo json_encode($msg);
    }

    public function SuplesiJR()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/suplesijasaraharja', $data);
    }

    public function dataSuplesiJR()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        $dateout = explode('-', $search['rencanakontrol']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        //$tglakhir = date('Y-m-d', strtotime($sampai));
        $filter = $search['filter'];

        $response = $client->request('GET', $base_url .  $service_name . 'sep/JasaRaharja/Suplesi/' . $filter . '/' . 'tglPelayanan/' . $tglawal, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);




        if ($string['metaData']['code'] == 201) {
            $data = [
                'pesan' => $string['metaData']['message'],
            ];
            $msg = [
                'pesan' => $string['metaData']['message'],
                'kodepesan' => $string['metaData']['code'],
                'success' => false,
            ];
        } else {
            $data = [
                'response' => $datakeluaran,
            ];
            $msg = [
                'data' => view('vclaim/dataSuplesiJR', $data),
                'success' => true,
                'kodepesan' => $string['metaData']['code'],
            ];
        }
        echo json_encode($msg);
    }

    public function IndukKecelakaan()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/indukKecelakaan', $data);
    }

    public function dataIndukKecelakaan()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        $filter = $search['filter'];

        $response = $client->request('GET', $base_url .  $service_name . 'sep/KllInduk/List/' . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);


        if ($string['metaData']['code'] == 201) {
            $data = [
                'pesan' => $string['metaData']['message'],
            ];
            $msg = [
                'pesan' => $string['metaData']['message'],
                'kodepesan' => $string['metaData']['code'],
                'success' => false,
            ];
        } else {
            $data = [
                'response' => $datakeluaran,
            ];
            $msg = [
                'data' => view('vclaim/dataIndukKecelakaan', $data),
                'success' => true,
                'kodepesan' => $string['metaData']['code'],
            ];
        }
        echo json_encode($msg);
    }

    public function Propinsi()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/ListPropinsi', $data);
    }

    public function referensiPropinsi()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $response = $client->request('GET', $base_url .  $service_name . 'referensi/propinsi', [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistpropinsi', $data)
        ];
        echo json_encode($msg);

        //echo json_encode($data);
    }

    public function LihatKabupaten()
    {
        if ($this->request->isAJAX()) {

            $kode = $this->request->getVar('kode');
            $namapropinsi = $this->request->getVar('nama');

            $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
            $service_name = 'vclaim-rest/';

            $client = new Client();
            $header = $this->header();
            $header['Content-Type'] = "application/json; charset=utf-8";

            $response = $client->request('GET', $base_url .  $service_name . 'referensi/kabupaten/propinsi/' . $kode, [
                'headers' => $this->header(),
            ])->getBody()->getContents();

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $string['response']);
            $datakeluaran = json_decode($keluaran, true);

            $hasil = $datakeluaran;
            $data = [
                'list' => $hasil,
                'pesan' => $response,
                'namafaskes' => $namapropinsi
            ];
            $msg = [
                'sukseskabupaten' => view('vclaim/modallistkabupaten', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function LihatKecamatan()
    {
        if ($this->request->isAJAX()) {

            $kode = $this->request->getVar('kode');
            $namakabupaten = $this->request->getVar('nama');

            $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
            $service_name = 'vclaim-rest/';

            $client = new Client();
            $header = $this->header();
            $header['Content-Type'] = "application/json; charset=utf-8";

            $response = $client->request('GET', $base_url .  $service_name . 'referensi/kecamatan/kabupaten/' . $kode, [
                'headers' => $this->header(),
            ])->getBody()->getContents();

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $string['response']);
            $datakeluaran = json_decode($keluaran, true);

            $hasil = $datakeluaran;
            $data = [
                'list' => $hasil,
                'pesan' => $response,
                'namafaskes' => $namakabupaten
            ];
            $msg = [
                'sukseskecamatan' => view('vclaim/modallistkecamatan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DetailJadwalDokter()
    {
        if ($this->request->isAJAX()) {

            $kodepoli = $this->request->getVar('kodepoli');
            $namaDokter = $this->request->getVar('namaDokter');
            $kodeDokter = $this->request->getVar('kodeDokter');
            $rencanakontrol = $this->request->getVar('rencanakontrol');
            $carikode = new ModelPasienMaster;
            $kodepolibpjs = $carikode->get_data_poli($kodepoli);



            $data = [
                'kodepoli' => $kodepoli,
                'namaDokter' => $namaDokter,
                'kodeDokter' => $kodeDokter,
                'namaPoli' => $kodepolibpjs['name'],
                'rencanakontrol' => $rencanakontrol,
            ];
            echo json_encode($data);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function DetailKontrol()
    {
        if ($this->request->isAJAX()) {

            $noSuratKontrol = $this->request->getVar('noSuratKontrol');
            $noSepAsalKontrol = $this->request->getVar('noSepAsalKontrol');
            $tglSuratKontrol = $this->request->getVar('tglSuratKontrol');
            $data = [
                'noSuratKontrol' => $noSuratKontrol,
                'noSepAsalKontrol' => $noSepAsalKontrol,
                'tglSuratKontrol' => $tglSuratKontrol,
            ];
            echo json_encode($data);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hitungmasaRujukan()
    {
        $tglRujukan = '2021-12-01';
        $hari_ini = date('Y-m-d');

        $tgl1 = strtotime($tglRujukan);
        $tgl2 = strtotime($hari_ini);

        $jarak = $tgl2 - $tgl1;

        $hari = $jarak / 60 / 60 / 24;
        echo $hari;
    }

    public function Rujukan()
    {

        return view('vclaim/Rujukan');
    }

    public function check_rujukan_kartu_v2()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $searchBy = $this->request->getVar('searchBy');
        $keyword = $this->request->getVar('card');
        $kriteria = $this->request->getVar('kriteria');

        if ($searchBy == "RS") {

            if ($kriteria == 1) {
                $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/RS/Peserta/' . $keyword, [
                    'headers' => $this->header(),
                ])->getBody()->getContents();
            } else {
                $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/RS/' . $keyword, [
                    'headers' => $this->header(),
                ])->getBody()->getContents();
            }
        } else {
            if ($kriteria == 1) {
                $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/Peserta/' . $keyword, [
                    'headers' => $this->header(),
                ])->getBody()->getContents();
            } else {
                $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/' . $keyword, [
                    'headers' => $this->header(),
                ])->getBody()->getContents();
            }
        }


        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);




        if ($string['metaData']['code'] == 201) {
            $data = [
                'pesan' => $string['metaData']['message'],
            ];
            $msg = [
                'pesan' => $string['metaData']['message'],
                'kodepesan' => $string['metaData']['code'],
                'success' => false,
                'data' => view('vclaim/dataRujukanNihil', $data),
            ];
        } else {
            $data = [
                'pesan' => $string['metaData']['code'],
                'noKartu' => $datakeluaran['rujukan']['peserta']['noKartu'],
                'nik' => $datakeluaran['rujukan']['peserta']['nik'],
                'nama' => $datakeluaran['rujukan']['peserta']['nama'],
                'pisa' => $datakeluaran['rujukan']['peserta']['pisa'],
                'sex' => $datakeluaran['rujukan']['peserta']['sex'],
                'noMR' => $datakeluaran['rujukan']['peserta']['mr']['noMR'],
                'noTelepon' => $datakeluaran['rujukan']['peserta']['mr']['noTelepon'],
                'tglLahir' => $datakeluaran['rujukan']['peserta']['tglLahir'],
                'tglCetakKartu' => $datakeluaran['rujukan']['peserta']['tglCetakKartu'],
                'tglTAT' => $datakeluaran['rujukan']['peserta']['tglTAT'],
                'tglTMT' => $datakeluaran['rujukan']['peserta']['tglTMT'],
                'kodeStatusPeserta' => $datakeluaran['rujukan']['peserta']['statusPeserta']['kode'],
                'keteranganStatusPeserta' => $datakeluaran['rujukan']['peserta']['statusPeserta']['keterangan'],
                'namaprovUmum' => $datakeluaran['rujukan']['peserta']['provUmum']['kdProvider'],
                'kodeprovUmum' => $datakeluaran['rujukan']['peserta']['provUmum']['nmProvider'],
                'kodeJenisPeserta' => $datakeluaran['rujukan']['peserta']['jenisPeserta']['kode'],
                'keteranganJenisPeserta' => $datakeluaran['rujukan']['peserta']['jenisPeserta']['keterangan'],
                'kodehakKelas' => $datakeluaran['rujukan']['peserta']['hakKelas']['kode'],
                'keteranganhakKelas' => $datakeluaran['rujukan']['peserta']['hakKelas']['keterangan'],
                'umursekarang' => $datakeluaran['rujukan']['peserta']['umur']['umurSekarang'],
                'umurSaatPelayanan' => $datakeluaran['rujukan']['peserta']['umur']['umurSaatPelayanan'],
                'dinsos' => $datakeluaran['rujukan']['peserta']['informasi']['dinsos'],
                'prolanisPRB' => $datakeluaran['rujukan']['peserta']['informasi']['prolanisPRB'],
                'noSKTM' => $datakeluaran['rujukan']['peserta']['informasi']['noSKTM'],
                'noAsuransiCob' => $datakeluaran['rujukan']['peserta']['cob']['noAsuransi'],
                'nmAsuransiAsuransiCob' => $datakeluaran['rujukan']['peserta']['cob']['nmAsuransi'],
                'tglTMTCob' => $datakeluaran['rujukan']['peserta']['cob']['tglTMT'],
                'tglTATCob' => $datakeluaran['rujukan']['peserta']['cob']['tglTAT'],
                'noKunjungan' => $datakeluaran['rujukan']['noKunjungan'],
                'namaprovPerujuk' => $datakeluaran['rujukan']['provPerujuk']['nama'],
                'kodeprovPerujuk' => $datakeluaran['rujukan']['provPerujuk']['kode'],
                'namapoliRujukan' => $datakeluaran['rujukan']['poliRujukan']['nama'],
                'kodepoliRujukan' => $datakeluaran['rujukan']['poliRujukan']['kode'],
                'namapelayanan' => $datakeluaran['rujukan']['pelayanan']['nama'],
                'keluhan' => $datakeluaran['rujukan']['keluhan'],
                'namadiagnosa' => $datakeluaran['rujukan']['diagnosa']['nama'],
                'kodediagnosa' => $datakeluaran['rujukan']['diagnosa']['kode'],
                //'tglrujukan_awal' => $datakeluaran['rujukan']['diagnosa']['kode'],
                'tglKunjungan' => $datakeluaran['rujukan']['tglKunjungan'],

            ];

            $msg = [
                'data' => view('vclaim/dataRujukan', $data),
                'success' => true,
                'kodepesan' => $string['metaData']['code'],
            ];
        }

        echo json_encode($msg);
    }

    public function Kontrol()
    {

        return view('vclaim/Kontrol');
    }

    public function check_surat_kontrol()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';
        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $noPeserta = $param['card'];

        $response = $client->request('GET', $base_url . $service_name . 'RencanaKontrol/noSuratKontrol/' . $noPeserta, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);


        if ($string['metaData']['code'] == 201) {
            $data = [
                'pesan' => $string['metaData']['message'],
            ];
            $msg = [
                'pesan' => $string['metaData']['message'],
                'kodepesan' => $string['metaData']['code'],
                'success' => false,
                'data' => view('vclaim/dataKontrolNihil', $data),
            ];
        } else {
            $data = [
                'pesan' => $string['metaData']['code'],
                'noSuratKontrol' => $datakeluaran['noSuratKontrol'],
                'tglRencanaKontrol' => $datakeluaran['tglRencanaKontrol'],
                'tglTerbit' => $datakeluaran['tglTerbit'],
                'jnsKontrol' => $datakeluaran['jnsKontrol'],
                'poliTujuan' => $datakeluaran['poliTujuan'],
                'namaPoliTujuan' => $datakeluaran['namaPoliTujuan'],
                'kodeDokter' => $datakeluaran['kodeDokter'],
                'namaDokter' => $datakeluaran['namaDokter'],
                'flagKontrol' => $datakeluaran['flagKontrol'],
                'kodeDokterPembuat' => $datakeluaran['kodeDokterPembuat'],
                'namaDokterPembuat' => $datakeluaran['namaDokterPembuat'],
                'namaJnsKontrol' => $datakeluaran['namaJnsKontrol'],
                'noSep' => $datakeluaran['sep']['noSep'],
                'tglSep' => $datakeluaran['sep']['tglSep'],
                'jnsPelayanan' => $datakeluaran['sep']['jnsPelayanan'],
                'poli' => $datakeluaran['sep']['poli'],
                'diagnosa' => $datakeluaran['sep']['diagnosa'],
                'noKartu' => $datakeluaran['sep']['peserta']['noKartu'],
                'nama' => $datakeluaran['sep']['peserta']['nama'],
                'tglLahir' => $datakeluaran['sep']['peserta']['tglLahir'],
                'kelamin' => $datakeluaran['sep']['peserta']['kelamin'],
                'hakKelas' => $datakeluaran['sep']['peserta']['hakKelas'],
                'kdProvider' => $datakeluaran['sep']['provUmum']['kdProvider'],
                'nmProvider' => $datakeluaran['sep']['provUmum']['nmProvider'],
                'kdProviderPerujuk' => $datakeluaran['sep']['provPerujuk']['kdProviderPerujuk'],
                'nmProviderPerujuk' => $datakeluaran['sep']['provPerujuk']['nmProviderPerujuk'],


            ];

            $msg = [
                'data' => view('vclaim/dataKontrol', $data),
                'success' => true,
                'kodepesan' => $string['metaData']['code'],
            ];
        }
        echo json_encode($msg);
    }

    public function SEP()
    {

        return view('vclaim/Sep');
    }

    public function check_SEP()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';
        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $noPeserta = $param['card'];

        $jumlah_karakter_sep = strlen($noPeserta);
        if ($jumlah_karakter_sep == 20) {
            $msg = [
                'gagal' => true,
                'pesantambahan' => 'No Sep Tidak Boleh  20 Digit',

            ];
        } else {

            $response = $client->request('GET', $base_url . $service_name . 'SEP/' . $noPeserta, [
                'headers' => $this->header(),
            ])->getBody()->getContents();
            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $string['response']);
            $datakeluaran = json_decode($keluaran, true);
            if ($string['metaData']['code'] == 201) {
                $data = [
                    'pesan' => $string['metaData']['message'],
                ];
                $msg = [
                    'pesan' => $string['metaData']['message'],
                    'kodepesan' => $string['metaData']['code'],
                    'success' => false,
                    'pesantambahan' => 'No Sep: ' . $noPeserta . 'Tidak Ditemukan',
                    //'data' => view('vclaim/dataKontrolNihil', $data),
                ];
            } else {
                $data = [
                    'pesan' => $string['metaData']['code'],
                    'noSep' => $datakeluaran['noSep'],
                    'tglSep' => $datakeluaran['tglSep'],
                    'jnsPelayanan' => $datakeluaran['jnsPelayanan'],
                    'kelasRawat' => $datakeluaran['kelasRawat'],
                    'noRujukan' => $datakeluaran['noRujukan'],
                    'poli' => $datakeluaran['poli'],
                    'poliEksekutif' => $datakeluaran['poliEksekutif'],
                    'catatan' => $datakeluaran['catatan'],
                    'penjamin' => $datakeluaran['penjamin'],
                    'diagnosa' => $datakeluaran['diagnosa'],
                    'noMr' => $datakeluaran['peserta']['noMr'],
                    'noKartu' => $datakeluaran['peserta']['noKartu'],
                    'jnsPeserta' => $datakeluaran['peserta']['jnsPeserta'],
                    'hakKelas' => $datakeluaran['peserta']['hakKelas'],
                    'asuransi' => $datakeluaran['peserta']['asuransi'],
                    'klsRawatHak' => $datakeluaran['klsRawat']['klsRawatHak'],
                    'klsRawatNaik' => $datakeluaran['klsRawat']['klsRawatNaik'],
                    'pembiayaan' => $datakeluaran['klsRawat']['pembiayaan'],
                    'penanggungJawab' => $datakeluaran['klsRawat']['penanggungJawab'],
                    'kdStatusKecelakaan' => $datakeluaran['kdStatusKecelakaan'],
                    'nmstatusKecelakaan' => $datakeluaran['nmstatusKecelakaan'],
                    'kdDPJP' => $datakeluaran['dpjp']['kdDPJP'],
                    'nmDPJP' => $datakeluaran['dpjp']['nmDPJP'],
                    'noSurat' => $datakeluaran['kontrol']['noSurat'],
                    'kdDokter' => $datakeluaran['kontrol']['kdDokter'],
                    'nmDokter' => $datakeluaran['kontrol']['nmDokter'],
                    'tglKejadian' => $datakeluaran['lokasiKejadian']['tglKejadian'],
                    'kdProp' => $datakeluaran['lokasiKejadian']['kdProp'],
                    'kdKab' => $datakeluaran['lokasiKejadian']['kdKab'],
                    'kdKec' => $datakeluaran['lokasiKejadian']['kdKec'],
                    'cob' => $datakeluaran['cob'],
                    'katarak' => $datakeluaran['katarak'],
                    'nama' => $datakeluaran['peserta']['nama'],
                    'tglLahir' => $datakeluaran['peserta']['tglLahir'],
                    'kelamin' => $datakeluaran['peserta']['kelamin'],
                    'hakKelas' => $datakeluaran['peserta']['hakKelas'],
                    'lokasi' => $datakeluaran['lokasiKejadian']['lokasi'],
                    'ketKejadian' => $datakeluaran['lokasiKejadian']['ketKejadian'],

                ];

                $msg = [
                    'data' => view('vclaim/dataSEP', $data),
                    'success' => true,
                    'kodepesan' => $string['metaData']['code'],
                ];
            }
        }
        echo json_encode($msg);
    }

    public function FingerPrint()
    {

        return view('vclaim/FingerPrint');
    }
    public function check_Finger_Print()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';
        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $noPeserta = $param['card'];
        $tglPelayanan = $param['tglPelayanan'];


        $response = $client->request('GET', $base_url . $service_name . 'Peserta/nokartu/' . $noPeserta . '/' . 'tglSEP/'  . $tglPelayanan, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);




        if ($string['metaData']['code'] == 201) {
            $msg = [
                'pesan' => $string['metaData']['message'],
                'kodepesan' => $string['metaData']['code'],
                'gagal' => true,
                'pesantambahan' => $string['metaData']['message'],
            ];
        } else {
            $responseFP = $client->request('GET', $base_url . $service_name . 'SEP/FingerPrint/Peserta/' . $noPeserta . '/' . 'TglPelayanan/' . $tglPelayanan, [
                'headers' => $this->header(),
            ])->getBody()->getContents();

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            $stringFP = json_decode($responseFP, true);
            $keluaranFP = $this->stringDecrypt($key, $stringFP['response']);
            $datakeluaranFP = json_decode($keluaranFP, true);
            // var_dump($datakeluaranFP);
            // die();


            if ($datakeluaranFP == null) {
                $msg = [
                    'pesan' => $stringFP['metaData']['message'],
                    'kodepesan' => $stringFP['metaData']['code'],
                    'success' => false,
                    'pesantambahan' => $datakeluaranFP['status'],
                ];
            } else {
                $msg = [
                    'success' => true,
                    //'kodepesan' => $datakeluaranFP['status'],
                    'pesan' => $datakeluaranFP['status'],
                ];
            }
        }
        echo json_encode($msg);
    }

    public function Spesialistik()
    {
        return view('vclaim/Spesialistik');
    }

    public function check_spesialistik()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();

        $jnsKontrol = $this->request->getVar('jnsKontrol');
        $jnsKartu = $this->request->getVar('jnsKartu');
        $card = $this->request->getVar('card');
        $tglRencanaKontrol = $this->request->getVar('tglRencanaKontrol');



        $jumlah_digit = strlen($card);
        if (($jnsKontrol == "") || ($jnsKartu == "")) {
            $msg = [
                'gagal' => true,
                'pesan' => 'Isi Terlebih Dahulu Jenis Kontrol atau No Kartu/ No SEP'
            ];
        } else if (($jnsKontrol == 1) and ($jnsKartu == 2)) {
            $msg = [
                'gagal' => true,
                'pesan' => 'Untuk Jenis Kontrol SPRI maka isi pencarian menggunakan No Kartu Peserta'
            ];
        } else if (($jnsKontrol == 2) and ($jnsKartu == 1)) {
            $msg = [
                'gagal' => true,
                'pesan' => 'Untuk Jenis Kontrol Rencana Kontrol maka isi pencarian menggunakan No SEP',
            ];
        } else if (($jnsKontrol == 1) and ($jnsKartu == 1) and ($card == "")) {
            $msg = [
                'gagal' => true,
                'pesan' => 'No Kartu Belum Diisi !!!'
            ];
        } else if (($jnsKontrol == 1) and ($jnsKartu == 1) and ($card <> "") and ($jumlah_digit <> 13)) {
            $msg = [
                'gagal' => true,
                'pesan' => 'No Kartu Harus 13 Digit !!!'
            ];
        } else if (($jnsKontrol == 2) and ($jnsKartu == 2) and ($card == "")) {
            $msg = [
                'gagal' => true,
                'pesan' => 'No SEP Belum Diisi !!!'
            ];
        } else if (($jnsKontrol == 2) and ($jnsKartu == 2) and ($card <> "") and ($jumlah_digit <> 19)) {
            $msg = [
                'gagal' => true,
                'pesan' => 'No SEP Harus 19 Digit !!!'
            ];
        } else {

            $response = $client->request('GET', $base_url .  $service_name . 'RencanaKontrol/ListSpesialistik/JnsKontrol/' . $jnsKontrol . '/' . 'nomor/' . $card . '/' . 'TglRencanaKontrol/' . $tglRencanaKontrol, [
                'headers' => $this->header(),
            ])->getBody()->getContents();

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];


            $key = $cons_id . $secretKey . $tStamp;
            $string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $string['response']);
            $data = json_decode($keluaran, true);

            if ($string['metaData']['code'] != 200) {
                $msg = [
                    'pesan' => $string['metaData']['message'],
                    'success' => false,
                ];
            } else {
                $msg = [
                    'data' => view('vclaim/datalistspesialistik', $data),
                    'pesan' => $string['metaData']['code'],
                    'success' => true,
                ];
            }
        }

        echo json_encode($msg);
    }

    public function SepInternal()
    {
        return view('vclaim/SepInternal');
    }

    public function check_SepInternal()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();

        $card = $this->request->getVar('noSep');




        $jumlah_digit = strlen($card);
        if ($card == "") {
            $msg = [
                'gagal' => true,
                'pesan' => 'Isi Terlebih Dahulu No SEP'
            ];
        } else if (($card <> "") and ($jumlah_digit <> 19)) {
            $msg = [
                'gagal' => true,
                'pesan' => 'No SEP Harus 19 Digit !!!'
            ];
        } else {

            $response = $client->request('GET', $base_url .  $service_name . 'SEP/Internal/' . $card, [
                'headers' => $this->header(),
            ])->getBody()->getContents();

            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];


            $key = $cons_id . $secretKey . $tStamp;
            $string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $string['response']);
            $data = json_decode($keluaran, true);


            if ($string['metaData']['code'] != 200) {
                $msg = [
                    'pesan' => $string['metaData']['message'],
                    'success' => false,
                ];
            } else {
                $msg = [
                    'data' => view('vclaim/datalistsepinternal', $data),
                    'pesan' => $string['metaData']['code'],
                    'success' => true,
                ];
            }
        }

        echo json_encode($msg);
    }

    public function HapusSepInternal()
    {
        if ($this->request->isAJAX()) {
            //$id = $this->request->getVar('id');
            $datasep['noSep'] = $this->request->getVar('noSep');
            $datasep['nosurat'] = $this->request->getVar('nosurat');
            $datasep['tglRujukanInternal'] = $this->request->getVar('tglRujukanInternal');
            $datasep['kdPoliTuj'] = $this->request->getVar('kdPoliTuj');
            $datasep['user'] = 'kuningan45';

            $header = $this->header();
            $sep = json_decode($this->delete_sep_internal($datasep, $header), true);


            $cons_id = $header['X-cons-id'];
            $secretKey = "4iK5B08401";
            $tStamp = $header['X-timestamp'];

            $key = $cons_id . $secretKey . $tStamp;
            //$string = json_decode($response, true);
            $keluaran = $this->stringDecrypt($key, $sep['response']);
            $datakeluaran = json_decode($keluaran, true);

            $msg = [
                'success' => true,
                'pesan' => $sep['metaData']['message'],
                'response' => $datakeluaran,
            ];
            echo json_encode($msg);
        }
    }

    private function delete_sep_internal($param, $header)
    {

        $data = [
            "request" =>
            [
                "t_sep" => [
                    "noSep" => $param['noSep'],
                    "noSurat" => $param['nosurat'],
                    "tglRujukanInternal" => $param['tglRujukanInternal'],
                    "kdPoliTuj" => $param['kdPoliTuj'],
                    "user" => $param['user']
                ]
            ]
        ];

        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';


        $client = new Client();
        //$header = $this->header();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('DELETE', $base_url .  $service_name . 'SEP/Internal/delete', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function ListPerpanjanganKhusus()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/Listperpanjangankhusus', $data);
    }

    public function DataRujukanKhusus()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');
        $tahun = $this->request->getVar('tahun');



        $response = $client->request('GET', $base_url .  $service_name . 'Rujukan/Khusus/List/Bulan/' . $filter . '/' . 'Tahun/'  . $tahun, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        if ($string['metaData']['code'] != 200) {
            $msg = [
                'pesan' => $string['metaData']['message'],
                'success' => false,
            ];
        } else {
            $msg = [
                'data' => view('vclaim/dataListperpanjangankhusus', $data),
                'success' => true,
            ];
        }


        echo json_encode($msg);
    }

    public function addRujukanKhusus()
    {

        return view('vclaim/Rujukan');
    }


    public function ajax_diagnosa()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_list_diagnosa_rujukan();
        foreach ($data as $row) {
            $json[] = $row['code'];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function CreateRujukanKhusus()
    {
        if ($this->request->isAJAX()) {

            $diagnosa = $this->ajax_diagnosa();

            $data = [
                'noKartu' => $this->request->getVar('noKartu'),
                'nama' => $this->request->getVar('nama'),
                'tglLahir' => $this->request->getVar('tglLahir'),
                'umursekarang' => $this->request->getVar('umursekarang'),
                'noRujukan' => $this->request->getVar('noRujukan'),
                'sex' => $this->request->getVar('sex'),
                //'diagnosa' => $diagnosa,

            ];
            $data['autocomplete'] = $this->ajax_diagnosa();


            $msg = [
                'suksesmodalsep' => view('vclaim/modalinsertRujukanKhusus', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanRujukanKhusus()
    {
        if ($this->request->isAJAX()) {


            $datasep['noRujukan'] = $this->request->getVar('noRujukan');
            $datasep['diagnosa'] = $this->request->getVar('diagnosa');
            $datasep['procedure'] = $this->request->getVar('procedure');
            $datasep['user'] = 'Coba Ws';

            $diagnosa = explode('|', $datasep['diagnosa']);
            $jmldata = count($diagnosa);
            for ($i = 0; $i < $jmldata; $i++) {

                if ($i == 0) {
                    //$datasep['icd'][] = 'P;' . $diagnosa[$i];
                    $datasep['icd'][]['kode'] = 'P;' . $diagnosa[$i];
                } else {
                    $datasep['icd'][]['kode'] = 'S;' . $diagnosa[$i];
                }
            }


            $procedure = explode('|', $datasep['procedure']);
            $jmldataprocedure = count($procedure);
            for ($i = 0; $i < $jmldataprocedure; $i++) {
                $datasep['icdix'][]['kode'] = $procedure[$i];
            }



            if (($datasep['noRujukan'] == "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'No Rujukan Tidak Boleh Kosong'
                ];
            } else if ($datasep['diagnosa'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'diagnosa Tidak Boleh Kosong'
                ];
            } else {



                $header = $this->header();
                $sep = json_decode($this->insert_rujukan_khusus($datasep, $header), true);

                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
                $tStamp = $header['X-timestamp'];

                $key = $cons_id . $secretKey . $tStamp;
                $keluaran = $this->stringDecrypt($key, $sep['response']);
                $datakeluaran = json_decode($keluaran, true);

                if ($sep['response'] == null) {
                    $msg = [
                        'success' => false,
                        'pesan' => $sep['metaData']['message']
                    ];
                } else {
                    $norujukan = $datakeluaran['rujukan']['norujukan'];
                    $nokapst = $datakeluaran['rujukan']['nokapst'];
                    $nmpst = $datakeluaran['rujukan']['nmpst'];
                    $diagppk = $datakeluaran['rujukan']['diagppk'];
                    $tglrujukan_awal = $datakeluaran['rujukan']['tglrujukan_awal'];
                    $tglrujukan_berakhir = $datakeluaran['rujukan']['tglrujukan_berakhir'];

                    $msg = [
                        'success' => true,
                        'response' => $datakeluaran,
                        'pesan' => $sep['metaData']['message']
                    ];
                }
            }
        }
        echo json_encode($msg);
    }

    private function insert_rujukan_khusus($param, $header)
    {

        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $data = [
            "noRujukan" => $param['noRujukan'],
            "diagnosa" => $param['icd'],
            "procedure" => $param['icdix'],
            "user" => $param['user']
        ];

        $client = new Client();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $base_url .  $service_name  . 'Rujukan/Khusus/insert', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }

    public function CariDiagnosaRujukanKhusus()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'suksescaridiagnosa' => view('vclaim/modalcaridiagnosaRujukanKhusus')
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function referensiDiagnosaRujukanKhusus()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $filter = $this->request->getVar('filter');


        $response = $client->request('GET', $base_url .  $service_name . 'referensi/diagnosa/' . $filter, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];


        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $data = json_decode($keluaran, true);

        $msg = [
            'data' => view('vclaim/datalistdiagnosaRujukanKhusus', $data)
        ];
        echo json_encode($msg);
    }

    public function ListPRB()
    {
        $data = [
            'poli' => $this->smf(),
        ];
        return view('vclaim/ListPRB', $data);
    }

    public function dataListPRB()
    {
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $search = $this->request->getPost();
        $dateout = explode('-', $search['tglSrb']);
        $mulai = str_replace('/', '-', $dateout[0]);
        $sampai = str_replace('/', '-', $dateout[1]);

        $tglawal = date('Y-m-d', strtotime($mulai));
        $tglakhir = date('Y-m-d', strtotime($sampai));

        $response = $client->request('GET', $base_url .  $service_name .  'prb/tglMulai/' . $tglawal . '/' . 'tglAkhir/' . $tglakhir, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);

        $data = [
            'response' => $datakeluaran,
        ];

        if ($string['metaData']['code'] == 201) {
            $msg = [
                'success' => false,
                'pesan' => $string['metaData']['message'],
            ];
        } else {
            $msg = [
                'success' => true,
                'data' => view('vclaim/dataListPRB', $data)
            ];
        }
        echo json_encode($msg);
    }

    public function ListNoPRB()
    {

        return view('vclaim/ListNoSRB');
    }
    public function check_ListNoPRB()
    {
        //base url
        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        //service name
        $service_name = 'vclaim-rest/';
        $client = new Client();
        $header = $this->header();
        //$header['Content-Type'] = "application/json; charset=utf-8";
        $param = $this->request->getPost();
        $noSrb = $param['nomorSrb'];
        $noSep = $param['noSep'];




        $response = $client->request('GET', $base_url . $service_name . 'prb/' . $noSrb . '/' . 'nosep/'  . $noSep, [
            'headers' => $this->header(),
        ])->getBody()->getContents();

        $cons_id = $header['X-cons-id'];
        $secretKey = "4iK5B08401";
        $tStamp = $header['X-timestamp'];

        $key = $cons_id . $secretKey . $tStamp;
        $string = json_decode($response, true);
        $keluaran = $this->stringDecrypt($key, $string['response']);
        $datakeluaran = json_decode($keluaran, true);


        if ($string['metaData']['code'] == 201) {
            $msg = [
                'pesan' => $string['metaData']['message'],
                'success' => false,
            ];
        } else {
            $msg = [
                'success' => true,
            ];
        }
        echo json_encode($msg);
    }

    public function simpanPRB()
    {
        if ($this->request->isAJAX()) {


            $datasep['noSep'] = $this->request->getVar('noSep');
            $datasep['noKartu'] = $this->request->getVar('noKartu');
            $datasep['alamat'] = $this->request->getVar('alamat');
            $datasep['email'] = $this->request->getVar('email');
            $datasep['keterangan'] = $this->request->getVar('keterangan');
            $datasep['saran'] = $this->request->getVar('saran');
            $datasep['programPRB'] = $this->request->getVar('programPRB');
            $datasep['kodeDPJP'] = $this->request->getVar('kodeDokter');
            $datasep['kdObat'] = $this->request->getVar('kdObat');
            $datasep['signa1'] = $this->request->getVar('signa1');
            $datasep['user'] = '210484';

            $kdObat = explode('|', $datasep['kdObat']);
            $jmldata = count($kdObat);
            for ($i = 0; $i < $jmldata; $i++) {
                $datasep['kdObatPRB'] = $kdObat[$i];
            }

            $signa1 = explode('|', $datasep['signa1']);
            $jmldatasigna1 = count($signa1);
            for ($i = 0; $i < $jmldatasigna1; $i++) {
                $datasep['signa1PRB'] = $signa1[$i];
            }

            if (($datasep['keterangan'] == "")) {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Keterangan Tidak Boleh Kosong'
                ];
            } else if ($datasep['saran'] == "") {
                $msg = [
                    'gagal' => true,
                    'pesan' => 'Saran Tidak Boleh Kosong'
                ];
            } else {
                $header = $this->header();
                $sep = json_decode($this->insert_prb($datasep, $header), true);

                $cons_id = $header['X-cons-id'];
                $secretKey = "4iK5B08401";
                $tStamp = $header['X-timestamp'];

                $key = $cons_id . $secretKey . $tStamp;
                $keluaran = $this->stringDecrypt($key, $sep['response']);
                $datakeluaran = json_decode($keluaran, true);

                if ($sep['response'] == null) {
                    $msg = [
                        'success' => false,
                        'pesan' => $sep['metaData']['message']
                    ];
                } else {
                    $namaDpjp = $datakeluaran['response']['DPJP']['nama'];
                    $keterangan = $datakeluaran['response']['keterangan'];
                    $noSrb = $datakeluaran['response']['noSRB'];
                    $alamat = $datakeluaran['response']['peserta']['alamat'];
                    $asalFaskes = $datakeluaran['response']['asalFaskes']['nama'];
                    $programPRB = $datakeluaran['response']['programPRB'];
                    $saran = $datakeluaran['response']['saran'];

                    $msg = [
                        'success' => true,
                        'response' => $datakeluaran,
                        'pesan' => $sep['metaData']['message']
                    ];
                }
            }
        }
        echo json_encode($msg);
    }

    private function insert_prb($param, $header)
    {

        $base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
        $service_name = 'vclaim-rest/';

        $data = [
            "request" =>
            [
                "t_prb" =>
                [
                    "noSep" => $param['noSep'],
                    "noKartu" => $param['noKartu'],
                    "alamat" => $param['alamat'],
                    "email" => $param['email'],
                    "programPRB" => $param['programPRB'],
                    "kodeDPJP" => $param['kodeDPJP'],
                    "keterangan" => $param['keterangan'],
                    "saran" => $param['saran'],
                    "user" => $param['user'],
                    "obat" =>
                    [
                        "kdObat" => $param['kdObatPRB'],
                        "signa1" => $param['signa1PRB'],
                        "signa2" => $param['signa1'],
                        "jmlObat" => '10'
                    ]
                ]
            ]
        ];

        var_dump($data);
        die();

        $client = new Client();
        $header['Content-Type'] = "Application/x-www-form-urlencoded";

        $response = $client->request('POST', $base_url .  $service_name  . 'PRB/insert', [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        return $response;
    }
}

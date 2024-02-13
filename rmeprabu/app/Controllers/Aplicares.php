<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;
use App\Models\Model_aplicares;

class Aplicares extends Controller
{
    private $base_url = 'https://new-api.bpjs-kesehatan.go.id/';
    // test
    //private $base_url = 'http://dvlp.bpjs-kesehatan.go.id:8081/';
    private $service_name = 'new-vclaim-rest/';
    private $kodePPK = '0609R001';

    private function header()
    {

        $data = "1168";
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

    public function index()
    {
        return view('aplicares/referensikamar');
    }

    public function referensi_kamar()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "application/json";

        $response = $client->request('GET', $this->base_url . 'aplicaresws/rest/ref/kelas', [
            'headers' => $header,

        ])->getBody()->getContents();

        $data['response'] = json_decode($response);
        $msg = [
            'data' => view('aplicares/datareferensikamar', $data)
        ];
        echo json_encode($msg);
    }

    public function Ketersediaan()
    {
        return view('aplicares/ketersediaankamar');
    }

    public function ketersediaan_kamar()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "application/json";

        $response = $client->request('GET', $this->base_url . 'aplicaresws/rest/bed/read/' . $this->kodePPK . '/1/50', [
            'headers' => $header,

        ])->getBody()->getContents();

        //var_dump(json_decode($response, true));
        $data['response'] = json_decode($response);
        $msg = [
            'data' => view('aplicares/dataketersediaankamar', $data)
        ];
        echo json_encode($msg);
    }


    public function MasterKamar()
    {
        return view('aplicares/masterkamar');
    }

    public function ambildataKamar()
    {
        if ($this->request->isAJAX()) {

            $model = new Model_aplicares();
            $data = [
                'list' => $model->get_master_kamar()
            ];
            $msg = [
                'data' => view('aplicares/datakamarRS', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function viewMasterKamar()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $model = new Model_aplicares();
            $roomcode = $this->request->getVar('roomcode');

            $data = [
                'kamar' => $model->get_data_master_kamar($roomcode),
            ];
            $msg = [
                'sukses' => view('aplicares/modalcreatekamar', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function create_kamar()
    {

        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "application/json";
        $roomcode = $this->request->getVar('roomcode');
        $data = $this->get_create($roomcode);


        $response = $client->request('POST', $this->base_url . 'aplicaresws/rest/bed/create/' . $this->kodePPK, [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();

        echo json_encode($response);
    }

    //update
    public function update_kamar()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "application/json";
        $data = $this->get_update();
        //var_dump($data); die();

        foreach ($data as $row) {
            $response[] = $client->request('POST', $this->base_url . 'aplicaresws/rest/bed/update/' . $this->kodePPK, [
                'headers' => $header,
                'json' => $row,

            ])->getBody()->getContents();
        }

        var_dump($response);
    }


    public function delete_kamar()
    {
        $client = new Client();
        $header = $this->header();
        $header['Content-Type'] = "application/json";
        $roomcode = $this->request->getVar('roomcode');
        $data = $this->get_delete($roomcode);

        $response = $client->request('POST', $this->base_url . 'aplicaresws/rest/bed/delete/' . $this->kodePPK, [
            'headers' => $header,
            'json' => $data,

        ])->getBody()->getContents();
        echo json_encode($response);
    }

    function get_update()
    {
        $model = new Model_aplicares();
        $data = $model->get_update();
        $roomcode = $model->get_roomcode();

        foreach ($roomcode as $indexroom => $room) {
            $kapasitas = 0;
            $tersedia = 0;
            foreach ($data as $row) {
                if ($row['status'] == 'KOSONG' && $row['roomcode'] == $room['roomcode']) {
                    $tersedia++;
                    $new_data[$indexroom]['tersedia'] = $tersedia;
                }

                if ($row['roomcode'] == $room['roomcode']) {
                    $kapasitas++;
                    $new_data[$indexroom]['kapasitas'] = $kapasitas;
                }
            }

            $new_data[$indexroom]['namaruang'] = $room['roomname'];
            $new_data[$indexroom]['koderuang'] = $room['roomcode'];
            $new_data[$indexroom]['kodekelas'] = $room['classroom'];
            $new_data[$indexroom]['tersediapria'] = 0;
            $new_data[$indexroom]['tersediawanita'] = 0;
            $new_data[$indexroom]['tersediapriawanita'] = 0;
        }

        return $new_data;
    }

    public function get_create()
    {
        $model = new Model_aplicares();
        $roomcode = $this->request->getVar('roomcode');
        $data = $model->get_create($roomcode);


        $tersedia = 0;
        $kapasitas = 0;
        foreach ($data as $row) {
            if ($row['status'] == 'KOSONG') {
                $tersedia++;
                $new_data['tersedia'] = $tersedia;
            }

            $kapasitas++;
            $new_data['kapasitas'] = $kapasitas;

            $new_data['namaruang'] = strtolower($row['roomname']);
            $new_data['koderuang'] = $row['roomcode'];
            $new_data['kodekelas'] = $row['classroom'];
            $new_data['tersediapria'] = 0;
            $new_data['tersediawanita'] = 0;
            $new_data['tersediapriawanita'] = 0;
        }
        return $new_data;
    }

    public function get_delete()
    {
        $model = new Model_aplicares();
        //$data = $model->get_delete('FLB01');
        $data = $this->request->getVar('roomcode');
        $data = $model->get_delete($data);


        $new_data['koderuang'] = $data['roomcode'];
        $new_data['kodekelas'] = $data['classroom'];
        return $new_data;
    }

    public function UpdateKetersediaan()
    {
        return view('aplicares/Updateketersediaankamar');
    }

    public function update_kamar_aplicares()
    {
        $client = new Client();

        $header = $this->header();
        $header['Content-Type'] = "application/json";
        $data = $this->get_update();


        foreach ($data as $row) {
            $response[] = $client->request('POST', $this->base_url . 'aplicaresws/rest/bed/update/' . $this->kodePPK, [
                'headers' => $header,
                'json' => $row,

            ])->getBody()->getContents();
        }

        //var_dump($response);
        $data = $response;
        var_dump($data);

        echo json_encode($data);
    }
}

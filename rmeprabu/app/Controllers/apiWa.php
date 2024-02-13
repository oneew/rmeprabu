<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Service;
use GuzzleHttp\Client;

class apiWa extends Controller
{
    public function index()
    {
        $client = new Client();

        $api_key   = 'fceff0304a7329cfc8b1624b50d64aa34938370b';
        $id_device = '6787';
        $url   = 'https://api.watsap.id/send-message';
        $no_hp = '081563627893';
        $pesan = '😁 Halo Terimakasih 🙏';

        $url = 'https://api.watsap.id/send-message';
        $data_post = [
            'id_device' => $id_device,
            'api-key' => $api_key,
            'no_hp'   => $no_hp,
            'pesan'   => $pesan
        ];
        $header['Content-Type'] = "multipart/form-data";

        $response = $client->request('POST', $url, [
            'header' => $header,
            'json' => $data_post
        ])->getBody()->getContents();

        var_dump($response);
    }
}

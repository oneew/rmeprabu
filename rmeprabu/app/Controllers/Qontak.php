<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use GuzzleHttp\Client;

class Qontak extends Controller
{
    public function get_token()
    {
        $client = new Client();

        $header['Content-Type'] = "application/json";

        // akun qontak lima / demo@qontak.com
        // $request = [
        //     "username" => "demo@qontak.com",
        //     "password" => "Password123!",
        //     "grant_type" => "password",
        //     "client_id" => "RRrn6uIxalR_QaHFlcKOqbjHMG63elEdPTair9B9YdY",
        //     "client_secret" => "Sa8IGIh_HpVK1ZLAF0iFf7jU760osaUNV659pBIZR00"
        // ];

        $request = [
            "username" => "sofonet@gmail.com",
            "password" => "Rsudsyamsudin123!",
            "grant_type" => "password",
            "client_id" => "RRrn6uIxalR_QaHFlcKOqbjHMG63elEdPTair9B9YdY",
            "client_secret" => "Sa8IGIh_HpVK1ZLAF0iFf7jU760osaUNV659pBIZR00"
        ];


        $response = $client->request('POST', 'https://chat-service.qontak.com/oauth/token', [
            'headers' => $header,
            'json' => $request,
        ])->getBody()->getContents();

        var_dump($response);
    }

    public function get_channel()
    {
        $client = new Client();

        $header['Authorization'] = 'Bearer y12Aam0auhyN-_vfVYTF2sFjK0cNRv2mxexs957otVs';
        $header['Content-Type'] = "application/json";

        $response = $client->request('GET', 'https://chat-service.qontak.com/api/open/v1/integrations', [
            'headers' => $header,
        ])->getBody()->getContents();

        var_dump(json_decode($response, true));
        // a7df491d-8b35-48c4-acd8-513f4155cb11
    }

    public function send_message()
    {
        $client = new Client();

        $header['Authorization'] = 'Bearer y12Aam0auhyN-_vfVYTF2sFjK0cNRv2mxexs957otVs';
        $header['Content-Type'] = "application/json";



        $request = [
            "to_name" => "Deni Apriali",
            "to_number" => "6282119597452",
            //"message_template_id" => "07f717e9-413f-4248-bba7-e5503d987a2f",
            "message_template_id" => "1fcfb8eb-f36f-4fbb-9f57-d1f11812d949",
            "channel_integration_id" => "7907b6a2-702d-4938-8393-b3a3ef58ed9c",
            "language" => ["code" => "id"],
            "parameters" => [
                "body" => [
                    // [
                    //     "key" => "1",
                    //     "value_text" => "Malam",
                    //     "value" => "waktu"
                    // ],
                    [
                        "key" => "1",
                        "value_text" => "Deni Apriali",
                        "value" => "name"
                    ],
                    // [
                    //     "key" => "3",
                    //     "value_text" => "MUHAMMAD ARZAN ALFARISH, DR.",
                    //     "value" => "dokter"
                    // ],
                    // [
                    //     "key" => "4",
                    //     "value_text" => "Rabu",
                    //     "value" => "hari"
                    // ],
                    [
                        "key" => "2",
                        "value_text" => "19-07-2022",
                        "value" => "tanggal"
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', 'https://chat-service.qontak.com/api/open/v1/broadcasts/whatsapp/direct', [
            'headers' => $header,
            'json' => $request,
        ])->getBody()->getContents();

        //var_dump($response);
    }

    function get_templates()
    {
        $client = new Client();

        $header['Authorization'] = 'Bearer y12Aam0auhyN-_vfVYTF2sFjK0cNRv2mxexs957otVs';
        $header['Content-Type'] = "application/json";

        $id = 'b654c960-e00b-4efa-98f8-65caf881f143';
        $response = $client->request('GET', 'https://chat-service.qontak.com/api/open/v1/templates/' . $id . '/whatsapp', [
            'headers' => $header,
        ])->getBody()->getContents();

        var_dump(json_decode($response, true));
    }

    public function validate_number()
    {
        $client = new Client();

        $header['Authorization'] = 'Bearer omEfnxsUev74aCV33PwqiCuT87QbYhvVuSuGNDmUR0E';
        $header['Content-Type'] = "application/json";

        $request = [
            "phone_numbers" => ["6282119597452"],
            "channel_integration_id" => "36ce24c0-4e29-4efe-bffe-f3dfcdc6b21d"
        ];

        $response = $client->request('POST', 'https://chat-service.qontak.com/api/open/v1/broadcasts/contacts', [
            'headers' => $header,
            'json' => $request,
        ])->getBody()->getContents();

        var_dump($response);
    }

    public function send_message_expertise_rad()
    {
        $client = new Client();

        $header['Authorization'] = 'Bearer y12Aam0auhyN-_vfVYTF2sFjK0cNRv2mxexs957otVs';
        $header['Content-Type'] = "application/json";



        $request = [
            "to_name" => "Deni Apriali",
            "to_number" => "6282119597452",
            "message_template_id" => "e42d2eff-a28d-4afe-92d9-966ca2fdbb3f",
            "channel_integration_id" => "7907b6a2-702d-4938-8393-b3a3ef58ed9c",
            "language" => ["code" => "id"],
            "parameters" => [
                "body" => [
                    [
                        "key" => "1",
                        "value_text" => "Pagi",
                        "value" => "waktu"
                    ],
                    [
                        "key" => "2",
                        "value_text" => "Deni Apriali",
                        "value" => "name"
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', 'https://chat-service.qontak.com/api/open/v1/broadcasts/whatsapp/direct', [
            'headers' => $header,
            'json' => $request,
        ])->getBody()->getContents();

        var_dump($response);
    }

    public function send_message_expertise()
    {
        $client = new Client();
        //36ce24c0-4e29-4efe-bffe-f3dfcdc6b21d
        $header['Authorization'] = 'Bearer RPTAXWCH70fttXAvLv0J-P1lovpEHOs6Gy6jJD7fStA';
        $header['Content-Type'] = "application/json";

        $urlDocument = base_url() . 'public/pdf/expertise radiologi.pdf';

        $request = [
            "to_name" => "Deni Apriali",
            "to_number" => "6282119597452",
            "message_template_id" => "e42d2eff-a28d-4afe-92d9-966ca2fdbb3f",
            "channel_integration_id" => "7907b6a2-702d-4938-8393-b3a3ef58ed9c",
            "language" => ["code" => "id"],
            "parameters" => [
                "header" => [
                    "format" => "DOCUMENT",
                    "params" => [
                        [
                            "key" => "url",
                            "value" => "https://qontak-hub-development.s3.amazonaws.com/uploads/direct/files/1689c7d8-e73a-4c40-862d-7d8eb4bce30a/expertise_radiologi.pdf"
                        ],
                        [
                            "key" => "filename",
                            "value" => "test.pdf"
                        ]
                    ]
                ],
                "body" => [
                    [
                        "key" => "1",
                        "value_text" => "pagi",
                        "value" => "waktu"
                    ],
                    [
                        "key" => "2",
                        "value_text" => "Deni Apriali",
                        "value" => "name"
                    ]
                ]
            ]
        ];

        $response = $client->request('POST', 'https://chat-service.qontak.com/api/open/v1/broadcasts/whatsapp/direct', [
            'headers' => $header,
            'json' => $request,
        ])->getBody()->getContents();

        var_dump($response);
    }
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Service;
use GuzzleHttp\Client;

class Test_api extends Controller
{
    public function index()
    {
        $client = new Client();

        $url = 'https://rsudds.ferizzarics.com/scp/api/Mwl';
        $request = [
            'item_ID' => 0,
            'taG_ACCESSION_NUMBER' => '009988',
            'taG_MODALITY' => 'CT',
            'taG_INSTITUTION_NAME' => 'RSUD dr. Slamet',
            'taG_REFFERING-PHYSICIAN-NAME' => 'dr. Susilo Spog',
            'taG_PATIENT_NAME' => 'Lee Kwan Yeo',
            'taG_PATIENT_ID' => '666',
            'taG_PATIENT_BIRTH_DATE' => '1978-08-31T00:00:00',
            'taG_PATIENT_SEX' => 'M',
            'taG_PATIENT_WEIGHT' => 0,
            'taG_STUDY_INSTANCE_UID' => '',
            'taG_REQUESTING_PHYSICIAN' => '',
            'taG_REQUESTED_PROCEDURE_DESCRIPTION' => '',
            'taG_ADMISSION_ID' => '',
            'taG_SCHEDULED_STATION_AE_TITLE' => '',
            'taG_SCHEDULED_PROCEDURE_STEP_START_DATE' => '2023-01-10T00:00:00',
            'taG_SCHEDULED_PROCEDURE_STEP_START_TIME' => '2023-01-10T00:00:00',
            'taG_SCHEDULED_PERFORMING_PHYSICIAN_NAME' => '',
            'taG_SCHEDULED_PROCEDURE_STEP_DESCRIPTION' => '',
            'taG_SCHEDULED_PROCEDURE_STEP_ID' => '',
            'taG_SCHEDULED_PROCEDURE_STEP_LOCATION' => '',
            'taG_REQUESTED_PROCEDURE_ID' => '',
            'taG_REASON_FOR_THE_REQUESTED_PROCEDURE' => '',
            'taG_REQUESTED_PROCEDURE_PRIORITY' => 'LOW'
        ];
        $header['Content-Type'] = "multipart/form-data";

        $response = $client->request('POST', $url, [
            'header' => $header,
            'json' => $request
        ])->getBody()->getContents();

        var_dump($response);
    }
}

<?php

namespace App\Controllers;

use App\Models\ModelBedInfo;

class InfoBed extends BaseController
{

    public function index()
    {


        $bed = new ModelBedInfo();
        $data = [
            'tampildata' => $bed->ambildatabed()
        ];

        echo view('dashboard/infobed', $data);
    }
}

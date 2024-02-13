<?php

namespace App\Controllers;

use App\Models\Modelranap;

class rawatinap extends BaseController
{


    public function index()
    {
        $rawatinap = new Modelranap();
        $keyword = $this->request->getVar('norm');

        if ($keyword) {
            $rawatinap->search($keyword);
        } else {
            $rawatinap->where('statusrawatinap', 'RAWAT')
                ->orderBy('documentdate', 'DESC')
                ->findAll();
        }


        $data = [
            'tampildata' => $rawatinap->where('statusrawatinap', 'RAWAT')
                ->orderBy('documentdate', 'DESC')
                ->findAll()
        ];
        echo view('ibs/pasien_ranap', $data);
    }
}

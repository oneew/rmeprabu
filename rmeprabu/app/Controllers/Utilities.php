<?php

namespace App\Controllers;

use App\Models\Model_dokter;
use Config\Services;

class Utilities extends BaseController
{
    public function ajax_get_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_dokter($request);

        $key = $request->getGet('term');
        $data = $m_auto->select('types, name')->where('types', 'DOKTER')->like('name', $key)->findAll();

        foreach ($data as $row) {
            $json[] = [
                'value' => $row['name'],
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }
}
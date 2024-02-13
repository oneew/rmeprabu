<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Table_dinamis extends Controller
{
    public function index()
    {
        $data['data'] = [
            ['name' => 'data 3 kolom', 'jumlah' => 3],
            ['name' => 'data 5 kolom', 'jumlah' => 5]
        ];

        // diambil dari data terbanyak. untuk mengatur header table
        $data['max_column'] = 5;

        //dd($data);
        //return view('table_dinamis/vertikal', $data);
        return view('clinicalpathway/tabledinamis', $data);
    }
}

<?php

namespace App\Controllers;

use Config\Services;
use CodeIgniter\HTTP\Request;
use App\Models\Model_nested_list;




class Nested_list extends BaseController
{

    public function index()
    {
        $query = new Model_nested_list();
        $master = $query->get_master();

        // foreach untuk memasukkan tiap id data $master ke array
        foreach ($master as $row_master) {
            $id[] = $row_master['journalnumber'];
        }

        // select data detail whereIn foreign key $id
        $detail = $query->get_detail($id);

        // foreach menyatukan $master dan detail dalam satu array
        // $detail dalam $master
        // array dalam array
        foreach ($master as $index => $row) {
            $data[$index]['journalnumber'] = $row['journalnumber'];
            $data[$index]['pasienid'] = $row['pasienid'];
            // foreach $detail yang disisipkan ke $master
            foreach ($detail as $item) {
                // mencocokkan primary key dan foreign key
                if ($item['journalnumber'] == $row['journalnumber']) {
                    // jika cocok maka akan membuat element baru pada $master yang sekarang menjadi $data
                    // element ini bertipe array, jadi jika ada data yang cocok lagi maka akan terisi lagi
                    $data[$index]['list'][] = $item;
                }
            }
        }



        var_dump($data);
    }
}

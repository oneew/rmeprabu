<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_autocomplete;
use Config\Services;

class Autocomplete2 extends Controller
{


    public function index()
    {
        $data['list'] = $this->_data_dokter();
        echo view('autocomplete/index', $data);
    }

    // fungsi onchange dokter
    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }


    // mereturn json yang nantinya digunakan untuk mengisi input otomatis pada view
    public function fill_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_dokter();
        return json_encode($data);
    }

    public function fill_dokter_gizi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_dokter_gizi();
        return json_encode($data);
    }


    public function fill_smf()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_smf();
        return json_encode($data);
    }

    public function fill_poli()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_poli();
        return json_encode($data);
    }

    public function fill_payment()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_payment();
        return json_encode($data);
    }

    public function fill_kelas()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_kelas();
        return json_encode($data);
    }


    public function fill_room()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_roomname();
        return json_encode($data);
    }

    public function ajax_pelayanan()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        // menangkap data yang dikirim dengan method get
        $key = $request->getGet('term');
        //$term = "KLS1";
        $term = $this->request->getVar('kelas');
        $data = $m_auto->get_list_pelayanan($term, $key);

        foreach ($data as $row) {
            // menulis ulang array/ mengganti key nama menjadi value
            $json[] = [
                'value' => $row['name'],
                'id' => $row['id'],
                'code' => $row['code'],
                'groupname' => $row['groupname'],
                'price' => $row['price']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function fill_jenis_pelayanan()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_pelayanan();
        return json_encode($data);
    }

    public function fill_jenis_pelayanan_igd()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_pelayanan_igd();
        return json_encode($data);
    }
}

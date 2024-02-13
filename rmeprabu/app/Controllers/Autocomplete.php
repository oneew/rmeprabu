<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_autocomplete;
use Config\Services;

class Autocomplete extends Controller
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
    public function fill_paymentmethod()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_paymentmethod();
        return json_encode($data);
    }

    public function fill_dokter_forensik()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_dokter_forensik();
        return json_encode($data);
    }

    public function fill_dokter_penunjang()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_dokter_penunjang();
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


    public function fill_jpkasir()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_jpkasir();
        return json_encode($data);
    }

    public function fill_mobil()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_mobil();
        return json_encode($data);
    }

    public function fill_pabrik()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_pabrik();
        return json_encode($data);
    }

    public function fill_lokasi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_lokasi();
        return json_encode($data);
    }

    public function fill_pregnan()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_pregnan();
        return json_encode($data);
    }

    public function fill_kelasterapi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_kelasterapi();
        return json_encode($data);
    }

    public function fill_subkelasterapi()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_subkelasterapi();
        return json_encode($data);
    }

    public function fill_petugas_resep()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_petugas_resep();
        return json_encode($data);
    }

    public function fill_role()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_role();
        return json_encode($data);
    }

    public function fill_triase()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_triase();
        return json_encode($data);
    }

    public function fill_dokter_HD()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_dokter_penunjang();
        return json_encode($data);
    }

    public function fill_depo()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_depo();
        return json_encode($data);
    }

    public function fill_lokasi_user()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $data = $m_auto->get_data_lokasi_user();
        return json_encode($data);
    }
}

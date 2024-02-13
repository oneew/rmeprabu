<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_Foto_Radiologi;
use Config\Services;

class FotoRadiologi extends Controller
{


    public function index()
    {
        $request = Services::request();
        $m_dokter = new Model_Foto_Radiologi($request);

        $data['list'] = $m_dokter->get_list_dokter();

        echo view('dokter/index', $data);
    }

    public function upload()
    {
        helper('form');
        $data['info'] = $this->request->getPost();
        echo view('radiologi/uploadfotoradiologi', $data);
    }

    public function do_upload()
    {
        $request = Services::request();
        $m_dokter = new Model_Foto_Radiologi($request);

        $foto = $this->request->getFile('file');

        $data = $this->request->getPost();


        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'file' => [
                'rules' => 'uploaded[file]',
                'errors' => [
                    'uploaded' => 'harus diisi'
                ]
            ]

        ]);



        if ($valid) {


            if (!empty($data['foto'])) {

                if (file_exists(ROOTPATH . 'public/assets/images/fotoradiologi/' . $data['foto'])) {

                    unlink(ROOTPATH . 'public/assets/images/fotoradiologi/' . $data['foto']);
                }
            }

            // nama baru, berdasarkan tanggal dan angka acak
            $name_foto = date('dmy') . random_int(100, 100000000) . '.' . $foto->getExtension();
            // memindahkan file dari folder temp ke folder yang di inginkan
            $foto->move('assets/images/fotoradiologi', $name_foto);
            // merubah field foto dalam database dengan variable name_foto
            $m_dokter->set_foto($name_foto, $data['code']);

            $msg = [
                'pesan' => 'Foto berhasil diupload',
                'url' => '../assets/images/fotoradiologi/' . $name_foto,
                'code' => $data['code']
            ];
            echo json_encode($msg);
        } else {
            $msg = [
                'pesangagal' => 'Foto gagal diupload'
            ];
            echo json_encode($msg);
        }
    }

    public function switch()
    {
        echo view('dokter/switch');
    }

    public function upload_view()
    {
        helper('form');
        $data['info'] = $this->request->getPost();
        echo view('rawatinap/uploadfotoradiologi_view', $data);
    }
}

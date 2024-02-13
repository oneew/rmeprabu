<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_dokter_gallery;
use Config\Services;

class Doktergallery extends Controller
{


    public function index()
    {
        $request = Services::request();
        $m_dokter = new Model_dokter_gallery($request);

        $data['list'] = $m_dokter->get_list_dokter();

        echo view('dokter/index', $data);
    }

    public function upload()
    {
        helper('form');
        $data['info'] = $this->request->getPost();
        echo view('dokter/upload', $data);
    }

    public function do_upload()
    {
        $request = Services::request();
        $m_dokter = new Model_dokter_gallery($request);

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

                if (file_exists(ROOTPATH . 'public/assets/images/dokter/' . $data['foto'])) {

                    unlink(ROOTPATH . 'public/assets/images/dokter/' . $data['foto']);
                }
            }

            // nama baru, berdasarkan tanggal dan angka acak
            $name_foto = date('dmy') . random_int(100, 100000000) . '.' . $foto->getExtension();
            // memindahkan file dari folder temp ke folder yang di inginkan
            $foto->move('assets/images/dokter', $name_foto);
            // merubah field foto dalam database dengan variable name_foto
            $m_dokter->set_foto($name_foto, $data['code']);

            $msg = [
                'pesan' => 'Foto berhasil diupload',
                'url' => '../assets/images/dokter/' . $name_foto,
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
}

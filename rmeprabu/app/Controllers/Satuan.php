<?php

namespace App\Controllers;

use App\Models\ModelMasterSatuan;
use App\Models\Modelrajal;
use Config\Services;
use Dompdf\Dompdf;

class Satuan extends BaseController
{

    public function index()
    {

        return view('gudangfarmasi/datamastersatuan');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterSatuan();
            $data = [
                'tampildata' => $gudang->ambildatasatuan()
            ];
            $msg = [
                'data' => view('gudangfarmasi/datamaster_satuan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tambahsatuan()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'daftarbank' => $this->daftar_bank(),
                'kelompok' => $this->kelompok(),
            ];
            $msg = [
                'data' => view('gudangfarmasi/modaladdsatuan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function daftar_bank()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_bank();
        return $list;
    }

    public function kelompok()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_kelompok();
        return $list;
    }

    public function inactive()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_active();
        return $list;
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama PBF',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'name' => $validation->getError('name')
                    ]
                ];
            } else {


                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),

                ];
                $perawat = new ModelMasterSatuan();
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Satuan Berhasil',
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function editsatuan()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $supplier = new ModelMasterSatuan();
            $data = [
                'tampildata' => $supplier->get_data_satuan($id),

            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modaleditsatuan', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {

            $simpandata = [
                'name' => $this->request->getVar('name'),
                'code' => $this->request->getVar('code'),
                'types' => $this->request->getVar('types'),
            ];
            $supplier = new ModelMasterSatuan();
            $id = $this->request->getVar('id');
            $supplier->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Satuan sudah berhasil diubah'
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusSatuan()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelMasterSatuan;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Satuan dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }
}

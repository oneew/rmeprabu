<?php

namespace App\Controllers;

use App\Models\ModelMasterSupplier;
use App\Models\Modelrajal;
use Config\Services;
use Dompdf\Dompdf;

class Supplier extends BaseController
{

    public function index()
    {

        return view('gudangfarmasi/datamastersupplier');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterSupplier();
            $data = [
                'tampildata' => $gudang->ambildatasupplier()
            ];
            $msg = [
                'data' => view('gudangfarmasi/datamaster_supplier', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tambahsupplier()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'daftarbank' => $this->daftar_bank(),
                'kelompok' => $this->kelompok(),
            ];
            $msg = [
                'data' => view('gudangfarmasi/modaladdsupplier', $data)
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


                $db = db_connect();
                $types = $this->request->getVar('types');
                $query = $db->query("SELECT code as kode_jurnal, numberseq as noantrian FROM supplier WHERE  types='$types' ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }

                $underscore = '_';

                if ($kode == "") {
                    $nourut = '00001';
                } else {
                    $nourut = (int) substr($kode, -5, 5);
                    $nourut++;
                }

                if ($types == 'FARMASI') {
                    $kode = 'PBFRBN';
                } else {
                    $kode = 'APTRBN';
                }

                $newkode = $kode . $underscore . sprintf('%06s', $nourut);

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);

                $simpandata = [
                    'types' => $this->request->getVar('types'),
                    'code' => $newkode,
                    'name' => $this->request->getVar('name'),
                    'address' => $this->request->getVar('address'),
                    'telephone' => $this->request->getVar('telephone'),
                    'address' => $this->request->getVar('address'),
                    'taxnumber' => $this->request->getVar('taxnumber'),
                    'taxname' => $this->request->getVar('taxname'),
                    'contactname' => $this->request->getVar('contactname'),
                    'handphone' => $this->request->getVar('handphone'),
                    'bankname' => $this->request->getVar('bankname'),
                    'bankaccount' => $this->request->getVar('bankaccount'),
                    'bankaccountname' => $this->request->getVar('bankaccountname'),
                    'numberseq' => $no_antrian,

                ];
                $perawat = new ModelMasterSupplier();
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Supplier Berhasil',
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function editsupplier()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $supplier = new ModelMasterSupplier();
            $data = [
                'tampildata' => $supplier->get_data_supplier($id),
                'daftarbank' => $this->daftar_bank(),
                'kelompok' => $this->kelompok(),
                'aktif' => $this->inactive(),
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modaleditsupplier', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {

            $simpandata = [
                'name' => $this->request->getVar('name'),
                'telephone' => $this->request->getVar('telephone'),
                'address' => $this->request->getVar('address'),
                'taxname' => $this->request->getVar('taxname'),
                'taxnumber' => $this->request->getVar('taxnumber'),
                'contactname' => $this->request->getVar('contactname'),
                'handphone' => $this->request->getVar('handphone'),
                'bankaccount' => $this->request->getVar('bankaccount'),
                'bankname' => $this->request->getVar('bankname'),
                'bankaccountname' => $this->request->getVar('bankaccountname'),
                'inactive' => $this->request->getVar('inactive'),

            ];
            $supplier = new ModelMasterSupplier();
            $id = $this->request->getVar('id');
            $supplier->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Supplier sudah berhasil diubah'
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\ModelDokter;
use App\Models\ModelTempletEresepDetail;
use App\Models\ModelTempletEresepHeader;

class TempletEResep extends BaseController
{
    function index() {

        if ($this->request->isAJAX()) {
            $data_header = new ModelTempletEresepHeader();
            return json_encode([
                'data' => view('templetEresep/data_e_resep', [
                    'datas' => $data_header->detail_e_resep(),
                ])
            ]);
        }

        $dokter = new ModelDokter();
        $datas =  $dokter->select('types, name, code')
        ->where('types', 'DOKTER')
        ->where('name !=', '')
        ->findAll();

        return view('templetEresep/index',[
            'datas' => $datas
        ]);
    }

    function store(){
        if ($this->request->isAJAX()) {
            $ref = 'e_resep_'. $this->request->getPost('token');

            $data_header = new ModelTempletEresepHeader();
            $data_e_resep_header = $data_header->where('referencenumber', $ref)->findAll();
            if($data_e_resep_header == null){
                $dokter = $this->request->getPost('nama_dokter');
                
                if ($dokter != null) {
                    $result_dokter = explode('|', $dokter);
                    $kode_dokter = $result_dokter[0];
                    $nama_dokter = $result_dokter[1];
                }

                $data_header->insert([
                    'referencenumber' => $ref,
                    'nama_tindakan' => $this->request->getPost('nama_tindakan'),
                    'nama_dokter' => $nama_dokter,
                    'kode_dokter' => $kode_dokter,
                    'created_by' => session()->get('firstname'),
                ]);
            }

            $data_detail = new ModelTempletEresepDetail();
            $data_detail->insert([
                'referencenumber' => $ref,
                'kode_obat' => $this->request->getPost('kode_obat'),
                'nama_obat' => $this->request->getPost('nama_obat'),
                'jumlah_obat' => $this->request->getPost('jumlah_obat'),
                'created_by' => session()->get('firstname'),
            ]);

            $msg = [
                'sukses' => 'Templet EResep Berhasil ditambahkan !!',
            ];
            return json_encode($msg);
        }else {
            exit('Tidak dapat di proses');
        }
    }

    function edit() {
        if ($this->request->isAJAX()) {
            $data_header = new ModelTempletEresepHeader();
            $dokter = new ModelDokter();

            return json_encode([
                'data' => view('templetEresep/modal_edit', [
                    'data' => $data_header->find($this->request->getVar('id')),
                    'list_dokter' => $dokter->select('types, name, code')
                                            ->where('types', 'DOKTER')
                                            ->where('name !=', '')
                                            ->findAll(),
                ])
            ]);
        }else {
            exit('tidak dapat di proses');
        }
    }

    function old_drug() {
        if ($this->request->isAJAX()) {
            $data = new ModelTempletEresepDetail();
            return json_encode([
                'data' => view('templetEresep/data_obat_lama', [
                    'list_obat' => $data->select('id, referencenumber, kode_obat, nama_obat, jumlah_obat')
                    ->where('referencenumber', $this->request->getVar('referencenumber'))
                    ->findAll(),
                ])
            ]);
        }
    }

    function delete_drug() {
        if ($this->request->isAJAX()) {
            $data = new ModelTempletEresepDetail();

            $data->delete($this->request->getVar('id'));
            return json_encode([
                'success' => 'Data obat berhasil di hapus',
            ]);
        }
    }

    function add_drug() {
        if ($this->request->isAJAX()) {
            $data_detail = new ModelTempletEresepDetail();
            $data_detail->insert([
                'referencenumber' => $this->request->getPost('referencenumber'),
                'kode_obat' => $this->request->getPost('kode_obat_add'),
                'nama_obat' => $this->request->getPost('nama_obat_add'),
                'jumlah_obat' => $this->request->getPost('jumlah_obat_add'),
                'created_by' => session()->get('firstname'),
            ]);

            return json_encode([
                'success' => 'Data obat berhasil di tambah',
            ]);
        }else{
            exit('tidak dapat di proses');
        }
    }

    function update() {
        if ($this->request->isAJAX()) {
            
            $data_header = new ModelTempletEresepHeader();

            $dokter = $this->request->getPost('nama_dokter_edit');
            
            if ($dokter != null) {
                $result_dokter = explode('|', $dokter);
                $kode_dokter = $result_dokter[0];
                $nama_dokter = $result_dokter[1];
            }

            $data_header->update($this->request->getPost('id_header'),[
                'nama_tindakan' => $this->request->getPost('nama_tindakan_edit'),
                'nama_dokter' => $nama_dokter,
                'kode_dokter' => $kode_dokter,
                'created_by' => session()->get('firstname'),
            ]);

            $msg = [
                'success' => 'Templet EResep Berhasil diubah !!',
            ];
            return json_encode($msg);
        }else {
            exit('Tidak dapat di proses');
        }
    }

    function delete() {
        if ($this->request->isAJAX()) {
            $data_header = new ModelTempletEresepHeader();
            $data_header->delete($this->request->getVar('id'));

            $data_detail = new ModelTempletEresepDetail();
            $data_detail->where('referencenumber', $this->request->getVar('ref'))->delete();

            return json_encode([
                'success' => 'Data Templet E Resep berhasil di hapus !!'
            ]);
        }else{
            exit('Tidak dapat diproses');
        }
    }

}

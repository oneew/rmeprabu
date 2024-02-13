<?php

namespace App\Controllers;

use App\Models\ModelMasterObat;
use App\Models\Modelrajal;
use Config\Services;
use Dompdf\Dompdf;



class BHP extends BaseController
{

    public function index()
    {

        return view('gudangfarmasi/datamasterbhp');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->ambildata_bhp()
            ];
            $msg = [
                'data' => view('gudangfarmasi/datamaster_bhp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tambahBHP()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'daftarbank' => $this->daftar_bank(),
                'production' => $this->daftar_production(),
                'satuan' => $this->daftar_satuan(),
                'pabrik' => $this->pabrik(),
                'eticket' => $this->daftar_eticket(),

            ];
            $msg = [
                'data' => view('gudangfarmasi/modaladdbhp', $data)
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

    public function daftar_production()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_production();
        return $list;
    }

    public function daftar_satuan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_satuan();
        return $list;
    }

    public function pabrik()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pabrik();
        return $list;
    }

    public function daftar_eticket()
    {
        $m_auto = new Modelrajal();
        $list = $m_auto->get_eticket();
        return $list;
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama BHP',
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
                $query = $db->query("SELECT MAX(code) as kode_jurnal, MAX(numberseq)as noantrian FROM obat WHERE code <>'NONE' LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }



                if ($kode == "") {
                    $nourut = '1000001';
                } else {
                    $nourut = (int) substr($kode, -7, 7);
                    $nourut++;
                }



                $newkode = sprintf('%07s', $nourut);

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);

                $simpandata = [
                    'code' => $newkode,
                    'name' => $this->request->getVar('name'),
                    'uom' => $this->request->getVar('uom'),
                    'volume' => $this->request->getVar('volume'),
                    'composition' => $this->request->getVar('composition'),
                    'purchaseprice' => $this->request->getVar('purchaseprice'),
                    'taxprice' => $this->request->getVar('taxprice'),
                    'salesprice' => $this->request->getVar('salesprice'),
                    'minstock' => $this->request->getVar('minstock'),
                    'maxstock' => $this->request->getVar('maxstock'),
                    'types' => $this->request->getVar('types'),
                    'category' => $this->request->getVar('category'),
                    'groups' => $this->request->getVar('groups'),
                    'eticket' => $this->request->getVar('eticket'),
                    'onlabel' => $this->request->getVar('onlabel'),
                    'offlabel' => $this->request->getVar('offlabel'),
                    'sicklevel' => $this->request->getVar('sicklevel'),
                    'memo' => $this->request->getVar('memo'),
                    'ac' => $this->request->getVar('ac'),
                    'dc' => $this->request->getVar('dc'),
                    'pc' => $this->request->getVar('pc'),
                    'ac_pc' => $this->request->getVar('ac_pc'),
                    'heartindication' => $this->request->getVar('heartindication'),
                    'fn' => $this->request->getVar('fn'),
                    'pregnantriskcode' => $this->request->getVar('pregnantriskcode'),
                    'pregnantriskname' => $this->request->getVar('pregnantriskname'),
                    'tradename' => $this->request->getVar('tradename'),
                    'manufacturecode' => $this->request->getVar('manufacturecode'),
                    'manufacturename' => $this->request->getVar('manufacturename'),
                    'originalname' => $this->request->getVar('originalname'),
                    'classteraphycode' => $this->request->getVar('classteraphycode'),
                    'classteraphyname' => $this->request->getVar('classteraphyname'),
                    'subclassteraphycode' => $this->request->getVar('subclassteraphycode'),
                    'subclassteraphyname' => $this->request->getVar('subclassteraphyname'),
                    'regimen' => $this->request->getVar('regimen'),
                    'indication' => $this->request->getVar('indication'),
                    'usualdoze' => $this->request->getVar('usualdoze'),
                    'pf_start' => $this->request->getVar('pf_start'),
                    'pf_work' => $this->request->getVar('pf_work'),
                    'pf_time' => $this->request->getVar('pf_time'),
                    'off_label_used' => $this->request->getVar('off_label_used'),
                    'drugefek' => $this->request->getVar('drugefek'),
                    'foodinteraction' => $this->request->getVar('foodinteraction'),
                    'production' => $this->request->getVar('production'),
                    'stockupdate' => $this->request->getVar('stockupdate'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'locationname' => $this->request->getVar('locationname'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),

                ];
                $perawat = new ModelMasterObat();
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah BHP Berhasil',
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function editBHP()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $supplier = new ModelMasterObat();
            $data = [
                'tampildata' => $supplier->ambildata_obat($id),
                'production' => $this->daftar_production(),
                'satuan' => $this->daftar_satuan(),
                'pabrik' => $this->pabrik(),
                'eticket' => $this->daftar_eticket(),
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modaleditbhp', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {

            $purchaseprice = $this->request->getVar('purchaseprice');
            $hargabeli = preg_replace("/[^0-9]/", "", $purchaseprice);

            $taxprice = $this->request->getVar('taxprice');
            $hnapajak = preg_replace("/[^0-9]/", "", $taxprice);

            $hargajual = $this->request->getVar('salesprice');
            //$hja = preg_replace("/[^0-9]/", "", $hargajual);
            $hja = $this->request->getVar('salesprice');

            $simpandata = [
                'name' => $this->request->getVar('name'),
                'uom' => $this->request->getVar('uom'),
                'volume' => $this->request->getVar('volume'),
                'composition' => $this->request->getVar('composition'),
                'purchaseprice' => $hargabeli,
                'taxprice' => $hnapajak,
                'salesprice' => $hja,
                'minstock' => $this->request->getVar('minstock'),
                'maxstock' => $this->request->getVar('maxstock'),
                'types' => $this->request->getVar('types'),
                'category' => $this->request->getVar('category'),
                'groups' => $this->request->getVar('groups'),
                'eticket' => $this->request->getVar('eticket'),
                'onlabel' => $this->request->getVar('onlabel'),
                'offlabel' => $this->request->getVar('offlabel'),
                'sicklevel' => $this->request->getVar('sicklevel'),
                'memo' => $this->request->getVar('memo'),
                'ac' => $this->request->getVar('ac'),
                'dc' => $this->request->getVar('dc'),
                'pc' => $this->request->getVar('pc'),
                'ac_pc' => $this->request->getVar('ac_pc'),
                'heartindication' => $this->request->getVar('heartindication'),
                'fn' => $this->request->getVar('fn'),
                'pregnantriskcode' => $this->request->getVar('pregnantriskcode'),
                'pregnantriskname' => $this->request->getVar('pregnantriskname'),
                'tradename' => $this->request->getVar('tradename'),
                'manufacturecode' => $this->request->getVar('manufacturecode'),
                'manufacturename' => $this->request->getVar('manufacturename'),
                'originalname' => $this->request->getVar('originalname'),
                'classteraphycode' => $this->request->getVar('classteraphycode'),
                'classteraphyname' => $this->request->getVar('classteraphyname'),
                'subclassteraphycode' => $this->request->getVar('subclassteraphycode'),
                'subclassteraphyname' => $this->request->getVar('subclassteraphyname'),
                'regimen' => $this->request->getVar('regimen'),
                'indication' => $this->request->getVar('indication'),
                'usualdoze' => $this->request->getVar('usualdoze'),
                'pf_start' => $this->request->getVar('pf_start'),
                'pf_work' => $this->request->getVar('pf_work'),
                'pf_time' => $this->request->getVar('pf_time'),
                'off_label_used' => $this->request->getVar('off_label_used'),
                'drugefek' => $this->request->getVar('drugefek'),
                'foodinteraction' => $this->request->getVar('foodinteraction'),
                'production' => $this->request->getVar('production'),
                'stockupdate' => $this->request->getVar('stockupdate'),
                'locationcode' => $this->request->getVar('locationcode'),
                'locationname' => $this->request->getVar('locationname'),
                'modifiedby' => $this->request->getVar('modifiedby'),
                'modifieddate' => $this->request->getVar('modifieddate'),

            ];
            $supplier = new ModelMasterObat();
            $id = $this->request->getVar('id');
            $supplier->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data BHP sudah berhasil diperbaharui'
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

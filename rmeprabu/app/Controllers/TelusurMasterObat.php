<?php

namespace App\Controllers;

use App\Models\ModelMasterObat;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelMasterBatch;
use Config\Services;
use Dompdf\Dompdf;
use App\Models\ModelMasterTelusurObat;

class TelusurMasterObat extends BaseController
{

    public function index()
    {

        return view('gudangfarmasi/telusurdatamasterobat');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterTelusurObat();
            $data = [
                'tampildata' => $gudang->ambildataobat_obat()
            ];
            $msg = [
                'data' => view('gudangfarmasi/telusurdatamaster_obat', $data)
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

    public function lokasi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi();
        return $list;
    }

    public function pemakaian()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_central();
        return $list;
    }

    public function kategori()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kategori();
        return $list;
    }

    public function jenis()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_jenis();
        return $list;
    }

    public function sicklevel()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_sicklevel();
        return $list;
    }

    public function pregnan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pregnan();
        return $list;
    }

    public function kelasterapi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kelasterapi();
        return $list;
    }

    public function subkelasterapi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_subkelasterapi();
        return $list;
    }

    public function ac()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_ac();
        return $list;
    }

    public function dc()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_dc();
        return $list;
    }

    public function pc()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pc();
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
                $query = $db->query("SELECT MAX(code) as kode_jurnal, MAX(numberseq)as noantrian FROM obat WHERE code <>'NONE' and code <>'code' LIMIT 1");

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
                    'keterangan' => $this->request->getVar('keterangan'),
                    'sumber' => $this->request->getVar('sumber'),

                ];
                $perawat = new ModelMasterObat();
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Obat Berhasil',
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function editOBAT()
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
                'lokasi' => $this->lokasi(),
                'pemakaian' => $this->pemakaian(),
                'kategori' => $this->kategori(),
                'jenis' => $this->jenis(),
                'sicklevel' => $this->sicklevel(),
                'pregnan' => $this->pregnan(),
                'kelasterapi' => $this->kelasterapi(),
                'subkelasterapi' => $this->subkelasterapi(),
                'sebelummakan' => $this->ac(),
                'bersamamakan' => $this->dc(),
                'sesudahmakan' => $this->pc(),
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modaleditobat', $data)
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
            $hargajualbarang = round($hja);

            // var_dump($hja);
            // die();

            $simpandata = [
                'name' => $this->request->getVar('name'),
                'uom' => $this->request->getVar('uom'),
                'volume' => $this->request->getVar('volume'),
                'composition' => $this->request->getVar('composition'),
                'purchaseprice' => $hargabeli,
                'taxprice' => $hnapajak,
                'salesprice' => $hargajualbarang,
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
                'sukses' => 'Data Obat sudah berhasil diperbaharui'
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatchNumber()
    {

        return view('gudangfarmasi/datamasterbatchnumber');
    }

    public function ambildataBatchNumber()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobatbalanceBatch()
            ];
            $msg = [
                'data' => view('gudangfarmasi/datamaster_batchnumber', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tambahBatch()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'daftarbank' => $this->daftar_bank(),
                'production' => $this->daftar_production(),
                'satuan' => $this->daftar_satuan(),
                'pabrik' => $this->pabrik(),
                'eticket' => $this->daftar_eticket(),
                'lokasi' => $this->lokasi(),
                'pemakaian' => $this->pemakaian(),
                'kategori' => $this->kategori(),
                'jenis' => $this->jenis(),
                'sicklevel' => $this->sicklevel(),
                'pregnan' => $this->pregnan(),
                'kelasterapi' => $this->kelasterapi(),
                'subkelasterapi' => $this->subkelasterapi(),
                'sebelummakan' => $this->ac(),
                'bersamamakan' => $this->dc(),
                'sesudahmakan' => $this->pc(),
                'lokasi' => $this->lokasiBatch(),

            ];
            $msg = [
                'data' => view('gudangfarmasi/modalacreatebatch', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ajax_nama_obat()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');
        $data = $m_auto->get_list_obat($key);

        foreach ($data as $row) {
            $json[] = [
                'value' => $row['name'] . ' | ' . $row['code'] . ' | ' . $row['uom'],
                'id' => $row['id'],
                'code' => $row['code'],
                'uom' => $row['uom'],
                'name' => $row['name']

            ];
        }
        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function Simpanbatch()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Obat',
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

                    'locationcode' => $this->request->getVar('locationcode'),
                    'code' => $this->request->getVar('code'),
                    'batchnumber' => $this->request->getVar('batchnumber'),
                    'expireddate' => $this->request->getVar('expireddate'),
                    'balance' => $this->request->getVar('balance'),
                    'uom' => $this->request->getVar('uom'),
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                ];
                $perawat = new ModelMasterBatch();
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Batch Number Berhasil',
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lokasiBatch()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi_batch();
        return $list;
    }


    public function editOBATInactive()
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
                'lokasi' => $this->lokasi(),
                'pemakaian' => $this->pemakaian(),
                'kategori' => $this->kategori(),
                'jenis' => $this->jenis(),
                'sicklevel' => $this->sicklevel(),
                'pregnan' => $this->pregnan(),
                'kelasterapi' => $this->kelasterapi(),
                'subkelasterapi' => $this->subkelasterapi(),
                'sebelummakan' => $this->ac(),
                'bersamamakan' => $this->dc(),
                'sesudahmakan' => $this->pc(),
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modaleditobatInactive', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedataInactive()
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

                'inactive' => $this->request->getVar('inactive'),
                'modifiedby' => $this->request->getVar('modifiedby'),
                'modifieddate' => $this->request->getVar('modifieddate'),

            ];
            $supplier = new ModelMasterObat();
            $id = $this->request->getVar('id');
            $supplier->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Obat sudah berhasil diperbaharui'
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Inactive()
    {

        return view('gudangfarmasi/datamasterobatinactive');
    }

    public function ambildataInactive()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->ambildataobat_obat_inactive()
            ];
            $msg = [
                'data' => view('gudangfarmasi/datamaster_obat_inactive', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CariFakturOBAT()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $supplier = new ModelMasterTelusurObat();
            $obat = $supplier->ambildata_obat_code($id);
            $kode_obat = $obat['code'];
            $nama_obat = $obat['name'];
            $data = [
                'code' => $kode_obat,
                'namaobat' => $nama_obat,
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modalcarifakturobat', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function CariDataFakturObat()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();

            $dateout = explode('-', $search['tanggalfaktur']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelMasterTelusurObat();
            $data = [
                'tampildata' => $register->search_Faktur($search)
            ];
            $msg = [
                'data' => view('gudangfarmasi/datacekfaktur', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CariDistribusiOBAT()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $supplier = new ModelMasterTelusurObat();
            $obat = $supplier->ambildata_obat_code($id);
            $kode_obat = $obat['code'];
            $nama_obat = $obat['name'];
            $data = [
                'code' => $kode_obat,
                'namaobat' => $nama_obat,
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modalcaridistribusiobat', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function CariDataDistribusiObat()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();

            $dateout = explode('-', $search['tanggalfaktur']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelMasterTelusurObat();
            $data = [
                'tampildata' => $register->search_Distribusi($search)
            ];
            $msg = [
                'data' => view('gudangfarmasi/datacekdistribusi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function CariPenjualanOBAT()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $supplier = new ModelMasterTelusurObat();
            $obat = $supplier->ambildata_obat_code($id);
            $kode_obat = $obat['code'];
            $nama_obat = $obat['name'];
            $data = [
                'code' => $kode_obat,
                'namaobat' => $nama_obat,
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modalcaripenjualanobat', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function CariDataPenjualanObat()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();

            $dateout = explode('-', $search['tanggalfaktur']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelMasterTelusurObat();
            $data = [
                'tampildata' => $register->search_Penjualan($search)
            ];
            $msg = [
                'data' => view('gudangfarmasi/datacekpenjualan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function CariKartuOBAT()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $supplier = new ModelMasterTelusurObat();
            $obat = $supplier->ambildata_obat_code($id);
            $kode_obat = $obat['code'];
            $nama_obat = $obat['name'];
            $data = [
                'code' => $kode_obat,
                'namaobat' => $nama_obat,
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modalcarikartustok', $data)
            ];
            echo json_encode($msg);
        }
    }
}

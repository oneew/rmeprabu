<?php

namespace App\Controllers;

use App\Models\ModelMasterObat;
use App\Models\Model_autocomplete;
use App\Models\ModelTerimaPBFHeader;
use App\Models\ModelTerimaPBFDetail;
use App\Models\ModelTerimaNonPBFHeader;
use App\Models\ModelTerimaNonPBFDetail;
use App\Models\ModelSOGudangHeader;
use App\Models\ModelSODepoHeader;
use App\Models\ModelSOGudangDetail;
use App\Models\ModelSODepoDetail;
use App\Models\ModelPasienRanap;
use App\Models\Modelrajal;
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;



class StockOpnameDepo extends BaseController
{

    public function index()
    {
        $gudang = new ModelMasterObat();
        $data = [
            'kelompok' => $gudang->kelompokobat_stockopname(),
            'lokasiruangan' => $this->lokasiruangan(),
            'lokasi' => $this->lokasi(),
        ];

        echo view('depofarmasi/form_stock_opname', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->ambildataobat()
            ];
            $msg = [
                'data' => view('gudangfarmasi/datamaster_obat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ajax_supplier()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');
        $data = $m_auto->get_list_supplier($key);

        foreach ($data as $row) {
            $json[] = [
                'value' => $row['name'],
                'id' => $row['id'],
                'code' => $row['code'],
                'address' => $row['address'],
                'supplier' => $row['name']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function simpandatastockopname()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'memo' => [
                    'label' => 'Catatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ],
                'groups' => [
                    'label' => 'Kelompok',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'memo' => $validation->getError('memo'),
                        'groups' => $validation->getError('groups')
                    ]
                ];
            } else {

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $tahun = $this->request->getVar('documentyear');
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(numberseq)as noantrian FROM transaksi_farmasi_opname_depo_header where reborn=1 ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                $underscore = '_';
                if ($kode == "") {
                    $nourut = '0000001';
                } else {
                    $nourut = (int) substr($kode, -7, 7);
                    $nourut++;
                }

                $locationcode = $this->request->getVar('locationcode');
                $tanda = 'SOP_RSUD2023U23';

                //$pbf = 'G-DEPORSPRABU';
                $pbf = 'G-DEPORS2023U23';
                $tahun = $this->request->getVar('documentyear');
                $potongtahun = substr($tahun, 2, 2);

                $groups = "STOCKOPNAME";

                $newkode = $tanda . $underscore . $groups . $underscore . $pbf . $underscore . $potongtahun . $underscore . sprintf('%07s', $nourut);
                // var_dump($kode);
                // var_dump($nourut);
                // var_dump($newkode);
                // die();
                // $newkode = "SOP_RSUDPRABU_STOCKOPNAME_DEPORSPRABU_22_0000095";

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);

                $locationcode = $this->request->getVar('locationcode');
                $memo = $this->request->getVar('memo');
                $documentdate = $this->request->getVar('documentdate');



                $simpandata = [

                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'memo' => $memo,
                    'locationcode' => $locationcode,
                    'locationname' => $this->request->getVar('locationname'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'reborn' => 1,
                ];
                $perawat = new ModelSODepoHeader;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Catatan Stock Opname Sudah Dipersiapkan, silahkan isi detail',
                    'journalnumber' => $newkode,
                    'lc' => $locationcode,
                    'referencenumber' => $memo,
                    'documentdate' => $documentdate,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Search_Obat()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobat()
            ];
            $msg = [
                'data' => view('gudangfarmasi/modalcariobat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildataobat()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobat()
            ];
            $msg = [
                'data' => view('gudangfarmasi/cariobat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataobat()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getVar();
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->search_DataObat($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/cariobat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailobat()
    {
        if ($this->request->isAJAX()) {

            $code = $this->request->getVar('code');
            $m_icd = new ModelMasterObat();
            $row = $m_icd->get_data_obat($code);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandastockopname_detail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'realqty' => [
                    'label' => 'Jumlah Stok Fisik',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'realqty' => $validation->getError('realqty')
                    ]
                ];
            } else {
                $stockqty = $this->request->getVar('stockqty');
                $realqty = $this->request->getVar('realqty');
                $price = $this->request->getVar('purchasepricebefore');
                $stocksistem = floor($stockqty);
                if ($stocksistem > $realqty) {
                    $qty = $realqty - $stocksistem;
                } else {
                    if ($stocksistem < $realqty) {
                        $qty = $realqty - $stocksistem;
                    }
                }
                $subtotal = $qty * $price;

                $simpandata = [

                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'documentdate' => $this->request->getVar('documentdate_detail'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'locationcode' => $this->request->getVar('locationcode_detail'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'stockqty' => $this->request->getVar('stockqty'),
                    'realqty' => $this->request->getVar('realqty'),
                    'qty' => $qty,
                    'uom' => $this->request->getVar('uom'),
                    'batchnumber' => $this->request->getVar('batchnumber'),
                    'expireddate' => $this->request->getVar('expireddate'),
                    'disc' => $this->request->getVar('disc'),
                    'tax' => $this->request->getVar('tax'),
                    'price' => $price,
                    'subtotal' => $subtotal,
                    'createdby' => $this->request->getVar('createdby_detail'),
                    'createddate' => $this->request->getVar('createddate_detail'),

                ];
                $perawat = new ModelSODepoDetail;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Stock terbaru telah disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeDetail()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'DetailObat' => $resume->search_detail_so_depo($journalnumber)
            ];
            $msg = [
                'data' => view('depofarmasi/data_form_so_depo', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus_detail_so()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelSODepoDetail;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function DSO()
    {
        $data = [
            'supplier' => $this->supplier(),
        ];
        return view('depofarmasi/registerDSO', $data);
    }

    public function ambildataDSO()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelSODepoHeader();
            $data = [
                'tampildata' => $register->ambildataDSO()
            ];
            $msg = [
                'data' => view('depofarmasi/dataregisterDSO', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDSO()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelSODepoHeader();
            $data = [
                'tampildata' => $register->search_RegisterDSO($search)
            ];

            $msg = [
                'data' => view('depofarmasi/dataregisterDSO', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function supplier()
    {

        $m_auto = new ModelMasterObat();
        $list = $m_auto->get_list_supplier();
        return $list;
    }

    public function DetailDSO($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_DSO_depo($id);
        $data = [
            'id' => $row['id'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'lc' => $row['locationcode'],
            'referencenumber' => $row['memo'],
        ];

        return view('depofarmasi/form_stock_opname_add', $data);
    }

    public function Search_BacthNumber()
    {
        if ($this->request->isAJAX()) {
            $code = $this->request->getVar('code');
            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelMasterObat();
            // $row = $gudang->get_data_BacthNumber($code);
            $data = [
                'tampildata' => $gudang->get_list_BacthNumber_pelayanan($code, $locationcode)
            ];
            $msg = [
                'data' => view('depofarmasi/modalcaribatchnumber', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildata_BN()
    {
        if ($this->request->isAJAX()) {
            $code = $this->request->getVar('codeobat');
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->get_list_BacthNumber_pelayanan($code, $locationcode)
            ];
            $msg = [
                'data' => view('depofarmasi/caribatchnumber', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detail_batchnumber()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelMasterObat();
            $row = $m_icd->get_data_obat_BN($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printstockopname()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "GUDANG FARMASI";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_SOGudang($lokasikasir);
        $data = [
            'dataopname' => $pasien->opnamedepoheader($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'tampildata' => $pasien->opnamedepodetail($id),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/so_depo', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function lokasiruangan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi_farmasi_ruangan();
        return $list;
    }

    public function lokasi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi_farmasi();
        return $list;
    }
}

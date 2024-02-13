<?php

namespace App\Controllers;

use App\Models\ModelMasterObat;
use App\Models\Model_autocomplete;
use App\Models\ModelTerimaPBFHeader;
use App\Models\ModelTerimaPBFDetail;
use App\Models\ModelTerimaNonPBFHeader;
use App\Models\ModelTerimaNonPBFDetail;
use App\Models\ModelPasienRanap;
use App\Models\ModelTNODetail;
use App\Models\Modellogactivity;
use App\Models\ModelReturPBFHeader;
use App\Models\ModelReturPBFDetail;
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;



class ObatKeluarGudang extends BaseController
{

    public function index()
    {
        $gudang = new ModelMasterObat();
        $data = [
            'kelompok' => $gudang->kelompokobat()
        ];

        echo view('gudangfarmasi/form_retur_pbf', $data);
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

    public function simpandataterimapbf()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'invoicenumber' => [
                    'label' => 'Nomor Invoice',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'invoicenumber' => $validation->getError('invoicenumber')
                    ]
                ];
            } else {

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $tahun = $this->request->getVar('documentyear');
                $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_terima_pbf_header WHERE  documentyear='$tahun' AND groups='$groups' ORDER BY id DESC LIMIT 1");

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
                $tanda = 'BTB-RBN';
                $pbf = 'PBF';
                $tahun = $this->request->getVar('documentyear');
                $potongtahun = substr($tahun, 2, 2);

                $supplier = $this->request->getVar('supplier');

                $newkode = $tanda . $underscore . $groups . $underscore . $pbf . $underscore . $supplier . $underscore . $potongtahun . $underscore . sprintf('%07s', $nourut);
                $tgl_invoice_v = $this->request->getVar("invoicedate");
                $tgl_order_v = $this->request->getVar("orderdate");
                $tgl_permintaan_v = $this->request->getVar("requestdate");
                $receiptdate = $this->request->getVar("receiptdate");


                $receiptdate = date('Y-m-d', strtotime($receiptdate));
                $tgl_permintaan = date('Y-m-d', strtotime($tgl_order_v));
                $tgl_invoice = date('Y-m-d', strtotime($tgl_invoice_v));
                $tgl_order = date('Y-m-d', strtotime($tgl_order_v));
                $tgl_dupada = date('Y-m-d', strtotime($tgl_permintaan_v));

                // var_dump($tgl_invoice);
                // var_dump($receiptdate);
                // var_dump($tgl_permintaan);

                // var_dump($tgl_dupada);
                // die();


                $totalhargafaktur = $this->request->getVar('totalinvoiceamount');
                //$hargafaktur = preg_replace("/[^0-9]/", "", $totalhargafaktur);
                $hargafaktur =  $totalhargafaktur;

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);
                $locationcode = $this->request->getVar('locationcode');

                $suppliername = $this->request->getVar('suppliername');
                $invoicenumber = $this->request->getVar('invoicenumber');
                $documentdate = $this->request->getVar('documentdate');




                $simpandata = [

                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'supplier' => $supplier,
                    'suppliername' => $suppliername,
                    'supplieraddress' => $this->request->getVar('supplieraddress'),
                    'invoicenumber' => $invoicenumber,
                    'invoicedate' => $tgl_invoice,
                    'receiptdate' => $receiptdate,
                    'ordernumber' => $this->request->getVar('ordernumber'),
                    'orderdate' => $tgl_dupada,
                    'requestnumber' => $this->request->getVar('requestnumber'),
                    'requestdate' => $tgl_permintaan,
                    'locationcode' => $locationcode,
                    'locationname' => $this->request->getVar('locationname'),
                    'totalinvoiceamount' => $hargafaktur,
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                ];
                $perawat = new ModelTerimaPBFHeader;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Faktur terima barang telah disimpan',
                    'journalnumber' => $newkode,
                    'lc' => $locationcode,
                    'relation' => $supplier,
                    'relationname' => $suppliername,
                    'referencenumber' => $invoicenumber,
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

            $relation = $this->request->getVar('relation');

            $gudang = new ModelMasterObat();
            $data = [
                // 'tampildata' => $gudang->caridataobat(),
                'tampildata' => '',
                'kodesuplier' => $relation,
            ];
            $msg = [
                'data' => view('gudangfarmasi/modalcariobatretur', $data)
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
                'tampildata' => $gudang->search_DataObat_barang_akan_retur($search)
            ];
            $msg = [
                'data' => view('gudangfarmasi/cariobatretur', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailobat()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelMasterObat();
            $row = $m_icd->get_data_obat_baru($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandataterimapbf_detail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'batchnumber' => [
                    'label' => 'Nomor Batch',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'batchnumber' => $validation->getError('batchnumber')
                    ]
                ];
            } else {




                $price = $this->request->getVar('price');
                $harga = $price;
                $qtybox = $this->request->getVar('qtybox');
                $volume = $this->request->getVar('volume');
                $disc = $this->request->getVar('disc');
                $tax = $this->request->getVar('tax');
                $qty = $qtybox * $volume;
                $subtotal = $qtybox * $price;
                $totaldiscount = $subtotal * ($disc / 100);
                $beforetax = $subtotal - $totaldiscount;
                $taxamount = $beforetax * ($tax / 100);
                $aftertax = $beforetax + $taxamount;

                $expire = $this->request->getVar('expireddate');
                $expireddate = date('Y-m-d', strtotime($expire));

                if ($harga < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Harga Harus Lebih Besar Dari Nol Rupiah'
                    ];
                } else if ($qtybox < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Volume Box Harus Terisi'
                    ];
                } else if ($volume < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Volume Isi Harus lebih dari Nol'
                    ];
                } else {

                    $simpandata = [

                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'documentdate' => $this->request->getVar('documentdate_detail'),
                        'relation' => $this->request->getVar('relation'),
                        'relationname' => $this->request->getVar('relationname'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'locationcode' => $this->request->getVar('locationcode_detail'),
                        'code' => $this->request->getVar('code'),
                        'name' => $this->request->getVar('name'),
                        'qtybox' => $this->request->getVar('qtybox'),
                        'volume' => $this->request->getVar('volume'),
                        'qty' => $qty,
                        'uom' => $this->request->getVar('uom'),
                        'batchnumber' => $this->request->getVar('batchnumber'),
                        'expireddate' => $expireddate,
                        'disc' => $this->request->getVar('disc'),
                        'tax' => $this->request->getVar('tax'),
                        'price' => $harga,
                        'purchaseprice' => $this->request->getVar('purchaseprice'),
                        'purchasepricebefore' => $this->request->getVar('purchasepricebefore'),
                        'subtotal' => $subtotal,
                        'totaldiscount' => $totaldiscount,
                        'beforetax' => $beforetax,
                        'taxamount' => $taxamount,
                        'aftertax' => $aftertax,
                        'createdby' => $this->request->getVar('createdby_detail'),
                        'createddate' => $this->request->getVar('createddate_detail'),
                        'pabrik' => $this->request->getVar('pabrik'),

                    ];
                    $perawat = new ModelTerimaPBFDetail;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Detail barang telah disimpan'
                    ];
                }
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
                'DetailObat' => $resume->search_detail_retur_pbf($journalnumber),
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_form_retur_pbf', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus_detail_terima_pbf()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelTerimaPBFDetail;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function DTPBF()
    {
        $data = [
            'supplier' => $this->supplier(),
        ];
        return view('gudangfarmasi/registerDTPBF', $data);
    }

    public function ambildataDTPBF()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFHeader();
            $data = [
                'tampildata' => $register->ambildataDTPBF()
            ];
            $msg = [
                'data' => view('gudangfarmasi/dataregisterDTPBF', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDTPBF()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelTerimaPBFHeader();
            $data = [
                'tampildata' => $register->search_RegisterDTPBF($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/dataregisterDTPBF', $data)
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

    public function DetailDTPBF($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_DTPBF($id);
        $data = [
            'id' => $row['id'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'lc' => $row['locationcode'],
            'relation' => $row['supplier'],
            'relationname' => $row['suppliername'],
            'referencenumber' => $row['invoicenumber'],
        ];

        return view('gudangfarmasi/form_terima_pbf_add', $data);
    }

    public function NPBF()
    {
        $gudang = new ModelMasterObat();
        $data = [
            'kelompok' => $gudang->kelompokobat()
        ];

        echo view('gudangfarmasi/form_terima_non_pbf', $data);
    }

    public function ambildataNPBF()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->ambildataobat()
            ];
            $msg = [
                'data' => view('gudangfarmasi/datamaster_obat_nonpbf', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandataterima_nonpbf()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'invoicenumber' => [
                    'label' => 'Nomor Invoice',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'invoicenumber' => $validation->getError('invoicenumber')
                    ]
                ];
            } else {

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $tahun = $this->request->getVar('documentyear');
                $supplier = $this->request->getVar('supplier');
                $query = $db->query("SELECT journalnumber as kode_jurnal, MAX(numberseq) as noantrian FROM transaksi_farmasi_terima_nonpbf_header WHERE  documentyear='$tahun' AND groups='$groups' ORDER BY id DESC LIMIT 1");

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
                $tanda = 'BTB';
                $pbf = 'NONPBF';
                $tahun = $this->request->getVar('documentyear');
                $potongtahun = substr($tahun, 2, 2);

                helper('text');
                $token3 = random_string('alnum', 6);
                $token_reborn3 = strtoupper($token3);

                $newkode = $tanda . $underscore . $groups . $underscore . $token_reborn3 . $underscore . $supplier . $underscore . $potongtahun . $underscore . sprintf('%07s', $nourut);

                $tgl_invoice = date('Y-m-d', strtotime($this->request->getVar("invoicedate")));
                $tgl_order = date('Y-m-d', strtotime($this->request->getVar("orderdate")));
                $tgl_permintaan = date('Y-m-d', strtotime($this->request->getVar("requestdate")));
                $receiptdate = date('Y-m-d', strtotime($this->request->getVar("receiptdate")));
                $totalhargafaktur = $this->request->getVar('totalinvoiceamount');
                //$hargafaktur = preg_replace("/[^0-9]/", "", $totalhargafaktur);
                $hargafaktur = $totalhargafaktur;

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);
                $locationcode = $this->request->getVar('locationcode');
                $supplier = $this->request->getVar('supplier');
                $suppliername = $this->request->getVar('suppliername');
                $invoicenumber = $this->request->getVar('invoicenumber');
                $documentdate = $this->request->getVar('documentdate');

                $tgl_invoice = date('Y-m-d', strtotime($tgl_invoice));
                $receiptdate = date('Y-m-d', strtotime($receiptdate));


                $simpandata = [

                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'supplier' => $supplier,
                    'suppliername' => $suppliername,
                    'supplieraddress' => $this->request->getVar('supplieraddress'),
                    'invoicenumber' => $invoicenumber,
                    'invoicedate' => $tgl_invoice,
                    'receiptdate' => $receiptdate,
                    'ordernumber' => $this->request->getVar('ordernumber'),
                    'orderdate' => $tgl_order,
                    'requestnumber' => $this->request->getVar('requestnumber'),
                    'requestdate' => $tgl_permintaan,
                    'locationcode' => $locationcode,
                    'locationname' => $this->request->getVar('locationname'),
                    'totalinvoiceamount' => $hargafaktur,
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                ];
                $perawat = new ModelTerimaNonPBFHeader;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Faktur terima barang telah disimpan',
                    'journalnumber' => $newkode,
                    'lc' => $locationcode,
                    'relation' => $supplier,
                    'relationname' => $suppliername,
                    'referencenumber' => $invoicenumber,
                    'documentdate' => $documentdate,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandataterima_nonpbf_detail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'batchnumber' => [
                    'label' => 'Nomor Batch',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'batchnumber' => $validation->getError('batchnumber')
                    ]
                ];
            } else {

                $expireddate = date('Y-m-d', strtotime($this->request->getVar("expireddate")));
                $price = $this->request->getVar('price');
                //$harga = preg_replace("/[^0-9]/", "", $price);
                $harga = $price;
                $qtybox = $this->request->getVar('qtybox');
                $volume = $this->request->getVar('volume');
                $disc = $this->request->getVar('disc');
                $tax = $this->request->getVar('tax');
                $qty = $qtybox * $volume;
                $subtotal = $qtybox * $price;
                $totaldiscount = $subtotal * ($disc / 100);
                $beforetax = $subtotal - $totaldiscount;
                $taxamount = $beforetax * ($tax / 100);
                $aftertax = $beforetax - $taxamount;

                $expire = $this->request->getVar('expireddate');
                $expireddate = date('Y-m-d', strtotime($expire));

                if ($harga < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Harga Harus Lebih Besar Dari Nol Rupiah'
                    ];
                } else if ($qtybox < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Volume Box Harus Terisi'
                    ];
                } else if ($volume < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Volume Isi Harus lebih dari Nol'
                    ];
                } else {

                    $simpandata = [

                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'documentdate' => $this->request->getVar('documentdate_detail'),
                        'relation' => $this->request->getVar('relation'),
                        'relationname' => $this->request->getVar('relationname'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'locationcode' => $this->request->getVar('locationcode_detail'),
                        'code' => $this->request->getVar('code'),
                        'name' => $this->request->getVar('name'),
                        'qtybox' => $this->request->getVar('qtybox'),
                        'volume' => $this->request->getVar('volume'),
                        'qty' => $qty,
                        'uom' => $this->request->getVar('uom'),
                        'batchnumber' => $this->request->getVar('batchnumber'),
                        'expireddate' => $expireddate,
                        'disc' => $this->request->getVar('disc'),
                        'tax' => $this->request->getVar('tax'),
                        'price' => $harga,
                        'purchaseprice' => $this->request->getVar('purchaseprice'),
                        'purchasepricebefore' => $this->request->getVar('purchasepricebefore'),
                        'subtotal' => $subtotal,
                        'totaldiscount' => $totaldiscount,
                        'beforetax' => $beforetax,
                        'taxamount' => $taxamount,
                        'aftertax' => $aftertax,
                        'createdby' => $this->request->getVar('createdby_detail'),
                        'createddate' => $this->request->getVar('createddate_detail'),

                    ];
                    $perawat = new ModelTerimaNonPBFDetail;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Detail barang telah disimpan'
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeDetail_nonpbf()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'DetailObat' => $resume->search_detail_terima_non_pbf($journalnumber)
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_form_terima_nonpbf', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus_detail_terima_non_pbf()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelTerimaNonPBFDetail;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function DTNonPBF()
    {
        $data = [
            'supplier' => $this->supplier(),
        ];
        return view('gudangfarmasi/registerDTNonPBF', $data);
    }

    public function ambildataDTNonPBF()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFHeader();
            $data = [
                'tampildata' => $register->ambildataDTNonPBF()
            ];
            $msg = [
                'data' => view('gudangfarmasi/dataregisterDTNPBF', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDTNonPBF()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelTerimaPBFHeader();
            $data = [
                'tampildata' => $register->search_RegisterDTNonPBF($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/dataregisterDTNPBF', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DetailDTNonPBF($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_DTNonPBF($id);
        $data = [
            'id' => $row['id'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'lc' => $row['locationcode'],
            'relation' => $row['supplier'],
            'relationname' => $row['suppliername'],
            'referencenumber' => $row['invoicenumber'],
        ];

        return view('gudangfarmasi/form_terima_non_pbf_add', $data);
    }

    public function printfakturpbf()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "GUDANG FARMASI";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->registerfakturpbf($id),
            'detail' => $pasien->detailregisterfakturpbf($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        //$html = view('pdf/faktur_pbf', $data);
        $html .= view('pdf/faktur_pbf', $data);
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function printfakturnonpbf()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "GUDANG FARMASI";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_kasir2($lokasikasir);
        $data = [
            'datapasien' => $pasien->registerfakturnonpbf($id),
            'detail' => $pasien->detailregisterfakturnonpbf($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
        ];

        $html = view('pdf/stylebootstrap');
        //$html = view('pdf/faktur_pbf', $data);
        $html .= view('pdf/faktur_non_pbf', $data);
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function ubahFaktur()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $m_icd = new ModelTerimaPBFHeader();
            $row = $m_icd->get_data_faktur($id);

            $data = [
                'id' => $row['id'],
                'invoicenumber' => $row['invoicenumber'],
                'invoicedate' => $row['invoicedate'],
                'receiptdate' => $row['receiptdate'],
                'requestnumber' => $row['requestnumber'],
                'documentdate' => $row['documentdate'],
                'suppliername'  => $row['suppliername'],
                'requestnumber'  => $row['requestnumber'],
                'requestdate'  => $row['requestdate'],

            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modalubahfaktur', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpanUbahFaktur()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar("id");
            $simpandata = [
                'invoicenumber' => $this->request->getVar("invoicenumber"),
                'invoicedate' => $this->request->getVar("invoicedate"),
                'receiptdate' => $this->request->getVar("receiptdate"),
                'requestnumber' => $this->request->getVar("requestnumber"),
                'requestdate' => $this->request->getVar("requestdate"),

            ];
            $perawat = new ModelTerimaPBFHeader;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data sudah berhasil diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Search_Obat_opik()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobat()
            ];
            $msg = [
                'data' => view('gudangfarmasi/modalcariobatvitual', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function hapusFaktur()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelTNODetail;
            $cek = $TNO->cek_faktur($id);
            $nama_tindakan = $cek['journalnumber'];
            $dokter = $cek['invoicenumber'];

            $gudang = new ModelTerimaPBFHeader;

            $gudang->delete($id);

            //$norm = $cek['relation'];
            $aktifitas = $nama_tindakan;
            $datalog_activity = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
                'level' => session()->get('level'),
                'locationname' => session()->get('locationname'),
                'locationcode' => session()->get('locationcode'),
                'dateactivity' => date('Y-m-d'),
                'datetimeactivity' => date('Y-m-d G:i:s'),
                'ip' => $this->request->getIPAddress(),
                'activity' => 'Hapus Faktur ' . $aktifitas . ' Pada No Faktur ' .  $nama_tindakan . '  Dengan Nomor Terima : ' . $dokter,
                'pasienid' => '',
                'menu' => ' Rawat Inap [Hapus Tindakan Ranap]',

            ];

            $catat = new Modellogactivity;
            $catat->insert($datalog_activity);

            $msg = [
                'sukses' => "Data Tindakan dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function simpandatareturpbf()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'suppliername' => [
                    'label' => 'Nama Suplier',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'suppliername' => $validation->getError('suppliername')
                    ]
                ];
            } else {

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $tahun = $this->request->getVar('documentyear');
                $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_retur_pbf_header  ORDER BY id DESC LIMIT 1");

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
                $tanda = 'BRB-RBN';
                $pbf = 'PBF';
                $tahun = $this->request->getVar('documentyear');
                $potongtahun = substr($tahun, 2, 2);

                $supplier = $this->request->getVar('supplier');

                $newkode = $tanda . $underscore . $groups . $underscore . $pbf . $underscore . $supplier . $underscore . $potongtahun . $underscore . sprintf('%07s', $nourut);

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);
                $locationcode = $this->request->getVar('locationcode');

                $suppliername = $this->request->getVar('suppliername');
                $invoicenumber = $this->request->getVar('invoicenumber');
                $documentdate = $this->request->getVar('documentdate');




                $simpandata = [

                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'supplier' => $supplier,
                    'suppliername' => $suppliername,
                    'supplieraddress' => $this->request->getVar('supplieraddress'),
                    'locationcode' => $locationcode,
                    'locationname' => $this->request->getVar('locationname'),
                    'memo' => $this->request->getVar('memo'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => date('Y-m-d G:i:s'),
                ];
                $perawat = new ModelReturPBFHeader;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Dokumen Retur telah disimpan',
                    'journalnumber' => $newkode,
                    'lc' => $locationcode,
                    'relation' => $supplier,
                    'relationname' => $suppliername,
                    'referencenumber' => '',
                    'documentdate' => $documentdate,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailobatretur()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelMasterObat();
            $row = $m_icd->get_data_obat_retur($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandatareturpbf_detail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'batchnumber' => [
                    'label' => 'Nomor Batch',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'batchnumber' => $validation->getError('batchnumber')
                    ]
                ];
            } else {
                $price = $this->request->getVar('price');
                $harga = $price;
                $qtybox = $this->request->getVar('qtybox');
                $qtybox2 = $this->request->getVar('qtybox');
                $volume = $this->request->getVar('volume');
                //$qtybox = $qtybox * -1;
                $qtybox =  -1;

                $qty = $qtybox * $volume;

                $subtotal = $qtybox * $price;

                $expire = $this->request->getVar('expireddate');
                $expireddate = date('Y-m-d', strtotime($expire));

                if ($harga < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Harga Harus Lebih Besar Dari Nol Rupiah'
                    ];
                } else if ($qtybox2 < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Volume Box Harus Terisi'
                    ];
                } else if ($volume < 1) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Volume Isi Harus lebih dari Nol'
                    ];
                } else {

                    $simpandata = [

                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'documentdate' => $this->request->getVar('documentdate_detail'),
                        'relation' => $this->request->getVar('relation'),
                        'relationname' => $this->request->getVar('relationname'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'locationcode' => $this->request->getVar('locationcode_detail'),
                        'code' => $this->request->getVar('code'),
                        'name' => $this->request->getVar('name'),
                        'qtybox' => $qtybox,
                        'volume' => $this->request->getVar('volume'),
                        'qty' => $qty,
                        'uom' => $this->request->getVar('uom'),
                        'batchnumber' => $this->request->getVar('batchnumber'),
                        'expireddate' => $expireddate,
                        'disc' => $this->request->getVar('disc'),
                        'tax' => $this->request->getVar('tax'),
                        'price' => $harga,
                        'subtotal' => $subtotal,
                        'createdby' => $this->request->getVar('createdby_detail'),
                        'createddate' => date('Y-m-d G:i:s'),
                    ];
                    $perawat = new ModelReturPBFDetail;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Detail barang telah disimpan dalam dokumen retur'
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function hapus_detail_retur_pbf()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelReturPBFDetail;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function DTPBFRetur()
    {
        $data = [
            'supplier' => $this->supplier(),
        ];
        return view('gudangfarmasi/registerDTPBFRetur', $data);
    }

    public function ambildataDTPBFRetur()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFHeader();
            $data = [
                'tampildata' => $register->ambildataDTPBFRetur()
            ];
            $msg = [
                'data' => view('gudangfarmasi/dataregisterDTPBFRetur', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDTPBFRetur()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelTerimaPBFHeader();
            $data = [
                'tampildata' => $register->search_RegisterDTPBFRetur($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/dataregisterDTPBFRetur', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DetailDTPBFRetur($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_DTPBF_Retur($id);

        $gudang = new ModelMasterObat();
        $data = [
            'id' => $row['id'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'lc' => $row['locationcode'],
            'relation' => $row['supplier'],
            'relationname' => $row['suppliername'],
            'referencenumber' => '',
            'kelompok' => $gudang->kelompokobat()
        ];

        return view('gudangfarmasi/form_retur_pbf_add', $data);
    }
}

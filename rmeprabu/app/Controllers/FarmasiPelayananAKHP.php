<?php

namespace App\Controllers;

use App\Models\ModelMasterObat;
use App\Models\Model_autocomplete;
use App\Models\ModelTerimaPBFDetail;
use App\Models\ModelDepoSPHeader;
use App\Models\ModelFarmasiPelayananHeader;
use App\Models\ModelFarmasiPelayananDetail;
use App\Models\ModelDistribusiHeader;
use App\Models\ModelDistribusiDetail;
use App\Models\ModelPasienRanap;
use App\Models\Modelrajal;
use App\Models\ModelTNODetailRJ;
use App\Models\ModeligdOrderRad2;
use App\Models\ModeligdAKHP;
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;



class FarmasiPelayananAKHP extends BaseController
{

    public function index()
    {
        $gudang = new ModelMasterObat();
        $resume = new ModelTerimaPBFDetail();
        $data = [
            'kelompok' => $gudang->kelompokobat(),
            'lokasi' => $this->lokasi(),
            'dokter' => $this->_data_dokter_all(),
            'petugas' => $this->data_petugas_resep(),
            'racikan' => $this->racikan(),
            'itemracikan' => $this->itemracikan(),
            'aturanpakai' => $resume->aturan_pakai(),
            'carapakai' => $resume->cara_pakai(),
            'carapetunjuk' => $resume->cara_petunjuk(),
        ];

        echo view('depofarmasi/form_farmasi_pelayanan_rajal', $data);
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

    public function racikan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_racikan();
        return $list;
    }

    public function itemracikan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_item_racikan();
        return $list;
    }

    public function simpandataresep()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pasienid' => [
                    'label' => 'Norm Tidak Boleh Kosong',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {

                $db = db_connect();
                $locationcode = $this->request->getVar('locationcode');

                $pasienid = $this->request->getVar('pasienid');
                $tanggalpelayanan = $this->request->getVar('documentdate');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $explodewaktu = explode("-", $documentdate);
                $tahun = $explodewaktu[0];
                $bulan = $explodewaktu[1];
                $potongtahun = substr($tahun, 2, 2);

                //$query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header WHERE documentyear='$tahun'  AND documentmonth='$bulan'  AND locationcode='$locationcode' and tanda=2 ORDER BY id desc LIMIT 1");
                $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header  ORDER BY id desc LIMIT 1");


                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                $underscore = '_';
                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }



                $tanda = 'RRJ';
                $today = date('ymd', strtotime($documentdate));

                $newkode = $tanda . $underscore . $pasienid . $underscore . $locationcode . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $no_antrian = sprintf($nourutantrian);

                $documentdate = $documentdate;
                $karyawan = $this->request->getVar('karyawan');
                $dispensasi = $this->request->getVar('dispensasi');
                $pasienid = $this->request->getVar('pasienid');
                $pasienname = $this->request->getVar('pasienname');
                $paymentmethod = $this->request->getVar('paymentmethod');
                $paymentmethodname = $this->request->getVar('paymentmethodname');
                $poliklinik = $this->request->getVar('poliklinik');
                $poliklinikname = $this->request->getVar('poliklinikname');
                $poliklinikclass = $this->request->getVar('poliklinikclass');
                $dokter = $this->request->getVar('dokter');
                $doktername = $this->request->getVar('doktername');
                $employee = $this->request->getVar('employee');
                $employeename = $this->request->getVar('employeename');
                $tandamemo = '/';
                $memo = $doktername . $tandamemo . $paymentmethod;
                $locationname = $this->request->getVar('locationname');
                $ranap = 1;

                $tanggallahir = $this->request->getVar('dateofbirth');
                $dob = strtotime($tanggallahir);
                $current_time = time();
                $age_years = date('Y', $current_time) - date('Y', $dob);
                $age_months = date('m', $current_time) - date('m', $dob);
                $age_days = date('d', $current_time) - date('d', $dob);

                if ($age_days < 0) {
                    $days_in_month = date('t', $current_time);
                    $age_months--;
                    $age_days = $days_in_month + $age_days;
                }

                if ($age_months < 0) {
                    $age_years--;
                    $age_months = 12 + $age_months;
                }

                $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
                $groups = "RJ";

                if ($doktername == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Dokter Pemberi Resep Harus Diisi'
                    ];
                } else if ($pasienname == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Nama Pasien Harus Diisi'
                    ];
                } else if ($paymentmethodname == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Cara Bayar Harus Diisi'
                    ];
                } else {

                    $simpandata = [
                        'isenaranap' => $ranap,
                        'groups' => $groups,
                        'journalnumber' => $newkode,
                        'documentdate' => $documentdate,
                        'documentyear' => $tahun,
                        'documentmonth' => $bulan,
                        'noreg' => $this->request->getVar('noreg'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                        'pasienid' => $pasienid,
                        'oldcode' => $this->request->getVar('oldcode'),
                        'pasienname' => $pasienname,
                        'pasiengender' => $this->request->getVar('pasiengender'),
                        'dateofbirth' => $this->request->getVar('dateofbirth'),
                        'pasienage' => $umur,
                        'pasienaddress' => $this->request->getVar('pasienaddress'),
                        'pasienarea' => $this->request->getVar('pasienarea'),
                        'pasiensubarea' => $this->request->getVar('pasiensubarea'),
                        'pasiensubareaname' => $this->request->getVar('pasiensubareaname'),
                        'karyawan' => $karyawan,
                        'dispensasi' => $dispensasi,
                        'dispensasipejabat' => $this->request->getVar('dispensasipejabat'),
                        'dispensasialasan' => $this->request->getVar('dispensasialasan'),
                        'paymentmethod' => $paymentmethod,
                        'paymentmethodname' => $paymentmethodname,
                        'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                        'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                        'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                        'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                        'smf' => $this->request->getVar('smf'),
                        'smfname' => $this->request->getVar('smfname'),
                        'poliklinik' => $poliklinik,
                        'poliklinikname' => $poliklinikname,
                        'poliklinikclass' => $poliklinikclass,
                        'poliklinikclassname' => $this->request->getVar('poliklinikclassname'),
                        'bednumber' => $this->request->getVar('bednumber'),
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'employee' => $employee,
                        'employeename' => $employeename,
                        'locationcode' => $locationcode,
                        'locationname' => $locationname,
                        'numberseq' => $no_antrian,
                        'createdby' => $this->request->getVar('createdby'),
                        'createddate' => $this->request->getVar('createddate'),
                    ];
                    $perawat = new ModelFarmasiPelayananHeader();
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Dokumen Resep Telah Dibuat, Silahkan Isi Detail Obat',
                        'journalnumber' => $newkode,
                        'documentdate' => $documentdate,
                        'karyawan' => $karyawan,
                        'dispensasi' => $dispensasi,
                        'relation' => $pasienid,
                        'relationname' => $pasienname,
                        'paymentmethod' => $paymentmethod,
                        'paymentmethodname' => $paymentmethodname,
                        'poliklinik' => $poliklinik,
                        'poliklinikname' => $poliklinikname,
                        'poliklinikclass' => $poliklinikclass,
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'employee' => $employee,
                        'employeename' => $employeename,
                        'referencenumber' => $memo,
                        'locationcode' => $locationcode,
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Search_Obat()
    {
        if ($this->request->isAJAX()) {

            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobat(),
                'locationcode' => $locationcode,
            ];
            $msg = [
                'data' => view('depofarmasi/modalcariobat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ruangan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kamar();
        return $list;
    }

    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }

    private function _data_dokter_all()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter_all();
        return $list;
    }

    private function data_petugas_resep()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_petugas_resep();
        return $list;
    }

    public function Search_PasienRanap()
    {
        if ($this->request->isAJAX()) {

            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelMasterObat();
            $data = [

                'locationcode' => $locationcode,
                'ruangan' => $this->ruangan(),
            ];
            $msg = [
                'data' => view('depofarmasi/modalcaripasienrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridatapasienranap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();

            $register = new ModelFarmasiPelayananHeader();
            $data = [
                'tampildata' => $register->Search_Pasien_Rajal($search)
            ];


            $msg = [
                'data' => view('depofarmasi/data_pasien_rajal', $data)
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
                'tampildata' => $gudang->caridataobatpelayanan()
            ];
            $msg = [
                'data' => view('depofarmasi/cariobatpelayanan', $data)
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
                'tampildata' => $gudang->search_DataObat_pelayanan($search),

            ];

            $msg = [
                'data' => view('depofarmasi/cariobatpelayanan', $data)
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
            $row = $m_icd->get_data_obat_pelayanan($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandataresep_detail()
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

                $price = $this->request->getVar('price');
                $jumlah = $this->request->getVar('qty');
                $jumlahstock = $this->request->getVar('qtystock');
                $qty = -1 * $jumlah;
                $subtotal = $price * $qty;

                $code = $this->request->getVar('code');
                $m_icd = new ModelMasterObat();
                $sm = $m_icd->get_minstock_obat($code);
                $stockminimal = $sm['minstock'];

                $beli = $jumlahstock - $jumlah;

                $emptydate = date('Y-m-d', strtotime($this->request->getVar("emptydate")));


                if ($jumlah > $jumlahstock) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Jumlah Dilayani Tidak Boleh Lebih Besar Daripada Jumlah Stock Saat ini'

                    ];
                } else if ($beli < $stockminimal) {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Jumlah Dilayani Tidak Boleh Lebih Besar Daripada Jumlah Stock Minimal [' . $stockminimal . ']',

                    ];
                } else {

                    $simpandata = [

                        'journalnumber' => $this->request->getVar('journalnumber'),
                        'documentdate' => $this->request->getVar('documentdate_detail'),
                        'karyawan' => $this->request->getVar('karyawan_detail'),
                        'dispensasi' => $this->request->getVar('dispensasi_detail'),
                        'relation' => $this->request->getVar('relation'),
                        'relationname' => $this->request->getVar('relationname'),
                        'paymentmethod' => $this->request->getVar('paymentmethod_detail'),
                        'paymentmethodname' => $this->request->getVar('paymentmethodname_detail'),
                        'poliklinik' => $this->request->getVar('poliklinik_detail'),
                        'poliklinikname' => $this->request->getVar('poliklinikname_detail'),
                        'poliklinikclass' => $this->request->getVar('poliklinikclass_detail'),
                        'dokter' => $this->request->getVar('dokter_detail'),
                        'doktername' => $this->request->getVar('doktername_detail'),
                        'employee' => $this->request->getVar('employee_detail'),
                        'employeename' => $this->request->getVar('employeename_detail'),
                        'referencenumber' => $this->request->getVar('referencenumber_detail'),
                        'locationcode' => $this->request->getVar('locationcode_detail'),
                        'locationname' => $this->request->getVar('locationname_detail'),
                        'racikan' => $this->request->getVar('racikan'),
                        'r' => $this->request->getVar('koderacikan'),
                        'koderacikan' => $this->request->getVar('koderacikan'),
                        'jumlahracikan' => $this->request->getVar('jumlahracikan'),
                        'code' => $this->request->getVar('code'),
                        'name' => $this->request->getVar('name'),
                        'batchnumber' => $this->request->getVar('batchnumber'),
                        'expireddate' => $this->request->getVar('expireddate'),
                        'qty' => $qty,
                        'uom' => $this->request->getVar('uom'),
                        'signa1' => $this->request->getVar('signa1'),
                        'signa2' => $this->request->getVar('signa2'),
                        'emptydate' => $emptydate,
                        'price' => $this->request->getVar('price'),
                        'subtotal' => $subtotal,
                        'createdby' => $this->request->getVar('createdby_detail'),
                        'createddate' => $this->request->getVar('createddate_detail'),
                        //'qtypaket' => $this->request->getVar('qtypaket'),
                        //'qtyluarpaket' => $this->request->getVar('qtyluarpaket'),
                        'eticket_aturan' => $this->request->getVar('aturanpakai'),
                        'eticket_carapakai' => $this->request->getVar('carapakai'),
                        'eticket_petunjuk' => $this->request->getVar('carapetunjuk'),

                    ];
                    $perawat = new ModelFarmasiPelayananDetail;
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Detail Obat telah disimpan'
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeDetailPermintaan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'DetailObat' => $resume->search_detail_depo_sp($journalnumber)
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_form_amprah_sp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumePelayanan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $headerpelayanan = $resume->search_header_pelayanan($journalnumber);
            $data = [
                'DetailObat' => $resume->search_detail_pelayanan($journalnumber),
                'kodejournal' => $journalnumber,
                'validasilunas' => $headerpelayanan['validasilunas'],
                'luarpaketinacbg' => $headerpelayanan['luarpaketinacbg'],
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
                'referencenumber' => $headerpelayanan['referencenumber'],

            ];
            $msg = [
                'data' => view('depofarmasi/data_form_pelayanan_rajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus_detail_resep()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelFarmasiPelayananDetail;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function DFPR()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
        ];
        return view('depofarmasi/registerDepoRJ', $data);
    }

    public function ambildataDFPRajal()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelDepoSPHeader();
            $data = [
                'tampildata' => $register->ambildataDFRJ()
            ];

            $msg = [
                'data' => view('depofarmasi/dataregisterDFRJ', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDFPR()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));


            $register = new ModelDepoSPHeader();
            $data = [
                'tampildata' => $register->search_RegisterDFRJ($search)
            ];
            $msg = [
                'data' => view('depofarmasi/dataregisterDFRJ', $data)
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

    public function DetailDFPR($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_DFPR($id);
        $resume = new ModelTerimaPBFDetail();
        $data = [
            'id' => $row['id'],
            'journalnumber' => $row['journalnumber'],
            'pasienid' => $row['pasienid'],
            'pasienname' => $row['pasienname'],
            'namadokter' => $row['dokter'],
            'doktername' => $row['doktername'],
            'employee' => $row['employee'],
            'employeename' => $row['employeename'],
            'poliklinikclass' => $row['poliklinikclass'],
            'poliklinik' => $row['poliklinik'],
            'poliklinikname' => $row['poliklinikname'],
            'dispensasi' => $row['dispensasi'],
            'karyawan' => $row['karyawan'],
            'documentdate' => $row['documentdate'],
            'paymentmethodname' => $row['paymentmethodname'],
            'paymentmethod' => $row['paymentmethod'],
            'dokter' => $this->_data_dokter(),
            'petugas' => $this->data_petugas_resep(),
            'racikan' => $this->racikan(),
            'itemracikan' => $this->itemracikan(),
            'aturanpakai' => $resume->aturan_pakai(),
            'carapakai' => $resume->cara_pakai(),
            'carapetunjuk' => $resume->cara_petunjuk(),

        ];

        return view('depofarmasi/form_farmasi_pelayanan_rajal_add', $data);
    }



    public function lokasi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi();
        return $list;
    }

    public function printdistribusi()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "GUDANG FARMASI";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_distribusi($lokasikasir);
        $data = [
            'dataopname' => $pasien->Distribusiheader($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'tampildata' => $pasien->Distribusidetail($id),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/distribusi_amprah', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function ambildataSP()
    {
        if ($this->request->isAJAX()) {
            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelDistribusiHeader();
            $data = [
                'tampildata' => $gudang->ambildataPermintaan($locationcode)
            ];
            $msg = [
                'data' => view('gudangfarmasi/carisuratpesanan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataSP()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateRequest']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $locationcode = $search['locationcode'];
            $gudang = new ModelDistribusiHeader();
            $data = [
                'tampildata' => $gudang->search_RegisterPermintaan($search),
                'locationcode' => $locationcode,
            ];

            $msg = [
                'data' => view('gudangfarmasi/carisuratpesanan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailpasienranap()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelDistribusiHeader();
            $row = $m_icd->get_data_pasien_igdrajal($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function Search_Obat_Pelayanan()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobat()
            ];
            $msg = [
                'data' => view('depofarmasi/modalcariobatpelayanan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Search_BacthNumber()
    {
        if ($this->request->isAJAX()) {
            $code = $this->request->getVar('code');
            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->get_list_BacthNumber_pelayanan($code, $locationcode),
                'lokasi' => $locationcode,
            ];
            $msg = [
                'data' => view('depofarmasi/modalcaribatchnumber_pelayanan', $data)
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
                'tampildata' => $gudang->get_list_BacthNumber($code)
            ];
            $msg = [
                'data' => view('gudangfarmasi/caribatchnumber', $data)
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
            $row = $m_icd->get_data_obat_BN_distribusi($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailobatdistribusi()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelMasterObat();
            $row = $m_icd->get_data_sp($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ValidasiLunas()
    {
        if ($this->request->isAJAX()) {

            $validation = 1;
            $validationdate = date('Y-m-d G:i:s');
            $validationby = $this->request->getVar('validationby');
            $simpandata = [
                'validasilunas' => $validation,
                'validationby' => $validationby,
                'validationdate' => $validationdate,

            ];
            $perawat = new ModelTerimaPBFDetail;
            $journalnumber = $this->request->getVar('kodejournal');
            $perawat->update_validasilunas($journalnumber, $simpandata);
            $msg = [
                'sukses' => 'Validasi Lunas Sudah Selesai !'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalValidasiLunas()
    {
        if ($this->request->isAJAX()) {

            $validation = 0;
            $validationdate = date('Y-m-d G:i:s');
            $validationby = $this->request->getVar('validationby');
            $simpandata = [
                'validasilunas' => $validation,
                'validationby' => '',
                'validationdate' => '0000:00:00 00:00:00',

            ];
            $perawat = new ModelTerimaPBFDetail;
            $journalnumber = $this->request->getVar('kodejournal');
            $perawat->update_validasilunas($journalnumber, $simpandata);
            $msg = [
                'sukses' => 'Validasi Lunas Sudah Selesai !'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ValidasiLuarPaket()
    {
        if ($this->request->isAJAX()) {

            $validation = 1;
            $validationdate = date('Y-m-d G:i:s');
            $validationby = $this->request->getVar('validationby');
            $simpandata = [
                'luarpaketinacbg' => $validation,
            ];
            $perawat = new ModelTerimaPBFDetail;
            $journalnumber = $this->request->getVar('kodejournal');
            $perawat->update_validasiluarpaket($journalnumber, $simpandata);
            $msg = [
                'sukses' => 'Validasi Luar Paket Sudah Selesai !'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function BatalValidasiLuarPaket()
    {
        if ($this->request->isAJAX()) {

            $validation = 0;
            $validationdate = date('Y-m-d G:i:s');
            $validationby = $this->request->getVar('validationby');
            $simpandata = [
                'luarpaketinacbg' => $validation,
            ];
            $perawat = new ModelTerimaPBFDetail;
            $journalnumber = $this->request->getVar('kodejournal');
            $perawat->update_validasiluarpaket($journalnumber, $simpandata);
            $msg = [
                'sukses' => 'Batal Validasi Luar Paket Sudah Selesai !'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Update_cara_pakai()
    {
        if ($this->request->isAJAX()) {
            $eticket_aturan = $this->request->getVar('aturanpakai');
            $eticket_carapakai = $this->request->getVar('carapakai');
            $eticket_petunjuk = $this->request->getVar('carapetunjuk');
            $pagi = $this->request->getVar('pagi');
            $siang = $this->request->getVar('siang');
            $sore = $this->request->getVar('sore');
            $malam = $this->request->getVar('malam');

            $simpandata = [
                'eticket_aturan' => $eticket_aturan,
                'eticket_carapakai' => $eticket_carapakai,
                'eticket_petunjuk' => $eticket_petunjuk,
                'pagi' => $pagi,
                'siang' => $siang,
                'sore' => $sore,
                'malam' => $malam,
            ];


            $perawat = new ModelTerimaPBFDetail;
            $id = $this->request->getVar('id');
            $perawat->update_carapemakaian_obat($id, $simpandata);
            $msg = [
                'sukses' => 'Cara Pakai Sudah DiSet !'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printpenjualan()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "DEPO FARMASI RAWAT INAP";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeader($id),
            'tampildata' => $pasien->penjualanDetail($id),

        ];

        $html = view('pdf/stylebootstrap');
        $html = view('pdf/struk_depo_rajal', $data);
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = 'Struk Depo Rajal';
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function viewFarmasiKlinis()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelMasterObat();
            $data = [

                'dataobatklinis' => $m_icd->get_detail_obat($id),
            ];

            $msg = [
                'suksesobatklinis' => view('depofarmasi/modalviewobatklinis', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printpenjualanKonvesional()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "DEPO FARMASI RAWAT INAP";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeader($id),
            'tampildata' => $pasien->penjualanDetail($id),

        ];

        return view('cetakan/buktireseprajal', $data);
    }

    public function printpenjualanKonvesionalKronis()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "DEPO FARMASI RAWAT INAP";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeader($id),
            'tampildata' => $pasien->penjualanDetailKronis($id),

        ];

        return view('cetakan/buktireseprajalkronis', $data);
    }

    public function printpenjualanKonvesionalNonKronis()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "DEPO FARMASI RAWAT INAP";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);

        $data = [
            'dataheaderpenjualan' => $pasien->penjualanHeader($id),
            'tampildata' => $pasien->penjualanDetailNonKronis($id),

        ];

        return view('cetakan/buktireseprajalnonkronis', $data);
    }

    public function printetiket()
    {

        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);

        $data = [
            'datapasien' => $pasien->etiketfarmasirajal($id),
        ];

        return view('cetakan/etiketfarmasirajal_aliit', $data);
    }

    public function Etiket()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $resume = new ModelTerimaPBFDetail();
            $pasien = new ModelPasienRanap($this->request);

            $data = [
                'datapasien' => $pasien->etiketfarmasirajal($id),
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
            ];
            $msg = [
                'sukses' => view('depofarmasi/modalsetetiket', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function LihatRincianPelayanan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTNODetailRJ();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'TNO' => $resume->search($referencenumber),
                'GIZI' => $resume->searchAsupanGizi($referencenumber),
                'OPERASI' => $resume->Operasirajal($referencenumber),
                'PENUNJANG' => $resume->Penunjangrajal($referencenumber),
                'FARMASI' => $resume->FARMASIrajal($referencenumber),
                'BHP' => $resume->BHPrajal($referencenumber),
                'PEMERIKSAAN' => $resume->Pemeriksaan($referencenumber)
            ];

            $msg = [
                'suksesmodalrincian' => view('depofarmasi/modalrincianpelayananrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printetiketSemua()
    {

        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);

        $data = [
            'datapasien' => $pasien->etiketfarmasirajalSemua($id),
        ];

        return view('cetakan/etiketfarmasirajalsemua_aliit', $data);
    }

    public function orderesepigd()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModeligdOrderRad2();
            $resume = new ModelTerimaPBFDetail();
            $gudang = new ModelMasterObat();
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['journalnumber'],

                'bpjs_sep' => $row['bpjs_sep'],
                'pasienid' => $row['pasienid'],
                'oldcode' => $row['oldcode'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'paymentmethod_payment' => $row['paymentmethod_payment'],
                'paymentmethodname_payment' => $row['paymentmethodname_payment'],
                'paymentcardnumber_payment' => $row['paymentcardnumber_payment'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokter' => $row['dokter'],
                'kodedokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'datein' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => '',
                'alamatpjb' => '',
                'hubunganpjb' => '',
                'telppjb' => '',
                'classroom' => $row['poliklinik'],
                'classroomname' => $row['poliklinikname'],
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'bednumber' => $row['poliklinik'],
                'kelompok' => $gudang->kelompokobat(),
                'lokasi' => $this->lokasi(),
                'dokter' => $this->_data_dokter_all(),
                'petugas' => $this->data_petugas_resep(),
                'racikan' => $this->racikan(),
                'itemracikan' => $this->itemracikan(),
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),

            ];
            $msg = [
                'sukses' => view('igd/modaleresep_igd', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function Search_Obat_Pelayanan_eresep()
    {
        if ($this->request->isAJAX()) {

            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobat()
            ];
            $msg = [
                'data' => view('depofarmasi/modalcariobatpelayanan_eresep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataobateresep()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getVar();
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->search_DataObat_pelayanan($search),

            ];

            $msg = [
                'data' => view('depofarmasi/cariobatpelayanan_eresep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandata_eresepigd()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pasienid' => [
                    'label' => 'Norm Tidak Boleh Kosong',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {

                $db = db_connect();
                $locationcode = $this->request->getVar('locationcode');



                $pasienid = $this->request->getVar('pasienid');
                $tanggalpelayanan = $this->request->getVar('documentdate');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $explodewaktu = explode("-", $documentdate);



                //$tahun = $this->request->getVar('documentyear');
                $tahun = $explodewaktu[0];
                // $bulan = $this->request->getVar('documentmonth');
                $bulan = $explodewaktu[1];
                $potongtahun = substr($tahun, 2, 2);

                // var_dump($tahun);
                // die();



                //$query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header WHERE documentyear='$tahun'  AND documentmonth='$bulan'  AND locationcode='$locationcode' and tanda=2 ORDER BY id desc LIMIT 1");
                $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header WHERE  tanda=2 ORDER BY id desc LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                $underscore = '_';
                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }



                $tanda = 'RIGD';
                $today = date('ymd', strtotime($documentdate));

                //$newkode = $tanda . $underscore . $pasienid . $underscore . $locationcode . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $newkode = $tanda . $underscore . $pasienid  . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                // var_dump($kode);
                // var_dump($antrian);
                // var_dump($newkode);
                // die();


                $no_antrian = sprintf($nourutantrian);

                $documentdate = $documentdate;
                $karyawan = $this->request->getVar('karyawan');
                $dispensasi = $this->request->getVar('dispensasi');
                $pasienid = $this->request->getVar('pasienid');
                $pasienname = $this->request->getVar('pasienname');
                $paymentmethod = $this->request->getVar('paymentmethod');
                $paymentmethodname = $this->request->getVar('paymentmethodname');
                $poliklinik = $this->request->getVar('poliklinik');
                $poliklinikname = $this->request->getVar('poliklinikname');
                $poliklinikclass = $this->request->getVar('poliklinikclass');
                $dokter = $this->request->getVar('dokter');
                $doktername = $this->request->getVar('doktername');
                $employee = $this->request->getVar('employee');
                $employeename = $this->request->getVar('employeename');
                $tandamemo = '/';
                $memo = $doktername . $tandamemo . $paymentmethod;
                $locationname = $this->request->getVar('locationname');
                $ranap = 1;

                $tanggallahir = $this->request->getVar('dateofbirth');
                $dob = strtotime($tanggallahir);
                $current_time = time();
                $age_years = date('Y', $current_time) - date('Y', $dob);
                $age_months = date('m', $current_time) - date('m', $dob);
                $age_days = date('d', $current_time) - date('d', $dob);

                if ($age_days < 0) {
                    $days_in_month = date('t', $current_time);
                    $age_months--;
                    $age_days = $days_in_month + $age_days;
                }

                if ($age_months < 0) {
                    $age_years--;
                    $age_months = 12 + $age_months;
                }

                $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
                $groups = "IGD";

                if ($doktername == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Dokter Pemberi Resep Harus Diisi'
                    ];
                } else if ($pasienname == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Nama Pasien Harus Diisi'
                    ];
                } else if ($paymentmethodname == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Cara Bayar Harus Diisi'
                    ];
                } else {

                    $simpandata = [
                        'isenaranap' => $ranap,
                        'groups' => $groups,
                        'journalnumber' => $newkode,
                        'documentdate' => $documentdate,
                        'documentyear' => $tahun,
                        'documentmonth' => $bulan,
                        'noreg' => $this->request->getVar('noreg'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                        'pasienid' => $pasienid,
                        'oldcode' => $this->request->getVar('oldcode'),
                        'pasienname' => $pasienname,
                        'pasiengender' => $this->request->getVar('pasiengender'),
                        'dateofbirth' => $this->request->getVar('dateofbirth'),
                        'pasienage' => $umur,
                        'pasienaddress' => $this->request->getVar('pasienaddress'),
                        'pasienarea' => $this->request->getVar('pasienarea'),
                        'pasiensubarea' => $this->request->getVar('pasiensubarea'),
                        'pasiensubareaname' => $this->request->getVar('pasiensubareaname'),
                        'karyawan' => $karyawan,
                        'dispensasi' => $dispensasi,
                        'dispensasipejabat' => $this->request->getVar('dispensasipejabat'),
                        'dispensasialasan' => $this->request->getVar('dispensasialasan'),
                        'paymentmethod' => $paymentmethod,
                        'paymentmethodname' => $paymentmethodname,
                        'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                        'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                        'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                        'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                        'smf' => $this->request->getVar('smf'),
                        'smfname' => $this->request->getVar('smfname'),
                        'poliklinik' => $poliklinik,
                        'poliklinikname' => $poliklinikname,
                        'poliklinikclass' => $poliklinikclass,
                        'poliklinikclassname' => $this->request->getVar('poliklinikclassname'),
                        'bednumber' => $this->request->getVar('bednumber'),
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'employee' => $employee,
                        'employeename' => $employeename,
                        'locationcode' => $locationcode,
                        'locationname' => $locationname,
                        'numberseq' => $no_antrian,
                        'createdby' => $this->request->getVar('createdby'),
                        'createddate' => $this->request->getVar('createddate'),
                    ];
                    $perawat = new ModelFarmasiPelayananHeader();
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Dokumen Resep Telah Dibuat, Silahkan Isi Detail Obat',
                        'journalnumber' => $newkode,
                        'documentdate' => $documentdate,
                        'karyawan' => $karyawan,
                        'dispensasi' => $dispensasi,
                        'relation' => $pasienid,
                        'relationname' => $pasienname,
                        'paymentmethod' => $paymentmethod,
                        'paymentmethodname' => $paymentmethodname,
                        'poliklinik' => $poliklinik,
                        'poliklinikname' => $poliklinikname,
                        'poliklinikclass' => $poliklinikclass,
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'employee' => $employee,
                        'employeename' => $employeename,
                        'referencenumber' => $memo,
                        'locationcode' => $locationcode,
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ordereseprajal()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModeligdOrderRad2();
            $resume = new ModelTerimaPBFDetail();
            $gudang = new ModelMasterObat();
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['journalnumber'],

                'bpjs_sep' => $row['bpjs_sep'],
                'pasienid' => $row['pasienid'],
                'oldcode' => $row['oldcode'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'paymentmethodori' => $row['paymentmethodori'],
                'paymentmethodnameori' => $row['paymentmethodnameori'],
                'paymentcardnumberori' => $row['paymentcardnumberori'],
                'paymentmethod_payment' => $row['paymentmethod_payment'],
                'paymentmethodname_payment' => $row['paymentmethodname_payment'],
                'paymentcardnumber_payment' => $row['paymentcardnumber_payment'],
                'poliklinik' => $row['poliklinik'],
                'poliklinikname' => $row['poliklinikname'],
                'faskes' => $row['faskes'],
                'faskesname' => $row['faskesname'],
                'dokter' => $row['dokter'],
                'kodedokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'datein' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'reasoncode' => $row['reasoncode'],
                'lakalantas' => $row['lakalantas'],
                'lokasilakalantas' => $row['lokasilakalantas'],
                'namapjb' => '',
                'alamatpjb' => '',
                'hubunganpjb' => '',
                'telppjb' => '',
                'classroom' => $row['poliklinik'],
                'classroomname' => $row['poliklinikname'],
                'room' => $row['poliklinik'],
                'roomname' => $row['poliklinikname'],
                'bednumber' => $row['poliklinik'],
                'kelompok' => $gudang->kelompokobat(),
                'lokasi' => $this->lokasi(),
                'dokter' => $this->_data_dokter_all(),
                'petugas' => $this->data_petugas_resep(),
                'racikan' => $this->racikan(),
                'itemracikan' => $this->itemracikan(),
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),

            ];
            $msg = [
                'sukses' => view('rawatjalan/modaleresep_rajal', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandata_ereseprajal()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pasienid' => [
                    'label' => 'Norm Tidak Boleh Kosong',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {

                $db = db_connect();
                $locationcode = $this->request->getVar('locationcode');



                $pasienid = $this->request->getVar('pasienid');
                $tanggalpelayanan = $this->request->getVar('documentdate');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $explodewaktu = explode("-", $documentdate);



                //$tahun = $this->request->getVar('documentyear');
                $tahun = $explodewaktu[0];
                // $bulan = $this->request->getVar('documentmonth');
                $bulan = $explodewaktu[1];
                $potongtahun = substr($tahun, 2, 2);

                // var_dump($tahun);
                // die();



                //$query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header WHERE documentyear='$tahun'  AND documentmonth='$bulan'  AND locationcode='$locationcode' and tanda=2 ORDER BY id desc LIMIT 1");
                $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header WHERE tanda=2 ORDER BY id desc LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                $underscore = '_';
                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }



                $tanda = 'RIRJ';
                $today = date('ymd', strtotime($documentdate));

                //$newkode = $tanda . $underscore . $pasienid . $underscore . $locationcode . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                $newkode = $tanda . $underscore . $pasienid . $underscore . $today . $underscore . sprintf('%06s', $nourut);
                // var_dump($kode);
                // var_dump($antrian);
                // var_dump($newkode);
                // die();


                $no_antrian = sprintf($nourutantrian);

                $documentdate = $documentdate;
                $karyawan = $this->request->getVar('karyawan');
                $dispensasi = $this->request->getVar('dispensasi');
                $pasienid = $this->request->getVar('pasienid');
                $pasienname = $this->request->getVar('pasienname');
                $paymentmethod = $this->request->getVar('paymentmethod');
                $paymentmethodname = $this->request->getVar('paymentmethodname');
                $poliklinik = $this->request->getVar('poliklinik');
                $poliklinikname = $this->request->getVar('poliklinikname');
                $poliklinikclass = $this->request->getVar('poliklinikclass');
                $dokter = $this->request->getVar('dokter');
                $doktername = $this->request->getVar('doktername');
                $employee = $this->request->getVar('employee');
                $employeename = $this->request->getVar('employeename');
                $tandamemo = '/';
                $memo = $doktername . $tandamemo . $paymentmethod;
                $locationname = $this->request->getVar('locationname');
                $ranap = 1;

                $tanggallahir = $this->request->getVar('dateofbirth');
                $dob = strtotime($tanggallahir);
                $current_time = time();
                $age_years = date('Y', $current_time) - date('Y', $dob);
                $age_months = date('m', $current_time) - date('m', $dob);
                $age_days = date('d', $current_time) - date('d', $dob);

                if ($age_days < 0) {
                    $days_in_month = date('t', $current_time);
                    $age_months--;
                    $age_days = $days_in_month + $age_days;
                }

                if ($age_months < 0) {
                    $age_years--;
                    $age_months = 12 + $age_months;
                }

                $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
                $groups = "RJ";

                if ($doktername == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Dokter Pemberi Resep Harus Diisi'
                    ];
                } else if ($pasienname == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Nama Pasien Harus Diisi'
                    ];
                } else if ($paymentmethodname == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Cara Bayar Harus Diisi'
                    ];
                } else {

                    $simpandata = [
                        'isenaranap' => $ranap,
                        'groups' => $groups,
                        'journalnumber' => $newkode,
                        'documentdate' => $documentdate,
                        'documentyear' => $tahun,
                        'documentmonth' => $bulan,
                        'noreg' => $this->request->getVar('noreg'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                        'pasienid' => $pasienid,
                        'oldcode' => $this->request->getVar('oldcode'),
                        'pasienname' => $pasienname,
                        'pasiengender' => $this->request->getVar('pasiengender'),
                        'dateofbirth' => $this->request->getVar('dateofbirth'),
                        'pasienage' => $umur,
                        'pasienaddress' => $this->request->getVar('pasienaddress'),
                        'pasienarea' => $this->request->getVar('pasienarea'),
                        'pasiensubarea' => $this->request->getVar('pasiensubarea'),
                        'pasiensubareaname' => $this->request->getVar('pasiensubareaname'),
                        'karyawan' => $karyawan,
                        'dispensasi' => $dispensasi,
                        'dispensasipejabat' => $this->request->getVar('dispensasipejabat'),
                        'dispensasialasan' => $this->request->getVar('dispensasialasan'),
                        'paymentmethod' => $paymentmethod,
                        'paymentmethodname' => $paymentmethodname,
                        'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                        'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                        'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                        'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                        'smf' => $this->request->getVar('smf'),
                        'smfname' => $this->request->getVar('smfname'),
                        'poliklinik' => $poliklinik,
                        'poliklinikname' => $poliklinikname,
                        'poliklinikclass' => $poliklinikclass,
                        'poliklinikclassname' => $this->request->getVar('poliklinikclassname'),
                        'bednumber' => $this->request->getVar('bednumber'),
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'employee' => $employee,
                        'employeename' => $employeename,
                        'locationcode' => $locationcode,
                        'locationname' => $locationname,
                        'numberseq' => $no_antrian,
                        'createdby' => $this->request->getVar('createdby'),
                        'createddate' => $this->request->getVar('createddate'),
                    ];
                    $perawat = new ModelFarmasiPelayananHeader();
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Dokumen Resep Telah Dibuat, Silahkan Isi Detail Obat',
                        'journalnumber' => $newkode,
                        'documentdate' => $documentdate,
                        'karyawan' => $karyawan,
                        'dispensasi' => $dispensasi,
                        'relation' => $pasienid,
                        'relationname' => $pasienname,
                        'paymentmethod' => $paymentmethod,
                        'paymentmethodname' => $paymentmethodname,
                        'poliklinik' => $poliklinik,
                        'poliklinikname' => $poliklinikname,
                        'poliklinikclass' => $poliklinikclass,
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'employee' => $employee,
                        'employeename' => $employeename,
                        'referencenumber' => $memo,
                        'locationcode' => $locationcode,
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function orderesepranap()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModeligdOrderRad2();
            $resume = new ModelTerimaPBFDetail();
            $gudang = new ModelMasterObat();
            $perawat2 = new ModeligdAKHP();
            //$row = $perawat->find($id);
            $row = $perawat2->ambildataranapibs($id);
            $data = [
                'id' => $row['id'],
                'groups' => $row['groups'],
                'journalnumber' => $row['journalnumber'],
                'documentdate' => $row['documentdate'],
                'documentyear' => $row['documentyear'],
                'documentmonth' => $row['documentmonth'],
                'referencenumber' => $row['referencenumber'],
                'bpjs_sep' => '',
                'pasienid' => $row['pasienid'],
                'oldcode' => $row['oldcode'],
                'pasienname' => $row['pasienname'],
                'pasiengender' => $row['pasiengender'],
                'pasienage' => $row['pasienage'],
                'pasiendateofbirth' => $row['pasiendateofbirth'],
                'pasienaddress' => $row['pasienaddress'],
                'pasienarea' => $row['pasienarea'],
                'pasiensubarea' => $row['pasiensubarea'],
                'pasiensubareaname' => $row['pasiensubareaname'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['paymentcardnumber'],
                'paymentmethodori' => $row['paymentmethodname'],
                'paymentmethodnameori' => $row['paymentmethodname'],
                'paymentcardnumberori' => '',
                'paymentmethod_payment' => $row['paymentmethodname'],
                'paymentmethodname_payment' => $row['paymentmethodname'],
                'paymentcardnumber_payment' => $row['paymentcardnumber'],
                'poliklinik' => '',
                'poliklinikname' => '',
                'faskes' => '',
                'faskesname' => '',
                'kodedokter' => $row['dokter'],
                'dokter' => $row['dokter'],
                'doktername' => $row['doktername'],
                'smf' => $row['smf'],
                'smfname' => $row['smfname'],
                'datein' => $row['createddate'],
                'icdx' => $row['icdx'],
                'icdxname' => $row['icdxname'],
                'reasoncode' => '',
                'lakalantas' => '',
                'lokasilakalantas' => '',
                'namapjb' => '',
                'alamatpjb' => '',
                'hubunganpjb' => '',
                'telppjb' => '',
                'classroom' => '',
                'classroomname' => '',
                'room' => $row['room'],
                'roomname' => $row['roomname'],
                'bednumber' => '',
                'kelompok' => $gudang->kelompokobat(),
                'lokasi' => $this->lokasi(),
                'dokter' => $this->_data_dokter_all(),
                'petugas' => $this->data_petugas_resep(),
                'racikan' => $this->racikan(),
                'itemracikan' => $this->itemracikan(),
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),

            ];
            $msg = [
                'sukses' => view('ibs/modaleresep_ranap', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandata_eresepranap()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pasienid' => [
                    'label' => 'Norm Tidak Boleh Kosong',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'doktername' => $validation->getError('doktername')
                    ]
                ];
            } else {

                $db = db_connect();
                $locationcode = $this->request->getVar('locationcode');



                $pasienid = $this->request->getVar('pasienid');
                $tanggalpelayanan = $this->request->getVar('documentdate');
                $documentdate = date('Y-m-d', strtotime($tanggalpelayanan));

                $explodewaktu = explode("-", $documentdate);

                $tahun = $explodewaktu[0];

                $bulan = $explodewaktu[1];
                $potongtahun = substr($tahun, 2, 2);




                $query = $db->query("SELECT journalnumber as kode_jurnal, numberseq as noantrian FROM transaksi_farmasi_pelayanan_header WHERE tanda=2 ORDER BY id desc LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                $underscore = '_';
                if ($kode == "") {
                    $nourut = '000001';
                } else {
                    $nourut = (int) substr($kode, -6, 6);
                    $nourut++;
                }

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }



                $tanda = 'RBNAKHPBHP';
                $today = date('ymd', strtotime($documentdate));

                $newkode = $tanda . $underscore . $pasienid . $underscore . $today . $underscore . sprintf('%06s', $nourut);


                $no_antrian = sprintf($nourutantrian);

                $documentdate = $documentdate;
                $karyawan = $this->request->getVar('karyawan');
                $dispensasi = $this->request->getVar('dispensasi');
                $pasienid = $this->request->getVar('pasienid');
                $pasienname = $this->request->getVar('pasienname');
                $paymentmethod = $this->request->getVar('paymentmethod');
                $paymentmethodname = $this->request->getVar('paymentmethodname');
                $poliklinik = $this->request->getVar('poliklinik');
                $poliklinikname = $this->request->getVar('poliklinikname');
                $poliklinikclass = $this->request->getVar('poliklinikclass');
                $dokter = $this->request->getVar('dokter');
                $doktername = $this->request->getVar('doktername');
                $employee = $this->request->getVar('employee');
                $employeename = $this->request->getVar('employeename');
                $tandamemo = '/';
                $memo = $doktername . $tandamemo . $paymentmethod;
                $locationname = $this->request->getVar('locationname');
                $ranap = 1;

                $tanggallahir = $this->request->getVar('dateofbirth');
                $dob = strtotime($tanggallahir);
                $current_time = time();
                $age_years = date('Y', $current_time) - date('Y', $dob);
                $age_months = date('m', $current_time) - date('m', $dob);
                $age_days = date('d', $current_time) - date('d', $dob);

                if ($age_days < 0) {
                    $days_in_month = date('t', $current_time);
                    $age_months--;
                    $age_days = $days_in_month + $age_days;
                }

                if ($age_months < 0) {
                    $age_years--;
                    $age_months = 12 + $age_months;
                }

                $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
                $groups = "RI   ";

                if ($doktername == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Dokter Pemberi Resep Harus Diisi'
                    ];
                } else if ($pasienname == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Nama Pasien Harus Diisi'
                    ];
                } else if ($paymentmethodname == "") {
                    $msg = [
                        'gagal' => true,
                        'pesan' => 'Cara Bayar Harus Diisi'
                    ];
                } else {

                    $simpandata = [
                        'isenaranap' => $ranap,
                        'groups' => $groups,
                        'journalnumber' => $newkode,
                        'documentdate' => $documentdate,
                        'documentyear' => $tahun,
                        'documentmonth' => $bulan,
                        'noreg' => $this->request->getVar('noreg'),
                        'referencenumber' => $this->request->getVar('referencenumber'),
                        'bpjs_sep' => $this->request->getVar('bpjs_sep'),
                        'pasienid' => $pasienid,
                        'oldcode' => $this->request->getVar('oldcode'),
                        'pasienname' => $pasienname,
                        'pasiengender' => $this->request->getVar('pasiengender'),
                        'dateofbirth' => $this->request->getVar('dateofbirth'),
                        'pasienage' => $umur,
                        'pasienaddress' => $this->request->getVar('pasienaddress'),
                        'pasienarea' => $this->request->getVar('pasienarea'),
                        'pasiensubarea' => $this->request->getVar('pasiensubarea'),
                        'pasiensubareaname' => $this->request->getVar('pasiensubareaname'),
                        'karyawan' => $karyawan,
                        'dispensasi' => $dispensasi,
                        'dispensasipejabat' => $this->request->getVar('dispensasipejabat'),
                        'dispensasialasan' => $this->request->getVar('dispensasialasan'),
                        'paymentmethod' => $paymentmethod,
                        'paymentmethodname' => $paymentmethodname,
                        'paymentcardnumber' => $this->request->getVar('paymentcardnumber'),
                        'paymentmethodori' => $this->request->getVar('paymentmethodori'),
                        'paymentmethodnameori' => $this->request->getVar('paymentmethodnameori'),
                        'paymentcardnumberori' => $this->request->getVar('paymentcardnumberori'),
                        'smf' => $this->request->getVar('smf'),
                        'smfname' => $this->request->getVar('smfname'),
                        'poliklinik' => $poliklinik,
                        'poliklinikname' => $poliklinikname,
                        'poliklinikclass' => $poliklinikclass,
                        'poliklinikclassname' => $this->request->getVar('poliklinikclassname'),
                        'bednumber' => $this->request->getVar('bednumber'),
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'employee' => $employee,
                        'employeename' => $employeename,
                        'locationcode' => $locationcode,
                        'locationname' => $locationname,
                        'numberseq' => $no_antrian,
                        'createdby' => $this->request->getVar('createdby'),
                        'createddate' => $this->request->getVar('createddate'),
                    ];
                    $perawat = new ModelFarmasiPelayananHeader();
                    $perawat->insert($simpandata);
                    $msg = [
                        'sukses' => 'Dokumen Resep Telah Dibuat, Silahkan Isi Detail Obat',
                        'journalnumber' => $newkode,
                        'documentdate' => $documentdate,
                        'karyawan' => $karyawan,
                        'dispensasi' => $dispensasi,
                        'relation' => $pasienid,
                        'relationname' => $pasienname,
                        'paymentmethod' => $paymentmethod,
                        'paymentmethodname' => $paymentmethodname,
                        'poliklinik' => $poliklinik,
                        'poliklinikname' => $poliklinikname,
                        'poliklinikclass' => $poliklinikclass,
                        'dokter' => $dokter,
                        'doktername' => $doktername,
                        'employee' => $employee,
                        'employeename' => $employeename,
                        'referencenumber' => $memo,
                        'locationcode' => $locationcode,
                    ];
                }
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumePelayananAKHP()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $headerpelayanan = $resume->search_header_pelayanan_AKHP($journalnumber);
            $nomorjurnal = $headerpelayanan['journalnumber'];
            $data = [
                'DetailObat' => $resume->search_detail_pelayanan_AKHP($journalnumber),
                'kodejournal' => $journalnumber,
                'validasilunas' => $headerpelayanan['validasilunas'],
                'luarpaketinacbg' => $headerpelayanan['luarpaketinacbg'],
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
                'referencenumber' => $headerpelayanan['referencenumber'],

            ];

            var_dump($data['DetailObat']);
            die();
            $msg = [
                'data' => view('ibs/data_form_pelayanan_akhp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumePelayananAKHPCL()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $headerpelayanan = $resume->search_header_pelayanan_AKHP($journalnumber);
            $nomorjurnal = $headerpelayanan['journalnumber'];


            $data = [
                'DetailObat' => $resume->search_detail_pelayanan_AKHPCL($journalnumber),
                'kodejournal' => $journalnumber,
                'validasilunas' => $headerpelayanan['validasilunas'],
                'luarpaketinacbg' => $headerpelayanan['luarpaketinacbg'],
                'aturanpakai' => $resume->aturan_pakai(),
                'carapakai' => $resume->cara_pakai(),
                'carapetunjuk' => $resume->cara_petunjuk(),
                'referencenumber' => $headerpelayanan['referencenumber'],

            ];


            $msg = [
                'data' => view('ibs/data_form_pelayanan_akhp', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

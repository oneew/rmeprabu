<?php

namespace App\Controllers;

use App\Models\ModelMasterObat;
use App\Models\Model_autocomplete;
use App\Models\ModelTerimaPBFHeader;
use App\Models\ModelTerimaPBFDetail;
use App\Models\ModelDepoSPHeader;
use App\Models\ModelDepoSPDetail;
use App\Models\ModelTerimaNonPBFHeader;
use App\Models\ModelTerimaNonPBFDetail;
use App\Models\ModelPasienRanap;
use App\Models\Modelrajal;
use App\Models\ModelSuratPesananHeader;
use App\Models\ModelSuratPesananDetail;
use App\Models\ModelrajalIBS;
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;



class AmprahFarmasiRuanganRanap extends BaseController
{

    public function index()
    {
        $gudang = new ModelMasterObat();
        $data = [
            'kelompok' => $gudang->kelompokobat(),
            'lokasi' => $this->lokasi(),
            'lokasiruangan' => $this->lokasiruangan(),
        ];

        echo view('rawatinap/form_amprah_barang_ruangan_ranap', $data);
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

    public function simpandataamprah()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'destinationcode' => [
                    'label' => 'Permintaan Tujuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'destinationcode' => $validation->getError('destinationcode')
                    ]
                ];
            } else {

                $db = db_connect();
                //$groups = $this->request->getVar('groups');
                $groups = 'ORDERRANAPREBORN';
                $tahun = $this->request->getVar('documentyear');
                $locationcode = $this->request->getVar('locationcode');
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(numberseq)as noantrian FROM transaksi_farmasi_deposp_header WHERE documentyear='$tahun' AND locationcode='$locationcode' and reborn=1 LIMIT 1");

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
                $tanda = 'SP-RBN';
                $tahun = $this->request->getVar('documentyear');
                $potongtahun = substr($tahun, 2, 2);

                $newkode = $tanda . $underscore . $locationcode . $underscore . $groups . $underscore . $potongtahun . $underscore . sprintf('%07s', $nourut);

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }




                $no_antrian = sprintf($nourutantrian);
                $locationcode = $this->request->getVar('locationcode');
                $destinationcode = $this->request->getVar('destinationcode');
                $documentdate = $this->request->getVar('documentdate');

                $simpandata = [

                    'groups' => $this->request->getVar('groups'),
                    'journalnumber' => $newkode,
                    'destinationcode' => $destinationcode,
                    'destinationname' => $this->request->getVar('destinationname'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'locationcode' => $locationcode,
                    'locationname' => $this->request->getVar('locationname'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'reborn' => 1,
                ];
                $perawat = new ModelDepoSPHeader;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Dokumen Permintaan Telah Dibuat, Silahkan Isi Detail Barang',
                    'journalnumber' => $newkode,
                    'lc' => $locationcode,
                    'destinationcode' => $destinationcode,
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

            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelMasterObat();
            $data = [
                //'tampildata' => $gudang->caridataobat(),
                'tampildata' => '',
                'locationcode' => $locationcode,
            ];
            $msg = [
                'data' => view('rawatinap/modalcariobatruangan', $data)
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
                'tampildata' => $gudang->caridataobatamprahruangan()
            ];
            $msg = [
                'data' => view('rawatinap/cariobatruangan', $data)
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
            $locationcode = $search['locationcode'];
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->search_DataObat_amprah_ruangan($search),
                'locationcode' => $locationcode,
            ];

            $msg = [
                'data' => view('rawatinap/cariobatruangan', $data)
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
            $locationcode = $this->request->getVar('locationcode');
            $m_icd = new ModelMasterObat();
            $row = $m_icd->get_data_obat_depo_sp_ruangan($code, $locationcode);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandataamprah_detail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Barang',
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

                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'locationcode' => $this->request->getVar('locationcode_detail'),
                    'destinationcode' => $this->request->getVar('destinationcode_detail'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'uom' => $this->request->getVar('uom'),
                    'qtystock' => $this->request->getVar('qtystock'),
                    'createdby' => $this->request->getVar('createdby_detail'),
                    'createddate' => $this->request->getVar('createddate_detail'),

                ];
                $perawat = new ModelDepoSPDetail;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail barang telah disimpan'
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
                'DetailObat' => $resume->search_detail_depo_sp($journalnumber)
            ];
            $msg = [
                'data' => view('depofarmasi/data_form_amprah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus_detail_amprah()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelDepoSPDetail;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function DSP()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
        ];
        return view('rawatinap/registerDSPruanganranap', $data);
    }

    public function ambildataDSP()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelDepoSPHeader();
            $data = [
                'tampildata' => $register->ambildataDSP()
            ];
            $msg = [
                'data' => view('rawatinap/dataregisterDSPruanganranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDSP()
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
                'tampildata' => $register->search_RegisterDSP($search)
            ];

            $msg = [
                'data' => view('rawatinap/dataregisterDSPruanganranap', $data)
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

    public function DetailDSP($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_DSP($id);
        $data = [
            'id' => $row['id'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'lc' => $row['locationcode'],
            'destinationcode' => $row['destinationcode'],
        ];

        return view('rawatinap/form_amprah_barang_add_ranap', $data);
    }



    public function lokasi()
    {

        $m_auto = new ModelrajalIBS();
        $list = $m_auto->get_list_lokasi_farmasi();
        return $list;
    }

    public function printamprah()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "GUDANG FARMASI";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $row2 = $pasien->get_data_depo_SP($lokasikasir);
        $data = [
            'dataopname' => $pasien->SPheader($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'tampildata' => $pasien->depoSPdetail($id),
        ];

        $html = view('pdf/stylebootstrap');
        $html .= view('pdf/sp_depo', $data);

        $dompdf->loadhtml($html);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function DSPesanan()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
        ];
        return view('gudangfarmasi/registersuratpesanan', $data);
    }

    public function ambildataDSPesanan()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelDepoSPHeader();
            $data = [
                'tampildata' => $register->ambildataDSPesanan()
            ];
            $msg = [
                'data' => view('gudangfarmasi/dataregistersuratpesanan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDSPesanan()
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
                'tampildata' => $register->search_RegisterDSPesanan($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/dataregistersuratpesanan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function tambahSuratPesanan()
    {
        if ($this->request->isAJAX()) {


            $data = [
                'lokasi' => $this->lokasi(),
            ];
            $msg = [
                'data' => view('gudangfarmasi/modalsuratpesanan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpanSuratPesanan()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'supplier' => [
                    'label' => 'Penyedia',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'destinationcode' => $validation->getError('destinationcode')
                    ]
                ];
            } else {

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $tahun = $this->request->getVar('documentyear');
                $locationcode = $this->request->getVar('locationcode');
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(numberseq)as noantrian FROM transaksi_farmasi_suratpesan_header ORDER BY id DESC LIMIT 1");

                foreach ($query->getResult() as $row) {
                    $kode = $row->kode_jurnal;
                    $antrian = $row->noantrian;
                }


                $underscore = '/';
                if ($kode == "") {
                    $nourut = '0000001';
                } else {
                    $nourut = (int) substr($kode, -7, 7);
                    $nourut++;
                }
                $tanda = 'SP';
                $tahun = $this->request->getVar('documentyear');
                $potongtahun = substr($tahun, 2, 2);
                $rs = 'RSUD.PBM';

                $newkode = $tanda . $underscore . $rs . $underscore . $tahun . $underscore . sprintf('%07s', $nourut);



                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);
                $locationcode = $this->request->getVar('locationcode');
                $destinationcode = $this->request->getVar('supplier');
                $destinationname = $this->request->getVar('suppliername');
                $documentdate = $this->request->getVar('documentdate');

                $simpandata = [
                    'journalnumber' => $newkode,
                    'destinationcode' => $destinationcode,
                    'destinationname' => $this->request->getVar('suppliername'),
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'locationcode' => $locationcode,
                    'locationname' => $this->request->getVar('locationname'),
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                    'keterangan' => $this->request->getVar('keterangan'),
                    'destinationaddress' => $this->request->getVar('supplieraddress'),
                ];
                $perawat = new ModelSuratPesananHeader;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Dokumen Surat Pesanan Telah Dibuat, Silahkan Isi Detail Barang',
                    'journalnumber' => $newkode,
                    'lc' => $locationcode,
                    'destinationcode' => $destinationcode,
                    'destinationname' => $destinationname,
                    'documentdate' => $documentdate,
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Search_Obat_Pesan()
    {
        if ($this->request->isAJAX()) {

            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobatPesan(),
                'locationcode' => $locationcode,
            ];
            $msg = [
                'data' => view('gudangfarmasi/modalcariobatPesan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataobatPesan()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getVar();
            $locationcode = $search['locationcode'];
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->search_DataObat_Pesan($search),
                'locationcode' => $locationcode,
            ];

            $msg = [
                'data' => view('gudangfarmasi/cariobatpesan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function detailobatPesan()
    {
        if ($this->request->isAJAX()) {

            $code = $this->request->getVar('code');
            $locationcode = $this->request->getVar('locationcode');
            $m_icd = new ModelMasterObat();
            $row = $m_icd->get_data_obat_pesan($code, $locationcode);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function simpandatasuratpesan_detail()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'name' => [
                    'label' => 'Nama Barang',
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

                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'locationcode' => $this->request->getVar('locationcode_detail'),
                    'destinationcode' => $this->request->getVar('destinationcode_detail'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'qty' => $this->request->getVar('qty'),
                    'uom' => $this->request->getVar('uom'),
                    'qtystock' => $this->request->getVar('qtystock'),
                    'createdby' => $this->request->getVar('createdby_detail'),
                    'createddate' => $this->request->getVar('createddate_detail'),

                ];
                $perawat = new ModelSuratPesananDetail;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail barang telah disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeDetailPesanan()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'DetailObat' => $resume->search_detail_pesanan($journalnumber)
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_form_pesan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus_detail_pesan()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelSuratPesananDetail;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function printpesan()
    {
        $dompdf = new Dompdf();

        $lokasikasir = "GUDANG FARMASI";
        $id = $this->request->getVar('page');
        $pasien = new ModelPasienRanap($this->request);
        $gudang = new ModelDepoSPHeader();
        $row2 = $pasien->get_data_depo_SP($lokasikasir);
        $data = [
            'dataopname' => $gudang->SPheader($id),
            'header1' => $row2['header1'],
            'header2' => $row2['header2'],
            'status' => $row2['status'],
            'alamat' => $row2['alamat'],
            'deskripsi' => $row2['deskripsi'],
            'tampildata' => $gudang->depoSPdetail($id),
        ];


        $html = view('pdf/suratpesangudang', $data);
        $dompdf->loadhtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function DetailDSPesanan($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $gudang = new ModelDepoSPHeader();
        $row = $gudang->SPheaderdetail($id);
        $data = [
            'id' => $row['id'],
            'groups' => $row['groups'],
            'journalnumber' => $row['journalnumber'],
            'documentdate' => $row['documentdate'],
            'lc' => $row['locationcode'],
            'destinationcode' => $row['destinationcode'],
        ];

        return view('depofarmasi/form_amprah_barang_add', $data);
    }

    public function UbahPesanan()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new ModelDepoSPHeader();

            $data = [
                'dataopname' => $m_icd->SPheaderdetail($id),
            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modalsuratpesanan_add', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lokasiruangan()
    {

        $m_auto = new ModelrajalIBS();
        $list = $m_auto->get_list_lokasi_farmasi_ruangan_ranap();
        return $list;
    }

    public function Distribusi()
    {
        $data = [
            'lokasi' => $this->lokasiruangan(),
            'kelompok' => $this->kelompok(),
        ];
        return view('rawatinap/laporan_distribusi_ruangan_ranap', $data);
    }


    public function ambildataDistribusi()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildataDistribusi()
            ];
            $msg = [
                'data' => view('rawatinap/data_laporan_distribusi_ruangan_ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDistribusi()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->search_RegisterDistribusi($search)
            ];

            $msg = [
                'data' => view('rawatinap/data_laporan_distribusi_ruangan_ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function kelompok()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kelompok_obat();
        return $list;
    }
}

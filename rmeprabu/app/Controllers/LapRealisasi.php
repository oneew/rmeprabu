<?php

namespace App\Controllers;

use App\Models\ModelMasterObat;
use App\Models\Model_autocomplete;
use App\Models\ModelTerimaPBFDetail;
use App\Models\ModelDepoSPHeader;
use App\Models\ModelDepoSPDetail;
use App\Models\ModelDistribusiHeader;
use App\Models\ModelDistribusiDetail;
use App\Models\ModelPasienRanap;
use App\Models\Modelrajal;
use App\Models\ModelKartuStock;
use App\Models\Model_autocomplete_obat;
use App\Models\ModelMasterBatch;
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;

use App\Models\ModelDepoSPHeaderNotifikasi;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;



class LapRealisasi extends BaseController
{

    public function index()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('gudangfarmasi/laporan_stok', $data);
    }


    public function caridatastok()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();

            $register = new ModelMasterObat();
            $data = [
                'tampildata' => $register->search_stok_obat($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/data_laporan_stok', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Ranap()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('dashboard/laporan_realisasi_ranap', $data);
    }


    public function ambildataDTPBF()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildataDTPBF()
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_laporan_obat_masuk_pbf', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataRealisasi()
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
                'tampildata' => $register->search_realisasi_ranap($search)
            ];


            $msg = [
                'data' => view('dashboard/data_realiasi_ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function Rajal()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('dashboard/laporan_realisasi_rajal', $data);
    }

    public function caridataRealisasiRajal()
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
                'tampildata' => $register->search_realisasi_rajal($search)
            ];


            $msg = [
                'data' => view('dashboard/data_realiasi_rajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function Distribusi()
    {
        $data = [
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('gudangfarmasi/laporan_distribusi', $data);
    }


    public function ambildataDistribusi()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildataDistribusi()
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_laporan_distribusi', $data)
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
                'data' => view('gudangfarmasi/data_laporan_distribusi', $data)
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

    public function lokasi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi_stock();
        return $list;
    }

    public function kelompok()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_kelompok_obat();
        return $list;
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
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }


    public function KartuStock()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('gudangfarmasi/laporan_kartu_stock', $data);
    }


    public function ambildataKartuStock()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelKartuStock();
            $data = [
                'tampildata' => $register->ambildatakartustock()
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_laporan_kartu_stock', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataKartuStock()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelKartuStock();
            $cek = $register->search_dataKartuStock_sebelum($search);
            $cek_akhir = $register->search_dataKartuStock_sesudah($search);
            $data = [
                'tampildata' => $register->search_dataKartuStock($search),
                'sisasebelum' => ABS($cek['qty']),
                'sisaakhir' => ABS($cek_akhir['qty']),

            ];

            $msg = [
                'data' => view('gudangfarmasi/data_laporan_kartu_stock', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ajax_obat()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete_obat($request);
        $key = $request->getGet('term');
        $term = $this->request->getVar('kelas');
        if ($key <> '') {
            $data = $m_auto->get_list_obat_cari($key);
        }

        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'] . '#' . $row['code'] . '#' . $row['uom'],
                'id' => $row['id'],
                'code' => $row['code'],
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function DistribusiDetail()
    {
        $data = [
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('gudangfarmasi/laporan_distribusi_detail', $data);
    }


    public function ambildataDistribusiDetail()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildataDistribusiDetail()
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_laporan_distribusi_detail', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDistribusiDetail()
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
                'tampildata' => $register->search_RegisterDistribusiDetail_baru($search),
                'tujuanlokasi' => $search['referencelocationcode'],
                'mulaitanggaldistribusi' => $search['mulai'],
                'akhirtanggaldistribusi' => $search['sampai'],
                'obat' => $search['namaobat']
            ];



            $msg = [
                'data' => view('gudangfarmasi/data_laporan_distribusi_detail', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function printdistribusitidakpenuh()
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
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $namafile = $data['header1'];
        $dompdf->stream($namafile, ['Attachment' => 0]);
    }

    public function EksporDataDistribusi()
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //Set Default Teks
        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(10);

        $spreadsheet->getDefaultStyle()
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT)
            ->setWrapText(true);

        // style lebar kolom
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('A')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('B')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('C')
            ->setAutoSize(true);
        $spreadsheet->getActiveSheet()
            ->getColumnDimension('D')
            ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
            ->getColumnDimension('E')
            ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
            ->getColumnDimension('F')
            ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
            ->getColumnDimension('G')
            ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
            ->getColumnDimension('H')
            ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
            ->getColumnDimension('I')
            ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
            ->getColumnDimension('J')
            ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
            ->getColumnDimension('K')
            ->setAutoSize(true);

        $spreadsheet->getActiveSheet()
            ->getColumnDimension('L')
            ->setAutoSize(true);


        //Style Judul table
        $spreadsheet->getActiveSheet()
            ->setCellValue('A1', "DATA DISTRIBUSI GUDANG FARMASI RSUD SYAMSUDIN");

        $spreadsheet->getActiveSheet()
            ->mergeCells("A1:L1");

        $spreadsheet->getActiveSheet()
            ->getStyle('A1')
            ->getFont()
            ->setSize(20);


        // SET judul table
        $spreadsheet->getActiveSheet()
            ->setCellValue('A2', "No")
            ->setCellValue('B2', "Kode")
            ->setCellValue('C2', "Uraian")
            ->setCellValue('D2', "Tanggal")
            ->setCellValue('E2', "No Register")
            ->setCellValue('F2', "Tujuan")
            ->setCellValue('G2', "No.Batch")
            ->setCellValue('H2', "Jumlah")
            ->setCellValue('I2', "Satuan")
            ->setCellValue('J2', "Jumlah Permintaan")
            ->setCellValue('K2', "Jumlah Dipenuhi")
            ->setCellValue('L2', "Jumlah Kekurangan");;

        $styleJudul = [
            'font' => [
                'color' => [
                    'rgb' => '000000'
                ],
                'bold' => true,
                'size' => 18
            ],
            'fill' => [
                'fillType' =>  fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'c9ffe5'
                ]
            ],
        ];



        $spreadsheet->getActiveSheet()
            ->getStyle('A2:L2')
            ->applyFromArray($styleJudul);

        //$search = $this->request->getPost();
        $tujuanlokasi = $this->request->getVar('tujuanlokasi');
        var_dump($tujuanlokasi);
        die();
        $search['mulai'] = '2023-03-20';
        $search['sampai'] = '2023-03-25';
        $distribusi = new ModelDepoSPHeaderNotifikasi();
        $data_distribusi = $distribusi->search_RegisterDDB_ekspor($search);
        $index = 3;
        foreach ($data_distribusi as $data) {
            $spreadsheet->getActiveSheet()
                ->setCellValue('A' . $index, $index - 2)
                ->setCellValue('B' . $index, $data['code'])
                ->setCellValue('C' . $index, $data['name'])
                ->setCellValue('D' . $index, $data['documentdate'])
                ->setCellValue('E' . $index, $data['journalnumber'])
                ->setCellValue('F' . $index, $data['referencelocationcode'])
                ->setCellValue('G' . $index, $data['batchnumber'])
                ->setCellValue('H' . $index, ABS($data['qty']))
                ->setCellValue('I' . $index, $data['uom'])
                ->setCellValue('J' . $index, $data['qtyrequest'])
                ->setCellValue('K' . $index, ABS($data['qty']))
                ->setCellValue('L' . $index, $data['qtyrequest'] - ABS($data['qty']));
            $index++;
        }

        $writer = new Xlsx($spreadsheet);
        $today = date('Ymd');
        $underscore = '_';
        $namafile = 'Data Distribusi Gudang';
        $filename = $namafile . $underscore  . $today;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }


    public function PengeluaranDepo()
    {
        $data = [
            'lokasi' => $this->lokasi_depo(),
            'kelompok' => $this->kelompok(),
        ];
        return view('gudangfarmasi/laporan_pengeluaran_depo', $data);
    }


    public function ambilPengeluaranDepo()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildataPenjualan()
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_laporan_penjualan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataPengeluaranDepo()
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
                'tampildata' => $register->cariambildataPenjualan($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/data_laporan_penjualan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function lokasi_depo()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi_depo();
        return $list;
    }

    public function RekapResepPenelaah()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi_depo(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_rekap_resep_penelaah', $data);
    }


    public function ambildataRekapResepPenelaah()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildatarekap_resep_penelaah()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep_penelaah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataRekapResepPenelaah()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register2 = new ModelMasterObat();

            $register = new ModelTerimaPBFDetail();
            $pasien = new ModelPasienRanap($this->request);
            $lokasi = $search['locationcode'];
            $lokasistok = $register2->get_lokasi_stock($lokasi);
            $lokasistokobat = $lokasistok['name'];
            $lokasikasir = 'GUDANG FARMASI';
            $row2 = $pasien->get_data_distribusi($lokasikasir);

            $data = [
                'tampildata' => $register->search_rekap_resep_penelaah_baru($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];

            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep_penelaah', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RekapResepEntri()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi_depo(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_rekap_resep_entri', $data);
    }


    public function ambildataRekapResepEntri()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $lokasikasir = 'GUDANG FARMASI';
            $pasien = new ModelPasienRanap($this->request);
            $row2 = $pasien->get_data_distribusi($lokasikasir);
            $data = [
                'tampildata' => $register->ambildatarekap_resep_entri()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep_entri', $data),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataRekapResepEntri()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register2 = new ModelMasterObat();

            $register = new ModelTerimaPBFDetail();
            $pasien = new ModelPasienRanap($this->request);
            $lokasi = $search['locationcode'];
            $lokasistok = $register2->get_lokasi_stock($lokasi);
            $lokasistokobat = $lokasistok['name'];
            $lokasikasir = 'GUDANG FARMASI';
            $row2 = $pasien->get_data_distribusi($lokasikasir);

            $data = [
                'tampildata' => $register->search_rekap_resep_entri_baru($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];

            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep_entri', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RekapResepNarkotik()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi_depo(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_rekap_resep_narkotik', $data);
    }


    public function ambildataRekapResepNarkotik()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $lokasikasir = 'GUDANG FARMASI';
            $pasien = new ModelPasienRanap($this->request);
            $row2 = $pasien->get_data_distribusi($lokasikasir);
            $data = [
                'tampildata' => $register->ambildatarekap_resep_narkotik()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep_narkotik', $data),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataRekapResepNarkotik()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register2 = new ModelMasterObat();

            $register = new ModelTerimaPBFDetail();
            $pasien = new ModelPasienRanap($this->request);
            $lokasi = $search['locationcode'];
            $lokasistok = $register2->get_lokasi_stock($lokasi);
            $lokasistokobat = $lokasistok['name'];
            $lokasikasir = 'GUDANG FARMASI';
            $row2 = $pasien->get_data_distribusi($lokasikasir);

            $data = [
                'tampildata' => $register->cariambildatarekap_resep_narkotik($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];



            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep_narkotik', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function RekapResepPsiko()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi_depo(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_rekap_resep_psiko', $data);
    }


    public function ambildataRekapResepPsiko()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $lokasikasir = 'GUDANG FARMASI';
            $pasien = new ModelPasienRanap($this->request);
            $row2 = $pasien->get_data_distribusi($lokasikasir);
            $data = [
                'tampildata' => $register->ambildatarekap_resep_psiko()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep_psiko', $data),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataRekapResepPsiko()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register2 = new ModelMasterObat();

            $register = new ModelTerimaPBFDetail();
            $pasien = new ModelPasienRanap($this->request);
            $lokasi = $search['locationcode'];
            $lokasistok = $register2->get_lokasi_stock($lokasi);
            $lokasistokobat = $lokasistok['name'];
            $lokasikasir = 'GUDANG FARMASI';
            $row2 = $pasien->get_data_distribusi($lokasikasir);

            $data = [
                'tampildata' => $register->cariambildatarekap_resep_psiko($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];



            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep_psiko', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Fixing()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelMasterBatch();
            $row = $m_icd->find($id);

            $data = [
                'id' => $row['id'],
                'batchnumber' => $row['batchnumber'],
                'balance' => round($row['balance']),
                'balance_temp' => round($row['balance_temp']),
                'code' => $row['code'],


            ];
            $msg = [
                'sukses' => view('gudangfarmasi/modalfixingbatch', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function simpanFixing()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar("id");
            $simpandata = [
                'balance_temp' => $this->request->getVar("balance_temp"),
            ];
            $perawat = new ModelMasterBatch;
            $id = $this->request->getVar('id');
            $code = $this->request->getVar('code');
            //$perawat->update($id, $simpandata);
            $perawat->update_code($code, $simpandata);
            $msg = [
                'sukses' => 'Terimakasih'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RanapTMO()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('dashboard/laporan_realisasi_ranap_tmo', $data);
    }

    public function caridataRealisasiTMO()
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
                'tampildata' => $register->search_realisasi_ranap_tmo($search)
            ];


            $msg = [
                'data' => view('dashboard/data_realiasi_ranap_tmo', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

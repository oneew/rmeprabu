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
use App\Models\Model_Persediaan;
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;




class LaporanPersediaanGudangFarmasi extends BaseController
{

    private function _list_jasa($search = null)
    {
        $register = new Model_Persediaan();

        $select = [
            'tampildata' => $register->ambildataobat($search),
            'penambahan' => $register->penambahan($search),
            'pengurangan' => $register->pengurangan($search),
            'saldo_awal' => $register->saldoawal($search),

        ];


        foreach ($select['tampildata'] as $index => $obat) {


            foreach ($select['penambahan'] as $tambah) {
                if ($tambah['code'] == $obat['code']) {
                    $list_tambah['qty'][$index][] = $tambah['qty'];
                    $list_tambah['purchaseprice'][$index][] = $tambah['purchaseprice'];
                }
            }

            foreach ($select['pengurangan'] as $kurang) {
                if ($kurang['code'] == $obat['code']) {
                    $list_kurang['qty'][$index][] = $kurang['qty'];
                    $list_kurang['price'][$index][] = $kurang['price'];
                }
            }

            foreach ($select['saldo_awal'] as $saldo) {
                if ($saldo['code'] == $obat['code']) {
                    $list_saldo['qty'][$index][] = $saldo['stock'];
                    $list_saldo['sistem'][$index][] = $saldo['stocksystem'];
                }
            }





            $PenambahanObat = isset($list_tambah['qty'][$index]) ? array_sum($list_tambah['qty'][$index]) : 0;
            $PenambahanObat_harga = isset($list_tambah['purchaseprice'][$index]) ? array_sum($list_tambah['purchaseprice'][$index]) : 0;

            $PenguranganObat = isset($list_kurang['qty'][$index]) ? array_sum($list_kurang['qty'][$index]) : 0;
            $PenguranganObat_harga = isset($list_kurang['price'][$index]) ? array_sum($list_kurang['price'][$index]) : 0;

            $saldo_awal_real_jumlah = isset($list_saldo['qty'][$index]) ? array_sum($list_saldo['qty'][$index]) : 0;
            $saldo_awal_real = isset($list_saldo['sistem'][$index]) ? array_sum($list_saldo['sistem'][$index]) : 0;

            $data['tampildata'][$index] =
                [
                    'KodeObat' => $obat['code'],
                    'NamaObat' => $obat['name'],
                    'satuan' => $obat['uom'],
                    'jenis' => $obat['types'],
                    'HargaObat' => $obat['purchaseprice'],
                    'SumberDana' => $obat['sumber'],
                    'Ed' => $obat['expireddate'],
                    'PenambahanObatJumlah' => $PenambahanObat,
                    'PenambahanObatHarga' => $PenambahanObat_harga,
                    'PenguranganObatJumlah' => $PenguranganObat,
                    'PenguranganObatHarga' => $PenguranganObat_harga,
                    'saldo_awal_bulan' => $saldo_awal_real_jumlah,


                ];
        }
        return $data;
    }



    public function Distribusi()
    {
        $data = [
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('gudangfarmasi/laporan_persediaan', $data);
    }


    public function ambildataDistribusi()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));



            $register = new ModelTerimaPBFDetail();
            $data = $this->_list_jasa($search);

            $msg = [
                'data' => view('gudangfarmasi/data_laporan_persediaan', $data)
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

            $search['sebelum'] = date('Y-m-d', strtotime(date($search['mulai']) . '- 1 month'));



            $register = new ModelTerimaPBFDetail();
            $data = $this->_list_jasa($search);
            $msg = [
                'data' => view('gudangfarmasi/data_laporan_persediaan', $data)
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

    // public function EksporDataPersediaan()
    // {

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     //Set Default Teks
    //     $spreadsheet->getDefaultStyle()
    //         ->getFont()
    //         ->setName('Times New Roman')
    //         ->setSize(10);

    //     $spreadsheet->getDefaultStyle()
    //         ->getAlignment()
    //         ->setHorizontal(Alignment::HORIZONTAL_LEFT)
    //         ->setWrapText(true);

    //     // style lebar kolom
    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('A')
    //         ->setAutoSize(true);
    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('B')
    //         ->setAutoSize(true);
    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('C')
    //         ->setAutoSize(true);
    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('D')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('E')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('F')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('G')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('H')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('I')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('J')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('K')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('L')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('M')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('N')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('O')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('P')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('Q')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('R')
    //         ->setAutoSize(true);

    //     $spreadsheet->getActiveSheet()
    //         ->getColumnDimension('S')
    //         ->setAutoSize(true);

    //     //Style Judul table
    //     $spreadsheet->getActiveSheet()
    //         ->setCellValue('A1', "LAPORAN PERSEDIAAN GUDANG FARMASI RSUD PRABUMULIH");

    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("A1:G1");

    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("H1:J1");

    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("K1:M1");

    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("N1:P1");

    //     $spreadsheet->getActiveSheet()
    //         ->mergeCells("Q1:S1");


    //     $spreadsheet->getActiveSheet()
    //         ->getStyle('A1')
    //         ->getFont()
    //         ->setSize(20);


    //     // SET judul table
    //     $spreadsheet->getActiveSheet()
    //         ->setCellValue('A2', "No")
    //         ->setCellValue('B2', "Kode Obat")
    //         ->setCellValue('C2', "Nama Obat")
    //         ->setCellValue('D2', "Satuan")
    //         ->setCellValue('E2', "Jenis")
    //         ->setCellValue('F2', "Sumber Dana")
    //         ->setCellValue('G2', "Expired Date")
    //         ->setCellValue('H2', "Volume")
    //         ->setCellValue('I2', "Harga Satuan")
    //         ->setCellValue('J2', "Jumlah")
    //         ->setCellValue('K2', "Volume")
    //         ->setCellValue('L2', "Harga Satuan")
    //         ->setCellValue('M2', "Jumlah")
    //         ->setCellValue('N2', "Volume")
    //         ->setCellValue('O2', "Harga Satuan")
    //         ->setCellValue('P2', "Jumlah")
    //         ->setCellValue('Q2', "Volume")
    //         ->setCellValue('Q2', "Harga Satuan")
    //         ->setCellValue('Q2', "Jumlah")

    //     $styleJudul = [
    //         'font' => [
    //             'color' => [
    //                 'rgb' => '000000'
    //             ],
    //             'bold' => true,
    //             'size' => 18
    //         ],
    //         'fill' => [
    //             'fillType' =>  fill::FILL_SOLID,
    //             'startColor' => [
    //                 'rgb' => 'c9ffe5'
    //             ]
    //         ],
    //     ];



    //     $spreadsheet->getActiveSheet()
    //         ->getStyle('A2:S2')
    //         ->applyFromArray($styleJudul);

    //     $search = $this->request->getPost();
    //     $dateout = explode('-', $search['DateOut']);
    //     $mulai = str_replace('/', '-', $dateout[0]);
    //     $sampai = str_replace('/', '-', $dateout[1]);
    //     $search['mulai'] = date('Y-m-d', strtotime($mulai));
    //     $search['sampai'] = date('Y-m-d', strtotime($sampai));



    //     $register = new ModelTerimaPBFDetail();
    //     $data_persediaan = $this->_list_jasa($search);

    //     $index = 4;
    //     foreach ($data_persediaan as $data) {
    //         $spreadsheet->getActiveSheet()
    //             ->setCellValue('A' . $index, $index - 2)
    //             ->setCellValue('B' . $index, $data['name'])
    //             ->setCellValue('C' . $index, $data['StatusPegawai'])
    //             ->setCellValue('D' . $index, $data['nip'])
    //             ->setCellValue('E' . $index, $data['golongan'])
    //             ->setCellValue('F' . $index, $data['jabatan'])
    //             ->setCellValue('G' . $index, $data['pendidikan']);
    //         $index++;
    //     }

    //     $writer = new Xlsx($spreadsheet);
    //     $today = date('Ymd');
    //     $underscore = '_';
    //     $namafile = 'Data Dokter';
    //     $filename = $namafile . $underscore  . $today;
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     $writer->save('php://output');
    // }
}

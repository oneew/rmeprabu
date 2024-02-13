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
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;



class LaporanFarmasiCL extends BaseController
{

    public function index()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('ibs/laporan_stok', $data);
    }


    public function caridatastok()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();

            $register = new ModelMasterObat();
            $data = [
                'tampildata' => $register->search_stok_obat2023($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/data_laporan_stok', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function InPBF()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('gudangfarmasi/laporan_terima_pbf', $data);
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


    public function caridataDTPBF()
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
                'tampildata' => $register->search_RegisterDTPBF($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/data_laporan_obat_masuk_pbf', $data)
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
        $dompdf->setPaper('A5', 'landscape');
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

    public function caridatastokNonPel()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();

            $register = new ModelMasterObat();
            $data = [
                'tampildata' => $register->search_stok_obat2023($search)
            ];

            $msg = [
                'data' => view('rawatinap/data_laporan_stok_nonpel', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

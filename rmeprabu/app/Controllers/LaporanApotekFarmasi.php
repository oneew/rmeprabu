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
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;



class LaporanApotekFarmasi extends BaseController
{

    public function index()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_stok', $data);
    }


    public function caridatastok()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $lokasikasir = "GUDANG FARMASI";

            $register = new ModelMasterObat();
            $pasien = new ModelPasienRanap($this->request);
            $row2 = $pasien->get_data_distribusi($lokasikasir);
            $lokasi = $search['locationcode'];
            $lokasistok = $register->get_lokasi_stock($lokasi);
            $lokasistokobat = $lokasistok['name'];
            $data = [
                'tampildata' => $register->search_stok_obat($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,

            ];

            $msg = [
                'data' => view('depofarmasi/data_laporan_stok', $data)
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

    public function InDariGudang()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_terima_dari_gudang', $data);
    }


    public function ambildataInDariGudang()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildataInGudang()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_obat_masuk_gudang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataInDariGudang()
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
                'tampildata' => $register->search_dataInDariGudang($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];

            $msg = [
                'data' => view('depofarmasi/data_laporan_obat_masuk_gudang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function InAntarDepo()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_terima_dari_antar_depo', $data);
    }


    public function ambildataInAntarDepo()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildataInGudangAntarDepo()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_obat_masuk_antar_depo', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataInAntarDepo()
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
                'tampildata' => $register->search_dataInDariGudangAntarDepo($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];

            $msg = [
                'data' => view('depofarmasi/data_laporan_obat_masuk_antar_depo', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function OutAntarDepo()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_out_antar_depo', $data);
    }


    public function ambildataOutAntarDepo()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildataOutGudangAntarDepo()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_out_antar_depo', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataOutAntarDepo()
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
                'tampildata' => $register->search_dataOutDariGudangAntarDepo($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];

            $msg = [
                'data' => view('depofarmasi/data_laporan_out_antar_depo', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RekapResep()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_rekap_resep', $data);
    }


    public function ambildataRekapResep()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildatarekap_resep()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataRekapResep()
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
                'tampildata' => $register->search_rekap_resep($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];

            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_resep', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RekapResepPenelaah()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
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
                'tampildata' => $register->search_rekap_resep_penelaah($search),
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

    public function RekapRatingObat()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
            'kelompok' => $this->kelompok(),
        ];
        return view('depofarmasi/laporan_rekap_rating_obat', $data);
    }


    public function ambildataRekapRatingObat()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelTerimaPBFDetail();
            $data = [
                'tampildata' => $register->ambildatarekap_rating_obat()
            ];
            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_rating_obat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function caridataRekapRatingObat()
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
                'tampildata' => $register->search_rekap_rating_obat($search),
                'header1' => $row2['header1'],
                'header2' => $row2['header2'],
                'status' => $row2['status'],
                'alamat' => $row2['alamat'],
                'lokasi' => $lokasistokobat,
            ];

            $msg = [
                'data' => view('depofarmasi/data_laporan_rekap_rating_obat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

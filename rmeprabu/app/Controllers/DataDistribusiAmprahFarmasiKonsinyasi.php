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
use App\Models\ModelDepoSPHeaderNotifikasi;
use CodeIgniter\HTTP\Request;
use Config\Services;
use Dompdf\Dompdf;



class DataDistribusiAmprahFarmasiKonsinyasi extends BaseController
{

    public function index()
    {
        $gudang = new ModelMasterObat();
        $data = [
            'kelompok' => $gudang->kelompokobat(),
            'lokasi' => $this->lokasi(),
        ];

        echo view('gudangfarmasi/form_distribusi_amprah_barang', $data);
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

    public function simpandatadistribusi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'referencenumber' => [
                    'label' => 'No Permintaan Tidak Boleh Kosong',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'referencenumber' => $validation->getError('referencenumber')
                    ]
                ];
            } else {

                $db = db_connect();
                $groups = $this->request->getVar('groups');
                $tahun = $this->request->getVar('documentyear');
                $locationcode = $this->request->getVar('locationcode');
                $query = $db->query("SELECT MAX(journalnumber) as kode_jurnal, MAX(numberseq)as noantrian FROM transaksi_farmasi_distribusi_header WHERE documentyear='$tahun' AND locationcode='$locationcode' LIMIT 1");

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
                $tanda = 'BDB';
                $tahun = $this->request->getVar('documentyear');
                $potongtahun = substr($tahun, 2, 2);

                $newkode = $tanda . $underscore . $locationcode . $underscore . $potongtahun . $underscore . sprintf('%07s', $nourut);

                if ($antrian == "") {
                    $nourutantrian = '1';
                } else {
                    $nourutantrian = (int)($antrian);
                    $nourutantrian++;
                }

                $no_antrian = sprintf($nourutantrian);
                $locationcode = $this->request->getVar('locationcode');
                $locationname = $this->request->getVar('locationname');
                $documentdate = $this->request->getVar('documentdate');
                $referencelocationcode = $this->request->getVar('referencelocationcode');
                $referencelocationname = $this->request->getVar('referencelocationname');
                $referenceuserid = $this->request->getVar('referenceuserid');
                $referencedate = $this->request->getVar('referencedate');
                $referencenumber = $this->request->getVar('referencenumber');

                $simpandata = [
                    'journalnumber' => $newkode,
                    'documentdate' => $this->request->getVar('documentdate'),
                    'documentyear' => $this->request->getVar('documentyear'),
                    'referencenumber' => $referencenumber,
                    'locationcode' => $locationcode,
                    'locationname' => $locationname,
                    'referenceuserid' => $referenceuserid,
                    'referencedate' => $referencedate,
                    'referencelocationcode' => $referencelocationcode,
                    'referencelocationname' => $referencelocationname,
                    'numberseq' => $no_antrian,
                    'createdby' => $this->request->getVar('createdby'),
                    'createddate' => $this->request->getVar('createddate'),
                ];
                $perawat = new ModelDistribusiHeader();
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Dokumen Distribusi Telah Dibuat, Silahkan Isi Detail Barang',
                    'journalnumber' => $newkode,
                    'locationcode' => $locationcode,
                    'locationname' => $locationname,
                    'referencelocationcode' => $referencelocationcode,
                    'referencelocationname' => $referencelocationname,
                    'documentdate' => $documentdate,
                    'referencenumber' => $referencenumber,
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

    public function Search_SP()
    {
        if ($this->request->isAJAX()) {

            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->caridataobat(),
                'locationcode' => $locationcode,
            ];
            $msg = [
                'data' => view('gudangfarmasi/modalcarisp', $data)
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
                'data' => view('depofarmasi/cariobat', $data)
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
                'tampildata' => $gudang->search_DataObat_amprah($search),
                'locationcode' => $locationcode,
            ];

            $msg = [
                'data' => view('depofarmasi/cariobat', $data)
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
            $row = $m_icd->get_data_obat_depo_sp($code, $locationcode);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function simpandatadistribusi_detail()
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

                $price = $this->request->getVar('price');
                $jumlah = $this->request->getVar('qty');
                $qty = -1 * $jumlah;
                $subtotal = $price * $qty;

                $simpandata = [

                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'documentdate' => $this->request->getVar('documentdate_detail'),
                    'referencenumber' => $this->request->getVar('referencenumber_detail'),
                    'referencelocationcode' => $this->request->getVar('referencelocationcode_detail'),
                    'referencelocationname' => $this->request->getVar('referencelocationname_detail'),
                    'locationcode' => $this->request->getVar('locationcode_detail'),
                    'locationname' => $this->request->getVar('locationname_detail'),
                    'code' => $this->request->getVar('code'),
                    'name' => $this->request->getVar('name'),
                    'batchnumber' => $this->request->getVar('batchnumber'),
                    'expireddate' => $this->request->getVar('expireddate'),
                    'qtyrequest' => $this->request->getVar('qtyrequest'),
                    'qty' => $qty,
                    'uom' => $this->request->getVar('uom'),
                    'price' => $this->request->getVar('price'),
                    'subtotal' => $subtotal,
                    'createdby' => $this->request->getVar('createdby_detail'),
                    'createddate' => $this->request->getVar('createddate_detail'),

                ];
                $perawat = new ModelDistribusiDetail;
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

    public function resumeDistribusi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelTerimaPBFDetail();
            $journalnumber = $this->request->getVar('journalnumber');
            $data = [
                'DetailObat' => $resume->search_detail_distribusi($journalnumber)
            ];
            $msg = [
                'data' => view('gudangfarmasi/data_form_distribusi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus_detail_distribusi()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelDistribusiDetail;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function DDA()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
        ];
        return view('gudangfarmasi/registerDDA', $data);
    }

    public function ambildataDDA()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelDepoSPHeader();
            $data = [
                'tampildata' => $register->ambildataDDA()
            ];
            $msg = [
                'data' => view('gudangfarmasi/dataregisterDDA', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDDA()
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
                'tampildata' => $register->search_RegisterDDA($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/dataregisterDDA', $data)
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

    public function DetailDDA($id = '')
    {

        $id = $this->request->getVar('id');
        $m_icd = new ModelPasienRanap($this->request);
        $row = $m_icd->get_data_DDA($id);
        $data = [
            'id' => $row['id'],
            'journalnumber' => $row['journalnumber'],
            'referencenumber' => $row['referencenumber'],
            'locationcode' => $row['locationcode'],
            'locationname' => $row['locationname'],
            'referencelocationname' => $row['referencelocationname'],
            'referencelocationcode' => $row['referencelocationcode'],
            'referencedate' => $row['referencedate'],
            'referenceuserid' => $row['referenceuserid'],
        ];

        return view('gudangfarmasi/form_distribusi_amprah_barang_add', $data);
    }



    public function lokasi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi_distribusi();
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
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            // var_dump($search['mulai']);
            // var_dump($search['sampai']);
            // die();

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

    public function detailSP()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $m_icd = new ModelDistribusiHeader();
            $row = $m_icd->get_data_permintaan_amprah($id);
            echo json_encode($row);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function Search_Obat_Amprah()
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

    public function Search_BacthNumber()
    {
        if ($this->request->isAJAX()) {
            $code = $this->request->getVar('code');
            $locationcode = $this->request->getVar('locationcode');
            $gudang = new ModelMasterObat();
            $data = [
                'tampildata' => $gudang->get_list_BacthNumber_distribusi($code, $locationcode),
                'lokasi' => $locationcode,
            ];
            $msg = [
                'data' => view('gudangfarmasi/modalcaribatchnumber_distribusi', $data)
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

    public function DSP()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
        ];
        return view('gudangfarmasi/registerDSPKonsinyasi', $data);
    }

    public function ambildataDSP()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelDepoSPHeaderNotifikasi();
            $data = [
                'tampildata' => $register->ambildataDSPKonsinyasi()
            ];
            $msg = [
                'data' => view('gudangfarmasi/dataregisterDSPKonsinyasi', $data)
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

            $register = new ModelDepoSPHeaderNotifikasi();
            $data = [
                'tampildata' => $register->search_RegisterDSPKonsinyasi($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/dataregisterDSPKonsinyasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function DDB()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
        ];
        return view('gudangfarmasi/registerDDB', $data);
    }

    public function ambildataDDB()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelDepoSPHeaderNotifikasi();
            $data = [
                'tampildata' => $register->ambildataDDB()
            ];
            $msg = [
                'data' => view('gudangfarmasi/dataregisterDDB', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDDB()
    {
        if ($this->request->isAJAX()) {
            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelDepoSPHeaderNotifikasi();
            $data = [
                'tampildata' => $register->search_RegisterDDB($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/dataregisterDDB', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusDist()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $TNO = new ModelDistribusiHeader;
            $TNO->delete($id);

            $msg = [
                'sukses' => "Data Tindakan dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }


    public function DSPNonACC()
    {
        $data = [
            'supplier' => $this->supplier(),
            'lokasi' => $this->lokasi(),
        ];
        return view('gudangfarmasi/registerDSPNonAcc', $data);
    }

    public function ambildataDSPNonACC()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelDepoSPHeaderNotifikasi();
            $data = [
                'tampildata' => $register->ambildataDSPNonAcc()
            ];
            $msg = [
                'data' => view('gudangfarmasi/dataregisterDSPNonAcc', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataDSPNonACC()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelDepoSPHeaderNotifikasi();
            $data = [
                'tampildata' => $register->search_RegisterDSPNonAcc($search)
            ];

            $msg = [
                'data' => view('gudangfarmasi/dataregisterDSPNonAcc', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

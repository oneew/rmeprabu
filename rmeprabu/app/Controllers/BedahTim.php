<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_icd;
// use App\Models\Modelranap;
use App\Models\Modeledukasibedahtim;
use App\Models\Model_autocomplete;
use App\Models\ModelDetailibs;
use App\Models\Modeledukasibedah;
use App\Models\Modeledukasi;
use Config\Services;

class BedahTim extends Controller
{

    public function listjadwaloperasi()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modeledukasibedah();

            $journalnumber = $this->request->getVar('journalnumber');

            $data = [
                'tampildata' => $perawat->where('journalnumber', $journalnumber)
                    ->orderBy('id', 'DESC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/datajadwaloperasibaruinputtim', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function formedittim()
    {
        if ($this->request->isAJAX()) {


            $id = $this->request->getVar('id');

            $perawat = new Modeledukasibedah();

            $db = db_connect();



            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'id_tprod' => $row['id_tprod'],
                'journalnumber' => $row['journalnumber'],
                'pasienid' => $row['pasienid'],
                'pasienname' => $row['pasienname'],
                'referencenumber' => $row['referencenumber'],
                'paymentmethod' => $row['paymentmethod'],
                'cases' => $row['cases'],
                'ibsdoktername' => $row['ibsdoktername'],
                'ibsanestesiname' => $row['ibsanestesiname'],
                'name' => $row['name'],
                'groupname' => $row['groupname'],
                'room' => $row['room'],
                'jenis_anestesi' => $row['jenis_anestesi'],
                'diagnosa_prabedah' => $row['diagnosa_prabedah'],
                'dt_advice_op' => $row['dt_advice_op'],



            ];
            $msg = [
                'sukses' => view('ibs/inputtim', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandatabanyak()
    {
        if ($this->request->isAJAX()) {

            $id_tprod = $this->request->getVar('id_tprod');
            $journalnumber = $this->request->getVar('journalnumber');
            $referencenumber = $this->request->getVar('referencenumber');
            $pasienid = $this->request->getVar('pasienid');
            $pasienname = $this->request->getVar('pasienname');
            $paymentmethod = $this->request->getVar('paymentmethod');
            $cases = $this->request->getVar('cases');
            $name = $this->request->getVar('name');
            $ibsdoktername = $this->request->getVar('ibsdoktername');
            $ibsanestesiname = $this->request->getVar('ibsanestesiname');
            $jenis_anestesi = $this->request->getVar('jenis_anestesi');
            $room = $this->request->getVar('room');
            $dt_advice_op = $this->request->getVar('dt_advice_op');
            $diagnosa_prabedah = $this->request->getVar('diagnosa_prabedah');
            $user = $this->request->getVar('user');
            $groupname = $this->request->getVar('groupname');
            $id_book_operasi = $this->request->getVar('id_book_operasi');
            $nama = $this->request->getVar('nama');
            $peran = $this->request->getVar('jabatan');

            $jmldata =  count($nama);
            for ($i = 0; $i < $jmldata; $i++) {

                $perawat = new Modeledukasibedahtim;
                $perawat->insert([
                    'id_tprod' => $id_tprod[$i],
                    'journalnumber' => $journalnumber[$i],
                    'referencenumber' => $referencenumber[$i],
                    'pasienid' => $pasienid[$i],
                    'pasienname' => $pasienname[$i],
                    'paymentmethod' => $paymentmethod[$i],
                    'cases' => $cases[$i],
                    'name' => $name[$i],
                    'ibsdoktername' => $ibsdoktername[$i],
                    'ibsanestesiname' => $ibsanestesiname[$i],
                    'jenis_anestesi' => $jenis_anestesi[$i],
                    'room' => $room[$i],
                    'dt_advice_op' => $dt_advice_op[$i],
                    'diagnosa_prabedah' => $diagnosa_prabedah[$i],
                    'user' => $user[$i],
                    'groupname' => $groupname[$i],
                    'id_book_operasi' => $id_book_operasi[$i],
                    'pelaksana' => $nama[$i],
                    'peran' => $peran[$i],
                ]);
            }

            $msg = [
                'sukses' => "$jmldata petugas sudah ditambahkan ke tim pelaksana operasi"
            ];
            echo json_encode($msg);
        }
    }



    public function datatim()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modeledukasibedahtim();

            $journalnumber = $this->request->getVar('journalnumber');

            $data = [
                'tampildata' => $perawat->where('journalnumber', $journalnumber)
                    ->orderBy('pelaksana', 'ASC')
                    ->findAll()
            ];
            $msg = [
                'data' => view('ibs/data_tim_operasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function hapustim()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new Modeledukasibedahtim;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data jadwal Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }


    public function keluar($page = '')
    {
        $journalnumber = $this->request->getVar('page');


        $data = [
            'journalnumber' => $journalnumber,
        ];

        echo view('layout/pagesalah', $data);
    }


    public function simpanedukasi()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'pemberiinformasi' => [
                    'label' => 'Nama Pemberi Informasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ],
                'penerimainformasi' => [
                    'label' => 'Nama Penerima Informasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus Diisi!'
                    ]

                ],
                'diagnosis' => [
                    'label' => 'Diagnosis pasien',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus Diisi!'
                    ]

                ],
                'kondisipasien' => [
                    'label' => 'Kondisi pasien sebelum dioperasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus Diisi!'
                    ]

                ],
                'name' => [
                    'label' => 'Nama tindakan yang disulkan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus Diisi!'
                    ]

                ],
                'bilatidakditindak' => [
                    'label' => 'Jika tidak dilakukan tindakan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' {field} Harus Diisi!'
                    ]
                ]



            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'pemberiinformasi' => $validation->getError('pemberiinformasi'),
                        'penerimainformasi' => $validation->getError('penerimainformasi'),
                        'diagnosis' => $validation->getError('diagnosis'),
                        'kondisipasien' => $validation->getError('kondisipasien'),
                        'name' => $validation->getError('name'),
                        'bilatidakditindak' => $validation->getError('bilatidakditindak')
                    ]
                ];
            } else {

                $simpandata = [

                    'journalnumber' => $this->request->getVar('journalnumber'),
                    'referencenumber' => $this->request->getVar('referencenumber'),
                    'pasienid' => $this->request->getVar('pasienid'),
                    'pasienname' => $this->request->getVar('pasienname'),
                    'pasiengender' => $this->request->getVar('pasiengender'),
                    'roomname' => $this->request->getVar('roomname'),
                    'pasiendateofbirth' => $this->request->getVar('pasiendateofbirth'),
                    'pemberiinformasi' => $this->request->getVar('pemberiinformasi'),
                    'penerimainformasi' => $this->request->getVar('penerimainformasi'),
                    'ibsdoktername' => $this->request->getVar('ibsdoktername'),
                    'ibsanestesiname' => $this->request->getVar('ibsanestesiname'),
                    'diagnosis' => $this->request->getVar('diagnosis'),
                    'kondisipasien' => $this->request->getVar('kondisipasien'),
                    'name' => $this->request->getVar('name'),
                    'manfaattindakan' => $this->request->getVar('manfaattindakan'),
                    'tatacara' => $this->request->getVar('tatacara'),
                    'risikotindakan' => $this->request->getVar('risikotindakan'),
                    'komplikasitindakan' => $this->request->getVar('komplikasitindakan'),
                    'dampaktindakan' => $this->request->getVar('dampaktindakan'),
                    'prognosistindakan' => $this->request->getVar('prognosistindakan'),
                    'alternatif' => $this->request->getVar('alternatif'),
                    'bilatidakditindak' => $this->request->getVar('bilatidakditindak'),
                    'id_tproh' => $this->request->getVar('id_tproh'),
                    'signature' => $this->request->getVar('signature'),

                ];

                $ibs = new Modeledukasi;
                $ibs->insert($simpandata);
                $msg = [
                    'sukses' => 'Detail Edukasi Bedah Berhasil Disimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\ModelPelayananPoli;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use Config\Services;
use CodeIgniter\HTTP\Request;

use Dompdf\Dompdf;

class RL extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL33', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl33_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL33(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/data_rl33', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoli()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl33_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL33($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/data_rl33', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL36()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL36', $data);
    }

    public function ambildataRL36()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl36_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildataibs_rekapjenisop(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/data_rl36', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL36()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl36_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_RegisterIBS_rekapjenisop($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/data_rl36', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL37()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL37', $data);
    }

    public function ambildataRL37()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl37_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL37(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/data_rl37', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL37()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl37_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL37($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/data_rl37', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL38()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL38', $data);
    }

    public function ambildataRL38()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl38_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL38(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/data_rl38', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL38()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl38_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL38($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/data_rl38', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL39()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL39', $data);
    }

    public function ambildataRL39()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl39_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL39(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/data_rl39', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL39()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl39_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL39($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/data_rl39', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL311Rajal()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL311Rajal', $data);
    }

    public function ambildataRL311Rajal()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl311Rajal_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL311Rajal(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/data_rl311Rajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL311Rajal()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl311Rajal_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL311Rajal($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/data_rl311Rajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL311Ranap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL311Ranap', $data);
    }

    public function ambildataRL311Ranap()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl311Ranap_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL311Ranap(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/data_rl311Ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL311Ranap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl311Ranap_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL311Ranap($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/data_rl311Ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL310()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL310', $data);
    }

    public function ambildataRL310()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl310_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL310(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/data_rl310', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL310()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl310_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL310($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/data_rl310', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL314()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL314', $data);
    }

    public function ambildataRL314()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl314_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL314(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];



            $msg = [
                'data' => view('rekammedik/dataRL314', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL314()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl314_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL314($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataRL314', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL314IGD()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL314IGD', $data);
    }

    public function ambildataRL314IGD()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl314IGD_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL314IGD(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];



            $msg = [
                'data' => view('rekammedik/dataRL314IGD', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL314IGD()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl314IGD_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL314IGD($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataRL314IGD', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL314Ranap()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL314Ranap', $data);
    }

    public function ambildataRL314Ranap()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl314Ranap_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL314Ranap(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/dataRL314Ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL314Ranap()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl314Ranap_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL314Ranap($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataRL314Ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function RL51()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL51', $data);
    }

    public function ambildataRL51()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl51_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL51(),
                'tampildataIGD' => $register->ambildata_RL51IGD(),
                'tampildataRanap' => $register->ambildata_RL51Ranap(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/dataRL51', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL51()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl51_kop($lokasikasir);

            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL51($search),
                'tampildataIGD' => $register->search_Register_RL51IGD($search),
                'tampildataRanap' => $register->search_Register_RL51Ranap($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataRL51', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL4A()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL4A', $data);
    }

    public function ambildataRL4A()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl4A_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL4A(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/dataRL4A', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL4A()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl4A_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL4A($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataRL4A', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL4B()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL4B', $data);
    }

    public function ambildataRL4B()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl4B_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL4B(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/dataRL4B', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL4B()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl4B_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL4B($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataRL4B', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function RL31()
    {
        $data = [
            'list' => $this->data_payment(),
            'poli' => $this->smf(),
            'dokter' => $this->_data_dokter(),
        ];
        return view('rekammedik/registerRL31', $data);
    }

    public function ambildataRL31()
    {
        if ($this->request->isAJAX()) {

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl31_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->ambildata_RL31(),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];
            $msg = [
                'data' => view('rekammedik/dataRL31', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoliRL31()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $lokasikasir = "INSTALASI REKAM MEDIK";
            $m_icd = new ModelPasienRanap($this->request);
            $row = $m_icd->get_data_rl31_kop($lokasikasir);
            $register = new ModelPelayananPoli();
            $data = [
                'tampildata' => $register->search_Register_RL31($search),
                'header1' => $row['header1'],
                'header2' => $row['header2'],
                'status' => $row['status'],
                'alamat' => $row['alamat'],
                'deskripsi' => $row['deskripsi'],
                'kelompok' => $row['kelompok']
            ];

            $msg = [
                'data' => view('rekammedik/dataRL31', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }






    public function data_payment()
    {

        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_payment();
        return $list;
    }

    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli();
        return $list;
    }

    public function poli_igd()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli_igd();
        return $list;
    }

    public function smf_ranap()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_smf_real();
        return $list;
    }


    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }
}

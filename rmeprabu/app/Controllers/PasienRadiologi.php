<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ModelPasienRadiologi;
use App\Models\ModelRawatJalanDaftar;
use Config\Services;

class PasienRadiologi extends Controller
{
    public function index()
    {
        $db = db_connect();
        $smf = $db->query("SELECT * FROM pelayanan_smf WHERE vclaimcode IS NOT NULL ORDER BY name DESC")->getResult();
        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_payment();

        $data = [
            'smf' => $smf,
            'list' => $list
        ];
        return view('radiologi/index', $data);
    }

    public function ambildata() {
        $request = Services::request();
        $data = new ModelPasienRadiologi($request);
        $data->select('id, groups, pasienid, pasienname, pasiengender, paymentmethod, roomname, validation, note, createddate, documentdate, doktername, smfname, status_periksa, classroom, journalnumber');
        
        helper('radiologi_detail_helper');

        $msg = [
            'data' => view('radiologi/data_pasien_rad', [
                'list_patient' => $data->where('groups', 'RAD')
                                        ->where('documentdate', date('Y-m-d'))
                                        ->orderBy('id', 'DESC')
                                        ->findAll(),
            ])
        ];

        return json_encode($msg);
    }

    public function caridatapasien() {
        if ($this->request->isAJAX()) {
            helper('radiologi_detail');
            $request = Services::request();
            $search = $this->request->getPost();
            if ($search['DateOut'] != "") {
                $dateout = explode('-', $search['DateOut']);
                $mulai = str_replace('/', '-', $dateout[0]);
                $sampai = str_replace('/', '-', $dateout[1]);
    
                $search['mulai'] = date('Y-m-d', strtotime($mulai));
                $search['sampai'] = date('Y-m-d', strtotime($sampai));
            }

            $data = new ModelPasienRadiologi($request);
            $data->join('transaksi_pelayanan_penunjang_detail' , 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
            $data->select('transaksi_pelayanan_penunjang_header.id,
            transaksi_pelayanan_penunjang_header.groups,
            transaksi_pelayanan_penunjang_header.pasienid,
            transaksi_pelayanan_penunjang_header.pasienname,
            transaksi_pelayanan_penunjang_header.pasiengender,
            transaksi_pelayanan_penunjang_header.paymentmethod,
            transaksi_pelayanan_penunjang_header.roomname,
            transaksi_pelayanan_penunjang_header.validation,
            transaksi_pelayanan_penunjang_header.note,
            transaksi_pelayanan_penunjang_header.createddate,
            transaksi_pelayanan_penunjang_header.documentdate,
            transaksi_pelayanan_penunjang_header.doktername,
            transaksi_pelayanan_penunjang_header.classroom,
            transaksi_pelayanan_penunjang_header.status_periksa,
            transaksi_pelayanan_penunjang_header.smfname,
            transaksi_pelayanan_penunjang_header.journalnumber,
            transaksi_pelayanan_penunjang_detail.name,
            transaksi_pelayanan_penunjang_detail.kelompokLab');
            $data->where('transaksi_pelayanan_penunjang_header.groups', 'RAD');

            if ($this->request->getVar('patientname') != "") {
                $data->like('transaksi_pelayanan_penunjang_header.pasienname', $this->request->getVar('patientname'), 'both');
            }

            if ($this->request->getVar('norm') != "") {
                $data->where('transaksi_pelayanan_penunjang_header.pasienid', $this->request->getVar('norm'));
            }

            if ($this->request->getVar('metodepembayaran') != "") {
                $data->where('transaksi_pelayanan_penunjang_header.paymentmethod', $this->request->getVar('metodepembayaran'));
            }

            if ($this->request->getVar('DateOut') != "") {
                $data->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
                $data->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);
            }

            if ($this->request->getVar('kelompok_rad')) {
                $data->where('transaksi_pelayanan_penunjang_detail.kelompokLab', $this->request->getVar('kelompok_rad'));
            }
            
            $msg = [
                'data' => view('radiologi/data_pasien_rad', [
                    'list_patient' => $data->orderBy('transaksi_pelayanan_penunjang_header.id', 'DESC')
                                            ->groupBy('transaksi_pelayanan_penunjang_header.journalnumber')
                                            ->findAll(),
                ])
            ];
    
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function Expertise()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('radiologi/registerexpertise', $data);
    }

    public function ambildataExpertise()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->get_expertise()
            ];
            $msg = [
                'data' => view('radiologi/dataexpertise', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataExpertise()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);

            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->search_expertise($search)
            ];
            $msg = [
                'data' => view('radiologi/dataexpertise', $data)
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

    public function ubahStatus() {
        if ($this->request->isAJAX()) {
            $request = Services::request();

            $data = new ModelPasienRadiologi($request);
            if ($this->request->getVar('status') == 'sedang') {
                $data->update($this->request->getVar('id'),[
                    'status_periksa' => 'sedang',
                    'tanggal_sedang_periksa' => date('Y-m-d H:i:s'),
                    'tanggal_sudah_periksa' => null,
                ]);
            }

            if ($this->request->getVar('status') == 'sudah') {
                $data->update($this->request->getVar('id'),[
                    'status_periksa' => 'sudah',
                    'tanggal_sudah_periksa' => date('Y-m-d H:i:s'),
                ]);
            }
            $msg = [
                'sukses' => 'Status pemeriksaan berhasil diubah',
            ];
    
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusBlanko() {
        if ($this->request->isAJAX()) {
            $request = Services::request();

            $data = new ModelPasienRadiologi($request);
            $get_data = $data->find($this->request->getVar('id'));
            $data->delete_detail($get_data['journalnumber']);
            $data->delete($this->request->getVar('id'));
            $msg = [
                'sukses' => 'Blanko berhasil dihapus',
            ];
    
            return json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

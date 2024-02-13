<?php

namespace App\Controllers;


use App\Models\Modelperawat;

class perawat extends BaseController
{
    public function index()
    {
        return view('ibs/data_perawat');
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $perawat = new Modelperawat();
            $data = [
                'tampildata' => $perawat->findAll()
            ];
            $msg = [
                'data' => view('ibs/dataperawat', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function formtambah()
    {
        if ($this->request->isAJAX()) {

            $db = db_connect();
            $listjabatan = $db->query("SELECT jabatan FROM jabatan_perawat ORDER BY jabatan")->getResult();
            $data2 = [
                'jabatan' => $listjabatan
            ];
            $msg = [
                'data' => view('ibs/modaltambah', $data2)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    //--------------------------------------------------------------------

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama Perawat Penata',
                    'rules' => 'required|is_unique[daftar_perawat.nama]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} tidak boleh sama'
                    ]

                ],
                'kelompok' => [
                    'label' => 'Kelompok Perawat Penata',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'kelompok' => $validation->getError('kelompok')
                    ]
                ];
            } else {
                $simpandata = [
                    'nama' => $this->request->getVar('nama'),
                    'jabatan' => $this->request->getVar('jabatan'),
                    'kelompok' => $this->request->getVar('kelompok'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),

                ];
                $perawat = new Modelperawat;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Data Perawat Penata Berhasil tersimpan'
                ];
            }
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function formedit()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');

            $perawat = new Modelperawat;
            $row = $perawat->find($id);
            $data = [
                'id' => $row['id'],
                'nama' => $row['nama'],
                'jabatan' => $row['jabatan'],
                'kelompok' => $row['kelompok'],
                'tanggal_lahir' => $row['tanggal_lahir'],
                'address' => $row['address'],
                'area' => $row['area'],
                'locationname' => $row['locationname'],
                'lokasi' => $this->locationname(),
            ];
            $msg = [
                'sukses' => view('ibs/modaledit', $data)
            ];
            echo json_encode($msg);
        }
    }


    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $simpandata = [
                'nama' => $this->request->getVar('nama'),
                'area' => $this->request->getVar('area'),
                'locationname' => $this->request->getVar('locationname'),
                'address' => $this->request->getVar('address'),

            ];
            $perawat = new Modelperawat;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Berhasil diupdate'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new Modelperawat;
            $perawat->delete($id);

            $msg = [
                'sukses' => "Data Perawat Penata dengan ID : $id Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function formtambahbanyak()
    {
        if ($this->request->isAJAX()) {
            $data = ['lokasi' => $this->locationname()];
            $msg = [
                'data' => view('ibs/formtambahbanyak', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function simpandatabanyak()
    {
        if ($this->request->isAJAX()) {
            $nama = $this->request->getVar('nama');
            $area = $this->request->getVar('area');
            $locationname = $this->request->getVar('locationname');
            $address = $this->request->getVar('address');

            $jmldata =  count($nama);
            for ($i = 0; $i < $jmldata; $i++) {

                $perawat = new Modelperawat;
                $perawat->insert([
                    'nama' => $nama[$i],
                    'area' => $area[$i],
                    'locationname' => $locationname[$i],
                    'address' => $address[$i],
                ]);
            }

            $msg = [
                'sukses' => "$jmldata data berhasil ditambah"
            ];
            echo json_encode($msg);
        }
    }

    public function locationname()
    {

        $m_auto = new Modelperawat();
        $list = $m_auto->get_list_locationname();
        return $list;
    }
}

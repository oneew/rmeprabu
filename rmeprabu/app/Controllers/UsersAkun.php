<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Modelrajal;
use App\Models\ModelAkunBaru;
use App\Models\UserModelLokasi;

use Config\Services;

class UsersAkun extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //lakukan validasi
            $rules = [

                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',

            ];

            //fungsi validateUser terdapat pada Validation\UserRules.php
            $errors = [
                'password' => [
                    'validateUser' => 'Email atau Password salah'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {


                $model = new UserModel();
                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                $this->setUserMethod($user);
                $email = \Config\Services::email();


                $tujuan = $this->request->getVar('email');
                $html = view('layout/logininfo2');

                $email->setFrom('simrsmuaraenim@gmail.com', 'Informasi Login Aplikasi SIMRS');
                $email->setTo($tujuan);
                $email->setSubject('Informasi Login Aplikasi SIMRS');
                $email->setMessage($html);
                $email->send();

                return redirect()->to(base_url() . '/Abie/HalamanUtama');
            }
        }


        return view('layout/login', $data);
    }

    private function setUserMethod($user)
    {
        $data = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'level' => $user['level'],
            'locationname' => $user['locationname'],
            'locationcode' => $user['locationcode'],
            'isLoggedIn' => true,

        ];
        session()->set($data);
        return true;
    }



    public function register()
    {
        $data = [
            'lokasi' => $this->lokasi(),
            'levelakses' => $this->listlevel()
        ];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //lakukan validasi
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[70]',
                'lastname' => 'required|min_length[3]|max_length[70]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
                'locationname' => 'required',
                'locationcode' => 'required',
                'level' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {


                $model = new UserModel();

                $newData = [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'locationname' => $this->request->getVar('locationname'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'level' => $this->request->getVar('level'),
                ];
                $model->save($newData);
                $sesson = session();
                $sesson->setFlashdata('success', 'Registrasi Berhasil');
                return redirect()->to(base_url() . '/UsersAkun/register');
            }
        }
        echo view('layout/registerakun', $data);
    }

    public function profile()
    {
        $data = [];
        helper(['form']);
        $model = new UserModel();
        if ($this->request->getMethod() == 'post') {
            //lakukan validasi
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
            ];

            if ($this->request->getPost('password') != '') {
                $rules['password'] = 'required|min_length[8]|max_length[255]';
                $rules['password_confirm'] = 'matches[password]';
            }



            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {




                $newData = [
                    'id' => session()->get('id'),
                    'firstname' => $this->request->getPost('firstname'),
                    'lastname' => $this->request->getPost('lastname'),
                ];

                if ($this->request->getPost('password') != '') {
                    $newData['password'] = $this->request->getPost('password');
                }



                $model->save($newData);

                session()->setFlashdata('success', 'Data Berhasil Diubah');
                return redirect()->to(base_url() . '/Users/profile');
            }
        }

        $data['user'] = $model->where('id', session()->get('id'))->first();
        return view('layout/profile', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url() . '/');
    }

    public function logininfo()
    {
        return view('layout/logininfo2');
    }

    public function lokasi()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_lokasi();
        return $list;
    }

    public function listlevel()
    {

        $m_auto = new ModelAkunBaru();
        $list = $m_auto->get_list_level();
        return $list;
    }

    public function RegisterAkunSimrs()
    {
        $data = [
            'lokasi' => $this->lokasi(),
            'levelakses' => $this->listlevel()
        ];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //lakukan validasi
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',
                'locationname' => 'required',
                'locationcode' => 'required',
                'level' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {


                $model = new UserModel();

                $newData = [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'locationname' => $this->request->getVar('locationname'),
                    'locationcode' => $this->request->getVar('locationcode'),
                    'level' => $this->request->getVar('level'),
                ];
                $model->save($newData);
                $sesson = session();
                $sesson->setFlashdata('success', 'Registrasi Berhasil');
                return redirect()->to(base_url() . '/UsersAkun/register');
            }
        }
        echo view('layout/registerakun', $data);
    }


    public function SettingLokasi()
    {

        return view('layout/DataUser');
    }

    public function ambildataSettingLokasi()
    {
        if ($this->request->isAJAX()) {

            $perawat = new UserModelLokasi();
            $data = [
                'tampildata' => $perawat->ambildatauser()
            ];
            $msg = [
                'data' => view('layout/data_user', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function entriLokasi()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $m_icd = new UserModelLokasi();
            $row = $m_icd->ambildatid($id);

            $data = [
                'id' => $row['id'],
                'firstname' => $row['firstname'],
                'email' => $row['email'],
                'locationcode' => $row['locationcode'],
                'locationname' => $row['locationname'],
                'lokasi' => $this->lokasiuser(),
            ];
            $msg = [
                'sukses' => view('layout/modalinputlokasi', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function lokasiuserranap()
    {
        $m_auto = new UserModelLokasi();
        $list = $m_auto->get_list_lokasi();
        return $list;
    }

    public function lokasiuser()
    {
        $m_auto = new UserModelLokasi();
        $list = $m_auto->get_list_lokasi_all();
        return $list;
    }

    public function simpanlokasibaru()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'locationcode' => [
                    'label' => 'kode lokasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]

                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'locationcode' => $validation->getError('locationcode_baru')
                    ]
                ];
            } else {

                $simpandata = [
                    'firstname' => $this->request->getVar('firstname'),
                    'email' => $this->request->getVar('email'),
                    'locationcode' => $this->request->getVar('locationcode_baru'),
                    'locationname' => $this->request->getVar('locationname_baru'),
                    'ip' => $this->request->getIPAddress(),
                    'createdby' => session()->get('firstname'),
                ];
                $perawat = new UserModelLokasi;
                $perawat->insert($simpandata);
                $msg = [
                    'sukses' => 'Tambah Lokasi Baru Berhasil',
                ];
            }

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function HistoriLokasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new UserModelLokasi();
            $email = $this->request->getVar('email');
            $data = [
                'kunjungan' => $resume->get_list_lokasi_after($email)
            ];

            $msg = [
                'data' => view('layout/data_histori_lokasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function hapusLokasi()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $lokasi = new UserModelLokasi;
            $lokasi->delete($id);
            $msg = [
                'sukses' => "Data Berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }

    public function UbahLokasi()
    {

        $model = new UserModelLokasi();
        $email = session()->get('email');
        $cek = $model->get_list_lokasi_after($email);
        $cek_id = $model->get_id($email);

        $data = [
            'lokasi' => $cek,
            'id' => $cek_id['id'],
        ];

        return view('layout/ubahlokasi', $data);
    }

    public function updatelokasi()
    {
        if ($this->request->isAJAX()) {

            $simpandata = [
                'locationcode' => $this->request->getVar('locationcode'),
                'locationname' => $this->request->getVar('locationname'),

            ];
            $user = new UserModel;
            $id = $this->request->getVar('id');
            $user->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data Lokasi sudah berhasil diubah'
            ];

            echo json_encode($msg);

            // return redirect()->to(base_url() . '/Users/logout');
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function DataLog()
    {

        return view('layout/DataLogUser');
    }

    public function ambildataLog()
    {
        if ($this->request->isAJAX()) {

            $perawat = new UserModelLokasi();
            $data = [
                'tampildata' => $perawat->ambildataactivity()
            ];
            $msg = [
                'data' => view('layout/data_user_log', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function ambildataLogperiodik()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $mulai = str_replace('/', '-', $dateout[0]);
            $sampai = str_replace('/', '-', $dateout[1]);
            $search['mulai'] = date('Y-m-d', strtotime($mulai));
            $search['sampai'] = date('Y-m-d', strtotime($sampai));

            $perawat = new UserModelLokasi();
            $data = [
                'tampildata' => $perawat->search_activity($search),

            ];
            $msg = [
                'data' => view('layout/data_user_log', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}

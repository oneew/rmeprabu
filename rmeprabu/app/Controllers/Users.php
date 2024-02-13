<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Modelrajal;
use App\Models\Model_Foto_Users;
use Config\Services;
use App\Models\logmasuk;

use Config\Service;
use GuzzleHttp\Client;


class Users extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //lakukan validasi
            $rules = [

                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateUser[email,password]',

            ];

            //fungsi validateUser terdapat pada Validation\UserRules.php
            $errors = [
                'password' => [
                    'validateUser' => 'Email atau Password salah'
                ]
            ];


            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                // $msg = [
                //     'gagal' => true,
                //     'pesan' => 'Email atau Password salah',
                // ];
            } else {


                $model = new UserModel();
                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                $this->setUserMethod($user);
                // $email = \Config\Services::email();


                // $tujuan = $this->request->getVar('email');
                // $html = view('layout/logininfo2');

                // $email->setFrom('simrs2021.syamsudin@gmail.com', 'Informasi Login Aplikasi SIMRS');
                // $email->setTo($tujuan);
                // $email->setSubject('Informasi Login Aplikasi SIMRS');
                // $email->setMessage($html);
                // $email->send();
                $msg = [
                    'berhasil' => true,
                    'pesan' => 'Anda Berhasil Masuk Ke Aplikasi Simrs',
                ];


                // if ($user['nowa'] != "-") {

                //     $client = new Client();

                //     $api_key   = 'fceff0304a7329cfc8b1624b50d64aa34938370b';
                //     $id_device = '6787';
                //     $url   = 'https://api.watsap.id/send-message';
                //     $no_hp = $user['nowa'];
                //     $nama_user = $user['firstname'];
                //     $ip = $this->request->getIPAddress();

                //     //$pesan = 'Selamat datang di aplikasi SIMRS Reborn 2022 🙏';
                //     $pesan = 'Selamat Datang' . $nama_user . ' di aplikasi SIMRS Reborn 2022. anda telah berhasil masuk ke aplikasi simrs dari perangkat dengan IP Address: ' . $ip . ' selamat bekerja sehat selalu, dan ingat selalu untuk  merubah kata sandi aplikasi simrs anda secara periodik dan tidak memberikannya kepada orang lain.
                // #programmer SIMRS#';

                //     $url = 'https://api.watsap.id/send-message';
                //     $data_post = [
                //         'id_device' => $id_device,
                //         'api-key' => $api_key,
                //         'no_hp'   => $no_hp,
                //         'pesan'   => $pesan
                //     ];
                //     $header['Content-Type'] = "multipart/form-data";

                //     $response = $client->request('POST', $url, [
                //         'header' => $header,
                //         'json' => $data_post
                //     ])->getBody()->getContents();
                // }

                $datalog = [
                    'id' => $user['id'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'email' => $user['email'],
                    'level' => $user['level'],
                    'locationname' => $user['locationname'],
                    'locationcode' => $user['locationcode'],
                    'foto' => $user['foto'],
                    'isLoggedIn' => true,
                    'datelogin' => date('Y-m-d'),
                    'datetimelogin' => date('Y-m-d G:i:s'),
                    'ip' => $this->request->getIPAddress(),

                ];
                $masuk = new logmasuk;
                $masuk->insert($datalog);
                return redirect()->to(base_url() . '/SimrsHome/HomeSimrs');
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
            'foto' => $user['foto'],
            'isLoggedIn' => true,
            'del' => $user['del'],
            'nowa' => $user['nowa'],

        ];
        session()->set($data);
        return true;
    }



    public function register()
    {
        $data = [
            'lokasi' => $this->lokasi(),
            'role' => $this->role(),
        ];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //lakukan validasi
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[50]',
                'lastname' => 'required|min_length[3]|max_length[50]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]|max_length[255]',
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
                return redirect()->to(base_url() . '/Users');
            }
        }
        echo view('layout/register', $data);
    }

    public function profile()
    {
        $data = [];
        helper(['form']);
        $model = new UserModel();
        if ($this->request->getMethod() == 'post') {
            //lakukan validasi
            $rules = [
                'firstname' => 'required|min_length[3]|max_length[50]',
                'lastname' => 'required|min_length[3]|max_length[50]',
            ];

            if ($this->request->getPost('password') != '') {
                $rules['password'] = 'required|min_length[6]|max_length[255]';
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

    public function role()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_role();
        return $list;
    }

    public function logoff()
    {
        $data = [
            'email' => session()->get('email'),
        ];
        session()->destroy();
        return view('layout/login', $data);
    }

    public function loginafterlogout()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            //lakukan validasi
            $rules = [

                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[6]|max_length[255]|validateUser[email,password]',

            ];

            //fungsi validateUser terdapat pada Validation\UserRules.php
            $errors = [
                'password' => [
                    'validateUser' => 'Email atau Password salah'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                $user = $this->request->getVar('email');
                $data = ['email' => $user];
            } else {


                $model = new UserModel();
                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                $this->setUserMethod($user);
                $email = \Config\Services::email();


                $tujuan = $this->request->getVar('email');
                $html = view('layout/logininfo2');

                $email->setFrom('simrs2021.syamsudin@gmail.com', 'Informasi Login Aplikasi SIMRS');
                $email->setTo($tujuan);
                $email->setSubject('Informasi Login Aplikasi SIMRS');
                $email->setMessage($html);
                $email->send();

                return redirect()->to(base_url() . '/SimrsHome/HomeSimrs');
            }
        }


        return view('layout/logoff', $data);
    }

    public function upload()
    {
        helper('form');
        $data['info'] = $this->request->getPost();
        echo view('layout/upload', $data);
    }

    public function do_upload()
    {
        $request = Services::request();
        $m_dokter = new Model_Foto_Users($request);
        $foto = $this->request->getFile('file');
        $data = $this->request->getPost();
        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'file' => [
                'rules' => 'uploaded[file]',
                'errors' => [
                    'uploaded' => 'harus diisi'
                ]
            ]

        ]);
        if ($valid) {
            if (!empty($data['foto'])) {

                if (file_exists(ROOTPATH . 'public/assets/images/users_simrs/' . $data['foto'])) {

                    unlink(ROOTPATH . 'public/assets/images/users_simrs/' . $data['foto']);
                }
            }

            $name_foto = date('dmy') . random_int(100, 100000000) . '.' . $foto->getExtension();

            $foto->move('assets/images/users_simrs', $name_foto);
            $m_dokter->set_foto($name_foto, $data['code']);

            $msg = [
                'pesan' => 'Foto Profil berhasil diupload',
                'url' => '../assets/images/users_simrs/' . $name_foto,
                'code' => $data['code']
            ];
            echo json_encode($msg);
        } else {
            $msg = [
                'pesangagal' => 'Foto gagal diupload'
            ];
            echo json_encode($msg);
        }
    }
}

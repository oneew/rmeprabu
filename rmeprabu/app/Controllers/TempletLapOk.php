<?php

namespace App\Controllers;

use App\Models\ModelPelayananPoliRME;
use App\Models\ModelTempletLaporanOperasiRME;

class TempletLapOk extends BaseController
{
    function index() {
        if ($this->request->isAJAX()) {
            $data = new ModelTempletLaporanOperasiRME();
            return json_encode([
                'data' => view('templetLapOk/data_lap', [
                    'datas' => $data->findAll(),
                ])
            ]);
        }

        return view('templetLapOk/index');
    }

    function create() {
        $m_auto = new ModelPelayananPoliRME();
        return json_encode([
            'data' => view('templetLapOk/modalcreate_lo_general', [
                'skin' => $m_auto->get_list_skin(),
                'jenisPembedahan' => $m_auto->get_list_jenisPembedahan(),
                'data_lap' => null
            ]),
        ]);
    }

    function store(){
        if ($this->request->isAJAX()) {
            $data = new ModelTempletLaporanOperasiRME();
            try {
                $simpan = [
                    'nama' => $this->request->getVar('name'),
                    'cito' => $this->request->getVar('cito'),
                    'elektif' => $this->request->getVar('elektif'),
                    'smfName' => $this->request->getVar('smfName'),
                    'dokterAnestesi' => $this->request->getVar('dokterAnestesi'),
                    'perawatAnestesi' => $this->request->getVar('perawatAnestesi'),
                    'scrubNurse' => $this->request->getVar('scrubNurse'),
                    'asisten1' => $this->request->getVar('asisten1'),
                    'asisten2' => $this->request->getVar('asisten2'),
                    'circulationNurse' => $this->request->getVar('circulationNurse'),
                    'posisiOperasi' => $this->request->getVar('posisiOperasi'),
                    'jenisSayatan' => $this->request->getVar('jenisSayatan'),
                    'skinPerparasi' => $this->request->getVar('skinPerparasi'),
                    'jenisPembedahan' => $this->request->getVar('jenisPembedahan'),
                    'diagnosaPraBedah' => $this->request->getVar('diagnosaPraBedah'),
                    'indikasiOperasi' => $this->request->getVar('indikasiOperasi'),
                    'jenisOperasi' => $this->request->getVar('jenisOperasi'),
                    'diagnosaPascaBedah' => $this->request->getVar('diagnosaPascaBedah'),
                    'prosedurOp' => $this->request->getVar('prosedurOp'),
                    'jaringanSpesimenOperasi' => $this->request->getVar('jaringanSpesimenOperasi'),
                    'jaringanSpesimenAspirasi' => $this->request->getVar('jaringanSpesimenAspirasi'),
                    'jaringanSpesimenkaterisasi' => $this->request->getVar('jaringanSpesimenkaterisasi'),
                    'lokalisasi' => $this->request->getVar('lokalisasi'),
                    'dikirimPA' => $this->request->getVar('dikirimPA'),
                    'profilaksisAntibiotik' => $this->request->getVar('profilaksisAntibiotik'),
                    'jamPemberian' => $this->request->getVar('jamPemberian'),
                    'laporanJalanOperasi' => $this->request->getVar('laporanJalanOperasi'),
                    'komplikasiPascaBedah' => $this->request->getVar('komplikasiPascaBedah'),
                    'jumlahPerdarahan' => $this->request->getVar('jumlahPerdarahan'),
                    'transfusiDarah' => $this->request->getVar('transfusiDarah'),
                    'pcr' => $this->request->getVar('pcr'),
                    'wb' => $this->request->getVar('wb'),
                    'jumlahPcrWb' => $this->request->getVar('jumlahPcrWb'),
                    'jenisInplan' => $this->request->getVar('jenisInplan'),
                    'noRegInplan' => $this->request->getVar('noRegInplan'),
                ];

                if (!in_array($this->request->getVar('id'), [null, ""])) {
                    $data->update($this->request->getVar('id'), array_merge($simpan,[
                        'katarak' => '0',
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => session()->get('firstname')
                    ]));
                    return json_encode([
                        'success' => 'Templet Lap OK Berhasil diperbarui !!'
                    ]);
                }

                $data->insert(array_merge($simpan, [
                    'katarak' => '0',
                    'created_by' => session()->get('firstname')
                ]));

                return json_encode([
                    'success' => 'Templet Lap OK Berhasil ditambahkan !!'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Templet Lap OK gagal ditambahkan !!'
                ]);
            }
        }else {
            exit('Tidak dapat di proses');
        }
    }

    function edit() {
        $data = new ModelTempletLaporanOperasiRME();
        $m_auto = new ModelPelayananPoliRME();
        return json_encode([
            'data' => view('templetLapOk/modalcreate_lo_general', [
                'skin' => $m_auto->get_list_skin(),
                'jenisPembedahan' => $m_auto->get_list_jenisPembedahan(),
                'data_lap' => $data->find($this->request->getVar('id'))
            ]),
        ]);
    }

    function createKatarak() {
        $m_auto = new ModelPelayananPoliRME();
        return json_encode([
            'data' => view('templetLapOk/modalcreate_lo_katarak', [
                'anesthesia' => $m_auto->get_list_anesthesia(),
                'approach' => $m_auto->get_list_approach(),
                'capsulotomy' => $m_auto->get_list_capsulotomy(),
                'nucleus' => $m_auto->get_list_nucleus(),
                'phaco' => $m_auto->get_list_phaco(),
                'iol' => $m_auto->get_list_iol(),
                'stitch' => $m_auto->get_list_stitch(),
                'perawat_katarak' => $m_auto->get_list_perawat_katarak_rme(),
                'data_katarak' => null
            ]),
        ]);
    }

    function editKatarak() {
        $m_auto = new ModelPelayananPoliRME();
        $data = new ModelTempletLaporanOperasiRME();
        return json_encode([
            'data' => view('templetLapOk/modalcreate_lo_katarak', [
                'anesthesia' => $m_auto->get_list_anesthesia(),
                'approach' => $m_auto->get_list_approach(),
                'capsulotomy' => $m_auto->get_list_capsulotomy(),
                'nucleus' => $m_auto->get_list_nucleus(),
                'phaco' => $m_auto->get_list_phaco(),
                'iol' => $m_auto->get_list_iol(),
                'stitch' => $m_auto->get_list_stitch(),
                'perawat_katarak' => $m_auto->get_list_perawat_katarak_rme(),
                'data_katarak' => $data->find($this->request->getVar('id'))
            ]),
        ]);
    }

    function storeKatarak() {
        if ($this->request->isAJAX()) {
            $data = new ModelTempletLaporanOperasiRME();
            $simpan = [
                'nama' => $this->request->getVar('nama'),
                'od' => $this->request->getVar('od'),
                'os' => $this->request->getVar('os'),
                'cataractGrade' => $this->request->getVar('cataractGrade'),
                'noteOp' => $this->request->getVar('noteOp'),
                'ucva' => $this->request->getVar('ucva'),
                'bcva' => $this->request->getVar('bcva'),
                'retinometry' => $this->request->getVar('retinometry'),
                'k1' => $this->request->getVar('k1'),
                'k2' => $this->request->getVar('k2'),
                'axl' => $this->request->getVar('axl'),
                'acd' => $this->request->getVar('acd'),
                'lt' => $this->request->getVar('lt'),
                'formula' => $this->request->getVar('formula'),
                'emetropia' => $this->request->getVar('emetropia'),
                'visus' => $this->request->getVar('visus'),
                'typeOperasi' => $this->request->getVar('typeOperasi'),
                'scrub' => $this->request->getVar('scrub'),
                'cukator' => $this->request->getVar('cukator'),
                'anestehesia' => $this->request->getVar('anestehesia'),
                'approach' => $this->request->getVar('approach'),
                'capsulotomy' => $this->request->getVar('capsulotomy'),
                'hydrodissection' => $this->request->getVar('hydrodissection'),
                'nucleus' => $this->request->getVar('nucleus'),
                'phaco' => $this->request->getVar('phaco'),
                'iol' => $this->request->getVar('iol'),
                'stitch' => $this->request->getVar('stitch'),
                'phacoMachine' => $this->request->getVar('phacoMachine'),
                'phacoTime' => $this->request->getVar('phacoTime'),
                'irigatingSolution' => $this->request->getVar('irigatingSolution'),
                'komplikasi' => $this->request->getVar('komplikasi'),
                'posterior' => $this->request->getVar('posterior'),
                'vitreus' => $this->request->getVar('vitreus'),
                'vitrectomy' => $this->request->getVar('vitrectomy'),
                'retained' => $this->request->getVar('retained'),
                'cortex' => $this->request->getVar('cortex'),
            ];
    
            try {
                if (!in_array($this->request->getVar('id_katarak'), [null, ''])) {
                    $data->update($this->request->getVar('id_katarak'), array_merge($simpan,[
                        'katarak' => '1',
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => session()->get('firstname')
                    ]));
                    return json_encode([
                        'success' => 'Templet Lap OK Berhasil diperbarui !!'
                    ]);
                }
    
                $data->insert(array_merge($simpan, [
                    'katarak' => '1',
                    'created_by' => session()->get('firstname')
                ]));

                return json_encode([
                    'success' => 'Templet Lap OK Berhasil ditambahkan !!'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Templet Lap OK Katarak gagal ditambahkan !!' . $th->getMessage()
                ]);
            }
        }else{
            exit('Tidak dapat di proses');
        }
    }

    function delete() {
        if ($this->request->isAJAX()) {
            try {
                $data = new ModelTempletLaporanOperasiRME();
                $data->delete($this->request->getVar('id'));

                return json_encode([
                    'success' => 'Data laporan operasi berhasil di hapus !!'
                ]);
            } catch (\Throwable $th) {
                return json_encode([
                    'error' => 'Data laporan operasi gagal di hapus !!'
                ]);
            }
        }else{
            exit('Tidak dapat di proses');
        }
    }

    function useTempletGeneral(){
        if ($this->request->isAJAX()) {
            $data = new ModelTempletLaporanOperasiRME();
                
            return json_encode([
                'data' => view('templetLapOk/modal_get_lo_general',[
                    'list_data' =>  $data->select('id, nama, created_by, created_at, katarak')->where('katarak', '0')->findAll()
                ])
            ]);            
        }else{
            exit('Tidak dapat di proses');
        }
    }

    function getDataLapGeneral() {
        if ($this->request->isAJAX()) {
            $data = new ModelTempletLaporanOperasiRME();
            return json_encode([
                'data' => $data->select('id, katarak, cito, elektif, smfName, dokterAnestesi, perawatAnestesi, scrubNurse, asisten1, asisten2, circulationNurse, posisiOperasi, jenisSayatan, skinPerparasi, jenisPembedahan, diagnosaPraBedah, indikasiOperasi, jenisOperasi, diagnosaPascaBedah, prosedurOp, jaringanSpesimenOperasi, jaringanSpesimenAspirasi, jaringanSpesimenkaterisasi, lokalisasi, dikirimPA, profilaksisAntibiotik, jamPemberian, laporanJalanOperasi, komplikasiPascaBedah, jumlahPerdarahan, transfusiDarah, pcr, wb, jumlahPcrWb, jenisInplan, noRegInplan')->where('id', $this->request->getVar('id'))->where('katarak', '0')->first()
            ]);
        }
    }

    function useTempletKatarak(){
        if ($this->request->isAJAX()) {
            $data = new ModelTempletLaporanOperasiRME();
                
            return json_encode([
                'data' => view('templetLapOk/modal_get_lo_katarak',[
                    'list_data' =>  $data->select('id, nama, created_by, created_at, katarak')->where('katarak', '1')->findAll()
                ])
            ]);            
        }else{
            exit('Tidak dapat di proses');
        }
    }

    function getDataLapKatarak() {
        if ($this->request->isAJAX()) {
            $data = new ModelTempletLaporanOperasiRME();
            return json_encode([
                'data' => $data->where('id', $this->request->getVar('id'))->where('katarak', '1')->first()
            ]);
        }
    }
}

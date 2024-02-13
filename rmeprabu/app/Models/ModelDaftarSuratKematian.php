<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDaftarSuratKematian extends Model
{

    protected $table      = 'admission_suratkematian';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'referencenumber', 'pasienid', 'pasienname', 'pasiengender', 'placeofbirth', 'pasiendateofbirth', 'umur', 'pekerjaan', 'agama', 'alamat',
        'kelurahan', 'kecamatan', 'kabupatenkota', 'propinsi', 'nik', 'wna', 'namapjb', 'hubungan_dengan_pjb', 'documentdate', 'datedie', 'timedie', 'locationdie', 'status_jenazah',
        'dokter_forensik', 'nip_dokter_forensik', 'date_periksa', 'time_periksa', 'dasar_rm', 'dasar_pemeriksaan_luar', 'dasar_autopsi_forensik', 'dasar_autopsi_medis',
        'dasar_autopsi_verbal', 'dasar_lain', 'penyebab_kematian', 'created_at', 'updated_at', 'createdby', 'updatedby', 'dokter_signature'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    function get_data_token($token_ibs)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table($tb);
        //$this->dt->select(' name , id , code , memo ');
        $this->dt->where('token_ranap', $token_ibs);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table($tb);
        //$this->dt->select(' name , id , code , memo ');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_ibs($id = '')
    {
        if ($id == '') {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}

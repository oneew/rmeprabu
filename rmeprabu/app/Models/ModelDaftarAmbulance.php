<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDaftarAmbulance extends Model
{

    protected $table      = 'admission_ambulance';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'referencenumber', 'pasienid', 'pasienname', 'pasiengender', 'pasiendateofbirth', 'namapjb', 'documentdate', 'datego', 'datetimego', 'diagnosa',
        'kondisipasien', 'kesadaran', 'tandavital', 'tekanandarah', 'nadi', 'respirasi', 'saturasi', 'roomname', 'bednumber', 'alamattujuan', 'syringepump', 'ventilatortransport',
        'infusonpump', 'monitor', 'alatlain', 'obat', 'perawatruangan', 'supirambulance', 'signaturepjb', 'signatureperawat', 'signaturesupir', 'code', 'platnomor', 'created_at',
        'updated_at', 'createdby', 'updatedby', 'token_ambulance', 'kelurahan', 'kecamatan', 'kabupatenkota', 'propinsi', 'kegiatanAmbulance'
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

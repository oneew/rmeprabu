<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDigitalisasiRM extends Model
{

    protected $table      = 'file_upload_rm';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'referencenumber', 'pasienid', 'pasienname', 'documentdate', 'poliklinikname', 'doktername', 'paymentmethodname', 'fileArsip', 'created_at', 'updated_at', 'createdBy'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function get_data_arsip_digital_detail($id)
    {
        $this->dt = $this->db->table('file_upload_rm');
        $this->dt->where('referencenumber', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajalhistoriupload()
    {
        $this->dt = $this->db->table('file_upload_rm');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalhistoriupload($search)
    {
        $this->dt = $this->db->table('file_upload_rm');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        if ($search['pilihanpoli'] != "") {
            $this->dt->like('poliklinikname', $search['pilihanpoli']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

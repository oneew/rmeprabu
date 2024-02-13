<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenunjangExpertise extends Model
{

    protected $table      = 'transaksi_pelayanan_penunjang_expertise';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'expertiseid', 'pacsnumber', 'groups', 'expertise', 'sendtopacs', 'createdby', 'createddate', 'modifiedby', 'modifieddate',
        'created_at', 'updated_at', 'fotoradiologi', 'idPenunjangDetail', 'klinis', 'employee', 'employeename', 'journalnumber', 'klinis'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function ubah_expertise($expertiseid, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->where('id', $expertiseid);
        $this->dt->update($simpandata);
    }
}

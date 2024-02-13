<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenunjangExpertiseLPK extends Model
{

    protected $table      = 'transaksi_pelayanan_penunjang_expertise_lpk';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'expertiseid', 'groups', 'expertise', 'createdby', 'createddate', 'modifiedby', 'modifieddate',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function ubah_expertise($expertiseid, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpk');
        $this->dt->where('expertiseid', $expertiseid);
        $this->dt->update($simpandata);
    }

    public function ubah_analis($expertiseid, $simpandataanalis)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('journalnumber', $expertiseid);
        $this->dt->update($simpandataanalis);
    }
}

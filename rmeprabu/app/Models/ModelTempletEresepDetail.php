<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTempletEresepDetail extends Model
{

    protected $table      = 'templet_e_resep_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'referencenumber',
        'kode_obat',
        'nama_obat',
        'jumlah_obat',
        'created_by',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    function get_obat_rme($key, $locationcode)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.name, obat.salesprice, SUM(obat_balance.balance)as balance, obat_balance.expireddate, obat_balance.batchnumber, obat_balance.locationcode, obat.uom,
        obat_balance.expireddate');
        $this->dt->where('obat_balance.locationcode', $locationcode);
        $this->dt->where('obat.code', $key);

        $this->dt->groupBy('obat_balance.code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

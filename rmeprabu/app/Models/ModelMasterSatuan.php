<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMasterSatuan extends Model
{

    protected $table      = 'satuan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'code', 'name', 'types', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function ambildatasatuan()
    {
        $this->dt = $this->db->table('satuan');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_satuan($id)
    {
        $this->dt = $this->db->table('satuan');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

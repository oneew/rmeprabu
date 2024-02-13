<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMasterSupplier extends Model
{

    protected $table      = 'supplier';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'code', 'name', 'address', 'telephone', 'taxnumber', 'taxname', 'contactname', 'handphone', 'bankname', 'bankaccount', 'bankaccountname', 'numberseq',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function ambildatasupplier()
    {
        $this->dt = $this->db->table('supplier');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_supplier($id)
    {
        $this->dt = $this->db->table('supplier');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDokter extends Model
{

    protected $table      = 'dokter';
    protected $primaryKey = 'id';

    protected $allowedFields = ['code', 'name', 'specialist', 'address', 'telephone', 'taxnumber', 'ssn', 'hadnphone', 'locationname', 'bankname', 'bankaccount', 'kode_bpjs'];

    function get_list_poli()
    {
        $this->dt = $this->db->table('daftar_poli');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

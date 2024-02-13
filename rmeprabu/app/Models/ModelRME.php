<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelRME extends Model
{

    protected $table      = 'template_soap_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'smf', 'keterangan', 'subjective', 'objective', 'asesment', 'planing'
    ];

    function ambildatarme()
    {
        $this->dt = $this->db->table('template_soap_rme');
        $this->dt->distinct('smf');
        $this->dt->orderBy('smf', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    public function insert_diagnosa($simpandata)
    {
        $table = $this->db->table('template_soap_rme');
        $table->insert($simpandata);
    }

    function get_data_rme_detail($id)
    {
        $this->dt = $this->db->table('template_soap_rme');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function update_diagnosa($simpandata)
    {
        $this->dt = $this->db->table('template_soap_rme');
        $this->dt->where('id', $simpandata['id']);
        $this->dt->update($simpandata);
    }

    public function delete_diagnosa($id)
    {
        $this->dt = $this->db->table('template_soap_rme');
        $this->dt->where('id', $id);
        $this->dt->delete();
    }

    function get_data_rme_detail2($id)
    {
        $this->dt = $this->db->table('template_soap_rme');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

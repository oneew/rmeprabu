<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelperawat extends Model
{

    protected $table      = 'daftar_perawat';
    protected $primaryKey = 'id';




    protected $allowedFields = ['nama', 'jabatan', 'kelompok', 'tanggal_lahir', 'locationname', 'area', 'address'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function get_list_locationname()
    {
        // $locationname = [$roomname, 'SEMUA'];
        $this->dt = $this->db->table('gudang');
        // $this->dt->whereIn('locationname', $locationname);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

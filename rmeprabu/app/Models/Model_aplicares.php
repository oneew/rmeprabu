<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_aplicares extends Model
{
    function get_create($id)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur_aplicare');
        $this->dt->where('roomcode', $id);
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->where('real', 1);
        $this->dt->select('roomcode , status, roomname , classroom');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_update()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur_aplicare');
        $this->dt->select('roomcode , status');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->where('real', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_delete($id)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur_aplicare');
        $this->dt->where('roomcode', $id);
        $this->dt->select('roomcode , classroom');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_roomcode()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur_aplicare');
        $this->dt->select('roomcode, roomname , classroom');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->where('real', 1);
        $this->dt->groupBy('roomcode');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_master_kamar()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur_aplicare');
        $this->dt->select('roomname, classroom, count(roomname)as jumlahbed, roomcode');
        $this->dt->groupBy('roomcode');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_master_kamar($roomcode)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur_aplicare');
        $this->dt->select('roomname, classroom, count(roomname)as jumlahbed, roomcode');
        $this->dt->where('roomcode', $roomcode);
        $this->dt->where('real', 1);
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->groupBy('roomcode');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

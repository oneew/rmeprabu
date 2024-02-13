<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelBedInfo extends Model
{

    function ambildatabed()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' classroomname , status, COUNT(code)as jumlahbed, 
        COUNT(IF(status="KOSONG",validationnumber, NULL))as kosong,
        COUNT(IF(status="TERISI",validationnumber, NULL))as isi ');

        $this->dt->groupBy('classroomname');
        $this->dt->orderBy('classroomname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

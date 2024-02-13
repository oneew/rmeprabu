<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelEnJadwal extends Model
{

    protected $table      = 'jadwaloperasimanual';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'pasienid', 'pasienname', 'pasiendateofbirth', 'pasienaddress', 'ibsdoktername', 'ibsanestesiname', 'name', 'room', 'dateOp', 'datetimeOp', 'asalRuangan', 'referencenumber',
        'paymentcardnumber', 'terlaksana', 'kodebooking', 'kodepoli', 'tanggaljaminput', 'timpelaksana', 'timanestesi', 'diagnosa', 'tgl_keputusan', 'paymentmethodname'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function ambildatarajal()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(20);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname']);
        $this->dt->like('pasienid', $search['norm']);
        $this->dt->limit(20);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_RegisterRanap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');

        $this->dt->where('datein >=', $search['mulai']);
        $this->dt->where('datein <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname']);
        $this->dt->like('pasienid', $search['norm']);
        $this->dt->where('statusrawatinap', 'RAWAT');
        $this->dt->limit(100);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function getPoliBpjsp($poliklinikname)
    {
        $this->dt = $this->db->table('pelayanan_smf');
        $this->dt->where('name', $poliklinikname);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function getPoliBpjspRanap($poliklinik)
    {
        $this->dt = $this->db->table('pelayanan_smf');
        $this->dt->where('name', $poliklinik);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

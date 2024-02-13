<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelPelayananPoliRMETRIAGE extends Model
{

    protected $table      = 'asesmen_triase_igd_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'admissionDateTime', 'transportasi', 'doktername', 'bb', 'tb', 'frekuensiNadi', 'tdSistolik', 'tdDiastolik',
        'suhu', 'frekuensiNafas', 'spo2', 'airway', 'breathing', 'circulation', 'eye', 'verbal', 'motorik', 'totalGcs', 'kesadaran',
        'kondisiPasien', 'kelompokTriase', 'paramedicName', 'createdBy', 'createddate', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifikator'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function get_data_triase($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_triase_igd_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cek_triase($id)
    {
        $this->dt = $this->db->table('asesmen_triase_igd_rme');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

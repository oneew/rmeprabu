<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelEdukasi extends Model
{

    protected $table      = 'edukasi_bedah';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'referencenumber', 'pasienid', 'pasienname', 'pasiengender', 'roomname', 'pasiendateofbirth', 'pemberiinformasi', 'penerimainformasi',
        'ibsdoktername', 'ibsanestesiname', 'diagnosis', 'kondisipasien', 'name', 'manfaattindakan', 'tatacara', 'risikotindakan', 'komplikasitindakan',
        'dampaktindakan', 'prognosistindakan', 'alternatif', 'bilatidakditindak', 'id_tproh', 'signature', 'signature_diskusi', 'signature_informasi', 'namapjb', 'alamatpjb',
        'pjbdateofbirth', 'pjbgender', 'date_informconcent', 'hasiltidakterduga'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    function get_data_edukasibedah($id)
    {
        $tb = "edukasi_bedah";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id_tproh', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

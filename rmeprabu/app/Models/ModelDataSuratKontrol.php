<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelDataSuratKontrol extends Model
{

    protected $table      = 'datasuratkontrolbpjs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'referencenumber', 'norm', 'diagnosa', 'kelasRawat', 'noSep', 'hakKelas', 'jnsPeserta', 'kelamin',
        'nama', 'noKartu', 'tglLahir', 'poliKontrol', 'tglRencanaKontrol', 'noSuratKontrol', 'kodeDokter', 'namaDokter', 'created_at', 'upadted_at', 'createdby', 'updatedBy'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function update_dataSuratKontrol($noSuratKontrol, $simpandata)
    {
        $this->dt = $this->db->table('datasuratkontrolbpjs');
        $this->dt->where('noSuratKontrol', $noSuratKontrol);
        $this->dt->update($simpandata);
    }
}

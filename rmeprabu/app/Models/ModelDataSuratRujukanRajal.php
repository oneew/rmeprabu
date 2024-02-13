<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelDataSuratRujukanRajal extends Model
{

    protected $table      = 'dataSuratRujukanBpjsRajal';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'referencenumber', 'norm', 'kodeDiagnosa', 'namaDiagnosa', 'kelasRawat', 'noSep', 'hakKelas', 'jnsPeserta', 'kelamin',
        'nama', 'noKartu', 'tglLahir', 'tipeRujukan', 'kodepoliTujuan', 'namapoliTujuan', 'tglRujukan', 'tglRencanaKunjungan', 'tglBerlakuKunjungan', 'noRujukan', 'kodeTujuanRujukan', 'namaTujuanRujukan', 'kodeDokter', 'created_at', 'upadted_at', 'createdby', 'updatedBy',
        'catatan', 'jnsPelayanan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function update_dataSuratRujukan($noRujukan, $simpandata)
    {
        $this->dt = $this->db->table('dataSuratRujukanBpjs');
        $this->dt->where('noRujukan', $noRujukan);
        $this->dt->update($simpandata);
    }
}

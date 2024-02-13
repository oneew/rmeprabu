<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelDataPengajuanSEPRanap extends Model
{

    protected $table      = 'dataPengajuanPenjaminanSEP';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'noKartu', 'journalnumber', 'referencenumber', 'norm', 'tglSep', 'jnsPelayanan', 'jnsPengajuan', 'keterangan', 'noSuratPengajuan',
        'created_at', 'upadted_at', 'createdby', 'updatedBy'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function update_dataPenjamin_SEP($referencenumber, $simpandata)
    {
        $this->dt = $this->db->table('dataPengajuanPenjaminanSEP');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->update($simpandata);
    }
}

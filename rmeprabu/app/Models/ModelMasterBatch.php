<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMasterBatch extends Model
{

    protected $table      = 'obat_balance';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'locationcode', 'code', 'batchnumber', 'expireddate', 'balance', 'uom', 'createdby', 'createddate', 'balance_temp'
    ];



    function update_code($code, $simpandata)
    {
        $this->dt = $this->db->table('obat_balance');
        $this->dt->where('code', $code);
        $this->dt->update($simpandata);
    }
}

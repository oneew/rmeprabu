<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelFarmasiPelayananDetail extends Model
{

    protected $table      = 'transaksi_farmasi_pelayanan_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'documentdate', 'karyawan', 'disepansasi', 'relation', 'relationname', 'paymentmethod', 'paymentmethodname', 'poliklinik', 'poliklinikname', 'poliklinikclass',
        'dokter', 'doktername', 'employee', 'employeename', 'referencenumber', 'locationcode', 'racikan', 'r', 'koderacikan', 'jumlahracikan', 'production', 'stockupdate', 'centrallocation',
        'code', 'name', 'batchnumber', 'expireddate', 'qty', 'qtyresep', 'uom', 'signa1', 'signa2', 'emptydate', 'usedrole', 'eticket', 'eticket_aturan', 'eticket_carapakai', 'eticket_petunjuk',
        'pagi', 'siang', 'sore', 'malam', 'price', 'disc', 'totaldiscount', 'subtotal', 'createdby', 'createddate', 'paymentchange', 'paymentchangenumber', 'eresep', 'qtypaket', 'qtyluarpaket','terapiPulang'

    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    function get_obat_rme($key, $locationcode)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.name, obat.salesprice, SUM(obat_balance.balance)as balance, obat_balance.expireddate, obat_balance.batchnumber, obat_balance.locationcode, obat.uom');
        $this->dt->where('obat_balance.locationcode', $locationcode);
        $this->dt->where('obat.code', $key);

        $this->dt->groupBy('obat_balance.code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

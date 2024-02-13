<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelValidasiPembayaranPenunjang extends Model
{

    protected $table      = 'transaksi_kasir_penunjang';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'validationnumber', 'journalnumber', 'documentdate', 'documentyear', 'documentmonth', 'referencenumber', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea',
        'pasiensubareaname',  'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'poliklinik', 'poliklinikname', 'dokter', 'doktername', 'employee', 'employeename', 'classroom', 'classroomname', 'grandtotal', 'disc',
        'paymentamount', 'memo', 'locationcode', 'locationname', 'posted', 'postedip', 'postedby', 'numberseq', 'createdby', 'createddate', 'paymentchange', 'paymentchangenumber', 'payersname', 'paymentstatus', 'metodepembayaran', 'referensibank', 'nominaldebet', 'noreferensidebet', 'signaturekasir', 'signaturepasien'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function get_list_payment()
    {
        $this->dt = $this->db->table('cara_pembayaran');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('inactive', 'TIDAK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterRajal($search)
    {
        $this->dt = $this->db->table($this->table);

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapembayaran($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

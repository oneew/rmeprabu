<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelValidasiPembayaranRajal extends Model
{

    protected $table      = 'transaksi_kasir_rawatjalan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'bpjs_sep', 'documentdate', 'documentyear', 'documentmonth', 'noantrian', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea',
        'pasiensubareaname',  'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'poliklinik', 'poliklinikname', 'smf', 'smfname', 'dokter', 'doktername', 'employee', 'employeename', 'referencenumber',  'code', 'description', 'icdx', 'icdxname', 'locationcode', 'locationname',
        'numberseq', 'createdby', 'createddate', 'modifiedip', 'modifiedby', 'modifieddate', 'classroom', 'classroomname', 'reasoncode', 'statuspasien', 'totaldaftar', 'totaltindakan',
        'totalbhp', 'totalitembhp', 'totalfarmasi', 'totalpenunjang', 'kasirpetunjang', 'subtotal', 'disc', 'totaldiscount', 'grandtotal', 'paymentamount', 'memo', 'locationcode', 'locationname',
        'penunjang', 'numberseq', 'createdby', 'payersname', 'paymentstatus', 'metodepembayaran', 'referensibank', 'nominaldebet', 'noreferensidebet', 'signaturekasir', 'signaturepasien'
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

    function ambilpasienbayar($referencenumber)
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildatahapus()
    {
        $this->dt = $this->db->table('log_delete_transaksi_kasir_rawatjalan');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

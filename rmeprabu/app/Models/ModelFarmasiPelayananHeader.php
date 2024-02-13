<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelFarmasiPelayananHeader extends Model
{

    protected $table      = 'transaksi_farmasi_pelayanan_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'insenaranap', 'groups', 'journalnumber', 'documentdate', 'documentmonth', 'documentyear', 'sumber', 'noreg', 'nobridging', 'noantrian', 'referencenumber', 'bpjs_sep',
        'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'dateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname', 'karyawan', 'disepansasi',
        'dispensasipejabat', 'dispensasialasan', 'cash', 'nonpaket', 'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'paymentmethodori', 'paymentmethodnameori', 'paymentcardnumberori',
        'smf', 'smfname', 'poliklinik', 'poliklinikname', 'poliklinikclass', 'poliklinikclassname', 'bednumber', 'dokter', 'doktername', 'employee', 'employeename', 'locationcode', 'locationname',
        'locationentry', 'qtyresep', 'qtylayan', 'qtybooked', 'qtydistribusi', 'embalase', 'referencenumberparent', 'parentid', 'parentname', 'totalamount', 'numberseq', 'subtotal',
        'disc', 'totaldiscount', 'grandtotal', 'validasi', 'valdiasilunas', 'createdby', 'createddate', 'modifiedby', 'modifieddate', 'validationby', 'validationdate', 'validationip',
        'paymentvalidation', 'paymentvalidationby', 'paymentvalidationdate', 'paymentchange', 'paymentchangenumber', 'koinsiden', 'eresep','terapiPulang', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function Search_Pasien_Ranap($search)
    {

        $statusrawatinap = ['RAWAT', 'PULANG'];
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->whereIn('statusrawatinap', $statusrawatinap);

        if ($search['roomname'] != "") {
            $this->dt->like('roomname', $search['roomname']);
        }
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm']);
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('pasienname', $search['namapasien']);
        }
        $this->dt->orderBy('datein', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Search_Pasien_Igd($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('groups', 'IGD');
        if ($search['tanggalpelayanan'] != date('Y-m-d')) {
            $this->dt->like('documentdate', $search['tanggalpelayanan']);
        }
        if ($search['tanggalpelayanan'] == date('Y-m-d')) {
            $this->dt->like('documentdate', date('Y-m-d'));
        }
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm']);
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('pasienname', $search['namapasien']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Search_Pasien_Rajal($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('groups', 'IRJ');
        if ($search['tanggalpelayanan'] != date('Y-m-d')) {
            $this->dt->like('documentdate', $search['tanggalpelayanan']);
        }
        if ($search['tanggalpelayanan'] == date('Y-m-d')) {
            $this->dt->like('documentdate', date('Y-m-d'));
        }
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm']);
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('pasienname', $search['namapasien']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

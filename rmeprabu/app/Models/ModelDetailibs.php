<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDetailibs extends Model
{

    protected $table      = 'transaksi_pelayanan_rawatinap_operasi_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'journalnumber', 'documentdate', 'relation', 'relationname', 'paymentmethod', 'paymentmethodname', 'classroom',
        'classroomname', 'room', 'roomname', 'smf', 'smfname', 'dokter', 'doktername', 'doktergeneral', 'doktergeneralname', 'registernumber',
        'referencenumber', 'referencenumberparent', 'locationcode', 'operationgroup', 'code', 'name', 'qty', 'groups', 'groupname', 'category',
        'categoryname', 'priceori', 'bhpori', 'share1ori', 'share2ori', 'price', 'bhp', 'markup', 'totaltarif', 'totalbhp', 'subtotal', 'disc',
        'totaldiscount', 'grandtotal', 'share1', 'share2', 'share21', 'share22', 'memo', 'createdby', 'createddate', 'token_ibs', 'koinsiden'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    function get_list_perawat($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->limit(1);
        $this->dt->where('journalnumber', $journalnumber);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_bpjs_code($namapoli)
    {
        $this->dt = $this->db->table('gudang');
        //$this->dt->select('id, nama, jabatan');
        $this->dt->limit(10);
        $this->dt->where('name', $namapoli);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_operasi($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join('transaksi_pelayanan_rawatinap_operasi_detail', 'transaksi_pelayanan_rawatinap_operasi_header.journalnumber=transaksi_pelayanan_rawatinap_operasi_detail.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_rawatinap_operasi_detail.id, transaksi_pelayanan_rawatinap_operasi_detail.documentdate, transaksi_pelayanan_rawatinap_operasi_detail.doktername, transaksi_pelayanan_rawatinap_operasi_header.ibsanestesiname, transaksi_pelayanan_rawatinap_operasi_detail.name, transaksi_pelayanan_rawatinap_operasi_detail.price, transaksi_pelayanan_rawatinap_operasi_detail.totalbhp,
        transaksi_pelayanan_rawatinap_operasi_detail.subtotal');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.journalnumber', $journalnumber);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDiagnosa extends Model
{

    protected $table      = 'transaksi_rekammedik_rawatjalan_header';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    function search_diagnosa_header($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');
        $this->dt->join('transaksi_rekammedik_rawatjalan_detail', 'transaksi_rekammedik_rawatjalan_detail.journalnumber=transaksi_rekammedik_rawatjalan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_rekammedik_rawatjalan_header.journalnumber ,  transaksi_rekammedik_rawatjalan_header.documentdate, transaksi_rekammedik_rawatjalan_header.groups, transaksi_rekammedik_rawatjalan_header.pasienid, transaksi_rekammedik_rawatjalan_header.poliklinikname, transaksi_rekammedik_rawatjalan_header.doktername, transaksi_rekammedik_rawatjalan_detail.coding, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx, transaksi_rekammedik_rawatjalan_detail.codeicdix, transaksi_rekammedik_rawatjalan_detail.nameicdix, , transaksi_rekammedik_rawatjalan_detail.createddate, , transaksi_rekammedik_rawatjalan_detail.createdby');
        $this->dt->where('transaksi_rekammedik_rawatjalan_header.pasienid', $referencenumber);
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_rekammedik_rawatjalan_header.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function search_diagnosa($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select(' transaksi_rekammedik_rawatjalan_detail.journalnumber ,  transaksi_rekammedik_rawatjalan_detail.documentdate, transaksi_rekammedik_rawatjalan_detail.types, transaksi_rekammedik_rawatjalan_detail.relation, transaksi_rekammedik_rawatjalan_detail.poliklinikname, transaksi_rekammedik_rawatjalan_detail.doktername, transaksi_rekammedik_rawatjalan_detail.coding, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx, transaksi_rekammedik_rawatjalan_detail.codeicdix, transaksi_rekammedik_rawatjalan_detail.nameicdix, transaksi_rekammedik_rawatjalan_detail.createddate, transaksi_rekammedik_rawatjalan_detail.createdby, transaksi_rekammedik_rawatjalan_detail.referencenumber, transaksi_rekammedik_rawatjalan_detail.referencenumber_rawatinap');
        $this->dt->where('transaksi_rekammedik_rawatjalan_detail.relation', $referencenumber);
        $this->dt->orderBy('transaksi_rekammedik_rawatjalan_detail.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_poli($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' transaksi_pelayanan_daftar_rawatjalan.journalnumber ,  transaksi_pelayanan_daftar_rawatjalan.documentdate, transaksi_pelayanan_daftar_rawatjalan.groups, transaksi_pelayanan_daftar_rawatjalan.pasienid, transaksi_pelayanan_daftar_rawatjalan.poliklinikname, transaksi_pelayanan_daftar_rawatjalan.doktername, transaksi_pelayanan_daftar_rawatjalan.reasoncode, transaksi_pelayanan_daftar_rawatjalan.statuspasien, transaksi_pelayanan_daftar_rawatjalan.icdx, transaksi_pelayanan_daftar_rawatjalan.icdxname, transaksi_pelayanan_daftar_rawatjalan.paymentmethodname, transaksi_pelayanan_daftar_rawatjalan.bpjs_sep');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.pasienid', $referencenumber);
        $this->dt->notlike('groups', 'IGD');
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatjalan.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_igd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' transaksi_pelayanan_daftar_rawatjalan.journalnumber ,  transaksi_pelayanan_daftar_rawatjalan.documentdate, transaksi_pelayanan_daftar_rawatjalan.groups, transaksi_pelayanan_daftar_rawatjalan.pasienid, transaksi_pelayanan_daftar_rawatjalan.poliklinikname, transaksi_pelayanan_daftar_rawatjalan.doktername, transaksi_pelayanan_daftar_rawatjalan.reasoncode, transaksi_pelayanan_daftar_rawatjalan.statuspasien, transaksi_pelayanan_daftar_rawatjalan.icdx, transaksi_pelayanan_daftar_rawatjalan.icdxname, transaksi_pelayanan_daftar_rawatjalan.paymentmethodname, transaksi_pelayanan_daftar_rawatjalan.bpjs_sep');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.pasienid', $referencenumber);
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatjalan.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_validasi_rawatinap');
        $this->dt->join('transaksi_pelayanan_pulang_rawatinap', 'transaksi_pelayanan_pulang_rawatinap.referencenumber=transaksi_pelayanan_validasi_rawatinap.referencenumber', 'left');
        $this->dt->select(' transaksi_pelayanan_validasi_rawatinap.referencenumber ,  transaksi_pelayanan_validasi_rawatinap.datein, transaksi_pelayanan_validasi_rawatinap.groups, transaksi_pelayanan_validasi_rawatinap.pasienid,  transaksi_pelayanan_validasi_rawatinap.doktername, transaksi_pelayanan_validasi_rawatinap.icdx, transaksi_pelayanan_validasi_rawatinap.icdxname, transaksi_pelayanan_pulang_rawatinap.dateout, transaksi_pelayanan_pulang_rawatinap.statuspasien, transaksi_pelayanan_pulang_rawatinap.roomname, transaksi_pelayanan_pulang_rawatinap.paymentmethodname');
        $this->dt->where('transaksi_pelayanan_validasi_rawatinap.pasienid', $referencenumber);
        $this->dt->like('transaksi_pelayanan_validasi_rawatinap.types', 'BARU');
        $this->dt->orderBy('transaksi_pelayanan_validasi_rawatinap.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_operasi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select('  transaksi_pelayanan_rawatinap_operasi_detail.id,  transaksi_pelayanan_rawatinap_operasi_detail.journalnumber,   transaksi_pelayanan_rawatinap_operasi_detail.documentdate,  transaksi_pelayanan_rawatinap_operasi_detail.types,  transaksi_pelayanan_rawatinap_operasi_detail.relation,  transaksi_pelayanan_rawatinap_operasi_detail.operationgroup,  transaksi_pelayanan_rawatinap_operasi_detail.name,  transaksi_pelayanan_rawatinap_operasi_detail.doktername ');
        $this->dt->where(' transaksi_pelayanan_rawatinap_operasi_detail.relation', $referencenumber);
        $this->dt->orderBy(' transaksi_pelayanan_rawatinap_operasi_detail.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_penunjang($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('  transaksi_pelayanan_penunjang_detail.id,  transaksi_pelayanan_penunjang_detail.journalnumber,   transaksi_pelayanan_penunjang_detail.documentdate,  transaksi_pelayanan_penunjang_detail.types,  transaksi_pelayanan_penunjang_detail.relation,  transaksi_pelayanan_penunjang_detail.name,  transaksi_pelayanan_penunjang_detail.employeename ');
        $this->dt->where(' transaksi_pelayanan_penunjang_detail.relation', $referencenumber);
        $this->dt->orderBy(' transaksi_pelayanan_penunjang_detail.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_farmasi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select(' transaksi_farmasi_pelayanan_detail.journalnumber ,  transaksi_farmasi_pelayanan_detail.documentdate, transaksi_farmasi_pelayanan_detail.poliklinikname, transaksi_farmasi_pelayanan_detail.doktername, transaksi_farmasi_pelayanan_detail.name');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.relation', $referencenumber);
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $this->dt->limit(50);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_diagnosa_sekarang($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select('transaksi_rekammedik_rawatjalan_detail.id, transaksi_rekammedik_rawatjalan_detail.journalnumber ,  transaksi_rekammedik_rawatjalan_detail.documentdate, transaksi_rekammedik_rawatjalan_detail.types, transaksi_rekammedik_rawatjalan_detail.relation, transaksi_rekammedik_rawatjalan_detail.poliklinikname, transaksi_rekammedik_rawatjalan_detail.doktername, transaksi_rekammedik_rawatjalan_detail.coding, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx, transaksi_rekammedik_rawatjalan_detail.codeicdix, transaksi_rekammedik_rawatjalan_detail.nameicdix, transaksi_rekammedik_rawatjalan_detail.createddate, transaksi_rekammedik_rawatjalan_detail.createdby, transaksi_rekammedik_rawatjalan_detail.referencenumber, transaksi_rekammedik_rawatjalan_detail.referencenumber_rawatinap, transaksi_rekammedik_rawatjalan_detail.kategori');
        $this->dt->where('transaksi_rekammedik_rawatjalan_detail.referencenumber', $referencenumber);
        $this->dt->orderBy('transaksi_rekammedik_rawatjalan_detail.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_diagnosa_sekarang_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select('transaksi_rekammedik_rawatjalan_detail.id, transaksi_rekammedik_rawatjalan_detail.journalnumber ,  transaksi_rekammedik_rawatjalan_detail.documentdate, transaksi_rekammedik_rawatjalan_detail.types, transaksi_rekammedik_rawatjalan_detail.relation, transaksi_rekammedik_rawatjalan_detail.poliklinikname, transaksi_rekammedik_rawatjalan_detail.doktername, transaksi_rekammedik_rawatjalan_detail.coding, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx, transaksi_rekammedik_rawatjalan_detail.codeicdix, transaksi_rekammedik_rawatjalan_detail.nameicdix, transaksi_rekammedik_rawatjalan_detail.createddate, transaksi_rekammedik_rawatjalan_detail.createdby, transaksi_rekammedik_rawatjalan_detail.referencenumber, transaksi_rekammedik_rawatjalan_detail.referencenumber_rawatinap, transaksi_rekammedik_rawatjalan_detail.kategori');
        $this->dt->where('transaksi_rekammedik_rawatjalan_detail.referencenumber_rawatinap', $referencenumber);
        $this->dt->where('transaksi_rekammedik_rawatjalan_detail.types', 'RI');
        $this->dt->orderBy('transaksi_rekammedik_rawatjalan_detail.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

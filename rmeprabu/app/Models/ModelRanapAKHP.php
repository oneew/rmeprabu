<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRanapAKHP extends Model
{

    protected $table      = 'transaksi_pelayanan_daftar_rawatjalan';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';

    public function search($keyword)
    {

        return $this->table('transaksi_pelayanan_daftar_rawatjalan')
            ->where('statusrawatinap', 'RAWAT')
            ->like('pasienid', $keyword)
            ->orLike('smfname', $keyword);
    }

    function ambildatarajal()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('validation', 'BELUM');
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(400);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pjb()
    {
        $this->dt = $this->db->table('hubungan_pjb');
        $this->dt->orderBy('hubunganpjb');
        $this->dt->select(' hubunganpjb , id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelas()
    {
        $this->dt = $this->db->table('pelayanan_kelas');

        $this->dt->select(' code , id , name');
        $this->dt->notLIKE('vclaimclass', 'NULL ');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kamar()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id ');
        $this->dt->groupBy('roomname');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_bed()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id ');
        $this->dt->where('status', 'KOSONG');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_smf()
    {
        $this->dt = $this->db->table('pelayanan_smf');
        $this->dt->select(' code ,  name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // list uniq room berdasar kelas (combobox2)
    function get_room_name($classroom)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->orderBy('room');
        $this->dt->select(' room , roomname , id ');
        $this->dt->groupBy('room');
        $this->dt->where('classroom', $classroom);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // list room kosong (combobox3)
    function get_room_list($roomname, $classroom)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code , id ');
        $this->dt->where('roomname', $roomname);
        $this->dt->where('classroom', $classroom);
        $this->dt->where('status', 'KOSONG');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataranapibs($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_header_pelayanan_AKHP($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_detail_pelayanan_AKHP($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.id, transaksi_farmasi_pelayanan_detail.r, transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.qty as qtypaket, transaksi_farmasi_pelayanan_detail.batchnumber, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.documentdate, transaksi_farmasi_pelayanan_detail.locationcode');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_detail.qty <>', 0);
        //$this->dt->like('transaksi_farmasi_pelayanan_header.journalnumber', 'RBNAKHPBHPRI');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function aturan_pakai()
    {
        $this->dt = $this->db->table('eticket_aturan');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cara_pakai()
    {
        $this->dt = $this->db->table('eticket_carapakai');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cara_petunjuk()
    {
        $this->dt = $this->db->table('eticket_petunjuk');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelranapOrderRad extends Model
{

    protected $table      = 'transaksi_pelayanan_daftar_rawatinap';
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
        $kondisi = ['REGISTER', 'RAWAT'];
        $this->dt = $this->db->table($this->table);
        $this->dt->whereIn('statusrawatinap', $kondisi);
        $this->dt->orderBy('documentdate', 'DESC');
        $this->dt->limit(600);
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
}

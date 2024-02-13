<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelranapOrderPenunjang extends Model
{

    protected $table      = 'transaksi_pelayanan_penunjang_header';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    function get_data_token($token_radiologi)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('token_radiologi', $token_radiologi);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_tokenbyID($id)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_admission_ambulance($token_radiologi)
    {
        $tb = "admission_ambulance";
        $this->dt = $this->db->table($tb);
        $this->dt->where('token_ambulance', $token_radiologi);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_admission_ambulance_journalnumber($journalnumber)
    {
        $tb = "admission_ambulance";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_tokenbyID_validasi($id)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_FRS($journalnumber)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien($pasienid)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }





    public function search($keyword)
    {

        return $this->table('transaksi_pelayanan_daftar_rawatjalan')
            ->where('statusrawatinap', 'RAWAT')
            ->like('pasienid', $keyword)
            ->orLike('smfname', $keyword);
    }

    function ambildatarajal()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('note', 'ORDER');
        $this->dt->notLike('classroom', 'IRJ');
        $this->dt->notLike('classroom', 'IGD');
        $this->dt->orderBy('documentdate', 'DESC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajalsop()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('note', 'ORDER');
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('documentdate', 'DESC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigdsop()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('note', 'ORDER');
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('documentdate', 'DESC');
        $this->dt->limit(100);
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

    function get_data_admission_forensik($token_radiologi)
    {
        $tb = "admission_forensik";
        $this->dt = $this->db->table($tb);
        $this->dt->where('token_forensik', $token_radiologi);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_admission_forensik_journalnumber($journalnumber)
    {
        $tb = "admission_forensik";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_admission_FRS_journalnumber($journalnumber)
    {
        $tb = "admission_forensik";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_admission_surat_kematian_journalnumber($journalnumber)
    {
        $tb = "admission_suratkematian";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_header_penunjang($journalnumber)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    // tambahan kang deni
    function get_data_header_penunjang_baru($id)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_data_nik($pasienid)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeledukasibedah extends Model
{

    protected $table      = 'book_operasi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_tprod', 'journalnumber', 'referencenumber', 'pasienid', 'pasienname', 'paymentmethod', 'cases', 'name', 'ibsdoktername', 'ibsanestesiname',
        'jenis_anestesi', 'room', 'dt_advice_op', 'diagnosa_prabedah', 'user', 'groupname', 'kodebooking', 'tanggaloperasi', 'kodepoli', 'namapoli', 'cardnumber'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    function get_data_token($token_ibs)
    {
        $tb = "transaksi_pelayanan_rawatinap_operasi_header";
        $this->dt = $this->db->table($tb);
        //$this->dt->select(' name , id , code , memo ');
        $this->dt->where('token_ibs', $token_ibs);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs($id)
    {
        $tb = "transaksi_pelayanan_rawatinap_operasi_header";
        $this->dt = $this->db->table($tb);
        //$this->dt->select(' name , id , code , memo ');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_book()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->select(' id ,id_tprod, pasienname , edukasibedah , persetujuanoperasi , konsultasidpjplain ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function edit_book($post)
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('id', $post['id']);
        $this->dt->update([$post['field'] => $post['value']]);
    }

    function get_book($journalnumber)
    {
        $this->dt = $this->db->table('book_operasi');
        $this->dt->where('journalnumber', $journalnumber);

        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

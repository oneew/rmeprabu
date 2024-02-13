<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelVisiteDetail extends Model
{

    protected $table      = 'transaksi_pelayanan_rawatinap_visite_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'documentdate', 'relation', 'relationname', 'paymentmethod', 'paymentmethodname', 'classroom', 'classroomname', 'room',
        'roomname', 'smf', 'smfname', 'dokter', 'doktername', 'registernumber', 'referencenumber', 'referencenumberparent',
        'locationcode', 'code', 'name', 'qty', 'groups', 'groupname', 'price', 'bhp', 'totaltarif', 'totalbhp',
        'subtotal', 'disc', 'totaldiscount', 'grandtotal', 'share1', 'share2', 'share21', 'share22', 'memo', 'createdby', 'createddate', 'created_at', 'updated_at',
        'paramedicName', 'koinsiden'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';




    function ambildatarajal()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('statuspasien', 'REGISTRASI');
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

        $this->dt->select(' code , id ');
        $this->dt->notLIKE('vclaimclass', 'NULL ');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kamar($classroom)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id , room');
        $this->dt->where('classroom', $classroom);
        $this->dt->groupBy('roomname');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_bed($room)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id ');
        $this->dt->where('status', 'KOSONG');
        $this->dt->where('room', $room);
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

    function search($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('referencenumber', $referencenumber);
        //$this->dt->notLIKE('doktername', 'PERAWAT');
        $this->dt->LIKE('groups', 'VISITE');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAskep($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('referencenumber', $referencenumber);
        //$this->dt->LIKE('doktername', 'PERAWAT');
        $this->dt->LIKE('name', 'ASUHAN');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

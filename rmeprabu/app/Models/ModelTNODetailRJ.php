<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTNODetailRJ extends Model
{

    protected $table      = 'transaksi_pelayanan_rawatjalan_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'journalnumber', 'documentdate', 'relation', 'relationname', 'paymentmethod', 'paymentmethodname', 'poliklinik', 'poliklinikname', 'smf',
        'smfname', 'employee', 'employeename', 'dokter', 'doktername', 'referencenumber', 'locationcode', 'code', 'name', 'qty', 'groups', 'groupname',  'price', 'disc', 'totaldiscount', 'totalbhp', 'subtotal',
        'share1', 'share2', 'share21', 'share22', 'memo', 'createdby', 'createddate', 'created_at', 'updated_at', 'pelaksana', 'paramedicName', 'validasipembayaran',
        'tanggalvalidasipembayaran', 'kasirvalidasi'
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
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('types', 'IRJ');
        //$this->dt->notLike('name', 'GIZI');
        $this->dt->orderBy('doktername', 'ASC');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Operasi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchtnoranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchVisite($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function _rincian($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_igd_validation($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_igd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('types', 'IGD');
        //$this->dt->notLike('name', 'GIZI');
        $this->dt->orderBy('doktername', 'ASC');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function _rincian2($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('types', 'IRJ');
        $this->dt->notLike('name', 'GIZI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Pemeriksaan($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function searchAsupanGizi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->like('name', 'SALAH');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }




    function Operasi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Operasirajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->join('transaksi_pelayanan_rawatinap_operasi_header', 'transaksi_pelayanan_rawatinap_operasi_header.journalnumber=transaksi_pelayanan_rawatinap_operasi_detail.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_rawatinap_operasi_detail.id, transaksi_pelayanan_rawatinap_operasi_detail.journalnumber, transaksi_pelayanan_rawatinap_operasi_detail.documentdate, transaksi_pelayanan_rawatinap_operasi_detail.name,
        transaksi_pelayanan_rawatinap_operasi_detail.doktername, transaksi_pelayanan_rawatinap_operasi_detail.totaltarif, transaksi_pelayanan_rawatinap_operasi_detail.types');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_detail.referencenumber', $referencenumber);
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.asal_pasien', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Operasiigd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjang($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangrajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangrajalrad($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'RAD');
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangranaprad($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'RAD');
        $this->dt->notlike('smf', 'NONE');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangigdrad($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'RAD');
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangrajallpk($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'LPK');
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangranaplpk($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'LPK');
        $this->dt->notlike('smf', 'NONE');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangigdlpk($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'LPK');
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangrajallpa($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'LPA');
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangranaplpa($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'LPA');
        $this->dt->notlike('smf', 'NONE');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangigdlpa($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'LPA');
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangrajalbd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'BD');
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangranapbd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'BD');
        $this->dt->notlike('smf', 'NONE');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangigdbd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'BD');
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Kasir_Penunjangrajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangigd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Ambulanceigd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjang_klinik($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjang_igd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangheader($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangheaderigd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangheaderrajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        // $this->dt->where('jurnalnumber', $referencenumber);
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();

    }



    function BHP($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPrajal($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IRJ');
        $this->dt->notLIKE('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function KasirBHPrajal_penunjang($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $referencenumber);
        //$this->dt->notLIKE('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPIgd($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('types, journalnumber , documentdate, name, createdby, SUM(totalbhp)as totalbhp ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->notLIKE('types', 'BD');
        $this->dt->groupBy('types');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }




    function search_farmasi_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, transaksi_farmasi_pelayanan_detail.name');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function FARMASIrajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );

        $this->dt->select(' 
            transaksi_farmasi_pelayanan_detail.journalnumber,  
            transaksi_farmasi_pelayanan_detail.poliklinikname, 
            transaksi_farmasi_pelayanan_detail.name, 
            transaksi_farmasi_pelayanan_detail.doktername, 
            transaksi_farmasi_pelayanan_detail.documentdate, 
            transaksi_farmasi_pelayanan_detail.price, 
            transaksi_farmasi_pelayanan_detail.qty,
            transaksi_farmasi_pelayanan_detail.subtotal,
            transaksi_farmasi_pelayanan_header.embalase
            ');
        // $this->dt->where('transaksi_farmasi_pelayanan_detail.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'RJ');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();

    }

    function FARMASIigd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select(' 
            transaksi_farmasi_pelayanan_detail.journalnumber,  
            transaksi_farmasi_pelayanan_detail.poliklinikname, 
            transaksi_farmasi_pelayanan_detail.name, 
            transaksi_farmasi_pelayanan_detail.doktername, 
            transaksi_farmasi_pelayanan_detail.documentdate, 
            transaksi_farmasi_pelayanan_detail.price, 
            transaksi_farmasi_pelayanan_detail.qty,
            transaksi_farmasi_pelayanan_detail.subtotal,
            transaksi_farmasi_pelayanan_header.embalase
            ');

        // $this->dt->where('transaksi_farmasi_pelayanan_detail.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function gabung($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select(' journalnumber, documentdate, name, qty, totaltarif, id ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query1 = $this->dt->get();



        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->select(' journalnumber, documentdate, name, qty, totaltarif, id ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query2 = $this->dt->get();

        $query = $this->db->query($query1 . 'UNION' . $query2);
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

    function FARMASI($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function search_diagnosa($pasienid)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select(' transaksi_rekammedik_rawatjalan_detail.journalnumber ,  transaksi_rekammedik_rawatjalan_detail.documentdate, transaksi_rekammedik_rawatjalan_detail.types, transaksi_rekammedik_rawatjalan_detail.relation, transaksi_rekammedik_rawatjalan_detail.poliklinikname, transaksi_rekammedik_rawatjalan_detail.doktername, transaksi_rekammedik_rawatjalan_detail.coding, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx, transaksi_rekammedik_rawatjalan_detail.codeicdix, transaksi_rekammedik_rawatjalan_detail.nameicdix, transaksi_rekammedik_rawatjalan_detail.createddate, transaksi_rekammedik_rawatjalan_detail.createdby, transaksi_rekammedik_rawatjalan_detail.referencenumber, transaksi_rekammedik_rawatjalan_detail.referencenumber_rawatinap');
        $this->dt->where('transaksi_rekammedik_rawatjalan_detail.relation', $pasienid);
        $this->dt->orderBy('transaksi_rekammedik_rawatjalan_detail.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_diagnosa_header($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_diagnosa_header_igd($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_diagnosa_header_ranap($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'RI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_rajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_rajal2($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('types', 'IRJ');
        $this->dt->notLike('name', 'GIZI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_visum($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_igd_rajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        //$this->dt->Like('types', 'IGD');
        //$this->dt->notLike('name', 'GIZI');
        $this->dt->orderBy('doktername', 'ASC');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjang_igd_rajal($referencenumber, $asal)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        if ($asal == "IGD") {
            $this->dt->where('classroom', 'IGD');
        } else if ($asal == "IRJ") {
            $this->dt->where('classroom', 'IRJ');
        }

        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIigd_rajal($referencenumber, $asal)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);


        if ($asal == "IGD") {
            $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        } else if ($asal == "IRJ") {
            $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'IRJ');
        }


        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_tindakan_igd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('types', 'IGD');
        //$this->dt->notLike('name', 'GIZI');
        $this->dt->orderBy('doktername', 'ASC');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_daftar_igd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Kasir_Tindakanrajal($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_igd_register($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_tindakan_igd_rme($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('types', 'IGD');
        //$this->dt->notLike('name', 'GIZI');
        $this->dt->orderBy('doktername', 'ASC');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // tambahan untuk detail farmasi
    function FARMASIigd_detail($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select(' 
            transaksi_farmasi_pelayanan_detail.journalnumber,  
            transaksi_farmasi_pelayanan_detail.poliklinikname, 
            transaksi_farmasi_pelayanan_detail.name, 
            transaksi_farmasi_pelayanan_detail.doktername, 
            transaksi_farmasi_pelayanan_detail.documentdate, 
            transaksi_farmasi_pelayanan_detail.price, 
            transaksi_farmasi_pelayanan_detail.qty,
            transaksi_farmasi_pelayanan_detail.subtotal,
            transaksi_farmasi_pelayanan_header.embalase
            ');
        // $this->dt->where('transaksi_farmasi_pelayanan_detail.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPIgd_detail($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->notLIKE('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIrajal_detail($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select(' 
            transaksi_farmasi_pelayanan_detail.journalnumber,  
            transaksi_farmasi_pelayanan_detail.poliklinikname, 
            transaksi_farmasi_pelayanan_detail.name, 
            transaksi_farmasi_pelayanan_detail.doktername, 
            transaksi_farmasi_pelayanan_detail.documentdate, 
            transaksi_farmasi_pelayanan_detail.price, 
            transaksi_farmasi_pelayanan_detail.qty,
            transaksi_farmasi_pelayanan_detail.subtotal,
            transaksi_farmasi_pelayanan_header.embalase
            ');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'IRJ');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPrajal_detail($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('classroom', 'IRJ');
        $this->dt->notLIKE('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_tindakan_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('types', 'TNO');
        //$this->dt->notLike('name', 'GIZI');
        $this->dt->orderBy('doktername', 'ASC');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;

class ModelCetakKoinsiden_A extends Model
{

    protected $table      = 'transaksi_pelayanan_rawatinap_tindakan_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'journalnumber', 'documentdate', 'relation', 'relationname', 'paymentmethod', 'paymentmethodname', 'classroom', 'classroomname', 'room',
        'roomname', 'smf', 'smfname', 'dokter', 'doktername', 'doktergeneral', 'doktergeneralname', 'registernumber', 'referencenumber', 'referencenumberparent',
        'locationcode', 'code', 'name', 'qty', 'groups', 'groupname', 'category', 'categoryname', 'status', 'price', 'bhp', 'totaltarif', 'totalbhp',
        'subtotal', 'disc', 'totaldiscount', 'grandtotal', 'share1', 'share2', 'share21', 'share22', 'memo', 'createdby', 'createddate', 'created_at', 'updated_at', 'pelaksana', 'paramedicName', 'koinsiden'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    function searchVisitePilihanNonKoinsiden_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->select('journalnumber, referencenumber, price, name, SUM(qty) as qty, SUM(totaltarif) as totaltarif, paymentmethodname, koinsiden');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->groupBy('name');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchTNOPilihanNonKoinsiden_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select('journalnumber, referencenumber, price, name, SUM(qty) as qty, SUM(subtotal) as subtotal, paymentmethodname, koinsiden');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangdetailPilihanRanapNonKoinsiden_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_penunjang_header.totalamount,
            transaksi_pelayanan_penunjang_detail.subtotal, 
            transaksi_pelayanan_penunjang_header.documentdate, 
            transaksi_pelayanan_penunjang_header.groups, 
            SUM(transaksi_pelayanan_penunjang_header.totalamount) as totalamount,
            transaksi_pelayanan_penunjang_header.journalnumber,
            transaksi_pelayanan_penunjang_detail.types,
            transaksi_pelayanan_penunjang_detail.price,
            SUM(transaksi_pelayanan_penunjang_detail.qty) as qty,
            transaksi_pelayanan_penunjang_detail.name,
            transaksi_pelayanan_penunjang_detail.koinsiden');
        $this->dt->where('transaksi_pelayanan_penunjang_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_pelayanan_penunjang_detail.koinsiden', 1);
        $this->dt->like('transaksi_pelayanan_penunjang_header.paymentmethod', $pilihancabar);
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IRJ');
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IGD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPpenunjangranapPilihanKoinsiden_Al($referencenumber, $pilihancabar)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber , journalnumber , types , SUM(totalbhp)as totalbhp ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->like('koinsiden', 1);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->groupBy('types');
        //$this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAsupanGiziPilihanNonKoinsiden_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select('types, referencenumber, paymentmethodname, name, price, SUM(qty) as qty, SUM(totaltarif) as totaltarif, koinsiden');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->groupBy('name');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function OperasiPilihan_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->like('koinsiden', 1);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIPilihanNonKoinsiden_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  
            transaksi_farmasi_pelayanan_header.documentdate, 
            transaksi_farmasi_pelayanan_header.poliklinikname, 
            transaksi_farmasi_pelayanan_header.doktername, 
            SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, 
            transaksi_farmasi_pelayanan_header.embalase,
            transaksi_farmasi_pelayanan_header.koinsiden');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.koinsiden', 1);
        $this->dt->notLIKE('transaksi_farmasi_pelayanan_header.groups', "IGD");
        $this->dt->notLIKE('transaksi_farmasi_pelayanan_header.groups', "IRJ");
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FarmasiRajalIgdKoinsiden_Al($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  
        transaksi_farmasi_pelayanan_header.documentdate, 
        transaksi_farmasi_pelayanan_header.poliklinikname, 
        transaksi_farmasi_pelayanan_header.doktername, 
        transaksi_farmasi_pelayanan_header.embalase, 
        transaksi_farmasi_pelayanan_header.koinsiden, 
        transaksi_farmasi_pelayanan_header.groups, 
        transaksi_farmasi_pelayanan_header.paymentmethodname,
        SUM(transaksi_farmasi_pelayanan_detail.qty *transaksi_farmasi_pelayanan_detail.price)as totalharga,
        transaksi_farmasi_pelayanan_header.koinsiden');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.koinsiden', 1);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PemeriksaanIGD_Al($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->like('koinsiden', 1);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function TindakanIGD_Al($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->select('referencenumber, price, name, SUM(qty) as qty, SUM(subtotal) as subtotal, koinsiden',);
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->groupBy('name');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangigdrajalKoinsidenKasir_Al($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('types, referencenumber, name, price, SUM(qty) as qty, SUM(subtotal) as subtotal, koinsiden');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('smf', 'NONE');
        $this->dt->where('koinsiden', 1);
        // $this->dt->limit(30);
        $this->dt->groupBy('name');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

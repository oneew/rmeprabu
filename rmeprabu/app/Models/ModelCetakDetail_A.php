<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;

class ModelCetakDetail_A extends Model
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


    function searchVisitePilihan_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->select('referencenumber, paymentmethodname, name, price, SUM(qty) as qty, SUM(totaltarif) as totaltarif');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->groupBy('name');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchTNOPilihan_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select('referencenumber, paymentmethodname, types, name, price, SUM(qty) as qty, SUM(subtotal) as subtotal');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangdetailPilihanRanap_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_penunjang_header.totalamount,
            transaksi_pelayanan_penunjang_detail.subtotal, 
            transaksi_pelayanan_penunjang_header.documentdate, 
            transaksi_pelayanan_penunjang_header.groups, 
            transaksi_pelayanan_penunjang_header.totalamount,
            transaksi_pelayanan_penunjang_header.journalnumber,
            transaksi_pelayanan_penunjang_detail.name,
            transaksi_pelayanan_penunjang_detail.types,
            transaksi_pelayanan_penunjang_detail.price,
            SUM(transaksi_pelayanan_penunjang_detail.qty) as qty,
            SUM(transaksi_pelayanan_penunjang_detail.subtotal) as subtotal');
        $this->dt->where('transaksi_pelayanan_penunjang_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_pelayanan_penunjang_header.paymentmethod', $pilihancabar);
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IRJ');
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IGD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.types');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIPilihan_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,
            transaksi_farmasi_pelayanan_header.groups,  
            transaksi_farmasi_pelayanan_header.documentdate, 
            transaksi_farmasi_pelayanan_header.poliklinikname, 
            transaksi_farmasi_pelayanan_header.doktername, 
            SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, 
            transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', "IGD");
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', "IRJ");
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FarmasiRajalIgdDetail_Al($referencenumber)
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
        SUM(transaksi_farmasi_pelayanan_detail.qty *transaksi_farmasi_pelayanan_detail.price) as totalharga');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        // $this->dt->like('transaksi_farmasi_pelayanan_header.koinsiden', 1);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPpenunjangranapPilihan_Al($referencenumber, $pilihancabar)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber , journalnumber , types , SUM(totalbhp)as totalbhp ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->groupBy('types');
        //$this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAsupanGiziPilihan_Al($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select('types, name, price, SUM(qty) as qty, SUM(totaltarif) as totaltarif');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
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
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PemeriksaanIGD_Al($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function TindakanIGD_Al($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->select('referencenumber, name, price, SUM(qty) as qty, SUM(subtotal) as subtotal');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->groupBy('name');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangigdrajal_Al($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber, name, price, SUM(qty) as qty, SUM(subtotal) as subtotal, types, classroom');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('smf', 'NONE');
        $this->dt->notLIKE('classroom', "RI");
        $this->dt->groupBy('name');
        $this->dt->orderBy('types');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // tambahan cetak rincian secara detail tidak di grupkan
    function searchVisitePilihan_Al_non_group($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->select('referencenumber, paymentmethodname, name, price, qty, totaltarif, subtotal,
            createddate, doktername, room, roomname, documentdate');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchTNOPilihan_Al_non_group($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select('documentdate, referencenumber, paymentmethodname, types, name, price, qty, subtotal, 
            createddate, doktername, roomname, verifikasi');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangRanap_Al_detail_non_group($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber, documentdate, paymentmethodname, name, price, qty, subtotal, 
            types, classroom, createddate, doktername, roomname');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLIKE('classroom', "IGD");
        $this->dt->notLIKE('classroom', "IRJ");
        // $this->dt->groupBy('name');
        $this->dt->orderBy('types');
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIPilihan_Al_detail_non_group($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,
            transaksi_farmasi_pelayanan_header.groups,  
            transaksi_farmasi_pelayanan_header.documentdate, 
            transaksi_farmasi_pelayanan_header.poliklinik as roomname, 
            transaksi_farmasi_pelayanan_header.doktername, 
            transaksi_farmasi_pelayanan_detail.name, 
            transaksi_farmasi_pelayanan_detail.price, 
            transaksi_farmasi_pelayanan_detail.qty as qty, 
            transaksi_farmasi_pelayanan_detail.subtotal as total, 
            transaksi_farmasi_pelayanan_detail.createddate,
            transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPORINAP');
        $this->dt->like('transaksi_farmasi_pelayanan_detail.paymentmethod', $pilihancabar);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', "IGD");
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', "IRJ");
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.documentdate');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    
    function FARMASIPilihan_Al_detail_non_group_IBS($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,
            transaksi_farmasi_pelayanan_header.groups,  
            transaksi_farmasi_pelayanan_header.documentdate, 
            transaksi_farmasi_pelayanan_header.poliklinik as roomname, 
            transaksi_farmasi_pelayanan_header.doktername, 
            transaksi_farmasi_pelayanan_detail.name, 
            transaksi_farmasi_pelayanan_detail.price, 
            transaksi_farmasi_pelayanan_detail.qty as qty, 
            transaksi_farmasi_pelayanan_detail.subtotal as total, 
            transaksi_farmasi_pelayanan_detail.createddate,
            transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPOOK');
        $this->dt->like('transaksi_farmasi_pelayanan_detail.paymentmethod', $pilihancabar);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', "IGD");
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', "IRJ");
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.documentdate');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPpenunjangranapPilihan_Al_non_group($referencenumber, $pilihancabar)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber , paymentmethodname, journalnumber , types , totalbhp, qty, price, name, 
            createddate, roomname, doktername, documentdate');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLIKE('smf', 'NONE');
        // $this->dt->notLIKE('types', 'BD');
        // $this->dt->notLIKE('classroom', 'IRJ');
        // $this->dt->notLIKE('classroom', 'IGD');
        // $this->dt->groupBy('types');
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAsupanGiziPilihan_Al_non_group($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select('types, referencenumber, name, price, qty, totaltarif, createddate,
            documentdate, paymentmethodname, doktername, roomname');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function OperasiPilihan_Al_non_group($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select('referencenumber, name, price, qty, totaltarif, createddate,
            documentdate, paymentmethodname, doktername, roomname, room');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PemeriksaanIGD_Al_non_group($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function TindakanIGD_Al_non_group($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->select('documentdate, referencenumber, name, price, qty, subtotal, createddate, 
            doktername, poliklinikname');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangigdrajal_Al_non_group($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber, documentdate, name, price, qty, subtotal, 
            types, classroom, createddate, doktername, roomname');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('smf', 'NONE');
        $this->dt->notLIKE('classroom', "RI");
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('types');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FarmasiRajalIgdDetail_Al_non_group($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,
                transaksi_farmasi_pelayanan_header.groups,  
                transaksi_farmasi_pelayanan_header.documentdate, 
                transaksi_farmasi_pelayanan_header.poliklinikname as roomname, 
                transaksi_farmasi_pelayanan_header.doktername, 
                transaksi_farmasi_pelayanan_detail.name, 
                transaksi_farmasi_pelayanan_detail.price, 
                transaksi_farmasi_pelayanan_detail.qty as qty, 
                transaksi_farmasi_pelayanan_detail.subtotal as total, 
                transaksi_farmasi_pelayanan_detail.createddate,
                transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', 'RI');
        // $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        
        // $this->dt->where('transaksi_farmasi_pelayanan_detail.referencenumber', $referencenumber);
        // $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', "RI");
        // // $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', "IRJ");
        // $this->dt->orderBy('transaksi_farmasi_pelayanan_header.journalnumber');
        // $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.documentdate');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPpenunjangIgd_Pilihan_Al_non_group($referencenumber, $pilihancabar)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber , paymentmethodname, journalnumber , types , totalbhp, qty, price, name, 
            createddate, roomname, doktername, documentdate');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->LIKE('smf', 'NONE');
        // $this->dt->notLIKE('types', 'BD');
        // $this->dt->notLIKE('classroom', 'IRJ');
        // $this->dt->notLIKE('classroom', 'IGD');
        // $this->dt->groupBy('types');
        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function OperasiPilihanIGD_Al_non_group($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select('referencenumber, name, price, qty, totaltarif, createddate,
            documentdate, paymentmethodname, doktername, roomname, room');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        // $this->dt->like('room', 'IGD');
        // $this->dt->like('room', 'PL-');

        $this->dt->orderBy('documentdate');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

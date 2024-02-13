<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTNODetail extends Model
{

    protected $table      = 'transaksi_pelayanan_rawatinap_tindakan_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'journalnumber', 'documentdate', 'relation', 'relationname', 'paymentmethod', 'paymentmethodname', 'classroom', 'classroomname', 'room',
        'roomname', 'smf', 'smfname', 'dokter', 'doktername', 'doktergeneral', 'doktergeneralname', 'registernumber', 'referencenumber', 'referencenumberparent',
        'locationcode', 'code', 'name', 'qty', 'groups', 'groupname', 'category', 'categoryname', 'status', 'price', 'bhp', 'totaltarif', 'totalbhp',
        'subtotal', 'disc', 'totaldiscount', 'grandtotal', 'share1', 'share2', 'share21', 'share22', 'memo', 'createdby', 'createddate', 'created_at', 'updated_at', 'pelaksana', 'koinsiden', 'ahli_gizi', 'bed_gizi', 'waktu', 'locationname', 'documentyear', 'documentmonth', 'pasienage', 'pasiendateofbirth'
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
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function searchAsupanGizi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
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


    function Operasi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjang($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLike('smf', 'NONE');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangigdrajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('smf', 'NONE');
        $this->dt->limit(30);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function SummaryPenunjangigdrajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        //$this->dt->select('groups, employeename, journalnumber, SUM(totalamount)as totalamount, documentdate, verifikasi');
        $this->dt->select('groups, employeename, journalnumber, SUM(totalamount)as totalamount, documentdate');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('totalamount > 0');
        $this->dt->Like('smf', 'NONE');
        $this->dt->groupBy('groups');
        $this->dt->limit(30);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function SummaryBHPigdrajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('types, journalnumber, SUM(totalbhp)as totalbhp, documentdate');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('smf', 'NONE');
        $this->dt->groupBy('types');
        $this->dt->limit(30);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangheader($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Kamar($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->join('pelayanan_kelas', 'pelayanan_kelas.code=transaksi_pelayanan_daftar_rawatinap.classroom', 'left');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLike('statusrawatinap', 'BATAL');
        //$this->dt->orderBy('transaksi_pelayanan_daftar_rawatinap.id', 'ASC');
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatinap.datetimein', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PemeriksaanIGD($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function TindakanIGD($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHP($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLIKE('smf', 'NONE');
        $this->dt->notLIKE('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPpenunjangranap2($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPpenunjangigd2($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->LIKE('smf', 'NONE');

        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPpenunjangranap($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber , journalnumber , types , SUM(totalbhp)as totalbhp ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->groupBy('types');
        //$this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function FARMASI($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  
            transaksi_farmasi_pelayanan_header.documentdate, 
            transaksi_farmasi_pelayanan_header.poliklinik, 
            transaksi_farmasi_pelayanan_header.poliklinikname, 
            transaksi_farmasi_pelayanan_header.doktername, 
            SUM(transaksi_farmasi_pelayanan_detail.price * transaksi_farmasi_pelayanan_detail.qty) as price, 
            transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIRANAP($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_header.koinsiden, transaksi_farmasi_pelayanan_header.paymentmethodname');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIRANAPVERIFIKASI($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.id, transaksi_farmasi_pelayanan_header.journalnumber ,transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_header.koinsiden, transaksi_farmasi_pelayanan_header.paymentmethodname');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIRAJAL($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RJ');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIIGD($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
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

    function TagihanAsal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function UangMuka($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('types', 'UM');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cekverifikasi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function searchPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAsupanGiziPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchVisitePilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function OperasiPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLike('smf', 'NONE');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function FARMASIRANAPPILIHAN($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.id, transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_header.paymentmethodname, transaksi_farmasi_pelayanan_header.koinsiden');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function BHPPilihan($referencenumber, $pilihancabar)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLIKE('smf', 'NONE');
        $this->dt->notLIKE('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIIGDRAJALVERIFIKASI($referencenumber)
    {
        $groups = ['IGD', 'RJ'];
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_header.koinsiden, transaksi_farmasi_pelayanan_header.paymentmethodname');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->whereIn('transaksi_farmasi_pelayanan_header.groups', $groups);
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    //koinsiden kasir
    function searchPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->like('koinsiden', $koinsiden);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAsupanGiziPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->like('koinsiden', $koinsiden);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchVisitePilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->like('koinsiden', $koinsiden);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function OperasiPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->like('koinsiden', $koinsiden);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangPilihanKoinsiden($referencenumber, $pilihancabar, $koinsiden)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->like('koinsiden', $koinsiden);
        $this->dt->notLike('smf', 'NONE');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIRANAPPILIHANKoinsiden($referencenumber, $pilihancabar, $koinsiden)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.id, transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_header.paymentmethodname, transaksi_farmasi_pelayanan_header.koinsiden');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        $this->dt->like('koinsiden', $koinsiden);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FarmasiRajalIgd($referencenumber)
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
        SUM(transaksi_farmasi_pelayanan_detail.qty *transaksi_farmasi_pelayanan_detail.price)as totalharga');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function TindakanIGDKoinsiden($referencenumber, $koinsiden)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('koinsiden', $koinsiden);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangigdrajalKoinsiden($referencenumber, $koinsiden)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('smf', 'NONE');
        $this->dt->like('koinsiden', $koinsiden);
        $this->dt->limit(30);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function FarmasiRajalIgdKoinsiden($referencenumber, $koinsiden)
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
        SUM(transaksi_farmasi_pelayanan_detail.qty *transaksi_farmasi_pelayanan_detail.price)as totalharga');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.koinsiden', $koinsiden);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function TindakanIGDKoinsidenKasir($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangigdrajalKoinsidenKasir($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('smf', 'NONE');
        $this->dt->where('koinsiden', 1);
        $this->dt->limit(30);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FarmasiRajalIgdKoinsidenKasir($referencenumber)
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
        SUM(transaksi_farmasi_pelayanan_detail.qty *transaksi_farmasi_pelayanan_detail.price)as totalharga');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.koinsiden', 1);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PemeriksaanIGDKoinsiden($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cek_tindakan($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function cek_faktur($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function cek_titipan($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function cek_harga_kelas($kelas_pasien)
    {
        $this->dt = $this->db->table('pelayanan_kelas');
        $this->dt->where('code', $kelas_pasien);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function cek_faktur_nonpbf($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_nonpbf_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    // tambahan kasir aliit
    function kasir_apotek_rinap_aliit($referencenumber)
    {
        $lokasidepo = ['DEPORINAP'];
        $this->dt = $this->db->table('transaksi_kasir_apotek');
        $this->dt->selectSum('paymentamount');
        // $this->dt->select('groups, referencenumber, sum(paymentamount) as payamount');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'RI');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function kasir_apotek_rajal_aliit($referencenumber)
    {
        $lokasidepo = ['RJ', 'IGD'];
        $this->dt = $this->db->table('transaksi_kasir_apotek');
        $this->dt->selectSum('paymentamount');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->whereIn('groups', $lokasidepo);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kasir_pnj_rinap_aliit($referencenumber)
    {
        // $lokasidepo = ['IGD', 'IRJ'];
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->selectSum('paymentamount');
        $this->dt->where('referencenumber', $referencenumber);
        // $this->dt->whereIn('classroom', $lokasidepo);
        $this->dt->notLike('classroom', 'IGD');
        $this->dt->notLike('classroom', 'IRJ');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function kasir_pnj_rajal_aliit($referencenumber)
    {
        // $lokasidepo = ['DEPORINAP'];
        $lokasidepo = ['IGD', 'IRJ'];
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->selectSum('paymentamount');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->whereIn('classroom', $lokasidepo);
        // $this->dt->notLike('classroom', 'IGD');
        // $this->dt->notLike('classroom', 'IRJ');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kasir_rajal_aliit($referencenumber)
    {
        // $lokasidepo = ['DEPORINAP'];
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->selectSum('paymentamount');
        $this->dt->where('referencenumber', $referencenumber);
        // $this->dt->notLike('classroom', 'IGD');
        // $this->dt->notLike('classroom', 'IRJ');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kasir_pembayaran_tindakan_aliit($referencenumber)
    {
        // $lokasidepo = ['DEPORINAP'];
        $this->dt = $this->db->table('transaksi_pembayaran_tindakan_rajal');
        $this->dt->selectSum('paymentamount');
        $this->dt->where('referencenumber', $referencenumber);
        // $this->dt->notLike('classroom', 'IGD');
        // $this->dt->notLike('classroom', 'IRJ');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Operasi_detail($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('room', 'IGD');
        $this->dt->orLike('room', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function pembayaran_tindakan_group_aliit($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->Like('types', 'IRJ');
        $this->dt->groupBy('validasipembayaran', '1');
        $this->dt->notLike('name', 'GIZI');
        $this->dt->selectSum('subtotal');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function pembayaran_daftar_group_aliit($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->Like('groups', 'IRJ');
        $this->dt->groupBy('validasipembayaran', '1');
        $this->dt->selectSum('price');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    // tambah tanggal 25-02-2023==================
    function Kamar_group_aliit($referencenumber) // untuk tindakan menyesuaikan ruangan dan tidak double jika ruangan yg sama
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->join('pelayanan_kelas', 'pelayanan_kelas.code=transaksi_pelayanan_daftar_rawatinap.classroom', 'left');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->groupBy('transaksi_pelayanan_daftar_rawatinap.roomname');
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatinap.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIRANAP_detail_aliit($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber , 
            transaksi_farmasi_pelayanan_detail.poliklinik as roomname, 
            transaksi_farmasi_pelayanan_detail.documentdate, 
            transaksi_farmasi_pelayanan_detail.doktername, 
            transaksi_farmasi_pelayanan_detail.name, 
            transaksi_farmasi_pelayanan_detail.price, 
            transaksi_farmasi_pelayanan_detail.qty, 
            transaksi_farmasi_pelayanan_detail.subtotal, 
            transaksi_farmasi_pelayanan_detail.createddate, 
            transaksi_farmasi_pelayanan_header.embalase, 
            transaksi_farmasi_pelayanan_header.koinsiden, 
            transaksi_farmasi_pelayanan_header.paymentmethodname, 
            transaksi_farmasi_pelayanan_header.paymentvalidation');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        // $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPORINAP');
        // $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function FARMASIRANAP_IBS_detail_aliit($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber , 
            transaksi_farmasi_pelayanan_detail.poliklinik as roomname, 
            transaksi_farmasi_pelayanan_detail.documentdate, 
            transaksi_farmasi_pelayanan_detail.doktername, 
            transaksi_farmasi_pelayanan_detail.name, 
            transaksi_farmasi_pelayanan_detail.price, 
            transaksi_farmasi_pelayanan_detail.qty, 
            transaksi_farmasi_pelayanan_detail.subtotal, 
            transaksi_farmasi_pelayanan_header.embalase, 
            transaksi_farmasi_pelayanan_header.koinsiden, 
            transaksi_farmasi_pelayanan_header.paymentmethodname, 
            transaksi_farmasi_pelayanan_header.paymentvalidation');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        // $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPOOK');
        // $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIIGD_detail_aliit($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join(
            'transaksi_farmasi_pelayanan_header',
            'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
            'left'
        );
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber , 
         transaksi_farmasi_pelayanan_header.documentdate, 
         transaksi_farmasi_pelayanan_header.poliklinikname, 
         transaksi_farmasi_pelayanan_header.doktername, 
         transaksi_farmasi_pelayanan_detail.name, 
         transaksi_farmasi_pelayanan_detail.price, 
         transaksi_farmasi_pelayanan_detail.qty, 
         transaksi_farmasi_pelayanan_detail.subtotal, 
         transaksi_farmasi_pelayanan_detail.createddate, 
         transaksi_farmasi_pelayanan_header.embalase, 
         transaksi_farmasi_pelayanan_header.koinsiden, 
         transaksi_farmasi_pelayanan_header.paymentmethodname, 
         transaksi_farmasi_pelayanan_header.paymentvalidation');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->notLike('transaksi_farmasi_pelayanan_header.groups', 'RI');
        // $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // function FARMASIigd_detail($referencenumber)
    // {
    //     $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
    //     $this->dt->join(
    //         'transaksi_farmasi_pelayanan_header',
    //         'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber',
    //         'left'
    //     );
    //     $this->dt->select(' 
    //         transaksi_farmasi_pelayanan_detail.journalnumber,  
    //         transaksi_farmasi_pelayanan_detail.poliklinikname, 
    //         transaksi_farmasi_pelayanan_detail.name, 
    //         transaksi_farmasi_pelayanan_detail.doktername, 
    //         transaksi_farmasi_pelayanan_detail.documentdate, 
    //         transaksi_farmasi_pelayanan_detail.price, 
    //         transaksi_farmasi_pelayanan_detail.qty,
    //         transaksi_farmasi_pelayanan_detail.subtotal,
    //         transaksi_farmasi_pelayanan_header.embalase
    //         ');
    //     $this->dt->where('transaksi_farmasi_pelayanan_detail.referencenumber', $referencenumber);
    //     $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'IGD');
    //     $this->dt->like('transaksi_farmasi_pelayanan_header.groups', 'IRJ');
    //     $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
    //     $query = $this->dt->get();
    //     return $query->getResultArray();
    // }

    function Penunjangdetailigdrajal_aliit($referencenumber)
    {
        $kelas = ['IGD', 'IRJ'];
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->whereIn('classroom', $kelas);
        $this->dt->orderBy('types');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPenunjangDetail extends Model
{

    protected $table      = 'transaksi_pelayanan_penunjang_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'journalnumber', 'documentdate', 'relation', 'relationname', 'paymentmethod', 'paymentmethodname', 'classroom', 'classroomname', 'room',
        'roomname', 'smf', 'smfname', 'dokter', 'doktername', 'doktergeneral', 'doktergeneralname', 'registernumber', 'referencenumber', 'referencenumberparent',
        'locationcode', 'code', 'name', 'qty', 'groups', 'groupname', 'category', 'categoryname', 'status', 'price', 'bhp', 'totaltarif', 'totalbhp',
        'subtotal', 'disc', 'totaldiscount', 'grandtotal', 'share1', 'share2', 'share21', 'share22', 'memo', 'createdby', 'createddate', 'created_at', 'updated_at', 'expertiseid', 'pacsnumber', 'kelompokLab', 'paramedicName', 'koinsiden', 'goldar'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function search($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchbyjournalnumber($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->where('types', 'RAD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchbyjournalnumberLPA($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->where('types', 'LPA');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchbyjournalnumberLPK($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->where('types', 'LPK');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_histori($relation)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('relation', $relation);
        $this->dt->where('types', 'RAD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_histori_LPA($relation)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('relation', $relation);
        $this->dt->where('types', 'LPA');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_histori_LPK($relation)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('relation', $relation);
        $this->dt->where('types', 'LPK');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchbyjournalnumber_BD($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->where('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchbyjournalnumber_ABL($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->where('types', 'ABL');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchbyjournalnumber_FRS($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->where('types', 'FRS');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_histori_BD($relation)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('relation', $relation);
        $this->dt->where('types', 'BD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_histori_ABL($relation)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('relation', $relation);
        $this->dt->where('types', 'ABL');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchadmission($journalnumber)
    {
        $this->dt = $this->db->table('admission_ambulance');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_header_ambulance($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_penunjang_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLike('classroom', 'IRJ');
        $this->dt->notLike('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_penunjang_igd($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        //$this->dt->notLike('classroom', 'IRJ');
        $this->dt->Like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_penunjang_rajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        //$this->dt->notLike('classroom', 'IRJ');
        $this->dt->Like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_expertise($expertiseid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->where('idPenunjangDetail', $expertiseid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_expertise_lpa($expertiseid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpa');
        $this->dt->where('expertiseid', $expertiseid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_expertise_pinjam($expertiseid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.expertiseid=transaksi_pelayanan_penunjang_expertise.expertiseid', 'left');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_expertise.id');
        $this->dt->select('transaksi_pelayanan_penunjang_expertise.expertiseid, transaksi_pelayanan_penunjang_expertise.pacsnumber,
        transaksi_pelayanan_penunjang_expertise.createdby, transaksi_pelayanan_penunjang_expertise.created_at, transaksi_pelayanan_penunjang_detail.id,
        transaksi_pelayanan_penunjang_detail.relation, transaksi_pelayanan_penunjang_detail.relationname, transaksi_pelayanan_penunjang_detail.paymentmethod, 
        transaksi_pelayanan_penunjang_detail.doktername, transaksi_pelayanan_penunjang_detail.roomname, transaksi_pelayanan_penunjang_expertise.fotoradiologi, transaksi_pelayanan_penunjang_detail.name, transaksi_pelayanan_penunjang_detail.paymentmethodname, transaksi_pelayanan_penunjang_detail.journalnumber');
        $this->dt->where('transaksi_pelayanan_penunjang_expertise.expertiseid', $expertiseid);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_expertise($expertiseid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('expertiseid', $expertiseid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_expertise_header($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->join('transaksi_pelayanan_penunjang_header', 'transaksi_pelayanan_penunjang_header.journalnumber=transaksi_pelayanan_penunjang_detail.journalnumber', 'left');
        $this->dt->limit(1);
        $this->dt->where('transaksi_pelayanan_penunjang_detail.journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_expertise_kembali($id)
    {
        $this->dt = $this->db->table('tracing_pinjam_foto_radiologi');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_expertise_pinjam_lpa($expertiseid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpa');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.expertiseid=transaksi_pelayanan_penunjang_expertise_lpa.expertiseid', 'left');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_expertise_lpa.id');
        $this->dt->select('transaksi_pelayanan_penunjang_expertise_lpa.expertiseid, transaksi_pelayanan_penunjang_expertise_lpa.pacsnumber,
        transaksi_pelayanan_penunjang_expertise_lpa.createdby, transaksi_pelayanan_penunjang_expertise_lpa.created_at, transaksi_pelayanan_penunjang_detail.id,
        transaksi_pelayanan_penunjang_detail.relation, transaksi_pelayanan_penunjang_detail.relationname, transaksi_pelayanan_penunjang_detail.paymentmethod, 
        transaksi_pelayanan_penunjang_detail.doktername, transaksi_pelayanan_penunjang_detail.roomname, transaksi_pelayanan_penunjang_expertise_lpa.fotoradiologi, transaksi_pelayanan_penunjang_detail.name, transaksi_pelayanan_penunjang_detail.paymentmethodname, transaksi_pelayanan_penunjang_detail.journalnumber');
        $this->dt->where('transaksi_pelayanan_penunjang_expertise_lpa.expertiseid', $expertiseid);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_expertise_kembali_lpa($id)
    {
        $this->dt = $this->db->table('tracing_pinjam_foto_lpa');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_expertise_visum($expertiseid)
    {
        $this->dt = $this->db->table('admission_visum_igd');
        $this->dt->where('journalnumber', $expertiseid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_pasien($pasienid)
    {
        $this->dt = $this->db->table('pasien');
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_expertise_visum_hasil($referencenumber)
    {
        $this->dt = $this->db->table('admission_visum_igd');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function searchbyjournalnumberLPK_bridgingLis($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->join('lab_hasil', 'lab_hasil.no_order=transaksi_pelayanan_penunjang_detail.journalnumber and lab_hasil.kode_pemeriksaan=transaksi_pelayanan_penunjang_detail.code', 'left');
        $this->dt->where('transaksi_pelayanan_penunjang_detail.journalnumber', $journalnumber);
        $this->dt->where('types', 'LPK');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_expertise_lpk($expertiseid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpk');
        $this->dt->where('expertiseid', $expertiseid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_analis_lpk()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->where('types', 'LPK');
        $this->dt->where('realdokter', 0);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_paramedis($expertiseid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select('paramedis');
        $this->dt->where('journalnumber', $expertiseid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function searchbyjournalnumberHD($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->where('types', 'HEMODIALISA');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchbyjournalnumberRHM($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->where('types', 'RHM');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_expertise_radiologi($idPenunjangDetail)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->where('idPenunjangDetail', $idPenunjangDetail);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_histori_RHM($relation)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('relation', $relation);
        $this->dt->where('types', 'RHM');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_histori_HD($relation)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('relation', $relation);
        $this->dt->where('types', 'HEMODIALISA');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_tokenbyID($id)
    {
        $tb = "transaksi_pelayanan_penunjang_detail";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

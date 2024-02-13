<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTempletEresepHeader extends Model
{

    protected $table      = 'templet_e_resep_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'referencenumber',
        'nama_tindakan',	
        'nama_dokter',
        'kode_dokter',
        'created_by',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';

    function detail_e_resep() {
        $this->dt = $this->db->table('templet_e_resep_header');
        $query = $this->dt->get()->getResultArray();

        // Loop e resep header
        foreach($query as $i=>$header) {
            $this->dt = $this->db->table('templet_e_resep_detail');
            $this->dt->select('referencenumber, nama_obat, kode_obat, jumlah_obat');
            $this->dt->where('referencenumber', $header['referencenumber']);
            $detail_query = $this->dt->get()->getResultArray();
            $query[$i]['detail'] = $detail_query;
        }
        return $query;
    }

    function get_history_e_resep($pasienid) {
        $asal = ['RJ', 'IGD', 'RI'];
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('pasienid, referencenumber, journalnumber, groups, qtylayan, poliklinikname, doktername, createddate');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->whereIn('groups', $asal);
        $this->dt->where('qtylayan >', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get()->getResultArray();

        // Loop e resep header
        foreach($query as $i=>$header) {
            $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
            $this->dt->select('journalnumber, code, name, qty, signa1, signa2');
            $this->dt->where('journalnumber', $header['journalnumber']);
            $detail_query = $this->dt->get()->getResultArray();
            $query[$i]['detail'] = $detail_query;
        }

        return $query;
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;


class ModelCP extends Model
{

    protected $table      = 'diagnosa_cp';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'diagnosa', 'los', 'icd', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    #protected $updatedField  = 'updated_at';


    function ambildataranap_exist()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('statusrawatinap', 'RAWAT');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(400);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatacp()
    {
        $this->dt = $this->db->table('diagnosa_cp');
        $this->dt->distinct('diagnosa');
        $this->dt->orderBy('diagnosa', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function diagnosa_cp_pilihan($pilihancp)
    {
        $this->dt = $this->db->table('diagnosa_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function diagnosa_cp_pilihan_kolom($pilihancp)
    {
        $this->dt = $this->db->table('diagnosa_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function penunjang_cp_pilihan($pilihancp)
    {
        $this->dt = $this->db->table('penunjang_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penunjang_cp_pilihan_kolom($pilihancp)
    {
        $this->dt = $this->db->table('penunjang_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function tindakan_cp_pilihan($pilihancp)
    {
        $this->dt = $this->db->table('tindakan_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function obat_cp_pilihan($pilihancp)
    {
        $this->dt = $this->db->table('obat_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function nutrisi_cp_pilihan($pilihancp)
    {
        $this->dt = $this->db->table('nutrisi_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function mobilisasi_cp_pilihan($pilihancp)
    {
        $this->dt = $this->db->table('mobilisasi_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function hasil_cp_pilihan($pilihancp)
    {
        $this->dt = $this->db->table('hasil_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function rencana_pemulihan_cp_pilihan($pilihancp)
    {
        $this->dt = $this->db->table('rencana_pemulihan_cp');
        $this->dt->where('diagnosa', $pilihancp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cp_detail($id)
    {
        $this->dt = $this->db->table('diagnosa_cp');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_cp_detail_penunjang($diagnosa_cp)
    {
        $this->dt = $this->db->table('penunjang_cp');
        $this->dt->where('diagnosa', $diagnosa_cp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cp_detail_tindakan($diagnosa_cp)
    {
        $this->dt = $this->db->table('tindakan_cp');
        $this->dt->where('diagnosa', $diagnosa_cp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cp_detail_obat($diagnosa_cp)
    {
        $this->dt = $this->db->table('obat_cp');
        $this->dt->where('diagnosa', $diagnosa_cp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cp_detail_nutrisi($diagnosa_cp)
    {
        $this->dt = $this->db->table('nutrisi_cp');
        $this->dt->where('diagnosa', $diagnosa_cp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cp_detail_mobilisasi($diagnosa_cp)
    {
        $this->dt = $this->db->table('mobilisasi_cp');
        $this->dt->where('diagnosa', $diagnosa_cp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cp_detail_hasil($diagnosa_cp)
    {
        $this->dt = $this->db->table('hasil_cp');
        $this->dt->where('diagnosa', $diagnosa_cp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cp_detail_rencana($diagnosa_cp)
    {
        $this->dt = $this->db->table('rencana_pemulihan_cp');
        $this->dt->where('diagnosa', $diagnosa_cp);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    public function insert_diagnosa($simpandata)
    {
        $table = $this->db->table('diagnosa_cp');
        $table->insert($simpandata);
    }

    public function delete_penunjangCP($hapusdata)
    {
        $table = $this->db->table('penunjang_cp');
        $table->delete($hapusdata);
    }

    public function delete_TindakanCP($hapusdata)
    {
        $table = $this->db->table('tindakan_cp');
        $table->delete($hapusdata);
    }

    public function delete_ObatCP($hapusdata)
    {
        $table = $this->db->table('obat_cp');
        $table->delete($hapusdata);
    }

    public function delete_NutrisiCP($hapusdata)
    {
        $table = $this->db->table('nutrisi_cp');
        $table->delete($hapusdata);
    }

    public function delete_MobilisasiCP($hapusdata)
    {
        $table = $this->db->table('mobilisasi_cp');
        $table->delete($hapusdata);
    }

    public function delete_HasilCP($hapusdata)
    {
        $table = $this->db->table('hasil_cp');
        $table->delete($hapusdata);
    }

    public function delete_RencanaCP($hapusdata)
    {
        $table = $this->db->table('rencana_pemulihan_cp');
        $table->delete($hapusdata);
    }

    function get_list_penunjang($key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->distinct('name');
        $this->dt->orderBy('id');
        $this->dt->like('name', $key);
        $this->dt->limit(15);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    public function insert_penunjang($simpandata)
    {
        $table = $this->db->table('penunjang_cp');
        $table->insert($simpandata);
    }

    public function insert_tindakan($simpandata)
    {
        $table = $this->db->table('tindakan_cp');
        $table->insert($simpandata);
    }

    public function insert_obat($simpandata)
    {
        $table = $this->db->table('obat_cp');
        $table->insert($simpandata);
    }

    public function insert_nutrisi($simpandata)
    {
        $table = $this->db->table('nutrisi_cp');
        $table->insert($simpandata);
    }

    public function insert_mobilisasi($simpandata)
    {
        $table = $this->db->table('mobilisasi_cp');
        $table->insert($simpandata);
    }

    public function insert_hasil($simpandata)
    {
        $table = $this->db->table('hasil_cp');
        $table->insert($simpandata);
    }

    public function insert_rencana($simpandata)
    {
        $table = $this->db->table('rencana_pemulihan_cp');
        $table->insert($simpandata);
    }
}

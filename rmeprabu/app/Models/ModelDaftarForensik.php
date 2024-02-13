<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDaftarforensik extends Model
{

    protected $table      = 'admission_forensik';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'journalnumber', 'referencenumber', 'pasienid', 'pasienname', 'pasiengender', 'pasiendateofbirth', 'umur', 'pekerjaan', 'agama', 'alamat', 'namapjb',
        'documentdate', 'roomname', 'bednumber', 'dokter_forensik', 'nip_dokter_forensik', 'request_from', 'request_number', 'anamnesis', 'suhutubuh', 'pernapasan', 'kesadaran', 'pakaian', 'tekanandarah',
        'denyutnadi', 'tinggibadan', 'beratbadan', 'cirikhusus', 'kepala', 'leher', 'bahu', 'dada', 'punggung', 'perut', 'pinggang', 'bokong', 'dubur', 'alatkelamin', 'anggota_gerak_atas',
        'anggota_gerak_bawah', 'penunjang_lab', 'penunjang_radiologi', 'penunjang_odontogram', 'penunjang_lain', 'ringkasan_pemeriksaan', 'icd', 'penyebab_A1', 'penyebab_A2',
        'penyebab_mendasari', 'b_1', 'b_2', 'b_n', 'pengobatan_tindakan', 'prognosis', 'kesimpulan', 'created_at', 'updated_at', 'createdby', 'updatedby', 'token_forensik', 'dokter_signature', 'lampiran_klinis',
        'lampiran_toksikologi', 'lampiran_histopatologi', 'lampiran_foto', 'lampiran_video', 'lampiran_lain'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';



    function get_data_token($token_ibs)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table($tb);
        //$this->dt->select(' name , id , code , memo ');
        $this->dt->where('token_ranap', $token_ibs);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table($tb);
        //$this->dt->select(' name , id , code , memo ');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    public function get_ibs($id = '')
    {
        if ($id == '') {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}

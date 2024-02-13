<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPulangRanap extends Model
{

    protected $table      = 'transaksi_pelayanan_pulang_rawatinap';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'validationnumber', 'journalnumber', 'parentjournalnumber', 'documentdate', 'documentyear', 'documentmonth',  'referencenumber',
        'bpjs_sep_poli', 'bpjs_sep', 'noantrian', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'paymentmethodori', 'paymentmethodnameori', 'paymentcardnumberori', 'poliklinik', 'poliklinikname', 'faskes', 'faskesname', 'dokterpoli', 'dokterpoliname', 'icdx', 'icdxname', 'reasoncode', 'statuspasien',  'lakalantas', 'lokasilakalantas', 'namapjb', 'hubunganpjb', 'telppjb', 'alamatpjb', 'pasienclassroom', 'bumil', 'dokter', 'doktername', 'smf', 'smfname', 'titipan', 'classroom', 'classroomname', 'room',
        'roomname',  'bednumber', 'bedname', 'referencenumberparent', 'parentid', 'parentname', 'datein', 'timein', 'datetimein', 'dateout', 'timeout', 'datedie', 'datetimeout', 'timedie', 'datetimedie', 'faskesrujukan', 'faskesnamerujukan',
        'locationcode', 'locationname', 'cancel', 'validation', 'validationby', 'validationdate', 'pasienclassroomchange', 'pasienclassroomchangenumber', 'numberseq',
        'createdby', 'createddate', 'modifiedby', 'modifieddate', 'paymentchange', 'paymentchangenumber','bayiSehat', 'verifikasi', 'tanggalverifikasi', 'petugasverifikasi', 'koinsiden',
        'verifikasimobdan', 'catatanVerifikasiMobdan','verifikasidiagnosa','bataldiagnosa'

    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        return $this->table('transaksi_pelayanan_rawatinap_operasi_header')
            ->like('referencenumber', $keyword);
    }
    public function dokterspesialis()
    {

        return $this->table('dokter')
            ->where('inactive', 'TIDAK')
            ->like('specialist', 'YA');
    }


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

    function searchpasienpulang($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien($pasienid)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_admission_surat_kematian_journalnumber($journalnumber)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

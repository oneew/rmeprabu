<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPindahRanap extends Model
{

    protected $table      = 'transaksi_pelayanan_pindah_rawatinap';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'validationnumber', 'journalnumber', 'parentjournalnumber', 'documentdate', 'documentyear', 'documentmonth',  'referencenumber',
        'bpjs_sep_poli', 'bpjs_sep', 'noantrian', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'paymentmethodori', 'paymentmethodnameori', 'paymentcardnumberori', 'poliklinik', 'poliklinikname', 'faskes', 'faskesname', 'dokterpoli', 'dokterpoliname', 'icdx', 'icdxname', 'reasoncode', 'statuspasien',  'lakalantas', 'lokasilakalantas', 'namapjb', 'hubunganpjb', 'telppjb', 'alamatpjb', 'pasienclassroom', 'bumil', 'dokter', 'doktername', 'smf', 'smfname', 'titipan', 'classroom', 'classroomname', 'room',
        'roomname',  'bednumber', 'bedname', 'referencenumberparent', 'parentid', 'parentname', 'datein', 'timein', 'datetimein', 'dateout', 'timeout', 'datedie', 'datetimeout', 'transferclassroom', 'transferclassroomname', 'transferroom', 'transferroomname', 'transferbednumber', 'transfersmf', 'transfersmfname', 'vsnadi', 'vstd', 'vssh', 'vsnf', 'vsrj', 'vsstability', 'vsdifiksasi', 'transferreason', 'memo',
        'locationcode', 'locationname', 'cancel', 'validation', 'validationby', 'validationdate', 'pasienclassroomchange', 'pasienclassroomchangenumber', 'numberseq',
        'createdby', 'createddate', 'modifiedby', 'modifieddate', 'paymentchange', 'paymentchangenumber', 'reborn'

    ];

    //protected $useTimestamps = true;
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

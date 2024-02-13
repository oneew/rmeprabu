<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDaftarRanap2 extends Model
{

    protected $table      = 'transaksi_pelayanan_daftar_rawatinap';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'groups', 'journalnumber', 'parentjournalnumber', 'transferjournalnumber', 'documentdate', 'documentyear', 'documentmonth',  'referencenumber',
        'bpjs_sep_poli', 'bpjs_sep', 'noantrian', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'paymentmethodori', 'paymentmethodnameori', 'paymentcardnumberori', 'poliklinik', 'poliklinikname', 'faskes', 'faskesname', 'dokterpoli', 'dokterpoliname', 'icdx', 'icdxname', 'reasoncode', 'statuspasien', 'bumil', 'lakalantas', 'lokasilakalantas', 'namapjb', 'hubunganpjb', 'telppjb', 'alamatpjb', 'pasienclassroom', 'dokter', 'doktername', 'smf', 'smfname', 'titipan', 'classroom', 'classroomname', 'room',
        'roomname', 'roomfisik', 'roomfisikname', 'bednumber', 'bedname', 'parentid', 'datein', 'timein', 'datetimein', 'locationcode', 'locationname', 'statusrawatinap', 'createdby', 'createddate',  'tgl_spr',
        'memo', 'token_ranap', 'lamabaru', 'dateout', 'datetimeout', 'timeout'
    ];

    //protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        // $builder = $this->table('transaksi_pelayanan_daftar_rawatinap_sementara');
        // $builder->like('pasienid', $keyword);
        // return $builder;

        return $this->table('transaksi_pelayanan_rawatinap_operasi_header')
            ->like('referencenumber', $keyword);
    }

    public function dokterspesialis()
    {
        // $builder = $this->table('transaksi_pelayanan_daftar_rawatinap_sementara');
        // $builder->like('pasienid', $keyword);
        // return $builder;

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

    function cek_register_today($pasienid)
    {
        $staturawatinap = ['RAWAT', 'REGISTER'];
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->whereIn('statusrawatinap', $staturawatinap);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelibs extends Model
{

    protected $table      = 'transaksi_pelayanan_rawatinap_operasi_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'groups', 'journalnumber', 'documentdate', 'documentyear', 'documentmonth', 'registernumber', 'referencenumber',
        'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'dokter', 'doktername', 'smf', 'smfname', 'classroom', 'classroomname', 'room',
        'roomname', 'locationcode', 'locationname', 'referencenumberparent', 'parentid', 'parentname', 'ibsdokter', 'ibsdoktername', 'ibsnurse', 'ibsnursename',
        'ibsanestesi', 'ibsanestesiname', 'ibspenata', 'ibspenataname', 'cases', 'operatorroom', 'anestesi', 'validation', 'createdby', 'createddate', 'icdx', 'icdxname', 'tglspr',
        'memo', 'email', 'token_ibs', 'namapjb', 'alamatpjb', 'asal_pasien', 'registernumber_rawatjalan', 'dokterpengirim'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

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
        $tb = "transaksi_pelayanan_rawatinap_operasi_header";
        $this->dt = $this->db->table($tb);
        //$this->dt->select(' name , id , code , memo ');
        $this->dt->where('token_ibs', $token_ibs);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs($id)
    {
        $tb = "transaksi_pelayanan_rawatinap_operasi_header";
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

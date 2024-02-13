<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDaftarRadiologi extends Model
{

    protected $table      = 'transaksi_pelayanan_penunjang_header';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'visited', 'groups', 'journalnumber', 'documentdate', 'documentyear', 'documentmonth', 'registernumber', 'referencenumber',
        'registernumber_rawatjalan', 'registernumber_rawatinap', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber',  'faskes', 'faskesname', 'dokter', 'doktername', 'employee', 'employeename',
        'smf', 'smfname', 'classroom', 'classroomname', 'room', 'roomname', 'locationcode', 'locationname', 'icdx', 'icdxname', 'orderpemeriksaan', 'tgl_order',
        'memo', 'token_radiologi', 'createdby', 'createddate', 'note', 'status', 'goldar', 'updateheader'
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

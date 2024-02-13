<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;


class ModelMasterPasien extends Model
{

    protected $table      = 'pasien';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'registerdate', 'code', 'oldcode', 'initial', 'name', 'gender', 'maritalstatus', 'religion', 'bloodtype', 'bloodrhesus', 'ssn', 'placeofbirth', 'dateofbirth', 'education',
        'citizenship', 'work', 'telephone', 'mobilephone', 'area', 'subarea', 'subareaname', 'address', 'postalcode', 'parentname', 'parenttelephone', 'couplename', 'paymentmethod', 'paymentmethodname',
        'cardnumber', 'parentid', 'numberseq', 'locationcode', 'createdby', 'createddate', 'district', 'rt', 'rw', 'kecamatan', 'kabupaten', 'propinsi', 'namaibukandung'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }




    function get_list_payment()
    {
        $this->dt = $this->db->table('cara_pembayaran');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('inactive', 'TIDAK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_penunjang()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->orderBy('code');
        $this->dt->select(' name , code, id ');
        $this->dt->where('penunjang', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_payment_pindahcabar()
    {
        $this->dt = $this->db->table('cara_pembayaran');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('inactive', 'TIDAK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien($id)
    {
        $tb = "pasien";
        $this->dt = $this->db->table('pasien');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

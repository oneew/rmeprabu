<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPasien extends Model
{

    protected $table      = 'pasien';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'registerdate', 'code', 'oldcode', 'initial', 'name', 'gender', 'maritalstatus', 'religion', 'bloodtype', 'bloodrhesus', 'ssn', 'placeofbirth', 'dateofbirth', 'education',
        'citizenship', 'work', 'telephone', 'mobilephone', 'area', 'subarea', 'subareaname', 'address', 'postalcode', 'parentname', 'parenttelephone', 'couplename', 'paymentmethod', 'paymentmethodname',
        'cardnumber', 'parentid', 'numberseq', 'locationcode', 'createdby', 'createddate', 'district', 'rt', 'rw', 'kecamatan', 'kabupaten', 'propinsi', 'namaibukandung', 'incorrectNik','kodetempatlahir','kodewilayah',
        'kodeagama','kodependidikan','kodeperkawinan','kodepekerjaan','kodegoldar','kodenegara','kodecreatedby','subdistrict','provinsi','city','prop','kota','norm',
        'kec','kel'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

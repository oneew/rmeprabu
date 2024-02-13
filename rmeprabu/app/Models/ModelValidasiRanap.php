<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelValidasiRanap extends Model
{

    protected $table      = 'transaksi_pelayanan_validasi_rawatinap';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'types', 'validationgroup', 'validationnumber', 'journalnumber', 'parentjournalnumber', 'documentdate', 'documentyear', 'documentmonth',  'referencenumber',
        'bpjs_sep_poli', 'bpjs_sep', 'noantrian', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'paymentmethodori', 'paymentmethodnameori', 'paymentcardnumberori', 'poliklinik', 'poliklinikname', 'faskes', 'faskesname', 'dokterpoli', 'dokterpoliname', 'icdx', 'icdxname', 'reasoncode', 'statuspasien', 'bumil', 'lakalantas', 'lokasilakalantas', 'namapjb', 'hubunganpjb', 'telppjb', 'alamatpjb', 'pasienclassroom', 'dokter', 'doktername', 'smf', 'smfname', 'titipan', 'classroom', 'classroomname', 'room',
        'roomname', 'roomfisik', 'roomfisikname', 'bednumberbefore', 'bednumber', 'bedname', 'referencenumberparent', 'parentid', 'parentname', 'memo', 'datein', 'timein', 'datetimein', 'locationcode', 'locationname', 'cancel', 'validation', 'validationby', 'validationdate', 'pasienclassroomchange', 'pasienclassroomchangenumber', 'numberseq', 'createdby', 'createddate', 'modifiedby', 'modifieddate', 'paymentchange', 'paymentchangenumber', 'created_at', 'updated_at', 'reborn'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

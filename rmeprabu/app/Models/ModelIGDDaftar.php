<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelIGDDaftar extends Model
{

    protected $table      = 'transaksi_pelayanan_daftar_rawatjalan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'visited', 'journalnumber', 'bpjs_sep', 'documentdate', 'documentyear', 'documentmonth', 'noantrian', 'pasienid',
        'oldcode', 'pasienname', 'pasiengender', 'pasienmaritalstatus', 'pasienage', 'pasiendateofbirth', 'registerdate', 'pasienaddress', 'pasienarea', 'pasiensubarea',
        'pasiensubareaname', 'pasienparentname', 'pasienssn', 'pasientelephone', 'dispensasi', 'karyawan', 'cash', 'paymentmethod', 'paymentmethodname',
        'paymentcardnumber', 'paymentmethodori', 'paymentmethodnameori', 'paymentcardnumberori', 'paymentmethod_payment', 'paymentmethodname_payment', 'paymentcardnumber_payment',
        'dispensasimemo', 'poliklinik', 'poliklinikname', 'poliklinikclass', 'poliklinikclassname', 'smf', 'smfname', 'dokter', 'doktername', 'faskes', 'faskesname',
        'referencenumber', 'referencedate', 'code', 'description', 'price', 'share1', 'share2', 'share21', 'share22', 'icdx', 'icdxname', 'locationcode', 'locationname',
        'numberseq', 'createdip', 'createdby', 'createddate', 'modifiedip', 'modifiedby', 'modifieddate', 'statustracker', 'statustrackerby', 'statustrackerdate',
        'statusout', 'statusoutby', 'statusoutdate', 'statusin', 'statusinby', 'statusindate', 'statusrm', 'statusrmby', 'statusrmdate', 'pulangrawat', 'memopulangrawat',
        'statuspasien', 'statusrawatip', 'statusrawatby', 'statusrawatdate', 'registerrawat', 'registerrawatby', 'registerrawatdate', 'reasoncode', 'lakalantas',
        'lokasilakalantas', 'journalnumberparent', 'referencenumberparent', 'parentid', 'parentname', 'printcounter', 'cancel', 'cancelreason', 'cancelmemo', 'cancelip',
        'cancelby', 'canceldate', 'validation', 'validationby', 'validationdate', 'coding', 'codingby', 'codingdate', 'inacbgs', 'inacbgsby', 'inacbgsdate', 'kodegrouper',
        'namagrouper', 'claim', 'claimby', 'claimdate', 'paymentchangenumber', 'statustracer', 'tracerprint', 'tracertimeout', 'datein', 'vclaimsep', 'vclaimsepdate', 'vclaimuser',
        'memo', 'email', 'token_rajal', 'noRujukan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function get_list_payment()
    {
        $this->dt = $this->db->table('cara_pembayaran');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('inactive', 'TIDAK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel !=', "1.00");
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    
    function ambildataigdBatal()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel', 1.00);
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterRajal($search)
    {
        $this->dt = $this->db->table($this->table);

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_RegisterigdBatal($search)
    {
        $this->dt = $this->db->table($this->table);

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('cancel', 1.00);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_ibs($search)
    {
        $this->dt = $this->db->table('jadwaloperasimanual');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajalibs()
    {
        $this->dt = $this->db->table('jadwaloperasimanual');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

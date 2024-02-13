<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelValidasiPembayaranRanap extends Model
{

    protected $table      = 'transaksi_pelayanan_kasir_rawatinap';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'paymentstatus', 'groups', 'validationnumber', 'journalnumber', 'parentjournalnumber', 'documentdate', 'documentyear', 'documentmonth', 'referencenumber', 'bpjs_sep_poli', 'bpjs_sep', 'noantrian', 'pasienid',  'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea',
        'pasiensubareaname', 'cash', 'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'paymentmethodori', 'paymentmethodnameori', 'paymentcardnumberori', 'poliklinik', 'poliklinikname', 'faskes', 'faskesname', 'dokterpoli', 'dokterpoliname', 'icdx', 'icdxname', 'smf',  'inacbgsclass', 'inacbgs', 'inacbgsname', 'reasoncode', 'statuspasien', 'lakalantas', 'lokasilakalantas', 'namapjb', 'hubunganpjb', 'telppjb', 'alamatpjb', 'pasienclassroom', 'bumil', 'dokter', 'doktername', 'smf', 'smfname', 'classroom', 'classroomname', 'room', 'roomname', 'bednumber', 'bedname', 'referencenumberparent', 'parentid', 'parentname', 'memo', 'datein', 'timein', 'datetimein', 'dateout', 'timeout', 'datetimeout', 'totaldaftarklinik', 'totaltindakanklinik', 'totalbhptindakanklinik', 'totalfarmasiklinik', 'totalpenunjangklinik', 'totalbhppenunjangklinik', 'totalkasirklinik', 'totalkamar', 'totalvisite', 'totaltindakanruang', 'totalmakan', 'totalbhptindakanruang', 'totaltindakanoperasi',
        'totalbhptindakanoperasi', 'totalfarmasi', 'totalpenunjang', 'totalbhppenunjang', 'totallainnya', 'totalbhplainnya', 'totalkasirranap', 'totalkasirpenunjang',
        'grandtotal', 'discount', 'tarifkelas1', 'tarifkelas2', 'tarifkelas3', 'selisih', 'realcost', 'paymentamount', 'paymentmethodnew', 'paymentmethodnamenew', 'paymentcardnumbernew', 'paymentchange', 'pasienclassroomnew', 'pasienclassroomchange', 'locationcode', 'locationname', 'cancel',
        'validation', 'validationby', 'validationdate', 'validationby', 'validationdate', 'validationcode', 'printcounter', 'blacklist', 'numberseq', 'createdby', 'createddate', 'modifiedby', 'modifieddate', 'payersname', 'paymentstatus', 'metodepembayaran', 'referensibank', 'nominaldebet', 'noreferensidebet', 'signaturekasir', 'signaturepasien', 'rincian',
        'totalTagihanAsal'
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
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
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
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function ambilpasienbayarRanap($validationnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('validationnumber', $validationnumber);
        $this->dt->notLike('paymentstatus', 'PINDAH CARA PEMBAYAR');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildatahapus()
    {
        $this->dt = $this->db->table('log_delete_transaksi_kasir_rawatjalan');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

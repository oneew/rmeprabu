<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelKlaim extends Model
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
        'memo', 'email', 'token_rajal', 'noRujukan', 'validasipemeriksaan', 'anamnesa', 'hasilperiksa', 'advicedokter', 'indikasirawat', 'signaturedokter', 'klaim', 'tanggalklaim', 'petugasklaim'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function ambildatapasienpulangRajal()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IRJ');
        $this->dt->where('klaim', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_pasienpulang_Rajal($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('klaim', 0);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildataklaimRajal()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('tanggalklaim', date('Y-m-d'));
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IRJ');
        $this->dt->where('klaim', 1);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_klaim_Rajal($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('tanggalklaim >=', $search['mulai']);
        $this->dt->where('tanggalklaim <=', $search['sampai']);
        $this->dt->where('klaim', 1);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
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

    function search_ranap_simple()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->join('transaksi_pelayanan_validasi_rawatinap', 'transaksi_pelayanan_validasi_rawatinap.referencenumber=transaksi_pelayanan_pulang_rawatinap.referencenumber', 'left');
        $this->dt->select('transaksi_pelayanan_pulang_rawatinap.referencenumber ,  transaksi_pelayanan_validasi_rawatinap.datein, transaksi_pelayanan_validasi_rawatinap.groups, transaksi_pelayanan_pulang_rawatinap.pasienid,  transaksi_pelayanan_pulang_rawatinap.doktername, transaksi_pelayanan_validasi_rawatinap.icdx, transaksi_pelayanan_validasi_rawatinap.icdxname, transaksi_pelayanan_pulang_rawatinap.dateout, transaksi_pelayanan_pulang_rawatinap.statuspasien, transaksi_pelayanan_pulang_rawatinap.roomname, transaksi_pelayanan_pulang_rawatinap.paymentmethodname, transaksi_pelayanan_pulang_rawatinap.pasienname, transaksi_pelayanan_pulang_rawatinap.smfname');
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout=', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_validasi_rawatinap.types', 'BARU');
        $this->dt->orderBy('transaksi_pelayanan_pulang_rawatinap.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_tarif_konsul_rajal($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' description , price');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_list_tarif_konsul_rajal_detail($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->selectSum(' subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('name', 'Konsul');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_biaya_keperawatan($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->selectSum(' subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->notlike('name', 'Konsul');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjangradiologirajal($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('types', 'RAD');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjanglabrajal($journalnumber)
    {
        $types = ['LPK', 'LPA'];
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->whereIn('types', $types);
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function Penunjangrehabrajal($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('types', 'RHM');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjangbankdarahrajal($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('types', 'BD');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function FARMASIRAJALNONKRONIS($journalnumber)
    {
        $this->dt = $this->db->table(' transaksi_farmasi_pelayanan_header');
        $this->dt->join(' transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('SUM(price * qtypaket )as harga');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RJ');

        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function FARMASIRAJALKRONIS($journalnumber)
    {
        $this->dt = $this->db->table(' transaksi_farmasi_pelayanan_header');
        $this->dt->join(' transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('SUM(price * qtyluarpaket )as harga ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RJ');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function FARMASIRAJALNONKRONISHEADER($journalnumber)
    {
        $this->dt = $this->db->table(' transaksi_farmasi_pelayanan_header');
        $this->dt->join(' transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('SUM(transaksi_farmasi_pelayanan_detail.price * transaksi_farmasi_pelayanan_detail.qtypaket )as harga, transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RJ');

        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_biaya_keperawatan_igd($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->selectSum(' subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->notlike('name', 'Konsul');
        $this->dt->notlike('groups', 'SEWA ALAT OBSERVASI');
        $this->dt->notlike('groups', 'GAS MEDIS OBSERVASI');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildatapasienpulangigd()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IGD');
        $this->dt->where('klaim', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_pasienpulang_igd($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('klaim', 0);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Penunjangradiologiigd($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('types', 'RAD');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjanglabigd($journalnumber)
    {
        $types = ['LPK', 'LPA'];
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->whereIn('types', $types);
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjangrehabigd($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('types', 'RHM');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjangbankdarahigd($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('types', 'BD');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function FARMASINONKRONISIGD($journalnumber)
    {
        $this->dt = $this->db->table(' transaksi_farmasi_pelayanan_header');
        $this->dt->join(' transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('SUM(price * qtypaket )as harga');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'IGD');

        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function FARMASIIGDKRONIS($journalnumber)
    {
        $this->dt = $this->db->table(' transaksi_farmasi_pelayanan_header');
        $this->dt->join(' transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('SUM(price * qtyluarpaket )as harga ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_biaya_sewa_alat_igd($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('groups', 'SEWA ALAT OBSERVASI');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_bmhp_igd($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('groups', 'GAS MEDIS OBSERVASI');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataklaimIgd()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('tanggalklaim', date('Y-m-d'));
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IGD');
        $this->dt->where('klaim', 1);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_klaim_Igd($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('tanggalklaim >=', $search['mulai']);
        $this->dt->where('tanggalklaim <=', $search['sampai']);
        $this->dt->where('klaim', 1);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapasienpulangranap()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('dateout', date('Y-m-d'));
        //$this->dt->where('cancel', 0.00);
        //$this->dt->where('klaim', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_pasienpulang_ranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');

        $this->dt->where('dateout >=', $search['mulai']);
        $this->dt->where('dateout <=', $search['sampai']);
        //$this->dt->where('klaim', 0);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        // $this->dt->where('cancel', 0.00);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_tarif_konsul_ranap($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->selectSum(' subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->notLike('name', 'Keperawatan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }



    function FARMASIRAJALNONKRONISHEADERDETAIL($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, SUM(transaksi_farmasi_pelayanan_detail.price * transaksi_farmasi_pelayanan_detail.qtypaket )as harga, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RJ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_biaya_keperawatan_ranap($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->notlike('name', 'Konsul');
        $this->dt->notlike('groups', 'SEWA ALAT OBSERVASI');
        $this->dt->notlike('groups', 'GAS MEDIS OBSERVASI');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjangradiologiranap($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('types', 'RAD');
        $this->dt->where('referencenumber', $journalnumber);
        //$this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjanglabranap($journalnumber)
    {
        $types = ['LPK', 'LPA'];
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->whereIn('types', $types);
        $this->dt->where('referencenumber', $journalnumber);
        //$this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Penunjangbankdararanap($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('types', 'BD');
        $this->dt->where('referencenumber', $journalnumber);
        //$this->dt->like('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function FARMASINONKRONISRANAP($journalnumber)
    {
        $this->dt = $this->db->table(' transaksi_farmasi_pelayanan_header');
        $this->dt->join(' transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('SUM(price * qtypaket )as harga');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        //$this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'IGD');

        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function FARMASIRANAPKRONIS($journalnumber)
    {
        $this->dt = $this->db->table(' transaksi_farmasi_pelayanan_header');
        $this->dt->join(' transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('SUM(price * qtyluarpaket )as harga ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        //$this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_biaya_sewa_alat_ranap($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('groups', 'SEWA ALAT');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_bmhp_ranap($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->selectSum('subtotal');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->like('groups', 'GAS MEDIS');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_kasir($referencenumber)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_merge($referencenumber)
    {
        $tb = "transaksi_pelayanan_rawatinap_visite_header";
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_header');
        $this->dt->select('paymentmethodname');
        $this->dt->distinct('paymentmethodname');
        $this->dt->where('referencenumber', $referencenumber);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function update_dataKlaim($id, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->update($simpandata);
    }

    function searchPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAsupanGiziPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchVisitePilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function OperasiPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangheaderPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function BHPpenunjangranapPilihan($referencenumber, $pilihancabar)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber , journalnumber , types , SUM(totalbhp)as totalbhp ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->groupBy('types');
        //$this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIPilihan($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganranapprint($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->notLike('paymentstatus', 'PINDAH CARA PEMBAYAR');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangdetailPilihanRanap($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_penunjang_header.totalamount,transaksi_pelayanan_penunjang_detail.subtotal, transaksi_pelayanan_penunjang_header.documentdate, transaksi_pelayanan_penunjang_header.groups, transaksi_pelayanan_penunjang_header.totalamount,transaksi_pelayanan_penunjang_header.journalnumber,transaksi_pelayanan_penunjang_detail.name');
        $this->dt->where('transaksi_pelayanan_penunjang_header.referencenumber', $referencenumber);
        $this->dt->like('transaksi_pelayanan_penunjang_header.paymentmethod', $pilihancabar);
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IRJ');
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IGD');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.documentdate');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    ///koinsiden

    function searchPilihanKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAsupanGiziPilihanKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchVisitePilihanKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function OperasiPilihanKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join('transaksi_pelayanan_rawatinap_operasi_detail', 'transaksi_pelayanan_rawatinap_operasi_header.journalnumber=transaksi_pelayanan_rawatinap_operasi_detail.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_rawatinap_operasi_header.journalnumber ,  transaksi_pelayanan_rawatinap_operasi_header.documentdate, transaksi_pelayanan_rawatinap_operasi_detail.koinsiden, transaksi_pelayanan_rawatinap_operasi_detail.name, transaksi_pelayanan_rawatinap_operasi_detail.totaltarif, transaksi_pelayanan_rawatinap_operasi_detail.qty');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_detail.koinsiden', 1);
        $this->dt->like('transaksi_pelayanan_rawatinap_operasi_header.paymentmethodname', $pilihancabar);
        $this->dt->orderBy('transaksi_pelayanan_rawatinap_operasi_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangheaderPilihanKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 1);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function BHPpenunjangranapPilihanKoinsiden($referencenumber, $pilihancabar)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber , journalnumber , types , SUM(totalbhp)as totalbhp ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->groupBy('types');
        //$this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIPilihanKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.koinsiden', 1);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function PenunjangdetailPilihanRanapKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_penunjang_header.totalamount,transaksi_pelayanan_penunjang_detail.subtotal, transaksi_pelayanan_penunjang_header.documentdate, transaksi_pelayanan_penunjang_header.groups, transaksi_pelayanan_penunjang_header.totalamount,transaksi_pelayanan_penunjang_header.journalnumber,transaksi_pelayanan_penunjang_detail.name');
        $this->dt->where('transaksi_pelayanan_penunjang_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_pelayanan_penunjang_detail.koinsiden', 1);
        $this->dt->like('transaksi_pelayanan_penunjang_header.paymentmethod', $pilihancabar);
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IRJ');
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IGD');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.documentdate');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchPilihanNonKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 0);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->notLike('types', 'GIZI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchAsupanGiziPilihanNonKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('types', 'GIZI');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 0);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function searchVisitePilihanNonKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 0);
        $this->dt->like('paymentmethodname', $pilihancabar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function OperasiPilihanNonKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join('transaksi_pelayanan_rawatinap_operasi_detail', 'transaksi_pelayanan_rawatinap_operasi_header.journalnumber=transaksi_pelayanan_rawatinap_operasi_detail.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_rawatinap_operasi_header.journalnumber ,  transaksi_pelayanan_rawatinap_operasi_header.documentdate, transaksi_pelayanan_rawatinap_operasi_detail.koinsiden, transaksi_pelayanan_rawatinap_operasi_detail.name, transaksi_pelayanan_rawatinap_operasi_detail.totaltarif, transaksi_pelayanan_rawatinap_operasi_detail.qty');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_detail.koinsiden', 0);
        $this->dt->like('transaksi_pelayanan_rawatinap_operasi_header.paymentmethodname', $pilihancabar);
        $this->dt->orderBy('transaksi_pelayanan_rawatinap_operasi_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function PenunjangheaderPilihanNonKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('koinsiden', 0);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function BHPpenunjangranapPilihanNonKoinsiden($referencenumber, $pilihancabar)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('referencenumber , journalnumber , types , SUM(totalbhp)as totalbhp ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->notLIKE('types', 'BD');
        $this->dt->notLIKE('classroom', 'IRJ');
        $this->dt->notLIKE('classroom', 'IGD');
        $this->dt->groupBy('types');
        //$this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function FARMASIPilihanNonKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_header.journalnumber ,  transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.poliklinikname, transaksi_farmasi_pelayanan_header.doktername, SUM(transaksi_farmasi_pelayanan_detail.price * qty)as price, transaksi_farmasi_pelayanan_header.embalase');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.koinsiden', 0);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        $this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function PenunjangdetailPilihanRanapNonKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_penunjang_header.totalamount,transaksi_pelayanan_penunjang_detail.subtotal, transaksi_pelayanan_penunjang_header.documentdate, transaksi_pelayanan_penunjang_header.groups, transaksi_pelayanan_penunjang_header.totalamount,transaksi_pelayanan_penunjang_header.journalnumber,transaksi_pelayanan_penunjang_detail.name');
        $this->dt->where('transaksi_pelayanan_penunjang_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_pelayanan_penunjang_detail.koinsiden', 0);
        $this->dt->like('transaksi_pelayanan_penunjang_header.paymentmethod', $pilihancabar);
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IRJ');
        $this->dt->notLIKE('transaksi_pelayanan_penunjang_header.classroom', 'IGD');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.documentdate');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildataklaimRanap()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('tanggalklaim', date('Y-m-d'));
        $this->dt->where('klaim', 1);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_klaim_Ranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');

        $this->dt->where('tanggalklaim >=', $search['mulai']);
        $this->dt->where('tanggalklaim <=', $search['sampai']);
        $this->dt->where('klaim', 1);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanHeaderFarmasi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('journalnumber, pasienid, pasienname, paymentmethodname, documentdate, pasienaddress, pasienage, dateofbirth, pasiengender, poliklinik, poliklinikname, doktername, referencenumber');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasirajalklaim($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RJ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasirajalklaimkronis($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RJ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $this->dt->where('transaksi_farmasi_pelayanan_detail.qtyluarpaket > 0');
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasirajalklaimnonkronis($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RJ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasiigdklaim($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasiigdklaimkronis($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $this->dt->where('transaksi_farmasi_pelayanan_detail.qtyluarpaket > 0');
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasiigdklaimnonkronis($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'IGD');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_detail_apotek_master($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber = transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.id, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.documentdate, transaksi_farmasi_pelayanan_detail.doktername,
        transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.batchnumber, transaksi_farmasi_pelayanan_detail.expireddate,
        transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.documentdate, transaksi_farmasi_pelayanan_detail.createdby,
        transaksi_farmasi_pelayanan_detail.signa1,  transaksi_farmasi_pelayanan_detail.signa2,  transaksi_farmasi_pelayanan_detail.eticket_aturan,  transaksi_farmasi_pelayanan_detail.eticket_carapakai,  transaksi_farmasi_pelayanan_detail.eticket_petunjuk,  transaksi_farmasi_pelayanan_detail.qty ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.documentdate');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanHeaderFarmasiRanap($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('journalnumber, pasienid, pasienname, paymentmethodname, documentdate, pasienaddress, pasienage, dateofbirth, pasiengender, poliklinik, poliklinikname, doktername, referencenumber');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'RI');
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasiranapklaim($journalnumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanHeaderFarmasiRanapKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('journalnumber, pasienid, pasienname, paymentmethodname, documentdate, pasienaddress, pasienage, dateofbirth, pasiengender, poliklinik, poliklinikname, doktername, referencenumber');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'RI');
        $this->dt->where('koinsiden', 1);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasiranapklaimKoinsiden($journalnumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $this->dt->where('transaksi_farmasi_pelayanan_header.koinsiden', 1);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanHeaderFarmasiRanapNonKoinsiden($referencenumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('journalnumber, pasienid, pasienname, paymentmethodname, documentdate, pasienaddress, pasienage, dateofbirth, pasiengender, poliklinik, poliklinikname, doktername, referencenumber');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'RI');
        $this->dt->where('koinsiden', 0);
        $this->dt->like('paymentmethod', $pilihancabar);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanfarmasiranapklaimNonKoinsiden($journalnumber, $pilihancabar)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_header.journalnumber, transaksi_farmasi_pelayanan_header.documentdate, transaksi_farmasi_pelayanan_header.embalase, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.expireddate');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $this->dt->where('transaksi_farmasi_pelayanan_header.koinsiden', 0);
        $this->dt->like('transaksi_farmasi_pelayanan_header.paymentmethod', $pilihancabar);
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function update_koinsiden_tno($id, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('id', $id);
        $this->dt->update($simpandata);
    }

    function update_koinsiden_visite($id, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('id', $id);
        $this->dt->update($simpandata);
    }

    function update_koinsiden_operasi($id, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('id', $id);
        $this->dt->update($simpandata);
    }

    function update_koinsiden_penunjang($id, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('id', $id);
        $this->dt->update($simpandata);
    }

    function update_koinsiden_farmasi($id, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('id', $id);
        $this->dt->update($simpandata);
    }

    function get_data_pulang_ranap($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pulang_ranap_kasir($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('transaksi_pelayanan_kasir_rawatinap.referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function update_koinsiden_tno_igd($id, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('id', $id);
        $this->dt->update($simpandata);
    }
}

<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelAsistenDokter extends Model
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
        'memo', 'email', 'token_rajal', 'noRujukan', 'lamabaru', 'igdkebidanan', 'code_triase', 'kelompok_triase', 'noSuratKontrol', 'noSepAsalKontrol', 'tglSuratKontrol', 'verifikasi', 'petugasverifikasi', 'tanggalverifikasi', 'tandaverifikasi', 'validasipembayaran', 'kasirvalidasi', 'backdate', 'perjanjian',
        'rencanaOperasi', 'kodepoli', 'kodedokter', 'tanggalperiksa', 'nama_konsul', 'harga_konsul', 'jasars_konsul', 'jasajp_konsul', 'jasadokter_konsul'
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

    function ambildatarajal()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->where('cancel', 0.00);
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajalBatal()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel', 1.00);
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterRajal($search)
    {
        $this->dt = $this->db->table($this->table);

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->where('cancel', 0.00);
        $this->dt->like('groups', 'IRJ');

        if ($search['norm_al'] != "") {
            $this->dt->havingLike('pasienid', $search['norm_al']);
            $this->dt->orderBy('pasienid', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->orderBy('pasienname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalBatal($search)
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
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_smf()
    {
        $this->dt = $this->db->table('pelayanan_smf');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('realsmf', 0);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'DOKTER');
        $this->dt->where('specialist', 'YA');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->notLike('memo', 'BUKAN DOKTER');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_expertise()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.id=transaksi_pelayanan_penunjang_expertise.idPenunjangDetail', 'left');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_expertise.id');
        $this->dt->select('transaksi_pelayanan_penunjang_expertise.expertiseid, transaksi_pelayanan_penunjang_expertise.pacsnumber,
        transaksi_pelayanan_penunjang_expertise.createdby, transaksi_pelayanan_penunjang_expertise.created_at, transaksi_pelayanan_penunjang_detail.id,
        transaksi_pelayanan_penunjang_detail.relation, transaksi_pelayanan_penunjang_detail.relationname, transaksi_pelayanan_penunjang_detail.paymentmethod, 
        transaksi_pelayanan_penunjang_detail.doktername, transaksi_pelayanan_penunjang_detail.roomname, transaksi_pelayanan_penunjang_expertise.fotoradiologi, transaksi_pelayanan_penunjang_detail.name,
        transaksi_pelayanan_penunjang_expertise.statuspinjam, transaksi_pelayanan_penunjang_expertise.asalpeminjam, transaksi_pelayanan_penunjang_expertise.peminjamname, transaksi_pelayanan_penunjang_expertise.employeename');
        $this->dt->where('transaksi_pelayanan_penunjang_expertise.created_at', date('Y-m-d'));
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_expertise($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.id=transaksi_pelayanan_penunjang_expertise.idPenunjangDetail', 'left');

        $this->dt->select('transaksi_pelayanan_penunjang_expertise.expertiseid, transaksi_pelayanan_penunjang_expertise.pacsnumber,
        transaksi_pelayanan_penunjang_expertise.createdby, transaksi_pelayanan_penunjang_expertise.created_at, transaksi_pelayanan_penunjang_detail.id,
        transaksi_pelayanan_penunjang_detail.relation, transaksi_pelayanan_penunjang_detail.relationname, transaksi_pelayanan_penunjang_detail.paymentmethod, 
        transaksi_pelayanan_penunjang_detail.doktername, transaksi_pelayanan_penunjang_detail.roomname, transaksi_pelayanan_penunjang_expertise.fotoradiologi, transaksi_pelayanan_penunjang_detail.name,
        transaksi_pelayanan_penunjang_expertise.statuspinjam, transaksi_pelayanan_penunjang_expertise.asalpeminjam, transaksi_pelayanan_penunjang_expertise.peminjamname, , transaksi_pelayanan_penunjang_expertise.employeename');
        $this->dt->where('transaksi_pelayanan_penunjang_expertise.created_at >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_expertise.created_at <=', $search['sampai']);
        $this->dt->like('transaksi_pelayanan_penunjang_expertise.expertiseid', $search['idexpertise']);
        $this->dt->like('transaksi_pelayanan_penunjang_detail.relationname', $search['patientname'], 'after');
        $this->dt->like('transaksi_pelayanan_penunjang_detail.relation', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('transaksi_pelayanan_penunjang_detail.paymentmethod', $search['metodepembayaran']);
        }
        $this->dt->orderBy('transaksi_pelayanan_penunjang_expertise.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_masuk()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterRanap_masuk($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_expertise_lpa()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpa');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.expertiseid=transaksi_pelayanan_penunjang_expertise_lpa.expertiseid', 'left');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_expertise_lpa.id');
        $this->dt->select('transaksi_pelayanan_penunjang_expertise_lpa.expertiseid, transaksi_pelayanan_penunjang_expertise_lpa.pacsnumber,
        transaksi_pelayanan_penunjang_expertise_lpa.createdby, transaksi_pelayanan_penunjang_expertise_lpa.created_at, transaksi_pelayanan_penunjang_detail.id,
        transaksi_pelayanan_penunjang_detail.relation, transaksi_pelayanan_penunjang_detail.relationname, transaksi_pelayanan_penunjang_detail.paymentmethod, 
        transaksi_pelayanan_penunjang_detail.doktername, transaksi_pelayanan_penunjang_detail.roomname, transaksi_pelayanan_penunjang_expertise_lpa.fotoradiologi, transaksi_pelayanan_penunjang_detail.name,
        transaksi_pelayanan_penunjang_expertise_lpa.statuspinjam, transaksi_pelayanan_penunjang_expertise_lpa.asalpeminjam, transaksi_pelayanan_penunjang_expertise_lpa.peminjamname');
        $this->dt->where('transaksi_pelayanan_penunjang_expertise_lpa.created_at', date('Y-m-d'));
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_expertise_lpa($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpa');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.expertiseid=transaksi_pelayanan_penunjang_expertise_lpa.expertiseid', 'left');

        $this->dt->select('transaksi_pelayanan_penunjang_expertise_lpa.expertiseid, transaksi_pelayanan_penunjang_expertise_lpa.pacsnumber,
        transaksi_pelayanan_penunjang_expertise_lpa.createdby, transaksi_pelayanan_penunjang_expertise_lpa.created_at, transaksi_pelayanan_penunjang_detail.id,
        transaksi_pelayanan_penunjang_detail.relation, transaksi_pelayanan_penunjang_detail.relationname, transaksi_pelayanan_penunjang_detail.paymentmethod, 
        transaksi_pelayanan_penunjang_detail.doktername, transaksi_pelayanan_penunjang_detail.roomname, transaksi_pelayanan_penunjang_expertise_lpa.fotoradiologi, transaksi_pelayanan_penunjang_detail.name,
        transaksi_pelayanan_penunjang_expertise_lpa.statuspinjam, transaksi_pelayanan_penunjang_expertise_lpa.asalpeminjam, transaksi_pelayanan_penunjang_expertise_lpa.peminjamname');
        $this->dt->where('transaksi_pelayanan_penunjang_expertise_lpa.created_at >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_expertise_lpa.created_at <=', $search['sampai']);
        $this->dt->like('transaksi_pelayanan_penunjang_expertise_lpa.expertiseid', $search['idexpertise']);
        $this->dt->like('transaksi_pelayanan_penunjang_detail.relationname', $search['patientname'], 'after');
        $this->dt->like('transaksi_pelayanan_penunjang_detail.relation', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('transaksi_pelayanan_penunjang_detail.paymentmethod', $search['metodepembayaran']);
        }
        $this->dt->orderBy('transaksi_pelayanan_penunjang_expertise_lpa.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function  cek_register_today($pasienid, $poliklinikname, $documentdate)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->where('documentdate', $documentdate);
        $this->dt->where('poliklinikname', $poliklinikname);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildatapatologiklinikexpertise()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'LPK');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPatologiKlinikexpertise($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('asalDaftar', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'LPK');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildatarajalMobileJKn()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('daftaronline', 1);
        $this->dt->where('dibatalkan', 0);
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalMobileJkn($search)
    {
        $this->dt = $this->db->table($this->table);

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('daftaronline', 1);
        $this->dt->where('dibatalkan', 0);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function cek_kode_poli($poliklinikname)
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select('code');
        $this->dt->where('name', $poliklinikname);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
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

    function  cek_konsul($deskripsipoli)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatjalan');
        $this->dt->where('locationcode', $deskripsipoli);
        $this->dt->where('auto', 1);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function  cek_konsul_lainnya()
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatjalan');
        $this->dt->where('auto', 2);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildatarajaltindakan()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->like('types', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalTindakan($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->like('types', 'IRJ');
        if ($search['norm_al'] != "") {
            $this->dt->havingLike('relation', $search['norm_al']);
            $this->dt->orderBy('pasienid', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('relationname', $search['patientname'], 'after');
            $this->dt->orderBy('pasienname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataIGD()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->where('cancel', 0.00);
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD($search)
    {
        $this->dt = $this->db->table($this->table);

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->where('cancel', 0.00);
        $this->dt->like('groups', 'IGD');

        if ($search['norm_al'] != "") {
            $this->dt->havingLike('pasienid', $search['norm_al']);
            $this->dt->orderBy('pasienid', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->orderBy('pasienname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajaltindakanIGD()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->like('types', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalTindakanIGD($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->like('types', 'IGD');
        if ($search['norm_al'] != "") {
            $this->dt->havingLike('relation', $search['norm_al']);
            $this->dt->orderBy('pasienid', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('relationname', $search['patientname'], 'after');
            $this->dt->orderBy('pasienname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDPJP()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->where('statusrawatinap', 'RAWAT');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDPJP($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->where('statusrawatinap', 'RAWAT');
        if ($search['norm_al'] != "") {
            $this->dt->havingLike('pasienid', $search['norm_al']);
            $this->dt->orderBy('pasienid', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->orderBy('pasienname', 'ASC');
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatavisite()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Registervisite($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_visite_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('doktername', session()->get('firstname'));
        if ($search['norm_al'] != "") {
            $this->dt->havingLike('relation', $search['norm_al']);
            $this->dt->orderBy('relation', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('relationname', $search['patientname'], 'after');
            $this->dt->orderBy('relationname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatatindakanranap()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Registertindakanranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('doktername', session()->get('firstname'));
        if ($search['norm_al'] != "") {
            $this->dt->havingLike('relation', $search['norm_al']);
            $this->dt->orderBy('relation', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('relationname', $search['patientname'], 'after');
            $this->dt->orderBy('relationname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatatindakanranapBS()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('doktername', session()->get('firstname'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegistertindakanranapBS($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('doktername', session()->get('firstname'));
        if ($search['norm_al'] != "") {
            $this->dt->havingLike('relation', $search['norm_al']);
            $this->dt->orderBy('relation', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('relationname', $search['patientname'], 'after');
            $this->dt->orderBy('relationname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatajadwalBS()
    {
        $this->dt = $this->db->table('jadwaloperasimanual');
        $this->dt->where('dateOp', date('Y-m-d'));
        $this->dt->where('ibsdoktername', session()->get('firstname'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterjadwalBS($search)
    {
        $this->dt = $this->db->table('jadwaloperasimanual');
        $this->dt->where('dateOp >=', $search['mulai']);
        $this->dt->where('dateOp <=', $search['sampai']);
        $this->dt->where('ibsdoktername', session()->get('firstname'));
        if ($search['norm_al'] != "") {
            $this->dt->havingLike('pasienid', $search['norm_al']);
            $this->dt->orderBy('pasienid', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->orderBy('pasienname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_detail_pelayanan_resep()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.id, transaksi_farmasi_pelayanan_detail.r, transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.qty as qtypaket, transaksi_farmasi_pelayanan_detail.batchnumber, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.name,
        transaksi_farmasi_pelayanan_header.pasienid, transaksi_farmasi_pelayanan_header.pasienname, transaksi_farmasi_pelayanan_header.paymentmethodname, transaksi_farmasi_pelayanan_header.doktername, transaksi_farmasi_pelayanan_header.groups');
        $this->dt->where('transaksi_farmasi_pelayanan_header.documentdate', date('Y-m-d'));
        $this->dt->where('transaksi_farmasi_pelayanan_header.doktername', session()->get('firstname'));
        $this->dt->where('transaksi_farmasi_pelayanan_detail.code <>', '');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_pelayanan_resep_periodik($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.id, transaksi_farmasi_pelayanan_detail.r, transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.qty as qtypaket, transaksi_farmasi_pelayanan_detail.batchnumber, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.name,
        transaksi_farmasi_pelayanan_header.pasienid, transaksi_farmasi_pelayanan_header.pasienname, transaksi_farmasi_pelayanan_header.paymentmethodname,  transaksi_farmasi_pelayanan_header.doktername, transaksi_farmasi_pelayanan_header.groups');
        $this->dt->where('transaksi_farmasi_pelayanan_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_farmasi_pelayanan_header.documentdate <=', $search['sampai']);
        $this->dt->where('transaksi_farmasi_pelayanan_header.doktername', session()->get('firstname'));
        $this->dt->where('transaksi_farmasi_pelayanan_detail.code <>', '');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapenunjang()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('employeename', session()->get('firstname'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('employeename', session()->get('firstname'));
        if ($search['norm_al'] != "") {
            $this->dt->havingLike('relation', $search['norm_al']);
            $this->dt->orderBy('relation', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('relationname', $search['patientname'], 'after');
            $this->dt->orderBy('relationname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatafkrajal()
    {
        $this->dt = $this->db->table('client_daftar_rawatjalan');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.doktername', session()->get('firstname'));
        $this->dt->where('client_daftar_rawatjalan.documentdate', date('Y-m-d'));
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.groups', 'IRJ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFKRajal($search)
    {
        $this->dt = $this->db->table('client_daftar_rawatjalan');
        $this->dt->orderBy('client_daftar_rawatjalan.id');
        $this->dt->where('client_daftar_rawatjalan.documentdate >=', $search['mulai']);
        $this->dt->where('client_daftar_rawatjalan.documentdate <=', $search['sampai']);
        $this->dt->where('client_daftar_rawatjalan.doktername', session()->get('firstname'));
        $this->dt->where('client_daftar_rawatjalan.groups', 'IRJ');

        if ($search['norm_al'] != "") {
            $this->dt->havingLike('client_daftar_rawatjalan.pasienid', $search['norm_al']);
            $this->dt->orderBy('client_daftar_rawatjalan.pasienid', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('client_daftar_rawatjalan.pasienname', $search['patientname'], 'after');
            $this->dt->orderBy('client_daftar_rawatjalan.pasienname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('client_daftar_rawatjalan.paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->orderBy('client_daftar_rawatjalan.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildatafkigd()
    {
        $this->dt = $this->db->table('client_daftar_rawatjalan');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.doktername', session()->get('firstname'));
        $this->dt->where('client_daftar_rawatjalan.documentdate', date('Y-m-d'));
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.groups', 'IGD');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFKigd($search)
    {
        $this->dt = $this->db->table('client_daftar_rawatjalan');
        $this->dt->orderBy('client_daftar_rawatjalan.id');
        $this->dt->where('client_daftar_rawatjalan.documentdate >=', $search['mulai']);
        $this->dt->where('client_daftar_rawatjalan.documentdate <=', $search['sampai']);
        $this->dt->where('client_daftar_rawatjalan.doktername', session()->get('firstname'));
        $this->dt->where('client_daftar_rawatjalan.groups', 'IGD');

        if ($search['norm_al'] != "") {
            $this->dt->havingLike('client_daftar_rawatjalan.pasienid', $search['norm_al']);
            $this->dt->orderBy('client_daftar_rawatjalan.pasienid', 'ASC');
        }

        if ($search['patientname'] != "") {
            $this->dt->like('client_daftar_rawatjalan.pasienname', $search['patientname'], 'after');
            $this->dt->orderBy('client_daftar_rawatjalan.pasienname', 'ASC');
        }

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('client_daftar_rawatjalan.paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->orderBy('client_daftar_rawatjalan.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildatafkranap()
    {
        $this->dt = $this->db->table('client_daftar_rawatinap');
        $this->dt->where('transaksi_pelayanan_daftar_rawatinap.doktername', session()->get('firstname'));
        $this->dt->where('client_daftar_rawatinap.dateout', date('Y-m-d'));
        //$this->dt->where('transaksi_pelayanan_daftar_rawatjalan.groups', 'IGD');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFKranap($search)
    {
        $this->dt = $this->db->table('client_daftar_rawatinap');
        $this->dt->orderBy('client_daftar_rawatinap.id');
        $this->dt->where('client_daftar_rawatinap.dateout >=', $search['mulai']);
        $this->dt->where('client_daftar_rawatinap.dateout <=', $search['sampai']);
        $this->dt->where('client_daftar_rawatinap.doktername', session()->get('firstname'));
        //$this->dt->where('client_daftar_rawatjalan.groups', 'IGD');

        // if ($search['norm_al'] != "") {
        //     $this->dt->havingLike('client_daftar_rawatinap.pasienid', $search['norm_al']);
        //     $this->dt->orderBy('client_daftar_rawatjalan.pasienid', 'ASC');
        // }

        // if ($search['patientname'] != "") {
        //     $this->dt->like('client_daftar_rawatinap.pasienname', $search['patientname'], 'after');
        //     $this->dt->orderBy('client_daftar_rawatinap.pasienname', 'ASC');
        // }

        // if ($search['metodepembayaran'] != "") {
        //     $this->dt->like('client_daftar_rawatinap.paymentmethodname', $search['metodepembayaran']);
        // }

        $this->dt->orderBy('client_daftar_rawatinap.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

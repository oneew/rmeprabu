<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelRawatJalanDaftar extends Model
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
        'rencanaOperasi', 'kodepoli', 'kodedokter', 'tanggalperiksa','verifikasimobdan','catatanVerifikasiMobdan', 'verifikasidiagnosarajal'
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
        $this->dt->where('cancel', 0.00);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        if ($search['pilihanpoli'] != "") {
            $this->dt->like('poliklinikname', $search['pilihanpoli']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
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
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        if ($lokasi == "NONE") {
            $this->dt->where('documentdate', date('Y-m-d'));
        } else {
            $this->dt->where('documentdate', date('Y-m-d'));
            $this->dt->where('room', session()->get('locationcode'));
        }

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterRanap_masuk($search)
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        if ($lokasi == "NONE") {

            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->like('pasienid', $search['norm'], 'after');
            if ($search['metodepembayaran'] != "") {
                $this->dt->like('paymentmethodname', $search['metodepembayaran']);
            }
        } else {
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->like('pasienid', $search['norm'], 'after');
            if ($search['metodepembayaran'] != "") {
                $this->dt->like('paymentmethodname', $search['metodepembayaran']);
            }
            $this->dt->where('room', session()->get('locationcode'));
        }


        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_expertise_lpa()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpa');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.id=transaksi_pelayanan_penunjang_expertise_lpa.pacsnumber', 'left');
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
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.id=transaksi_pelayanan_penunjang_expertise_lpa.pacsnumber', 'left');

        $this->dt->select('transaksi_pelayanan_penunjang_expertise_lpa.expertiseid, transaksi_pelayanan_penunjang_expertise_lpa.pacsnumber,
        transaksi_pelayanan_penunjang_expertise_lpa.createdby, transaksi_pelayanan_penunjang_expertise_lpa.created_at, transaksi_pelayanan_penunjang_detail.id,
        transaksi_pelayanan_penunjang_detail.relation, transaksi_pelayanan_penunjang_detail.relationname, transaksi_pelayanan_penunjang_detail.paymentmethod, 
        transaksi_pelayanan_penunjang_detail.doktername, transaksi_pelayanan_penunjang_detail.roomname, transaksi_pelayanan_penunjang_expertise_lpa.fotoradiologi, transaksi_pelayanan_penunjang_detail.name,
        transaksi_pelayanan_penunjang_expertise_lpa.statuspinjam, transaksi_pelayanan_penunjang_expertise_lpa.asalpeminjam, transaksi_pelayanan_penunjang_expertise_lpa.peminjamname');
        $this->dt->where('transaksi_pelayanan_penunjang_expertise_lpa.created_at >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_expertise_lpa.created_at <=', $search['sampai']);
        //$this->dt->like('transaksi_pelayanan_penunjang_expertise_lpa.expertiseid', $search['idexpertise']);
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

    function ambildataIGD()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
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
        $this->dt->where('cancel', 0.00);
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

    function ambildatarajalIGD()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel', 0.00);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterRajaBDl($search)
    {
        $this->dt = $this->db->table($this->table);

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('cancel', 0.00);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        if ($search['pilihanpoli'] != "") {
            $this->dt->like('groups', $search['pilihanpoli']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

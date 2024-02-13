<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelValidasiPembayaranFarmasi extends Model
{

    protected $table      = 'transaksi_kasir_apotek';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'validationnumber', 'journalnumber', 'documentdate', 'documentyear', 'documentmonth', 'referencenumber', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea',
        'pasiensubareaname',  'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'poliklinik', 'poliklinikname', 'dokter', 'doktername', 'employee', 'employeename', 'classroom', 'classroomname', 'grandtotal', 'disc',
        'paymentamount', 'memo', 'locationcode', 'locationname', 'posted', 'postedip', 'postedby', 'numberseq', 'createdby', 'createddate', 'paymentchange', 'paymentchangenumber', 'payersname', 'paymentstatus', 'metodepembayaran', 'referensibank', 'nominaldebet', 'noreferensidebet', 'signaturekasir', 'signaturepasien'
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

    function ambildatapembayaran($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_apotek()
    {
        $this->dt = $this->db->table('lokasiapotek');
        $this->dt->orderBy('id');
        $this->dt->select(' locationcode , locationname, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapenunjang_close()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('paymentvalidation', 'BELUM');
        $this->dt->where('qtylayan >', 0);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang_close($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('locationcode', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethod', $search['metodepembayaran']);
        }
        $this->dt->where('paymentvalidation', 'BELUM');
        $this->dt->where('qtylayan >', 0);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_penunjang($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_rajal_kasir_penunjang($referencenumber)
    {
        $tb = "transaksi_farmasi_pelayanan_header";
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_detail_apotek($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapenunjang_close_validasi()
    {
        $this->dt = $this->db->table('transaksi_kasir_apotek');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang_close_validasi($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_apotek');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('locationcode', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_penunjang_header($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapembayaran_apotek($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_apotek');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildatapenunjang_beritaacara()
    {
        $this->dt = $this->db->table('transaksi_kasir_apotek');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang_close_beritaacara($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_apotek');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('locationcode', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
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

    function kunjunganpenunjangprint($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_apotek');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Kasir_Penunjangrajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_buktipembayaran_penunjang($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Bukti Pembayaran Penunjang');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_print_detail_penunjang($journalnumber)
    {
        $tb = "transaksi_farmasi_pelayanan_header";
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

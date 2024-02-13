<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKartuStock extends Model
{

    protected $table      = 'transaksi_farmasi_terima_pbf_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'documentdate', 'relation', 'relationname', 'referencenumber', 'locationcode', 'code', 'name', 'qtybox', 'volume', 'qty', 'uom', 'batchnumber',
        'expireddate', 'disc', 'tax', 'price', 'purchaseprice', 'purchasepricebefore', 'subtotal', 'totaldiscount', 'beforetax', 'taxamount', 'aftertax', 'invoiceamount', 'createdby',
        'createddate'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function search_detail_terima_pbf($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_terima_non_pbf($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_nonpbf_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_so_gudang($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_gudang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_depo_sp($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_distribusi($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDTPBF()
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDTPBF($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_detail');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['namasupplier'] != "") {
            $this->dt->like('suppliername', $search['namasupplier']);
        }

        $this->dt->limit(1000);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDistribusi()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDistribusi($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['referencelocationcode'] != "") {
            $this->dt->like('referencelocationcode', $search['referencelocationcode']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_pelayanan($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function update_validasilunas($journalnumber, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->update($simpandata);
    }

    function update_validasiluarpaket($journalnumber, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->update($simpandata);
    }

    function search_header_pelayanan($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function aturan_pakai()
    {
        $this->dt = $this->db->table('eticket_aturan');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cara_pakai()
    {
        $this->dt = $this->db->table('eticket_carapakai');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cara_petunjuk()
    {
        $this->dt = $this->db->table('eticket_petunjuk');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function update_carapemakaian_obat($id, $simpandata)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->where('id', $id);
        $this->dt->update($simpandata);
    }

    function search_detail_so_depo($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_depo_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_pesanan($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_suratpesan_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildataInGudang()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('locationcode', 'FARMASI');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_dataInDariGudang($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('locationcode', 'FARMASI');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['locationcode'] != "") {
            $this->dt->like('referencelocationcode', $search['locationcode']);
        }

        //$this->dt->limit(1000);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataInGudangAntarDepo()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->notLike('locationcode', 'FARMASI');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_dataInDariGudangAntarDepo($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->notLike('locationcode', 'FARMASI');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['locationcode'] != "") {
            $this->dt->like('referencelocationcode', $search['locationcode']);
        }

        //$this->dt->limit(1000);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataOutGudangAntarDepo()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->notLike('locationcode', 'FARMASI');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_dataOutDariGudangAntarDepo($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        if ($search['locationcode'] != "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }

        //$this->dt->limit(1000);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarekap_resep()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select(' doktername , COUNT(doktername)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->groupBy('doktername');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_rekap_resep($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select(' doktername , COUNT(doktername)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['locationcode'] = "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }

        $this->dt->groupBy('doktername');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarekap_resep_penelaah()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select(' employeename , COUNT(employeename)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->groupBy('employeename');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_rekap_resep_penelaah($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');


        if ($search['locationcode'] = "") {
            $this->dt->select(' employeename , COUNT(employeename)as jumlah ');
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
        } else {
            $this->dt->select(' employeename , COUNT(employeename)as jumlah ');
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
            $this->dt->like('locationcode', $search['locationcode']);
        }

        $this->dt->groupBy('employeename');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarekap_rating_obat()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select(' name , SUM(ABS(qty))as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_rekap_rating_obat($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select(' name , SUM(ABS(qty))as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['locationcode'] = "") {
            $this->dt->like('locationcode', $search['locationcode']);
        }

        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_header_pelayanan_AKHP($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('noreg', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function search_detail_pelayanan_AKHP($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.id, transaksi_farmasi_pelayanan_detail.r, transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.batchnumber, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.name');
        $this->dt->where('transaksi_farmasi_pelayanan_header.noreg', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatakartustock()
    {
        $this->dt = $this->db->table('transaksi_farmasi_main');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('code', '#');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_dataKartuStock($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_main');
        //$this->dt->where('trx', 'I');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', 'FARMASI');
        if ($search['code'] != "") {
            $this->dt->where('code', $search['code']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_dataKartuStock_sebelum($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_main');
        $this->dt->selectSum('qty');
        //$this->dt->where('trx', 'I');
        $this->dt->where('documentdate <=', $search['mulai']);
        $this->dt->where('locationcode', 'FARMASI');
        if ($search['code'] != "") {
            $this->dt->where('code', $search['code']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_dataKartuStock_sesudah($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_main');
        $this->dt->selectSum('qty');
        //$this->dt->where('trx', 'I');
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', 'FARMASI');
        if ($search['code'] != "") {
            $this->dt->where('code', $search['code']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_dataKartuStock_sebelumGC($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_main');
        $this->dt->selectSum('qty');
        //$this->dt->where('trx', 'I');
        $this->dt->where('documentdate <=', $search['mulai']);
        $this->dt->where('locationcode', 'GASCENTRAL');
        if ($search['code'] != "") {
            $this->dt->where('code', $search['code']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function search_dataKartuStock_sesudahGC($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_main');
        $this->dt->selectSum('qty');
        //$this->dt->where('trx', 'I');
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', 'GANCENTRAL');
        if ($search['code'] != "") {
            $this->dt->where('code', $search['code']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_dataKartuStockGC($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_main');
        //$this->dt->where('trx', 'I');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', 'GASCENTRAL');
        if ($search['code'] != "") {
            $this->dt->where('code', $search['code']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

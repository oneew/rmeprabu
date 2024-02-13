<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTerimaPBFDetailKonsinyasi extends Model
{

    protected $table      = 'transaksi_farmasi_faktur_konsinyasi_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'documentdate', 'relation', 'relationname', 'referencenumber', 'locationcode', 'code', 'name', 'qtybox', 'volume', 'qty', 'uom', 'batchnumber',
        'expireddate', 'disc', 'tax', 'price', 'purchaseprice', 'purchasepricebefore', 'subtotal', 'totaldiscount', 'beforetax', 'taxamount', 'aftertax', 'invoiceamount', 'createdby',
        'createddate', 'pabrik'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function search_detail_terima_pbf($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_faktur_konsinyasi_detail');
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
            $this->dt->like('relationname', $search['namasupplier']);
        }

        $this->dt->limit(1000);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDistribusi()
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        //if ($lokasi == "NONE") {
        $this->dt->where('documentdate', date('Y-m-d'));
        // } else {
        //    $this->dt->where('documentdate', date('Y-m-d'));
        //  $this->dt->where('referencelocationcode', session()->get('locationcode'));
        //}

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDistribusi($search)
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');

        //if ($lokasi == "NONE") {


        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', 'FARMASI');
        //} else {

        //  $this->dt->where('documentdate >=', $search['mulai']);
        //  $this->dt->where('documentdate <=', $search['sampai']);
        // $this->dt->where('referencelocationcode', session()->get('locationcode'));
        // }


        $this->dt->orderBy('documentdate', 'DESC');
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


    function search_detail_pelayanan_AKHPCL($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.id, transaksi_farmasi_pelayanan_detail.r, transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.qty as qtypaket, transaksi_farmasi_pelayanan_detail.batchnumber, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.name, , transaksi_farmasi_pelayanan_detail.documentdate, transaksi_farmasi_pelayanan_detail.poliklinikname, transaksi_farmasi_pelayanan_detail.locationcode ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.noreg', $journalnumber);
        $this->dt->where('transaksi_farmasi_pelayanan_detail.qty <>', 0);
        //$this->dt->like('transaksi_farmasi_pelayanan_header.journalnumber', 'RBNAKHPBHPRI');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataDistribusiDetail()
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('qtyrequest > ABS(qty)');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDistribusiDetail($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildatarekap_rating_obat_ruangan()
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select(' name , SUM(ABS(qty))as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('locationcode', $lokasi);
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_rekap_rating_obat_ruangan($search)
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select(' name , SUM(ABS(qty))as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('locationcode', $lokasi);
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterDistribusiDetail_baru($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        if ($search['referencelocationcode'] == "") {
            // $this->dt->where('locationcode', 'FARMASI');
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
            $this->dt->where('qtyrequest > ABS(qty)');
            if ($search['namaobat'] <> "") {
                $this->dt->like('name', $search['namaobat']);
            }
        } else {
            // $this->dt->where('locationcode', 'FARMASI');
            $this->dt->where('referencelocationcode', $search['referencelocationcode']);
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
            $this->dt->where('qtyrequest > ABS(qty)');
            if ($search['namaobat'] <> "") {
                $this->dt->like('name', $search['namaobat']);
            }
        }
        // $this->dt->like('name', $search['namaobat']);

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterDTPBF_baru($search)
    {
        $kategori = $search['kategori'];
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_detail');
        $this->dt->join('obat', 'obat.code=transaksi_farmasi_terima_pbf_detail.code', 'left');
        $this->dt->join('transaksi_farmasi_terima_pbf_header', 'transaksi_farmasi_terima_pbf_header.journalnumber=transaksi_farmasi_terima_pbf_detail.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_terima_pbf_detail.code, transaksi_farmasi_terima_pbf_detail.name, transaksi_farmasi_terima_pbf_detail.batchnumber, transaksi_farmasi_terima_pbf_detail.uom,transaksi_farmasi_terima_pbf_detail.documentdate,
        transaksi_farmasi_terima_pbf_detail.relationname, transaksi_farmasi_terima_pbf_detail.referencenumber, transaksi_farmasi_terima_pbf_detail.expireddate, transaksi_farmasi_terima_pbf_detail.qtybox,
        transaksi_farmasi_terima_pbf_detail.volume, transaksi_farmasi_terima_pbf_detail.qty, transaksi_farmasi_terima_pbf_detail.uom, obat.types, transaksi_farmasi_terima_pbf_detail.price, transaksi_farmasi_terima_pbf_detail.purchaseprice,
        transaksi_farmasi_terima_pbf_detail.subtotal,  transaksi_farmasi_terima_pbf_header.invoicedate');

        if ($kategori == "1") {
            $this->dt->where('transaksi_farmasi_terima_pbf_header.documentdate >=', $search['mulai']);
            $this->dt->where('transaksi_farmasi_terima_pbf_header.documentdate <=', $search['sampai']);
        } else {
            $this->dt->where('transaksi_farmasi_terima_pbf_header.invoicedate >=', $search['mulai']);
            $this->dt->where('transaksi_farmasi_terima_pbf_header.invoicedate <=', $search['sampai']);
        }
        if ($search['namasupplier'] != "") {
            $this->dt->like('relationname', $search['namasupplier']);
        }
        if ($search['groups'] != "") {
            $this->dt->like('obat.types', $search['groups']);
        }

        if ($search['namaobat'] != "") {
            $this->dt->like('transaksi_farmasi_terima_pbf_detail.name', $search['namaobat']);
        }


        //$this->dt->limit(2000);
        $this->dt->orderBy('transaksi_farmasi_terima_pbf_detail.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_depo_sp_vitual($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataPenjualan()
    {

        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join('transaksi_farmasi_pelayanan_header', 'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber', 'left');
        $this->dt->join('obat', 'obat.code=transaksi_farmasi_pelayanan_detail.code', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.id, transaksi_farmasi_pelayanan_detail.documentdate,  transaksi_farmasi_pelayanan_detail.karyawan,
        transaksi_farmasi_pelayanan_detail.dispensasi, transaksi_farmasi_pelayanan_detail.relation, transaksi_farmasi_pelayanan_detail.relationname, transaksi_farmasi_pelayanan_detail.paymentmethodname,
        transaksi_farmasi_pelayanan_detail.doktername,transaksi_farmasi_pelayanan_detail.employeename,transaksi_farmasi_pelayanan_detail.locationcode,transaksi_farmasi_pelayanan_detail.code,
        transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.batchnumber,transaksi_farmasi_pelayanan_detail.expireddate, transaksi_farmasi_pelayanan_detail.qty,
        transaksi_farmasi_pelayanan_detail.qtyresep, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.signa1,transaksi_farmasi_pelayanan_detail.signa2, transaksi_farmasi_pelayanan_detail.emptydate,
        transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.createdby, transaksi_farmasi_pelayanan_detail.journalnumber,
        transaksi_farmasi_pelayanan_header.groups, transaksi_farmasi_pelayanan_header.doktername, transaksi_farmasi_pelayanan_header.dispensasipejabat, transaksi_farmasi_pelayanan_header.dispensasialasan, obat.groups as jenis,obat.manufacturename,
        obat.salesprice, obat.taxprice');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPO');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cariambildataPenjualan($search)
    {

        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join('transaksi_farmasi_pelayanan_header', 'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber', 'left');
        $this->dt->join('obat', 'obat.code=transaksi_farmasi_pelayanan_detail.code', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.id, transaksi_farmasi_pelayanan_detail.documentdate,  transaksi_farmasi_pelayanan_detail.karyawan,
        transaksi_farmasi_pelayanan_detail.dispensasi, transaksi_farmasi_pelayanan_detail.relation, transaksi_farmasi_pelayanan_detail.relationname, transaksi_farmasi_pelayanan_detail.paymentmethodname,
        transaksi_farmasi_pelayanan_detail.doktername,transaksi_farmasi_pelayanan_detail.employeename,transaksi_farmasi_pelayanan_detail.locationcode,transaksi_farmasi_pelayanan_detail.code,
        transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.batchnumber,transaksi_farmasi_pelayanan_detail.expireddate, transaksi_farmasi_pelayanan_detail.qty,
        transaksi_farmasi_pelayanan_detail.qtyresep, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.signa1,transaksi_farmasi_pelayanan_detail.signa2, transaksi_farmasi_pelayanan_detail.emptydate,
        transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.createdby, transaksi_farmasi_pelayanan_detail.journalnumber,
        transaksi_farmasi_pelayanan_header.groups, transaksi_farmasi_pelayanan_header.doktername, transaksi_farmasi_pelayanan_header.dispensasipejabat, transaksi_farmasi_pelayanan_header.dispensasialasan, obat.groups as jenis,obat.manufacturename,
        obat.salesprice, obat.taxprice');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate <=', $search['sampai']);
        $this->dt->where('transaksi_farmasi_pelayanan_detail.locationcode', $search['locationcode']);
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.documentdate', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_rekap_resep_penelaah_baru($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        if ($search['locationcode'] == "") {
            $this->dt->select('employeename , COUNT(employeename)as jumlah');
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
        } else {
            $this->dt->select('employeename , COUNT(employeename)as jumlah');
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
            $this->dt->where('locationcode', $search['locationcode']);
        }
        $this->dt->groupBy('employeename');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarekap_resep_entri()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('createdby , COUNT(createdby)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('locationcode', 'DEPO');
        $this->dt->groupBy('createdby');
        $this->dt->orderBy('jumlah', 'DESC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_rekap_resep_entri_baru($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        if ($search['locationcode'] == "") {
            $this->dt->select('createdby , COUNT(createdby)as jumlah');
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
            $this->dt->like('locationcode', 'DEPO');
        } else {
            $this->dt->select('createdby , COUNT(createdby)as jumlah');
            $this->dt->where('documentdate >=', $search['mulai']);
            $this->dt->where('documentdate <=', $search['sampai']);
            $this->dt->where('locationcode', $search['locationcode']);
        }
        $this->dt->groupBy('createdby');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildatarekap_resep_narkotik()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join('obat', 'obat.code=transaksi_farmasi_pelayanan_detail.code', 'left');
        $this->dt->join('transaksi_farmasi_pelayanan_header', 'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.relation, transaksi_farmasi_pelayanan_detail.relationname, transaksi_farmasi_pelayanan_header.pasienaddress,transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name,
        transaksi_farmasi_pelayanan_detail.journalnumber, transaksi_farmasi_pelayanan_header.locationname, transaksi_farmasi_pelayanan_header.doktername, SUM(ABS(transaksi_farmasi_pelayanan_detail.qty))as jumlah,
        transaksi_farmasi_pelayanan_detail.uom, SUM(ABS(transaksi_farmasi_pelayanan_detail.subtotal))as total, transaksi_farmasi_pelayanan_detail.documentdate');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPO');
        $this->dt->where('obat.category', 'NARKOTIKA');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.relation');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'ASC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cariambildatarekap_resep_narkotik($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join('obat', 'obat.code=transaksi_farmasi_pelayanan_detail.code', 'right');
        $this->dt->join('transaksi_farmasi_pelayanan_header', 'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.relation, transaksi_farmasi_pelayanan_detail.relationname, transaksi_farmasi_pelayanan_header.pasienaddress,transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name,
        transaksi_farmasi_pelayanan_detail.journalnumber, transaksi_farmasi_pelayanan_header.locationname, transaksi_farmasi_pelayanan_header.doktername, SUM(ABS(transaksi_farmasi_pelayanan_detail.qty))as jumlah,
        transaksi_farmasi_pelayanan_detail.uom, SUM(ABS(transaksi_farmasi_pelayanan_detail.subtotal))as total, transaksi_farmasi_pelayanan_detail.documentdate');
        if ($search['locationcode'] == "") {
            $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate >=', $search['mulai']);
            $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate <=', $search['sampai']);
            $this->dt->like('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPO');
            $this->dt->where('obat.category', 'NARKOTIKA');
        } else {
            $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate >=', $search['mulai']);
            $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate <=', $search['sampai']);
            $this->dt->like('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPO');
            $this->dt->where('obat.category', 'NARKOTIKA');
            $this->dt->where('transaksi_farmasi_pelayanan_detail.locationcode', $search['locationcode']);
        }

        $this->dt->groupBy('transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.relation');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'ASC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarekap_resep_psiko()
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join('obat', 'obat.code=transaksi_farmasi_pelayanan_detail.code', 'left');
        $this->dt->join('transaksi_farmasi_pelayanan_header', 'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.relation, transaksi_farmasi_pelayanan_detail.relationname, transaksi_farmasi_pelayanan_header.pasienaddress,transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name,
        transaksi_farmasi_pelayanan_detail.journalnumber, transaksi_farmasi_pelayanan_header.locationname, transaksi_farmasi_pelayanan_header.doktername, SUM(ABS(transaksi_farmasi_pelayanan_detail.qty))as jumlah,
        transaksi_farmasi_pelayanan_detail.uom, SUM(ABS(transaksi_farmasi_pelayanan_detail.subtotal))as total, transaksi_farmasi_pelayanan_detail.documentdate');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPO');
        $this->dt->where('obat.category', 'PSIKOTROPIKA');
        $this->dt->groupBy('transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.relation');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'ASC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cariambildatarekap_resep_psiko($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join('obat', 'obat.code=transaksi_farmasi_pelayanan_detail.code', 'right');
        $this->dt->join('transaksi_farmasi_pelayanan_header', 'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.relation, transaksi_farmasi_pelayanan_detail.relationname, transaksi_farmasi_pelayanan_header.pasienaddress,transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name,
        transaksi_farmasi_pelayanan_detail.journalnumber, transaksi_farmasi_pelayanan_header.locationname, transaksi_farmasi_pelayanan_header.doktername, SUM(ABS(transaksi_farmasi_pelayanan_detail.qty))as jumlah,
        transaksi_farmasi_pelayanan_detail.uom, SUM(ABS(transaksi_farmasi_pelayanan_detail.subtotal))as total, transaksi_farmasi_pelayanan_detail.documentdate');
        if ($search['locationcode'] == "") {
            $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate >=', $search['mulai']);
            $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate <=', $search['sampai']);
            $this->dt->like('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPO');
            $this->dt->where('obat.category', 'PSIKOTROPIKA');
        } else {
            $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate >=', $search['mulai']);
            $this->dt->where('transaksi_farmasi_pelayanan_detail.documentdate <=', $search['sampai']);
            $this->dt->like('transaksi_farmasi_pelayanan_detail.locationcode', 'DEPO');
            $this->dt->where('obat.category', 'PSIKOTROPIKA');
            $this->dt->where('transaksi_farmasi_pelayanan_detail.locationcode', $search['locationcode']);
        }

        $this->dt->groupBy('transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.relation');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'ASC');
        //$this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_retur_pbf($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_retur_pbf_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

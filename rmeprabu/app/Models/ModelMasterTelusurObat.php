<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMasterTelusurObat extends Model
{

    protected $table      = 'obat';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'code', 'name', 'uom', 'volume', 'composition', 'purchaseprice', 'taxprice', 'salesprice', 'minstock', 'maxstock', 'types', 'category', 'groups', 'eticket', 'onlabel', 'offlabel',
        'sicklevel', 'memo', 'ac', 'dc', 'pc', 'ac_pc', 'heartindication', 'fn', 'pregnantriskcode', 'pregnantriskname', 'tradename', 'manufacturecode', 'manufacturename', 'originalname',
        'classteraphycode', 'classteraphyname', 'subclassteraphycode', 'subclassteraphyname', 'regimen', 'indication', 'usualdoze', 'pf_start', 'pf_work', 'pf_time', 'off_label_used',
        'drugefek', 'foodinteraction', 'production', 'stockupdate', 'locationcode', 'locationname', 'transactionlastupdate', 'numberseq', 'createdby', 'createddate', 'modifiedby', 'modifieddate',
        'purchaseprice_ori', 'taxprice_ori', 'salesprice_ori', 'inactive', 'keterangan', 'sumber'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function ambildataobat()
    {
        $this->dt = $this->db->table('obat');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataobat_obat()
    {
        $this->dt = $this->db->table('obat');
        //$this->dt->where('types', 'OBAT');
        //$this->dt->where('inactive', 'TIDAK');
        $this->dt->notLike('code', 'NONE');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function kelompokobat()
    {
        $this->dt = $this->db->table('kelompok_obat_gudang');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kelompokobat_stockopname()
    {
        $this->dt = $this->db->table('kelompok_obat_gudang');
        $this->dt->orderBy('id', 'ASC');
        $this->dt->where('stockopname', 0);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function caridataobat()
    {
        $this->dt = $this->db->table('obat_balance');
        $this->dt->join('obat', 'obat.code=obat_balance.code', 'left');
        $this->dt->select('obat_balance.code, obat_balance.uom, SUM(obat_balance.balance)as stock, obat.name, obat.id');
        $this->dt->groupBy('obat_balance.code');
        $this->dt->orderBy('name', 'ASC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_DataObat($search)
    {
        $this->dt = $this->db->table('obat_balance');
        $this->dt->join('obat', 'obat.code=obat_balance.code', 'left');
        $this->dt->select('obat_balance.code, obat_balance.uom, SUM(obat_balance.balance)as stock, obat.name, obat.purchaseprice, obat.id');
        if ($search['codeobat'] != "") {
            $this->dt->like('obat_balance.code', $search['codeobat']);
        }
        if ($search['namaobat'] != "") {
            $this->dt->like('obat.name', $search['namaobat']);
        }
        $this->dt->groupBy('obat_balance.code');
        $this->dt->limit(100);

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_obat($code)
    {
        $tb = "obat";
        $this->dt = $this->db->table('obat');
        $this->dt->select('code, uom, name, round(obat.purchaseprice)as hargasebelum, purchaseprice');
        $this->dt->where('code', $code);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_obat_baru($id)
    {
        $tb = "obat";
        $this->dt = $this->db->table('obat');
        $this->dt->select('code, uom, name, round(obat.purchaseprice)as hargasebelum, purchaseprice');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_supplier()
    {
        $this->dt = $this->db->table('supplier  ');
        $this->dt->select(' code ,  name, address ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_BacthNumber($code)
    {
        $tb = "obat";
        $this->dt = $this->db->table('obat_balance');
        $this->dt->select('code, uom, batchnumber, expireddate, balance, createddate');
        $this->dt->where('code', $code);
        $this->dt->where('locationcode', 'FARMASI');
        $this->dt->orderBy('expireddate', 'ASC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_BacthNumber($code)
    {
        $tb = "obat";
        $this->dt = $this->db->table('obat_balance');
        $this->dt->select('id, code, uom, batchnumber, expireddate, balance, createddate');
        $this->dt->where('code', $code);
        $this->dt->where('locationcode', 'FARMASI');
        $this->dt->orderBy('expireddate', 'ASC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_obat_BN($id)
    {
        $tb = "obat_balance";
        $this->dt = $this->db->table('obat_balance');
        $this->dt->select('id, code, uom, batchnumber, expireddate, round(balance,0) as balance, createddate');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildata_akhp()
    {
        $this->dt = $this->db->table('obat');
        $this->dt->where('types', 'AKHP');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_bhp()
    {
        $this->dt = $this->db->table('obat');
        $this->dt->where('types', 'BHP');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_gasmedis()
    {
        $this->dt = $this->db->table('obat');
        $this->dt->where('types', 'GAS MEDIS');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_obat($id)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->where('code', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_DataObat_amprah($search)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(obat_balance.balance)as stock, obat.name, obat.purchaseprice, obat_balance.locationcode');
        if ($search['codeobat'] != "") {
            $this->dt->like('obat_balance.code', $search['codeobat']);
        }
        if ($search['namaobat'] != "") {
            $this->dt->like('obat.name', $search['namaobat']);
        }
        if ($search['locationcode'] != "") {
            $this->dt->like('obat_balance.locationcode', $search['locationcode']);
        }
        $this->dt->groupBy('obat_balance.code');
        $this->dt->limit(100);

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_obat_depo_sp($code, $locationcode)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(round(obat_balance.balance,0))as stock, obat.name, obat.purchaseprice, obat_balance.locationcode');
        $this->dt->where('obat.code', $code);
        $this->dt->where('obat_balance.locationcode', $locationcode);
        $this->dt->groupBy('obat_balance.code');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_obat_BN_distribusi($id)
    {
        $tb = "obat_balance";
        $this->dt = $this->db->table('obat_balance');
        $this->dt->select('id, code, uom, batchnumber, expireddate, round(balance)as balance, createddate');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_BacthNumber_distribusi($code, $locationcode)
    {
        $tb = "obat";
        $this->dt = $this->db->table('obat_balance');
        $this->dt->select('id, code, uom, batchnumber, expireddate, balance, createddate');
        $this->dt->where('code', $code);
        $this->dt->where('locationcode', $locationcode);
        $this->dt->where('locationcode', 'FARMASI');
        $this->dt->orderBy('expireddate', 'ASC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_sp($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_detail');
        $this->dt->join('obat', 'obat.code=transaksi_farmasi_deposp_detail.code', 'left');
        $this->dt->select('transaksi_farmasi_deposp_detail.code, transaksi_farmasi_deposp_detail.uom, round(transaksi_farmasi_deposp_detail.qty)as qty, transaksi_farmasi_deposp_detail.name, round(obat.salesprice) as salesprice');
        $this->dt->where('transaksi_farmasi_deposp_detail.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_obat_depo_sp_distribusi($code)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(obat_balance.balance)as stock, obat.name, obat.purchaseprice, obat_balance.locationcode');
        $this->dt->where('obat.code', $code);
        $this->dt->groupBy('obat_balance.code');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_stok_obat($search)
    {
        $this->dt = $this->db->table('obat_balance');
        $this->dt->join('obat', 'obat.code=obat_balance.code', 'inner');
        $this->dt->select('obat_balance.code, obat.uom, obat_balance.balance as stock, obat.name, obat_balance.expireddate, obat_balance.batchnumber, obat.manufacturename, obat.taxprice, obat.groups, obat.category');
        $this->dt->where('obat_balance.locationcode', $search['locationcode']);
        if ($search['types'] != "") {
            $this->dt->like('obat.types', $search['types']);
        }
        if ($search['namaobat'] != "") {
            $this->dt->like('obat.name', $search['namaobat']);
        }
        $this->dt->orderBy('obat_balance.code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kamar()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id ');
        $this->dt->groupBy('roomname');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function caridataobatpelayanan()
    {
        $this->dt = $this->db->table('obat');
        $this->dt->orderBy('name', 'ASC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_DataObat_pelayanan($search)
    {
        $this->dt = $this->db->table('obat');
        if ($search['codeobat'] != "") {
            $this->dt->like('code', $search['codeobat']);
        }
        if ($search['namaobat'] != "") {
            $this->dt->like('name', $search['namaobat']);
        }
        $this->dt->orderBy('name');
        $this->dt->limit(100);

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_obat_pelayanan($id)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->select('id, code, name, uom, composition, round(salesprice)as salesprice');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_BacthNumber_pelayanan($code, $locationcode)
    {
        $tb = "obat";
        $this->dt = $this->db->table('obat_balance');
        $this->dt->select('id, code, uom, batchnumber, expireddate, balance, createddate');
        $this->dt->where('code', $code);
        $this->dt->where('locationcode', $locationcode);
        $this->dt->orderBy('expireddate', 'ASC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_minstock_obat($code)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->select('minstock');
        $this->dt->where('code', $code);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_detail_obat($id)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function caridataobatbalance()
    {
        $this->dt = $this->db->table('obat_balance');
        $this->dt->join('obat', 'obat.code=obat_balance.code', 'left');
        $this->dt->select('obat_balance.code, obat_balance.uom, SUM(obat_balance.balance)as balance, obat.name, obat.id, obat_balance.batchnumber, obat_balance.expireddate, obat_balance.createdby, obat_balance.createddate, obat_balance.locationcode');
        $this->dt->groupBy('obat_balance.locationcode', 'FARMASI');
        $this->dt->groupBy('obat_balance.code');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function caridataobatPesan()
    {
        $this->dt = $this->db->table('obat_balance');
        $this->dt->join('obat', 'obat.code=obat_balance.code', 'left');
        $this->dt->select('obat_balance.code, obat_balance.uom, SUM(obat_balance.balance)as stock, obat.name, obat.id');
        $this->dt->groupBy('obat_balance.code');
        $this->dt->orderBy('name', 'ASC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_DataObat_Pesan($search)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(obat_balance.balance)as stock, obat.name, obat.purchaseprice, obat_balance.locationcode');
        if ($search['codeobat'] != "") {
            $this->dt->like('obat_balance.code', $search['codeobat']);
        }
        if ($search['namaobat'] != "") {
            $this->dt->like('obat.name', $search['namaobat']);
        }
        if ($search['locationcode'] != "") {
            $this->dt->like('obat_balance.locationcode', 'FARMASI');
        }
        $this->dt->groupBy('obat_balance.code');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_obat_pesan($code, $locationcode)
    {
        $locationcode = 'FARMASI';
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(round(obat_balance.balance,0))as stock, obat.name, obat.purchaseprice, obat_balance.locationcode');
        $this->dt->where('obat.code', $code);
        $this->dt->where('obat_balance.locationcode', $locationcode);
        $this->dt->groupBy('obat_balance.code');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_lokasi_stock($lokasi)
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->where('code', $lokasi);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_DataObat_barang_masuk($search)
    {
        $this->dt = $this->db->table('obat');
        //$this->dt->join('obat', 'obat.code=obat_balance.code', 'left');
        $this->dt->select('obat.code, obat.uom, obat.volume as stock, obat.name, obat.purchaseprice, obat.id');
        if ($search['codeobat'] != "") {
            $this->dt->like('obat.code', $search['codeobat']);
        }
        if ($search['namaobat'] != "") {
            $this->dt->like('obat.name', $search['namaobat']);
        }
        $this->dt->groupBy('obat.code');
        $this->dt->limit(100);

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function caridataobatamprahruangan()
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(obat_balance.balance)as stock, obat.name, obat.id');
        $this->dt->groupBy('obat.code');
        $this->dt->orderBy('name', 'ASC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_DataObat_amprah_ruangan($search)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(obat_balance.balance)as stock, obat.name, obat.purchaseprice, obat_balance.locationcode');
        if ($search['codeobat'] != "") {
            $this->dt->like('obat.code', $search['codeobat']);
        }
        if ($search['namaobat'] != "") {
            $this->dt->like('obat.name', $search['namaobat']);
        }
        // if ($search['locationcode'] != "") {
        //     $this->dt->like('obat_balance.locationcode', $search['locationcode']);
        // }
        $this->dt->groupBy('obat.code');
        $this->dt->limit(1000);

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_obat_depo_sp_ruangan($code, $locationcode)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(round(obat_balance.balance,0))as stock, obat.name, obat.purchaseprice, obat_balance.locationcode');
        $this->dt->where('obat.code', $code);
        //$this->dt->like('obat_balance.locationcode', $locationcode);
        $this->dt->groupBy('obat_balance.code');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function caridataobatbalanceBatch()
    {
        $this->dt = $this->db->table('obat_balance');
        $this->dt->join('obat', 'obat.code=obat_balance.code', 'left');
        $this->dt->select('obat_balance.code, obat_balance.uom, SUM(obat_balance.balance)as balance, obat.name, obat.id, obat_balance.batchnumber, obat_balance.expireddate, obat_balance.createdby, obat_balance.createddate, obat_balance.locationcode');
        $this->dt->groupBy('obat_balance.id');
        //$this->dt->groupBy('obat_balance.code');
        $this->dt->orderBy('name', 'ASC');
        $this->dt->limit(500);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_DataObat_amprah_NoBatch($search)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.uom, SUM(obat_balance.balance)as stock, obat.name, obat.id, obat.purchaseprice, obat_balance.locationcode');
        if ($search['codeobat'] != "") {
            $this->dt->like('obat_balance.code', $search['codeobat']);
        }
        if ($search['namaobat'] != "") {
            $this->dt->like('obat.name', $search['namaobat']);
        }
        if ($search['locationcode'] != "") {
            $this->dt->like('obat_balance.locationcode', $search['locationcode']);
        }
        $this->dt->groupBy('obat_balance.code');
        // $this->dt->groupBy('obat_balance.id');
        $this->dt->limit(100);

        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function ambildataobat_obat_inactive()
    {
        $this->dt = $this->db->table('obat');
        $this->dt->where('types', 'OBAT');
        $this->dt->where('inactive', 'YA');
        $this->dt->notLike('code', 'NONE');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_obat_code($id)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->where('code', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function search_Faktur($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('code', $search['codeobat']);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_Distribusi($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('code', $search['codeobat']);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_Penjualan($search)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('code', $search['codeobat']);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

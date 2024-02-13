<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ModelChartPasien extends Model
{

    protected $order = array('id' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct()
    {
        parent::__construct();
        $this->db = db_connect();
    }

    function get_list_pasien($date)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select('id , paymentmethod , paymentgroup,  pasiengender');
        $this->dt->where('documentdate', $date);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_payment()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select('id , paymentmethod');
        $this->dt->groupBy('paymentmethod');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_payment2()
    {
        $this->dt = $this->db->table('cara_pembayaran');
        $this->dt->select('id , groups as paymentmethod ');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->groupBy('groups');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_pendapatan_rajal($bulan, $tahun)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->select('SUM(paymentamount)as jumlahrajal');
        $this->dt->where('documentyear', $tahun);
        $this->dt->where('documentmonth', $bulan);
        $this->dt->where('groups', 'IRJ');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_pendapatan_igd($bulan, $tahun)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->select('SUM(paymentamount)as jumlahigd');
        $this->dt->where('documentyear', $tahun);
        $this->dt->where('documentmonth', $bulan);
        $this->dt->where('groups', 'IGD');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_pendapatan_ranap($bulan, $tahun)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->select('SUM(paymentamount)as jumlahranap');
        $this->dt->where('documentyear', $tahun);
        $this->dt->where('documentmonth', $bulan);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
}

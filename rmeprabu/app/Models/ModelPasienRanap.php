<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class ModelPasienRanap extends Model
{

    protected $table = "transaksi_pelayanan_daftar_rawatinap";
    protected $column_order = array('id', 'journalnumber', 'documentdate', 'pasienid', 'pasienname', 'paymentmethodname', 'doktername', 'dokter');
    protected $column_search = array('journalnumber', 'documentdate', 'pasienid', 'pasienname', 'paymentmethodname', 'doktername');
    protected $order = array('id' => 'desc');
    protected $request;
    protected $db;
    protected $dt;



    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }

    private function _get_datatables_query()
    {

        $this->dt = $this->db->table($this->table);
        $this->dt->where('statusrawatinap', 'RAWAT');


        if ($this->request->getPost('norm')) {

            $this->dt->like('pasienid', $this->request->getPost('norm'));
        }

        if ($this->request->getPost('smf')) {
            $this->dt->like('smfname', $this->request->getPost('smf'));
        }



        if ($this->request->getPost('start_date') && $this->request->getPost('end_date')) {

            $start_date = date('Y-m-d', strtotime($this->request->getPost("start_date")));
            $end_date = date('Y-m-d', strtotime($this->request->getPost("end_date")));

            $this->dt->where('documentdate >=', $start_date);
            $this->dt->where('documentdate <=', $end_date);
            $this->dt->where('statusrawatinap', 'RAWAT');
        }



        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }

    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }

    function get_data_ibs($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');

        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');

        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_edukasibedah($id)
    {
        $tb = "edukasi_bedah";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id_tproh', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_rajal($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_pulang($id)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_pemeriksaan_rajal($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_ranap_validasi($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $id);
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_kasir($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_kasir_penunjang($referencenumber)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_kasir_penunjang_validasi($referencenumber)
    {
        $tb = "transaksi_kasir_penunjang";
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_kasir_ranap($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_kasir_validasi($referencenumber)
    {
        $tb = "transaksi_kasir_rawatjalan";
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }



    function get_data_rajal_close($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_by_journalnumber($journalnumber)
    {
        $tb = "transaksi_pelayanan_rawatjalan_header";
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_kasir_validasi_print($id)
    {
        $tb = "transaksi_kasir_rawatjalan";
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_kasir_validasi_print2($referencenumber)
    {
        $tb = "transaksi_kasir_rawatjalan";
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_kasir_validasi_print2($referencenumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_kasir_validasi_print3($referencenumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'UM');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_kasir_validasi_print4($referencenumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('paymentstatus', 'PINDAH CARA PEMBAYAR');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_kasir_validasi_print5($referencenumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'PHKP');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Rincian');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_ranap3($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Rincian');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir2($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_ranap($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Informasi');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_rajal_print($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Kwitansi Instalasi Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_buktipembayaran($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Bukti');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
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

    function get_data_buktipembayaran_uangmuka($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Bukti Pembayaran Uang Muka Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_bukti_pindahcabar($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Bukti Pindah Cara Pembayaran Pada Pelayanan Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_bukti_pindahhakkelas($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Bukti Pindah Hak Kelas Perawatan Pada Pelayanan Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_bac($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Berita Acara Setoran');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_penerimaan($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Penerimaan Kasir');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_piutang($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Piutang Kasir');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_detail_validasi($lokasikasir, $hal)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', $hal);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_10besar_penyakit_rajal($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan 10 Besar Penyakit Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_10besar_penyakit_igd($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan 10 Besar Penyakit IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_10besar_penyakit_ranap($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan 10 Besar Penyakit Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_bac_penunjang($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Berita Acara Setoran');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_bac_uangmuka($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Berita Acara Setoran Uang Muka');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_rajal_kasir_validasi_signature($referencenumber)
    {
        $tb = "transaksi_kasir_rawatjalan";
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_penunjang_kasir_validasi_signature($referencenumber)
    {
        $tb = "transaksi_kasir_penunjang";
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_kasir_validasi_signature($referencenumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_kasir_validasi_signature_pindahhakkelas($referencenumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->like('types', 'PHKP');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_close_email($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_data_ranap_close_email($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_close_email_ranap($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_email($id)
    {
        $tb = "transaksi_kasir_rawatjalan";
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->join('transaksi_pelayanan_daftar_rawatjalan', 'transaksi_pelayanan_daftar_rawatjalan.journalnumber = transaksi_kasir_rawatjalan.referencenumber', 'left');
        $this->dt->where('transaksi_kasir_rawatjalan.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganrajal($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function kunjunganrajaldirect($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganigdprint($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganpenunjangprint($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganranapprint($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->notLike('validationnumber', 'PBTN');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganranapprint_pindahhakkelas($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('validationnumber', $journalnumber);
        $this->dt->like('types', 'PHKP');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_print_detail($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_print_detail_penunjang($journalnumber)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_print_detail_ranap($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_print_detail_ranap_kasir($journalnumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_print_detail_ranap_kasir_pindahhakkelas($journalnumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('validationnumber', $journalnumber);
        $this->dt->like('types', 'PHKP');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_detail_igd($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_detail_ranap($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_journalnumber($documentdate)
    {
        $tb = "transaksi_kasir_rawatjalan";
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->select(' journalnumber  , noantrian ');
        $this->dt->where('documentdate', $documentdate);
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_ranap_pulang($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rawatinap_by_journalnumber($journalnumber)
    {
        $tb = "transaksi_pelayanan_rawatinap_tindakan_header";
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function pindahcarabayar($carabayar)
    {
        $this->dt = $this->db->table('cara_pembayaran');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->notLike('code', $carabayar);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function pindahhakkelas($kelas)
    {
        $this->dt = $this->db->table('pelayanan_kelas');
        $this->dt->where('realclass', 1);
        $this->dt->notLike('code', $kelas);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_masuk_rajal_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Pasien Masuk Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_masuk_igd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Pasien Masuk IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_masuk_ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Pasien Masuk Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_keluar_rajal_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Pasien Keluar Rawat Jalan');
        $this->dt->limit(10000);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_keluar_igd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Pasien Keluar IGD');
        $this->dt->limit(10000);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_data_pasien_keluar_ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Pasien Keluar Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_rajal_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_igd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_cabar_rajal_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Cara Bayar Di Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_cabar_igd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Cara Bayar Di IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_cabar_ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Cara Bayar Di Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_wilayah_rajal_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Wilayah Di Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_wilayah_igd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Wilayah Di IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_wilayah_ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Wilayah Di Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_gender_rajal_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Jenis kelamin Di Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_gender_igd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Jenis kelamin Di IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_gender_ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Jenis kelamin Di Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_carapulang_rajal_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Cara Pulang Di Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_carapulang_igd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Cara Pulang Di IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rekap_kunjungan_carapulang_ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Berdasarkan Cara Pulang Di Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_mati_igd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Data Kematian Di IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_mati_ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Data Kematian Di Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_radiologi_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Detail Pemeriksaan Radiologi');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpk_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Detail Pemeriksaan Laboratorium Patologi Klinik');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpa_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Detail Pemeriksaan Laboratorium Patologi Anatomi');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_bd_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Detail Pemeriksaan Bank Darah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rad_cabar_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Radiologi Per Cara Bayar');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpk_cabar_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Laboratorium Patologi Klinik Per Cara Bayar');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_lpa_cabar_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Laboratorium Patologi Anatomi Per Cara Bayar');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_bd_cabar_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Bank Darah Per Cara Bayar');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rad_wilayah_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Radiologi Per Cara Bayar dan Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpk_wilayah_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Laboratorium Patologi Klinik Per Cara Bayar dan Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpa_wilayah_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Laboratorium Patologi Anatomi Per Cara Bayar dan Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_bd_wilayah_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Bank Darah Per Cara Bayar dan Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rad_wilayah_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Radiologi Per Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpk_wilayah_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Laboratorium Patologi Klinik Per Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpa_wilayah_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Laboratorium Patologi Anatomi Per Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_bd_wilayah_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Bank Darah Per Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rad_gender_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Radiologi Per Jenis Kelamin');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpk_gender_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Laboratorium Patologi Klinik Per Jenis Kelamin');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lpa_gender_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Laboratorium Patologi Anatomi Per Jenis Kelamin');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_bd_gender_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pemeriksaan Bank Darah Per Jenis Kelamin');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_data_ibs_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Detail Operasi Instalasi Bedah Sentral');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_wilayah_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Instalasi Bedah Sentral');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_pem_wilayah_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Tindakan Operasi Per Wilayah Di Instalasi Bedah Sentral');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_kelas_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Tindakan Operasi Per Kelas Di Instalasi Bedah Sentral');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_jenis_op_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Jenis Tindakan Operasi Per SMF Di Instalasi Bedah Sentral');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_jenis_cabar_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Instalasi Bedah Sentral Berdasarkan Cara Bayar');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_jenkel_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Tindakan Operasi Bedah Sentral Berdsarkan Jenis Kelamin');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_smf_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Kunjungan Bedah Sentral Berdsarkan SMF');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_DO_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Dokter Operator Bedah Sentral');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ibs_DA_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Dokter Anestesi Bedah Sentral');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl33_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.3 Kesehatan Gigi Dan Mulut');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl36_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.6 Kegiatan Pembedahan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl37_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.7 Kegiatan Radiologi');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl38_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.8 Pemeriksaan Laboratorium');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_data_rl39_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.9 Pelayanan Rehabilitasi Medik');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl311Rajal_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.11 Kegiatan Kesehatan Jiwa (Rawat Jalan)');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl311Ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.11 Kegiatan Kesehatan Jiwa (Rawat Inap)');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl310_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.10 Kegiatan Pelayanan Khusus');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl314_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.14 Kegiatan Rujukan Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl314IGD_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.14 Kegiatan Rujukan IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl314Ranap_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.14 Kegiatan Rujukan Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl51_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 5.1 Kegiatan Pelayanan Pasien Lama dan Baru');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl4A_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 4A Laporan Data Keadaan Morbiditas Pasien Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl4B_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 4B Laporan Data Keadaan Morbiditas Pasien Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rl31_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan RL 3.1 Kegiatan Pelayanan Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_bukti_ambulance($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Formulir Pelayanan Ambulance Emergency');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_kop_kematian_forensik($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'SERTIFIKAT MEDIS PENYEBAB KEMATIAN');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_kop_visum_forensik($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'SURAT KETERANGAN VISUM ET REPERTUM');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function data_ambulance($journalnumber)
    {
        $this->dt = $this->db->table('admission_ambulance');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function data_surat_kematian($journalnumber)
    {
        $this->dt = $this->db->table('admission_suratkematian');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function data_surat_visum($journalnumber)
    {
        $this->dt = $this->db->table('admission_forensik');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_ABL_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Detail Pelayanan Ambulance');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_abl_cabar_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pelayanan Ambulance Per Cara Bayar');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_abl_wilayah_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pelayanan Ambulance Per Cara Bayar dan Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_abl_wilayah_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pelayanan Ambulance Per Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_abl_gender_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pelayanan Ambulance Per Jenis Kelamin');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_FRS_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Detail Pelayanan Forensik');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_frs_cabar_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pelayanan Forensik Per Cara Bayar');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_frs_wilayah_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pelayanan Forensik Per Cara Bayar dan Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_frs_wilayah_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pelayanan Forensik Per Wilayah');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_frs_gender_pem_kop($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Laporan Rekap Pelayanan Forensik Per Jenis Kelamin');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_DTPBF($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_DTNonPBF($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_nonpbf_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_DSO($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_gudang_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_SOGudang($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'BUKTI STOCK OPNAME');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function opnameheader($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_gudang_header');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function opnamedetail($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_gudang_detail');
        $this->dt->where('journalnumber', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_depo_SP($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'FORM AMPRAH BARANG');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function SPheader($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function depoSPdetail($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_detail');
        $this->dt->where('journalnumber', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_DSP($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_deposp_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_DDA($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_distribusi($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'BUKTI DISTRIBUSI PERMINTAAN BARANG');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function Distribusiheader($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_header');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Distribusidetail($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->where('journalnumber', $id);
        //$this->dt->where('createdby', 'YUNI DEWI LESTARI, S');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_DFPR($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_karcis($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Pendaftaran Instalasi Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_karcis_igd($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_edukasi_bedah($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'DOKUMEN EDUKASI PRA BEDAH');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function edukasibedah($id)
    {
        $this->dt = $this->db->table('edukasi_bedah');
        $this->dt->where('id_tproh', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_edukasibedah($journalnumber)
    {
        $this->dt = $this->db->table('edukasi_bedah');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_informconcent_operasi($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'FORMULIR PERSETUJUAN/PENOLAKAN UPAYA TINDAKAN KEDOKTERAN');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_laporan_operasi($journalnumber)
    {
        $this->dt = $this->db->table('laporan_operasi');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_laporan_operasi_before($journalnumber)
    {
        $this->dt = $this->db->table('laporan_operasi');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_header_lap_operasi($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'LAPORAN OPERASI');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasienpindah($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');

        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_sjp($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Surat Jaminan Pelayanan (SJP) Rawat Jalan');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganrajal_sjp($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_expertise_rad($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'HASIL PEMERIKSAAN RADIOLOGI');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function tindakan_penunjang($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function tindakan_penunjang_rad($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function headerpenunjang($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function tindakan_penunjang_detail($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function tindakan_penunjang_detail_rad($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }



    function expertisepenunjang($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->where('expertiseid', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function expertisepenunjang_rad($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->where('idPenunjangDetail', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function expertisepenunjang_lpa($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpa');
        $this->dt->where('pacsnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganrajal_pasienid($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' journalnumber  , pasienid ');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_sjp_igd($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Surat Jaminan Pelayanan (SJP) IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function data_pasienid($pasienid)
    {
        $this->dt = $this->db->table('pasien');
        $this->dt->select(' religion  , code ');
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganranap($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganranap_pasienid($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' journalnumber  , pasienid ');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganranap_sjp($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_sjp_ranap($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'Surat Jaminan Pelayanan (SJP) Rawat Inap');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kop_RMK($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'RINGKASAN MASUK DAN KELUAR RUMAH SAKIT');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_RMK($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_RMK($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select('pasienid');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_master($pasienid)
    {
        $tb = "pasien";
        $this->dt = $this->db->table('pasien');
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kop_Persetujuan($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'SURAT PERSETUJUAN KELAS PERAWATAN DAN PENANGGUNG JAWAB BIAYA');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function dataSep($id)
    {
        $this->dt = $this->db->table('dataSep');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function dataSepBarcode($id)
    {
        $this->dt = $this->db->table('dataSep');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function dataSepBarcodeRanap($referencenumber)
    {
        $this->dt = $this->db->table('dataSepRanap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function dataSepRanap($referencenumber)
    {
        $this->dt = $this->db->table('dataSepRanap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_expertise_lpa($lokasikasir)
    {
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_expertise_lpk($lokasikasir)
    {
        $tb = "kop";
        $this->dt = $this->db->table('kop');
        $this->dt->where('kelompok', $lokasikasir);
        $this->dt->like('deskripsi', 'HASIL PEMERIKSAAN LABORATORIUM PATOLOGI KLINIK');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function data_surat_visum_igd($journalnumber)
    {
        $this->dt = $this->db->table('admission_visum_igd');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganlpk($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function data_kunjunganlpk($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_hasil_lis($journalnumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->join('lab_hasil', 'lab_hasil.no_order = transaksi_pelayanan_penunjang_detail.journalnumber', 'left');
        $this->dt->where('transaksi_pelayanan_penunjang_detail.journalnumber', $journalnumber);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganLPK_pasienid($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' journalnumber  , pasienid ');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganlpk_detail($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganLPK_pasienid2($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' journalnumber  , pasienid ');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function hasilexpertiseLpk($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise_lpk');
        $this->dt->where('expertiseid', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kasir_ranap_validasi($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_print_detail_ranap_kasir_pindahcabar($journalnumber)
    {
        $tb = "transaksi_pelayanan_kasir_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('validationnumber', $journalnumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganranapprint_pindahcabar($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('validationnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function dataSPRI($id)
    {
        $this->dt = $this->db->table('dataSPRIBpjs');
        $this->dt->where('noSuratKontrol', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function dataSPRI_all($id)
    {
        $this->dt = $this->db->table('dataSPRIBpjs');
        $this->dt->where('noSuratKontrol', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function dataSuratKontrol_all($id)
    {
        $this->dt = $this->db->table('datasuratkontrolbpjs');
        $this->dt->where('noSuratKontrol', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function dataSuratKontrolBpjs($id)
    {
        $this->dt = $this->db->table('datasuratkontrolbpjs');
        $this->dt->where('noSuratKontrol', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function caridokter($kodedokter)
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->select('name');
        $this->dt->where('kode_bpjs', $kodedokter);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function tindakanRajal($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function registerfakturpbf($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_header');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function detailregisterfakturpbf($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_pbf_detail');
        $this->dt->where('journalnumber', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function registerfakturnonpbf($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_nonpbf_header');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function detailregisterfakturnonpbf($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_terima_nonpbf_detail');
        $this->dt->where('journalnumber', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanHeader($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('journalnumber, pasienid, pasienname, paymentmethodname, documentdate, pasienaddress, pasienage, dateofbirth, pasiengender, poliklinik, poliklinikname, doktername, paymentmethod');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function get_obat_farklin($id)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_triase($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select('journalnumber, kelompok_triase');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_asal_header($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('journalnumber, referencenumber');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_karcis_rajal($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganpenunjangprintTagihanPenunjang($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganpenunjangprintTagihanPenunjang2($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_DSO_depo($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_depo_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function opnamedepoheader($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_depo_header');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function opnamedepodetail($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_opname_depo_detail');
        $this->dt->where('journalnumber', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_print_detail_tindakan_rajal($journalnumber)
    {
        $tb = " transaksi_pelayanan_rawatjalan_header";
        $this->dt = $this->db->table(' transaksi_pelayanan_rawatjalan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_print_detail_tindakan_rajal_array($journalnumber)
    {
        $tb = " transaksi_pelayanan_rawatjalan_header";
        $this->dt = $this->db->table(' transaksi_pelayanan_rawatjalan_header');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_print_detail_tindakan_rajal_detail($journalnumber)
    {
        $tb = " transaksi_pelayanan_rawatjalan_header";
        $this->dt = $this->db->table(' transaksi_pelayanan_rawatjalan_header');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganigdprintverifikasi($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganranapverifikasi($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanDetail($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select('name, uom, qty, expireddate, price, subtotal, qtypaket, qtyluarpaket');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(200);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanDetailKronis($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select('name, uom, qty, expireddate, price, subtotal, qtypaket, qtyluarpaket');
        $this->dt->where('journalnumber', $id);
        $this->dt->where('qtyluarpaket > 0');
        $this->dt->limit(50);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanDetailNonKronis($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->select('name, uom, qty, expireddate, price, subtotal, qtypaket, qtyluarpaket');
        $this->dt->where('journalnumber', $id);
        //$this->dt->where('qtyluarpaket < 1');
        $this->dt->limit(50);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function etiketfarmasirajal($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
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

    function get_data_detail_apotek($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_rajal_kasir_apotek($referencenumber)
    {
        $tb = "transaksi_farmasi_pelayanan_header";
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_rawatinap_by_journalnumber2($journalnumber)
    {
        //$tb = "transaksi_pelayanan_rawatinap_tindakan_header";
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_header');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_pasien_pulang($id)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');

        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_pulang_ranap($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_DTPBF_Retur($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_retur_pbf_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_DTPBF_Konsinyasi($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_faktur_konsinyasi_header');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function DistribusidetailAKHP($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->join('obat', 'obat.code = transaksi_farmasi_distribusi_detail.code', 'left');
        $this->dt->where('obat.types', 'AKHP');
        $this->dt->where('journalnumber', $id);
        //$this->dt->where('createdby', 'YUNI DEWI LESTARI, S');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function DistribusidetailGM($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->join('obat', 'obat.code = transaksi_farmasi_distribusi_detail.code', 'left');
        $this->dt->where('obat.types', 'GAS MEDIS');
        $this->dt->where('journalnumber', $id);
        //$this->dt->where('createdby', 'YUNI DEWI LESTARI, S');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Distribusidetailobat($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->join('obat', 'obat.code = transaksi_farmasi_distribusi_detail.code', 'left');
        $this->dt->where('obat.types', 'OBAT');
        $this->dt->where('journalnumber', $id);
        //$this->dt->where('createdby', 'YUNI DEWI LESTARI, S');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function DistribusidetailBHP($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_distribusi_detail');
        $this->dt->join('obat', 'obat.code = transaksi_farmasi_distribusi_detail.code', 'left');
        $this->dt->where('obat.types', 'BHP');
        $this->dt->where('journalnumber', $id);
        //$this->dt->where('createdby', 'YUNI DEWI LESTARI, S');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Distribusidetailbaksos($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_baksos_gudang_detail');
        $this->dt->where('journalnumber', $id);
        //$this->dt->where('createdby', 'YUNI DEWI LESTARI, S');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function Distribusiheaderbaksos($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_baksos_gudang_header');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_DDABaksos($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_baksos_gudang_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganrajal_sjp_hari_ini($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganrajal_sjp_sebelumnya($pasienid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->where('documentdate <', date('Y-m-d'));
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_karcis_rajal_aliit($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan as daftar');
        $this->dt->join('pasien', 'pasien.code=daftar.pasienid', 'left');
        $this->dt->select('daftar.id, daftar.journalnumber, daftar.documentdate,
            daftar.pasienid, daftar.pasienname, daftar.price, daftar.description,
            daftar.paymentmethodname, daftar.poliklinikname, daftar.doktername,
            daftar.kasirvalidasi, daftar.pasiendateofbirth,daftar.pasienage, pasien.ssn');
        $this->dt->where('daftar.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kunjunganpenunjangprint_aliit($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('referencenumber', $referencenumber);
        // $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function kasir_igd_aliit($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('referencenumber', $referencenumber);
        // $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class Model_autocomplete_obat extends Model
{

    //protected $table = "transaksi_pelayanan_rawatinap_operasi_header2";
    protected $order = array('id' => 'desc');
    protected $request;
    protected $db;
    protected $dt;

    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
    }


    function get_list_dokter()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id , kode_bpjs');
        $this->dt->where('types', 'DOKTER');
        $this->dt->where('specialist', 'YA');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->notLike('memo', 'ANESTESI');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_all()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id, kode_bpjs ');
        $this->dt->where('types', 'DOKTER');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->notLike('name', 'AHLI GIZI');
        $this->dt->notLike('name', 'NONE');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter2()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'DOKTER');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->notLike('memo', 'ANESTESI');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_forensik()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('locationname', 'FORENSIK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_penunjang($groups)
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id , code');
        $this->dt->where('realdokter', 1);
        $this->dt->like('types', $groups);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_gizi2()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');

        $this->dt->where('types', 'DOKTER');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->like('name', 'GIZI');
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

    function get_list_pelayanan_radiologi()
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'RAD');
        $this->dt->groupBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_PK()
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'LPK');
        $this->dt->groupBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_PA()
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'LPA');
        $this->dt->groupBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_BD()
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'BD');
        $this->dt->groupBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function get_list_dokter_gizi()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'DOKTER');
        $this->dt->where('inactive', 'TIDAK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_perawat_askep()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->like('name', 'PERAWAT');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_perawat_askep2()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('id');
        $this->dt->select(' name , id ');
        $this->dt->where('nakes', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function iaget_list_dokter_anestesi()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'DOKTER');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->where('memo', 'ANESTESI');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // mengambil nama, code , memo dari dokter yang diselect
    function get_data_dokter()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->select(' name , id , code , memo, kode_bpjs ');

        $this->dt->where('id', $this->request->getPost('key'));

        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dokter_forensik()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->select(' name , id , code , memo , nip');

        $this->dt->where('id', $this->request->getPost('key'));

        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dokter_penunjang()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->select(' name , id , code ');

        $this->dt->where('id', $this->request->getPost('key'));

        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dokter_gizi()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->select(' name , id , code , memo ');
        //$this->dt->where('name', 'AHLI GIZI');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }





    function get_data_smf()
    {
        $this->dt = $this->db->table('pelayanan_smf');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_payment()
    {
        $this->dt = $this->db->table('cara_pembayaran');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_poli()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' name , id , code , bpjscode');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pelayanan()
    {
        $this->dt = $this->db->table('pelayanan_tarif_daftar');
        $this->dt->select(' name , id , code , groups, price, share1, share2');
        $this->dt->notLike('groups', 'IGD');
        $this->dt->notLike('groups', 'BAYI');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pelayanan_igd()
    {
        $this->dt = $this->db->table('pelayanan_tarif_daftar');
        $this->dt->select(' name , id , code , groups, price, share1, share2');
        $this->dt->like('groups', 'IGD');
        //$this->dt->Like('groups', 'BAYI');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }




    function get_data_kelas()
    {
        $this->dt = $this->db->table('pelayanan_kelas');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_roomname()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' name , id , code , room , roomname');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }




    function get_list()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->limit(10);
        $this->dt->like('name', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function get_list_pelayanan($term, $key)
    {
        $category = ['TNO', 'SAL', 'TOB', 'GAM', 'BMHP', 'TMO'];
        $this->dt = $this->db->table('pelayanan_tarif_rawatinap');
        $this->dt->orderBy('name');
        $this->dt->select('id, groups, groupname, code, groupname , name, category, categoryname, price, share1, share2,  share21, share22,  share23');
        $this->dt->where('classroom', $term);
        //$this->dt->where('category', 'TNO');
        $this->dt->whereIn('category', $category);
        $this->dt->like('name', $key);
        // $this->dt->like('code', 'TNO');
        $this->dt->notLike('nonaktif', 'Y');
        $this->dt->notLike('nonaktif', 'D');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_pelayanan_IBS($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatinap');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, groupname , name, category, categoryname, price, share1, share2');

        $this->dt->where('classroom', $term);
        $this->dt->notLIKE('categoryname', 'TINDAKAN NON OPERATIF');
        $this->dt->like('name', $key);
        $this->dt->limit(20);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_pelayanan_PSN($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatinap');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, groupname , name, category, categoryname, price, share1, share2');
        $this->dt->where('classroom', $term);
        $this->dt->like('name', $key);
        $this->dt->like('categoryname', 'PERSALINAN');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_Gizi($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatinap');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, groupname , name, category, categoryname, price, share1, share2');
        $this->dt->where('classroom', $term);
        $this->dt->like('name', $key);
        $this->dt->like('category', 'APG');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_Gizi2($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatinap');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, groupname , name, category, categoryname, price, share1, share2');
        $this->dt->where('classroom', $term);
        $this->dt->like('name', $key);
        $this->dt->where('categoryname', 'PELAYANAN GIZI');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_visite($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_visite');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, name, category, price, share1, share2');
        $this->dt->where('classroom', $term);

        $this->dt->like('name', $key);
        $this->dt->notLike('name', 'ASUHAN KEPERAWATAN');
        $this->dt->notLike('name', 'KONSELING / VISITE FARMASI KLINIK');
        $this->dt->notLike('name', 'VISITE PERAWAT KAMAR OPERASI / VISITE PERAWAT ANESTESI');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_askep($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_visite');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, name, category, price, share1, share2');
        $this->dt->where('classroom', $term);

        $this->dt->like('name', $key);
        $this->dt->notLike('name', 'VISITE DOKTER UMUM / JAGA / RUANGAN (DILUAR JAM KERJA )');
        $this->dt->notLike('name', 'VISITE DOKTER SPESIALIS DI HARI LIBUR');
        $this->dt->notLike('name', 'VISITE DOKTER SPESIALIS');
        $this->dt->notLike('name', 'VISITE > 1X PADA HARI SAMA - DOKTER UMUM / JAGA / RUANGAN');
        $this->dt->notLike('name', 'VISITE > 1X PADA HARI SAMA - DOKTER SPESIALIS DI HARI LIBUR');
        $this->dt->notLike('name', 'VISITE > 1X PADA HARI SAMA - DOKTER SPESIALIS');
        $this->dt->notLike('name', 'KONSULTASI MEDIK PSIKIATRI');
        $this->dt->notLike('name', 'KONSULTASI DOKTER  SPESIALIS DI LUAR JAM KERJA (LEWAT TELEPON)');
        $this->dt->notLike('name', 'KONSULTASI DOKTER  SPESIALIS DI LUAR JAM KERJA (LEWAT TELEPON)');

        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_groups_ibs()
    {
        $this->dt = $this->db->table('list_groups_ibs');
        $this->dt->orderBy('deskripsi');
        $this->dt->select(' groups , deskripsi ');

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_perawat($key)
    {
        $this->dt = $this->db->table('daftar_perawat');
        $this->dt->orderBy('nama');
        $this->dt->select('id, nama, jabatan');
        $this->dt->limit(10);
        $this->dt->like('nama', $key);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_pemeriksaan_radiologi($key, $kelas)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2 ');
        $this->dt->like('name', $key);
        $this->dt->where('classroom', $kelas);
        $this->dt->like('types', 'RAD');
        $this->dt->groupBy('name');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_pemeriksaan_LPA($key, $kelas)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2 ');
        $this->dt->like('name', $key);
        $this->dt->where('classroom', $kelas);
        $this->dt->like('types', 'LPA');
        $this->dt->groupBy('name');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_pemeriksaan_LPK($key, $kelas)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2 ');
        $this->dt->like('name', $key);
        $this->dt->where('classroom', $kelas);
        $this->dt->like('types', 'LPK');
        $this->dt->groupBy('name');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_BD($key, $kelas)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2 ');
        $this->dt->where('types', 'BD');
        $this->dt->like('name', $key);
        $this->dt->where('classroom', $kelas);
        $this->dt->orWhere('classroom', 'NONE');

        $this->dt->groupBy('name');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_ABL($key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2 ');
        $this->dt->like('name', $key);
        $this->dt->where('types', 'ABL');
        $this->dt->groupBy('name');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_FRS($key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2 ');
        $this->dt->like('name', $key);
        $this->dt->where('types', 'FRS');
        $this->dt->groupBy('name');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_diagnosa($key)
    {
        $this->dt = $this->db->table('rekmed_icdx2');
        $this->dt->orderBy('id');
        $this->dt->select('id, s1, code, originalcode, name, subname, severity');
        $this->dt->like('originalcode', '.');
        $this->dt->like('name', $key);
        $this->dt->orlike('code', $key);

        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_faskes($key)
    {
        $this->dt = $this->db->table('faskes');
        $this->dt->orderBy('id');
        $this->dt->select('id, code,  name,  address');
        $this->dt->like('name', $key);

        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_rujuk($key)
    {
        $this->dt = $this->db->table('faskes');
        $this->dt->orderBy('name');
        $this->dt->select('id, code, name, address');
        $this->dt->like('name', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_wilayah($key)
    {
        $this->dt = $this->db->table('master_desakel');
        $this->dt->join('area', 'area.code=master_desakel.kode', 'left');
        $this->dt->orderBy('master_desakel.NAMA_KEL', 'ASC');
        $this->dt->select('master_desakel.ID, master_desakel.NAMA_KEL, master_desakel.NAMA_KEC, master_desakel.NAMA_KAB, master_desakel.NAMA_PROP, master_desakel.kode_wilayah, master_desakel.kode, area.code, area.name, master_desakel.zipcode');
        $this->dt->like('master_desakel.NAMA_KEC', $key);
        $this->dt->orlike('master_desakel.NAMA_KEL', $key);

        $this->dt->limit(70);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_pelayanan_rajal($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatjalan');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, name, category, price, share1, share2, types');

        $this->dt->where('classroom', $term);
        $this->dt->where('types', 'IRJ');
        $this->dt->like('name', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_igd($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatjalan');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, name, category, price, share1, share2, types');

        $this->dt->where('classroom', $term);
        $this->dt->where('types', 'IGD');
        $this->dt->like('name', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_rajal_gizi($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatjalan');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, name, category, price, share1, share2, types');

        $this->dt->where('classroom', $term);
        $this->dt->where('types', 'IRJ');
        $this->dt->like('name', $key);
        $this->dt->like('name', 'GIZI');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_igd_gizi($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatjalan');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, name, category, price, share1, share2, types');

        $this->dt->where('classroom', $term);
        $this->dt->where('types', 'IGD');
        $this->dt->like('name', $key);
        $this->dt->like('name', 'GIZI');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_jpkasir()
    {
        $this->dt = $this->db->table('jenispembayaran_kasir');
        $this->dt->select(' jenispembayaran , id , keteranganpembayaran , deskripsi ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_inacbg($key)
    {
        $this->dt = $this->db->table('inacbg_tarif');
        $this->dt->select('INACBG, DESKRIPSI, TARIFF, sum(if(KELAS_RAWAT = 1, TARIFF_ORIGINAL, 0)) AS kls1, sum(if(KELAS_RAWAT = 2, TARIFF_ORIGINAL, 0)) AS kls2, sum(if(KELAS_RAWAT = 3, TARIFF_ORIGINAL, 0)) AS kls3');
        $this->dt->where('REGIONAL', 'reg1');
        $this->dt->where('KODE_TARIFF', 'BP');
        $this->dt->like('INACBG', $key, 'after');
        $this->dt->groupBy('INACBG');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_icdx($key)
    {
        $this->dt = $this->db->table('rekmed_icdx');
        $this->dt->orderBy('id');
        $this->dt->select('id, originalcode, name');
        $this->dt->like('name', $key);
        $this->dt->orlike('originalcode', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_icdix($key)
    {
        $this->dt = $this->db->table('rekmed_icdix');
        $this->dt->orderBy('id');
        $this->dt->select('id, code, name');
        $this->dt->like('name', $key);
        $this->dt->orlike('code', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_mobil()
    {
        $this->dt = $this->db->table('mobil_ambulance');
        $this->dt->select(' platnomor , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_supplier($key)
    {
        $this->dt = $this->db->table('supplier');
        $this->dt->orderBy('name');
        $this->dt->select('id, code, name, address');
        $this->dt->like('name', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pabrik()
    {
        $this->dt = $this->db->table('pabrik');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_lokasi()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pregnan()
    {
        $this->dt = $this->db->table('obat_resikohamil');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kelasterapi()
    {
        $this->dt = $this->db->table('obat_kelasterapi');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_subkelasterapi()
    {
        $this->dt = $this->db->table('obat_subkelasterapi');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_petugas_resep()
    {
        $this->dt = $this->db->table('petugas_resep');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id , code');
        $this->dt->where('inactive', 'TIDAK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_petugas_resep()
    {
        $this->dt = $this->db->table('petugas_resep');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_pelayanan_IBS_new($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatinap');
        $this->dt->orderBy('id');
        $this->dt->select('id, groups, groupname, code, groupname , name, category, categoryname, price, share1, share2');
        $this->dt->where('classroom', $term);
        $this->dt->notLIKE('categoryname', 'TINDAKAN NON OPERATIF');
        $this->dt->like('name', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_role()
    {
        $this->dt = $this->db->table('cofee');
        $this->dt->select(' name , id , code ');
        $this->dt->where('id', $this->request->getPost('key'));
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_triase()
    {
        $this->dt = $this->db->table('master_triage');
        $this->dt->select(' name , id , code');

        $this->dt->where('id', $this->request->getPost('key'));

        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_pelayanan_IBS45($term, $key)
    {
        $this->dt = $this->db->table('pelayanan_tarif_rawatinap');
        $this->dt->orderBy('name');
        $this->dt->select('id, groups, groupname, code, groupname , name, category, categoryname, price, share1, share2');
        $this->dt->where('classroom', $term);
        // $this->dt->where('groups', 'MEDIS OPERATIF');
        $this->dt->where('groupname', 'TINDAKAN MEDIS OPERATIF');
        $this->dt->like('name', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_rad()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('types', 'RAD');
        $this->dt->where('realdokter', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelas()
    {
        $this->dt = $this->db->table('pelayanan_kelas');

        $this->dt->select(' name , id , code');
        $this->dt->where('realclass', '1');
        $this->dt->orderBy('id', 'ASC');

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_pa()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('types', 'LPA');
        $this->dt->where('realdokter', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_bd()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('types', 'BD');
        $this->dt->where('realdokter', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_pk()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('types', 'LPK');
        $this->dt->where('realdokter', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_kelompok_lab()
    {
        $this->dt = $this->db->table('kelompokLabPk');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_LPK_paket($kelompokLab, $classroom)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2, kelompokLab');
        $this->dt->like('kelompokLab', $kelompokLab);
        $this->dt->where('classroom', $classroom);
        $this->dt->like('types', 'LPK');
        $this->dt->groupBy('name');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_paramedic($namapoli)
    {
        $locationname = ['SEMUA', $namapoli];
        $this->dt = $this->db->table('daftar_perawat');
        $this->dt->whereIn('locationname', $locationname);
        $this->dt->orderBy('nama', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_paramedic_igd()
    {
        $locationname = ['IGD', 'SEMUA'];
        $this->dt = $this->db->table('daftar_perawat');
        $this->dt->whereIn('locationcode', $locationname);
        $this->dt->orderBy('nama', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_paramedic_ranap($roomname)
    {
        $this->dt = $this->db->table('daftar_perawat');
        $this->dt->where('area', 'IRI');
        //$this->dt->like('locationname', $roomname);
        $this->dt->orderBy('nama', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_paramedic_nutrisi()
    {
        $this->dt = $this->db->table('daftar_perawat');
        $this->dt->like('locationname', 'AHLI NUTRISI');
        $this->dt->orderBy('nama', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_diagnosa_rujukan()
    {
        $this->dt = $this->db->table('rekmed_icdx2');
        $this->dt->orderBy('id');
        $this->dt->select('id, s1, code, originalcode, name, subname, severity');
        $this->dt->like('originalcode', '.');

        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelompok_rad()
    {
        $this->dt = $this->db->table('kelompokRadiologi');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_RAD_paket($kelompokLab, $classroom)
    {
        $aktif = ['Y', 'D'];
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2, kelompokLab, nonaktif');
        $this->dt->like('kelompokLab', $kelompokLab);
        $this->dt->where('classroom', $classroom);
        $this->dt->like('types', 'RAD');
        $this->dt->whereNotIn('nonaktif', $aktif);
        $this->dt->groupBy('name');
        $this->dt->limit(130);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelompok_lab_pa()
    {
        $this->dt = $this->db->table('kelompokLPA');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_LPA_paket($kelompokLab, $classroom)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2, kelompokLab');
        $this->dt->like('kelompokLab', $kelompokLab);
        $this->dt->where('classroom', $classroom);
        $this->dt->like('types', 'LPA');
        $this->dt->groupBy('name');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelompok_BD()
    {
        $this->dt = $this->db->table('kelompokBD');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_BD_paket($kelompokLab, $classroom)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2, kelompokLab');
        $this->dt->like('kelompokLab', $kelompokLab);
        $this->dt->where('classroom', $classroom);
        $this->dt->like('types', 'BD');
        $this->dt->groupBy('name');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_HD()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('types', 'HD');
        $this->dt->where('realdokter', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelompok_hd()
    {
        $this->dt = $this->db->table('kelompokHD');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_HD_paket($kelompokLab, $classroom)
    {
        $classroom = 'VVIP';
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2, kelompokLab');
        $this->dt->like('kelompokLab', $kelompokLab);
        //$this->dt->where('classroom', $classroom);
        $this->dt->where('classroom', $classroom);
        $this->dt->like('types', 'HEMODIALISA');
        $this->dt->groupBy('name');
        $this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_RHM()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('types', 'RHM');
        $this->dt->where('realdokter', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelompok_rhm()
    {
        $this->dt = $this->db->table('kelompokRHM');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pemeriksaan_RHM_paket($kelompokLab, $classroom)
    {
        $this->dt = $this->db->table('pelayanan_tarif_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2, kelompokLab');
        $this->dt->like('kelompokLab', $kelompokLab);
        $this->dt->where('classroom', $classroom);
        $this->dt->like('types', 'RHM');
        $this->dt->groupBy('name');
        $this->dt->limit(80);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_perawat_rhm()
    {
        $this->dt = $this->db->table('daftar_perawat');
        $this->dt->where('locationname', 'REHAB MEDIK');
        $this->dt->orderBy('nama');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_frs()
    {
        $this->dt = $this->db->table('petugas_penunjang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code, id ');
        $this->dt->where('types', 'FRS');
        $this->dt->where('realdokter', 1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dokter_anestesi()
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('types', 'DOKTER');
        $this->dt->where('inactive', 'TIDAK');
        $this->dt->where('memo', 'ANESTESI');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_obat($key)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->orderBy('name');
        $this->dt->select('id, code, name, uom');
        $this->dt->like('name', $key);
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_obat_cari($key)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->orderBy('name');
        $this->dt->like('name', $key);
        //$this->dt->where('inactive', 'TIDAK');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelrajal extends Model
{

    protected $table      = 'transaksi_pelayanan_daftar_rawatjalan';
    protected $primaryKey = 'id';

    protected $useTimestamps = true;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';

    protected $allowedFields = [
        'statuspasien',
    ];
    public function search($keyword)
    {

        return $this->table('transaksi_pelayanan_daftar_rawatjalan')
            ->where('statusrawatinap', 'RAWAT')
            ->like('pasienid', $keyword)
            ->orLike('smfname', $keyword);
    }

    function ambildatarajal()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->Like('statuspasien', 'DIRAWAT');
        $this->dt->where('registerrawat', 'BELUM');
        $this->dt->orderBy('documentdate', 'DESC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pjb()
    {
        $this->dt = $this->db->table('hubungan_pjb');
        $this->dt->orderBy('hubunganpjb');
        $this->dt->select(' hubunganpjb , id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_naikKelas_Bpjs()
    {
        $this->dt = $this->db->table('kelasrawatnaikBpjs');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_pembiayaan_Bpjs()
    {
        $this->dt = $this->db->table('pembiayaannaikkelasBpjs');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_tujuanKunjunganSep()
    {
        $this->dt = $this->db->table('tujuankunjunganSep');
        $this->dt->orderBy('id');
        $this->dt->select(' name , code, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_statusPulangSep()
    {
        $this->dt = $this->db->table('statuspulangSep');
        $this->dt->orderBy('id');
        $this->dt->select(' name , code, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_flagprocedure()
    {
        $this->dt = $this->db->table('flagprocedureSep');
        $this->dt->orderBy('id');
        $this->dt->select(' name , code, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_penunjangsep()
    {
        $this->dt = $this->db->table('penunjangSep');
        $this->dt->orderBy('id');
        $this->dt->select(' name , code, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_assesmnetpelayanansep()
    {
        $this->dt = $this->db->table('assessmentPelayananSep');
        $this->dt->orderBy('id');
        $this->dt->select(' name , code, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_jeniskllsep()
    {
        $this->dt = $this->db->table('jenislakalantasSep');
        $this->dt->orderBy('id');
        $this->dt->select(' name , code, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_penyebab_kematian()
    {
        $this->dt = $this->db->table('penyebab_kematian');
        $this->dt->orderBy('id');
        $this->dt->select(' name , id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_penjaminKLL()
    {
        $this->dt = $this->db->table('penjamin_kll');
        $this->dt->orderBy('penjamin');
        $this->dt->select(' penjamin , id , code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelas()
    {
        $this->dt = $this->db->table('pelayanan_kelas');
        $this->dt->select(' code , id , name');
        $this->dt->notLIKE('vclaimclass', 'NULL ');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_propinsi()
    {
        $this->dt = $this->db->table('master_desakel');
        $this->dt->select(' NO_PROP , ID , NAMA_PROP');
        $this->dt->groupBy('NAMA_PROP');
        $this->dt->orderBy('NAMA_PROP');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelas_real()
    {
        $this->dt = $this->db->table('pelayanan_kelas');

        $this->dt->select(' code , id , name');
        $this->dt->like('realclass', '1');
        $this->dt->orderBy('code');
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

    function get_list_bed()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id ');
        $this->dt->where('status', 'KOSONG');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_bed_ranap()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id ');
        //$this->dt->where('status', 'KOSONG');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_smf()
    {
        $this->dt = $this->db->table('pelayanan_smf');
        $this->dt->select(' code ,  name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_smf_real()
    {
        $this->dt = $this->db->table('pelayanan_smf');
        $this->dt->select(' code ,  name, id ');
        $this->dt->like('realsmf', 0);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_statuspulang()
    {
        $this->dt = $this->db->table('pasien_status');
        $this->dt->select(' code ,  name, id ');
        $this->dt->notLIKE('eklaimstatus', 'ISNULL');
        $this->dt->orderBy('eklaimstatus');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_APS()
    {
        $this->dt = $this->db->table('alasan_aps');
        $this->dt->select(' code ,  name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_poli()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id, bpjscode ');
        $this->dt->like('code', 'PL');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_polibpjs()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id, bpjscode');
        $this->dt->like('code', 'PL');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function get_list_poli_igd()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('code', 'IGD');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_igd()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('code', 'IGD');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_room_name_coding()
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->orderBy('room');
        $this->dt->select(' room , roomname , id ');
        $this->dt->groupBy('room');
        $this->dt->where('INACTIVE', 'TIDAK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    // list uniq room berdasar kelas (combobox2)
    function get_room_name($classroom)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->orderBy('room');
        $this->dt->select(' room , roomname , id ');
        $this->dt->groupBy('room');
        $this->dt->where('classroom', $classroom);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_kabupaten_name($kelas)
    {
        $this->dt = $this->db->table('master_desakel');
        $this->dt->orderBy('NAMA_KAB');
        $this->dt->select(' NAMA_KAB ,  ID ');
        $this->dt->groupBy('NAMA_KAB');
        $this->dt->where('NAMA_PROP', $kelas);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // list room kosong (combobox3)
    function get_room_list($roomname, $classroom)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->orderBy('name');
        $this->dt->select(' name , code , id ');
        $this->dt->where('roomname', $roomname);
        $this->dt->where('classroom', $classroom);
        $this->dt->where('status', 'KOSONG');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_kecamatan_list($room)
    {
        $this->dt = $this->db->table('master_desakel');
        $this->dt->select(' NAMA_KEC ,  ID ');
        $this->dt->where('NAMA_KAB', $room);
        $this->dt->orderBy('NAMA_KEC');
        $this->dt->groupBy('NAMA_KEC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_pelayanan()
    {
        $this->dt = $this->db->table('pelayanan_tarif_daftar');
        $this->dt->select(' code ,  name, groups, price, share1, share2, id ');
        $this->dt->notLIKE('groups', 'IGD');
        $this->dt->notLIKE('groups', 'BAYI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pelayanan_igd()
    {
        $this->dt = $this->db->table('pelayanan_tarif_daftar');
        $this->dt->select(' code ,  name, groups, price, share1, share2, id ');
        $this->dt->where('groups', 'IGD');
        $this->dt->notLIKE('groups', 'BAYI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_sebab_sakit()
    {
        $this->dt = $this->db->table('pasien_reasoncode');
        $this->dt->select(' code ,  name, id ');
        $this->dt->orderBy('name');
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

    function get_pulang($keterangan)
    {
        $this->dt = $this->db->table('alasan_aps');
        $this->dt->orderBy('name');
        $this->dt->select(' code , name , id ');
        $this->dt->where('keterangan', $keterangan);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_inisial()
    {
        $this->dt = $this->db->table('master_inisial');
        $this->dt->select(' inisial ,  id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_agama()
    {
        $this->dt = $this->db->table('master_agama');
        $this->dt->select(' agama ,  id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kecamatan()
    {
        $this->dt = $this->db->table('master_desakel');
        $this->dt->select(' NAMA_KEC , NAMA_KEL, NAMA_KAB,  id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_nikah()
    {
        $this->dt = $this->db->table('master_marital_status');
        $this->dt->select(' marital_status ,  id ');
        $this->dt->orderBy('marital_status');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pendidikan()
    {
        $this->dt = $this->db->table('master_pendidikan');
        $this->dt->select(' pendidikan ,  id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pekerjaan()
    {
        $this->dt = $this->db->table('master_pekerjaan');
        $this->dt->select(' pekerjaan ,  id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_metode_pembayaran()
    {
        $this->dt = $this->db->table('cara_pembayaran');
        $this->dt->select(' code , name,  id ');
        $this->dt->orderBy('name');
        $this->dt->where('inactive', 'TIDAK');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pasien_status_rajal()
    {
        $this->dt = $this->db->table('pasien_status');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('rajal', '1');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pasien_status_igd()
    {
        $this->dt = $this->db->table('pasien_status');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('igd', '1');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_metodebayar()
    {
        $this->dt = $this->db->table('metode_pembayaran_kasir');
        $this->dt->select(' metodepembayaran, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_bank()
    {
        $this->dt = $this->db->table('daftar_bank');
        $this->dt->select(' namabank, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_bank($metodepembayaran)
    {
        $this->dt = $this->db->table('daftar_bank');
        $this->dt->orderBy('namabank');
        $this->dt->select(' metodepembayaran , namabank , id ');
        $this->dt->where('metodepembayaran', $metodepembayaran);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_jpkasir()
    {
        $this->dt = $this->db->table('jenispembayaran_kasir');
        $this->dt->select(' jenispembayaran, keteranganpembayaran, id ');
        $this->dt->where('code_transaksi', 0);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_jpkasir_uangmuka()
    {
        $this->dt = $this->db->table('jenispembayaran_kasir');
        $this->dt->select(' jenispembayaran, keteranganpembayaran, id ');
        $this->dt->where('jenispembayaran', 'UM');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_jpkasir_pindahcabar()
    {
        $this->dt = $this->db->table('jenispembayaran_kasir');
        $this->dt->select(' jenispembayaran, keteranganpembayaran, id ');
        $this->dt->where('code_transaksi', 2);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_jpkasir_pindahhakkelas()
    {
        $this->dt = $this->db->table('jenispembayaran_kasir');
        $this->dt->select(' jenispembayaran, keteranganpembayaran, deskripsi, id ');
        $this->dt->where('code_transaksi', 3);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_pemicu_inacbg($keterangan)
    {
        $this->dt = $this->db->table('pemicu_inacbg');
        $this->dt->orderBy('name');
        $this->dt->select(' code , name , id , keterangan');
        $this->dt->where('keterangan', $keterangan);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_mobil()
    {
        $this->dt = $this->db->table('mobil_ambulance');
        $this->dt->select(' code ,  platnomor, jenismobil, fungsi, id ');
        $this->dt->orderBy('platnomor');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_supir()
    {
        $this->dt = $this->db->table('sopir_ambulance');
        $this->dt->select(' code ,  supirambulance, id ');
        $this->dt->orderBy('supirambulance');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_kelompok()
    {
        $this->dt = $this->db->table('kategori_pbf');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_active()
    {
        $this->dt = $this->db->table('aktif');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_production()
    {
        $this->dt = $this->db->table('production_farmasi');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_satuan()
    {
        $this->dt = $this->db->table('satuan');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pabrik()
    {
        $this->dt = $this->db->table('pabrik');
        $this->dt->select(' code ,  name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_eticket()
    {
        $this->dt = $this->db->table('eticket_warna');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lokasi()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('employee', '45');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lokasi_farmasi()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('mainwarehouse', '1');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lokasi_distribusi()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('distribusiobat', 1);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_lokasi_stock()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('viewstock', 1);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_central()
    {
        $this->dt = $this->db->table('pemakaian_farmasi');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_jenis()
    {
        $this->dt = $this->db->table('jenis');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kategori()
    {
        $this->dt = $this->db->table('kategori');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_sicklevel()
    {
        $this->dt = $this->db->table('sick_level');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pregnan()
    {
        $this->dt = $this->db->table('obat_resikohamil');
        $this->dt->select(' name, id, code ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelasterapi()
    {
        $this->dt = $this->db->table('obat_kelasterapi');
        $this->dt->select(' name, id, code ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_subkelasterapi()
    {
        $this->dt = $this->db->table('obat_subkelasterapi');
        $this->dt->select(' name, id, code ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_ac()
    {
        $this->dt = $this->db->table('ac_farmasi');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_dc()
    {
        $this->dt = $this->db->table('dc_farmasi');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pc()
    {
        $this->dt = $this->db->table('pc_farmasi');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelompok_obat()
    {
        $this->dt = $this->db->table('kelompok_obat_gudang');
        $this->dt->select(' name, id ');
        $this->dt->where('stockopname', 0);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_racikan()
    {
        $this->dt = $this->db->table('racikan');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_item_racikan()
    {
        $this->dt = $this->db->table('item_racikan');
        $this->dt->select(' code ,  name, id , keterangan');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_racikan($keterangan)
    {
        $this->dt = $this->db->table('item_racikan');
        $this->dt->orderBy('name');
        $this->dt->select(' code , name , id ');
        $this->dt->where('keterangan', $keterangan);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_role()
    {
        $this->dt = $this->db->table('cofee');
        $this->dt->select(' code ,  name, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_triase()
    {
        $this->dt = $this->db->table('master_triage');
        $this->dt->select(' code ,  name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_unit()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->orderBy('name');
        $this->dt->select(' name , id ');
        $this->dt->where('employee', '45');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_kegiatan_ambulance()
    {
        $this->dt = $this->db->table('kegiatan_ambulance');
        $this->dt->select(' name, id ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_piutang($pasienid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(5);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_piutang_rajal($pasienid)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(5);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_detail_penunjang($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_PRB()
    {
        $this->dt = $this->db->table('diagnosaPRB');
        $this->dt->orderBy('id');
        $this->dt->select(' nama , kode, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_taskid()
    {
        $this->dt = $this->db->table('masterTaskId');
        $this->dt->orderBy('id');
        $this->dt->select(' name , code, id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lokasi_depo()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('viewstock', 1);
        $this->dt->where('depo', 1);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lokasi_batch()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('viewstock', 1);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lokasi_farmasi_ruangan()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('room', '1');
        $this->dt->where('employee', 45);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_lokasi_batch2()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('viewstock', 1);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_gudang()
    {
        $this->dt = $this->db->table('gudang');
        $this->dt->select(' code ,  name, id ');
        $this->dt->where('room', '1');
        // $this->dt->where('employee', 45);
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

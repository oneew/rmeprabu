<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelPasienMaster extends Model
{

    protected $table      = 'pasien';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'registerdate', 'code', 'oldcode', 'initial', 'name', 'gender', 'maritalstatus', 'religion', 'bloodtype', 'bloodrhesus', 'ssn', 'placeofbirth',
        'dateofbirth', 'education', 'citizenship', 'work', 'telephone', 'mobilephone', 'area', 'subarea', 'subareaname', 'address', 'postalcode', 'parentname',
        'parenttelephone', 'couplename', 'paymentmethod', 'paymentmethodname', 'cardnumber', 'parentid', 'numberseq', 'locationcode', 'blacklist', 'blacklistby',
        'blacklistdate', 'blacklistnumber', 'createdby', 'createddate', 'modifiedby', 'modifieddate', 'inout', 'datelastout', 'lastinfrom', 'datelastin', 'district',
        'rt', 'rw', 'created_at', 'updated_at', 'namaibukandung', 'kecamatan', 'propinsi', 'kabupaten', 'incorrectNik'
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

    function ambildatapasien()
    {
        $this->dt = $this->db->table($this->table);
        $this->dt->where('code', 'X');
        $this->dt->limit(5);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_DataPasien($search)
    {
        $this->dt = $this->db->table($this->table);
        if ($search['code'] != "") {
            $this->dt->like('code', $search['code'], 'both');
        }
        if ($search['namapasien'] != "") {
            $this->dt->like('name', $search['namapasien'], 'both');
        }
        if ($search['nomorasuransi'] != "") {
            $this->dt->like('cardnumber', $search['nomorasuransi']);
        }
        if ($search['alamat'] != "") {
            $this->dt->like('address', $search['alamat']);
        }
        if ($search['nik'] != "") {
            $this->dt->like('ssn', $search['nik']);
        }
        if (isset($search['dob'])) {
            if ($search['dob'] != "") {
                $this->dt->like('dateofbirth', $search['dob'], 'both');
            }
        }
        $this->dt->limit(10);

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien($id)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_cek($id)
    {
        $tb = "pasien";
        $this->dt = $this->db->table('pasien');
        $this->dt->join('transaksi_pelayanan_daftar_rawatjalan', 'transaksi_pelayanan_daftar_rawatjalan.pasienid=pasien.code', 'left');
        $this->dt->where('pasien.id', $id);
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatjalan.id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_lama($id)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_data_pasien_nik($nik)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('ssn', $nik);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_kelompok_triase()
    {
        $tb = "master_triage";
        $this->dt = $this->db->table($tb);
        $this->dt->notLike('name', 'NONE');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_rajal($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_data_rajal_kunjungan($pasienid)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('pasienid', $pasienid);
        $this->dt->orderby('id', 'DESC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pinjam_expertise($expertiseid)
    {
        $tb = "tracing_pinjam_foto_radiologi";
        $this->dt = $this->db->table($tb);
        $this->dt->where('expertiseid', $expertiseid);
        $this->dt->orderby('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pinjam_expertise_lpa($expertiseid)
    {
        $tb = "tracing_pinjam_foto_lpa";
        $this->dt = $this->db->table($tb);
        $this->dt->where('expertiseid', $expertiseid);
        $this->dt->orderby('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_ranap($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_ranap_kunjungan($pasienid)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('pasienid', $pasienid);
        $this->dt->orderby('id', 'DESC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_rajal_row($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_row_direct($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_lama_rajal($pasienid)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_dokter_bpjs($kodedokter)
    {
        $tb = "dokter";
        $this->dt = $this->db->table($tb);
        $this->dt->where('code', $kodedokter);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_poli_bpjs($kodepoli)
    {
        $tb = "daftar_poli";
        $this->dt = $this->db->table($tb);
        $this->dt->where('code', $kodepoli);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_row($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_row_cek_spri($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_dataSep($noSep)
    {
        $tb = "dataSep";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noSep', $noSep);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dataSep_delete($noSep, $journalnumber)
    {
        $tb = "dataSep";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noSep', $noSep);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dataSepRanap($noSep)
    {
        $tb = "dataSepRanap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noSep', $noSep);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dataSuratKontrol($noSuratKontrol)
    {
        $tb = "dataSuratKontrolbpjs";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noSuratKontrol', $noSuratKontrol);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dataSPRI($noSuratKontrol)
    {
        $tb = "dataSPRIBpjs";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noSuratKontrol', $noSuratKontrol);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_row_sep($id)
    {
        //$tb = "pasien";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->join('dataSep', 'dataSep.journalnumber=transaksi_pelayanan_daftar_rawatjalan.journalnumber', 'left');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_row_spri($id)
    {
        //$tb = "pasien";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->join('dataSPRIBpjs', 'dataSPRIBpjs.journalnumber=transaksi_pelayanan_daftar_rawatjalan.journalnumber', 'left');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_row_sep($id)
    {
        //$tb = "pasien";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->join('dataSepRanap', 'dataSepRanap.referencenumber=transaksi_pelayanan_daftar_rawatinap.referencenumber', 'left');
        $this->dt->where('transaksi_pelayanan_daftar_rawatinap.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_row_dataSuratKontrolBpjs($id)
    {
        //$tb = "pasien";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->join('dataSuratKontrolBpjs', 'dataSuratKontrolBpjs.referencenumber=transaksi_pelayanan_daftar_rawatinap.referencenumber', 'left');
        $this->dt->where('transaksi_pelayanan_daftar_rawatinap.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_lama_nik($nik)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('ssn', $nik);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_pasien_update_nik($nik)
    {
        $this->dt = $this->db->table('pasien');
        $this->dt->where('ssn', $nik);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_validasi($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pulang_ranap($id)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->join('pasien', 'pasien.code=transaksi_pelayanan_pulang_rawatinap.pasienid', 'left');
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pulang_ranap_kasir($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->join('pasien', 'pasien.code=transaksi_pelayanan_pulang_rawatinap.pasienid', 'left');
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_validasi_kasir($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pulang_ranap_on($id)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->join('pasien', 'pasien.code=transaksi_pelayanan_daftar_rawatinap.pasienid', 'left');
        $this->dt->where('transaksi_pelayanan_daftar_rawatinap.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_penunjang($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('pasien', 'pasien.code=transaksi_pelayanan_penunjang_header.pasienid', 'left');
        $this->dt->where('transaksi_pelayanan_penunjang_header.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_penunjang_validasi($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('pasien', 'pasien.code=transaksi_pelayanan_penunjang_header.pasienid', 'left');
        $this->dt->where('transaksi_pelayanan_penunjang_header.journalnumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_dataSuratRujukanRS($noSuratRujukan)
    {
        $tb = "dataSuratRujukanBpjs";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noRujukan', $noSuratRujukan);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dataSuratRujukanRSRajal($noSuratRujukan)
    {
        $tb = "dataSuratRujukanBpjsRajal";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noRujukan', $noSuratRujukan);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_row_dataSuratRujukanBpjs($id)
    {
        //$tb = "pasien";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->join('dataSuratRujukanBpjs', 'dataSuratRujukanBpjs.referencenumber=transaksi_pelayanan_daftar_rawatinap.referencenumber', 'left');
        $this->dt->where('transaksi_pelayanan_daftar_rawatinap.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_poli($kodepoli)
    {
        $tb = "daftar_poli";
        $this->dt = $this->db->table($tb);
        $this->dt->where('bpjscode', $kodepoli);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_poliV2($poliKontrol)
    {
        $tb = "daftar_poli";
        $this->dt = $this->db->table($tb);
        $this->dt->where('bpjscode', $poliKontrol);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_data_surat_kontrol($noSuratKontrol)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noSuratKontrol', $noSuratKontrol);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_data_surat_kontrol_master($noSepPasien)
    {
        $tb = "dataSuratKontrolBpjs";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noSep', $noSepPasien);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_penjaminan_sep_ranap($referencenumber)
    {
        $tb = "dataPengajuanPenjaminanSEP";
        $this->dt = $this->db->table($tb);
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_rajal_row2($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_penjaminan_sep_rajal($referencenumber)
    {
        $tb = "dataPengajuanPenjaminanSEPRajal";
        $this->dt = $this->db->table($tb);
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_diagnosa()
    {
        $tb = "rekmed_icdx2";
        $this->dt = $this->db->table($tb);
        //$this->dt->limit(1);
        $this->dt->select('originalcode');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_tindakan($id)
    {
        $tb = "transaksi_pelayanan_rawatjalan_detail";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_rajal_verifikasi($journalnumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_rajal_verifikasi_karcis($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_data_rajal_row_dataSuratKontrolBpjsRajal($id)
    {
        //$tb = "pasien";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->join('dataSuratKontrolBpjsFromRajal', 'dataSuratKontrolBpjsFromRajal.journalnumber=transaksi_pelayanan_daftar_rawatjalan.journalnumber', 'left');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_poliV2_poli($poliKontrol)
    {
        $tb = "daftar_poli";
        $this->dt = $this->db->table($tb);
        $this->dt->where('name', $poliKontrol);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_dataSuratKontrol_rajal($noSuratKontrol)
    {
        $tb = "dataSuratKontrolBpjsFromRajal";
        $this->dt = $this->db->table($tb);
        $this->dt->where('noSuratKontrol', $noSuratKontrol);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function update_dataPasien($code, $simpandatapasien)
    {
        $this->dt = $this->db->table('pasien');
        $this->dt->where('code', $code);
        $this->dt->update($simpandatapasien);
    }

    function get_data_tindakan_all($id)
    {
        $tb = "transaksi_pelayanan_rawatjalan_detail";
        $this->dt = $this->db->table($tb);
        $this->dt->select('SUM(subtotal)as subtotal, doktername, referencenumber, journalnumber');
        $this->dt->where('referencenumber', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_identitas_data_tindakan_all($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table($tb);
        $this->dt->where('journalnumber', $id);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_ranap_kunjungan_pulang($pasienid)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('pasienid', $pasienid);
        $this->dt->orderby('id', 'DESC');
        $this->dt->limit(5);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_data_penunjang_histori($pasienid)
    {
        $tb = "transaksi_pelayanan_penunjang_detail";
        $this->dt = $this->db->table($tb);
        $this->dt->where('relation', $pasienid);
        $this->dt->orderby('id', 'DESC');
        $this->dt->limit(20);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_obat_histori($pasienid)
    {
        $tb = "transaksi_farmasi_pelayanan_detail";
        $this->dt = $this->db->table($tb);
        $this->dt->where('relation', $pasienid);
        $this->dt->orderby('id', 'DESC');
        $this->dt->limit(40);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_lama_master($id)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('code', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_ranap_klaim($journalnumber)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table($tb);
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_validasi_kasir_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLike('paymentstatus', 'PINDAH CARA PEMBAYAR');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

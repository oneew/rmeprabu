<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;


use CodeIgniter\Model;


class ModelPelayananPoliRME extends Model
{

    protected $table      = 'asesmen_awal_perawatan_rj_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'dokterAnestesi', 'prosedurop', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'doktername', 'bb', 'tb', 'frekuensiNadi', 'tdSistolik',
        'suhu', 'frekuensiNafas', 'skalaNyeri', 'psikologisTak', 'psikologisTakut', 'psikologisSedih', 'psikologisRendahDiri', 'psikologisMarah', 'psikologisMudahTersinggung', 'sosiologisTak', 'sosiologisIsolasi',
        'sosiologisLain', 'spritualTak', 'spiritualPerluDibantu', 'spiritualAgama', 'Alergi', 'uraianAlergi', 'nutrisiTurunBb', 'nutrisiKurus', 'nutrisiMuntahDiare', 'nutrisiKondisiKhusus', 'uraianKondisiKhusus', 'rujukAhliGizi',
        'fungsionalAlatBantu', 'fungsionalNamaAlatBantu', 'fungsionalProthesis', 'fungsionalCacatTubuh', 'fungsionalAdl', 'fungsionalRiwayatJatuh', 'keluhanUtama', 'kesadaran', 'DiagnosaAskep', 'uraianAskep', 'createdBy', 'paramedicName', 'createddate',
        'caraBerjalan', 'dudukMenopang', 'skoringJatuh', 'sasaranRencana', 'file_audio', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifikator', 'tdDiastolik', 'spo2', 'airway', 'suaraNafas', 'polaNafas', 'bunyiNafas', 'iramaNafas',
        'distressPernafasan', 'akral', 'sianosis', 'pengisianKapiler', 'kelembabanKulit', 'turgor', 'eye', 'verbal', 'motorik', 'totalGcs', 'asesmenFungsional', 'edema', 'daerahEdema', 'laserasi', 'daerahLaserasi',
        'kondisiLain', 'provokes', 'quality', 'regio', 'severity', 'durasiNyeri', 'spiritual', 'psikologis', 'sosiologis', 'riwayatPenyakitSekarang', 'riwayatPenyakitKeluarga', 'riwayatPenggunaanObat',
        'nutrisiturunBbDewasa', 'asupanMakanDewasa', 'totalSkorNutrisiDewasa', 'totalSkorNutrisiAnak', 'implementasiAskep', 'anamnesis', 'uraianAllo', 'keadaanUmum', 'admissionDateTime', 'pupil', 'riwayatPenyakitDahulu', 'kondisiPasien',
        'caraTiba', 'kasusTrauma', 'rpdLain', 'riwayatOperasi', 'obatSaatIni', 'terapiKomplementari', 'terapiKomplementariLain', 'merokok', 'uraianMerokok', 'alkohol', 'uraianAlkohol', 'obatTidur', 'olahRaga',
        'hamil', 'perkiraanKelahiran', 'menyusui', 'spontan', 'caesar', 'kurangBulan', 'cukupBulan', 'bcg', 'dpt', 'polio', 'campak', 'hepatitisB', 'pcv', 'varicela', 'rotavirus', 'typoid', 'hib', 'mmr', 'influenza',
        'pneumokokus', 'hpv', 'tetantus', 'zooster', 'yellowFever', 'caCervix', 'hepatitisA', 'hepatitisBDewasa', 'polioDewasa', 'tidakSemangat', 'rasaTertekan', 'depresi', 'cepatLelah', 'sulitBerbicara', 'kurangNafsuMakan',
        'sulitKonsentrasi', 'obatPenenang', 'merasaBersalah', 'kepala', 'rambut', 'muka', 'mata', 'telinga', 'hidung', 'gigi', 'lidah', 'mulut', 'tenggorokan', 'leher', 'punggung', 'payudara', 'dada', 'perut', 'genital',
        'anus', 'integumen', 'ekstremitas', 'crt', 'kananAtas', 'kiriAtas', 'kananBawah', 'kiriBawah', 'ginekologi', 'obstetri', 'kebutuhanEdukasi', 'bahasaSehari', 'perluPenterjemah', 'tingkatPendidikan', 'dapatMembaca',
        'keyakinanPenyakit', 'uraianKeyakinanPenyakit', 'visual', 'audio', 'kinestetik', 'hambatanEdukasi', 'kesediaanMenerimaInformasi', 'penurunanBBRencana', 'penyakitMalnutrisi', 'penyakitBerat', 'diagnosisSekunder',
        'alatBantuBerjalan', 'heparin', 'mobilisasi', 'statusMental', 'observasi', 'terapeutik', 'edukasi', 'kolaborasi', 'lingkarKepala', 'lingkarLengan', 'namaSuami', 'umurSuami', 'pendidikanSuami', 'pekerjaanSuami', 'alamatSuami',
        'lla', 'bmt', 'hpht', 'usiaKehamilan', 'riwayatKb', 'tanggalKunjunganPertama', 'kehamilan', 'penolongPersalinan', 'jenisPersalinan', 'masalahPersalinan', 'keadaanBayi', 'menarche', 'lamaHaid', 'siklusHaid', 'jumlahDarah',
        'keluhanHaid', 'keluhanFluorAlbus', 'keluhanperdarahan', 'keluhanBabBak', 'keluhanAir', 'keluhanHis', 'keluhanGerakAnak', 'anc', 'djj', 'lokasiAnc', 'tripleEliminasi', 'tfuObstetri', 'bjaObstetri',
        'hisObstetri', 'leopold1', 'leopold2', 'leopold3', 'leopold4', 'pemeriksaanInspekulo', 'pemeriksaanDalam', 'pemeriksaanPanggul', 'inspeksiGinekologi', 'palpasiGinekologi', 'perkusiGinekologi', 'auskyltasiGinekologi',
        'deskripsiTumorGinekologi', 'letakBesarGinekologi', 'batasPermukaanGinekologi', 'PergerakanGinekologi', 'nyeriTekanGinekologi', 'lainGinekologi', 'kriteriaHasil', 'umur', 'jenisKL', 'DiagAnak', 'Kognitif', 'Lingkungan', 'ResponObat', 'PenggunaanObat', 'kriteriaHasilAnak',
        'ObTFU', 'kembar', 'keguguran',
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
        $lokasi = session()->get('locationname');
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select('documentdate, cancel, groups, pasienname, pasienid, poliklinikname, paymentmethodname, id, validasipemeriksaan, pasiengender, doktername, pasienaddress, verifikasimobdan, catatanVerifikasiMobdan, verifikasidiagnosarajal, statuspasien, journalnumber');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel !=', "1.00");
        if (!in_array($lokasi, ["NONE", "-"])) {
            $this->dt->where('poliklinikname', $lokasi);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_lapcoding()
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_lapcoding()
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_lapcoding()
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('groups', 'RI');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_lapcoding($search)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIgd_lapcoding($search)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_lapcoding($search)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinik', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'RI');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_10besar()
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select(' codeicdx , nameicdx, COUNT(codeicdx)as jumlah ');
        $this->dt->where('date_pelayanan', date('Y-m-d'));
        $this->dt->like('types', 'IRJ');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_10besar()
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select(' codeicdx , nameicdx, COUNT(codeicdx)as jumlah ');
        $this->dt->where('date_pelayanan', date('Y-m-d'));
        $this->dt->like('types', 'IGD');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_10besar()
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select(' codeicdx , nameicdx, COUNT(codeicdx)as jumlah ');
        $this->dt->where('date_pelayanan', date('Y-m-d'));
        $this->dt->like('types', 'RI');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_10besar($search)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select(' codeicdx , nameicdx, COUNT(codeicdx)as jumlah ');
        $this->dt->where('date_pelayanan >=', $search['mulai']);
        $this->dt->where('date_pelayanan <=', $search['sampai']);
        $this->dt->like('doktername', $search['doktername']);
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('types', 'IRJ');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_10besar($search)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select(' codeicdx , nameicdx, COUNT(codeicdx)as jumlah ');
        $this->dt->where('date_pelayanan >=', $search['mulai']);
        $this->dt->where('date_pelayanan <=', $search['sampai']);
        $this->dt->like('doktername', $search['doktername']);
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('types', 'IGD');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_10besar($search)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select(' codeicdx , nameicdx, COUNT(codeicdx)as jumlah ');
        $this->dt->where('date_pelayanan >=', $search['mulai']);
        $this->dt->where('date_pelayanan <=', $search['sampai']);
        $this->dt->like('doktername', $search['doktername']);
        if ($search['poli'] != "") {
            $this->dt->like('smfname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('types', 'RI');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function ambildataigd()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel !=', "1.00");
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('dateout', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_pasienpulang_ranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');

        $this->dt->where('dateout >=', $search['mulai']);
        $this->dt->where('dateout <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('room', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterRajal($search)
    {
        $lokasi = session()->get('locationname');
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select('documentdate, cancel, groups, pasienname, pasienid, poliklinikname, paymentmethodname, id, validasipemeriksaan, pasiengender, doktername, pasienaddress, verifikasimobdan, catatanVerifikasiMobdan, verifikasidiagnosarajal, statuspasien, journalnumber');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('cancel', '0.00');
        $this->dt->where('groups', 'IRJ');
        if ($search['patientname'] != "") {
            $this->dt->like('pasienname', $search['patientname'], 'after');
        }
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm'], 'after');
        }
        if (!in_array($lokasi, ['-', 'NONE', null])) {
            $this->dt->where('poliklinikname', $lokasi);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_Registerigd($search)
    {
        $lokasi = session()->get('locationname');
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select('documentdate, cancel, groups, pasienname, pasienid, poliklinikname, paymentmethodname, id, validasipemeriksaan, pasiengender, doktername, pasienaddress, verifikasimobdan, catatanVerifikasiMobdan, verifikasidiagnosarajal, statuspasien, journalnumber');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('cancel !=', "1.00");
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['patientname'] != "") {
            $this->dt->like('pasienname', $search['patientname'], 'after');
        }
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm'], 'after');
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        if (!in_array($lokasi, ['-', 'NONE', null])) {
            $this->dt->where('poliklinikname', $lokasi);
        }

        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_close()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->where('validasipemeriksaan', 1);
        $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapenunjang_close()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_close_validasi()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('validation_date', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->where('validasipemeriksaan', 1);
        $this->dt->where('validation', 'SUDAH');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapenunjang_close_validasi()
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_close_validasi()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('validation_date', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->where('validasipemeriksaan', 1);
        $this->dt->where('validation', 'SUDAH');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterRajal_close($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->where('validasipemeriksaan', 1);
        $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang_close($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('groups', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethod', $search['metodepembayaran']);
        }
        $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_close_validasi($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('validation_date >=', $search['mulai']);
        $this->dt->where('validation_date <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->where('validasipemeriksaan', 1);
        $this->dt->where('validation', 'SUDAH');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang_close_validasi($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('groups', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIgd_close_validasi($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('validation_date >=', $search['mulai']);
        $this->dt->where('validation_date <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->where('validasipemeriksaan', 1);
        $this->dt->where('validation', 'SUDAH');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_close_validasi()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->notLike('paymentstatus', 'PINDAH CARA PEMBAYAR');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_close_validasi_uangmuka()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('types', 'UM');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_close_validasi_pindahcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('paymentstatus', 'PINDAH CARA PEMBAYAR');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_close_validasi_pindahhakkelas()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('types', 'PHKP');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_close_validasi($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->notLike('paymentstatus', 'PINDAH CARA PEMBAYAR');
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('roomname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_close_validasi_uangmuka($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        // $this->dt->like('pasienname', $search['patientname'], 'after');
        // $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('roomname', $search['poli']);
        // }
        if ($search['identitaspasien'] != "") {
            $this->dt->like('pasienname', $search['identitaspasien']);
        }
        $this->dt->where('types', 'UM');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_close_validasi_pindahcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('paymentstatus', 'PINDAH CARA PEMBAYAR');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_close_validasi_pindahhakkelas($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        // $this->dt->like('pasienname', $search['patientname'], 'after');
        // $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('roomname', $search['poli']);
        // }
        // if ($search['metodepembayaran'] != "") {
        //     $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        // }
        if ($search['identitaspasien'] != "") {
            $this->dt->like('pasienname', $search['identitaspasien']);
        }
        $this->dt->like('types', 'PHKP');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_rajal($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table($tb);
        //$this->dt->select(' name , id , code , memo ');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildatarajal_beritaacara()
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataIgd_beritaacara()
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_beritaacara()
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->notlike('types', 'PBTN');
        $this->dt->notlike('types', 'PHKP');
        $this->dt->notlike('types', 'PBNTN');
        $this->dt->notlike('types', 'PBANTN');
        //$this->dt->whereIn('types', $jenis);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_beritaacara_uangmuka()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('types', 'UM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_close_beritaacara($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['statusbayar'] != "") {
            $this->dt->like('paymentstatus', $search['statusbayar']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapenunjang_beritaacara()
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang_close_beritaacara($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('groups', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIgd_close_beritaacara($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_close_beritaacara($search)
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->notlike('types', 'PBTN');
        $this->dt->notlike('types', 'PHKP');
        $this->dt->notlike('types', 'PBNTN');
        $this->dt->notlike('types', 'PBANTN');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_close_beritaacara_uangmuka($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('types', 'UM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }



    function ambildataigd_close()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->where('validasipemeriksaan', 1);
        $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_close()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('dateout', date('Y-m-d'));
        $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_uangmuka()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        //$this->dt->where('datein', date('Y-m-d'));
        $this->dt->where('statusrawatinap', 'RAWAT');
        //$this->dt->like('paymentby', 'RAWAT');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_close($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->where('validasipemeriksaan', 1);
        $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Registerranap_close($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');

        $this->dt->where('dateout >=', $search['mulai']);
        $this->dt->where('dateout <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('roomname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapasienpulang()
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        if ($lokasi == "NONE") {
            $this->dt->where('dateout', date('Y-m-d'));
        } else {
            $this->dt->where('dateout', date('Y-m-d'));
            $this->dt->where('room', session()->get('locationcode'));
        }

        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_pasienpulang($search)
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        if ($lokasi == "NONE") {
            $this->dt->where('dateout >=', $search['mulai']);
            $this->dt->where('dateout <=', $search['sampai']);
            $this->dt->like('pasienname', $search['patientname']);
            $this->dt->like('pasienid', $search['norm']);

            if ($search['metodepembayaran'] != "") {
                $this->dt->like('paymentmethodname', $search['metodepembayaran']);
            }
        } else {
            $this->dt->where('dateout >=', $search['mulai']);
            $this->dt->where('dateout <=', $search['sampai']);
            $this->dt->like('pasienname', $search['patientname']);
            $this->dt->like('pasienid', $search['norm']);
            if ($search['metodepembayaran'] != "") {
                $this->dt->like('paymentmethodname', $search['metodepembayaran']);
            }
            $this->dt->where('room', session()->get('locationcode'));
        }

        $this->dt->where('dateout >=', $search['mulai']);
        $this->dt->where('dateout <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('smfname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapasienpindah()
    {

        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_pindah_rawatinap');

        if ($lokasi == "NONE") {
            $this->dt->where('dateout', date('Y-m-d'));
        } else {
            $this->dt->where('dateout', date('Y-m-d'));
            $this->dt->where('room', session()->get('locationcode'));
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_pasienpindah($search)
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_pindah_rawatinap');


        // if ($search['poli'] != "") {
        //     $this->dt->like('smfname', $search['poli']);
        // }
        // if ($search['metodepembayaran'] != "") {
        //     $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        // }

        if ($lokasi == "NONE") {
            $this->dt->where('dateout >=', $search['mulai']);
            $this->dt->where('dateout <=', $search['sampai']);
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->like('pasienid', $search['norm'], 'after');
        } else {
            $this->dt->where('dateout >=', $search['mulai']);
            $this->dt->where('dateout <=', $search['sampai']);
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->like('pasienid', $search['norm'], 'after');
            $this->dt->where('room', session()->get('locationcode'));
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Registerranap_uangmuka($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');

        // $this->dt->where('datein >=', $search['mulai']);
        // $this->dt->where('datein <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('roomname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('statusrawatinap', 'RAWAT');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_ranap_simple()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->join('transaksi_pelayanan_validasi_rawatinap', 'transaksi_pelayanan_validasi_rawatinap.referencenumber=transaksi_pelayanan_pulang_rawatinap.referencenumber', 'left');
        $this->dt->select('transaksi_pelayanan_pulang_rawatinap.referencenumber ,  transaksi_pelayanan_validasi_rawatinap.datein, transaksi_pelayanan_validasi_rawatinap.groups, transaksi_pelayanan_pulang_rawatinap.pasienid,  transaksi_pelayanan_pulang_rawatinap.doktername, transaksi_pelayanan_validasi_rawatinap.icdx, transaksi_pelayanan_validasi_rawatinap.icdxname, transaksi_pelayanan_pulang_rawatinap.dateout, transaksi_pelayanan_pulang_rawatinap.statuspasien, transaksi_pelayanan_pulang_rawatinap.roomname, transaksi_pelayanan_pulang_rawatinap.paymentmethodname, transaksi_pelayanan_pulang_rawatinap.pasienname, transaksi_pelayanan_pulang_rawatinap.smfname');
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout=', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_validasi_rawatinap.types', 'BARU');
        $this->dt->orderBy('transaksi_pelayanan_pulang_rawatinap.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_ranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->join('transaksi_pelayanan_validasi_rawatinap', 'transaksi_pelayanan_validasi_rawatinap.referencenumber=transaksi_pelayanan_pulang_rawatinap.referencenumber', 'left');
        $this->dt->select('transaksi_pelayanan_pulang_rawatinap.referencenumber ,  transaksi_pelayanan_validasi_rawatinap.datein, transaksi_pelayanan_validasi_rawatinap.groups, transaksi_pelayanan_pulang_rawatinap.pasienid,  transaksi_pelayanan_pulang_rawatinap.doktername, transaksi_pelayanan_validasi_rawatinap.icdx, transaksi_pelayanan_validasi_rawatinap.icdxname, transaksi_pelayanan_pulang_rawatinap.dateout, transaksi_pelayanan_pulang_rawatinap.statuspasien, transaksi_pelayanan_pulang_rawatinap.roomname, transaksi_pelayanan_pulang_rawatinap.paymentmethodname, transaksi_pelayanan_pulang_rawatinap.pasienname, transaksi_pelayanan_pulang_rawatinap.smfname');
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout <=', $search['sampai']);
        $this->dt->like('transaksi_pelayanan_pulang_rawatinap.pasienid', $search['norm']);
        $this->dt->like('transaksi_pelayanan_pulang_rawatinap.pasienname', $search['patientname']);
        $this->dt->like('transaksi_pelayanan_pulang_rawatinap.paymentmethodname', $search['metodepembayaran']);
        $this->dt->like('transaksi_pelayanan_pulang_rawatinap.smfname', $search['poli']);
        $this->dt->like('transaksi_pelayanan_validasi_rawatinap.types', 'BARU');
        $this->dt->orderBy('transaksi_pelayanan_pulang_rawatinap.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_pasienmasuk()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_pasienmasuk($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_pasienmasuk()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_pasienmasuk($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_pasienmasuk()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_validasi_rawatinap');
        $this->dt->where('datein', date('Y-m-d'));
        $this->dt->like('types', 'BARU');
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_pasienmasuk($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_validasi_rawatinap');

        $this->dt->where('datein >=', $search['mulai']);
        $this->dt->where('datein <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('room', $search['poli']);
        }
        if ($search['smfname'] != "") {
            $this->dt->like('smfname', $search['smfname']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('types', 'BARU');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_pasienkeluar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('validation_date', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_pasienkeluar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('validation_date >=', $search['mulai']);
        $this->dt->where('validation_date <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_pasienkeluar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('dateout', date('Y-m-d'));
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_pasienkeluar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');

        $this->dt->where('dateout >=', $search['mulai']);
        $this->dt->where('dateout <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('room', $search['poli']);
        }
        if ($search['smfname'] != "") {
            $this->dt->like('smfname', $search['smfname']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_rekapkunjungan()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(poliklinikname)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_rekapkunjungan($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname, COUNT(poliklinikname)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_rekapkunjungan()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(poliklinikname)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_rekapkunjungan($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname, COUNT(poliklinikname)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_rekapkunjungan()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' roomname , COUNT(roomname)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'BARU');
        $this->dt->groupBy('roomname');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_rekapkunjungan($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' roomname, COUNT(roomname)as jumlah ');
        $this->dt->where('datein >=', $search['mulai']);
        $this->dt->where('datein <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('types', 'BARU');
        $this->dt->groupBy('roomname');
        $this->dt->orderBy('jumlah', 'DESC');
        $this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(paymentmethodname="TUNAI",pasienname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",pasienname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",pasienname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",pasienname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",pasienname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",pasienname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",pasienname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",pasienname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",pasienname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",pasienname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",pasienname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",pasienname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",pasienname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",pasienname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",pasienname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",pasienname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",pasienname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",pasienname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",pasienname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",pasienname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",pasienname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",pasienname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",pasienname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",pasienname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",pasienname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",pasienname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",pasienname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",pasienname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",pasienname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",pasienname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",pasienname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",pasienname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",pasienname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",pasienname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",pasienname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",pasienname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",pasienname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",pasienname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",pasienname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",pasienname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",pasienname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",pasienname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",pasienname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",pasienname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",pasienname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",pasienname, NULL))as lain ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(paymentmethodname="TUNAI",pasienname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",pasienname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",pasienname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",pasienname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",pasienname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",pasienname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",pasienname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",pasienname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",pasienname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",pasienname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",pasienname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",pasienname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",pasienname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",pasienname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",pasienname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",pasienname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",pasienname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",pasienname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",pasienname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",pasienname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",pasienname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",pasienname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",pasienname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",pasienname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",pasienname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",pasienname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",pasienname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",pasienname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",pasienname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",pasienname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",pasienname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",pasienname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",pasienname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",pasienname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",pasienname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",pasienname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",pasienname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",pasienname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",pasienname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",pasienname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",pasienname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",pasienname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",pasienname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",pasienname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",pasienname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",pasienname, NULL))as lain ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(paymentmethodname="TUNAI",pasienname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",pasienname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",pasienname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",pasienname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",pasienname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",pasienname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",pasienname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",pasienname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",pasienname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",pasienname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",pasienname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",pasienname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",pasienname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",pasienname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",pasienname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",pasienname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",pasienname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",pasienname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",pasienname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",pasienname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",pasienname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",pasienname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",pasienname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",pasienname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",pasienname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",pasienname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",pasienname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",pasienname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",pasienname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",pasienname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",pasienname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",pasienname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",pasienname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",pasienname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",pasienname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",pasienname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",pasienname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",pasienname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",pasienname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",pasienname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",pasienname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",pasienname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",pasienname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",pasienname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",pasienname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",pasienname, NULL))as lain ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(paymentmethodname="TUNAI",pasienname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",pasienname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",pasienname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",pasienname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",pasienname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",pasienname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",pasienname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",pasienname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",pasienname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",pasienname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",pasienname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",pasienname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",pasienname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",pasienname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",pasienname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",pasienname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",pasienname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",pasienname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",pasienname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",pasienname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",pasienname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",pasienname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",pasienname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",pasienname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",pasienname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",pasienname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",pasienname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",pasienname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",pasienname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",pasienname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",pasienname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",pasienname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",pasienname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",pasienname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",pasienname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",pasienname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",pasienname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",pasienname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",pasienname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",pasienname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",pasienname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",pasienname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",pasienname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",pasienname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",pasienname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",pasienname, NULL))as lain ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' smfname , COUNT(IF(paymentmethodname="TUNAI",pasienname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",pasienname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",pasienname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",pasienname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",pasienname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",pasienname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",pasienname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",pasienname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",pasienname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",pasienname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",pasienname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",pasienname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",pasienname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",pasienname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",pasienname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",pasienname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",pasienname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",pasienname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",pasienname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",pasienname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",pasienname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",pasienname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",pasienname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",pasienname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",pasienname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",pasienname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",pasienname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",pasienname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",pasienname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",pasienname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",pasienname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",pasienname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",pasienname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",pasienname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",pasienname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",pasienname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",pasienname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",pasienname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",pasienname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",pasienname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",pasienname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",pasienname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",pasienname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",pasienname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",pasienname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",pasienname, NULL))as lain ');
        $this->dt->where('types', 'BARU');
        $this->dt->where('datein', date('Y-m-d'));
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' smfname , COUNT(IF(paymentmethodname="TUNAI",pasienname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",pasienname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",pasienname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",pasienname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",pasienname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",pasienname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",pasienname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",pasienname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",pasienname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",pasienname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",pasienname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",pasienname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",pasienname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",pasienname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",pasienname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",pasienname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",pasienname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",pasienname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",pasienname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",pasienname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",pasienname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",pasienname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",pasienname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",pasienname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",pasienname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",pasienname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",pasienname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",pasienname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",pasienname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",pasienname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",pasienname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",pasienname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",pasienname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",pasienname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",pasienname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",pasienname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",pasienname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",pasienname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",pasienname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",pasienname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",pasienname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",pasienname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",pasienname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",pasienname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",pasienname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",pasienname, NULL))as lain ');
        $this->dt->where('types', 'BARU');
        $this->dt->where('datein >=', $search['mulai']);
        $this->dt->where('datein <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }

        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' smfname , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('types', 'BARU');
        $this->dt->where('datein', date('Y-m-d'));
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' smfname , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('types', 'BARU');
        $this->dt->where('datein >=', $search['mulai']);
        $this->dt->where('datein <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }

        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_rekapgender()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_rekapgender($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan  ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_rekapgender()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_rekapgender($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan  ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_rekapgender()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' smfname , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('types', 'BARU');
        $this->dt->where('datein', date('Y-m-d'));
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_rekapgender($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' smfname , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan  ');
        $this->dt->where('types', 'BARU');
        $this->dt->where('datein >=', $search['mulai']);
        $this->dt->where('datein <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_rekapcarapulang()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(statuspasien="REGISTRASI",pasienname, NULL))as registrasi,
        COUNT(IF(statuspasien="PULANG (BEROBAT JALAN)",pasienname, NULL))as pulangberobat,
        COUNT(IF(statuspasien="DIRAWAT",pasienname, NULL))as dirawat,
        COUNT(IF(statuspasien="DIRAWAT APS",pasienname, NULL))as dirawataps,
        COUNT(IF(statuspasien="MENINGGAL < 48 JAM",pasienname, NULL))as meninggalkurang48,
        COUNT(IF(statuspasien="MENINGGAL > 48 JAM",pasienname, NULL))as meninggallebih48,
        COUNT(IF(statuspasien="MENINGGAL < 8 JAM",pasienname, NULL))as meninggalkurang8,
        COUNT(IF(statuspasien="DOA",pasienname, NULL))as doa,
        COUNT(IF(statuspasien="RUJUK KE RS LAIN",pasienname, NULL))as rujukrslain,
        COUNT(IF(statuspasien="PINDAH KE RS LAIN",pasienname, NULL))as pindahrslain,
        COUNT(IF(statuspasien="KONSUL KE KLINIK",pasienname, NULL))as konsulklinik,
        COUNT(IF(statuspasien="KABUR",pasienname, NULL))as kabut,
        COUNT(IF(statuspasien="PULANG (SEMBUH)",pasienname, NULL))as pulangsembuh,
        COUNT(IF(statuspasien="RUJUK BALIK",pasienname, NULL))as rujukbalik ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_rekapcarapulang($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(statuspasien="REGISTRASI",pasienname, NULL))as registrasi,
        COUNT(IF(statuspasien="PULANG (BEROBAT JALAN)",pasienname, NULL))as pulangberobat,
        COUNT(IF(statuspasien="DIRAWAT",pasienname, NULL))as dirawat,
        COUNT(IF(statuspasien="DIRAWAT APS",pasienname, NULL))as dirawataps,
        COUNT(IF(statuspasien="MENINGGAL < 48 JAM",pasienname, NULL))as meninggalkurang48,
        COUNT(IF(statuspasien="MENINGGAL > 48 JAM",pasienname, NULL))as meninggallebih48,
        COUNT(IF(statuspasien="MENINGGAL < 8 JAM",pasienname, NULL))as meninggalkurang8,
        COUNT(IF(statuspasien="DOA",pasienname, NULL))as doa,
        COUNT(IF(statuspasien="RUJUK KE RS LAIN",pasienname, NULL))as rujukrslain,
        COUNT(IF(statuspasien="PINDAH KE RS LAIN",pasienname, NULL))as pindahrslain,
        COUNT(IF(statuspasien="KONSUL KE KLINIK",pasienname, NULL))as konsulklinik,
        COUNT(IF(statuspasien="KABUR",pasienname, NULL))as kabur,
        COUNT(IF(statuspasien="PULANG APS",pasienname, NULL))as pulangaps,
        COUNT(IF(statuspasien="PULANG (SEMBUH)",pasienname, NULL))as pulangsembuh,
        COUNT(IF(statuspasien="RUJUK BALIK",pasienname, NULL))as rujukbalik  ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_rekapcarapulang()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(statuspasien="REGISTRASI",pasienname, NULL))as registrasi,
        COUNT(IF(statuspasien="PULANG (BEROBAT JALAN)",pasienname, NULL))as pulangberobat,
        COUNT(IF(statuspasien="DIRAWAT",pasienname, NULL))as dirawat,
        COUNT(IF(statuspasien="DIRAWAT APS",pasienname, NULL))as dirawataps,
        COUNT(IF(statuspasien="MENINGGAL < 48 JAM",pasienname, NULL))as meninggalkurang48,
        COUNT(IF(statuspasien="MENINGGAL > 48 JAM",pasienname, NULL))as meninggallebih48,
        COUNT(IF(statuspasien="MENINGGAL < 8 JAM",pasienname, NULL))as meninggalkurang8,
        COUNT(IF(statuspasien="DOA",pasienname, NULL))as doa,
        COUNT(IF(statuspasien="RUJUK KE RS LAIN",pasienname, NULL))as rujukrslain,
        COUNT(IF(statuspasien="PINDAH KE RS LAIN",pasienname, NULL))as pindahrslain,
        COUNT(IF(statuspasien="KONSUL KE KLINIK",pasienname, NULL))as konsulklinik,
        COUNT(IF(statuspasien="KABUR",pasienname, NULL))as kabut,
        COUNT(IF(statuspasien="PULANG (SEMBUH)",pasienname, NULL))as pulangsembuh,
        COUNT(IF(statuspasien="RUJUK BALIK",pasienname, NULL))as rujukbalik ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_rekapcarapulang($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname , COUNT(IF(statuspasien="REGISTRASI",pasienname, NULL))as registrasi,
        COUNT(IF(statuspasien="PULANG (BEROBAT JALAN)",pasienname, NULL))as pulangberobat,
        COUNT(IF(statuspasien="DIRAWAT",pasienname, NULL))as dirawat,
        COUNT(IF(statuspasien="DIRAWAT APS",pasienname, NULL))as dirawataps,
        COUNT(IF(statuspasien="MENINGGAL < 48 JAM",pasienname, NULL))as meninggalkurang48,
        COUNT(IF(statuspasien="MENINGGAL > 48 JAM",pasienname, NULL))as meninggallebih48,
        COUNT(IF(statuspasien="MENINGGAL < 8 JAM",pasienname, NULL))as meninggalkurang8,
        COUNT(IF(statuspasien="DOA",pasienname, NULL))as doa,
        COUNT(IF(statuspasien="RUJUK KE RS LAIN",pasienname, NULL))as rujukrslain,
        COUNT(IF(statuspasien="PINDAH KE RS LAIN",pasienname, NULL))as pindahrslain,
        COUNT(IF(statuspasien="KONSUL KE KLINIK",pasienname, NULL))as konsulklinik,
        COUNT(IF(statuspasien="KABUR",pasienname, NULL))as kabur,
        COUNT(IF(statuspasien="PULANG APS",pasienname, NULL))as pulangaps,
        COUNT(IF(statuspasien="PULANG (SEMBUH)",pasienname, NULL))as pulangsembuh,
        COUNT(IF(statuspasien="RUJUK BALIK",pasienname, NULL))as rujukbalik  ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_rekapcarapulang()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->select(' smfname , COUNT(IF(statuspasien="REGISTRASI",pasienname, NULL))as registrasi,
        COUNT(IF(statuspasien="PULANG (BEROBAT JALAN)",pasienname, NULL))as pulangberobat,
        COUNT(IF(statuspasien="DIRAWAT",pasienname, NULL))as dirawat,
        COUNT(IF(statuspasien="DIRAWAT APS",pasienname, NULL))as dirawataps,
        COUNT(IF(statuspasien="MENINGGAL < 48 JAM",pasienname, NULL))as meninggalkurang48,
        COUNT(IF(statuspasien="MENINGGAL > 48 JAM",pasienname, NULL))as meninggallebih48,
        COUNT(IF(statuspasien="MENINGGAL < 8 JAM",pasienname, NULL))as meninggalkurang8,
        COUNT(IF(statuspasien="DOA",pasienname, NULL))as doa,
        COUNT(IF(statuspasien="RUJUK KE RS LAIN",pasienname, NULL))as rujukrslain,
        COUNT(IF(statuspasien="PINDAH KE RS LAIN",pasienname, NULL))as pindahrslain,
        COUNT(IF(statuspasien="KONSUL KE KLINIK",pasienname, NULL))as konsulklinik,
        COUNT(IF(statuspasien="KABUR",pasienname, NULL))as kabut,
        COUNT(IF(statuspasien="PULANG (SEMBUH)",pasienname, NULL))as pulangsembuh,
        COUNT(IF(statuspasien="RUJUK BALIK",pasienname, NULL))as rujukbalik ');
        $this->dt->where('dateout', date('Y-m-d'));
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_rekapcarapulang($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->select(' smfname , COUNT(IF(statuspasien="REGISTRASI",pasienname, NULL))as registrasi,
        COUNT(IF(statuspasien="PULANG (BEROBAT JALAN)",pasienname, NULL))as pulangberobat,
        COUNT(IF(statuspasien="DIRAWAT",pasienname, NULL))as dirawat,
        COUNT(IF(statuspasien="DIRAWAT APS",pasienname, NULL))as dirawataps,
        COUNT(IF(statuspasien="MENINGGAL < 48 JAM",pasienname, NULL))as meninggalkurang48,
        COUNT(IF(statuspasien="MENINGGAL > 48 JAM",pasienname, NULL))as meninggallebih48,
        COUNT(IF(statuspasien="MENINGGAL < 8 JAM",pasienname, NULL))as meninggalkurang8,
        COUNT(IF(statuspasien="DOA",pasienname, NULL))as doa,
        COUNT(IF(statuspasien="RUJUK KE RS LAIN",pasienname, NULL))as rujukrslain,
        COUNT(IF(statuspasien="PINDAH KE RS LAIN",pasienname, NULL))as pindahrslain,
        COUNT(IF(statuspasien="KONSUL KE KLINIK",pasienname, NULL))as konsulklinik,
        COUNT(IF(statuspasien="KABUR",pasienname, NULL))as kabur,
        COUNT(IF(statuspasien="PULANG APS",pasienname, NULL))as pulangaps,
        COUNT(IF(statuspasien="PULANG (SEMBUH)",pasienname, NULL))as pulangsembuh,
        COUNT(IF(statuspasien="RUJUK BALIK",pasienname, NULL))as rujukbalik  ');
        $this->dt->where('dateout >=', $search['mulai']);
        $this->dt->where('dateout <=', $search['sampai']);

        if ($search['doktername'] != "") {
            $this->dt->like('doktername', $search['doktername']);
        }
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_pasienmati()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->join('transaksi_rekammedik_rawatjalan_detail', 'transaksi_rekammedik_rawatjalan_detail.referencenumber=transaksi_pelayanan_daftar_rawatjalan.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_daftar_rawatjalan.pasienid, transaksi_pelayanan_daftar_rawatjalan.documentdate, transaksi_pelayanan_daftar_rawatjalan.pasienname, transaksi_pelayanan_daftar_rawatjalan.doktername, transaksi_pelayanan_daftar_rawatjalan.pasiengender, transaksi_pelayanan_daftar_rawatjalan.pasienaddress, transaksi_pelayanan_daftar_rawatjalan.statuspasien, 
        transaksi_pelayanan_daftar_rawatjalan.validation, transaksi_pelayanan_daftar_rawatjalan.poliklinikname, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx, transaksi_pelayanan_daftar_rawatjalan.coding, transaksi_pelayanan_daftar_rawatjalan.paymentmethodname ');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.documentdate', date('Y-m-d'));
        $status = ['DOA', 'MENINGGAL < 8 JAM', 'MENINGGAL < 48 JAM', 'MENINGGAL > 48 JAM'];
        $this->dt->wherein('statuspasien', $status);
        $this->dt->like('transaksi_pelayanan_daftar_rawatjalan.groups', 'IGD');
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatjalan.id', 'ASC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIGD_pasienmati($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->join('transaksi_rekammedik_rawatjalan_detail', 'transaksi_rekammedik_rawatjalan_detail.referencenumber=transaksi_pelayanan_daftar_rawatjalan.journalnumber', 'left');
        $this->dt->select('transaksi_pelayanan_daftar_rawatjalan.pasienid, transaksi_pelayanan_daftar_rawatjalan.documentdate, transaksi_pelayanan_daftar_rawatjalan.pasienname, transaksi_pelayanan_daftar_rawatjalan.doktername, transaksi_pelayanan_daftar_rawatjalan.pasiengender, transaksi_pelayanan_daftar_rawatjalan.pasienaddress, transaksi_pelayanan_daftar_rawatjalan.statuspasien, 
        transaksi_pelayanan_daftar_rawatjalan.validation, transaksi_pelayanan_daftar_rawatjalan.poliklinikname, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx, transaksi_pelayanan_daftar_rawatjalan.coding, transaksi_pelayanan_daftar_rawatjalan.paymentmethodname ');
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.documentdate <=', $search['sampai']);
        $status = ['DOA', 'MENINGGAL < 8 JAM', 'MENINGGAL < 48 JAM', 'MENINGGAL > 48 JAM'];
        $this->dt->wherein('statuspasien', $status);
        $this->dt->like('transaksi_pelayanan_daftar_rawatjalan.pasienname', $search['patientname'], 'after');
        $this->dt->like('transaksi_pelayanan_daftar_rawatjalan.pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('transaksi_pelayanan_daftar_rawatjalan.poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('transaksi_pelayanan_daftar_rawatjalan.paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->like('transaksi_pelayanan_daftar_rawatjalan.groups', 'IGD');
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatjalan.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_pasienmati()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->join('transaksi_rekammedik_rawatjalan_detail', 'transaksi_rekammedik_rawatjalan_detail.referencenumber=transaksi_pelayanan_pulang_rawatinap.referencenumber', 'left');
        $this->dt->select('transaksi_pelayanan_pulang_rawatinap.pasienid, transaksi_pelayanan_pulang_rawatinap.dateout, transaksi_pelayanan_pulang_rawatinap.pasienname, transaksi_pelayanan_pulang_rawatinap.doktername, transaksi_pelayanan_pulang_rawatinap.pasiengender, transaksi_pelayanan_pulang_rawatinap.pasienaddress, transaksi_pelayanan_pulang_rawatinap.statuspasien, 
        transaksi_pelayanan_pulang_rawatinap.validation, transaksi_pelayanan_pulang_rawatinap.smfname, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx,  transaksi_pelayanan_pulang_rawatinap.paymentmethodname ');
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout', date('Y-m-d'));
        $status = ['DOA', 'MENINGGAL < 8 JAM', 'MENINGGAL < 48 JAM', 'MENINGGAL > 48 JAM'];
        $this->dt->wherein('statuspasien', $status);
        $this->dt->orderBy('transaksi_pelayanan_pulang_rawatinap.id', 'ASC');
        $this->dt->limit(10);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_pasienmati($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->join('transaksi_rekammedik_rawatjalan_detail', 'transaksi_rekammedik_rawatjalan_detail.referencenumber=transaksi_pelayanan_pulang_rawatinap.referencenumber', 'left');
        $this->dt->select('transaksi_pelayanan_pulang_rawatinap.pasienid, transaksi_pelayanan_pulang_rawatinap.dateout, transaksi_pelayanan_pulang_rawatinap.pasienname, transaksi_pelayanan_pulang_rawatinap.doktername, transaksi_pelayanan_pulang_rawatinap.pasiengender, transaksi_pelayanan_pulang_rawatinap.pasienaddress, transaksi_pelayanan_pulang_rawatinap.statuspasien, 
        transaksi_pelayanan_pulang_rawatinap.validation, transaksi_pelayanan_pulang_rawatinap.poliklinikname, transaksi_rekammedik_rawatjalan_detail.codeicdx, transaksi_rekammedik_rawatjalan_detail.nameicdx, transaksi_pelayanan_pulang_rawatinap.paymentmethodname ');
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout <=', $search['sampai']);
        $status = ['DOA', 'MENINGGAL < 8 JAM', 'MENINGGAL < 48 JAM', 'MENINGGAL > 48 JAM'];
        $this->dt->wherein('statuspasien', $status);
        $this->dt->like('transaksi_pelayanan_pulang_rawatinap.pasienname', $search['patientname'], 'after');
        $this->dt->like('transaksi_pelayanan_pulang_rawatinap.pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('transaksi_pelayanan_pulang_rawatinap.room', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('transaksi_pelayanan_pulang_rawatinap.paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('transaksi_pelayanan_pulang_rawatinap.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataradiologi_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'RAD');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRadiologi_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('types', 'RAD');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatalpk_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'LPK');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPK_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('types', 'LPK');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatalpa_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'LPA');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPA_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('types', 'LPA');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatabd_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'BD');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterBD_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('types', 'BD');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarad_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'RAD');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRAD_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('groups', 'RAD');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatalpk_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'LPK');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPK_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('groups', 'LPK');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatalpa_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'LPA');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPA_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('groups', 'LPA');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatabd_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'BD');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterBD_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('groups', 'BD');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarad_rekapwilayah_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'RAD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRAD_rekapwilayah_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'RAD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatalpk_rekapwilayah_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'LPK');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPK_rekapwilayah_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'LPK');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatalpa_rekapwilayah_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'LPA');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPA_rekapwilayah_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'LPA');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatabd_rekapwilayah_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'BD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterBD_rekapwilayah_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'BD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarad_rekapgender_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'RAD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRAD_rekapgender_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'RAD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatalpk_rekapgender_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'LPK');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPK_rekapgender_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'LPK');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatalpa_rekapgender_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'LPA');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterLPA_rekapgender_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'LPA');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatabd_rekapgender_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'BD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterBD_rekapgender_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'BD');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapwilayah_pem()
    {
        $this->dt = $this->db->table(' transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join(' transaksi_pelayanan_rawatinap_operasi_detail', ' transaksi_pelayanan_rawatinap_operasi_detail.journalnumber= transaksi_pelayanan_rawatinap_operasi_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where(' transaksi_pelayanan_rawatinap_operasi_header.documentdate', date('Y-m-d'));
        $this->dt->groupBy(' transaksi_pelayanan_rawatinap_operasi_detail.name');
        $this->dt->orderBy(' transaksi_pelayanan_rawatinap_operasi_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapwilayah_pem($search)
    {
        $this->dt = $this->db->table(' transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join(' transaksi_pelayanan_rawatinap_operasi_detail', ' transaksi_pelayanan_rawatinap_operasi_detail.journalnumber= transaksi_pelayanan_rawatinap_operasi_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate <=', $search['sampai']);
        $this->dt->groupBy('transaksi_pelayanan_rawatinap_operasi_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_rawatinap_operasi_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapkelas()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select(' name , COUNT(IF(classroom="HCU",relationname, NULL))as hcu,
        COUNT(IF(classroom="INTENSIF",relationname, NULL))as intensif,
        COUNT(IF(classroom="ISOLASI",relationname, NULL))as isolasi,
        COUNT(IF(classroom="IW",relationname, NULL))as iw,
        COUNT(IF(classroom="HCU",relationname, NULL))as hcu,
        COUNT(IF(classroom="KLS1",relationname, NULL))as kls1,
        COUNT(IF(classroom="KLS2",relationname, NULL))as kls2,
        COUNT(IF(classroom="KLS3",relationname, NULL))as kls3,
        COUNT(IF(classroom="ODCRJ",relationname, NULL))as odcrj,
        COUNT(IF(classroom="PERINATOLOGI",relationname, NULL))as perinatologi,
        COUNT(IF(classroom="PSR",relationname, NULL))as psr,
        COUNT(IF(classroom="SR",relationname, NULL))as sr,
        COUNT(IF(classroom="VIP1",relationname, NULL))as vip1,
        COUNT(IF(classroom="VIP2",relationname, NULL))as vip2,
        COUNT(IF(classroom="VIP3",relationname, NULL))as vip3,
        COUNT(IF(classroom="VVIP",relationname, NULL))as vvip,
        COUNT(IF(classroom="UTAMA1",relationname, NULL))as utama1,
        COUNT(IF(classroom="UTAMA2",relationname, NULL))as utama2 ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->orderBy('name', 'ASC');
        $this->dt->groupBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapkelas($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select(' name , COUNT(IF(classroom="HCU",relationname, NULL))as hcu,
        COUNT(IF(classroom="INTENSIF",relationname, NULL))as intensif,
        COUNT(IF(classroom="ISOLASI",relationname, NULL))as isolasi,
        COUNT(IF(classroom="IW",relationname, NULL))as iw,
        COUNT(IF(classroom="HCU",relationname, NULL))as hcu,
        COUNT(IF(classroom="KLS1",relationname, NULL))as kls1,
        COUNT(IF(classroom="KLS2",relationname, NULL))as kls2,
        COUNT(IF(classroom="KLS3",relationname, NULL))as kls3,
        COUNT(IF(classroom="ODCRJ",relationname, NULL))as odcrj,
        COUNT(IF(classroom="PERINATOLOGI",relationname, NULL))as perinatologi,
        COUNT(IF(classroom="PSR",relationname, NULL))as psr,
        COUNT(IF(classroom="SR",relationname, NULL))as sr,
        COUNT(IF(classroom="VIP1",relationname, NULL))as vip1,
        COUNT(IF(classroom="VIP2",relationname, NULL))as vip2,
        COUNT(IF(classroom="VIP3",relationname, NULL))as vip3,
        COUNT(IF(classroom="VVIP",relationname, NULL))as vvip,
        COUNT(IF(classroom="UTAMA1",relationname, NULL))as utama1,
        COUNT(IF(classroom="UTAMA2",relationname, NULL))as utama2 ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapjenisop()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select(' smfname , COUNT(IF(groups="KECIL",relationname, NULL))as kecil,
        COUNT(IF(groups="SEDANG",relationname, NULL))as sedang,
        COUNT(IF(groups="BESAR",relationname, NULL))as besar,
        COUNT(IF(groups="KHUSUS",relationname, NULL))as khusus,
        COUNT(IF(groups="KHUSUS1",relationname, NULL))as khusus1,
        COUNT(IF(groups="KHUSUS2",relationname, NULL))as khusus2,
        COUNT(IF(groups="KHUSUS3",relationname, NULL))as khusus3,
        COUNT(IF(groups="KHUSUS4",relationname, NULL))as khusus4 ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapjenisop($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select(' smfname , COUNT(IF(groups="KECIL",relationname, NULL))as kecil,
        COUNT(IF(groups="SEDANG",relationname, NULL))as sedang,
        COUNT(IF(groups="BESAR",relationname, NULL))as besar,
        COUNT(IF(groups="KHUSUS",relationname, NULL))as khusus,
        COUNT(IF(groups="KHUSUS1",relationname, NULL))as khusus1,
        COUNT(IF(groups="KHUSUS2",relationname, NULL))as khusus2,
        COUNT(IF(groups="KHUSUS3",relationname, NULL))as khusus3,
        COUNT(IF(groups="KHUSUS4",relationname, NULL))as khusus4 ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapjeniscabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select(' paymentmethod , COUNT(paymentmethod)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapjeniscabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select(' paymentmethod , COUNT(paymentmethod)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapjenkel()
    {
        $this->dt = $this->db->table(' transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join(' transaksi_pelayanan_rawatinap_operasi_detail', ' transaksi_pelayanan_rawatinap_operasi_detail.journalnumber= transaksi_pelayanan_rawatinap_operasi_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where(' transaksi_pelayanan_rawatinap_operasi_header.documentdate', date('Y-m-d'));
        $this->dt->groupBy(' transaksi_pelayanan_rawatinap_operasi_detail.name');
        $this->dt->orderBy(' transaksi_pelayanan_rawatinap_operasi_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapjenkel($search)
    {
        $this->dt = $this->db->table(' transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join(' transaksi_pelayanan_rawatinap_operasi_detail', ' transaksi_pelayanan_rawatinap_operasi_detail.journalnumber= transaksi_pelayanan_rawatinap_operasi_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate <=', $search['sampai']);
        $this->dt->groupBy('transaksi_pelayanan_rawatinap_operasi_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_rawatinap_operasi_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapjenissmf()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select(' smfname , COUNT(smfname)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapjenissmf($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_detail');
        $this->dt->select(' smfname , COUNT(smfname)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapjenisDO()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join('transaksi_pelayanan_rawatinap_operasi_detail', 'transaksi_pelayanan_rawatinap_operasi_detail.journalnumber=transaksi_pelayanan_rawatinap_operasi_header.journalnumber', 'left');
        $this->dt->select(' ibsdoktername , COUNT(name)as jumlah ');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate', date('Y-m-d'));
        $this->dt->groupBy('ibsdoktername');
        $this->dt->orderBy('ibsdoktername', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapjenisDO($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join('transaksi_pelayanan_rawatinap_operasi_detail', 'transaksi_pelayanan_rawatinap_operasi_detail.journalnumber=transaksi_pelayanan_rawatinap_operasi_header.journalnumber', 'left');
        $this->dt->select(' ibsdoktername , COUNT(name)as jumlah ');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate <=', $search['sampai']);
        $this->dt->groupBy('ibsdoktername');
        $this->dt->orderBy('ibsdoktername', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataibs_rekapjenisDA()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join('transaksi_pelayanan_rawatinap_operasi_detail', 'transaksi_pelayanan_rawatinap_operasi_detail.journalnumber=transaksi_pelayanan_rawatinap_operasi_header.journalnumber', 'left');
        $this->dt->select(' ibsanestesiname , COUNT(name)as jumlah ');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate', date('Y-m-d'));
        $this->dt->groupBy('ibsanestesiname');
        $this->dt->orderBy('ibsanestesiname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIBS_rekapjenisDA($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->join('transaksi_pelayanan_rawatinap_operasi_detail', 'transaksi_pelayanan_rawatinap_operasi_detail.journalnumber=transaksi_pelayanan_rawatinap_operasi_header.journalnumber', 'left');
        $this->dt->select(' ibsanestesiname , COUNT(name)as jumlah ');
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_rawatinap_operasi_header.documentdate <=', $search['sampai']);
        $this->dt->groupBy('ibsanestesiname');
        $this->dt->orderBy('ibsanestesiname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL33()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('poliklinikname', 'GIGI');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL33($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('poliklinikname', 'GIGI');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL37()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'RAD');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL37($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('types', 'RAD');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL38()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'LPK');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL38($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('types', 'LPK');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL39()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'RHM');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL39($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('types', 'RHM');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL311Rajal()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $tindakan = ['FIKSASI PASIEN JIWA', 'KOMUNIKASI TERAPEUTIK JIWA', 'MEMANDIKAN PASIEN JIWA', 'PENDIDIKAN/PENYULUHAN KESEHATAN (PENKES) INDIVIDU ...', 'TERAPI AKTIVITAS KELOMPOK', 'PSIKOTERAPI SUPORTIF', 'PSIKOTERAPI TILIKAN', 'PSIKOTERAPI SUPORTIF', 'PSIKOTERAPI TILIKAN', 'KONSULTASI PSIKOLOGIS', 'KONSULTASI PSIKOLOGIS', 'PSIKOTHERAPI', 'KONSULTASI PSIKOTERAPI', 'PSIKOTERAPI KELUARGA'];
        $this->dt->whereIn('name', $tindakan);
        $this->dt->like('poliklinikname', 'JIWA');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL311Rajal($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $tindakan = ['FIKSASI PASIEN JIWA', 'KOMUNIKASI TERAPEUTIK JIWA', 'MEMANDIKAN PASIEN JIWA', 'PENDIDIKAN/PENYULUHAN KESEHATAN (PENKES) INDIVIDU ...', 'TERAPI AKTIVITAS KELOMPOK', 'PSIKOTERAPI SUPORTIF', 'PSIKOTERAPI TILIKAN', 'PSIKOTERAPI SUPORTIF', 'PSIKOTERAPI TILIKAN', 'KONSULTASI PSIKOLOGIS', 'KONSULTASI PSIKOLOGIS', 'PSIKOTHERAPI', 'KONSULTASI PSIKOTERAPI', 'PSIKOTERAPI KELUARGA'];
        $this->dt->whereIn('name', $tindakan);
        $this->dt->like('poliklinikname', 'JIWA');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL311Ranap()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $tindakan = ['FIKSASI PASIEN JIWA', 'KOMUNIKASI TERAPEUTIK JIWA', 'MEMANDIKAN PASIEN JIWA', 'PENDIDIKAN/PENYULUHAN KESEHATAN (PENKES) INDIVIDU ...', 'TERAPI AKTIVITAS KELOMPOK', 'PSIKOTERAPI SUPORTIF', 'PSIKOTERAPI TILIKAN', 'PSIKOTERAPI SUPORTIF', 'PSIKOTERAPI TILIKAN', 'KONSULTASI PSIKOLOGIS', 'KONSULTASI PSIKOLOGIS', 'PSIKOTHERAPI', 'KONSULTASI PSIKOTERAPI', 'PSIKOTERAPI KELUARGA'];
        $this->dt->whereIn('name', $tindakan);
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL311Ranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_tindakan_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $tindakan = ['FIKSASI PASIEN JIWA', 'KOMUNIKASI TERAPEUTIK JIWA', 'MEMANDIKAN PASIEN JIWA', 'PENDIDIKAN/PENYULUHAN KESEHATAN (PENKES) INDIVIDU ...', 'TERAPI AKTIVITAS KELOMPOK', 'PSIKOTERAPI SUPORTIF', 'PSIKOTERAPI TILIKAN', 'PSIKOTERAPI SUPORTIF', 'PSIKOTERAPI TILIKAN', 'KONSULTASI PSIKOLOGIS', 'KONSULTASI PSIKOLOGIS', 'PSIKOTHERAPI', 'KONSULTASI PSIKOTERAPI', 'PSIKOTERAPI KELUARGA'];
        $this->dt->whereIn('name', $tindakan);
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL310()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $tindakan = [
            'ASCITES FUNGSI', 'COLONOSCOPY BIOPSI', 'ECHOCARDIOGRAFI DOPPLER WARNA', 'EEG', 'ENDOSKOPI THT TANPA BIOPSI', 'ESEFAGOGASTRODUODENOSCOPY (EGD) DENGAN BIOPSI', 'ESWL BPJS / TUNAI RAWAT INAP / BPJS RAWAT JALAN BARU',
            'PEMASANGAN CATETER DOUBLE LUMEN', 'PROEF PUNGSI', 'PUNGSI SENDI/LUTUT'
        ];
        $this->dt->whereIn('name', $tindakan);
        $this->dt->like('types', 'PDC');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESCC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL310($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(name)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $tindakan = [
            'ASCITES FUNGSI', 'COLONOSCOPY BIOPSI', 'ECHOCARDIOGRAFI DOPPLER WARNA', 'EEG', 'ENDOSKOPI THT TANPA BIOPSI', 'ESEFAGOGASTRODUODENOSCOPY (EGD) DENGAN BIOPSI', 'ESWL BPJS / TUNAI RAWAT INAP / BPJS RAWAT JALAN BARU',
            'PEMASANGAN CATETER DOUBLE LUMEN', 'PROEF PUNGSI', 'PUNGSI SENDI/LUTUT'
        ];
        $this->dt->whereIn('name', $tindakan);
        $this->dt->like('types', 'PDC');
        $this->dt->groupBy('name');
        $this->dt->orderBy('jumlah', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL314()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname,
        COUNT(case when statuspasien LIKE "%RUJUK KE RS LAIN%" then 1 ELSE NULL END) as "rujukkerslain",
        COUNT(case when statuspasien LIKE "%PINDAH KE RS LAIN%" then 1 ELSE NULL END) as "pindahkerslain",
        COUNT(case when statuspasien LIKE "%RUJUK BALIK%" then 1 ELSE NULL END) as "rujukbalik",
        COUNT(case when faskesname LIKE "%DATANG%" then 1 ELSE NULL END) as "datang",
        COUNT(case when faskesname LIKE "%RS%" then 1 ELSE NULL END) as "rslain",
        COUNT(case when faskesname LIKE "%BP%" then 1 ELSE NULL END) as "bp",
        COUNT(case when faskesname LIKE "%PUSKESMAS%" then 1 ELSE NULL END) as "puskesmas",
        COUNT(case when faskesname LIKE "%KLINIK%" then 1 ELSE NULL END) as "klinik",
        COUNT(case when faskesname LIKE "%DR.%" then 1 ELSE NULL END) as "dokter"
         ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL314($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname,
        COUNT(case when statuspasien LIKE "%RUJUK KE RS LAIN%" then 1 ELSE NULL END) as "rujukkerslain",
        COUNT(case when statuspasien LIKE "%PINDAH KE RS LAIN%" then 1 ELSE NULL END) as "pindahkerslain",
        COUNT(case when statuspasien LIKE "%RUJUK BALIK%" then 1 ELSE NULL END) as "rujukbalik",
        COUNT(case when faskesname LIKE "%DATANG%" then 1 ELSE NULL END) as "datang",
        COUNT(case when faskesname LIKE "%RS%" then 1 ELSE NULL END) as "rslain",
        COUNT(case when faskesname LIKE "%BP%" then 1 ELSE NULL END) as "bp",
        COUNT(case when faskesname LIKE "%PUSKESMAS%" then 1 ELSE NULL END) as "puskesmas",
        COUNT(case when faskesname LIKE "%KLINIK%" then 1 ELSE NULL END) as "klinik",
        COUNT(case when faskesname LIKE "%DR.%" then 1 ELSE NULL END) as "dokter" ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('groups', 'IRJ');
        $this->dt->notlike('poliklinikname', 'INSTALASI SANITASI DAN KEBERSIHAN');
        $this->dt->notlike('poliklinikname', 'LABORATORIUM PATOLOGI ANATOMI');
        $this->dt->notlike('poliklinikname', '-');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL314IGD()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname,
        COUNT(case when statuspasien LIKE "%RUJUK KE RS LAIN%" then 1 ELSE NULL END) as "rujukkerslain",
        COUNT(case when statuspasien LIKE "%PINDAH KE RS LAIN%" then 1 ELSE NULL END) as "pindahkerslain",
        COUNT(case when statuspasien LIKE "%RUJUK BALIK%" then 1 ELSE NULL END) as "rujukbalik",
        COUNT(case when faskesname LIKE "%DATANG%" then 1 ELSE NULL END) as "datang",
        COUNT(case when faskesname LIKE "%RS%" then 1 ELSE NULL END) as "rslain",
        COUNT(case when faskesname LIKE "%BP%" then 1 ELSE NULL END) as "bp",
        COUNT(case when faskesname LIKE "%PUSKESMAS%" then 1 ELSE NULL END) as "puskesmas",
        COUNT(case when faskesname LIKE "%KLINIK%" then 1 ELSE NULL END) as "klinik",
        COUNT(case when faskesname LIKE "%DR.%" then 1 ELSE NULL END) as "dokter"
         ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL314IGD($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' poliklinikname,
        COUNT(case when statuspasien LIKE "%RUJUK KE RS LAIN%" then 1 ELSE NULL END) as "rujukkerslain",
        COUNT(case when statuspasien LIKE "%PINDAH KE RS LAIN%" then 1 ELSE NULL END) as "pindahkerslain",
        COUNT(case when statuspasien LIKE "%RUJUK BALIK%" then 1 ELSE NULL END) as "rujukbalik",
        COUNT(case when faskesname LIKE "%DATANG%" then 1 ELSE NULL END) as "datang",
        COUNT(case when faskesname LIKE "%RS%" then 1 ELSE NULL END) as "rslain",
        COUNT(case when faskesname LIKE "%BP%" then 1 ELSE NULL END) as "bp",
        COUNT(case when faskesname LIKE "%PUSKESMAS%" then 1 ELSE NULL END) as "puskesmas",
        COUNT(case when faskesname LIKE "%KLINIK%" then 1 ELSE NULL END) as "klinik",
        COUNT(case when faskesname LIKE "%DR.%" then 1 ELSE NULL END) as "dokter" ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('groups', 'IGD');
        $this->dt->groupBy('poliklinikname');
        $this->dt->orderBy('poliklinikname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL314Ranap()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' smfname,
        COUNT(case when statuspasien LIKE "%RUJUK KE RS LAIN%" then 1 ELSE NULL END) as "rujukkerslain",
        COUNT(case when statuspasien LIKE "%PINDAH KE RS LAIN%" then 1 ELSE NULL END) as "pindahkerslain",
        COUNT(case when statuspasien LIKE "%RUJUK BALIK%" then 1 ELSE NULL END) as "rujukbalik",
        COUNT(case when faskesname LIKE "%DATANG%" then 1 ELSE NULL END) as "datang",
        COUNT(case when faskesname LIKE "%RS%" then 1 ELSE NULL END) as "rslain",
        COUNT(case when faskesname LIKE "%BP%" then 1 ELSE NULL END) as "bp",
        COUNT(case when faskesname LIKE "%PUSKESMAS%" then 1 ELSE NULL END) as "puskesmas",
        COUNT(case when faskesname LIKE "%KLINIK%" then 1 ELSE NULL END) as "klinik",
        COUNT(case when faskesname LIKE "%DR.%" then 1 ELSE NULL END) as "dokter"
         ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL314Ranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' smfname,
        COUNT(case when statuspasien LIKE "%RUJUK KE RS LAIN%" then 1 ELSE NULL END) as "rujukkerslain",
        COUNT(case when statuspasien LIKE "%PINDAH KE RS LAIN%" then 1 ELSE NULL END) as "pindahkerslain",
        COUNT(case when statuspasien LIKE "%RUJUK BALIK%" then 1 ELSE NULL END) as "rujukbalik",
        COUNT(case when faskesname LIKE "%DATANG%" then 1 ELSE NULL END) as "datang",
        COUNT(case when faskesname LIKE "%RS%" then 1 ELSE NULL END) as "rslain",
        COUNT(case when faskesname LIKE "%BP%" then 1 ELSE NULL END) as "bp",
        COUNT(case when faskesname LIKE "%PUSKESMAS%" then 1 ELSE NULL END) as "puskesmas",
        COUNT(case when faskesname LIKE "%KLINIK%" then 1 ELSE NULL END) as "klinik",
        COUNT(case when faskesname LIKE "%DR.%" then 1 ELSE NULL END) as "dokter" ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->groupBy('smfname');
        $this->dt->orderBy('smfname', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL51()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' lamabaru, COUNT(lamabaru)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->groupBy('lamabaru');
        $this->dt->orderBy('lamabaru', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL51($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' lamabaru, COUNT(lamabaru)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('groups', 'IRJ');
        $this->dt->groupBy('lamabaru');
        $this->dt->orderBy('lamabaru', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function ambildata_RL51IGD()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' lamabaru, COUNT(lamabaru)as jumlah ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->groupBy('lamabaru');
        $this->dt->orderBy('lamabaru', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL51IGD($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' lamabaru, COUNT(lamabaru)as jumlah ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('groups', 'IGD');
        $this->dt->groupBy('lamabaru');
        $this->dt->orderBy('lamabaru', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL51Ranap()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' lamabaru, COUNT(lamabaru)as jumlah ');
        $this->dt->where('datein', date('Y-m-d'));
        $this->dt->like('types', 'BARU');
        $this->dt->groupBy('lamabaru');
        $this->dt->orderBy('lamabaru', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL51Ranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' lamabaru, COUNT(lamabaru)as jumlah ');
        $this->dt->where('datein >=', $search['mulai']);
        $this->dt->where('datein <=', $search['sampai']);
        $this->dt->like('types', 'BARU');
        $this->dt->groupBy('lamabaru');
        $this->dt->orderBy('lamabaru', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL4A()
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->join('transaksi_pelayanan_pulang_rawatinap', 'transaksi_pelayanan_pulang_rawatinap.referencenumber=transaksi_rekammedik_rawatjalan_detail.referencenumber', 'left');
        $this->dt->select(' codeicdx , nameicdx, COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years < 4,relationname, NULL))as Lkurang4,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years < 4,relationname, NULL))as Pkurang4,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 4 AND age_years < 15,relationname, NULL))as Lkurang14,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 4 AND age_years < 15,relationname, NULL))as Pkurang14,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 14 AND age_years < 25,relationname, NULL))as Lkurang24,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 14 AND age_years < 25,relationname, NULL))as Pkurang24,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 24 AND age_years < 45,relationname, NULL))as Lkurang44,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 24 AND age_years < 45,relationname, NULL))as Pkurang44,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 44 AND age_years < 65,relationname, NULL))as Lkurang64,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 44 AND age_years < 65,relationname, NULL))as Pkurang64,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 65,relationname, NULL))as Lkurang65,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 65,relationname, NULL))as Pkurang65,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L",relationname, NULL))as laki,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P",relationname, NULL))as perempuan,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="DOA",relationname, NULL))as doa,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG (BEROBAT JALAN)",relationname, NULL))as pulang,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL < 48 JAM",relationname, NULL))as meninggal1,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL > 48 JAM",relationname, NULL))as meninggal2,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL < 8 JAM",relationname, NULL))as meninggal3,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="RUJUK KE RS LAIN",relationname, NULL))as rujuk,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PINDAH KE RS LAIN",relationname, NULL))as pindah,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG (SEMBUH)",relationname, NULL))as pulangsembuh,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="RUJUK BALIK",relationname, NULL))as rujukbalik,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="KABUR",relationname, NULL))as kabur,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG APS",relationname, NULL))as pulangaps ');
        $this->dt->where('date_pelayanan', date('Y-m-d'));
        $this->dt->like('types', 'RI');
        $this->dt->like('kategori', 'Primer');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('codeicdx', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL4A($search)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->join('transaksi_pelayanan_pulang_rawatinap', 'transaksi_pelayanan_pulang_rawatinap.referencenumber=transaksi_rekammedik_rawatjalan_detail.referencenumber', 'left');
        $this->dt->select(' codeicdx , nameicdx, COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years < 4,relationname, NULL))as Lkurang4,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years < 4,relationname, NULL))as Pkurang4,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 4 AND age_years < 15,relationname, NULL))as Lkurang14,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 4 AND age_years < 15,relationname, NULL))as Pkurang14,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 14 AND age_years < 25,relationname, NULL))as Lkurang24,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 14 AND age_years < 25,relationname, NULL))as Pkurang24,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 24 AND age_years < 45,relationname, NULL))as Lkurang44,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 24 AND age_years < 45,relationname, NULL))as Pkurang44,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 44 AND age_years < 65,relationname, NULL))as Lkurang64,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 44 AND age_years < 65,relationname, NULL))as Pkurang64,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 65,relationname, NULL))as Lkurang65,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 65,relationname, NULL))as Pkurang65,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L",relationname, NULL))as laki,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P",relationname, NULL))as perempuan,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="DOA",relationname, NULL))as doa,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG (BEROBAT JALAN)",relationname, NULL))as pulang,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL < 48 JAM",relationname, NULL))as meninggal1,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL > 48 JAM",relationname, NULL))as meninggal2,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL < 8 JAM",relationname, NULL))as meninggal3,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="RUJUK KE RS LAIN",relationname, NULL))as rujuk,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PINDAH KE RS LAIN",relationname, NULL))as pindah,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG (SEMBUH)",relationname, NULL))as pulangsembuh,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="RUJUK BALIK",relationname, NULL))as rujukbalik,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="KABUR",relationname, NULL))as kabur,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG APS",relationname, NULL))as pulangaps ');
        $this->dt->where('date_pelayanan >=', $search['mulai']);
        $this->dt->where('date_pelayanan <=', $search['sampai']);
        $this->dt->like('types', 'RI');
        $this->dt->like('kategori', 'Primer');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('codeicdx', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL4B()
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->join('transaksi_pelayanan_daftar_rawatjalan', 'transaksi_pelayanan_daftar_rawatjalan.journalnumber=transaksi_rekammedik_rawatjalan_detail.referencenumber', 'left');
        $this->dt->select(' codeicdx , nameicdx, COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years < 4,relationname, NULL))as Lkurang4,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years < 4,relationname, NULL))as Pkurang4,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 4 AND age_years < 15,relationname, NULL))as Lkurang14,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 4 AND age_years < 15,relationname, NULL))as Pkurang14,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 14 AND age_years < 25,relationname, NULL))as Lkurang24,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 14 AND age_years < 25,relationname, NULL))as Pkurang24,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 24 AND age_years < 45,relationname, NULL))as Lkurang44,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 24 AND age_years < 45,relationname, NULL))as Pkurang44,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 44 AND age_years < 65,relationname, NULL))as Lkurang64,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 44 AND age_years < 65,relationname, NULL))as Pkurang64,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 65,relationname, NULL))as Lkurang65,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 65,relationname, NULL))as Pkurang65,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L",relationname, NULL))as laki,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P",relationname, NULL))as perempuan,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="DOA",relationname, NULL))as doa,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="PULANG (BEROBAT JALAN)",relationname, NULL))as pulang,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="MENINGGAL < 48 JAM",relationname, NULL))as meninggal1,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="MENINGGAL > 48 JAM",relationname, NULL))as meninggal2,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="MENINGGAL < 8 JAM",relationname, NULL))as meninggal3,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="RUJUK KE RS LAIN",relationname, NULL))as rujuk,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="PINDAH KE RS LAIN",relationname, NULL))as pindah,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="PULANG (SEMBUH)",relationname, NULL))as pulangsembuh,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="RUJUK BALIK",relationname, NULL))as rujukbalik,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="KABUR",relationname, NULL))as kabur,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="DIRAWAT",relationname, NULL))as dirawat1,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="DIRAWAT APS",relationname, NULL))as dirawat2,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="PULANG APS",relationname, NULL))as pulangaps ');
        $this->dt->where('date_pelayanan', date('Y-m-d'));
        $this->dt->notlike('types', 'RI');
        $this->dt->like('kategori', 'Primer');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('codeicdx', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL4B($search)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->join('transaksi_pelayanan_daftar_rawatjalan', 'transaksi_pelayanan_daftar_rawatjalan.journalnumber=transaksi_rekammedik_rawatjalan_detail.referencenumber', 'left');
        $this->dt->select(' codeicdx , nameicdx, COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years < 4,relationname, NULL))as Lkurang4,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years < 4,relationname, NULL))as Pkurang4,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 4 AND age_years < 15,relationname, NULL))as Lkurang14,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 4 AND age_years < 15,relationname, NULL))as Pkurang14,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 14 AND age_years < 25,relationname, NULL))as Lkurang24,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 14 AND age_years < 25,relationname, NULL))as Pkurang24,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 24 AND age_years < 45,relationname, NULL))as Lkurang44,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 24 AND age_years < 45,relationname, NULL))as Pkurang44,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 44 AND age_years < 65,relationname, NULL))as Lkurang64,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 44 AND age_years < 65,relationname, NULL))as Pkurang64,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L" AND age_years > 65,relationname, NULL))as Lkurang65,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P" AND age_years > 65,relationname, NULL))as Pkurang65,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="L",relationname, NULL))as laki,
        COUNT(IF(transaksi_rekammedik_rawatjalan_detail.pasiengender="P",relationname, NULL))as perempuan,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="DOA",relationname, NULL))as doa,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="PULANG (BEROBAT JALAN)",relationname, NULL))as pulang,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="MENINGGAL < 48 JAM",relationname, NULL))as meninggal1,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="MENINGGAL > 48 JAM",relationname, NULL))as meninggal2,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="MENINGGAL < 8 JAM",relationname, NULL))as meninggal3,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="RUJUK KE RS LAIN",relationname, NULL))as rujuk,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="PINDAH KE RS LAIN",relationname, NULL))as pindah,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="PULANG (SEMBUH)",relationname, NULL))as pulangsembuh,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="RUJUK BALIK",relationname, NULL))as rujukbalik,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="KABUR",relationname, NULL))as kabur,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="DIRAWAT",relationname, NULL))as dirawat1,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="DIRAWAT APS",relationname, NULL))as dirawat2,
        COUNT(IF(transaksi_pelayanan_daftar_rawatjalan.statuspasien="PULANG APS",relationname, NULL))as pulangaps ');
        $this->dt->where('date_pelayanan >=', $search['mulai']);
        $this->dt->where('date_pelayanan <=', $search['sampai']);
        $this->dt->notlike('types', 'RI');
        $this->dt->like('kategori', 'Primer');
        $this->dt->notlike('codeicdx', 'NONE');
        $this->dt->groupBy('codeicdx');
        $this->dt->orderBy('codeicdx', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildata_RL31()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->join('transaksi_pelayanan_pulang_rawatinap', 'transaksi_pelayanan_pulang_rawatinap.referencenumber=transaksi_pelayanan_daftar_rawatinap.referencenumber', 'left');
        $this->dt->select(' transaksi_pelayanan_daftar_rawatinap.smfname , COUNT(transaksi_pelayanan_daftar_rawatinap.pasienid)as pasienmasuk ');
        $this->dt->where('transaksi_pelayanan_daftar_rawatinap.datein', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_daftar_rawatinap.types', 'BARU');
        $this->dt->groupBy('transaksi_pelayanan_daftar_rawatinap.smfname');
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatinap.smfname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_RL31($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->join('transaksi_pelayanan_pulang_rawatinap', 'transaksi_pelayanan_pulang_rawatinap.referencenumber=transaksi_pelayanan_daftar_rawatinap.referencenumber', 'left');
        $this->dt->select(' transaksi_pelayanan_daftar_rawatinap.smfname , COUNT(transaksi_pelayanan_daftar_rawatinap.pasienid)as pasienmasuk,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="DOA",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as doa,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG (BEROBAT JALAN)",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as pulang,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL < 48 JAM",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as meninggal1,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL > 48 JAM",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as meninggal2,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="MENINGGAL < 8 JAM",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as meninggal3,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="RUJUK KE RS LAIN",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as rujuk,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PINDAH KE RS LAIN",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as pindah,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG (SEMBUH)",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as pulangsembuh,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="RUJUK BALIK",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as rujukbalik,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="KABUR",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as kabur,
        COUNT(IF(transaksi_pelayanan_pulang_rawatinap.statuspasien="PULANG APS",transaksi_pelayanan_pulang_rawatinap.pasienname, NULL))as pulangaps ');
        $this->dt->where('transaksi_pelayanan_daftar_rawatinap.datein >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_daftar_rawatinap.datein <=', $search['sampai']);
        $this->dt->like('transaksi_pelayanan_daftar_rawatinap.types', 'BARU');
        $this->dt->groupBy('transaksi_pelayanan_daftar_rawatinap.smfname');
        $this->dt->orderBy('transaksi_pelayanan_daftar_rawatinap.smfname', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataABL_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'ABL');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterABL_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('types', 'ABL');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataABL_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'ABL');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterABL_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('groups', 'ABL');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataABL_rekapwilayah_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'ABL');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterABL_rekapwilayah_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'ABL');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataabl_rekapgender_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'ABL');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterABL_rekapgender_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'ABL');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataFRS_rekapcabar()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('types', 'FRS');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFRS_rekapcabar($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select(' name , COUNT(IF(paymentmethodname="TUNAI",relationname, NULL))as tunai,
        COUNT(IF(paymentmethodname="JKN-ASKES",relationname, NULL))as jknaskes,
        COUNT(IF(paymentmethodname="JKN-BUMN",relationname, NULL))as jknbumn,
        COUNT(IF(paymentmethodname="JKN-JAMKESMAS",relationname, NULL))as jknjamkesmas,
        COUNT(IF(paymentmethodname="JKN-JAMSOSTEK",relationname, NULL))as jknjamsostek,
        COUNT(IF(paymentmethodname="JKN-TNI-POLRI",relationname, NULL))as jkntnipolri,
        COUNT(IF(paymentmethodname="JKN-UMUM",relationname, NULL))as jknumum,
        COUNT(IF(paymentmethodname="JKN-KIS",relationname, NULL))as jknkis,
        COUNT(IF(paymentmethodname="JKN-KS",relationname, NULL))as jknks,
        COUNT(IF(paymentmethodname="NOTA",relationname, NULL))as nota,
        COUNT(IF(paymentmethodname="BAKSOS",relationname, NULL))as baksos,
        COUNT(IF(paymentmethodname="DISPENSASI",relationname, NULL))as dispensasi,
        COUNT(IF(paymentmethodname="JAMKESDA KOTA",relationname, NULL))as jamkesdakota,
        COUNT(IF(paymentmethodname="JAMKESDA KAB CIANJUR",relationname, NULL))as jamkesdacianjur,
        COUNT(IF(paymentmethodname="JAMKESDA KAB. BOGOR",relationname, NULL))as jamkesdakabbogor,
        COUNT(IF(paymentmethodname="JAMKESDA KABUPATEN",relationname, NULL))as jamkesdakabupaten,
        COUNT(IF(paymentmethodname="JAMPERSAL KOTA",relationname, NULL))as jampersalkota,
        COUNT(IF(paymentmethodname="NOTA ASKES INHEART",relationname, NULL))as notaaskes,
        COUNT(IF(paymentmethodname="NOTA BERKAS JAYA MANDIRI",relationname, NULL))as notaberkasjayamandiri,
        COUNT(IF(paymentmethodname="NOTA BPJS KETENAGAKERJAAN",relationname, NULL))as notabpjstenagakerja,
        COUNT(IF(paymentmethodname="NOTA CEMINDO GEMILANG",relationname, NULL))as notacemindo,
        COUNT(IF(paymentmethodname="NOTA GSI / MAXI",relationname, NULL))as notagsi,
        COUNT(IF(paymentmethodname="NOTA JASARAHARJA",relationname, NULL))as notajasaraharja,
        COUNT(IF(paymentmethodname="NOTA KELAS II",relationname, NULL))as notakelas2,
        COUNT(IF(paymentmethodname="NOTA KELAS III",relationname, NULL))as notakelas3,
        COUNT(IF(paymentmethodname="NOTA KERETA API INDONESIA",relationname, NULL))as notakeretaapi,
        COUNT(IF(paymentmethodname="NOTA KINO CARE",relationname, NULL))as notakinocare,
        COUNT(IF(paymentmethodname="NOTA MEDIKA PRATAMA",relationname, NULL))as notamedicapratama,
        COUNT(IF(paymentmethodname="NOTA MOLAX GLOBAL",relationname, NULL))as notamolaxglobal, 
        COUNT(IF(paymentmethodname="NOTA MUARA GRILYA KESTARI",relationname, NULL))as notamuara,
        COUNT(IF(paymentmethodname="NOTA MUARA TUNGGAL",relationname, NULL))as notamuaratunggal,
        COUNT(IF(paymentmethodname="NOTA NAYAKA",relationname, NULL))as notanayaka,
        COUNT(IF(paymentmethodname="NOTA PERKASA NUSA GUNA",relationname, NULL))as notaperkasanusa,
        COUNT(IF(paymentmethodname="NOTA POS",relationname, NULL))as notapos,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIANJUR",relationname, NULL))as notabricianjur,
        COUNT(IF(paymentmethodname="NOTA PP BRI CIBADAK",relationname, NULL))as notabricibadak,
        COUNT(IF(paymentmethodname="NOTA PP BRI SUKABUMI",relationname, NULL))as notabricisukabumi,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG MANIK",relationname, NULL))as notagunungmanik,
        COUNT(IF(paymentmethodname="NOTA PT. GUNUNG ROSA",relationname, NULL))as notagunungrosa,
        COUNT(IF(paymentmethodname="NOTA PT. UNIVERSAL",relationname, NULL))as notauniversal,
        COUNT(IF(paymentmethodname="NOTA PTPN",relationname, NULL))as notaptpn,
        COUNT(IF(paymentmethodname="NOTA RUMAH CEMARA",relationname, NULL))as notarumahcemara,
        COUNT(IF(paymentmethodname="NOTA SEMEN JAWA",relationname, NULL))as notasemenjawa,
        COUNT(IF(paymentmethodname="NOTA YANKOPEN ANTAM",relationname, NULL))as notayankopen,
        COUNT(IF(paymentmethodname="NOTA YKP BTN ",relationname, NULL))as notaykpbtn,
        COUNT(IF(paymentmethodname="LAIN-LAIN",relationname, NULL))as lain ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('types', 'FRS');
        $this->dt->groupBy('name');
        $this->dt->orderBy('name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataFRS_rekapwilayah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'FRS');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFRS_rekapwilayah($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->select(' paymentmethod , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('groups', 'FRS');
        $this->dt->groupBy('paymentmethod');
        $this->dt->orderBy('paymentmethod', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataFRS_rekapwilayah_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'FRS');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFRS_rekapwilayah_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasienarea="KOTA",pasienname, NULL))as kota,
        COUNT(IF(pasienarea="KOTA SUKABUMI",pasienname, NULL))as kotasukabumi,
        COUNT(IF(pasienarea="KABUPATEN",pasienname, NULL))as kabupaten,
        COUNT(IF(pasienarea="CIANJUR",pasienname, NULL))as cianjur,
        COUNT(IF(pasienarea="BOGOR",pasienname, NULL))as bogor,
        COUNT(IF(pasienarea="LAINNYA",pasienname, NULL))as lain,
        COUNT(IF(pasienarea="NONE",pasienname, NULL))as none ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        // if ($search['doktername'] != "") {
        //     $this->dt->like('doktername', $search['doktername']);
        // }
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'FRS');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatafrs_rekapgender_pem()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate', date('Y-m-d'));
        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'FRS');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterFRS_rekapgender_pem($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->join('transaksi_pelayanan_penunjang_detail', 'transaksi_pelayanan_penunjang_detail.journalnumber=transaksi_pelayanan_penunjang_header.journalnumber', 'left');
        $this->dt->select(' name , COUNT(IF(pasiengender="L",pasienname, NULL))as laki,
        COUNT(IF(pasiengender="P",pasienname, NULL))as perempuan ');
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate >=', $search['mulai']);
        $this->dt->where('transaksi_pelayanan_penunjang_header.documentdate <=', $search['sampai']);

        $this->dt->like('transaksi_pelayanan_penunjang_header.groups', 'FRS');
        $this->dt->groupBy('transaksi_pelayanan_penunjang_detail.name');
        $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.name', 'ASC');
        //$this->dt->limit(30);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapatologiklinik()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'LPK');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterPatologiKlinik($search)
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

    function ambildataSentLis()
    {
        $this->dt = $this->db->table('order_lab');
        $this->dt->where('waktu_kirim', date('Y-m-d'));
        $this->dt->like('groups', 'LPK');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterKirimLis($search)
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

    function ambildatarajal_aftervalidasi()
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_aftervalidasi($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatabatal()
    {
        $this->dt = $this->db->table('log_delete_transaksi_kasir_rawatjalan');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_ambildata_log($search)
    {
        $this->dt = $this->db->table('log_delete_transaksi_kasir_rawatjalan');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_penerimaan()
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->where('paymentamount > 0');
        $this->dt->notlike('types', 'PBTN');
        $this->dt->notlike('types', 'PHKP');
        $this->dt->notlike('types', 'PBNTN');
        $this->dt->notlike('types', 'PBANTN');
        //$this->dt->whereIn('types', $jenis);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_penerimaan()
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->where('paymentamount > 0');
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataigd_penerimaan()
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->where('paymentamount > 0');
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapenunjang_penerimaan()
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->where('paymentamount > 0');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_penerimaan($search)
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('paymentamount > 0');
        //$this->dt->whereIn('types', $jenis);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->notlike('types', 'PBTN');
        $this->dt->notlike('types', 'PHKP');
        $this->dt->notlike('types', 'PBNTN');
        $this->dt->notlike('types', 'PBANTN');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_penerimaan($search)
    {

        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('groups', 'IRJ');
        $this->dt->where('paymentamount > 0');
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_RegisterIgd_penerimaan($search)
    {

        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('groups', 'IGD');
        $this->dt->where('paymentamount > 0');
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang_penerimaan($search)
    {

        $this->dt = $this->db->table('transaksi_kasir_penunjang');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('paymentamount > 0');
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_piutang($search)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('grandtotal >', 'paymentamount');
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }

        $this->dt->notlike('types', 'PBTN');
        $this->dt->notlike('types', 'PHKP');
        $this->dt->notlike('types', 'PBNTN');
        $this->dt->notlike('types', 'PBANTN');
        $this->dt->notlike('types', 'UM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_piutang($search)
    {

        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('groups', 'IRJ');
        $this->dt->where('paymentstatus', 'PIUTANG');
        //$this->dt->where('grandtotal >', 'paymentamount');
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIgd_piutang($search)
    {

        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('groups', 'IGD');
        $this->dt->where('paymentstatus', 'PIUTANG');
        //$this->dt->where('grandtotal >', 'paymentamount');
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPenunjang_piutang($search)
    {

        $this->dt = $this->db->table('transaksi_kasir_penunjang');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('grandtotal >', 'paymentamount');
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRanap_detail_beritaacara($search)
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->notlike('types', 'PBTN');
        $this->dt->notlike('types', 'PHKP');
        $this->dt->notlike('types', 'PBNTN');
        $this->dt->notlike('types', 'PBANTN');
        $this->dt->notlike('types', 'UM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_Register_uangmuka($search)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('types', 'UM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataregister_uangmuka()
    {
        //$jenis = ['TN', 'IUR', 'NTN', 'UM'];
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->where('types', 'UM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    public function search_RegisterPenunjang_detail_beritaacara($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_karcis()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.cancel', 0);
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_close_karcis($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('transaksi_pelayanan_daftar_rawatjalan.cancel', 0);
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

    function ambildatarekap_pendapatan_rajal()
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->select(' created_at , SUM(grandtotal)as jumlahtagihan, SUM(paymentamount + nominaldebet)as jumlahbayar ');
        $this->dt->where('created_at', date('Y-m-d'));
        //$this->dt->where('transaksi_pelayanan_daftar_rawatjalan.cancel', 0);
        $this->dt->where('paymentamount >', 0);
        //$this->dt->orwhere('nominaldebet >', 0);
        $this->dt->like('groups', 'IRJ');
        $this->dt->groupBy('created_at');
        $this->dt->orderBy('created_at');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_datarekap_pendapatan_rajal($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->select(' created_at , SUM(grandtotal)as jumlahtagihan, SUM(paymentamount + nominaldebet)as jumlahbayar ');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        //$this->dt->where('transaksi_pelayanan_daftar_rawatjalan.cancel', 0);
        $this->dt->where('paymentamount >', 0);
        //$this->dt->orwhere('nominaldebet >', 0);
        $this->dt->like('groups', 'IRJ');
        $this->dt->groupBy('created_at');
        $this->dt->orderBy('created_at');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarekap_pendapatan_igd()
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->select(' created_at , SUM(grandtotal)as jumlahtagihan, SUM(paymentamount + nominaldebet)as jumlahbayar ');
        $this->dt->where('created_at', date('Y-m-d'));
        //$this->dt->where('transaksi_pelayanan_daftar_rawatjalan.cancel', 0);
        $this->dt->where('paymentamount >', 0);
        // $this->dt->orwhere('nominaldebet >', 0);
        $this->dt->like('groups', 'IGD');
        $this->dt->groupBy('created_at');
        $this->dt->orderBy('created_at');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_datarekap_pendapatan_igd($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_rawatjalan');
        $this->dt->select(' created_at , SUM(grandtotal)as jumlahtagihan, SUM(paymentamount + nominaldebet)as jumlahbayar ');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        //$this->dt->where('transaksi_pelayanan_daftar_rawatjalan.cancel', 0);
        $this->dt->where('paymentamount >', 0);
        //$this->dt->orwhere('nominaldebet >', 0);
        $this->dt->like('groups', 'IGD');
        $this->dt->groupBy('created_at');
        $this->dt->orderBy('created_at');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarekap_pendapatan_ranap()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->select(' created_at , SUM(grandtotal)as jumlahtagihan, SUM(paymentamount + nominaldebet)as jumlahbayar ');
        $this->dt->where('created_at', date('Y-m-d'));
        //$this->dt->where('transaksi_pelayanan_daftar_rawatjalan.cancel', 0);
        $this->dt->where('paymentamount >', 0);
        //$this->dt->orwhere('nominaldebet >', 0);
        $this->dt->groupBy('created_at');
        $this->dt->orderBy('created_at');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_datarekap_pendapatan_ranap($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_kasir_rawatinap');
        $this->dt->select(' created_at , SUM(grandtotal)as jumlahtagihan, SUM(paymentamount + nominaldebet)as jumlahbayar ');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('paymentamount >', 0);
        //$this->dt->orwhere('nominaldebet >', 0);
        $this->dt->groupBy('created_at');
        $this->dt->orderBy('created_at');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarekap_pendapatan_penunjang()
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->select(' created_at , SUM(grandtotal)as jumlahtagihan, SUM(paymentamount + nominaldebet)as jumlahbayar ');
        $this->dt->where('created_at', date('Y-m-d'));
        //$this->dt->where('transaksi_pelayanan_daftar_rawatjalan.cancel', 0);
        $this->dt->where('paymentamount >', 0);
        //$this->dt->orwhere('nominaldebet >', 0);
        $this->dt->groupBy('created_at');
        $this->dt->orderBy('created_at');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function search_datarekap_pendapatan_penunjang($search)
    {
        $this->dt = $this->db->table('transaksi_kasir_penunjang');
        $this->dt->select(' created_at , SUM(grandtotal)as jumlahtagihan, SUM(paymentamount + nominaldebet)as jumlahbayar ');
        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);
        $this->dt->where('paymentamount >', 0);
        //$this->dt->orwhere('nominaldebet >', 0);
        $this->dt->groupBy('created_at');
        $this->dt->orderBy('created_at');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_tindakan()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        // $this->dt->where('validasipemeriksaan', 1);
        // $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_Tindakan($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        // $this->dt->where('validasipemeriksaan', 1);
        // $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapasienpulangRajal()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_pasienpulang_Rajal($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapasienpulangIGD()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_pasienpulang_IGD($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->where('cancel', 0.00);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_beritaacara_tindakan()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('tanggalvalidasipembayaran', date('Y-m-d'));
        $this->dt->where('validasipembayaran', 1);
        $this->dt->like('types', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_close_beritaacara_tindakan($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');

        $this->dt->where('tanggalvalidasipembayaran >=', $search['mulai']);
        $this->dt->where('tanggalvalidasipembayaran <=', $search['sampai']);
        $this->dt->where('validasipembayaran', 1);
        $this->dt->like('relationname', $search['patientname'], 'after');
        $this->dt->like('relation', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('types', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajal_beritaacara_karcis()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('validasipembayaran', 1);
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajal_close_beritaacara_karcis($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('validasipembayaran', 1);
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

    function ambildataigd_tindakan()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        // $this->dt->where('validasipemeriksaan', 1);
        // $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIgd_Tindakan($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        // $this->dt->where('validasipemeriksaan', 1);
        // $this->dt->where('validation', 'BELUM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajalPerjanjian()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('perjanjian', 1);
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalPerjanjian($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('perjanjian', 1);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapatologiklinikLPA()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'LPA');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPatologiKlinikLPA($search)
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
        $this->dt->like('groups', 'LPA');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapatologiklinikBD()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'BD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterPatologiKlinikBD($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('asalDaftar', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'BD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapatologiklinikRHM()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'RHM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterPatologiKlinikRHM($search)
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
        $this->dt->like('groups', 'RHM');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataCL()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'CAT');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_RegisterCL($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'CAT');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatapasienpulangsensus()


    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->join('transaksi_pelayanan_kasir_rawatinap', 'transaksi_pelayanan_kasir_rawatinap.referencenumber=transaksi_pelayanan_pulang_rawatinap.referencenumber', 'left');
        $this->dt->select('transaksi_pelayanan_pulang_rawatinap.id, transaksi_pelayanan_pulang_rawatinap.referencenumber, transaksi_pelayanan_pulang_rawatinap.paymentcardnumber, transaksi_pelayanan_pulang_rawatinap.documentdate,
        transaksi_pelayanan_pulang_rawatinap.validation, transaksi_pelayanan_pulang_rawatinap.validation, transaksi_pelayanan_pulang_rawatinap.statuspasien, transaksi_pelayanan_pulang_rawatinap.datetimein,
        transaksi_pelayanan_pulang_rawatinap.datetimeout,  transaksi_pelayanan_pulang_rawatinap.pasienid, transaksi_pelayanan_pulang_rawatinap.pasienname, transaksi_pelayanan_pulang_rawatinap.pasiengender,
        transaksi_pelayanan_pulang_rawatinap.roomname,  transaksi_pelayanan_pulang_rawatinap.bednumber, transaksi_pelayanan_pulang_rawatinap.classroomname, transaksi_pelayanan_pulang_rawatinap.paymentmethodname,
        transaksi_pelayanan_pulang_rawatinap.poliklinikname, transaksi_pelayanan_pulang_rawatinap.doktername, transaksi_pelayanan_pulang_rawatinap.pasienaddress, transaksi_pelayanan_kasir_rawatinap.realcost');
        if ($lokasi == "NONE") {
            $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout', date('Y-m-d'));
        } else {
            $this->dt->where('transaksi_pelayanan_pulang_rawatinap.dateout', date('Y-m-d'));
            $this->dt->where('transaksi_pelayanan_pulang_rawatinap.room', session()->get('locationcode'));
        }
        //$this->dt->like('transaksi_pelayanan_kasir_rawatinap.types', 'NTN');
        $this->dt->like('transaksi_pelayanan_kasir_rawatinap.types', 'NTN');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_pasienpulangSensus($search)
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        if ($lokasi == "NONE") {
            $this->dt->where('dateout >=', $search['mulai']);
            $this->dt->where('dateout <=', $search['sampai']);
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->like('pasienid', $search['norm'], 'after');
            // if ($search['poli'] != "") {
            //     $this->dt->like('smfname', $search['poli']);
            // }
            if ($search['metodepembayaran'] != "") {
                $this->dt->like('paymentmethodname', $search['metodepembayaran']);
            }
        } else {
            $this->dt->where('dateout >=', $search['mulai']);
            $this->dt->where('dateout <=', $search['sampai']);
            $this->dt->like('pasienname', $search['patientname'], 'after');
            $this->dt->like('pasienid', $search['norm'], 'after');
            // if ($search['poli'] != "") {
            //     $this->dt->like('smfname', $search['poli']);
            // }
            if ($search['metodepembayaran'] != "") {
                $this->dt->like('paymentmethodname', $search['metodepembayaran']);
            }
            $this->dt->where('room', session()->get('locationcode'));
        }

        $this->dt->where('dateout >=', $search['mulai']);
        $this->dt->where('dateout <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('smfname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_poli($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_poli_rme($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_list_skala_nyeri()
    {
        $this->dt = $this->db->table('skala_nyeri_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_paramedic($term, $key)
    {
        $this->dt = $this->db->table('daftar_perawat');
        $this->dt->orderBy('nama');
        //$this->dt->where('poliklinikname', $term);
        $this->dt->like('nama', $key);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kesadaran()
    {
        $this->dt = $this->db->table('master_kesadaran_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_diagnosa_perawat()
    {
        $this->dt = $this->db->table('diagnosa_keperawatan_rme');
        $this->dt->distinct('diagnosa');
        $this->dt->groupBy('diagnosa');
        $this->dt->orderBy('diagnosa');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_askep($diagnosa)
    {
        $this->dt = $this->db->table('diagnosa_keperawatan_rme');
        $this->dt->where('diagnosa', $diagnosa);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_konsultasi()
    {
        $this->dt = $this->db->table('master_konsultasi_rme');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_tindaklanjut()
    {
        $this->dt = $this->db->table('master_tindaklanjut_rme');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_asesmen_perawat_poli_rme($referencenumber)
    {
        $tb = "asesmen_awal_perawatan_rj_rme";
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_pasien_rme($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_template_rme($namapoli)
    {
        $poli = [$namapoli, 'NONE'];
        $this->dt = $this->db->table('template_soap_rme');
        //$this->dt->whereIn('smf', $poli);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_resume_penunjang($referencenumber)
    {
        $kelas = ['IRJ', 'IGD'];
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->whereIn('classroom', $kelas);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_cppt_perawat($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_cppt_medis($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        // $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_cppt_medis_pasien($pasienid)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_cppt_medis_konsul($pasienid)
    {
        $this->dt = $this->db->table('resume_cppt_rme');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->where('cpptGenerik', 1);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cppt_id($id)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_RiwayatPasien($pasienid)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_tindakan_detail($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->select('name, journalnumber, referencenumber');
        $query = $this->dt->whereIn('referencenumber', $id);
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_diagnosa_detail($id)
    {
        $asal = ['IRJ', 'IGD'];
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->select('codeicdx, nameicdx, kategori, referencenumber');
        $query = $this->dt->whereIn('referencenumber', $id);
        $query = $this->dt->whereIn('types', $asal);
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_rad_detail($id)
    {
        $asal = ['IRJ', 'IGD'];
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->join('transaksi_pelayanan_penunjang_expertise', 'transaksi_pelayanan_penunjang_expertise.idPenunjangDetail=transaksi_pelayanan_penunjang_detail.id', 'left');
        $this->dt->select('transaksi_pelayanan_penunjang_detail.id,transaksi_pelayanan_penunjang_detail.code, transaksi_pelayanan_penunjang_detail.name, transaksi_pelayanan_penunjang_detail.referencenumber, transaksi_pelayanan_penunjang_expertise.idPenunjangDetail');
        $query = $this->dt->whereIn('transaksi_pelayanan_penunjang_detail.referencenumber', $id);
        $query = $this->dt->whereIn('transaksi_pelayanan_penunjang_detail.classroom', $asal);
        $query = $this->dt->where('transaksi_pelayanan_penunjang_detail.types', 'RAD');
        $query = $this->dt->orderBy('transaksi_pelayanan_penunjang_detail.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_lpk_detail($id)
    {
        $asal = ['IRJ', 'IGD'];
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('code, name, referencenumber, journalnumber');
        $query = $this->dt->whereIn('referencenumber', $id);
        $query = $this->dt->whereIn('classroom', $asal);
        $query = $this->dt->where('types', 'LPK');
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function search_lpa_detail($id)
    {
        $asal = ['IRJ', 'IGD'];
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('code, name, referencenumber');
        $query = $this->dt->whereIn('referencenumber', $id);
        $query = $this->dt->whereIn('classroom', $asal);
        $query = $this->dt->where('types', 'LPA');
        $query = $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }




    function get_data_expertise_rad($id)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        $this->dt->where('idPenunjangDetail', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }


    function get_data_expertise_lpk($id)
    {
        $this->dt = $this->db->table('lab_hasil');
        $this->dt->where('no_order', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_cppt_perawat_pasien($pasienid)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('pasienid', $pasienid);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_data_cppt_id_perawat($id)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_resep_detail($id)
    {
        $asal = ['RJ', 'IGD'];
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.signa1, transaksi_farmasi_pelayanan_detail.signa2, transaksi_farmasi_pelayanan_header.referencenumber, transaksi_farmasi_pelayanan_header.journalnumber');
        $query = $this->dt->whereIn('transaksi_farmasi_pelayanan_header.referencenumber', $id);
        $query = $this->dt->whereIn('transaksi_farmasi_pelayanan_header.groups', $asal);
        $query = $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $query = $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_obat_rme($key, $locationcode)
    {
        $this->dt = $this->db->table('obat');
        $this->dt->join('obat_balance', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('obat.code, obat.name, obat.salesprice, SUM(obat_balance.balance)as balance, obat_balance.expireddate, obat_balance.batchnumber, obat_balance.locationcode, obat.uom,
        obat_balance.expireddate');
        $this->dt->where('obat_balance.locationcode', $locationcode);
        $this->dt->like('obat.name', $key);

        $this->dt->groupBy('obat_balance.code');
        $this->dt->limit(20);
        // $this->dt->orderBy('obat.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_racikan_rme()
    {
        $this->dt = $this->db->table('racikan_rme');
        $this->dt->select(' name, id, kode ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cek_farmasi_rme($referencenumber, $groups)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', $groups);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataigdrme()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->where('cancel !=', "1.00");
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterIgdrme($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->where('cancel', 0);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');

        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_mobil()
    {
        $this->dt = $this->db->table('mobil_triase_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_airway()
    {
        $this->dt = $this->db->table('airway_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_breathing()
    {
        $this->dt = $this->db->table('breathing_rme');
        $this->dt->where('active', 0);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_circulation()
    {
        $this->dt = $this->db->table('circulation_rme');
        $this->dt->where('active', 0);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_eye()
    {
        $this->dt = $this->db->table('gcs_eye_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_verbal()
    {
        $this->dt = $this->db->table('gcs_verbal_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_motorik()
    {
        $this->dt = $this->db->table('gcs_motorik_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_triase_rme($referencenumber)
    {
        $tb = "asesmen_triase_igd_rme";
        $this->dt = $this->db->table('asesmen_triase_igd_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_airway_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Airway');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_data_cek_coding($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_suaraNafas_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Suara Nafas');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_polaNafas_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Pola Nafas');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_bunyiNafas_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Bunyi Nafas');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_iramaNafas_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Irama Nafas');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_tandaDistressNafas_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Tanda Distress Nafas');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_akral_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Akral');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_sianosis_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Sianosis');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kapiler_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'CRT');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelembapan_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Kelembaban Kulit');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_turgor_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Turgor');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pupil_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Pupil');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_asesmen_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Asesment Fungsional');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_provokes_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Provokes');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_quality_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Quality');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_severity_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'severity');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_sosiologis_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Sosiologis');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_psikologis_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Psikologis');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_spiritual_detail()
    {
        $this->dt = $this->db->table('data_opsi_asesmen_perawat_igd_rme');
        $this->dt->where('kelompok', 'Spiritual');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_turunbb_detail()
    {
        $this->dt = $this->db->table('nutrisi_turun_bb_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_asesmen_perawat_igd_rme($referencenumber)
    {
        $tb = "asesmen_awal_perawatan_rj_rme";
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_asal_pasien_rme()
    {
        $this->dt = $this->db->table('asalPasien_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_ats_rme()
    {
        $this->dt = $this->db->table('master_triase_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_alasan_rujuk()
    {
        $this->dt = $this->db->table('alasanrujuk_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_transfer()
    {
        $this->dt = $this->db->table('transport_transfer_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_derajat()
    {
        $this->dt = $this->db->table('derajat_pasien_transfer_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_monitoring($referencenumber)
    {
        $this->dt = $this->db->table('monitoring_perawat_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');

        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_poli_rme_to_ranap($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'ASC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_diagnosa_rme($referencenumber)
    {
        $tb = "asesmen_awal_medis_rj_rme";
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_asesmen_perawat_rme($referencenumber)
    {
        $tb = "asesmen_awal_perawatan_rj_rme";
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_prosedur_rme($referencenumber)
    {
        $tb = "transaksi_pelayanan_rawatjalan_detail";
        $this->dt = $this->db->table('transaksi_pelayanan_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->select('name');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_resep_rme($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join('transaksi_farmasi_pelayanan_header', 'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.name');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function cek_hasil_transfer_rme($referencenumber)
    {
        $tb = "transfer_pasien_rme";
        $this->dt = $this->db->table('transfer_pasien_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_exist()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('statusrawatinap', 'RAWAT');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1200);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_ranap($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_ranap_rme($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function cek_hasil_transfer_rme_ranap($referencenumber)
    {
        $tb = "transfer_pasien_rme";
        $this->dt = $this->db->table('transfer_pasien_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_kasus_trauma()
    {
        $this->dt = $this->db->table('kasus_trauma_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_rpd()
    {
        $this->dt = $this->db->table('riwayat_penyakit_dahulu_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_komplementari()
    {
        $this->dt = $this->db->table('terapi_komplementari_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kepala()
    {
        $this->dt = $this->db->table('data_opsi_kepala_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_rambut()
    {
        $this->dt = $this->db->table('data_opsi_rambut_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_muka()
    {
        $this->dt = $this->db->table('data_opsi_muka_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_mata()
    {
        $this->dt = $this->db->table('data_opsi_mata_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_telinga()
    {
        $this->dt = $this->db->table('data_opsi_telinga_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_hidung()
    {
        $this->dt = $this->db->table('data_opsi_hidung_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_gigi()
    {
        $this->dt = $this->db->table('data_opsi_gigi_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_lidah()
    {
        $this->dt = $this->db->table('data_opsi_lidah_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_mulut()
    {
        $this->dt = $this->db->table('data_opsi_mulut_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_tenggorokan()
    {
        $this->dt = $this->db->table('data_opsi_tenggorokan_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_leher()
    {
        $this->dt = $this->db->table('data_opsi_leher_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_punggung()
    {
        $this->dt = $this->db->table('data_opsi_punggung_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_payudara()
    {
        $this->dt = $this->db->table('data_opsi_payudara_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_dada()
    {
        $this->dt = $this->db->table('data_opsi_dada_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_perut()
    {
        $this->dt = $this->db->table('data_opsi_perut_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_genital()
    {
        $this->dt = $this->db->table('data_opsi_genital_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_anus()
    {
        $this->dt = $this->db->table('data_opsi_anus_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_integumen()
    {
        $this->dt = $this->db->table('data_opsi_integumen_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_ekstremitas()
    {
        $this->dt = $this->db->table('data_opsi_ekstremitas_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_ginekologi()
    {
        $this->dt = $this->db->table('data_opsi_ginekologi_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_obstetri()
    {
        $this->dt = $this->db->table('data_opsi_obstetry_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kebutuhan_edukasi()
    {
        $this->dt = $this->db->table('kebutuhan_edukasi_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_bahasa()
    {
        $this->dt = $this->db->table('bahasa_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_pendidikan()
    {
        $this->dt = $this->db->table('master_pendidikan');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_hambatan()
    {
        $this->dt = $this->db->table('hambatan_edukasi_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_penurunanBB()
    {
        $this->dt = $this->db->table('penurunan_bb_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_alat_bantu_berjalan()
    {
        $this->dt = $this->db->table('alat_bantu_berjalan_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_mobilisasi()
    {
        $this->dt = $this->db->table('mobilisasi_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_askep_observasi($diagnosa)
    {
        $this->dt = $this->db->table('diagnosa_keperawatan_rme');
        $this->dt->where('diagnosa', $diagnosa);
        $this->dt->where('otec', 'OBSERVASI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    // function get_list_askep_MKep($diagnosa)
    // {
    //     $this->dt = $this->db->table('diagnosa_keperawatan_rme');
    //     $this->dt->where('diagnosa', $diagnosa);
    //     $this->dt->where('otec', 'MASALAH KEPERAWATAN');
    //     $this->dt->orderBy('id');
    //     $query = $this->dt->get();
    //     return $query->getResultArray();
    // }
    // function get_list_askep_IKep($diagnosa)
    // {
    //     $this->dt = $this->db->table('diagnosa_keperawatan_rme');
    //     $this->dt->where('diagnosa', $diagnosa);
    //     $this->dt->where('otec', 'INTERVENSI KEPERAWATAN');
    //     $this->dt->orderBy('id');
    //     $query = $this->dt->get();
    //     return $query->getResultArray();
    // }
    // function get_list_askep_MKol($diagnosa)
    // {
    //     $this->dt = $this->db->table('diagnosa_keperawatan_rme');
    //     $this->dt->where('diagnosa', $diagnosa);
    //     $this->dt->where('otec', 'INTERVENSI KOLABORASI');
    //     $this->dt->orderBy('id');
    //     $query = $this->dt->get();
    //     return $query->getResultArray();
    // }

    function get_list_askep_terapeutik($diagnosa)
    {
        $this->dt = $this->db->table('diagnosa_keperawatan_rme');
        $this->dt->where('diagnosa', $diagnosa);
        $this->dt->where('otec', 'TERAPEUTIC');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_askep_edukasi($diagnosa)
    {
        $this->dt = $this->db->table('diagnosa_keperawatan_rme');
        $this->dt->where('diagnosa', $diagnosa);
        $this->dt->where('otec', 'EDUKASI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_askep_kolaborasi($diagnosa)
    {
        $this->dt = $this->db->table('diagnosa_keperawatan_rme');
        $this->dt->where('diagnosa', $diagnosa);
        $this->dt->where('otec', 'KOLABORASI');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_cppt_perawat_ranap($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        //$this->dt->where('groups', 'IRI');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_cppt_all($referencenumber)
    {
        $this->dt = $this->db->table('resume_cppt_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_asesmen_perawat_igd_rme_view($referencenumber)
    {
        $tb = "asesmen_awal_perawatan_rj_rme";
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_asesmen_perawat_poli_rme_view($referencenumber)
    {
        $tb = "asesmen_awal_perawatan_rj_rme";
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }



    function get_data_pasien_ranap_rme_dokter($id)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_asesmen_perawat_ranap_rme_view($referencenumber)
    {
        $tb = "asesmen_awal_perawatan_rj_rme";
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'IRI');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_cppt_gos($search)
    {
        $this->dt = $this->db->table('cppt_simgos');
        $this->dt->like('pasienid', $search['norm'], 'after');
        $this->dt->orderBy('ID', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_rme_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_rme_ranap_pulang($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_resume_medis_rajal($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->where('groups', 'IRJ');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_cek_resume_medis_rajal($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->where('groups', 'IRJ');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_cek_resume_medis_rajalmobdan($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->where('groups', 'IRJ');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_cek_master_pasien($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_riwayat_resep_detail($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->where('journalnumber', $journalnumber);
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
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

    function kunjunganranap_pasienid($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->select(' journalnumber  , pasienid, doktername ');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function data_pasienid($pasienid)
    {
        $this->dt = $this->db->table('pasien');
        $this->dt->select(' religion  , code');
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataWLP()
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('admissionDate', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalWLP($search)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');

        $this->dt->where('admissionDate >=', $search['mulai']);
        $this->dt->where('admissionDate <=', $search['sampai']);

        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_list_kb()
    {
        $this->dt = $this->db->table('riwayat_kb_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_diagnosa_pra_bedah($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataibs_pasca_bedah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        //$this->dt->where('selesai', 1);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(400);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_ranap_rme_bedah($id)
    {
        $tb = "transaksi_pelayanan_rawatinap_operasi_header";
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->where('id', $id);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_ranap_rme_dokter_bedah($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_anesthesia()
    {
        $this->dt = $this->db->table('anesthesia_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_approach()
    {
        $this->dt = $this->db->table('approcah_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_capsulotomy()
    {
        $this->dt = $this->db->table('capsulotomy_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_nucleus()
    {
        $this->dt = $this->db->table('nucleus_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_phaco()
    {
        $this->dt = $this->db->table('phaco_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_iol()
    {
        $this->dt = $this->db->table('iol_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_stitch()
    {
        $this->dt = $this->db->table('stitch_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_perawat_katarak_rme()
    {
        $this->dt = $this->db->table('perawat_katarak_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataWLMDRajal()
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('admissionDate', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalWLMDRajal($search)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');

        $this->dt->where('admissionDate >=', $search['mulai']);
        $this->dt->where('admissionDate <=', $search['sampai']);

        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRJ');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataWLMDIgd()
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('admissionDate', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalWLMDIgd($search)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');

        $this->dt->where('admissionDate >=', $search['mulai']);
        $this->dt->where('admissionDate <=', $search['sampai']);

        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataWLPIgd()
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('admissionDate', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalWLPIgd($search)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');

        $this->dt->where('admissionDate >=', $search['mulai']);
        $this->dt->where('admissionDate <=', $search['sampai']);

        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataWLPRanap()
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRI');
        $this->dt->orderBy('admissionDate', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalWLPRanap($search)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');

        $this->dt->where('admissionDate >=', $search['mulai']);
        $this->dt->where('admissionDate <=', $search['sampai']);

        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRI');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataWLMDRanap()
    {
        $this->dt = $this->db->table('resume_cppt_rme');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'IRI');
        $this->dt->orderBy('admissionDate', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRajalWLMDRanap($search)
    {
        $this->dt = $this->db->table('resume_cppt_rme');

        $this->dt->where('admissionDate >=', $search['mulai']);
        $this->dt->where('admissionDate <=', $search['sampai']);

        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'IRI');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_ranap_rme_bedah_pra($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_lo_katarak($referencenumber)
    {
        $this->dt = $this->db->table('laporan_operasi_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('katarak', 1);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_lo($referencenumber)
    {
        $this->dt = $this->db->table('laporan_operasi_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('katarak', 0);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataibs_pra_bedah()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_rawatinap_operasi_header');
        $this->dt->where('selesai', 0);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(400);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_nutrisi_rme()
    {
        $this->dt = $this->db->table('status_nutrisi_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_konsul_rme()
    {
        $this->dt = $this->db->table('konsul_bedah_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_riwayat_rme()
    {
        $this->dt = $this->db->table('riwayat_terapi_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_resiko_rme()
    {
        $this->dt = $this->db->table('asesmen_resiko_jatuh_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_diagnosa_askep()
    {
        $this->dt = $this->db->table('diagnosa_keperawatan_rme');
        $this->dt->groupBy('diagnosa');
        $this->dt->distinct('diagnosa');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildataranap_pulang_exist()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('dateout', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_ranap_rme_dokter_pulang($id)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('id', $id);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_ranap_rme_pulang($referencenumber)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_ranap_rme_pulang_pjb($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_resume_medis_ranap($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_pulang_ranap_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_ranap_rme_akan_pulang($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_list_resume_penunjang_ranap_2($referencenumber)
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->notLike('classroom', 'IGD');
        $this->dt->notLike('classroom', 'IRJ');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_detail_resep_pulang($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_header.journalnumber=transaksi_farmasi_pelayanan_detail.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.signa1, transaksi_farmasi_pelayanan_detail.signa2, transaksi_farmasi_pelayanan_detail.qtypaket');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->where('transaksi_farmasi_pelayanan_header.terapiPulang', 1);
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_rme_rajal_resume($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_resume_medis_rajal($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'IRJ');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function kunjunganrajal_pasienid($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->select(' journalnumber  , pasienid, doktername ');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_rad_expertise($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('classroom', 'IRJ');
        $this->dt->where('types', 'RAD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_lpk_expertise($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('classroom', 'IRJ');
        $this->dt->where('types', 'LPK');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_ranap_rme_pulang_fix($id)
    {
        $tb = "transaksi_pelayanan_pulang_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');

        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_resume_medis_igd($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('groups', 'IGD');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_cek_resume_medis_igd($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->where('groups', 'IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_cek_resume_medis_igdmobdan($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_medis_rj_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->where('groups', 'IGD');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataradiologi()
    {

        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate', date('Y-m-d'));
        $this->dt->like('groups', 'RAD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterRadiologi($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['asalDaftar'] != "") {
            $this->dt->like('asalDaftar', $search['asalDaftar']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->like('groups', 'RAD');
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_penunjang($id)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_header');
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_penunjang_rajal($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_penunjang_ranap($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatinap";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_pasien_rajala_rme($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function search_header_pelayanan_rme_ranap($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('referencenumber', $journalnumber);
        $this->dt->where('groups', 'RI');
        $this->dt->where('qtylayan >', 0);
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function FARMASIRANAP($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select(' transaksi_farmasi_pelayanan_detail.journalnumber, transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.batchnumber, 
        transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket, transaksi_farmasi_pelayanan_detail.price, transaksi_farmasi_pelayanan_detail.subtotal ');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        //$this->dt->where('transaksi_farmasi_pelayanan_header.groups', 'RI');
        //$this->dt->groupBy('transaksi_farmasi_pelayanan_header.journalnumber');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_header.id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanHeader($id)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->select('journalnumber, pasienid, pasienname, paymentmethodname, documentdate, pasienaddress, pasienage, dateofbirth, pasiengender, poliklinik, poliklinikname, doktername');
        $this->dt->where('referencenumber', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function penjualanDetail($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.uom, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.expireddate, transaksi_farmasi_pelayanan_detail.price, 
        transaksi_farmasi_pelayanan_detail.subtotal, transaksi_farmasi_pelayanan_detail.qtypaket, transaksi_farmasi_pelayanan_detail.qtyluarpaket');
        $this->dt->where('transaksi_farmasi_pelayanan_header.referencenumber', $referencenumber);
        $this->dt->limit(200);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_sip_dokter($namaDokter)
    {
        $this->dt = $this->db->table('dokter');
        $this->dt->where('name', $namaDokter);
        $this->dt->orderBy('id');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function ambildataWLResumeMedis()
    {
        $this->dt = $this->db->table('asesmen_pulang_ranap_rme');
        $this->dt->where('created_at', date('Y-m-d'));
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RegisterResumeMedis($search)
    {
        $this->dt = $this->db->table('asesmen_pulang_ranap_rme');

        $this->dt->where('created_at >=', $search['mulai']);
        $this->dt->where('created_at <=', $search['sampai']);

        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        // if ($search['poli'] != "") {
        //     $this->dt->like('poliklinikname', $search['poli']);
        // }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_lpk_expertise_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);

        $this->dt->where('types', 'LPK');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_rad_expertise_ranap($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->where('referencenumber', $referencenumber);
        // $this->dt->where('classroom', 'IRJ');
        $this->dt->where('types', 'RAD');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_skin()
    {
        $this->dt = $this->db->table('skin_perparasi_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_jenisPembedahan()
    {
        $this->dt = $this->db->table('jenis_pembedahan_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_kamar_operasi()
    {
        $this->dt = $this->db->table('kamar_operasi_rme');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_lo_general($referencenumber)
    {
        $this->dt = $this->db->table('laporan_operasi_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('katarak', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_riwayat_resep_detail_join($journalnumber)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->join('obat_balance', 'obat_balance.code=transaksi_farmasi_pelayanan_detail.code', 'left');
        $this->dt->join('obat', 'obat_balance.code=obat.code', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name, obat.salesprice, SUM(obat_balance.balance)as balance, obat_balance.expireddate, obat_balance.batchnumber, obat_balance.locationcode, obat.uom,
        obat_balance.expireddate, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.eticket_carapakai');
        $this->dt->where('transaksi_farmasi_pelayanan_detail.journalnumber', $journalnumber);
        $this->dt->groupBy('obat_balance.code');
        $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function insert_banyak_data($data)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_detail');
        $this->dt->InsertBatch($data);
    }


    function search_RegisterigdMobDana($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');

        $this->dt->where('documentdate >=', $search['mulai']);
        $this->dt->where('documentdate <=', $search['sampai']);
        $this->dt->like('pasienname', $search['patientname'], 'after');
        $this->dt->like('pasienid', $search['norm'], 'after');
        if ($search['poli'] != "") {
            $this->dt->like('poliklinikname', $search['poli']);
        }
        if ($search['metodepembayaran'] != "") {
            $this->dt->like('paymentmethodname', $search['metodepembayaran']);
        }
        if ($search['statuspasien'] != "") {
            $this->dt->like('statuspasien', $search['statuspasien']);
        }
        $this->dt->like('groups', 'IGD');
        $this->dt->orderBy('id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_pasien_rajal_rme($referencenumber)
    {
        $tb = "transaksi_pelayanan_daftar_rawatjalan";
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatjalan');
        $this->dt->where('journalnumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_cek_resume_pulang_ranap($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_pulang_ranap_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_data_diagnosa_primer_skunder_rajal($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_rekammedik_rawatjalan_detail');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'asc');
        // $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_resep_detail_all($id2)
    {
        $asal = ['RJ', 'IGD', 'RI'];
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->join('transaksi_farmasi_pelayanan_detail', 'transaksi_farmasi_pelayanan_detail.journalnumber=transaksi_farmasi_pelayanan_header.journalnumber', 'left');
        $this->dt->select('transaksi_farmasi_pelayanan_detail.code, transaksi_farmasi_pelayanan_detail.name, transaksi_farmasi_pelayanan_detail.qty, transaksi_farmasi_pelayanan_detail.signa1, transaksi_farmasi_pelayanan_detail.signa2, transaksi_farmasi_pelayanan_header.referencenumber, transaksi_farmasi_pelayanan_header.journalnumber,
        transaksi_farmasi_pelayanan_detail.journalnumber');
        $query = $this->dt->whereIn('transaksi_farmasi_pelayanan_header.referencenumber', $id2);
        $query = $this->dt->whereIn('transaksi_farmasi_pelayanan_header.groups', $asal);
        $query = $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $query = $this->dt->orderBy('transaksi_farmasi_pelayanan_detail.id', 'ASC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function search_RiwayatPasien_resep($pasienid)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('pasienid', $pasienid);
        $query = $this->dt->where('transaksi_farmasi_pelayanan_header.qtylayan >', 0);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_cppt_edit($id)
    {
        $this->dt = $this->db->table('resume_cppt_rme');
        $this->dt->select('id, s, o, a, p');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_cppt_edit_rajal($id)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rj_rme');
        $this->dt->select('id, keluhanUtama, o, a, p');
        $this->dt->where('id', $id);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function update_cppt_edit($id, $data)
    {
        $this->dt = $this->db->table('resume_cppt_rme');
        $this->dt->where('id', $id);
        return $this->dt->update($data);
    }

    function radiologi_rme($referencenumber)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_penunjang_detail');
        $this->dt->select('transaksi_pelayanan_penunjang_detail.id, transaksi_pelayanan_penunjang_detail.name, transaksi_pelayanan_penunjang_detail.types, transaksi_pelayanan_penunjang_detail.referencenumber, transaksi_pelayanan_penunjang_detail.expertiseid, transaksi_pelayanan_penunjang_detail.documentdate, transaksi_pelayanan_penunjang_detail.relationname, transaksi_pelayanan_penunjang_detail.pasiengender, transaksi_pelayanan_penunjang_detail.pasiendateofbirth, transaksi_pelayanan_penunjang_detail.paymentmethod, transaksi_pelayanan_penunjang_detail.pasienaddress, transaksi_pelayanan_penunjang_detail.roomname, transaksi_pelayanan_penunjang_detail.relation, transaksi_pelayanan_penunjang_detail.doktername, transaksi_pelayanan_penunjang_detail.employeename, transaksi_pelayanan_penunjang_expertise.expertise, transaksi_pelayanan_penunjang_expertise.expertiseid, transaksi_pelayanan_penunjang_expertise.idPenunjangDetail, transaksi_pelayanan_penunjang_expertise.klinis, transaksi_pelayanan_penunjang_expertise.createddate');
        $this->dt->join('transaksi_pelayanan_penunjang_expertise', 'transaksi_pelayanan_penunjang_expertise.idPenunjangDetail=transaksi_pelayanan_penunjang_detail.id');
        $this->dt->where('transaksi_pelayanan_penunjang_detail.types', 'RAD');
        $this->dt->where('transaksi_pelayanan_penunjang_detail.referencenumber', $referencenumber);
        $query = $this->dt->get()->getResultArray();

        // Loop e resep header
        // foreach($query as $i=>$header) {
        //     $this->dt = $this->db->table('transaksi_pelayanan_penunjang_expertise');
        //     $this->dt->where('idPenunjangDetail', $header['id']);
        //     $detail_query = $this->dt->get()->getResultArray();
        //     $query[$i]['expertise'] = $detail_query;
        // }

        return $query;
    }

    function caridataranap_pulang_exist($search)
    {
        $this->dt = $this->db->table('transaksi_pelayanan_pulang_rawatinap');
        if ($search['norm'] != "") {
            $this->dt->like('pasienid', $search['norm'], 'both');
        }
        if ($search['name'] != "") {
            $this->dt->like('pasienname', $search['name'], 'both');
        }
        if ($search['dpjp'] != "") {
            $this->dt->like('doktername', $search['dpjp']);
        }
        if ($search['dateOut'] != "") {
            $this->dt->where('dateout >=', $search['mulai']);
            $this->dt->where('dateout <=', $search['sampai']);
        }
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_data_cek_farmasi_pulang_rme($referencenumber, $groups)
    {
        $this->dt = $this->db->table('transaksi_farmasi_pelayanan_header');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->where('terapiPulang', '1');
        $this->dt->where('groups', $groups);
        $this->dt->orderBy('id', 'DESC');
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_data_header_penunjang_baru($id)
    {
        $tb = "transaksi_pelayanan_penunjang_header";
        $this->dt = $this->db->table($tb);
        $this->dt->where('id', $id);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }
    function get_data_nik($pasienid)
    {
        $tb = "pasien";
        $this->dt = $this->db->table($tb);
        $this->dt->where('code', $pasienid);
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getRowArray();
    }

    function get_list_umur()
    {
        $this->dt = $this->db->table('umuranak_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_jeniskelaminanak()
    {
        $this->dt = $this->db->table('jeniskelaminanak_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_diagnosisanak()
    {
        $this->dt = $this->db->table('diagnosisanak_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_gangguankognitif()
    {
        $this->dt = $this->db->table('gangguankognitif_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_faktorlingkungan()
    {
        $this->dt = $this->db->table('faktorlingkungan_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_responobatanak()
    {
        $this->dt = $this->db->table('responobatanak_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function get_list_penggunaanobat()
    {
        $this->dt = $this->db->table('penggunaanobatanak_rme');
        $this->dt->orderBy('id');
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

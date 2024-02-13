<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelAsesmenPasienPulangRME extends Model
{

    protected $table      = 'asesmen_pulang_ranap_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'doktername', 'createdBy',
        'createddate', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifikator', 'pasiendateofbirth', 'pasienage', 'diagnosisMasuk', 'lastRoom', 'dateIn', 'dateOut',
        'namaPjb', 'alasanRawat', 'pemeriksaanPenunjang', 'terapiSelamaRawat', 'perkembanganSetelahPerawatan', 'alergiObat', 'kondisiWaktuKeluar', 'pengobatanDilanjutkan',
        'tanggalKontrol', 'diagnosisUtama', 'diagnosisSekunder', 'prosedur', 'ringkasanRiwayatPenyakit', 'hasilPemeriksaanFisik'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;


use CodeIgniter\Model;


class ModelPelayananPoliRMETRansfer extends Model
{

    protected $table      = 'transfer_pasien_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'doktername', 'bb', 'tb', 'frekuensiNadi', 'tdSistolik', 'tdDiastolik',
        'suhu', 'frekuensiNafas', 'skalaNyeri', 'created_at', 'updated_at', 'createdBy', 'paramedicName', 'createddate', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifikator', 'spo2', 'eye', 'verbal', 'motorik',
        'totalGcs', 'admissionDateTime', 'pindahDate', 'pindahDateTime', 'keluhanUtama', 'riwayatPenyakitSekarang', 'riwayatAlergi', 'uraianAlergi', 'pemeriksaanFisik', 'kesadaran', 'diagnosa', 'dariRuang',
        'ruangTujuan', 'indikasiRawat', 'keadaanUmum', 'alasanTransfer', 'hasilPenunjang', 'prosedur', 'obat', 'lain_lain', 'keadaanUmumPindah', 'bbPindah', 'tbPindah', 'frekuensiNadiPindah', 'tdSistolikPindah', 'tdDiastolikPindah',
        'suhuPindah', 'frekuensiNafasPindah', 'spo2Pindah', 'tinggiFundusUteriPindah', 'kontraksiUterusPindah', 'janin', 'perdarahan', 'diet', 'mobilisasi', 'dekubitus', 'nyeri', 'jatuh', 'alergi',
        'phlebitis', 'ain_lainPindah', 'uraianLain', 'ngt', 'folley', 'chest', 'ett', 'alat_transport', 'derajatPasien', 'petugasPendamping',
        'keadaanUmumTiba', 'totalGcsTiba', 'bbTiba', 'tbTiba', 'frekuensiNadiTiba', 'tdSistolikTiba', 'tdDiastolikTiba', 'suhuTiba', 'frekuensiNafasTiba', 'spo2Tiba', 'tinggiFundusUteriTiba', 'kontraksiUterusTiba',
        'janinTiba', 'perdarahanTiba', 'paramedicNamePemindah', 'paramedicNamePenerima', 'status', 'acceptDateTime'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

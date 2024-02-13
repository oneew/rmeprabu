<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelLaporanOperasiRME extends Model
{

    protected $table      = 'laporan_operasi_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'doktername', 'createdBy',
        'createddate', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifikator', 'diagnosis', 'dokterOperator', 'dokterAnestesi', 'tindakanOperasi', 'od', 'os', 'cataractGrade', 'noteOp', 'ucva', 'bcva','retinometry', 'k1', 'k2', 'axl', 'acd', 'lt', 'formula', 'emetropia', 'visus', 'typeOperasi', 'intraOperativeDate', 'intraOperativeTime', 'anesthesilogist', 'scrub', 'cukator', 'anestehesia', 'approach', 'capsulotomy', 'hydrodissection', 'nucleus', 'phaco', 'iol', 'stitch', 'phacoMachine', 'phacoTime', 'irigatingSolution', 'komplikasi', 'posterior', 'vitreus', 'vitrectomy', 'retained', 'cortex', 'katarak', 'cito', 'elektif', 'asalRuangan', 'kamarOperasi', 'smfName', 'perawatAnestesi', 'scrubNurse', 'asisten1', 'asisten2', 'circulationNurse', 'posisiOperasi', 'jenisSayatan', 'skinPerparasi', 'jenisPembedahan', 'diagnosaPraBedah','indikasiOperasi', 'jenisOperasi', 'diagnosaPascaBedah', 'startDateTimeOp', 'stopDateTimeOp', 'lamaOperasi', 'jaringanSpesimenOperasi', 'jaringanSpesimenAspirasi', 'jaringanSpesimenkaterisasi', 'lokalisasi', 'dikirimPA', 'profilaksisAntibiotik', 'jamPemberian', 'laporanJalanOperasi', 'komplikasiPascaBedah', 'jumlahPerdarahan', 'transfusiDarah', 'pcr', 'wb', 'jumlahPcrWb', 'jenisInplan', 'noRegInplan', 'skriningNurse', 'prosedurOp'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

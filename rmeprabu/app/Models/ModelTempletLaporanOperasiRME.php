<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelTempletLaporanOperasiRME extends Model
{

    protected $table      = 'templet_laporan_operasi_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama', 'updated_at', 'created_by', 'updated_by', 'diagnosis', 'dokterOperator', 'dokterAnestesi', 'tindakanOperasi', 'od', 'os', 'cataractGrade', 'noteOp', 'ucva', 'bcva','retinometry', 'k1', 'k2', 'axl', 'acd', 'lt', 'formula', 'emetropia', 'visus', 'typeOperasi', 'intraOperativeDate', 'intraOperativeTime', 'anesthesilogist', 'scrub', 'cukator', 'anestehesia', 'approach', 'capsulotomy', 'hydrodissection', 'nucleus', 'phaco', 'iol', 'stitch', 'phacoMachine', 'phacoTime', 'irigatingSolution', 'komplikasi', 'posterior', 'vitreus', 'vitrectomy', 'retained', 'cortex', 'katarak', 'cito', 'elektif', 'asalRuangan', 'kamarOperasi', 'smfName', 'perawatAnestesi', 'scrubNurse', 'asisten1', 'asisten2', 'circulationNurse', 'posisiOperasi', 'jenisSayatan', 'skinPerparasi', 'jenisPembedahan', 'diagnosaPraBedah','indikasiOperasi', 'jenisOperasi', 'diagnosaPascaBedah', 'startDateTimeOp', 'stopDateTimeOp', 'lamaOperasi', 'jaringanSpesimenOperasi', 'jaringanSpesimenAspirasi', 'jaringanSpesimenkaterisasi', 'lokalisasi', 'dikirimPA', 'profilaksisAntibiotik', 'jamPemberian', 'laporanJalanOperasi', 'komplikasiPascaBedah', 'jumlahPerdarahan', 'transfusiDarah', 'pcr', 'wb', 'jumlahPcrWb', 'jenisInplan', 'noRegInplan', 'skriningNurse', 'prosedurOp'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;


use CodeIgniter\Model;


class ModelPelayananPoliRMEMonitoring extends Model
{

    protected $table      = 'monitoring_perawat_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'doktername', 'bb', 'tb', 'frekuensiNadi', 'tdSistolik',
        'suhu', 'frekuensiNafas', 'skalaNyeri', 'created_at', 'updated_at', 'createdBy', 'paramedicName', 'createddate', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifikator', 'spo2', 'eye', 'verbal', 'motorik',
        'totalGcs', 'admissionDateTime', 'executionDate', 'executionDateTime', 'kesadaran', 'diagnosa', 'pemberianOral', 'pemberianParental', 'pemberianNgt',
        'pemberianObat', 'muntah', 'drain', 'iwl', 'perdarahan', 'urin', 'balance', 'diuresis', 'kontraksiUterus', 'durasi', 'intensitas',
        'periksaDalam', 'pervaginam', 'janin', 'tinggiPundusUteri'

    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

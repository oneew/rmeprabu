<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;


use CodeIgniter\Model;


class ModelCPPTRME extends Model
{

    protected $table      = 'resume_cppt_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'doktername', 'bb', 'tb', 'frekuensiNadi', 'tdSistolik',
        'suhu', 'frekuensiNafas', 'skalaNyeri', 'createdBy', 'createddate', 'paramedicName', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifikator', 'spo2', 'eye', 'verbal', 'motorik', 'totalGcs',
        'admissionDateTime', 's', 'o', 'a', 'p', 'kelompokCppt', 'cpptGenerik', 'intruksiPPA'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

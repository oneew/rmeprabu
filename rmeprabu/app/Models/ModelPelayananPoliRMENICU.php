<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelPelayananPoliRMENICU extends Model
{

    protected $table      = 'transfer_pasien_nicu_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'admissionDateTime', 'doktername', 'createdBy',
        'createddate', 'paramedicName', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifkator', 'acceptDatetTime', 'kondisi1', 'kondisi2', 'kondisi3', 'diagnosis', 'riwayatPemeriksan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelPelayananPoliRMEEdukasiPraBedah extends Model
{

    protected $table      = 'edukasi_pra_bedah_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'admissionDateTime', 'doktername', 'createdBy',
        'createddate', 'paramedicName', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifkator', 'diagnosis', 'dokterOperator', 'pemberInformasi',
        'penerimaInformasi', 'kondisiPasien', 'tindakan', 'manfaatTindakan', 'uraianProsedur', 'risikoTindakan', 'komplikasiTindakan', 'dampakTindakan', 'prognosisTindakan',
        'alternatifTindakan', 'bilaTidakDitindak'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

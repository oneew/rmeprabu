<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;


use CodeIgniter\Model;


class ModelPelayananPoliHDRMEMonitoring extends Model
{

    protected $table      = 'monitoring_perawathd_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups', 'registernumber', 'referencenumber', 'pasienid', 'pasienname', 'poliklinikname', 'paymentmethodname', 'admissionDate', 'doktername', 'frekuensiNadi', 'tdSistolik',
        'suhu', 'frekuensiNafas', 'skalaNyeri', 'created_at', 'updated_at', 'createdBy', 'paramedicName', 'createddate', 'verifikasiDPJP', 'tanggalJamVerifikasi', 'verifikator',
        'muntah', 'drain', 'iwl', 'perdarahan', 'urin', 'balance', 'diuresis', 'kontraksiUterus', 'durasi', 'intensitas',
        'monitoring_qb', 'monitoring_uf', 'monitoring_Nacl', 'monitoring_dext', 'monitoring_Mkn', 'monitoring_Lain', 'monitoring_UFVolume', 'KeteranganUF', 'monitoring_jumlah', 'monitoring_hd',
        'monitoring_diagnosa', 'monitoring_TotalUF', 'akses', 'Fisuse', 'headache', 'kram', 'hipotensi', 'nyeridada', 'hipertensi', 'gatal', 'demam', 'dingin', 'Lainya',

    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    function get_cppt_perawat($referencenumber)
    {
        $this->dt = $this->db->table('asesmen_awal_perawatan_rjhd_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1);
        $query = $this->dt->get();
        return $query->getResultArray();
    }


    function get_monitoring($referencenumber)
    {
        $this->dt = $this->db->table('monitoring_perawathd_rme');
        $this->dt->where('referencenumber', $referencenumber);
        $this->dt->orderBy('id', 'DESC');

        $query = $this->dt->get();
        return $query->getResultArray();
    }
}

<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;


use CodeIgniter\Model;


class ModelPelayananPoliHDRME extends Model
{

    protected $table      = 'asesmen_awal_perawatan_rjhd_rme';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'groups',
        'registernumber',
        'referencenumber',
        'admissionDate',
        'admissionDateTime',
        'doktername',
        'paramedicName',
        'nomesin',
        'hdke',
        'pasienid',
        'diagnosahd',
        'tipeDL',
        'tipedialiser',
        'Pasienname',
        'Alergi',
        'uraianAlergi',
        'keluhanUtama',
        'kesadaran',
        'riwayatPenyakitSekarang',
        'riwayatPenyakitKeluarga',
        'riwayatPenyakitDahulu',
        'riwayatPenggunaanObat',
        'bb',
        'tb',
        'frekuensiNadi',
        'tdSistolik',
        'tdDiastolik',
        'suhu',
        'frekuensiNafas',
        'bbprehd',
        'Konjugtiva',
        'Ektremitas',
        'bbkering',
        'bbposthd',
        'akvaskular',
        'hdkateter1',
        'avalinya',
        'fungsionalRiwayatJatuh',
        'diagnosisSekunder',
        'alatBantuBerjalan',
        'heparin',
        'mobilisasi',
        'statusMental',
        'kriteriaHasil',
        'tglgizi',
        'misscore',
        'kesimpulannutrisi',
        'rujukAhliGizi',
        'Psikososial',
        'Komunikasi',
        'uraianKomunikasi',
        'merawat',
        'uraianmerawat',
        'kondisi',
        'tdmedik',
        'QB',
        'QD',
        'UFG',
        'Profiling',
        'UF',
        'Bicarbonat',
        'Asetat',
        'DLBicarbonat',
        'Condativity',
        'Temperatur',
        'Sirkulasi',
        'Heparinisasiawal',
        'Continue',
        'Intermitten',
        'LMWH',
        'TpHeparin',
        'DiagnosaAskep',
        'sasaranRencana',
        'uraianAskep',
        'created_at',
        'updated_at',
        'verifikasiDPJP',
        'tanggalJamVerifikasi',
        'verifikator',
        'paymentmethodname',
        'poliklinikname',
        'createdBy',
        'createddate',
        'PenggunaanObat',

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
}

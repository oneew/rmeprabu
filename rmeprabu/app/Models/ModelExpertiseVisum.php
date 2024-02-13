<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelExpertiseVisum extends Model
{

    protected $table      = 'admission_visum_igd';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'referencenumber', 'documentdate', 'pasienid', 'pasienname', 'pasiengender', 'pasiendateofbirth', 'pasienreligion', 'pasienCitizenship', 'pasienWork', 'pasienaddress',
        'permintaanDari', 'noPermintaan', 'tglPermintaan', 'tglterimaPermintaan', 'doktername1', 'doktername2', 'keadaanDatang', 'keadaanUmum', 'pengakuanKorban',
        'tekananDarah', 'frekuensiNadi', 'frekuensiNafas', 'suhu', 'korbanDitemukan', 'korbanDilakukan', 'statusKorban', 'kesimpulan', 'created_at', 'updated_at',
        'created_by', 'updated_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function ubah_expertise($expertiseid, $simpandata)
    {
        $this->dt = $this->db->table('admission_visum_igd');
        $this->dt->where('journalnumber', $expertiseid);
        $this->dt->update($simpandata);
    }
}

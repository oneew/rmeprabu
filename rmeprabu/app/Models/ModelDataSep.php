<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;

use CodeIgniter\Model;


class ModelDataSep extends Model
{

    protected $table      = 'dataSep';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'pelayanan', 'journalnumber', 'referencenumber', 'norm', 'catatan', 'diagnosa', 'jnsPelayanan', 'kelasRawat', 'noSep', 'penjamin', 'asuransi', 'hakKelas', 'jnsPeserta', 'kelamin',
        'nama', 'noKartu', 'tglLahir', 'dinsos', 'prolanisPRB', 'noSKTM', 'poli', 'poliEksekutif', 'tglSep', 'asalRujukan', 'tglRujukan', 'noRujukan', 'ppkRujukan',
        'lakaLantas', 'tglKejadian', 'suplesi', 'noSuplesi', 'kdPropinsi', 'kdKabupaten', 'kdKecamatan', 'created_at', 'upadted_at', 'createdby', 'noTelp', 'cob', 'katarak', 'keterangan', 'updatedBy',
        'noTelp', 'cob', 'katarak', 'keterangan', 'statusPulang', 'noSuratMeninggal', 'tglMeninggal', 'tglPulang', 'noLPManual', 'userSepPulang', 'pembiayaan', 'penanggungJawab', 'tujuanKunj',
        'flagProcedure', 'kdPenunjang', 'dpjpLayan', 'assesmentPel', 'jenislakaLantas', 'kodeDPJP', 'kunjunganke', 'faskesPerujuk'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    function update_dataSep($noSep, $simpandata)
    {
        $this->dt = $this->db->table('dataSep');
        $this->dt->where('noSep', $noSep);
        $this->dt->update($simpandata);
    }
}

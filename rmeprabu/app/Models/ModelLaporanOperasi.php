<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLaporanOperasi extends Model
{

    protected $table      = 'laporan_operasi';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'journalnumber', 'ruang', 'pasiendateofbirth', 'pasiengender', 'pasienname', 'pasienid', 'operatorroom', 'tanggaloperasi', 'cases', 'ibsdoktername',
        'ibsanestesiname', 'perawatinstrumen', 'penataanestesi', 'jenisanestesi', 'obatanestesi', 'obatanestesi', 'diagnosaprabedah', 'diagnosapascabedah', 'indikasioperasi',
        'jenisoperasi', 'disinfeksikulit', 'eksisi', 'pa', 'lab', 'mulaioperasi', 'selesai', 'durasi', 'jumlahpendarahan', 'transfusi', 'prc', 'wb', 'jalanoperasi',
        'signature_dokteroperator', 'jenisbahan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelranap extends Model
{

    protected $table      = 'transaksi_pelayanan_daftar_rawatinap';
    protected $primaryKey = 'id';




    //protected $allowedFields = ['nama', 'jabatan', 'kelompok', 'tanggal_lahir'];

    protected $useTimestamps = true;
    //protected $createdField  = 'created_at';
    //protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        // $builder = $this->table('transaksi_pelayanan_daftar_rawatinap_sementara');
        // $builder->like('pasienid', $keyword);
        // return $builder;

        return $this->table('transaksi_pelayanan_daftar_rawatinap')
            ->where('statusrawatinap', 'RAWAT')
            ->like('pasienid', $keyword)
            ->orLike('smfname', $keyword);
    }
}

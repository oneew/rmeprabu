<?php
if (! function_exists('radiologi_detail')) {
    function radiologi_detail($journalnumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi_pelayanan_penunjang_detail')
                    ->select('journalnumber, name')
                    ->where('journalnumber', $journalnumber)
                    ->get()
                    ->getResultArray();

        if ($builder == null) {
            return 'TIDAK ADA PEMERIKSAAN';
        }
        return $builder;

    }
}
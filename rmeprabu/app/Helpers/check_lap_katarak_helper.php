<?php
if (! function_exists('check_lap_katarak')) {
    function check_lap_katarak($referencenumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('laporan_operasi_rme')
                    ->select('referencenumber')
                    ->where('referencenumber', $referencenumber)
                    ->where('katarak', '1')
                    ->get()
                    ->getResultArray();
                    
        if ($builder != null) {
            return 'ADA';
        }

        return 'TIDAK ADA';
    }
}
<?php
if (! function_exists('check_lap_ibs')) {
    function check_lap_ibs($referencenumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('laporan_operasi_rme')
                    ->select('referencenumber')
                    ->where('referencenumber', $referencenumber)
                    ->where('katarak', '0')
                    ->get()
                    ->getResultArray();
                    
        if ($builder != null) {
            return 'ADA';
        }

        return 'TIDAK ADA';
    }
}
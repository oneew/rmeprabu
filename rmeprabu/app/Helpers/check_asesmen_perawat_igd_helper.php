<?php
if (! function_exists('check_asesmen_perawat_igd')) {
    function check_asesmen_perawat_igd($journalnumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('asesmen_awal_perawatan_rj_rme')
                    ->select('referencenumber, groups')
                    ->where('referencenumber', $journalnumber)
                    ->where('groups', 'IGD')
                    ->get()
                    ->getResultArray();
                    
        if ($builder != null) {
            return 'SUDAH DIISI';
        }

        return 'BELUM DIISI';
    }
}
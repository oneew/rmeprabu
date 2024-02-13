<?php
if (! function_exists('check_resume_igd')) {
    function check_resume_igd($journalnumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('asesmen_awal_medis_rj_rme')
                    ->select('referencenumber')
                    ->where('referencenumber', $journalnumber)
                    ->get()
                    ->getResultArray();
                    
        if ($builder != null) {
            return 'ADA';
        }

        return 'TIDAK ADA';
    }
}
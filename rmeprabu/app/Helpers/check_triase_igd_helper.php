<?php
if (! function_exists('check_triase_igd')) {
    function check_triase_igd($referencenumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('asesmen_triase_igd_rme')
                    ->select('referencenumber')
                    ->where('referencenumber', $referencenumber)
                    ->get()
                    ->getResultArray();
                    
        if ($builder != null) {
            return 'ADA';
        }

        return 'TIDAK ADA';
    }
}
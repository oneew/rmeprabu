<?php
if (! function_exists('check_obat_racikan')) {
    function check_obat_racikan($journalnumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('farmasi_obat_racikan_rme')
                    ->select('id, journalnumber, description')
                    ->where('journalnumber', $journalnumber)
                    ->get()
                    ->getResultArray();
                    
        if ($builder != null) {
            return $builder;
        }

        return 'TIDAK ADA';
    }
}
<?php
if (! function_exists('check_resume_ranap')) {
    function check_resume_ranap($referencenumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('asesmen_pulang_ranap_rme')
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
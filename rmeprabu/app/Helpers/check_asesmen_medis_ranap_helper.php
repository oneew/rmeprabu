<?php
if (!function_exists('check_asesmen_medis_ranap')) {
    function check_asesmen_medis_ranap($referencenumber)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('asesmen_awal_medis_rj_rme')
            ->select('referencenumber, groups')
            ->where('referencenumber', $referencenumber)
            ->where('groups', 'IRI')
            ->get()
            ->getResultArray();

        if ($builder != null) {
            return 'SUDAH DIISI';
        }

        return 'BELUM DIISI';
    }
}

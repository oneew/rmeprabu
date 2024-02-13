<?php
if (! function_exists('cari_nip_dokter')) {
    function cari_nip_dokter($doktername)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter')
                    ->select('nip, name')
                    ->where('name', $doktername)
                    ->limit(1)
                    ->get()
                    ->getRow();

        if ($builder != null) {
            return $builder->nip;
        }

        return null;
    }
}
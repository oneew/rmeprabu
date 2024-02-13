<?php
if (! function_exists('cari_sip_dokter')) {
    function cari_sip_dokter($doktername)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('dokter')
                    ->select('sip, name')
                    ->where('name', $doktername)
                    ->limit(1)
                    ->get()
                    ->getRow();

        if ($builder != null) {
            return $builder->sip;
        }

        return null;
    }
}
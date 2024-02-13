<?php
if (! function_exists('get_data_penunjang')) {
    function get_data_penunjang($classroom_data, $kelompok, $types)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pelayanan_tarif_penunjang')
                    ->select('id, name, price, code, groups, groupname, category, categoryname, expertisegroup, bhp, share1, share2, kelompokLab')
                    ->where('classroom', $classroom_data)
                    ->where('kelompokLab', $kelompok)
                    ->like('types', $types)
                    ->get()
                    ->getResultArray();

        if ($builder != null) {
            return $builder;
        }

        return null;
    }
}
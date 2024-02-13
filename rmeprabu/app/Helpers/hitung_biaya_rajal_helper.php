<?php

use App\Models\ModelTNODetail;

if (! function_exists('hitung_biaya_rajal')) {
    function hitung_biaya_rajal($referencenumber)
    {
        $db      = \Config\Database::connect();
        $builder =  $db->table('transaksi_kasir_rawatjalan')
            ->select('referencenumber, subtotal, paymentamount, nominaldebet')
            ->where('referencenumber', $referencenumber)
            ->limit(1)
            ->get()
            ->getResultArray();

        if ($builder != null) {
            $row = $builder[0];
            $total = $row['paymentamount'] + $row['nominaldebet'];
            $rupiah=number_format(round($total),0,',','.');
            return 'Rp. ' . $rupiah;
        }

        return 'Belum Validasi Kasir';
    }
}
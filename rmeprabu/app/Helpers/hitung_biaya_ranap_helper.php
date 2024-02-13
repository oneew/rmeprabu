<?php

use App\Models\ModelTNODetail;

if (! function_exists('hitung_biaya_ranap')) {
    function hitung_biaya_ranap($referencenumber)
    {
        $db      = \Config\Database::connect();
        $builder =  $db->table('transaksi_pelayanan_kasir_rawatinap')
            ->select('referencenumber, totalvisite, totaltindakanruang, totalpenunjang, totalbhppenunjang, totalfarmasi, totalbhptindakanruang, totalkamar, totaltindakanoperasi, totalmakan')
            ->where('referencenumber', $referencenumber)
            ->notLike('validationnumber', 'PBTN')
            ->limit(1)
            ->get()
            ->getResultArray();

        if ($builder != null) {
            $row = $builder[0];
            $visite_tindakan = $row['totalvisite'] + $row['totaltindakanruang'];
            $penunjang = $row['totalpenunjang'] + $row['totalbhppenunjang'];
            $farmasi = $row['totalfarmasi'] + $row['totalbhptindakanruang'];
    
            $totalRANAP = abs($row['totalkamar']) + $visite_tindakan + $penunjang + $farmasi + abs($row['totaltindakanoperasi']) + abs($row['totalmakan']);

            $rupiah=number_format($totalRANAP,0,',','.');
            return 'Rp. ' . $rupiah;
        }

        return 'Belum Validasi Kasir';
    }
}
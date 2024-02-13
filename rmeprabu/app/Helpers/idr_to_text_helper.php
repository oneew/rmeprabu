<?php
if (! function_exists('idr_to_text')) {
    function penyebut2($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = penyebut2($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = penyebut2($nilai / 10) . " puluh" . penyebut2($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . penyebut2($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut2($nilai / 100) . " ratus" . penyebut2($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . penyebut2($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut2($nilai / 1000) . " ribu" . penyebut2($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut2($nilai / 1000000) . " juta" . penyebut2($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut2($nilai / 1000000000) . " milyar" . penyebut2(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut2($nilai / 1000000000000) . " trilyun" . penyebut2(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    function idr_to_text($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(penyebut2($nilai));
        } else {
            $hasil = trim(penyebut2($nilai));
        }
        return $hasil;
    }
}
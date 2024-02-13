<?php
if (! function_exists('hitung_umur')) {
    function hitung_umur($tanggallahir)
    {
        $dob = strtotime($tanggallahir);
        $current_time = time();
        $age_years = date('Y', $current_time) - date('Y', $dob);
        $age_months = date('m', $current_time) - date('m', $dob);
        $age_days = date('d', $current_time) - date('d', $dob);

        if ($age_days < 0) {
            $days_in_month = date('t', $current_time);
            $age_months--;
            $age_days = $days_in_month + $age_days;
        }

        if ($age_months < 0) {
            $age_years--;
            $age_months = 12 + $age_months;
        }

        return $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
    }
}
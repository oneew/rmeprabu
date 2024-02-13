<?php
if (! function_exists('hitung_usia_by_doc')) {
    function hitung_usia_by_doc($tanggallahir, $tanggaldocument, $length)
    {
        $dob = strtotime($tanggallahir);
        $current_time = strtotime($tanggaldocument);
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

        if ($length == 1) {
            return $age_years . " Thn";
        }

        if ($length == 2) {
            return $age_years . " Thn " . $age_months . " Bln ";
        }

        if ($length == 3) {
            return $age_years . " Thn " . $age_months . " Bln " . $age_days . " H";
        }
    }
}
<?php

namespace App\Controllers;

use App\Models\ModelChartPasien;

class Abie extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Halaman Login |.:: SIMRS'
        ];

        //return view('login/index', $data);
    }

    public function HalamanUtama()
    {
        //$date = date('Y-m-d');
        $date = "2016-12-01";

        $m_chart = new ModelChartPasien();
        $list_pasien = $m_chart->get_list_pasien($date);
        //$list_payment = $m_chart->get_list_payment();

        $data['pasien'] = json_encode($this->_chart_pasien_hari_ini2($list_pasien));
        $data['pasien_gender'] = json_encode($this->_pasien_gender($list_pasien));


        return view('dashboard/index', $data);
    }

    private function _chart_pasien_hari_ini($list_pasien, $list_payment)
    {

        foreach ($list_payment as $i => $payment) {
            $chart_pasien[$i]['name'] = $payment['paymentmethod'];
            $chart_pasien[$i]['list'] = null;
            foreach ($list_pasien as $pasien) {
                if ($pasien['paymentmethod'] == $payment['paymentmethod']) {
                    $chart_pasien[$i]['list'][] = $pasien['id'];
                }
            }
            $chart_pasien[$i]['count'] = ($chart_pasien[$i]['list'] != null) ? count($chart_pasien[$i]['list']) : 0;
        }

        return $chart_pasien;
    }


    private function _chart_pasien_hari_ini2($list_pasien)
    {
        $list_payment = ['BANSOS', 'JAMKESDA KOTA', 'JAMKESDA KAB', 'JASMPERSAL', 'JKN', 'NOTA', 'TUNAI'];
        foreach ($list_payment as $i => $payment) {
            $chart_pasien[$i]['name'] = $payment;
            $chart_pasien[$i]['list'] = null;
            foreach ($list_pasien as $pasien) {
                // dirubah kondisinya
                if (stripos($pasien['paymentmethod'], $payment) === 0) {
                    $chart_pasien[$i]['list'][] = $pasien['id'];
                }
            }
            $chart_pasien[$i]['count'] = ($chart_pasien[$i]['list'] != null) ? count($chart_pasien[$i]['list']) : 0;
        }

        return $chart_pasien;
    }


    private function _pasien_gender($list_pasien)
    {
        $list_gender = ['L', 'P'];

        foreach ($list_gender as $i => $gender) {
            $chart_pasien[$i]['name'] = $gender;
            $chart_pasien[$i]['list'] = null;
            foreach ($list_pasien as $pasien) {
                if ($pasien['pasiengender'] == $gender) {
                    $chart_pasien[$i]['list'][] = $pasien['id'];
                }
            }
            $chart_pasien[$i]['count'] = ($chart_pasien[$i]['list'] != null) ? count($chart_pasien[$i]['list']) : 0;
        }

        return $chart_pasien;
    }
}

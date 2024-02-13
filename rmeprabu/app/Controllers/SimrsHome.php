<?php

namespace App\Controllers;

use App\Models\ModelChartPasien;

class SimrsHome extends BaseController
{
    public function index()
    {
        $data = [
            'tittle' => 'Halaman Login |.:: SIMRS'
        ];
    }

    public function HomeSimrs()
    {

        $data = '1';

        return view('dashboard/index');
    }

    public function HomeSimrsAsli()
    {

        $date = date('Y-m-d');
        $bulan = date('n');
        $tahun = date('Y');
        $m_chart = new ModelChartPasien();
        $list_pasien = $m_chart->get_list_pasien($date);
        $nilairajal = $m_chart->get_pendapatan_rajal($bulan, $tahun);
        $nilaiigd = $m_chart->get_pendapatan_igd($bulan, $tahun);
        $nilairanap = $m_chart->get_pendapatan_ranap($bulan, $tahun);
        $incomerajal = $nilairajal['jumlahrajal'];
        $incomeigd = $nilaiigd['jumlahigd'];
        $incomeranap = $nilairanap['jumlahranap'];

        $data['pendapatanrajal'] = $incomerajal;
        $data['pendapatanigd'] = $incomeigd;
        $data['pendapatanranap'] = $incomeranap;
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
        $list_payment = ['BANSOS', 'JAMKESDA', 'JASMPERSAL', 'JKN', 'NOTA', 'TUNAI'];
        foreach ($list_payment as $i => $payment) {
            $chart_pasien[$i]['name'] = $payment;
            $chart_pasien[$i]['list'] = null;
            foreach ($list_pasien as $pasien) {

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

    public function KonfirmMobile()
    {

        $data = '1';

        return view('layout/mobileconfirm');
    }
}

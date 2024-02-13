<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/muaraenim.ico">
    <title>Kwitansi Tindakan Rawat Jalan</title>
    <style type="text/css">
        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
            margin-left: 5.0;
            margin-top: 0.6em;
        }

        h5 {
            display: block;
            font-size: 2em;
            margin-top: 1.67em;
            margin-bottom: 0.67em;
            margin-left: 0.4;
            margin-right: 0;
            font-weight: bold;
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid text-dark">
        <div class="row" style="font-size:60%">
            <div class="pull-text text-left">
                <table style="border-collapse: collapse; width: 80%; height: 272px;" border="0">
                    <tbody>
                        <?php
                        foreach ($datapasien as $row) :
                        ?>

                            <tr style="height: 15px;">
                                <td style="width: 15%; height: 15px;" rowspan="2"><img style="height: 20px;" src="./assets/images/muaraenim.png" width="40" class="dark-logo" /></td>
                                <td style="width: 69.8905%; height: 10px;">RSUD Dr.H.MOHAMAD RABAIN</td>
                            </tr>
                            <tr style="height: 15px;">
                                <td style="width: 69.8905%; height: 10px;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</td>
                            </tr>
                            <tr style="height: 15px;">
                                <td style="width: 15%; height: 10px;"></td>
                                <td style="width: 69.8905%; height: 10px;">Tlp :</td>
                            </tr>
                            <tr style="height: 15px;">
                                <td style="width: 15%; height: 15px;" colspan="2">
                                    <hr>
                                </td>
                            </tr>

                            <tr style="height: 10px;">
                                <td style="width: 15%; height: 15px;"></td>
                                <td style="width: 69.8905%; height: 15px;">KWITANSI</td>
                            </tr>
                            <tr style="height: 10px;">
                                <td style="width: 15%; height: 15px;"></td>
                                <td style="width: 15%; height: 15px;">Nomor : <?= $row['journalnumber']; ?> - <?= $row['id']; ?></td>
                            </tr>


                            <tr style="height: 18px;">
                                <td style="width: 15%; height: 15px;">Sudah terima Dari</td>
                                <td style="width: 69.8905%; height: 15px;">:<?= $row['relationname']; ?></td>
                            </tr>
                            <?php
                            function penyebut($nilai)
                            {
                                $nilai = abs($nilai);
                                $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                                $temp = "";
                                if ($nilai < 12) {
                                    $temp = " " . $huruf[$nilai];
                                } else if ($nilai < 20) {
                                    $temp = penyebut($nilai - 10) . " belas";
                                } else if ($nilai < 100) {
                                    $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
                                } else if ($nilai < 200) {
                                    $temp = " seratus" . penyebut($nilai - 100);
                                } else if ($nilai < 1000) {
                                    $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
                                } else if ($nilai < 2000) {
                                    $temp = " seribu" . penyebut($nilai - 1000);
                                } else if ($nilai < 1000000) {
                                    $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
                                } else if ($nilai < 1000000000) {
                                    $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
                                } else if ($nilai < 1000000000000) {
                                    $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
                                } else if ($nilai < 1000000000000000) {
                                    $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
                                }
                                return $temp;
                            }

                            function terbilang($nilai)
                            {
                                if ($nilai < 0) {
                                    $hasil = "minus " . trim(penyebut($nilai));
                                } else {
                                    $hasil = trim(penyebut($nilai));
                                }
                                return $hasil;
                            } ?>
                            <tr style="height: 15px;">
                                <td style="width: 15%; height: 15px;">Uang Sebesar</td>
                                <td style="width: 69.8905%; height: 15px;">:# <?php echo ucwords(terbilang($row['subtotal'])) . " Rupiah"; ?></td>
                            </tr>
                            <tr style="height: 15px;">
                                <td style="width: 15%; height: 15px;">Untuk Biaya</td>
                                <td style="width: 69.8905%; height: 15px;">: Biaya Tindakan <b><?= $row['name']; ?></b></td>
                            </tr>
                            <tr style="height: 15px;">
                                <td style="width: 15%; height: 15px;">Nama</td>
                                <td style="width: 69.8905%; height: 15px;">: <?= $row['relationname']; ?></td>
                            </tr>
                            <tr style="height: 15px;">
                                <td style="width: 15%; height: 15px;">No Rekam medis</td>
                                <td style="width: 69.8905%; height: 15px;">: <?= $row['relation']; ?></td>
                            </tr>
                            <tr style="height: 15px;">
                                <td style="width: 15%; height: 15px;">Jumlah</td>
                                <td style="width: 69.8905%; height: 15px;">: Rp.<?= number_format($row['subtotal'], 2, ",", ".") ?></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">Cara Bayar</td>
                                <td style="width: 69.8905%;">: <?= $row['paymentmethodname']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">Pelayanan</td>
                                <td style="width: 69.8905%;">: <?= $row['poliklinikname']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">Dokter DPJP</td>
                                <td style="width: 69.8905%;">: <?= $row['doktername']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">&nbsp;</td>
                                <td style="width: 69.8905%;">&nbsp;</td>
                            </tr>
                            <?php
                            $tanggal = date('Y-m-d');
                            function tgl_indo($tanggal)
                            {
                                $bulan = array(
                                    1 =>   'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember'
                                );
                                $pecahkan = explode('-', $tanggal);
                                return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                            }

                            ?>
                            <tr>
                                <td style="width: 15%;">Keluarga Pasien</td>
                                <td style="width: 69.8905%;">Muara Enim, <?php echo tgl_indo($tanggal); ?> <?= date('h:i:s'); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">&nbsp;</td>
                                <td style="width: 69.8905%;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">&nbsp;</td>
                                <td style="width: 69.8905%;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="width: 15%;">
                                    <u><?= $row['relationname']; ?></u>
                                </td>
                                <td style="width: 69.8905%;"><u><?= $row['kasirvalidasi']; ?></u></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
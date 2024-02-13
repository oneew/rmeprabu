<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Bukti Pembayaran Tindakan Rawat Jalan</title>
    <style type="text/css">
        @page {
            margin: 20px 15px;
            font-size: 14px;
            margin-top: 0.8.cm;
            margin-bottom: 1.1.cm;
            margin-left: 1.5.cm;
            margin-right: 1.5.cm;
            line-height: 1.5;
            font-family: "Arial", "sans-serif", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            color: black;
        }

        body {
            font-size: 10px;
            line-height: 1.5;
            font-family: "Arial", "sans-serif", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            color: black;
        }


        table {

            width: 100%;
        }

        table,
        th,
        td {
            text-align: left;
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row" style="font-size:100%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 3%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px;" src="./assets/images/gallery/muaraenim.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 90%; text-align: center;">
                                <b>
                                    <font size="2">PEMERINTAH KABUPATEN MUARA ENIM</font>
                                </b>
                            </td>
                            <td style="width: 3%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px;" src="./assets/images/gallery/muaraenim.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 90%; text-align: center; font: size 200px;">
                                <b>
                                    <font size="3">RUMAH SAKIT UMUM DAERAH Dr.H.MOHAMAD RABAIN</font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 90%; text-align: center;">
                                Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 80%; text-align: center; line-height :1" colspan="3">
                                <hr>
                            </td>
                        </tr>

                        <tr>
                            <td style="width: 100%; text-align: center; line-height :1" colspan="3">
                                <br>
                                <b>
                                    <font size="3">Kwitansi Tindakan Rawat Jalan</font>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <tr>
                            <td style="width: 100%; text-align: center; line-height :1; font-sizex :6px;" colspan="2">No. : <?= $row['journalnumber']; ?> - <?= $row['id']; ?></td>
                        </tr>
                </table>
            <?php endforeach; ?>

            <font size="14px">
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1;" border="0">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>


                                <tr>
                                    <td colspan="2">
                                        <br>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-collapse: collapse; width: 35%;">Sudah Terima Dari</td>
                                    <td style="width: 80%; height: 15px;">: <?= $row['relationname']; ?></td>
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
                                    <td style="width: 10%; height: 15px;">Uang Sebesar</td>
                                    <td style="width: 80%; height: 15px;">: # <?php echo ucwords(terbilang($row['subtotal'])) . " Rupiah #"; ?></td>
                                </tr>
                                <tr style="height: 15px;">
                                    <td style="width: 10%; height: 15px;">Untuk Biaya</td>
                                    <td style="width: 80%; height: 15px;">: Biaya Tindakan <b><?= $row['name']; ?></b></td>
                                </tr>
                                <tr style="height: 15px;">
                                    <td style="width: 10%; height: 15px;">Nama</td>
                                    <td style="width: 80%; height: 15px;">: <?= $row['relationname']; ?></td>
                                </tr>
                                <tr style="height: 15px;">
                                    <td style="width: 10%; height: 15px;">No. Rekam Medis</td>
                                    <td style="width: 80%; height: 15px;">: <?= $row['relation']; ?></td>
                                </tr>
                                <tr style="height: 15px;">
                                    <td style="width: 10%; height: 15px;">Jumlah</td>
                                    <td style="width: 80%; height: 15px;">: Rp. <?= number_format($row['subtotal'], 0, ",", ".") ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">Cara Bayar</td>
                                    <td style="width: 80%;">: <?= $row['paymentmethodname']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">Pelayanan</td>
                                    <td style="width: 80%;">: <?= $row['poliklinikname']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">Dokter DPJP</td>
                                    <td style="width: 80%;">: <?= $row['doktername']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">&nbsp;</td>
                                    <td style="width: 80%;">&nbsp;</td>
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
                                } ?>
                                <tr>
                                    <td style="width: 10%; text-align: center;">Keluarga / Pasien</td>
                                    <td style="width: 80%; text-align: center;">Muara Enim, <?php echo tgl_indo($tanggal); ?> <?= date('h:i:s'); ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">&nbsp;</td>
                                    <td style="width: 80%;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;">&nbsp;</td>
                                    <td style="width: 80%;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 10%; text-align: center;">
                                        <u><?= $row['relationname']; ?></u>
                                    </td>
                                    <td style="width: 80%; text-align: center;"><u><?= $row['kasirvalidasi']; ?></u></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </font>
            </div>
        </div>
    </div>


</body>

</html>
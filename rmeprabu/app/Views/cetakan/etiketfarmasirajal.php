<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/faviconkuningan.ico">
    <title>Karcis Rawat Jalan</title>
    <style type="text/css">
        @page {
            margin: 5px;
            size: 6.cm 4.cm;
            line-height: 1.03;
            margin-top: 0.4.cm;
            margin-bottom: 0px;
            margin-right: 0.3cm;
            margin-left: 0.3.cm;
            font-family: 'Arial', sans-serif;
            font-size: 20px;
        }

        body {
            width: 6.cm;
            height: 4.cm;
            padding-top: 0;
        }

        tr {
            height: 0px;
            line-height: 1.5;
        }

        .barcode {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            font-weight: bold;
        }

        .header1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: bold;
        }

        .header2 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;

        }

        .identitas {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            font-weight: bold;

        }

        .obat {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;


        }
    </style>

</head>

<body>
    <table class="header1" style="height: 28px; width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
                <td style="width: 100%; height: 10px; text-align: center;" colspan="2">RSUD KOTA PRABUMULIH</td>
            </tr>
            <tr>
                <td style="width: 100%; height: 18px; text-align: center;" colspan="2">Jln. Lingkar Kel. Gunung Ibul Prabumulih Timur 31111 <br> Telp (0713)3300402/ (0713)3300404</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table class="identitas" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <?php
            foreach ($datapasien as $row) :
            ?>
                <?php
                $tanggal = $row['documentdate'];
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
                    <td class="header2" style="width: 50%;">No :
                        <?php $nomor = explode("_", $row['journalnumber']);
                        $nomor1 = $nomor[3];
                        $nomor2 = $nomor[4];
                        $split = "_";
                        $jurnal = $nomor1 . $split . $nomor2;
                        echo $jurnal;
                        ?>
                    </td>
                    <td class="header2" style="width: 50%; text-align: right;">Tgl: <?php echo tgl_indo($tanggal); ?></td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center;" colspan="2"><?= $row['relationname']; ?> [<?= $row['relation']; ?>]</td>
                </tr>

                <tr>
                    <td style="width: 50%; text-align: center;" colspan="2">Sehari : <?php echo number_format($row['signa1'], 0, ",", "."); ?> x <?php echo number_format($row['signa2'], 0, ",", ".") . " " . $row['uom']; ?></td>
                </tr>

                <tr>
                    <td style="width: 50%; text-align: center;" colspan="2"><?= $row['name'] . "   [" . $row['eticket_carapakai'] . "]"; ?></td>
                </tr>

                <?php $sgn = number_format($row['signa1'], 0, ",", ".") ?>
                <?php if ($sgn == 1 or $sgn == 0) {
                    $jm = "07:00";
                } ?>
                <?php if ($sgn == 2) {
                    $jm = "07:00 & 19:00";
                } ?>
                <?php if ($sgn == 3) {
                    $jm = "07:00 & 15:00 & 23:00";
                } ?>
                <?php if ($sgn == 4) {
                    $jm = "07:00 & 13:00 & 19:00 & 01:00";
                } ?>
                <?php if ($sgn == 5) {
                    $jm = "07:00 & 11:08 & 16:16 & 21:04 & 02:02";
                } ?>
                <tr>
                    <td style="width: 50%; text-align: center;" colspan="2">Jam : <?= $jm; ?></td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center;" colspan="2"><?= $row['eticket_petunjuk']; ?></td>
                </tr>
        </tbody>
    </table>

    <!-- <table class="obat" style="width: 100%; border-collapse: collapse; height: 54px;" border="1" cellspacing="0" cellpadding="0">
        <tbody>
            <tr style="height: 18px;">
                <td style="width: 18%; text-align: center; height: 18px;">PAGI</td>
                <td style="width: 18%; text-align: center; height: 18px;">SIANG</td>
                <td style="width: 18%; text-align: center; height: 18px;">SORE</td>
                <td style="width: 18%; text-align: center; height: 18px;">MALAM</td>
                <td style="width: 24%; text-align: center; height: 36px;" rowspan="2"><?= $row['uom']; ?></td>
            </tr>
            <tr style="height: 18px;">
                <td style="width: 18%; height: 18px; text-align:center;"><b><?php if ($row['pagi'] == 0) {
                                                                                echo "-";
                                                                            } else {
                                                                                echo $row['pagi'];
                                                                            } ?></b></td>

                <td style="width: 18%; height: 18px; text-align:center;"><b><?php if ($row['siang'] == 0) {
                                                                                echo "-";
                                                                            } else {
                                                                                echo $row['siang'];
                                                                            } ?></b></td>

                <td style="width: 18%; height: 18px; text-align:center;"><b><?php if ($row['sore'] == 0) {
                                                                                echo "-";
                                                                            } else {
                                                                                echo $row['sore'];
                                                                            } ?></b></td>

                <td style="width: 18%; height: 18px; text-align:center;"><b><?php if ($row['malam'] == 0) {
                                                                                echo "-";
                                                                            } else {
                                                                                echo $row['malam'];
                                                                            } ?></b></td>

            </tr>
            <tr style="height: 18px;">
                <td style="width: 18%; height: 18px; text-align:center;" colspan="2">ED: <?= $row['expireddate']; ?></td>
                <td style="width: 60%; height: 18px; text-align:center;" colspan="3"><?= $row['eticket_carapakai']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table> -->

</body>
<script type="text/javascript">
    window.print();
</script>

</html>
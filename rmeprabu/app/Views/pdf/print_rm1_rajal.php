<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>RM1 Rajal</title>
    <style type="text/css">
        table {

            width: 10%;
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

    <table style="border-collapse: collapse; width: 100%; height: 126px;" border="1">
        <tbody>
            <?php
            foreach ($dataopname as $row) :
            ?>
                <?php
                $original_date = $tgllahir;
                $timestamp = strtotime($original_date);
                $new_date = date("d-m-Y", $timestamp);

                $tanggallahir = $tgllahir;
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

                $umur = $age_years . " tahun " . $age_months . " bulan ";


                ?>
                <tr style="height: 18px;">
                    <td style="width: 60%; height: 18px;" colspan="3"><b>RSUD H. M. RABAIN<b></td>
                    <td style="width: 40%; height: 18px; text-align: right;" colspan="2"><b>RM. RJ. 01<b></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 20%; height: 72px; text-align: center;" rowspan="5">
                        <div class="img">
                            <img style="height: 40px;" src="./assets/images/gallery/muaraenim.png" width="40" class="dark-logo" />

                        </div>
                    </td>
                    <td style="width: 20%; height: 72px; text-align: center;" colspan="2" rowspan="5"><b>KUNJUNGAN RAWAT JALAN<b></td>
                    <td style="width: 12.5318%; height: 28px;" colspan="2">Nama &nbsp;: <?= $row['pasienname']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 12.5318%; height: 28px;" colspan="2">Tgl Lahir : <?= $row['pasiendateofbirth']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 12.5318%; height: 28px;" colspan="2">No.RM : <?= $row['pasienid']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 12.5318%; height: 28px;" colspan="2">ALamat : <?= $row['pasienaddress']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 12.5318%; height: 28px;" colspan="2">Jam Daftar : <?= $row['createddate']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 10%; height: 18px;">Tgl Jam</td>
                    <td style="width: 20%; height: 18px; text-align: center;">Profesional Pemberi Asuhan</td>
                    <td style="width: 50%; height: 18px; text-align: center;">HASIL ASESMEN PASIEN DAN PEMBERI PELAYANAN</td>
                    <td style="width: 12.5318%; height: 18px; text-align: center;">Instruksi PPA Termasuk Pasca Bedah</td>
                    <td style="width: 27.4682%; height: 18px; text-align: center;">Review dan Verifikasi DPJP</td>
                </tr>
                <tr style="height: 200px;">
                    <td style="width: 20%; height: 70px;">&nbsp;</td>
                    <td style="width: 20%; height: 70px;">&nbsp;</td>
                    <td style="width: 20%; height: 70px;">&nbsp;</td>
                    <td style="width: 12.5318%; height: 70px;">&nbsp;</td>
                    <td style="width: 27.4682%; height: 70px;">
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>

                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <!-- <p>&nbsp;</p>
                        <p>&nbsp;</p> -->

                        <p>&nbsp;</p>
                        <p>&nbsp;</p>


                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>


</body>

</html>
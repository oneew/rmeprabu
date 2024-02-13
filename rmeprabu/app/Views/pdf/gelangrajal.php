<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/faviconkuningan.ico">
    <title>Gelang pasien Rawat Jalan</title>
    <style type="text/css">
        @page {
            margin: 3px;
            size: 29cm 2.2cm;
            line-height: 0;
            padding-top: 2px;
        }

        body {
            /* margin: 0px; */
            /* margin-top: 1; */
            padding-top: 0.3cm;
            width: 29cm;
            height: 2cm;
            display: flex;
            justify-content: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 12px;
            line-height: 1.px;

        }

        .divtengah {
            display: flex;
            justify-content: center;
            margin-left: 400px;
            /* margin-top: 0.2px; */
        }

        tr {
            padding: 0px;
            line-height: 0.5;
            margin: 0px;
        }

        td {

            word-wrap: break-word;
        }
    </style>
    </style>
</head>

<body>

    <div class="divtengah">
        <table style="border-collapse: collapse; " border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <?php
                foreach ($datapasien as $row) :
                ?>
                    <?php
                    $original_date = $row['pasiendateofbirth'];
                    $timestamp = strtotime($original_date);
                    $new_date = date("d-m-Y", $timestamp);

                    $tanggallahir = $row['pasiendateofbirth'];
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

                    $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";


                    ?>

                    <tr>
                        <td style="width: 70px;" rowspan="4"><?= $barcode; ?></td>
                        <td style="width: 30%;">NORM</td>
                        <td style="width: 50%;">: <?= $row['pasienid']; ?> [<?= $row['paymentmethodname']; ?>]</td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>: <?= $row['pasienname']; ?></td>
                    </tr>
                    <tr>
                        <td>TGL LAHIR</td>
                        <td>: <?= $new_date; ?> [<?= $umur; ?>]</td>
                    </tr>
                    <tr>
                        <td>ALAMAT</td>
                        <td>: <?= $row['pasienaddress']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>
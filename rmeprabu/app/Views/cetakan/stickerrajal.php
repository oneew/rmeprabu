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
            size: 7cm 3cm;
            line-height: 1;
            margin-top: 10px;
            margin-bottom: 0px;
            font-family: 'Arial', sans-serif;
            font-size: 20px;
        }

        body {

            width: 7cm;
            height: 2.5cm;
            padding-top: 0;

        }

        tr {
            height: 0px;
            line-height: 1;
        }

        .barcode {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            font-weight: bold;

        }
    </style>

</head>

<body>

    <table style="border-collapse: collapse; width: 100%;" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <?php
            foreach ($datapasien as $row) :
            ?>

                <tr>
                    <td class="barcode" style="width: 67.8467%;"><b><?= $row['pasienname']; ?></b></td>
                    <td style="width: 32.1533%;" rowspan="4"><?= $barcode; ?></td>
                </tr>
                <tr>
                    <td class="barcode" style="width: 67.8467%;"><b><?= $row['pasienid']; ?>[<?= $row['pasiengender'] ?>]</b></td>
                </tr>
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

                $umur = $age_years . " tahun " . $age_months . " bulan ";
                ?>
                <tr>
                    <td class="barcode" style="width: 67.8467%;"><b>Tgl Lahir : <?= $new_date; ?></b></td>
                </tr>
                <tr>
                    <td class="barcode" style="width: 67.8467%;"><b><?= $umur; ?></b></td>
                </tr>
                <tr>
                    <td class="barcode" style="width: 67.8467%;"><b><?= $row['pasienaddress']; ?></b></b></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
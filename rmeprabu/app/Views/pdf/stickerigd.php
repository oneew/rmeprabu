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
            margin: 0px;
            size: 5cm 3cm;
            line-height: 1;
            margin-top: 0.3.px;
            margin-left: 0.1.px;
        }

        /* @import url('http://fonts.cdfonts.com/css/arial'); */

        body {
            margin: 15px;
            width: 5.cm;
            height: 3.cm;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10px;
            /* margin-top: 0.2em; */
            margin-top: 0.3.px;
            margin-left: 0.1.px;
            margin-bottom: 0.1.px;
        }

        h5 {
            display: block;
            font-size: 2em;
            margin-top: 0.67em;
            margin-bottom: 0.1em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
        }

        tr {
            height: 6px;
            line-height: 1;
        }

        .sticker {
            width: 7cm;
            height: 3cm;
        }

        .divtengah {
            display: flex;
            justify-content: center;
            margin-left: 10px;
            line-height: 1.1;
        }
    </style>

</head>

<body>
    <div class="divtengah" style="line-height: 0.9;">
        <div class="row">
            <table style="border-collapse: collapse; width: 100%;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <tr style="height: 40px;">
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width: 30px;"><?= $barcode; ?></td>
                            <td style="text-align: left; font-size:18px"><b><?= $row['pasienid']; ?>[<?= $row['pasiengender'] ?>]</b></td>
                        </tr>
                        <tr>
                            <td style="font-size: 12px;" colspan="2"><?= $row['pasienname']; ?></td>
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

                        $umur = $age_years . " Th " . $age_months . " Bln " . $age_days . " Hr";


                        ?>
                        <tr style="height: 10px;">
                            <td colspan="2"><?= $new_date; ?> [<?= $umur; ?>]</td>
                        </tr>

                        <tr>
                            <td colspan="2"><?= $row['pasienaddress']; ?></b></td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
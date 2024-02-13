<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/faviconkuningan.ico">
    <title>Gelang pasien Rawat Inap</title>
    <style type="text/css">
        @page {
            margin: 3px;
            size: 150cm 2.3cm;
            line-height: 0px;
            padding: 0px;
        }

        body {
            display: flex;
            margin: 0px;
            width: 29cm;
            height: 10cm;
            display: flex;
            justify-content: center;
        }

        .divtengah {
            display: flex;
            justify-content: center;
            margin-left: 400px;
            font-size: 12px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        tr {
            padding: 0px;
            line-height: 1.5;
            /* margin: 0px; */
        }

        td {

            word-wrap: break-word;
        }
    </style>
    </style>
</head>

<body>

    <div class="divtengah" style="font: 100%">
        <table style="width: 150%; border-collapse: collapse; " border="0" cellspacing="0" cellpadding="0">
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

                    $umur = $age_years . " th " . $age_months . " bl " . $days_months . " hr";


                    ?>
                    <tr>

                        <td style="width: 60px;"><b>NORM</b></td>
                        <td>: <b><?= $row['pasienid']; ?></b></td>
                    </tr>
                    <tr>
                        <td><b>NAMA</b></td>
                        <td>: <b><?= $row['pasienname']; ?></b></td>
                    </tr>
                    <tr>
                        <td><b>Tgl Lhr</b></td>
                        <td>: <b><?= $new_date; ?></b></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>
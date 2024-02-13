<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/faviconkuningan.ico">
    <title>TRACERT Rawat Jalan</title>
    <style type="text/css">
        @page {
            margin: 0px;
            size: 7cm 10cm;
            line-height: 0;
            padding-top: 1px;
        }

        body {
            margin: 10px;
            width: 16cm;
            height: 10cm;
        }

        tr {
            height: 10px;
        }

        .sticker {
            width: 7cm;
            height: 3cm;
        }

        .divtengah {
            display: flex;
            justify-content: center;
            margin-left: 10px;
        }

        .barcode {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: bold;

        }
    </style>

</head>

<body>


    <table class="detailrajal" style="width: 100%; border-collapse: collapse; height: 126px;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <?php
            foreach ($datapasien as $row) :
            ?>
                <?php
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
                <tr style="height: 18px;">
                    <td style="width: 100%; text-align: left; height: 18px;" colspan="2">RSUD DR H M RABAIN</td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 18.4672%; height: 18px;">Tanggal</td>
                    <td style="width: 81.5328%; height: 18px;">: <?= date('d-m-Y G:i:s'); ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 18.4672%; height: 18px;">Nomor Rontgen</td>
                    <td style="width: 81.5328%; height: 18px;">: <?= $expertiseid; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 18.4672%; height: 18px;">Nama</td>
                    <td style="width: 81.5328%; height: 18px;">: <?= $row['pasienname']; ?> | <?= $umur; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 18.4672%; height: 18px;">Alamat</td>
                    <td style="width: 81.5328%; height: 18px;">: <?= $row['pasienaddress']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 18.4672%; height: 18px;">Rontgen</td>
                    <td style="width: 81.5328%; height: 18px;">: <?php echo $pemeriksaan; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 18.4672%; height: 18px;">Dokter</td>
                    <td style="width: 81.5328%; height: 18px;">: <?= $row['doktername']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

<script type="text/javascript">
    window.print();
</script>

</html>
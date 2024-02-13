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
            width: 7cm;
            height: 3cm;


        }

        h5 {
            display: block;
            font-size: 2em;
            margin-top: 0.67em;
            margin-bottom: 0.67em;
            margin-left: 0;
            margin-right: 0;
            font-weight: bold;
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
    </style>

</head>

<body>
    <div class="divtengah" style="line-height: 0.5;">
        <div class="row" style="font-size:60%">
            <table style="border-collapse: collapse; width: 70%; height: 25px;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>

                        <tr style="height: 18px;">
                            <td style="width: 80%; height: 18px; text-align: center;" colspan="2"><b>TRACERT RAWAT JALAN</b></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="width: 18%; height: 18px;">TglJam</td>
                            <td style="width: 60%; height: 18px;">: <?= date('d-m-Y G:i:s'); ?></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="width: 18%; height: 18px;">RM.Lama</td>
                            <td style="width: 60%; height: 18px;">: <?= $row['oldcode']; ?></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="width: 18%; height: 18px;">RM.Baru</td>
                            <td style="width: 60%; height: 18px;">: <?= $row['pasienid']; ?></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="width: 18%; height: 18px;">Cara Bayar</td>
                            <td style="width: 60%; height: 18px;">: <?= $row['paymentmethodname']; ?></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="width: 18%; height: 18px;">Alamat</td>
                            <td style="width: 90%; height: 18px;">: <?= $row['pasienaddress']; ?></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="width: 18%; height: 18px;">Pasien</td>
                            <td style="width: 60%; height: 18px;">: <?= $row['pasienname']; ?></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="width: 18%; height: 18px;">Klinik</td>
                            <td style="width: 60%; height: 18px;">: <?= $row['poliklinikname']; ?></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="width: 18%; height: 18px;">Urutan</td>
                            <td style="width: 60%; height: 18px;">: <?php echo number_format($row['noantrian'], 0, ",", "."); ?></td>

                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
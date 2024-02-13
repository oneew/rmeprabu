<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/faviconkuningan.ico">
    <title></title>
    <style type="text/css">
        @page {
            margin: 5px;
            size: 4.5cm 3cm;
            line-height: 1;

            margin-bottom: 0.5px;
        }
    </style>

</head>

<body>
    <div class="row" style="font-size:60%">
        <table style="border-collapse: collapse; width: 100%;" border="0">
            <tbody>
                <?php
                foreach ($datapasien as $row) :
                ?>
                    <tr>
                        <td style="width: 100%; text-align: center;"><?= $row['journalnumber']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: center;"><?= $barcode; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;"><?= $row['pasienname']; ?> <?= date('d-m-y'); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;">No.RM : <?= $row['pasienid']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;"><?= $row['roomname']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;"><?= $row['paymentmethod']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
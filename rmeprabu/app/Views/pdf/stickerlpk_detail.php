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
            margin: 7px;
            size: 4.5cm 3cm;
            line-height: 1;
            margin-bottom: 18.466px;
            margin-top: 8.4px;
        }
    </style>

</head>

<body>
    <div class="row" style="font-size:60%">
        <table style="border-collapse: collapse; width: 100%;" border="0">
            <tbody>
                <?php
                foreach ($datapasien as $index => $row) :
                ?>
                    <tr>
                        <td style="width: 100%; text-align: left;"><?php
                                                                    $row['journalnumber'];
                                                                    $data = explode("_", $row['journalnumber']);
                                                                    $nomorlab = $data[2] . "_" . $data[3];
                                                                    echo $nomorlab; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;"><?= $barcode[$index]; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;"><?= $row['relationname']; ?> <?= date('d-m-y'); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;">No.RM : <?= $row['relation']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;"><?= $row['roomname']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;"><?= strtoupper($row['name']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
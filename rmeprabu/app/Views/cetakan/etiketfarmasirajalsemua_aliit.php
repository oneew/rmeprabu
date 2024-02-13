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
            size: 6.cm 5.cm;
            line-height: 1.03;
            margin-top: 0.4.cm;
            margin-bottom: 0px;
            margin-right: 0.3cm;
            margin-left: 0.3.cm;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10px;
        }

        body {
            width: 5.cm;
            height: 6.cm;
            padding-top: 0;
            font-size: 10px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: bold;
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
            font-size: 8px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: bold;
        }

        .header2 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;

        }

        .identitas {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 10px;
            /* font-weight: bold; */

        }

        .obat {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;


        }
    </style>

</head>

<body>

    <?php
    foreach ($datapasien as $row) :
    ?>

        <table class="body" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <?php

                ?>

                <tr>
                    <td style="width: 100%; height: 10px; text-align: center;" colspan="2">RSUD H. M. RABAIN</td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 10px; text-align: center;" colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;" colspan="=2">Tgl : <?= $row['documentdate']; ?></td>
                </tr>
                <tr>
                    <td style="width: 50%;" colspan="2">RM : <?= $row['relation']; ?>
                    </td>
                </tr>

                <tr>
                    <td style="width: 50%; text-align: left;" colspan="2"> <?= $row['relationname']; ?> </td>
                </tr>

                <tr>
                    <td style="width: 50%; text-align: center;" colspan="2">Sehari : <?php echo number_format($row['signa1'], 0, ",", "."); ?> x <?php echo number_format($row['signa2'], 0, ",", ".") . " " . $row['uom']; ?></td>
                </tr>

                <tr>
                    <td style="width: 50%; text-align: center;" colspan="2"><?= $row['name'] . "   [" . $row['eticket_carapakai'] . "]"; ?></td>
                </tr>

                <?php $sgn = number_format($row['signa1'], 0, ",", ".") ?>
                <?php if ($sgn == 1 or $sgn == 0) {
                    // $jm = "07:00";
                    $jm = "24 Jam sekali";
                } ?>
                <?php if ($sgn == 2) {
                    // $jm = "07:00 & 19:00";
                    $jm = "12 Jam sekali";
                } ?>
                <?php if ($sgn == 3) {
                    // $jm = "07:00 & 15:00 & 23:00";
                    $jm = "8 Jam sekali";
                } ?>
                <?php if ($sgn == 4) {
                    // $jm = "07:00 & 13:00 & 19:00 & 01:00";
                    $jm = "6 Jam sekali";
                } ?>
                <?php if ($sgn == 5) {
                    // $jm = "07:00 & 11:08 & 16:16 & 21:04 & 02:02";
                    $jm = "5 Jam sekali";
                } ?>
                <tr>
                    <!-- <td style="width: 50%; text-align: center;" colspan="2">Jam : <?= $jm; ?></td> -->
                    <td style="width: 50%; text-align: center;" colspan="2">Setiap : <?= $jm; ?></td>
                </tr>
                <tr>
                    <td style="width: 50%; text-align: center;" colspan="2"><?= $row['eticket_petunjuk']; ?></td>
                </tr>


            </tbody>
        </table>


    <?php endforeach; ?>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
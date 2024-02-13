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
            margin: 1px;
            size: 6.4.cm 4.01.cm;
            line-height: 1;
            margin-top: 0.1.cm;
            margin-bottom: 0px;
            margin-right: 0.3cm;
            margin-left: 0.3.cm;
            font-family: 'Arial', sans-serif;
            font-size: 8px;
        }

        body {
            width: 6.cm;
            height: 4.cm;
            padding-top: 0;
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
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            /* font-weight: bold; */
        }

        .header2 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;

        }

        .identitas {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            font-family: Tahoma;
            /* font-weight: bold; */

        }

        .obat {
            font-family: Tahoma, Arial, Helvetica, sans-serif;
            font-size: 11px;


        }
    </style>

</head>

<body>

    <?php
    foreach ($datapasien as $row) :
    ?>

        <table class="identitas" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <?php

                ?>

                <tr style="height: 8 px;">
                    <td style="width: 100%; text-align: center;" colspan="2"><u>RSUD H. M. RABAIN</u></td>
                </tr>
                <tr>
                    <td style="width: 20%;">Tanggal</td>
                    <td style="width: 90%;">: <?= $row['documentdate']; ?></td>

                </tr>

                <tr>
                    <td style="width: 20%;">Nama</td>
                    <td style="width: 90%;">: <?= $row['relationname']; ?></td>
                </tr>

                <tr>
                    <td style="width: 20%;">No RM</td>
                    <td style="width: 90%;">: <?= $row['relation']; ?></td>
                </tr>



                <tr>
                    <td style="width: 20%;">Obat</td>
                    <td style="width: 80%;">: <?= $row['name']; ?></td>
                </tr>

                <tr>
                    <td style="width: 5%;">Jml</td>
                    <td style="width: 90%;">: <?= abs($row['qty']); ?> &nbsp; Exp Date <?= $row['expireddate']; ?></td>
                </tr>

                <tr>
                    <td style="width: 100%;" colspan="2">Aturan Pakai : <?= number_format($row['signa1']); ?> x <?= number_format($row['signa2']); ?> [<?= $row['uom'] . "]"; ?></td>
                </tr>

                <?php
                $signa2 = ABS($row['signa2']);
                if ($signa2 == 1) {
                    $signapakai = "PAGI";
                } ?>

                <?php
                $signa2 = ABS($row['signa2']);
                if ($signa2 == 2) {
                    $signapakai = "PAGI - MALAM";
                } ?>

                <?php
                $signa2 = ABS($row['signa2']);
                if ($signa2 == 3) {
                    $signapakai = "PAGI - SIANG - MALAM";
                } ?>

                <tr>
                    <td style="width: 100%;" colspan="2"><?= $row['eticket_carapakai']; ?> &nbsp; &nbsp; / <?= $signapakai; ?></td>
                </tr>


            </tbody>
        </table>


    <?php endforeach; ?>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
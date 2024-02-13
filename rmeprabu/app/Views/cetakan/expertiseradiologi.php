<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Expertise radiologi</title>
    <style type="text/css">
        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
            margin-left: 10;
            margin-right: 20;
            margin-top: 0.6em;
        }

        .kasirrajal {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: bold;

        }

        .detailrajal {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 20px;


        }

        .headerrajal {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            font-weight: bold;

        }

        hr {
            border: none;
            border-top: 3px double #333;
            color: #333;
            overflow: visible;
            text-align: center;
            height: 5px;
        }

        hr:after {
            background: #fff;
            content: '§';
            padding: 0 4px;
            position: relative;
            top: -13px;
        }
        #yus, .ck-table-resized, .ck-table-resized tr, .ck-table-resized td{
            border: 1px solid #000;
            border-collapse: collapse;
        }
    </style>
    </style>
</head>

<body>
    <table class="headerrajal" style="width: 100%; border-collapse: collapse; height: 54px;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr style="height: 18px;">
                <td style="width: 14.9026%; height: 54px; text-align:center;" rowspan="3"> <img style="height: 40px;" src="../assets/images/gallery/pemkab.png" width="40" /></td>
                <td style="width: 64.9027%; text-align: center; height: 18px;">PEMERINTAH KABUPATEN MUARA ENIM</td>
                <td style="width: 20.1946%; height: 54px; text-align:center;" rowspan="3"> <img style="height: 40px;" src="../assets/images/gallery/muaraenim.png" width="40" /></td>
            </tr>
            <tr style="height: 18px;">
                <td style="width: 64.9027%; text-align: center; height: 18px;">RSUD DR. H. MUHAMAD RABAIN</td>
            </tr>
            <tr style="height: 18px;">
                <td style="width: 64.9027%; text-align: center; height: 18px;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara
                    Enim, Sumatera Selatan 31314</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table class="detailrajal" style="height: 126px; width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
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
                    <td style="width: 25%; height: 18px; text-align:center;" colspan="4"><b>HASIL PEMERIKSAAN RADIOLOGI</b></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;">Nomor Foto</td>
                    <td style="width: 25%; height: 18px;">: <?= $expertiseid; ?></td>
                    <td style="width: 25%; height: 18px;">Tanggal Pemeriksaan</td>
                    <td style="width: 25%; height: 18px;">: <?= $row['documentdate']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;">Nama</td>
                    <td style="width: 25%; height: 18px;">: <?= $row['pasienname']; ?></td>
                    <td style="width: 25%; height: 18px;">Jenis Kelamin/Umur</td>
                    <td style="width: 25%; height: 18px;">: <?= $row['pasiengender']; ?> | <?= $umur; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;">Cara Bayar</td>
                    <td style="width: 25%; height: 18px;">: <?= $row['paymentmethod']; ?></td>
                    <td style="width: 25%; height: 18px;">Alamat</td>
                    <td style="width: 25%; height: 18px;">: <?= $row['pasienaddress']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;">Klinik/Ruangan</td>
                    <td style="width: 25%; height: 18px;">: <?= $row['roomname']; ?></td>
                    <td style="width: 25%; height: 18px;">No.RM</td>
                    <td style="width: 25%; height: 18px;">: <?= $row['pasienid']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;">Dokter Pengirim</td>
                    <td style="width: 25%; height: 18px;">: <?= $row['doktername']; ?></td>
                    <td style="width: 25%; height: 18px;">Tanggal Ekspertise</td>
                    <td style="width: 25%; height: 18px;">: <?= $tanggalexpertise; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 18px;">Dokter Radiologi</td>
                    <td style="width: 25%; height: 18px;">: <?= $Dokterrad; ?></td>
                    <!-- <td style="width: 25%; height: 18px;">: ?php echo $dokterpemeriksa; ?></td> -->
                    <td style="width: 25%; height: 18px;">Klinis</td>
                    <td style="width: 25%; height: 18px;">: <?= $klinis; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <table class="detailrajal" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="width: 100%;">Pemeriksaan : <?php echo $pemeriksaan; ?></td>
            </tr>
            <tr>
                <td style="width: 100%;">Ekspertise :</td>
            </tr>
            <br>
            <tr>
                <td style="width: 100%;"></td>
            </tr>
            <tr>
                <td style="width: 100%;"><?= $expertise; ?></td>
            </tr>
        </tbody>
    </table>
    <?php
    $tanggal = $tanggalexpertise;
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }

    ?>
    <table class="detailrajal" style="width: 100%; border-collapse: collapse; height: 108px;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <?php
            foreach ($datapasien as $tanda) :
            ?>
                <tr style="height: 18px;">
                    <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                    <td style="width: 37.0438%; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                    <td style="width: 37.0438%; height: 18px;">Radiologist</td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                    <td style="width: 37.0438%; height: 18px;"><?= $barcode; ?></td>


                </tr>

                <tr style="height: 18px;">
                    <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                    <td style="width: 37.0438%; height: 18px;"><u><?= $Dokterrad; ?></u></td>
                    <!-- <td style="width: 37.0438%; height: 18px;"><u>?php echo $dokterpemeriksa; ?></u></td> -->
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                    <td style="width: 37.0438%; height: 18px;">SIP. <?= $sip ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
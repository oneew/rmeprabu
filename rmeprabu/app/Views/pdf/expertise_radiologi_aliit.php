<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Expertise Radiologi</title>
    <style type="text/css">
        @page {
            /* margin: 25px 12px; */
            margin: 20px 15px;
            font-size: 14px;
            margin-top: 0.8.cm;
            margin-bottom: 1.1.cm;
            margin-left: 1.3.cm;
            margin-right: 1.5.cm;
            line-height: 1;
            /* line-height: 1.2; */
            color: black;
        }

        body {
            font-size: 12px;
            /* line-height: 1.3; */
            line-height: 1;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: black;
        }

        table {

            width: 100%;
        }

        table,
        th,
        td {
            text-align: left;
        }
    
    </style>
</head>

<body>

<div class="container">
    <div class="row" style="font-size:100%">
        <div class="col-md-12">
            <table style="border-collapse: collapse; width: 100%; line-height: 1;" border="0">
                    <tbody>
                    <tr>
                            <td style="width: 12%; text-align: left;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px; text-align: left;" src="./assets/images/gallery/pemkab.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                            <td style="text-align: left;">
                                <!-- <b> -->
                                    <font size=16px><?= $header1; ?></font>
                                <!-- </b> -->
                            </td>
                            
                        </tr>
                        <tr>
                            <td style="text-align: left;">
                                <b>
                                    <font size="20px"> <?php echo $header2; ?> </font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="text-align: left;">
                                <font size="1"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="pull-text text-center">
                    <div class="col-md-12">
                        <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 33.3333%; text-align: center;">
                                        <?= $deskripsi; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <tr style="height: 17px">
                                    <td style="width: 21.5026%; height: 17px">Nomor Foto</td>
                                    <td style="width: 3.02251%; height: 17px">:</td>
                                    <td style="width: 23.9207%; height: 17px"><?= $expertiseid; ?></td>
                                    <td style="width: 26.5111%; height: 17px">Tanggal Pemeriksaan</td>
                                    <td style="width: 2.67706%; height: 17px">:</td>
                                    <td style="width: 22.3662%; height: 17px"><?= $row['documentdate']; ?></td>
                                </tr>

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

                                $umur = $age_years . " Th " . $age_months . " Bl " . $age_days . " Hr";


                                ?>
                                <tr style="height: 17px">
                                    <td style="width: 21.5026%; height: 17px">Nama</td>
                                    <td style="width: 3.02251%; height: 17px">:</td>
                                    <td style="width: 23.9207%; height: 17px"><?= $row['pasienname']; ?></td>
                                    <td style="width: 26.5111%; height: 17px">Jenis Kelamin/Umur</td>
                                    <td style="width: 2.67706%; height: 17px">:</td>
                                    <td style="width: 22.3662%; height: 17px"><?= $row['pasiengender']; ?> | <?= $umur; ?></td>
                                </tr>
                                <tr style="height: 17px">
                                    <td style="width: 21.5026%; height: 17px">Cara Bayar</td>
                                    <td style="width: 3.02251%; height: 17px">:</td>
                                    <td style="width: 23.9207%; height: 17px"><?= $row['paymentmethod']; ?></td>
                                    <td style="width: 26.5111%; height: 17px">Alamat</td>
                                    <td style="width: 2.67706%; height: 17px">:</td>
                                    <td style="width: 22.3662%; height: 17px"><?= $row['pasienaddress']; ?></td>
                                </tr>
                                <tr style="height: 17px">
                                    <td style="width: 21.5026%; height: 17px">Klinik/Ruangan</td>
                                    <td style="width: 3.02251%; height: 17px">:</td>
                                    <td style="width: 23.9207%; height: 17px"><?= $row['roomname']; ?></td>
                                    <td style="width: 26.5111%; height: 17px">No. RM</td>
                                    <td style="width: 2.67706%; height: 17px">:</td>
                                    <td style="width: 22.3662%; height: 17px"><?= $row['pasienid']; ?></td>
                                </tr>
                                <tr style="height: 17px">
                                    <td style="width: 21.5026%; height: 17px">Dokter Pengirim</td>
                                    <td style="width: 3.02251%; height: 17px">:</td>
                                    <td style="width: 23.9207%; height: 17px"><?= $row['doktername']; ?></td>
                                    <td style="width: 26.5111%; height: 17px">Tanggal Ekspertise</td>
                                    <td style="width: 2.67706%; height: 17px">:</td>
                                    <td style="width: 22.3662%; height: 17px"><?= $tanggalexpertise; ?></td>
                                </tr>
                                <tr style="height: 17px; border-bottom: solid">
                                    <td style="width: 21.5026%; height: 17px">Dokter Radiologi</td>
                                    <td style="width: 3.02251%; height: 17px">:</td>
                                    <!-- <td style="width: 23.9207%; height: 17px">?= $row['employeename']; ?></td> -->
                                    <td style="width: 23.9207%; height: 17px"><?php echo $dokterpemeriksa; ?></td>
                                    <td style="width: 26.5111%; height: 17px">Klinis</td>
                                    <td style="width: 2.67706%; height: 17px">:</td>
                                    <td style="width: 22.3662%; height: 17px"><?= $klinis; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr>

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%;  line-height: 2;" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 25%;"><b>Pemeriksaan/ Tindakan : <?php echo $pemeriksaan; ?></b></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;"><b>Expertise :</b></td>
                            </tr>
                            <tr>
                                <td style="width: 25%; line-height:1.3"><p align="justify"><?= $expertise; ?></p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

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

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="width: 10%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 10%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 30%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 10%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 10%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 30%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Radiologist</td>
                            </tr>
                            <?php
                            foreach ($expertise as $row) :
                            ?>

                                <tr style="height: 18px;">
                                    <td style="width: 10%; text-align: center; height: 50px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1">
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 10%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 30%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;"><?= $row['createddate']  ?></td>
                                </tr>

                                <tr style="height: 30px;">
                                    <td style="width: 0%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 0%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 0%; text-align: center; height: 18px;">&nbsp;</td>
                                    <!-- <td style="width: 80%; text-align: center; height: 18px;"><u>?= $row['employeename']; ?></u></td> -->
                                    <td style="width: 80%; text-align: center; height: 18px;"><u><?= $row['createdby']  ?></u></td>
                                </tr>
                                <tr>
                                    <td style="width: 0%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 0%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 0%; text-align: center; height: 18px;">&nbsp;</td>
                                    <!-- <td style="width: 80%; text-align: center; height: 18px;">SIP. ?= $sip; ?></td> -->

                                </tr>

                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
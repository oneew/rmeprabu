<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Print CPPT Pasien</title>
    <style type="text/css">
        @page {
            /* margin: 20px 15px; */
            margin: 0;
            font-size: 12px;
        }

        body {
            /* margin: 0px; */
            margin-top: 1.cm;
            margin-left: 1.cm;
            margin-right: 1.cm;
            margin-bottom: 1.cm;
            font-size: 12px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>

</head>

<body>

    <!-- <div class="container-fluid text-dark"> -->
    <div>
        <div class="row">
            <!-- <div class="col-md-12"> -->
            <div>
                <div>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <table style="border-collapse: collapse; line-height: 1; width:100%;" border="0">
                            <tbody>
                                <tr>
                                    <!-- <td style="width: 15%; text-align: center;" rowspan="3"> -->
                                    <td style="width: 3.cm; text-align: left;" rowspan="3">
                                        <div class="img">
                                            <img style="height: 70px;" src="./assets/images/gallery/pemkab.png" width="70px" class="dark-logo" />
                                        </div>
                                    </td>
                                    <td style="text-align: left; width:15.cm">
                                        <font size="18px"><?= $header1; ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;">
                                        <b>
                                            <font size="22px" ><?php echo $header2; ?></font>
                                            
                                        </b>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;">
                                        <font size="1"><?php echo $alamat; ?></font>
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="2">
                                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                    </td>
                                </tr>

                                <tr style="height: 100px">
                                    <td style="width: 100%; text-align: center; line-height :0.5" colspan="2">
                                        <br>
                                        <b>
                                            <font size="4">
                                        </b>
                                   CATATAN PERKEMBANGAN PASIEN TERINTEGRASI (INTEGRATED NOTE)</td>
                                </tr>
                                <!-- <tr> -->
                                    <!-- <td colspan="2" style="text-align: right;"> -->
                                        <!-- <br> -->
                                        <!-- <font size="14px">Antrian Poli : <b><?= number_format($row['noantrian'], 0, ",", "."); ?></b></font> -->
                                    <!-- </td> -->
                                <!-- </tr> -->
                            </tbody>
                        </table>
                </div>
                <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->
                <br>

                <div class="0">
                    <table style="border-collapse: collapse; width: 100%;" border="0">
                        <thead>
                            <tr>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <!-- <td style="width: 3cm;"> </td> -->
                            </tr>
                        </thead>
                        <tbody style="line-height: 1;">
                            <tr>
                                <td style="text-align: left;">NO. RM</td>
                                <td>:</td>
                                <td></td>
                                <!-- <td></td> -->
                                <td style="text-align: left;">Umur</td>
                                <td>:</td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td style="text-align: left;">Nama Pasien</td>
                                <td>:</td>
                                <td></td>
                                <td style="text-align: left;">Jenis Kelamin</td>
                                <td>:</td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td style="text-align: left;">Tgl. Lahir</td>
                                <td>:</td>
                                <td></td>
                                <td style="text-align: left;">Diagnosis</td>
                                <td>:</td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td style="text-align: left;">P. Jawab Jaminan</td>
                                <td>:</td>
                                <td></td>
                                <td style="text-align: left;">R. Rawat Terakhir</td>
                                <td>:</td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td style="text-align: left;">Tgl. Masuk</td>
                                <td>:</td>
                                <td></td>
                                <td style="text-align: left;">Tgl. Keluar/Meninggal</td>
                                <td>:</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tr style="line-height: 1;"> 
                                <td style="text-align: center;">Nama Obat</td>
                                <td style="text-align: center;">Jumlah</td>
                                <td style="text-align: center;">Dosis</td>
                                <td style="text-align: center;"> Frekuensi</td>
                                <td style="text-align: center;"> Cara Pemberian</td>
                                <td style="text-align: center;"> Kajian Pasien Meninggal</td>
                            </tr>
                            <tr style="line-height: 1.5;">
                                <td>1.)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="line-height: 1.5;">
                                <td>2.)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="line-height: 1.5;">
                                <td>3.)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="line-height: 1.5;">
                                <td>4.)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="line-height: 1.5;">
                                <td>5.)</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                                </table>

                                </td>
                            </tr>
                                                        <tr style="line-height: 2.5;">
                                <td colspan="3">
                                    Format Resume Medis Ditambahkan Catatan :
                                </td>
                                <td colspan="3" style="text-align: center;">
                                    Muara Enim, <?= date('d-m-Y', strtotime($row['documentdate'])); ?>
                                </td>
                            </tr>
                            <tr style="line-height: 0.9;">
                                <td colspan="3">
                                    Bila terjadi keadaan darurat segera menghubungi pusat pelayanan kesehatan terdekat !
                                </td>
                                <td colspan="3" style="text-align: center;">Dokter Penanggung Jawab Pelayanan</td>
                            </tr>
                            <tr style="line-height: 4.5;">
                                <td colspan="2">Lembar 1 : Rekam Medis</td>
                            </tr>
                            <tr style="line-height: 0;">
                                <td colspan="3">Lembar 2 : Pasien</td>
                                <td colspan="3" style="text-align: center;">(_____________________________)</td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td colspan="3">Lembar 3 : Penjamin</td>
                                <td colspan="3" style="text-align: center;">Tanda tangan & Nama Lengkap</td>
                            </tr>
                            </tbody>
                    </table>


                    <table>
                        <tbody>
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->

                <?php endforeach; ?>


                </div>
            </div>
        </div>
    </div>

</body>

</html>
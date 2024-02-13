<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Resume Pasien Keluar</title>
    <style type="text/css">
        @page {
            /* margin: 20px 15px; */
            margin: 0;
            font-size: 14px;
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
                                            <font size="22px"><?php echo $header2; ?></font>

                                        </b>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;">
                                        <font size="1"><?php echo $alamat; ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                    </td>
                                </tr>

                                <tr style="height: 100px">
                                    <td style="width: 100%; text-align: center; line-height :0" colspan="2">
                                        <br>
                                        <b>
                                            <font size="4">
                                        </b>
                                        <h3> <u> SURAT KETERANGAN DOKTER</u></h3>
                                    </td>
                                </tr>
                                <tr style="line-height: 3;">
                                    <td style="text-align: center;" colspan="2">Nomor :</td>
                                    <!-- </tr>
                                <!-- <tr> -->
                                    <!-- <td colspan="2" style="text-align: right;"> -->
                                    <!-- <br> -->
                                    <!-- <font size="14px">Antrian Poli : <b><?= number_format($row['noantrian'], 0, ",", "."); ?></b></font> -->
                                    <!-- </td> -->
                                    <!-- </tr>
                            </tbody>
                        </table>
                </div>
                <! <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->
                                    <br>

                                    <div class="0">
                                        <table style="border-collapse: collapse; width: 100%;" border="0">
                                            <thead>
                                                <tr>
                                                    <td style="width: 1cm;"> </td>
                                                    <td style="width: 3cm;"> </td>
                                                    <td style="width: 1cm;"> </td>
                                                    <td style="width: 4cm;"> </td>
                                                    <td style="width: 4cm;"> </td>
                                                    <td style="width: 2cm;"> </td>
                                                    <!-- <td style="width: 3cm;"> </td> -->
                                                </tr>
                                            </thead>
                                            <tbody style="line-height: 2;">
                                                <tr style="line-height: 2">
                                                    <td colspan="6">
                                                        <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Yang bertanda tangan dibawah ini. Dokter pemerintah yang bertugas di RSUD Dr. H Mohamad Rabain Muara Enim. Telah Memeriksa :
                                                        <p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nama</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tempat Tanggal Lahir</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jenis Kelamin</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Alamat</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Keperluan</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="line-height:5;">Dengan Hasil Pemeriksaan :</td>
                                                    <!-- <td>:</td> -->
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tinggi Badan</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Berat Badan</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tensi Darah</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Golongan Darah</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td>Kesimpulan</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td>Catatan</td>
                                                    <td>:</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">
                                                        Demikian surat keterangan ini di buat dan dapat digunakan sebagaimana mestinya.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td style="text-align: center;" colspan="3">
                                                        Muara Enim, <?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>
                                                    </td>
                                                </tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td style="text-align: center;" colspan="3">Dokter Pemeriksa,</td>
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
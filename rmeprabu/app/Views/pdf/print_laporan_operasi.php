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

        td {
            border-collapse: collapse;
            border-bottom: 1px solid black;
            border-top: 1px solid black;
            /* padding-top: 2; */
            /* padding-bottom: 2; */
            padding-left: 4;
            padding-right: 4;
        }


        .ataskosong {
            border-collapse: collapse;
            border-bottom: none;
            border-top: none;
            border-left: none;
            border-right: none;
            /* padding-top: 1;
            padding-bottom: 1;
            padding-left: 1;
            padding-right: 1; */

        }

        .atas {
            border-collapse: collapse;
            border-bottom: 1px solid black;
            border-top: 1px solid black;
            padding-top: 2;
            padding-bottom: 2;
            padding-left: 4;
            padding-right: 4;
        }

        .bawah {
            border-bottom: 1px solid black;
        }

        .kanan {
            border-right: 1px solid black;
        }

        .kiri {
            border-left: 1px solid black;
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
                                    <td class="ataskosong" style="width: 3.cm; text-align: left;" rowspan="3">
                                        <div class="img">
                                            <img style="height: 70px;" src="./assets/images/gallery/pemkab.png" width="70px" class="dark-logo" />
                                        </div>
                                    </td>
                                    <td class="ataskosong" style="text-align: left; width:15.cm">
                                        <font size="18px"><?= $header1; ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ataskosong" style="text-align: left;">
                                        <b>
                                            <font size="22px"><?php echo $header2; ?></font>

                                        </b>
                                    </td>
                                </tr>
                                <tr>

                                    <td class="ataskosong" style="text-align: left;">
                                        <font size="1"><?php echo $alamat; ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ataskosong" colspan="2">
                                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                    </td>
                                </tr>

                                <tr style="height: 100px">
                                    <td style="width: 100%; text-align: center; line-height :0" colspan="2">
                                        <br>
                                        <b>
                                            <font size="4">
                                        </b>
                                        <h3> <u> LAPORAN OPERASI</u></h3>
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
                                            <!-- <thead>
                                                <tr>
                                                    <td style="width: 20%;"> </td>
                                                    <td style="width: 30%;"> </td>
                                                    <td style="width: 20%;"> </td>
                                                    <td style="width: 5%;"> </td>
                                                    <td style="width: 25%;"> </td>
                                                    
                                                </tr>
                                            </thead> -->
                                            <tbody style="line-height: 2;">
                                                <tr>
                                                    <td style="width: 20%;"> </td>
                                                    <td style="width: 30%;"> </td>
                                                    <td style="width: 20%;"> </td>
                                                    <td style="width: 5%;"> </td>
                                                    <td style="width: 25%;"> </td>
                                                    <!-- <td style="width: 2cm;"> </td> -->
                                                    <!-- <td style="width: 3cm;"> </td> -->
                                                </tr>
                                                <tr>
                                                    <td rowspan="2" class="kiri" style="text-align: center;">
                                                        UPF
                                                    </td>
                                                    <td rowspan="2" class="kanan"> :</td>
                                                    <td style="border-bottom: none; ">
                                                        Tanggal Operasi
                                                    </td>
                                                    <td class="kanan" style="border-bottom: none;" colspan="2">:</td>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <!-- <td></td>
                                                    <td></td> -->
                                                    <td style="border-top: none;">
                                                        Jenis Operasi
                                                    </td>
                                                    <td class="kanan" style="border-top: none;" colspan="2">:</td>
                                                    <!-- <td></td> -->
                                                </tr>
                                                <tr>
                                                    <td class="kiri" colspan="2">RANAP ASAL : </td>
                                                    <td class="kiri">kamar Operasi</td>
                                                    <td class="kanan" colspan="2">:</td>
                                                </tr>
                                                <tr>
                                                    <td style="border-left: 1px solid black; border-right: 1px solid black" colspan="5">
                                                        dr. DPJP : ..................... dr. Anestesi : ............................ Perawat Anestesi : ...................... </td>
                                                    <!-- <td>kamar Operasi</td>
                                                    <td colspan="2">:</td> -->
                                                </tr>

                                                <tr>
                                                    <td class="kiri">Scrub Nurse / Instumen</td>
                                                    <td class="kanan">:</td>
                                                    <td colspan="2">Posisi Operasi Pasien</td>
                                                    <td class="kanan">:</td>
                                                </tr>
                                                <tr>
                                                    <td class="kiri">Asisten I</td>
                                                    <td class="kanan">:</td>
                                                    <td colspan="2">Jenis Sayatan</td>
                                                    <td class="kanan">:</td>
                                                </tr>
                                                <tr>
                                                    <td class="kiri">Asisten II</td>
                                                    <td class="kanan">:</td>
                                                    <td style="border-bottom: none;" colspan="2">Skin Perparasi</td>
                                                    <td style="border-bottom: none;" class="kanan">:</td>
                                                </tr>
                                                <tr>
                                                    <td class="kiri">Skrining Nurse</td>
                                                    <td class="kanan">:</td>
                                                    <td style="border-top: none;" colspan="2">Jenis Pembedahan</td>
                                                    <td style="border-top: none;" class="kanan">:</td>
                                                </tr>

                                                <tr>
                                                    <td class="kiri">Diagnosa Pra-Bedah</td>
                                                    <td colspan="4" class="kanan">:</td>
                                                </tr>

                                                <tr>
                                                    <td class="kiri">Indikasi Operasi</td>
                                                    <td colspan="4" class="kanan">:</td>
                                                </tr>

                                                <tr>
                                                    <td class="kiri">Jenis Operasi</td>
                                                    <td colspan="4" class="kanan">:</td>
                                                </tr>

                                                <tr>
                                                    <td class="kiri">Diagnosa Pasca Bedah</td>
                                                    <td colspan="4" class="kanan">:</td>
                                                </tr>

                                                <tr>
                                                    <td class="kiri">Mulai Operasi Jam</td>
                                                    <td class="kanan">:</td>
                                                    <td class="kanan" style="border-bottom: none;" rowspan="3" colspan="3">
                                                        Jaringan Operasi Asal
                                                        <br>Asal :</br>
                                                        <br>Lokasi : .......</br>
                                                        <br>Dikirin PA :</br>
                                                        <br>Profilaksis Antibiotik .............. Jam Pemberian .......</br>
                                                    </td>
                                                    <!-- <td style="border-bottom: none;" class="kanan">:</td> -->
                                                </tr>
                                                <tr>
                                                    <td class="kiri">Selesai Operasi Jam</td>
                                                    <td class="kanan">:</td>
                                                    <!-- <td style="border-top: none; border-bottom: none;" colspan="2">Lokalisasi</td>
                                                    <td style="border-top: none; border-bottom: none;" class="kanan">:</td> -->
                                                </tr>

                                                <tr>
                                                    <td class="kiri">Lama Operasi Jam</td>
                                                    <td class="kanan">:</td>
                                                    <!-- <td style="border-top: none;" colspan="2">Dikirim PA</td>
                                                    <td style="border-top: none;" class="kanan">:</td> -->
                                                </tr>

                                                <tr>
                                                    <td colspan="5" style="border-left: 1px solid black; border-right: 1px solid black; text-align:center">
                                                        Layanana Jalannya Operasi / Temuan Saat Operasi :
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="border-left: 1px solid black; border-right: 1px solid black; text-align:center">
                                                        Komplikasi Pasca Bedah :
                                                        <br>
                                                        <br>
                                                        <br>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="kiri" style="text-align: left;">
                                                        Jml Pendarahan Hilang
                                                    </td>
                                                    <td class="kanan"> :</td>
                                                    <td colspan="2">
                                                        Transfusi Darah Masuk
                                                        <br>Jenis
                                                    </td>
                                                    <td class="kanan">
                                                        : ....
                                                        <br>: ....
                                                    </td>
                                                    <!-- <td></td> -->
                                                </tr>


                                                <!-- <tr>
                                                    <td class="kiri">Lama Operasi Jam</td>
                                                    <td class="kanan">:</td>
                                                    <td colspan="2" style="border-top: none;">Dikirim PA</td>
                                                    <td style="border-top: none; border-right: 1px solid black;">:....</td>
                                                </tr> -->

                                                <tr>
                                                    <td colspan="2" class="kiri" style="text-align: center;">
                                                        Operator / DPJP
                                                        <br>
                                                        <br>
                                                        <br>
                                                        <br>
                                                        (.................)
                                                    </td>
                                                    <td class="kanan" style="border-top: none; border-left: 1px solid black;" colspan="3">
                                                        Bila Menggunakan Inflan
                                                        <br>Jenis Inflan : ........... No. Reg Inflan ........
                                                        <br>Dipasang di Organ : .................
                                                        <br>Stiker / Barcode
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>

                                        <!-- <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table> -->
                                        <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->

                                    <?php endforeach; ?>


                                    </div>
                </div>
            </div>
        </div>

</body>

</html>
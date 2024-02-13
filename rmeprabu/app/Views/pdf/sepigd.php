<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/images/favicon.ico">
    <title>SEP IGD</title>
    <style type="text/css">
        @page {
            /* margin: 10px 15px; */
            font-size: 14px;
            margin-top: 0.6.cm;
            margin-bottom: 0.cm;
            margin-left: 1.1.cm;
            margin-right: 1.5.cm;
            line-height: 1.1;
            color: black;
            /* font-family: "Arial", "sans-serif"; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            font-size: 14px;
            line-height: 1.1;
            /* font-family: "Arial", "sans-serif"; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: black;
        }

        hr.style1 {
            border-top: 1px solid #8c8b8b;
            width: 100px;
        }

        .bpjs {
            font-size: 10px;
        }

        .divtengah {

            margin-left: 10px;
        }
    </style>

</head>

<body>

    <div class="container-fluid text-dark divtengah">
        <div class="row" style="font-size:100%">
            <div class="col-md-12">
                <div>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <table border="0" style="border-collapse: collapse; text-align: center; width: 90%; height:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 5%; text-align: center;" rowspan="2" line-height: 1>
                                        <div class="img">
                                            <img style="height: 40px;" src="./assets/images/gallery/bpjs.jpeg" width="170px" class="dark-logo" />
                                        </div>
                                    </td>
                                    <td style="width: 90%; text-align: center;" line-height: 1>
                                        <font size=16px>SURAT ELIGIBILTAS PESERTA</font>
                                    </td>
                                    <td style="width: 5%; text-align: center;" rowspan="2" line-height: 1>
                                        <div class="img">
                                            <img style="height: 40px;" src="./assets/images/gallery/muaraenim.png" width="35px" class="dark-logo" />

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 90%; text-align: center;">
                                        <font size="17px"> <?php echo $header2; ?> </font>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>

                <div class="pull-text text-left">
                    <table border="0" style="border-collapse: collapse; width: 100%; height: 10px" cellspacing=0 cellpading=0>
                        <tbody>
                            <?php
                            $tglSep = $row['tglSep'];
                            $create = $row['created_at'];

                            if ($create > $tglSep) {
                                $kata = '(Backdate)';
                            } else {
                                $kata = '';
                            }
                            ?>
                            <tr>
                                <td style="width: 25%;">No. SEP</td>
                                <td style="width: 25%;" colspan="3">: <?= $row['noSep']; ?> <?= $kata; ?></td>
                            </tr>

                            <tr>
                                <td style="width: 25%;">Tgl. SEP</td>
                                <td style="width: 45%;">: <?= date('d-m-Y', strtotime($row['tglSep'])); ?></td>
                                <td style="width: 5%;" rowspan="2">Peserta</td>
                                <td style="width: 25%;" rowspan="2">: <?= $row['jnsPeserta']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">No. Kartu</td>
                                <td style="width: 25%;" colspan="2">: <?= $row['noKartu']; ?> (<?= $row['norm']; ?>)</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Nama Peserta</td>
                                <td style="width: 25%;">: <?= $row['nama']; ?></td>
                                <td style="width: 25%;">Jns.Rawat</td>
                                <td style="width: 25%;">: <?= $row['jnsPelayanan']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Tgl. Lahir</td>
                                <td style="width: 25%;">: <?= date('d-m-Y', strtotime($row['tglLahir'])); ?></td>
                                <td style="width: 25%;">Jns. Kunjungan</td>
                                <?php
                                if ($row['tujuanKunj'] == 0) {
                                    $tujuan = "Normal";
                                }
                                if ($row['tujuanKunj'] == 1) {
                                    $tujuan = "Prosedur";
                                }
                                if ($row['tujuanKunj'] == 2) {
                                    $tujuan = "Konsul Dokter";
                                }
                                ?>
                                <td style="width: 25%;">: <?= $tujuan; ?> (Ke <?= $row['kunjunganke']; ?>)</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">No. Telepon</td>
                                <td style="width: 25%;">: <?= $row['noTelp']; ?></td>
                                <td style="width: 25%;">Poli Perujuk</td>
                                <td style="width: 25%;">: </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Sub/Spesialis</td>
                                <td style="width: 25%;">: <?= $row['poli']; ?></td>
                                <td style="width: 25%;">Kls.Hak</td>
                                <td style="width: 25%;">: <?= $row['hakKelas']; ?></td>

                            </tr>
                            <tr>
                                <td style="width: 25%;">Dokter</td>
                                <td style="width: 25%;" colspan="3">: <?= $namaDokter; ?></td>

                            </tr>
                            <tr>
                                <td style="width: 25%;">Faskes Perujuk</td>
                                <td colspan="3" style="width: 25%;">: </td>
                                <!-- <td style="width: 25%;">Kls. Rawat</td> -->
                                <!-- <td style="width: 25%;">: ?= $row['kelasRawat']; ?></td> -->
                            </tr>
                            <tr>
                                <td style="width: 25%;">Diagnosa Awal</td>
                                <td style="width: 25%;" colspan="3">: <?= $row['diagnosa']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Catatan</td>
                                <td style="width: 25%;">: <?= $row['catatan']; ?></td>
                                <td style="width: 25%;">Penjamin</td>
                                <td style="width: 25%;">:</td>
                            </tr>
                        </tbody>
                    </table>

                <?php endforeach; ?>
                <table style="width: 90%; border-collapse: collapse; height: 90px;" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td class="bpjs" style="width: 46.8369%;" colspan="4">*Saya Menyetujui BPJS Kesehatan menggunakan informasi medis pasien jika diperlukan</td>
                        </tr>
                        <tr>
                            <td class="bpjs" style="width: 46.8369%;" colspan="4">*Sep bukan sebagai bukti penjamin peserta</td>
                        </tr>
                        <tr>
                            <td style="width: 25%; line-height:1" colspan="3"></td>
                            <td style="width: 25%; text-align: center;">Pasien/Keluarga Pasien</td>
                        </tr>

                        <tr style="line-height: 1;">
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">
                            </td>
                        </tr>
                        <tr style="line-height: 1;">
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">
                            </td>
                        </tr>
                        <tr style="line-height: 1;">
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">
                                <hr class="style1" />
                            </td>
                        </tr>
                        <tr style="line-height: 1;">
                            <td class="bpjs" style="width: 25%;" colspan="4">Cetakan Ke 1 <?= date('d-m-Y'); ?> <?= date('H:m:s'); ?> WIB</td>

                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>



    <br>
    <br>

    <br>
    <br>

    <br>
    <br>

    <br>
    <br>

    <br>
    <br>

    <div class="container-fluid text-dark divtengah">
        <div class="row" style="font-size:100%">
            <div class="col-md-12">
                <div>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <table style="border-collapse: collapse; width: 100%; line-height: 1.5" border="1">
                            <tr>
                                <td>
                                    <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 10%; text-align: center;" rowspan="3">
                                                    <div class="img">
                                                        <img style="height: 35;" src="./assets/images/gallery/muaraenim.jpg" width="40px" class="dark-logo" />
                                                    </div>
                                                </td>
                                                <td style="width: 90%; text-align: center;line-height: 1.5;">
                                                    <b>
                                                        <font size="16px"> <?= $header1; ?></font>
                                                    </b>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="width: 90%; text-align: center;">
                                                    <b>
                                                        <font size="18px"> <?php echo $header2; ?> </font>
                                                    </b>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td style="width: 99%; text-align: center;">
                                                    <font size="12px"> <?php echo $alamat; ?> </font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <br>
                            <tr>
                                <td>
                                    <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                                        <br>
                                        <tr>
                                            <td style="width: 2%; line-height: 2"> </td>
                                            <td style="width: 15%;"> </td>
                                            <td style="width: 28%;"> </td>
                                            <td style="width: 15%;"> </td>
                                            <td style="width: 40%;"> </td>
                                        </tr>
                                        <tr>
                                            <td style="line-height: 2"></td>
                                            <td>Nomor RM</td>
                                            <td>: <?= $row['norm']; ?></td>
                                            <td>Registrasi</td>
                                            <td>: <?= $row['journalnumber']; ?></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td style="line-height: 1.5">Nama Peserta</td>
                                            <td style="line-height: 1.5">: <?= $row['nama']; ?></td>
                                            <td style="line-height: 1.5">Poli</td>
                                            <td style="line-height: 1.5">: <?= $row['poli']; ?></td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td style="line-height: 2"><b>&nbsp;&nbsp;&nbsp;&nbsp;/Diagnosa</b></td>
                                            <td colspan="2" style="line-height: 2"><b>: </b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="line-height: 2"><b>&nbsp;&nbsp;&nbsp;&nbsp;Tindakan</b></td>
                                            <td style="line-height: 2" colspan="2"><b>:</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                            </td>
                                            <td colspan="2"></td>
                                            <td colspan="2" style="line-height: 2; text-align:center">Tanda Tangan Dokter
                                                <br>
                                                <br>
                                                <!-- <br> -->
                                                <!-- <br>
                                                <br>
                                                <br>
                                                <br> -->
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2"></td>
                                            <td colspan="2" style="line-height: 2; text-align:center"><?= $namaDokter; ?>
                                                <br>
                                                <br>
                                                <!-- <br> -->
                                            </td>
                                        </tr>

                                    </table>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </table>
                </div>
            </div>
        </div>


</body>

</html>
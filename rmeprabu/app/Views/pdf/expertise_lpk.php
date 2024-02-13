<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" src="./assets/images/faviconkuningan.ico">
    <title>Expertise Laboratorium Patologi Klinik</title>
    <style type="text/css">
        table {

            width: 10%;
        }

        table,
        th,
        td {
            text-align: left;
        }

        footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            background-color: lightblue;
            height: 50px;
            margin-left: 10px;
        }

        p {
            page-break-after: always;
            margin-left: 10px;
        }

        p:last-child {
            page-break-after: never;
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row" style="font-size:60%">
            <div class="col-md-12">
                <div class="pull-text text-center">
                    <div class="col-md-12">
                        <table style="border-collapse: collapse; width: 100%;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 16.4234%; text-align: center;" rowspan="6">
                                        <div class="img">
                                            <img style="height: 40px;" src="./assets/images/gallery/muaraenim.png" width="40" class="dark-logo" />
                                        </div>
                                    </td>
                                    <td style="width: 83.5766%; text-align: center; font-size:13px">
                                        <b>RUMAH SAKIT UMUM DAERAH H. M. RABAIN</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 83.5766%; text-align: center;font-size:11px">
                                        <b>INSTALASI LABORATORIUM KLINIK</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 83.5766%; text-align: center;font-size:10px"><b>Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 83.5766%; text-align: center; font-size:10px"><b>Email : <a href="mailto:labrsud45@gmail.com,">labrsud45@gmail.com,</a> Website : </b></td>
                                </tr>
                                <tr>
                                    <td style="width: 83.5766%; text-align: center; font-size:10px"><b>Penanggung jawab Laboratorium : </b></td>
                                </tr>
                                <tr>
                                    <td style="width: 83.5766%; text-align: center;font-size:11px">
                                        <b>HASIL LABORATORIUM KLINIK</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table style="border-collapse: collapse; width: 100%; height: 108px;" border="0">
                            <tbody>
                                <?php
                                foreach ($datapasien as $row) :
                                ?>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; text-align: left; height: 18px;">No. LAB</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">: <?= $row['journalnumber']; ?></td>
                                        <td style="width: 25%; text-align: left; height: 18px;">TGL PEMERIKSAAN</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">: <?= $row['documentdate']; ?></td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; text-align: left; height: 18px;">No.RM/No.Reg</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">: <?= $row['pasienid']; ?>|<?= $row['journalnumber']; ?></td>
                                        <td style="width: 25%; text-align: left; height: 18px;">&nbsp;</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">&nbsp;</td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; text-align: left; height: 18px;">NAMA PASIEN</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">: <?= $row['pasienname']; ?></td>
                                        <td style="width: 25%; text-align: left; height: 18px;">DOKTER</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">: <?= $row['employeename']; ?></td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; text-align: left; height: 18px;">UMUR PASIEN</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">:</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">SPESIMEN DITERIMA</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">:</td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; text-align: left; height: 18px;">JENIS KELAMIN</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">: <?= $row['pasiengender']; ?></td>
                                        <td style="width: 25%; text-align: left; height: 18px;">TGL HASIL SELESAI</td>
                                        <td style="width: 25%; text-align: left; height: 18px;">:</td>
                                    </tr>
                                    <tr style="height: 18px;">
                                        <td style="width: 25%; text-align: left; height: 18px;">ALAMAT</td>
                                        <td style="width: 25%; text-align: left; height: 18px;" colspan="3">: <?= $row['pasienaddress']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 25%; text-align: left;">ASAL PASIEN</td>
                                        <td style="width: 25%; text-align: left;">: <?= $row['asalDaftar']; ?>|<?= $row['roomname']; ?></td>
                                        <td style="width: 25%; text-align: left;">STATUS PASIEN</td>
                                        <td style="width: 25%; text-align: left;">:</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr>
                        <table style="border-collapse: collapse; width: 100%; height: 36px;" border="1">
                            <thead>
                                <tr style="height: 18px;">
                                    <th style="width: 20%; height: 18px; text-align: center;">PEMERIKSAAN</th>
                                    <th style="width: 4%; height: 18px; text-align: center;">&nbsp;</th>
                                    <th style="width: 30%; height: 18px; text-align: center;">HASIL</th>
                                    <th style="width: 5%; height: 18px; text-align: center;">SATUAN</th>
                                    <th style="width: 30%; height: 18px; text-align: center;">NILAI RUJUKAN</th>
                                    <th style="width: 10%; height: 18px; text-align: center;">METODE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($pemeriksaan as $row) :
                                ?> <tr style="height: 18px;">
                                        <td style="width: 20%; height: 18px; text-align: left;"><?= $row['name']; ?></td>
                                        <td style="width: 4%; height: 18px; text-align: center;">&nbsp;</td>
                                        <td style="width: 30%; height: 18px; text-align: center;">&nbsp;</td>
                                        <td style="width: 5%; height: 18px; text-align: center;">&nbsp;</td>
                                        <td style="width: 30%; height: 18px; text-align: center;">&nbsp;</td>
                                        <td style="width: 10%; height: 18px; text-align: center;">&nbsp;</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <br>
                        <table style="border-collapse: collapse; width: 100%;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 100%;"><?= $expertise; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table style="border-collapse: collapse; width: 100%;" border="0">
                            <tbody>
                                <?php
                                foreach ($datapasien as $row) :
                                ?>
                                    <tr>
                                        <td style="width: 100%; text-align: right;">Pemeriksa,</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%; text-align: right; height:100px;"><?= $row['employeename']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <footer>
                            <p><b>Nb: <i>Hasil berupa angka menggunakan sistem desimal dengan separator tiitk</i></b>
                                <br>
                                <i>Dicetak Pada Tanggal, <?= date('d-m-Y h:m'); ?></i>
                            </p>

                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
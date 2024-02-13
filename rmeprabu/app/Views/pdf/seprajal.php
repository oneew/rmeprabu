<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/images/favicon.ico">
    <title>SEP Rawat Jalan</title>
    <style type="text/css">
        @page {
            margin: 22px;
            margin-top: 3px;
            font-family: Arial;
            color: #000000;

        }

        body {
            margin: 1px;
            width: 21.59cm;
            height: 9cm;
            margin-top: 0px;
            font-family: arial;
            color: #000000;
        }

        hr.style1 {
            border-top: 1px solid #8c8b8b;
            width: 100px;
        }

        .bpjs {
            font-size: 8px;
            color: #000000;
        }

        .divtengah {

            margin-left: 10px;
        }

        table {
            font-family: arial;
            color: #000000;
        }

        table tr {
            font-family: arial;
            color: #000000;
        }

        table td {
            font-family: arial;
            color: #000000;
        }

        p {
            font-family: arial;
            color: #000000;
        }

        @font-face {
            font-family: "arial";
            src: local("Source Sans Pro"), url("fonts/sourcesans/sourcesanspro-regular-webfont.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;

        }
    </style>

</head>

<body>

    <div class="container-fluid text-dark divtengah">
        <div class="row" style="font-size:60%">
            <div class="col-md-12">
                <div>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <table border="0" style="border-collapse: collapse; text-align: center; width: 90%; height:10px">
                            <tbody>
                                <tr>
                                    <td style="width: 25%;" rowspan="2">
                                        <img style="height: 30px;" src="./assets/images/gallery/bpjs.jpeg" width="100" class="dark-logo" />
                                    </td>
                                    <td style="width: 33.2829%; text-align: center; font-family: Arial;" colspan="2"><b>SURAT ELIGIBILTAS PESERTA</b></td>
                                    <td style="width: 25%;" rowspan="2">
                                        <div class="img text-right">
                                            <img style="height: 20px;" src="./assets/images/gallery/muaraenim.png" width="40" class="dark-logo" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 33.2829%; text-align: center;" colspan="2">
                                        <b><?= $header2; ?></b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <div class="pull-text text-left">
                    <table border="0" style="border-collapse: collapse; width: 90%; height: 10px" cellspacing=0 cellpading=0>
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
                                <td style="width: 25%; font-family: Arial;">No.SEP</td>
                                <td style="width: 25%;" colspan="3">: <?= $row['noSep']; ?> <b><?= $kata; ?></b></td>
                            </tr>

                            <tr>
                                <td style="width: 25%;">Tgl.SEP</td>
                                <td style="width: 45%;">: <?= $row['tglSep']; ?></td>
                                <td style="width: 5%;">Peserta</td>
                                <td style="width: 25%;">: <?= $row['jnsPeserta']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">No.Kartu</td>
                                <td style="width: 25%;" colspan="3">: <?= $row['noKartu']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Nama Peserta</td>
                                <td style="width: 25%;">: <?= $row['nama']; ?> (<?= $row['norm']; ?>)</td>
                                <td style="width: 25%;">Jns.Rawat</td>
                                <td style="width: 25%;">: <?= $row['jnsPelayanan']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Tgl.Lahir</td>
                                <td style="width: 25%;">: <?= $row['tglLahir']; ?></td>
                                <td style="width: 25%;">Jns.Kunjungan</td>
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
                                <td style="width: 25%;">No.Telepon</td>
                                <td style="width: 25%;">: <?= $row['noTelp']; ?></td>
                                <td style="width: 25%;">Poli Perujuk</td>
                                <td style="width: 25%;">: 0</td>
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
                                <td style="width: 25%;">: </td>
                                <td style="width: 25%;">Kls.Rawat</td>
                                <td style="width: 25%;">: <?= $row['kelasRawat']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Diagnosa Awal</td>
                                <td style="width: 25%;" colspan="3">: <?= $row['diagnosa']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Catatan</td>
                                <td style="width: 25%;">:<?= $row['catatan']; ?></td>
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
                            <td style="width: 25%;" colspan="3"></td>
                            <td style="width: 25%; text-align: center;">Pasien/Keluarga Pasien</td>
                        </tr>
                        <tr>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">

                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">&nbsp;</td>
                            <td style="width: 25%;">
                                <hr class="style1" />
                            </td>
                        </tr>
                        <tr>
                            <td class="bpjs" style="width: 25%;" colspan="4">Cetakan Ke 1 <?= date('d-m-Y'); ?> <?= date('h:m:s'); ?> Wib</td>

                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
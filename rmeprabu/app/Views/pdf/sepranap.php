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
            /* margin: 10px 15px; */
            font-size: 12px;
            margin-top: 0.6.cm;
            margin-bottom: 0.cm;
            margin-left: 1.3.cm;
            margin-right: 1.7.cm;
            line-height: 1.1;
            color: black;
            font-family: "Arial", "sans-serif";
        }

        body {
            font-size: 12px;
            line-height: 1.1;
            font-family: "Arial", "sans-serif";
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
                                            <img style="height: 40px;" src="./assets/images/gallery/bpjs.jpeg" width="120px" class="dark-logo" />
                                        </div>
                                    </td>
                                    <td style="width: 60%; text-align: center;" line-height: 1>
                                        <font size=14px>SURAT ELIGIBILTAS PESERTA</font>
                                    </td>
                                    <td style="width: 5%; text-align: center;" rowspan="2" line-height: 1>
                                        <div class="img">
                                            <img style="height: 30px;" src="./assets/images/gallery/muaraenim.png" width="40" />

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 60%; text-align: center;">
                                        <font size="16px"> RSUD H.M. RABAIN</font>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>

                <div class="pull-text text-left">
                    <table border="0" style="border-collapse: collapse; width: 90%;" cellspacing=0 cellpading=0>
                        <tbody>
                            <?php
                            $tglSep = $row['tglSep'];
                            $create = $row['created_at'];

                            if ($create > $tglSep) {
                                $kata = 'Backdate';
                            } else {
                                $kata = '';
                            }
                            ?>
                            <tr>
                                <td style="width: 25%;">No.SEP</td>
                                <td style="width: 25%;" colspan="3">: <?= $row['noSep']; ?> (<b><?= $kata; ?></b>)</td>
                            </tr>

                            <tr>
                                <td style="width: 25%;">Tgl.SEP</td>
                                <td style="width: 45%;">: <?= $row['tglSep']; ?></td>
                                <td style="width: 5%;">Peserta</td>
                                <td style="width: 25%;" rowspan="2">: <?= $row['jnsPeserta']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">No.Kartu</td>
                                <td style="width: 25%;" colspan="2">: <?= $row['noKartu']; ?> (<?= $row['norm']; ?>)</td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Nama Peserta</td>
                                <td style="width: 25%;">: <?= $row['nama']; ?></td>
                                <td style="width: 25%;">Jns.Rawat</td>
                                <td style="width: 25%;">: <?= $row['jnsPelayanan']; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">Tgl.Lahir</td>
                                <td style="width: 25%;">: <?= $row['tglLahir']; ?></td>
                                <td style="width: 25%;">Jns.Kunjungan</td>

                                <td style="width: 25%;">: </td>
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
                            <td class="bpjs" style="width: 25%;" colspan="4">Cetakan Ke 1 <?= date('d-m-Y'); ?> <?= date('h:m:s'); ?> WIB</td>

                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
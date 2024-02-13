<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Sertifikat Kematian</title>
    <style type="text/css">
        table {

            width: 10%;

        }

        table,
        th,
        td {
            text-align: left;
            padding: 5px;
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row" style="font-size:60%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; border=" 0">
                    <tbody>
                        <tr>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/pemkab.jpeg" width="40" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 53.3333%; text-align: center;">
                                <h6><b class="text-info"><?= $header1; ?></b></h6>
                            </td>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/pemkab.jpeg" width="40" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;">
                                <h5><b><?= $header2; ?></b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;"><?= $alamat; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;">
                                <b>
                                    <u>
                                        <h6> <?= $deskripsi; ?></h6>
                                    </u>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="pull-text text-left">
                    <table style="height: 324px; width: 100%; border-collapse: collapse;" border="1" cellspacing="40">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <tr style="height: 18px;">
                                    <td style="width: 101.46%; height: 18px;" colspan="4"><strong>No. Surat : <?= $row['journalnumber']; ?></strong></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 101.46%; height: 18px;" colspan="4"><strong>I. Identitas Jenazah</strong></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Nomor Rekam Medis</td>
                                    <td style="width: 23.5822%; height: 18px;" colspan="3">: <?= $row['pasienid']; ?></td>

                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Nama Lengkap</td>
                                    <td style="width: 23.5822%; height: 18px;" colspan="3">: <?= $row['pasienname']; ?></td>

                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">No. Induk Kependudukan</td>
                                    <td style="width: 23.5822%; height: 18px;">: <?= $row['nik']; ?></td>
                                    <td style="width: 26.0949%; height: 18px;">No. Kartu keluarga</td>
                                    <td style="width: 17.5931%; height: 18px;">:</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Jenis kelamin</td>
                                    <td style="width: 23.5822%; height: 18px;" colspan="3">: <?= $row['pasiengender']; ?></td>

                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Tempat Lahir</td>
                                    <td style="width: 23.5822%; height: 18px;">: <?= $row['placeofbirth']; ?></td>
                                    <td style="width: 26.0949%; height: 18px;">Tanggal Lahir</td>
                                    <td style="width: 17.5931%; height: 18px;">: <?= $row['pasiendateofbirth']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Alamat</td>
                                    <td style="width: 67.2702%; height: 18px;" colspan="3">: <?= $row['alamat']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Kelurahan</td>
                                    <td style="width: 23.5822%; height: 18px;">: <?= $row['kelurahan']; ?></td>
                                    <td style="width: 26.0949%; height: 18px;">Kecamatan</td>
                                    <td style="width: 17.5931%; height: 18px;">: <?= $row['kecamatan']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Kabupaten/Kota</td>
                                    <td style="width: 23.5822%; height: 18px;">: <?= $row['kabupatenkota']; ?></td>
                                    <td style="width: 26.0949%; height: 18px;">Propinsi</td>
                                    <td style="width: 17.5931%; height: 18px;">: <?= $row['propinsi']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Status Kependudukan</td>
                                    <td style="width: 23.5822%; height: 18px;">: <?= $row['wna']; ?></td>
                                    <td style="width: 26.0949%; height: 18px;">Hubungan keluarga</td>
                                    <td style="width: 17.5931%; height: 18px;">: <?= $row['hubungan_dengan_pjb']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Waktu Meninggal</td>
                                    <td style="width: 23.5822%; height: 18px;">: <?= $row['datedie']; ?></td>
                                    <td style="width: 26.0949%; height: 18px;">Pukul</td>
                                    <td style="width: 17.5931%; height: 18px;">: <?= $row['timedie']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Tempat Meninggal</td>
                                    <td style="width: 23.5822%; height: 18px;" colspan="3">: <?= $row['locationdie']; ?></td>

                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;" colspan="4"><strong>II. Keterangan Khusus Kasus Kematian Di Rumah Atau Alainnya</strong></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Status Jenazah</td>
                                    <td style="width: 23.5822%; height: 18px;">: <?php if ($row['status_jenazah'] == 0) {
                                                                                        echo " Belum Dimakankan";
                                                                                    } else {
                                                                                        echo " Sudah Dimakamkan";
                                                                                    } ?></td>
                                    <td style="width: 26.0949%; height: 18px;">Nama Pemeriksa</td>
                                    <td style="width: 17.5931%; height: 18px;">: <?= $row['dokter_forensik']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Waktu Pemeriksaan</td>
                                    <td style="width: 23.5822%; height: 18px;">: <?= $row['date_periksa']; ?></td>
                                    <td style="width: 26.0949%; height: 18px;">Jam periksa</td>
                                    <td style="width: 17.5931%; height: 18px;">: <?= $row['time_periksa']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;" colspan="4"><strong>III. Penyebab Kematian</strong></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Dasar Diagnosis</td>
                                    <td style="width: 23.5822%; height: 18px;" colspan="3">: <?php
                                                                                                if ($row['dasar_rm'] == 1) {
                                                                                                    echo "Rekam Medis ";
                                                                                                }

                                                                                                if ($row['dasar_pemeriksaan_luar'] == 1) {
                                                                                                    echo ",Pemeriksaan Luar Jenazah ";
                                                                                                }

                                                                                                if ($row['dasar_autopsi_forensik'] == 1) {
                                                                                                    echo ",Autopsi Forensik ";
                                                                                                }

                                                                                                if ($row['dasar_autopsi_medis'] == 1) {
                                                                                                    echo ",Autopsi Medis ";
                                                                                                }

                                                                                                if ($row['dasar_autopsi_verbal'] == 1) {
                                                                                                    echo ",Autopsi Verbal ";
                                                                                                }

                                                                                                if ($row['dasar_lain'] == 1) {
                                                                                                    echo ",Surat Keterangan Lainnya ";
                                                                                                }

                                                                                                ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 34.1897%; height: 18px;">Kelompok Penyebab Kematian</td>
                                    <td style="width: 23.5822%; height: 18px;" colspan="3">: <?= $row['penyebab_kematian']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <br>
                <?php

                $tanggal = "2021-01-01";
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
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Sukabumi, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">Pihak Yang Menerima</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Dokter Yang Menerangkan</td>
                            </tr>
                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>

                                <tr style="height: 18px;">
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" />
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['dokter_signature']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr style="height: 30px;">

                                    <td style="width: 50%; text-align: center; height: 18px;"><u>Keluarga</u></td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['dokter_forensik']; ?></u></td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
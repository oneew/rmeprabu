<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Bukti Pelayanan Ambulance</title>
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
                                    <img style="height: 40px;" src="./assets/images/gallery/muaraenim.png" width="40" class="dark-logo" />

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
                                    <h6> <?= $deskripsi; ?></h6>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%;   height: 10px; line-height: 1;" border="0">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <tr>
                                    <td style="width: 25%;">Nama pasien</td>
                                    <td style="width: 65%;">: <?php echo $row['pasienname']; ?></td>
                                    <td style="width: 10%;"> (<?php echo $row['pasiengender']; ?>)</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">No. Rekam medik</td>
                                    <td style="width: 75%;">: <?php echo $row['pasienid']; ?> | <?php echo $row['pasiengender']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Tgl Lahir</td>
                                    <td style="width: 75%;">: <?php echo $row['pasiendateofbirth']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Tanggal Keberangkatan</td>
                                    <td style="width: 25%;">: <?php echo $row['datego']; ?></td>
                                    <td style="width: 10%;">Waktu</td>
                                    <td style="width: 40%;">: <?php echo $row['datetimego']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Diagnosa</td>
                                    <td style="width: 75%;">: <?php echo $row['diagnosa']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Kondisi Pasien</td>
                                    <td style="width: 75%;">: <?php echo $row['kondisipasien']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Kesadaran</td>
                                    <td style="width: 75%;">: <?php echo $row['kesadaran']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Tanda Vital</td>
                                    <td style="width: 75%;">: <?php echo $row['tandavital']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Tekanan Darah</td>
                                    <td style="width: 25%;">: <?php echo $row['tekanandarah']; ?> mmHg</td>
                                    <td style="width: 25%;">Nadi</td>
                                    <td style="width: 25%;">: <?php echo $row['nadi']; ?> x/menit</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Respirasi</td>
                                    <td style="width: 25%;">: <?php echo $row['respirasi']; ?> x/menit</td>
                                    <td style="width: 25%;">Saturasi O2</td>
                                    <td style="width: 25%;">: <?php echo $row['saturasi']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Asal Ruangan</td>
                                    <td style="width: 25%;">: <?php echo $row['roomname']; ?></td>
                                    <td style="width: 25%;">Nomor Bed</td>
                                    <td style="width: 25%;">: <?php echo $row['bednumber']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Tujuan</td>
                                    <td style="width: 25%;">: <?php echo $row['alamattujuan']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Kelurahan</td>
                                    <td style="width: 25%;">: <?php echo $row['kelurahan']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Kecamatan</td>
                                    <td style="width: 25%;">: <?php echo $row['kecamatan']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Kabupaten/Kota</td>
                                    <td style="width: 25%;">: <?php echo $row['kabupatenkota']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Propinsi</td>
                                    <td style="width: 25%;">: <?php echo $row['propinsi']; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="width: 100%;"><b>Alat Yang Dipersiapkan Dalam Ambulance</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">SyringePump</td>
                                    <td style="width: 25%;">: <?php if ($row['syringepump'] == 1) {
                                                                    echo "Ya";
                                                                } else {
                                                                    echo "Tidak";
                                                                } ?></td>
                                    <td style="width: 25%;">Ventilator Transport</td>
                                    <td style="width: 25%;">: <?php if ($row['ventilatortransport'] == 1) {
                                                                    echo "Ya";
                                                                } else {
                                                                    echo "Tidak";
                                                                } ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Infusion Pump</td>
                                    <td style="width: 25%;">: <?php if ($row['infusonpump'] == 1) {
                                                                    echo "Ya";
                                                                } else {
                                                                    echo "Tidak";
                                                                } ?></td>
                                    <td style="width: 25%;">Monitor</td>
                                    <td style="width: 25%;">: <?php if ($row['monitor'] == 1) {
                                                                    echo "Ya";
                                                                } else {
                                                                    echo "Tidak";
                                                                } ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Alat Lain :</td>
                                    <td style="width: 75%;">: <?php echo $row['alatlain']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Obat-obatan :</td>
                                    <td style="width: 75%;">: <?php echo $row['obat']; ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <?php
                $tanggal = $row['documentdate'];
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
                                <td style="width: 50%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">Perawat Ruangan</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Petugas Ambulance</td>
                            </tr>
                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>

                                <tr style="height: 18px;">
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signatureperawat']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturesupir']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr style="height: 30px;">

                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['perawatruangan']; ?></u></td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['updatedby']; ?></u></td>
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
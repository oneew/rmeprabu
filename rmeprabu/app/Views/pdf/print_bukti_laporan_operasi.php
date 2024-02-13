<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Laporan Operasi Operasi</title>
    <style type="text/css">
        table {

            width: 10%;
        }

        table,
        th,
        td {
            text-align: left;
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
                                    <img style="height: 40px;" src="./assets/images/gallery/pemkab.png" width="40" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 53.3333%; text-align: center;">
                                <h6><b class="text"><?= $header1; ?></b></h6>
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
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <tr>
                                    <td style="width: 25%;">No. RM</td>
                                    <td style="width: 25%;">: <?php echo $row['pasienid']; ?></td>
                                    <td style="width: 25%;">Nama Pasien</td>
                                    <td style="width: 25%;">: <?php echo $row['pasienname']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Jenis Kelamin</td>
                                    <td style="width: 25%;">: <?php echo $row['pasiengender']; ?></td>
                                    <td style="width: 25%;">Tanggal Lahir</td>
                                    <td style="width: 25%;">: <?php echo $row['pasiendateofbirth']; ?></td>
                                </tr>
                                <?php
                                $tanggal = $row['created_at'];
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

                        </tbody>
                    </table>
                </div>
                <br>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 288px;" border="1">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">Ruang Operasi</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['ruang']; ?></td>
                                <td style="width: 25%; height: 18px;">Kamar Operasi</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['operatorroom']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">Dokter Operator</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['ibsdoktername']; ?></td>
                                <td style="width: 25%; height: 18px;">Dokter Anestesi</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['ibsanestesiname']; ?></td>
                            </tr>
                            <tr style="height: 36px;">
                                <td style="width: 25%; height: 36px;">Perawat Instrumen</td>
                                <td style="width: 25%; height: 36px;">: <?= $row['perawatinstrumen']; ?></td>
                                <td style="width: 25%; height: 36px;">Penata Anestesi</td>
                                <td style="width: 25%; height: 36px;">: <?= $row['penataanestesi']; ?></td>
                            </tr>
                            <tr style="height: 36px;">
                                <td style="width: 25%; height: 36px;">Jenis Anestesi</td>
                                <td style="width: 25%; height: 36px;">: <?= $row['jenisanestesi']; ?></td>
                                <td style="width: 25%; height: 36px;">Obat-obat Anestesi</td>
                                <td style="width: 25%; height: 36px;">: <?= $row['obatanestesi']; ?></td>
                            </tr>
                            <tr style="height: 36px;">
                                <td style="width: 25%; height: 36px;">Diagnosa Pra Bedah</td>
                                <td style="width: 25%; height: 36px;">: <?= $row['diagnosaprabedah']; ?></td>
                                <td style="width: 25%; height: 36px;">Diagnosa Pasca Bedah</td>
                                <td style="width: 25%; height: 36px;">: <?= $row['diagnosapascabedah']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">Indikasi Operasi</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['indikasioperasi']; ?></td>
                                <td style="width: 25%; height: 18px;">Jenis Operasi</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['jenisoperasi']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">Disinfeksi Kulit</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['disinfeksikulit']; ?></td>
                                <td style="width: 25%; height: 18px;">Eksisi</td>
                                <td style="width: 25%; height: 18px;">: <?php if ($row['eksisi'] == '1') {
                                                                            echo " Ya";
                                                                        } else {
                                                                            echo "Tidak";
                                                                        }  ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">Dibawa Ke PA</td>
                                <td style="width: 25%; height: 18px;">: <?php if ($row['pa'] == '1') {
                                                                            echo " Ya";
                                                                        } else {
                                                                            echo "Tidak";
                                                                        }  ?></td>
                                <td style="width: 25%; height: 18px;">Dibawa Ke Lab</td>
                                <td style="width: 25%; height: 18px;">: <?php if ($row['lab'] == '1') {
                                                                            echo " Ya";
                                                                        } else {
                                                                            echo "Tidak";
                                                                        }  ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">Jenis bahan</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['jenisbahan']; ?></td>
                                <td style="width: 25%; height: 18px;">Waktu Operasi</td>
                                <td style="width: 25%; height: 18px;">:(<?= $row['tanggaloperasi']; ?>) <?= $row['mulaioperasi']; ?> sd <?= $row['selesai']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">Durasi Operasi</td>
                                <td style="width: 25%; height: 18px;">: <?= $row['durasi']; ?></td>
                                <td style="width: 25%; height: 18px;">Transfusi</td>
                                <td style="width: 25%; height: 18px;">: <?php if ($row['transfusi'] == '1') {
                                                                            echo " Ya";
                                                                        } else {
                                                                            echo "Tidak";
                                                                        }  ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 25%; height: 18px;">PRC</td>
                                <td style="width: 25%; height: 18px;">: <?php if ($row['prc'] == '1') {
                                                                            echo " Ya";
                                                                        } else {
                                                                            echo "Tidak";
                                                                        }  ?></td>
                                <td style="width: 25%; height: 18px;">WB</td>
                                <td style="width: 25%; height: 18px;">: <?php if ($row['wb'] == '1') {
                                                                            echo " Ya";
                                                                        } else {
                                                                            echo "Tidak";
                                                                        }  ?></td>
                            </tr>
                            <tr style="height: 36px;">
                                <td style="width: 25%; height: 36px;">Laporan Jalan Operasi</td>
                                <td style="width: 25%; height: 36px;" colspan="3"> <?= $row['jalanoperasi']; ?></td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <table style="border-collapse: collapse; width: 100%;" border="1">
                        <tbody>
                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>
                                <tr>
                                    <td class="text-left" style="width: 27.1898%; text-align: center;">Yang Membuat Laporan </td>
                                </tr>
                                <tr>
                                    <td class="text-left" style="width: 100%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signature_dokteroperator']; ?>" />
                                            </div>
                                        </div>
                                        <div class="el-card-content">
                                            <small><?= $tanda['ibsdoktername']; ?></small>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <br>




            </div>
        </div>
    </div>
</body>

</html>
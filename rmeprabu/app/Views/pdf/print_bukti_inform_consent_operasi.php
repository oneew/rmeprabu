<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Form Persetujuan Tindakan Operasi</title>
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
                                    <img style="height: 40px;" src="./assets/images/gallery/pemkot.jpeg" width="40" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 53.3333%; text-align: center;">
                                <h6><b class="text"><?= $header1; ?></b></h6>
                            </td>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/bunut.jpeg" width="40" class="dark-logo" />

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

                        </tbody>
                    </table>
                </div>
                <br>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 198px;" border="1">
                        <tbody>
                            <tr style="height: 18px;">
                                <td class="text-center" style="text-align: center; height: 18px; width: 184.05%;" colspan="5"><b>PEMBERIAN INFORMASI</b></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 52.281%; height: 18px;" colspan="3">Pelaksana Tindakan</td>
                                <td style="width: 131.769%; height: 18px;" colspan="2">: <?= $row['ibsdoktername']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 52.281%; height: 18px;" colspan="3">Pemberi Informasi</td>
                                <td style="width: 131.769%; height: 18px;" colspan="2">: <?= $row['pemberiinformasi']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 52.281%; height: 18px;" colspan="3">Penerima Informasi/ Pemberi Persetujuan</td>
                                <td style="width: 131.769%; height: 18px;" colspan="2">: <?= $row['penerimainformasi']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td class="text-center" style="width: 0.29195%; height: 18px; text-align: center;"><b>No</b></td>
                                <td class="text-center" style="width: 60.9672%; height: 18px; text-align: center;"><b>JENIS INFORMASI</b></td>
                                <td class="text-center" style="height: 18px; text-align: center; width: 137.791%;" colspan="3"><b>ISI INFORMASI</b></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td class="text-center" style="width: 0.29195%; height: 18px; text-align: center;">1</td>
                                <td style="width: 40.9672%; height: 18px;">Diagnosa Dan Dasar Diagnosa</td>
                                <td style="height: 18px; width: 137.791%;" colspan="3"><?= $row['diagnosis']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td class="text-center" style="width: 0.29195%; text-align: center; height: 18px;">2</td>
                                <td style="width: 40.9672%; height: 18px;">Kondisi Pasien</td>
                                <td style="height: 18px; width: 137.791%;" colspan="3"><?= $row['kondisipasien']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td class="text-center" style="width: 0.29195%; text-align: center; height: 18px;">3</td>
                                <td style="width: 40.9672%; height: 18px;">Tindakan Kedokteran Yang Diusulkan</td>
                                <td style="height: 18px; width: 137.791%;" colspan="3"><?= $row['name']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td class="text-center" style="width: 0.29195%; text-align: center; height: 18px;">4</td>
                                <td style="width: 40.9672%; height: 18px;">Tata Cara Dan Tujuan Tindakan</td>
                                <td style="height: 18px; width: 137.791%;" colspan="3"><?= $row['tatacara']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td class="text-center" style="width: 0.29195%; text-align: center; height: 18px;">5</td>
                                <td style="width: 40.9672%; height: 18px;">Manfaat Tindakan</td>
                                <td style="height: 18px; width: 137.791%;" colspan="3"><?= $row['manfaattindakan']; ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td class="text-center" style="width: 0.29195%; text-align: center; height: 18px;">6</td>
                                <td style="width: 40.9672%; height: 18px;">Risiko Tindakan</td>
                                <td style="height: 18px; width: 137.791%;" colspan="3"><?= $row['risikotindakan']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 0.29195%; text-align: center;">7</td>
                                <td style="width: 40.9672%;">Nama Orang Yang Mengerjakan Tindakan</td>
                                <td style="width: 137.791%;" colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 0.29195%; text-align: center;">8</td>
                                <td style="width: 40.9672%;">Kemungkinan Alternatif Tindakan</td>
                                <td style="width: 137.791%;" colspan="3"><?= $row['alternatif']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 0.29195%; text-align: center;">9</td>
                                <td style="width: 40.9672%;">Prognosis Dari Tindakan</td>
                                <td style="width: 137.791%;" colspan="3"><?= $row['prognosistindakan']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 0.29195%; text-align: center;">10</td>
                                <td style="width: 40.9672%;">Kemungkinan Hasil Yang Tidak Terduga</td>
                                <td style="width: 137.791%;" colspan="3"><?= $row['hasiltidakterduga']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 0.29195%; text-align: center;">11</td>
                                <td style="width: 40.9672%;">Kemungkinan Hasil Bila Tidak Dilakukan Tindakan</td>
                                <td style="width: 137.791%;" colspan="3"><?= $row['bilatidakditindak']; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;" colspan="4">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal di atas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan/atau berdiskusi</td>
                                <td style="width: 50%; text-align: center; height: 18px;">
                                    <div class="col-md-12">
                                        <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $row['signature_diskusi']; ?>" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 83.2288%; text-align: left;" colspan="4">Dengan ini menyatakan bahwa saya telah menerima informasi dari dokter dan &nbsp;<strong><em>telah memahaminya</em></strong>.</td>
                                <td style="width: 50%; text-align: center; height: 18px;">
                                    <div class="col-md-12">
                                        <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $row['signature_informasi']; ?>" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table style="border-collapse: collapse; width: 100%;" border="1">
                        <tbody>
                            <tr>
                                <td class="text-center" style="width: 27.1898%; text-align: center;" colspan="4"><strong>PERSETUJUAN / PENOLAKAN UPAYA TINDAKAN KEDOKTERAN</strong><strong><br /></strong><strong><br /></strong></td>
                            </tr>
                            <tr>
                                <td style="width: 100%;" colspan="4">
                                    <p>Saya, yang bertanda tangan di bawah ini bernama &nbsp;<u><?= $row['pasienname']; ?>,</u> tanggal lahir &nbsp;<u> <?= $row['pasiendateofbirth']; ?>,</u>&nbsp;&nbsp;<?php if ($row['pasiengender'] == "L") {
                                                                                                                                                                                                                echo "Laki-laki";
                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                echo "Perempuan";
                                                                                                                                                                                                            } ?> , alamat<u>&nbsp; <?= $row['alamatpjb']; ?></u>, dengan ini menyatakan <strong><em>PERSETUJUAN/<strike>PENOLAKAN</strike> *) &nbsp;</em></strong><em>untuk &nbsp;dilakukan &nbsp;tindakan</em> &nbsp;<b><?= $row['name']; ?></b>** (<strong><em>setelah mendapatkan persetujuan dari </em></strong><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;dengan alasan ________________________________) terhadap saya */<u>&shy;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>saya*, nama<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ,</u> tanggal lahir <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;,</u> laki-laki/perempuan*, &nbsp;alamat<u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                    <p>Saya memahami perlunya dan manfaat tindakan sebagaimana telah dijelaskan seperti diatas kepada saya/ <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>saya*, termasuk risiko dan komplikasi yang mungkin timbul apabila tindakan tersebut tidak dilakukan.</p>
                                    <p>Saya juga menyadari bahwa dokter melakukan suatu upaya dan oleh karena ilmu kedokteran bukanlah ilmu pasti maka keberhasilan tindakan kedokteran bukanlah keniscayaan, melainkan sangat tergantung pada izin Tuhan Yang Maha Esa.</p>
                                </td>
                            </tr>
                            <?php
                            $tanggal = $row['date_informconcent'];
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
                            <tr>
                                <td style="width: 100%; text-align: right;" colspan="4">Sukabumi, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>
                                <tr>
                                    <td class="text-center" style="width: 27.1898%; text-align: center;">Yang Menyatakan</td>
                                    <td class="text-center" style="width: 33.9416%; text-align: center;">Saksi 1</td>
                                    <td class="text-center" style="text-align: center;" colspan="2">Saksi 2</td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signature_informasi']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center" style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signature_diskusi']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 27.1898%;">&nbsp;</td>
                                    <td style="width: 33.9416%;">&nbsp;</td>
                                    <td style="width: 26.3686%;" colspan="2">&nbsp;</td>
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
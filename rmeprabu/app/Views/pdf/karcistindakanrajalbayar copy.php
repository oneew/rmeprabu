<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/muaraenim.ico">
    <title>Kwitansi Tindakan Rawat Jalan</title>
    <style type="text/css">
        @page {
            /* margin: 20px 15px; */
            margin: 0;
            font-size: 12px;
        }

        body {
            /* margin: 0px; */
            margin-top: 0.3.cm;
            margin-left: 1.cm;
            margin-right: 1.cm;
            margin-bottom: 0.cm;
            font-size: 12px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        h5 {
            display: block;
            font-size: 2em;
            margin-top: 1.67em;
            margin-bottom: 0.67em;
            margin-left: 0.4;
            margin-right: 0;
            font-weight: bold;
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid text-dark">
        <div class="row">
            <div class="pull-text text-left;">
                <?php
                foreach ($datapasien as $row) :
                ?>
                    <table style="border-collapse: collapse; line-height: 1; width:100%;" border="0">
                        <tbody>
                            <tr>
                                <!-- <td style="width: 15%; text-align: center;" rowspan="3"> -->
                                <td style="width: 2.cm; text-align: left;" rowspan="3">
                                    <div class="img">
                                        <img style="height: 45px;" src="./assets/images/gallery/pemkab.png" width="45px" class="dark-logo" />
                                    </div>
                                </td>
                                <td style="text-align: left; width:16.cm">
                                    <font size="14px">PEMERINTAH KABUPATEN MUARA ENIM</font>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left">
                                    <b>
                                        <font size="18px">RSUD DR. H. MOHAMAD RABAIN</font>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <font size="1">Jalan Sultan Mahmud Badaruddin II No. 49 Muara Enim Telp 0734-424354 Fax 0834-422738 Kode Pos 31314</font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top: -4;">
                                    <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 100%; text-align: center; line-height :1" colspan="2">
                                    <b>
                                        <font size="3"><u>K U I T A N S I</u></font>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%; height: 15px; text-align:center" colspan="2">No. : <?= $row['journalnumber']; ?> - <?= $row['id']; ?></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->

            <div class="pull-text text-left">
                <table style="border-collapse: collapse; width: 100%;" border="0">
                    <thead>

                        <tr style="height: 16px;">
                            <td style="width: 20%;">Sudah Terima Dari</td>
                            <td style="width: 69.8905%;">: <?= $row['pasienname']; ?></td>
                        </tr>
                        <?php
                        function penyebut($nilai)
                        {
                            $nilai = abs($nilai);
                            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                            $temp = "";
                            if ($nilai < 12) {
                                $temp = " " . $huruf[$nilai];
                            } else if ($nilai < 20) {
                                $temp = penyebut($nilai - 10) . " belas";
                            } else if ($nilai < 100) {
                                $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
                            } else if ($nilai < 200) {
                                $temp = " seratus" . penyebut($nilai - 100);
                            } else if ($nilai < 1000) {
                                $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
                            } else if ($nilai < 2000) {
                                $temp = " seribu" . penyebut($nilai - 1000);
                            } else if ($nilai < 1000000) {
                                $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
                            } else if ($nilai < 1000000000) {
                                $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
                            } else if ($nilai < 1000000000000) {
                                $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
                            } else if ($nilai < 1000000000000000) {
                                $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
                            }
                            return $temp;
                        }

                        function terbilang($nilai)
                        {
                            if ($nilai < 0) {
                                $hasil = "minus " . trim(penyebut($nilai));
                            } else {
                                $hasil = trim(penyebut($nilai));
                            }
                            return $hasil;
                        } ?>
                        <tr>
                            <td>Uang Sebesar</td>
                            <td>: # <?php echo ucwords(terbilang($row['price'])) . " Rupiah"; ?></td>
                        </tr>
                        <tr>
                            <td>Untuk Biaya</td>
                            <td>: Biaya Pemeriksaan <b><?= $row['description']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: <?= $row['pasienname']; ?></td>
                        </tr>
                        <tr>
                            <td>No Rekam medis</td>
                            <td>: <?= $row['pasienid']; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>: Rp.<?= number_format($row['price'], 2, ",", ".") ?></td>
                        </tr>
                        <tr>
                            <td>Cara Bayar</td>
                            <td>: <?= $row['paymentmethodname']; ?></td>
                        </tr>
                        <tr>
                            <td>Pelayanan</td>
                            <td>: <?= $row['poliklinikname']; ?></td>
                        </tr>
                        <tr>
                            <td>Dokter DPJP</td>
                            <td>: <?= $row['doktername']; ?></td>
                        </tr>

                        <?php
                        $tanggal = date('Y-m-d');
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
                        <tr style="line-height: 1.5;">
                            <td>Keluarga Pasien</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Muara Enim, <?php echo tgl_indo($tanggal); ?> <?= date('h:i:s'); ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                (_______________)
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <u><?= $row['kasirvalidasi']; ?></u>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


            <hr style="height:1px;border:none;color:#000;background-color:#333;" />
            <div class="pull-text text-left;">
                <?php
                foreach ($datapasien as $row) :
                ?>
                    <table style="border-collapse: collapse; line-height: 1; width:100%;" border="0">
                        <tbody>
                            <tr>
                                <font size="1px">
                                    <td colspan="2">&nbsp; </td>
                                </font>
                            </tr>
                            <tr>
                                <!-- <td style="width: 15%; text-align: center;" rowspan="3"> -->
                                <td style="width: 2.cm; text-align: left;" rowspan="3">
                                    <div class="img">
                                        <img style="height: 45px;" src="./assets/images/gallery/pemkab.png" width="45px" class="dark-logo" />
                                    </div>
                                </td>
                                <td style="text-align: left; width:16.cm">
                                    <font size="14px">PEMERINTAH KABUPATEN MUARA ENIM</font>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left">
                                    <b>
                                        <font size="18px">RSUD DR. H. MOHAMAD RABAIN</font>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <font size="1">Jalan Sultan Mahmud Badaruddin II No. 49 Muara Enim Telp 0734-424354 Fax 0834-422738 Kode Pos 31314</font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top: -4;">
                                    <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 100%; text-align: center; line-height :1" colspan="2">
                                    <b>
                                        <font size="3"><u>K U I T A N S I</u></font>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%; height: 15px; text-align:center" colspan="2">No. : <?= $row['journalnumber']; ?> - <?= $row['id']; ?></td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->

            <div class="pull-text text-left">
                <table style="border-collapse: collapse; width: 100%;" border="0">
                    <thead>

                        <tr style="height: 16px;">
                            <td style="width: 20%;">Sudah Terima Dari</td>
                            <td style="width: 69.8905%;">: <?= $row['pasienname']; ?></td>
                        </tr>

                        <tr>
                            <td>Uang Sebesar</td>
                            <td>: # <?php echo ucwords(terbilang($row['price'])) . " Rupiah"; ?></td>
                        </tr>
                        <tr>
                            <td>Untuk Biaya</td>
                            <td>: Biaya Pemeriksaan <b><?= $row['description']; ?></b></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: <?= $row['pasienname']; ?></td>
                        </tr>
                        <tr>
                            <td>No Rekam medis</td>
                            <td>: <?= $row['pasienid']; ?></td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>: Rp.<?= number_format($row['price'], 2, ",", ".") ?></td>
                        </tr>
                        <tr>
                            <td>Cara Bayar</td>
                            <td>: <?= $row['paymentmethodname']; ?></td>
                        </tr>
                        <tr>
                            <td>Pelayanan</td>
                            <td>: <?= $row['poliklinikname']; ?></td>
                        </tr>
                        <tr>
                            <td>Dokter DPJP</td>
                            <td>: <?= $row['doktername']; ?></td>
                        </tr>



                        ?>
                        <tr style="line-height: 1.5;">
                            <td>Keluarga Pasien</td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Muara Enim, <?php echo tgl_indo($tanggal); ?> <?= date('h:i:s'); ?></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                (_______________)
                            </td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <u><?= $row['kasirvalidasi']; ?></u>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
            <br>
            <div class="pull-text text-left;">
                <?php
                foreach ($datapasien as $row) :
                ?>
                    <table style="border-collapse: collapse; line-height: 1; width:100%;" border="0">
                        <tbody>
                            <tr>
                                <!-- <td style="width: 15%; text-align: center;" rowspan="3"> -->
                                <td style="width: 2.cm; text-align: left;" rowspan="3">
                                    <div class="img">
                                        <img style="height: 45px;" src="./assets/images/gallery/pemkab.png" width="45px" class="dark-logo" />
                                    </div>
                                </td>
                                <td style="text-align: left; width:16.cm">
                                    <font size="14px">PEMERINTAH KABUPATEN MUARA ENIM</font>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left">
                                    <b>
                                        <font size="18px">RSUD DR. H. MOHAMAD RABAIN</font>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <font size="1">Jalan Sultan Mahmud Badaruddin II No. 49 Muara Enim Telp 0734-424354 Fax 0834-422738 Kode Pos 31314</font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top: -4;">
                                    <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 100%; text-align: center; line-height :1" colspan="2">
                                    <b>
                                        <font size="3"><u>K U I T A N S I</u></font>
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%; height: 15px; text-align:center" colspan="2">No. : <?= $row['journalnumber']; ?> - <?= $row['id']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->

                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%;" border="0">
                            <thead>

                                <tr style="height: 16px;">
                                    <td style="width: 20%;">Sudah Terima Dari</td>
                                    <td style="width: 69.8905%;">: <?= $row['pasienname']; ?></td>
                                </tr>

                                <tr>
                                    <td>Uang Sebesar</td>
                                    <td>: # <?php echo ucwords(terbilang($row['price'])) . " Rupiah"; ?></td>
                                </tr>
                                <tr>
                                    <td>Untuk Biaya</td>
                                    <td>: Biaya Pemeriksaan <b><?= $row['description']; ?></b></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $row['pasienname']; ?></td>
                                </tr>
                                <tr>
                                    <td>No Rekam medis</td>
                                    <td>: <?= $row['pasienid']; ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah</td>
                                    <td>: Rp.<?= number_format($row['price'], 2, ",", ".") ?></td>
                                </tr>
                                <tr>
                                    <td>Cara Bayar</td>
                                    <td>: <?= $row['paymentmethodname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Pelayanan</td>
                                    <td>: <?= $row['poliklinikname']; ?></td>
                                </tr>
                                <tr>
                                    <td>Dokter DPJP</td>
                                    <td>: <?= $row['doktername']; ?></td>
                                </tr>



                                ?>
                                <tr style="line-height: 1.5;">
                                    <td>Keluarga Pasien</td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Muara Enim, <?php echo tgl_indo($tanggal); ?> <?= date('h:i:s'); ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        (_______________)
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <u><?= $row['kasirvalidasi']; ?></u>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>

</body>

</html>
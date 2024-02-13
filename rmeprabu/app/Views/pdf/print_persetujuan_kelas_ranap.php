<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Rincian Masuk Keluar Pasien</title>
    <style type="text/css">
        table {

            width: 10%;
        }

        table,
        th,
        td {
            text-align: left;
        }

        hr.style-eight {
            overflow: visible;
            /* For IE */
            padding: 0;
            border: none;
            border-top: medium double #333;
            color: #333;
            text-align: center;
        }

        hr.style-eight:after {
            content: "§";
            display: inline-block;
            position: relative;
            top: -0.7em;
            font-size: 1.5em;
            padding: 0 0.25em;
            background: white;
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
                                <h6><b class="text-dark"><?= $header1; ?></b></h6>
                            </td>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/muaraenim.png" width="40" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;">
                                <h5><b class="text-dark"><?= $header2; ?></b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;"><?= $alamat; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;">
                                <b>
                                    <?= $deskripsi; ?>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr style="height:1px;border:none;color:#333;background-color:#333;" />

                <div class="pull-text text-left">
                    <table style="height: 306px; width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <?php
                            foreach ($dataopname as $row) :
                            ?>
                                <?php
                                $original_date = $tgllahir;
                                $timestamp = strtotime($original_date);
                                $new_date = date("d-m-Y", $timestamp);

                                $tanggallahir = $tgllahir;
                                $dob = strtotime($tanggallahir);
                                $current_time = time();
                                $age_years = date('Y', $current_time) - date('Y', $dob);
                                $age_months = date('m', $current_time) - date('m', $dob);
                                $age_days = date('d', $current_time) - date('d', $dob);

                                if ($age_days < 0) {
                                    $days_in_month = date('t', $current_time);
                                    $age_months--;
                                    $age_days = $days_in_month + $age_days;
                                }

                                if ($age_months < 0) {
                                    $age_years--;
                                    $age_months = 12 + $age_months;
                                }

                                $umur = $age_years . " tahun " . $age_months . " bulan ";


                                ?>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px;" colspan="2">Yang bertanda tangan dibawah ini, saya pasien:</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;">Nama</td>
                                    <td style="width: 70.8028%; height: 18px;">: <?= $row['pasienname']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;">Jenis kelamin &amp; Umur</td>
                                    <td style="width: 70.8028%; height: 18px;">: <?php if ($row['pasiengender'] == "L") {
                                                                                        echo "LAKI-lAKI";
                                                                                    } else {
                                                                                        echo "PEREMPUAN";
                                                                                    } ?> [<?= $umur; ?>]</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;">Alamat</td>
                                    <td style="width: 70.8028%; height: 18px;">: <?= $row['pasienaddress']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;">No. RM</td>
                                    <td style="width: 70.8028%; height: 18px;">: <?= $row['pasienid']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;">Hak Kelas Rawat</td>
                                    <td style="width: 70.8028%; height: 18px;">: <?= $row['pasienclassroom']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px;" colspan="2">Dan sebagai penanggung jawab : <b><?= $row['hubunganpjb']; ?></b> dari pasien</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;">Nama</td>
                                    <td style="width: 70.8028%; height: 18px;">: <?= $row['namapjb']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;">Alamat</td>
                                    <td style="width: 70.8028%; height: 18px;">: <?= $row['alamatpjb']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;">No. Telp/HP</td>
                                    <td style="width: 70.8028%; height: 18px;">: <?= $row['telppjb']; ?></td>
                                </tr>
                                <tr style="height: 36px;">
                                    <td style="width: 29.1972%; height: 36px;" colspan="2">Dengan ini menyatakan dan memilih ingin dirawat inap di: <b><?= $row['classroomname']; ?></b> ruang/bangsal : <b><?= $row['roomname']; ?></b> RSUD 45 Kuningan.</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;" colspan="2">saya sanggup memenuhi ketentuan :</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;" colspan="2">1. Membayar biaya perawatan sesuai kelas perawatan</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;" colspan="2">2. Membayar selisih bila rawat inap di atas hak kelas</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;" colspan="2">3. Membayar selisih biaya perawatan, termasuk bila memerlukan ruang intensif sesuai kenaikan kelas perawatan</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 29.1972%; height: 18px;" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 29.1972%;" colspan="2">Yang berlaku bagi diri saya sebagai pasien JKN</td>
                                </tr>
                                <tr>
                                    <td style="width: 29.1972%;" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 29.1972%;" colspan="2">
                                        <table style="width: 100%; border-collapse: collapse;" border="1" cellspacing="0" cellpadding="0">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 6.12742%; text-align: center;">NO</td>
                                                    <td style="width: 87.1936%; text-align: center;">SYARAT</td>
                                                    <td style="width: 6.67889%;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 6.12742%; text-align: center;">1</td>
                                                    <td style="width: 87.1936%;">KARTU ASLI DAN FOTOCOPY JKN, ASKES &amp; TNI POLRI</td>
                                                    <td style="width: 6.67889%;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 6.12742%; text-align: center;">2</td>
                                                    <td style="width: 87.1936%;">FOTOCOPY KTP PASIEN / ORANG TUA PASIEN</td>
                                                    <td style="width: 6.67889%;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 6.12742%; text-align: center;">3</td>
                                                    <td style="width: 87.1936%;">UNTUK KASUS KECELAKAAN LALU LINTAS DILENGKAPI DENGAN BAP DARI KEPOLISIAN</td>
                                                    <td style="width: 6.67889%;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 6.12742%; text-align: center;">4</td>
                                                    <td style="width: 87.1936%;">BILA APS(ATAS PERMINTAAN SENDIRI) CARA PEMBAYARAN MENJADI TUNAI</td>
                                                    <td style="width: 6.67889%;">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 29.1972%;" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2">1. Bahwa saya sebagai petugas telah menjelaskan tentang persyaratan&nbsp; administrasi tersebut di atas</td>
                                </tr>
                                <tr>
                                    <td style="width: 29.1972%;" colspan="2">2. Apabila persyaratan diatas tidak diselesaikan&nbsp; dalam waktu 3x24 jam, maka pembayaran menjadi TUNAI</td>
                                </tr>

                        </tbody>
                    </table>

                </div>
                <br>
                <div class="pull-text text-center">
                    <?= $barcode; ?>
                </div>
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
                <div class="pull-text text-center">
                    <table style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr>
                                <td style="width: 50%;">&nbsp;</td>
                                <td style="width: 50%;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Mengetahui</td>
                                <td style="width: 50%;">Yang membuat Pernyataan</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">Petugas Pendaftaran Rawat Inap</td>
                                <td style="width: 50%;">Pasien / Keluarga Pasien</td>
                            </tr>
                            <tr>
                                <td style="width: 50%;">&nbsp;</td>
                                <td style="width: 50%;">
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%;"><b><?= $row['createdby']; ?></b></td>
                                <td style="width: 50%;"><b><?= $row['namapjb']; ?></b></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
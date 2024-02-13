S

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
        @page {
            margin: 20px 15px;
            font-size: 10px;
            margin-top: 0.8.cm;
            margin-bottom: 1.1.cm;
            margin-left: 1.5.cm;
            margin-right: 1.5.cm;
            line-height: 1.5;
            color: black;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        body {
            font-size: 10px;
            line-height: 1.5;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: black;
        }

        .wgaris {
            border-width: 0.5 px;
            /* border-style: solid; */
            border-top: 2px black;
            border-bottom: 2px black;
            border-left: 0px white;
            border-right: 0px white;
            /* border-left: #ff0000;
            border-right: #ff0000; */
        }

        .table {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row" style="font-size:100%">
            <div class="col-md-12">

                <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                    <tbody>
                        <tr style="height: 18px;">
                            <td style="width: 40%; height: 18px; text-align: right;" colspan="2"><b>RM.1<b></td>
                        </tr>
                        <tr>
                            <td style="width: 1%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 50" src="./assets/images/gallery/muaraenim.jpg" width="55px" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 99%; text-align: center;">
                                <b>
                                    <font size="20px"> <?= $header1; ?></font>
                                </b>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 99%; text-align: center;">
                                <b>
                                    <font size="22px"> <?php echo $header2; ?> </font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 99%; text-align: center;">
                                <font size="13px"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <hr>

                <div>
                    <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                        <tbody>
                            <tr style="height: 100px">
                                <td style="width: 100%; text-align: center; line-height :1">
                                    <br>
                                    <b>
                                        <font size="4"><?php echo  $deskripsi ?></font>
                                    </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- <br> -->

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 432px;" border="1">
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
                                    <td style="height: 18px; width: 69.0694%;" colspan="3"><b>No REGISTER : <?= $row['journalnumber']; ?></b></td>
                                    <td style="height: 18px; width: 80.9306%;" colspan="3"><b>No REFERENSI : <?= $row['referencenumber']; ?></b></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="height: 18px; width: 69.0694%;" colspan="3"><b>IDENTITAS PASIEN</b></td>
                                    <td style="height: 18px; width: 80.9306%;" colspan="3"><b>PEMBAYARAN</b></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">NO RM</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $row['pasienid']; ?></b></td>
                                    <td style="width: 80.9306%; height: 18px;" colspan="3">PJB : <b><?= $row['namapjb']; ?></b></td>

                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">NAMA</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $row['pasienname']; ?></b></td>
                                    <td style="width: 80.9306%; height: 18px;" colspan="3">NO.TELP/HP PJB: <b><?= $row['telppjb']; ?></b></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">JENIS KELAMIN</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?php if ($row['pasiengender'] == "L") {
                                                                                                    echo "LAKI-lAKI";
                                                                                                } else {
                                                                                                    echo "PEREMPUAN";
                                                                                                } ?></b></td>
                                    <td style="height: 18px; width: 80.9306%;" colspan="3">ALAMAT PJB : <b><?= $row['alamatpjb']; ?></b></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">TGL LAHIR/UMUR</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $new_date; ?>[<?= $umur; ?>]</b></td>
                                    <td style="height: 18px; width: 80.9306%;" colspan="3"><b>PEMBAYARAN</b></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">PENDIDIKAN</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $pendidikan; ?></b></td>
                                    <td style="width: 80.9306%; height: 18px;" colspan="3">CARA: <?= $row['paymentmethodname']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">PEKERJAAN</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $pekerjaan; ?></b></td>
                                    <td style="width: 80.9306%; height: 18px;" colspan="3">NO KARTU: <?= $row['paymentcardnumber']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">ALAMAT</td>
                                    <td style="height: 18px; width: 104.927%;" colspan="5"><?= $alamatpasien; ?> (RT : <?= $rt; ?> RW: <?= $rw; ?>) Kec: <?= $kecamatan; ?> Kab: <?= $kabupaten; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">AGAMA</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $agama; ?></b></td>
                                    <td style="height: 18px; width: 80.9306%;" colspan="3">RUJUKAN DAN CARA MASUK MELALUI</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">NO.TELP</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2">&nbsp;</td>
                                    <td style="width: 31.5693%; height: 18px;">FASKES</td>
                                    <td style="width: 49.3613%; height: 18px;" colspan="2"><?= $row['faskesname']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">NIK</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $nik; ?></b></td>
                                    <td style="width: 31.5693%; height: 18px;">KLINIK</td>
                                    <td style="width: 49.3613%; height: 18px;" colspan="2"><?= $row['poliklinikname']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">STATUS</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $status; ?></b></td>
                                    <td style="width: 80.9306%; height: 18px;" colspan="3">&nbsp;</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="height: 18px; width: 69.0694%;" colspan="3">INFORMASI SMF</td>
                                    <td style="width: 31.5693%; height: 18px;">KELUAR/PULANG</td>
                                    <td style="width: 24.3613%; height: 18px;">HARI</td>
                                    <td style="width: 25%; height: 18px;">TGL</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">SMF</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $row['smfname']; ?></b></td>
                                    <td style="width: 31.5693%; height: 18px;">LAMA PERAWATAN</td>
                                    <td style="width: 24.3613%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                </tr>
                                <tr style="height: 36px;">
                                    <td style="width: 45.073%; height: 36px;">RAWAT GABUNG</td>
                                    <td style="width: 23.9964%; height: 36px;" colspan="2">&nbsp;</td>
                                    <td style="width: 31.5693%; height: 36px;">CARA PEMBAYARAN</td>
                                    <td style="width: 24.3613%; height: 36px;">&nbsp;</td>
                                    <td style="width: 25%; height: 36px;">&nbsp;</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="height: 18px; width: 45.073%;">RUANG PERAWATAN</td>
                                    <td style="width: 12.3175%; height: 18px;">KLS</td>
                                    <td style="width: 11.6789%; height: 18px;">TGL JAM</td>
                                    <td style="width: 31.5693%; height: 18px;">PINDAH PEMBAYARAN</td>
                                    <td style="width: 24.3613%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%;">RUANG IW</td>
                                    <td style="width: 12.3175%;">&nbsp;</td>
                                    <td style="width: 11.6789%;">&nbsp;</td>
                                    <td style="width: 80.9306%;" colspan="3">CATATAN:</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">RUANG</td>
                                    <td style="width: 12.3175%; height: 18px;"><b><?= $row['roomname']; ?></b></td>
                                    <td style="width: 11.6789%; height: 18px;"><b><?= $row['datetimein']; ?></b></td>
                                    <td style="height: 54px; width: 80.9306%;" colspan="3" rowspan="2">&nbsp;</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">PINDAH RUANG</td>
                                    <td style="width: 12.3175%; height: 18px;">&nbsp;</td>
                                    <td style="width: 11.6789%; height: 18px;">&nbsp;</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 150%; height: 18px;" colspan="6">INFORMASI DATA KESAKITAN</td>
                                </tr>
                                <tr style="height: 28px;">
                                    <td style="width: 45.073%; height: 56px;">DIAGNOSA MASUK</td>
                                    <td style="width: 104.927%; height: 56px;" colspan="5"><b><?= $row['icdxname']; ?></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%; height: 59px;">DIAGNOSA AKHIR</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td style="width: 31.693%; height: 59px;">ICD X</td>
                                    <td colspan="1"><b><?= $row['icdx']; ?></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%; height: 50px;">KOMPLIKASI</td>
                                    <td colspan="3">&nbsp;</td>
                                    <td style="width: 31.5693%; height: 50px;">ICD X</td>
                                    <td colspan="1">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%; height: 28px;">OPERASI/TINDAKAN</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td style="width: 31.5693%; height: 28px;">ICD IX</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%; height: 26px;">KEADAAN KELUAR</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td style="width: 31.5693%; height: 26px;">CARA KELUAR</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%; height: 56px;">DOKTER YANG MERAWAT</td>
                                    <td style="width: 23.9964%; height: 56px;" colspan="2"><b><?= $row['doktername']; ?></b></td>
                                    <td style="width: 31.5693%; height: 46px;">TANDA TANGAN</td>
                                    <td style="width: 49.3613%; height: 46px;" colspan="2">&nbsp;</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <br>
                <div class="pull-text text-center">
                    <?= $barcode; ?>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
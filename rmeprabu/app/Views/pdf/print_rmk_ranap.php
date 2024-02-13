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
                                    <h6> <?= $deskripsi; ?></h6>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>

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
                                    <td style="width: 80.9306%; height: 18px;" colspan="3"></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">NAMA</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?= $row['pasienname']; ?></b></td>
                                    <td style="width: 80.9306%; height: 18px;" colspan="3">NO.TELP/HP</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">JENIS KELAMIN</td>
                                    <td style="width: 23.9964%; height: 18px;" colspan="2"><b><?php if ($row['pasiengender'] == "L") {
                                                                                                    echo "LAKI-lAKI";
                                                                                                } else {
                                                                                                    echo "PEREMPUAN";
                                                                                                } ?></b></td>
                                    <td style="height: 18px; width: 80.9306%;" colspan="3">&nbsp;</td>
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
                                    <td style="height: 18px; width: 104.927%;" colspan="5"><?= $row['pasienaddress']; ?></td>
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
                                    <td style="width: 11.6789%; height: 18px;">TGL</td>
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
                                    <td style="width: 11.6789%; height: 18px;"><b><?= $row['datein']; ?></b></td>
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
                                <tr style="height: 18px;">
                                    <td style="width: 45.073%; height: 18px;">DIAGNOSA MASUK</td>
                                    <td style="width: 104.927%; height: 18px;" colspan="5"><b><?= $row['icdxname']; ?></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%;">DIAGNOSA AKHIR</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td style="width: 31.5693%;">ICD X</td>
                                    <td colspan="2"><b><?= $row['icdx']; ?></b></td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%;">KOMPLIKASI</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td style="width: 31.5693%;">ICD X</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%;">OPERASI</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td style="width: 31.5693%;">ICD IX</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%;">KEADAAN KELUAR</td>
                                    <td colspan="2">&nbsp;</td>
                                    <td style="width: 31.5693%;">CARA KELUAR</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 45.073%;">DOKTER YANG MERAWAT</td>
                                    <td style="width: 23.9964%;" colspan="2"><b><?= $row['doktername']; ?></b></td>
                                    <td style="width: 31.5693%;">TANDA TANGAN</td>
                                    <td style="width: 49.3613%;" colspan="2">&nbsp;</td>
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
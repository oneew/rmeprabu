<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>SJP Rawat Inap</title>
    <style type="text/css">
        @page {
            /* margin: 20px 15px; */
            margin: 0;
            font-size: 12px;
        }

        body {
            /* margin: 0px; */
            margin-top: 1.cm;
            margin-left: 1.cm;
            margin-right: 1.cm;
            margin-bottom: 1.cm;
            font-size: 12px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>

</head>

<body>

    <!-- <div class="container-fluid text-dark"> -->
    <div>
        <div class="row">
            <!-- <div class="col-md-12"> -->
            <div>
                <div>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <table style="border-collapse: collapse; line-height: 1; width:100%;" border="0">
                            <tbody>
                                <tr>
                                    <!-- <td style="width: 15%; text-align: center;" rowspan="3"> -->
                                    <td style="width: 3.cm; text-align: left;" rowspan="3">
                                        <div class="img">
                                            <img style="height: 70px;" src="./assets/images/gallery/pemkab.png" width="70px" class="dark-logo" />
                                        </div>
                                    </td>
                                    <td style="text-align: left; width:15.cm">
                                        <font size="18px"><?= $header1; ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: left;">
                                        <b>
                                            <font size="22px" ><?php echo $header2; ?></font>
                                            
                                        </b>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;">
                                        <font size="1"><?php echo $alamat; ?></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                    </td>
                                </tr>

                                <tr style="height: 100px">
                                    <td style="width: 100%; text-align: center; line-height :1" colspan="2">
                                        <br>
                                        <b>
                                            <font size="4"><u><?php echo $deskripsi; ?></u></font>
                                        </b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: right;">
                                        <!-- <br>
                                        <font size="14px">Antrian Poli : <b><?= number_format($row['noantrian'], 0, ",", "."); ?></b></font> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->
                <br>

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%;" border="0">
                        <thead>
                            <tr>
                                <td style="width: 0.4cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 0.15cm;"> </td>
                                <td style="width: 5.8cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 0.15cm;"> </td>
                                <td style="width: 6cm;"> </td>
                            </tr>
                        </thead>
                        <tbody style="line-height: 1.5;">
                            <tr>
                                <td></td>
                                <td style="text-align: left;">Kunjungan Sebelumnya</td>
                                <td>: </td>
                                <td><?= $row['poliklinikname']; ?> | <?= $row['dokterpoliname']; ?></td>
                                <!-- <td><?= $polikliniknamesebelumnya; ?> | <?= $doktersebelumnya; ?></td> -->
                                <!-- <td></td> -->
                                <td>Pembayaran/Jaminan</td>
                                <td>: </td>
                                <td><?= $row['paymentmethodname']; ?></td>

                            </tr>
                            <tr style="line-height: 2;">
                                <?php
                                // $tanggal = $row['createddate'];
                                $tanggal = $row['datetimein'];
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
                                <td style="text-align:left;">1.</td>
                                <td style="text-align:left">Tanggal SJP</td>
                                <!-- <td>: ?php echo tgl_indo($tanggal); ?></td> -->
                                <td>: </td>
                                <td><?= date('d-m-Y H:i:s', strtotime($tanggal)); ?></td>
                                <td>Nama Pasien</td>
                                <td>: </td>
                                <td><?= $row['pasienname']; ?></td>

                            </tr>
                            <tr>
                                <td style="text-align:left;">2.</td>
                                <td style="text-align:left">Nomor Rujukan</td>
                                <td>: </td>
                                <td></td>
                                <td>Berat Badan</td>
                                <td>: </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;">3.</td>
                                <td style="text-align:left">Tanggal Rujukan</td>
                                <td>: </td>
                                <td></td>
                                <td>Nomor Medrek</td>
                                <td>: </td>
                                <td><?= $row['pasienid']; ?></td>
                            </tr>

                            <tr>
                                <td style="text-align:left;">4.</td>
                                <!-- <td style="text-align:left">Asal Rujukan</td>
                                <td>: </td> -->
                                <!-- <td>?= $row['TglSuratKontrol'] ?></td> -->
                                <!-- <td></td> -->
                                <td>Asal Rujukan</td>
                                <td>: </td>
                                <td><?= $row['faskesname']; ?></td>
                                <!-- <td></td> -->
                                <td>Nomor Registrasi</td>
                                <td>: </td>
                                <td><?= $row['journalnumber']; ?></td>
                            </tr>

                            <?php
                            if ($row['pasiengender'] == 'L') {
                                $jk = "LAKI-LAKI";
                            } else {
                                $jk = "PEREMPUAN";
                            }
                            ?>
                            <tr>
                                <td style="text-align:left;">5.</td>
                                <!-- <td style="text-align:left">Diagnosa Awal</td>
                                <td>: </td>
                                <td></td> -->
                                <td>Asal Pelayanan</td>
                                <td>: </td>
                                <!-- <td></td> -->
                                <td><?= $row['poliklinikname']; ?></td>
                                <td>Jenis Kelamin</td>
                                <td>: </td>
                                <td><?= $jk ?></td>
                            </tr>


                            <tr>
                                <td style="text-align:left;">6.</td>
                                <td style="text-align:left">Ruangan Tujuan (RI)</td>
                                <td>: </td>
                                <td>(<?= $row['roomname']; ?>)</td>

                                <!-- <td>1) <?= $row['poliklinikname']; ?></td> -->
                                <td>Tanggal Lahir</td>
                                <td>: </td>
                                <td><?= date('d-m-Y', strtotime($row['pasiendateofbirth'])) ?>
                                    [<?= $row['pasienage']; ?>]</td>
                            </tr>
                            <?php
                            if ($row['lamabaru'] == 'L') {
                                $status = "Pasien Lama";
                            } else {
                                $status = "Pasien Baru";
                            }
                            ?>
                            <tr>
                                <td style="text-align:left;">7.</td>
                                <td style="text-align:left">Nama Dokter</td>
                                <td>: </td>
                                <td><?= $row['doktername']; ?></td>
                                <td>Status</td>
                                <td>: </td>
                                <td><?= $status ?></td>
                            </tr>

                            <tr>
                                <td style="text-align:left;">8.</td>
                                <td style="text-align:left">Diagnosa Awal</td>
                                <td>: </td>
                                <td><?= $row['icdx']; ?>[<?= $row['icdxname']; ?>]</td>
                                <td>Diagnosa Akhir (RS)</td>
                                <td>: </td>
                                <td></td>
                            </tr>

                            <tr>
                                <td style="text-align:left;">9.</td>
                                <td style="text-align:left">Pemeriksaan Paket</td>
                                <td>: </td>
                                <td>2) ......P2A &nbsp;&nbsp;&nbsp;&nbsp;3) ......P2B &nbsp;&nbsp;&nbsp;&nbsp;4) ......P2C &nbsp;&nbsp;
                                    <br>
                                    5) ......P3A &nbsp;&nbsp;&nbsp;&nbsp;6) ......P3B &nbsp;&nbsp;&nbsp;&nbsp;7) ......P3C &nbsp;&nbsp;
                                </td>
                                <td>Catatan Khusus</td>
                                <td>: </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;">10.</td>
                                <td style="text-align:left">Rujukan Intern Ke</td>
                                <td>: </td>
                                <td>8) Poli : </td>
                                <td>Petugas Registrasi</td>
                                <td colspan="2">: <?= $row['createdby']; ?>[<?= $row['createddate']; ?>]</td>
                                <td></td>
                            </tr>
                            <!-- <tr>
                                <td style="text-align:left;"></td>
                                <td style="text-align:left"></td>
                                <td>: </td>
                                <td>9) Poli : </td>
                                <td>Pasien</td>
                                <td>Dokter RS</td>
                                <td>Petugas</td>
                            </tr> -->

                            <tr>
                                <td style="text-align:left;"></td>
                                <td style="text-align:left"></td>
                                <td>: </td>
                                <td>9) Poli : </td>
                                <td>Riwayat Alergi Obat</td>
                                <td>: </td>
                                <td></td>
                                <!-- <td colspan="3">
                                    <table>
                                        <tr>
                                            <td style="width: 3cm;">Pasien</td>
                                            <td style="width: 3cm;">Dokter</td>
                                            <td style="width: 3cm;">Petugas</td>
                                        </tr>
                                    </table>
                                </td> -->
                            </tr>

                            <!-- <tr>
                                <td style="text-align:left;">11.</td>
                                <td style="text-align:left">Jaminan Pelayanan</td>
                                <td>:</td>
                                <td>10) </td>
                                <td>1) ...........</td>
                                <td>1) ........... </td>
                                <td>1) ........... </td>
                            </tr> -->

                            <tr>
                                <td style="text-align:left;">11.</td>
                                <td style="text-align:left">Jaminan Pelayanan</td>
                                <td>:</td>
                                <td>10) </td>
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td style="width: 3cm;">Pasien</td>
                                            <td style="width: 3cm;">Dokter</td>
                                            <td style="width: 3cm;">Petugas</td>
                                        </tr>
                                    </table>
                                </td>
                                <!-- <td colspan="3">
                                    <table>
                                        <tr>
                                            <td style="width: 3cm;">1) ........</td>
                                            <td style="width: 3cm;">1) ........</td>
                                            <td style="width: 3cm;">1) ........</td>
                                        </tr>
                                    </table>
                                </td> -->
                            </tr>
                            <tr>
                                <td style="text-align:left;"></td>
                                <td style="text-align:left"></td>
                                <td> </td>
                                <td>11) </td>
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td style="width: 3cm;">1) ........</td>
                                            <td style="width: 3cm;">1) ........</td>
                                            <td style="width: 3cm;">1) ........</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:left;">12.</td>
                                <td style="text-align:left">Biaya Pelayanan</td>
                                <td></td>
                                <td></td>
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td style="width: 3cm;">2) ........</td>
                                            <td style="width: 3cm;">2) ........</td>
                                            <td style="width: 3cm;">2) ........</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:left;"></td>
                                <td style="text-align:left">- Diajuakan</td>
                                <td>: </td>
                                <td>Rp. )</td>
                                <!-- <td></td> -->
                                <td colspan="3">
                                    <table>
                                        <tr>
                                            <td style="width: 3cm;">3) ........</td>
                                            <td style="width: 3cm;">3) ........</td>
                                            <td style="width: 3cm;">3) ........</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:left;"></td>
                                <td style="text-align:left">- Disetujui</td>
                                <td>: </td>
                                <td>Rp. )</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                            
                            <tr>
                            <td style="text-align:left;">13.</td>
                                    <td style="text-align: left;">Alamat</td>
                                    <td>: </td>
                                    <td><?= $row['pasienaddress'];?></td>
                                    <td></td>
                               
                            </tr>

                            <tr style="line-height: 3;">
                                <td colspan="4">
                                    <b>BERKAS INI TIDAK DIBAWA PULANG</b>
                                </td>
                                <td colspan="3" style="text-align: center;">
                                    Muara Enim, <?= date('d-m-Y', strtotime($row['documentdate'])); ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table border=1>
                                        <tr>
                                            <td style="width: 1cm; text-align: center">
                                                V
                                            </td>
                                            <td style="width: 2.5cm;">
                                                <br>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 1cm; text-align: center">
                                                R
                                            </td>
                                            <td style="width: 2.5cm;">
                                                <br>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 1cm; text-align: center">
                                                D
                                            </td>
                                            <td style="width: 2.5cm;">
                                                <br>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 1cm; text-align: center">
                                                S
                                            </td>
                                            <td style="width: 2.5cm;">
                                                <br>
                                            </td>
                                        </tr>


                                    </table>
                                </td>
                                <td colspan="3" style="text-align: center;">
                                    <br>
                                    <br>
                                    <br>
                                    (_______________________)
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table>
                        <tbody>
                            <tr>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->

                <?php endforeach; ?>


                </div>
            </div>
        </div>
    </div>

</body>

</html>
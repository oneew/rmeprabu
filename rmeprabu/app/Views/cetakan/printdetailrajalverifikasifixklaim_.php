<div class="container">
    <div class="row">
        <div class="col">

            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <!-- Tell the browser to be responsive to screen width -->
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="description" content="">
                <meta name="author" content="">
                <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
                <title>Rincian Biaya Instalasi Rawat Jalan</title>
                <style type="text/css">
                    @page {
                        margin: 30px 30px;
                        margin-left: 2.cm;
                        font-size: 12px;
                        line-height: 1;
                    }

                    body {
                        margin: 5px;
                        margin-left: 10;
                        margin-right: 20;
                        margin-top: 0px;
                        padding-top: 0px;
                    }

                    table {

                        width: 10%;
                    }


                    table,
                    th,
                    td {
                        text-align: left;
                    }

                    .verifikasi {
                        font-family: Arial, Helvetica, sans-serif;
                        font-size: 12px;
                        line-height: 1.5;

                    }

                    .alamat {
                        font-family: Arial, Helvetica, sans-serif;
                        font-size: 12px;
                        font-weight: bold;

                    }

                    .header1 {
                        font-family: Arial, Helvetica, sans-serif;
                        font-size: 15px;
                        font-weight: bold;

                    }

                    .header2 {
                        font-family: Arial, Helvetica, sans-serif;
                        font-size: 12px;
                        /* font-weight: bold; */

                    }

                    hr {
                        border: none;
                        border-top: 3px double #333;
                        color: #333;
                        overflow: visible;
                        text-align: center;
                        height: 5px;
                    }

                    hr:after {
                        background: #fff;
                        content: '§';
                        padding: 0 4px;
                        position: relative;
                        top: -13px;
                    }
                </style>
                </style>
            </head>

            <body>
                <table class="header2" style="border-collapse: collapse; width: 100%; line-height: 1" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td style="width: 15%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px;" src="../assets/images/gallery/pemkab.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 70%; text-align: center;">
                                <b>
                                    <font size="2">PEMERINTAH KABUPATEN MUARAENIM</font>
                                </b>
                            </td>
                            <td style="width: 15%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 60px;" src="../assets/images/gallery/muaraenim.png" width="60" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 70%; text-align: center; font: size 100px;">
                                <b>
                                    <font size="3">RUMAH SAKIT UMUM DAERAH H. M. RABAIN</font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 70%; text-align: center; font: size 10px;">
                                Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100%; text-align: center; line-height :1" colspan="3">
                                <br>
                                <b>
                                    <font size="2">RINCIAN BIAYA INSTALASI RAWAT JALAN </font>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>

                <table class="verifikasi" style="width: 95%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <?php
                        foreach ($datapasien as $row) :
                        ?>
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

                            <tr>
                                <td style="width: 20%;">Nomor Bukti</td>
                                <td style="width: 20%;">: <?php echo $row['journalnumber']; ?></td>
                                <td style="width: 20%;">Poliklinik</td>
                                <td style="width: 30%;">: <?= $row['poliklinikname']; ?></td>

                            </tr>
                            <tr>
                                <td style="width: 20%;">Tanggal Pelayanan</td>
                                <td style="width: 30%;">: <?php echo tgl_indo($tanggal); ?></td>
                                <td style="width: 20%;">Pembayaran</td>
                                <td style="width: 30%;">: <?= $row['paymentmethodname']; ?></td>
                            </tr>
                            </tr>
                            <tr>
                                <td style="width: 20%;">Nama Pasien</td>
                                <td style="width: 30%;">: <?= $row['pasienname']; ?> [<?= $row['pasienid']; ?>]</td>
                                <td style="width: 20%;">No. Pendaftaran</td>
                                <td style="width: 30%;">: <?= $row['journalnumber']; ?></td>
                            <tr>
                                <td style="width: 20%;">ALamat</td>
                                <td style="width: 30%;" colspan="3">: <?= $row['pasienaddress']; ?></td>

                            </tr>
                            <tr>
                                <td style="width: 20%;">Dokter Pemeriksa</td>
                                <td style="width: 30%;">: <?= $row['doktername']; ?></td>
                                <td style="width: 20%;">Waktu pendaftaran</td>
                                <td style="width: 30%;">: <?= $documentdate; ?> | <?= $createdby; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">&nbsp;</td>
                                <td style="width: 30%;">&nbsp;</td>
                                <td style="width: 20%;">&nbsp;</td>
                                <td style="width: 30%;">&nbsp;</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>



                <hr>
                <table class="table table-sm" id="dataGabung" style="width: 95%; border-collapse: collapse;" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>

                            <th>No</th>
                            <th>Keterangan</th>

                            <th style="text-align: right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php
                        foreach ($pasien as $row) : ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td style="text-align: left;"><?= $row['description'] ?></td>

                                <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".") ?></td>
                                <?php $TotPemeriksaan[] = $row['price'];  ?>
                                <?php $no++; ?>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        foreach ($TNO as $rowTNO) :


                        ?>
                            <tr>

                                <td><?php echo $no ?></td>
                                <td> <?= $rowTNO['name']  ?></td>
                                <td style="text-align: right;"><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                                <?php $TotTNO[] = $rowTNO['subtotal'];  ?>
                                <?php $no++;  ?>
                            </tr>
                        <?php endforeach; ?>
                        <?php
                        foreach ($PENUNJANG as $P) :
                        ?>
                            <?php if ($P['totalamount'] > 0) { ?>
                                <tr>
                                    <?php if ($P['groups'] == "RAD") {
                                        $deskripsi = 'Radiologi';
                                    }
                                    if ($P['groups'] == "LPK") {
                                        $deskripsi = 'Lab Patologi Klinik';
                                    }
                                    if ($P['groups'] == "LPA") {
                                        $deskripsi = 'Lab Patologi Anatomi';
                                    }
                                    if ($P['groups'] == "BD") {
                                        $deskripsi = 'Bank Darah';
                                    }
                                    ?>

                                    <td><?php echo $no ?></td>
                                    <td><?= $deskripsi; ?> | <?= $P['journalnumber'] ?></td>

                                    <td style="text-align: right"><?= number_format($P['totalamount'], 2, ",", ".") ?></td>
                                    <?php $TotPENUNJANG[] = $P['totalamount'];  ?>
                                    <?php $no++; ?>
                                </tr>
                            <?php } ?>
                        <?php endforeach; ?>


                        <?php if (['price'] > 0) { ?>
                            <?php
                            foreach ($FARMASI as $F) :
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td>FAR <?= $F['journalnumber'] ?></td>
                                    <td style="text-align: right"><?php $awal = abs($F['price']);
                                                                    $far = $awal + $F['embalase'];
                                                                    $deni = ceil($far);
                                                                    echo number_format($deni, 2, ",", ".") ?></td>
                                    <?php $TotFAR[] = $deni;  ?>
                                    <?php $no++ ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php } ?>

                        <?php if ('totalbhp' > 0) { ?>
                            <?php
                            foreach ($BHP as $behape) :
                            ?>
                                <?php
                                if ($behape['totalbhp'] > 0) { ?>
                                    <tr>

                                        <td>BHP <?= $behape['journalnumber'] ?></td>
                                        <td style="text-align: right;"><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                        <?php $TotBHP[] = $behape['totalbhp'];  ?>
                                        <?php $no++ ?>
                                    </tr>
                                <?php } ?>
                            <?php endforeach; ?>
                        <?php } ?>

                        <?php
                        foreach ($OPERASI as $OP) :
                        ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?= $OP['name']  ?> <?= $OP['doktername'] ?></td>
                                <td style="text-align: rights;"><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                                <?php $no++ ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>

                            <td style="text-align: right;" colspan="2"><b>Total Biaya</b></td>
                            <td style="width: 5px;"></td>
                            <?php $check_TotPem = isset($TotPemeriksaan) ? array_sum($TotPemeriksaan) : 0;
                            $TotalPemeriksaan = $check_TotPem;
                            $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                            $TotalTNO = $check_TotTNO;
                            $check_TotPenunjang = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                            $TotalPenunjang = $check_TotPenunjang;
                            $check_TotFar = isset($TotFAR) ? array_sum($TotFAR) : 0;
                            $TotalFarmasi = $check_TotFar;
                            $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                            $TotalBHP = $check_TotBHP;
                            $check_TotOperasi = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
                            $TotalOperasi = $check_TotOperasi;

                            $totalbiaya = $TotalPemeriksaan + $TotalTNO + $TotalPenunjang + $TotalFarmasi + $TotalBHP + $TotalOperasi;



                            ?>
                            <td style="text-align: right;">
                                <?= number_format($totalbiaya, 2, ",", ".") ?>
                            </td>

                    </tfoot>
                </table>
            </body>
            <script type="text/javascript">
                window.print();
            </script>

            </html>
        </div>
    </div>
</div>
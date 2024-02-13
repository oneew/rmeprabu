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
            margin: 20px 15px;
            font-size: 12px;
            line-height: 1;
        }

        table {
            width: 100%;
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
        <div class="row" style="font-size:100%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 1%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <!-- <img style="height: 85px;" src="./assets/images/gallery/pemkot.jpeg" width="100px" class="dark-logo" /> -->
                                    <img style="height: 85px;" src="./assets/images/gallery/muaraenim.png" width="85px" class="dark-logo" />

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
                                <font size="14px"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <hr size="10px">

                <div>
                    <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                        <tbody>
                            <tr style="height: 100px">
                                <td style="width: 100%; text-align: center; line-height :1">
                                    <br>
                                    <b>
                                        <font size="4"> <?php echo $deskripsi; ?> </font>
                                    </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="pull-text">
                    <table style="border-collapse: collapse; width: 95%; height: 1px;" border="0">
                        <tbody>

                            <?php
                            foreach ($datapasien as $row) :
                            ?>

                                <tr>
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
                                    <td>Nomor Bukti</td>
                                    <td>: <?php echo $row['journalnumber']; ?></td>
                                    <td></td>
                                    <td>Waktu Pembuatan</td>
                                    <td colspan="2">: <?php echo tgl_indo($tanggal); ?></td>

                                </tr>
                                <tr>
                                    <td>Nomor RM</td>
                                    <td>: <?= $row['pasienid']; ?></td>
                                    <td></td>
                                    <td>Poliklinik</td>
                                    <td colspan="2">: <?= $row['poliklinikname']; ?></td>

                                </tr>
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td>: <?= $row['pasienname']; ?></td>
                                    <td></td>
                                    <td>Pembayaran</td>
                                    <td colspan="2">: <?= $row['paymentmethodname']; ?></td>

                                </tr>
                                <tr>
                                    <td>ALamat</td>
                                    <td>: <?= $row['pasienaddress']; ?></td>
                                    <td>&nbsp;</td>
                                    <td>No. Pendaftaran</td>
                                    <td colspan="2">: <?= $row['referencenumber']; ?></td>

                                </tr>


                                <tr>
                                    <td>Dokter</td>
                                    <td colspan="2">: <?= $row['doktername']; ?></td>

                                    <td>Waktu pendaftaran</td>
                                    <td colspan="2">: <?= $documentdate; ?> | <?= $createdby; ?></td>

                                </tr>



                        </tbody>
                    </table>
                    <br>
                    <table id="dataGabung" class="table table-sm" border="0" style=" width: 95%;">
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
                                    <?php $TotKarcis[] = $row['price'];  ?>
                                    <?php $no++; ?>
                                </tr>

                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td style="text-align: left;"><?= $row['nama_konsul'] ?></td>

                                    <td style="text-align: right;"><?= number_format($row['harga_konsul'], 2, ",", ".") ?></td>
                                    <?php $TotKonsul[] = $row['harga_konsul'];  ?>
                                    <?php $no++; ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php $check_TotKarcis = isset($TotKarcis) ? array_sum($TotKarcis) : 0;
                                $TotalKarcis = $check_TotKarcis;

                                $check_TotKonsul = isset($TotKonsul) ? array_sum($TotKonsul) : 0;
                                $TotalKonsul = $check_TotKonsul;

                                $TotalPemeriksaan = $TotalKarcis + $TotalKonsul;
                            ?>

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
                            <?php endforeach; ?>
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
                                <td></td>
                                <?php //$check_TotPem = isset($TotPemeriksaan) ? array_sum($TotPemeriksaan) : 0;
                                //$TotalPemeriksaan = $check_TotPem;

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
                                <?php
                                foreach ($datapasien as $rowbayar) :
                                ?>

                            </tr>

                            <td style="text-align: right;" colspan="2"><b>Pembayaran</b></td>
                            <td></td>
                            <td style="text-align: right;">
                                <?= number_format(($rowbayar['paymentamount'] + $rowbayar['nominaldebet']), 2, ",", ".") ?>
                            </td>
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
                                    }


                            ?>
                            <?php /*
                            <tr>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">Uang Kembali</td> */ ?>
                            <?php
                                    $bayar = $rowbayar['paymentamount'] + $rowbayar['nominaldebet'];
                                    if ($rowbayar['subtotal'] > $bayar) {
                                        $sisabayar = ($rowbayar['subtotal'] - ($rowbayar['paymentamount'] + $rowbayar['nominaldebet']));
                                        $uangkembali = 0;
                                        $bilang = $bayar;
                                    } else {
                                        $sisabayar = 0;
                                        $uangkembali = $bayar - $rowbayar['subtotal'];
                                        $bilang = $rowbayar['subtotal'];
                                    }
                            ?>
                            <?php /*
                                <td></td>
                                <td><?= number_format(($uangkembali), 2, ",", ".") ?></td>

                            </tr>
                            */ ?>
                        <?php endforeach; ?>

                        </tfoot>
                    </table>
                    <b>Terbilang : #<?php echo ucwords(terbilang($bilang)) . " Rupiah"; ?>#</b>

                    <table style="border-collapse: collapse; width: 95%; height: 90px;" border="0">
                        <tbody>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr style="height: 18px;">
                                <td style="width: 50%; text-align: center; height: 18px;">Penyetor</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Petugas Kasir</td>
                            </tr>
                            <?php
                                foreach ($datapasien as $tanda) :
                            ?>

                                <tr style="height: 18px;">
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr style="height: 30px;">

                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['payersname']; ?></u></td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['createdby']; ?></u></td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
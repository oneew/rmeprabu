<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Rincian Biaya Instalasi Gawat Darurat</title>
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
                <div>
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 0;" border="0">
                        <tbody>
                            <tr>
                                <td style="width: 100%; text-align: center; line-height: 0;">
                                    <h5><b class="text-info"><?= $header1; ?></b></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center; line-height: 0;">
                                    <h5><b><?= $header2; ?></b></h5>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;"><?= $alamat; ?></td>
                            </tr>

                            <tr>
                                <td style="width: 100%; text-align: center;">
                                    <h6> <?= $deskripsi; ?></h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
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
                                    <td style="text-align">Nomor Bukti</td>
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
                    <table id="dataGabung" class="table color-table purple-table" style="border: 1;">
                        <thead>
                            <tr>

                                <th>Tipe</th>
                                <th>Keterangan</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                foreach ($pasien as $row) :


                            ?>
                                <tr>

                                    <td></td>
                                    <td style="text-align: left;"><?= $row['description'] ?></td>
                                    <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".")  ?></td>
                                    <td>1</td>
                                    <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".") ?></td>
                                    <?php $TotPemeriksaan[] = $row['price'];  ?>

                                </tr>
                            <?php endforeach; ?>
                            <?php
                                foreach ($TNO as $rowTNO) :


                            ?>
                                <tr>

                                    <td><?= $rowTNO['types'] ?></td>
                                    <td><?= $rowTNO['journalnumber'] ?> <?= $rowTNO['name']  ?></td>
                                    <td><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                                    <td><?= $rowTNO['qty'] ?></td>
                                    <td><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                                    <?php $TotTNO[] = $rowTNO['subtotal'];  ?>

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

                                    <td><?= $P['groups'] ?></td>
                                    <td><?= $deskripsi; ?> | <?= $P['journalnumber'] ?></td>
                                    <td><?= number_format($P['totalamount'], 2, ",", ".") ?></td>
                                    <td><?= $P['totalqty'] ?></td>
                                    <td><?= number_format($P['totalamount'], 2, ",", ".") ?></td>
                                    <?php $TotPENUNJANG[] = $P['totalamount'];  ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php
                                foreach ($FARMASI as $F) :
                            ?>
                                <tr>
                                    <td>FAR</td>
                                    <td><?= $F['documentdate'] ?></td>
                                    <td><?= $F['journalnumber'] ?></td>
                                    <td><?= $F['poliklinikname']  ?></td>
                                    <td><?= $F['doktername']  ?></td>
                                    <td><?php $awal = abs($F['price']);
                                        $far = $awal + $F['embalase'];
                                        $deni = ceil($far);
                                        echo number_format($deni, 2, ",", ".") ?></td>
                                    <?php $TotFAR[] = $deni;  ?>
                                </tr>
                            <?php endforeach; ?>
                            <?php
                                foreach ($BHP as $behape) :
                            ?>
                                <?php
                                    if ($behape['totalbhp'] > 0) { ?>
                                    <tr>

                                        <td>BHP <?= $behape['types'] ?></td>
                                        <td><?= $behape['journalnumber'] ?></td>
                                        <td><?= number_format($behape['totalbhp'], 2, ",", ".")  ?></td>
                                        <td></td>
                                        <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                        <?php $TotBHP[] = $behape['totalbhp'];  ?>
                                    </tr>
                                <?php } ?>
                            <?php endforeach; ?>
                            <?php
                                foreach ($OPERASI as $OP) :
                            ?>
                                <tr>
                                    <td><?= $OP['types'] ?></td>
                                    <td><?= $OP['documentdate'] ?></td>
                                    <td><?= $OP['journalnumber'] ?></td>
                                    <td><?= $OP['name']  ?></td>
                                    <td><?= $OP['doktername'] ?></td>
                                    <td><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><b>Total Biaya</b></td>
                                <td></td>
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
                                <td>
                                    <h6><?= number_format($totalbiaya, 2, ",", ".") ?></h6>
                                </td>
                                <?php
                                foreach ($datapasien as $rowbayar) :
                                ?>

                            </tr>
                            <td></td>
                            <td></td>
                            <td style="text-align: right;"><b>Pembayaran</b></td>
                            <td></td>
                            <td>
                                <h6><?= number_format(($rowbayar['paymentamount'] + $rowbayar['nominaldebet']), 2, ",", ".") ?></h6>
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
                            <tr>

                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">Uang Kembali</td>
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
                                <td></td>
                                <td><?= number_format(($uangkembali), 2, ",", ".") ?></td>

                            </tr>
                        <?php endforeach; ?>

                        </tfoot>
                    </table>
                    <b>Terbilang : #<?php echo ucwords(terbilang($bilang)) . " Rupiah"; ?>#</b>

                    <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
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
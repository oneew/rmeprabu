<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Rincian Biaya Pemeriksaan Penunjang</title>
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
                                    <h6>Rincian Tagihan Biaya Pemeriksaan Penunjang</h6>
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
                                    <td colspan="2">: </td>

                                </tr>
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td>: <?= $row['pasienname']; ?></td>
                                    <td></td>
                                    <td>Pembayaran</td>
                                    <td colspan="2">: <?= $row['paymentmethod']; ?></td>

                                </tr>
                                <tr>
                                    <td>ALamat</td>
                                    <td>: <?= $row['pasienaddress']; ?></td>
                                    <td>&nbsp;</td>
                                    <td>No. Pendaftaran</td>
                                    <td colspan="2">: <?= $row['referencenumber']; ?></td>

                                </tr>


                                <tr>
                                    <td>Dokter Pemeriksa</td>
                                    <td colspan="2">: <?= $row['employeename']; ?></td>

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
                                    if ($P['groups'] == "RHM") {
                                        $deskripsi = 'Rehab Medik';
                                    }
                                    ?>

                                    <td><?= $P['groups'] ?></td>
                                    <td><?= $P['name'] ?></td>
                                    <td><?= number_format($P['totaltarif'], 2, ",", ".") ?></td>
                                    <td><?= $P['qty'] ?></td>
                                    <td><?= number_format($P['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $TotPENUNJANG[] = $P['totaltarif'];  ?>
                                </tr>
                            <?php endforeach; ?>



                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="text-align: right;"><b>Total Biaya</b></td>
                                <td></td>
                                <?php
                                $check_TotPenunjang = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                                $TotalPenunjang = $check_TotPenunjang;




                                $totalbiaya =  $TotalPenunjang;



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
                            <td style="text-align: right;"><b>Tagihan</b></td>
                            <td></td>
                            <td>
                                <h6><?= number_format($totalbiaya, 2, ",", ".") ?></h6>
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
                        <?php endforeach; ?>

                        </tfoot>
                    </table>
                    <b>Terbilang : #<?php echo ucwords(terbilang($totalbiaya)) . " Rupiah"; ?>#</b>
                    <br>Status Validasi Kasir/Pembayaran : <b><?= $row['validation']; ?></b>

                    <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
                        <table style="border-collapse: collapse; width: 100%; height: 107px;" border="0">
                            <tbody>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;"><?= $createdby; ?></td>
                                </tr>
                                <tr style="height: 17px;">
                                    <td style="width: 25%; height: 17px;">&nbsp;</td>
                                    <td style="width: 25%; height: 17px;">&nbsp;</td>
                                    <td style="width: 25%; height: 17px;">&nbsp;</td>
                                    <td style="width: 25%; height: 17px;">KASIR</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                    <td style="width: 25%; height: 18px;">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>

                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
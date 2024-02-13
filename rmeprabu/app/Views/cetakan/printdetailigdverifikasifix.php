<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Rincian Biaya Instalasi IGD</title>
    <style type="text/css">
        @page {
            margin: 20px 15px;
            font-size: 12px;
            margin-top: 0.8.cm;
            margin-bottom: 1.cm;
            margin-left: 1.5.cm;
            margin-right: 1.5.cm;
            line-height: 1.3;
            color: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            font-size: 12px;
            line-height: 1.3;
            /* font-family: "Arial", "sans-serif,""Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: black;
        }

        .wgaris {
            border-width: 1px;
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

    <table class="verifikasi" style="width: 100%; border-collapse: collapse; height: 72px;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr style="height: 18px;">
                <td class="header1" style="width: 100%; text-align: center; height: 18px;"><b>PEMERINTAH KABUPATEN MUARA ENIM<b></td>
            </tr>
            <tr style="height: 18px;">
                <td class="header2" style="width: 100%; text-align: center; height: 18px;">RSUD DR. H. MUHAMAD RABAIN</td>
            </tr>
            <tr style="height: 18px;">
                <td class="alamat" style="width: 100%; text-align: center; height: 18px;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</td>
            </tr>
            <tr style="height: 18px;">
                <td class="header2" style="width: 100%; text-align: center; height: 18px;"><b>Rincian Biaya Pelayanan IGD</b></td>
            </tr>
        </tbody>
    </table>

    <p>
    <table class="verifikasi" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
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
                    <td style="width: 25%;">Nomor Bukti</td>
                    <td style="width: 25%;" colspan="3">: <?php echo $row['journalnumber']; ?></td>

                </tr>
                <tr>
                    <td style="width: 25%;">Tanggal Pelayanan</td>
                    <td style="width: 25%;">: <?php echo tgl_indo($tanggal); ?></td>
                    <td style="width: 25%;">Poliklinik</td>
                    <td style="width: 25%;">: <?= $row['poliklinikname']; ?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Nama Pasien</td>
                    <td style="width: 25%;">: <?= $row['pasienname']; ?> [<?= $row['pasiengender']; ?>]</td>
                    <td style="width: 25%;">No. Rekam Medik</td>
                    <td style="width: 25%;">: <?= $row['pasienid']; ?></td>
                    
                </tr>
                <tr>
                    <td style="width: 25%;">ALamat</td>
                    <td style="width: 25%;">: <?= $row['pasienaddress']; ?></td>
                    <td style="width: 25%;">Pembayaran</td>
                    <td style="width: 25%;">: <?= $row['paymentmethodname']; ?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Dokter Pemeriksa</td>
                    <td style="width: 25%;">: <?= $row['doktername']; ?></td>
                    <td style="width: 25%;">Waktu pendaftaran</td>
                    <td style="width: 25%;">: <?= $documentdate; ?> | <?= $createdby; ?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">&nbsp;</td>
                    <td style="width: 25%;">&nbsp;</td>
                    <td style="width: 25%;">&nbsp;</td>
                    <td style="width: 25%;">&nbsp;</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



    <hr>
    <table class="verifikasi" id="dataGabung" style="width: 100%; border-collapse: collapse;" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>

                <th>Tipe</th>
                <th>Keterangan</th>
                <th>Dokter</th>
                <th>Harga</th>
                <th>Jumlah</th>
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
                    <td style="text-align: center;"><?= $row['doktername'] ?></td>
                    <td ><?= number_format($row['price'], 2, ",", ".")  ?></td>
                    <td style="text-align: center;">1.00</td>
                    <td ><?= number_format($row['price'], 2, ",", ".") ?></td>
                    <?php $TotPemeriksaan[] = $row['price'];  ?>

                </tr>
            <?php endforeach; ?>
            <?php
            foreach ($TNO as $rowTNO) :


            ?>
                <tr>

                    <td style="text-align: center;"><?= $rowTNO['types'] ?></td>
                    <td><?= $rowTNO['name']  ?></td>
                    <td style="text-align: center;"><?= $row['doktername'] ?></td>
                    <td ><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                    <td style="text-align: center;"><?= $rowTNO['qty'] ?></td>
                    <td ><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
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

                    <td style="text-align: center;"><?= $P['types'] ?></td>
                    <td><?= $P['name']; ?></td>
                    <td style="text-align: center;"><?= $row['doktername'] ?></td>
                    <td ><?= number_format($P['price'], 2, ",", ".") ?></td>
                    <td style="text-align: center;"><?= $P['qty'] ?></td>
                    <td ><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotPENUNJANG[] = $P['subtotal'];  ?>
                </tr>
            <?php endforeach; ?>
            <?php
            foreach ($FARMASI as $F) :
            ?>
                <tr>
                    <td style="text-align: center;">FAR</td>
                    <td><?= $F['name'] ?></td>
                    <td style="text-align: center;"><?= $row['doktername'] ?></td>
                    <td style="text-align: left;"><?= number_format(abs($F['price']), 2, ",", ".") ?></td>
                    <td style="text-align: center;"><?= number_format(abs($F['qty']), 2, ",", ".") ?></td>
                            <td style="text-align: left;"><?php $awal = abs($F['subtotal']);
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

                        <td style="text-align: center;">BHP</td>
                        <td><?= $behape['name'] ?></td>
                        <td style="text-align: center;"><?= $row['doktername'] ?></td>
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
                    <td style="text-align: center;"><?= $OP['types'] ?></td>
                    <td><?= $OP['name']  ?></td>
                    <td style="text-align: center;"><?= $row['doktername'] ?></td>
                    <td><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                    <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;"><b>Total Biaya</b></td>
                <td style="text-align: center;">:</td>
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
                    <b><?= number_format($totalbiaya, 2, ",", ".") ?></b>
                </td>
                <?php
                foreach ($datapasien as $rowbayar) :
                ?>

            </tr>
            <td></td>
            <td></td>
            <td style="text-align: right;"></td>
            <td></td>
            <td>
                <h6></h6>
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
                <tr>
                    <td colspan="2" style="text-align: left;"></td>
                    <td colspan="4" style="text-align: left;">
                                    <i>Terbilang : #<?php echo ucwords(terbilang($totalbiaya)) . " Rupiah"; ?>#</i>
                    </td>
                </tr>
            </tr>

        <?php endforeach; ?>

        </tfoot>
    </table>
    <table class="verifikasi" id="dataGabung" style="width: 100%; line-height:3; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th colspan="2" style="text-align: center;">Petugas Rumah sakit <br>___________</th>
                <th colspan="2" style="text-align: center;">Penyetor <br><u><?= $row['pasienname']; ?></u></th>
            </tr>
    </table>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
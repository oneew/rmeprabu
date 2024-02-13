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
            font-size: 14px;
            font-weight: bold;

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

    <table class="verifikasi" style="width: 100%; border-collapse: collapse; height: 72px;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr style="height: 18px;">
                <td class="header1" style="width: 100%; text-align: center; height: 18px;"><b>PEMERINTAH KABUPATEN MUARA ENIM<b></td>
            </tr>
            <tr style="height: 18px;">
                <td class="header2" style="width: 100%; text-align: center; height: 18px;">RUMAH SAKIT UMUM DAERAH H. M. RABAIN</td>
            </tr>
            <tr style="height: 18px;">
                <td class="alamat" style="width: 100%; text-align: center; height: 18px;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</td>
            </tr>
            <tr style="height: 18px;">
                <td class="header2" style="width: 100%; text-align: center; height: 18px;">Rincian Biaya Instalasi Rawat Jalan</td>
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
                    <td style="width: 25%;">: <?= $row['pasienname']; ?> [<?= $row['pasienid']; ?>]</td>
                    <td style="width: 25%;">Pembayaran</td>
                    <td style="width: 25%;">: <?= $row['paymentmethodname']; ?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">ALamat</td>
                    <td style="width: 25%;">: <?= $row['pasienaddress']; ?></td>
                    <td style="width: 25%;">No. Pendaftaran</td>
                    <td style="width: 25%;">: <?= $row['journalnumber']; ?></td>
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
    <table class="verifikasi" id="dataGabung" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
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
                    <td><?= number_format($row['price'], 2, ",", ".")  ?></td>
                    <td>1</td>
                    <td><?= number_format($row['price'], 2, ",", ".") ?></td>
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
                <?php
                if ($F['harga'] > 0) { ?>
                    <tr>

                        <td>FAR</td>
                        <td><?= $F['documentdate'] ?> [<?= $F['journalnumber'] ?>]</td>
                        <td></td>
                        <td></td>
                        <td><?php
                            $deni = $F['harga'];
                            echo number_format($deni, 2, ",", ".") ?></td>
                        <?php $TotFAR[] = $deni;  ?>
                    </tr>
                <?php } ?>
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

            </tr>

        <?php endforeach; ?>

        </tfoot>
    </table>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
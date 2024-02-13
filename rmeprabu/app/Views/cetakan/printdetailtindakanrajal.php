<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Rincian Pembayaran Tindakan Rawat Jalan</title>
    <style type="text/css">
        @page {
            margin: 0px;
        }

        body {
            margin: 0px;
            margin-left: 10;
            margin-right: 20;
            margin-top: 0.6em;
        }

        .kasirrajal {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: bold;

        }

        .detailrajal {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 20px;


        }

        .headerrajal {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
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
    <table class="headerrajal" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <tr>
                <td style="width: 100%; text-align: center;">PEMERINTAH KABUPATEN MUARAENIM</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: center;">RUMAH SAKIT UMUM DAERAH H. M. RABAIN</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: center;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: center;">RINCIAN PEMBAYARAN TINDAKAN RAWAT JALAN</td>
            </tr>
        </tbody>
    </table>
    <p>
    <table class="kasirrajal" style="width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
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
                    <td style="width: 25%;">: <?php echo $row['journalnumber']; ?></td>
                    <td style="width: 25%;">Waktu Pembuatan</td>
                    <td style="width: 25%;">: <?php echo tgl_indo($tanggal); ?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Nomor RM</td>
                    <td style="width: 25%;">: <?= $row['pasienid']; ?></td>
                    <td style="width: 25%;">Poliklinik</td>
                    <td style="width: 25%;">: <?= $row['poliklinikname']; ?></td>
                </tr>
                <tr>
                    <td style="width: 25%;">Nama Pasien</td>
                    <td style="width: 25%;">: <?= $row['pasienname']; ?></td>
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

    <p>
    <table class="detailrajal" style="width: 100%; border-collapse: collapse;" border="1" cellspacing="0" cellpadding="0">
        <thead>
            <tr>

                <th>Kode Tindakan</th>
                <th>Nama Tindakan</th>
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
                    <td><?= $P['code'] ?></td>
                    <td><?= $P['name'] ?></td>
                    <td style="text-align: right;"><?= number_format($P['price'], 2, ",", ".") ?></td>
                    <td style="text-align: center;"><?= $P['qty'] ?></td>
                    <td style="text-align: right;"><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotPENUNJANG[] = $P['subtotal'];
                    $kasirvalidasi = $P['kasirvalidasi'];
                    ?>

                </tr>
            <?php endforeach; ?>


        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td class="kasirrajal" style="text-align: right;"><b>Total Biaya</b></td>
                <td></td>
                <?php
                $check_TotPenunjang = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                $TotalPenunjang = $check_TotPenunjang;

                $totalbiaya =  $TotalPenunjang;
                ?>
                <td style="text-align: right;" class="kasirrajal">
                    <?= number_format($totalbiaya, 2, ",", ".") ?>
                </td>
                <?php
                foreach ($datapasien as $rowbayar) :
                ?>

            </tr>
            <td></td>
            <td></td>
            <td class="kasirrajal" style="text-align: right;"><b>Total Pembayaran</b></td>
            <td></td>
            <td style="text-align: right;" class="kasirrajal">
                <?= number_format($totalbiaya, 2, ",", ".") ?>
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
    <b class="kasirrajal">Terbilang : #<?php echo ucwords(terbilang($totalbiaya)) . " Rupiah"; ?>#</b>
    </table>
    <table class="kasirrajal" style="border-collapse: collapse; width: 100%;" border="0">
        <tbody>
            <tr>
                <td style="width: 50%; text-align: center;">&nbsp;</td>
                <td style="width: 50%; text-align: center;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: center;">&nbsp;</td>
                <td style="width: 50%; text-align: center;">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td style="width: 50%; text-align: center;">&nbsp;</td>
                <td style="width: 50%; text-align: center;"><?= $kasirvalidasi; ?></td>
            </tr>
        </tbody>
    </table>
</body>
<script type="text/javascript">
    window.print();
</script>

</html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/images/favicon.ico">
    <title>SPRI</title>
    <style type="text/css">
        @page {
            margin: 22px;
        }

        body {
            margin: 1px;
            width: 21.59cm;
            height: 9cm;
        }

        .bpjs {
            font-size: 8px;
        }

        .tebal {
            font-weight: bold;
            font-weight: 900;
        }
    </style>

</head>
<?php
$tanggal = $tglRencanaKontrol;
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

<body>
    <div class="row tebal" style="font-size:60%">
        <table style="border-collapse: collapse; width: 60%; height: 234px;" border="0">
            <tbody>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 36px; text-align: center;" rowspan="2"><img style="height: 30px;" src="./assets/images/gallery/bpjs.jpeg" width="100" class="dark-logo" /></td>
                    <td style="width: 33.3333%; height: 10px; text-align: left;">SURAT RENCANA KONTROL</td>
                    <td style="width: 33.3333%; height: 13px; text-align: right;">No. <?= $noSuratKontrol; ?></td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 10px;">RSUD H. M. RABAIN</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Kepada Yth</td>
                    <td colspan="2" style="width: 33.3333%; height: 13px;">: <?= $namaDokter; ?></td>

                </tr>
                <tr style="height: 13px;">
                    <td style="width: 99.9999%; height: 13px; text-align: left;" colspan="3">Mohon Pemeriksaan dan Penanganan Lebih Kanjut:</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">No Kartu</td>
                    <td style="width: 33.3333%; height: 13px;">: <?= $noKartu; ?></td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Nama Peserta</td>
                    <td style="width: 33.3333%; height: 13px;">: <?= $nama; ?> [<?= $jenkel; ?>]</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Tgl.Lahir</td>
                    <td style="width: 33.3333%; height: 13px;">: <?= $tglLahir; ?></td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Diagnosa</td>
                    <td style="width: 33.3333%; height: 13px;">: <?= $diagnosa; ?></td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Rencana Kontrol</td>
                    <td style="width: 33.3333%; height: 13px;" colspan="2">: <?php echo tgl_indo($tanggal); ?> [<?= $poliTujuan; ?>]</td>

                </tr>
                <tr style="height: 13px;">
                    <td style="width: 99.9999%; height: 13px;" colspan="3">Demikian atas bantuannya, diucapkan banyak terimakasih.</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">Mengetahui DPJP,</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td colspan="3" style="width: 33.3333%; height: 13px;"><?= $barcode; ?></td>

                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px; font-size:60%">Tgl.terbit : <?= $tglTerbit; ?></td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
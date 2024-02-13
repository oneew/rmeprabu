<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/images/favicon.ico">
    <title>SuratRujukanAntarRS</title>
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
$tanggal = $tglRujukan;
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


<?php
$tglBerlakuKunjungan = $tglBerlakuKunjungan;
function tgl_indo2($tglBerlakuKunjungan)
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
    $pecahkan = explode('-', $tglBerlakuKunjungan);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

?>

<?php
$tglRencanaKunjungan = $tglRencanaKunjungan;
function tgl_indo3($tglRencanaKunjungan)
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
    $pecahkan = explode('-', $tglRencanaKunjungan);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

?>



<body>
    <div class="row tebal" style="font-size:60%">
        <table style="border-collapse: collapse; width: 60%; height: 234px;" border="0">
            <tbody>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 36px; text-align: center;" rowspan="2"><img style="height: 30px;" src="./assets/images/gallery/bpjs.jpeg" width="100" class="dark-logo" /></td>
                    <td style="width: 33.3333%; height: 10px; text-align: left;">SURAT RUJUKAN
                        <br>RSUD H. M. RABAIN
                    </td>
                    <td style="width: 33.3333%; height: 13px; text-align: right;">No. <?= $noRujukan; ?>
                        <br><?php echo tgl_indo($tanggal); ?>
                    </td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 10px;"></td>
                    <td style="width: 33.3333%; height: 13px; text-align:right"></td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Kepada Yth</td>
                    <td style="width: 33.3333%; height: 13px;">: <?= $namapoliTujuan; ?>
                        <br>: <?= $namaTujuanRujukan; ?><< /td>
                    <td style="width: 33.3333%; height: 13px;"> </td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 99.9999%; height: 13px; text-align: left;" colspan="3">Mohon Pemeriksaan dan Penanganan Lebih Kanjut:</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">No Kartu</td>
                    <td style="width: 33.3333%; height: 13px;">: <?= $noKartu; ?></td>
                    <td style="width: 33.3333%; height: 13px;"><?php if ($tipeRujukan == 0) {
                                                                    $tipe = "Penuh";
                                                                };
                                                                if ($tipeRujukan == 1) {
                                                                    $tipe = "Partial";
                                                                };
                                                                if ($tipeRujukan == 2) {
                                                                    $tipe = "balik PRB";
                                                                };
                                                                echo "==Rujukan $tipe==" ?></td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Nama Peserta</td>
                    <td style="width: 33.3333%; height: 13px;">: <?= $nama; ?></td>
                    <td style="width: 33.3333%; height: 13px;"><?php
                                                                if ($jnsPelayanan == 1) {
                                                                    $jenis = "Rawat Inap";
                                                                };
                                                                if ($jnsPelayanan == 2) {
                                                                    $jenis = "Rawat Jalan";
                                                                };
                                                                echo "---$jenis---" ?></td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Tgl.Lahir</td>
                    <td style="width: 33.3333%; height: 13px;">: <?= $tglLahir; ?></td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Diagnosa</td>
                    <td style="width: 33.3333%; height: 13px;" colspan="2">: <?= $namadiagnosa; ?></td>

                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">Keterangan</td>
                    <td style="width: 33.3333%; height: 13px;" colspan="2">: <?php echo $catatan; ?></td>

                </tr>
                <tr style="height: 13px;">
                    <td style="width: 99.9999%; height: 13px;" colspan="3">Demikian atas bantuannya, diucapkan banyak terimakasih.</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">Mengetahui</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;" colspan="2">Rujukan Berlaku Sampai Dengan <?= tgl_indo2($tglBerlakuKunjungan); ?></td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>

                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;" colspan="2">Tanggal Rencana Berkunjung <?= tgl_indo3($tglRencanaKunjungan); ?></td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>

                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                </tr>
                <tr style="height: 13px;">
                    <td style="width: 33.3333%; height: 13px; font-size:60%">Tgl.terbit : <?= $tglRujukan; ?></td>
                    <td style="width: 33.3333%; height: 13px;">&nbsp;</td>
                    <td style="width: 33.3333%; height: 13px;">__________________</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
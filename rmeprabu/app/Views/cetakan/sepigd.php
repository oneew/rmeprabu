<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/assets/images/favicon.ico">
    <title>SEP IGD</title>
    <style type="text/css">
        @import url('http://fonts.cdfonts.com/css/arial');

        body {
            /* margin: 1px;
            width: 21.59cm;
            height: 9cm;
            margin-top: 0px;
            margin-bottom: 0px; */
            margin-top: 0px;
            margin-left: 0px;
            padding-top: 0px;
            padding-bottom: 0px;
            /* padding-top: 1px;
            padding-bottom: 1px; */
            font-family: 'Arial', sans-serif;
        }

        .bpjs {
            font-size: 8px;
            color: #000000;
        }

        .sep {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;

        }

        hr.style1 {
            border-top: 1px solid #8c8b8b;
            width: 100px;
        }
    </style>

</head>

<body>
    <table style="height: 252px; width: 100%; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
        <tbody>
            <?php
            foreach ($datapasien as $row) :
            ?>
                <?php
                $tglSep = $row['tglSep'];
                $create = $row['created_at'];

                if ($create > $tglSep) {
                    $kata = '(Backdate)';
                } else {
                    $kata = '';
                }
                ?>
                <tr style="height: 18px;">
                    <td style="width: 25%; height: 36px;" rowspan="2">
                        <img style="height: 50px;" src="../assets/images/gallery/bpjs.jpeg" width="100" />
                    </td>
                    <td style="width: 50%; height: 18px; text-align:center" colspan="2"><b>SURAT ELIGIBILTAS PESERTA</b></td>
                    <td style="width: 25%; height: 36px;" rowspan="2">
                        <img style="height: 20px;" src="../assets/images/gallery/muaraenim.png" width="40" />
                    </td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 50%; height: 18px; text-align:center" colspan="2"><b>RUMAH SAKIT UMUM DAERAH H. M. RABAIN</b></td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">No.SEP</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['noSep']; ?> <b><?= $kata; ?></b></td>
                    <td class="sep" style="width: 25%; height: 18px;">&nbsp;</td>
                    <td class="sep" style="width: 25%; height: 18px;">&nbsp;</td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">Tgl.SEP</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['tglSep']; ?></td>
                    <td class="sep" style="width: 25%; height: 18px;">Peserta</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['jnsPeserta']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">No.Kartu</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['noKartu']; ?></td>
                    <td class="sep" style="width: 25%; height: 18px;">&nbsp;</td>
                    <td class="sep" style="width: 25%; height: 18px;">&nbsp;</td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">Nama Peserta</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['nama']; ?> (<?= $row['norm'] ?>)</td>
                    <td class="sep" style="width: 25%; height: 18px;">Jns.Rawat</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['jnsPelayanan']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">Tgl.Lahir</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['tglLahir']; ?></td>
                    <td class="sep" style="width: 25%; height: 18px;">Jns.Kunjungan</td>
                    <?php
                    if ($row['tujuanKunj'] == 0) {
                        $tujuan = "Normal";
                    }
                    if ($row['tujuanKunj'] == 1) {
                        $tujuan = "Prosedur";
                    }
                    if ($row['tujuanKunj'] == 2) {
                        $tujuan = "Konsul Dokter";
                    }
                    ?>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $tujuan; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">No.Telepon</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['noTelp']; ?></td>
                    <td class="sep" style="width: 25%; height: 18px;">Poli Perujuk</td>
                    <td class="sep" style="width: 25%; height: 18px;">: 0</td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">Sub/Spesialis</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['poli']; ?></td>
                    <td class="sep" style="width: 25%; height: 18px;">Kls.Hak</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['hakKelas']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">Dokter</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $namaDokter; ?></td>
                    <td class="sep" style="width: 25%; height: 18px;">&nbsp;</td>
                    <td class="sep" style="width: 25%; height: 18px;">&nbsp;</td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">Faskes Perujuk</td>
                    <td class="sep" style="width: 25%; height: 18px;">:</td>
                    <td class="sep" style="width: 25%; height: 18px;">Kls.Rawat</td>
                    <td class="sep" style="width: 25%; height: 18px;">: <?= $row['kelasRawat']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">Diagnosa Awal</td>
                    <td class="sep" style="width: 25%; height: 18px;" colspan="3">: <?= $row['diagnosa']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;">Catatan</td>
                    <td sclass="sep" tyle="width: 25%; height: 18px;">: <?= $row['catatan']; ?></td>
                    <td class="sep" style="width: 25%; height: 18px;">Penjamin</td>
                    <td class="sep" style="width: 25%; height: 18px;">:</td>
                </tr>
                <tr style="height: 18px;">
                    <td class="sep" style="width: 25%; height: 18px;" colspan="4">&nbsp;</td>
                </tr>

                <tr>
                    <td class="bpjs" style="width: 25%;" colspan="4">*Sep bukan sebagai bukti penjamin peserta</td>
                </tr>
                <tr>
                    <td class="sep" style="width: 25%;">&nbsp;</td>
                    <td class="sep" style="width: 25%;">&nbsp;</td>
                    <td class="sep" style="width: 25%; text-align:center;" colspan="2">Pasien/ Keluarga Pasien</td>
                </tr>
                <tr>
                    <td style="width: 25%;">&nbsp;</td>
                    <td style="width: 25%;">&nbsp;</td>
                    <td style="width: 25%;">&nbsp;</td>
                    <td style="width: 25%;">&nbsp;</td>
                </tr>

                <tr>
                    <td style="width: 25%;">&nbsp;</td>
                    <td style="width: 25%;">&nbsp;</td>
                    <td colspan="2" style="text-align: center;">
                        <hr class="style1" />
                    </td>
                </tr>
                <tr>
                    <td class="bpjs" style="width: 25%;" colspan="2">Cetakan Ke 1 <?= date('d-m-Y'); ?> <?= date('h:m:s'); ?> Wib</td>
                    <td style="width: 25%;" colspan="2">&nbsp;</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>
<script type="text/javascript">
    window.print();
</script>

</html>
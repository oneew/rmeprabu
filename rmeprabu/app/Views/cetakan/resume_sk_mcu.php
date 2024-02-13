<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK MCU</title>
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }
        p{
            margin-bottom: 0;
            margin-top: 0;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <!-- kop surat -->
    <table style="border-collapse: collapse; width:100%; border-bottom: 1px solid #000;">
        <tr>
            <td style="text-align: left; width: 70px;" rowspan="3">
                <img style="height: 70px;" src="<?= base_url('assets/images/gallery/pemkab.png'); ?>" width="70px" class="dark-logo" />
            </td>
            <td style="text-align: left; width:15cm; font-size: 18px;">
                <?= $kop['header1']; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-size: 18px;">
                <b>
                    <?= $kop['header2']; ?>
                </b>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-size: 12px;">
                <?= $kop['alamat']; ?>
            </td>
        </tr>
    </table>
    <!-- akhir kop surat -->

    <h3 style="text-align: center; margin-bottom: 0;"><u>SURAT KETERANGAN</u></h3>
    <h6 style="text-align: center; margin-top: 0;">Nomor: <?= $data_sk['nomor_surat'] ;?></h6>
    <p style="margin-bottom: 20px;">Penanda tangan di bawah ini, Dokter Pemeriksa di RSUD dr. HM Rabain Muara Enim menerangkan bahwa:</p>
    <table style="border-collapse: collapse; font-size: 12px;">
        <tr>
            <td>Nama</td>
            <td style="text-transform: uppercase;">: <?= $data_sk['name'] ;?></td>
        </tr>
        <tr>
            <td>Tempat dan tanggal lahir</td>
            <td>: <?= $data_sk['placeofbirth'] .', '. date('d-m-Y', strtotime($data_sk['dateofbirth'])) ;?></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>: <?= hitung_usia_by_doc($data_sk['placeofbirth'], $data_sk['created_at'], 1) ;?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $data_sk['gender'] ;?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $data_sk['address'] ;?></td>
        </tr>
    </table>
    
    <div style="font-size: 12px; margin: 20px 0;">
        <?= $data_sk['hasil'] ;?>
    </div>

    <p>Surat keterangan ini untuk keperluan: <strong><?= $data_sk['keperluan'] ;?></strong></p>

    <table style="width: 100%; margin-top: 20px; font-size: 12px;">
        <tr>
            <td style="width: 50%;"></td>
            <td>
                Muara Enim, <?= tgl_indo_helper($data_sk['created_at']) ;?>
                <br>
                Dokter Pemeriksa,
                <br>
                <?= barcode_helper($data_sk['referencenumber']. ' ' .$data_asesmen['doktername']. ' '. $data_sk['created_at']) ;?>
                <br>
                <strong><?= $data_asesmen['doktername'] ;?></strong>
                <br>
                <?= cari_nip_dokter($data_asesmen['doktername']) == null ? null : 'NIP. '. cari_nip_dokter($data_asesmen['doktername']);?>
                <br>
                <?= cari_sip_dokter($data_asesmen['doktername']) == null ? null : 'SIP. '. cari_sip_dokter($data_asesmen['doktername']);?>
            </td>
        </tr>
    </table>
    <script>
        window.print()
    </script>
</body>

</html>
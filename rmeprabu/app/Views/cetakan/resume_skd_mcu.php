<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKD MCU</title>
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

    <h3 style="text-align: center; margin-bottom: 0;"><u>SURAT KETERANGAN DOKTER</u></h3>
    <h6 style="text-align: center; margin-top: 0;">Nomor: <?= $data_skd['nomor_surat'] ;?></h6>
    <p>Yang bertanda tangan di bawah ini, Dokter Spesialis Okupasi (Kedokteran Kerja) Pada RSUD H.M.Rabain Muara Enim, menerangkan bahwa:</p>
    <table style="border-collapse: collapse; font-size: 12px;">
        <tr>
            <td>No. Register</td>
            <td>: <?= $data_skd['referencenumber'] ;?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td style="text-transform: uppercase;">: <?= $data_skd['name'] ;?></td>
        </tr>
        <tr>
            <td>Tempat dan tanggal lahir</td>
            <td>: <?= $data_skd['placeofbirth'] .', '. date('d-m-Y', strtotime($data_skd['dateofbirth'])) ;?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $data_skd['gender'] ;?></td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: <?= $data_skd['religion'] ;?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?= $data_skd['address'] ;?></td>
        </tr>
        <tr>
            <td>Untuk Keperluan</td>
            <td>: <?= $data_skd['keperluan'] ;?></td>
        </tr>
    </table>
    <p>Dengan hasil pemeriksaan :</p>
    <table style="width: 75%; border-collapse: collapse; font-size: 12px;">
        <tr>
            <td>Tinggi Badan</td>
            <td>: <?= $data_asesmen['tb'] ;?> Cm</td>
            <td></td>
            <td>Tensi Darah</td>
            <td>: <?= $data_asesmen['tdSistolik'] .'/'. $data_asesmen['tdDiastolik'];?> mmHg</td>
        </tr>
        <tr>
            <td>Berat Badan</td>
            <td>: <?= $data_asesmen['bb'] ;?> Kg</td>
            <td></td>
            <td>Body Mass Index</td>
            <td>: <?= (int)$data_asesmen['bb'] / ((int)$data_asesmen['tb'] * (int)$data_asesmen['tb']);?> Kg/m2</td>
        </tr>
    </table>
    <p>Berdasarkan hasil pemeriksaan fisik yang bersangkutan pada saat ini dinyatakan :</p>
    <p style="<?= $data_skd['hasil'] == 'Kesehatan Baik' ? null : 'text-decoration: line-through;' ;?>">a. Kesehatan Baik</p>
    <p style="<?= $data_skd['hasil'] == 'Kesehatan cukup baik dengan kelainan yang dapat dipulihkan' ? null : 'text-decoration: line-through;' ;?>">b. Kesehatan cukup baik dengan kelainan yang dapat dipulihkan</p>
    <p style="<?= $data_skd['hasil'] == 'Kemampuan fisik terbatas untuk pekerjaan tertantu' ? null : 'text-decoration: line-through;' ;?>">c. Kemampuan fisik terbatas untuk pekerjaan tertantu</p>
    <p style="<?= $data_skd['hasil'] == 'Tidak sehat dan tidak aman untuk semua pekerjaan' ? null : 'text-decoration: line-through;' ;?>">d. Tidak sehat dan tidak aman untuk semua pekerjaan</p>
    <p>Demikian surat keterangan ini di buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</p>
    <table style="width: 100%; margin-top: 20px; font-size: 12px;">
        <tr>
            <td style="width: 50%;"></td>
            <td>
                Muara Enim, <?= tgl_indo_helper($data_skd['created_at']) ;?>
                <br>
                Dokter Spesialis Okupasi (Kedokteran Kerja)
                <br>
                RSUD Dr. H. M. Rabain Muara Enim
                <br>
                <?= barcode_helper($data_skd['referencenumber']. ' ' .$data_asesmen['doktername']. ' '. $data_skd['created_at']) ;?>
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
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Expertise Patologi Anatomi</title>
    <style type="text/css">
        hr{
            border-top: 3px double #8c8b8b;
        }

        td{
            padding-left: 5px;
            padding-right: 5px;
        }
    </style>
</head>

<body>

    <table style="border-collapse: collapse; width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                <div class="img">
                    <img style="height: 40px;" src="<?= base_url('assets/images/gallery/muaraenim.png') ;?>" width="40" class="dark-logo" />
                </div>
            </td>
            <td style="width: 53.3333%; text-align: center;">
                <h3 style="margin: 0;"><b class="text-info"><?= $kop['header1']; ?></b></h3>
                <h3 style="margin: 0;"><b><?= $kop['header2']; ?></b></h3>
                <?= $kop['alamat']; ?>
            </td>
            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                <div class="img">
                    <img style="height: 40px;" src="<?= base_url('assets/images/gallery/logo_puskesmas.png') ;?>" width="40" class="dark-logo" />
                </div>
            </td>
        </tr>
    </table>
    <hr>
    <h4 style="text-align: center;">LEMBAR JAWABAN</h4>
    <table style="border: 1px solid #000; border-collapse: collapse; width: 100%; font-size: 10px;">
        <tr>
            <td style="border: 1px solid #000; width: 10%;">No. Reg</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['journalnumber'] ;?></td>
            <td style="border: 1px solid #000; width: 15%;">Dokter Pengirim</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['doktername'] ;?></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 10%;">No. RM</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['code'] ;?></td>
            <td style="border: 1px solid #000; width: 15%;">No Telp/HP Pasien</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['mobilephone'] == '' ? '-' : $data['mobilephone'];?></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 10%;">Nama</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['name'] ;?></td>
            <td style="border: 1px solid #000; width: 15%;">Tgl Pengiriman</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= tgl_indo_helper($data['documentdate']);?></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 10%;">Umur/Tgl Lahir</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= hitung_usia_by_doc($data['dateofbirth'], $data['documentdate'], 1) ;?></td>
            <td style="border: 1px solid #000; width: 15%;">Tgl Penyelesaian</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= tgl_indo_helper($data['created_at']);?></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 10%;">Jenis Kelamin</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['gender'] ;?></td>
            <td style="border: 1px solid #000; width: 15%;">Metode Pembayaran</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['paymentmethodname'];?></td>
        </tr>
    </table>

    <table style="border-collapse: collapse; width: 100%; margin-top: 20px;">
        <tr>
            <td style="width: 10%; vertical-align: top;"><strong>MAKROSKOPIS</strong></td>
            <td style="text-align: center; vertical-align: top;">:</td>
            <td style="vertical-align: top;"><?= $data['makroskopis'] ;?></td>
        </tr>
        <tr>
            <td style="width: 10%; vertical-align: top;"><strong>MIKROSKOPIS</strong></td>
            <td style="text-align: center; vertical-align: top;">:</td>
            <td style="vertical-align: top;"><?= $data['mikroskopis'] ;?></td>
        </tr>
        <tr>
            <td style="width: 10%; vertical-align: top;"><strong>KESAN</strong></td>
            <td style="text-align: center; vertical-align: top;">:</td>
            <td style="vertical-align: top;"><?= $data['kesan'] ;?></td>
        </tr>
    </table>

    <table style="border-collapse: collapse; width: 100%; margin-top: 20px; font-size: 10px;">
        <tr>
            <td style="width: 60%;"></td>
            <td>
                Muara Enim, <?= tgl_indo_helper($data['created_at']);?>
                <br>
                <?= barcode_helper($data['journalnumber'].' '. $data['employeename']) ;?>
                <br>
                <u><?= $data['employeename'] ;?></u>
                <br>
                <strong><?= cari_nip_dokter($data['employeename']) == null ? 'SIP. '. cari_sip_dokter($data['employeename']) : 'NIP. ' . cari_nip_dokter($data['employeename']);?></strong>
            </td>
        </tr>
    </table>

    <script>
        window.print();
    </script>
</body>

</html>
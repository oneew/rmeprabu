<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Print CPPT Pasien</title>
    <style type="text/css">
        @page {
            /* margin: 20px 15px; */
            margin: 0;
            font-size: 12px;
        }

        body {
            /* margin: 0px; */
            margin-top: 1.cm;
            margin-left: 1.cm;
            margin-right: 1.cm;
            margin-bottom: 1.cm;
            font-size: 12px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>

</head>

<body>

    <!-- <div class="container-fluid text-dark"> -->
    <div>
        <div class="row">
            <!-- <div class="col-md-12"> -->
             <!-- kop surat -->
             <table style="border-collapse: collapse; width:100%; border-bottom: 1px solid #000;">
                <tr >
                    <td style="text-align: left; width: 70px;" rowspan="3">
                        <img style="height: 70px;" src="<?= base_url('assets/images/gallery/pemkab.png') ;?>" width="70px" class="dark-logo" />
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
            <p style="text-align: center;"><b> CATATAN PERKEMBANGAN PASIEN TERINTEGRASI <br>(Integrated Note)</b></p>
                            <table style="border-collapse: collapse; width: 100%; font-size: 12px;">
                <tr>
                    <td style="text-align: left;">NO. RM</td>
                    <td>: <?= $kunjungan_pasien_ranap['pasienid']; ?></td>
                    <td></td>
                    <td style="text-align: left;">Umur</td>
                    <td colspan="2">: <?= $kunjungan_pasien_ranap['pasienage']; ?> <b>[ <?= $kunjungan_pasien_ranap['pasiengender']; ?> ]</b></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Nama Pasien</td>
                    <td>: <?= $kunjungan_pasien_ranap['pasienname']; ?></td>
                    <td></td>
                    <td style="text-align: left;">Diagnosis</td>
                    <td>: <?= $resume_medis_ranap['diagnosisUtama']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Tgl. Lahir</td>
                    <td>: <?= $kunjungan_pasien_ranap['pasiendateofbirth']; ?></td>
                    <td></td>
                    <td style="text-align: left;">R. Rawat Terakhir</td>
                    <td>: <?= $kunjungan_pasien_ranap['roomname']; ?> / <?= $kunjungan_pasien_ranap['datein']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">P. Jawab Jaminan</td>
                    <td>: <?= $kunjungan_pasien_ranap['namapjb']; ?></td>
                    <td></td>
                    <td style="text-align: left;">Tgl. Keluar/Meninggal</td>
                    <td>: <?= $kunjungan_pasien_ranap['dateout']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Tgl. Masuk</td>
                    <td>:<?= $kunjungan_pasien_ranap['datein']; ?></td>
                </tr>
                            <tr>
                                <td colspan="6">
                                <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tr style="line-height: 1;"> 
                                <td>NO.</td>
                                <td style="text-align: center;">Tanggal dan Jam (Date and Time)</td>
                                <td style="text-align: center;">Profesi (Profession)</td>
                                <td style="text-align: center;"> CPPT(Integrated Progress Note)</td>
                                <td style="text-align: center;"> Nama Pencatat (Note Taker)</td>
                                <td style="text-align: center;"> Tanda Tangan / Cap / Barcode</td>
                            </tr>
                               
                            <tbody>
                            <?php $no = 0;
                              foreach ($Cpptall as $row) :
                                    $no++; ?>
                                 <tr>
                                 <td><?= $no ?>.</td>
                                 <td style="text-align: center;"><?= $row['createddate']  ?> <br> <?= $row['poliklinikname']  ?></td>
                                 <td style="text-align: center;"><?= $row['kelompokCppt']  ?></td>
                                 <td>
                                    <br><strong>Subjektif : </strong> <br><?= $row['s']  ?>
                                    <br><strong>Objektife : </strong> <br><?= $row['o']  ?>
                                    <br><strong>Asesmen : </strong> <br><?= $row['a']  ?>
                                    <br><strong>Planing : </strong><br><?= $row['p']  ?>
                                 </td>
                                 <td tyle="text-align: center;"><?= $row['createdBy']  ?></td>
                                 <td style="text-align: center;">
                                    <div class="qrcode" data-dokter="<?= $row['createdBy']  ?>" data-date="<?= $row['createddate']  ?>" data-ref="<?= $row['referencenumber']  ?>"></div>
                                </td>
                                 </tr>
                            <?php endforeach; ?>
                            </tbody>
                            </table>
                    </table>


                    <table>
                        <tbody>
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->


                </div>
            </div>
        </div>
    </div>

</body>
<script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
<script>
    $('.qrcode').each(function() {
        $(this).qrcode({
            text: $(this).attr('data-dokter') + $(this).attr('data-date') + $(this).attr('data-ref'),
            width: 80,
            height: 80,
        })
    })

</script>
<script type="text/javascript">
    window.print();
</script>
</html>
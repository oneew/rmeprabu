<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Visum</title>
    <style type="text/css">
        @page {
            margin: 10px;
            margin-left: 30px;
            margin-right: 30px;
        }

        table {
            width: 10%;

        }

        table,
        th,
        td {
            text-align: left;
            padding: 5px;

        }

        .divvisum {
            padding: 0px;

            word-spacing: 0px;
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid divvisum">
        <div class="row" style="font-size:60%">
            <div class="col-md-12">
                <table style="border-collapse: collapse; width: 100%; border=" 0">
                    <tbody>
                        <tr>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/pemkab.png" width="40" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 53.3333%; text-align: center;">
                                <h6><b class="text-info"><?= $header1; ?></b></h6>
                            </td>
                            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                                <div class="img">
                                    <img style="height: 40px;" src="./assets/images/gallery/muaraenim.png" width="40" class="dark-logo" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;">
                                <h5><b><?= $header2; ?></b></h5>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;"><?= $alamat; ?></td>
                        </tr>
                        <tr>
                            <td style="width: 33.3333%; text-align: center;">
                                <b>
                                    <u>
                                        <h6> <?= $deskripsi; ?></h6>
                                    </u>
                                </b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
                foreach ($datapasien as $row) :
                ?>
                    <div class="divvisum">
                        <table style="border-collapse: collapse; width: 100%;" border="0" cellpading=0 cellspacing=0>
                            <tbody>
                                <tr>
                                    <td style="width: 22.9318%;">&nbsp;</td>
                                    <td style="width: 36.9829%;">&nbsp;</td>
                                    <td style="width: 40.0852%; text-align: right;">Muara Enim, </td>
                                </tr>
                                <tr>
                                    <td style="width: 22.9318%;">Nomor</td>
                                    <td style="width: 36.9829%;">: <?= $row['journalnumber']; ?></td>
                                    <td style="width: 40.0852%;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 22.9318%;">Perihal</td>
                                    <td style="width: 36.9829%;">: VISUM et REPERTUM</td>
                                    <td style="width: 40.0852%;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><strong>PRO JUSTITIA</strong></td>
                                    <td style="width: 40.0852%;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width: 22.9318%; text-align: center;" colspan="3"><span style="text-decoration: underline;"><strong>VISUM ET REPERTUM</strong></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="divvisum">
                        <table style="border-collapse: collapse; width: 100%;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 100%; text-align: justify;">&nbsp; &nbsp; &nbsp;Yang bertanda tangan dibawah ini <b><?= $row['doktername1']; ?></b> dokter pemeriksa di Instalasi Gawat Darurat di <b>RSUD 45 Kuningan</b> atas permintaan dari <b><?= $row['permintaanDari']; ?></b> dengan surat nomor : <b><?= $row['noPermintaan']; ?></b>, tertanggal &nbsp;dua puluh delapan oktober duaribu duapuluh satu dan diterima oleh kami pada tanggal dua puluh delapan oktober duaribu duapuluh satu maka dengan ini menerangkan bahwa pada tanggal dua puluh delapan oktober duaribu duapuluh satu, Jam __:__:__ Waktu Indonesia Bagian Barat, <b>bertempat di RSUD 45 Kuningan</b>, telah melakukan pemeriksaan korban dengan nomor registrasi <b><?= $row['referencenumber']; ?></b>, yang menurut surat tersebut adalah :</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="divvisum">
                        <table style="border-collapse: collapse; width: 100%; height: 10px;" border="0" cellpading="1" cellspacing="1">
                            <tbody>
                                <tr style="height: 1px;">
                                    <td style="width: 9.97564%; height: 1px;">&nbsp;</td>
                                    <td style="width: 19.8297%; height: 1px;">Nama</td>
                                    <td style="width: 70.1946%; height: 1px;">: <?= $row['pasienname']; ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 9.97564%; height: 1px;">&nbsp;</td>
                                    <td style="width: 19.8297%; height: 1px;">Umur/TTL</td>
                                    <td style="width: 70.1946%; height: 1px;">:</td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 9.97564%; height: 1px;">&nbsp;</td>
                                    <td style="width: 19.8297%; height: 1px;">Jenis Kelamin</td>
                                    <td style="width: 70.1946%; height: 1px;">: <?= $row['pasiengender']; ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 9.97564%; height: 1px;">&nbsp;</td>
                                    <td style="width: 19.8297%; height: 1px;">Agama</td>
                                    <td style="width: 70.1946%; height: 1px;">: <?= $row['pasienreligion']; ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 9.97564%; height: 1px;">&nbsp;</td>
                                    <td style="width: 19.8297%; height: 1px;">Pekerjaan</td>
                                    <td style="width: 70.1946%; height: 1px;">: <?= $row['pasienWork']; ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 9.97564%; height: 1px;">&nbsp;</td>
                                    <td style="width: 19.8297%; height: 1px;">Kewarganegaraan</td>
                                    <td style="width: 70.1946%; height: 1px;">: <?= $row['pasienCitizenship']; ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 9.97564%; height: 1px;">&nbsp;</td>
                                    <td style="width: 19.8297%; height: 1px;">Tempat tinggal</td>
                                    <td style="width: 70.1946%; height: 1px;">: <?= $row['pasienaddress']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="divvisum">
                        <table style="border-collapse: collapse; width: 100%; height: 180px;" border="0">
                            <tbody>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px;"><strong><span style="text-decoration: underline;">HASIL PEMERIKSAAN :</span></strong></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px;">A. Korban datang dalam keadaan : <?= $row['keadaanDatang']; ?>, dengan keadaan umum : <?= $row['keadaanUmum']; ?> ,</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px;">B. Korban Mengaku : <?= $row['pengakuanKorban']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px;">C. Tanda Vital :&nbsp;</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px; padding-left: 40px;">1. Tekanan Darah : <?= $row['tekananDarah']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px; padding-left: 40px;">2. Frekuensi Nadi : <?= $row['frekuensiNadi']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px; padding-left: 40px;">3. Frekuensi Nafas : <?= $row['frekuensiNafas']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px; padding-left: 40px;">4. Suhu : <?= $row['suhu']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px;">D. Pada korban ditemukan : <?= $row['korbanDitemukan']; ?></td>
                                </tr>
                                <tr style="height: 10px;">
                                    <td style="width: 100%; height: 10px;">E. Pada korban dilakukan&nbsp; : <?= $row['statusKorban']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="divvisum">
                        <table style="height: 1px; width: 100%; border-collapse: collapse;" border="0" cellspacing="30">
                            <tbody>
                                <tr style="height: 1px;">
                                    <td style="width: 100%; text-align: center; height: 1px;"><strong>KESIMPULAN</strong></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 100%; height: 1px;"><?= $row['kesimpulan']; ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 100%; height: 1px;">Demikian visum et repertum ini dibuat dengan sebenarnya dengan menggunakan keilmuan yang sebaik-baiknya,mengingat sumpah sesuai dengan kitab undang-undang hukum acara pidana.------ </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <br>
                <?php endforeach; ?>
                <?php

                $tanggal = date('Y-m-d');
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

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%;" border="0">
                        <tbody>
                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>
                                <tr>
                                    <td style="width: 33.3333%;">&nbsp;</td>
                                    <td style="width: 33.3333%;">&nbsp;</td>
                                    <td style="width: 33.3333%; text-align: right;">Muara Enim,<?php echo tgl_indo($tanggal); ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">Dokter Pemeriksa</td>
                                    <td style="width: 33.3333%;">&nbsp;</td>
                                    <td style="width: 33.3333%;">Dokter Pemeriksa</td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;"><u><?= $tanda['doktername1']; ?></u></td>
                                    <td style="width: 33.3333%;">&nbsp;</td>
                                    <td style="width: 33.3333%;"><u><?= $tanda['doktername2']; ?></u></td>
                                </tr>
                                <tr>
                                    <td style="width: 33.3333%;">SIP.</td>
                                    <td style="width: 33.3333%;">&nbsp;</td>
                                    <td style="width: 33.3333%;">SIP.</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
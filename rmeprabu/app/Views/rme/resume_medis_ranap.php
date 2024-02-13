<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Resume Pasien Keluar</title>
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

        table {
            width: 100%;
        }
    </style>

</head>

<body>
    <div>
        <div class="row">
            <div>
                <div> 
                    <table style="border-collapse: collapse; line-height: 1; width:100%;" border="0">
                        <tbody>
                            <tr >
                                <td style="width: 3.cm; text-align: left;" rowspan="3">
                                    <div class="img">
                                        <img style="height: 70px;" src="./assets/images/gallery/pemkab.png" width="70px" class="dark-logo" />
                                    </div>
                                </td>
                                <td style="text-align: left; width:15.cm">
                                    <font size="18px"><?= $header1; ?></font>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <b>
                                        <font size="22px"><?php echo $header2; ?></font>

                                    </b>
                                </td>
                            </tr>
                            <tr>

                                <td style="text-align: left;">
                                    <font size="1"><?php echo $alamat; ?></font>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                                </td>
                            </tr>

                            <tr style="height: 100px">
                                <td style="width: 100%; text-align: center; line-height :0.5" colspan="2">
                                    <br>
                                    <b>
                                        <font size="4">
                                    </b>
                                    <b> RESUME MEDIS PASIEN RAWAT INAP</b>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <br>

                <div class="0">
                    <table style="border-collapse: collapse; width: 100%;" border="0">
                        <thead>
                            <tr>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 3cm;"> </td>
                            </tr>
                        </thead>
                        <tbody style="line-height: 1;">
                            <tr>
                                <td style="text-align: left;">NO. RM</td>
                                <td>: <?= $pasienid; ?></td>
                                <td></td>
                                <td style="text-align: left;">Umur</td>
                                <td colspan="2">: <?= $pasienage; ?> <b>[ <?= $pasiengender; ?> ]</b></td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td style="text-align: left;">Nama Pasien</td>
                                <td colspan="2">: <?= $pasienname; ?></td>
                                <td></td>
                                <!-- <td style="text-align: left;">Jenis Kelamin</td>
                                <td>: ?= $pasiengender; ?></td> -->
                            </tr>
                            <tr style="line-height: 1;">
                                <td style="text-align: left;">Tgl. Lahir</td>
                                <td>: <?= $pasiendateofbirth; ?></td>
                                <td></td>
                                <td style="text-align: left;">Diagnosis</td>
                                <td colspan="2">:<?= $diagnosisUtama; ?></td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td style="text-align: left;">P. Jawab Jaminan</td>
                                <td>: <?= $namapjb; ?></td>
                                <td></td>
                                <td style="text-align: left;">R. Rawat Terakhir</td>
                                <td>: <?= $roomname; ?></td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td style="text-align: left;">Tgl. Masuk</td>
                                <td>:<?= $datein;?></td>
                                <td></td>
                                <td style="text-align: left;">Tgl. Keluar/Meninggal</td>
                                <td>: <?= $dateout; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Alamat</td>
                                <td colspan="2">: <?= $pasienaddress;?></td>
                                <td style="text-align: left;">Status Pulang</td>
                                <td colspan="2">: <?=$statuspasien;?></td>
                            </tr>
                            <tr style="line-height: 3;">
                                <td colspan="2">- Alasan Dirawat di Rumah Sakit :</td>
                                <td colspan="4"> <u><?= $alasanRawat; ?></u></td>
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="2">- Ringkasa Riwayat Penyakit :</td>
                                <td colspan="4"> <u> <?= $ringkasanRiwayatPenyakit; ?></u></td>
                            </tr>

                            <tr style="line-height: 1.5;">
                                <td colspan="2">- Hasil Pemeriksaan Fisik :</td>
                                <td colspan="4"> <u><?= $hasilPemeriksaanFisik; ?></u></td>
                            </tr>

                            <tr style="line-height: 1.5;">
                                <td colspan="2">- Pemeriksaan Penunjang/Diagnostik Penting :</td>
                                <td colspan="4"> <u><?= $pemeriksaanPenunjang; ?></u></td>
                            </tr>

                            <tr style="line-height: 1.5;">
                                <td colspan="2">- Terapi/Pengobatan Selama di Rumah Sakit :</td>
                                <td colspan="4"> <u><?= $terapiSelamaRawat; ?></u></td>
                            </tr>

                            <tr style="line-height: 1.5;">
                                <td colspan="2">- Perkembangan Setelah Perawatan :</td>
                                <td colspan="4"> <u><?= $perkembanganSetelahPerawatan; ?></u></td>
                            </tr>

                            <tr style="line-height: 2;">
                                <td colspan="2">- Alergi(reaksi obat) :</td>
                                <td colspan="4"> <u><?= $alergiObat; ?></u></td>
                                <!-- <td colspan="6">1. Tidak &nbsp; &nbsp; &nbsp; 2. Ya, Jelaskan :________________________________________________________________</td> -->
                            </tr>
                            <tr style="line-height: 3;">
                                <td>- Diagnosis Utama</td>
                                <td colspan="3">: <u><?= $diagnosisUtama; ?></u></td>
                                <!-- <td colspan="2">ICD 10 :_________________________</td> -->
                                <!-- <td>:</td> -->
                            </tr>
                            <tr style="line-height: 2;">
                                <td>- Diagnosis Sekunder</td>
                                <td colspan="3">: <u><?= $diagnosisSekunder; ?></u></td>
                                <!-- <td colspan="2">ICD 10 :_________________________</td> -->
                                <!-- <td>:</td> -->
                            </tr>
                            <tr style="line-height: 2;">
                                <td>- Tindakan/Prosedur</td>
                                <td colspan="3">: <u><?= $prosedur; ?></u></td>
                                <!-- <td colspan="2">ICD 9 &nbsp; :_________________________</td> -->
                                <!-- <td>:</td> -->
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="6">- Kondisi Waktu Keluar : <u><?= $kondisiWaktuKeluar; ?></u></td>
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="6">- Pengobatan Dilanjutkan : <u><?= $pengobatanDilanjutkan; ?></u></td>
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="6">- Tanggal Kontrol Poliklinik : <u><?= !in_array($tanggalKontrol, ['-', null]) ? tgl_indo_helper($tanggalKontrol) : $tanggalKontrol ;?></u></td>
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="1">- Terapi Pulang :</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <table id="dataradiologi" style="border-collapse: collapse;" class="table color-table success-table" border="1">
                                        <thead>
                                            <tr>

                                                <th>No</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Dosis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($DetailObat as $row) :
                                                $no++; ?>
                                                <tr>

                                                    <td><?= $no ?></td>
                                                    <td><?= $row['name']  ?></td>
                                                    <td style="text-align: center;"><?= round($row['qtypaket']) ?></td>
                                                    <td style="text-align: center;"><?= round($row['signa1']) ?> x <?= round($row['signa2']) ?></td>

                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php
                            $date = $dateout;
                            function tgl_indo3($date)
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
                                $pecahkan = explode('-', $date);
                                return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                            }

                            ?>
                            <tr style="line-height: 2.5;">
                                <td colspan="3">
                                    Format Resume Medis Ditambahkan Catatan :
                                </td>
                                <td colspan="3" style="text-align: center;">
                                    Muara Enim,  <?php echo tgl_indo3($date); ?>
                                </td>
                            </tr>
                            <tr style="line-height: 0.9;">
                                <td colspan="3">
                                    Bila terjadi keadaan darurat segera menghubungi pusat pelayanan kesehatan terdekat !
                                </td>
                                <td colspan="3" style="text-align: center;">Dokter Penanggung Jawab Pelayanan</td>
                            </tr>
                            <tr style="line-height: 4.5;">
                                <td colspan="3">Lembar 1 : Rekam Medis</td>
                                <td colspan="3" style="text-align: center;"><?= $barcode; ?></td>
                            </tr>
                            <tr style="line-height: 0;">
                                <td colspan="3">Lembar 2 : Pasien</td>
                                <td colspan="3" style="text-align: center;"> <?= $doktername; ?>
                                <br>(_____________________________)</td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td colspan="3">Lembar 3 : Penjamin
                                <br colspan="3"><i>*Dibuat pada tanggal <?= $createddate; ?>*</i>
                                <br colspan="3"><i>*Login by dpjp <?= $doktername; ?>*<i>
                                </td>
                            </tr>
                         
                        </tbody>
                    </table>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
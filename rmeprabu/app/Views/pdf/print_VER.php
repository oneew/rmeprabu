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
        table {
            width: 10%;

        }

        table,
        th,
        td {
            text-align: left;
            padding: 5px;
        }
    </style>
    </style>
</head>

<body>

    <div class="container-fluid">
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

                <div class="pull-text text-left">
                    <table style="height: 180px; width: 100%; border-collapse: collapse;" border="1" cellspacing="30">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <tr style="height: 18px;">
                                    <td style="width: 100%; height: 18px;" colspan="2"><strong>I. Surat Permintaan Visum Et Repertum</strong></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">a)No. Surat Permintaan</td>
                                    <td style="width: 67.1533%; height: 18px;">: <?= $row['request_number']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">b)Tanggal waktu SP Ver Diterima</td>
                                    <td style="width: 67.1533%; height: 18px;">: <?= $row['documentdate']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">c)Pihak Yang Membuat SPV</td>
                                    <td style="width: 67.1533%; height: 18px;">: <?= $row['request_from']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;" colspan="2"><strong>Laporan Visum Et Repertum</strong></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">a)Waktu dan Pembuatan VeR</td>
                                    <td style="width: 67.1533%; height: 18px;">: <?= $row['updated_at']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;" colspan="2">b)Identitas Pasien</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">1.Nama</td>
                                    <td style="width: 67.1533%; height: 18px;">: <?= $row['pasienname']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">2.Nomor Rekam Medis</td>
                                    <td style="width: 67.1533%; height: 18px;">: <?= $row['pasienid']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">3.Alamat</td>
                                    <td style="width: 67.1533%; height: 18px;">: <?= $row['alamat']; ?></td>
                                </tr>

                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;" colspan="2">c)Hasil Pemeriksaan</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">
                                        <p style="padding-left: 40px;">1.Tinggi Badan</p>
                                    </td>
                                    <td style="width: 67.1533%; height: 18px;">: <?= $row['tinggibadan']; ?> Sentimer</td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">2.Berat Badan</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['beratbadan']; ?> Kilogram</td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">3.Ciri Khusus</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['cirikhusus']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">4.Kepala</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['kepala']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">4.Leher</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['leher']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">5.Bahu</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['bahu']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">6.Dada</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['dada']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">7.Punggung</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['punggung']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">7.Perut</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['perut']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">8.Pinggang</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['pinggang']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">9.Bokong</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['bokong']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">10.Dubur</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['dubur']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">11.Alat kelamin</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['alatkelamin']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">12.Anggota Gerak Atas</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['anggota_gerak_atas']; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 32.8467%;">
                                        <p style="padding-left: 40px;">13.Anggota Gerak Bawah</p>
                                    </td>
                                    <td style="width: 67.1533%;">: <?= $row['anggota_gerak_bawah']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">d)Pemeriksaan Dalam</td>
                                    <td style="width: 67.1533%;">: </td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;" colspan="2">d)Pemeriksaan Penunjang</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">1)Laboratorium</td>
                                    <td style="width: 67.1533%;">: <?= $row['penunjang_lab']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">2)Radiologi</td>
                                    <td style="width: 67.1533%;">: <?= $row['penunjang_radiologi']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">3)Odontogram</td>
                                    <td style="width: 67.1533%;">: <?= $row['penunjang_odontogram']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">4)lain..</td>
                                    <td style="width: 67.1533%;">: <?= $row['penunjang_lain']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Ringkasan Pemeriksaan</td>
                                    <td style="width: 67.1533%;">: <?= $row['ringkasan_pemeriksaan']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">ICD</td>
                                    <td style="width: 67.1533%;">: <?= $row['icd']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Penyebab Kematian Langsung</td>
                                    <td style="width: 67.1533%;">: <?= $row['penyebab_A1']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Penyebab Antara(I-b)</td>
                                    <td style="width: 67.1533%;">: <?= $row['penyebab_A2']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Penyebab Yang Mendasari</td>
                                    <td style="width: 67.1533%;">: <?= $row['penyebab_mendasari']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Keadaan Morbid Lain (B-1)</td>
                                    <td style="width: 67.1533%;">: <?= $row['b_1']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Keadaan Morbid Lain (B-2)</td>
                                    <td style="width: 67.1533%;">: <?= $row['b_2']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Keadaan Morbid Lain (B-n)</td>
                                    <td style="width: 67.1533%;">: <?= $row['b_n']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Pengobatan Dan Tindakan</td>
                                    <td style="width: 67.1533%;">: <?= $row['pengobatan_tindakan']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Prognosis Dari Penyakit</td>
                                    <td style="width: 67.1533%;">: <?= $row['prognosis']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Kesimpulan</td>
                                    <td style="width: 67.1533%;">: <?= $row['kesimpulan']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;" colspan="2">III Penutup</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;" colspan="2">Demikian surat keterangan ini dibuat berdasarkan dengan penguraian yang sejujur- jujurnya dan menggunakan pengetahuan yang sebaik-baiknya serta mengingat sumpah pada saat menerima jabatan</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Tempat Dikeluarkan Surat Visum</td>
                                    <td style="width: 67.1533%;">: Sukabumi</td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Nama Lengkap & Nomor Induk</td>
                                    <td style="width: 67.1533%;">: <?= $row['dokter_forensik']; ?> <?= $row['nip_dokter_forensik']; ?></td>
                                </tr>
                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;">Jabatan & Kompetensi</td>
                                    <td style="width: 67.1533%;">:</td>
                                </tr>

                                <tr style="height: 18px;">
                                    <td style="width: 32.8467%; height: 18px;" colspan="2">IV Lampiran</td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <br>
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
                    <table style="border-collapse: collapse; width: 100%; height: 90px;" border="0">
                        <tbody>
                            <tr style="height: 1px;">
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <tr style="height: 1px;">
                                <td style="width: 50%; text-align: center; height: 18px;"></td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                <td style="width: 50%; text-align: center; height: 18px;">Dokter Forensik</td>
                            </tr>
                            <?php
                            foreach ($datapasien as $tanda) :
                            ?>

                                <tr style="height: 18px;">
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" />
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">
                                        <div class="col-md-12">
                                            <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['dokter_signature']; ?>" />
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr style="height: 30px;">

                                    <td style="width: 50%; text-align: center; height: 18px;"><u></u></td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;">&nbsp;</td>
                                    <td style="width: 50%; text-align: center; height: 18px;"><u><?= $tanda['dokter_forensik']; ?></u></td>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Download PDF</title>
    <style type="text/css">
        @page {
            font-size: 12px;
            size: A4 portrait;
            page-break-before: always;
        }

        .page {
            page-break-before: always;
            margin: 1cm;
        }

        body {
            font-size: 12px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>

</head>

<body id="data">
    <!-- RESUME MEDIS PASIEN RAWAT INAP -->
    <?php if ($resume_medis_ranap != null && $kunjungan_pasien_ranap != null) : ?>
        <div class="page">
            <div class="row">
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
                <p style="text-align: center;"><b> RESUME MEDIS PASIEN RAWAT INAP</b></p>
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
                        <td>: <?= date('d-m-Y', strtotime($kunjungan_pasien_ranap['pasiendateofbirth'])); ?></td>
                        <td></td>
                        <td style="text-align: left;">R. Rawat Terakhir</td>
                        <td>: <?= $kunjungan_pasien_ranap['roomname']; ?> / <?= date('d-m-Y', strtotime($kunjungan_pasien_ranap['datein'])); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">P. Jawab Jaminan</td>
                        <td>: <?= $kunjungan_pasien_ranap['namapjb']; ?></td>
                        <td></td>
                        <td style="text-align: left;">Tgl. Keluar/Meninggal</td>
                        <td>: <?= date('d-m-Y', strtotime($kunjungan_pasien_ranap['dateout'])); ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">Tgl. Masuk</td>
                        <td>:<?= date('d-m-Y', strtotime($kunjungan_pasien_ranap['datein'])); ?></td>
                    </tr>
                </table>
                <table style="width: 100%; border-collapse: collapse; font-size: 12px; width: 100%;">
                    <tr>
                        <td style="width: 40%;">- Alasan Dirawat di Rumah Sakit</td>
                        <td>: <u><?= $resume_medis_ranap['alasanRawat']; ?></u></td>
                    </tr>

                    <tr>
                        <td style="width: 40%;">- Ringkasa Riwayat Penyakit</td>
                        <td>: <u> <?= $resume_medis_ranap['ringkasanRiwayatPenyakit']; ?></u></td>
                    </tr>

                    <tr>
                        <td style="width: 40%;">- Hasil Pemeriksaan Fisik</td>
                        <td>: <u><?= $resume_medis_ranap['hasilPemeriksaanFisik']; ?></u></td>
                    </tr>

                    <tr>
                        <td style="width: 40%;">- Pemeriksaan Penunjang/Diagnostik Penting</td>
                        <td>: <u><?= $resume_medis_ranap['pemeriksaanPenunjang']; ?></u></td>
                    </tr>

                    <tr>
                        <td style="width: 40%;">- Terapi/Pengobatan Selama di Rumah Sakit</td>
                        <td>: <u><?= $resume_medis_ranap['terapiSelamaRawat']; ?></u></td>
                    </tr>

                    <tr>
                        <td style="width: 40%;">- Perkembangan Setelah Perawatan</td>
                        <td>: <u><?= $resume_medis_ranap['perkembanganSetelahPerawatan']; ?></u></td>
                    </tr>

                    <tr>
                        <td style="width: 40%;">- Alergi(reaksi obat)</td>
                        <td>: <u><?= $resume_medis_ranap['alergiObat']; ?></u></td>
                    </tr>
                    <tr>
                        <td>- Diagnosis Utama</td>
                        <td>: <u><?= $resume_medis_ranap['diagnosisUtama']; ?></u></td>
                    </tr>
                    <tr>
                        <td>- Diagnosis Sekunder</td>
                        <td>: <u><?= $resume_medis_ranap['diagnosisSekunder']; ?></u></td>
                    </tr>
                    <tr>
                        <td>- Tindakan/Prosedur</td>
                        <td>: <u><?= $resume_medis_ranap['prosedur']; ?></u></td>
                    </tr>
                    <tr>
                        <td>- Kondisi Waktu Keluar</td>
                        <td>: <u><?= $resume_medis_ranap['kondisiWaktuKeluar']; ?></u></td>
                    </tr>
                    <tr>
                        <td>- Pengobatan Dilanjutkan</td>
                        <td>: <u><?= $resume_medis_ranap['pengobatanDilanjutkan']; ?></u></td>
                    </tr>
                    <tr>
                        <td>- Tanggal Kontrol Poliklinik</td>
                        <td>: <u><?= tgl_indo_helper($resume_medis_ranap['tanggalKontrol']); ?></u></td>
                    </tr>
                    <tr>
                        <td>- Terapi Pulang :</td>
                    </tr>
                </table>
                <table id="dataradiologi" style="border-collapse: collapse; border: 1px solid #000; width: 100%; font-size: 12px;">
                    <tr>
                        <th style="border: 1px solid black;">No</th>
                        <th style="border: 1px solid black;">Nama Obat</th>
                        <th style="border: 1px solid black;">Jumlah</th>
                        <th style="border: 1px solid black;">Dosis</th>
                    </tr>
                    <tbody>
                        <?php foreach ($DetailObat as $no => $row) : ?>
                            <tr>
                                <td style="border: 1px solid black;"><?= ++$no ?></td>
                                <td style="border: 1px solid black;"><?= $row['name']  ?></td>
                                <td style="text-align: center; border: 1px solid black;"><?= round($row['qtypaket']) ?></td>
                                <td style="text-align: center; border: 1px solid black;"><?= round($row['signa1']) ?> x <?= round($row['signa2']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <table style="border-collapse: collapse; font-size: 12px; width: 100%;">
                    <tr>
                        <td>
                            <p>Format Resume Medis Ditambahkan Catatan :
                                <br>
                                Bila terjadi keadaan darurat segera menghubungi pusat <br> pelayanan kesehatan terdekat !
                                <br>
                                Lembar 1 : Rekam Medis
                                <br>
                                Lembar 2 : Pasien
                                <br>
                                Lembar 3 : Penjamin
                            </p>
                        </td>
                        <td style="text-align: center;">
                            Muara Enim, <?= date('d-m-Y'); ?>
                            <br>
                            Dokter Penanggung Jawab Pelayanan
                            <br>
                            <?= barcode_helper($resume_medis_ranap['pasienid']); ?>
                            <br>
                            (_____________________________)
                            <br>
                            <?= $resume_medis_ranap['doktername']; ?>
                        </td>
                    </tr>
                </table>
                <strong style="font-size: 12px;"><i>*Dibuat pada tanggal <?= $resume_medis_ranap['createddate']; ?> users by <?= $resume_medis_ranap['doktername']; ?>*</i></strong>
            </div>
        </div>
    <?php endif ?>
    <!-- //RESUME MEDIS PASIEN RAWAT INAP -->

    <!-- RESUME MEDIS IGD -->
    <?php if ($kunjungan_pasien_igd != "") : ?>
        <div class="page">
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
            <p style="text-align: center;"><strong>RESUME MEDIS PASIEN IGD (Discharge Summary)</strong></p>
            <table style="border-collapse: collapse; width: 100%; font-size: 12px; border-bottom: 1px solid #000;">
                <tr>
                    <td style="text-align: left;">NO. RM</td>
                    <td>: <?= $kunjungan_pasien_igd['pasienid']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Nama Pasien</td>
                    <td>: <?= $kunjungan_pasien_igd['pasienname']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Tanggal Lahir</td>
                    <td>: <?= tgl_indo_helper($kunjungan_pasien_ranap['pasiendateofbirth']); ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Tanggal Pemeriksaan</td>
                    <td>: <?= tgl_indo_helper($kunjungan_pasien_igd['admissionDate']); ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Poliklinik</td>
                    <td>: <?= $kunjungan_pasien_igd['poliklinikname']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Dokter</td>
                    <td>: <?= $kunjungan_pasien_igd['doktername']; ?></td>
                </tr>
            </table>
            <table style="border-collapse: collapse; width: 100%; font-size: 12px;">
                <tr>
                    <td><b>1. Anamnesis (anamnesa) :</b></td>
                </tr>
                <tr>
                    <td><?= $kunjungan_pasien_igd['keluhanUtama']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"><b>2. Objektif :</b></td>
                </tr>
                <tr>
                    <td>
                        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                            <tr>
                                <td style="text-align: left;">a). BB : <?= $kunjungan_pasien_igd['bb']; ?></td>
                                <td style="text-align: left;">b). TB : <?= $kunjungan_pasien_igd['tb']; ?></td>
                                <td style="text-align: left;">c). Sistolik : <?= $kunjungan_pasien_igd['tdSistolik']; ?></td>
                                <td style="text-align: left;">d). Diastolik : <?= $kunjungan_pasien_igd['tdDiastolik']; ?></td>
                            </tr>
                </tr>
                <tr>
                    <td style="text-align: left;">e). Frekuensi Nadi : <?= $kunjungan_pasien_igd['frekuensiNadi']; ?></td>
                    <td style="text-align: left;">f). Frekuensi Nafas : </td>
                    <td style="text-align: left;">g). Suhu : <?= $kunjungan_pasien_igd['suhu']; ?></td>
                </tr>
                </tr>
            </table>
            </td>
            </tr>
            <tr>
                <td> <?= $kunjungan_pasien_igd['objektive']; ?> </td>
            </tr>
            <tr>
                <td style="text-align: left;"><b>3. Diagnosa (diagnosis):</b></td>
            </tr>
            <tr>
                <td> <?= $kunjungan_pasien_igd['diagnosis']; ?></td>
            </tr>

            <tr>
                <td><b>4. Terapi/ Pengobatan Selama Di Rumah Sakit (therapy/ treatment in hospital) :</b></td>
            </tr>
            <tr>
                <td> <?= $kunjungan_pasien_igd['planning']; ?></td>
            </tr>


            <tr>
                <td>
                </td>
                <td style="text-align: center;">
                    Muara Enim, <?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;">Dokter Penanggung Jawab Pelayanan</td>
            </tr>


            <tr>
                <td></td>
                <td style="text-align: center;"><?= barcode_helper($kunjungan_pasien_igd['doktername'] . cari_sip_dokter($kunjungan_pasien_igd['doktername']) . $kunjungan_pasien_igd['createddate'] . $kunjungan_pasien_igd['referencenumber']); ?></td>
            </tr>


            <tr>
                <td></td>
                <td style="text-align: center;"><?= $kunjungan_pasien_igd['doktername']; ?></td>
            </tr>
            </table>
            <strong style="font-size: 12px;"><i>*Dibuat pada tanggal <?= $kunjungan_pasien_igd['createddate']; ?> by users <?= $kunjungan_pasien_igd['doktername']; ?>*</i></strong>
        </div>
    <?php endif ?>
    <!-- END RESUME MEDIS IGD -->

    <!-- RESUME MEDIS RAJAL -->
    <?php if ($kunjungan_pasien_rajal != "") : ?>
        <div class="page">
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
            <p style="text-align: center;"><strong>RESUME MEDIS PASIEN Rawat Jalan (Discharge Summary)</strong></p>
            <table style="border-collapse: collapse; width: 100%; font-size: 12px; border-bottom: 1px solid #000;">
                <tr>
                    <td style="text-align: left;">NO. RM</td>
                    <td>: <?= $kunjungan_pasien_rajal['pasienid']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Nama Pasien</td>
                    <td>: <?= $kunjungan_pasien_rajal['pasienname']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Tanggal Lahir</td>
                    <td>: <?= tgl_indo_helper($kunjungan_pasien_ranap['pasiendateofbirth']); ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Tanggal Pemeriksaan</td>
                    <td>: <?= tgl_indo_helper($kunjungan_pasien_rajal['admissionDate']); ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Poliklinik</td>
                    <td>: <?= $kunjungan_pasien_rajal['poliklinikname']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;">Dokter</td>
                    <td>: <?= $kunjungan_pasien_rajal['doktername']; ?></td>
                </tr>
            </table>
            <table style="border-collapse: collapse; width: 100%; font-size: 12px;">
                <tr>
                    <td><b>1. Anamnesis (anamnesa) :</b></td>
                </tr>
                <tr>
                    <td><?= $kunjungan_pasien_rajal['keluhanUtama']; ?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"><b>2. Objektif :</b></td>
                </tr>
                <tr>
                    <td>
                        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                            <tr>
                                <td style="text-align: left;">a). BB : <?= $kunjungan_pasien_rajal['bb']; ?></td>
                                <td style="text-align: left;">b). TB : <?= $kunjungan_pasien_rajal['tb']; ?></td>
                                <td style="text-align: left;">c). Sistolik : <?= $kunjungan_pasien_rajal['tdSistolik']; ?></td>
                                <td style="text-align: left;">d). Diastolik : <?= $kunjungan_pasien_rajal['tdDiastolik']; ?></td>
                            </tr>
                </tr>
                <tr>
                    <td style="text-align: left;">e). Frekuensi Nadi : <?= $kunjungan_pasien_rajal['frekuensiNadi']; ?></td>
                    <td style="text-align: left;">f). Frekuensi Nafas : </td>
                    <td style="text-align: left;">g). Suhu : <?= $kunjungan_pasien_rajal['suhu']; ?></td>
                </tr>
                </tr>
            </table>
            </td>
            </tr>
            <tr>
                <td> <?= $kunjungan_pasien_rajal['objektive']; ?> </td>
            </tr>
            <tr>
                <td style="text-align: left;"><b>3. Diagnosa (diagnosis):</b></td>
            </tr>
            <tr>
                <td> <?= $kunjungan_pasien_rajal['diagnosis']; ?></td>
            </tr>

            <tr>
                <td><b>4. Terapi/ Pengobatan Selama Di Rumah Sakit (therapy/ treatment in hospital) :</b></td>
            </tr>
            <tr>
                <td> <?= $kunjungan_pasien_rajal['planning']; ?></td>
            </tr>


            <tr>
                <td>
                </td>
                <td style="text-align: center;">
                    Muara Enim, <?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;">Dokter Penanggung Jawab Pelayanan</td>
            </tr>


            <tr>
                <td></td>
                <td style="text-align: center;"><?= barcode_helper($kunjungan_pasien_rajal['doktername'] . cari_sip_dokter($kunjungan_pasien_rajal['doktername']) . $kunjungan_pasien_rajal['createddate'] . $kunjungan_pasien_rajal['referencenumber']); ?></td>
            </tr>


            <tr>
                <td></td>
                <td style="text-align: center;"><?= $kunjungan_pasien_rajal['doktername']; ?></td>
            </tr>
            </table>
            <strong style="font-size: 12px;"><i>*Dibuat pada tanggal <?= $kunjungan_pasien_rajal['createddate']; ?> by users <?= $kunjungan_pasien_rajal['doktername']; ?>*</i></strong>
        </div>
    <?php endif ?>
    <!-- END RESUME MEDIS RAJAL -->

    <!-- RESUME RADIOLOGI -->
    <?php if ($resume_ra != "") : ?>
        <?php foreach ($resume_ra as $data_ra) : ?>
            <div class="page">
                <table class="headerrajal" style="width: 100%; border-collapse: collapse; height: 54px; font-weight: bold;" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td style="width: 14.9026%; height: 54px; text-align:center;" rowspan="3"> <img style="height: 70px;" src="<?= base_url('assets/images/gallery/pemkab.png'); ?>" /></td>
                            <td style="width: 64.9027%; text-align: center; font-size: 18px;">PEMERINTAH KABUPATEN MUARA ENIM</td>
                            <td style="width: 20.1946%; height: 54px; text-align:center;" rowspan="3"> <img style="height: 70px;" src="<?= base_url('assets/images/gallery/pemkab.png'); ?>" /></td>
                        </tr>
                        <tr>
                            <td style="width: 64.9027%; text-align: center; font-size: 18px;">RSUD DR. H. MUHAMAD RABAIN</td>
                        </tr>
                        <tr>
                            <td style="width: 64.9027%; text-align: center; font-size: 12px;">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara
                                Enim, Sumatera Selatan 31314</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table class="detailrajal" style="height: 126px; width: 100%; border-collapse: collapse; font-size: 12px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width: 25%; height: 18px; text-align:center;" colspan="4"><b>HASIL PEMERIKSAAN RADIOLOGI</b></td>
                    </tr>
                    <tr>
                        <td style="width: 25%; height: 18px;">Nomor Foto</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['expertiseid']; ?></td>
                        <td style="width: 25%; height: 18px;">Tanggal Pemeriksaan</td>
                        <td style="width: 25%; height: 18px;">: <?= date('d-m-Y', strtotime($data_ra['documentdate'])); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%; height: 18px;">Nama</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['relationname']; ?></td>
                        <td style="width: 25%; height: 18px;">Jenis Kelamin/Umur</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['pasiengender'] == '1' ? 'L' : 'P'; ?> | <?= hitung_umur($data_ra['pasiendateofbirth']); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%; height: 18px;">Cara Bayar</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['paymentmethod']; ?></td>
                        <td style="width: 25%; height: 18px;">Alamat</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['pasienaddress']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%; height: 18px;">Klinik/Ruangan</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['roomname']; ?></td>
                        <td style="width: 25%; height: 18px;">No.RM</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['relation']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%; height: 18px;">Dokter Pengirim</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['doktername']; ?></td>
                        <td style="width: 25%; height: 18px;">Tanggal Ekspertise</td>
                        <td style="width: 25%; height: 18px;">: <?= date('d-m-Y', strtotime($data_ra['createddate'])); ?></td>
                    </tr>
                    <tr>
                        <td style="width: 25%; height: 18px;">Dokter Radiologi</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['employeename']; ?></td>
                        <td style="width: 25%; height: 18px;">Klinis</td>
                        <td style="width: 25%; height: 18px;">: <?= $data_ra['klinis']; ?></td>
                    </tr>
                </table>
                <hr>
                <table class="detailrajal" style="width: 100%; border-collapse: collapse; font-size: 12px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width: 100%;">Pemeriksaan : <?= $data_ra['name']; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 100%;">Ekspertise :</td>
                    </tr>
                    <br>
                    <tr>
                        <td style="width: 100%;"></td>
                    </tr>
                    <tr>
                        <td style="width: 100%;"><?= $data_ra['expertise']; ?></td>
                    </tr>
                </table>

                <table class="detailrajal" style="width: 100%; border-collapse: collapse; height: 108px; font-size: 12px;" border="0" cellspacing="0" cellpadding="0">
                    <tr style="height: 18px;">
                        <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                        <td style="width: 37.0438%; height: 18px;">Muara Enim, <?= tgl_indo_helper($data_ra['createddate']); ?></td>
                    </tr>
                    <tr style="height: 18px;">
                        <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                        <td style="width: 37.0438%; height: 18px;">Radiologist</td>
                    </tr>
                    <tr style="height: 18px;">
                        <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                        <td style="width: 37.0438%; height: 18px;"><?= barcode_helper($data_ra['employeename'] . cari_sip_dokter($data_ra['employeename']) . $data_ra['createddate'] . $data_ra['expertiseid']); ?></td>


                    </tr>

                    <tr style="height: 18px;">
                        <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                        <td style="width: 37.0438%; height: 18px;"><u><?= $data_ra['employeename']; ?></u></td>
                    </tr>
                    <tr style="height: 18px;">
                        <td style="width: 62.9562%; height: 18px;">&nbsp;</td>
                        <td style="width: 37.0438%; height: 18px;">SIP. <?= cari_sip_dokter($data_ra['employeename']) ?></td>
                    </tr>
                </table>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <!-- END RESUME RADIOLOGI -->

    <!-- FARMASI RAJAL/IGD-->
    <?php if ($data_farmasi_header != null) : ?>
        <div class="page">
            <table class="header" style="height: 270px; width: 100%; border-collapse: collapse; font-size:12px" border="0" cellspacing="0" cellpadding="0">
                <tr style="height: 18px;">
                    <td style="width: 84.2718%; height: 18px;" colspan="5"><b>RSUD DR H M RABAIN</b></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 84.2718%; height: 18px;" colspan="5"><b>Pemerintah Kabupaten Muara Enim</b></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 84.2718%; height: 18px;" colspan="5"><b>NPWP</b></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 84.2718%; height: 18px;" colspan="5"><b>Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314</b></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 84.2718%; height: 18px;" colspan="5"><b>Telp </b></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 84.2718%; height: 18px; text-align: center;" colspan="5">
                        <b>PELAYANAN FARMASI DEPO RAWAT JALAN</b>
                    </td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 84.2718%; height: 18px;" colspan="5">
                        <hr>
                    </td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 42.447%; height: 18px;" colspan="2">Tanggal</td>
                    <td style="width: 41.8248%; height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['documentdate']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 42.447%; height: 18px;" colspan="2">No Kuitansi</td>
                    <td style="width: 41.8248%; height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['journalnumber']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="width: 42.447%; height: 18px;" colspan="2">Nama</td>
                    <td style="width: 41.8248%; height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['pasienname']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px;" colspan="2">Alamat</td>
                    <td style="height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['pasienaddress']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px;" colspan="2">TglLahir/Umur</td>
                    <td style="height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['pasienage']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px;" colspan="2">JenisKelamin</td>
                    <td style="height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['pasiengender'] == "L" ? "Laki-laki" : "Perempuan"; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px;" colspan="2">Norm</td>
                    <td style="height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['pasienid']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px;" colspan="2">Poli/ruangan</td>
                    <td style="height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['poliklinikname']; ?></td>
                </tr>
                <tr style="height: 18px;">
                    <td style="height: 18px;" colspan="2">Nama Dokter</td>
                    <td style="height: 18px;" colspan="3">: <?= $data_farmasi_header[0]['doktername']; ?></td>
                </tr>
                <tr>
                    <td style="width: 42.447%;" colspan="2">Cara Bayar</td>
                    <td style="width: 1.82482%;" colspan="3">: <?= $data_farmasi_header[0]['paymentmethodname']; ?></td>
                </tr>
            </table>
            <hr>
            <table class="resep" style="height: 100px; width: 100%; border-collapse: collapse; font-size:12px" border="1" cellspacing="1" cellpadding="2">
                <thead>
                    <tr>
                        <td style="width: 5.58394%;"><b>No</b></td>
                        <td style="width: 34.2337%;"><b>Nama Obat</b></td>
                        <td style="width: 15.0291%;"><b>Jumlah</b></td>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data_obat as $no => $row) : ?>
                        <tr>
                            <td style="width: 5.58394%;"><?= ++$no; ?></td>
                            <td style="width: 34.2337%;"><?= $row['name']; ?></td>
                            <td style="width: 15.0291%;"><?= $row['qtypaket']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <table class="resep" style="height: 270px; width: 100%; border-collapse: collapse; font-size:70%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                    <tr>
                        <td style="width: 50%; text-align: center;">Pembeli</td>
                        <td style="width: 50%; text-align: center;">Penerima</td>
                    </tr>
                    <tr>
                        <td style="width: 50%; text-align: center;">
                            ____________________________
                        </td>
                        <td style="width: 50%; text-align: center;">
                            ____________________________
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif ?>
    <!-- END FARMASI -->

    <!-- KASIR -->
    <?php if ($data_header_kasir != null) : ?>
        <div class="page">
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
            <hr style="margin-top: 2px; margin-bottom: 2px;">
            <p style="text-align: center; font-size: 16;"><strong>Rincian Biaya Instalasi Rawat Inap</strong></p>
            <!-- data pasien -->
            <table style="border-collapse: collapse; width: 100%; height: 14px; line-height:1.2; font-size: 12px;">
                <tr style="height: 14px;">
                    <td style="text-align:justify; line-height:1;">No. Bukti</td>
                    <td>: <?= $data_header_kasir[0]['journalnumber']; ?></td>
                    <td>Tanggal Pulang</td>
                    <td>: <?= date('d-m-Y', strtotime($data_header_kasir[0]['dateout'])); ?></td>

                </tr>
                <tr>
                    <td>Nomor RM</td>
                    <td>: <?= $data_header_kasir[0]['pasienid']; ?></td>
                    <td>Pembayaran</td>
                    <td>: <?= $data_header_kasir[0]['paymentmethodname']; ?></td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>: <?= $data_header_kasir[0]['pasienname']; ?></td>
                    <td>No. Pendaftaran</td>
                    <td>: <?= $data_header_kasir[0]['referencenumber']; ?></td>
                </tr>
                <tr>
                    <td>ALamat</td>
                    <td colspan="3">: <?= $data_header_kasir[0]['pasienaddress']; ?></td>

                </tr>
                <tr>
                    <td>Dokter</td>
                    <td>: <?= $data_header_kasir[0]['doktername']; ?></td>
                    <td>Waktu pendaftaran</td>
                    <td>: <?= date('d-m-Y', strtotime($kunjungan_pasien_ranap['documentdate'])); ?> | <?= $kunjungan_pasien_ranap['createdby']; ?></td>
                </tr>
            </table>
            <!-- akhir data pasien -->

            <!-- hitung biaya ranap -->
            <table style="border-collapse: collapse; width: 100%; height: 14px; line-height:1.2; font-size: 12px;">
                <thead style="border-top: 2px solid #000; border-bottom: 2px solid #000; line-height:1.2;">
                    <tr>
                        <th style="text-align: left;">Type</th>
                        <th style="text-align: left;">Periode</th>
                        <th style="text-align: left;">Ruangan</th>
                        <th style=" text-align: center;">LamaRawat</th>
                        <th style="text-align: right;">Tarif</th>
                        <th style="text-align: right;">TotalTarif</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $no = 1;
                    $i = 0;
                    foreach ($KAMAR as $K) :
                    ?>
                        <?php
                        if (($K['statusrawatinap'] == "PINDAH") or ($K['statusrawatinap'] == "PULANG")) {
                            $hari_ini = strtotime($K['datetimeout']);
                        } else {
                            $hari_ini = time();
                        }
                        $tgl_masuk = strtotime($K['datetimein']);

                        $Y = (floor(($hari_ini - $tgl_masuk) / 86400)) / 365;
                        $tahun = floor($Y);
                        $M = (floor(($hari_ini - $tgl_masuk) / 86400)) % 365;
                        $bulan = floor($M / 30);
                        $D  = (floor(($hari_ini - $tgl_masuk) / 86400));
                        $hari  = $D % 1440;
                        $H    = (floor(($hari_ini - $tgl_masuk) / 3600));
                        $jam        = $H    % 24;
                        $MN = (floor(($hari_ini - $tgl_masuk) / 60));
                        $menit        = $MN % 60;

                        // ----- tambahan perhitungan hari
                        $tgl1 = new DateTime($K['datein']);
                        $tgl2 = new DateTime($K['dateout']);
                        $selisih = $tgl1->diff($tgl2)->days + 1;
                        ?>

                        <?php if ($K['types'] == "BARU" and $K['statusrawatinap'] == "PULANG") : ?>
                            <?php $selisiha = $selisih; ?>
                        <?php endif ?>

                        <?php if ($K['types'] == "BARU" and $K['statusrawatinap'] == "PINDAH" and strtotime($K['timeout']) < strtotime('01:00:1')) : ?>
                            <?php $selisiha = $selisih - 1; ?>
                        <?php elseif ($K['types'] == "PINDAHAN" and $K['statusrawatinap'] == "PINDAH" and strtotime($K['timein']) > strtotime('01:00:01')) : ?>
                            <?php $selisiha = $selisih - 1; ?>
                        <?php elseif ($K['types'] == "PINDAHAN" and $K['statusrawatinap'] == "PULANG" and strtotime($K['timein']) > strtotime('01:00:01')) : ?>
                            <?php $selisiha = $selisih - 1; ?>
                        <?php else : ?>
                            <?php $selisiha = $selisih; ?>
                        <?php endif ?>

                        <tr>
                            <td><?= $K['types'] ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($K['datetimein'])) ?> - <?= date('d-m-Y H:i:s', strtotime($K['datetimeout'])); ?></td>
                            <td><?= $K['roomname']  ?> | <?= $K['bednumber'] ?></td>

                            <td style=" text-align: center;"><?php echo $hari . " Hr " . $jam . " Jm " . $menit . " Mn "; ?></td>
                            <td style=" text-align: right;">
                                <?php
                                $ruangan = $K['roomname'];
                                if (strpos($ruangan, 'TANPA TEKANAN NEGATIF') !== false) {
                                    $tarif = 156815;
                                } else if (strpos($ruangan, 'TEKANAN NEGATIF') !== false) {
                                    $tarif = 256815;
                                } else {
                                    $tarif = $K['price'];
                                }
                                echo  number_format($tarif, 2, ",", ".");
                                ?>
                            </td>

                            <td style=" text-align: right;">
                                <?php
                                $waktu = 6;
                                $waktu2 = 6;
                                $ruangan = $K['roomname'];

                                if (strpos($ruangan, 'TANPA TEKANAN NEGATIF') !== false) {
                                    $tarif = 156815;
                                } else if (strpos($ruangan, 'TEKANAN NEGATIF') !== false) {
                                    $tarif = 256815;
                                } else {
                                    $tarif = $K['price'];
                                }

                                if (($jam <= $waktu) and ($menit < 5)) {
                                    $tm = 0.5;
                                    $tambahan = 0 * $tarif;
                                } else if (($jam <= $waktu) and ($menit > 1)) {
                                    $tm = 0.5;
                                    $tambahan = 0.5 * $tarif;
                                } else if ($jam >= $waktu2) {
                                    $tm = 1;
                                    $tambahan = 1 * $tarif;
                                }

                                $jumlah_hari = $hari;
                                $tot_hari = $jumlah_hari + $tm;
                                $biayakamar = ($jumlah_hari * $tarif);
                                $biayakamar = $biayakamar + $tambahan;
                                echo  number_format($biayakamar, 2, ",", ".");
                                ?>
                                <?php $TotBK[] = $biayakamar;  ?>
                                <?php $no++; ?>

                            </td>
                        <?php endforeach ?>
                        <!-- menhitung jumlah Biaya kamar -->
                        <?php
                        $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
                        $TotalBK = $check_TotBK;
                        ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Ruangan) . </td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalBK, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="6">&nbsp;</td>
                        </tr>
                </tbody>
            </table>
            <!-- looping Tindakan Ruangan -->
            <?php foreach ($KAMAR_GROUP as $KG) :
                $ruangan = $KG['roomname']; ?>

                <?php
                $no = 1;
                $i = 0;
                ?>

                <br>
                <table class="table table-sm" id="dataGabung" style="font-size: 12px;" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th style="text-align: left; width: 5%">No</th>
                            <th style="text-align: left; width: 13%">Tanggal</th>
                            <th style="text-align: left; width: 36%;">Keterangan</th>
                            <!-- <th style="text-align: center; width: 5%">Qty</th> -->
                            <th style="text-align: left; width: 34%">dokter</th>
                            <th style="text-align: right;width: 15%">Harga</th>
                            <th style="text-align: right; width: 17%">Total</th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $kelasruangan = "IRJ / IGD";
                        foreach ($PEMIGD as $PIGD) :
                            if ($PIGD['groups'] == "IRJ") {
                                $kelasruangan = "Rawat Jalan";
                                $room_op = $PIGD['poliklinik'];
                            } elseif ($PIGD['groups'] == "IGD") {
                                $kelasruangan = "IGD";
                                $room_op = $PIGD['poliklinik'];
                            }
                        endforeach; ?>
                        <?php $no = 1;
                        $i = 0; ?>
                        <!-- Visit Ranap -->
                        <?php
                        foreach ($VISITE as $row) :
                            if ($row['roomname'] == $ruangan) {
                                $TotVISIT[] = $row['totaltarif'];
                                $TotVst[] = $row['totaltarif'];
                            };
                        endforeach ?>
                        <?php
                        $check_TotVISIT = isset($TotVISIT) ? array_sum($TotVISIT) : 0;
                        $TotalVISIT = $check_TotVISIT;

                        $sub_TotVst = isset($TotVst) ? array_sum($TotVst) : 0;

                        if ($sub_TotVst > 0) { ?>
                            <tr>
                                <td colspan="6"><u>Visit/Askep</u></td>
                            </tr>
                        <?php } ?>

                        <?php
                        foreach ($VISITE as $row) :
                            if ($row['roomname'] == $ruangan) { ?>
                                <?php
                                unset($TotVst[$i]);
                                $i++; ?>
                                <?php if ($row['totaltarif'] > 0) { ?>
                                    <tr>
                                        <td><?php echo "$no" ?></td>
                                        <td> <?= date('d-m-Y', strtotime($row['documentdate'])) ?></td>
                                        <td> <?= $row['name'] ?> [<?= number_format($row['qty'], 2); ?>]</td>
                                        <?php
                                        $caridokter = explode(" ", $row['doktername']);
                                        if ($caridokter[0] == "dr" or $caridokter[0] == "dr.") {
                                            $dokter = $row['doktername'];
                                        } else {
                                            $dokter = "";
                                        } ?>
                                        <td> <?php echo $dokter ?></td>
                                        <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".")  ?></td>
                                        <td style="text-align: right;"><?= number_format($row['totaltarif'], 2, ",", ".") ?></td>
                                        <?php $no++; ?>
                                    </tr>
                        <?php
                                };
                            };
                        endforeach; ?>

                        <?Php if ($i > 0) { ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="3">
                                    <hr style="margin-top: 2px; margin-bottom: 2px">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: right" colspan="5">Sub Total (Visit/Askep)</td>
                                <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotVst, 2, ",", ".") ?></b></td>
                            </tr>
                            <tr style="font-size: 4px; line-height:1">
                                <td colspan="5">&nbsp;</td>
                            </tr>

                        <?php } ?>

                        <!-- Tindakan Ranap -->
                        <?php
                        $no = 1;
                        $i = 0;
                        foreach ($TNO as $rowTNO) :
                            if ($rowTNO['roomname'] == $ruangan) {
                                $TotTNO[] = $rowTNO['subtotal'];
                                $TotTn[] = $rowTNO['subtotal'];
                            };
                        endforeach ?>
                        <?php
                        $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                        $TotalTNO = $check_TotTNO;
                        $sub_TotTn = isset($TotTn) ? array_sum($TotTn) : 0;
                        if ($sub_TotTn > 0) { ?>
                            <tr>
                                <td colspan="6"><u>Tindakan Non Operatip</u></td>
                            </tr>
                        <?php } ?>
                        <?php
                        foreach ($TNO as $rowTNO) :
                            if ($rowTNO['roomname'] == $ruangan) { ?>
                                <?php
                                unset($TotTn[$i]);
                                $i++; ?>
                                <tr>
                                    <?php if ($rowTNO['subtotal'] > 0) { ?>
                                        <td><?php echo "$no" ?></td>
                                        <td> <?= date('d-m-Y', strtotime($rowTNO['documentdate'])) ?></td>
                                        <td> <?= $rowTNO['name'] ?> [<?= number_format($rowTNO['qty'], 2) ?>]</td>
                                        <?php
                                        $caridokter = explode(" ", $rowTNO['doktername']);
                                        if ($caridokter[0] == "dr" or $caridokter[0] == "dr.") {
                                            $dokter = $rowTNO['doktername'];
                                        } else {
                                            $dokter = "";
                                        } ?>
                                        <td> <?php echo $dokter ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                                        <td style="text-align: right;"><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                                        <!-- ?php $TotTNO[] = $rowTNO['subtotal'];  ?> //Untuk Perhitungan -->
                                        <?php $no++; ?>
                                </tr>
                    <?php
                                    };
                                };
                            endforeach; ?>

                    <?Php if ($i > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Tindakan Non Operatif) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotTn, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- Penunjang Rawat Inap -->
                    <?php
                    $no = 1;
                    $i = 0;
                    foreach ($PENUNJANG as $P) :
                        if ($P['roomname'] == $ruangan) {
                            $TotPENUNJANG[] = $P['subtotal'];
                            $totPnj[] = $P['subtotal'];
                        };
                    endforeach ?>
                    <?php
                    $check_TotPENUNJANG = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                    $TotalPENUNJANG = $check_TotPENUNJANG;

                    $sub_TotPnj = isset($totPnj) ? array_sum($totPnj) : 0;
                    if ($sub_TotPnj > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Penunjang</u></td>
                        </tr>
                    <?php } ?>
                    <?php foreach ($PENUNJANG as $P) :
                        if ($P['roomname'] == $ruangan) { ?>
                            <?php
                            unset($totPnj[$i]);
                            $i++; ?>
                            <?php if ($P['subtotal'] > 0) { ?>
                                <tr>
                                    <?php if ($P['types'] == "RAD") {
                                        $deskripsi = 'Radiologi';
                                    }
                                    if ($P['types'] == "LPK") {
                                        $deskripsi = 'Lab Patologi Klinik';
                                    }
                                    if ($P['types'] == "LPA") {
                                        $deskripsi = 'Lab Patologi Anatomi';
                                    }
                                    if ($P['types'] == "BD") {
                                        $deskripsi = 'Bank Darah';
                                    }
                                    ?>
                                    <td><?php echo $no ?></td>
                                    <td><?= date('d-m-Y', strtotime($P['documentdate'])) ?></td>
                                    <td><?= $P['name']; ?> [<?= number_format($P['qty'], 2) ?>]</td>
                                    <td><?= $P['doktername']; ?></td>
                                    <td style="text-align: right;"><?= number_format($P['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                            <?php } ?>
                    <?php };
                    endforeach; ?>

                    <?Php if ($i > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Penunjang) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotPnj, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>


                    <!-- Operasi -->
                    <?php
                    $no = 1;
                    $i = 0;
                    foreach ($OPERASI as $OP) :
                        if ($OP['roomname'] == $ruangan) {
                            $TotOPERASI[] = $OP['totaltarif'];
                            $TotOp[] = $OP['totaltarif'];
                        };
                    endforeach
                    ?>
                    <?php
                    $check_TotOPERASI = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
                    $TotalOPERASI = $check_TotOPERASI;
                    $sub_TotOp = isset($TotOp) ? array_sum($TotOp) : 0;
                    if ($sub_TotOp > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Tindakan Operasi</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($OPERASI as $OP) :
                        if ($OP['roomname'] == $ruangan) { ?>
                            <?php
                            unset($TotOp[$i]);
                            $i++; ?>
                            <?php if ($OP['totaltarif'] > 0) { ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td> <?= date('d-m-Y', strtotime($OP['documentdate'])) ?></td>
                                    <td><?= $OP['name']  ?> [<?= number_format($OP['qty'], 2) ?>]</td>
                                    <td><?= $OP['doktername']  ?></td>
                                    <td style="text-align: right;"><?= number_format($OP['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                    <?php };
                        };
                    endforeach; ?>

                    <?Php if ($i > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Tindakan Operasi) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotOp, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- bhp -->
                    <?php
                    $no = 1;
                    $i = 0;
                    foreach ($BHP as $behape) :
                        if ($behape['roomname'] == $ruangan) {
                            $TotBHP[] = $behape['totalbhp'];
                            $totBh[] = $behape['totalbhp'];
                        };
                    endforeach ?>
                    <?php
                    $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                    $TotalBHP = $check_TotBHP;

                    $sub_TotBh = isset($totBh) ? array_sum($totBh) : 0;
                    if ($sub_TotBh > 0) { ?>
                        <tr>
                            <td colspan="6"><u>BHP</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($BHP as $behape) :
                        if ($behape['roomname'] == $ruangan) { ?>
                            <?php
                            unset($totBh[$i]);
                            $i++; ?>
                            <?php if ($behape['totalbhp'] > 0) { ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?= $behape['types'] ?></td>
                                    <td><?= $behape['name']  ?> [<?= number_format($behape['qty'], 2) ?>]</td>
                                    <td><?= $behape['doktername']  ?></td>
                                    <td style="text-align: right"><?= number_format($behape['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right"><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                    <?php $no++ ?>
                                </tr>
                    <?php };
                        };
                    endforeach;  ?>

                    <?Php if ($i > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (BHP) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotBh, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- Gzi -->
                    <?php
                    $no = 1;
                    $i = 0;
                    foreach ($GIZI as $GZ) :
                        if ($GZ['roomname'] == $ruangan) {
                            $TotGIZI[] = $GZ['totaltarif'];
                            $totGz[] = $GZ['totaltarif'];
                        };
                    endforeach ?>
                    <?php
                    $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
                    $TotalGIZI = $check_TotGIZI;

                    $sub_TotGz = isset($totGz) ? array_sum($totGz) : 0;
                    if ($sub_TotGz > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Gizi</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($GIZI as $GZ) :
                        if ($GZ['roomname'] == $ruangan) { ?>
                            <?php
                            unset($TotGz[$i]);
                            $i++; ?>
                            <?php if ($GZ['totaltarif'] > 0) { ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td> <?= date('d-m-Y', strtotime($GZ['documentdate'])) ?></td>
                                    <td> <?= $GZ['name']  ?> [<?= number_format($GZ['qty'], 2) ?>]</td>
                                    <td> <?= $GZ['doktername'] ?> </td>
                                    <td style="text-align: right;"><?= number_format($GZ['price'], 2, ",", ".") ?></td>
                                    <td style="text-align: right;"><?= number_format($GZ['totaltarif'], 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                    <?php };
                        };
                    endforeach; ?>

                    <?Php if ($i > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Gizi) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotGz, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    <!-- Farmasi ranap -->
                    <?php
                    $no = 1;
                    $i = 0;
                    foreach ($FARMASI as $F) :
                        if ($F['roomname'] == $ruangan) {
                            $TotFAR[] = abs($F['total']);
                            $TotFr[] = abs($F['total']);
                        };
                    endforeach ?>
                    <?php
                    $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
                    $TotalFAR = $check_TotFAR;

                    $sub_TotFr = isset($TotFr) ? array_sum($TotFr) : 0;
                    if ($sub_TotFr > 0) { ?>
                        <tr>
                            <td colspan="6"><u>Farmasi Rawat Inap</u></td>
                        </tr>
                    <?php } ?>
                    <?php
                    foreach ($FARMASI as $F) :
                        if ($F['roomname'] == $ruangan) { ?>
                            <?php
                            unset($TotFr[$i]);
                            $i++; ?>
                            <?php if (abs($F['total']) > 0) { ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td> <?= date('d-m-Y', strtotime($F['documentdate'])) ?></td>
                                    <td><?= $F['name']  ?> [<?= number_format(abs($F['qty']), 2, ",", ".") ?>]</td>
                                    <td><?= $F['doktername']  ?></td>
                                    <td style="text-align: right;"><?= number_format($F['price'], 2, ",", ".") ?></td>

                                    <td style="text-align: right;"><?php $awal = (-1 * ($F['total']));
                                                                    $far = $awal + $F['embalase'];
                                                                    $deni = ceil($far);
                                                                    echo number_format($awal, 2, ",", ".") ?></td>
                                    <?php $no++; ?>
                                </tr>
                    <?php };
                        };
                    endforeach; ?>

                    <?Php if ($i > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Farmasi) . <?= $ruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($sub_TotFr, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php   } ?>

                    </tbody>
                </table>
            <?php endforeach; ?>
            <?php
            $check_TotBK = isset($TotBK) ? array_sum($TotBK) : 0;
            $TotalBK = $check_TotBK; ?>
            <hr style="margin-bottom: 2px; margin-top: 2px">
            <!-- akhir looping kamar -->
            <!-- Menghitung Total Biaya Rawat Inap -->
            <?php
            $totalRanap = $TotalBK + $TotalVISIT + $TotalTNO + $TotalPENUNJANG + $TotalOPERASI + $TotalBHP + $TotalGIZI + $TotalFAR;
            ?>
            <!-- akhir hitung biaya ranap -->

            <!-- Cetak IGD -->
            <table class="table table-sm" id="dataGabung" style="font-size: 12px;" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="text-align: left; width: 5%">No</th>
                        <th style="text-align: left; width: 13%">Tanggal</th>
                        <th style="text-align: left; width: 36%;">Keterangan</th>
                        <!-- <th style="text-align: center; width: 5%">Qty</th> -->
                        <th style="text-align: left; width: 34%">dokter</th>
                        <th style="text-align: right;width: 15%">Harga</th>
                        <th style="text-align: right; width: 17%">Total</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Pemeriksaan -->
                    <?php
                    $no = 1;
                    foreach ($PEMIGD as $PIGD) :
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td> <?= date('d-m-Y', strtotime($PIGD['documentdate'])) ?></td>
                            <td><?= $PIGD['description'] ?> [<?= number_format(1, 2, ",", ".") ?>]</td>
                            <td><?= $PIGD['doktername'] ?></td>
                            <td style="text-align: right;"><?= number_format($PIGD['price'], 2, ",", ".") ?></td>
                            <td style="text-align: right;"><?= number_format($PIGD['price'], 2, ",", ".") ?></td>
                            <?php $TotPEMIGD[] = $PIGD['price']; ?>
                            <?php $no++; ?>
                        </tr>
                    <?php endforeach;
                    $check_TotPEMIGD = isset($TotPEMIGD) ? array_sum($TotPEMIGD) : 0;
                    $TotalPemIGD = $check_TotPEMIGD;
                    ?>

                    <!-- Tindakan IGD -->
                    <?php
                    $no = 1;
                    foreach ($TINIGD as $TGD) :
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td> <?= date('d-m-Y', strtotime($PIGD['documentdate'])) ?></td>
                            <td><?= $TGD['name'] ?> [<?= number_format($TGD['qty'], 2) ?>]</td>
                            <td><?= $TGD['doktername']  ?></td>
                            <td style="text-align: right;"><?= number_format($TGD['price'], 2, ",", ".") ?></td>
                            <td style="text-align: right;"><?= number_format($TGD['subtotal'], 2, ",", ".") ?></td>
                            <?php $TotTINDIGD[] = $TGD['subtotal']; ?>
                            <?php $no++; ?>
                        </tr>

                    <?php endforeach;
                    $check_TotTINDIGD = isset($TotTINDIGD) ? array_sum($TotTINDIGD) : 0;
                    $TotalTindIGD = $check_TotTINDIGD;
                    ?>

                    <!-- Jumlah gabungan tindakan dan pemeriksaan igd -->
                    <?php if (($TotalPemIGD + $TotalTindIGD) > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Tindakan) . <?= $kelasruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalPemIGD + $TotalTindIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php } ?>

                    <!-- OPERASI IGD?RJ -->
                    <?php
                    $no = 1;
                    foreach ($OPERASI as $OPIGD) :
                    ?>
                        <?php if (($OPIGD['room'] == $room_op) or (substr($OPIGD['room'], 0, 3) == $room_op)) { ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td> <?= date('d-m-Y', strtotime($OPIGD['documentdate'])) ?></td>
                                <td><?= $OPIGD['name'] ?> [<?= number_format($OPIGD['qty'], 2) ?>]</td>
                                <td><?= $OPIGD['doktername']  ?></td>
                                <td style="text-align: right;"><?= number_format($OPIGD['price'], 2, ",", ".") ?></td>
                                <td style="text-align: right;"><?= number_format($OPIGD['totaltarif'], 2, ",", ".") ?></td>
                                <?php $TotOPIGD[] = $OPIGD['totaltarif']; ?>
                                <?php $no++; ?>
                            </tr>
                        <?php } ?>
                    <?php endforeach;
                    $check_TotOPIGD = isset($TotOPIGD) ? array_sum($TotOPIGD) : 0;
                    $TotalOPIGD = $check_TotOPIGD;
                    ?>

                    <!-- OPERASI IGD/RJ igd -->
                    <?php if (($TotalOPIGD) > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (OPERASI) . <?= $kelasruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalOPIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php } ?>

                    <!-- Farmasi Igd -->
                    <?php
                    $no = 1;
                    foreach ($FARMASIIGD as $FIGD) :
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td> <?= date('d-m-Y', strtotime($FIGD['documentdate'])) ?></td>
                            <td><?= $FIGD['name']  ?> [<?= number_format(abs($FIGD['qty']), 2) ?>]</td>
                            <td><?= $FIGD['doktername']  ?></td>
                            <td style="text-align: right;"><?= number_format($FIGD['price'], 2, ",", ".") ?></td>

                            <td style="text-align: right;"><?php $awaligd = abs($FIGD['total']);
                                                            $farigd = $awaligd + $FIGD['embalase'];
                                                            $deniigd = ceil($farigd);
                                                            echo number_format($awaligd, 2, ",", ".") ?></td>
                            <?php $TotFARIGD[] = $awaligd;  ?>
                            <?php $no++; ?>
                        </tr>
                    <?php endforeach ?>
                    <?php
                    $check_TotFARIGD = isset($TotFARIGD) ? array_sum($TotFARIGD) : 0;
                    $TotalFARIGD = $check_TotFARIGD;
                    ?>
                    <?php if ($TotalFARIGD > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Farmasi) . <?= $kelasruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalFARIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php } ?>

                    <!-- penujang -->
                    <?php
                    $no = 1;
                    foreach ($PENUNJANGIGD as $PNJIGD) :
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td> <?= date('d-m-Y', strtotime($PNJIGD['documentdate'])) ?></td>
                            <td><?= $PNJIGD['types']; ?> | <?= $PNJIGD['name']; ?> [<?= number_format($PNJIGD['qty'], 2) ?>]</td>
                            <td><?= $PNJIGD['doktername']; ?></td>
                            <td style="text-align: right;"><?= number_format($PNJIGD['price'], 2, ",", ".") ?></td>
                            <td style="text-align: right;"><b><?= number_format($PNJIGD['subtotal'], 2, ",", ".") ?></b></td>
                            <?php $TotPENUNJANGIGD[] = $PNJIGD['subtotal'];  ?>
                        </tr>
                    <?php endforeach ?>
                    <?php
                    $check_TotPENUNJANGIGD = isset($TotPENUNJANGIGD) ? array_sum($TotPENUNJANGIGD) : 0;
                    $TotalPENUNJANGIGD = $check_TotPENUNJANGIGD;
                    ?>
                    <?php if ($TotalPENUNJANGIGD > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-top: 2px; margin-bottom: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="5">Sub Total (Penunjang) . <?= $kelasruangan ?></td>
                            <td style="text-align: right;" colspan="1"><b><?php echo number_format($TotalPENUNJANGIGD, 2, ",", ".") ?></b></td>
                        </tr>
                        <tr style="font-size: 4px; line-height:1">
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
            <hr style="margin-bottom: 0px; margin-top: 2px">
            <br>
            <!-- akhir hitungan IGD -->
            <!-- menghitung jumlah Total Rawat Jalan ? IGD -->
            <?php
            $totalRajal = $TotalPemIGD + $TotalTindIGD + $TotalOPIGD + $TotalFARIGD + $TotalPENUNJANGIGD;
            ?>

            <table class="table table-sm" id="dataGabung" style="font-size: 12px;" cellspacing="0" cellpadding="0">
                <tfoot>
                    <tr>
                        <th style="text-align: left; width: 5%"></th>
                        <th style="text-align: left; width: 13%"></th>
                        <th style="text-align: left; width: 36%;"></th>
                        <!-- <th style="text-align: center; width: 5%">Qty</th> -->
                        <th style="text-align: left; width: 34%"></th>
                        <th style="text-align: right;width: 15%"></th>
                        <th style="text-align: right; width: 17%"></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3">
                            <hr style="margin-bottom: 2px; margin-top: 0px">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;">Biaya Rawat Inap (RI)</td>
                        <td colspan="1" style="text-align: right">
                            <?php echo number_format($totalRanap, 2, ",", "."); ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align: right" colspan="4">Biaya (<?= $kelasruangan . ")"; ?></td>
                        <td style="text-align: right" colspan="1">
                            <?php echo number_format($totalRajal, 2, ",", "."); ?>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td style="text-align: center; margin-top: 1px; margin-bottom: 1px" colspan="3" rowspan="5"><?= barcode_helper($data_header_kasir[0]['journalnumber']); ?></td>
                        <td colspan="3">
                            <hr style="margin-bottom: 2px; margin-top: 2px">
                        </td>
                    </tr>

                    <!-- menampilkan data diskon dari tabel transaksi kasir ranap -->
                    <?php
                    foreach ($data_header_kasir as $rowbayar) :
                    ?>

                        <!-- menghitung jumlah pembayaran awal -->
                        <?php
                        $totalbayarawal_kasir = abs($TotalKasirApotek_RI) + abs($TotalKasirApotek_RJ) +
                            abs($TotalKasirPnj_RI) + abs($TotalKasirPnj_RJ) + abs($TotalKasir_RJ);

                        $totalbiaya_rajal_ranap = abs($rowbayar['grandtotal']) +
                            (abs($totalbayarawal_kasir) + abs($rowbayar['discount']));

                        $totaltagihan = abs($totalbiaya_rajal_ranap) -
                            (abs($totalbayarawal_kasir) + abs($rowbayar['discount']));
                        ?>
                        <tr>
                            <td style="text-align: right" colspan="1"><b>Total Biaya</b></td>
                            <td style="text-align: right" colspan="2">
                                <b> <?php echo number_format($totalbiaya_rajal_ranap, 2, ",", "."); ?></b>
                            </td>
                            <!-- <td></td> -->
                        </tr>

                        <tr>
                            <td style="text-align: right" colspan="1">Deposit</td>
                            <td style="text-align: right" colspan="2">
                                <?php echo number_format($totalbayarawal_kasir, 2, ",", "."); ?>
                            </td>
                        </tr>


                        <tr>
                            <td style="text-align: right" colspan="1">Diskon</td>
                            <td style="text-align: right" colspan="2">
                                <?php echo number_format($rowbayar['discount'], 2, ",", "."); ?>
                            </td>
                        </tr>
                        <tr>
                            <!-- <td></td>
                        <td></td>
                        <td></td> -->
                            <td colspan="3">
                                <hr style="margin-bottom: 2px; margin-top: 2px">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center" colspan="3">ctk: <?= date('d-m-Y H:i:s') ?></td>
                            <td style="text-align: right" colspan="1"><b>Total Tagihan Biaya</b></td>
                            <td style="text-align: right" colspan="2">
                                <b> <?php echo number_format($totaltagihan, 2, ",", "."); ?></b>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right" colspan="4">Pembayaran Tagihan</td>
                            <td style="text-align: right" colspan="1">
                                <?php echo number_format(abs($rowbayar['paymentamount']), 2, ",", "."); ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                <hr style="margin-bottom: 2px; margin-top: 2px">
                            </td>
                        </tr>
                        <tr style="height: 18px;">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: right;" colspan="2">Muara Enim, <?= tgl_indo_helper(date('Y-m-d')); ?></td>
                        </tr>
                        <tr style="height: 18px;">
                            <td style="text-align: center;" colspan="3">Penyetor</td>
                            <!-- <td>&nbsp;</td> -->
                            <td>&nbsp;</td>
                            <td style="text-align: center;" colspan="2">Petugas</td>
                        </tr>


                        <tr style=" height: 18px;">
                            <td style="text-align: center;" colspan="3">
                                <div class="col-md-12">

                                </div>
        </div>
        </td>
        <!-- <td>&nbsp;</td> -->
        <td>&nbsp;</td>
        <td style="text-align: center;" colspan="2">
            <div class="col-md-12">

            </div>
        </td>
        </tr>

        <tr style="height: 30px;">

            <td style="text-align: center;" colspan="3"><u><?= $rowbayar['payersname']; ?></u></td>
            <!-- <td>&nbsp;</td> -->
            <td>&nbsp;</td>
            <td style="text-align: center;" colspan="2"><u><?= $rowbayar['createdby']; ?></u></td>
        </tr>

        <!-- <td colspan="4" style="text-align: right;"><b>PEMBAYARAN</b></td> -->

        <td style="text-align: right;">
            <!-- <b>?= number_format(($rowbayar['paymentamount'] + $rowbayar['nominaldebet']) + $totalbayarawal_kasir, 2, ",", ".") ?></b> -->
        </td>
        <?php
                        function penyebut($nilai)
                        {
                            $nilai = abs($nilai);
                            $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                            $temp = "";
                            if ($nilai < 12) {
                                $temp = " " . $huruf[$nilai];
                            } else if ($nilai < 20) {
                                $temp = penyebut($nilai - 10) . " belas";
                            } else if ($nilai < 100) {
                                $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
                            } else if ($nilai < 200) {
                                $temp = " seratus" . penyebut($nilai - 100);
                            } else if ($nilai < 1000) {
                                $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
                            } else if ($nilai < 2000) {
                                $temp = " seribu" . penyebut($nilai - 1000);
                            } else if ($nilai < 1000000) {
                                $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
                            } else if ($nilai < 1000000000) {
                                $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
                            } else if ($nilai < 1000000000000) {
                                $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
                            } else if ($nilai < 1000000000000000) {
                                $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
                            }
                            return $temp;
                        }

                        function terbilang($nilai)
                        {
                            if ($nilai < 0) {
                                $hasil = "minus " . trim(penyebut($nilai));
                            } else {
                                $hasil = trim(penyebut($nilai));
                            }
                            return $hasil;
                        }
        ?>
        <tr>
        </tr>
    <?php endforeach; ?>
    </tfoot>
    </table>
    </div>
<?php endif ?>
<!-- END KASIR -->

<!-- laporan ok general -->
<?php if ($data_laporan_ok != null) : ?>
    <?php foreach ($data_laporan_ok as $laporan_ok) : ?>
        <div class="page">
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
            <p style="margin-bottom: 0; text-align: center;"><strong><u>LAPORAN OPERASI</u></strong></p>
            <p style="margin-top: 0; text-align: center;">Nomor : <?= $laporan_ok['registernumber']; ?></p>
            <table style="border-collapse: collapse; width: 100%; font-size: 12px;" border="1">
                <tbody>
                    <tr>
                        <td style="width: 20%;"> </td>
                        <td style="width: 30%;"> </td>
                        <td style="width: 20%;"> </td>
                        <td style="width: 5%;"> </td>
                        <td style="width: 25%;"> </td>

                    </tr>
                    <tr>
                        <td class="kiri">Nama</td>
                        <td class="kanan">: <?= $laporan_ok['pasienname']; ?></td>
                        <td class="kiri">NO. RM</td>
                        <td class="kanan" colspan="2">: <?= $laporan_ok['pasienid']; ?> | [<?= $kunjungan_pasien_ranap['pasiengender']; ?>]</td>
                    </tr>
                    <tr>
                        <td class="kiri">Tgl. Lahir</td>
                        <td class="kanan">: <?= $kunjungan_pasien_ranap['pasiendateofbirth']; ?> | <?= $kunjungan_pasien_ranap['pasienage']; ?></td>
                        <td class="kiri">Alamat</td>
                        <td class="kanan" colspan="2">: <?= $kunjungan_pasien_ranap['pasienaddress']; ?></td>
                    </tr>
                    <tr>
                        <td rowspan="2" class="kiri" style="text-align: center;">
                            UPF
                        </td>
                        <td rowspan="2" class="kanan"> : <b><?= $laporan_ok['smfName']; ?></b></td>
                        <td style="border-bottom: none; ">
                            Tanggal Operasi
                        </td>
                        <td class="kanan" style="border-bottom: none;" colspan="2">: <?= $laporan_ok['admissionDate']; ?></td>
                        <!-- <td></td> -->
                    </tr>
                    <tr>
                        <!-- <td></td>
                        <td></td> -->
                        <td style="border-top: none;">
                            Jenis Operasi
                        </td>
                        <td class="kanan" style="border-top: none;" colspan="2">: <?= $laporan_ok['jenisOperasi']; ?></td>
                        <!-- <td></td> -->
                    </tr>
                    <tr>
                        <td class="kiri" colspan="2">RANAP ASAL : <?= $laporan_ok['poliklinikname']; ?></td>
                        <td class="kiri">kamar Operasi</td>
                        <td class="kanan" colspan="2">: <?= $laporan_ok['kamarOperasi']; ?></td>
                    </tr>
                    <tr>
                        <td style="border-left: 1px solid black; border-right: 1px solid black" colspan="5">
                            dr. DPJP : <?= $laporan_ok['doktername']; ?> &nbsp;&nbsp;dr. Anestesi : <?= $laporan_ok['dokterAnestesi']; ?> &nbsp;&nbsp; Perawat Anestesi : <?= $laporan_ok['perawatAnestesi']; ?> </td>

                    </tr>

                    <tr>
                        <td class="kiri">Scrub Nurse / Instumen</td>
                        <td class="kanan">: <?= $laporan_ok['scrubNurse']; ?></td>
                        <td colspan="2">Posisi Operasi Pasien</td>
                        <td class="kanan">: <?= $laporan_ok['posisiOperasi']; ?></td>
                    </tr>
                    <tr>
                        <td class="kiri">Asisten I</td>
                        <td class="kanan">: <?= $laporan_ok['asisten1']; ?></td>
                        <td colspan="2">Jenis Sayatan</td>
                        <td class="kanan">: <?= $laporan_ok['jenisSayatan']; ?></td>
                    </tr>
                    <tr>
                        <td class="kiri">Asisten II</td>
                        <td class="kanan">: <?= $laporan_ok['asisten2']; ?></td>
                        <td style="border-bottom: none;" colspan="2">Skin Perparasi</td>
                        <td style="border-bottom: none;" class="kanan">: <?= $laporan_ok['skinPerparasi']; ?></td>
                    </tr>
                    <tr>
                        <td class="kiri">Circulation Nurse</td>
                        <td class="kanan">: <?= $laporan_ok['circulationNurse']; ?></td>
                        <td style="border-top: none;" colspan="2">Jenis Pembedahan</td>
                        <td style="border-top: none;" class="kanan">: <?= $laporan_ok['jenisPembedahan']; ?></td>
                    </tr>

                    <tr>
                        <td class="kiri">Diagnosa Pra-Bedah</td>
                        <td class="kanan">: <?= $laporan_ok['diagnosaPraBedah']; ?></td>
                        <td style="border-top: none;" colspan="2">Skrining Nurse</td>
                        <td style="border-top: none;" class="kanan">: <?= $laporan_ok['skriningNurse']; ?></td>
                    </tr>

                    <tr>
                        <td class="kiri">Indikasi Operasi</td>
                        <td colspan="4" class="kanan">: <?= $laporan_ok['indikasiOperasi']; ?></td>
                    </tr>

                    <tr>
                        <td class="kiri">Prosedur/Tindakan Operasi</td>
                        <td colspan="4" class="kanan">: <?= $laporan_ok['prosedurOp'];; ?></td>
                    </tr>

                    <tr>
                        <td class="kiri">Diagnosa Pasca Bedah</td>
                        <td colspan="4" class="kanan">: <?= $laporan_ok['diagnosaPascaBedah']; ?></td>
                    </tr>

                    <tr>
                        <td class="kiri">Mulai Operasi Jam</td>
                        <td class="kanan">: <?= $laporan_ok['startDateTimeOp']; ?></td>
                        <td class="kanan" style="border-bottom: none;" rowspan="3" colspan="3">
                            Jaringan Operasi Asal
                            <br>Asal : <?= $laporan_ok['jaringanSpesimenOperasi']; ?> #<?= $laporan_ok['jaringanSpesimenAspirasi']; ?> #<?= $laporan_ok['jaringanSpesimenkaterisasi']; ?></br>
                            <br>Lokasi : <?= $laporan_ok['lokalisasi']; ?></br>
                            <br>Dikirim PA : <?= $laporan_ok['dikirimPA']; ?></br>
                            <br>Profilaksis Antibiotik : <?= $laporan_ok['profilaksisAntibiotik']; ?> &nbsp;&nbsp;Jam Pemberian : <?= $laporan_ok['jamPemberian']; ?></br>
                        </td>

                    </tr>
                    <tr>
                        <td class="kiri">Selesai Operasi Jam</td>
                        <td class="kanan">: <?= $laporan_ok['stopDateTimeOp']; ?></td>

                    </tr>

                    <tr>
                        <td class="kiri">Lama Operasi Jam</td>
                        <td class="kanan">:</td>

                    </tr>

                    <tr>
                        <td colspan="5" style="border-left: 1px solid black; border-right: 1px solid black; text-align:center">
                            Layanana Jalannya Operasi / Temuan Saat Operasi :
                            <br>
                            <?= $laporan_ok['laporanJalanOperasi']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="border-left: 1px solid black; border-right: 1px solid black; text-align:center">
                            Komplikasi Pasca Bedah :
                            <br>
                            <?= $laporan_ok['komplikasiPascaBedah']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="kiri" style="text-align: left;">
                            Jml Pendarahan Hilang
                        </td>
                        <td class="kanan"> : <?= $laporan_ok['jumlahPerdarahan']; ?> cc</td>
                        <td colspan="2">
                            Transfusi Darah Masuk
                            <br>Jenis
                        </td>
                        <td class="kanan">
                            : <?= $laporan_ok['transfusiDarah']; ?>
                            <br>: <?= $laporan_ok['pcr']; ?> # <?= $laporan_ok['wb']; ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="kiri" style="text-align: center;">Operator / DPJP
                            <table style="border-collapse: collapse; width: 100%;" border="1">
                                <tbody>
                                    <tr>
                                        <td style="width: 100%; height: 18px;  text-align: center;">
                                            <?= barcode_helper($laporan_ok['doktername']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%; height: 18px;  text-align: center; font-size: 12px;"><b><?= $laporan_ok['doktername']; ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="kanan" style="border-top: none; border-left: 1px solid black;" colspan="3">
                            <table style="border-collapse: collapse; width: 100%; font-size: 12px;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 100%; text-align: center;">Bila Menggunakan Inflan</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%; text-align: center;">Jenis Inflan : <?= $laporan_ok['jenisInplan']; ?> No.Reg Inflan : <?= $laporan_ok['noRegInplan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%; text-align: center;">Dipasang Di Organ :</td>
                                    </tr>
                                </tbody>
                            </table>

                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    <?php endforeach ?>
<?php endif ?>
<!-- akhir laporan ok general -->

<!-- laporan ok katarak -->
<?php if ($data_laporan_ok_katarak != null) : ?>
    <?php foreach ($data_laporan_ok_katarak as $laporan_ok_katarak) : ?>
        <div class="page">
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
            <p style="margin-bottom: 0; text-align: center;"><strong><u>LAPORAN OPERASI KATARAK</u></strong></p>
            <table style="border-collapse: collapse; width: 100%; font-size: 12px;" border="0">
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
                <tbody>
                    <tr>
                        <td>Nama Pasien</td>
                        <td colspan="2">: <?= $kunjungan_pasien_ranap['pasienname']; ?></td>
                        <td>Jenis Kelamin</td>
                        <td>: <?= $kunjungan_pasien_ranap['pasiengender'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>No. MR</td>
                        <td colspan="2">: <?= $kunjungan_pasien_ranap['pasienid']; ?></td>
                        <td>Type Operasi</td>
                        <td>: <?= $laporan_ok_katarak['typeOperasi']; ?></td>
                    </tr>
                    <tr>
                        <td>Tgl. Lahir</td>
                        <td colspan="2">: <?= $kunjungan_pasien_ranap['pasiendateofbirth']; ?> |<?= $kunjungan_pasien_ranap['pasienage']; ?></td>
                        <td>Nama Operator</td>
                        <td colspan="2">: <?= $kunjungan_pasien_ranap['doktername']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td colspan="2">: <?= $kunjungan_pasien_ranap['pasienaddress']; ?></td>
                        <td>Perawat</td>
                        <td>: <?= $laporan_ok_katarak['anesthesilogist']; ?></td>
                    </tr>
                    <tr>
                        <td>Intra-Operative Date</td>
                        <td colspan="2">: <?= $laporan_ok_katarak['intraOperativeDate']; ?></td>
                        <td>Time</td>
                        <td>: <?= $laporan_ok_katarak['intraOperativeTime']; ?></td>
                    </tr>
                    <tr>
                        <td>Scrub</td>
                        <td colspan="2">: <?= $laporan_ok_katarak['scrub']; ?></td>
                        <td>Cukator</td>
                        <td>: <?= $laporan_ok_katarak['cukator']; ?></td>
                    </tr>
                    <tr>
                        <td style="line-height: 3.2;"><B>[] OD &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; [] OS</B></td>
                    </tr>
                    <tr>
                        <td style="line-height: 2;">Pre-operative</td>
                        <td>:</td>
                        <td>Cataract Grade</td>
                        <td>: <?= $laporan_ok_katarak['cataractGrade']; ?></td>
                        <td>Note</td>
                        <td>: <?= $laporan_ok_katarak['noteOp']; ?></td>
                    </tr>
                    <tr>
                        <td>UCVA</td>
                        <td>: <?= $laporan_ok_katarak['ucva']; ?></td>
                        <td>BCVA</td>
                        <td>: <?= $laporan_ok_katarak['bcva']; ?></td>
                        <td>AXL</td>
                        <td>: <?= $laporan_ok_katarak['axl']; ?></td>
                    </tr>
                    <tr>
                        <td>Retinometry</td>
                        <td>: <?= $laporan_ok_katarak['retinometry']; ?></td>
                        <td>ACD</td>
                        <td>: <?= $laporan_ok_katarak['acd']; ?></td>
                    </tr>
                    <tr>
                        <td>K1</td>
                        <td>: <?= $laporan_ok_katarak['k1']; ?></td>
                        <td>ACD</td>
                        <td>: <?= $laporan_ok_katarak['acd']; ?></td>
                    </tr>
                    <tr>
                        <td>K2</td>
                        <td>: <?= $laporan_ok_katarak['k2']; ?></td>
                        <td>LT</td>
                        <td>: <?= $laporan_ok_katarak['lt']; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Formula</td>
                        <td>: <?= $laporan_ok_katarak['formula']; ?></td>
                        <td>=>Visus</td>
                        <td>: <?= $laporan_ok_katarak['visus']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="line-height: 2.7;">Target Emmetropia With IOL Power</td>
                        <td>: <?= $laporan_ok_katarak['emetropia']; ?></td>
                    </tr>
                    <tr style="line-height: 2;">
                        <td style="line-height: 3;" colspan="2">1. Anesthesia</td>
                        <td>: <?= $laporan_ok_katarak['anestehesia']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">2. Approach</td>
                        <td>: <?= $laporan_ok_katarak['approach']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">3. Capsulotomy(CC)</td>
                        <td>: <?= $laporan_ok_katarak['capsulotomy']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">4. Hydrodissection</td>
                        <td>: <?= $laporan_ok_katarak['hydrodissection']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">5. Nucleus Management</td>
                        <td>: <?= $laporan_ok_katarak['nucleus']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">6. Phaco Techique</td>
                        <td>: <?= $laporan_ok_katarak['phaco']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">7. IOL Placement</td>
                        <td>: <?= $laporan_ok_katarak['iol']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">8. Stitch</td>
                        <td>: <?= $laporan_ok_katarak['stitch']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">9. Phaco Machine</td>
                        <td>: <?= $laporan_ok_katarak['phacoMachine']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">10. Irirgating Solution</td>
                        <td>: <?= $laporan_ok_katarak['irigatingSolution']; ?></td>
                    </tr>
                    <tr>
                        <td style="line-height: 2.9"> <b>KOMPLIKASI : <?php if ($laporan_ok_katarak['komplikasi'] == 1) {
                                                                            $kom = 'Ya';
                                                                        } else {
                                                                            $kom = 'Tidak';
                                                                        }
                                                                        echo $kom; ?></b></td>
    
                    <tr style="line-height: 2;">
                        <td colspan="3">[ ] Posterior Capsul Ruptur : <b><?php if ($laporan_ok_katarak['posterior'] == 1) {
                                                                                $pos = 'Ya';
                                                                            } else {
                                                                                $pos = 'Tidak';
                                                                            }
                                                                            echo $pos; ?></b></td>
    
                    </tr>
                    <tr>
                        <td colspan="3">[ ] Vitreus Prolapse : <b><?php if ($laporan_ok_katarak['vitreus'] == 1) {
                                                                        $vit = 'Ya';
                                                                    } else {
                                                                        $vit = 'Tidak';
                                                                    }
                                                                    echo $vit; ?></b></td>
                        <td colspan="3">(During phaco/ cortec aspiration/ IOL implementation)</td>
                    </tr>
                    <tr>
                        <td colspan="3">[ ] Vitrectomy : <b><?php if ($laporan_ok_katarak['vitrectomy'] == 1) {
                                                                $vitrect = 'Ya';
                                                            } else {
                                                                $vitrect = 'Tidak';
                                                            }
                                                            echo $vitrect; ?></b>
                        </td>
                        <td colspan="3">(Manual/ machine)</td>
                    </tr>
                    <tr>
                        <td colspan="3"> [ ] Retained Lens Material : <b><?php if ($laporan_ok_katarak['retained'] == 1) {
                                                                                $retain = 'Ya';
                                                                            } else {
                                                                                $retain = 'Tidak';
                                                                            }
                                                                            echo $retain; ?></td>
                        <td colspan="3">(WQhole/more than half/ less then helf)</td>
                    </tr>
                    <tr>
                        <td colspan="2">[ ] Cortex Left : <b><?php if ($laporan_ok_katarak['cortex'] == 1) {
                                                                    $cortex = 'Ya';
                                                                } else {
                                                                    $cortex = 'Tidak';
                                                                }
                                                                echo $cortex; ?></td>
                    </tr>
                    <tr style="line-height: 3;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align: center;">
                            Muara Enim, <?= date('d-m-Y'); ?>
                        </td>
                    </tr>
                    <tr style="line-height: 5;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align: center;"><u><?= $laporan_ok_katarak['doktername']; ?></u></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endforeach ?>
<?php endif ?>
<!-- akhir laporan ok katarak -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    // window.addEventListener("DOMContentLoaded", function() {   
    //     const element = document.getElementById('data');
    //     html2pdf().from(element).save();
    // }); 
    window.print();
</script>
</body>

</html>
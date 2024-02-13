<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Laporan Operasi</title>
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

<body>
    <div>
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
    </div>
<script>
    window.addEventListener("DOMContentLoaded", function() {
        window.print();
    }); 
</script>
</body>

</html>
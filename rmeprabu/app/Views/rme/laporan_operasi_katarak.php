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
    <title>Laporan Operasi Katarak</title>
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

<script>
    window.addEventListener("DOMContentLoaded", function() {   
        window.print();
    }); 
</script>
</body>

</html>
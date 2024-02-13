<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Bukti Pembayaran Kasir</title>
    <style type="text/css">
        @page {
            margin: 20px 15px;
            font-size: 14px;
            margin-top: 0.8.cm;
            margin-bottom: 1.1.cm;
            margin-left: 1.5.cm;
            margin-right: 1.5.cm;
            line-height: 1.5;
            color: black;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        body {
            font-size: 14px;
            line-height: 1.5;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: black;
        }

        .wgaris {
            border-width: 0.5 px;
            /* border-style: solid; */
            border-top: 2px black;
            border-bottom: 2px black;
            border-left: 0px white;
            border-right: 0px white;
            /* border-left: #ff0000;
            border-right: #ff0000; */
        }

        .table {
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row" style="font-size:100%">
            <div class="col-md-12">

                <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 1%; text-align: center;" rowspan="3">
                                <div class="img">
                                    <img style="height: 50" src="./assets/images/gallery/muaraenim.png" width="60px" class="dark-logo" />

                                </div>
                            </td>
                            <td style="width: 99%; text-align: center;">
                                <b>
                                    <font size="20px"> <?= $header1; ?></font>
                                </b>
                            </td>

                        </tr>
                        <tr>
                            <td style="width: 99%; text-align: center;">
                                <b>
                                    <font size="22px"> <?php echo $header2; ?> </font>
                                </b>
                            </td>
                        </tr>
                        <tr>

                            <td style="width: 99%; text-align: center;">
                                <font size="14px"> <?php echo $alamat; ?> </font>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <hr>

                <div>
                    <table style="border-collapse: collapse; width: 100%; line-height: 1" border="0">
                        <tbody>
                            <tr style="height: 100px">
                                <td style="width: 100%; text-align: center; line-height :1">
                                    <br>
                                    <b>
                                        <font size="4"> <?php echo $deskripsi; ?> </font>
                                    </b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>

                <font size="14px">
                    <div class="pull-text text-left">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1.2;" border="0">
                            <tbody>
                                <?php
                                foreach ($datapasien as $row) :
                                ?>
                                    <tr>
                                        <td style="border-collapse: collapse; width: 100%; line-height: 2;" colspan="4"><u>SUDAH TERIMA DARI</u></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">No. Kwitansi</td>
                                        <td style="width: 45%">: <?php echo $row['validationnumber']; ?></td>
                                        <td style="width: 15%">No. Rekam medik</td>
                                        <td style="width: 25%">: <?php echo $row['pasienid']; ?> | <?php echo $row['pasiengender']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">No. Pendaftaran</td>
                                        <td style="width: 45%">: <?php echo $row['referencenumber']; ?></td>
                                        <td style="width: 15%">Pembayaran</td>
                                        <td style="width: 25%">: <?php echo $row['paymentmethodname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">Nama pasien</td>
                                        <td style="width: 45%">: <b><?php echo $row['pasienname']; ?></b></td>
                                        <td style="width: 15%">Tgl Lahir</td>
                                        <td style="width: 25%">: <?php echo $row['pasiendateofbirth']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">Alamat</td>
                                        <td style="width: 85%" colspan="3">: <?php echo $row['pasienaddress']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 15%">Ruangan</td>
                                        <td style="width: 45%">: <?php echo $row['roomname']; ?></td>
                                        <td style="width: 15%">Tgl Pulang</td>
                                        <td style="width: 25%">: <?php echo $row['dateout']; ?></td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php /* kondisi mencari angka rata kanan .......*/ ?>

                    <div class="pull-text">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1.2;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 100%; line-height: 1.5;" colspan="7"><u>RINCIAN BIAYA PELAYANAN RAWAT INAP</u></td>
                                </tr>

                                <!-- Menghitung visit dokter -->
                                <?php
                                    foreach ($VISITE as $rowV) :
                                ?>
                                    <?php $TotPemeriksaan[] = $rowV['totaltarif'];  ?>
                                <?php endforeach;
                                    $check_TotPemeriksaan = isset($TotPemeriksaan) ? array_sum($TotPemeriksaan) : 0;
                                    $TotalPemeriksaan = $check_TotPemeriksaan; ?>

                                <tr>
                                    <td style="width: 25%">Biaya Kamar</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($row['totalkamar'], 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Biaya Visite Dokter</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalPemeriksaan, 0, ",", "."); ?></td>
                                </tr>

                                <!-- Menghitung Lab -->
                                <?php foreach ($PENUNJANG as $P) : ?>
                                    <?php if ($P['groups'] == "LPK") {
                                            // $deskripsi = 'Lab Patologi Klinik'; 
                                    ?>
                                        <?php $TotPENUNJANGLPK[] = $P['totalamount'];  ?>
                                    <?php } ?>

                                    <?php if ($P['groups'] == "LPA") {
                                            // $deskripsi = 'Lab Patologi Anatomi'; 
                                    ?>
                                        <?php $TotPENUNJANGLPA[] = $P['totalamount'];  ?>
                                    <?php } ?>

                                <?php endforeach;
                                    $check_TotPENUNJANGLPA = isset($TotPENUNJANGLPA) ? array_sum($TotPENUNJANGLPA) : 0;
                                    $TotalPenunjangLPA = $check_TotPENUNJANGLPA;

                                    $check_TotPENUNJANGLPK = isset($TotPENUNJANGLPK) ? array_sum($TotPENUNJANGLPK) : 0;
                                    $TotalPenunjangLPK = $check_TotPENUNJANGLPK + $check_TotPENUNJANGLPA;
                                ?>

                                <!-- Menghitung Radiologi -->
                                <?php foreach ($PENUNJANG as $P) : ?>
                                    <?php if ($P['groups'] == "RAD") {
                                            // $deskripsi = 'RADIOLOGI'; 
                                    ?>
                                        <?php $TotPENUNJANGRAD[] = $P['totalamount'];  ?>
                                    <?php } ?>
                                <?php endforeach;
                                    $check_TotPENUNJANGRAD = isset($TotPENUNJANGRAD) ? array_sum($TotPENUNJANGRAD) : 0;
                                    $TotalPenunjangRAD = $check_TotPENUNJANGRAD;
                                ?>

                                <!-- Menghitung Bank Darah -->
                                <?php foreach ($PENUNJANG as $P) : ?>
                                    <?php if ($P['groups'] == "BD") {
                                            // $deskripsi = 'BANK DARAH'; 
                                    ?>
                                        <?php $TotPENUNJANGBD[] = $P['totalamount'];  ?>
                                    <?php } ?>
                                <?php endforeach;
                                    $check_TotPENUNJANGBD = isset($TotPENUNJANGBD) ? array_sum($TotPENUNJANGBD) : 0;
                                    $TotalPenunjangBD = $check_TotPENUNJANGBD;
                                ?>

                                <!-- Menghitung Hemodialisa -->
                                <?php foreach ($PENUNJANGBR as $PBR) : ?>
                                    <?php if ($PBR['types'] == "HD") {
                                            // $deskripsi = 'HEMODIALISA; 
                                    ?>
                                        <?php $TotPENUNJANGHD[] = $PBR['subtotal'];
                                            $TotBMHP[] =  $PBR['share1']; ?>
                                    <?php } ?>
                                <?php endforeach;
                                    $check_TotPENUNJANGHD = isset($TotPENUNJANGHD) ? array_sum($TotPENUNJANGHD) : 0;
                                    $TotalPenunjangHD = $check_TotPENUNJANGHD;

                                    $check_TotBMHP = isset($TotBMHP) ? array_sum($TotBMHP) : 0;
                                    $TotalBMHP = $check_TotBMHP;

                                    $TambahTNOHD = $TotalPenunjangHD - $TotalBMHP;
                                ?>

                                <!-- Menghitung Tindakan No Penunjang -->
                                <?php foreach ($TNONoPenunjang as $TNP) : ?>
                                    <?php $TotTNONoPenunjang[] = $TNP['subtotal'];  ?>

                                    <?php if ($TNP['types'] == "APG") { // $deskripsi = 'GIZI; 
                                    ?>
                                        <?php $TotGIZI[] = $TNP['subtotal']; ?>
                                    <?php } ?>

                                    <?php if ($TNP['category'] == "SAL") { // $deskripsi = 'SEwa alat; 
                                    ?>
                                        <?php $TotSewaAlat[] = $TNP['subtotal']; ?>
                                    <?php } ?>

                                <?php endforeach;
                                    $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
                                    $TotalGIZI = $check_TotGIZI;

                                    $check_TotSewaAlat = isset($TotSewaAlat) ? array_sum($TotSewaAlat) : 0;
                                    $TotalSewaAlat = $check_TotSewaAlat;

                                    $check_TotTNONoPenunjang = isset($TotTNONoPenunjang) ? array_sum($TotTNONoPenunjang) : 0;
                                    $TotalTNONoPenunjang = $check_TotTNONoPenunjang - $check_TotGIZI - $check_TotSewaAlat;
                                ?>

                                <tr>
                                    <td style="width: 25%">Biaya Laboratorium</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalPenunjangLPK, 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Biaya Tindakan Medis / Paramedis</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo  number_format($TotalTNONoPenunjang + $TambahTNOHD, 0, ",", "."); ?></td>
                                </tr>


                                <!-- menhitung farmasi igd -->
                                <?php
                                    foreach ($FARMASIIGD as $FIGD) :
                                ?>
                                    <?php $TotFARIGD[] = abs($FIGD['totalharga']);  ?>
                                <?php endforeach; ?>

                                <?php
                                    $check_TotFARIGD = isset($TotFARIGD) ? array_sum($TotFARIGD) : 0;
                                    $TotalFARIGD = $check_TotFARIGD;
                                ?>

                                <!-- Menghitung farmasi rawat inap -->
                                <?php
                                    foreach ($FARMASI as $F) :
                                ?>
                                    <?php $TotFAR[] = abs($F['price']);  ?>
                                <?php endforeach; ?>

                                <?php
                                    $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
                                    $TotalFAR = $check_TotFAR - $check_TotFARIGD;
                                ?>

                                <tr>
                                    <td style="width: 25%">Biaya Radiologi</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalPenunjangRAD, 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Farmasi & BHP</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalFAR, 0, ",", "."); ?></td>
                                </tr>

                                <!-- Menghitung Radiologi USG -->
                                <?php foreach ($PENUNJANGBRUSG as $PBRUSG) : ?>
                                    <?php $TotPENUNJANGUSG[] = $PBRUSG['subtotal'];  ?>
                                <?php endforeach;
                                    $check_TotPENUNJANGUSG = isset($TotPENUNJANGUSG) ? array_sum($TotPENUNJANGUSG) : 0;
                                    $TotalPenunjangUSG = $check_TotPENUNJANGUSG;
                                ?>

                                <!-- Menghitung Tindakan EKG -->
                                <?php foreach ($TNOEKG as $TEKG) : ?>
                                    <?php $TotTNOEKG[] = $TEKG['subtotal'];  ?>
                                <?php endforeach;
                                    $check_TotTNOEKG = isset($TotTNOEKG) ? array_sum($TotTNOEKG) : 0;
                                    $TotalPenunjangEKG = $check_TotTNOEKG;
                                ?>

                                <!-- Menghitung Tindakan EKG -->
                                <?php foreach ($TNOEEG as $TEEG) : ?>
                                    <?php $TotTNOEEG[] = $TEEG['subtotal'];  ?>
                                <?php endforeach;
                                    $check_TotTNOEEG = isset($TotTNOEEG) ? array_sum($TotTNOEEG) : 0;
                                    $TotalPenunjangEEG = $check_TotTNOEEG;
                                ?>

                                <!-- Menghitung Tindakan EKG -->
                                <?php foreach ($TNOUSG as $TUSG) : ?>
                                    <?php $TotTNOUSG[] = $TUSG['subtotal'];  ?>
                                <?php endforeach;
                                    $check_TotTNOUSG = isset($TotTNOUSG) ? array_sum($TotTNOUSG) : 0;
                                    $TotalPenunjangUSG = $check_TotTNOUSG;
                                    $TotalGabPenunjang = $TotalPenunjangEKG + $TotalPenunjangEEG + $TotalPenunjangUSG;
                                ?>

                                <tr>
                                    <td style="width: 25%">Biaya Penunjang</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalGabPenunjang, 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Konsultasi Gizi</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalGIZI, 0, ",", "."); ?></td>
                                </tr>


                                <tr>
                                    <td style="width: 25%">Biaya Pelayanan Darah</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalPenunjangBD, 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">Sewa Alat</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalSewaAlat, 0, ",", "."); ?></td>
                                </tr>

                                <tr>
                                    <td style="width: 25%">Tindakan Operasi</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($row['totaltindakanoperasi'], 0, ",", "."); ?></td>
                                    <td style="width: 15%"></td>
                                    <td style="width: 25%">BMHP</td>
                                    <td style="width: 1px">:</td>
                                    <td style="width: 15%; text-align: right;"><?php echo number_format($TotalBMHP, 0, ",", "."); ?></td>
                                </tr>


                                <!-- menghitung tindakan igd -->
                                <?php
                                    foreach ($PEMIGD as $PIGD) :
                                ?>
                                    <?php $TotPEMIGD[] = $PIGD['price']; ?>
                                <?php endforeach; ?>
                                <?php $check_TotPEMIGD = isset($TotPEMIGD) ? array_sum($TotPEMIGD) : 0;
                                    $TotalPemIGD = $check_TotPEMIGD; ?>

                                <!-- menghitung konsul igd -->
                                <?php
                                    foreach ($KONSULIGD as $KIGD) :
                                ?>
                                    <?php $TotKonsulIGD[] = $KIGD['price']; ?>
                                <?php endforeach; ?>
                                <?php $check_TotKonsulIGD = isset($TotKonsulIGD) ? array_sum($TotKonsulIGD) : 0;
                                    $TotalKonsulIGD = $check_TotKonsulIGD; ?>

                                <!-- menghitung tindakan igd -->
                                <?php
                                    foreach ($TINIGD as $TGD) :
                                ?>
                                    <?php $TotTINDIGD[] = $TGD['subtotal']; ?>
                                <?php endforeach;
                                    $check_TotTINDIGD = isset($TotTINDIGD) ? array_sum($TotTINDIGD) : 0;
                                    $TotalTindIGD = $check_TotTINDIGD;
                                ?>

                                <!-- mnghitung farmasi igd -->
                                <?php
                                    foreach ($PENUNJANGIGD as $PNJIGD) :
                                ?>
                                    <?php $TotPENUNJANGIGD[] = $PNJIGD['subtotal'];  ?>
                                <?php endforeach; ?>
                                <?php
                                    $check_TotPENUNJANGIGD = isset($TotPENUNJANGIGD) ? array_sum($TotPENUNJANGIGD) : 0;
                                    $TotalPENUNJANGIGD = $check_TotPENUNJANGIGD;
                                ?>

                                <?php
                                    foreach ($TagihanAsal as $tagihan_asal) :
                                        $totaldaftarklinik = $tagihan_asal['totaldaftar'];
                                        $totaltindakanklinik = $tagihan_asal['totaltindakan'];
                                        $totalbhptindakanklinik = $tagihan_asal['totalbhp'];
                                        $totalfarmasiklinik = $tagihan_asal['totalfarmasi'];
                                        $totalpenunjangklinik = $tagihan_asal['totalpenunjang'];
                                        $totalkasirklinik = $tagihan_asal['grandtotal'];
                                        $asalpelayanan = $tagihan_asal['groups'];
                                ?>

                                    <?php
                                        $TotalBiayaIGD = $TotalPENUNJANGIGD + $TotalTindIGD + $TotalPemIGD + $TotalFARIGD + $TotalKonsulIGD;
                                        $sisatagihanasal = $TotalBiayaIGD - $tagihan_asal['paymentamount'];

                                        $TotalBiayaRI = $row['totalkamar'] + $TotalPemeriksaan + $TotalPenunjangLPK +
                                            $TotalTNONoPenunjang + $TambahTNOHD + $TotalPenunjangRAD + $TotalFAR + $TotalGabPenunjang +
                                            $TotalGIZI + $TotalPenunjangBD + $TotalSewaAlat + $row['totaltindakanoperasi'] + $TotalBMHP;
                                    ?>

                                    <tr style="font-style:oblique; line-height :2;">
                                        <td style="width: 25%"></td>
                                        <td style="width: 1px"> </td>
                                        <td style="width: 15%"> </td>
                                        <td style="width: 15%"> </td>
                                        <td style="width: 25%"><b>Tagihan Rawat Inap</b></td>
                                        <td style="width: 1px">:</td>
                                        <td style="width: 15%; text-align: right;"><b><?php echo number_format($TotalBiayaRI, 0, ",", "."); ?></b></td>
                                    </tr>
                                    <tr style="font-style:oblique; line-height :1;">
                                        <td style="width: 25%"></td>
                                        <td style="width: 1px"> </td>
                                        <td style="width: 15%"> </td>
                                        <td style="width: 15%"> </td>
                                        <td style="width: 25%"><b><?php if ($row['groups'] == "IRJ") {
                                                                        $asal = 'Pelayanan RJ';
                                                                    } else {
                                                                        $asal = 'Pelayanan IGD';
                                                                    }
                                                                    ?>Tagihan <?= $asal; ?></b> </td>
                                        <td style="width: 1px">:</td>
                                        <td style="width: 15%; text-align: right;"><b><?php echo number_format($TotalBiayaIGD, 0, ",", "."); ?></b> </td>
                                    </tr>

                                    <tr style="font-style:oblique; line-height :1.1;">
                                        <td style="width: 25%"></td>
                                        <td style="width: 1px"> </td>
                                        <td style="width: 15%"> </td>
                                        <td style="width: 15%"> </td>
                                        <td style="width: 25%"> </td>
                                        <td style="width: 1px"></td>
                                        <td style="width: 15%; text-align: right;">- <i><?php echo number_format($tagihan_asal['paymentamount'], 0, ",", ".") ?></i></td>
                                    </tr>

                                    <tr>
                                        <td style="text-align: left">Total Tagihan Biaya</td>
                                        <td style="width: 1px">:</td>
                                        <td style="text-align: right;"><?php echo number_format($TotalBiayaRI + $TotalBiayaIGD - $tagihan_asal['paymentamount'], 0, ",", "."); ?></td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 25%"></td>
                                        <td style="width: 1px"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                    <tr style="font-style:oblique; line-height :1.2;">
                                        <td style="text-align: left"><b>Bayar Tagihan</b></td>
                                        <td style="width: 1px">:</td>
                                        <td style="text-align: right;"><b><?php $totalbayar = ($row['paymentamount'] + $row['nominaldebet']);
                                                                            echo number_format($totalbayar, 0, ",", "."); ?></b></td>
                                        <td style="width: 15%"></td>
                                        <td style="width: 25%"></td>
                                        <td style="width: 1px"></td>
                                        <td style="width: 15%"></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>



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



                    Terbilang : #<?php echo ucwords(terbilang($totalbayar)) . " Rupiah"; ?>#

                    <?php
                                    $tanggal = $row['created_at'];
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
                    <br>
                    <br>

                    <div class="pull-text">
                        <table style="border-collapse: collapse; width: 100%; height: 1px; line-height: 1;" border="0">
                            <tbody>
                                <tr style="height: 1px;">
                                    <td style="width: 35%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 35%; text-align: center; height: 1px">Muara Enim, <?php echo tgl_indo($tanggal); ?></td>
                                </tr>
                                <tr style="height: 1px;">
                                    <td style="width: 35%; text-align: center; height: 1px;">Penyetor</td>
                                    <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                    <td style="width: 35%; text-align: center; height: 1px;">Petugas Kasir</td>
                                </tr>
                                <?php
                                    foreach ($datapasien as $tanda) :
                                ?>

                                    <tr style="height: 1px;">
                                        <td style="width: 35%; text-align: center; height: 1px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturekasir']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width:35%; text-align: center; height: 1px;">
                                            <div class="col-md-12">
                                                <div class="el-card-avatar el-overlay-1"> <img width="800%" height="300%" src="<?= $tanda['signaturepasien']; ?>" />
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr style="height: 30px;">

                                        <td style="width: 35%; text-align: center; height: 1px;"><u><?= $tanda['payersname']; ?></u></td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 15%; text-align: center; height: 1px;">&nbsp;</td>
                                        <td style="width: 35%; text-align: center; height: 1px;"><u><?= $tanda['createdby']; ?></u></td>
                                    <?php endforeach; ?>
                                    </tr>
                            </tbody>

                        </table>
                    </div>
                <?php endforeach; ?>
                </font>
            </div>
        </div>
    </div>


</body>

</html>
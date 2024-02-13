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
    </style>

</head>

<body>

    <!-- <div class="container-fluid text-dark"> -->
    <div>
        <div class="row">
            <!-- <div class="col-md-12"> -->
            <div>
                <div>
                    <?php
                    foreach ($datapasien as $row) :
                    ?>
                        <table style="border-collapse: collapse; line-height: 1; width:100%;" border="0">
                            <tbody>
                                <tr>
                                    <!-- <td style="width: 15%; text-align: center;" rowspan="3"> -->
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
                                            <font size="22px" ><?php echo $header2; ?></font>
                                            
                                        </b>
                                    </td>
                                </tr>
                                <tr>

                                    <td style="text-align: left;">
                                        <font size="1"><?php echo $alamat; ?></font>
                                    </td>
                                </tr>
                                <tr >
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
                                   RESUME PASIEN KELUAR GAWAT DARURAT (Discharge Summary)</td>
                                </tr>
                                <!-- <tr> -->
                                    <!-- <td colspan="2" style="text-align: right;"> -->
                                        <!-- <br> -->
                                        <!-- <font size="14px">Antrian Poli : <b><?= number_format($row['noantrian'], 0, ",", "."); ?></b></font> -->
                                    <!-- </td> -->
                                <!-- </tr> -->
                            </tbody>
                        </table>
                </div>
                <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->
                <br>

                <div class="0">
                    <table style="border-collapse: collapse; width: 100%;" border="0">
                        <thead>
                            <tr>
                                <td style="width: 0.4cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 0.15cm;"> </td>
                                <td style="width: 5.8cm;"> </td>
                                <td style="width: 3cm;"> </td>
                                <td style="width: 0.15cm;"> </td>
                                <td style="width: 6cm;"> </td>
                            </tr>
                        </thead>
                        <tbody style="line-height: 1;">
                            <tr>
                                <td style="text-align: left;">Nomor RM</td>
                                <td>:</td>
                                <!-- <td></td> -->
                                <td style="text-align: left;">Tanggal Masuk</td>
                                <td>:</td>
                                <td>Jam Masuk :</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Nama Pasien</td>
                                <td>:</td>
                                <!-- <td></td> -->
                                <td>(admision date)</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Jenis Kelamin</td>
                                <td>:</td>
                                <!-- <td></td> -->
                                <td>Tanggal Keluar</td>
                                <td>:</td>
                                <td>Jam Keluar :</td>
                               </tr>
                            <tbody style="line-height: 0.8;">
                            <tr>
                                <td style="text-align: left;"></td>
                                <td></td>
                                <!-- <td></td> -->
                                <td>(discharge date)</td>

                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="3.5;">1. Anamnesis (anamnesa) :</td>
                                <!-- <td>:</td> -->
                            </tr>
                            <tr style="line-height: 3;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <!-- <td> ICD 9 :</td> -->
                            </tr>
                            <tr style="line-height: 0.5;">
                                <td colspan="3.5;">2. Pemeriksaan Fisik (fhisical findings) :</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 3;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <!-- <td> ICD 9 :</td> -->
                            </tr>
                            <tr style="line-height: 0.5;">
                                <td colspan="3.5;">3. Pemeriksaan Penunjang (supporting examination) :</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 3;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <!-- <td> ICD 9 :</td> -->
                            </tr>
                            <tr style="line-height: 0.5;">
                                <td colspan="5;">4. Terapi/ Pengobatan Selama Di Rumah Sakit (therapy/ treatment in hospital) :</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 3;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <!-- <td> ICD 9 :</td> -->
                            </tr>
                            <tr style="line-height: 0.5;">
                                <td colspan="3.5;">5. Diagnosis Utama (primary dagnosis) :</td>
                               <!-- <td>: </td> -->
                             </tr>
                             <tr style="line-height: 2;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <td> ICD 10 : </td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td colspan="3.5;">6. Diagnosis Tambahan (auditional diagnosis) :</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <td> ICD 10 :</td>
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <td> ICD 10 :</td>
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <td> ICD 10 :</td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td colspan="3.5;">7. Tindakan Utama (primary procedure) :</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 3;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <td> ICD 9 :</td>
                            </tr>
                            <tr style="line-height: 1;">
                                <td colspan="3.5;">8. Tindakan Tambahan ( auditional procedur) :</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 3;">
                                <td colspan="3.5;">______________________________________________________________________________________</td>
                               <td> ICD 9 :</td>
                            </tr>
                            <tr style="line-height: 2;">
                                <td colspan="3.5;">• Cara Pulang*) :</td>
                               <!-- <td>: </td> -->
                            </tr> <tr style="line-height: 2;">
                                <td colspan="3.5;">• Kondisi Saat Pulang*) :</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 4;">
                                <td colspan="2.9;">• Kontrol Ke*) :</td>
                               <td colspan="3" style="text-align:center;">DALAM KEADAAN DARURAT DAPAT MENGHUBUNGI IGD :</td>
                            </tr>
                            <tr style="line-height: 0.5;">
                                <td colspan="3.5;">_____________________________________________</td>
                               <!-- <td style="text-alig==;"> Rsud Dr.H Mohammad Rabain</td> -->
                            </tr>
                            <tr style="line-height: 0.5;">
                                <td colspan="2.9"></td>
                                <td colspan="3;" style="text-align: center;"> IGD Rsud dr. H. Mohammad Rabain Kab. Muara Enim 31314</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 1;">
                                <td colspan="2.9"></td>
                                <td colspan="3;" style="text-align: center;">Nomor Telephone : 0734-424345</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 0;">
                                <td colspan="3.5;">- Alamat  :_____________________________________</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 1;">
                                <td colspan="3.5;">- Tanggal :____________________________________</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 4;">
                                <td colspan="3.5;">*) Beri tanda ceklis sesuai pilihan</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 0;">
                                <td colspan="4.5;">- Dibua rangkap 3 ( 1 untuk rekam medis, 1 untuk pasien, 1 untuk penjamin)</td>
                               <!-- <td>: </td> -->
                            </tr>
                            <tr style="line-height: 4;">
                                <td colspan="2" style="text-align: center;">
                                    Muara Enim, <?= date('d-m-Y', strtotime($row['documentdate'])); ?>
                                </td>
                            </tr>
                            <tr style="line-height: 0.5;">
                                <td colspan="2"; style="text-align: center;">Dokter Penanggung Jawab Pelayanan</td>
                               <!-- <td>: </td> -->
                              </tr>
                              <tr style="line-height: 2;">
                                <td colspan="2" style="text-align: center;">
                                    <br>
                                    <br>
                                    <br>
                                    (__________________________________)
                                </td>
                             </tr>
                             <tr style="line-height: 0.5;">
                                <td colspan="2" style="text-align: center;">Tanda tangan dan nama jelas</td>
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
                    <!-- <hr style="height:1px;border:none;color:#333;background-color:#333;" /> -->

                <?php endforeach; ?>


                </div>
            </div>
        </div>
    </div>

</body>

</html>
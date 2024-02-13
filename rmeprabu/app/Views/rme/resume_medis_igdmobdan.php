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


    <style type="text/css">
        .hr27 {
            border: none;
            border-top: 3px double #333;
            color: #333;
            overflow: visible;
            text-align: center;
            height: 5px;
        }

        .hr27:after {
            background: #fff;
            content: 'Hasil Pemeriksaan';
            padding: 0 2px;
            position: relative;
            top: -13px;
            font-size: 20px;
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
                            <tr>
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
                                    <b>RESUME MEDIS PASIEN IGD (Discharge Summary)</b>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <br>

                <div class="0">
                    <table style="border-collapse: collapse; width: 100%;" border="0">

                        <tbody style="line-height: 2;">
                            <tr>
                                <td style="text-align: left;">NO. RM</td>
                                <td>: <?= $pasienid; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Nama Pasien</td>
                                <td>: <?= $pasienname; ?></td>
                            </tr>
                            <?php
                            $tanggal = $pasiendateofbirth;
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
                            <tr>
                                <td style="text-align: left;">Tanggal Lahir</td>
                                <td>: <?php echo tgl_indo($tanggal); ?></td>
                            </tr>
                            <?php
                            $tanggalperiksa = $tanggalperiksa;
                            function tgl_indo2($tanggalperiksa)
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
                                $pecahkan = explode('-', $tanggalperiksa);
                                return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                            }

                            ?>
                            <tr>
                                <td style="text-align: left;">Tanggal Pemeriksaan</td>
                                <td>: <?php echo tgl_indo2($tanggalperiksa); ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Poliklinik</td>
                                <td>: <?= $poliklinik; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Dokter</td>
                                <td>: <?= $dokter; ?></td>
                            </tr>


                        </tbody>
                    </table>

                    <hr class="hr27" >
                    <table style="border-collapse: collapse; width: 100%;" border="0" >

                        <tbody style="line-height: 2;">
                            <tr style="line-height: 2;">
                                    <td colspan="2;"><b>1. Anamnesis (anamnesa) :</b></td>
                            </tr>
                            <tr>
                                    <td colspan="6"><?= $anamnesa; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;"><b>2. Objektif :</b></td>
                            </tr>
                            <tr>
                                <td colspan="6"> <?= $objective; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;"><b>3. Diagnosa (diagnosis):</b></td>
                            </tr>
                            <tr>
                                <td colspan="6"> <?= $diagnosis; ?></td>
                            </tr>
                            <tr>
                            <td colspan="5;"><b>4. Terapi/ Pengobatan Selama Di Rumah Sakit (therapy/ treatment in hospital) :</b></td>
                            </tr>
                            <tr>
                                <td colspan="6"> <?= $terapi; ?></td>
                            </tr>


                            <tr style="line-height: 2.5;">
                                <td colspan="3">

                                </td>
                                <td colspan="3" style="text-align: center;">
                                    Muara Enim, <?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>
                                </td>
                            </tr>
                            <tr style="line-height: 0.9;">
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: center;">Dokter Penanggung Jawab Pelayanan</td>
                            </tr>


                            <tr style="line-height: 4.5;">
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: center;"><?= $barcode; ?></td>
                            </tr>


                            <tr style="line-height: 1;">
                                <td colspan="3"></td>
                                <td colspan="3" style="text-align: center;"><?= $dokter; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
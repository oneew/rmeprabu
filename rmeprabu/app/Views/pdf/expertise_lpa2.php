<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Expertise Patologi Anatomi</title>
    <style type="text/css">
        table {

            width: 10%;
        }

        table,
        th,
        td {
            text-align: left;
        }

        footer {
            position: fixed;
            bottom: 10px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        .teks {
            font-family: 'arial';
            font-size: 13px;
        }
    </style>
    </style>
</head>

<body>
    <div>
        <div class="row">
            <div>
                <div> 
                <table style="border-collapse: collapse; width:100%; border-bottom: 1px solid #000;">
                <tr >
                    <td style="text-align: left; width: 70px;" rowspan="3">
                        <img style="height: 60px;" src="<?= base_url('assets/images/gallery/pemkab.png') ;?>" width="70px" class="dark-logo" />
                    </td>
                                <td style="text-align: center; width:15cm; font-size: 18px;">
                                    <?= $header1; ?>
                                </td>
                                <td style="text-align: left; width: 70px;" rowspan="3">
                        <img style="height: 60px;" src="<?= base_url('assets/images/gallery/puskesmas.png') ;?>" width="70px" class="dark-logo" />
                    </td>
                            </tr>
                            <tr>
                            <td style="text-align: center; font-size: 18px;">
                                    <b>
                                        <?php echo $header2; ?>

                                    </b>
                                </td>
                            </tr>
                            <tr>

                            <td style="text-align: center; font-size: 12px;">
                                    <?php echo $alamat; ?>
                                </td>
                            </tr>
                            <tr>
                    </tbody>
                </table>
                <hr>
                <div class="pull-text text-center">
                    <div class="col-md-12">
                        <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                            <tbody>
                                <tr>
                                    <td style="width: 33.3333%; text-align: center;">
                                        <?= $deskripsi; ?>
                                        <br> Hasil Pemeriksaan Mikroskopik Konvensional (Modified Bethesda 2001)
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="pull-text text-left">

                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 1;" border="0">
                        <tbody>
                            <?php
                            foreach ($datapasien as $row) :
                            ?>
                                <tr>
                                <td style="text-align: left;">Nama</td>
                                    <td >:</td>
                                    <td ><?= $row['pasienname']; ?></td>
                                    <td >Dokter Pengirim</td>
                                    <td >:</td>
                                    <td ><?= $row['doktername']; ?></td>
                                </tr>
                                <tr>
                                <td style="text-align: left;">No. RM</td>
                                    <td >:</td>
                                    <td ><?= $row['pasienid']; ?></td>
                                    <td >No. Reg</td>
                                    <td >:</td>
                                    <td ><?= $row['referencenumber']; ?></td>
                                </tr>
                                <tr>
                                <td style="text-align: left;">Umur</td>
                                    <td >:</td>
                                    <td ><?= $row['pasienage']; ?></td>
                                    <td >Jenis Klamin</td>
                                    <td >:</td>
                                    <td ><?= $row['pasiengender']; ?></td>
                                </tr>
                                <tr>
                                <td style="text-align: left;">Alamat</td>
                                    <td >:</td>
                                    <td ><?= $row['pasienaddress']; ?></td>
                                    <td >No.PA</td>
                                    <td >:</td>
                                    <td ><?= $row['journalnumber']; ?></td>
                                </tr>
                                <tr>
                                <td style="text-align: left;">No Tgl <br>Pengiriman</td>
                                    <td >:</td>
                                    <td ><?= $row['created_at']; ?></td>
                                    <td >Tgl Jawab/<br>Penyelesaian</td>
                                    <td >:</td>
                                    <td ><?= $row['created_at']; ?></td>
                                </tr>
                                <tr>
                                    <td >Diagnosa <br>Klinis</td>
                                    <td >:</td>
                                    <td ><?= $row['icdxname']; ?></td>
                                </tr>
                                <?php
                                $tanggallahir = $row['pasiendateofbirth'];
                                $dob = strtotime($tanggallahir);
                                $current_time = time();
                                $age_years = date('Y', $current_time) - date('Y', $dob);
                                $age_months = date('m', $current_time) - date('m', $dob);
                                $age_days = date('d', $current_time) - date('d', $dob);

                                if ($age_days < 0) {
                                    $days_in_month = date('t', $current_time);
                                    $age_months--;
                                    $age_days = $days_in_month + $age_days;
                                }

                                if ($age_months < 0) {
                                    $age_years--;
                                    $age_months = 12 + $age_months;
                                }

                                $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";


                                ?>
                               
                                
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <hr>

                <div class="pull-text text-left">
                    <table style="border-collapse: collapse; width: 100%; height: 10px; line-height: 2;" border="1" cellpadding=3 cellspacing=3>
                        <tbody>
                            <tr>
                                <td style="width: 25%;"><b>Klasifikasi Kelainan Sitologis :</b></td>
                                <td style="width: 25%;"><b class="teks">Intra Epithelial Lession (LIS) :</b></td>
                            </tr>
                                <tr>
                                    <td style="width: 25%;"><b class="teks">Kulaitas Smear :</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;"><b class="teks">INTERPRETASI :</b></td>
                                    <td style="width: 25%;"><b class="teks">Karsinoma Sel Skuanoma (SCC) :</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;"><b class="teks">Endocervix :</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;"><b class="teks">PERUBAHAN REAKTIF :</b></td>
                                    <td style="width: 25%;"><b class="teks">SEL GLANDURAL <br>Sel glandural atipik (AGC) :</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;"><b class="teks">INFEKSI :</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;"><b class="teks">EVALUASI HORMONAL  <br>(Apusan Vagina):</b></td>
                                    <td style="width: 25%;"><b class="teks">SARAN :</b></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;"><b class="teks">ABNORMALITAS SEL EPITHAL SEL SKUASOMA <br> Sel Skuamosa atipik / Atypical Squamous Cell (ASC):</A:blank></td>
                                </tr>
                                <td style="width: 25%;"><b class="teks"> <U>KESIMPULAN </U></b></td>
                        </tbody>
                    </table>
                </div>

                <?php
                $tanggal = $tanggalexpertise;
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
                    <div style="width: 100%; height: 90px; display: flex; justify-content:flex-end">
                    Muara Enim, <?= date('d-m-Y', strtotime(date('Y-m-d'))); ?>
                                    <br>Dokter Pemeriksa
                                    <br>(_____________________________)
                    </div>
                    <footer>
                        <table style="border-collapse: collapse; width: 100%; height: 18px;" border="0">
                            <tbody>
                                <tr style="height: 10px;">
                                    <td style="width: 100%; height: 18px;"> Dokter Yang Memeriksa : <?= $row['employeename']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </footer>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
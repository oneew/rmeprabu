<body>
    <div class="container-fluid">

        <div class="row" style="font-size:60%">

            <div class="col-md-12">
                <div class="pull-right text-right">
                    <h6>RM.01.02/VIII/2016</h6>
                </div>
                <hr />
                <div class="">

                    <h6><b>INFORMASI PELAYANAN PASIEN RAWAT INAP</b> <span class="">#<?= $journalnumber; ?></span></h6>
                    <hr />
                    <address>
                        <h6><b class="text-danger">RSUD Dr.H.MOHAMAD RABAIN</b></h6>
                        <p class="text-muted ml-1">Jalan Sultan Mahmud Badaruddin II No. 48 Air Lintang, Ps. II Muara Enim, Kec. Muara Enim, Kabupaten Muara Enim, Sumatera Selatan 31314
                            <br /> Muara Enim
                            <br /> Sumatera Selatan
                        </p>
                    </address>
                </div>
                <div class="pull-right text-right">
                    <address>
                        <h6>Kepada,</h6>
                        <h6 class="font-bold"><?= $pasienname; ?></h6>
                        <p class="text-muted ml-4">No.RM : <?= $pasienid; ?>,
                            <br /> Metode Pembayaran : <?= $paymentmethodname; ?>,
                            <br /> Kelas Perawatan : <?= $classroomname; ?>
                        </p>
                        <p class="mt-4"><b>Tanggal Masuk Perawatan :</b> <i class="fa fa-calendar"></i> <?= $documentdate; ?>
                        </p>

                    </address>
                </div>

                <div class="table-responsive mt-4" style="clear: both;">
                    <table class="table table-hover no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-left">Hak Pasien</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($hakpasien as $hak) :
                            ?>
                                <tr>
                                    <td><?= $hak['id']; ?></td>
                                    <td style="text-align: left;"><?= $hak['hakpasien']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="table table-hover no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-left">Kewajiban Pasien</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($kewajibanpasien as $wajib) :
                            ?>
                                <tr>
                                    <td><?= $wajib['id']; ?></td>
                                    <td style="text-align: left;"><?= $wajib['kewajibanpasien']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="table table-hover no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-left">PERATURAN & TATATERTIB PASIEN RAWAT INAP (ADMINISTRASI)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($administrasi as $adm) :
                            ?>
                                <tr>
                                    <td><?= $adm['id']; ?></td>
                                    <td style="text-align: left;"><?= $adm['tatatertib']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="table table-hover no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-left">PERATURAN & TATATERTIB PASIEN RAWAT INAP (KEUANGAN)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($keuangan as $keu) :
                            ?>
                                <tr>
                                    <td><?= $keu['id']; ?></td>
                                    <td style="text-align: left;"><?= $keu['tatatertib']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="table table-hover no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-left">PERATURAN & TATATERTIB PASIEN RAWAT INAP (PELAYANAN)</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($pelayanan as $pel) :
                            ?>
                                <tr>
                                    <td><?= $pel['id']; ?></td>
                                    <td style="text-align: left;"><?= $pel['tatatertib']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pull-right mt-4 text-right">
                    <hr>
                    <h5><b>Billing ID : <?= $token; ?></b> </h5>
                </div>

            </div>


        </div>
</body>

</html>
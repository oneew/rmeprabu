<body>
    <div class="container-fluid">

        <div class="row" style="font-size:60%">
            <div class="col-md-12">
                <div class="">
                    <h5><b>REMUNERASI</b> <span class="">#<?= $datapribadi[0]['norek']; ?></span></h5>
                    <hr />
                    <address>
                        <h5><b class="text-danger">RSUD KOTA BANDUNG</b></h5>
                        <p class="text-muted ml-1">Jl Rumah sakit No. 22
                            <br /> Ujungberung,
                            <br /> Bandung - (022)7809581</p>
                    </address>
                </div>
                <div class="pull-right text-right">
                    <address>
                        <h5>To,</h5>
                        <h6 class="font-bold"><?= $datapribadi[0]['name']; ?></h6>
                        <p class="text-muted ml-4">No.Rekening : <?= $datapribadi[0]['norek']; ?>,
                            <br /> Status Pegawai : <?= $datapribadi[0]['StatusPegawai']; ?>,
                            <br /> Tahun Kerja : <?= $datapribadi[0]['tahunkerja']; ?></p>
                        <p class="mt-4"><b>Periode Remunerasi :</b> <i class="fa fa-calendar"></i> <?php echo " " ?> <?php
                                                                                                                        foreach ($JTL as $JT) :
                                                                                                                        ?>
                                <?php
                                                                                                                            echo $JT['MonthIndexing'];
                                                                                                                            echo " ";
                                                                                                                            echo $JT['YearIndexing']; ?> </p>
                    <?php endforeach;
                    ?></p>

                    </address>
                </div>

                <div class="table-responsive mt-4" style="clear: both;">
                    <table class="table table-hover no-wrap">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th class="text-left">Total Score Indexing</th>
                                <th class="text-right">Bruto</th>
                                <th>Pajak</th>
                                <th class="text-right">Nominal Pajak</th>
                                <th class="text-right">Neto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($JTL as $row) :
                            ?>
                                <tr>
                                    <td><?= $row['Keterangan'] ?></td>
                                    <td><?= $row['TotalScore'] ?></td>
                                    <td style="text-align: right;"><?= number_format($row['NilaiBruto'], 2, ",", "."); ?>
                                    <td><?= $row['pajak'] ?></td>
                                    <td style="text-align: right;"><?= number_format($row['NilaiPajak'], 2, ",", "."); ?>
                                    <td style="text-align: right;"><?= number_format($row['NilaiNetto'], 2, ",", "."); ?>
                                        <?php $nilainetto[] = $row['NilaiNetto']; ?>
                                </tr>

                            <?php endforeach; ?>
                            <?php
                            foreach ($TR as $TRM) :
                            ?>
                                <tr>
                                    <td>TIM REMUN</td>
                                    <td><?= $TRM['jabatan'] ?></td>
                                    <td style="text-align: right;"><?= number_format($TRM['NilaiBruto'], 2, ",", "."); ?>
                                    <td><?= $TRM['pajak'] ?></td>
                                    <td style="text-align: right;"><?= number_format($TRM['NilaiPajak'], 2, ",", "."); ?>
                                    <td style="text-align: right;"><?= number_format($TRM['NilaiNetto'], 2, ",", "."); ?>
                                        <?php $nilainetto[] = $TRM['NilaiNetto']; ?>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>

                <div class="pull-right mt-4 text-right">
                    <p>SubTotal: <?php $netto = isset($nilainetto) ? $nilainetto : array(0);
                                    $subTotal = array_sum($netto);
                                    echo number_format($subTotal, 2, ",", "."); ?></p>
                    <p><?php $potongan = 0; ?>Potongan : <?php echo number_format($potongan, 2, ",", "."); ?> </p>
                    <hr>
                    <h5><b>Total :</b> <?php $total = $subTotal - $potongan;
                                        echo number_format($total, 2, ",", "."); ?></h5>
                </div>

            </div>


        </div>
</body>

</html>
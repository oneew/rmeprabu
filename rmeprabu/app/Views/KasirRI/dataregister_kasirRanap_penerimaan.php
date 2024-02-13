<head>
    <link href="../assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <style>
        @media screen {
            #printSection {
                display: none;
            }
        }

        @media print {

            body * {
                visibility: hidden;
            }

            .modal-dialog {
                max-width: 100%;
                width: 100%;
            }

            #printSection,
            #printSection * {
                visibility: visible;
            }

            .tb {
                visibility: visible;
            }

            #printSection {
                position: absolute;
                left: 0;
                top: 0;
                margin: 0;
                padding: 0;
                visibility: visible;
                /**Remove scrollbar for printing.**/
                overflow: visible !important;
            }

            .modal-body {
                overflow: visible !important;
            }

            .modal-dialog {
                visibility: visible !important;
                /**Remove scrollbar for printing.**/
                overflow: visible !important;
            }

            table {
                font-size: 10px;
            }
        }
    </style>

</head>
<div id="printThis">
    <div class="pull-center text-center">
        <address>
            <h3> &nbsp;<b class="text-info"><?= $header1; ?></b></h3>
            <p class="text-muted ml-1"><?= $header2; ?>
                <br /> <?= $status; ?>
                <br /> <?= $alamat; ?>
                <br />
            <h5> <?= $deskripsi; ?></h5>
            </p>
        </address>
    </div>
    <table id="registerrajal" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th colspan="14" class="text-info"><b>Penerimaan Kasir Rawat Jalan</b></th>
            </tr>
            <tr>
                <th>No</th>
                <th>TglValidasiKasir</th>
                <th>NoRm</th>
                <th>NamaPasien</th>
                <th>CaraBayar</th>
                <th>AsalPasien</th>
                <th>Dokter</th>
                <th>JumlahBiaya</th>
                <th>PotonganDiskon</th>
                <th>Tagihan</th>
                <th>TotalBayar</th>
                <th>Piutang</th>
                <th>Metode</th>
                <th>RefBank</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildatarajal as $rowrajal) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $rowrajal['created_at'] ?>
                        <br><b><?= $rowrajal['paymentstatus'] ?></b>
                    </td>
                    <td><?= $rowrajal['pasienid'] ?></td>
                    <td><?= $rowrajal['pasienname'] ?></td>
                    <td><?= $rowrajal['paymentmethodname'] ?></td>
                    <td><?= $rowrajal['poliklinikname'] ?></td>
                    <td><?= $rowrajal['doktername'] ?></td>
                    <td>
                        <?php
                        echo number_format($rowrajal['subtotal'], 2, ",", ".");
                        ?>
                        <?php $TotSubTotalRajal[] = $rowrajal['subtotal'];  ?></td>
                    <td>
                        <?= number_format($rowrajal['totaldiscount'], 2, ",", "."); ?>
                        <?php $TotdiscountRajal[] = $rowrajal['totaldiscount'];  ?>
                    </td>
                    <td>
                        <?php
                        echo number_format($rowrajal['grandtotal'], 2, ",", ".");
                        $TotbiayaRajal[] = $rowrajal['grandtotal'];
                        ?>
                    </td>
                    <td>
                        <?php $cashrajal = $rowrajal['paymentamount'];
                        $debetrajal = $rowrajal['nominaldebet'];
                        $totalbayarrajal = $cashrajal + $debetrajal;
                        if ($rowrajal['grandtotal'] >= $totalbayarrajal) {
                            $totalbayarrajal = $totalbayarrajal;
                        } else  if ($totalbayarrajal > $rowrajal['grandtotal']) {
                            $totalbayarrajal = $rowrajal['grandtotal'];
                        }
                        echo number_format($totalbayarrajal, 2, ",", ".");
                        ?>
                        <?php $TotincomeRajal[] = $totalbayarrajal;  ?>
                    </td>
                    <td><?php
                        $cashrajal2 = $rowrajal['paymentamount'];
                        $debetrajal2 = $rowrajal['nominaldebet'];
                        $totalbayarrajal2 = $cashrajal2 + $debetrajal2;
                        if ($totalbayarrajal2 < $rowrajal['grandtotal']) {
                            $sisabayarrajal2 = $rowrajal['grandtotal'] - $totalbayarrajal2;
                        } else if ($totalbayarrajal2 > $rowrajal['grandtotal']) {
                            $sisabayarrajal2 = 0;
                        } else {
                            $sisabayarrajal2 = 0;
                        }

                        echo number_format($sisabayarrajal2, 2, ",", ".");
                        ?>
                        <?php $TothutangRajal[] = $sisabayarrajal2; ?>

                    </td>
                    <td><?= $rowrajal['metodepembayaran'] ?></td>
                    <td><?= $rowrajal['referensibank'] ?></td>
                </tr>

            <?php endforeach; ?>

            <tr>
                <td colspan="6"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info">
                        <?php
                        $check_TotsubTotalRajal = isset($TotSubTotalRajal) ? array_sum($TotSubTotalRajal) : 0;
                        $TotalsubTotalRajal = $check_TotsubTotalRajal;
                        echo number_format($TotalsubTotalRajal, 2, ",", "."); ?></span>
                </td>
                <td><span class="badge badge-dark">
                        <?php
                        $check_TotdiscountRajal = isset($TotdiscountRajal) ? array_sum($TotdiscountRajal) : 0;
                        $TotaldiscountRajal = $check_TotdiscountRajal;
                        echo number_format($TotaldiscountRajal, 2, ",", "."); ?></span>
                </td>
                <td><span class="badge badge-info">
                        <?php
                        $check_TotbiayaRajal = isset($TotbiayaRajal) ? array_sum($TotbiayaRajal) : 0;
                        $TotalbiayaRajal = $check_TotbiayaRajal;
                        echo number_format($TotalbiayaRajal, 2, ",", "."); ?></span>
                </td>
                <td><span class="badge badge-success">
                        <?php
                        $check_TotincomeRajal = isset($TotincomeRajal) ? array_sum($TotincomeRajal) : 0;
                        $TotalincomeRajal = $check_TotincomeRajal;
                        echo number_format($TotalincomeRajal, 2, ",", "."); ?></span>
                </td>
                <td><span class="badge badge-warning">
                        <?php
                        $check_TothutangRajal = isset($TothutangRajal) ? array_sum($TothutangRajal) : 0;
                        $TotalhutangRajal = $check_TothutangRajal;
                        echo number_format($TotalhutangRajal, 2, ",", "."); ?></span>
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="14" class="text-info"><b>Penerimaan Kasir IGD</b></th>
            </tr>
            <?php $na = 0;
            foreach ($tampildataigd as $rowigd) :
                $na++;
            ?>
                <tr>
                    <td><?= $na ?></td>
                    <td><?= $rowigd['created_at'] ?>
                        <br><b><?= $rowigd['paymentstatus'] ?></b>
                    </td>
                    <td><?= $rowigd['pasienid'] ?></td>
                    <td><?= $rowigd['pasienname'] ?></td>
                    <td><?= $rowigd['paymentmethodname'] ?></td>
                    <td><?= $rowigd['poliklinikname'] ?></td>
                    <td><?= $rowigd['doktername'] ?></td>
                    <td><?php
                        echo number_format($rowigd['subtotal'], 2, ",", ".");
                        ?><?php $TotSubTotalIgd[] = $rowigd['subtotal'];  ?></td>
                    <td><?= number_format($rowigd['totaldiscount'], 2, ",", "."); ?> <?php $TotdiscountIgd[] = $rowigd['totaldiscount'];  ?></td>
                    <td><?php
                        echo number_format($rowigd['grandtotal'], 2, ",", ".");
                        $TotbiayaIgd[] = $rowigd['grandtotal'];
                        ?> </td>
                    <td><?php $cash = $rowigd['paymentamount'];
                        $debet = $rowigd['nominaldebet'];
                        $totalbayar = $cash + $debet;
                        if ($rowigd['grandtotal'] > $totalbayar) {
                            $totalbayar = $totalbayar;
                        } else {
                            $totalbayar = $rowigd['grandtotal'];
                        }
                        echo number_format($totalbayar, 2, ",", ".");
                        ?>
                        <?php $TotincomeIgd[] = $totalbayar;  ?></td>

                    <td><?php $cashigd = $rowigd['paymentamount'];
                        $debetigd = $rowigd['nominaldebet'];
                        $totalbayarigd = $cashigd + $debetigd;

                        if ($rowigd['grandtotal'] >= $totalbayarigd) {
                            $sisabayarigd = $rowigd['grandtotal'] - $totalbayarigd;
                        } else  if ($totalbayarigd > $rowigd['grandtotal']) {
                            $sisabayarigd = 0.00;
                        }

                        //$sisabayar = $rowigd['grandtotal'] - $totalbayar;

                        echo number_format($sisabayarigd, 2, ",", ".");
                        ?>
                        <?php $TotpiutangIgd[] = $sisabayarigd;  ?></td>
                    <td><?= $rowigd['metodepembayaran'] ?></td>
                    <td><?= $rowigd['referensibank'] ?></td>

                </tr>

            <?php endforeach; ?>

            <tr>
                <td colspan="6"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotsubTotalIgd = isset($TotSubTotalIgd) ? array_sum($TotSubTotalIgd) : 0;
                                                    $TotalsubTotalIgd = $check_TotsubTotalIgd;
                                                    echo number_format($TotalsubTotalIgd, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-dark"><?php
                                                    $check_TotdiscountIgd = isset($TotdiscountIgd) ? array_sum($TotdiscountIgd) : 0;
                                                    $TotaldiscountIgd = $check_TotdiscountIgd;
                                                    echo number_format($TotaldiscountIgd, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotbiayaIgd = isset($TotbiayaIgd) ? array_sum($TotbiayaIgd) : 0;
                                                    $TotalbiayaIgd = $check_TotbiayaIgd;
                                                    echo number_format($TotalbiayaIgd, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $check_TotincomeIgd = isset($TotincomeIgd) ? array_sum($TotincomeIgd) : 0;
                                                        $TotalincomeIgd = $check_TotincomeIgd;
                                                        echo number_format($TotalincomeIgd, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-warning"><?php
                                                        $check_TotpiutangIgd = isset($TotpiutangIgd) ? array_sum($TotpiutangIgd) : 0;
                                                        $TotalpiutangIgd = $check_TotpiutangIgd;
                                                        echo number_format($TotalpiutangIgd, 2, ",", "."); ?></span></td>
                <td colspan="2"></td>

            </tr>
            <tr>
                <th colspan="14" class="text-info"><b>Penerimaan Kasir Rawat Inap</b></th>
            </tr>
            <?php $nc = 0;
            foreach ($tampildata as $row) :
                $nc++;
            ?>
                <tr>
                    <td><?= $nc ?></td>
                    <td><?= $row['created_at'] ?>
                        <br><b><?= $row['paymentstatus'] ?></b>
                    </td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['paymentmethodname'] ?></td>
                    <td><?= $row['roomname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?php if (($row['types'] == "TN") or ($row['types'] == "NTN") or ($row['types'] == "IUR")) {
                            $jumlahbiayaranap = $row['grandtotal'];
                            echo number_format($jumlahbiayaranap, 2, ",", ".");
                        } else {
                            $jumlahbiayaranap = 0.00;
                            echo number_format($jumlahbiayaranap, 2, ",", ".");
                        } ?><?php $TotSubTotalRanap[] = $jumlahbiayaranap;  ?>
                    </td>
                    <td><?= number_format($row['discount'], 2, ",", "."); ?>
                        <?php $TotdiscountRanap[] = $row['discount'];  ?>
                    </td>
                    <td><?php if (($row['types'] == "TN") or ($row['types'] == "NTN") or ($row['types'] == "IUR")) {
                            $grandtotal = $row['grandtotal'];
                            echo number_format($grandtotal, 2, ",", ".");
                        } else {
                            $grandtotal = 0.00;
                            echo number_format($grandtotal, 2, ",", ".");
                        } ?> <?php $TotbiayaRanap[] = $grandtotal;  ?></td>
                    <td><?php $cash = $row['paymentamount'];
                        $debet = $row['nominaldebet'];
                        $totalbayar = $cash + $debet;
                        if ($row['grandtotal'] > $totalbayar) {
                            $totalbayar = $totalbayar;
                        } else {
                            $totalbayar = $row['grandtotal'];
                        }
                        echo number_format($totalbayar, 2, ",", ".");
                        ?>
                        <?php $TotincomeRanap[] = $totalbayar;  ?></td>

                    <td><?php $cash = $row['paymentamount'];
                        $debet = $row['nominaldebet'];
                        $totalbayar = $cash + $debet;
                        if ($row['types'] == "UM") {
                            $sisabayar = 0;
                        } else {
                            if ($row['grandtotal'] > $totalbayar) {
                                $totalbayar = $totalbayar;
                                $sisabayar = $row['grandtotal'] - $totalbayar;
                            } else {
                                $totalbayar = $row['grandtotal'];
                                $sisabayar = 0;
                            }
                        }
                        echo number_format($sisabayar, 2, ",", ".");
                        ?>
                        <?php $TotpiutangRanap[] = $sisabayar;  ?></td>
                    <td><?= $row['metodepembayaran'] ?></td>
                    <td><?= $row['referensibank'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotsubTotalRanap = isset($TotSubTotalRanap) ? array_sum($TotSubTotalRanap) : 0;
                                                    $TotalsubTotalRanap = $check_TotsubTotalRanap;
                                                    echo number_format($TotalsubTotalRanap, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-dark"><?php
                                                    $check_TotdiscountRanap = isset($TotdiscountRanap) ? array_sum($TotdiscountRanap) : 0;
                                                    $TotaldiscountRanap = $check_TotdiscountRanap;
                                                    echo number_format($TotaldiscountRanap, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotbiayaRanap = isset($TotbiayaRanap) ? array_sum($TotbiayaRanap) : 0;
                                                    $TotalbiayaRanap = $check_TotbiayaRanap;
                                                    echo number_format($TotalbiayaRanap, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $check_TotincomeRanap = isset($TotincomeRanap) ? array_sum($TotincomeRanap) : 0;
                                                        $TotalincomeRanap = $check_TotincomeRanap;
                                                        echo number_format($TotalincomeRanap, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-warning"><?php
                                                        $check_TotpiutangRanap = isset($TotpiutangRanap) ? array_sum($TotpiutangRanap) : 0;
                                                        $TotalpiutangRanap = $check_TotpiutangRanap;
                                                        echo number_format($TotalpiutangRanap, 2, ",", "."); ?></span></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="14" class="text-info"><b>Penerimaan Kasir Penunjang</b></th>
            </tr>

            <?php $nd = 0;
            foreach ($tampildatapenunjang as $rowpenunjang) :
                $nd++;
            ?>
                <tr>
                    <td><?= $nd ?></td>
                    <td><?= $rowpenunjang['created_at'] ?>
                        <br><b><?= $rowpenunjang['groups'] ?></b>
                    </td>
                    <td><?= $rowpenunjang['pasienid'] ?></td>
                    <td><?= $rowpenunjang['pasienname'] ?></td>
                    <td><?= $rowpenunjang['paymentmethodname'] ?></td>
                    <td><?= $rowpenunjang['poliklinikname'] ?></td>
                    <td><?= $rowpenunjang['doktername'] ?></td>
                    <td><?php
                        $jumlahbiayapenunjang = $rowpenunjang['grandtotal'];
                        echo number_format($jumlahbiayapenunjang, 2, ",", ".");
                        ?><?php $TotSubTotalPenunjang[] = $jumlahbiayapenunjang;  ?>
                    </td>
                    <td><?= number_format($rowpenunjang['disc'], 2, ",", "."); ?>
                        <?php $TotdiscountPenunjang[] = $rowpenunjang['disc'];  ?>
                    </td>
                    <td><?php
                        $grandtotalPenunjang = $rowpenunjang['grandtotal'];
                        echo number_format($grandtotal, 2, ",", ".");
                        ?> <?php $TotbiayaPenunjang[] = $grandtotalPenunjang;  ?></td>
                    <td><?php $cashPenunjang = $rowpenunjang['paymentamount'];
                        $debetPenunjang = $rowpenunjang['nominaldebet'];
                        $totalbayarPenunjang = $cashPenunjang + $debetPenunjang;
                        if ($rowpenunjang['grandtotal'] > $totalbayarPenunjang) {
                            $totalbayarPenunjang = $totalbayarPenunjang;
                        } else {
                            $totalbayarPenunjang = $rowpenunjang['grandtotal'];
                        }
                        echo number_format($totalbayarPenunjang, 2, ",", ".");
                        ?>
                        <?php $TotincomePenunjang[] = $totalbayarPenunjang;  ?></td>

                    <td><?php $cashPenunjang = $rowpenunjang['paymentamount'];
                        $debetPenunjang = $rowpenunjang['nominaldebet'];
                        $totalbayarPenunjang = $cashPenunjang + $debetPenunjang;

                        if ($rowpenunjang['grandtotal'] > $totalbayarPenunjang) {
                            //$totalbayarPenunjang = $totalbayarPenunjang;
                            $sisabayarPenunjang = $rowpenunjang['grandtotal'] - $totalbayarPenunjang;
                        } else if ($totalbayarPenunjang >= $rowpenunjang['grandtotal']) {
                            //$totalbayarPenunjang = $rowpenunjang['grandtotal'];
                            $sisabayarPenunjang = 0;
                        }

                        echo number_format($sisabayarPenunjang, 2, ",", ".");
                        ?>
                        <?php $TotpiutangPenunjang[] = $sisabayarPenunjang;  ?></td>
                    <td><?= $rowpenunjang['metodepembayaran'] ?></td>
                    <td><?= $rowpenunjang['referensibank'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotsubTotalPenunjang = isset($TotSubTotalPenunjang) ? array_sum($TotSubTotalPenunjang) : 0;
                                                    $TotalsubTotalPenunjang = $check_TotsubTotalPenunjang;
                                                    echo number_format($TotalsubTotalPenunjang, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-dark"><?php
                                                    $check_TotdiscountPenunjang = isset($TotdiscountPenunjang) ? array_sum($TotdiscountPenunjang) : 0;
                                                    $TotaldiscountPenunjang = $check_TotdiscountPenunjang;
                                                    echo number_format($TotaldiscountPenunjang, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotbiayaPenunjang = isset($TotbiayaPenunjang) ? array_sum($TotbiayaPenunjang) : 0;
                                                    $TotalbiayaPenunjang = $check_TotbiayaPenunjang;
                                                    echo number_format($TotalbiayaPenunjang, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $check_TotincomePenunjang = isset($TotincomePenunjang) ? array_sum($TotincomePenunjang) : 0;
                                                        $TotalincomePenunjang = $check_TotincomePenunjang;
                                                        echo number_format($TotalincomePenunjang, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-warning"><?php
                                                        $check_TotpiutangPenunjang = isset($TotpiutangPenunjang) ? array_sum($TotpiutangPenunjang) : 0;
                                                        $TotalpiutangPenunjang = $check_TotpiutangPenunjang;
                                                        echo number_format($TotalpiutangPenunjang, 2, ",", "."); ?></span></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    <table style="border-collapse: collapse; width: 100%;" border="1" class="tablesaw table-bordered table-hover table no-wrap">
        <tbody>
            <tr>
                <td style="width: 87.1679%; text-align: right;"><b>Total Biaya</b></td>
                <?php $biayaseluruh = $TotalsubTotalRajal + $TotalsubTotalIgd + $TotalsubTotalRanap + $TotalsubTotalPenunjang; ?>
                <td style="width: 12.8321%; text-align: right;"><b><?php echo number_format($biayaseluruh, 2, ",", "."); ?></b></td>
            </tr>
            <tr>
                <td style="width: 87.1679%; text-align: right;"><b>Total Tagihan</b></td>
                <?php $tagihanseluruh = $TotalbiayaRajal + $TotalbiayaIgd + $TotalbiayaRanap + $TotalbiayaPenunjang; ?>
                <td style="width: 12.8321%; text-align: right;"><b><?php echo number_format($tagihanseluruh, 2, ",", "."); ?></b></td>
            </tr>
            <tr>
                <td style="width: 87.1679%; text-align: right;"><b>Total Penerimaan</b></td>
                <?php $incomeseluruh = $TotalincomeRajal + $TotalincomeIgd + $TotalincomeRanap + $TotalincomePenunjang; ?>
                <td style="width: 12.8321%; text-align: right;"><b><?php echo number_format($incomeseluruh, 2, ",", "."); ?></b></td>
            </tr>
            <tr>
                <td style="width: 87.1679%; text-align: right;"><b>Total Piutang</b></td>
                <?php $piutangseluruh = $TotalhutangRajal + $TotalpiutangIgd + $TotalpiutangRanap + $TotalpiutangPenunjang; ?>
                <td style="width: 12.8321%; text-align: right;"><b><?php echo number_format($piutangseluruh, 2, ",", "."); ?></b></td>
            </tr>
        </tbody>
    </table>


    <table style="border-collapse: collapse; width: 100%;" border="0">
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
        <tbody>
            <tr>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 33.3334%;" colspan="2">&nbsp;</td>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 33.3334%; text-align: center;" colspan="2">Kuningan, <?php echo tgl_indo($tanggal); ?></td>
            </tr>
            <tr>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 33.3334%; text-align: center;" colspan="2">Bendahara Penerimaan</td>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 33.3334%; text-align: center;" colspan="2">Kasir</td>
            </tr>
            <tr>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 16.6667%;">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 16.6667%; text-align: center;" colspan="2">........................................</td>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 16.6667%; text-align: center;" colspan="2">........................................</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="pull-right mt-1 text-left">
            <button id="btnPrint" type="button" class="btn btn-default btn-outline"><span><i class="fa fa-print"></i> Print</span></button>
        </div>
    </div>
</div>



<script type="text/javascript">
    document.getElementById("btnPrint").onclick = function() {

        printElement(document.getElementById("printThis"));

    };

    function printElement(elem) {
        var domClone = elem.cloneNode(true);
        var $printSection = document.getElementById("printSection");
        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }
        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
    }
</script>
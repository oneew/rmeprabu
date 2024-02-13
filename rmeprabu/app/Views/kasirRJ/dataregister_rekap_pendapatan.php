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
    <table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th class="text-info">Kasir Rawat Jalan</th>
            </tr>
            <tr>
                <th style="width: 1%;">No</th>
                <th>TglValidasiKasir</th>
                <th>Tagihan</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td style="width: 1%;"><?= $no ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><?= number_format($row['jumlahtagihan'], 2, ",", "."); ?> <?php $TotSubTotalTagihan[] = $row['jumlahtagihan'];  ?></td>
                    <td><?= number_format($row['jumlahbayar'], 2, ",", "."); ?> <?php $TotSubTotalBayar[] = $row['jumlahbayar'];  ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="1"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotsubTotal = isset($TotSubTotalTagihan) ? array_sum($TotSubTotalTagihan) : 0;
                                                    $TotalsubTotal = $check_TotsubTotal;
                                                    echo number_format($TotalsubTotal, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $check_TotsubTotalBayar = isset($TotSubTotalBayar) ? array_sum($TotSubTotalBayar) : 0;
                                                        $TotalsubTotalBayar = $check_TotsubTotalBayar;
                                                        echo number_format($TotalsubTotalBayar, 2, ",", "."); ?></span></td>
            </tr>
            <tr>
                <th class="text-info">Kasir IGD</th>
            </tr>
            <tr>
                <th style="width: 1%;">No</th>
                <th>TglValidasiKasir</th>
                <th>Tagihan</th>
                <th>Pembayaran</th>
            </tr>
            <?php $noA = 0;
            foreach ($tampildataigd as $rowigd) :
                $noA++;
            ?>
                <tr>
                    <td style="width: 1%;"><?= $noA ?></td>
                    <td><?= $rowigd['created_at'] ?></td>
                    <td><?= number_format($rowigd['jumlahtagihan'], 2, ",", "."); ?> <?php $TotSubTotalTagihanIgd[] = $rowigd['jumlahtagihan'];  ?></td>
                    <td><?= number_format($rowigd['jumlahbayar'], 2, ",", "."); ?> <?php $TotSubTotalBayarIgd[] = $rowigd['jumlahbayar'];  ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="1"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotsubTotalIgd = isset($TotSubTotalTagihanIgd) ? array_sum($TotSubTotalTagihanIgd) : 0;
                                                    $TotalsubTotalIgd = $check_TotsubTotalIgd;
                                                    echo number_format($TotalsubTotalIgd, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $check_TotsubTotalBayarIgd = isset($TotSubTotalBayarIgd) ? array_sum($TotSubTotalBayarIgd) : 0;
                                                        $TotalsubTotalBayarIgd = $check_TotsubTotalBayarIgd;
                                                        echo number_format($TotalsubTotalBayarIgd, 2, ",", "."); ?></span></td>
            </tr>
            <tr>
                <th class="text-info">Kasir Rawat Inap</th>
            </tr>
            <tr>
                <th style="width: 1%;">No</th>
                <th>TglValidasiKasir</th>
                <th>Tagihan</th>
                <th>Pembayaran</th>
            </tr>
            <?php $noB = 0;
            foreach ($tampildataranap as $rowranap) :
                $noB++;
            ?>
                <tr>
                    <td style="width: 1%;"><?= $noB ?></td>
                    <td><?= $rowigd['created_at'] ?></td>
                    <td><?= number_format($rowranap['jumlahtagihan'], 2, ",", "."); ?> <?php $TotSubTotalTagihanRanap[] = $rowranap['jumlahtagihan'];  ?></td>
                    <td><?= number_format($rowranap['jumlahbayar'], 2, ",", "."); ?> <?php $TotSubTotalBayarRanap[] = $rowranap['jumlahbayar'];  ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="1"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotsubTotalRanap = isset($TotSubTotalTagihanRanap) ? array_sum($TotSubTotalTagihanRanap) : 0;
                                                    $TotalsubTotalRanap = $check_TotsubTotalRanap;
                                                    echo number_format($TotalsubTotalRanap, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $check_TotsubTotalBayarRanap = isset($TotSubTotalBayarRanap) ? array_sum($TotSubTotalBayarRanap) : 0;
                                                        $TotalsubTotalBayarRanap = $check_TotsubTotalBayarRanap;
                                                        echo number_format($TotalsubTotalBayarRanap, 2, ",", "."); ?></span></td>
            </tr>
            <tr>
                <th class="text-info">Kasir Penunjang</th>
            </tr>
            <tr>
                <th style="width: 1%;">No</th>
                <th>TglValidasiKasir</th>
                <th>Tagihan</th>
                <th>Pembayaran</th>
            </tr>
            <?php $noB = 0;
            foreach ($tampildatapenunjang as $rowpenunjang) :
                $noB++;
            ?>
                <tr>
                    <td style="width: 1%;"><?= $noB ?></td>
                    <td><?= $rowpenunjang['created_at'] ?></td>
                    <td><?= number_format($rowpenunjang['jumlahtagihan'], 2, ",", "."); ?> <?php $TotSubTotalTagihanPenunjang[] = $rowpenunjang['jumlahtagihan'];  ?></td>
                    <td><?php echo number_format($rowpenunjang['jumlahbayar'], 2, ",", "."); ?> <?php $TotSubTotalBayarPenunjang[] = $rowpenunjang['jumlahbayar'];  ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="1"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotsubTotalPenunjang = isset($TotSubTotalTagihanPenunjang) ? array_sum($TotSubTotalTagihanPenunjang) : 0;
                                                    $TotalsubTotalPenunjang = $check_TotsubTotalPenunjang;
                                                    echo number_format($TotalsubTotalPenunjang, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $check_TotsubTotalBayarPenunjang = isset($TotSubTotalBayarPenunjang) ? array_sum($TotSubTotalBayarPenunjang) : 0;
                                                        $TotalsubTotalBayarPenunjang = $check_TotsubTotalBayarPenunjang;
                                                        echo number_format($TotalsubTotalBayarPenunjang, 2, ",", "."); ?></span></td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td>TOTAL PENDAPATAN</td>
                <td><span class="badge badge-info"><?php
                                                    $TotalTagihan = $TotalsubTotal + $TotalsubTotalIgd + $TotalsubTotalRanap + $TotalsubTotalPenunjang;
                                                    echo number_format($TotalTagihan, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $TotalPendapatan = $TotalsubTotalBayar + $TotalsubTotalBayarIgd + $TotalsubTotalBayarRanap + $TotalsubTotalBayarPenunjang;
                                                        echo number_format($TotalPendapatan, 2, ",", "."); ?></span></td>
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
                <td style="width: 33.3334%; text-align: center;" colspan="2">Kasir Rawat Jalan</td>
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
<!DOCTYPE html>

<head>
    <!-- <link href="../assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <!-- <link href="../assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet"> -->
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
                font-size: 14px;
            }
        }
    </style>

</head>

<body>
    <!-- <div id="printThis"> -->
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
    <!-- <table id="registerrajal" class="tablesaw table-bordered table-hover table no-wrap"> -->
    <table id="registerrajal" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th colspan="14" class="text-info"><b>Penerimaan Kasir Rawat Jalan llllll</b></th>
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
                <!-- <td colspan="6"></td> -->
                <td><?= $no ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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
                <td></td>
                <td></td>
                <!-- <td colspan="2"></td> -->
            </tr>



        </tbody>
    </table>

    <!-- </div>

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right mt-1 text-left">
                <button id="btnPrint" type="button" class="btn btn-default btn-outline"><span><i class="fa fa-print"></i> Print</span></button>
            </div>
        </div>
    </div> -->

</body>

</html>

<script>
    $('#registerrajal').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        scrollY: '300px',
        columnDefs: [{
                responsivePriority: 3,
                targets: 0
            },
            {
                responsivePriority: 2,
                targets: -1
            }
        ],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    })
</script>

<!-- <script type="text/javascript">
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
</script> -->
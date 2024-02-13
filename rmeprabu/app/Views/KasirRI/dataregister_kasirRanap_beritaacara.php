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
                <th>No</th>
                <th>TglValidasiKasir</th>
                <th>NoRm</th>
                <th>NamaPasien</th>
                <th>CaraBayar</th>
                <th>AsalPasien</th>
                <th>Dokter</th>
                <th>Status</th>
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
            foreach ($tampildata as $row) :
                $no++;


            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['paymentmethodname'] ?></td>
                    <td><?= $row['roomname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><span class="<?php if ($row['grandtotal'] > $row['paymentamount']) {
                                            echo "badge badge-danger";
                                            $kes = "Piutang";
                                        } else {
                                            echo "badge badge-success";
                                            $kes = "Lunas";
                                        }  ?>"><?= $kes ?></span></td>
                    <td><?= number_format($row['grandtotal'], 2, ",", "."); ?> <?php $TotSubTotal[] = $row['grandtotal'];  ?></td>
                    <td><?= number_format($row['discount'], 2, ",", "."); ?> <?php $Totdiscount[] = $row['discount'];  ?></td>
                    <td><?= number_format($row['grandtotal'], 2, ",", "."); ?> <?php $Totbiaya[] = $row['grandtotal'];  ?></td>
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
                        <?php $Totincome[] = $totalbayar;  ?></td>

                    <td><?php $cash = $row['paymentamount'];
                        $debet = $row['nominaldebet'];
                        $totalbayar = $cash + $debet;
                        if ($row['grandtotal'] > $totalbayar) {
                            $totalbayar = $totalbayar;
                            $sisabayar = $row['grandtotal'] - $totalbayar;
                        } else {
                            $totalbayar = $row['grandtotal'];
                            $sisabayar = 0;
                        }

                        echo number_format($sisabayar, 2, ",", ".");
                        ?>
                        <?php $Totpiutang[] = $sisabayar;  ?></td>
                    <td><?= $row['metodepembayaran'] ?></td>
                    <td><?= $row['referensibank'] ?></td>

                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="7"></td>
                <td>TOTAL</td>
                <td><span class="badge badge-info"><?php
                                                    $check_TotsubTotal = isset($TotSubTotal) ? array_sum($TotSubTotal) : 0;
                                                    $TotalsubTotal = $check_TotsubTotal;
                                                    echo number_format($TotalsubTotal, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-dark"><?php
                                                    $check_Totdiscount = isset($Totdiscount) ? array_sum($Totdiscount) : 0;
                                                    $Totaldiscount = $check_Totdiscount;
                                                    echo number_format($Totaldiscount, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-info"><?php
                                                    $check_Totbiaya = isset($Totbiaya) ? array_sum($Totbiaya) : 0;
                                                    $Totalbiaya = $check_Totbiaya;
                                                    echo number_format($Totalbiaya, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-success"><?php
                                                        $check_Totincome = isset($Totincome) ? array_sum($Totincome) : 0;
                                                        $Totalincome = $check_Totincome;
                                                        echo number_format($Totalincome, 2, ",", "."); ?></span></td>
                <td><span class="badge badge-warning"><?php
                                                        $check_Totpiutang = isset($Totpiutang) ? array_sum($Totpiutang) : 0;
                                                        $Totalpiutang = $check_Totpiutang;
                                                        echo number_format($Totalpiutang, 2, ",", "."); ?></span></td>
                <td colspan="2"></td>

            </tr>
        </tfoot>
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
                <td style="width: 33.3334%; text-align: center;" colspan="2">Sukabumi, <?php echo tgl_indo($tanggal); ?></td>
            </tr>
            <tr>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 33.3334%; text-align: center;" colspan="2">Bendahara Penerimaan</td>
                <td style="width: 16.6667%;">&nbsp;</td>
                <td style="width: 33.3334%; text-align: center;" colspan="2">Kasir Rawat Inap</td>
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
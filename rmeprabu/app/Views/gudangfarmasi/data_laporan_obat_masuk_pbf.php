<head>
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
            <h3> &nbsp;<b class="text-info">PEMERINTAH KOTA SUKABUMI</b></h3>
            <p class="text-info">UOBK RSUD R SYAMSUDIN, SH

                <br /> INSTALASI FARMASI
                <br />
            <h5> LAPORAN PENERIMAAN BARANG </h5>
            </p>
        </address>
    </div>
    <button id="btnPrint" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
    </br>

    <table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>

                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Jenis</th>
                <th>Tanggal Terima</th>
                <th>Tanggal Faktur</th>
                <th>Supplier</th>
                <th>No. Invoice</th>
                <th>No. Batch</th>
                <th>Exp. Date</th>
                <th>Jml Box</th>
                <th>Isi/Box</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Harga/Box</th>
                <th>Harga@</th>
                <th>PPN</th>
                <th>Diskon</th>
                <th>Total</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['types'] ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['invoicedate'] ?></td>
                    <td><?= $row['relationname'] ?></td>
                    <td><?= $row['referencenumber'] ?></td>
                    <td><?= $row['batchnumber'] ?></td>
                    <td><?= $row['expireddate'] ?></td>
                    <td><?= $row['qtybox'] ?></td>
                    <td><?= $row['volume'] ?></td>
                    <td><?= $row['qty'] ?></td>
                    <td><?= $row['uom'] ?></td>
                    <td style="text-align: right;"><?= number_format($row['price'], 2, ",", "."); ?></td>
                    <td style="text-align: center;"><?= number_format($row['purchaseprice'], 2, ",", "."); ?></td>
                    <td style="text-align: center;"><?= number_format($row['taxamount'], 2, ",", "."); ?></td>
                    <td style="text-align: center;"><?= number_format($row['totaldiscount'], 2, ",", "."); ?></td>
                    <td style="text-align: center;"><?php $subtotal = ($row['subtotal'] - $row['totaldiscount']) + $row['taxamount'];
                                                    echo number_format($subtotal, 2, ",", "."); ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
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
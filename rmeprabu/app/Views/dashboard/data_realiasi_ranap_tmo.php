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

                <br /> JASA PELAYANAN
                <br />
            <h5> LAPORAN REALISASI PASIEN JKN </h5>
            </p>
        </address>
    </div>
    <button id="btnPrint" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
    </br>

    <table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>

                <th>No</th>
                <th>Nama Dokter</th>
                <th>Total Realcost</th>
                <th>Total Realisasi</th>
                <th>JML Kasus</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td style="text-align: right;"><?= number_format($row['realcost'], 2, ",", "."); ?></td>
                    <td style="text-align: center;"><?= number_format($row['realisasi'], 2, ",", "."); ?></td>
                    <td><?= $row['jumlah'] ?></td>
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
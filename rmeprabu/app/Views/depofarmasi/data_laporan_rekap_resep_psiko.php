<head>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
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
            <h4> INSTALASI FARMASI</h4>
            <h5> LAPORAN REKAP PEMAKAIAN PSIKOTROPIKA PER-PASIEN DI <?= $lokasi; ?></h5>
            </p>
        </address>
    </div>
    <table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>

                <th>No</th>
                <th>NO. RM</th>
                <th>NAME PASIEN</th>
                <th>ALAMAT PASIEN</th>
                <th>KODE</th>
                <th>NAMA OBAT</th>
                <th>NO. RESEP</th>
                <th>LOKASI</th>
                <th>DOKTER</th>
                <th>JUMLAH</th>
                <th>SATUAN</th>
                <th>TOTAL Rp.</th>
                <th>TANGGAL</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['relation'] ?></td>
                    <td><?= $row['relationname'] ?></td>
                    <td><?= $row['pasienaddress'] ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['locationname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['uom'] ?></td>
                    <td><?= number_format($row['total'], 2, ",", ".");
                        ?></td>
                    <td><?= $row['documentdate'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>


<div class="row">
    <div class="col-md-12">
        <div class="pull-right mt-1 text-left">
            <button id="btnPrint" type="button" class="btn btn-info btn-outline"><span><i class="fa fa-print"></i> Print</span></button>
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
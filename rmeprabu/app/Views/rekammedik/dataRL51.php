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

            @page {
                size: A4 landscape;
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
                font-size: 20px;
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
            <h4> <?= $kelompok; ?></h4>
            <h5> <?= $deskripsi; ?></h5>
            </p>
        </address>
    </div>
    <table id="diagnosa" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kegiatan Pelayanan Rawat Jalan</th>
                <th class="text-center"><span class="badge badge-pill badge-warning">Jumlah</span></th>
            </tr>
        </thead>
        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?php if ($row['lamabaru'] == "L") {
                            echo "Pasien Lama";
                        } else {
                            echo "Pasien Baru";
                        } ?></td>
                    <td class="text-center"><?= $row['jumlah'] ?></td>
                    <?php $TotKasus[] = $row['jumlah']; ?>
                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <?php
            $check_Total = isset($TotKasus) ? array_sum($TotKasus) : 0;
            $TotalKasus = $check_Total;

            ?>
            <tr>
                <td class="text-right" colspan="2">Total</td>
                <td class="text-center"><b><?= $TotalKasus; ?></b></td>
            </tr>
        </tfoot>
    </table>
    <table id="diagnosa2" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kegiatan Pelayanan IGD</th>
                <th class="text-center"><span class="badge badge-pill badge-warning">Jumlah</span></th>
            </tr>
        </thead>
        <tbody>

            <?php $noIGD = 0;
            foreach ($tampildataIGD as $rowIGD) :
                $noIGD++;
            ?>
                <tr>
                    <td class="text-center"><?= $noIGD ?></td>
                    <td><?php if ($rowIGD['lamabaru'] == "L") {
                            echo "Pasien Lama";
                        } else {
                            echo "Pasien Baru";
                        } ?></td>
                    <td class="text-center"><?= $rowIGD['jumlah'] ?></td>
                    <?php $TotKasusIGD[] = $rowIGD['jumlah']; ?>
                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <?php
            $check_TotalIGD = isset($TotKasusIGD) ? array_sum($TotKasusIGD) : 0;
            $TotalKasusIGD = $check_TotalIGD;

            ?>
            <tr>
                <td class="text-right" colspan="2">Total</td>
                <td class="text-center"><b><?= $TotalKasusIGD; ?></b></td>
            </tr>
        </tfoot>
    </table>
    <table id="diagnosa3" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Kegiatan Pelayanan Rawat Inap</th>
                <th class="text-center"><span class="badge badge-pill badge-warning">Jumlah</span></th>
            </tr>
        </thead>
        <tbody>

            <?php $noRI = 0;
            foreach ($tampildataRanap as $rowRI) :
                $noRI++;
            ?>
                <tr>
                    <td class="text-center"><?= $noRI ?></td>
                    <td><?php if ($rowRI['lamabaru'] == "L") {
                            echo "Pasien Lama";
                        } else {
                            echo "Pasien Baru";
                        } ?></td>
                    <td class="text-center"><?= $rowRI['jumlah'] ?></td>
                    <?php $TotKasusRI[] = $rowRI['jumlah']; ?>
                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <?php
            $check_TotalRI = isset($TotKasusRI) ? array_sum($TotKasusRI) : 0;
            $TotalKasusRI = $check_TotalRI;

            ?>
            <tr>
                <td class="text-right" colspan="2">Total</td>
                <td class="text-center"><b><?= $TotalKasusRI; ?></b></td>
            </tr>
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

<script>
    $('#diagnosa').DataTable({
        dom: 'Bfrtip',
        responsive: true,
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
    $('#diagnosa2').DataTable({
        dom: 'Bfrtip',
        responsive: true,
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
    $('#diagnosa3').DataTable({
        dom: 'Bfrtip',
        responsive: true,
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
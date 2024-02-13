<head>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
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
    <table id="diagnosa1" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">SMF</th>
                <th class="text-center"><span class="badge badge-pill badge-success">KECIL</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">SEDANG</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">BESAR</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">KHUSUS</span></th>
                <th class="text-center"><span class="badge badge-pill badge-danger">KHUSUS I</span></th>
                <th class="text-center"><span class="badge badge-pill badge-danger">KHUSUS II</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">KHUSUS III</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">KHUSUS IV</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">TOTAL</span></th>
            </tr>
        </thead>
        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $row['smfname'] ?></td>
                    <td class="text-center"><?= $row['kecil'] ?></td>
                    <td class="text-center"><?= $row['sedang'] ?></td>
                    <td class="text-center"><?= $row['besar'] ?></td>
                    <td class="text-center"><?= $row['khusus'] ?></td>
                    <td class="text-center"><?= $row['khusus1'] ?></td>
                    <td class="text-center"><?= $row['khusus2'] ?></td>
                    <td class="text-center"><?= $row['khusus3'] ?></td>
                    <td class="text-center"><?= $row['khusus4'] ?></td>
                    <td class="text-center"><?php $Totkelas = $row['kecil'] + $row['sedang'] + $row['besar'] + $row['khusus'] + $row['khusus1'] + $row['khusus2'] + $row['khusus3'] + $row['khusus4'];
                                            echo $Totkelas;
                                            $TotalKelas[] = $Totkelas;
                                            ?></td>

                    <?php
                    $Totkasuskecil[] = $row['kecil'];
                    $Totkasussedang[] = $row['sedang'];
                    $Totkasusbesar[] = $row['besar'];
                    $Totkasuskhusus[] = $row['khusus'];
                    $Totkasuskhusus1[] = $row['khusus1'];
                    $Totkasuskhusus2[] = $row['khusus2'];
                    $Totkasuskhusus3[] = $row['khusus3'];
                    $Totkasuskhusus4[] = $row['khusus4'];
                    ?>
                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <?php
            $check_Totkelas = isset($TotalKelas) ? array_sum($TotalKelas) : 0;
            $Totalkelassemua = $check_Totkelas;
            $check_TotKasuskecil = isset($Totkasuskecil) ? array_sum($Totkasuskecil) : 0;
            $TotalKasuskecil = $check_TotKasuskecil;
            $check_TotKasussedang = isset($Totkasussedang) ? array_sum($Totkasussedang) : 0;
            $TotalKasussedang = $check_TotKasussedang;
            $check_TotKasusbesar = isset($Totkasusbesar) ? array_sum($Totkasusbesar) : 0;
            $TotalKasusbesar = $check_TotKasusbesar;
            $check_TotKasuskhusus = isset($Totkasuskhusus) ? array_sum($Totkasuskhusus) : 0;
            $TotalKasuskhusus = $check_TotKasuskhusus;
            $check_TotKasuskhusus1 = isset($Totkasuskhusus1) ? array_sum($Totkasuskhusus1) : 0;
            $TotalKasuskhusus1 = $check_TotKasuskhusus1;
            $check_TotKasuskhusus2 = isset($Totkasuskhusus2) ? array_sum($Totkasuskhusus2) : 0;
            $TotalKasuskhusus2 = $check_TotKasuskhusus2;
            $check_TotKasuskhusus3 = isset($Totkasuskhusus3) ? array_sum($Totkasuskhusus3) : 0;
            $TotalKasuskhusus3 = $check_TotKasuskhusus3;
            $check_TotKasuskhusus4 = isset($Totkasuskhusus4) ? array_sum($Totkasuskhusus4) : 0;
            $TotalKasuskhusus4 = $check_TotKasuskhusus4;


            ?>
            <tr>
                <td class="text-right" colspan="2">Total</td>
                <td class="text-center"><b><?= $TotalKasuskecil; ?></b></td>
                <td class="text-center"><b><?= $TotalKasussedang; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusbesar; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskhusus; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskhusus1; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskhusus2; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskhusus3; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskhusus4; ?></b></td>
                <td class="text-center"><b><?= $Totalkelassemua; ?></b></td>
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
</script>
<head>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">

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
                <th class="text-center">TINDAKAN</th>
                <th class="text-center"><span class="badge badge-pill badge-success">KELAS 1</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">KELAS 2</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">KELAS 3</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">HCU</span></th>
                <th class="text-center"><span class="badge badge-pill badge-danger">ISOLASI</span></th>
                <th class="text-center"><span class="badge badge-pill badge-danger">INTENSIF</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">PERINATOLOGI</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">OCD RJ</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">KELAS UTAMA I</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">KELAS UTAMA II</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">KELAS VIP I</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">KELAS VIP II</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">KELAS VIP III</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">KELAS SUITE ROOM</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">PRESIDENT SUITE ROOM</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">VVIP</span></th>
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
                    <td><?= $row['name'] ?></td>
                    <td class="text-center"><?= $row['kls1'] ?></td>
                    <td class="text-center"><?= $row['kls2'] ?></td>
                    <td class="text-center"><?= $row['kls3'] ?></td>
                    <td class="text-center"><?= $row['hcu'] ?></td>
                    <td class="text-center"><?= $row['isolasi'] ?></td>
                    <td class="text-center"><?= $row['intensif'] ?></td>
                    <td class="text-center"><?= $row['perinatologi'] ?></td>
                    <td class="text-center"><?= $row['odcrj'] ?></td>
                    <td class="text-center"><?= $row['utama1'] ?></td>
                    <td class="text-center"><?= $row['utama2'] ?></td>
                    <td class="text-center"><?= $row['vip1'] ?></td>
                    <td class="text-center"><?= $row['vip2'] ?></td>
                    <td class="text-center"><?= $row['vip3'] ?></td>
                    <td class="text-center"><?= $row['sr'] ?></td>
                    <td class="text-center"><?= $row['psr'] ?></td>
                    <td class="text-center"><?= $row['vvip'] ?></td>
                    <td class="text-center"><?php $Totkelas = $row['kls1'] + $row['kls2'] + $row['kls3'] + $row['hcu'] + $row['intensif'] + $row['perinatologi'] + $row['odcrj'] + $row['utama1'] + $row['utama2'] + $row['vip1'] + $row['vip2'] + $row['vip3'] + $row['sr'] + $row['psr'] + $row['vvip'];
                                            echo $Totkelas;
                                            $TotalKelas[] = $Totkelas;
                                            ?></td>

                    <?php
                    $Totkasuskls1[] = $row['kls1'];
                    $Totkasuskls2[] = $row['kls2'];
                    $Totkasuskls3[] = $row['kls3'];
                    $Totkasushcu[] = $row['hcu'];
                    $Totkasusisolasi[] = $row['isolasi'];
                    $Totkasusintensif[] = $row['intensif'];
                    $Totkasusperinatologi[] = $row['perinatologi'];
                    $Totkasusodcrj[] = $row['odcrj'];
                    $Totkasusutama1[] = $row['utama1'];
                    $Totkasusutama2[] = $row['utama2'];
                    $Totkasusvip1[] = $row['vip1'];
                    $Totkasusvip2[] = $row['vip2'];
                    $Totkasusvip3[] = $row['vip3'];
                    $Totkasussr[] = $row['sr'];
                    $Totkasuspsr[] = $row['psr'];
                    $Totkasusvvip[] = $row['vvip'];
                    ?>
                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <?php
            $check_Totkelas = isset($TotalKelas) ? array_sum($TotalKelas) : 0;
            $Totalkelassemua = $check_Totkelas;
            $check_TotKasuskls1 = isset($Totkasuskls1) ? array_sum($Totkasuskls1) : 0;
            $TotalKasuskls1 = $check_TotKasuskls1;
            $check_TotKasuskls2 = isset($Totkasuskls2) ? array_sum($Totkasuskls2) : 0;
            $TotalKasuskls2 = $check_TotKasuskls2;
            $check_TotKasuskls3 = isset($Totkasuskls3) ? array_sum($Totkasuskls3) : 0;
            $TotalKasuskls3 = $check_TotKasuskls3;
            $check_TotKasushcu = isset($Totkasushcu) ? array_sum($Totkasushcu) : 0;
            $TotalKasushcu = $check_TotKasushcu;
            $check_TotKasusisolasi = isset($Totkasusisolasi) ? array_sum($Totkasusisolasi) : 0;
            $TotalKasusisolasi = $check_TotKasusisolasi;
            $check_TotKasusintensif = isset($Totkasusintensif) ? array_sum($Totkasusintensif) : 0;
            $TotalKasusintensif = $check_TotKasusintensif;
            $check_TotKasusperinatologi = isset($Totkasusperinatologi) ? array_sum($Totkasusperinatologi) : 0;
            $TotalKasusperinatologi = $check_TotKasusperinatologi;
            $check_TotKasusodcrj = isset($Totkasusodcrj) ? array_sum($Totkasusodcrj) : 0;
            $TotalKasusodcrj = $check_TotKasusodcrj;
            $check_TotKasusutama1 = isset($Totkasusutama1) ? array_sum($Totkasusutama1) : 0;
            $TotalKasusutama1 = $check_TotKasusutama1;
            $check_TotKasusutama2 = isset($Totkasusutama2) ? array_sum($Totkasusutama2) : 0;
            $TotalKasusutama2 = $check_TotKasusutama2;
            $check_TotKasusvip1 = isset($Totkasusvip1) ? array_sum($Totkasusvip1) : 0;
            $TotalKasusvip1 = $check_TotKasusvip1;
            $check_TotKasusvip2 = isset($Totkasusvip2) ? array_sum($Totkasusvip2) : 0;
            $TotalKasusvip2 = $check_TotKasusvip2;
            $check_TotKasusvip3 = isset($Totkasusvip3) ? array_sum($Totkasusvip3) : 0;
            $TotalKasusvip3 = $check_TotKasusvip3;
            $check_TotKasussr = isset($Totkasussr) ? array_sum($Totkasussr) : 0;
            $TotalKasussr = $check_TotKasussr;
            $check_TotKasuspsr = isset($Totkasuspsr) ? array_sum($Totkasuspsr) : 0;
            $TotalKasuspsr = $check_TotKasuspsr;
            $check_TotKasusvvip = isset($Totkasusvvip) ? array_sum($Totkasusvvip) : 0;
            $TotalKasusvvip = $check_TotKasusvvip;

            ?>
            <tr>
                <td class="text-right" colspan="2">Total Tindakan</td>
                <td class="text-center"><b><?= $TotalKasuskls1; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskls2; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskls3; ?></b></td>
                <td class="text-center"><b><?= $TotalKasushcu; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusisolasi; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusintensif; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusperinatologi; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusodcrj; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusutama1; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusutama2; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusvip1; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusvip2; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusvip3; ?></b></td>
                <td class="text-center"><b><?= $TotalKasussr; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuspsr; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusvvip; ?></b></td>
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
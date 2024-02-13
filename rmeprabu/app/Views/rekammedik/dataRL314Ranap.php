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
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center" colspan="6"><span class="badge badge-pill badge-success">RUJUKAN</span></th>
                <th class="text-center" colspan="3"><span class="badge badge-pill badge-success">DIRUJUK</span></th>
            </tr>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">JENIS SPESIALISASI</th>
                <th class="text-center"><span class="badge badge-pill badge-success">DITERIMA DARI PUSKESMAS</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">DITERIMA DARI FASKES LAIN</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">DITERIMA DARI RS LAIN</span>
                </th>
                <th class="text-center"><span class="badge badge-pill badge-warning">DIKEMBALIKAN KE PUSKESMAS</span>
                </th>
                <th class="text-center"><span class="badge badge-pill badge-warning">DIKEMBALIKAN KE FASKES LAIN</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">DIKEMBALIKAN KE RS ASAL</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">PASIEN RUJUKAN</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">PASIEN DATANG SENDIRI</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">DITERIMA KEMBALI</span></th>
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
                    <td class="text-center"><?= $row['puskesmas'];
                                            $TotPuskesmas[] = $row['puskesmas']; ?></td>
                    <td class="text-center"><?php $faskeslain = $row['bp'] + $row['dokter'];
                                            echo $faskeslain;
                                            $TotFaskesLain[] = $faskeslain; ?></td>
                    <td class="text-center"><?= $row['rslain'];
                                            $TotRsLain[] = $row['rslain']; ?></td>
                    <td class="text-center"><?php $kembalipuskesmas = 0;
                                            echo $kembalipuskesmas;
                                            $TotKembaliPuskesmas[] = $kembalipuskesmas; ?></td>
                    <td class="text-center"><?php $kembalifaskes = 0;
                                            echo $kembalifaskes;
                                            $TotKembaliFaskes[] = $kembalifaskes; ?></td>
                    <td class="text-center"><?= $row['rujukbalik'];
                                            $TotRujukBalik[] = $row['rujukbalik']; ?></td>
                    <td class="text-center"><?php $ke_rslain = $row['rujukkerslain'] + $row['pindahkerslain'];
                                            echo $ke_rslain;
                                            $TotKeRsLain[] = $ke_rslain; ?></td>
                    <td class="text-center"><?= $row['datang'];
                                            $TotDatangSendiri[] = $row['datang']; ?></td>
                    <td class="text-center"><?php $kembaliditerima = 0;
                                            echo $kembaliditerima;
                                            $TotKembaliDiterima[] = $kembaliditerima; ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <?php
            $check_TotPuskesmas = isset($TotPuskesmas) ? array_sum($TotPuskesmas) : 0;
            $TotalPuskesmas = $check_TotPuskesmas;
            $check_TotFaskesLain = isset($TotFaskesLain) ? array_sum($TotFaskesLain) : 0;
            $TotalFaskesLain = $check_TotFaskesLain;
            $check_TotRsLain = isset($TotRsLain) ? array_sum($TotRsLain) : 0;
            $TotalRsLain = $check_TotRsLain;
            $check_TotKembaliPuskesmas = isset($TotKembaliPuskesmas) ? array_sum($TotKembaliPuskesmas) : 0;
            $TotalKembaliPuskesmas = $check_TotKembaliPuskesmas;
            $check_TotKembaliFaskes = isset($TotKembaliFaskes) ? array_sum($TotKembaliFaskes) : 0;
            $TotalKembaliFaskes = $check_TotKembaliFaskes;
            $check_TotRujukBalik = isset($TotRujukBalik) ? array_sum($TotRujukBalik) : 0;
            $TotalRujukBalik = $check_TotRujukBalik;
            $check_TotKeRsLain = isset($TotKeRsLain) ? array_sum($TotKeRsLain) : 0;
            $TotalKeRsLain = $check_TotKeRsLain;
            $check_TotDatangSendiri = isset($TotDatangSendiri) ? array_sum($TotDatangSendiri) : 0;
            $TotalDatangSendiri = $check_TotDatangSendiri;
            $check_TotKembaliDiterima = isset($TotKembaliDiterima) ? array_sum($TotKembaliDiterima) : 0;
            $TotalKembaliDiterima = $check_TotKembaliDiterima;

            ?>

            <tr>
                <td class="text-right" colspan="2">Total Pasien</td>
                <td class="text-center"><b><?= $TotalPuskesmas; ?></b></td>
                <td class="text-center"><b><?= $TotalFaskesLain; ?></b>
                </td>
                <td class="text-center"><b><?= $TotalRsLain; ?></b>
                </td>
                <td class="text-center"><b><?= $TotalKembaliPuskesmas; ?></b>
                </td>
                <td class="text-center"><b><?= $TotalKembaliFaskes; ?></b>
                </td>
                <td class="text-center"><b><?= $TotalRujukBalik; ?></b>
                </td>
                <td class="text-center"><b><?= $TotalKeRsLain; ?></b>
                </td>
                <td class="text-center"><b><?= $TotalDatangSendiri; ?></b>
                </td>
                <td class="text-center"><b><?= $TotalKembaliDiterima; ?></b>
                </td>
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
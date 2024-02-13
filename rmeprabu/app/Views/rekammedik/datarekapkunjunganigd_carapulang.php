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
                <th class="text-center"><span class="badge badge-pill badge-success">DIRAWAT</span></th>
                <th class="text-center" colspan="4"><span class="badge badge-pill badge-danger">MENINGGAL</span></th>

                <th class="text-center" colspan="3"><span class="badge badge-pill badge-success">PULANG</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">KONSUL KLINIK</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">RUJUK BALIK</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">RUJUK KE RS LAIN</span></th>
                <th class="text-center"><span class="badge badge-pill badge-danger">KABUR</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">BELUM VALIDASI</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">TOTAL</span></th>
            </tr>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">POLIKLINIK</th>
                <th class="text-center"><span class="badge badge-pill badge-success">DIRAWAT</span></th>
                <th class="text-center"><span class="badge badge-pill badge-danger">DOA</span></th>
                <th class="text-center"><span class="badge badge-pill badge-danger">MENINGGAL < 8 JAM</span>
                </th>
                <th class="text-center"><span class="badge badge-pill badge-danger">MENINGGAL < 48 JAM</span>
                </th>
                <th class="text-center"><span class="badge badge-pill badge-danger">MENINGGAL > 48 JAM</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">PULANG (BEROBAT JALAN)</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">PULANG APS</span></th>
                <th class="text-center"><span class="badge badge-pill badge-success">PULANG (SEMBUH)</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">KONSUL KLINIK</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">RUJUK BALIK</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">RUJUK KE RS LAIN</span></th>
                <th class="text-center"><span class="badge badge-pill badge-danger">KABUR</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">BELUM VALIDASI</span></th>
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
                    <td><?= $row['poliklinikname'] ?></td>
                    <td class="text-center"><?php $dirawat = $row['dirawat'] + $row['dirawataps'];
                                            echo $dirawat; ?></td>
                    <td class="text-center"><?= $row['doa'] ?></td>
                    <td class="text-center"><?= $row['meninggalkurang8'] ?></td>
                    <td class="text-center"><?= $row['meninggalkurang48'] ?></td>
                    <td class="text-center"><?= $row['meninggallebih48'] ?></td>
                    <td class="text-center"><?= $row['pulangberobat'] ?></td>
                    <td class="text-center"><?= $row['pulangaps'] ?></td>
                    <td class="text-center"><?= $row['pulangsembuh'] ?></td>
                    <td class="text-center"><?= $row['konsulklinik'] ?></td>
                    <td class="text-center"><?= $row['rujukbalik'] ?></td>
                    <td class="text-center"><?= $pindah = $row['rujukrslain'] + $row['pindahrslain']; ?></td>
                    <td class="text-center"><?= $row['kabur'] ?></td>
                    <td class="text-center"><?= $row['registrasi'] ?></td>
                    <td class="text-center"><?php $total = $dirawat + $row['doa'] + $row['meninggalkurang8'] + $row['meninggalkurang48'] + $row['meninggallebih48'] + $row['pulangberobat'] +
                                                $row['pulangaps'] + $row['pulangsembuh'] + $row['konsulklinik'] + $row['rujukbalik'] + $pindah + $row['kabur'] + $row['registrasi'];
                                            echo $total;
                                            $TotKasus[] = $total;
                                            ?></td>
                    <?php
                    $Totkasusdirawat[] = $dirawat;
                    $Totkasusdoa[] = $row['doa'];
                    $Totkasusmeninggalkurang8[] = $row['meninggalkurang8'];
                    $Totkasusmeninggalkurang48[] = $row['meninggalkurang48'];
                    $Totkasusmeninggallebih48[] = $row['meninggallebih48'];
                    $Totkasuspulangberobat[] = $row['pulangberobat'];
                    $Totkasuspulangaps[] = $row['pulangaps'];
                    $Totkasuspulangsembuh[] = $row['pulangsembuh'];
                    $Totkasuskonsulklinik[] = $row['konsulklinik'];
                    $Totkasusrujukbalik[] = $row['rujukbalik'];
                    $Totkasusrujukrslain[] = $pindah;
                    $Totkasuskabur[] = $row['kabur'];
                    $Totkasusregistrasi[] = $row['registrasi'];
                    ?>
                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <?php
            $check_TotKasusdirawat = isset($Totkasusdirawat) ? array_sum($Totkasusdirawat) : 0;
            $TotalKasusdirawat = $check_TotKasusdirawat;
            $check_TotKasusdoa = isset($Totkasusdoa) ? array_sum($Totkasusdoa) : 0;
            $TotalKasusdoa = $check_TotKasusdoa;
            $check_TotKasusmeninggalkurang8 = isset($Totkasusmeninggalkurang8) ? array_sum($Totkasusmeninggalkurang8) : 0;
            $TotalKasusmeninggalkurang8 = $check_TotKasusmeninggalkurang8;
            $check_TotKasusmeninggalkurang48 = isset($Totkasusmeninggalkurang48) ? array_sum($Totkasusmeninggalkurang48) : 0;
            $TotalKasusmeninggalkurang48 = $check_TotKasusmeninggalkurang48;
            $check_TotKasusmeninggallebih48 = isset($Totkasusmeninggallebih48) ? array_sum($Totkasusmeninggallebih48) : 0;
            $TotalKasusmeninggallebih48 = $check_TotKasusmeninggallebih48;
            $check_TotKasuspulangberobat = isset($Totkasuspulangberobat) ? array_sum($Totkasuspulangberobat) : 0;
            $TotalKasuspulangberobat = $check_TotKasuspulangberobat;
            $check_TotKasuspulangaps = isset($Totkasuspulangaps) ? array_sum($Totkasuspulangaps) : 0;
            $TotalKasuspulangaps = $check_TotKasuspulangaps;
            $check_TotKasuspulangsembuh = isset($Totkasuspulangsembuh) ? array_sum($Totkasuspulangsembuh) : 0;
            $TotalKasuspulangsembuh = $check_TotKasuspulangsembuh;
            $check_TotKasuskonsulklinik = isset($Totkasuskonsulklinik) ? array_sum($Totkasuskonsulklinik) : 0;
            $TotalKasuskonsulklinik = $check_TotKasuskonsulklinik;
            $check_TotKasusrujukbalik = isset($Totkasusrujukbalik) ? array_sum($Totkasusrujukbalik) : 0;
            $TotalKasusrujukbalik = $check_TotKasusrujukbalik;
            $check_TotKasusrujukrslain = isset($Totkasusrujukrslain) ? array_sum($Totkasusrujukrslain) : 0;
            $TotalKasusrujukrslain = $check_TotKasusrujukrslain;
            $check_TotKasuskabur = isset($Totkasuskabur) ? array_sum($Totkasuskabur) : 0;
            $TotalKasuskabur = $check_TotKasuskabur;
            $check_TotKasusregistrasi = isset($Totkasusregistrasi) ? array_sum($Totkasusregistrasi) : 0;
            $TotalKasusregistrasi = $check_TotKasusregistrasi;
            $check_Total = isset($TotKasus) ? array_sum($TotKasus) : 0;
            $TotalKasus = $check_Total;

            ?>
            <tr>
                <td class="text-right" colspan="2">Total Pasien</td>
                <td class="text-center"><b><?= $TotalKasusdirawat; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusdoa; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusmeninggalkurang8; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusmeninggalkurang48; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusmeninggallebih48; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuspulangberobat; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuspulangaps; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuspulangsembuh; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskonsulklinik; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusrujukbalik; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusrujukrslain; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuskabur; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusregistrasi; ?></b></td>
                <td class="text-center"><b><?= $TotalKasus; ?></b></td>
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
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
                <th class="text-center"></th>
                <th class="text-center"></th>
                <th class="text-center"><span class="badge badge-pill badge-success">TUNAI</span></th>
                <th class="text-center" colspan="8"><span class="badge badge-pill badge-danger">JKN</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">NOTA</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">BAKSOS</span></th>
                <th class="text-center" colspan="4"><span class="badge badge-pill badge-warning">JAMKESDA</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">JAMPERSAL KOTA</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">DISPENSASI</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning">LAIN-lAIN</span></th>
                <th class="text-center"><span class="badge badge-pill badge-warning"></span></th>
            </tr>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">PEMERIKSAAN</th>
                <th class="text-center">TUNAI</th>
                <th class="text-center">JKN-ASKES</th>
                <th class="text-center">JKN-BUMN</th>
                <th class="text-center">JKN-JAMKESMAS</th>
                <th class="text-center">JKN-JAMSOSTEK</th>
                <th class="text-center">JKN-KIS</th>
                <th class="text-center">JKN-UMUM</th>
                <th class="text-center">JKN-TNI POLRI</th>
                <th class="text-center">JKN-KS</th>
                <th class="text-center">NOTA</th>
                <th class="text-center">BAKSOS</th>
                <th class="text-center">JAMKESDA KOTA</th>
                <th class="text-center">JAMKESDA KAB CIANJUR</th>
                <th class="text-center">JAMKESDA KAB BOGOR</th>
                <th class="text-center">JAMKESDA KABUPATEN</th>
                <th class="text-center">JAMPERSAL KOTA</th>
                <th class="text-center">DISPENSASI</th>
                <th class="text-center">LAIN-LAIN</th>
                <th class="text-center">TOTAL</th>
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
                    <td class="text-center"><?= $row['tunai'] ?></td>
                    <td class="text-center"><?= $row['jknaskes'] ?></td>
                    <td class="text-center"><?= $row['jknbumn'] ?></td>
                    <td class="text-center"><?= $row['jknjamkesmas'] ?></td>
                    <td class="text-center"><?= $row['jknjamsostek'] ?></td>
                    <td class="text-center"><?= $row['jknkis'] ?></td>
                    <td class="text-center"><?= $row['jknumum'] ?></td>
                    <td class="text-center"><?= $row['jkntnipolri'] ?></td>
                    <td class="text-center"><?= $row['jknks'] ?></td>
                    <td class="text-center"><?php $totalnota = $row['nota'] + $row['notaaskes'] + $row['notaberkasjayamandiri'] + $row['notabpjstenagakerja'] + $row['notacemindo'] +
                                                $row['notagsi'] + $row['notajasaraharja'] + $row['notakelas2'] + $row['notakelas3'] + $row['notakeretaapi'] + $row['notakinocare'] + $row['notamedicapratama'] + $row['notamolaxglobal'] +
                                                $row['notamuara'] + $row['notamuaratunggal'] + $row['notanayaka'] + $row['notaperkasanusa'] + $row['notapos'] + $row['notabricianjur'] + $row['notabricibadak'] + $row['notabricisukabumi'] +
                                                $row['notagunungmanik'] + $row['notagunungrosa'] + $row['notauniversal'] + $row['notaptpn'] + $row['notarumahcemara'] + $row['notasemenjawa'] + $row['notayankopen'] + $row['notaykpbtn'];
                                            echo $totalnota; ?></td>
                    <td class="text-center"><?= $row['baksos'] ?></td>
                    <td class="text-center"><?= $row['jamkesdakota'] ?></td>
                    <td class="text-center"><?= $row['jamkesdacianjur'] ?></td>
                    <td class="text-center"><?= $row['jamkesdakabbogor'] ?></td>
                    <td class="text-center"><?= $row['jamkesdakabupaten'] ?></td>
                    <td class="text-center"><?= $row['jampersalkota'] ?></td>
                    <td class="text-center"><?= $row['dispensasi'] ?></td>
                    <td class="text-center"><?= $row['lain'] ?></td>
                    <td class="text-center"><?php $total = $row['tunai'] + $row['jknaskes'] + $row['jknbumn'] + $row['jknjamkesmas'] + $row['jknjamsostek'] + $row['jknkis'] +
                                                $row['jknumum'] + $row['jkntnipolri'] + $row['jknks'] + $totalnota + $row['baksos'] + $row['jamkesdakota'] + $row['jamkesdacianjur'] + $row['jamkesdakabbogor'] +
                                                $row['jamkesdakabupaten'] + $row['jampersalkota'] + $row['dispensasi'] + $row['lain'];
                                            echo $total;
                                            $TotKasus[] = $total;
                                            ?></td>
                    <?php
                    $TotkasusTunai[] = $row['tunai'];
                    $Totkasusjknaskes[] = $row['jknaskes'];
                    $Totkasusjknbumn[] = $row['jknbumn'];
                    $Totkasusjknjamkesmas[] = $row['jknjamkesmas'];
                    $Totkasusjknjamsostek[] = $row['jknjamsostek'];
                    $Totkasusjknkis[] = $row['jknkis'];
                    $Totkasusjknumum[] = $row['jknumum'];
                    $Totkasusjkntnipolri[] = $row['jkntnipolri'];
                    $Totkasusjknks[] = $row['jknks'];
                    $Totkasusnota[] = $totalnota;
                    $Totkasusbaksos[] = $row['baksos'];
                    $Totkasusjamkesdakota[] = $row['jamkesdakota'];
                    $Totkasusjamkesdacianjur[] = $row['jamkesdacianjur'];
                    $Totkasusjamkesdakabbogor[] = $row['jamkesdakabbogor'];
                    $Totkasusjamkesdakabupaten[] = $row['jamkesdakabupaten'];
                    $Totkasusjampersalkota[] = $row['jampersalkota'];
                    $Totkasusdispensasi[] = $row['dispensasi'];
                    $Totkasuslain[] = $row['lain'];
                    ?>
                </tr>

            <?php endforeach; ?>

        </tbody>
        <tfoot>
            <?php
            $check_TotKasusTunai = isset($TotkasusTunai) ? array_sum($TotkasusTunai) : 0;
            $TotalKasusTunai = $check_TotKasusTunai;
            $check_TotKasusjknaskes = isset($Totkasusjknaskes) ? array_sum($Totkasusjknaskes) : 0;
            $TotalKasusjknaskes = $check_TotKasusjknaskes;
            $check_TotKasusjknbumn = isset($Totkasusjknbumn) ? array_sum($Totkasusjknbumn) : 0;
            $TotalKasusjknbumn = $check_TotKasusjknbumn;
            $check_TotKasusjknjamkesmas = isset($Totkasusjknjamkesmas) ? array_sum($Totkasusjknjamkesmas) : 0;
            $TotalKasusjknjamkesmas = $check_TotKasusjknjamkesmas;
            $check_TotKasusjknjamsostek = isset($Totkasusjknjamsostek) ? array_sum($Totkasusjknjamsostek) : 0;
            $TotalKasusjknjamsostek = $check_TotKasusjknjamsostek;
            $check_TotKasusjknkis = isset($Totkasusjknkis) ? array_sum($Totkasusjknkis) : 0;
            $TotalKasusjknkis = $check_TotKasusjknkis;
            $check_TotKasusjknumum = isset($Totkasusjknumum) ? array_sum($Totkasusjknumum) : 0;
            $TotalKasusjknumum = $check_TotKasusjknumum;
            $check_TotKasusjkntnipolri = isset($Totkasusjkntnipolri) ? array_sum($Totkasusjkntnipolri) : 0;
            $TotalKasusjkntnipolri = $check_TotKasusjkntnipolri;
            $check_TotKasusjknks = isset($Totkasusjknks) ? array_sum($Totkasusjknks) : 0;
            $TotalKasusjknks = $check_TotKasusjknks;
            $check_TotKasusnota = isset($Totkasusnota) ? array_sum($Totkasusnota) : 0;
            $TotalKasusnota = $check_TotKasusnota;
            $check_TotKasusbaksos = isset($Totkasusbaksos) ? array_sum($Totkasusbaksos) : 0;
            $TotalKasusbaksos = $check_TotKasusbaksos;
            $check_TotKasusjamkesdakota = isset($Totkasusjamkesdakota) ? array_sum($Totkasusjamkesdakota) : 0;
            $TotalKasusjamkesdakota = $check_TotKasusjamkesdakota;
            $check_TotKasusjamkesdacianjur = isset($Totkasusjamkesdacianjur) ? array_sum($Totkasusjamkesdacianjur) : 0;
            $TotalKasusjamkesdacianjur = $check_TotKasusjamkesdacianjur;
            $check_TotKasusjamkesdakabbogor = isset($Totkasusjamkesdakabbogor) ? array_sum($Totkasusjamkesdakabbogor) : 0;
            $TotalKasusjamkesdakabbogor = $check_TotKasusjamkesdakabbogor;
            $check_TotKasusjamkesdakabupaten = isset($Totkasusjamkesdakabupaten) ? array_sum($Totkasusjamkesdakabupaten) : 0;
            $TotalKasusjamkesdakabupaten = $check_TotKasusjamkesdakabupaten;
            $check_TotKasusjampersalkota = isset($Totkasusjampersalkota) ? array_sum($Totkasusjampersalkota) : 0;
            $TotalKasusjampersalkota = $check_TotKasusjampersalkota;
            $check_TotKasusdispensasi = isset($Totkasusdispensasi) ? array_sum($Totkasusdispensasi) : 0;
            $TotalKasusdispensasi = $check_TotKasusdispensasi;
            $check_TotKasuslain = isset($Totkasuslain) ? array_sum($Totkasuslain) : 0;
            $TotalKasuslain = $check_TotKasuslain;

            $check_Total = isset($TotKasus) ? array_sum($TotKasus) : 0;
            $TotalKasus = $check_Total;

            ?>
            <tr>
                <td class="text-right" colspan="2">Total Pemeriksaan</td>
                <td class="text-center"><b><?= $TotalKasusTunai; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjknaskes; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjknbumn; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjknjamkesmas; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjknjamsostek; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjknkis; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjknumum; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjkntnipolri; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjknks; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusnota; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusbaksos; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjamkesdakota; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjamkesdacianjur; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjamkesdakabbogor; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjamkesdakabupaten; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusjampersalkota; ?></b></td>
                <td class="text-center"><b><?= $TotalKasusdispensasi; ?></b></td>
                <td class="text-center"><b><?= $TotalKasuslain; ?></b></td>
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
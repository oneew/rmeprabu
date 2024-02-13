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
                <th class="text-center" rowspan="3">No</th>
                <th class="text-center" rowspan="3">No. DTD</th>
                <th class="text-center" rowspan="3">No. Daftar Terperinci</th>
                <th class="text-center" rowspan="3">Golongan Sebab Penyakit</th>
                <th class="text-center" colspan="12">Jumlah Pasien Hidup dan Mati Menurut Golongan Umur & Jenis Kelamin</th>
                <th class="text-center" colspan="2" rowspan="2">Pasien Keluar Hidup & Mati Menurut Jenis Kelamin</th>
                <th class="text-center" rowspan="3">Jumlah Pasien Keluar Hidup</th>
                <th class="text-center" rowspan="3">Jumlah Pasien Keluar Mati</th>
            </tr>
            <tr>
                <th class="text-center" colspan="2">1-4 Thn</th>
                <th class="text-center" colspan="2">5-14 Thn</th>
                <th class="text-center" colspan="2">15-24 Thn</th>
                <th class="text-center" colspan="2">25-44 Thn</th>
                <th class="text-center" colspan="2">45-64 Thn</th>
                <th class="text-center" colspan="2">>65 Thn</th>
            </tr>
            <tr>
                <th class="text-center"><span class="badge badge-pill badge-info">L</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">P</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">L</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">P</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">L</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">P</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">L</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">P</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">L</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">P</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">L</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">P</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">L</span></th>
                <th class="text-center"><span class="badge badge-pill badge-info">P</span></th>

            </tr>
        </thead>
        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td class="text-center"><?= $row['codeicdx'] ?></td>
                    <td class="text-center"></td>
                    <td class="text-center"><?= $row['nameicdx'] ?></td>
                    <td class="text-center"><?= $row['Lkurang4'] ?></td>
                    <td class="text-center"><?= $row['Pkurang4'] ?></td>
                    <td class="text-center"><?= $row['Lkurang14'] ?></td>
                    <td class="text-center"><?= $row['Pkurang14'] ?></td>
                    <td class="text-center"><?= $row['Lkurang24'] ?></td>
                    <td class="text-center"><?= $row['Pkurang24'] ?></td>
                    <td class="text-center"><?= $row['Lkurang44'] ?></td>
                    <td class="text-center"> <?= $row['Pkurang44'] ?></td>
                    <td class="text-center"><?= $row['Lkurang64'] ?></td>
                    <td class="text-center"><?= $row['Pkurang64'] ?></td>
                    <td class="text-center"><?= $row['Lkurang65'] ?></td>
                    <td class="text-center"><?= $row['Lkurang65'] ?></td>
                    <td class="text-center"><?= $row['laki'] ?></td>
                    <td class="text-center"><?= $row['perempuan'] ?></td>
                    <td class="text-center"><?php $hidup = $row['pulang'] + $row['pulangsembuh'] + $row['kabur'] + $row['rujukbalik'] + $row['pindah'] + $row['rujuk'] + $row['pulangaps'] + $row['dirawat1'] + $row['dirawat2'];
                                            echo $hidup; ?></td>
                    <td class="text-center"><?php $die = $row['doa'] + $row['meninggal1'] + $row['meninggal2'] + $row['meninggal3'];
                                            echo $die; ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>
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
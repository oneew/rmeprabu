<!DOCTYPE html>

<head>
    <!-- <link href="../assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="<?= base_url(); ?>/assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <!-- <link href="../assets/plugins/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet"> -->
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

<body>
    <!-- <table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap"> -->
    <table id="registerranap" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Pelayanan</th>
                <th>Nama</th>
                <th>Nomor Rekam Medis</th>
                <th>Alamat</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Pulang</th>
                <th>Tanggal Koding</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>Jenis Jaminan</th>
                <th>Status Pasien (Lama/Baru)</th>
                <th>Kode ICD</th>
                <th>DPJP</th>
                <th>Ruang Rawat/Poli</th>
                <th>Kelas Rawat</th>
                <th>Keadaan Pulang</th>


            </tr>
        </thead>
        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?php if ($row['groups'] == "IRJ") {
                            $pelayanan = "RAWAT JALAN";
                        }
                        if ($row['groups'] == "IGD") {
                            $pelayanan = "IGD";
                        }
                        if ($row['groups'] == "RI") {
                            $pelayanan = "RAWAT INAP";
                        }
                        echo $pelayanan; ?>
                    </td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienaddress'] ?> <?= $row['pasiensubareaname'] ?> <?= $row['pasienarea'] ?></td>
                    <td><?= $row['dateIn'] ?></td>
                    <td><?= $row['dateOut'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><?php if ($row['pasiengender'] == "L") {
                            $jenkel = "Laki-laki";
                        }
                        if ($row['pasiengender'] == "P") {
                            $jenkel = "Perempuan";
                        }
                        echo $jenkel; ?></td>
                    <td><?= $row['pasienage'] ?></td>
                    <td><?= $row['paymentmethodname'] ?></td>
                    <td><?= $row['lamabaru']; ?></td>
                    <td><?= $row['kodeIcd']; ?></td>
                    <td><?= $row['doktername']; ?></td>
                    <td><?= $row['poliklinikname']; ?></td>
                    <td><?= $row['classroomname']; ?></td>
                    <td><?= $row['keadaanPulang']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>

<script>
    $('#registerranap').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        scrollY: '500px',
        // columnDefs: [{
        //         responsivePriority: 3,
        //         targets: 0
        //     },
        //     {
        //         responsivePriority: 2,
        //         targets: -1
        //     }
        // ],

        buttons: [
            // 'copy', 
            'csv', 'excel', 'pdf', 'print'
        ]
    })
</script>

<!-- <script type="text/javascript">
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
</script> -->
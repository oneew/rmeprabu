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

            <h4> <?= $kelompok; ?></h4>

            <h5> <?= $deskripsi; ?></h5>

            </p>

        </address>

    </div>

    <table id="pasienmasukrajal" class="tablesaw table-bordered table-hover table no-wrap">

        <thead>

            <tr>

                <th>No</th>
                <th>Tgl. Masuk</th>
                <th>Tgl. Keluar</th>
                <th>Nomor RekamMedis</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Metode Pembayaran</th>
                <th>Hak Kelas</th>
                <th>Ruangan</th>
                <th>Status Pasien</th>
                <th>SMF</th>
                <th>Dokter</th>
                <th>Alamat</th>
                <th>Diagnosa</th>
                <th>Umur</th>
                <th>Desa/Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kabupaten/Kota</th>
            </tr>

        </thead>

        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>

                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['datein'] ?></td>
                    <td><?= $row['dateout'] ?></td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['pasiengender'] ?></td>
                    <td><?= $row['paymentmethodname'] ?></td>
                    <td><?= $row['pasienclassroom'] ?> <?php ?></td>
                    <td><?= $row['roomname'] ?></td>
                    <td><?= $row['statuspasienpulang'] ?></td>
                    <td><?= $row['smfname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= $row['pasienaddress'] ?> <?php ?></td>
                    <td class="<?= check_resume_ranap($row['referencenumber']) == 'ADA' ? null : 'bg-danger text-white' ;?>">
                    <?= check_resume_ranap($row['referencenumber']) == 'ADA' ? $row['diagnosisUtama'] : 'Resume belum di isi' ;?>
                    </td>
                    <td><?= $row['pasienage'] ?> <?php ?></td>
                    <td><?= $row['district'] ?> <?php ?></td>
                    <td><?= $row['kecamatan'] ?> <?php ?></td>
                    <td><?= $row['kabupaten'] ?> <?php ?></td>

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
        $printSection.innerHTML = ""
        $printSection.appendChild(domClone);
        window.print();

    }

</script>

<script>

    $('#pasienmasukrajal').DataTable({

        scrollX:true,

        dom: 'Bfrtip',

        displayLength: 50,

        buttons: [

            'copy', 'csv', 'excel', 'pdf', 'print'

        ]

    })

</script>
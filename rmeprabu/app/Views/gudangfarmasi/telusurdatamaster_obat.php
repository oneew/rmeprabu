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
            <h4>Telusur Data Obat / AKHP/ BHP/ GAS MEDIS</h4>
            </p>
        </address>
    </div>
    <table id="radiologi" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th>Faktur</th>
                <th>Distribusi</th>
                <th>Penjualan</th>
                <th>Kartu Stok</th>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Jenis</th>
                <th>Kategori</th>
                <th>Kelompok</th>
                <th>Manufaktur</th>

            </tr>
        </thead>
        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><button type="button" class="btn btn-warning btn-sm" onclick="carifaktur('<?= $row['code'] ?>')"> <i class="mdi mdi-apple-keyboard-command"></i></td>
                    <td><button type="button" class="btn btn-info btn-sm" onclick="caridistribusi('<?= $row['code'] ?>')"> <i class="mdi mdi-apple-keyboard-command"></i></td>
                    <td><button type="button" class="btn btn-danger btn-sm" onclick="caripenjualan('<?= $row['code'] ?>')"> <i class="mdi mdi-apple-keyboard-command"></i></td>
                    <td><button type="button" class="btn btn-dark btn-sm" onclick="carikartu('<?= $row['code'] ?>')"> <i class="mdi mdi-apple-keyboard-command"></i></td>
                    <td><?= $no ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['uom'] ?></td>
                    <td><?= $row['types'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td><?= $row['groups'] ?></td>
                    <td><?= $row['manufacturename'] ?></td>
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
    $('#radiologi').DataTable({
        "displayLength": 100,
    })
</script>


<script>
    function carifaktur(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TelusurMasterObat/CariFakturOBAT'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalcarifakturobat').modal('show');

                }
            }

        });
    }
</script>



<script>
    function caridistribusi(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TelusurMasterObat/CariDistribusiOBAT'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalcaridistribusiobat').modal('show');

                }
            }

        });
    }
</script>



<script>
    function caripenjualan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TelusurMasterObat/CariPenjualanOBAT'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalcaripenjualanobat').modal('show');

                }
            }

        });
    }
</script>


<script>
    function carikartu(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('TelusurMasterObat/CariKartuOBAT'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalcarikartustok').modal('show');

                }
            }

        });
    }
</script>
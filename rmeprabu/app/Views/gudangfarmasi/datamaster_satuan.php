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
            <h4>Data Master Satuan</h4>
            </p>
        </address>
    </div>
    <table id="radiologi" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>

                <th>#</th>
                <th>No</th>
                <th>KodeSataun</th>
                <th>NamaSatuan</th>
                <th>Kelompok</th>
            </tr>
        </thead>
        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><button type="button" class="btn btn-info btn-sm" onclick="updatesatuan('<?= $row['id'] ?>')"> <i class="mdi mdi-apple-keyboard-command"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $row['id'] ?>')"> <i class="fas fa-trash-alt"></i></button>
                    </td>

                    <td><?= $no ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['types'] ?></td>

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
        "displayLength": 100,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    })
</script>

<script>
    function updatesatuan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Satuan/editsatuan'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaleditsatuan').modal('show');

                }
            }

        });


    }
</script>

<script>
    function hapus(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data satuan ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('Satuan/hapusSatuan'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            datasupplier();

                        }
                    }

                });


            }
        })

    }
</script>
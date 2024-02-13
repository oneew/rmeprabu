<head>
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">



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
<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>


            <th>No</th>
            <th>Kode</th>
            <th>Uraian</th>

            <th>Jenis</th>
            <th>No. Batch</th>
            <th>Exp. Date</th>
            <th>HNA + PPN</th>
            <th>Sisa</th>
            <th>Satuan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>

                <td><?= $no ?></td>
                <td><?= $row['code'] ?></td>
                <td><?= $row['name'] ?></td>


                <td><?= $row['groups'] ?></td>
                <td><?= $row['batchnumber'] ?></td>
                <td><?= $row['expireddate'] ?></td>
                <td style="text-align: right;"><?= number_format($row['taxprice'], 2, ",", "."); ?></td>
                <td style="text-align: center;"><?= number_format($row['stock'], 2, ",", "."); ?></td>
                <td><?= $row['uom'] ?></td>
                <?php $totalstock[] = $row['stock']; ?>
            </tr>

        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <td colspan="15" class="text-center">
            <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
        </td>
        <h3><?php
            $check_Stock = isset($totalstock) ? array_sum($totalstock) : 0;
            $Total_Stock = $check_Stock;
            echo number_format($Total_Stock, 2, ",", "."); ?> </h3>
        <h5>Stok Tanggal : <?= date('d-m-Y'); ?></h5>
    </tfoot>
</table>




<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('LaporanGudangFarmasi/printstok') ?>?page=" + id, "_blank");

        })
    });
</script>



<script>
    $('#registerranap').DataTable({
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
        "displayLength": 50,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    })
</script>


<script>
    function fixing(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanGudangFarmasi/fixing'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalfixingbatch').modal('show');
                }
            }
        });
    }
</script>
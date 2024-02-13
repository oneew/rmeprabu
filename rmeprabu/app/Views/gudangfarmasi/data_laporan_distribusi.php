<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>

            <th>No</th>
            <th>Kode</th>
            <th>Uraian</th>
            <th>Tanggal</th>
            <th>No.Register</th>
            <th>Sumber</th>
            <th>Tujuan</th>
            <th>No. Permintaan</th>
            <th>No. Batch</th>
            <th>Exp. Date</th>
            <th>Jumlah</th>
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
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['locationname'] ?></td>
                <td><?= $row['referencelocationname'] ?></td>
                <td><?= $row['referencenumber'] ?></td>
                <td><?= $row['batchnumber'] ?></td>
                <td><?= $row['expireddate'] ?></td>
                <td><?= abs($row['qty']) ?></td>
                <td><?= $row['uom'] ?></td>
            </tr>

        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <td colspan="11" class="text-center">
            <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
        </td>
    </tfoot>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('LaporanGudangFarmasi/printdistribusi') ?>?page=" + id, "_blank");

        })
    });
</script>

<script>
    $('#registerranap').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "paging": false,
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
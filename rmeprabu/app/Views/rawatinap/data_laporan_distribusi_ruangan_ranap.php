<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>

            <th>No</th>
            <th>Kode</th>
            <th>Uraian</th>
            <th>Tanggal</th>
            <th>No.Register</th>
            <th>Pengirim</th>
            <th>Penerima</th>
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
<table id="datapoli" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th style="width: 20px;">#</th>
            <th>No</th>
            <th>Nama Dokter</th>
            <th>Kode Dokter</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($response as $row) :
            $no++; ?>
            <tr>
                <td><button type="button" class="btn waves-effect btn-rounded btn-outline-info btn-sm btnprintsep" onclick="UpdateJadwal('<?= $row['kodedokter']; ?>')"> <i class="mdi mdi-lead-pencil"></i></button></td>
                <td><?= $no ?></td>
                <td><?= $row['namadokter']; ?></td>
                <td><?= $row['kodedokter']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#datapoli').DataTable({
            responsive: true
        });
    });
</script>

<script>
    function UpdateJadwal(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/Cetak'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalprintregisterranap').modal('show');
                }
            }
        });
    }
</script>
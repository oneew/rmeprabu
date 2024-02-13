<table id="datapengguna" class="table display table-bordered table-striped no-wrap" style="width:100%">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kode Lokasi</th>
            <th>Aktifitas</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>
                <td><button type="button" class="btn btn-success btn-sm" onclick="CatatLokasi('<?= $row['id'] ?>')"> <i class="fas fa-bed"></i></button></td>
                <td><?= $row['firstname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['locationcode'] ?></td>
                <td><?= $row['activity'] ?></td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>



<script>
    $(document).ready(function() {
        $('#datapengguna').DataTable({
            responsive: true
        });
    });

    function CatatLokasi(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('UsersAkun/entriLokasi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalinputlokasi').modal('show');
                }
            }
        });

    }
</script>
<table id="dataexpertise" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>No Foto/Expertise</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>MetodePembayaran</th>
            <th>RuanganAsal</th>
            <th>Pemeriksaan</th>
            <th>DokterPengirim</th>
            <th>TanggalExpertise</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-succes btn-sm btnprintsep" onclick="Cetak('<?= $row['id']; ?>')"> <i class="fas fa-eye"></i></button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['expertiseid'] ?></td>
                <td><?= $row['relation'] ?></td>
                <td><?= $row['relationname'] ?></td>
                <td><?= $row['paymentmethod'] ?></td>
                <td><?= $row['roomname'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['created_at'] ?>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>


<script>
    function Cetak(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRadiologi/ViewExpertise'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modal').modal('show');

                }
            }

        });


    }
</script>
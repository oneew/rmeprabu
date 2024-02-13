<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Tgl Permintaan</th>
            <th>No Surat Pesan</th>
            <th>Penyedia</th>
            <th>Nama Pembuat</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="ubahpesanan('<?= $row['id']; ?>')"> <i class="far fa-edit"></i></button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['destinationname'] ?></td>
                <td><?= $row['createdby'] ?></td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<script>
    function ubahpesanan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('AmprahFarmasi/UbahPesanan'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalsuratpesanan_add').modal('show');

                }
            }

        });


    }
</script>
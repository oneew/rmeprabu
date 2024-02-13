<table id="datarajal" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>ReferenceNumber</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>Poliklinik</th>
            <th>Dokter</th>


        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>
                <td><button type="button" class="btn btn-success waves-light btn-rounded btn-sm" onclick="hdrajal('<?= $row['id'] ?>')"> <i class="fas fa-diagnoses"></i></button></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['pasienid']  ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['poliklinikname'] ?></td>
                <td><?= $row['doktername'] ?></td>


            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#datarajal').DataTable();


    });

    function hdrajal(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RegHD/orderfromrajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukseshd) {
                    $('.viewmodal').html(response.sukseshd).show();
                    $('#modaldaftarhdfromrajal').modal('show');

                }
            }

        });


    }
</script>